<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paragraph;
use App\Models\Article;
use App\Models\Category;

class ParagraphsController extends Controller
{
    public function create_edit(Article $article, Paragraph $paragraph)
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
        if($paragraph->id) {
            // 编辑           
            return view('paragraphs.create_edit', compact('categories', 'article', 'paragraphs', 'paragraph', 'lists'));
        } else {
            // 新增
            $paragraph = null;
            return view('paragraphs.create_edit', compact('categories', 'article', 'paragraphs', 'paragraph', 'lists'));
        }
        
    }

    public function store(Request $request)
    {
        $data = [];     
        $data['content'] = $this->checkContent($request['test-editormd']);   
        $data['article_id'] = $request->article_id;
        $data['order'] = 100;
        $paragraph = Paragraph::create($data);
        return redirect()->route('articles.show', $request->article_id)->with('success', '创建话题成功');    
    }

    public function update(Request $request, Article $article, Paragraph $paragraph)
    {
        $data = [];
        $data['content'] = $this->checkContent($request['test-editormd']);
        $paragraph->update($data);

        return redirect()->route('articles.show', $article->id)->with('success', '更新成功');
    }

    public function destroy(Article $article, Paragraph $paragraph)
    {
        $paragraph->delete();
		return redirect()->route('articles.show', $article->id)->with('success', '删除成功');
    }

    private function checkContent($contentMd) {
        $headArr = explode("\r\n", $contentMd);
        $targetArr = ['# ', '## ', '### ', '#### ', '##### ', '######'];
        $hasBlank = false; // 默认没有空格
        foreach($targetArr as $item) {
            echo $item."<br>";
            if (strpos($headArr[0], $item) === 0) { // strpos()找到返回位置0，没找到返回false
                // 找到空格了
                $hasBlank = true;
                break;
            } 
        }
        if (substr($headArr[0],0,1) !== '#') { // 若提交内容不以 ‘#’ 开头，则添加默认标题
            $data['content'] = "## 默认标题\r\n".$contentMd;
        } elseif (!$hasBlank) {  // 以 ’#‘ 开头， 且 ’#‘ 后面没有空格，则添加空格
            $data['content'] = "## 您的标题缺少空格\r\n".$contentMd;
        } else {
            // 以 ’#‘ 开头，且后有空格，即正常内容
            $data['content'] = $contentMd;
        }    

        return $data['content'];
    }
    
}
