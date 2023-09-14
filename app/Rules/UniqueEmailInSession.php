<?php
//Le dossier Rules et le fichier UniqueEmailInSession.php a ete cree avec la commande php artisan make:rule UniqueEmailInSession
//Le fichier UniqueEmailInSession.php a ete modifie pour ajouter les regles de validation pour l'email
namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueEmailInSession implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }
    private $profileId;
    public function __construct($profileId = null)
    {
        $this->profileId = $profileId;
    }

    public function passes($attribute, $value)
    {
        $profiles = session()->get('profiles', []);

        foreach ($profiles as $profile) {
            if (($profile->email === $value) && ($profile->id !== $this->profileId)) {
                return false;
            }
        }

        return true;
    }

    public function message()
    {
        return 'L\'email est déjà pris.';
    }

}
