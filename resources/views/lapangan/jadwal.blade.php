@extends('layouts.admin')

@section('title', 'Jadwal Lapangan')

@section('content')

@if(session('success'))
    <div id="snackbar" class="snackbar show">
        {{ session('success') }}
    </div>
@endif

<div class="d-flex flex-wrap gap-4">
    @foreach($fields as $field)
        <div class="card shadow-sm" style="width: 300px; height: 300px;">
            @if($field->image)
                <img src="{{ asset('storage/' . $field->image) }}" alt="Lapangan {{ $field->name }}" class="card-img-top" style="height: 150px; object-fit: cover;">
            @endif

            <div class="card-body d-flex flex-column justify-content-between p-3">
                <h5 class="card-title mb-3" style="font-size: 1rem; font-weight: bold;">
                    {{ $field->name }}
                </h5>

                <a href="{{ url('/admin/lapangan/schedule/' . $field->id) }}" class="btn btn-success w-100 mt-auto">
                    Cek Detail
                </a>
            </div>
        </div>
    @endforeach
</div>
@endsection
