<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paragraph;

class StaticPagesController extends Controller
{
    public function home()
    {
        $paragraphs = Paragraph::all();
        $paragraphs->each(function($item, $key) {
            $item->content = str_replace('{{', '{ {', $item->content);
            $item->content = str_replace('}}', '} }', $item->content);
        });
        // dd($paragraphs);
        return view('static_pages.home', compact('paragraphs'));
    }

    public function editor()
    {
        return view('static_pages.editor');
    }
    
}
