@extends('components.layout')

@section('content')
    <div style="text-align: center; margin-bottom: 30px;">
        <h1 style="display: inline-block; color:#272361; border: 2px solid #272361; padding: 10px;">MODIFICATIONS</h1>
    </div>


    @if(session('profiles'))
        <div class="row">
            @foreach(session('profiles') as $profile)
                <div class="col-md-4">
                    <div class="card mb-4" style="box-shadow: 0px 0px 15px 0px #272361">
                        <div class="card-body"
                             style="border: 1px solid dimgrey; padding: 5px; height: 650px; display: flex; flex-direction: column;">
                            <img src="{{ asset($profile->photo) }}" class="card-img-top" alt="Photo de profil">
                            <h5 class="card-title"
                                style="font-size: larger; font-weight: bold; color: #e64331; text-decoration: underline; padding: 10px;">
                                {{ $profile->prenom }} {{ $profile->nom }}
                            </h5>
                            <p class="card-text" style="flex-grow: 1; padding: 10px;">
                                <strong>Id :</strong> {{ isset($profile->id) ? $profile->id : 'Non assigné' }}<br>
                                <strong>Email :</strong> {{ $profile->email }}<br>
                                <strong>Téléphone :</strong> {{ $profile->telephone }}<br>
                                <strong>Commentaire:</strong> {{ \Illuminate\Support\Str::limit($profile->commentaire, 100, '...') }}<!-- Limite le nombre de caractères à 100 -->

                            </p>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('profile.edit', ['profile' => $profile->id]) }}" class="btn btn-primary" style="width: 48%; margin-right: 4%;">Modifier</a>

                                <form action="{{ route('profile.destroy', ['profile' => $profile->id]) }}" method="POST" style="display:inline; width: 48%;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-100">Supprimer</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    @else
        <p class="message" style="text-align: center;">Aucun profil n'a été créé.</p>
    @endif
@endsection
