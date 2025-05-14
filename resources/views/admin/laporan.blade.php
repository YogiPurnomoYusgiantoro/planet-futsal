@extends('layouts.admin')

@section('title', 'Laporan Keuangan')

@section('content')

@if(session('success'))
    <div id="snackbar" class="snackbar show">
        {{ session('success') }}
    </div>
@endif

<h2 class="mb-4">Laporan Keuangan</h2>

<div class="mb-4 d-flex flex-wrap gap-2">
    <a href="{{ route('laporan.keuangan', ['filter' => 'today']) }}" class="btn btn-outline-primary">Hari Ini</a>
    <a href="{{ route('laporan.keuangan', ['filter' => 'month']) }}" class="btn btn-outline-primary">Bulan Ini</a>
    <a href="{{ route('laporan.keuangan', ['filter' => 'year']) }}" class="btn btn-outline-primary">Tahun Ini</a>
</div>

<form method="GET" action="{{ route('laporan.keuangan') }}" class="row g-2 mb-4">
    <div class="col-md-3">
        <input type="date" name="from" class="form-control" value="{{ request('from') }}">
    </div>
    <div class="col-md-3">
        <input type="date" name="to" class="form-control" value="{{ request('to') }}">
    </div>
    <div class="col-md-3">
        <button type="submit" class="btn btn-success">Filter Tanggal</button>
    </div>
</form>

<div class="mb-3">
    <a href="{{ route('laporan.keuangan.pdf', request()->all()) }}" class="btn btn-danger">Download PDF</a>
</div>

<div class="table-responsive">
    <table class="table table-borderless">
        <thead class="bg-light">
            <tr>
                <th>Tanggal</th>
                <th>Nama Lapangan</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach($orders as $order)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($order->date)->format('d M Y') }}</td>
                    <td>{{ $order->field_name }}</td>
                    <td>Rp {{ number_format($order->price, 0, ',', '.') }}</td>
                </tr>
                @php $total += $order->price; @endphp
            @endforeach
        </tbody>
        <tfoot class="bg-light">
            <tr>
                <th colspan="2" class="text-end">Total Pendapatan:</th>
                <th>Rp {{ number_format($total, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>
</div>
@endsection
