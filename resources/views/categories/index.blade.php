@extends('layouts.app_nosider')
@section('title', '分类管理')

@section('content')
  <div class="col-md-offset-2 col-md-8">
    <div class="panel panel-default">
      <div class="panel-body">
        <a href="{{ route('categories.create') }}">
          <button type="button" class="btn btn-primary pull-right">添加分类</button>
        </a>
      </div>
    </div>
    <table class="table">
      <tr>
        <th>#</th>
        <th>分类名称</th>
        <th>分类描述</th>
        <th>操作</th>
      </tr>
      @foreach($categories as $category)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $category->name }}</td>
        <td>{{ $category->description }}</td>
        <td>
          <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-default btn-xs pull-left"><i class="glyphicon glyphicon-edit"></i> 编辑</a>
          <form id="delete_form" action="{{ route('categories.destroy', $category->id) }}" method="post">
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