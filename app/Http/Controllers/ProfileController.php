<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('formulaire');
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
        //Validation des données du formulaire
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required',
            'telephone' => 'required',
            'commentaire' => 'required',
            'photo' => 'nullable'
        ]);
         //Création d'un objet profil avec les données du formulaire
        $data = new \stdClass();
        $data->nom = $request->nom;
        $data->prenom = $request->prenom;
        $data->email = $request->email;
        $data->telephone = $request->telephone;
        $data->commentaire = $request->commentaire;
        $data->photo = $request->photo;

        //Stockage du profil dans la session
        $profiles = session()->get('profiles', []);//Récupération des profils dans la session ou tableau vide
        $profiles[] = $data;//Ajout du profil dans le tableau
        session()->put('profiles', $profiles);//Stockage du tableau dans la session

        //Redirection vers la page de création de profil
        return redirect()->route('profiles.create')->with('success', 'Profile créé avec succès.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
