@extends('layouts.customers')

@section('title', 'Pembayaran Berhasil')

@section('content')
    <div class="container text-center">
        <img src="https://img.freepik.com/free-photo/3d-hand-using-online-banking-app-smartphone_107791-16639.jpg?t=st=1746672564~exp=1746676164~hmac=be465b5fd271e7e96665cc8e48e3b8233bd14b771ed909c4ef7a8ae600a86f85&w=740" alt="Pembayaran Berhasil" class="img-fluid mb-4" style="max-width: 300px; height: auto;">

        <h4 class="fw-bold mb-3">Pembayaran Anda Telah Berhasil</h4>
        <p class="text-muted mb-4">Kode booking akan dikirimkan ke email anda.</p>

        <div class="d-grid gap-2 col-6 mx-auto mt-4">
            <a href="/booking/search?kode_booking={{$booking_code}}" class="btn btn-success">Cek Kode Booking</a>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    window.addEventListener('beforeunload', function (e) {
        e.preventDefault();
        e.returnValue = '';
    });

    history.pushState(null, document.title, location.href);
    window.addEventListener('popstate', function () {
        history.pushState(null, document.title, location.href);
    });
</script>
@endpush
