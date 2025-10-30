<?php

namespace App\Http\Controllers;

use App\Models\KategoriPengeluaran;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class KategoriPengeluaranController extends Controller
{
    public function index()
    {
        $kategori = KategoriPengeluaran::latest()->paginate(10);
        return view('keuangan.kategori', compact('kategori'));
    }

    public function create()
    {
        return view('keuangan.kategori.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_kategori' => 'required|string|max:50|unique:kategori_pengeluaran,nama_kategori',
            ], [
                'nama_kategori.unique' => 'Nama kategori sudah digunakan, silakan pilih nama lain.',
            ]);

            KategoriPengeluaran::create([
                'nama_kategori' => $request->nama_kategori,
            ]);

            return redirect()
                ->back()
                ->with('success', 'Kategori berhasil ditambahkan!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()
                ->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('modal', 'modalKategori');
        }
    }

    public function edit($id)
    {
        $kategori = KategoriPengeluaran::findOrFail($id);
        return view('keuangan.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $kategori = KategoriPengeluaran::findOrFail($id);

        try {
            $request->validate([
                'nama_kategori' => 'required|string|max:50|unique:kategori_pengeluaran,nama_kategori,' . $kategori->id_kategori . ',id_kategori',
            ], [
                'nama_kategori.unique' => 'Nama kategori sudah digunakan, silakan pilih nama lain.',
            ]);

            $kategori->update([
                'nama_kategori' => $request->nama_kategori,
            ]);

            return redirect()->route('keuangan.kategori.index')->with('success', 'Kategori berhasil diperbarui!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            session()->flash('modal', 'modalEditKategori-' . $id);
            throw $e;
        }
    }

    public function destroy($id)
    {
        $kategori = KategoriPengeluaran::findOrFail($id);

        $terpakai = Pengeluaran::where('id_kategori', $kategori->id_kategori)->exists();

        if ($terpakai) {
            return redirect()->route('keuangan.kategori.index')
                ->with('error', 'Kategori tidak dapat dihapus karena sudah digunakan dalam data pengeluaran!');
        }

        try {
            $kategori->delete();
            return redirect()->route('keuangan.kategori.index')->with('success', 'Kategori berhasil dihapus!');
        } catch (QueryException $e) {
            return redirect()->route('keuangan.kategori.index')->with('error', 'Terjadi kesalahan saat menghapus kategori.');
        }
    }
}