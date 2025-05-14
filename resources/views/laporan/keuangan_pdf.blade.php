<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            padding: 8px 10px;
            border: 1px solid #000;
            text-align: left;
        }
        .table th {
            background-color: #f0f0f0;
        }
        .total-row td {
            font-weight: bold;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

<div class="header">
    <h2>Laporan Keuangan</h2>
    <p>Dicetak pada: {{ \Carbon\Carbon::now()->format('d M Y, H:i') }}</p>
</div>

<table class="table">
    <thead>
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
    <tfoot>
        <tr class="total-row">
            <td colspan="2">Total Pendapatan</td>
            <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
        </tr>
    </tfoot>
</table>

</body>
</html>
