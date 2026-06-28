<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipantSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_formation_id',
        'utilisateur_id',
        'presence',
        'date_inscription',
        'etat',
    ];

    protected function casts(): array
    {
        return [
            'presence' => 'boolean',
            'date_inscription' => 'datetime',
        ];
    }

    // ----- Relations -----

    /**
     * Relation avec la session de formation.
     */
    public function session()
    {
        return $this->belongsTo(SessionFormation::class, 'session_formation_id');
    }

    /**
     * Relation avec l'utilisateur (participant).
     */
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'utilisateur_id');
    }
}