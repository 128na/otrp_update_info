<?php

declare(strict_types=1);

namespace App\Actions\Info\Sheet;

use Illuminate\Support\Collection;

final class GetVersions extends SheetAccess
{
    /**
     * @return Collection<int,array{version:string,released_at:string,url:string}>
     */
    public function __invoke(): Collection
    {
        $items = $this->getItems('Versions', 'B:D');

        return $items->map(fn (array $item): array => [
            'version' => $this->pick($item, 0),
            'released_at' => $this->pick($item, 1),
            'url' => $this->pick($item, 2),
        ]);
    }
}
