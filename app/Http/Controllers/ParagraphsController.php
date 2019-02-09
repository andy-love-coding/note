<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paragraph;

class ParagraphsController extends Controller
{
    public function store(Request $request)
    {
        $data = [];

        $data['content'] = $request['test-editormd'];
        $data['article_id'] = 1;
        $data['order'] = 100;
        $paragraph = Paragraph::create($data);
        return redirect()->route('home')->with('success', '创建话题成功');    
    }
}
