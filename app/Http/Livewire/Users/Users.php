<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;

class Users extends Component
{
    public $users,$name,$permissions, $rolePermissions, $roles;
    //public $updateMode = false;
    public $permission = [];
    public $isModal = 0;

    public function render()
    {
        $this->users = User::orderBy('id','desc')->get();
        return view('livewire.users.users');
    }
}
