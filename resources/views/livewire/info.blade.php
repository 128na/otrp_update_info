<div>

    @foreach ($tags as $tag)
    <button
        type="button"
        class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700"
    >{{$tag}}</button>
    @endforeach
    @foreach ($versions as $version)
    <div>
        <div>{{$version['version']}}</div>
        <div>{{$version['released_at']}}</div>
        <div>{{$version['url']}}</div>
        @foreach ($version['update_info'] as $info)
            <div>{{$info['content']}}</div>
            @foreach ($info['tags'] as $tag)
                <div>{{$tag}}</div>
            @endforeach
        @endforeach
    </div>
    @endforeach

    {{$last_modified_at}}
</div>
