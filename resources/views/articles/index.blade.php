@extends('layouts.app_nosider')
@section('title', '文章管理')

@section('content')
  <div class="col-md-offset-2 col-md-8">    
    <table class="table">
      <tr>
        <th>ID</th>
        <th>文章名称</th>
        <th>分类名称</th>
        <th>操作</th>
      </tr>
      @foreach($articles as $article)
      <tr>
        <td>{{ $article->id }}</td>
        <td>{{ $article->title }}</td>
        <td>{{ $article->category->name }}</td>
        <td>
          <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-default btn-xs pull-left"><i class="glyphicon glyphicon-edit"></i> 编辑</a>
          <form id="delete_form" action="{{ route('articles.destroy', $article->id) }}" method="post" onsubmit= 'javascript:return confirm("您确认要删除吗？");'>
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-default btn-xs pull-left" style="margin-left: 6px;">
            <i class="glyphicon glyphicon-trash"></i>删除</button>
          </form>
        </td>
      </tr>
      @endforeach
    </table>
  </div>

@stop