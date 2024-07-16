# Speed up MySQL

## Index 

Index All Columns Used in 'where', 'order by', and 'group by' Clauses

Index make selection faster but modifications/DML operations slower.

For selection: clustered index is the fastest, non clustered index can be even worse than no index.

Don't have unused indexes lying around.

## Optimize Like Statements With Union Clause

If the `OR`s in the `WHERE` clause are too much or too complicated, the optimizer could incorrectly choose a full table scan to retrieve a record.  
Use `UNION` instead. 

## Avoid Like Expressions With Leading Wildcards

Don't do `WHERE column LIKE  '%xxx'`. MySQL can't utilize indexes and will do full table scan instead.

## Don’t do negative searches

Instead of: `SELECT * FROM Customers WHERE RegionID <> 3` (which can't utilize indexes),

Use: `SELECT * FROM Customers WHERE RegionID < 3 UNION ALL SELECT * FROM Customers WHERE RegionID` (which can utilize indexes).

## Don't use function inside WHERE clause

If so, the SQL server will scan instead of seek table using indexes.

## Take Advantage of MySQL Full-Text Searches

If you have to use wildcards, utilize full text index instead.  
https://github.com/atabegruslan/Others/blob/master/Storage/db.md#full-text-vs-metadata-search

## IN vs UNION ALL 

(Sidenote: `UNION ALL` display duplicate values, `UNION` don't)

When filtering rows of data on multiple values in tables with skewed distributions and non-covering indexes, writing your logic into multiple statements joined with UNION ALLs can sometimes generate more efficient execution plans than just using IN or ORs.

## DISTINCT with few unique values

Using the DISTINCT operator is not always the fastest way to return the unique values in a dataset. 

Using recursive CTEs to return distinct values on large datasets with relatively few unique values: https://sqlperformance.com/2014/10/t-sql-queries/performance-tuning-whole-plan

What are Common Table Expressions: https://www.sqlservertutorial.net/sql-server-basics/sql-server-cte/

## Optimize Your Database Schema

- Normalize
	- 1NF: Cell should contain only single value. So no eg arrays.
	- 2NF: If a table have composite key, then every non-candidate attribute must depend on the entire composite key. Accomplished by seperating the attribute that depends on only a part of the composite key into another table.
	- 3NF: In a table, can't have Col2 -> Col1 -> PK. Accomplished by seperating that transitive dependency into another table.
	- 3.5NF: In a table, there can't be any other dependencies, except the dependencies that stems from the super key.
	- 4NF: In a table with >2 columns, there can't be multi-valued dependency. Eg, if person1 likes to eat apples and bananas, and likes to play soccer and basketball, then 2 unique rows containing the same info can arise (person1 - apples - soccer & person1 - bananas - soccer), which is not allowed.
	- 5NF: If a table is broken down. It must be the same upon recombining. If not so, then don't break the table apart.
	- (Ref: https://www.youtube.com/playlist?list=PLLGlmW7jT-nTr1ory9o2MgsOmmx2w8FB3 )
- Don't use datatypes that is bigger than needed. Eg, for yes/no flags, use tinyint, don't use int.
	- Texts: 
		- https://chartio.com/resources/tutorials/understanding-strorage-sizes-for-mysql-text-data-types/
		- https://stackoverflow.com/questions/25300821/difference-between-varchar-and-text-in-mysql
	- Numeric:
		- https://www.w3resource.com/mysql/mysql-data-types.php
		- https://dev.mysql.com/doc/refman/8.0/en/numeric-type-syntax.html
		- https://github.com/atabegruslan/Others/blob/master/Illustrations/Storage/sql_float_types.PNG
	- Datetime:
		- https://stackoverflow.com/questions/409286/should-i-use-the-datetime-or-timestamp-data-type-in-mysql
		- https://www.eversql.com/mysql-datetime-vs-timestamp-column-types-which-one-i-should-use
		- https://stackoverflow.com/questions/39250006/filtering-table-in-mysql-with-difference-between-two-timestamp-columns
	- (Ref: https://www.youtube.com/playlist?list=PL_c9BZzLwBRKn20DFbNeLAAbw4ZMTlZPH)
- Avoid null values
- Don't have too many columns in a table
- Minimize `JOIN`s, especially nested/compound joins. 
	- Sometimes, SELECT clause subqueries can also replace JOINs
	- When have nested/compound joins, force the order of joins, instead of query-optimizer's order
		Force table join order with blocking operators: https://sqlbits.com/Sessions/Event14/Query_Tuning_Mastery_Clash_of_the_Row_Goals

## Avoid Use of Non-correlated Scalar Sub Query

Non-correlated vs correlated subqueries:  
Non-correlated means subquery is independent of parent query. Correlated means subquery depends on input from parent query.  
https://www.vertica.com/docs/9.2.x/HTML/Content/Authoring/AnalyzingData/Queries/Subqueries/NoncorrelatedAndCorrelatedSubqueries.htm

Scalar subqueries:  
A subquery that selects only one column or expression and returns one row.  
https://docs.actian.com/ingres/11.0/index.html#page/SQLRef/Scalar_Subqueries.htm

If subquery in independent of parent query, then write it as an independent query. It's less complicated for the optimizer.

## Derived tables instead of correlated subqueries

What are derived tables: https://www.mysqltutorial.org/mysql-derived-table/

Derived table queries often produces better performance due to their set-based nature.

## GROUP BY instead of Window functions

What are window function: https://www.sqltutorial.org/sql-window-functions/

Sometimes window functions rely a little too much on tempdb and blocking operators to accomplish what you ask of them. While using them is always my first choice because of their simple syntax, if they perform poorly you can usually rewrite them as an old-fashioned GROUP BY to achieve better performance.

## MySQL Query Caching

Cache: https://www.digitalocean.com/community/tutorials/how-to-optimize-mysql-with-query-cache-on-ubuntu-18-04

Cache refreshing: 

1. On write. Update cache upon updating original data.
2. Application polls original data to update cache.
3. Original DB pushes/notifies cache upon change.

- https://github.com/atabegruslan/Others/tree/master/Illustrations/Storage/cache_refreshing_techniques.pdf
- https://medium.datadriveninvestor.com/cache-refreshing-techniques-446403de1ba2

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

## Be selective for what columns and rows you retrieve

Regarding columns: Don't use `SELECT *`, just select what you need.

## Don’t double-dip

Query large tables only once whenever possible.

## Do pre-stage data

This is one of my favorite topics because it’s an old technique that’s often overlooked. If you have a report or a procedure (or better yet, a set of them) that will do similar joins to large tables, it can be a benefit for you to pre-stage the data by joining the tables ahead of time and persisting them into a table. Now the reports can run against that pre-staged table and avoid the large join.

You’re not always able to use this technique, but when you can, you’ll find it is an excellent way to save server resources.

Note that many developers get around this join problem by concentrating on the query itself and creating a view-only around the join so that they don’t have to type the join conditions again and again. But the problem with this approach is that the query still runs for every report that needs it. By pre-staging the data, you run the join just once (say, 10 minutes before the reports) and everyone else avoids the big join. I can’t tell you how much I love this technique; in most environments, there are popular tables that get joined all the time, so there’s no reason why they can’t be pre-staged.

## Temporary Staging Tables

Sometimes the query optimizer struggles to generate an efficient execution plan for complex queries. Breaking a complex query into multiple steps that utilize temporary staging tables can provide SQL Server with more information about your data. They also cause you to write simpler queries which can cause the optimizer to generate more efficient execution plans as well as allow it to reuse result sets more easily.

## Do delete and update in batches

Don't delete/update too many entries in one go. ("in one go" here means: as 1 transaction). It can cause blockages.

## Don't do large ops on many tables in the same batch

Don't operate on too many tables on 1 transaction. Remember that each table will be locked. It can cause blockages.

## Avoid cursors

What are cursors: https://www.mysqltutorial.org/mysql-cursor/

Cursors can cause your operation to block other operations for a lot longer than is necessary. This greatly decreases concurrency in your system.

- Solutions/Mitigations:
	- **Use set-based queries**: Set-based queries is more efficient than cursor-based queries.
	- If you really need to use cursors:
		- **Avoid dynamic cursors**: dynamic cursor limits the optimizer to using nested loop joins.
		- Do the cursor operations against a **temp table**:

Eg, a cursor that goes through a table and updates a couple of columns based on some comparison results. Instead of doing the comparison against the live table, you may be able to put that data into a temp table and do the comparison against that instead. Then you have a single `UPDATE` statement against the live table that’s much smaller and holds locks only for a short time.

## Don't nest views

What are views: https://www.mysqltutorial.org/mysql-views-tutorial.aspx  
Nested view aren't a 'cache'. It's a 'remembered query'.

![](/Illustrations/Storage/view_cants.PNG)

Avoid nested views:
1. you will probably have much more data coming back than you need.
2. the query optimizer will give up and return a bad query plan.

- https://bornsql.ca/blog/nested-views-bad/

## Indexed Views

When you can't add new indexes to existing tables, you might be able to get away with creating a view on those tables and indexing the view instead . This works great for vendor databases where you can't touch any of the existing objects.

## Do use partitioning to avoid large data moves

What is table partitioning: https://www.sqlshack.com/database-table-partitioning-sql-server/

Not everyone will be able to take advantage of this tip, which relies on partitioning in SQL Server Enterprise, but for those of you who can, it’s a great trick. Most people don’t realize that all tables in SQL Server are partitioned. You can separate a table into multiple partitions if you like, but even simple tables are partitioned from the time they’re created; however, they’re created as single partitions. If you’re running SQL Server Enterprise, you already have the advantages of partitioned tables at your disposal.

This means you can use partitioning features like `SWITCH` to archive large amounts of data from a warehousing load. Let’s look at a real example from a client I had last year. The client had the requirement to copy the data from the current day’s table into an archive table; in case the load failed, the company could quickly recover with the current day’s table. For various reasons, it couldn’t rename the tables back and forth every time, so the company inserted the data into an archive table every day before the load, then deleted the current day’s data from the live table.

This process worked fine in the beginning, but a year later, it was taking 1.5 hours to copy each table -- and several tables had to be copied every day. The problem was only going to get worse. The solution was to scrap the `INSERT` and `DELETE` process and use the `SWITCH` command. The `SWITCH` command allowed the company to avoid all of the writes because it assigned the pages to the archive table. It’s only a metadata change. The `SWITCH` took on average between two and three seconds to run. If the current load ever fails, you `SWITCH` the data back into the original table.

This is a case where understanding that all tables are partitions slashed hours from a data load.

## If you must use ORMs, use stored procedures

ORM machine-generates queries, which is never as good as a programmer who knows what he's doing.

- https://laravel.io/forum/04-23-2014-eloquent-vs-raw-sql-which-is-really-better
- https://stackoverflow.com/questions/38391710/laravel-eloquent-vs-query-builder-why-use-eloquent-to-decrease-performance

## Stored procedures and User defined functions

What they are: https://github.com/atabegruslan/Others/blob/master/Storage/db.md#stored-procedures--udfs

UDFs are further seperated into scalar UDFs and **Table-Valued functions**.

UDFs can cause query plans to serialize, which can obviously slow things down (but not always).  
But sometimes on the contrary, a poorly configured server will parallelize queries too frequently and cause poorer performance than their serially equivalent plan. 

## Do use table-valued functions

This is one of my favorite tricks of all time because it is truly one of those hidden secrets that only the experts know. When you use a scalar function in the `SELECT` list of a query, the function gets called for every single row in the result set. This can reduce the performance of large queries by a significant amount. However, you can greatly improve the performance by converting the scalar function to a table-valued function and using a `CROSS APPLY` in the query. This is a wonderful trick that can yield great improvements.

What is `CROSS APPLY`: https://www.youtube.com/watch?v=kVogo0AbatM

- https://stackoverflow.com/questions/34754663/difference-between-scalar-table-valued-and-aggregate-functions-in-sql-server
- https://www.sqlservertutorial.net/sql-server-user-defined-functions/sql-server-scalar-functions/
- https://www.sqlservertutorial.net/sql-server-user-defined-functions/sql-server-table-valued-functions/
- https://www.mssqltips.com/sqlservertip/1958/sql-server-cross-apply-and-outer-apply/

### But avoid Multi-statement Table Valued Functions (TVFs)

Multi-statement TVFs are more costly than inline TFVs. SQL Server expands inline TFVs into the main query like it expands views but evaluates multi-statement TVFs in a separate context from the main query and materializes the results of multi-statement into temporary work tables. The separate context and work table make multi-statement TVFs costly.

## Don't use triggers

What are triggers: https://github.com/atabegruslan/Others/blob/master/Storage/db.md#triggers 

Avoid triggers!

Reason: If you update table, and the trigger updates another table.  
Then locks are put onto 2 tables.  
The original update and the triggered update counts as 1 transaction and locks won't be lifted until transaction is done.  
Can cause blockage and slow-downs.

Instead: Make the original and triggered updates as 2 stored procedures, and as **seperate transactions**. 

## Don’t cluster on GUID

What is GUID/UUID: https://www.mysqltutorial.org/mysql-uuid/ , https://www.sqlservertutorial.net/sql-server-basics/sql-server-guid/  
A GUID (globally unique identifier) is a 16-byte randomly generated number. 

Ordering your table's data on this clustered GUID will cause your table to fragment much faster than using a steadily increasing value like `DATE` or `IDENTITY`. 

This applies to more than GUIDs -- it goes toward any volatile column.

### About UUID

- https://www.youtube.com/watch?v=OAOQ7U0XAi0
- https://www.youtube.com/watch?v=2MbFDR7qt5U

![](/Illustrations/Storage/uuid_ulid.PNG)

## Position a Column in an Index

Order or position of a column in an index also plays a vital role to improve SQL query performance. An index can help to improve the SQL query performance if the criteria of the query matches the columns that are left most in the index key. 

As a best practice, most selective columns should be placed leftmost in the key of a non-clustered index.

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

## Default filegroup settings

Filegroups are "directories" where DB store their files.

Advantage of more filegroups: more parallelization.

Specify these 2 to make insert faster:

![](/Illustrations/Storage/improve_SQL_Server_performance_3.PNG)

- What are filegroups: https://blogs.lessthandot.com/index.php/DataMgmt/DBAdmin/sql-server-filegroups-the-what
- https://sqlstudies.com/2018/02/19/the-default-filegroup-and-why-you-should-care/
- https://www.sqlshack.com/how-to-work-with-filegroups-in-sql-server-and-migrate-data-between-them/

## Statistic 

Turn on statistics as they helps the query optimizer.

![](/Illustrations/Storage/improve_SQL_Server_performance_4.PNG)

## Data Compression

Not only does data compression save space , but on certain workloads it can actually improve performance. Since compressed data can be stored in fewer pages, read disk speeds are improved, but maybe more importantly the compressed data allows more to be stored in SQL Server's buffer pool, increasing the potential for SQL Server to reuse data already in memory.

## Switch cardinality estimators

The newer cardinality estimator introduced in SQL Server 2014 improves the performance of many queries. However, in some specific cases it can make queries perform more slowly. 

In those cases, a simple query hint is all you need to force SQL Server to change back to the legacy cardinality estimator: https://blog.sqlauthority.com/2019/02/09/sql-server-enabling-older-legacy-cardinality-estimation/

## Copy the data

If you can't get better performance by rewriting a query, you can always copy the data you need to a new table in a location where you CAN create indexes and do whatever other helpful transformations you need to do ahead of time.

**Ref:** 
- https://dzone.com/articles/how-to-optimize-mysql-queries-for-speed-and-perfor
- https://dev.mysql.com/doc/refman/8.0/en/explain.html
- https://www.infoworld.com/article/3209665/sql-unleashed-17-ways-to-speed-your-sql-queries.html
- https://bertwagner.com/posts/12-ways-to-rewrite-sql-queries-for-better-performance/

---

## Eager vs Lazy load

- The (n + 1) problem: https://stackoverflow.com/questions/97197/what-is-the-n1-selects-problem-in-orm-object-relational-mapping
- In Laravel: https://github.com/atabegruslan/Others/blob/master/Storage/laravel_db.md#n1-problem
- In .NET: https://www.youtube.com/watch?v=j4w-KFoZTtI
- https://stackoverflow.com/questions/31366236/lazy-loading-vs-eager-loading
- https://www.imperva.com/learn/performance/lazy-loading/#:~:text=Lazy%20Loading%20vs.,entities%20referenced%20by%20a%20resource.

![](/Illustrations/Storage/dotnet_eager_lazy.PNG)

---

# Security

- https://www.infoworld.com/article/2953834/7-essential-sql-server-security-tips.html

---

# General Basics

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

![](/Illustrations/Storage/storage_engine_indexes.PNG)

![](/Illustrations/Storage/clustered_unclustered_indexes_1.PNG)

![](/Illustrations/Storage/clustered_unclustered_indexes_2.PNG)

![](/Illustrations/Storage/unique_and_primary_keys.PNG)

### Auto Increment

https://trebleclick.blogspot.com/2009/01/mysql-set-auto-increment-in-phpmyadmin.html

## Full-text vs metadata search

Full-text search is distinguished from searches based on metadata or on parts of the original texts.

In a full-text search, a search engine examines all of the words in every stored document as it tries to match search criteria.

- https://mariadb.com/kb/en/full-text-index-overview
- https://en.wikipedia.org/wiki/Full-text_search
- https://www.youtube.com/watch?v=Q8Kg67XgPzc

### In CJK languages

- https://mariadb.com/kb/en/about-mroonga
- https://levelup.gitconnected.com/how-to-make-chinese-full-text-search-dd8b6df801fb?gi=20ec5f770d70
- https://dev.mysql.com/doc/refman/8.4/en/fulltext-search.html
- https://forums.percona.com/t/how-fulltext-support-chinese-search/2059
- https://dev.mysql.com/worklog/task/?id=6607
- https://stackoverflow.com/questions/27940695/how-to-perform-mysql-fulltext-search-with-chinese-characters

## Execution order

https://dba.stackexchange.com/a/162756

## Data Types

https://www.mysqltutorial.org/mysql-data-types.aspx

### Spatial

- https://www.w3resource.com/mysql/mysql-spatial-data-types.php

### Binary

- https://en.wikipedia.org/wiki/Binary_large_object
- https://medium.com/nerd-for-tech/store-files-binary-in-mysql-database-and-view-using-vanilla-js-and-node-js-95a227002b85
- https://stackoverflow.com/questions/33586210/how-to-read-the-value-in-a-binary-column-in-mysql

## Prepared Statements

https://www.w3schools.com/php/php_mysql_prepared_statements.asp

## Atomicity

Basic transaction and rollback: 

```php
try 
{
	$dsn = DB_DRIVER.":host=".DB_SERVER.";dbname=".DB_DATABASE.";charset=UTF8";
	$dbh = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
} 
catch (PDOException $e) 
{
	die($e->getMessage());		
}	

try 
{
    $dbh->beginTransaction();

	$sql = 'SELECT col1,col2 FROM table WHERE id=:key';
	$sth = $dbh->prepare($sql);
	$sth->execute(array(":key" => 1));

    $dbh->commit();
} 
catch (PDOException $e) 
{
    $dbh->rollBack();
    die($e->getMessage());
}
```

- Rollbacks:
	- https://github.com/atabegruslan/Others/blob/master/Illustrations/Storage/rollback_1.pdf
	- https://github.com/atabegruslan/Others/blob/master/Illustrations/Storage/rollback_1a_transaction_log.pdf
	- https://github.com/atabegruslan/Others/blob/master/Illustrations/Storage/rollback_1ai_rollback_segment.pdf
	- https://github.com/atabegruslan/Others/blob/master/Illustrations/Storage/rollback_1b_multiversion_concurrency_control.pdf

## Concurrency

Table lock: https://www.mysqltutorial.org/mysql-table-locking/

https://github.com/atabegruslan/Others/blob/master/Illustrations/Storage/db_concurrency_2pl_or_timestamp.pdf

### Locking

- https://viblo.asia/p/database-locking-naQZRDGd5vx
- https://www.tutorialspoint.com/mysql/mysql_lock_tables.htm

## Triggers

- Good intro: https://www.youtube.com/watch?v=rIi1dvPdTHE
- Another good intro: https://dev.mysql.com/doc/refman/8.4/en/trigger-syntax.html
- https://stackoverflow.com/questions/19152974/fire-a-trigger-after-the-update-of-specific-columns-in-mysql/19153222#19153222

### Examples

| MySQL | PGSQL |
| ------ | ------ |
| ![](/Illustrations/Storage/trigger_mysql_1.png) | ![](/Illustrations/Storage/trigger_pgsql_1.png) |
| https://www.mysqltutorial.org/mysql-triggers.aspx | https://www.postgresqltutorial.com/postgresql-triggers/creating-first-trigger-postgresql , https://www.postgresql.org/docs/current/plpgsql-errors-and-messages.html , https://www.cybertec-postgresql.com/en/postgresql-how-to-write-a-trigger |

Calling API from Trigger
- https://medium.com/@elvis.gosselin/calling-rest-apis-from-mysql-dd9f15b74d92
- https://www.mooreds.com/wordpress/archives/1497
- https://open-bi.blogspot.com/2012/11/call-restful-web-services-from-mysql.html
- https://stackoverflow.com/questions/37215104/calling-an-url-from-a-trigger-in-mysql
- https://stackoverflow.com/questions/21746553/how-to-install-mysql-udf-in-windows-wamp
	- https://github.com/mysqludf/lib_mysqludf_str/blob/master/README.win_x64.txt

## Stored procedures & UDFs

| Stored Function (UDF) | Stored Procedure |
|---|---|
| Must return a value | Can return nothing |
| Can only have input parameters | Can have both input and output parameters |
| Functions can be called from Procedure | Procedures cannot be called from a Function |
| Can't edit, just read (ie: returns) the data | Can edit data, and should be used for editing data and making transactions |

Full list of differences:
- https://www.sqlshack.com/functions-vs-stored-procedures-sql-server/
- https://www.c-sharpcorner.com/article/stored-procedures-vs-user-defined-functions-and-choosing-which-one-to-use/
- https://stackoverflow.com/questions/2039936/difference-between-stored-procedures-and-user-defined-functions/15413792
- https://bestinterviewquestion.medium.com/difference-between-stored-procedure-and-function-in-mysql-52f845d70b05

### UDF Examples

| MySQL | PGSQL |
| ------ | ------ |
| ![](/Illustrations/Storage/udf_mysql_1a.png) | ![](/Illustrations/Storage/udf_pgsql_1a.png) |
| ![](/Illustrations/Storage/udf_mysql_1b.png) | https://www.postgresqltutorial.com/postgresql-plpgsql/postgresql-create-function |
| ![](/Illustrations/Storage/udf_mysql_1c.png) |  |
| https://www.mysqltutorial.org/mysql-stored-function , https://www.sqlservertutorial.net/sql-server-user-defined-functions |  |

Other points of interest from above example:
- PGSQL's closest equivalent to `DETERMINISTIC`:
	- https://dba.stackexchange.com/questions/185044/postgresql-immutable-volatile-stable
	- https://www.postgresql.org/message-id/2131668.1686840541%40sss.pgh.pa.us
- PLPGSQL have full functionalities but hurts performance. 'sql' is the simpler alt: https://en.wikipedia.org/wiki/PL/pgSQL
- User defined variables in MySQL: https://www.mysqltutorial.org/mysql-basics/mysql-variables
- Better to use Text instead of Varchar in PGSQL: https://wiki.postgresql.org/wiki/Don't_Do_This#Don.27t_use_varchar.28n.29_by_default
- These are both valid syntaxes for PGSQL stored functions
	- `CREATE OR REPLACE FUNCTION get_user_level( IN user_id INTEGER ) RETURNS TEXT`
	- `CREATE OR REPLACE FUNCTION get_user_level( IN user_id INTEGER, OUT something TEXT )`
	- But still, functions are better than procedures for routines with returns.
- PGSQL often have "case folding", so better to use snake_case and avoid camelCase

### Stored Procedures Examples

| MySQL | PGSQL |
| ------ | ------ |
| ![](/Illustrations/Storage/stored_procedures_mysql_1a.png) | ![](/Illustrations/Storage/stored_procedures_pgsql_1a.png) |
| ![](/Illustrations/Storage/stored_procedures_mysql_1b.png) | ![](/Illustrations/Storage/stored_procedures_pgsql_1b.png) |
| https://www.mysqltutorial.org/mysql-stored-procedure , https://www.mysqltutorial.org/getting-started-with-mysql-stored-procedures.aspx , https://www.youtube.com/watch?v=LgSgEt1mSFk | https://www.postgresqltutorial.com/postgresql-plpgsql/postgresql-create-procedure |

## Partitioning and Sharding

| MySQL | PGSQL |
| ------ | ------ |
| ![](/Illustrations/Storage/partition_mysql.png) | ![](/Illustrations/Storage/partition_pgsql.png) |
| https://www.percona.com/blog/what-is-mysql-partitioning , https://viblo.asia/p/gioi-thieu-ve-partitioning-trong-mysql-jvEla6kz5kw , https://www.devart.com/dbforge/mysql/studio/partition-mysql.html , https://planetscale.com/blog/what-is-mysql-partitioning | https://www.enterprisedb.com/postgres-tutorials/how-use-table-partitioning-scale-postgresql , https://www.postgresql.org/docs/current/ddl-partitioning.html |

- https://www.sqltutorial.org/sql-window-functions/sql-partition-by
- https://www.sqlshack.com/database-table-partitioning-sql-server
- https://www.mongodb.com/docs/manual/core/sharding-data-partitioning
- https://uptrace.medium.com/postgresql-table-partitioning-589d7092a505
- https://www.youtube.com/watch?v=JDLgw8Po9QY
- https://www.youtube.com/watch?v=hdxdhCpgYo8
- https://www.youtube.com/watch?v=wXvljefXyEo
- https://www.youtube.com/watch?v=QA25cMWp9Tk

![](/Illustrations/Storage/partitioning.PNG)

![](/Illustrations/Storage/sharding_algorithms.PNG)

## Character Sets and Collations

A character set is a set of symbols and encodings. A collation is a set of rules for comparing characters in a character set.

- https://dev.mysql.com/doc/refman/8.0/en/charset-general.html
- https://stackoverflow.com/questions/4538732/what-does-collation-mean
- https://mysqlserverteam.com/mysql-8-0-1-accent-and-case-sensitive-collations-for-utf8mb4/
- https://stackoverflow.com/questions/48588705/how-to-remove-diacritics-from-utf8-characters-in-php

- https://www.w3schools.com/sql/func_mysql_binary.asp
- https://mariadb.com/kb/en/about-mroonga/
- https://mroonga.org/docs

## Encoding

https://github.com/atabegruslan/Others/blob/master/Security/encode.md#encodings-commonly-used-in-web-development-db

## Import and Export DB via Terminal

- Export all: `mysqldump -u root -p mydatabase > /home/myuser/database-dump.sql`
- Export data only: `mysqldump -u [user] -p[pass] --no-create-info mydb > mydb.sql`
- Export structure only: `mysqldump -u [user] -p[pass] --no-data mydb > mydb.sql`
- Import: `mysql -u [user] -p[pass] mydb < mydb.sql`

## Good to know techniques

- https://github.com/atabegruslan/Others/tree/master/Illustrations/Storage/techniques
- Find out what happens under the hood: https://dev.mysql.com/blog-archive/mysql-explain-analyze/

Temporarily disable foreign constraints

MySQL

```
SET FOREIGN_KEY_CHECKS = 0;
...
SET FOREIGN_KEY_CHECKS = 1;
```

PGSQL
```
BEGIN;
ALTER TABLE b DISABLE TRIGGER ALL;
...
ALTER TABLE b ENABLE TRIGGER ALL;
COMMIT;
```

https://stackoverflow.com/questions/38112379/disable-postgresql-foreign-key-checks-for-migrations

## DB Platforms

- https://www.quora.com/What-are-the-different-database-servers
- https://www.guru99.com/mariadb-vs-mysql.html
- https://softwareengineering.stackexchange.com/questions/120178/whats-the-difference-between-mariadb-and-mysql

## DB Types

- https://www.youtube.com/watch?v=W2Z7fbCLSTw

![](/Illustrations/Storage/db_types.PNG)

- https://www.youtube.com/watch?v=kkeFE6iRfMM

![](/Illustrations/Storage/db_choices.PNG)

- https://www.youtube.com/watch?v=jb2AvF8XzII

![](/Illustrations/Storage/db_future_types.PNG)

### Relational

- https://en.wikipedia.org/wiki/Comparison_of_relational_database_management_systems

### NoSQL

- https://www.youtube.com/watch?v=0buKQHokLK8

### BigData

#### Hadoop

- Good Intro: https://www.youtube.com/watch?v=MfF750YVDxM
- Good Lecture: https://www.youtube.com/playlist?list=PLlgLmuG_KgbasW0lpInSAIxYd2vqAEPit
- Good Tutorial: https://www.youtube.com/playlist?list=PLkz1SCf5iB4dw3jbRo0SYCk2urRESUA3v
- Key slides: https://github.com/atabegruslan/Others/blob/master/Illustrations/Storage/hadoop/
- https://www.tutorialspoint.com/apache_solr/apache_solr_on_hadoop.htm
- https://www.tutorialspoint.com/hadoop/hadoop_big_data_solutions.htm

### Multi Dimensional

- OLTP (Online Transaction Processing): Inserts, Updates, Deletes.
- OLAP (Online Analytic Processing): Answer MultiDimensional queries, i.e.: Selects.
- Example of a MultiDimensional DBMS: https://en.wikipedia.org/wiki/Essbase

### Cloud

- https://www.clever-cloud.com/doc/deploy/addon/fs-bucket/
- https://www.clever-cloud.com/doc/develop/best-practices/cloud-storage/
- https://stackshare.io/stackups/amazon-ec2-vs-clever-cloud
- https://www.missioncloud.com/blog/resource-amazon-ebs-vs-efs-vs-s3-picking-the-best-aws-storage-option-for-your-business
- https://stackshare.io/stackups/aws-elastic-beanstalk-vs-clever-cloud-vs-heroku
