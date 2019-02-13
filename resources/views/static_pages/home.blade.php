@extends('layouts.app')

@section('content')
<div id="doc-content">
<textarea style="display:none;">
@foreach($paragraphs as $paragraph)
{!! $paragraph->content !!}
@endforeach
</textarea>
</div>
@stop
<script>
    var lists = {!! $lists !!};    
</script>
