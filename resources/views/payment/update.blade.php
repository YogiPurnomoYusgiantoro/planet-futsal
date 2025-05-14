{{-- resources/views/payment/update.blade.php --}}
@extends('layouts.customers')

@section('title', 'Pembayaran Berhasil')

@section('content')
    <div class="container text-center">
        <img src="https://img.freepik.com/free-photo/3d-hand-making-cashless-payment-from-smartphone_107791-16609.jpg?t=st=1746696153~exp=1746699753~hmac=292d343e9a3cd56509bbb2ed0025794602519932a6ff9b6d3e49bc6d82ef6f58&w=740" alt="Pembayaran Berhasil" class="img-fluid mb-4" style="max-width: 300px; height: auto;">

        <h4 class="fw-bold mb-3">Pembayaran anda sedang diproses</h4>
        <p class="text-muted mb-4">Mohon jangan tutup atau refresh halaman ini.</p>
        </div>
    </div>

    <form id="payment-update-form" action="{{ route('payment.update.store') }}" method="POST">
        @csrf
        <input type="hidden" name="booking_code" value="{{ $order->booking_code }}">
        <button type="submit" id="dummy" hidden></button>
    </form>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
    const dummyButton = document.getElementById("dummy");
    if (dummyButton) {
        dummyButton.click();
    }
    });
    </script>

@endsection
