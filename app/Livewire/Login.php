<?php

namespace App\Livewire;

use Livewire\Component;

class Login extends Component
{
    public $email, $password;
    public function login(){
        $this->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(auth()->attempt(['email' => $this->email, 'password' => $this->password])){
            return redirect('/');
        }
        $this->addError('password', 'Wrong credentials');
        return redirect()->back();
    }
    public function render()
    {
        return view('livewire.login');
    }
}
