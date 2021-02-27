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
    public $name,$permissions, $rolePermissions, $roles;
    //public $updateMode = false;
    public $permission = [];
    public $isModal = 0;

    public function render()
    {
        $this->roles = Role::orderBy('id','DESC')->get();
        $this->permission = Permission::get();
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
        //KEMUDIAN DI DALAMNYA KITA MENJALANKAN FUNGSI UNTUK MENGOSONGKAN FIELD
        $this->resetFields();
        //DAN MEMBUKA MODAL
        $this->openModal();
    }
    
        //FUNGSI INI UNTUK MENUTUP MODAL DIMANA VARIABLE ISMODAL KITA SET JADI FALSE
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
        //$permission = $this->permission;
            $validatedDate = $this->validate([
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        //$permissions = $this->permission;
    
        $role = Role::create(['name' => $this->name]);
        $role->syncPermissions($this->permission);

       session()->flash('message', $this->role_id ? $this->name . ' Role Created Successfuly': $this->name . 'Role Created Successfuly');
       $this->closeModal(); //TUTUP MODAL
       $this->resetFields();
    }

    public function edit($id)
    {
        $roles = Role::findOrFail($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        // dd($expense);
        $this->expense_id = $id;
        $this->date = $expense->date;

        $this->openModal(); 
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
    
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
    
        $role->syncPermissions($request->input('permission'));
    
        return redirect()->route('roles.index')
                        ->with('success','Role updated successfully');
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
        session()->flash('message', 'role Deleted Successfully.');
    }

}
