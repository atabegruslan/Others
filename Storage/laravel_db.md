# Eloquent ORM or Query Builder (`\DB`)

## Speed vs Changing DB

Eloquent is slower. But easier when changing DB, eg from MySQL to PostgreSQL

https://stackoverflow.com/questions/38391710/laravel-eloquent-vs-query-builder-why-use-eloquent-to-decrease-performance

![](/Illustrations/Storage/Eloquent_Speed.png)

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

DB Performance:
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
