# Speed up MySQL

## Index 

Index All Columns Used in 'where', 'order by', and 'group by' Clauses

## Optimize Like Statements With Union Clause

## Avoid Like Expressions With Leading Wildcards

## Take Advantage of MySQL Full-Text Searches

## Optimize Your Database Schema

## MySQL Query Caching

**Ref:** https://dzone.com/articles/how-to-optimize-mysql-queries-for-speed-and-perfor

---

## Issue about `UPDATE`

`UPDATE` statement is logged, which means it has to write twice for every single write to the table.

Example:

Situation: Reading from the `Customer` table and you want anyone with more than $100,000 in orders to be labeled as "Preferred".

Bad solution: Insert the data into the table. Then run an `UPDATE` statement to set the CustomerRank column to "Preferred" for anyone who has more than $100,000 in orders.

Good solution:
```sql
SELECT ..., ...,
CASE
    WHEN amount > 100000 THEN 'Preferred'
    ELSE ''
END AS CustomerRank
FROM Customer;
```
and then insert it.

## Don’t blindly reuse code

When copying code, rid the things that you don't need. eg joins, where conditions... 

## Do pull only the number of columns you need

Don't `SELECT *`, just take what you need.

## Don’t double-dip

Query large tables only once whenever possible.

## Do pre-stage data

This is one of my favorite topics because it’s an old technique that’s often overlooked. If you have a report or a procedure (or better yet, a set of them) that will do similar joins to large tables, it can be a benefit for you to pre-stage the data by joining the tables ahead of time and persisting them into a table. Now the reports can run against that pre-staged table and avoid the large join.

You’re not always able to use this technique, but when you can, you’ll find it is an excellent way to save server resources.

Note that many developers get around this join problem by concentrating on the query itself and creating a view-only around the join so that they don’t have to type the join conditions again and again. But the problem with this approach is that the query still runs for every report that needs it. By pre-staging the data, you run the join just once (say, 10 minutes before the reports) and everyone else avoids the big join. I can’t tell you how much I love this technique; in most environments, there are popular tables that get joined all the time, so there’s no reason why they can’t be pre-staged.

## Do delete and update in batches

Don't delete/update too many entries in one go. ("in one go" here means: as 1 transaction). It can cause blockages.

## Don't do large ops on many tables in the same batch

Don't operate on too many tables on 1 transaction. Remember that each table will be locked. It can cause blockages.

## Do use temp tables to improve cursor performance

### What is cursor:

- https://www.youtube.com/watch?v=9z6ouWK5_l0
	- https://www.youtube.com/watch?v=VtUvkndrk_c

