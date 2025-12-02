<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RoleUser;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('admin.user.index', compact('user'));
    }

    public function create()
    {
        // Kirim data role untuk dropdown pemilihan role (Admin, Resepsionis, Dokter, dsb)
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:200',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:6',
            'idrole' => 'required'
        ]);

        // Insert ke tabel user
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Insert ke tabel role_user
        RoleUser::create([
            'iduser' => $user->iduser,
            'idrole' => $request->idrole,
            'status' => 1,
        ]);

        return redirect()->route('admin.user.index')
                         ->with('success', 'User berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:200',
            'email' => 'required|email|unique:user,email,' . $id . ',iduser',
        ]);

        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        if ($request->idrole) {
            RoleUser::where('iduser', $id)->update([
                'idrole' => $request->idrole,
            ]);
        }

        return redirect()->route('admin.user.index')
                         ->with('success', 'User berhasil diperbarui!');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('admin.user.index')
                         ->with('success', 'User berhasil dihapus!');
    }
}
