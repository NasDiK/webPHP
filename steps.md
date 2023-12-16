1) `php artisan make:controller ApiController`
2) `php artisan make:resource ArticleResourceCollection`
3) `php artisan make:resource ArticleResource`

4) 
```php
 public function newsList() {
        $newsListCollection = new ArticleResourceCollection(/*News::all() //todo создать модель News с миграцией*/);
        
        return Response::json($newsListCollection);
    }

    public function article($articleId) {
        $model = new ArticleResource(/*News::find($articleId) */);

        return Response::json($model);
    }
```

5) Начинить ресурсы по примеру апи

```php
toArray() {
  return [
    'id' => $this->id,
    'name' => $this->name
    //....
  ]
}
```

## 6) routes/api

```php
Route::get('/newsList', [ApiController::class, 'newsList']);

Route::get('/article/{id}', [ApiController::class, 'article']);
```
