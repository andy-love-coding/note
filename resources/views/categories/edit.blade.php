@extends('layouts.app_nosider')
@section('title', '编辑分类')

@section('content')
<div class="col-md-offset-4 col-md-4">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h5>编辑分类</h5>
    </div>
    <div class="panel-body">
      @include('shared._errors')
      
      <form method="POST" action="{{ route('categories.update', $category->id) }}">
          {{ csrf_field() }}
          {{ method_field('PUT') }}
          <div class="form-group">
            <label for="name">分类名称：</label>
            <input type="text" name="name" class="form-control" value="{{ $category->name }}">
          </div>

          <div class="form-group">
            <label for="description">分类描述：</label>
            <input type="text" name="description" class="form-control" value="{{ $category->description }}">
          </div>         

          <button type="submit" class="btn btn-primary">保存修改</button>
      </form>
    </div>
  </div>
</div>
@stop