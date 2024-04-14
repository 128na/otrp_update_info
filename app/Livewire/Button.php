<?php

declare(strict_types=1);

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Attributes\Reactive;
use Livewire\Component;

final class Button extends Component
{
    #[Reactive]
    public bool $selected = false;

    public string $tag = '';

    public function render(): View
    {
        return view('livewire.button');
    }

    public function toggle(): void
    {
        $this->dispatch('toggleTag', tag: $this->tag);
    }
}
