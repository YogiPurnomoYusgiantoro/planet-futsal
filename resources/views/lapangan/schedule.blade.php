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

        <div class="mb-3">
            <label for="day_of_week" class="form-label">Hari</label>
            <select name="day_of_week" id="day_of_week" class="form-select" required>
                <option value="">-- Pilih Hari --</option>
                <option value="1">Senin</option>
                <option value="2">Selasa</option>
                <option value="3">Rabu</option>
                <option value="4">Kamis</option>
                <option value="5">Jumat</option>
                <option value="6">Sabtu</option>
                <option value="0">Minggu</option>
            </select>
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
