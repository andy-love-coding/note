<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

// 类目默认显示其下的第一篇文章
class CategoriesController extends Controller
{
    public function show(Category $category)
    {        
        if ($category->articles->count() === 1) {
            $article = $category->articles->first();
            dd($article->title);
        }
    }
}
