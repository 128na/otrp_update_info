<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Actions\Info\SyncFromSheet;
use Illuminate\Console\Command;

final class SyncInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(SyncFromSheet $syncFromSheet)
    {
        $syncFromSheet();
    }
}
