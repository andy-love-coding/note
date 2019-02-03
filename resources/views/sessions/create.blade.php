<!DOCTYPE html>
<html>
<head>
  <title>@yield('title', 'NOTE')- 最好用的笔记</title>
  <link rel="stylesheet" href="/css/app.css">
  <link rel="stylesheet" href="/css/tree.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
</head>
<body>
  <div id="app" class="{{ route_class() }}-page">
    @include('layouts._header')
    @include('layouts._message')
    <div class="main">            
      <div class="col-md-offset-4 col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h5>登录</h5>
          </div>
          <div class="panel-body">
            @include('shared._errors')

            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group">
                  <label for="email">邮箱：</label>
                  <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                  <label for="password">密码（<a href="{{ route('password.request') }}">忘记密码</a>）：</label>
                  <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                </div>

                <div class="checkbox">
                  <label><input type="checkbox" name="remember"> 记住我</label>
                </div>

                <button type="submit" class="btn btn-primary">登录</button>
            </form>

            <hr>

            <p>还没账号？<a href="{{ route('signup') }}">现在注册！</a></p>
          </div>
        </div>
      </div>

    </div>
  </div>
  <script src="/js/app.js"></script>
</body>
</html>


