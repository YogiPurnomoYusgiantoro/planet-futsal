@extends('layouts.admin')

@section('title', 'Lapangan Terpesan')

@section('content')
<div class="mb-4">
    <form method="GET" action="{{ route('lapangan.booked') }}">
        <label for="date" class="font-semibold">Pilih Tanggal:</label>
        <input type="date" id="date" name="date" value="{{ request('date', now()->toDateString()) }}" class="border p-2 rounded" onchange="this.form.submit()">
    </form>
</div>

@php
    $selectedDate = request('date', now()->toDateString());
@endphp

@if($schedules->isEmpty())
    <div class="text-gray-500 italic">Tidak ada pemesanan pada tanggal ini.</div>
@else
    <div class="grid md:grid-cols-2 mt-4 gap-4">
        @foreach($schedules as $schedule)
            <div class="border border-gray-300 rounded-lg shadow-md p-4 bg-white">
                <h3 class="text-blue-600 font-bold text-lg mb-1">{{ $schedule->field_name }}</h3>
                <p><strong>Waktu:</strong> {{ $schedule->start_time }} - {{ $schedule->end_time }}</p>
                <p><strong>Harga:</strong> Rp {{ number_format($schedule->price, 0, ',', '.') }}</p>
                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($schedule->date)->format('d M Y') }}</p>
                <p>
                    <strong>Status Booking:</strong>
                    @if($schedule->booking_status == 'done')
                        <span class="text-green-600 font-semibold">Selesai</span>
                    @else
                        <span class="text-yellow-600 font-semibold">Pending</span>
                    @endif
                </p>
            </div>
        @endforeach
    </div>
@endif
@endsection
