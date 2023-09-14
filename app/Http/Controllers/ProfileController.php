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
        //Récupération des profils dans la session ou tableau vide
        $profiles = session()->get('profiles', []);
        return view('components.profile', compact('profiles'));
    }

    public function redirectModification()
    {
        $profiles = session('profiles', []);
        return view('components.modification', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('components.formulaire');

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

            // Sauvegardez l'image originale d'abord
            $request->file('photo')->move(public_path('images/'), $imageName);

            // Pour utiliser le recadrage d'image avec intervention/image, modifiez le fichier php.ini dans Xampp et décommentez la ligne extension=gd
            // Téléchargez l'image et recadrez-la
            $image = Image::make($path);
            $image->fit(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            });

            // Enregistrez l'image recadrée avec un suffixe distinct
            $croppedImageName = 'cropped_' . $imageName;
            $croppedPath = public_path('images/' . $croppedImageName);
            $image->save($croppedPath);

            $data->photo_original = 'images/' . $imageName; // Path to the original image
            $data->photo_cropped = 'images/' . $croppedImageName; // Path to the cropped image
        } else {
            $data->photo_original = null;
            $data->photo_cropped = null;
        }


        $profiles = session()->get('profiles', []);
        $profiles[] = $data;
        session()->put('profiles', $profiles);

        return redirect()->route('profiles.index')->with('success', 'Profile créé avec succès.');


    }


    /**
     * Display the specified resource.
     */
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     *///Pour effectuer une recherche dans la session d'un profil avec le id
    public function show(Request $request)
    {
        $profileId = $request->input('profile');

        $profiles = session('profiles', []);
        $profile = collect($profiles)->firstWhere('id', $profileId);

        return view('components.recherche', compact('profile'));
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
            return redirect()->route('profiles.redirectModification')->with('error', 'Profil non trouvé.');
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
            $profiles[$index]->nom = $request->nom;//
            $profiles[$index]->prenom = $request->prenom;
            $profiles[$index]->email = $request->email;
            $profiles[$index]->telephone = $request->telephone;
            $profiles[$index]->commentaire = $request->commentaire;

            // Gestion de la photo si elle a été mise à jour
            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
                // Stockez la photo et mettez à jour le chemin d'accès dans le profil
                // (ajustez selon la manière dont vous gérez le stockage des photos)
                $path = $request->photo->store('photos');
                $profiles[$index]->photo = $path;
            }

            session()->put('profiles', $profiles);
            return redirect()->route('profiles.redirectModification')->with('success', 'Profil mis à jour avec succès.');
        } else {
            return redirect()->route('profiles.redirectModification')->with('error', 'Profil non trouvé.');
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
        return redirect()->route('profiles.redirectModification')->with('success', 'Profil supprimé avec succès.');
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
