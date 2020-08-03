<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Data;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * GASからデータを受信し、
     */
    public function receiver(Request $request)
    {
        // トークンチェック
        $valid_token = config('app.api.token', false);
        abort_unless($valid_token, 404, 'missing token');
        abort_unless($request->input('token') === $valid_token, 404, 'invalid token');

        $data = $request->input('data');
        $version = $request->input('version', 1);

        Data::put($data, $version);
    }
    public function index()
    {
        $version = 1;
        return Data::getFile($version);
    }
}
