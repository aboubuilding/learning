<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'etat',
    ];

    // ----- Relations -----

    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Dans app/Models/Role.php

/**
 * Les utilisateurs ayant ce rôle.
 */
public function utilisateurs()
{
    return $this->belongsToMany(User::class, 'utilisateur_roles', 'role_id', 'user_id')
                ->withTimestamps();
}
}