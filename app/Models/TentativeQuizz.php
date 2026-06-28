<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TentativeQuizz extends Model
{
    use HasFactory;

    protected $fillable = [
        'utilisateur_id',
        'quiz_id',
        'score',
        'reussi',
        'date_tentative',
        'etat',
    ];

    protected function casts(): array
    {
        return [
            'reussi' => 'boolean',
            'score' => 'integer',
            'date_tentative' => 'datetime',
        ];
    }

    // ----- Relations -----

    /**
     * Relation avec l'utilisateur qui a fait la tentative.
     */
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'utilisateur_id');
    }

    /**
     * Relation avec le quiz concerné.
     */
    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    // ----- Relations futures (à décommenter si vous créez une table `tentative_reponses`) -----

    /**
     * Une tentative peut avoir plusieurs réponses (détail des questions/réponses).
     */
    // public function reponses()
    // {
    //     return $this->hasMany(TentativeReponse::class);
    // }
}