<?php

declare(strict_types=1);

namespace App\Actions\Info;

use App\Actions\Info\Sheet\GetTags;
use App\Actions\Info\Sheet\GetUpdateInfos;
use App\Actions\Info\Sheet\GetVersions;

final readonly class SyncFromSheet
{
    public function __construct(
        private GetVersions $getVersions,
        private GetTags $getTags,
        private GetUpdateInfos $getUpdateInfos,
        private BuildData $buildData,
        private PutJson $putJson,
    ) {}

    public function __invoke(): void
    {
        ($this->putJson)(($this->buildData)(
            ($this->getVersions)(),
            ($this->getTags)(),
            ($this->getUpdateInfos)(),
        ));
    }
}
