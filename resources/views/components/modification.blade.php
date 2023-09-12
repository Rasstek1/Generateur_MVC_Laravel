@extends('components.layout')

@section('content')

    <div style="text-align: center; margin-bottom: 30px;">
        <h1 style="display: inline-block; color:#272361; border: 2px solid #272361; padding: 10px;">MODIFICATION</h1>
    </div>


    <div class="container">
        <div class="row">
            @foreach($profiles as $profile)
                <div class="col-md-4">
                    <div class="card mb-4" style="box-shadow: 0px 0px 10px #888888;">
                        <div class="card-body">
                            <!-- Afficher la photo du profil -->
                            <img src="{{ asset($profile->photo) }}" class="card-img-top" alt="Photo de profil">

                            <!-- Afficher les détails du profil -->
                            <h5 class="card-title" style="color: #800080; font-weight: bold;">
                                {{ $profile->prenom }} {{ $profile->nom }}
                            </h5>
                            <p class="card-text">
                                <strong>Email :</strong> {{ $profile->email }}<br>
                                <strong>Téléphone :</strong> {{ $profile->telephone }}<br>
                                <strong>Commentaire :</strong> {{ $profile->commentaire }}
                            </p>

                            <!-- Boutons Modifier et Supprimer -->
                            <a href="{{ route('profiles.edit', $profile->id) }}" class="btn btn-primary">Modifier</a>
                            <form action="{{ route('profiles.destroy', $profile->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
