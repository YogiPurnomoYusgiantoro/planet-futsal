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
                                $days = [
                                    0 => 'Minggu', 1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu',
                                    4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu'
                                ];
                                $grouped = $field->schedules->groupBy('day_of_week');
                            @endphp

                            @foreach($days as $dayNum => $dayName)
                                @if(isset($grouped[$dayNum]))
                                    <div class="mb-3">
                                        <div class="fw-bold mb-2">{{ $dayName }}</div>
                                        <div class="row row-cols-1 row-cols-md-2 g-2">
                                            @foreach($grouped[$dayNum]->chunk(ceil($grouped[$dayNum]->count() / 2)) as $chunk)
                                                <div class="col">
                                                    @foreach($chunk as $schedule)
                                                        <div class="d-flex justify-content-start align-items-center gap-2 mb-2">
                                                            <div class="badge bg-success">
                                                                {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} -
                                                                {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                                            </div>
                                                            <div class="badge bg-dark">
                                                                Rp {{ number_format($schedule->price) }}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
