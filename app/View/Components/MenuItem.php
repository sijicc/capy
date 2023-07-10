<?php

namespace App\View\Components;

use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuItem extends Component
{

    /**
     * @throws Exception
     */
    public function __construct(
        public ?string $href,
        public string  $title,
        public ?string $icon = null,
        /** @var MenuItem[] */
        public array   $children = [],
        public bool    $active = false,
        public string  $tag = 'a',
    )
    {
        if (count($this->children) > 0) {
            $this->active = collect($this->children)->contains(fn(MenuItem $item) => $item->active);
            // If there are children, the href should be null
            $this->href = null;
            // If there are children, the tag should be a span instead of an anchor
            $this->tag = 'span';
        }

        if ($this->active) {
            $this->icon = 'heroicon-s-check';
        }

        if (!in_array($this->tag, ['a', 'span'])) {
            throw new Exception('Invalid tag');
        }
    }

    public function render(): View
    {
        // TODO: fix displaying of children
        // TODO: fix active state
        return view('components.menu-item', [
            'href' => $this->href,
            'title' => $this->title,
            'icon' => $this->icon,
            'children' => $this->children,
            'active' => $this->active,
            'tag' => $this->tag,
        ]);
    }
}
