import { VersionArgs } from "type";
import { UpdateInfo } from "./UpdateInfoList";

export function Version({ version, selectedTags, onTagChange }: VersionArgs) {
    const updateInfoList = version.update_info.map((updateInfo, index) => <UpdateInfo
        updateInfo={updateInfo}
        selectedTags={selectedTags}
        key={index}
        onTagChange={onTagChange}
    />);

    return (
        <div className="mb-4">
            <div>
                <span className="text-2xl dark:text-white me-1">v{version.version}</span>
                <span className="dark:text-white me-1">{version.released_at}</span>
                <a
                    href={version.url}
                    target="_blank"
                    rel="noopener noreferrer"
                    className="text-blue-600 dark:text-blue-500 hover:underline"
                >Link</a>
                {updateInfoList}
            </div>
        </div>
    );
}
