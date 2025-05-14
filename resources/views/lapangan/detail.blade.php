@extends('layouts.admin')

@section('title', 'Detail Lapangan')

@section('content')

@if(session('success'))
    <div id="snackbar" class="snackbar show">
        {{ session('success') }}
    </div>
@endif

<h2 class="text-xl font-bold mb-4">Detail Jadwal Lapangan</h2>

<form method="POST" action="{{ route('field.update', $field->id) }}" id="formUpdateField" class="mb-4">
    @csrf
    @method('PUT')
    <label class="font-semibold">Nama Lapangan:</label>
    <div class="d-flex gap-2">
        <input type="text" name="name" value="{{ $field->name }}" class="form-control w-auto" required>
        <button type="button" class="btn btn-warning" onclick="confirmSubmit('formUpdateField')">Update</button>
        <button type="button" class="btn btn-danger" onclick="confirmDelete()">Hapus Lapangan</button>
    </div>
</form>

<form method="POST" action="{{ route('field.destroy', $field->id) }}" id="formDeleteField">
    @csrf
    @method('DELETE')
</form>

<div class="mb-4">
    <form method="GET" action="{{ url()->current() }}">
        <label for="date" class="font-semibold">Pilih Tanggal:</label>
        <input type="date" id="date" name="date" value="{{ request('date', now()->toDateString()) }}" class="border p-2 rounded" onchange="this.form.submit()">
    </form>
</div>

@php
    $selectedDate = request('date', now()->toDateString());
    $filteredSchedules = $field->schedules->filter(function ($schedule) use ($selectedDate) {
        return $schedule->date === $selectedDate;
    });
@endphp

@if($filteredSchedules->isEmpty())
    <div class="text-gray-500 italic">Tidak ada jadwal untuk tanggal ini.</div>
@else
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Tanggal</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach($filteredSchedules as $schedule)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($schedule->date)->format('d M Y') }}</td>
                        <td>{{ $schedule->start_time }}</td>
                        <td>{{ $schedule->end_time }}</td>
                        <td>
                            <form method="POST" action="{{ route('schedule.updatePrice', $schedule->id) }}" id="formSchedule{{ $schedule->id }}" class="d-flex gap-2 align-items-center">
                                @csrf
                                @method('PUT')
                                <input type="number" name="price" value="{{ $schedule->price }}" class="form-control form-control-sm" style="width: 100px;" required>
                                <button type="button" class="btn btn-sm btn-warning" onclick="confirmSubmit('formSchedule{{ $schedule->id }}')">Simpan</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Perubahan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin menyimpan perubahan ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-warning" id="modalConfirmBtn">Simpan</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Lapangan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        Tindakan ini akan menghapus lapangan dan semua jadwal terkait.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger" id="modalDeleteBtn">Hapus</button>
      </div>
    </div>
  </div>
</div>

<script>
    let formToSubmit = null;

    function confirmSubmit(formId) {
        formToSubmit = document.getElementById(formId);
        const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
        modal.show();
    }

    function confirmDelete() {
        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        modal.show();
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('modalConfirmBtn').addEventListener('click', function () {
            if (formToSubmit) {
                formToSubmit.submit();
            }
        });

        document.getElementById('modalDeleteBtn').addEventListener('click', function () {
            document.getElementById('formDeleteField').submit();
        });
    });
</script>
@endsection
