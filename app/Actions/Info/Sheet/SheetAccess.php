<?php

declare(strict_types=1);

namespace App\Actions\Info\Sheet;

use Illuminate\Support\Collection;
use Revolution\Google\Sheets\Sheets;

abstract class SheetAccess
{
    public function __construct(private readonly Sheets $sheets)
    {
    }

    /**
     * @return Collection<int,array<int,string>>
     */
    protected function getItems(string $sheetName, string $range): Collection
    {
        /** @var array<int,array<int,string>> */
        $items = $this->sheets->sheet($sheetName)->range($range)->all();

        array_shift($items);

        return collect($items);
    }

    /**
     * @param  mixed[]  $arr
     */
    protected function pick(array $arr, int $key): string
    {
        $item = $arr[$key] ?? '';
        if (is_string($item)) {
            return $item;
        }

        return '';
    }
}
