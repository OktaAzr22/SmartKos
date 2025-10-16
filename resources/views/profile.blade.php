@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Profil Saya</h1>
<p>Nama: {{ Auth::user()->name ?? 'Tidak diketahui' }}</p>
<p>Email: {{ Auth::user()->email ?? 'Tidak diketahui' }}</p>
@endsection
