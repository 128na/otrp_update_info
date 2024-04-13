<?php

declare(strict_types=1);

namespace App\Actions\Info\Sheet;

final class GetVersions extends SheetAccess
{
    public function __invoke()
    {
        /**
         * @var Collection<int,string[4]>
         */
        $items = $this->getItems('Versions', 'A:D');

        return $items->map(fn ($item): array => [
            'id' => $item[0] ?? '',
            'version' => $item[1] ?? '',
            'released_at' => $item[2] ?? '',
            'url' => $item[3] ?? '',
        ]);
    }
}
