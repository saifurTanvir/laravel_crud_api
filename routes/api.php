<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\new_user;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/registration', [AuthController::class, 'registration'])->name('registration');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:api')->group( function(){
    
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::post('/create', function(){
        $data = array(
            'user_firstname' => request()->firstname, 'user_lastname' => request()->lastname, 'user_condition'=> request()->condition
        );
        $success = new_user::create($data); 
        return response()->json($success);
    });
    
    Route::put('/update/{id}', function($id){
        $data = array(
            'user_firstname' => request()->firstname, 'user_lastname' => request()->lastname, 'user_condition'=> request()->condition
        );
        $success = new_user::where('user_id', $id)->update($data);
        return $success;
    });
    
    Route::delete('/delete/{id}', function($id){
        $success = new_user::where('user_id', $id)->delete();
        return $success;
    });
    
    
    Route::get('/users', function(){
        $users = new_user::all();
        return response()->json($users);
    });
    
});

