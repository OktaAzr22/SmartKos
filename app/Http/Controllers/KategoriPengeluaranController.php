<?php

namespace App\Http\Controllers;

use App\Models\KategoriPengeluaran;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class KategoriPengeluaranController extends Controller
{
    /**
     * Tampilkan daftar kategori
     */
    public function index()
    {
        $kategori = KategoriPengeluaran::latest()->get();
        return view('kategori.index', compact('kategori'));
    }

    /**
     * Form tambah kategori
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Simpan kategori baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:50|unique:kategori_pengeluaran,nama_kategori',
        ], [
            'nama_kategori.unique' => 'Nama kategori sudah digunakan, silakan pilih nama lain.',
        ]);

        KategoriPengeluaran::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Form edit kategori
     */
    public function edit($id)
    {
        $kategori = KategoriPengeluaran::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * Update kategori
     */
    public function update(Request $request, $id)
    {
        $kategori = KategoriPengeluaran::findOrFail($id);

        $request->validate([
            'nama_kategori' => 'required|string|max:50|unique:kategori_pengeluaran,nama_kategori,' . $kategori->id_kategori . ',id_kategori',
        ], [
            'nama_kategori.unique' => 'Nama kategori sudah digunakan, silakan pilih nama lain.',
        ]);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Hapus kategori (dicegah jika sudah digunakan)
     */
    public function destroy($id)
    {
        $kategori = KategoriPengeluaran::findOrFail($id);

        // 🔒 Cek apakah kategori ini digunakan di tabel pengeluaran
        $terpakai = Pengeluaran::where('id_kategori', $kategori->id_kategori)->exists();

        if ($terpakai) {
            return redirect()->route('kategori.index')
                ->with('error', 'Kategori tidak dapat dihapus karena sudah digunakan dalam data pengeluaran!');
        }

        try {
            $kategori->delete();
            return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus!');
        } catch (QueryException $e) {
            return redirect()->route('kategori.index')->with('error', 'Terjadi kesalahan saat menghapus kategori.');
        }
    }
}
