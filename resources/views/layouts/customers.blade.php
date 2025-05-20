<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Planet Futsal')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        html, body {
            height: 100%;
            margin: 0;
            
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .app-wrapper {
            width: 100%;
            max-width: 375px;
            height: 100vh;
            border: 1px solid #ccc;
            display: flex;
            flex-direction: column;
            background-color: #FCFCFC !important;
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

        .navbar-custom {
            background-color: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link,
        .navbar-custom .navbar-toggler {
            color: #096B68;
        }

        .navbar-custom .nav-link:hover {
            color:rgb(84, 99, 99);
        }

        .navbar-custom .navbar-toggler-icon {
            filter: brightness(0) invert(1); 
        }

        #splash-screen {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
  }

  .splash-content img {
    width: 80px;
    height: 80px;
  }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body>
    <div class="app-wrapper">
        <nav class="navbar navbar-custom">
            <div class="container-fluid d-flex justify-content-between align-items-center">
            <a class="navbar-brand d-flex align-items-center" href="/">
    <img src="{{ asset('images/logo.png') }}" alt="" style="width: 40px; height: 40px; margin-right: 8px;">
    <span style="font-weight: bold; font-size: 18px;">Planet Futsal</span>
</a>
                <div class="d-flex gap-2 align-items-center">

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation" style="background-color:#096B68; color:white;">
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

        <div id="splash-screen">
  <div class="splash-content">
    <img src="{{ asset('images/logo.png') }}" alt="Planet Futsal Logo" />
  </div>
</div>

        <div class="content-scroll">
            @yield('content')
        </div>
    </div>

    @stack('scripts')

    <script>
  document.addEventListener("DOMContentLoaded", function () {
    if (!localStorage.getItem("splashShown")) {
      setTimeout(function () {
        var splash = document.getElementById("splash-screen");
        if (splash) {
          splash.style.display = "none";
        }
        localStorage.setItem("splashShown", "true");
      }, 2000); 
    } else {
      var splash = document.getElementById("splash-screen");
      if (splash) {
        splash.style.display = "none";
      }
    }
  });
</script>
</body>
</html>
