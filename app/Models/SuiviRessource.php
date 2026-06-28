<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuiviRessource extends Model
{
    use HasFactory;

    protected $fillable = [
        'utilisateur_id',
        'ressource_pedagogique_id',
        'consultee',
        'terminee',
        'temps_passe_secondes',
        'premiere_consultation',
        'derniere_consultation',
        'date_completion',
        'etat',
    ];

    protected function casts(): array
    {
        return [
            'consultee' => 'boolean',
            'terminee' => 'boolean',
            'temps_passe_secondes' => 'integer',
            'premiere_consultation' => 'datetime',
            'derniere_consultation' => 'datetime',
            'date_completion' => 'datetime',
        ];
    }

    // ----- Relations -----

    /**
     * Relation avec l'utilisateur.
     */
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'utilisateur_id');
    }

    /**
     * Relation avec la ressource pédagogique.
     */
    public function ressource()
    {
        return $this->belongsTo(Ressource::class, 'ressource_pedagogique_id');
    }

    // ----- Méthodes utilitaires -----

    /**
     * Marquer la ressource comme consultée.
     */
    public function marquerConsulte()
    {
        $this->update([
            'consultee' => true,
            'premiere_consultation' => $this->premiere_consultation ?? now(),
            'derniere_consultation' => now(),
        ]);
    }

    /**
     * Marquer la ressource comme terminée.
     */
    public function marquerTermine()
    {
        $this->update([
            'terminee' => true,
            'date_completion' => now(),
            'derniere_consultation' => now(),
        ]);
    }

    /**
     * Ajouter du temps passé sur la ressource.
     */
    public function ajouterTempsPasse($secondes)
    {
        $this->increment('temps_passe_secondes', $secondes);
        $this->update(['derniere_consultation' => now()]);
    }

    /**
     * Vérifier si la ressource est terminée.
     */
    public function estTerminee()
    {
        return $this->terminee === true;
    }

    /**
     * Vérifier si la ressource a été consultée.
     */
    public function estConsultee()
    {
        return $this->consultee === true;
    }

    /**
     * Calculer le temps passé en format lisible.
     */
    public function tempsPasseFormate()
    {
        $secondes = $this->temps_passe_secondes;
        $heures = floor($secondes / 3600);
        $minutes = floor(($secondes % 3600) / 60);
        $secondesRestantes = $secondes % 60;

        if ($heures > 0) {
            return sprintf('%dh %02dm %02ds', $heures, $minutes, $secondesRestantes);
        } elseif ($minutes > 0) {
            return sprintf('%dm %02ds', $minutes, $secondesRestantes);
        }
        return sprintf('%ds', $secondesRestantes);
    }
}