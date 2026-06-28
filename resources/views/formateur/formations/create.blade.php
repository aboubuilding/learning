@extends('layouts.app')

@section('title', 'Créer une formation — AquaForm')

@section('page_title', 'Créer une formation')
@section('page_icon', 'fa-plus-circle')

@section('breadcrumb')
    <li><a href="{{ route('home') }}">Accueil</a></li>
    <li><a href="{{ route('formateur.formations.index') }}">Mes formations</a></li>
    <li class="active">Créer</li>
@endsection

@section('page_actions')
    <a href="{{ route('formateur.formations.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
        <i class="fas fa-arrow-left me-1"></i> Retour à la liste
    </a>
@endsection

@section('contenu')
    <div class="card shadow-sm border-0">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i> Veuillez corriger les erreurs ci-dessous.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('formateur.formations.store') }}" method="POST" id="formationForm">
                @csrf

                {{-- ===== INFORMATIONS GÉNÉRALES ===== --}}
                <div class="row g-3 mb-4">
                    <div class="col-md-8">
                        <label class="form-label" for="titre">Titre de la formation <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('titre') is-invalid @enderror" id="titre" name="titre" value="{{ old('titre') }}" required>
                        @error('titre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="categorie_id">Catégorie <span class="text-danger">*</span></label>
                        <select class="form-select @error('categorie_id') is-invalid @enderror" id="categorie_id" name="categorie_id" required>
                            <option value="">Choisir une catégorie</option>
                            @foreach($categories as $categorie)
                                <option value="{{ $categorie['id'] }}" {{ old('categorie_id') == $categorie['id'] ? 'selected' : '' }}>
                                    {{ $categorie['nom'] }}
                                </option>
                            @endforeach
                        </select>
                        @error('categorie_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="description">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="niveau">Niveau <span class="text-danger">*</span></label>
                        <select class="form-select @error('niveau') is-invalid @enderror" id="niveau" name="niveau" required>
                            @foreach($niveaux as $niveau)
                                <option value="{{ $niveau }}" {{ old('niveau') == $niveau ? 'selected' : '' }}>
                                    {{ $niveau }}
                                </option>
                            @endforeach
                        </select>
                        @error('niveau')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="duree">Durée estimée <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('duree') is-invalid @enderror" id="duree" name="duree" value="{{ old('duree') }}" placeholder="ex: 8h, 2h30" required>
                        @error('duree')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 d-flex align-items-center">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="est_publie" name="est_publie" value="1" {{ old('est_publie') ? 'checked' : '' }}>
                            <label class="form-check-label" for="est_publie">Publier la formation</label>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                {{-- ===== MODULES ===== --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0"><i class="fas fa-cubes me-2 text-primary"></i>Modules</h5>
                    <button type="button" class="btn btn-sm btn-success rounded-pill" id="addModuleBtn">
                        <i class="fas fa-plus-circle me-1"></i> Ajouter un module
                    </button>
                </div>

                <div id="modulesContainer">
                    {{-- Les modules seront ajoutés dynamiquement ici --}}
                    <div class="alert alert-info" id="emptyModulesMessage">
                        <i class="fas fa-info-circle me-2"></i> Aucun module pour l'instant. Cliquez sur "Ajouter un module".
                    </div>
                </div>

                <hr class="my-4">

                {{-- ===== QUIZ GLOBAL (optionnel) ===== --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0"><i class="fas fa-question-circle me-2 text-warning"></i>Quiz (optionnel)</h5>
                    <button type="button" class="btn btn-sm btn-success rounded-pill" id="addQuizBtn">
                        <i class="fas fa-plus-circle me-1"></i> Ajouter un quiz
                    </button>
                </div>

                <div id="quizzesContainer">
                    <div class="alert alert-info" id="emptyQuizzesMessage">
                        <i class="fas fa-info-circle me-2"></i> Aucun quiz pour l'instant.
                    </div>
                </div>

                {{-- ===== BOUTONS ===== --}}
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="fas fa-save me-2"></i> Créer la formation
                    </button>
                    <a href="{{ route('formateur.formations.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="fas fa-times me-2"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('css')
<style>
    .module-card {
        background: #f8faf9;
        border: 1px solid #e2e8e6;
        border-radius: 12px;
        padding: 1.25rem;
        margin-bottom: 1rem;
        position: relative;
    }
    .module-card .module-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }
    .module-card .module-header h6 {
        margin: 0;
        font-weight: 600;
    }
    .module-card .btn-remove-module {
        color: #dc3545;
        background: none;
        border: none;
        font-size: 1.1rem;
        cursor: pointer;
        padding: 0 0.5rem;
    }
    .module-card .btn-remove-module:hover {
        color: #a71d2a;
    }
    .ressource-item {
        background: #fff;
        border: 1px solid #e2e8e6;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex-wrap: wrap;
    }
    .ressource-item .form-group {
        flex: 1;
        min-width: 150px;
        margin-bottom: 0;
    }
    .ressource-item .form-group label {
        font-size: 0.75rem;
        font-weight: 600;
        margin-bottom: 0.2rem;
    }
    .ressource-item .form-group input,
    .ressource-item .form-group select {
        font-size: 0.85rem;
        padding: 0.3rem 0.6rem;
    }
    .ressource-item .btn-remove-ressource {
        color: #dc3545;
        background: none;
        border: none;
        font-size: 0.9rem;
        cursor: pointer;
        padding: 0 0.3rem;
        align-self: flex-end;
    }
    .quiz-item {
        background: #fff9eb;
        border: 1px solid #ffeeba;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
    }
    .quiz-item .form-group {
        flex: 1;
        min-width: 140px;
        margin-bottom: 0;
    }
    .quiz-item .form-group label {
        font-size: 0.75rem;
        font-weight: 600;
        margin-bottom: 0.2rem;
    }
    .quiz-item .form-group input {
        font-size: 0.85rem;
        padding: 0.3rem 0.6rem;
    }
    .quiz-item .btn-remove-quiz {
        color: #dc3545;
        background: none;
        border: none;
        font-size: 0.9rem;
        cursor: pointer;
        padding: 0 0.3rem;
        align-self: flex-end;
    }
    .badge-ressource-type {
        font-size: 0.65rem;
        padding: 0.2rem 0.5rem;
        border-radius: 20px;
        background: #e9ecef;
        color: #495057;
        display: inline-block;
    }
</style>
@endpush

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let moduleIndex = 0;
        let ressourceIndex = 0;
        let quizIndex = 0;

        const modulesContainer = document.getElementById('modulesContainer');
        const emptyModulesMessage = document.getElementById('emptyModulesMessage');
        const quizzesContainer = document.getElementById('quizzesContainer');
        const emptyQuizzesMessage = document.getElementById('emptyQuizzesMessage');

        // ---- Ajouter un module ----
        document.getElementById('addModuleBtn').addEventListener('click', function() {
            const moduleId = moduleIndex++;
            const moduleHtml = `
                <div class="module-card" data-module-index="${moduleId}">
                    <div class="module-header">
                        <h6><i class="fas fa-cube me-2 text-primary"></i> Module ${moduleId + 1}</h6>
                        <button type="button" class="btn-remove-module" title="Supprimer ce module">
                            <i class="fas fa-times-circle"></i>
                        </button>
                    </div>
                    <div class="row g-2 mb-2">
                        <div class="col-md-8">
                            <label class="form-label small fw-bold">Titre du module</label>
                            <input type="text" class="form-control form-control-sm" name="modules[${moduleId}][titre]" placeholder="Ex: Introduction" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Ordre</label>
                            <input type="number" class="form-control form-control-sm" name="modules[${moduleId}][ordre]" value="${moduleId + 1}" min="1" required>
                        </div>
                    </div>

                    <div class="ressources-container mb-2">
                        <label class="form-label small fw-bold">Ressources</label>
                        <div class="ressources-list">
                            <div class="alert alert-light alert-sm py-1 px-2 mb-1 text-muted small" style="font-size:0.8rem;">
                                Aucune ressource. Cliquez sur "Ajouter une ressource" ci-dessous.
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary rounded-pill add-ressource-btn" data-module="${moduleId}">
                            <i class="fas fa-plus-circle me-1"></i> Ajouter une ressource
                        </button>
                    </div>

                    <div class="row g-2">
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="modules[${moduleId}][has_quiz]" value="1" id="module_quiz_${moduleId}">
                                <label class="form-check-label small" for="module_quiz_${moduleId}">
                                    Ce module contient un quiz
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6" style="display:none;" id="module_quiz_fields_${moduleId}">
                            <label class="form-label small fw-bold">Titre du quiz</label>
                            <input type="text" class="form-control form-control-sm" name="modules[${moduleId}][quiz][titre]" placeholder="Quiz du module">
                        </div>
                        <div class="col-md-3" style="display:none;" id="module_quiz_score_${moduleId}">
                            <label class="form-label small fw-bold">Score minimal (%)</label>
                            <input type="number" class="form-control form-control-sm" name="modules[${moduleId}][quiz][score_minimal]" value="70" min="0" max="100">
                        </div>
                        <div class="col-md-3" style="display:none;" id="module_quiz_tentatives_${moduleId}">
                            <label class="form-label small fw-bold">Tentatives max</label>
                            <input type="number" class="form-control form-control-sm" name="modules[${moduleId}][quiz][nombre_tentatives]" value="3" min="1">
                        </div>
                    </div>
                </div>
            `;

            // Insérer le module avant le message "aucun module"
            const insertBefore = emptyModulesMessage.nextSibling;
            if (insertBefore) {
                modulesContainer.insertBefore(createElementFromHTML(moduleHtml), insertBefore);
            } else {
                modulesContainer.appendChild(createElementFromHTML(moduleHtml));
            }
            emptyModulesMessage.style.display = 'none';

            // Gérer l'affichage du quiz du module
            const moduleDiv = modulesContainer.querySelector(`.module-card[data-module-index="${moduleId}"]`);
            const checkbox = moduleDiv.querySelector(`input[name="modules[${moduleId}][has_quiz]"]`);
            const quizFields = moduleDiv.querySelector(`#module_quiz_fields_${moduleId}`);
            const quizScore = moduleDiv.querySelector(`#module_quiz_score_${moduleId}`);
            const quizTentatives = moduleDiv.querySelector(`#module_quiz_tentatives_${moduleId}`);

            checkbox.addEventListener('change', function() {
                const show = this.checked;
                quizFields.style.display = show ? 'block' : 'none';
                quizScore.style.display = show ? 'block' : 'none';
                quizTentatives.style.display = show ? 'block' : 'none';
            });

            // Gestion des ressources
            const ressourcesList = moduleDiv.querySelector('.ressources-list');
            const addRessourceBtn = moduleDiv.querySelector('.add-ressource-btn');
            let ressourceCounter = 0;

            addRessourceBtn.addEventListener('click', function() {
                const ressourceId = `module_${moduleId}_ressource_${ressourceCounter++}`;
                const html = `
                    <div class="ressource-item" data-ressource-id="${ressourceId}">
                        <div class="form-group">
                            <label>Titre</label>
                            <input type="text" class="form-control form-control-sm" name="modules[${moduleId}][ressources][${ressourceCounter-1}][titre]" placeholder="Titre de la ressource" required>
                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            <select class="form-select form-select-sm" name="modules[${moduleId}][ressources][${ressourceCounter-1}][type]" required>
                                <option value="video">Vidéo</option>
                                <option value="pdf">PDF</option>
                                <option value="diaporama">Diaporama</option>
                                <option value="guide">Guide interactif</option>
                                <option value="lien">Lien externe</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>URL / Fichier</label>
                            <input type="text" class="form-control form-control-sm" name="modules[${moduleId}][ressources][${ressourceCounter-1}][url]" placeholder="URL ou chemin du fichier">
                        </div>
                        <button type="button" class="btn-remove-ressource" title="Supprimer cette ressource">
                            <i class="fas fa-times-circle"></i>
                        </button>
                    </div>
                `;
                // Supprimer le message "aucune ressource" s'il existe
                const emptyMsg = ressourcesList.querySelector('.alert-light');
                if (emptyMsg) emptyMsg.remove();

                ressourcesList.appendChild(createElementFromHTML(html));
            });

            // Suppression du module
            moduleDiv.querySelector('.btn-remove-module').addEventListener('click', function() {
                moduleDiv.remove();
                if (modulesContainer.querySelectorAll('.module-card').length === 0) {
                    emptyModulesMessage.style.display = 'block';
                }
                // Re-numéroter les modules (optionnel)
            });
        });

        // ---- Ajouter un quiz global ----
        document.getElementById('addQuizBtn').addEventListener('click', function() {
            const qIndex = quizIndex++;
            const html = `
                <div class="quiz-item" data-quiz-index="${qIndex}">
                    <div class="form-group">
                        <label>Titre du quiz</label>
                        <input type="text" class="form-control form-control-sm" name="quizzes[${qIndex}][titre]" placeholder="Quiz final" required>
                    </div>
                    <div class="form-group">
                        <label>Score minimal (%)</label>
                        <input type="number" class="form-control form-control-sm" name="quizzes[${qIndex}][score_minimal]" value="70" min="0" max="100">
                    </div>
                    <div class="form-group">
                        <label>Tentatives max</label>
                        <input type="number" class="form-control form-control-sm" name="quizzes[${qIndex}][nombre_tentatives]" value="3" min="1">
                    </div>
                    <button type="button" class="btn-remove-quiz" title="Supprimer ce quiz">
                        <i class="fas fa-times-circle"></i>
                    </button>
                </div>
            `;
            const insertBefore = emptyQuizzesMessage.nextSibling;
            if (insertBefore) {
                quizzesContainer.insertBefore(createElementFromHTML(html), insertBefore);
            } else {
                quizzesContainer.appendChild(createElementFromHTML(html));
            }
            emptyQuizzesMessage.style.display = 'none';
        });

        // Suppression des quiz (délégation d'événements)
        quizzesContainer.addEventListener('click', function(e) {
            const target = e.target.closest('.btn-remove-quiz');
            if (target) {
                const quizItem = target.closest('.quiz-item');
                if (quizItem) {
                    quizItem.remove();
                    if (quizzesContainer.querySelectorAll('.quiz-item').length === 0) {
                        emptyQuizzesMessage.style.display = 'block';
                    }
                }
            }
        });

        // Suppression des ressources (délégation)
        modulesContainer.addEventListener('click', function(e) {
            const target = e.target.closest('.btn-remove-ressource');
            if (target) {
                const ressourceItem = target.closest('.ressource-item');
                if (ressourceItem) {
                    ressourceItem.remove();
                    // Si plus de ressources, afficher le message
                    const ressourceList = ressourceItem.closest('.ressources-list');
                    if (ressourceList && ressourceList.querySelectorAll('.ressource-item').length === 0) {
                        // Ajouter un message "aucune ressource" si nécessaire
                        const emptyMsg = document.createElement('div');
                        emptyMsg.className = 'alert alert-light alert-sm py-1 px-2 mb-1 text-muted small';
                        emptyMsg.style.fontSize = '0.8rem';
                        emptyMsg.textContent = 'Aucune ressource. Cliquez sur "Ajouter une ressource" ci-dessous.';
                        ressourceList.appendChild(emptyMsg);
                    }
                }
            }

            // Suppression des modules
            const moduleTarget = e.target.closest('.btn-remove-module');
            if (moduleTarget) {
                const moduleCard = moduleTarget.closest('.module-card');
                if (moduleCard) {
                    moduleCard.remove();
                    if (modulesContainer.querySelectorAll('.module-card').length === 0) {
                        emptyModulesMessage.style.display = 'block';
                    }
                }
            }
        });

        // ---- Utilitaires ----
        function createElementFromHTML(htmlString) {
            const div = document.createElement('div');
            div.innerHTML = htmlString.trim();
            return div.firstChild;
        }

        // ---- Gestion des quiz de module (délégation) ----
        modulesContainer.addEventListener('change', function(e) {
            const target = e.target;
            if (target.matches('input[name$="[has_quiz]"]')) {
                const moduleDiv = target.closest('.module-card');
                if (moduleDiv) {
                    const index = moduleDiv.dataset.moduleIndex;
                    const show = target.checked;
                    const quizFields = moduleDiv.querySelector(`#module_quiz_fields_${index}`);
                    const quizScore = moduleDiv.querySelector(`#module_quiz_score_${index}`);
                    const quizTentatives = moduleDiv.querySelector(`#module_quiz_tentatives_${index}`);
                    if (quizFields) quizFields.style.display = show ? 'block' : 'none';
                    if (quizScore) quizScore.style.display = show ? 'block' : 'none';
                    if (quizTentatives) quizTentatives.style.display = show ? 'block' : 'none';
                }
            }
        });
    });
</script>
@endpush