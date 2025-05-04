@extends('layouts.customers')

@section('title', 'Checkout')

@section('content')
    <h4 class="fw-bold mb-3">Detail Pemesanan</h4>

    {{-- Form Identitas --}}
    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <input type="hidden" name="booking_raw" id="booking_raw">

        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" name="name" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email">
            <div class="form-text">Kode bookingmu akan dikirimkan ke email ini.</div>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Nomor Telepon</label>
            <input type="text" class="form-control" name="phone" required>
        </div>

        {{-- List Sesi --}}
        <h6 class="fw-semibold mt-4">Rincian Pemesanan</h6>
        <ul class="list-group mb-3" id="bookingList"></ul>

        <h5 class="text-end">Total: <span id="totalPrice" class="text-success">Rp0</span></h5>

        {{-- Submit --}}
        <div class="d-grid mt-4">
            <button type="submit" class="btn btn-success">Bayar Sekarang</button>
        </div>
    </form>

    {{-- Script Parsing --}}
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const rawBooking = urlParams.get('booking');
        const list = document.getElementById('bookingList');
        const total = document.getElementById('totalPrice');
        const hiddenInput = document.getElementById('booking_raw');

        let totalPrice = 0;
        const sessionsByDate = {};

        if (rawBooking) {
            const items = rawBooking.split(',');

            items.forEach(item => {
                const parts = item.split(':');
                const schedule_id = parts[0];
                const date = parts[1];
                const price = parts[2];
                const timeRange = parts.slice(3).join(':'); // 08:00-09:00

                if (!sessionsByDate[date]) sessionsByDate[date] = [];
                sessionsByDate[date].push({
                    time: timeRange.replace('-', ' - '),
                    price: parseInt(price)
                });

                totalPrice += parseInt(price);
            });

            for (const date in sessionsByDate) {
                const li = document.createElement('li');
                li.className = 'list-group-item';

                const timeList = sessionsByDate[date]
                    .map(s => `<div>${s.time}</div>`)
                    .join('');

                    li.innerHTML = `
                       <div class="border rounded p-2 mb-2 bg-light">
                           <strong>Tanggal:</strong> ${formatDate(date)}
                       </div>
                       <div class="border rounded p-2">
                           <strong>Sesi:</strong><br>${timeList}
                       </div>
                    `;
                list.appendChild(li);
            }

            total.textContent = 'Rp' + totalPrice.toLocaleString('id-ID');
            hiddenInput.value = rawBooking;
        } else {
            list.innerHTML = `<li class="list-group-item text-danger">Tidak ada sesi yang dipilih.</li>`;
        }

        function formatDate(dateStr) {
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            return new Date(dateStr).toLocaleDateString('id-ID', options);
        }
    </script>
@endsection
