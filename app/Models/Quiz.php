<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'titre',
        'score_minimal',
        'nombre_max_tentatives',
        'etat',
    ];

    protected function casts(): array
    {
        return [
            'score_minimal' => 'integer',
            'nombre_max_tentatives' => 'integer',
        ];
    }

    // ----- Relations -----

    /**
     * Relation avec le module auquel appartient ce quiz.
     */
    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    /**
 * Les tentatives pour ce quiz.
 */
public function tentatives()
{
    return $this->hasMany(TentativeQuizz::class);
}

    // ----- Relations futures (à décommenter quand les modèles seront créés) -----

    /**
     * Un quiz peut avoir plusieurs questions.
     */
    // public function questions()
    // {
    //     return $this->hasMany(Question::class);
    // }

    /**
     * Un quiz peut avoir plusieurs tentatives (réponses des utilisateurs).
     */
    // public function tentatives()
    // {
    //     return $this->hasMany(TentativeQuiz::class);
    // }
}