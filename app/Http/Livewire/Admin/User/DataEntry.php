<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DataEntry extends Component
{
    public $that   = 'user';
    public $thatUp = 'User';
    public $editId = '';

    public $name;
    public $email;
    public $mobile;
    public $address;
    public $city;
    public $state;
    public $zip;
    public $company;
    public $permissions = [];

    public $allPermissions;
    public $user;
    public $roles;

    public $new_role;

    public function submit()
    {
        if (can('edit user')) {
            $validatedArr = $this->validate([
                'name'        => 'required',
                'email'       => 'required',
                'mobile'      => 'nullable',
                'address'     => 'nullable',
                'city'        => 'nullable',
                'state'       => 'nullable',
                'zip'         => 'nullable',
                'company'     => 'nullable',
                'permissions' => ['nullable'],
            ]);

            $this->user->syncPermissions($this->permissions);

            $status = "updated";
            unset($validatedArr['permissions']);

            $this->user->update($validatedArr);

            session()->flash('success_msg', $this->thatUp . ' ' . $status);
            return redirect()->route('dashboard.' . $this->that);
        }
    }

    public function createNewRole()
    {
        if (can('edit user')) {
            $this->validate(['new_role' => 'required|unique:roles,name']);
            Role::create(['name' => $this->new_role])->givePermissionTo($this->permissions);
            $this->reset('new_role');
            $this->roles = Role::all(['name', 'id']);
        }
    }

    public function selectRole($role)
    {
        if (can('edit user')) {
            $role              = Role::with('permissions')->find($role);
            $this->permissions = [];
            foreach ($role->permissions->toArray() as $key => $permission) {
                $this->permissions[$key] = $permission['name'];
            }
        }
    }

    public function deleteRole($role)
    {
        if (can('edit user')) {
            Role::destroy($role);
            $this->roles = [];
            $this->roles = Role::all(['name', 'id']);
        }
    }

    public function mount($id = '')
    {
        $this->user    = User::findOrFail($id);
        $this->name    = $this->user->name;
        $this->email   = $this->user->email;
        $this->mobile  = $this->user->mobile;
        $this->address = $this->user->address;
        $this->city    = $this->user->city;
        $this->state   = $this->user->state;
        $this->zip     = $this->user->zip;
        $this->company = $this->user->company;

        foreach ($this->user->getDirectPermissions()->toArray() as $key => $permission) {
            $this->permissions[$key] = $permission['name'];
        }

        foreach (Permission::orderBy('group_by')->get("name")->toArray() as $key => $permission) {
            $this->allPermissions[$key] = $permission['name'];
        }

        $this->roles = Role::all(['name', 'id']);
    }

    public function render()
    {
        return view('livewire.admin.' . $this->that . '.data-entry')
            ->layout('layouts.admin');
    }
}
