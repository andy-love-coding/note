<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paragraph;
use App\Models\Category;

class StaticPagesController extends Controller
{
    public function home()
    {
        $categories = Category::all();
        $defaultCategory = $categories->first();
        $defaultArticle = $defaultCategory->articles->first();

        $paragraphs = $defaultArticle->paragraphs;
        $paragraphs = paragraphsClear($paragraphs);

        // 得到 树形数组
        $lists = mdToTree($paragraphs);        
        $lists = json_encode($lists);
        
        return view('static_pages.home', compact('categories', 'paragraphs', 'lists'));
    }

    public function editor()
    {
        return view('static_pages.editor');
    }
    
}
