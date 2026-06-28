<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalActivite extends Model
{
    use HasFactory;

    protected $fillable = [
        'utilisateur_id',
        'action',
        'description',
        'adresse_ip',
        'temps_passe_secondes',
        'etat',
    ];

    protected function casts(): array
    {
        return [
            'temps_passe_secondes' => 'integer',
        ];
    }

    // ----- Relations -----

    /**
     * Relation avec l'utilisateur qui a effectué l'action.
     */
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'utilisateur_id');
    }
}