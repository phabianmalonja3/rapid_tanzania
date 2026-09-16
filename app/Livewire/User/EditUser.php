<?php

namespace App\Livewire\User;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class EditUser extends ModalComponent
{
    public function render()
    {
        return view('livewire.user.edit-user');
    }
}
