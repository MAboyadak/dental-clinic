<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function all()
    {
        $users = User::all();
        return view('users.all',compact('users'));
    }
    public function create()
    {
        return view('users.create');
    }
    public function store(Request $request)
    {   
        $request->validate([
            'name' => 'required|unique:users',
            'password' => 'required',
            'isAdmin' => 'nullable',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->password = $request->input('password');
        if(empty ($request->input('isAdmin') ) )
        {
            $user->is_admin =0;
        }else{
            $user->is_admin = $request->input('isAdmin');
        }
        $user->save();
        return redirect()->route('users')->with('success', 'تمت الاضافة بنجاح');
    }
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users')->with('success', 'تم المسح بنجاح');
    }
}
