<?php

declare(strict_types=1);

namespace App\Providers;

use App\Actions\Info\Sheet\SheetAccess;
use Illuminate\Support\ServiceProvider;
use Revolution\Google\Sheets\Facades\Sheets;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    #[\Override]
    public function register(): void
    {
        $this->app->bind(SheetAccess::class, fn(): \App\Actions\Info\Sheet\SheetAccess => new SheetAccess(
            Sheets::spreadsheet(config('google.sheet_id'))
        ));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
