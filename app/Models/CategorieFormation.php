<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieFormation extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'etat',
    ];

    // ----- Relations -----

    public function formations()
    {
        return $this->hasMany(Formation::class);
    }
}