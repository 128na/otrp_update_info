import { useState } from 'react';
import { Data, Version as V } from 'type';
import { Version } from './Version';
import { ConditionFilter } from './ConditionFilter';
import { Footer } from './Footer';

export function MainLayout({ data }: { data: Data }) {
    const getFreshVersions = (): V[] => JSON.parse(JSON.stringify(data.versions));
    const [keyword, setKeyword] = useState<string>('');
    const [selectedTags, setSelectedTags] = useState<string[]>([]);

    const toggleTag = (tag: string) => {
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

    const filtered = getFreshVersions().map(version => {
        version.update_info = version.update_info.filter(updateInfo => {
            const notIncludesSomeTag = selectedTags.some(st => !updateInfo.tags.includes(st));
            if (notIncludesSomeTag) {
                return false;
            }

            if (!keyword) {
                return true;
            }

            return updateInfo.content.includes(keyword);
        });
        return version;
    }).filter(version => version.update_info.length > 0);

    const versionList = filtered.map((version, index) => <Version
        version={version}
        selectedTags={selectedTags}
        key={index}
        onTagChange={toggleTag}
    />);

    return (
        <main>
            <section className="px-4 lg:px-6 py-2.5 mb-2.5">
                <div className="mx-auto max-w-screen-md">
                    <ConditionFilter
                        tags={data.tags}
                        selectedTags={selectedTags}
                        keyword={keyword}
                        onKeywordChange={setKeyword}
                        onTagChange={toggleTag}
                        onReset={reset}
                    />
                    {versionList}
                </div>
            </section>
            <Footer lastModifiedAt={data.last_modified_at} />
        </main >
    );
}
