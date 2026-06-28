<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumDiscussion extends Model
{
    use HasFactory;

    protected $fillable = [
        'formation_id',
        'titre',
        'description',
        'est_verrouille',
        'etat',
    ];

    protected function casts(): array
    {
        return [
            'est_verrouille' => 'boolean',
        ];
    }

    // ----- Relations -----

    /**
     * Relation avec la formation associée à cette discussion.
     */
    public function formation()
    {
        return $this->belongsTo(Formation::class, 'formation_id');
    }

    // Dans app/Models/ForumDiscussion.php

/**
 * Les messages de cette discussion.
 */
public function messages()
{
    return $this->hasMany(MessageForum::class, 'forum_discussion_id');
}

/**
 * Récupérer les messages principaux (non-réponses) de la discussion.
 */
public function messagesPrincipaux()
{
    return $this->messages()->whereNull('message_parent_id');
}

    // ----- Relations futures (à décommenter si vous créez la table forum_messages) -----

    /**
     * Une discussion peut avoir plusieurs messages.
     */
    // public function messages()
    // {
    //     return $this->hasMany(ForumMessage::class);
    // }
}