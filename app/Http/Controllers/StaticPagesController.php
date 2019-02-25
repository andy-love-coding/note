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

        $article = $defaultCategory->articles->first();
        if($article){            
            $paragraphs = $article->paragraphs;
        } else {
            $paragraphs = collect([]); // 空集合
        }        
        $paragraphs = paragraphsClear($paragraphs);


        // 得到 树形数组
        $lists = mdToTree($paragraphs);
        if (isset($article->title)) {
            array_unshift ($lists, [
                "id" => "0",
                "title" => $article->title,
                "url" => "#" . $article->title,
                "level" => 1,
                "candidate" => true 
             ]);
        }          
        $lists = json_encode($lists);
        
        return view('static_pages.home', compact('categories', 'paragraphs', 'article', 'lists'));
    }

    public function editor()
    {
        return view('static_pages.editor');
    }
    
}
