@extends('layouts.app')

@section('content')
<div id="doc-content">
<textarea style="display:none;">
{{ isset($article) ? "# ".$article->title : '' }}
@foreach($paragraphs as $paragraph)
<input class="paragraph" type="hidden" value="{{ $paragraph->id }}">
{!! $paragraph->content !!}
@endforeach
</textarea>
</div>
@stop
<script>
    var lists = {!! $lists !!};
</script>
