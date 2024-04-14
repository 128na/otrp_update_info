<?php

declare(strict_types=1);

namespace App\Providers;

use App\Actions\Info\LoadJson;
use App\Actions\Info\PutJson;
use App\Actions\Info\Sheet\GetTags;
use App\Actions\Info\Sheet\GetUpdateInfos;
use App\Actions\Info\Sheet\GetVersions;
use App\Actions\Info\Sheet\SheetAccess;
use App\Http\Middleware\EnsureTokenIsValid;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Revolution\Google\Sheets\Facades\Sheets;
use Storage;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    #[\Override]
    public function register(): void
    {
        $sheet = function (): \Revolution\Google\Sheets\Sheets {
            /** @var \Revolution\Google\Sheets\Sheets */
            $sheets = Sheets::spreadsheet(Config::string('google.sheet_id'));

            return $sheets;
        };
        $this->app->bind(GetTags::class, fn (): SheetAccess => new GetTags($sheet()));
        $this->app->bind(GetVersions::class, fn (): SheetAccess => new GetVersions($sheet()));
        $this->app->bind(GetUpdateInfos::class, fn (): SheetAccess => new GetUpdateInfos($sheet()));
        $this->app->bind(PutJson::class, fn (): PutJson => new PutJson(Storage::disk('public')));
        $this->app->bind(LoadJson::class, fn (): LoadJson => new LoadJson(Storage::disk('public')));
        $this->app->bind(EnsureTokenIsValid::class, fn (): EnsureTokenIsValid => new EnsureTokenIsValid(Config::string('google.sync_token')));
    }
}
