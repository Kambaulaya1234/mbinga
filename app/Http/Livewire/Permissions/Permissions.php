<?php

namespace App\Http\Livewire\Permissions;

use Livewire\Component;
//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Permissions extends Component
{
    // public function __construct() {
    //     $this->middleware(['auth', 'isAdmin']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    // }
    public $name,$permissions, $rolePermissions, $roles, $permission, $permission_id;
    public $roles_id = [];
    public $isModal = 0;

    public function render()
    {
        $this->roles = Role::orderBy('id','DESC')->get();
        $this->permissions = Permission::orderBy('id','desc')->get();
        return view('livewire.permissions.permissions');
    }

    public function create() {
        $roles = Role::get(); //Get all roles

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
        }
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store() {
        if (empty($this->permission_id)) 
        {
        $this->validate([
            'name'=>'required|unique:permissions,name|max:40',
        ]);
        }

        $permission = Permission::updateOrCreate(['id' => $this->permission_id],
        ['name' => $this->name]);
        
        $roles_id = $this->roles_id;
        if (!empty($this->roles_id)) 
        { 
            //If one or more role is selected
            foreach ($roles_id as $role) {
                $r = Role::where('id', '=', $role)->firstOrFail(); //Match input role to db record

                $permission = Permission::where('name', '=', $this->name)->first(); //Match input //permission to db record
                $r->givePermissionTo($permission);
            }
        }

        session()->flash('message', $this->permission_id ? $this->name . ' Permission Created Successfuly': $this->name . 'Permission Created Successfuly');
        $this->closeModal(); //TUTUP MODAL
        $this->resetFields();

    }

    public function edit($id) {
        $permission = Permission::findOrFail($id);
        $this->name = $permission->name; 
        $this->permission_id = $id;
        $this->openModal(); 
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function delete($id) {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        session()->flash('message', 'Role Deleted Successfully.');

    }
}
