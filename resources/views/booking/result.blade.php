@extends('layouts.customers')

@section('title', 'Lapangan Anda')

@section('content')
    <div class="container mt-2">
            <div class="card mb-4 border border-success">
                <div class="card-header bg-success text-white">
                    <h6 class="mb-0">Kode Booking: <strong>{{ $booking[0]->booking_code }}</strong></h6>
                </div>
                <div class="card-body">
                    <p class="mb-1"><strong>Nama Pemesan:</strong> {{ $booking[0]->customer_name }}</p>
                    <p class="mb-1"><strong>Email:</strong> {{ $booking[0]->customer_email ?? 'Tidak ada' }}</p>
                    <p class="mb-0"><strong>Nomor Telepon:</strong> {{ $booking[0]->customer_phone }}</p>
                </div>
            </div>

            <h6 class="fw-semibold mb-3 text-success">Rincian Pemesanan</h6>

            <div class="row g-3">
                @foreach ($booking as $session)
                    <div class="col-12">
                        <div class="card border border-success">
                            <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                                <div class="mb-2 mb-md-0">
                                    <h6 class="card-title text-success mb-1">{{ $session->field_name }}</h6>
                                    <p class="mb-0"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($session->session_date)->format('d M Y') }}</p>
                                </div>
                                <div>
                                    <p class="mb-0"><strong>Jam:</strong> {{ \Carbon\Carbon::parse($session->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($session->end_time)->format('H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <br><br>
            <div class="text-center mt-4">
                <div class="mt-2">
                    {!! $qrCode !!}
                </div>
            </div>

            <p class="text-muted text-center mt-4 mb-4">Tunjukkan QR ini saat anda check in.</p>

    </div>
@endsection
