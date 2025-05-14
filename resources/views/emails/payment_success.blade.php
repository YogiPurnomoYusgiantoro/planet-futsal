<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Berhasil</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .email-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 600px;
            margin: 0 auto;
        }

        h1 {
            color: #28a745;
            font-size: 28px;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .button {
            display: inline-block;
            color: white;
            background-color: #28a745;
            color: #fff;
            padding: 12px 20px;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            margin-top: 20px;
        }

        .button:hover {
            background-color: #218838;
        }

        .footer {
            font-size: 12px;
            color: #777;
            text-align: center;
            margin-top: 30px;
        }

    </style>
</head>
<body>

    <div class="email-container">
        <h1>Pembayaran Berhasil!</h1>
        <p>Terima kasih telah melakukan pembayaran untuk pemesanan futsal Anda. Kami senang Anda memilih layanan kami.</p>

        <p><strong>Kode Booking:</strong> {{ $booking_code }}</p>
        <p><strong>Total Pembayaran:</strong> Rp {{ number_format($amount, 0, ',', '.') }}</p>

        <a href="http://127.0.0.1:8000/booking/search?kode_booking={{$booking_code}}" class="button">Cek Kode Booking</a>

        <div class="footer">
            <p>Jika Anda membutuhkan bantuan lebih lanjut, jangan ragu untuk menghubungi kami.</p>
            <p>&copy; 2025 Planet Futsal - Semua Hak Dilindungi</p>
        </div>
    </div>

</body>
</html>
