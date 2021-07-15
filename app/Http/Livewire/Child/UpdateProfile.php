<?php

namespace App\Http\Livewire\Child;

use App\Models\User;
use Livewire\Component;

class UpdateProfile extends Component
{
    public $name;
    public $email;
    public $mobile;
    public $address;
    public $city;
    public $state;
    public $zip;
    public $company;

    public function submit()
    {
        $this->validate(['name' => 'required']);

        $user = User::findOrFail(auth()->user()->id);

        $user->name = $this->name;
        $user->mobile = $this->mobile;
        $user->address = $this->address;
        $user->city = $this->city;
        $user->state = $this->state;
        $user->zip = $this->zip;
        $user->company = $this->company;

        $user->save();

        session()->flash('success_msg', 'Profile information updated.');
    }

    public function mount()
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->mobile = $user->mobile;
        $this->email = $user->email;
        $this->address = $user->address;
        $this->city = $user->city;
        $this->state = $user->state;
        $this->zip = $user->zip;
        $this->company = $user->company;
    }

    public function render()
    {
        return view('livewire.child.update-profile');
    }
}
