<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'photo',
        'email_verifie_le',
        'mot_de_passe',
        'role_id',
        'etat',
    ];

    protected $hidden = [
        'mot_de_passe',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verifie_le' => 'datetime',
        ];
    }

    /**
     * Surcharge obligatoire car le champ de mot de passe s'appelle "mot_de_passe".
     */
    public function getAuthPassword()
    {
        return $this->mot_de_passe;
    }

    // ----- Relations -----

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Un utilisateur peut être formateur pour plusieurs formations
    public function formationsAnimees()
    {
        return $this->hasMany(Formation::class, 'formateur_id');
    }

    /**
 * Les formations auxquelles l'utilisateur est inscrit.
 */
public function formationsInscrit()
{
    return $this->belongsToMany(Formation::class, 'inscriptions')
                ->withPivot('date_inscription', 'statut')
                ->withTimestamps();
}

/**
 * Les inscriptions de l'utilisateur.
 */
public function inscriptions()
{
    return $this->hasMany(Inscription::class, 'utilisateur_id');
}

/**
 * Les progressions de l'utilisateur (pour chaque formation).
 */
public function progressions()
{
    return $this->hasMany(Progression::class, 'utilisateur_id');
}

/**
 * Récupérer la progression d'une formation spécifique.
 */
public function progressionPourFormation($formationId)
{
    return $this->progressions()->where('formation_id', $formationId)->first();
}

/**
 * Les tentatives de quiz de l'utilisateur.
 */
public function tentativesQuizz()
{
    return $this->hasMany(TentativeQuizz::class, 'utilisateur_id');
}

// Dans app/Models/User.php

/**
 * Les activités journalisées de l'utilisateur.
 */
public function activites()
{
    return $this->hasMany(JournalActivite::class, 'utilisateur_id');
}

/**
 * Récupérer les dernières activités de l'utilisateur.
 */
public function dernieresActivites($limite = 10)
{
    return $this->activites()
        ->latest()
        ->limit($limite)
        ->get();
}

// Dans app/Models/User.php

/**
 * Les sessions de formation auxquelles l'utilisateur participe.
 */
public function sessionsParticipant()
{
    return $this->belongsToMany(SessionFormation::class, 'participant_sessions', 'utilisateur_id', 'session_formation_id')
                ->withPivot('presence', 'date_inscription')
                ->withTimestamps();
}

/**
 * Les inscriptions aux sessions (pivot).
 */
public function inscriptionsSessions()
{
    return $this->hasMany(ParticipantSession::class, 'utilisateur_id');
}

/**
 * Vérifier si l'utilisateur est inscrit à une session.
 */
public function estInscritASession($sessionId)
{
    return $this->sessionsParticipant()
        ->where('session_formation_id', $sessionId)
        ->exists();
}

/**
 * Récupérer les sessions à venir de l'utilisateur.
 */
public function sessionsAVenir()
{
    return $this->sessionsParticipant()
        ->where('date_session', '>=', now()->toDateString())
        ->where('est_active', true)
        ->orderBy('date_session')
        ->orderBy('heure_debut');
}

/**
 * Récupérer les sessions passées de l'utilisateur.
 */
public function sessionsPassees()
{
    return $this->sessionsParticipant()
        ->where('date_session', '<', now()->toDateString())
        ->orderByDesc('date_session')
        ->orderByDesc('heure_debut');
}

// Dans app/Models/User.php

/**
 * Les suivis des ressources pédagogiques par l'utilisateur.
 */
public function suiviRessources()
{
    return $this->hasMany(SuiviRessource::class, 'utilisateur_id');
}

/**
 * Récupérer le suivi d'une ressource spécifique.
 */
public function suiviPourRessource($ressourceId)
{
    return $this->suiviRessources()
        ->where('ressource_pedagogique_id', $ressourceId)
        ->first();
}

/**
 * Récupérer les ressources consultées par l'utilisateur.
 */
public function ressourcesConsultees()
{
    return $this->belongsToMany(Ressource::class, 'suivi_ressources', 'utilisateur_id', 'ressource_pedagogique_id')
                ->withPivot('consultee', 'terminee', 'temps_passe_secondes', 'premiere_consultation', 'derniere_consultation', 'date_completion')
                ->withTimestamps();
}

/**
 * Récupérer les ressources terminées par l'utilisateur.
 */
public function ressourcesTerminees()
{
    return $this->ressourcesConsultees()
        ->wherePivot('terminee', true);
}

/**
 * Calculer le temps total passé par l'utilisateur sur toutes les ressources.
 */
public function tempsTotalRessources()
{
    return $this->suiviRessources()->sum('temps_passe_secondes');
}

// Dans app/Models/User.php

/**
 * Les évaluations données par l'utilisateur.
 */
public function evaluations()
{
    return $this->hasMany(EvaluationRessource::class, 'utilisateur_id');
}

/**
 * Vérifier si l'utilisateur a évalué une formation.
 */
public function aEvalueFormation($formationId)
{
    return $this->evaluations()
        ->where('formation_id', $formationId)
        ->exists();
}

/**
 * Récupérer l'évaluation d'une formation spécifique.
 */
public function evaluationPourFormation($formationId)
{
    return $this->evaluations()
        ->where('formation_id', $formationId)
        ->first();
}

// Dans app/Models/User.php

/**
 * Les rôles de l'utilisateur (via la table pivot).
 */
public function roles()
{
    return $this->belongsToMany(Role::class, 'utilisateur_roles', 'user_id', 'role_id')
                ->withTimestamps();
}

/**
 * Vérifier si l'utilisateur a un rôle spécifique.
 */
public function aRole($roleNom)
{
    return $this->roles()->where('nom', $roleNom)->exists();
}

/**
 * Vérifier si l'utilisateur est administrateur.
 */
public function estAdministrateur()
{
    return $this->aRole('Administrateur');
}

/**
 * Vérifier si l'utilisateur est formateur.
 */
public function estFormateur()
{
    return $this->aRole('Formateur');
}

/**
 * Vérifier si l'utilisateur est apprenant.
 */
public function estApprenant()
{
    return $this->aRole('Apprenant');
}

/**
 * Assigner un rôle à l'utilisateur.
 */
public function assignerRole($roleId)
{
    if (!$this->roles()->where('role_id', $roleId)->exists()) {
        $this->roles()->attach($roleId);
    }
}

/**
 * Retirer un rôle à l'utilisateur.
 */
public function retirerRole($roleId)
{
    $this->roles()->detach($roleId);
}

/**
 * Synchroniser les rôles de l'utilisateur.
 */
public function synchroniserRoles(array $roleIds)
{
    $this->roles()->sync($roleIds);
}

    // Un utilisateur peut s'inscrire à plusieurs formations (via une table pivot à créer)
    // public function inscriptions() { return $this->hasMany(Inscription::class); }
    // public function formationsSuivies() { return $this->belongsToMany(Formation::class, 'inscriptions'); }
}