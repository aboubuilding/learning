<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationRessource extends Model
{
    use HasFactory;

    protected $fillable = [
        'formation_id',
        'utilisateur_id',
        'note',
        'commentaire',
        'etat',
    ];

    protected function casts(): array
    {
        return [
            'note' => 'integer',
        ];
    }

    // ----- Relations -----

    /**
     * Relation avec la formation évaluée.
     */
    public function formation()
    {
        return $this->belongsTo(Formation::class, 'formation_id');
    }

    /**
     * Relation avec l'utilisateur qui a donné l'évaluation.
     */
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'utilisateur_id');
    }

    // ----- Méthodes utilitaires -----

    /**
     * Vérifier si l'évaluation est positive (note >= 4).
     */
    public function estPositive()
    {
        return $this->note >= 4;
    }

    /**
     * Vérifier si l'évaluation est négative (note <= 2).
     */
    public function estNegative()
    {
        return $this->note <= 2;
    }

    /**
     * Vérifier si l'évaluation est neutre (note = 3).
     */
    public function estNeutre()
    {
        return $this->note == 3;
    }

    /**
     * Convertir la note en étoiles (pour affichage).
     */
    public function etoiles()
    {
        return str_repeat('⭐', $this->note) . str_repeat('☆', 5 - $this->note);
    }

    /**
     * Récupérer le libellé de la note.
     */
    public function libelleNote()
    {
        return match ($this->note) {
            1 => 'Très insatisfaisant',
            2 => 'Insatisfaisant',
            3 => 'Moyen',
            4 => 'Satisfaisant',
            5 => 'Très satisfaisant',
            default => 'Non évalué',
        };
    }
}