<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'user'], function(){
    Route::get('/user',function(){
        global $users;
        return $users;
    });   
    Route::get('/user/{id}', function($id) {
        global $users;
        if(isset($users[$id])){
            return $users[$id];
        } else {
            return 'Cannot find this user, display an error index  '. $id;
        }
    })->where(['id'=> '[0-9]+']);
    Route::get('/user/{userName}',function($userName){
        global $users;
            foreach($users as $user){
                if($user['name'] == $userName){
                    return $user;
                }
            }   
            return 'Cannot find the user with name '. $userName;
    })->where(['userName'=> '[a-zA-Z]+']);
    Route::fallback(function(){
        return 'You cannot get like this !';
    });
});
Route::get('/user/{userIndex}/post/{postIndex}',function($userIndex,$postIndex){
    global $users;
    if(isset($users[$userIndex])){
        return $users[$userIndex]['posts'][$postIndex];
    }
});
