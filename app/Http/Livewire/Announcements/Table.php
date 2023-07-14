<?php

namespace App\Http\Livewire\Announcements;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Table extends Component
{

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.announcements.table');
    }
}
