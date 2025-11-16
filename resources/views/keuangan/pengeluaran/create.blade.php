@extends('layouts.app')

@section('content')

<x-breadcrumb />

<div class="mt-6 bg-white dark:bg-gray-800 rounded-xl border 
            border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">

    {{-- Header --}}
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 
                flex justify-between items-center">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
            Catat Pengeluaran
        </h3>

        <a href="{{ route('pengeluaran.index') }}" 
           class="text-gray-400 dark:text-gray-300 hover:text-gray-600 dark:hover:text-gray-100 transition">
            <i class="fas fa-times text-lg"></i>
        </a>
    </div>

    {{-- Content --}}
    <div class="p-6 dark:text-gray-100">
        <form id="formPengeluaran" action="{{ route('pengeluaran.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                {{-- Left Side --}}
                <div class="space-y-6">

                    {{-- Kategori --}}
                    <x-select 
                        label="Kategori Pengeluaran"
                        name="id_kategori"
                        :options="$kategori->pluck('nama_kategori', 'id_kategori')"
                        value="{{ old('id_kategori') }}"
                        required
                    />

                    {{-- Jumlah --}}
                    <x-input-icon
    label="Jumlah Pengeluaran"
    name="jumlah"
    prefix="Rp"
    type="number"
    step="0.01"
    placeholder="asdsad"
    required
/>

                    {{-- Tanggal --}}
                    <x-input-date
    name="tanggal_pengeluaran"
    label="Tanggal Pengeluaran"
/>

                </div>

                {{-- Right Side --}}
                <x-textarea 
    name="deskripsi"
    label="Deskripsi"
    rows="10"
/>

            </div>

            <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                <x-btn-cancel href="{{ route('pengeluaran.index') }}"  />
                <x-btn-save form="formPengeluaran"/>
            </div>
        </form>
    </div>

</div>

@endsection
