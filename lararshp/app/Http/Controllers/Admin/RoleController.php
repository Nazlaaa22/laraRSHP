<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    // ================================
    // 1. TAMPILKAN LIST ROLE
    // ================================
    public function index()
    {
        $role = Role::all();   // ambil semua data
        return view('admin.role.index', compact('role'));
    }

    // ================================
    // 2. FORM TAMBAH
    // ================================
    public function create()
    {
        return view('admin.role.create');
    }

    // ================================
    // 3. SIMPAN ROLE BARU
    // ================================
    public function store(Request $request)
    {
        $request->validate([
            'nama_role' => 'required|string|max:100|unique:role,nama_role',
        ]);

        Role::create([
            'nama_role' => $request->nama_role,
        ]);

        return redirect()->route('admin.role.index')
            ->with('success', 'Role berhasil ditambahkan!');
    }

    // ================================
    // 4. FORM EDIT
    // ================================
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.role.edit', compact('role'));
    }

    // ================================
    // 5. UPDATE ROLE
    // ================================
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $request->validate([
            'nama_role' => 'required|string|max:100|unique:role,nama_role,' . $id . ',idrole',
        ]);

        $role->update([
            'nama_role' => $request->nama_role,
        ]);

        return redirect()->route('admin.role.index')
            ->with('success', 'Role berhasil diperbarui!');
    }

    // ================================
    // 6. HAPUS ROLE
    // ================================
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('admin.role.index')
            ->with('success', 'Role berhasil dihapus!');
    }
}
