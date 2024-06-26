<?php

declare(strict_types=1);

namespace App\Actions\Info;

use App\Constants\JsonName;
use Illuminate\Contracts\Filesystem\Filesystem;

final readonly class PutJson
{
    public function __construct(private Filesystem $filesystem) {}

    public function __invoke(mixed $data): void
    {
        $str = json_encode($data);
        if ($str === false) {
            throw new FailedException('json_encode failed');
        }

        $this->filesystem->put(JsonName::INFO, $str);
    }
}
