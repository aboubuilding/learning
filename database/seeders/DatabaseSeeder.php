<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\CategorieFormation;
use App\Models\Formation;
use App\Models\Module;
use App\Models\Ressource;
use App\Models\Inscription;
use App\Models\Progression;
use App\Models\Quiz;
use App\Models\QuestionQuizz;
use App\Models\ReponseQuizz;
use App\Models\TentativeQuizz;
use App\Models\ReponseTentative;
use App\Models\Certificat;
use App\Models\JournalActivite;
use App\Models\Notification;
use App\Models\SessionFormation;
use App\Models\ParticipantSession;
use App\Models\ForumDiscussion;
use App\Models\MessageForum;
use App\Models\SuiviRessource;
use App\Models\EvaluationRessource;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // --- 1. RÔLES ---
        $roleAdmin = Role::firstOrCreate(['nom' => 'Administrateur'], ['description' => 'Accès total', 'etat' => 1]);
        $roleFormateur = Role::firstOrCreate(['nom' => 'Formateur'], ['description' => 'Gère les formations', 'etat' => 1]);
        $roleApprenant = Role::firstOrCreate(['nom' => 'Apprenant'], ['description' => 'Suit les formations', 'etat' => 1]);

        // --- 2. CATÉGORIES ---
        $categories = [];
        foreach (['Produits chimiques', 'Réglementation', 'Recouvrement des coûts', 'Sécurité'] as $nom) {
            $categories[] = CategorieFormation::firstOrCreate(
                ['nom' => $nom],
                ['description' => "Formation sur $nom", 'etat' => 1]
            );
        }

        // --- 3. UTILISATEURS ---
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'nom' => 'Admin',
                'prenom' => 'Super',
                'telephone' => '0612345678',
                'photo' => null,
                'mot_de_passe' => Hash::make('password'),
                'etat' => 1,
            ]
        );
        $admin->roles()->syncWithoutDetaching([$roleAdmin->id]);

        $formateurs = [];
        foreach ([
            ['nom' => 'Dupont', 'prenom' => 'Jean', 'email' => 'jean.dupont@example.com'],
            ['nom' => 'Martin', 'prenom' => 'Sophie', 'email' => 'sophie.martin@example.com'],
            ['nom' => 'Bernard', 'prenom' => 'Pierre', 'email' => 'pierre.bernard@example.com'],
        ] as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'nom' => $data['nom'],
                    'prenom' => $data['prenom'],
                    'telephone' => '06' . fake()->unique()->numberBetween(10000000, 99999999),
                    'photo' => null,
                    'mot_de_passe' => Hash::make('password'),
                    'etat' => 1,
                ]
            );
            $user->roles()->syncWithoutDetaching([$roleFormateur->id]);
            $formateurs[] = $user;
        }

        $apprenants = [];
        for ($i = 0; $i < 20; $i++) {
            $user = User::firstOrCreate(
                ['email' => fake()->unique()->safeEmail()],
                [
                    'nom' => fake()->lastName(),
                    'prenom' => fake()->firstName(),
                    'telephone' => '06' . fake()->unique()->numberBetween(10000000, 99999999),
                    'photo' => null,
                    'mot_de_passe' => Hash::make('password'),
                    'etat' => 1,
                ]
            );
            $user->roles()->syncWithoutDetaching([$roleApprenant->id]);
            $apprenants[] = $user;
        }
        $allUsers = User::all();

        // --- 4. FORMATIONS ---
        $formations = [];
        $titles = [
            'Sécurité chimique avancée',
            'Introduction aux réglementations REACH',
            'Gestion des coûts en entreprise',
            'Sécurité au travail : bases',
            'Produits chimiques : stockage et transport'
        ];
        $descriptions = [
            'Formation approfondie sur la manipulation des produits chimiques',
            'Comprendre et appliquer les réglementations REACH',
            'Méthodes de recouvrement et optimisation budgétaire',
            'Les fondamentaux de la sécurité en milieu professionnel',
            'Bonnes pratiques pour le stockage et le transport sécurisé'
        ];
        $durees = [480, 360, 300, 240, 200];
        $niveaux = ['avance', 'intermediaire', 'intermediaire', 'debutant', 'intermediaire'];

        for ($i = 0; $i < 5; $i++) {
            $formation = Formation::create([
                'categorie_formation_id' => $categories[array_rand($categories)]->id,
                'formateur_id' => $formateurs[array_rand($formateurs)]->id,
                'titre' => $titles[$i],
                'description' => $descriptions[$i],
                'duree_minutes' => $durees[$i],
                'niveau' => $niveaux[$i],
                'image' => null,
                'est_publie' => true,
                'etat' => 1,
            ]);
            $formations[] = $formation;
        }

        // --- 5. MODULES ---
        $modules = [];
        foreach ($formations as $formation) {
            $nb = rand(3, 6);
            for ($i = 1; $i <= $nb; $i++) {
                $module = Module::create([
                    'formation_id' => $formation->id,
                    'formateur_id' => $formateurs[array_rand($formateurs)]->id,
                    'titre' => 'Module ' . $i . ' - ' . fake()->sentence(3),
                    'description' => fake()->paragraph(2),
                    'ordre' => $i,
                    'etat' => 1,
                ]);
                $modules[] = $module;
            }
        }

        // --- 6. RESSOURCES ---
        $ressources = [];
        $types = ['video', 'pdf', 'diaporama', 'guide', 'lien'];
        foreach ($modules as $module) {
            $nb = rand(2, 5);
            for ($i = 1; $i <= $nb; $i++) {
                $type = $types[array_rand($types)];
                $ressource = Ressource::create([
                    'module_id' => $module->id,
                    'titre' => fake()->sentence(4),
                    'type' => $type,
                    'chemin_fichier' => $type !== 'lien' ? 'ressources/' . fake()->uuid() . '.' . ($type === 'video' ? 'mp4' : 'pdf') : null,
                    'url_externe' => $type === 'lien' ? fake()->url() : null,
                    'ordre' => $i,
                    'telechargeable' => fake()->boolean(80),
                    'etat' => 1,
                ]);
                $ressources[] = $ressource;
            }
        }

        // --- 7. INSCRIPTIONS ---
        $inscriptions = [];
        foreach ($apprenants as $user) {
            $nb = rand(2, min(5, count($formations)));
            $selected = fake()->randomElements($formations, $nb);
            foreach ($selected as $formation) {
                $inscription = Inscription::firstOrCreate(
                    ['utilisateur_id' => $user->id, 'formation_id' => $formation->id],
                    [
                        'date_inscription' => fake()->dateTimeBetween('-3 months', 'now'),
                        'statut' => fake()->randomElement(['active', 'terminee', 'en_attente']),
                        'etat' => 1,
                    ]
                );
                $inscriptions[] = $inscription;
            }
        }

        // --- 8. PROGRESSIONS ---
        foreach ($inscriptions as $inscription) {
            $taux = fake()->numberBetween(0, 100);
            Progression::firstOrCreate(
                [
                    'utilisateur_id' => $inscription->utilisateur_id,
                    'formation_id' => $inscription->formation_id,
                ],
                [
                    'taux_completion' => $taux,
                    'date_completion' => $taux == 100 ? fake()->dateTimeBetween('-1 month', 'now') : null,
                    'etat' => 1,
                ]
            );
        }

        // --- 9. QUIZZES ---
        $quizzes = [];
        foreach ($modules as $module) {
            if (fake()->boolean(70)) {
                $quiz = Quiz::create([
                    'module_id' => $module->id,
                    'titre' => 'Quiz - ' . $module->titre,
                    'score_minimal' => fake()->numberBetween(60, 80),
                    'nombre_max_tentatives' => fake()->numberBetween(2, 5),
                    'etat' => 1,
                ]);
                $quizzes[] = $quiz;
            }
        }

        // --- 10. QUESTIONS & RÉPONSES ---
        foreach ($quizzes as $quiz) {
            $nbQuestions = rand(5, 10);
            for ($i = 0; $i < $nbQuestions; $i++) {
                $question = QuestionQuizz::create([
                    'quiz_id' => $quiz->id,
                    'question' => fake()->sentence(6) . ' ?',
                    'explication' => fake()->sentence(10),
                    'points' => rand(1, 3),
                    'etat' => 1,
                ]);
                $nbReponses = rand(3, 5);
                $bonneIndex = rand(0, $nbReponses - 1);
                for ($j = 0; $j < $nbReponses; $j++) {
                    ReponseQuizz::create([
                        'question_quiz_id' => $question->id,
                        'reponse' => fake()->sentence(4),
                        'est_correcte' => $j === $bonneIndex,
                        'etat' => 1,
                    ]);
                }
            }
        }

        // --- 11. SESSIONS ---
        $sessions = [];
        foreach ($formations as $formation) {
            $nb = rand(1, 3);
            for ($i = 0; $i < $nb; $i++) {
                $date = fake()->dateTimeBetween('-1 month', '+3 months');
                $session = SessionFormation::create([
                    'formation_id' => $formation->id,
                    'titre' => 'Session du ' . $date->format('d/m/Y'),
                    'description' => fake()->sentence(10),
                    'date_session' => $date,
                    'heure_debut' => fake()->time('H:i:s'),
                    'heure_fin' => fake()->time('H:i:s'),
                    'type_session' => fake()->randomElement(['presentiel', 'visioconference', 'hybride']),
                    'lieu' => fake()->address(),
                    'lien_visioconference' => 'https://meet.example.com/' . fake()->slug(),
                    'nombre_places' => rand(10, 30),
                    'est_active' => fake()->boolean(80),
                    'etat' => 1,
                ]);
                $sessions[] = $session;
            }
        }

        // --- 12. PARTICIPANTS AUX SESSIONS ---
        foreach ($sessions as $session) {
            if (count($apprenants) === 0) continue;
            $nb = rand(5, min(20, count($apprenants)));
            $selected = fake()->randomElements($apprenants, $nb);
            foreach ($selected as $user) {
                ParticipantSession::firstOrCreate(
                    [
                        'session_formation_id' => $session->id,
                        'utilisateur_id' => $user->id,
                    ],
                    [
                        'presence' => fake()->boolean(70),
                        'date_inscription' => fake()->dateTimeBetween('-2 weeks', 'now'),
                        'etat' => 1,
                    ]
                );
            }
        }

        // --- 13. FORUMS & MESSAGES ---
        foreach ($formations as $formation) {
            $nbDiscussions = rand(1, 3);
            for ($i = 0; $i < $nbDiscussions; $i++) {
                $discussion = ForumDiscussion::create([
                    'formation_id' => $formation->id,
                    'titre' => fake()->sentence(5),
                    'description' => fake()->paragraph(2),
                    'est_verrouille' => fake()->boolean(20),
                    'etat' => 1,
                ]);
                $nbMessages = rand(5, 15);
                $messages = [];
                for ($j = 0; $j < $nbMessages; $j++) {
                    $user = $allUsers->random();
                    $parentId = ($j > 0 && fake()->boolean(30)) ? $messages[array_rand($messages)]->id : null;
                    $msg = MessageForum::create([
                        'forum_discussion_id' => $discussion->id,
                        'utilisateur_id' => $user->id,
                        'message_parent_id' => $parentId,
                        'contenu' => fake()->paragraph(2),
                        'est_modifie' => fake()->boolean(10),
                        'date_modification' => fake()->optional(0.2)->dateTimeBetween('-1 week', 'now'),
                        'etat' => 1,
                    ]);
                    $messages[] = $msg;
                }
            }
        }

        // --- 14. SUIVI RESSOURCES ---
        if (count($ressources) > 0) {
            foreach ($apprenants as $user) {
                $nb = rand(round(count($ressources) * 0.3), round(count($ressources) * 0.6));
                $selected = fake()->randomElements($ressources, $nb);
                foreach ($selected as $ressource) {
                    $consultee = fake()->boolean(80);
                    $terminee = $consultee && fake()->boolean(60);
                    SuiviRessource::create([
                        'utilisateur_id' => $user->id,
                        'ressource_pedagogique_id' => $ressource->id,
                        'consultee' => $consultee,
                        'terminee' => $terminee,
                        'temps_passe_secondes' => rand(30, 600),
                        'premiere_consultation' => $consultee ? fake()->dateTimeBetween('-2 months', 'now') : null,
                        'derniere_consultation' => $consultee ? fake()->dateTimeBetween('-1 month', 'now') : null,
                        'date_completion' => $terminee ? fake()->dateTimeBetween('-1 month', 'now') : null,
                        'etat' => 1,
                    ]);
                }
            }
        }

        // --- 15. ÉVALUATIONS ---
        $terminees = Inscription::where('statut', 'terminee')->get();
        foreach ($terminees as $inscription) {
            if (fake()->boolean(60)) {
                EvaluationRessource::create([
                    'formation_id' => $inscription->formation_id,
                    'utilisateur_id' => $inscription->utilisateur_id,
                    'note' => rand(1, 5),
                    'commentaire' => fake()->optional(0.7)->sentence(8),
                    'etat' => 1,
                ]);
            }
        }

        // --- 16. CERTIFICATS ---
        $completees = Progression::where('taux_completion', 100)->get();
        foreach ($completees as $progression) {
            $exists = Certificat::where('utilisateur_id', $progression->utilisateur_id)
                ->where('formation_id', $progression->formation_id)
                ->exists();
            if (!$exists) {
                Certificat::create([
                    'utilisateur_id' => $progression->utilisateur_id,
                    'formation_id' => $progression->formation_id,
                    'numero_certificat' => 'CERT-' . date('Y') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT),
                    'chemin_pdf' => 'certificats/cert_' . fake()->uuid() . '.pdf',
                    'date_delivrance' => fake()->dateTimeBetween('-1 month', 'now'),
                    'etat' => 1,
                ]);
            }
        }

        // --- 17. NOTIFICATIONS ---
        foreach ($allUsers as $user) {
            for ($i = 0; $i < rand(2, 5); $i++) {
                Notification::create([
                    'utilisateur_id' => $user->id,
                    'titre' => fake()->sentence(3),
                    'message' => fake()->paragraph(2),
                    'lu' => fake()->boolean(70),
                    'date_lecture' => fake()->optional(0.7)->dateTimeBetween('-1 week', 'now'),
                    'etat' => 1,
                ]);
            }
        }

        // --- 18. JOURNAL D'ACTIVITÉS ---
        $actions = ['connexion', 'deconnexion', 'consultation_formation', 'telechargement', 'quiz_tente'];
        foreach ($allUsers as $user) {
            for ($i = 0; $i < rand(5, 15); $i++) {
                JournalActivite::create([
                    'utilisateur_id' => $user->id,
                    'action' => fake()->randomElement($actions),
                    'description' => fake()->sentence(6),
                    'adresse_ip' => fake()->ipv4(),
                    'temps_passe_secondes' => fake()->optional(0.5)->numberBetween(10, 600),
                    'etat' => 1,
                    'created_at' => fake()->dateTimeBetween('-3 months', 'now'),
                ]);
            }
        }

        // --- 19. TENTATIVES DE QUIZ (CORRIGÉ) ---
        if (count($quizzes) > 0) {
            foreach ($apprenants as $user) {
                $nbTentatives = rand(0, 3);
                for ($t = 0; $t < $nbTentatives; $t++) {
                    $quiz = fake()->randomElement($quizzes);
                    $score = fake()->numberBetween(0, 100);
                    $reussi = $score >= $quiz->score_minimal;
                    $tentative = TentativeQuizz::create([
                        'utilisateur_id' => $user->id,
                        'quiz_id' => $quiz->id,
                        'score' => $score,
                        'reussi' => $reussi,
                        'date_tentative' => fake()->dateTimeBetween('-2 months', 'now'),
                        'etat' => 1,
                    ]);

                    // Récupération directe des questions
                    $questions = QuestionQuizz::where('quiz_id', $quiz->id)->get();
                    foreach ($questions as $question) {
                        $reponsesPossibles = ReponseQuizz::where('question_quiz_id', $question->id)->get();
                        if ($reponsesPossibles->count() > 0) {
                            $choisie = fake()->randomElement($reponsesPossibles);
                            ReponseTentative::create([
                                'tentative_quiz_id' => $tentative->id,
                                'question_quiz_id' => $question->id,
                                'reponse_quiz_id' => $choisie->id,
                                'etat' => 1,
                            ]);
                        }
                    }
                }
            }
        }
    }
}