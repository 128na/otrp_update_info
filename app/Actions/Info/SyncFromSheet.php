<?php

declare(strict_types=1);

namespace App\Actions\Info;

use App\Actions\Info\Sheet\GetTags;
use App\Actions\Info\Sheet\GetUpdateInfos;
use App\Actions\Info\Sheet\GetVersions;

final class SyncFromSheet
{
    public function __construct(
        private readonly GetVersions $getVersions,
        private readonly GetTags $getTags,
        private readonly GetUpdateInfos $getUpdateInfos,
        private readonly BuildData $buildData,
        private readonly SaveJson $saveJson,
    ) {

    }

    public function __invoke()
    {
        ($this->saveJson)(($this->buildData)(
            ($this->getVersions)(),
            ($this->getTags)(),
            ($this->getUpdateInfos)(),
        ));
    }
}
