<?php
namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class Data
{
  /**
   * ストレージからjson文字列を取得し、配列に変換して返す
   * @param string|int $api
   * @return array
   */
  public static function get($api = 1)
  {
    return json_decode(Storage::disk('public')->get(static::getFilename($api)), true);
  }
  /**
   * json文字列を加工、ストレージに保存する
   * @param array $data
   * @param string|int $api
   */
  public static function put($data, $api = 1)
  {
    $data = json_decode($data, true);
    $data = static::convertData($data);
    return Storage::disk('public')->put(static::getFilename($api), json_encode($data));
  }
  /**
   * 最終更新日を取得する
   */
  public static function lastModified($api = 1)
  {
    $timestamp = Storage::disk('public')->lastModified(static::getFilename($api));
    return Carbon::createFromTimestamp($timestamp);
  }

  private static function getFilename($api)
  {
    return "{$api}/data.json";
  }

  private static function convertData($data)
  {
    $versions    = collect($data['versions']);
    $tags        = collect($data['tags']);
    $update_info = collect($data['update_info']);

    $versions = $versions->map(function($version) use ($tags, $update_info) {
      $version['update_info'] = $update_info
        ->filter(function($info) use ($version) {
          return $version['id'] === $info['version'];
        })
        ->map(function($info) use ($tags) {
          $info['tags'] = collect($info['tags'])
            ->map(function($tag_id) use ($tags) {
              return $tags->first(function($tag) use ($tag_id) {
                return $tag['id'] == $tag_id;
              });
            });
          return $info;
        })
        ->values();
      return $version;
    });

    $data = [
      'versions'   => $versions,
      'tags'       => $tags,
    ];
    return $data;
  }
}
