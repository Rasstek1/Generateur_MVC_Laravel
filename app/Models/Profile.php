<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'commentaire',
        'photo',
    ];

    public function getPhotoAttribute($value)
    {
        return asset('storage/' . $value);
    }

    public function setPhotoAttribute($value)
    {
        $this->attributes['photo'] = $value->store('profiles');
    }

    public function getFullNameAttribute()
    {
        return $this->nom . ' ' . $this->prenom;
    }

    public function getCommentaireAttribute($value)
    {
        return nl2br($value);
    }

    public function setCommentaireAttribute($value)
    {
        $this->attributes['commentaire'] = str_replace(["\r\n", "\r", "\n"], '<br>', $value);
    }

    public function getTelephoneAttribute($value)
    {
        return substr($value, 0, 2) . ' ' . substr($value, 2, 2) . ' ' . substr($value, 4, 2) . ' ' . substr($value, 6, 2) . ' ' . substr($value, 8, 2);
    }

    public function setTelephoneAttribute($value)
    {
        $this->attributes['telephone'] = str_replace(' ', '', $value);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y H:i:s', strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('d/m/Y H:i:s', strtotime($value));
    }

    public function getPhotoOriginalAttribute($value)
    {
        return asset('storage/' . $value);
    }
}
