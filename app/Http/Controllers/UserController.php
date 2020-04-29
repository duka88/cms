<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserEditRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
       $users = User::paginate(15);

       return view('users.index')->with('users', $users);
    }

     public function create(){
      

       return view('users.create');
    }

    public function store(UserCreateRequest $request){
         
         $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request['password']),
            'role' => $request->role

         ]);

        session()->flash('success', 'User created successfully.');

        return redirect(route('users.index'));
      
    }

    public function destroy(User $user){
        
       

         $user->delete();

          session()->flash('success', 'User deleted successfully.');

        return redirect(route('users.index'));
    }
   
    public function edit(User $user)
    {
        return view('users.create')->with('user', $user);
    }

    public function update(UserEditRequest $request, User $user){
        
     
       $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request['password'])            

         ]);

       session()->flash('success', 'User updated successfully.');

        return redirect(route('users.index'));
    }

}
