<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Info\SyncFromSheet;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class ManualSyncController extends Controller
{
    public function index(): View
    {
        return view('sync');
    }

    public function update(SyncFromSheet $syncFromSheet): RedirectResponse
    {
        $syncFromSheet();

        return redirect('/');
    }
}
