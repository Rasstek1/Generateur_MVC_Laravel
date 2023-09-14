<?php
//Dossier Request et le fichier ProfileRequest.php a ete cree avec la commande php artisan make:request ProfileRequest
//Le fichier ProfileRequest.php a ete modifie pour ajouter les regles de validation

namespace App\Http\Requests;

use App\Rules\UniqueEmailInSession;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $profileId = $this->route('profile');

        return [
            'nom' => 'required|string|max:25|regex:/^[a-zA-Z]+(([\',. -][a-zA-Z ])?[a-zA-Z]*)*$/', //regex pour accepter les lettres et les espaces
            'prenom' => 'required|string|max:25|regex:/^[a-zA-Z]+(([\',. -][a-zA-Z ])?[a-zA-Z]*)*$/', //regex pour accepter les lettres et les espaces
            'email' => ['required', 'email', 'max:255', new UniqueEmailInSession($profileId)], //Regle de validation pour l'email.La gestion est faite dans le fichier UniqueEmailInSession.php
            'telephone' => 'required',//Utiliser Regex101 pour tester les regex si besoin
            'commentaire' => 'required|string|max:50',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}

