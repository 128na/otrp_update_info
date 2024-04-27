import { UpdateInfoArgs } from "type";
import { TagButton } from "./TagButton";

export function UpdateInfo({ updateInfo, selectedTags, onTagChange }: UpdateInfoArgs) {
    const tagList = updateInfo.tags.map((tag, index) => <TagButton
        tag={tag}
        selectedTags={selectedTags}
        key={index}
        onClick={() => onTagChange(tag)}
    />);


    return (
        <div>
            {tagList}
            <span className="dark:text-white">{updateInfo.content}</span>
        </div>
    );
}
