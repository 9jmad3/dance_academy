<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Account extends Component
{
    public function render()
    {
        return view('livewire.admin.account')
            ->layout('layouts.admin', ['title' => 'Mi cuenta']);
    }
}
