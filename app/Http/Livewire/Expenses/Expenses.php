<?php
  
namespace App\Http\Livewire\expenses;

  
use Livewire\Component;
use App\Models\Expense;
use App\Models\Category;
use App\Models\User;
  
class Expenses extends Component
{
    public $expenses,$expense, $name, $date, $type, $description, $category_id, $expense_id, $user_ids;
   // public $updateMode = false;
   public $isModal = 0;
   public $user_id = [];
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function render()
    {
        $this->expenses = Expense::with('users')->orderBy('id','desc')->get();
        $expense = $this->expenses;

        $this->users = User::all();
        $users = $this->users;
        //dd($expense);

        $this->categories = Category::all();
        $categories = $this->categories;

        return view('livewire.expenses.expenses', compact('users', 'categories'));
    }

        //FUNGSI INI AKAN DIPANGGIL KETIKA TOMBOL TAMBAH ANGGOTA DITEKAN
        public function create()
        {
            $this->users = User::all();
            //dd($this->users);
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
            $this->date = '';
            $this->type = '';
            $this->user_id = '';
            $this->description = '';
            $this->category_id = '';
        }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
    {
        $validatedDate = $this->validate([
            'date' => 'required',
            'type' => 'required',
            'user_id' => 'required',
            'name' => 'required',
            'category_id' => 'required',
            'description' => 'required',
        ]);

        $user_ids = $this->user_id;

       $expenses = Expense::updateOrCreate(['id' => $this->expense_id],[
            'date' => $this->date,
            'type' => $this->type,
            // 'user_id' => $user_id,
            'name' => $this->name,
            'category_id' => $this->category_id,
            'description' => $this->description,
        ])->users()->attach($user_ids);


  
       // session()->flash('message', 'expense Created Successfully.');
  
       // $this->resetInputFields();

       session()->flash('message', $this->expense_id ? $this->name . ' Expenses Created Successfuly': $this->name . 'Expenses Created Successfuly');
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
        $expense = Expense::findOrFail($id);
        // dd($expense);
        $this->expense_id = $id;
        $this->date = $expense->date;
        $this->type = $expense->type;
        $this->user_id = $expense->user_id;
        $this->category_id = $expense->category_id;
        $this->name = $expense->name;
        $this->description = $expense->description;
  
        //$this->updateMode = true;
        $expense -> users()->detach($this->user_id);
       // dd($this->user_id);
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
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        Expense::find($id)->delete();
        session()->flash('message', 'expense Deleted Successfully.');
    }
}