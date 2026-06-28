<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progression extends Model
{
    use HasFactory;

    protected $fillable = [
        'utilisateur_id',
        'formation_id',
        'taux_completion',
        'date_completion',
        'etat',
    ];

    protected function casts(): array
    {
        return [
            'taux_completion' => 'float',
            'date_completion' => 'datetime',
        ];
    }

    // ----- Relations -----

    /**
     * Relation avec l'utilisateur (apprenant).
     */
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'utilisateur_id');
    }

    /**
     * Relation avec la formation suivie.
     */
    public function formation()
    {
        return $this->belongsTo(Formation::class, 'formation_id');
    }
}