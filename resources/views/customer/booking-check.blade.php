@extends('layouts.customers')

@section('title', 'Cek Kode Booking')

@section('content')
<div class="mb-4">
    <h4 class="text-success">Cek Kode Booking</h4>
    <p class="text-muted">Masukkan kode booking kamu untuk melihat detail pesanan.</p>
</div>

<form action="{{ route('booking.search') }}" method="GET" class="mb-3">
    <div class="mb-3">
        <label for="kode_booking" class="form-label">Kode Booking</label>
        <input type="text" class="form-control border-success" name="kode_booking" id="kode_booking" placeholder="Contoh: PF123ABC" required>
    </div>
    <button type="submit" class="btn btn-success w-100">Cari</button>
</form>
@endsection
