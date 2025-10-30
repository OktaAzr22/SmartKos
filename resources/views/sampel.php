@extends('layouts.app')

@section('content')
<x-breadcrumb />
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
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
</style>

                <div class="space-y-6">
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                        <div class="p-6 space-y-6">
                            <div class="flex flex-col md:flex-row gap-8">
                                <!-- Profile Photo Section -->
                                <div class="md:w-1/3">
                                    <div class="relative profile-photo-container">
                                        <div id="profile-image" class="w-40 h-48 bg-gradient-to-r from-primary-500 to-primary-700 rounded-md flex items-center justify-center text-white text-4xl font-semibold mx-auto">
                                            JD
                                        </div>
                                        <button id="edit-profile-image-btn" class="absolute bottom-2 right-2 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-gray-50 transition">
                                            <i class="fas fa-camera text-gray-600 text-sm"></i>
                                        </button>
                                    </div>
                                    <div class="mt-4 text-center">
                                        <h3 class="text-lg font-semibold text-gray-800">John Doe</h3>
                                        <p class="text-sm text-gray-900">Team Manager</p>
                                    </div>
                                </div>
                                
                                <!-- Personal Information -->
                                <div class="md:w-2/3">
                                    <div class="relative bg-gray-50 rounded-xl border border-gray-100 p-6">
                                        <!-- Tombol Edit -->
                                        <button id="edit-personal-info-btn" class="absolute top-4 right-4 flex items-center gap-2 px-4 py-1.5 text-sm font-medium text-blue-600 border border-gray-200 rounded-full hover:bg-blue-50 transition">
                                            <i class="fas fa-edit"></i>
                                            Edit
                                        </button>

                                        <!-- Header -->
                                        <h3 class="text-base font-semibold text-gray-800 mb-6">Personal Information</h3>

                                        <!-- Info Grid -->
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-12 text-sm">
                                            <div>
                                                <p class="text-gray-500 font-medium">First Name</p>
                                                <p class="mt-1 text-gray-900 font-semibold" id="first-name-display">Musharof</p>
                                            </div>

                                            <div>
                                                <p class="text-gray-500 font-medium">Last Name</p>
                                                <p class="mt-1 text-gray-900 font-semibold" id="last-name-display">Chowdhury</p>
                                            </div>

                                            <div>
                                                <p class="text-gray-500 font-medium">Email Address</p>
                                                <p class="mt-1 text-gray-900 font-semibold" id="email-display">randomuser@pimjo.com</p>
                                            </div>

                                            <div>
                                                <p class="text-gray-500 font-medium">Phone</p>
                                                <p class="mt-1 text-gray-900 font-semibold" id="phone-display">+09 363 398 46</p>
                                            </div>

                                            <div class="sm:col-span-2">
                                                <p class="text-gray-500 font-medium">Status</p>
                                                <p class="mt-1 text-gray-900 font-semibold" id="bio-display">Mahasiswa</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal untuk Edit Personal Information -->
                <div id="personal-info-modal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
                    <div class="modal-content bg-white rounded-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
                        <div class="p-6 border-b border-gray-200">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold text-gray-800">Edit Personal Information</h3>
                                <button id="close-modal" class="text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-times text-xl"></i>
                                </button>
                            </div>
                        </div>
                        
                        <form id="personal-info-form" class="p-6 space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="first-name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                                    <input type="text" id="first-name" name="first-name" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                        value="Musharof">
                                </div>
                                
                                <div>
                                    <label for="last-name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                                    <input type="text" id="last-name" name="last-name" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                        value="Chowdhury">
                                </div>
                                
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                    <input type="email" id="email" name="email" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                        value="randomuser@pimjo.com">
                                </div>
                                
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                    <input type="text" id="phone" name="phone" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                        value="+09 363 398 46">
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                    
                                </div>
                            </div>
                            
                            <div class="flex justify-end space-x-3 pt-4">
                                <button type="button" id="cancel-btn" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                                    Cancel
                                </button>
                                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-primary-500 border border-transparent rounded-lg hover:bg-primary-600 transition">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Modal untuk Edit Profile Image -->
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
                        
                        <form id="profile-image-form" class="p-6 space-y-6">
                            <div>
                                <label for="profile-photo" class="block text-sm font-medium text-gray-700 mb-2">Upload New Photo</label>
                                <input type="file" id="profile-photo" name="profile-photo" 
                                    accept="image/*" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                            </div>
                            
                            <div id="image-preview-container" class="image-preview-container">
                                <p class="text-sm font-medium text-gray-700 mb-2">Preview:</p>
                                <img id="image-preview" class="image-preview" src="" alt="Preview">
                            </div>
                            
                            <div class="flex justify-end space-x-3 pt-4">
                                <button type="button" id="cancel-image-btn" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                                    Cancel
                                </button>
                                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-primary-500 border border-transparent rounded-lg hover:bg-primary-600 transition">
                                    Save Image
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <script>
// === Modal Edit Personal Information ===
const editPersonalInfoBtn = document.getElementById('edit-personal-info-btn');
const personalInfoModal = document.getElementById('personal-info-modal');
const closeModalBtn = document.getElementById('close-modal');
const cancelBtn = document.getElementById('cancel-btn');

