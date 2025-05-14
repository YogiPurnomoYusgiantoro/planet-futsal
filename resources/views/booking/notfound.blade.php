@extends('layouts.customers')

@section('title', 'Lapangan Anda')

@section('content')
    <div class="container text-center">
        <img src="https://img.freepik.com/free-vector/man-saying-no-concept-illustration_114360-14222.jpg?t=st=1746675781~exp=1746679381~hmac=cb9c46e96fcd47a7c0f89df4eae14690dfa7ae65900e41c48813c1d1eca0abea&w=740" alt="Pembayaran Berhasil" class="img-fluid mb-4" style="max-width: 300px; height: auto;">

        <h4 class="fw-bold mb-3">Kode Booking Anda tidak ditemukan</h4>
        <p class="text-muted mb-4">Mohon masukkan informasi kode booking dengan benar.</p>

        <div class="d-grid gap-2 col-6 mx-auto mt-4">
            <a href="/booking" class="btn btn-success">Cek Kode Booking</a>
        </div>
    </div>
@endsection
