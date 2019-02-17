<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>编辑器- 最好用的笔记</title>
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
      <!-- 显示 markdown文档 -->
      <div id="doc-content">
<textarea style="display:none;">
{{ "# ".$article->title }}
</textarea>
      </div>

      <!-- markdown 编辑器表单 -->
      @if($paragraph)
      <form method="post" action="{{ route('article.paragraphs.update', [$article->id, $paragraph->id]) }}">
      {{ method_field('PATCH') }}
      @else
      <form method="post" action="{{ route('article.paragraphs.store', $article->id) }}">
      @endif
        {{ csrf_field() }}
        <input type="hidden" name="article_id" value="{{ $article->id }}">
        <div id="test-editormd">
<!-- 编辑器默认值 -->
<textarea name="test-editormd" style="display:none;">
@if($paragraph)      
{{ $paragraph->content }}
@endif
</textarea>
        </div> 
        <div style="width:90%;margin: 10px auto;">
          <input type="submit" name="submit" value="保存" style="padding: 5px;"> 
        </div>               
      </form>
    </div>
  </div>

  <script src="/js/app.js"></script>
  <script src="/js/tree.js"></script>
  <script src="http://cdn.bootcss.com/bootstrap-hover-dropdown/2.0.10/bootstrap-hover-dropdown.min.js"></script>
  @include('markdown::decode',['editors'=>['doc-content']])
  @include('markdown::encode',['editors'=>['test-editormd']])
  <script>
    var lists = {!! $lists !!};    
  </script>
  <script>
    $(document).ready(function(){
      $('#tree').append(loadTree(lists));
      nodeClick($('#tree'));
    })
  </script>  
</body>
</html>