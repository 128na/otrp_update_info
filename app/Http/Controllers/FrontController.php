<?php

declare(strict_types=1);

namespace App\Http\Controllers;

final class FrontController extends Controller
{
    public function __invoke()
    {
        return 'hello';

    }
}
