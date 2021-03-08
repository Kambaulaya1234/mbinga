<?php
  
namespace App\Http\Livewire\Departments;

  
use Livewire\Component;
use App\Models\Department;
  
class Departments extends Component
{
    public  $departments, $department_id, $name;
   // public $updateMode = false;
   public $isModal = 0;
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function render()
    {
        $this->departments = Department::all();
        //dd($this->departments);
        return view('livewire.departments.departments');
    }

        //FUNGSI INI AKAN DIPANGGIL KETIKA TOMBOL TAMBAH ANGGOTA DITEKAN
        public function create()
        {
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
        }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields(){
        $this->name = '';
    }
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
    {
        $validatedDate = $this->validate([
            'name' => 'required',
        ]);
  
        Department::updateOrCreate(['id' => $this->department_id],[
            'name' => $this->name, 
        ]);
  
       // session()->flash('message', 'expense Created Successfully.');
  
       // $this->resetInputFields();

       session()->flash('message', $this->department_id ? $this->name . ' Departiment Created Successfuly': $this->name . ' Departiment Created Successfuly');
       $this->closeModal(); //TUTUP MODAL
       $this->resetFields();
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        $department = Department::findOrFail($id);
        $this->department_id = $id;
        $this->name = $department->name;
  
        //$this->updateMode = true;
        $this->openModal(); 
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // public function update()
    // {
    //     $validatedDate = $this->validate([
    //         'name' => 'required',
    //     ]);
  
    //     $department = Department::find($this->department_id);
    //     $department->update([
    //         'name' => $this->input,
    //     ]);
  
    //     $this->updateMode = false;
  
    //     session()->flash('message', 'department Updated Successfully.');
    //     $this->resetInputFields();
    // }
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        Department::find($id)->delete();
        session()->flash('message', 'department Deleted Successfully.');
    }
}