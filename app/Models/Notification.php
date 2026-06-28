<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'utilisateur_id',
        'titre',
        'message',
        'lu',
        'date_lecture',
        'etat',
    ];

    protected function casts(): array
    {
        return [
            'lu' => 'boolean',
            'date_lecture' => 'datetime',
        ];
    }

    // ----- Relations -----

    /**
     * Relation avec l'utilisateur destinataire de la notification.
     */
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'utilisateur_id');
    }
}