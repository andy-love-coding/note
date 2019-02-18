<header class="navbar navbar-fixed-top navbar-default">
  <div class="container-fluid">
    <div class="col-md-offset-0 col-md-12">
      <a href="{{ route('home') }}" id="logo">NOTE</a>
      <nav>
        <ul class="nav navbar-nav navbar-left">
          @foreach($categories as $index => $category)
            @if ($category->articles->count() === 0)              
              <li class="disabled"><a href="#">{{ $category->name }}</a></li>
            @elseif ($category->articles->count() === 1)
              <li class="{{ active_class((if_route('category.articles.show') && if_route_param('category', $index+1))) }}"><a href="{{ route('category.articles.show', [$category->id, $category->articles->first()->id]) }}">{{ $category->name }}</a></li>
            @else
              <li class="dropdown {{ active_class((if_route('category.articles.show') && if_route_param('category', $index+1))) }}">
                <button type="button" class="btn dropdown-toggle" id="dropdownMenu1" 
                    data-toggle="dropdown" data-hover="dropdown">
                    {{ $category->name }}
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                  @foreach($category->articles as $article)
                    <li><a href="{{ route('category.articles.show', [$category->id, $article->id]) }}">{{ $article->title }}</a></li>
                  @endforeach
                </ul>
              </li>              
            @endif
          @endforeach     
          
        </ul>
      </nav>
      <nav>
        <ul class="nav navbar-nav navbar-right">
          @if (Auth::check())
            <li><a href="#">用户列表</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                {{ Auth::user()->name }} <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li><a href="{{ route('users.show', Auth::user()->id) }}">个人中心</a></li>
                <li><a href="#">编辑资料</a></li>
                <li><a href="{{ route('categories.index') }}">分类管理</a></li>
                <li class="divider"></li>
                <li>
                  <a id="logout" href="#">
                    <form action="{{ route('logout') }}" method="POST">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      <button class="btn btn-block btn-danger" type="submit" name="button">退出</button>
                    </form>
                  </a>
                </li>
              </ul>
            </li>
          @else
            <li><a href="{{ route('help') }}">帮助</a></li>
            <li><a href="{{ route('login') }}">登录</a></li>
          @endif
        </ul>
      </nav>
    </div>
  </div>
</header>