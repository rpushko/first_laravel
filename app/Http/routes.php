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
Route::group(['prefix' => 'tasks'], function () {
    Route::get('/', function () {
        $tasks = \App\Task::all();//collection
        return view('tasks.index', ['tasks' => $tasks]);
    })->name('tasks.list');


    Route::get('/create', function () {
        return view('tasks.create');
    })->name('tasks.create');
    Route::post('/', function () {
    })->name('tasks.store');
    Route::delete('/{task}', function () {
    })->name('tasks.destroy');
});