// Buka modal personal info
editPersonalInfoBtn.addEventListener('click', () => {
    personalInfoModal.classList.add('show');
});

// Tutup modal personal info
const closePersonalModal = () => {
    personalInfoModal.classList.remove('show');
};
closeModalBtn.addEventListener('click', closePersonalModal);
cancelBtn.addEventListener('click', closePersonalModal);

// Submit form personal info
document.getElementById('personal-info-form').addEventListener('submit', function(e) {
    e.preventDefault();

    // Ambil data dari input
    const firstName = document.getElementById('first-name').value;
    const lastName = document.getElementById('last-name').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    const bio = document.getElementById('bio').value;

    // Update tampilan data di profil
    document.getElementById('first-name-display').innerText = firstName;
    document.getElementById('last-name-display').innerText = lastName;
    document.getElementById('email-display').innerText = email;
    document.getElementById('phone-display').innerText = phone;
    document.getElementById('bio-display').innerText = bio;

    // Tutup modal
    closePersonalModal();

    // (Opsional) Jika ingin kirim ke backend:
    // fetch('/update-profile', {
    //     method: 'POST',
    //     headers: {
    //         'Content-Type': 'application/json',
    //         'X-CSRF-TOKEN': '{{ csrf_token() }}'
    //     },
    //     body: JSON.stringify({ firstName, lastName, email, phone, bio })
    // })
    // .then(res => res.json())
    // .then(data => console.log('Profile updated:', data))
    // .catch(err => console.error(err));
});

// === Modal Edit Profile Image ===
const editProfileImageBtn = document.getElementById('edit-profile-image-btn');
const profileImageModal = document.getElementById('profile-image-modal');
const closeImageModalBtn = document.getElementById('close-image-modal');
const cancelImageBtn = document.getElementById('cancel-image-btn');
const profilePhotoInput = document.getElementById('profile-photo');
const imagePreviewContainer = document.getElementById('image-preview-container');
const imagePreview = document.getElementById('image-preview');

// Buka modal ganti foto profil
editProfileImageBtn.addEventListener('click', () => {
    profileImageModal.classList.add('show');
});

// Tutup modal foto profil
const closeImageModal = () => {
    profileImageModal.classList.remove('show');
    imagePreviewContainer.style.display = 'none';
    profilePhotoInput.value = '';
};
closeImageModalBtn.addEventListener('click', closeImageModal);
cancelImageBtn.addEventListener('click', closeImageModal);

// Preview gambar sebelum disimpan
profilePhotoInput.addEventListener('change', (e) => {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            imagePreview.src = event.target.result;
            imagePreviewContainer.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        imagePreviewContainer.style.display = 'none';
    }
});

// Simpan gambar profil baru
document.getElementById('profile-image-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const file = profilePhotoInput.files[0];
    if (!file) {
        alert('Pilih gambar terlebih dahulu!');
        return;
    }

    const reader = new FileReader();
    reader.onload = function(event) {
        // Ganti tampilan avatar profil
        const profileImage = document.getElementById('profile-image');
        profileImage.innerHTML = `<img src="${event.target.result}" alt="Profile" class="w-40 h-48 object-cover rounded-md">`;
    };
    reader.readAsDataURL(file);

    closeImageModal();

    // (Opsional) Kirim ke backend pakai fetch FormData
    // const formData = new FormData();
    // formData.append('profile-photo', file);
    // fetch('/update-photo', {
    //     method: 'POST',
    //     headers: {
    //         'X-CSRF-TOKEN': '{{ csrf_token() }}'
    //     },
    //     body: formData
    // })
    // .then(res => res.json())
    // .then(data => console.log('Image updated:', data))
    // .catch(err => console.error(err));
});
</script>

@endsection
