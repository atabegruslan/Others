# Notable differences

## No more distinction in the adapter interface regarding synchronous and asynchronous requests:

### Retrofit 2.0
```java
public interface Service {
    @GET("retrofit/{version}/get.php")
    Call<Model> get(@Path("version") String version, @Query("test_name") String test_name);
}
```

### Retrofit 1.9
```java
public interface Service {
    @GET("/retrofit/{version}/get.php")
    public void getAsync(@Path("version") String version, @Query("test_name") String test_name, Callback<Model> response);

    @GET("/retrofit/{version}/get.php")
    public Model getSync(@Path("version") String version, @Query("test_name") String test_name);
}
```

## Becareful about constructing URLs

### In 2.0, should be like this
```java
private static final String ROOT_URL = "http://ruslancode.net23.net/";
...
service = new Retrofit.Builder().baseUrl(ROOT_URL).client(client).addConverterFactory(GsonConverterFactory.create()).build().create(Service.class);
```

```java
public interface Service {
    @GET("retrofit/{version}/get.php")
    Call<Model> get(@Path("version") String version, @Query("test_name") String test_name);
}
```

### Instead of 1.9's
```java
private final String BASE_URL = "http://ruslancode.net23.net/";
...
restAdapter = new RestAdapter.Builder().setEndpoint(BASE_URL).build();
service = restAdapter.create(Service.class);
```

```java
public interface Service {
    @GET("/retrofit/{version}/get.php")
    public void getAsync(@Path("version") String version, @Query("test_name") String test_name, Callback<Model> response);

    @GET("/retrofit/{version}/get.php")
    public Model getSync(@Path("version") String version, @Query("test_name") String test_name);
}
```

## Detailed

https://github.com/atabegruslan/Others/blob/master/Illustrations/Mobile/retrofit_versions.pdf
