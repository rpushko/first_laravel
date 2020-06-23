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
    Route::post('/', function (\Illuminate\Http\Request $request) {
    $validator=Validator::make($request->all(),[
        'name'=>'required|max:5',
    ]);

    if($validator->fails()){
        return redirect(route('tasks.create'))
            ->withInput()
            ->withErrors($validator);
    }
//    $task=new \App\Task();
//    $task->name=$request->name;
//    $task->save();
    \App\Task::create(['name'=>$request->name]);
    return redirect (route('tasks.list'));
    })->name('tasks.store');


    Route::delete('/{task}', function (\App\Task $task) {
        $task->delete();
        return redirect (route('tasks.list'));
    })->name('tasks.destroy');

//    Route::get('/edit', function () {
//        return redirect(route('tasks.edit'));
//    })->name('tasks.edit');
//
//    Route::put('/{task}', function (\App\Task $task){
//        $task->update();
//        return redirect (route('tasks.list'));
//    })->name('tasks.update');
Route::get('/{task}/edit',function (\App\Task $task){
    return view('tasks.edit',['task'=>$task]);
})->name('tasks.edit');

Route::put('/{task}',function (\Illuminate\Http\Request $request,\App\Task $task) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:5',
    ]);

    if ($validator->fails()) {
        return redirect(route('tasks.edit',$task->id))
            ->withInput()
            ->withErrors($validator);
    }

    $task->name = $request->name;
    $task->save();
    return redirect(route('tasks.list'));
})->name('tasks.update');
});

