<?php

use App\Http\Requests\TaskRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Models\Task;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/',function(){
    return Redirect()->route('tasks.index');
});

Route::get('/tasks', function ()  {
    return view('index',[
        'tasks'=>Task::latest()->paginate(10)
    ]);
})->name('tasks.index');

Route::view('/tasks/create', 'create')->name('tasks.create');

Route::post('/tasks', function (TaskRequest $request) {
    $task = Task::create($request->validated());
    return redirect()->route('tasks.show',['task'=>$task->id])
    ->with('success', 'The task added successfully');
})->name('tasks.store');

Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
    $task->update($request->validated());
    return redirect()->route('tasks.show',['task'=>$task->id])
    ->with('success', 'The task updated successfully');
})->name('tasks.update');

Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('edit',['task' => $task]);
})->name('tasks.edit');

Route::get('/tasks/{task}', function (Task $task) {
    return view('show',['task' => $task]);
})->name('tasks.show');

Route::delete('/tasks/{task}', function (Task $task){
    $task->delete();

    return redirect()->route('tasks.index')->with('success', 'The task deleted successfully');
})->name('tasks.destroy');

Route::put('/tasks/{task}/status-complate', function (Task $task) {
    $task->Status_complete();

    return redirect()->back()->with('success', 'The task updated successfully');
})->name('tasks.comleted');