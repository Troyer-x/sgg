<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); 

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.upsert');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/users')->with('error',  __('users.create_error'));
        }
        DB::commit();

        return redirect('/users')->with('success', __('users.create_success'));
    }

    public function edit(User $user)
    {
        return view('users.upsert', compact('user'));
    }

    public function update(Request $request, User $user)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'required|string',
        ]);
        DB::beginTransaction();
        try {
            $user->update($request->only(['name', 'email', 'password']));
    
            if ($request->filled('password')) {
                $user->update(['password' => bcrypt($request->password)]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/users')->with('error',  __('users.update_error'));
        }
        DB::commit();
    
        return redirect('/users')->with('success', __('users.update_success'));
    }

    public function destroy(User $user)
    {

        DB::beginTransaction();
        try {
            $user->departments()->detach();
            $user->delete();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/users')->with('error',  __('users.delete_error'));
        }
        DB::commit();

        return redirect('/users')->with('success', __('users.delete_success'));
    }
}
