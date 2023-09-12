@extends('components.layout')

@section('content')
    <div>
        <div style="text-align: center; margin-bottom: 30px;">
            <h1 style="display: inline-block; color:#272361; border: 2px solid #272361; padding: 10px;">FORMULAIRE</h1>
        </div>


        <form action="{{ isset($profile) ? route('profile.update', $profile->id) : route('profile.store') }}" method="POST" enctype="multipart/form-data" style="border: 1px solid #ccc; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 15px 0px #272361; max-width: 500px; margin: auto;">
            @csrf
            @if(isset($profile))
                @method('PUT')
            @endif
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $profile->nom ?? '') }}" required>
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="{{ old('prenom', $profile->prenom ?? '') }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Adresse e-mail</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $profile->email ?? '') }}" required>
            </div>
            <div class="mb-3">
                <label for="telephone" class="form-label">Téléphone</label>
                <input type="tel" class="form-control" id="telephone" name="telephone" value="{{ old('telephone', $profile->telephone ?? '') }}" required>
            </div>
            <div class="form-group">
                <label for="commentaire">Commentaire :</label>
                <textarea class="form-control" id="commentaire" name="commentaire" rows="3" maxlength="100" placeholder="Max 100 caractères">{{ old('commentaire', $profile->commentaire ?? '') }}</textarea>
            </div>
            <div class="mb-3 text-center">
                <label for="photo"></label>
                <div class="d-flex justify-content-center">
                    <label class="btn btn-warning w-50 me-2">
                        Sélectionnez une image <input type="file" name="photo" id="photo" style="display: none;">
                    </label>
                    <button type="submit" class="btn btn-primary w-50">Envoyer</button>
                </div>
            </div>
        </form>

    </div>
@endsection
