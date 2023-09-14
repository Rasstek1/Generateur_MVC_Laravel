@extends('components.layout')

@section('content')
    <div style="text-align: center; margin-bottom: 30px;">
        <h1 style="display: inline-block; color:#272361; background:linear-gradient(to bottom, lightsteelblue, white); border: 2px solid #272361; padding: 10px;">RECHERCHER</h1>
    </div>

    <div style="width: 100%; display: flex; flex-direction: column; align-items: center;">
        <form method="GET" action="{{ route('profile.show') }}" style="margin: 0 auto; width: 300px; text-align: center; margin-bottom: 20px;">
            <input type="text" name="profile" placeholder="Entrez l'ID du profil" style="margin-bottom: 20px; width: 100%;">
            <button type="submit">Montrer le profil</button>
        </form>

        @if($profile ?? false)
            <div class="card mb-4" style="box-shadow: 0px 0px 15px 0px #272361; max-width: 600px;  margin: 0 auto;">
                <div class="card-body" style="border: 1px solid dimgrey; padding: 5px; display: flex; flex-direction: column; align-items: center;">
                    <img src="{{ asset($profile->photo_original) }}" class="card-img-top" alt="Photo de profil" style="object-fit: contain; max-width: 100%; height: auto;">
                    <h5 class="card-title" style="font-size: larger; font-weight: bold; color: #e64331; text-decoration: underline; padding: 10px;">
                        {{ $profile->prenom }} {{ $profile->nom }}
                    </h5>
                    <p class="card-text" style="padding: 10px;">
                        <strong>Id :</strong> {{ isset($profile->id) ? $profile->id : 'Non assigné' }}<br>
                        <strong>Email :</strong> {{ $profile->email }}<br>
                        <strong>Téléphone :</strong> {{ $profile->telephone }}<br>
                        <strong>Commentaire :</strong> {{ \Illuminate\Support\Str::limit($profile->commentaire, 100, '...') }}<!-- Limite le nombre de caractères à 100 -->
                    </p>
                </div>
            </div>
        @endif
    </div>

@endsection

