<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleResourceCollection;
use App\Http\Resources\StatyaClassResource;
use App\Http\Resources\StatyaClassResourceCollection;
use App\Models\Statya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller
{
    //
    public function newsList() {
        $newsListCollection = new StatyaClassResourceCollection(Statya::all());

        return Response::json($newsListCollection);
    }

    public function article($articleId) {
        $model = new StatyaClassResource(Statya::find($articleId));

        return Response::json($model);
    }
}
