<?php

namespace App\Livewire\User;

use Livewire\Attributes\Layout;
use Livewire\Component;

class UserHomepage extends Component
{
    #[Layout('components.layouts.user-layout')]
    public function render()
    {
        return view('livewire.user.user-homepage');
    }
}
