@extends('layouts.admin')

@section('title', 'Jadwal Lapangan')

@section('content')
    <h2 class="mb-4">Jadwal Lapangan</h2>

    <div class="row">
        @foreach($fields as $field)
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    @if($field->image)
                        <img src="{{ asset('storage/' . $field->image) }}" class="card-img-top" alt="Lapangan" style="width: 100%; height: 300px; object-fit: cover;">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $field->name }}</h5>
                        <div class="mt-3">
                            @php
                                $grouped = $field->schedules->groupBy('date');
                            @endphp

                            @foreach($grouped as $date => $schedules)
                                <div class="mb-3">
                                    <div class="fw-bold mb-2">
                                        {{ \Carbon\Carbon::parse($date)->translatedFormat('l, d M Y') }}
                                    </div>

                                    <div class="row row-cols-1 row-cols-md-2 g-2">
                                        @foreach($schedules->chunk(ceil($schedules->count() / 2)) as $chunk)
                                            <div class="col">
                                                @foreach($chunk as $schedule)
                                                    <div class="d-flex justify-content-start align-items-center gap-2 mb-2">
                                                        <div class="badge bg-success">
                                                            {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} -
                                                            {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                                        </div>
                                                        <div class="badge bg-dark">
                                                            Rp {{ number_format($schedule->price, 0, ',', '.') }}
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
