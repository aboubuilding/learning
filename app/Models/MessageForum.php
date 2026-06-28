<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageForum extends Model
{
    use HasFactory;

    protected $fillable = [
        'forum_discussion_id',
        'utilisateur_id',
        'message_parent_id',
        'contenu',
        'est_modifie',
        'date_modification',
        'etat',
    ];

    protected function casts(): array
    {
        return [
            'est_modifie' => 'boolean',
            'date_modification' => 'datetime',
        ];
    }

    // ----- Relations -----

    /**
     * Relation avec la discussion à laquelle appartient ce message.
     */
    public function discussion()
    {
        return $this->belongsTo(ForumDiscussion::class, 'forum_discussion_id');
    }

    /**
     * Relation avec l'utilisateur auteur du message.
     */
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'utilisateur_id');
    }

    /**
     * Relation avec le message parent (si c'est une réponse).
     */
    public function parent()
    {
        return $this->belongsTo(MessageForum::class, 'message_parent_id');
    }

    /**
     * Relation avec les réponses à ce message.
     */
    public function reponses()
    {
        return $this->hasMany(MessageForum::class, 'message_parent_id');
    }

    // ----- Méthodes utilitaires -----

    /**
     * Vérifier si le message est une réponse.
     */
    public function estReponse()
    {
        return !is_null($this->message_parent_id);
    }

    /**
     * Vérifier si le message a été modifié.
     */
    public function aEteModifie()
    {
        return $this->est_modifie;
    }
}