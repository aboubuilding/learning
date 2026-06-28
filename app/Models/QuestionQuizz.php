<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionQuizz extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'question',
        'explication',
        'points',
        'etat',
    ];

    protected function casts(): array
    {
        return [
            'points' => 'integer',
        ];
    }

    // ----- Relations -----

    /**
     * Relation avec le quiz auquel appartient cette question.
     */
    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    // ----- Relations futures (à décommenter quand les modèles seront créés) -----

    /**
     * Une question peut avoir plusieurs réponses possibles.
     */
    // public function reponses()
    // {
    //     return $this->hasMany(ReponseQuestion::class);
    // }

    /**
     * Une question peut avoir plusieurs tentatives de réponses (par les utilisateurs).
     */
    // public function tentatives()
    // {
    //     return $this->hasMany(TentativeReponse::class);
    // }
}