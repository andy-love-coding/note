@extends('layouts.app_nosider')
@section('title', '分类管理')

@section('content')
<div class="col-md-offset-4 col-md-4">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h5>添加主题</h5>
    </div>
    <div class="panel-body">
      @include('shared._errors')
      
      <form method="POST" action="{{ route('articles.store') }}">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="category_id">选择分类：</label>
            <select name="category_id" class="form-control">
              <option value="0">请选择</option>
              @foreach($categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="title">主题名称：</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
          </div>         

          <button type="submit" class="btn btn-primary">添加主题</button>
      </form>
    </div>
  </div>
</div>
@stop