export interface Data {
    versions: Version[];
    tags: string[];
    last_modified_at: string;
}

export interface Version {
    version: string;
    released_at: string;
    url: string;
    update_info: UpdateInfo[]
}

export interface UpdateInfo {
    version: string;
    content: string;
    tags: string[];
}

export interface ConditionFilterArgs {
    tags: string[];
    selectedTags: string[];
    keyword: string;
    onKeywordChange: React.Dispatch<React.SetStateAction<string>>;
    onTagChange: (tag: string) => void;
    onReset: () => void;
}

export interface TagListArgs {
    tags: string[];
    selectedTags: string[];
    onTagChange: (tag: string) => void;
}


export interface UpdateInfoListArgs {
    updateInfo: UpdateInfo[];
    selectedTags: string[];
    onTagChange: (tag: string) => void;
}


export interface VersionListArgs {
    versions: Version[];
    selectedTags: string[];
    onTagChange: (tag: string) => void;
}
