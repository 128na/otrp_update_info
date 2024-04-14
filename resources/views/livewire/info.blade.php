<main>
    <section class="px-4 lg:px-6 py-2.5 my-2.5">
        <div class="mx-auto max-w-screen-md">
            <div class="mb-2">
                @foreach ($tags as $index => $tag)
                <livewire:button
                    :$tag
                    :selected="$this->selected($tag)"
                    :key="'tl_'.$index"
                />
                @endforeach
                <div class="inline-flex rounded-md shadow-sm" role="group">
                    <input
                        type="text"
                        class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700"
                        placeholder="キーワード"
                        wire:model.live.debounce.250ms="keyword"
                    />
                    <button
                        type="button"
                        class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700"
                        wire:click="clear"
                    >リセット</button>
                </div>
            </div>

            @forelse  ($versions as $vi => $version)
            <div class="mb-2" wire:key="{{ $vi }}">
                <div>
                    <span class="font-bold text-xl dark:text-white">v{{$version['version']}}</span>
                    <spa class="dark:text-white">{{$version['released_at']}}</span>
                    <a
                        href="{{$version['url']}}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="text-blue-600 dark:text-blue-500 hover:underline"
                        >Link</a>
                </div>
                @foreach ($version['update_info'] as $ui => $info)
                <div wire:key="{{ $ui }}">
                    @foreach ($info['tags'] as $ti => $tag)
                    <livewire:button
                        :$tag
                        :selected="$this->selected($tag)"
                        :key="'ti_'.$vi.'_'.$ui.'_'.$ti"
                    />
                    @endforeach
                    <span
                        class="dark:text-white"
                    >{{$info['content']}}</span>
                </div>
                @endforeach
            </div>
            @empty
                <div>該当なし</div>
            @endforelse
        </div>
    </section>
    <footer>
        <nav class="px-4 lg:px-6 py-2.5 mt-2.5 dark:bg-gray-800 border-solid border-t" >
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-md">
                <span class="self-center text-sm dark:text-white">最終更新 : {{$last_modified_at}}</span>
            </div>
        </nav>
    </footer>
</main>
