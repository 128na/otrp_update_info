<header>
    <nav class="px-4 lg:px-6 py-2.5 mb-2.5 dark:bg-gray-800 border-solid border-b" >
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-md">
            <a href="/" class="flex items-center">
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">{{ $title ?? config('app.name') }}</span>
            </a>
            <div class=" justify-between items-center w-full md:flex md:w-auto md:order-1">
                <ul class="flex flex-col mt-4 font-medium md:flex-row md:space-x-8 md:mt-0">
                    <li>
                        <a
                            href="https://github.com/teamhimeh/simutrans/releases"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="block p-2 text-gray-700 dark:text-white"
                        >Download</a>
                    </li>
                    <li>
                        <a
                            href="https://github.com/teamhimeh/simutrans/blob/OTRP-distribute/documentation/OTRP_v13_information.md"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="block p-2 text-gray-700 dark:text-white"
                        >Doc</a>
                    </li>
                    <li>
                        <a
                            href="https://simutrans-intro.notion.site/API-2cbb6813417b4b2f80c27392b4d6b3d2#872c99c1ada5489a802bd6c2ae7c382b"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="block p-2 text-gray-700 dark:text-white"
                        >API</a>
                    </li>
                    <li>
                        <a
                            href="https://github.com/128na/otrp_update_info"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="block p-2 text-gray-700 dark:text-white"
                        >GitHub</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
