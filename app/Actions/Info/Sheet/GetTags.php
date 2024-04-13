<?php

declare(strict_types=1);

namespace App\Actions\Info\Sheet;

use Illuminate\Support\Collection;

final class GetTags extends SheetAccess
{
    public function __invoke(): Collection
    {
        /**
         * @var Collection<int,string[3]>
         */
        $items = $this->getItems('Tags', 'A:C');

        return $items->map(fn ($item) => [
            'id' => $item[0] ?? '',
            'name' => $item[1] ?? '',
            'description' => $item[2] ?? '',
        ]);
    }
}
