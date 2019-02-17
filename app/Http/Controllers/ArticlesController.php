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
        array_unshift ($lists, [
           "id" => "0",
           "title" => $article->title,
           "url" => "#" . $article->title,
           "level" => 1,
           "candidate" => true 
        ]);
        $lists = json_encode($lists);

        return view('articles.show', compact('categories', 'article', 'paragraphs', 'lists'));
    }
    
    public function create()
    {
        $categories = Category::all();

        return view('articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        if ($request->category_id !== "0") {
            $article = Article::create($request->all());
            return redirect()->route('articles.show', $article->id)->with('success', '更新成功！');
        }
        return redirect()->route('articles.create')->with('danger', '请选择分类！');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('home')->with('success', '删除成功');
    }
}