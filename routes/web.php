<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminFormationController;
use App\Http\Controllers\Admin\AdminModuleController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminInscriptionController;
use App\Http\Controllers\Admin\AdminStatistiqueController;
use App\Http\Controllers\Admin\AdminJournalController;
use App\Http\Controllers\Admin\AdminParametreController;
use App\Http\Controllers\Apprenant\ApprenantController;
use App\Http\Controllers\Apprenant\ApprenantProgressionController;
use App\Http\Controllers\Apprenant\ApprenantHistoriqueController;
use App\Http\Controllers\Apprenant\ApprenantCertificatController;
use App\Http\Controllers\Apprenant\ApprenantCatalogueController;
use App\Http\Controllers\Apprenant\CoursController;
use App\Http\Controllers\Apprenant\RessourceController as ApprenantRessourceController;
use App\Http\Controllers\Formateur\FormationController as FormateurFormationController;
use App\Http\Controllers\Formateur\ModuleController as FormateurModuleController;
use App\Http\Controllers\Formateur\InscritController as FormateurInscritController;
use App\Http\Controllers\Formateur\RessourceController as FormateurRessourceController;
use App\Http\Controllers\Formateur\ParticipantController;
use App\Http\Controllers\Formateur\QuizController;

/*
|--------------------------------------------------------------------------
| Routes publiques (non authentifiées)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/recherche', [HomeController::class, 'search'])->name('home.search');

// Authentification
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/register-success', [RegisterController::class, 'success'])->name('register.success');

/*
|--------------------------------------------------------------------------
| Routes protégées par session (authentifiées)
|--------------------------------------------------------------------------
*/
Route::middleware('auth.session')->group(function () {

    // ============================================================
    // DASHBOARDS (vues directes)
    // ============================================================
    Route::get('/apprenant/dashboard', fn() => view('dashboard.apprenant'))->name('apprenant.dashboard');
    Route::get('/formateur/dashboard', fn() => view('dashboard.formateur'))->name('formateur.dashboard');
    Route::get('/admin/dashboard', fn() => view('dashboard.admin'))->name('admin.dashboard');

    // ============================================================
    // ADMINISTRATEUR
    // ============================================================
    Route::prefix('admin')->name('admin.')->group(function () {

        // --- Utilisateurs ---
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create');
        Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
        Route::get('/users/{id}', [AdminUserController::class, 'show'])->name('users.show');
        Route::get('/users/{id}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [AdminUserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('users.destroy');

        // --- Formations ---
        Route::get('/formations', [AdminFormationController::class, 'index'])->name('formations.index');
        Route::get('/formations/create', [AdminFormationController::class, 'create'])->name('formations.create');
        Route::post('/formations', [AdminFormationController::class, 'store'])->name('formations.store');
        Route::get('/formations/{id}', [AdminFormationController::class, 'show'])->name('formations.show');
        Route::get('/formations/{id}/edit', [AdminFormationController::class, 'edit'])->name('formations.edit');
        Route::put('/formations/{id}', [AdminFormationController::class, 'update'])->name('formations.update');
        Route::delete('/formations/{id}', [AdminFormationController::class, 'destroy'])->name('formations.destroy');

        // --- Modules ---
        Route::get('/modules', [AdminModuleController::class, 'index'])->name('modules.index');
        Route::get('/modules/create', [AdminModuleController::class, 'create'])->name('modules.create');
        Route::post('/modules', [AdminModuleController::class, 'store'])->name('modules.store');
        Route::get('/modules/{id}', [AdminModuleController::class, 'show'])->name('modules.show');
        Route::get('/modules/{id}/edit', [AdminModuleController::class, 'edit'])->name('modules.edit');
        Route::put('/modules/{id}', [AdminModuleController::class, 'update'])->name('modules.update');
        Route::delete('/modules/{id}', [AdminModuleController::class, 'destroy'])->name('modules.destroy');

        // --- Catégories ---
        Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/create', [AdminCategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories', [AdminCategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{id}', [AdminCategoryController::class, 'show'])->name('categories.show');
        Route::get('/categories/{id}/edit', [AdminCategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{id}', [AdminCategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{id}', [AdminCategoryController::class, 'destroy'])->name('categories.destroy');

        // --- Inscriptions ---
        Route::get('/inscriptions', [AdminInscriptionController::class, 'index'])->name('inscriptions.index');
        Route::get('/inscriptions/{id}', [AdminInscriptionController::class, 'show'])->name('inscriptions.show');
        Route::get('/inscriptions/{id}/edit', [AdminInscriptionController::class, 'edit'])->name('inscriptions.edit');
        Route::put('/inscriptions/{id}', [AdminInscriptionController::class, 'update'])->name('inscriptions.update');
        Route::delete('/inscriptions/{id}', [AdminInscriptionController::class, 'destroy'])->name('inscriptions.destroy');

        Route::post('/inscriptions/{id}/validate', [AdminInscriptionController::class, 'validateInscription'])->name('inscriptions.validate');
        Route::post('/inscriptions/{id}/cancel', [AdminInscriptionController::class, 'cancelInscription'])->name('inscriptions.cancel');

        // --- Statistiques ---
        Route::get('/statistiques', [AdminStatistiqueController::class, 'index'])->name('statistiques.index');
        Route::get('/statistiques/completion', [AdminStatistiqueController::class, 'completion'])->name('statistiques.completion');

        // --- Journal ---
        Route::get('/journal', [AdminJournalController::class, 'index'])->name('journal.index');
        Route::get('/journal/export', [AdminJournalController::class, 'export'])->name('journal.export');

        // --- Paramètres ---
        Route::get('/parametres', [AdminParametreController::class, 'index'])->name('parametres.index');
        Route::put('/parametres', [AdminParametreController::class, 'update'])->name('parametres.update');
    });

    // ============================================================
    // APPRENANT
    // ============================================================
    Route::prefix('apprenant')->name('apprenant.')->group(function () {

        // Mes cours
        Route::get('/mes-cours', [ApprenantController::class, 'index'])->name('mes-cours');
        Route::get('/formation/{id}', [ApprenantController::class, 'show'])->name('formation.show');

        // Progression
        Route::get('/progression', [ApprenantProgressionController::class, 'index'])->name('progression.index');
        Route::get('/progression/{id}', [ApprenantProgressionController::class, 'show'])->name('progression.show');

        // Historique
        Route::get('/historique', [ApprenantHistoriqueController::class, 'index'])->name('historique.index');
        Route::get('/historique/{id}', [ApprenantHistoriqueController::class, 'show'])->name('historique.show');

        // Certificats
        Route::get('/certificats', [ApprenantCertificatController::class, 'index'])->name('certificats.index');
        Route::get('/certificats/{id}', [ApprenantCertificatController::class, 'show'])->name('certificats.show');
        Route::get('/certificats/{id}/download', [ApprenantCertificatController::class, 'download'])->name('certificats.download');
        Route::post('/certificats/{id}/share', [ApprenantCertificatController::class, 'share'])->name('certificats.share');

        // Catalogue
        Route::get('/catalogue', [ApprenantCatalogueController::class, 'index'])->name('catalogue.index');
        Route::get('/catalogue/{id}', [ApprenantCatalogueController::class, 'show'])->name('catalogue.show');

        // Cours (suivi)
        Route::get('/cours/{id}', [CoursController::class, 'show'])->name('cours.show');
        Route::post('/cours/{formationId}/ressource/{ressourceId}/consulter', [CoursController::class, 'marquerConsultee'])->name('cours.ressource.consulter');
        Route::post('/cours/{formationId}/ressource/{ressourceId}/terminer', [CoursController::class, 'marquerTerminee'])->name('cours.ressource.terminer');

        // Ressources
        Route::get('/ressource/{id}', [ApprenantRessourceController::class, 'show'])->name('ressource.show');
        Route::post('/ressource/{id}/mark-completed', [ApprenantRessourceController::class, 'markCompleted'])->name('ressource.mark-completed');
        Route::get('/ressource/{id}/download', [ApprenantRessourceController::class, 'download'])->name('ressource.download');
    });

    // ============================================================
    // FORMATEUR
    // ============================================================
    Route::prefix('formateur')->name('formateur.')->group(function () {

        // --- Formations ---
        Route::get('/formations', [FormateurFormationController::class, 'index'])->name('formations.index');
        Route::get('/formations/create', [FormateurFormationController::class, 'create'])->name('formations.create');
        Route::post('/formations', [FormateurFormationController::class, 'store'])->name('formations.store');
        Route::get('/formations/{id}', [FormateurFormationController::class, 'show'])->name('formations.show');
        Route::get('/formations/{id}/edit', [FormateurFormationController::class, 'edit'])->name('formations.edit');
        Route::put('/formations/{id}', [FormateurFormationController::class, 'update'])->name('formations.update');
        Route::delete('/formations/{id}', [FormateurFormationController::class, 'destroy'])->name('formations.destroy');

        // --- Modules (gérés depuis la vue show) ---
        Route::get('/formations/{formationId}/modules/create', [FormateurFormationController::class, 'createModule'])->name('modules.create');
        Route::post('/formations/{formationId}/modules', [FormateurFormationController::class, 'storeModule'])->name('modules.store');
        Route::get('/formations/{formationId}/modules/{moduleId}/edit', [FormateurFormationController::class, 'editModule'])->name('modules.edit');
        Route::put('/formations/{formationId}/modules/{moduleId}', [FormateurFormationController::class, 'updateModule'])->name('modules.update');
        Route::delete('/formations/{formationId}/modules/{moduleId}', [FormateurFormationController::class, 'destroyModule'])->name('modules.destroy');

        // --- Ressources ---
        Route::post('/modules/{moduleId}/ressources', [FormateurRessourceController::class, 'store'])->name('ressources.store');
        Route::delete('/ressources/{ressourceId}', [FormateurRessourceController::class, 'destroy'])->name('ressources.destroy');

        // --- Participants (inscrits) ---
        Route::get('/participants', [ParticipantController::class, 'index'])->name('participants.index');
        Route::get('/participants/{id}', [ParticipantController::class, 'show'])->name('participants.show');
        Route::put('/participants/{id}', [ParticipantController::class, 'updateStatut'])->name('participants.updateStatut');
        Route::delete('/participants/{id}', [ParticipantController::class, 'destroy'])->name('participants.destroy');

        // --- Quiz ---
        Route::get('/quiz', [QuizController::class, 'index'])->name('quiz.index');
        Route::get('/quiz/create', [QuizController::class, 'create'])->name('quiz.create');
        Route::post('/quiz', [QuizController::class, 'store'])->name('quiz.store');
        Route::get('/quiz/{id}', [QuizController::class, 'show'])->name('quiz.show');
        Route::get('/quiz/{id}/edit', [QuizController::class, 'edit'])->name('quiz.edit');
        Route::put('/quiz/{id}', [QuizController::class, 'update'])->name('quiz.update');
        Route::delete('/quiz/{id}', [QuizController::class, 'destroy'])->name('quiz.destroy');
        Route::get('/quiz/{id}/results', [QuizController::class, 'results'])->name('quiz.results');

        // --- Inscrits (ancienne route, à conserver si nécessaire) ---
        Route::get('/inscrits/{inscritId}', [FormateurInscritController::class, 'show'])->name('inscrits.show');
    });
});