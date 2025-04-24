<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Planet Futsal')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            background-color: #f8f9fa;
        }   

        body {
            display: flex;
            justify-content: center;
            align-items: center;
        }   

        .app-wrapper {
            width: 100%;
            max-width: 375px; /* default: iPhone 8 width */
            height: 100vh;
            border: 1px solid #ccc;
            display: flex;
            flex-direction: column;
            background-color: white;
            overflow: hidden;
        }
        
        @media (min-width: 768px) {
            .app-wrapper {
                max-width: 500px;
            }
        } 

        .content-scroll {
            flex: 1;
            overflow-y: auto;
            padding: 1rem 1rem 4rem;
        }   
    </style>    

</head>
<body>
    <div class="app-wrapper">
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="#">Planet Futsal</a>

            <div class="d-flex gap-2 align-items-center">
                <a class="nav-link me-2" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
  <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
</svg></a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav px-3">
                <li class="nav-item">
                    <a class="nav-link" href="/">Sewa Lapangan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/booking">Cek Kode Booking</a>
                </li>
            </ul>
        </div>
    </nav>

        <div class="content-scroll">
            @yield('content')
        </div>
    </div>


</body>

</html>
