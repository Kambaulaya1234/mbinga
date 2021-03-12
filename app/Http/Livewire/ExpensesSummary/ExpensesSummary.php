<?php

namespace App\Http\Livewire\ExpensesSummary;

use Livewire\Component;

use Livewire\WithPagination;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Category;
use App\Models\Expenses;
use App\Models\User;
use Carbon\Carbon;

class ExpensesSummary extends Component
{
    use WithPagination;
    public $searchTerm, $start_date, $end_date, $users, $paid_to, $paid_to1;
    public $expenses, $expense, $incomes, $categories, $totalExpenses1, $totalExpenses;
    public $totalIncome1, $totalIncome, $expenses_users, $total_users;
    
    public function render()
    {
        $this->getExpensesSummary();
         $expenses = $this->expenses;
         $totalExpenses = $this->totalExpenses;
         $totalIncome = $this->totalIncome;

        return view('livewire.expenses-summary.expenses-summary');
    }

    public function getExpensesSummary(){
        $this->resetFilters();
        $start_date = Carbon::parse($this->start_date)
        ->toDateTimeString();
        $end_date = Carbon::parse($this->end_date)
        ->toDateTimeString();
        if($end_date){
            $this->expenses = Expense::whereBetween('created_at',[$start_date,$end_date])->get();
            $this->incomes = Income::whereBetween('created_at',[$start_date,$end_date])->get();

        if(count($this->expenses) > 0){

            $this->totalExpenses = 0;

                foreach($this->expenses as $row){
                    $this->totalExpenses1 = 0;
                    $this->expenses_paid_to1 = 0;
                    $this->expenses_paid_to = [];
                    $this->totalExpenses1 = $row->amount;
                    
                    foreach($row->paid_to as $row){
                        array_push($this->expenses_paid_to, $row->name);
                    }
                    $this->total_paid_to1 = count($this->expenses_paid_to);
                    $this->totalExpenses1 = $this->total_paid_to1 * $this->totalExpenses1;
                    $this->totalExpenses = $this->totalExpenses + $this->totalExpenses1;
                 }
               //dd($this->totalExpenses);

            //     foreach($this->expenses as $row){
            //         $this->totalExpenses1 = 0;
            //         $this->expenses_users1 = 0;
            //         $this->expenses_users = [];
            //         $this->totalExpenses1 = $row->category->amount;
                    
            //         foreach($row->users as $row){
            //             array_push($this->expenses_users, $row->name);
            //         }
            //         $this->total_users1 = count($this->expenses_users);
            //         $this->totalExpenses1 = $this->total_users1 * $this->totalExpenses1;
            //         $this->totalExpenses = $this->totalExpenses + $this->totalExpenses1;
            //      }
            //    dd($this->total_users1);
        }

            $this->totalIncome1 = [];
            foreach($this->incomes as $row){
                $this->totalIncome1 = $row->amount;
                $this->totalIncome = $this->totalIncome + $this->totalIncome1;
            }
        }

        }

        public function resetFilters(){
                $this->reset(['totalExpenses','totalIncome']);
                // Will reset both the totalExpenses AND the totalIncome property.
          }
    }