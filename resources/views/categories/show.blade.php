@extends('layouts.app')
@section('title', $category->name)

@section('content')
{{ $category->name }}
@stop