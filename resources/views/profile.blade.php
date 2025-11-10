@extends('layouts.app')

@section('content')
    <x-breadcrumb />

    @if ($errors->any() && session('modal'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                showModal('{{ session('modal') }}');
            });
        </script>
    @endif

    <div class="space-y-6">
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="p-6 space-y-6">
                <div class="flex flex-col md:flex-row gap-8">
                    <div class="md:w-1/3">
                        <div class="relative profile-photo-container">
                            <div id="profile-image"
                                class="w-40 h-48 bg-gradient-to-r from-primary-500 to-primary-700 rounded-md flex items-center justify-center text-white text-4xl font-semibold mx-auto overflow-hidden">
                                @if($user->image)
                                    <img src="{{ asset('storage/' . $user->image) }}" alt="Profile"class="w-full h-full object-cover" alt="Profile">  
                                @else
                                    JD
                                @endif
                            </div>
                            <button id="open-image-modal"
                                class="absolute bottom-2 right-2 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-gray-50 transition">
                                <i class="fas fa-camera text-gray-600 text-sm"></i>
                            </button>
                        </div>
                        <div class="mt-4 text-center">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $user->full_name }}</h3>
                            @php
                                $statusColors = [
                                    'mahasiswa' => 'bg-blue-100 text-blue-800',
                                    'pelajar' => 'bg-green-100 text-green-800',
                                    'pekerja keras' => 'bg-yellow-100 text-yellow-800',
                                ];

                                $status = $user->status ?? 'Belum diatur';
                                $badgeColor = $statusColors[strtolower($status)] ?? 'bg-gray-100 text-gray-800';
                            @endphp

                            <span class="px-2.5 py-0.5 text-xs font-medium rounded-full {{ $badgeColor }}">
                                {{ ucfirst($status) }}
                            </span>
                        </div>
                    </div>

                    <div class="md:w-2/3">
                        <div class="relative bg-gray-50 rounded-xl border border-gray-100 p-6">
                            <button onclick="showModal('modalProfile')"
                                class="absolute top-4 right-4 flex items-center gap-2 px-4 py-1.5 text-sm font-medium text-blue-600 border border-gray-200 rounded-full hover:bg-blue-50 transition">
                                <i class="fas fa-edit"></i>
                                Edit
                            </button>
                            <h3 class="text-base font-semibold text-gray-800 mb-6">Personal Information</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-12 text-sm">
                                <div>
                                    <p class="text-gray-500 font-medium">First Name</p>
                                    <p class="mt-1 text-gray-900 font-semibold">{{ $user->first_name }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-500 font-medium">Last Name</p>
                                    <p class="mt-1 text-gray-900 font-semibold">{{ $user->last_name ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-500 font-medium">Email</p>
                                    <p class="mt-1 text-gray-900 font-semibold">{{ $user->email }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-500 font-medium">Phone</p>
                                    <p class="mt-1 text-gray-900 font-semibold">{{ $user->phone ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="profile-image-modal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="modal-content bg-white rounded-xl w-full max-w-md">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-800">Edit Profile Image</h3>
                    <button id="close-image-modal" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>

            <form action="{{ route('profile.updateImage') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="profile-photo" class="block text-sm font-medium text-gray-700 mb-2">Upload New Photo</label>
                    <input type="file" id="profile-photo" name="image" accept="image/*"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                    @error('image')
                        <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div id="image-preview-container" class="image-preview-container" style="display: none;">
                    <p class="text-sm font-medium text-gray-700 mb-2">Preview:</p>
                    <img id="image-preview" class="image-preview" src="" alt="Preview">
                    
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" id="cancel-image-btn"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-primary-500 border border-transparent rounded-lg hover:bg-primary-600 transition">
                        Save Image
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        /* Animasi untuk modal */
        .modal {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .modal.show {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            transform: scale(0.9);
            transition: transform 0.3s ease;
        }

        .modal.show .modal-content {
            transform: scale(1);
        }

        /* Style untuk preview gambar */
        .image-preview-container {
            display: none;
            margin-top: 1rem;
        }

        .image-preview {
            max-width: 100%;
            max-height: 200px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>

    <script>
        const modal = document.getElementById('profile-image-modal');
        const openBtn = document.getElementById('open-image-modal');
        const closeBtn = document.getElementById('close-image-modal');
        const cancelBtn = document.getElementById('cancel-image-btn');
        const fileInput = document.getElementById('profile-photo');
        const previewContainer = document.getElementById('image-preview-container');
        const previewImage = document.getElementById('image-preview');

        openBtn.addEventListener('click', () => modal.classList.add('show'));

        closeBtn.addEventListener('click', () => modal.classList.remove('show'));
        cancelBtn.addEventListener('click', () => modal.classList.remove('show'));

        fileInput.addEventListener('change', (e) => {
            const [file] = e.target.files;
            if (file) {
                previewContainer.style.display = 'block';
                previewImage.src = URL.createObjectURL(file);
            } else {
                previewContainer.style.display = 'none';
            }
        });
    </script>

    <x-animated-modal id="modalProfile" title="Edit Personal Information" size="max-w-lg">
        <form action="{{ route('profile.update') }}" method="POST" id="formProfile">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">
                        First Name
                    </label>
                    <input
                        type="text"
                        name="first_name"
                        id="first_name"
                        value="{{ old('first_name', $user->first_name ?? '') }}"
                        required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan nama depan">
                    @error('first_name')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">
                        Last Name
                    </label>
                    <input
                        type="text"
                        name="last_name"
                        id="last_name"
                        value="{{ old('last_name', $user->last_name ?? '') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan nama belakang">
                    @error('last_name')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                        Phone
                    </label>
                    <input
                        type="text"
                        name="phone"
                        id="phone"
                        value="{{ old('phone', $user->phone ?? '') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan nomor telepon">
                    @error('phone')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                        Status
                    </label>
                    <select
                        name="status"
                        id="status"
                        required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih status</option>
                        <option value="mahasiswa" {{ old('status', $user->status ?? '') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                        <option value="pelajar" {{ old('status', $user->status ?? '') == 'pelajar' ? 'selected' : '' }}>Pelajar</option>
                        <option value="pekerja keras" {{ old('status', $user->status ?? '') == 'pekerja keras' ? 'selected' : '' }}>Pekerja Keras</option>
                    </select>
                    @error('status')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <hr class="my-6 border-gray-200">
            <div class="flex justify-end space-x-3">
                <button type="button"
                        onclick="hideModal('modalProfile')"
                        class="px-4 py-2 text-gray-600 hover:text-gray-800 font-medium rounded-lg border border-gray-300">
                    Cancel
                </button>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all transform hover:scale-105">
                    Save Changes
                </button>
            </div>
        </form>
    </x-animated-modal>
@endsection
<!-- Preferences -->
{{-- <div class="space-y-6 mt-8">
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="relative p-6 space-y-6 bg-gray-50 rounded-xl border border-gray-100">
            <button class="absolute top-4 right-4 flex items-center gap-2 px-4 py-1.5 text-sm font-medium text-blue-600 border border-gray-200 rounded-full hover:bg-blue-50 transition">
                <i class="fas fa-edit"></i> Edit
            </button>

            <h3 class="text-base font-semibold text-gray-800 mb-6">Preferences</h3>

            <div class="space-y-6 text-sm">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-medium text-gray-900">Email Notifications</p>
                        <p class="text-xs text-gray-500">Receive email notifications for important updates</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-500"></div>
                    </label>
                </div>

                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-medium text-gray-900">Push Notifications</p>
                        <p class="text-xs text-gray-500">Receive push notifications on your device</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-500"></div>
                    </label>
                </div>

                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-medium text-gray-900">Dark Mode</p>
                        <p class="text-xs text-gray-500">Switch to dark mode for better visibility</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-500"></div>
                    </label>
                </div>

                <div class="pt-4 border-t border-gray-200">
                    <p class="font-medium text-gray-900 mb-2">Language</p>
                    <select class="w-full p-2 border border-gray-300 rounded-lg bg-white text-sm">
                        <option selected>English</option>
                        <option>Indonesian</option>
                        <option>Spanish</option>
                        <option>French</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div> --}}