<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;

class Data
{
    /**
     * ストレージからjson文字列を取得し、配列に変換して返す
     *
     * @param  string|int  $version  api version
     * @return array
     */
    public static function get($version = 1)
    {
        return json_decode(self::getFile($version), true);
    }

    public static function getFile($version = 1)
    {
        return Storage::disk('public')->get(self::getFilename($version));
    }

    /**
     * json文字列を加工、ストレージに保存する
     *
     * @param  array  $data
     * @param  string|int  $version  api version
     */
    public static function put($data, $version = 1)
    {
        $data = json_decode($data, true);
        $data = self::convertData($data);

        return Storage::disk('public')->put(self::getFilename($version), json_encode($data));
    }

    private static function getFilename($version)
    {
        return "{$version}/data.json";
    }

    private static function convertData($data)
    {
        $versions = collect($data['versions']);
        $tags = collect($data['tags']);
        $update_info = collect($data['update_info']);

        $versions = $versions->map(function ($version) use ($tags, $update_info) {
            $version['update_info'] = $update_info
                ->filter(function ($info) use ($version) {
                    return $version['id'] === $info['version'];
                })
                ->map(function ($info) use ($tags) {
                    $info['tags'] = collect($info['tags'])
                        ->map(function ($tag_id) use ($tags) {
                            return $tags->first(function ($tag) use ($tag_id) {
                                return $tag['id'] == $tag_id;
                            });
                        });

                    return $info;
                })
                ->values();

            return $version;
        });

        $data = [
            'versions' => $versions,
            'tags' => $tags,
            'last_modified_at' => now()->format('Y-m-d H:i:s'),
        ];

        return $data;
    }
}