![](https://raw.githubusercontent.com/atabegruslan/Others/master/Illustrations/cursor.PNG)

- https://www.javatpoint.com/mysql-cursor
- https://www.youtube.com/watch?v=RHRjLd0bEaQ
- https://www.youtube.com/watch?v=xhBUE4Lb1go

I hope we all know by now that it’s best to stay away from cursors if at all possible. Cursors not only suffer from speed problems, which in itself can be an issue with many operations, but they can also cause your operation to block other operations for a lot longer than is necessary. This greatly decreases concurrency in your system.

However, you can’t always avoid using cursors, and when those times arise, you may be able to get away from cursor-induced performance issues by doing the cursor operations against a temp table instead. Take, for example, a cursor that goes through a table and updates a couple of columns based on some comparison results. Instead of doing the comparison against the live table, you may be able to put that data into a temp table and do the comparison against that instead. Then you have a single `UPDATE` statement against the live table that’s much smaller and holds locks only for a short time.

Sniping your data modifications like this can greatly increase concurrency. I’ll finish by saying you almost never need to use a cursor. There’s almost always a set-based solution; you need to learn to see it.

## Don't nest views

### What are views

- https://www.youtube.com/watch?v=DCp0oFVG_fk

![](https://raw.githubusercontent.com/atabegruslan/Others/master/Illustrations/view_cants.PNG)

### View VS Stored Prodecures

- https://dev.to/rachelsoderberg/comparing-sql-views-and-stored-procedures-4pfb

### Nested View & its disadvantage

- https://bornsql.ca/blog/nested-views-bad/

Views can be convenient, but you need to be careful when using them. While views can help to obscure large queries from users and to standardize data access, you can easily find yourself in a situation where you have views that call views that call views that call views. This is called nesting views, and it can cause severe performance issues, particularly in two ways:

- First, you will very likely have much more data coming back than you need.
- Second, the query optimizer will give up and return a bad query plan.

I once had a client that loved nesting views. The client had one view it used for almost everything because it had two important joins. The problem was that the view returned a column with 2MB documents in it. Some of the documents were even larger. The client was pushing at least an extra 2MB across the network for every single row in almost every single query it ran. Naturally, query performance was abysmal.

And none of the queries actually used that column! Of course, the column was buried seven views deep, so even finding it was difficult. When I removed the document column from the view, the time for the biggest query went from 2.5 hours to 10 minutes. When I finally unraveled the nested views, which had several unnecessary joins and columns, and wrote a plain query, the time for that same query dropped to subseconds.

## Do use table-valued functions

This is one of my favorite tricks of all time because it is truly one of those hidden secrets that only the experts know. When you use a scalar function in the `SELECT` list of a query, the function gets called for every single row in the result set. This can reduce the performance of large queries by a significant amount. However, you can greatly improve the performance by converting the scalar function to a table-valued function and using a `CROSS APPLY` in the query. This is a wonderful trick that can yield great improvements.

- https://stackoverflow.com/questions/34754663/difference-between-scalar-table-valued-and-aggregate-functions-in-sql-server
- https://www.sqlservertutorial.net/sql-server-user-defined-functions/sql-server-scalar-functions/
- https://www.sqlservertutorial.net/sql-server-user-defined-functions/sql-server-table-valued-functions/
- https://www.mssqltips.com/sqlservertip/1958/sql-server-cross-apply-and-outer-apply/

## Do use partitioning to avoid large data moves

Not everyone will be able to take advantage of this tip, which relies on partitioning in SQL Server Enterprise, but for those of you who can, it’s a great trick. Most people don’t realize that all tables in SQL Server are partitioned. You can separate a table into multiple partitions if you like, but even simple tables are partitioned from the time they’re created; however, they’re created as single partitions. If you’re running SQL Server Enterprise, you already have the advantages of partitioned tables at your disposal.

This means you can use partitioning features like `SWITCH` to archive large amounts of data from a warehousing load. Let’s look at a real example from a client I had last year. The client had the requirement to copy the data from the current day’s table into an archive table; in case the load failed, the company could quickly recover with the current day’s table. For various reasons, it couldn’t rename the tables back and forth every time, so the company inserted the data into an archive table every day before the load, then deleted the current day’s data from the live table.

This process worked fine in the beginning, but a year later, it was taking 1.5 hours to copy each table -- and several tables had to be copied every day. The problem was only going to get worse. The solution was to scrap the `INSERT` and `DELETE` process and use the `SWITCH` command. The `SWITCH` command allowed the company to avoid all of the writes because it assigned the pages to the archive table. It’s only a metadata change. The `SWITCH` took on average between two and three seconds to run. If the current load ever fails, you `SWITCH` the data back into the original table.

This is a case where understanding that all tables are partitions slashed hours from a data load.

## If you must use ORMs, use stored procedures

ORM machine-generates queries, which is never as good as a programmer who knows what he's doing.

Stored procedures have a number of advantages. For starters, you’re pushing much less data across the network. If you have a long query, then it could take three or four round trips across the network to get the entire query to the database server. That's not including the time it takes the server to put the query back together and run it, or considering that the query may run several -- or several hundred -- times a second.

Using a stored procedure will greatly reduce that traffic because the stored procedure call will always be much shorter. Also, stored procedures are easier to trace in Profiler or any other tool. A stored procedure is an actual object in your database. That means it's much easier to get performance statistics on a stored procedure than on an ad-hoc query and, in turn, find performance issues and draw out anomalies.

In addition, stored procedures parameterize more consistently. This means you’re more likely to reuse your execution plans and even deal with caching issues, which can be difficult to pin down with ad-hoc queries. Stored procedures also make it much easier to deal with edge cases and even add auditing or change-locking behavior. A stored procedure can handle many tasks that trouble ad-hoc queries. My wife unraveled a two-page query from Entity Framework a couple of years ago. It took 25 minutes to run. When she boiled it down to its essence, she rewrote that huge query as `SELECT COUNT(*) from T1`. No kidding.

OK, I kept it as short as I could. Those are the high-level points. I know many .Net coders think that business logic doesn’t belong in the database, but what can I say other than you’re outright wrong. By putting the business logic on the front end of the application, you have to bring all of the data across the wire merely to compare it. That’s not good performance. I had a client earlier this year that kept all of the logic out of the database and did everything on the front end. The company was shipping hundreds of thousands of rows of data to the front end, so it could apply the business logic and present the data it needed. It took 40 minutes to do that. I put a stored procedure on the back end and had it call from the front end; the page loaded in three seconds.

Of course, the truth is that sometimes the logic belongs on the front end and sometimes it belongs in the database. But ORMs always get me ranting.

- https://laravel.io/forum/04-23-2014-eloquent-vs-raw-sql-which-is-really-better
- https://stackoverflow.com/questions/38391710/laravel-eloquent-vs-query-builder-why-use-eloquent-to-decrease-performance

## Don't use triggers

### What are triggers

![](https://raw.githubusercontent.com/atabegruslan/Others/master/Illustrations/Triggers_1.PNG)

![](https://raw.githubusercontent.com/atabegruslan/Others/master/Illustrations/Triggers_2.PNG)

- https://www.youtube.com/watch?v=gy6LY0Xy2zU

This one is largely the same as the previous one, but it bears mentioning. Don’t use triggers unless it’s unavoidable -- and it’s almost always avoidable.

The problem with triggers: Whatever it is you want them to do will be done in the same transaction as the original operation. If you write a trigger to insert data into another table when you update a row in the Orders table, the lock will be held on both tables until the trigger is done. If you need to insert data into another table after the update, then put the update and the insert into a stored procedure and do them in separate transactions. If you need to roll back, you can do so easily without having to hold locks on both tables. As always, keep transactions as short as possible and don’t hold locks on more than one resource at a time if you can help it.

## Don’t cluster on GUID

A GUID (globally unique identifier) is a 16-byte randomly generated number. 

Ordering your table's data on this clustered GUID will cause your table to fragment much faster than using a steadily increasing value like `DATE` or `IDENTITY`. 

This applies to more than GUIDs -- it goes toward any volatile column.

## Don't count all rows if you only need to see if data exists

Don't use `SELECT COUNT(*)` to check existence. Use `If EXISTS` instead.

```sql
SET @CT = (SELECT COUNT(*) FROM dbo.T1);
If @CT > 0
BEGIN
<Do something>
END 
```

```sql
If EXISTS (SELECT 1 FROM dbo.T1)
BEGIN
<Do something>
END
```

`SELECT COUNT(*)` takes a LOT more reads.

If you really do need a row count on the table, and it's really big, another technique is to pull it from the system table. `SELECT` rows from `sysindexes` will get you the row counts for all of the indexes. And because the clustered index represents the data itself, you can get the table rows by adding `WHERE indid = 1`. Then simply include the table name and you're golden. So the final query is: 

`SELECT rows from sysindexes where object_name(id) = 'T1' and indexid = 1`. 

In my 270 million row table, this returned sub-second and had only six logical reads. Now that's performance.

## Don’t do negative searches

Instead of `SELECT * FROM Customers WHERE RegionID <> 3`,

(You can't use an index with the above query because it's a negative search that has to be compared row by row with a table scan)

Use `SELECT * FROM Customers WHERE RegionID < 3 UNION ALL SELECT * FROM Customers WHERE RegionID`.

(The above query uses the index)

**Ref:** https://www.infoworld.com/article/3209665/sql-unleashed-17-ways-to-speed-your-sql-queries.html

https://github.com/atabegruslan/Others/blob/master/Illustrations/Improve_SQL_Performance.pdf

![](https://raw.githubusercontent.com/atabegruslan/Others/master/Illustrations/improve_SQL_Server_performance.PNG)

Index make selection faster but modifications slower.

For selection: clustered index is the fastest, non clustered index can be even worse than no index.

Don't use function inside WHERE clause of the SQL query, because if so, then the SQL server will scan instead of seek table using indexes.

Specify these 2 to make insert faster:

![](https://raw.githubusercontent.com/atabegruslan/Others/master/Illustrations/improve_SQL_Server_performance_3.PNG)

Turn statistics (ie SQL Server intel) on is faster:

![](https://raw.githubusercontent.com/atabegruslan/Others/master/Illustrations/improve_SQL_Server_performance_4.PNG)

https://bertwagner.com/posts/12-ways-to-rewrite-sql-queries-for-better-performance/

---

## Eager vs Lazy load

- The (n + 1) problem: https://stackoverflow.com/questions/97197/what-is-the-n1-selects-problem-in-orm-object-relational-mapping
- In Laravel: https://www.youtube.com/watch?v=bZlvzvGpCEE
- In Laravel: https://www.youtube.com/watch?v=N0phQbyzF0I
- In .NET: https://www.youtube.com/watch?v=j4w-KFoZTtI

![](https://raw.githubusercontent.com/atabegruslan/Others/master/Illustrations/dotnet_eager_lazy.PNG)

---

# Security

- https://www.infoworld.com/article/2953834/7-essential-sql-server-security-tips.html

---

# General Basics

## DB Platforms

- https://en.wikipedia.org/wiki/Comparison_of_relational_database_management_systems
- https://www.quora.com/What-are-the-different-database-servers


- https://www.guru99.com/mariadb-vs-mysql.html
- https://softwareengineering.stackexchange.com/questions/120178/whats-the-difference-between-mariadb-and-mysql

## Storage Engines

- https://mariadb.com/kb/en/storage-engine-index-types/
- https://en.wikipedia.org/wiki/Database_engine
	- https://en.wikipedia.org/wiki/Database_engine#Data_structures

- https://dev.mysql.com/doc/refman/5.7/en/storage-engines.html
- https://dba.stackexchange.com/questions/17431/which-is-faster-innodb-or-myisam

InnoDB | MyISAM
------ | ------
row-level locking   | full table-level locking  
faster insert and update   | faster read in some situations  
less efficient `select count(*)`   | efficient `select count(*)` (save data as table level)  
referential integrity (RDBMS)   | no referential integrity (DMBS)  
ACID   | no ACID  
transaction, logs, rollback   | no transaction nor crash recovery  
big projects   | small projects, small footprint  
FULLTEXT only after MySQL 5.6. InnoDB uses inverted lists for FULLTEXT indexes.   | FULLTEXT search indexes  
AUTO_INCREMENT field is a part of index   |   
cant re-establish deleted tables   |   

- Most MySQL indexes (PRIMARY KEY, UNIQUE, INDEX, and FULLTEXT) are stored in B-trees. 
- Indexes on spatial data types use R-trees.
- MEMORY tables also support hash indexes.

## Index

- https://stackoverflow.com/questions/7306316/b-tree-vs-hash-table
- Good tutorial: https://www.youtube.com/watch?v=EZ3jBam2IEA&list=PL_c9BZzLwBRK0Pc28IdvPQizD2mJlgoID&index=41
- https://www.youtube.com/watch?v=ITcOiLSfVJQ
- https://itknowledgeexchange.techtarget.com/itanswers/cluster-index/
- https://dev.mysql.com/doc/refman/5.5/en/mysql-indexes.html
- https://dev.mysql.com/doc/refman/8.0/en/index-btree-hash.html

![](https://raw.githubusercontent.com/atabegruslan/Others/master/Illustrations/clustered_vs_non_index.PNG)

![](https://raw.githubusercontent.com/atabegruslan/Others/master/Illustrations/unique_n_primary_keys.PNG)

## Full-text vs metadata search

Full-text search is distinguished from searches based on metadata or on parts of the original texts.

In a full-text search, a search engine examines all of the words in every stored document as it tries to match search criteria.

- https://mariadb.com/kb/en/full-text-index-overview/
- https://en.wikipedia.org/wiki/Full-text_search
- https://www.youtube.com/watch?v=Q8Kg67XgPzc

## Character Sets and Collations

A character set is a set of symbols and encodings. A collation is a set of rules for comparing characters in a character set.

- https://dev.mysql.com/doc/refman/8.0/en/charset-general.html
- https://stackoverflow.com/questions/4538732/what-does-collation-mean
- https://mysqlserverteam.com/mysql-8-0-1-accent-and-case-sensitive-collations-for-utf8mb4/
- https://stackoverflow.com/questions/48588705/how-to-remove-diacritics-from-utf8-characters-in-php


- https://www.w3schools.com/sql/func_mysql_binary.asp
- https://mariadb.com/kb/en/about-mroonga/
- https://mroonga.org/docs/

## Encoding

https://github.com/atabegruslan/Others/blob/master/Illustrations/encode.md#encodings-commonly-used-in-web-development-db

## Similar data types

- https://www.youtube.com/playlist?list=PL_c9BZzLwBRKn20DFbNeLAAbw4ZMTlZPH
- Texts: 
	- https://chartio.com/resources/tutorials/understanding-strorage-sizes-for-mysql-text-data-types/
	- https://stackoverflow.com/questions/25300821/difference-between-varchar-and-text-in-mysql
- Numeric:
	- https://www.w3resource.com/mysql/mysql-data-types.php#:~:text=MySQL%20supports%20all%20standard%20SQL,FIXED%20are%20synonyms%20for%20DECIMAL.
	- https://dev.mysql.com/doc/refman/8.0/en/numeric-type-syntax.html
- Datetime:
	- https://stackoverflow.com/questions/409286/should-i-use-the-datetime-or-timestamp-data-type-in-mysql
	- https://www.eversql.com/mysql-datetime-vs-timestamp-column-types-which-one-i-should-use/#:~:text=DATETIME%20%2D%20%E2%80%9CThe%20DATETIME%20type%20is,both%20date%20and%20time%20parts.&text=TIMESTAMP%20%2D%20%E2%80%9CThe%20TIMESTAMP%20data%20type,14%3A07'%20UTC.%E2%80%9D
	- https://stackoverflow.com/questions/39250006/filtering-table-in-mysql-with-difference-between-two-timestamp-columns

## Stored Procedures

- https://www.youtube.com/watch?v=LgSgEt1mSFk
- https://www.youtube.com/playlist?list=PLT9miexWCpPUoMztUQSvkPGR6SYSnqK4Z
- https://www.php.net/manual/en/pdo.prepared-statements.php

## Import and Export DB via Terminal

- Export all: `mysqldump -u root -p mydatabase > /home/myuser/database-dump.sql`
- Export data only: `mysqldump -u [user] -p[pass] --no-create-info mydb > mydb.sql`
- Export structure only: `mysqldump -u [user] -p[pass] --no -data mydb > mydb.sql`
- Import: `mysql -u [user] -p[pass] mydb < mydb.sql`

---
