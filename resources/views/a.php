@extends('layouts.app')

@section('content')
<x-breadcrumb />

<div class="space-y-6">
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="p-6 space-y-6">
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Foto Profil -->
                <div class="md:w-1/3">
                    <div class="relative profile-photo-container">
                        @if (Auth::user()->image)
                            <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                 alt="Foto Profil"
                                 class="w-40 h-48 object-cover rounded-md mx-auto shadow-md">
                        @else
                            <div class="w-40 h-48 bg-gradient-to-r from-blue-500 to-blue-700 rounded-md flex items-center justify-center text-white text-4xl font-semibold mx-auto">
                                {{ strtoupper(substr(Auth::user()->first_name ?? '?', 0, 1)) }}
                            </div>
                        @endif
                    </div>

                    <div class="mt-4 text-center">
                        <h3 class="text-lg font-semibold text-gray-800">
                            {{ Auth::user()->first_name . ' ' . Auth::user()->last_name ?? 'Tidak diketahui' }}
                        </h3>
                        <p class="text-sm text-gray-600 capitalize">
                            {{ Auth::user()->status ?? '-' }}
                        </p>
                    </div>
                </div>

                <!-- Informasi Pribadi -->
                <div class="md:w-2/3">
                    <div class="relative bg-gray-50 rounded-xl border border-gray-100 p-6">
                        <a href="{{ route('profile') }}"
                           class="absolute top-4 right-4 flex items-center gap-2 px-4 py-1.5 text-sm font-medium text-blue-600 border border-gray-200 rounded-full hover:bg-blue-50 transition">
                            <i class="fas fa-edit"></i>
                            Edit
                        </a>

                        <h3 class="text-base font-semibold text-gray-800 mb-6">Personal Information</h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-12 text-sm">
                            <div>
                                <p class="text-gray-500 font-medium">First Name</p>
                                <p class="mt-1 text-gray-900 font-semibold">
                                    {{ Auth::user()->first_name ?? 'Tidak diketahui' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-gray-500 font-medium">Last Name</p>
                                <p class="mt-1 text-gray-900 font-semibold">
                                    {{ Auth::user()->last_name ?? '-' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-gray-500 font-medium">Email Address</p>
                                <p class="mt-1 text-gray-900 font-semibold">
                                    {{ Auth::user()->email ?? 'Tidak diketahui' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-gray-500 font-medium">Phone</p>
                                <p class="mt-1 text-gray-900 font-semibold">
                                    {{ Auth::user()->phone ?? '-' }}
                                </p>
                            </div>

                            <div class="sm:col-span-2">
                                <p class="text-gray-500 font-medium">Status</p>
                                <p class="mt-1 text-gray-900 font-semibold capitalize">
                                    {{ Auth::user()->status ?? '-' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="max-w-3xl mx-auto mt-10 bg-white rounded-xl shadow p-6">
    <h2 class="text-2xl font-semibold mb-6">Edit Profil</h2>

    @if (session('success'))
        <div class="mb-4 p-3 text-green-700 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">First Name</label>
                <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}"
                    class="w-full border-gray-300 rounded-lg" required>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Last Name</label>
                <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}"
                    class="w-full border-gray-300 rounded-lg">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                class="w-full border-gray-300 rounded-lg" required>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Phone</label>
            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                class="w-full border-gray-300 rounded-lg">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Status</label>
            <select name="status" class="w-full border-gray-300 rounded-lg">
                <option value="mahasiswa" {{ $user->status == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                <option value="pelajar" {{ $user->status == 'pelajar' ? 'selected' : '' }}>Pelajar</option>
                <option value="pekerja keras" {{ $user->status == 'pekerja keras' ? 'selected' : '' }}>Pekerja Keras</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Foto Profil</label>
            <input type="file" name="image" class="w-full border-gray-300 rounded-lg">
            @if ($user->image)
                <img src="{{ asset('storage/' . $user->image) }}" alt="Profile Image" class="w-24 h-24 mt-2 rounded-full object-cover">
            @endif
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Password Baru (Opsional)</label>
            <input type="password" name="password" class="w-full border-gray-300 rounded-lg">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="w-full border-gray-300 rounded-lg">
        </div>

        <div class="pt-4">
            <button type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

{{-- section page 2 --}}
                        {{-- <div class="p-6">
                            <div class="relative bg-gray-50 rounded-xl border border-gray-100 p-6">
                                <button class="absolute top-4 right-4 flex items-center gap-2 px-4 py-1.5 text-sm font-medium text-blue-600 border border-gray-200 rounded-full hover:bg-blue-50 transition">
                                    <i class="fas fa-edit"></i>
                                    Edit
                                </button>

                                <h3 class="text-base font-semibold text-gray-800 mb-6">Address</h3>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-12 text-sm">
                                    <div>
                                        <p class="text-gray-500 font-medium">Country</p>
                                        <p class="mt-1 text-gray-900 font-semibold">Indonesia</p>
                                    </div>

                                    <div>
                                        <p class="text-gray-500 font-medium">City / State</p>
                                        <p class="mt-1 text-gray-900 font-semibold">Phoenix, United States</p>
                                    </div>

                                    <div>
                                        <p class="text-gray-500 font-medium">Email Address</p>
                                        <p class="mt-1 text-gray-900 font-semibold">randomuser@pimjo.com</p>
                                    </div>

                                    <div>
                                        <p class="text-gray-500 font-medium">Tax ID</p>
                                        <p class="mt-1 text-gray-900 font-semibold">AS4568384</p>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <p class="text-gray-500 font-medium">Postal Code</p>
                                        <p class="mt-1 text-gray-900 font-semibold">45132</p>
                                    </div>
                                    
                                    <div class="sm:col-span-2">
                                        <p class="text-gray-500 font-medium">Full Address</p>
                                        <p class="mt-1 text-gray-900 font-semibold">123 Main Street, Phoenix, AZ 45132, United States</p>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        {{-- section page 3 --}}
                        {{-- <div class="p-6">
                            <div class="relative bg-gray-50 rounded-xl border border-gray-100 p-6">
                                <button class="absolute top-4 right-4 flex items-center gap-2 px-4 py-1.5 text-sm font-medium text-blue-600 border border-gray-200 rounded-full hover:bg-blue-50 transition">
                                    <i class="fas fa-edit"></i>
                                    Edit
                                </button>

                                <h3 class="text-base font-semibold text-gray-800 mb-6">Preferences</h3>

                                <div class="space-y-6">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">Email Notifications</p>
                                            <p class="text-xs text-gray-500">Receive email notifications for important updates</p>
                                        </div>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer" checked>
                                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-500"></div>
                                        </label>
                                    </div>
                                    
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">Push Notifications</p>
                                            <p class="text-xs text-gray-500">Receive push notifications on your device</p>
                                        </div>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer" checked>
                                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-500"></div>
                                        </label>
                                    </div>
                                    
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">Dark Mode</p>
                                            <p class="text-xs text-gray-500">Switch to dark mode for better visibility</p>
                                        </div>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer">
                                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-500"></div>
                                        </label>
                                    </div>
                                    
                                    <div class="pt-4 border-t border-gray-200">
                                        <p class="text-sm font-medium text-gray-900 mb-2">Language</p>
                                        <select class="w-full p-2 border border-gray-300 rounded-lg bg-white text-sm">
                                            <option selected>English</option>
                                            <option>Indonesian</option>
                                            <option>Spanish</option>
                                            <option>French</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div> --}}