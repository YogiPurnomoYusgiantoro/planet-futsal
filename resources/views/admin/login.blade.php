<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - Planet Futsal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: #f8fff8;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            background: white;
            padding: 3rem 2rem;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 360px;
        }

        .card h1 {
            text-align: center;
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
            color: #2c3e50;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            color: #444;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 15px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #3D8D7A;
            color: white;
            border: none;
            font-size: 16px;
            border-radius: 8px;
            margin-top: 1rem;
            transition: background-color 0.3s;
        }

        .footer {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 13px;
            color: #777;
        }

    </style>
</head>
<body>

<div class="card">
    <h1>Admin Login</h1>

    @if(session('error'))
        <div style="color: red; text-align:center; margin-bottom: 12px;">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="/admin/login">
        @csrf

        <div class="form-group">
            <label for="email">Email Admin</label>
            <input type="email" name="email" id="email" placeholder="admin@planetfutsal.com" required>
        </div>

        <div class="form-group">
            <label for="password">Kata Sandi</label>
            <input type="password" name="password" id="password" placeholder="********" required>
        </div>

        <button type="submit">Masuk</button>
    </form>

    <div class="footer">
        &copy; {{ date('Y') }} Planet Futsal
    </div>
</div>

</body>
</html>
