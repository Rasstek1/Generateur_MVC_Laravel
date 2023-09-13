<!doctype html>
<html lang="fr">
<head>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,400;0,900;1,400&family=Nanum+Myeongjo:wght@400;800&display=swap" rel="stylesheet">



    <title>The Profile Factory</title>
</head>
<body style="display: flex; flex-direction: column; min-height: 100vh;">


<!-- Header et Navigation -->
<header>
    <div class="container-fluid">
        <!-- Logo -->
        <div class=" justify-content-center text-center">
            <div class="col-12">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="logo" src="{{ asset('img/Logo.png') }}" alt="Logo">
                </a>
                <p>WE ARE DYING TO HAVE YOUR PROFILE</p>
            </div>
        </div>



        <!-- Navigation -->
        <div class="row justify-content-center text-center">
            <div class="col-12">
                <nav class="navbar navbar-expand">
                    <div class="container-fluid">
                        <!-- Le contenu du menu de navigation -->
                        <div class="navbar-collapse justify-content-center" id="navbarNav">
                            <ul class="navbar-nav flex-row">
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{ url('/') }}">Accueil</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{ url('/') }}">Formulaire</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('profile.create') }}">Profils</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('profiles.redirectModification') }}">Modification</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>





<!-- Contenu -->
<div class="container mt-4 flex-grow-1" style="min-height: 70vh;">
    @yield('content')
</div>

<!-- Footer -->
<footer class="text-left py-4">
    TheProfileFactory © 2023
</footer>



</body>
</html>




