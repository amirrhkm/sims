<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AccountController extends Controller
{
    public function index()
    {
        $pengurus = User::where('role', 'pengurus')
        ->orderBy('name')
        ->paginate(10, ['*'], 'pengurus_page');

        $pemohon = User::where('role', 'pemohon')
            ->orderBy('name')
            ->paginate(10, ['*'], 'pemohon_page');

        return view('pengurus.pengguna-main', compact('pengurus', 'pemohon'));
    }

    public function create()
    {
        $users = User::all();
        return view('pengurus.pengguna-add', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:pemohon,pengurus',
            'position' => 'required|string|max:255',
            'grade' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
        ]);

        User::create($request->all());

        return redirect()->route('pengurus.pengguna')->with('success', 'Pengguna berjaya ditambah.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pengurus.pengguna-edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return redirect()->route('pengurus.pengguna')->with('success', 'Pengguna berjaya diubah.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('pengurus.pengguna')->with('success', 'Pengguna berjaya dihapuskan.');
    }
}
