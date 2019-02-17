<!DOCTYPE html>
<html>
<head>
  
  <title>编辑器- 最好用的笔记</title>
  <link rel="stylesheet" href="/css/app.css">
  <link rel="stylesheet" href="/css/tree.css">
  <link rel="stylesheet" href="/css/font-awesome.min.css">

</head>
<body>
  <div id="app" class="{{ route_class() }}-page">
    @include('layouts._header')
    @include('layouts._message')
    @include('layouts._sidebar')

    <div class="main container-fluid">
      <form method="post" action="{{ route('paragraphs.store') }}">
        {{ csrf_field() }}
        <div id="test-editormd">
          <textarea name="test-editormd" style="display:none;"></textarea>
        </div> 
        <div style="width:90%;margin: 10px auto;">
          <input type="submit" name="submit" value="保存" style="padding: 5px;"> 
        </div>               
      </form>      
    </div>
  </div>

  <script src="/js/app.js"></script>
  <script src="/js/tree.js"></script>
  @include('markdown::encode',['editors'=>['test-editormd']])
  <script>
    $(document).ready(function(){
      var data = [
        {title: "编码", field: "code",url:"https://www.baidu.com/s?wd=1",candidate: true},
        {title: "基本信息", open: true,url:"https://www.baidu.com/s?wd=2", children:[
          {title: "234rtretjrlejgfz23423fsfjdsfdjslgfdlgfgjlglfdgjlgflgjl", field: "name",url:"https://www.baidu.com/s?wd=2.1", candidate: true},
          {title: "年龄", field: "age",url:"https://www.baidu.com/s?wd=2.2", candidate: true},
          {title: "性别", field: "sex",url:"https://www.baidu.com/s?wd=2.3", candidate: true},
          {title: '教育相关1', open: true,url:"https://www.baidu.com/s?wd=2.4", children:[
            {title: "最高学历1", field: "education",url:"https://www.baidu.com/s?wd=2.4.1", candidate: true},
            {title: "毕业学校1", field: "college",url:"https://www.baidu.com/s?wd=2.4.2", candidate: true},
            {title: "所学技术1", open:true,url:"https://www.baidu.com/s?wd=2.4.3", children: [
              {title: "1111111111111111111111111122222222222222222", field: 'java',url:"https://www.baidu.com/s?wd=2.4.3.1", candidate: true},
              {title: "Oracle数据操作1", field: 'oracle',url:"https://www.baidu.com/s?wd=2.4.3.2", candidate: true},
              {title: "网页设计1", field: 'html',url:"https://www.baidu.com/s?wd=2.4.3.3", candidate: true}
            ]}
          ]},
          {title: '教育相关2', open: true,url:"https://www.baidu.com/s?wd=2.5", children:[
            {title: "最高学历2", field: "education",url:"https://www.baidu.com/s?wd=2.5.1", candidate: true},
            {title: "毕业学校2", field: "college",url:"https://www.baidu.com/s?wd=2.5.2", candidate: true},
            {title: "所学技术2", open:true,url:"https://www.baidu.com/s?wd=2.5.3", children: [
              {title: "Java编程2", field: 'java',url:"https://www.baidu.com/s?wd=2.5.3.1", candidate: true},
              {title: "Oracle数据操作2", field: 'oracle',url:"https://www.baidu.com/s?wd=2.5.3.2", candidate: true},
              {title: "网页设计2", field: 'html',url:"https://www.baidu.com/s?wd=2.5.3.3", candidate: true}
            ]}
          ]}
        ]},
        {title: "基本信息", open: true,url:"https://www.baidu.com/s?wd=2", children:[
          {title: "名称", field: "name",url:"https://www.baidu.com/s?wd=2.1", candidate: true},
          {title: "年龄", field: "age",url:"https://www.baidu.com/s?wd=2.2", candidate: true},
          {title: "性别", field: "sex",url:"https://www.baidu.com/s?wd=2.3", candidate: true},
          {title: '教育相关1', open: true,url:"https://www.baidu.com/s?wd=2.4", children:[
            {title: "最高学历1", field: "education",url:"https://www.baidu.com/s?wd=2.4.1", candidate: true},
            {title: "毕业学校1", field: "college",url:"https://www.baidu.com/s?wd=2.4.2", candidate: true},
            {title: "所学技术1", open:true,url:"https://www.baidu.com/s?wd=2.4.3", children: [
              {title: "11111111111111111111111111666666666", field: 'java',url:"https://www.baidu.com/s?wd=2.4.3.1", candidate: true},
              {title: "Oracle数据操作1", field: 'oracle',url:"https://www.baidu.com/s?wd=2.4.3.2", candidate: true},
              {title: "网页设计1", field: 'html',url:"https://www.baidu.com/s?wd=2.4.3.3", candidate: true}
            ]}
          ]},
          {title: '教育相关2', open: true,url:"https://www.baidu.com/s?wd=2.5", children:[
            {title: "最高学历2", field: "education",url:"https://www.baidu.com/s?wd=2.5.1", candidate: true},
            {title: "毕业学校2", field: "college",url:"https://www.baidu.com/s?wd=2.5.2", candidate: true},
            {title: "所学技术2", open:true,url:"https://www.baidu.com/s?wd=2.5.3", children: [
              {title: "Java编程2", field: 'java',url:"https://www.baidu.com/s?wd=2.5.3.1", candidate: true},
              {title: "Oracle数据操作2", field: 'oracle',url:"https://www.baidu.com/s?wd=2.5.3.2", candidate: true},
              {title: "网页设计2", field: 'html',url:"https://www.baidu.com/s?wd=2.5.3.3", candidate: true}
            ]}
          ]}
        ]},
        {title: '工作信息', open: true,url:"https://www.baidu.com/s?wd=3", children:[
          {title: "职位", field: "office",url:"https://www.baidu.com/s?wd=3.1", candidate: true},
          {title: "职称", field: "call",url:"https://www.baidu.com/s?wd=3.2", candidate: true},
          {title: "所在楼层", field: "place",url:"https://www.baidu.com/s?wd=3.3", candidate: true}
        ]}
      ];

      $('#tree').append(loadTree(data));
      nodeClick($('#tree'));
    })
  </script>
</body>
</html>