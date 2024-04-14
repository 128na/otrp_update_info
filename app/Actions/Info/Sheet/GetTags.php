<?php

declare(strict_types=1);

namespace App\Actions\Info\Sheet;

use Illuminate\Support\Collection;

final class GetTags extends SheetAccess
{
    /**
     * @return Collection<int,string>
     */
    public function __invoke(): Collection
    {
        $items = $this->getItems('Tags', 'B:B');

        return $items->map(fn (array $item): string => $this->pick($item, 0));
    }
}
