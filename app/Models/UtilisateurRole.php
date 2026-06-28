<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtilisateurRole extends Model
{
    use HasFactory;

    protected $table = 'utilisateur_roles';

    protected $fillable = [
        'user_id',
        'role_id',
        'etat',
    ];

    // ----- Relations -----

    /**
     * Relation avec l'utilisateur.
     */
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relation avec le rôle.
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}