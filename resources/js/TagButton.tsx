import { TagButtonArgs } from "type";

export function TagButton({ tag, selectedTags, onClick }: TagButtonArgs) {
    const additionalClass = selectedTags.includes(tag)
        ? 'text-white bg-green-700 hover:bg-green-800 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800'
        : 'text-gray-900 bg-white border-gray-300 hover:bg-gray-100 focus:ring-gray-100 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 border';

    return (
        <button
            type="button"
            className={`focus:outline-none focus:ring-4 font-medium rounded-lg text-sm py-1 px-2 me-1 my-1 ${additionalClass}`}
            onClick={() => onClick()}
        >{tag}</button>
    );
}
