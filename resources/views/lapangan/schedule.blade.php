@extends('layouts.admin')

@section('title', 'Atur Jadwal Lapangan')

@section('content')
    <h2>Atur Jadwal Lapangan</h2>

    <form action="{{ route('lapangan.schedule.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="field_id" class="form-label">Pilih Lapangan</label>
            <select name="field_id" id="field_id" class="form-select" required>
                <option value="">-- Pilih Lapangan --</option>
                @foreach($fields as $field)
                    <option value="{{ $field->id }}">{{ $field->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3 row">
            <div class="col">
                <label for="start_date" class="form-label">Tanggal Mulai</label>
                <input type="date" name="start_date" id="start_date" class="form-control" required>
            </div>
            <div class="col">
                <label for="end_date" class="form-label">Tanggal Selesai</label>
                <input type="date" name="end_date" id="end_date" class="form-control" required>
            </div>
        </div>

        <div class="mb-3 row">
            <div class="col">
                <label for="start_time" class="form-label">Jam Awal Operasional</label>               
                <input type="time" name="start_time" id="start_time" step="3600" class="form-control" required>
            </div>
            <div class="col">
                <label for="end_time" class="form-label">Jam Akhir Operasional</label>
                <input type="time" name="end_time" id="end_time" step="3600" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Harga (Rp)</label>
            <input type="number" name="price" id="price" class="form-control" required min="0">
        </div>

        <button type="submit" class="btn btn-success">Simpan Jadwal</button>
    </form>
@endsection
