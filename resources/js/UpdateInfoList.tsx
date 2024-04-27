import { UpdateInfoListArgs } from "type";
import { TagList } from "./TagList";

export function UpdateInfoList({ updateInfo, selectedTags, onTagChange }: UpdateInfoListArgs) {
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
