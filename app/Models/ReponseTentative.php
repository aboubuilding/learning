<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReponseTentative extends Model
{
    use HasFactory;

    protected $fillable = [
        'tentative_quiz_id',
        'question_quiz_id',
        'reponse_quiz_id',
        'etat',
    ];

    // ----- Relations -----

    /**
     * Relation avec la tentative de quiz.
     */
    public function tentativeQuiz()
    {
        return $this->belongsTo(TentativeQuizz::class, 'tentative_quiz_id');
    }

    /**
     * Relation avec la question concernée.
     */
    public function question()
    {
        return $this->belongsTo(QuestionQuizz::class, 'question_quiz_id');
    }

    /**
     * Relation avec la réponse choisie (si c'est une QCM).
     */
    public function reponseChoisie()
    {
        return $this->belongsTo(ReponseQuizz::class, 'reponse_quiz_id');
    }
}