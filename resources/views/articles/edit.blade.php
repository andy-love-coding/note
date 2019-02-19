@extends('layouts.app_nosider')
@section('title', '编辑分类')

@section('content')
<div class="col-md-offset-4 col-md-4">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h5>编辑文章</h5>
    </div>
    <div class="panel-body">
      @include('shared._errors')
      
      <form method="POST" action="{{ route('articles.update', $article->id) }}">
          {{ csrf_field() }}
          {{ method_field('PUT') }}
          <div class="form-group">
            <label for="title">文章标题</label>
            <input type="text" name="title" class="form-control" value="{{ $article->title }}">
          </div>

          <div class="form-group">
            <label for="category_id">文章分类：</label>
            <select name="category_id" class="form-control" disabled>
              <option value="{{ $article->category->id }}">{{ $article->category->name }}</option>
            </select>
          </div>         

          <button type="submit" class="btn btn-primary">保存修改</button>
      </form>
    </div>
  </div>
</div>
@stop