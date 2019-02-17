<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

// 类目默认显示其下的第一篇文章
class CategoriesController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('categories.create', compact('categories'));
    }

    public function store(Request $request, Category $category)
    {
        $category->fill($request->all());
        $category->save();
        return redirect()->route('categories.index')->with('success', '新增分类成功');
    }

    public function edit (Category $category)
    {
        $categories = Category::all();
        return view('categories.edit', compact('categories', 'category'));
    }

    public function update(Category $category, Request $request)
    {
        $category->update($request->all());
        return redirect()->route('categories.index')->with('success', '更新成功！');
    }
}
