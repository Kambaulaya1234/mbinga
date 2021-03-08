<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Hash;
use Illuminate\Support\Arr;

class Users extends Component
{
    public $users,$name, $email, $user_id, $password, $password_confirmation, $permissions, $rolePermissions, $roles;
    //public $updateMode = false;
    public $roles_id = [];
    public $isModal = 0;

    public function render()
    {
        $this->roles = Role::with('users')->get();
        $this->permissions = Permission::get();
        $this->users = User::orderBy('id','desc')->get();
        return view('livewire.users.users');
    }

    public function create()
    {
        $roles = Role::all();
        $this->permissions = Permission::all();

        $this->resetFields();

        $this->openModal();
    }

    public function closeModal()
    {
        $this->isModal = false;
    }
    
    public function openModal()
    {
        $this->isModal = true;
    }

    public function resetFields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        //$this->roles_id = '';
    }

    public function store()
        {
            if(empty($this->user_id))
            {
            $validatedData = $this->validate([
                'name' => 'required|max:120',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|confirmed',
                ]);
            }
                
            $this->password = Hash::make($this->password);
            $user = User::updateOrCreate(['id' => $this->user_id],[
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password,
            ]);

            $roles_id = $this->roles_id;
            
            if(!empty($this->user_id))
            {
                if (isset($roles_id)) {        
                    $user->roles()->sync($roles_id);  //If one or more role is selected associate user to roles          
                }        
                else {
                    $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
                } 
            }
            if (isset($roles_id)) {

                foreach ($roles_id as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();            
                $user->assignRole($role_r); //Assigning role to user
                }
            }

            session()->flash('message', $this->user_id ? $this->name . ' User Created Successfuly': $this->name . 'User Created Successfuly');
            $this->closeModal(); //TUTUP MODAL
            $this->resetFields();
        }
    
    public function edit($id)
        {
            $user = User::findOrFail($id); //Get user with specified id
            $this->user_id = $id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->password = $user->password;
            $this->password_confirmation = $user->password_confirmation;

            $this->roles = $user->roles; //Get all roles 
            $this->openModal(); 
        }

    public function cancel()
        {
            $this->updateMode = false;
            $this->resetInputFields();
        }
  
    
    public function delete($id)
        {
            User::find($id)->delete();
            session()->flash('message', 'User Deleted Successfully.');
        }
}
