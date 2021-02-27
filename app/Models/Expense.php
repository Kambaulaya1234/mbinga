<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = [
        'date', 'type','name','user_id','category_id','description',
    ];

    public function users(){
        return $this->belongsToMany(User::class, 'expense_user');
  
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
