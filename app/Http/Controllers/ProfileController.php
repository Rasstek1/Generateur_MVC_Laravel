<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

//Pour utiliser avec intervention/image

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profiles = session('profiles', []);
        return view('components.modification', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Récupération des profils dans la session ou tableau vide
        $profiles = session()->get('profiles', []);
        return view('components.profile', compact('profiles'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required',
            'telephone' => 'required',
            'commentaire' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // Récupérez tous les profils de la session
        $profiles = session()->get('profiles', []);

        // Trouvez l'ID le plus élevé parmi ces profils et ajoutez 1 pour obtenir le nouvel ID
        $maxId = collect($profiles)->max('id');
        $newId = is_null($maxId) ? 1 : $maxId + 1;

        $data = new \stdClass();
        $data->id = $newId; // Attribuez le nouvel ID au profil
        $data->nom = $request->nom;
        $data->prenom = $request->prenom;
        $data->email = $request->email;
        $data->telephone = $request->telephone;
        $data->commentaire = $request->commentaire;

        if ($request->hasFile('photo')) {
            $imageName = time() . '.' . $request->photo->extension();

            // Chemin d'accès où l'image sera stockée
            $path = public_path('images/' . $imageName);

            //Pour utiliser le recadrage d'image avec intervention/image, modifier le fichier php.ini dans Xampp et decommente la ligne extension=gd
            // Téléchargez l'image et recadrez-la
            $image = Image::make($request->file('photo')->getRealPath());
            $image->fit(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            });

            // Enregistrez l'image recadrée
            $image->save($path);

            $data->photo = 'images/' . $imageName;
        } else {
            $data->photo = null;
        }

        $profiles = session()->get('profiles', []);
        $profiles[] = $data;
        session()->put('profiles', $profiles);

        return redirect()->route('profile.create')->with('success', 'Profile créé avec succès.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $profiles = session('profiles', []);
        $profile = collect($profiles)->firstWhere('id', $id);

        if ($profile) {
            return view('components.formulaire', compact('profile'));
        } else {
            return redirect()->route('profile.index')->with('error', 'Profil non trouvé.');
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $profiles = session('profiles', []);
        $index = array_search($id, array_column($profiles, 'id'));

        if ($index !== false) {
            // Mettez à jour les champs du profil ici
            $profiles[$index]->nom = $request->nom;
            // ... (autres champs à mettre à jour)

            session()->put('profiles', $profiles);
            return redirect()->route('profile.index')->with('success', 'Profil mis à jour avec succès.');
        } else {
            return redirect()->route('profile.index')->with('error', 'Profil non trouvé.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $profiles = session('profiles', []);
        $profiles = array_values(array_filter($profiles, function ($profile) use ($id) {
            return $profile->id != $id;
        }));

        // Réaffecter les IDs
        foreach ($profiles as $index => $profile) {
            $profile->id = $index + 1;
        }

        session()->put('profiles', $profiles);
        return redirect()->route('profile.index')->with('success', 'Profil supprimé avec succès.');
    }
}
///a mettre dans le terminal pour installer intervention/image
/// composer require intervention/image
///
/// a mettre dans config/app.php
///
/// 'providers' => [
//    // ...
//    Intervention\Image\ImageServiceProvider::class,
//],
//
//'aliases' => [
//    // ...
//    'Image' => Intervention\Image\Facades\Image::class,
//],
