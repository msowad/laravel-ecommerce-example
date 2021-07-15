<?php

namespace App\Http\Livewire\Child;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChangePassword extends Component
{
    public $old_password;
    public $new_password;

    public function submit()
    {
        if (Auth::attempt(['email' => auth()->user()->email, 'password' => $this->old_password])) {

            $this->validate([
                'new_password' => 'required|min:6',
            ]);

            $user = User::findOrFail(auth()->user()->id);


            $user->password = $this->new_password;
            $user->save();

            $this->reset(['old_password', 'new_password']);

            session()->flash('success_msg', 'Password successfully updated.');
        } else {
            session()->flash('error_msg', 'Please enter valid password.');
        }
    }

    public function render()
    {
        return view('livewire.child.change-password');
    }
}
