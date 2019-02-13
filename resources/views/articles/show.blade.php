@extends('layouts.app')
@section('title', $article->title)

@section('content')
{{ article->title }}
@stop