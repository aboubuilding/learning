<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'formation_id',    // À ajouter dans votre migration si ce n'est pas déjà fait
        'formateur_id',
        'titre',
        'description',
        'ordre',
        'etat',
    ];

    protected function casts(): array
    {
        return [
            'ordre' => 'integer',
        ];
    }

    // ----- Relations actuelles -----

    /**
     * Relation avec le formateur (utilisateur) associé à ce module.
     */
    public function formateur()
    {
        return $this->belongsTo(User::class, 'formateur_id');
    }

    /**
     * Relation avec la formation à laquelle appartient ce module.
     * (À décommenter si vous ajoutez la colonne `formation_id` dans la table `modules`)
     */
    // public function formation()
    // {
    //     return $this->belongsTo(Formation::class, 'formation_id');
    // }

    // ----- Relations futures (à décommenter quand les modèles seront créés) -----

    /**
     * Un module peut contenir plusieurs ressources (vidéos, diaporamas, PDF, etc.)
     * si vous créez une table `contenus` ou `ressources`.
     */
    // public function contenus()
    // {
    //     return $this->hasMany(Contenu::class);
    // }

    /**
     * Un module peut avoir plusieurs quiz.
     */
    // public function quiz()
    // {
    //     return $this->hasMany(Quiz::class);
    // }

    /**
     * Un module peut avoir plusieurs progressions (suivi par apprenant).
     */
    // public function progressions()
    // {
    //     return $this->hasMany(Progression::class);
    // }
}