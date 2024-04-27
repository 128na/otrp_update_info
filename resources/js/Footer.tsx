export function Footer({ lastModifiedAt }: { lastModifiedAt: string }) {
    return (
        <footer>
            <nav className="px-4 lg:px-6 py-2.5 mt-2.5 dark:bg-gray-800 border-solid border-t" >
                <div className="flex flex-wrap justify-between items-center mx-auto max-w-screen-md">
                    <span className="self-center text-sm dark:text-white">最終更新 : {lastModifiedAt}</span>
                </div>
            </nav>
        </footer>
    );
}
