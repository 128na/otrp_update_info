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
     * @return Collection<int,string[]>
     */
    protected function getItems(string $sheetName, string $range): Collection
    {
        $items = $this->sheets->sheet($sheetName)->range($range)->all();

        array_shift($items);

        return collect($items);
    }
}
