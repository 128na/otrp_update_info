<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Data;

class ApiController extends Controller
{
    /**
     * GASからデータを受信し、
     */
    public function receiver(Request $request)
    {
        // トークンチェック
        $valid_token = config('app.api.token', false);
        abort_unless($valid_token && $request->input('token') === $valid_token, 404);

        $data = $request->input('data');
        $api  = $request->input('version', 1);

        Data::put($data, $api);
    }
}
