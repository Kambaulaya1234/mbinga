<?php
  
namespace App\Http\Livewire\expenses;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

  
use Livewire\Component;
use App\Models\Expense;
use App\Models\Department;
use App\Models\Category;
use App\Models\User;
use App\Models\Tag;
use Auth;
class Expenses extends Component
{
    public $expenses, $expense, $users, $name, $payment_type, $description,$categories, $category_id, $expense_id, $created_by;
    public $departments, $department_id, $expense_start_date, $expense_end_date, $paid_to, $paid_at, $approved_by, $approved_at;
    public $amount, $tags, $tag, $tagIds, $tagNames;
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
        $this->expenses = Expense::with('paid_to')->orderBy('id','desc')->get();
        $this->users = User::all();
        $this->categories = Category::all();
        $this->departments = Department::all();

        return view('livewire.expenses.expenses');
    }

        //FUNGSI INI AKAN DIPANGGIL KETIKA TOMBOL TAMBAH ANGGOTA DITEKAN
        public function create()
        {
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
            $this->description = '';
            $this->amount = '';
            $this->payment_type = '';
            $this->expense_start_date = '';
            $this->expense_end_date = '';
            $this->paid_to = '';
            $this->paid_at = '';
            $this->created_by = '';
            $this->approved_by = '';
            $this->approved_at = '';
            $this->category_id = '';
            $this->department_id = '';
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
        $validatedData = $this->validate([
            'name' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'payment_type' => 'required',
            'expense_start_date' => 'required',
            'expense_end_date' => 'required',
            'paid_to' => 'required',
            'paid_at' => 'required',
            'created_by' => 'required',
            'department_id' => 'required',
            'category_id' => 'required',
            ]);

       $expenses = Expense::updateOrCreate(['id' => $this->expense_id],[
            'name' => $this->name,
            'amount' => $this->amount,
            'description' => $this->description,
            'payment_type' => $this->payment_type,
            'expense_start_date' => $this->expense_start_date,
            'expense_end_date' => $this->expense_end_date,
            'paid_at' => $this->paid_at,
            'approved_at' => $this->approved_at,
            'category_id' => $this->category_id,
            'department_id' => $this->department_id,
        ]);

        if(!empty($this->paid_to))
        {
            if (isset($this->paid_to)) {        
                $expenses->paid_to()->sync($this->paid_to);  //If one or more user is selected associate expense to user          
            }        
            else {
                $expenses->paid_to()->detach(); //If no role is selected remove exisiting role associated to a user
            } 
        }

        if(!empty($this->created_by))
        {
            if (isset($this->created_by)) {        
                $expenses->created_by()->sync($this->created_by);  //If one or more user is selected associate expense to user          
            }        
            else {
                $expenses->created_by()->detach(); //If no role is selected remove exisiting role associated to a user
            } 
        }

        if(!empty($this->approved_by))
        {
            if (isset($this->approved_by)) {        
                $expenses->approved_by()->sync($this->approved_by);  //If one or more user is selected associate expense to user          
            }        
            else {
                $expenses->approved_by()->detach(); //If no role is selected remove exisiting role associated to a user
            } 
        }

        if($expenses)
        {        
            $this->tagNames = explode(',',$this->tags);
            $this->tagIds = [];
            foreach($this->tagNames as $tagName)
            {
            $this->tag = Tag::firstOrCreate(['name'=>$tagName]);
            if($this->tag)
             {
              $this->tagIds[] = $this->tag->id;
             }

            }
            
            $expenses->tags()->sync($this->tagIds);
            //$expenses->tags()->attach(['user_id' => Auth::User()->id]);
        }

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
        $this->expense_id = $id;
        $this->name = $expense->name;
        $this->amount = $expense->amount;
        $this->description = $expense->description;
        $this->payment_type = $expense->payment_type;
        $this->paid_at = $expense->paid_at;
        $this->approved_at = $expense->approved_at;
        $this->expense_start_date = $expense->expense_start_date;
        $this->expense_end_date = $expense->expense_end_date;
        $this->department_id = $expense->department_id;
        $this->category_id = $expense->category_id;
 
        //$this->updateMode = true;
        $expense -> paid_to()->detach($this->paid_to);
        $expense -> created_by()->detach($this->created_by);
        $expense -> approved_by()->detach($this->approved_by);
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
        Expense::find($id)->delete();
        session()->flash('message', 'expense Deleted Successfully.');
    }
}