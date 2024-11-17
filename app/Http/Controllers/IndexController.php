<?php

namespace App\Http\Controllers;

use Exception;

class IndexController extends Controller
{
    public function __invoke(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        return view('index');
    }
}
