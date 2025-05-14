@extends('layouts.customers')

@section('title', $field->name)

@section('content')
    <img src="{{ asset('storage/' . $field->image) }}" class="img-fluid rounded mb-3" alt="{{ $field->name }}">

    <h4 class="fw-bold">{{ $field->name }}</h4>

    <p class="text-muted">{{ $field->description }}</p>

    <h6 class="fw-semibold mt-4">Fasilitas</h6>
    <div class="text-secondary small">
        <div class="d-flex align-items-center mb-2">
            <i class="bi bi-cup-hot-fill me-2 text-success"></i> <span>Jual Minuman</span>
        </div>
        <div class="d-flex align-items-center mb-2">
            <i class="bi bi-car-front-fill me-2 text-success"></i> <span>Parkir Mobil</span>
        </div>
        <div class="d-flex align-items-center mb-2">
            <i class="bi bi-scooter me-2 text-success"></i> <span>Parkir Motor</span>
        </div>
        <div class="d-flex align-items-center mb-2">
            <i class="bi bi-universal-access me-2 text-success"></i> <span>Ruang Ganti</span>
        </div>
        <div class="d-flex align-items-center mb-2">
            <i class="bi bi-badge-wc-fill me-2 text-success"></i> <span>Toilet</span>
        </div>
        <div class="d-flex align-items-center">
            <i class="bi bi-wifi me-2 text-success"></i> <span>Wi-fi</span>
        </div>
    </div>

    <h6 class="fw-semibold mt-4 mb-2">Sesi Lapangan</h6>
    <input type="date" id="dateSelect" class="form-control mb-3" onchange="renderSessions()">

    <div id="sessionContainer" class="row g-2"></div>
    <div id="sessionEmpty" class="text-muted small text-center mt-3 d-none">
        Sesi tidak tersedia pada tanggal tersebut.
    </div>

    <div class="d-grid mt-4">
        <button class="btn btn-success" onclick="goToCheckout()">Lanjut ke Checkout</button>
    </div>

    <script>
        const schedules = @json($schedules);
        const bookedSessions = @json($bookedSessions);

        function selectSession(el) {
            el.classList.toggle('selected-session');
        }

        function renderSessions() {
            const date = document.getElementById('dateSelect').value;
            const sessions = schedules[date];
            const container = document.getElementById('sessionContainer');
            const emptyNotice = document.getElementById('sessionEmpty');

            container.innerHTML = '';

            if (!sessions || sessions.length === 0) {
                emptyNotice.classList.remove('d-none');
                return;
            }

            emptyNotice.classList.add('d-none');

            sessions.forEach(session => {
                // Check if the session is already booked
                const isBooked = bookedSessions.some(booked => booked.schedule_id === session.id);
                
                const col = document.createElement('div');
                col.className = 'col-6';
                col.innerHTML = `
                    <div class="border rounded p-2 text-center selectable-session ${isBooked ? 'disabled-session' : ''}"
                         data-id="${session.id}"
                         data-start="${session.start_time.slice(0,5)}"
                         data-end="${session.end_time.slice(0,5)}"
                         data-price="${session.price}"
                         style="cursor: ${isBooked ? 'not-allowed' : 'pointer'};"
                         onclick="selectSession(this)">
                        <div class="fw-bold">${session.start_time.slice(0,5)} - ${session.end_time.slice(0,5)}</div>
                        <div class="small text-success">Rp${Number(session.price).toLocaleString('id-ID')}</div>
                    </div>
                `;
                container.appendChild(col);
            });
        }

        function goToCheckout() {
            const selected = document.querySelectorAll('.selected-session');
            const date = document.getElementById('dateSelect').value;

            if (!date) {
                alert('Silakan pilih tanggal terlebih dahulu.');
                return;
            }

            const bookingParams = Array.from(selected).map(el => {
                const id = el.dataset.id;
                const price = el.dataset.price;
                const start = el.dataset.start;
                const end = el.dataset.end;
                return `${id}:${date}:${price}:${start}-${end}`;
            });

            if (bookingParams.length === 0) {
                alert('Kamu harus memilih setidaknya satu sesi');
                return;
            }

            const finalQuery = bookingParams.join(',');
            window.location.href = `/checkout?booking=${encodeURIComponent(finalQuery)}`;
        }

        document.addEventListener('DOMContentLoaded', () => {
            const dateInput = document.getElementById('dateSelect');
            const availableDates = Object.keys(schedules).sort();
            if (availableDates.length > 0) {
                dateInput.value = availableDates[0];
                renderSessions();
            }
        });
    </script>

    <style>
        .selectable-session {
            transition: 0.2s;
            border: 2px solid #dee2e6;
        }

        .selectable-session:hover {
            border-color: #28a745;
            background-color: #e9fbe9;
        }

        .selected-session {
            border-color: #198754 !important;
            background-color: #d1f7d1 !important;
        }

        .disabled-session {
            background-color: #f8d7da !important;
            color: #6c757d;
            cursor: not-allowed;
        }
    </style>
@endsection
