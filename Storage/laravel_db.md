# Relationships

- https://laravel.com/docs/8.x/database-testing#has-many-relationships (`->has()` and `->for()`)
- https://joelclermont.com/post/laravel-8-factory-relationships/ (Factory in factory)
- https://www.codegrepper.com/code-examples/whatever/laravel+factory+relationship (via callbacks)
- https://github.com/atabegruslan/Laravel_CRUD_API?tab=readme-ov-file#theory-of-many-to-many-relationships-in-laravel
- https://www.youtube.com/watch?v=lAiOevxK7e8
- https://www.youtube.com/watch?v=uylJ3k_m_zg
- https://stackoverflow.com/questions/29751859/laravel-5-hasmany-relationship-on-two-columns
- https://laraveldaily.com/post/laravel-relation-attempt-to-read-property-on-null-error
- https://laraveldaily.com/post/eloquent-count-models-by-relations-performance-optimizations
- https://laravel.com/docs/10.x/eloquent-relationships#aggregating-related-models
- https://laravel.com/docs/11.x/migrations#foreign-key-constraints
- https://www.youtube.com/watch?v=ijt10uTM8LY
- https://www.youtube.com/watch?v=6jnUK-HPtbk

# Migration scripts

- Migration is for database structure.
- To run a DB migration script again:
    - `php artisan migrate:rollback` (which deletes the most recent batch out of the `migrations` table)
    - Or go into the DB, manually delete the entry out of the `migrations` table.
- Seeding is for database data.
    - Make seed: `php artisan make:seeder WhateverTableSeeder`
    - Run seed: `php artisan db:seed --class=WhateverTableSeeder`

# Timestamps and Soft Deletes

If you weren't using these before and decide to start using them

1. Adust the database
    - For timestamps: add `created_at` & `updated_at` nullable columns of timestamp type, default now.
    - For soft delete: add `deleted_at` nullable column of timestamp type, default null.
2. Make the migration script consistent by adding 
```php
Schema::create('whatevers', function (Blueprint $table) {
    ...
    $table->softDeletes();
    $table->timestamps();
});
```
3. In model, add:
```php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Whatever extends Model
{
    use SoftDeletes;

    public $timestamps = true;
```

You can see that `Illuminate\Database\Eloquent\Model.php::performDeleteOnModel()` is overridden by `Illuminate\Database\Eloquent\SoftDeletes.php::performDeleteOnModel()`

https://www.itsolutionstuff.com/post/how-to-use-soft-delete-in-laravel-5example.html

# PgSql

Have these in `.env`
```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
POSTGRESQL_ADDON_DB=xxx
POSTGRESQL_ADDON_USER=postgres
POSTGRESQL_ADDON_PASSWORD=
```

Enable `extension=pdo_pgsql` in `php.ini`

# Eloquent ORM or Query Builder (`\DB`)

Eloquent: https://hub.packtpub.com/eloquent-without-laravel

https://laravel-news.com/query-expressions-for-laravel

Sushi: array driver for Eloquent: https://laravel-news.com/laravel-sushi

- https://www.freecodecamp.org/news/moving-away-from-magic-or-why-i-dont-want-to-use-laravel-anymore-2ce098c979bd

## Speed vs Changing DB

Eloquent is slower. But easier when changing DB, eg from MySQL to PostgreSQL

https://stackoverflow.com/questions/38391710/laravel-eloquent-vs-query-builder-why-use-eloquent-to-decrease-performance

![](/Illustrations/Storage/laravel_eloquent_speed.png)

![](/Illustrations/Storage/laravel_eloquent_vs_query_builder.png)

## Functionalities

Eloquent have more functionalities. (You can code for them in the model file)

## Considerations for N+1 problem

With Query Builder, you can explicitly write queries with considerations for N+1 problem.  
With Eloquent, you have to use things like `with` to enable considerations for N+1 problem. Eloquent won't do it by itself.  

![](/Illustrations/Storage/laravel_n_plus_1.png)

https://www.youtube.com/watch?v=uVsY_OXRq5o

### N+1 problem 

By default: lazy load.  
But lazy load have N + 1 problem.  
EG: Picture have Metadata. So if you want to retrieve N Pictures and their width: `$picture->metadata->width`, then for each picture another query will be run for metadata. Hence, you'll end up with N + 1 queries (N for Metadata and 1 for Picture).  
Eager loading reduces this from N+1 to 2:  
```
select * from pictures
select * from metadatas where id in (1, 2, 3, 4, 5, ...)
```
Eager loading have 2 functions that we can utilize: `Picture::with('metadata')->get();` or `Picture::all()->load('metadata');`.  

- https://viblo.asia/p/eager-loading-trong-laravel-su-dung-with-hay-load-RnB5p0bG5PG
- https://laravel.com/docs/5.2/eloquent-relationships#eager-loading
- https://www.youtube.com/watch?v=bZlvzvGpCEE
- https://www.youtube.com/watch?v=N0phQbyzF0I
- https://www.youtube.com/watch?v=OJJU3AGlsEI

# Better code for DB optimization

1. Add indexes and FKs
2. Use `->get()` last. So group and order, then take the first n entries, and finally use `->get()`.
3. Refer to relationship instead of fetching all related entries. So use `$model->relation()` instead of `$model->relation`. Use things like `->count()` after that.

