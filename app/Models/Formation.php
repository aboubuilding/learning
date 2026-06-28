<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $fillable = [
        'categorie_formation_id',
        'formateur_id',
        'titre',
        'description',
        'duree_minutes',
        'niveau',
        'image',
        'est_publie',
        'etat',
    ];

    protected function casts(): array
    {
        return [
            'est_publie' => 'boolean',
            'duree_minutes' => 'integer',
        ];
    }

    // ----- Relations actuelles (existantes) -----

    /**
     * Relation avec la catégorie de la formation.
     */
    public function categorie()
    {
        return $this->belongsTo(CategorieFormation::class, 'categorie_formation_id');
    }

    /**
     * Relation avec l'utilisateur qui est le formateur.
     */
    public function formateur()
    {
        return $this->belongsTo(User::class, 'formateur_id');
    }

    /**
 * Les inscriptions à cette formation.
 */
public function inscriptions()
{
    return $this->hasMany(Inscription::class);
}

/**
 * Les apprenants inscrits à cette formation.
 */
public function apprenants()
{
    return $this->belongsToMany(User::class, 'inscriptions')
                ->withPivot('date_inscription', 'statut')
                ->withTimestamps();
}

/**
 * Les progressions des apprenants pour cette formation.
 */
public function progressions()
{
    return $this->hasMany(Progression::class);
}

// Dans app/Models/Formation.php

/**
 * Les sessions de cette formation.
 */
public function sessions()
{
    return $this->hasMany(SessionFormation::class);
}

/**
 * Récupérer les sessions actives de la formation.
 */
public function sessionsActives()
{
    return $this->sessions()->where('est_active', true);
}

/**
 * Récupérer les sessions à venir de la formation.
 */
public function sessionsAVenir()
{
    return $this->sessions()
        ->where('date_session', '>=', now()->toDateString())
        ->where('est_active', true);
}

// Dans app/Models/Formation.php

/**
 * Les discussions du forum pour cette formation.
 */
public function discussions()
{
    return $this->hasMany(ForumDiscussion::class);
}

/**
 * Récupérer les discussions non verrouillées.
 */
public function discussionsOuvertes()
{
    return $this->discussions()->where('est_verrouille', false);
}

// Dans app/Models/Formation.php

/**
 * Les évaluations de cette formation.
 */
public function evaluations()
{
    return $this->hasMany(EvaluationRessource::class, 'formation_id');
}

/**
 * Calculer la note moyenne de la formation.
 */
public function noteMoyenne()
{
    return $this->evaluations()->avg('note');
}

/**
 * Récupérer le nombre d'évaluations.
 */
public function nombreEvaluations()
{
    return $this->evaluations()->count();
}

/**
 * Calculer la répartition des notes.
 */
public function repartitionNotes()
{
    return $this->evaluations()
        ->selectRaw('note, COUNT(*) as total')
        ->groupBy('note')
        ->orderBy('note')
        ->pluck('total', 'note')
        ->toArray();
}

    // ----- Relations futures (à décommenter quand les modèles seront créés) -----

    /**
     * Une formation peut avoir plusieurs modules.
     */
    // public function modules()
    // {
    //     return $this->hasMany(Module::class);
    // }

    /**
     * Une formation peut avoir plusieurs quiz (si vous avez une table quiz).
     */
    // public function quiz()
    // {
    //     return $this->hasMany(Quiz::class);
    // }

    /**
     * Une formation peut avoir plusieurs inscriptions (table pivot).
     */
    // public function inscriptions()
    // {
    //     return $this->hasMany(Inscription::class);
    // }

    /**
     * Les apprenants inscrits à cette formation (via la table inscriptions).
     */
    // public function apprenants()
    // {
    //     return $this->belongsToMany(User::class, 'inscriptions')
    //                 ->withPivot('date_inscription', 'statut')
    //                 ->withTimestamps();
    // }

    /**
     * Une formation peut avoir plusieurs progressions (pour suivre l'avancement de chaque apprenant).
     */
    // public function progressions()
    // {
    //     return $this->hasMany(Progression::class);
    // }
}