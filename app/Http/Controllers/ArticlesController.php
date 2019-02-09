<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Cache;

class ArticlesController extends Controller
{
    public function index()
    {
        $article = Article::first();     
        $paragraphs = $article->paragraphs;
        $paragraphs->each(function($item, $key) {
            $item->content = str_replace('{{', '{ {', $item->content);
            $item->content = str_replace('}}', '} }', $item->content);
        });
        $arr = [];
        $newarr = [];
        $lists = [];
        $i = 1;
        // 得到基础目录数组
        foreach($paragraphs as $paragraph) {
            $arr = explode("\r\n", $paragraph->content);
            foreach($arr as $key=>$value) {
                if (substr($value,0,1) === '#') {                  
                    $headarr = explode(" ", $value);
                    $newarr[] = ['id'=>$i, 'title'=>$headarr[1], 'url'=>'#'.$headarr[1], 'level'=>strlen($headarr[0]), 'pid'=>0, 'candidate' => true];
                    $i += 1;
                }
            }
        }
         
        // 更新目录数组的 pid
        foreach($newarr as $kk => $vv) {
            if ($kk === 0) {
                continue;
            }
            $newarr[$kk]['pid'] = $this->findFather($vv['id'],$newarr);
        }
        $lists = $this->getTree($newarr);
        

        // dump($lists);
        // dump($newarr);
        // die;
        $lists = json_encode($lists);   
        // $lists = json_encode([
        //     ['title'=>'刘鑫', 'open'=> true,'url' => "https=>//www.baidu.com/s?wd=1", 'candidate' => true],
        //     ['title'=> "基本信息", 'open'=> true,'url'=>"https=>//www.baidu.com/s?wd=2", 'children'=>[
        //         ['title'=> "234rtretjrlejgfz23423fsfjdsfdjslgfdlgfgjlglfdgjlgflgjl", 'field'=> "name",'url'=>"https=>//www.baidu.com/s?wd=2.1", 'candidate'=> true],
        //         ['title'=> "年龄", 'field'=> "age",'url'=>"https=>//www.baidu.com/s?wd=2.2", 'candidate'=> true],
        //         ['title'=> "性别", 'field'=> "sex",'url'=>"https=>//www.baidu.com/s?wd=2.3", 'candidate'=> true],
        //         ['title'=> '教育相关1', 'open'=> true,'url'=>"https=>//www.baidu.com/s?wd=2.4", 'children'=>[
        //           ['title'=> "最高学历1", 'field'=> "education",'url'=>"https=>//www.baidu.com/s?wd=2.4.1", 'candidate'=> true],
        //           ['title'=> "毕业学校1", 'field'=> "college",'url'=>"https=>//www.baidu.com/s?wd=2.4.2", 'candidate'=> true],
        //           ['title'=> "所学技术1", 'open'=>true,'url'=>"https=>//www.baidu.com/s?wd=2.4.3", 'children'=> [
        //             ['title'=> "1111111111111111111111111122222222222222222", 'field'=> 'java','url'=>"https=>//www.baidu.com/s?wd=2.4.3.1", 'candidate'=> true],
        //             ['title'=> "Oracle数据操作1", 'field'=> 'oracle','url'=>"https=>//www.baidu.com/s?wd=2.4.3.2", 'candidate'=> true],
        //             ['title'=> "网页设计1", 'field'=> 'html','url'=>"https=>//www.baidu.com/s?wd=2.4.3.3", 'candidate'=> true]
        //           ]]
        //         ]],
        //         ['title'=> '教育相关2', 'open'=> true,'url'=>"https=>//www.baidu.com/s?wd=2.5", 'children'=>[
        //           ['title'=> "最高学历2", 'field'=> "education",'url'=>"https=>//www.baidu.com/s?wd=2.5.1", 'candidate'=> true],
        //           ['title'=> "毕业学校2", 'field'=> "college",'url'=>"https=>//www.baidu.com/s?wd=2.5.2", 'candidate'=> true],
        //           ['title'=> "所学技术2", 'open'=>true,'url'=>"https=>//www.baidu.com/s?wd=2.5.3", 'children'=> [
        //             ['title'=> "Java编程2", 'field'=> 'java','url'=>"https=>//www.baidu.com/s?wd=2.5.3.1", 'candidate'=> true],
        //             ['title'=> "Oracle数据操作2", 'field'=> 'oracle','url'=>"https=>//www.baidu.com/s?wd=2.5.3.2", 'candidate'=> true],
        //             ['title'=> "网页设计2", 'field'=> 'html','url'=>"https=>//www.baidu.com/s?wd=2.5.3.3", 'candidate'=> true]
        //           ]]
        //         ]]
        //       ]],
        // ]);
        
        return view('static_pages.home', compact('paragraphs', 'lists'));
    }

    // 为节点找 pid 
    public function findFather($id,$arr) {
        $son = $arr[$id-1];
        $subarr = array_reverse(array_slice($arr,0,$id-1));
        
        foreach ($subarr as $k=>$father) {
            if ($son['level'] > $father['level']) { // 找到父亲了
                return $father['id'];
            }            
        }
        return 0;
    }

    public function getTree($list, $pid = 0)
    {
        $tree = [];
        if (!empty($list)) {
            //先修改为以id为下标的列表
            $newList = [];
            foreach ($list as $k => $v) {
                $newList[$v['id']] = $v;
            }
            //然后开始组装成特殊格式
            foreach ($newList as $value) {
                if ($pid == $value['pid']) {//先取出顶级
                    $tree[] = &$newList[$value['id']];
                } elseif (isset($newList[$value['pid']])) {//再判定非顶级的pid是否存在，如果存在，则再pid所在的数组下面加入一个字段items，来将本身存进去
                    $newList[$value['pid']]['candidate'] = false;
                    $newList[$value['pid']]['open'] = true;
                    $newList[$value['pid']]['children'][] = &$newList[$value['id']];
                }
            }
        }
        return $tree;
    }
}