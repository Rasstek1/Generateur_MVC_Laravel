@extends('layout')

@section('content')
    <div>
        <h1 style="text-align: center;">Formulaire</h1>
        <form action="{{ url('/traiter-formulaire') }}" method="POST" style="border: 1px solid #ccc; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); max-width: 500px; margin: auto;">
            @csrf
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Adresse e-mail</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="telephone" class="form-label">Téléphone</label>
                <input type="tel" class="form-control" id="telephone" name="telephone" required>
            </div>
            <div class="mb-3">
                <label for="commentaire" class="form-label">Message</label>
                <textarea class="form-control" id="commentaire" name="commentaire" rows="4" required></textarea>
            </div>
            <form action="upload.php" method="POST" enctype="multipart/form-data">
                Sélectionnez une image :
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Uploader l'image" name="submit">
            </form>

            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>


    </div>

@endsection
