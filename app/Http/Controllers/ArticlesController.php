<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;


class ArticlesController extends Controller
{
    public function show(Article $article)
    {
        $categories = Category::all();

        $paragraphs = $article->paragraphs;
        $paragraphs = paragraphsClear($paragraphs);

        // 得到 树形数组
        $lists = mdToTree($paragraphs);        
        $lists = json_encode($lists);

        return view('static_pages.home', compact('categories', 'paragraphs', 'lists'));
    }    
}