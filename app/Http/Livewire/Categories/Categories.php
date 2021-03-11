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
        return view('livewire.categories.categories');
    }

        public function create()
        {
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
            // $this->amount = '';
        }

    public function store()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            // 'amount' => 'required',
        ]);

  
        Category::updateOrCreate(['id' => $this->category_id],[
            'name' => $this->name,
            // 'amount' => $this->amount,
        ]);

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
        // $this->amount = $category->amount;
  
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

    public function delete($id)
    {
        Category::find($id)->delete();
        session()->flash('message', 'category Deleted Successfully.');
    }
}