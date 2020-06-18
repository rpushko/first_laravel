<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix'=>'tasks'],function(){
    Route::get('/',function (){
        $tasks=\App\Task::all();//collection
        return view('tasks.index',['tasks'=>$tasks]);
    });
    Route::post('/',function (){
    });
    Route::delete('/{task}',function (){
    });
});
