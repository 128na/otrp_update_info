<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Info\LoadJson;
use Illuminate\Contracts\View\View;

final class FrontController extends Controller
{
    public function __invoke(LoadJson $loadJson): View
    {
        try {
            return view('index', ['data' => $loadJson()]);
        } catch (\Throwable) {
            return view('index', ['data' => ['versions' => [], 'tags' => [], 'last_modified_at' => '']]);
        }
    }
}
