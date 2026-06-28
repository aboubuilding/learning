<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'siteName' => 'AquaForm',
            'heroEyebrow' => 'Plateforme e-learning du secteur de l\'eau',
            'heroTitle' => 'Formez vos équipes à la <em>sécurité</em>, à la <em>réglementation</em> et à la gestion des <em>produits chimiques</em>',
            'heroLead' => 'AquaForm rassemble les compétences essentielles des opérateurs de l\'eau et de l\'assainissement…',
            'stats' => [
                'modules'      => ['label'=>'Modules de formation', 'value'=>'120+', 'offset'=>40],
                'apprenants'   => ['label'=>'Apprenants formés', 'value'=>'8 400+', 'offset'=>20],
                'reussite'     => ['label'=>'Taux de réussite aux quiz', 'value'=>'86%', 'offset'=>55],
                'certificats'  => ['label'=>'Certificats délivrés', 'value'=>'5 900+', 'offset'=>70],
            ],
            'categories' => [
                ['nom'=>'Produits chimiques', 'description'=>'Stockage, dosage et manipulation sécurisée…'],
                ['nom'=>'Réglementation', 'description'=>'Textes en vigueur, normes de qualité…'],
                ['nom'=>'Recouvrement des coûts', 'description'=>'Tarification, facturation et stratégies…'],
                ['nom'=>'Sécurité', 'description'=>'Équipements de protection, procédures d\'urgence…'],
            ],
            'features' => [
                ['titre'=>'Vidéos de formation', 'desc'=>'Intégrées à la plateforme ou via lien externe…'],
                ['titre'=>'Diaporamas interactifs', 'desc'=>'Tutoriels pas à pas pour s\'approprier les procédures…'],
                ['titre'=>'Documents & fiches techniques', 'desc'=>'PDF, textes réglementaires et fiches techniques…'],
            ],
            'webinarTag' => 'Prochaine session en direct',
            'webinarTitle' => 'Manipulation sécurisée des produits chlorés — webinaire formateurs',
            'webinarDesc' => 'Rejoignez nos experts pour une session pratique…',
            'news' => [
                ['categorie'=>'Réglementation', 'titre'=>'Mise à jour des seuils de qualité de l\'eau potable', 'desc'=>'Nouveau module disponible…'],
                ['categorie'=>'Sécurité', 'titre'=>'Nouveau parcours sur les équipements de protection individuelle', 'desc'=>'Cinq modules vidéo…'],
                ['categorie'=>'Plateforme', 'titre'=>'Export des rapports d\'activité désormais disponible en Excel', 'desc'=>'Les administrateurs peuvent générer…'],
            ],
        ];

        return view('home', $data);
    }
}