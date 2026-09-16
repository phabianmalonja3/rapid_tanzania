<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Logout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return <<<'blade'
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="dropdown-item has-icon text-danger btn"><i class="fas fa-sign-out-alt"></i>Logout</button>
</form>
blade;
    }
}

