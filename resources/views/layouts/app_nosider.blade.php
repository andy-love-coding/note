<!DOCTYPE html>
<html>
<head>
  <title>@yield('title', 'NOTE')- 最好用的笔记</title>
  <link rel="stylesheet" href="/css/app.css">
</head>
<body>
  <div id="app" class="{{ route_class() }}-page">
    @include('layouts._header')
    @include('layouts._message')

    <div class="main nosider">        
        @yield('content')
    </div>    
  </div>

  <script src="/js/app.js"></script>
</body>
</html>