<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data;

class MainController extends Controller
{
    //
    public function index()
    {
        $data = Data::get(1);
        return view('index', compact('data'));
    }
}
