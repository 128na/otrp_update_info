import { useState } from 'react';
import { Data, Version } from 'type';
import { VersionList } from './VersionList';
import { ConditionFilter } from './ConditionFilter';
import { Footer } from './Footer';

export function MainLayout({ data }: { data: Data }) {
    const getFreshVersions = (): Version[] => JSON.parse(JSON.stringify(data.versions));
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
                        onTagChange={toggleTag}
                    />
                </div>
            </section>
            <Footer lastModifiedAt={data.last_modified_at} />
        </main >
    );
}
