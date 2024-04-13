<?php

declare(strict_types=1);

namespace App\Actions\Info\Sheet;

use Illuminate\Support\Collection;

final class GetUpdateInfos extends SheetAccess
{
    /**
     * @return Collection<int,array{id:string,version:string,tags:array<int,string>,content:string}>
     */
    public function __invoke(): Collection
    {
        $items = $this->getItems('UpdateInfo', 'A:F');

        return $items->map(function (array $item): array {
            /** @var array<int,string> */
            $tags = array_values(array_filter([$this->pick($item, 2), $this->pick($item, 3), $this->pick($item, 4)]));

            return [
                'id' => $this->pick($item, 0),
                'version' => $this->pick($item, 1),
                'tags' => $tags,
                'content' => $this->pick($item, 5),
            ];
        });
    }
}
