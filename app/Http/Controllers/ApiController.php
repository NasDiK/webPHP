<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleResourceCollection;
use Illuminate\Http\Request;
use Response;

class ApiController extends Controller
{
    //
    public function newsList() {
        $newsListCollection = new ArticleResourceCollection(/*News::all() //todo создать модель News с миграцией*/);
        
        return Response::json($newsListCollection);
    }

    public function article($articleId) {
        $model = new ArticleResource(/*News::find($articleId) */);

        return Response::json($model);
    }
}
