@extends('layouts.admin')

@section('title', 'Tambah Lapangan')

@section('content')

@if(session('success'))
    <div id="snackbar" class="snackbar show">
        {{ session('success') }}
    </div>
@endif

    <h2>Tambah Lapangan</h2>
    <form action="{{ route('lapangan.store') }}" enctype='multipart/form-data' method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Lapangan</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Gambar</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
@endsection
