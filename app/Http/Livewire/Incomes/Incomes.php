<?php
  
namespace App\Http\Livewire\Incomes;

  
use Livewire\Component;
use App\Models\Income;
use App\Models\User;
  
class Incomes extends Component
{
    public $incomes, $name, $income_id, $amount, $user_id, $date, $type, $description;
   // public $updateMode = false;
   public $isModal = 0;
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function render()
    {
        $this->incomes = Income::all();
        $this->users = User::all();
        $users = $this->users;
        //dd($this->incomes);
        return view('livewire.incomes.incomes', compact('users'));
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
            $this->user_id = '';
            $this->amount = '';
            $this->date = '';
            $this->type = '';
            $this->description = '';
        }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields(){
        $this->user_id = '';
        $this->amount = '';
        $this->date = '';
        $this->type = '';
        $this->description = '';
    }
   
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
            'amount' => 'required',
            'description' => 'required',
        ]);
  
        Income::updateOrCreate(['id' => $this->income_id],[
            'date' => $this->date,
            'type' => $this->type,
            'user_id' => $this->user_id,
            'amount' => $this->amount,
            'description' => $this->description,
        ]);
  
       // session()->flash('message', 'expense Created Successfully.');
  
       // $this->resetInputFields();

       session()->flash('message', $this->income_id ? $this->name . ' Income Created Successfuly': $this->name . 'Income Created Successfuly');
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
        $income = Income::findOrFail($id);
        $this->income_id = $id;
        $this->date = $income->date;
        $this->type = $income->type;
        $this->user_id = $income->user_id;
        $this->amount = $income->amount;
        $this->description = $income->description;
  
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
    //         'date' => 'required',
    //         'type' => 'required',
    //         'user_id' => 'required',
    //         'amount' => 'required',
    //         'description' => 'required',
    //     ]);
  
    //     $income = Income::find($this->income_id);
    //     $income->update([
    //         'date' => $this->date,
    //         'type' => $this->type,
    //         'user_id' => $this->user_id,
    //         'amount' => $this->amount,
    //         'description' => $this->description,
    //     ]);
  
    //     $this->updateMode = false;
  
    //     session()->flash('message', 'income Updated Successfully.');
    //     $this->resetInputFields();
    // }
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        Income::find($id)->delete();
        session()->flash('message', 'income Deleted Successfully.');
    }
}