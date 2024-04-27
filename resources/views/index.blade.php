@extends('layout')

@section('content')
<div id="app"></div>
<script>
window.data = @json($data);
</script>
@viteReactRefresh
@vite('resources/js/app.jsx')
@endsection
