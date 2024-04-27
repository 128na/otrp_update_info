import { createRoot } from 'react-dom/client';
import { useState } from 'react';

const root = createRoot(document.getElementById('app'));
root.render(<MainLayout />);

function MainLayout() {
    /**
     * @type  {{versions:[{version:string,released_at:string,url:string,update_info:[{version:string,content:string,tags:string[]}]}],tags:string[],last_modified_at:string}}
     */
    const data = window.data;
    /**
     * @returns {[{version:string,released_at:string,url:string,update_info:[{version:string,content:string,tags:string[]}]}]}
     */
    const getFreshVersions = () => JSON.parse(JSON.stringify(data.versions));
    const [keyword, setKeyword] = useState('');
    const [selectedTags, setSelectedTags] = useState([]);

    const toggleTag = (tag) => {
        if (selectedTags.includes(tag)) {
            setSelectedTags(selectedTags.filter(t => t !== tag));
        } else {
            setSelectedTags([...selectedTags, tag]);
        }
    };

    const reset = () => {
        setSelectedTags([]);
        setKeyword('');
    };

    const filtered = getFreshVersions().map(v => {
        v.update_info = v.update_info.filter(u => {
            const notIncludesSomeTag = selectedTags.some(st => !u.tags.includes(st));
            if (notIncludesSomeTag) {
                return false;
            }

            if (!keyword) {
                return true;
            }

            return u.content.includes(keyword);
        });
        return v;
    }).filter(v => v.update_info.length > 0);

    return (
        <main>
            <section className="px-4 lg:px-6 py-2.5 my-2.5">
                <div className="mx-auto max-w-screen-md">
                    <ConditionFilter
                        tags={data.tags}
                        selectedTags={selectedTags}
                        keyword={keyword}
                        onKeywordChange={setKeyword}
                        onTagChange={toggleTag}
                        onReset={reset}
                    />
                    <VersionList
                        versions={filtered}
                        selectedTags={selectedTags}
                        keyword={keyword}
                        onTagChange={toggleTag}
                    />
                </div>
            </section>
            <Footer lastModifiedAt={data.last_modified_at} />
        </main >
    );
}

/**
 * @param {{tags:string[],selectedTags:string[],keyword:string}}
 */
function ConditionFilter({ tags, selectedTags, keyword, onKeywordChange, onTagChange, onReset }) {
    return (
        <div className="mb-2">
            <TagList tags={tags} selectedTags={selectedTags} onTagChange={onTagChange} />
            <div className="inline-flex rounded-md shadow-sm" role="group">
                <input
                    type="text"
                    className="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700"
                    placeholder="キーワード"
                    value={keyword}
                    onChange={(e) => onKeywordChange(e.target.value)}
                />
                <button
                    type="button"
                    className="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700"
                    onClick={onReset}
                >リセット</button>
            </div>
        </div>
    );
}

/**
 * @param {{tags:string[],selectedTags:string[]}}
 */
function TagList({ tags, selectedTags, onTagChange }) {
    const additionalClass = (t) => selectedTags.includes(t)
        ? 'text-white bg-green-700 hover:bg-green-800 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800'
        : 'text-gray-900 bg-white border-gray-300 hover:bg-gray-100 focus:ring-gray-100 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 border';


    const tagList = tags.map((t, index) =>
        <button
            key={index}
            type="button"
            className={`focus:outline-none focus:ring-4 font-medium rounded-lg text-sm py-1 px-2 me-1 my-1 ${additionalClass(t)}`}
            onClick={() => onTagChange(t)}
        >{t}</button>
    );
    return (<>{tagList}</>);
}

function UpdateInfoList({ updateInfo, selectedTags, onTagChange }) {
    const updateInfoList = updateInfo.map((u, index) => {
        return (
            <div key={index}>
                <TagList tags={u.tags} selectedTags={selectedTags} onTagChange={onTagChange} />
                <span className="dark:text-white">{u.content}</span>
            </div>
        );
    });
    return (<>{updateInfoList}</>);
}

/**
 * @param  {{versions:[{version:string,released_at:string,url:string,update_info:[{version:string,content:string,tags:string[]}]}],selectedTags:string[],keyword:string}}
 */
function VersionList({ versions, selectedTags, onTagChange }) {
    const versionList = versions.map((v, index) =>
        <div className="mb-2" key={index}>
            <div>
                <span className="font-bold text-xl dark:text-white">v{v.version}</span>
                <span className="dark:text-white">{v.released_at}</span>
                <a
                    href={v.url}
                    target="_blank"
                    rel="noopener noreferrer"
                    className="text-blue-600 dark:text-blue-500 hover:underline"
                >Link</a>
                <UpdateInfoList
                    updateInfo={v.update_info}
                    selectedTags={selectedTags}
                    onTagChange={onTagChange}
                />
            </div>
        </div>
    );
    return (<>{versionList}</>);
}

/**
 * @param {{lastModifiedAt:string}}
 */
function Footer({ lastModifiedAt }) {
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
