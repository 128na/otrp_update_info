<?php

declare(strict_types=1);

namespace App\Actions\Info\Sheet;

final class GetUpdateInfos extends SheetAccess
{
    public function __invoke()
    {
        /**
         * @var Collection<int,string[6]>
         */
        $items = $this->getItems('UpdateInfo', 'A:F');

        return $items->map(fn ($item): array => [
            'id' => $item[0] ?? '',
            'version' => $item[1] ?? '',
            'tags' => array_filter([$item[2] ?? '', $item[3] ?? '', $item[4] ?? '']),
            'content' => $item[5] ?? '',
        ]);
    }
}
