@extends('layout')
@section('title', 'スプレッドシート同期')

@section('content')
<form
    method="post"
    action="{{ request()->fullUrl() }}"
>
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <button
        type="submit"
        class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700"
    >今すぐ同期</button>
</form>
@endsection
