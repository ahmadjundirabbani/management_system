<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    // GET: Menampilkan semua data karyawan 
    public function index()
    {
        return response()->json(Karyawan::all(), 200);
    }

    // POST: Menambah karyawan baru 
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Nama' => 'required|string|max:150',
            'Tgl Lahir' => 'required|date',
            'Gaji' => 'required|numeric'
        ]);

        $karyawan = Karyawan::create($validated);
        return response()->json([
            'message' => 'Data berhasil ditambah',
            'data' => $karyawan
        ], 201);
    }

    // GET: Melihat detail satu karyawan 
    public function show($id)
    {
        $karyawan = Karyawan::find($id);
        if (!$karyawan) return response()->json(['message' => 'Data tidak ditemukan'], 404);
        return response()->json($karyawan, 200);
    }

    // PUT: Mengubah data karyawan 
    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::find($id);
        if (!$karyawan) return response()->json(['message' => 'Data tidak ditemukan'], 404);

        $karyawan->update($request->all());
        return response()->json([
            'message' => 'Data berhasil diubah',
            'data' => $karyawan
        ], 200);
    }

    // DELETE: Menghapus data karyawan 
    public function destroy($id)
    {
        $karyawan = Karyawan::find($id);
        if (!$karyawan) return response()->json(['message' => 'Data tidak ditemukan'], 404);

        $karyawan->delete();
        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
