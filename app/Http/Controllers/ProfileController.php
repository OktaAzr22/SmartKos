<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // 🔹 Menampilkan profil user yang sedang login
    public function index()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    // 🔹 Update data pribadi
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'nullable|string|max:100',
            'phone'      => 'nullable|string|max:20',
            'status'     => 'required|in:mahasiswa,pelajar,pekerja keras',
        ]);

        $user->update($request->only('first_name', 'last_name', 'phone', 'status'));

        return back()->with('success', 'Data pribadi berhasil diperbarui.');
    }

    // 🖼️ Update foto profil
    public function updateImage(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus foto lama jika ada
            if ($user->image && Storage::exists('public/' . $user->image)) {
                Storage::delete('public/' . $user->image);
            }

            // Simpan foto baru
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/profile_images', $imageName);

            // Simpan path ke database
            $user->image = 'profile_images/' . $imageName;
            $user->save();
        }

        return back()->with('success', 'Foto profil berhasil diperbarui.');
    }
}
