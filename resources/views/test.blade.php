@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    {{-- Card dengan warna theme --}}
    <div class="bg-white dark:bg-dark-800 rounded-xl border border-gray-200 dark:border-dark-700 p-6 mb-6">
        <h2 class="text-2xl font-bold text-text mb-4">Test Warna</h2>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            {{-- Primary --}}
            <div class="p-4 bg-primary text-white rounded-lg">Primary</div>
            
            {{-- Secondary --}}
            <div class="p-4 bg-secondary text-white rounded-lg">Secondary</div>
            
            {{-- Success --}}
            <div class="p-4 bg-success text-white rounded-lg">Success</div>
            
            {{-- Danger --}}
            <div class="p-4 bg-danger text-white rounded-lg">Danger</div>
        </div>
        
        {{-- Text colors --}}
        <div class="mt-6 space-y-2">
            <p class="text-text">Text utama (berubah di dark mode)</p>
            <p class="text-gray-600 dark:text-dark-400">Text secondary</p>
            <p class="text-primary">Text primary (berubah di dark mode)</p>
        </div>
    </div>
    
    {{-- Dark theme colors --}}
    <div class="grid grid-cols-5 gap-2">
        <div class="p-4 bg-dark-950 text-white text-center">950</div>
        <div class="p-4 bg-dark-900 text-white text-center">900</div>
        <div class="p-4 bg-dark-800 text-white text-center">800</div>
        <div class="p-4 bg-dark-700 text-white text-center">700</div>
        <div class="p-4 bg-dark-600 text-white text-center">600</div>
        <div class="p-4 bg-dark-500 text-white text-center">500</div>
        <div class="p-4 bg-dark-400 text-black text-center">400</div>
        <div class="p-4 bg-dark-300 text-black text-center">300</div>
        <div class="p-4 bg-dark-200 text-black text-center">200</div>
        <div class="p-4 bg-dark-100 text-black text-center">100</div>
    </div>
</div>
@endsection