Also:
- Use magic methods eg `withCount`.
- Use `with` to avoid N+1 problem.

https://www.youtube.com/watch?v=yAAqAxiaEmg

---

Performance:
- https://kinsta.com/blog/laravel-performance
- https://www.youtube.com/watch?v=FhlVOIfjxbA
- https://www.youtube.com/watch?v=LuxFql2CDyg
- https://www.youtube.com/watch?v=lRi1-RYnQ7A
- https://www.youtube.com/watch?v=12KCl82L48Y
- https://www.youtube.com/watch?v=2QhPLcYLay8
- https://www.youtube.com/watch?v=IE557e1Fy84
- https://www.youtube.com/watch?v=PYAuAStv6cw
- https://www.youtube.com/watch?v=csWx7RcNh5U
- https://www.youtube.com/watch?v=HadES55O4Wk
- https://www.youtube.com/watch?v=yAAqAxiaEmg
- https://www.youtube.com/watch?v=JOnXX-N96NE
- https://www.youtube.com/watch?v=S-d4xrJA_Zs
- when: https://www.youtube.com/watch?v=YKkXfyzFCGE
- whenLoaded: https://www.youtube.com/watch?v=Ls7m14eCaSU

![](/Illustrations/Storage/laravel_whenLoaded.png)

- Collections: https://www.youtube.com/watch?v=isAz2GduuA0
- Collections methods: https://www.youtube.com/watch?v=isAz2GduuA0
- Collection vs array performance: https://www.youtube.com/watch?v=RGALgqsXiqU

Correct syntax for Cache & Pagination:
![](/Illustrations/Storage/laravel_paginate_cache.png)

Useful knowhow:
- https://www.youtube.com/watch?v=IwPpOFFfCTc
- https://www.youtube.com/watch?v=1a1ySsWxxH8
- https://www.youtube.com/watch?v=QUkW6Y1woN0
- https://www.youtube.com/watch?v=aqccE0lSOjs
- https://github.com/atabegruslan/Others/blob/master/Development/laravel.md#nested-models
- https://www.youtube.com/watch?v=jwgvic7hmx0
- https://www.youtube.com/watch?v=O1TIsQO0mwM
- https://www.youtube.com/watch?v=bSQcmcu6yHc
- https://www.youtube.com/watch?v=QqsDk5RA9jU
- https://www.youtube.com/watch?v=243NrYTRYvo
- https://www.youtube.com/watch?v=f-eAI1fdOOY
- https://www.youtube.com/watch?v=6J8vb5_WRBw
- https://www.youtube.com/watch?v=rgOlkcTncv8
- https://www.youtube.com/watch?v=G4AwoAiti14
- https://stackoverflow.com/questions/37953783/laravel-5-dynamically-run-migrations
- https://stackoverflow.com/questions/15622710/how-to-set-every-row-to-the-same-value-with-laravels-eloquent-fluent
- https://stackoverflow.com/questions/32819364/laravel-migration-create-a-new-column-filled-from-existing-column
- https://stackoverflow.com/questions/56306043/laravel-move-data-from-one-table-to-another-and-drop-the-column-that-the-data-ca
- https://www.youtube.com/watch?v=6jnUK-HPtbk
- Store session to DB: https://www.youtube.com/watch?v=EO-kp3nl3cg
- https://stackoverflow.com/questions/28018466/laravel-proper-way-to-get-eloquent-to-create-nested-select
- `where`: https://www.youtube.com/watch?v=TlWbDO2P76I
- https://stackoverflow.com/questions/30231862/laravel-eloquent-has-with-wherehas-what-do-they-mean
- https://stackoverflow.com/questions/41756404/laravel-eloquent-union-query/41758244
- https://www.itsolutionstuff.com/post/laravel-how-to-make-subquery-in-select-statementexample.html
- https://stackoverflow.com/questions/24823915/how-to-select-from-subquery-using-laravel-query-builder
- https://stackoverflow.com/questions/34587457/difference-between-eloquent-modelget-and-all
- https://laravel-news.com/laravel-deleted-models
- params column: https://www.youtube.com/watch?v=jkKVy5UQ6Y0
- https://laravel-news.com/laravel-10-30-0
- Scout for full-text search: 
    - https://laravel.com/docs/11.x/scout
    - https://www.youtube.com/watch?v=0o3Ua52Y6pU
- https://www.youtube.com/watch?v=t_wtC3qR-n0
- https://stackoverflow.com/questions/40917189/laravel-syntax-error-or-access-violation-1055-error

All in one command: `php artisan migrate:fresh  --seed --seeder=XxxSeeder`

![](/Illustrations/Storage/laravel_refactor_example_1.png)

Common mistakes

![](/Illustrations/Storage/laravel_eloquent_or.png)

Repo pattern

- https://vegibit.com/laravel-repository-pattern
- https://tutspack.com/crud-example-with-repository-design-pattern-in-laravel
- https://viblo.asia/p/trien-khai-crud-voi-laravel-service-repository-pattern-6J3ZgyWA5mB
- https://viblo.asia/p/laravel-crud-vue3-ap-dung-repository-pattern-vao-ung-dung-bJzKmobwl9N
- Why not use: https://www.youtube.com/watch?v=giJcdfW2wC8