<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

use App\Mpdels\Expense;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use HasRoles;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function paid_to()
    {
    	return $this->belongsToMany(Expense::class, 'expense_paid_to', 'expense_id');
    }

    public function created_by()
    {
    	return $this->belongsToMany(Expense::class, 'expense_created_by', 'expense_id' );
    }

    public function approved_by()
    {
    	return $this->belongsToMany(Expense::class, 'expense_approved_by', 'expense_id');
    }
    
    public function income(){
        return $this->hasOne(User::class);
  
    }

    public function department(){
        return $this->hasOne(Department::class);
  
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
