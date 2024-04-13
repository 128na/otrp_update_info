<?php

declare(strict_types=1);

namespace App\Actions\Info\Sheet;

use Illuminate\Support\Collection;

final class GetTags extends SheetAccess
{
    /**
     * @return Collection<int,array{id:string,name:string,description:string}>
     */
    public function __invoke(): Collection
    {
        $items = $this->getItems('Tags', 'A:C');

        return $items->map(fn (array $item): array => [
            'id' => $this->pick($item, 0),
            'name' => $this->pick($item, 1),
            'description' => $this->pick($item, 2),
        ]);
    }
}
