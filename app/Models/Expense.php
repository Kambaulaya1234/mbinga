<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = [
        'expense_start_date', 'expense_end_date', 'amount', 'payment_type','name','created_by','category_id',
        'description','department_id','paid_to','paid_at', 'approved_at', 'is_approved',
    ];

    public function paid_to(){
        return $this->belongsToMany(User::class, 'expense_paid_to', 'expense_id', 'paid_to');
    }

    public function created_by(){
        return $this->belongsToMany(User::class, 'expense_created_by', 'expense_id', 'created_by');
    }

    public function approved_by(){
        return $this->belongsToMany(User::class, 'expense_approved_by', 'expense_id', 'approved_by'); 
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function tags(){
        return $this->belongsToMany( 'App\Models\Tag', 'expenses_users_tags', 'expense_id', 'tag_id');
      }
}
