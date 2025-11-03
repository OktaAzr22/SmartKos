<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function update(Request $request)
    {
        try {
        $user = Auth::user();

        $request->validate([
            'first_name' => 'required|string|max:100|min:2',
            'last_name'  => 'nullable|string|max:100',
            'phone'      => 'nullable|string|max:20',
            'status'     => 'required|in:mahasiswa,pelajar,pekerja keras',
        ]);

        $user->update($request->only('first_name', 'last_name', 'phone', 'status'));

        return redirect()
                ->back()
                ->with('success', 'Data pribadi berhasil diperbarui.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()
                ->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('modal', 'modalProfile');
        }
    }

    public function updateImage(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {

            if ($user->image && Storage::exists('public/' . $user->image)) {
                Storage::delete('public/' . $user->image);
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('profile_images', $imageName, 'public');

            $user->image = 'profile_images/' . $imageName;
            $user->save();
        }

        return back()->with('success', 'Foto profil berhasil diperbarui.');
    }
}