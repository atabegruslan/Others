# Intro

https://mongodb.org/

## Setup via MSI
1. Install MongoDB, see https://docs.mongodb.com/guides/server/install/
2. You will see many commands available to you in `C:\Program Files\MongoDB\Server\4.2\bin\`. (Also be sure that that path is added to environment variables)
3. Create a folder where your DB will be at. Eg `C:/data/db` on Windows.
4. To start server, run from `C:/data/` `mongod --dbpath .`

## Setup via Zip

1. Setup

	![](/Illustrations/Storage/mongo/setup_from_zip_1.PNG)

2. Run MongoDB server as Windows service

	![e](/Illustrations/Storage/mongo/setup_from_zip_2.PNG)

3. Communication with Mongo server

	![](/Illustrations/Storage/mongo/setup_from_zip_3.PNG)

## Commands in the `bin` folder

| Command | Description |
|---|---|
| `mongod` | Server |
| `mongo` | Client (JS console) |
| `mongoimport` & `export` | Get data in and out from DB in JSON or CSV format |
| `mongodump` | Export BSON backup |
| `mongorestore` | Restore DB from BSON backup |
| `bsondump` | Convert BSON to JSON backup file |
| `mongostat` | Run passively with server, give status of current MongoDB instance |

## Misc
- Your program will be built in different programming languages. If you put Mongo code into these programs, then need respective drivers from http://mongodb.org/
- Mongo data types: https://www.tutorialspoint.com/mongodb/mongodb_datatype.htm
- BSON = Binary JSON. Eg: a document such as `{"hello":"world"}` will be stored as BSON like:
	```
	\x16\x00\x00\x00               // total document size
	\x02                           // 0x02 = type String
	hello\x00                      // field name
	\x06\x00\x00\x00world\x00      // field value (size of value, value, null terminator)
	\x00                           // 0x00 = type EOO ('end of object')
	```

# Tutorial

## Episode 1

![](/Illustrations/Storage/mongo/001.PNG)

| Command | Description |
|---|---|
| `show db` | Lists to you all the DBs |
| `use test` | There is already a `test` DB, so it'll go to the `test` DB |
| `use bookmarks` | There isnt a `bookmarks` DB, so it creates a new DB called `bookmarks` |
| `db` | Shows the current DB used |
| `db.links` | If there is no `links` table, a new `links` table gets created. If there is a `links` table, then it'll go to the `links` table |
| `db.links.count()` | Counts the number of rows in the `link`s table |

## Episode 2 - Insertion

![](/Illustrations/Storage/mongo/002.PNG)

## Episode 3 - Create JS Object

![](/Illustrations/Storage/mongo/003.PNG)

## Episode 4 - Review the created JS object and then save it to DB

![](/Illustrations/Storage/mongo/004.PNG)

`save` method can either become a `insert` or a `update` method. Mongo auto-detects whether that record is already in the DB. If it's already there, then Mongo auto converts the `save` method into an `update` method, and vice-versa for `insert`.

## Episode 5 - Review what we saved into the DB

![](/Illustrations/Storage/mongo/005.PNG)

- `forEach(printjson)` prints in a formatted way.
- `_id` is the auto-assigned unique id.

## Episode 6 - Unique ID

![](/Illustrations/Storage/mongo/006.PNG)

- It's a big random number, to ensure uniqueness across a network of machines.
- It's generated from: creation time, machine-id and process-id. The time created attribute can be regurgitated back to you from the unique id.

## Episode 7 - Assign your own IDs

![](/Illustrations/Storage/mongo/007.PNG)

## Episode 8 - Foreign keys

![](/Illustrations/Storage/mongo/008.PNG)

- Either normalize the DB OR use 'foreign keys'
- It's better to normalize it if there are a lot of update writes and vice-versa.

## Episode 9 - Bookmarks JS File

![](/Illustrations/Storage/mongo/009.PNG)

- `drop()` is for table deletion.

## Episode 10 - Insert the external file `bookmarks.js` into the BOOKMARKS table

![](/Illustrations/Storage/mongo/010.PNG)

## Episode 11 - Find in `users` table where `email` is johndoe blah

![](/Illustrations/Storage/mongo/011.PNG)

## Episode 12 - Search by array element in DB

![](/Illustrations/Storage/mongo/012.PNG)

## Episode 13 - Queries

![](/Illustrations/Storage/mongo/013.PNG)

- `find()` returns an cursor object. We can't further interact with cursor object.
- `findOne()` returns the document, which we can interact with.

## Episode 14 - Find all within that range, only show certain columns

![](/Illustrations/Storage/mongo/014.PNG)

- `$lt`
- `$lte`
- `$gt`
- `$gte`

## Episode 15 - Find all users whose name is either jane or john

![](/Illustrations/Storage/mongo/015.PNG)

- `in` operator defines a set
- `nin` operator means 'not in this set'

## Episode 16

![](/Illustrations/Storage/mongo/016.PNG)

- `...` means error
- `all` operator means: must satisfy everything in the defined set

## Episode 17

![](/Illustrations/Storage/mongo/017.PNG)

- `or`: must match one
- `nor`: must match none
- There is also the `and` operator

## Episode 18 - Search by null field

![](/Illustrations/Storage/mongo/018.PNG)

## Episode 19

![](/Illustrations/Storage/mongo/019.PNG)

- Find all whose fav value is divisible by 5
- Find all whose fav value is NOT divisible by 5

## Episode 20 - Element match operator

![](/Illustrations/Storage/mongo/020.PNG)

## Episode 21 - Where operator encloses JS within queries

![](/Illustrations/Storage/mongo/021.PNG)

## Episode 22 - Sort results

![](/Illustrations/Storage/mongo/022.PNG)

## Episode 23 - Find the `min`, `max`, top few and bottom few

![](/Illustrations/Storage/mongo/023.PNG)

- `min`, `max`: combo of limit n sort

## Episode 24 - Skip first 3, show 4-6

![](/Illustrations/Storage/mongo/024.PNG)

- Can be useful when implement paging

## Episode 25

![](/Illustrations/Storage/mongo/025.PNG)

- `update` actually is updates by replacement, all other record attributes will be lost
- `update` with that 3rd param = true: it will update or insert field depending on whether its there (?)

## Episode 26 - Query via JS object

![](/Illustrations/Storage/mongo/026.PNG)

- Increment
- Decrement

## Episode 27

Update one field only, not update by replecement, so other fields wont be lost

![](/Illustrations/Storage/mongo/027a.PNG)

- If field don't exist, then adds the field in.

![](/Illustrations/Storage/mongo/027b.PNG)

- `unset` = delete field
- `update` only updates the first matching record, so to solve this:
	- 3rd update parameter as false - update by mod not by repl
	- 4th update parameter as true - update multiple

## Episode 28

![](/Illustrations/Storage/mongo/028.PNG)

- Find & modify true: return updated record
- Find * modify false: return original record
- Only modify first-found

## Episode 29 - `push`

![](/Illustrations/Storage/mongo/029.PNG)

## Episode 30 - `pushAll` 

![](/Illustrations/Storage/mongo/030.PNG)

- If use `push()` in this case, then the array will be pushed into the existing array

## Episode 31 - `addToSet`

![](/Illustrations/Storage/mongo/031.PNG)

- Only add element into the tags array if that element isn't there

## Episode 32

![](/Illustrations/Storage/mongo/032.PNG)

- Add many items to array using `addToSet`

## Episode 33 - 36 - Pull and pull all to remove array items

![](/Illustrations/Storage/mongo/033.PNG)

![](/Illustrations/Storage/mongo/034.PNG)

![](/Illustrations/Storage/mongo/035.PNG)

![](/Illustrations/Storage/mongo/036.PNG)

## Episode 37 - Pop from array at front or back

![](/Illustrations/Storage/mongo/037.PNG)

## Episode 38

![](/Illustrations/Storage/mongo/038.PNG)

## Episode 39 - Remane 'random' to 'something_else'

![](/Illustrations/Storage/mongo/039.PNG)
