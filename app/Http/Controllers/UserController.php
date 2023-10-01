<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'visible_password' => $request->password,
            'password' => Hash::make($request->password),
            'occupation' => $request->occupation,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        return redirect()->back()->with('message', 'User registered successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'occupation' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'visible_password' => $request->password,
            'password' => Hash::make($request->password),
            'occupation' => $request->occupation,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        return redirect()->route('user.index')->with('message', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::user()->id == $id) {
            return redirect()->route('user.index')->with('danger', 'You cannot delete yourself');
        }
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.index')->with('message', 'User deleted successfully!');
    }
}
