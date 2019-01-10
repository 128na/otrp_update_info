<?php
namespace App\Models;

use Illuminate\Support\Facades\Storage;

class Data
{
  public static function get($api = 1)
  {
    return json_decode(Storage::disk('public')->get("{$api}/data.json"), true);
  }
  public static function put($data, $api = 1)
  {
    $data = json_decode($data, true);
    $data = static::convertData($data);
    return Storage::disk('public')->put("{$api}/data.json",json_encode($data));
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
    return $versions;
  }

}
