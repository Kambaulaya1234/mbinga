<?php

namespace App\Http\Livewire\Roles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Livewire\Component;

class Roles extends Component
{
    // function __construct()
    // {
    //      $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
    //      $this->middleware('permission:role-create', ['only' => ['create','store']]);
    //      $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
    //      $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    // }
    public $name,$permissions, $rolePermissions, $roles, $role_id, $permission;
    //public $updateMode = false;
    public $permission_id = [];
    public $isModal = 0;

    public function render()
    {
        $this->roles = Role::orderBy('id','DESC')->get();
        $this->permissions = Permission::get();
        return view('livewire.roles.roles');
        
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $this->permissions = Permission::all();
        
        $this->resetFields();
        
        $this->openModal();
    }
    
        public function closeModal()
        {
            $this->isModal = false;
        }
    
        //FUNGSI INI DIGUNAKAN UNTUK MEMBUKA MODAL
        public function openModal()
        {
            $this->isModal = true;
        }

        public function resetFields()
        {
            $this->name = '';
            $this->permission = '';
        }

    public function store()
    {
        if(empty($this->role_id))
        {
            $this->validate([
                'name' => 'required|unique:roles,name',
                'permission_id' => 'required',
            ]);
        }

        $role = Role::updateOrCreate(['id' => $this->role_id],
            ['name' => $this->name]);

        $permissions = $this->permission_id;
    
        if(!empty($this->role_id))
        {  
            $p_all = Permission::all();//Get all permissions
    
            foreach ($p_all as $p) {
                $role->revokePermissionTo($p); //Remove all permissions associated with role
            }
    
            foreach ($permissions as $permission) {
                $p = Permission::where('id', '=', $permission)->firstOrFail(); //Get corresponding form //permission in db
                $role->givePermissionTo($p);  //Assign permission to role
            }

            session()->flash('message', $this->role_id ? $this->name . ' Role Updated Successfuly': $this->name . 'Role Updated Successfuly');
            $this->closeModal(); //TUTUP MODAL
            $this->resetFields();
        }

        if(empty($this->role_id))
        {
            //$role->syncPermissions($this->permission_id);
            foreach ($permissions as $permission) {
                $p = Permission::where('id', '=', $permission)->firstOrFail(); 
             //Fetch the newly created role and assign permission
                $role = Role::where('name', '=', $name)->first(); 
                $role->givePermissionTo($p);
            }
    
           session()->flash('message', $this->role_id ? $this->name . ' Role Created Successfuly': $this->name . 'Role Created Successfuly');
           $this->closeModal(); //TUTUP MODAL
           $this->resetFields();
        }
    }

    public function edit($id)
    {
        $roles = Role::findOrFail($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        $this->name = $roles->name; 
        $this->role_id = $id;

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
    public function delete($id)
    {
       // DB::table("roles")->where('id',$id)->delete();
        Role::find($id)->delete();
        session()->flash('message', 'Role Deleted Successfully.');
    }

}
