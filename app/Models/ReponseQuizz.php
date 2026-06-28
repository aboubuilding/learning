<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReponseQuizz extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_quiz_id',
        'reponse',
        'est_correcte',
        'etat',
    ];

    protected function casts(): array
    {
        return [
            'est_correcte' => 'boolean',
        ];
    }

    // ----- Relations -----

    /**
     * Relation avec la question à laquelle appartient cette réponse.
     */
    public function question()
    {
        return $this->belongsTo(QuestionQuizz::class, 'question_quiz_id');
    }
}