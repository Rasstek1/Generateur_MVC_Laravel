<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('/components.formulaire');//route pour afficher le formulaire
});

Route::resource('profile', ProfileController::class)//route pour les ressources du controller ProfileController
    ->only(['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']);

Route::get('/profile', [ProfileController::class, 'index'])->name('profiles.index');//route pour afficher le formulaire a partir de la methode create du controller
Route::post('/formulaire', [ProfileController::class, 'store'])->name('formulaire.store');//route pour enregistrer les données du formulaire a partir de la methode store du controller
Route::get('/modification', [ProfileController::class, 'redirectModification'])->name('profiles.redirectModification');
Route::resource('profile', ProfileController::class);
Route::get('/profile', [ProfileController::class, 'index'])->name('profiles.index'); // Pour afficher le formulaire
Route::get('/profile/create', [ProfileController::class, 'create'])->name('profiles.create');

//Route pour la page Recherche
Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
