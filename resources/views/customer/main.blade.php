@extends('layouts.customers')

@section('title', 'Planet Futsal')

@section('content')
<br>
@foreach ($fields as $field)
    <a href="{{ url('/fields/' . $field->id) }}" class="text-decoration-none text-dark">
        <div class="card mb-3 shadow-sm">
            <img src="{{ asset('storage/' . $field->image) }}" class="card-img-top" alt="{{ $field->name }}" style="object-fit: cover; height: 180px;">
            
            <div class="card-body">
                <h5 class="card-title mb-1">{{ $field->name }}</h5>
                <p class="text-muted small mb-1 d-flex align-items-center">
                    <img src="https://asset.ayo.co.id/assets/img/football.png" alt="Futsal" width="16" height="16" class="me-1">
                    Futsal
                </p>
                @php
                    $minPrice = $field->schedules->min('price');
                @endphp
                <p class="mt-4 fw-semibold">Mulai <span class="text-success">Rp{{ number_format($minPrice, 0, ',', '.') }}</span> <small class="text-muted">/sesi</small></p>
            </div>
        </div>
    </a>
@endforeach
@endsection
