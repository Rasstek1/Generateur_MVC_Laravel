<!doctype html>
<html lang="fr">
<head>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Mon Projet Laravel</title>
</head>
<body style="display: flex; flex-direction: column; min-height: 100vh;">

<!-- Header et Navigation -->
<header style="background-color: #b3d1ff; padding: 20px 0;">
    <div class="container-fluid">
        <div class="row align-items-center">
            <!-- Emplacement pour le logo et le titre -->
            <div class="col-3 d-flex align-items-center">
                <a class="navbar-brand" href="#" style="margin-right: 15px;">
                    <img src="{{ asset('img/appium-logo.png') }}" alt="Logo" style="max-width: 100px;">
                </a>
                <h1 style="font-size: 1.5em; margin: 0; color:darkblue;">TheProfilFactory</h1>
            </div>

            <!-- Navigation -->
            <div class="col-6">
                <nav class="navbar navbar-expand-lg justify-content-center">
                    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/form') }}">Form</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/formdata') }}">Form Data</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

            <!-- Colonne vide pour équilibrer -->
            <div class="col-3 text-center">
            </div>
        </div>
    </div>
</header>



<!-- Contenu -->
<div class="container mt-4 flex-grow-1" style="min-height: 70vh;">
    @yield('content')
</div>


<!-- Footer -->
<footer class="text-left py-4 bg-primary" style="padding-left: 20px; color:cornflowerblue">
    TheProfilFactory © 2023
</footer>


<!-- Bootstrap JS et dépendances (optionnel) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

