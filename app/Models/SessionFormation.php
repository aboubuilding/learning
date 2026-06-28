<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionFormation extends Model
{
    use HasFactory;

    protected $fillable = [
        'formation_id',
        'titre',
        'description',
        'date_session',
        'heure_debut',
        'heure_fin',
        'type_session',
        'lieu',
        'lien_visioconference',
        'nombre_places',
        'est_active',
        'etat',
    ];

    protected function casts(): array
    {
        return [
            'date_session' => 'date',
            'heure_debut' => 'datetime:H:i',
            'heure_fin' => 'datetime:H:i',
            'est_active' => 'boolean',
            'nombre_places' => 'integer',
        ];
    }

    // ----- Relations -----

    /**
     * Relation avec la formation associée à cette session.
     */
    public function formation()
    {
        return $this->belongsTo(Formation::class, 'formation_id');
    }


    // Dans app/Models/SessionFormation.php

/**
 * Les participants à cette session.
 */
public function participants()
{
    return $this->hasMany(ParticipantSession::class, 'session_formation_id');
}

/**
 * Les utilisateurs inscrits à cette session.
 */
public function inscrits()
{
    return $this->belongsToMany(User::class, 'participant_sessions', 'session_formation_id', 'utilisateur_id')
                ->withPivot('presence', 'date_inscription')
                ->withTimestamps();
}

/**
 * Vérifier si un utilisateur est inscrit à cette session.
 */
public function estInscrit($utilisateurId)
{
    return $this->participants()
        ->where('utilisateur_id', $utilisateurId)
        ->exists();
}

/**
 * Compter le nombre d'inscrits.
 */
public function nombreInscrits()
{
    return $this->participants()->count();
}

/**
 * Compter le nombre de présents.
 */
public function nombrePresents()
{
    return $this->participants()->where('presence', true)->count();
}

/**
 * Vérifier si la session est complète.
 */
public function estComplete()
{
    if (is_null($this->nombre_places)) {
        return false;
    }
    return $this->nombreInscrits() >= $this->nombre_places;
}

/**
 * Récupérer les places restantes.
 */
public function placesRestantes()
{
    if (is_null($this->nombre_places)) {
        return null;
    }
    return max(0, $this->nombre_places - $this->nombreInscrits());
}
}