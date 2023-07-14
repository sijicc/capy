<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuItem extends Component
{
    public function __construct(
        public ?string $href,
        public string  $title,
        public ?string $icon = null,
        /** @var MenuItem[] */
        public array   $children = [],
        public bool    $active = false,
    )
    {
        if (count($this->children) > 0) {
            $this->active = collect($this->children)->contains(fn(MenuItem $item) => $item->active);
        }
    }

    public function render(): View
    {
        return view('components.menu-item', [
            'href' => $this->href,
            'title' => $this->title,
            'icon' => $this->icon,
            'children' => $this->children,
            'active' => $this->active,
        ]);
    }
}
