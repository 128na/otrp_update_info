<?php

declare(strict_types=1);

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;

final class Button extends Component
{
    public bool $selected = false;

    public string $tag = '';

    public function render(): View
    {
        return view('livewire.button');
    }

    public function toggle(): void
    {
        $this->dispatch('toggleTag', tag: $this->tag);

        $this->selected = ! $this->selected;
    }
}
