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

  <script src="/js/app.js"></script>
  <script src="/js/tree.js"></script>
  <script src="http://cdn.bootcss.com/bootstrap-hover-dropdown/2.0.10/bootstrap-hover-dropdown.min.js"></script>
  @include('markdown::decode',['editors'=>['doc-content']])
  <script>
    $(document).ready(function(){
      $('#tree').append(loadTree(lists));
      nodeClick($('#tree'));
    })
  </script>
</body>
</html>