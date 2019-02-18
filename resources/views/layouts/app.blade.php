<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'NOTE')- 最好用的笔记</title>
  <link rel="stylesheet" href="/css/app.css">
  <link rel="stylesheet" href="/css/tree.css">
  <link rel="stylesheet" href="/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{asset('vendor/markdown/css/editormd.min.css')}}" />
</head>
<body>
  <div id="app" class="{{ route_class() }}-page">
    @include('layouts._header')
    @include('layouts._message')
    @include('layouts._sidebar')

    <div class="main container-fluid">
        @yield('content')
    </div>
  </div>
  @include('shared._create_article')

  <script src="/js/app.js"></script>
  <script src="/js/tree.js"></script>
  <script src="http://cdn.bootcss.com/bootstrap-hover-dropdown/2.0.10/bootstrap-hover-dropdown.min.js"></script>
  @include('markdown::decode',['editors'=>['doc-content']])
  
  <script>
    
    $(document).ready(function(){
      // 自动生成目录
      $('#tree').append(loadTree(lists));
      nodeClick($('#tree'));

      // 定义公共变量
      var _URL_ = "{{ env('APP_URL') }}";      
      
      // 给文章添加“添加段落”的按钮,”删除文章“按钮
      var aa = $('<a>').addClass('add').attr({
        href: _URL_ + '/articles/'+ {{ isset($article) ? $article->id : '0' }} +'/paragraphs/create'
      });
      var ii = $('<i>').addClass('glyphicon glyphicon-pencil').appendTo(aa);
      var form_article = $('<form>').addClass('del_form_article').attr({
        'method': 'post',
        'action': _URL_ + "/articles/"+ "{{ isset($article) ? $article->id : '' }}"
      });

      var input_token1 = $('<input>').attr({
        'type': 'hidden',
        'name': '_token',
        'value': "{{ csrf_token() }}"
      });
      var input_method1 = $('<input>').attr({
        'type': 'hidden',
        'name': '_method',
        'value': 'DELETE'
      });
      var button1 = $('<button>').attr({
        'type': 'submit'
      });
      var i_del1 = $('<i>').addClass('glyphicon glyphicon-trash').appendTo(button1);
      
      form_article.append(input_token1);
      form_article.append(input_method1);
      form_article.append(button1);

      $('h1').first().append(aa);
      $('h1').first().append(form_article);

      // 给每个段落添加编辑和删除按钮
      var a = $('<a>').addClass('edit');
      var i = $('<i>').addClass('glyphicon glyphicon-edit').appendTo(a);  
      var form = $('<form>').addClass('del_form').attr({
        'method': 'post'
      });
      var input_token = $('<input>').attr({
        'type': 'hidden',
        'name': '_token',
        'value': "{{ csrf_token() }}"
      });
      var input_method = $('<input>').attr({
        'type': 'hidden',
        'name': '_method',
        'value': 'DELETE'
      });
      var button = $('<button>').attr({
        'type': 'submit'
      });
      var i_del = $('<i>').addClass('glyphicon glyphicon-trash').appendTo(button);
      form.append(input_token);
      form.append(input_method);
      form.append(button);      

      $('.paragraph').parent().next().append(a);
      $('.paragraph').parent().next().append(form);

      link = []; // 用于存储段落的 id
      $('.paragraph').each(function(index, element) {
        link.push(element.defaultValue);
      }); 
      $('.edit').each(function(index, element){        
        element.href = _URL_ + "/articles/"+ {{ isset($article) ? $article->id : '' }} +"/paragraphs/"+ link[index] +"/edit";
      });
      $('.del_form').each(function(index, element){
        element.action = _URL_ + "/articles/"+ {{ isset($article) ? $article->id : '' }} +"/paragraphs/"+ link[index];
      });      
    })
  </script>
  @yield('script')
</body>
</html>