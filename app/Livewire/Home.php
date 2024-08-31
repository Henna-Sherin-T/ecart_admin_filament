<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]


class Home extends Component
{

    public function mount()
    {
        if(!auth()->check()){
            return redirect('/login');
        }
    }
    
    public function logout(){
        auth()->logout();
        return redirect('/login');
    }

    public function render()
    {
        return view('livewire.home');
    }
}
