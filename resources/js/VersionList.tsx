import { VersionListArgs } from "type";
import { UpdateInfoList } from "./UpdateInfoList";

export function VersionList({ versions, selectedTags, onTagChange }: VersionListArgs) {
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
