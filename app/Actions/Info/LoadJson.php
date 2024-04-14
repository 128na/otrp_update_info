<?php

declare(strict_types=1);

namespace App\Actions\Info;

use App\Constants\JsonName;
use Illuminate\Contracts\Filesystem\Filesystem;

final readonly class LoadJson
{
    public function __construct(private Filesystem $filesystem)
    {
    }

    /**
     * @return array{versions:array<int,array{version:string,released_at:string,url:string,update_info:array<int,array{version:string,tags:array<int,string>,content:string}>}>,tags:array<int,string>,last_modified_at:string}
     */
    public function __invoke(): array
    {
        $str = $this->filesystem->get(JsonName::INFO);
        if (! $str) {
            throw new FailedException('file get failed');
        }

        /**
         * @var null|array{versions:array<int,array{version:string,released_at:string,url:string,update_info:array<int,array{version:string,tags:array<int,string>,content:string}>}>,tags:array<int,string>,last_modified_at:string}
         */
        $data = json_decode($str, true);
        if (! $data) {
            throw new FailedException('json_decode failed');
        }

        return $data;
    }
}
