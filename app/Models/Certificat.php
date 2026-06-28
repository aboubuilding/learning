<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificat extends Model
{
    use HasFactory;

    protected $fillable = [
        'utilisateur_id',
        'formation_id',
        'numero_certificat',
        'chemin_pdf',
        'date_delivrance',
        'etat',
    ];

    protected function casts(): array
    {
        return [
            'date_delivrance' => 'datetime',
        ];
    }

    // ----- Relations -----

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'utilisateur_id');
    }

    public function formation()
    {
        return $this->belongsTo(Formation::class, 'formation_id');
    }
}