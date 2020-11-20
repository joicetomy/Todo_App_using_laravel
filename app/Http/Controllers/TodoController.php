<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class TodoController extends Controller
{
    public function home() {
       
        $todos=Todo::all();
        
        return view("home",['todos'=>$todos]);

    }

    public function store(Request $request) {

       $validatedData=$request->validate([
           'title'=>'required|max:124'
       ]);
       $todo=new Todo();
       $todo->title=$request->post('title');
       $todo->save();
       return redirect('/');
    }

    public function edit(Todo $todo) {
       
        
        return view('update',compact('todo'));

    }

    public function update(Request $request,Todo $todo) {
        $validatedData=$request->validate([
            'title'=>'required|max:124'
        ]);
        $todo->title=$validatedData['title'];
        $todo->save();
        return redirect(route('home'));

    }

    public function delete(Todo $todo) {
       
        $todo->delete();
        
        return redirect(route('home'));

    }

}
