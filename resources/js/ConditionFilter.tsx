import { ConditionFilterArgs } from "type";
import { TagList } from "./TagList";

export function ConditionFilter({ tags, selectedTags, keyword, onKeywordChange, onTagChange, onReset }: ConditionFilterArgs) {
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
