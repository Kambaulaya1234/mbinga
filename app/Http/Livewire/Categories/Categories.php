<?php
  
namespace App\Http\Livewire\Categories;

  
use Livewire\Component;
use App\Models\Category;
  
class Categories extends Component
{
    public $categories, $category_id, $name, $amount;
   // public $updateMode = false;
   public $isModal = 0;
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function render()
    {
        $this->categories = Category::all();
        //dd($this->categories);
        return view('livewire.categories.categories');
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
            $this->amount = '';
        }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields(){
        $this->name = '';
        $this->amount = '';
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
            'amount' => 'required',
        ]);
  
        Category::updateOrCreate(['id' => $this->category_id],[
            'name' => $this->name,
            'amount' => $this->amount,
        ]);
  
       // session()->flash('message', 'expense Created Successfully.');
  
       // $this->resetInputFields();

       session()->flash('message', $this->category_id ? $this->name . ' Category Created Successfuly': $this->name . 'Category Created Successfuly');
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
        $category = Category::findOrFail($id);
        $this->category_id = $id;
        $this->name = $category->name;
        $this->amount = $category->amount;
  
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
    //         'amount' => 'required',
    //     ]);
  
    //     $category = Category::find($this->category_id);
    //     $category->update([
    //         'name' => $this->name,
    //         'amount' => $this->amount,
    //     ]);
  
    //     $this->updateMode = false;
  
    //     session()->flash('message', 'category Updated Successfully.');
    //     $this->resetInputFields();
    // }
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        Category::find($id)->delete();
        session()->flash('message', 'category Deleted Successfully.');
    }
}