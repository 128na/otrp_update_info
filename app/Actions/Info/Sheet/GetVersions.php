<?php

declare(strict_types=1);

namespace App\Actions\Info\Sheet;

use Illuminate\Support\Collection;

final class GetVersions extends SheetAccess
{
    /**
     * @return Collection<int,array{id:string,version:string,released_at:string,url:string}>
     */
    public function __invoke(): Collection
    {
        $items = $this->getItems('Versions', 'A:D');

        return $items->map(fn (array $item): array => [
            'id' => $this->pick($item, 0),
            'version' => $this->pick($item, 1),
            'released_at' => $this->pick($item, 2),
            'url' => $this->pick($item, 3),
        ]);
    }
}
