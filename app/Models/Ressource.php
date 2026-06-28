<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ressource extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'titre',
        'type',
        'chemin_fichier',
        'url_externe',
        'ordre',
        'telechargeable',
        'etat',
    ];

    protected function casts(): array
    {
        return [
            'ordre' => 'integer',
            'telechargeable' => 'boolean',
        ];
    }

    // ----- Relations -----

    /**
     * Relation avec le module auquel appartient cette ressource.
     */
    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }


    // Dans app/Models/Ressource.php

/**
 * Les suivis des utilisateurs pour cette ressource.
 */
public function suivis()
{
    return $this->hasMany(SuiviRessource::class, 'ressource_pedagogique_id');
}

/**
 * Récupérer le nombre d'utilisateurs ayant consulté cette ressource.
 */
public function nombreConsultations()
{
    return $this->suivis()->where('consultee', true)->count();
}

/**
 * Récupérer le nombre d'utilisateurs ayant terminé cette ressource.
 */
public function nombreTerminees()
{
    return $this->suivis()->where('terminee', true)->count();
}

/**
 * Calculer le taux de complétion de cette ressource.
 */
public function tauxCompletion()
{
    $total = $this->suivis()->count();
    if ($total === 0) {
        return 0;
    }
    $terminees = $this->suivis()->where('terminee', true)->count();
    return round(($terminees / $total) * 100, 2);
}
}