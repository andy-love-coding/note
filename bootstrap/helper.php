<?php

// 获取当前路由名称，并把 "." 替换成 "_" 
function route_class()
{
    // `Route::currentRouteName()` 会获取当前路由的名称，即 ->name('路由名称') 中的名称，而不是获取路由路径
    return str_replace('.', '-', Route::currentRouteName());
}

// paragraphs 清理：处理 “{{}}”
function paragraphsClear($paragraphs) {
    $paragraphs->each(function($item, $key) {
        $item->content = str_replace('{{', '{ {', $item->content);
        $item->content = str_replace('}}', '} }', $item->content);
        // $item->content = preg_replace('/(#+ )([A-Za-z0-9\x{4e00}-\x{9fa5} "",:;“”，：；]+)(\\r\\n)/u', '${1}${2}$3', $item->content);
    });
    return $paragraphs;
}

// 从 markdown 段落，提取标题树形数组
function mdToTree($mdParagraphs) {
    $basearr = getBaseArr($mdParagraphs);
    $basearr = updatePid($basearr);
    $listTree = getTree($basearr);
    return $listTree;
}

// 得到标题的基础数组
function getBaseArr($mdParagraphs) {
    $arr = [];
    $basearr = [];
    $i = 1;
    foreach($mdParagraphs as $paragraph) {
        $arr = explode("\r\n", $paragraph->content);
        foreach($arr as $key=>$value) {
            if (substr($value,0,1) === '#') {                  
                $headarr = explode(" ", $value, 2);
                if (isset($headarr[1])) {
                    $basearr[] = ['id'=>$i, 'title'=>$headarr[1], 'url'=>'#'.$headarr[1], 'level'=>strlen($headarr[0]), 'pid'=>0, 'candidate' => true];
                }
                $i += 1;
            }
        }
    }
    return $basearr;
}

// 更新基础数组的 pid
function updatePid($basearr) {
    foreach($basearr as $kk => $vv) {
        if ($kk === 0) {
            continue;
        }
        $basearr[$kk]['pid'] = findFather($vv['id'],$basearr);
    }
    return $basearr;
}

// 将 数组变为树形数组
function getTree($list, $pid = 0)
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

// 为节点找 pid 
function findFather($id,$arr) {
    if (isset($arr[$id-1])) {
        $son = $arr[$id-1]; // 从数组的第二个开始，依次作为儿子，向上找父亲
    } else {
        return 0;
    }    
    $subarr = array_reverse(array_slice($arr,0,$id-1)); // 向上的子数组
    
    foreach ($subarr as $k=>$father) {
        if ($son['level'] > $father['level']) { // 找到父亲了
            return $father['id'];
        }            
    }
    return 0;
}