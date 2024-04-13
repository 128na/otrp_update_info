<?php

declare(strict_types=1);

namespace App\Actions\Info;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;

final readonly class BuildData
{
    public function __construct(private CarbonImmutable $now)
    {
    }

    /**
     * @param  Collection<int,array{version:string,released_at:string,url:string}>  $versions
     * @param  Collection<int,array{name:string}>  $tags
     * @param  Collection<int,array{version:string,tags:array<int,string>,content:string}>  $updateInfos
     * @return array{versions:Collection<int,array{version:string,released_at:string,url:string,update_info:array<int,array{version:string,tags:array<int,array{name:string}>,content:string}>}>,tags:Collection<int,array{name:string}>,last_modified_at:string}
     */
    public function __invoke(Collection $versions, Collection $tags, Collection $updateInfos): array
    {
        $updateInfos = $updateInfos->map(function (array $u) use ($tags) {
            $u['tags'] = array_map(fn ($tagName) => $tags->first(fn ($t): bool => $tagName === $t['name']), $u['tags']);

            return $u;
        });

        /**
         * @var Collection<int,array{version:string,released_at:string,url:string,update_info:array<int,array{version:string,tags:array<int,array{name:string}>,content:string}>}>
         */
        $versions = $versions->map(function (array $v) use ($updateInfos): array {
            $v['released_at'] = Carbon::hasFormat($v['released_at'], 'Y/m/d') ? Carbon::createFromFormat('Y/m/d', $v['released_at'])?->startOfDay()->toISOString() ?? '' : '';
            $v['update_info'] = $updateInfos->filter(fn (array $u): bool => $v['version'] === $u['version'])->all();

            return $v;
        });

        return [
            'versions' => $versions,
            'tags' => $tags,
            'last_modified_at' => $this->now->toDateTimeString(),
        ];
    }
}
