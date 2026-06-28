<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'utilisateur_id',
        'formation_id',
        'date_inscription',
        'statut',
        'etat',
    ];

    protected function casts(): array
    {
        return [
            'date_inscription' => 'datetime',
        ];
    }

    // ----- Relations -----

    /**
     * Relation avec l'utilisateur (apprenant) inscrit.
     */
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'utilisateur_id');
    }

    /**
     * Relation avec la formation à laquelle l'utilisateur est inscrit.
     */
    public function formation()
    {
        return $this->belongsTo(Formation::class, 'formation_id');
    }

    // ----- Relations futures (à décommenter si besoin) -----

    /**
     * Une inscription peut avoir une progression associée.
     */
    // public function progression()
    // {
    //     return $this->hasOne(Progression::class);
    // }
}