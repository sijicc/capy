<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class DashboardController extends Controller
{
    public function __invoke(): Factory|View|Application|\Illuminate\Contracts\Foundation\Application
    {
        return view('dashboard');
    }
}
