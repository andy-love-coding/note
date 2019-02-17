@extends('layouts.app')
@section('title', $article->title)

@section('content')
<div id="doc-content">
<textarea style="display:none;">
{{ "# ".$article->title }}
@foreach($paragraphs as $paragraph)
<input class="paragraph" type="hidden" value="{{ $paragraph->id }}">
{!! $paragraph->content !!}
@endforeach
</textarea>
</div>
@endsection

@section('script')
<script>
    var lists = {!! $lists !!};
</script>
@stop

