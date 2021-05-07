<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Posts\Posts;
use App\Http\Livewire\Users\Users;
use App\Http\Livewire\Roles\Roles;
use App\Http\Livewire\Permissions\Permissions;
use App\Http\Livewire\Expenses\Expenses;
use App\Http\Livewire\Incomes\Incomes;
use App\Http\Livewire\Categories\Categories;
use App\Http\Livewire\Departments\Departments;
use App\Http\Livewire\ExpensesSummary\ExpensesSummary;

// use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => ['auth']], function() {
    Route::get('roles', Roles::class)->name('roles');
    Route::get('permissions', Permissions::class)->name('permissions');
    Route::get('posts', Posts::class)->name('posts'); 
    Route::get('users', Users::class)->name('users');
    Route::get('expenses', Expenses::class)->name('expenses'); 
    Route::get('incomes', Incomes::class)->name('incomes');  
    Route::get('categories', Categories::class)->name('categories');
    Route::get('departments', Departments::class)->name('departments');
    Route::get('expensesSummary', ExpensesSummary::class)->name('expensesSummary');
    Route::get('/getExpensesSummary', [ExpensesSummary::class, 'getExpensesSummary'])->name('getExpensesSummary');
    Route::get('/search-box', function () {
        return view('livewire.search.search'); 
});
});


// Route::get('/admin', function () {

//     $roles = Role::create(['name' => 'admin']);
//     $permissions = Permission::create(['name' => 'roles-show']);
//     $roles->givePermissionTo($permissions);
//     Auth::User()->assignRole($roles);
// });