@extends('layouts.app')

@section('title', 'Créer un quiz — AquaForm')

@section('page_title', 'Créer un quiz')
@section('page_icon', 'fa-plus-circle')

@section('breadcrumb')
    <li><a href="{{ route('home') }}">Accueil</a></li>
    <li><a href="{{ route('formateur.quiz.index') }}">Quiz</a></li>
    <li class="active">Créer</li>
@endsection

@section('contenu')
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('formateur.quiz.store') }}" method="POST" id="quizForm">
                @csrf

                {{-- Informations générales --}}
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label" for="titre">Titre du quiz <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="titre" name="titre" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="formation_id">Formation <span class="text-danger">*</span></label>
                        <select class="form-select" id="formation_id" name="formation_id" required>
                            <option value="">Choisir une formation</option>
                            @foreach($formations as $formation)
                                <option value="{{ $formation['id'] }}">{{ $formation['titre'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="module_id">Module (optionnel)</label>
                        <select class="form-select" id="module_id" name="module_id">
                            <option value="">Aucun module (quiz global)</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="score_minimal">Score minimal (%) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="score_minimal" name="score_minimal" value="70" min="0" max="100" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="nombre_tentatives">Tentatives max <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="nombre_tentatives" name="nombre_tentatives" value="3" min="1" required>
                    </div>
                </div>

                <hr>

                {{-- Questions --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0"><i class="fas fa-list-ol me-2 text-primary"></i>Questions</h5>
                    <button type="button" class="btn btn-sm btn-success rounded-pill" id="addQuestionBtn">
                        <i class="fas fa-plus-circle me-1"></i> Ajouter une question
                    </button>
                </div>

                <div id="questionsContainer">
                    <div class="alert alert-info" id="emptyQuestionsMessage">
                        <i class="fas fa-info-circle me-2"></i> Aucune question pour l'instant. Cliquez sur "Ajouter une question".
                    </div>
                </div>

                {{-- Boutons --}}
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="fas fa-save me-2"></i> Créer le quiz
                    </button>
                    <a href="{{ route('formateur.quiz.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('css')
<style>
    .question-card {
        background: #f8faf9;
        border: 1px solid #e2e8e6;
        border-radius: 12px;
        padding: 1.25rem;
        margin-bottom: 1rem;
        position: relative;
    }
    .question-card .question-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }
    .question-card .question-header h6 {
        margin: 0;
        font-weight: 600;
    }
    .question-card .btn-remove-question {
        color: #dc3545;
        background: none;
        border: none;
        font-size: 1.1rem;
        cursor: pointer;
        padding: 0 0.5rem;
    }
    .reponse-item {
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
    .reponse-item .form-group {
        flex: 1;
        min-width: 150px;
        margin-bottom: 0;
    }
    .reponse-item .form-group label {
        font-size: 0.75rem;
        font-weight: 600;
        margin-bottom: 0.2rem;
    }
    .reponse-item .form-group input,
    .reponse-item .form-group select {
        font-size: 0.85rem;
        padding: 0.3rem 0.6rem;
    }
    .reponse-item .btn-remove-reponse {
        color: #dc3545;
        background: none;
        border: none;
        font-size: 0.9rem;
        cursor: pointer;
        padding: 0 0.3rem;
        align-self: flex-end;
    }
</style>
@endpush

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let questionIndex = 0;
        let reponseIndex = 0;
        const questionsContainer = document.getElementById('questionsContainer');
        const emptyMessage = document.getElementById('emptyQuestionsMessage');

        // Gérer le chargement des modules selon la formation
        document.getElementById('formation_id').addEventListener('change', function() {
            const formationId = this.value;
            const moduleSelect = document.getElementById('module_id');
            const modules = @json($modules);
            moduleSelect.innerHTML = '<option value="">Aucun module (quiz global)</option>';
            if (formationId && modules[formationId]) {
                modules[formationId].forEach(module => {
                    const opt = document.createElement('option');
                    opt.value = module.id;
                    opt.textContent = module.titre;
                    moduleSelect.appendChild(opt);
                });
            }
        });

        // Ajouter une question
        document.getElementById('addQuestionBtn').addEventListener('click', function() {
            const qIndex = questionIndex++;
            const html = `
                <div class="question-card" data-question-index="${qIndex}">
                    <div class="question-header">
                        <h6><i class="fas fa-question-circle me-2 text-primary"></i> Question ${qIndex + 1}</h6>
                        <button type="button" class="btn-remove-question" title="Supprimer cette question">
                            <i class="fas fa-times-circle"></i>
                        </button>
                    </div>
                    <div class="row g-2 mb-2">
                        <div class="col-md-9">
                            <label class="form-label small fw-bold">Question</label>
                            <input type="text" class="form-control form-control-sm" name="questions[${qIndex}][question]" placeholder="Ex: Quelle est la formule chimique de l'eau ?" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold">Points</label>
                            <input type="number" class="form-control form-control-sm" name="questions[${qIndex}][points]" value="1" min="1" required>
                        </div>
                    </div>
                    <div class="reponses-container">
                        <label class="form-label small fw-bold">Réponses</label>
                        <div class="reponses-list">
                            <div class="alert alert-light alert-sm py-1 px-2 mb-1 text-muted small" style="font-size:0.8rem;">
                                Aucune réponse. Cliquez sur "Ajouter une réponse".
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary rounded-pill add-reponse-btn" data-question="${qIndex}">
                            <i class="fas fa-plus-circle me-1"></i> Ajouter une réponse
                        </button>
                    </div>
                </div>
            `;
            const insertBefore = emptyMessage.nextSibling;
            if (insertBefore) {
                questionsContainer.insertBefore(createElementFromHTML(html), insertBefore);
            } else {
                questionsContainer.appendChild(createElementFromHTML(html));
            }
            emptyMessage.style.display = 'none';
        });

        // Ajouter une réponse (délégation)
        questionsContainer.addEventListener('click', function(e) {
            const target = e.target.closest('.add-reponse-btn');
            if (target) {
                const questionIdx = target.dataset.question;
                const questionCard = target.closest('.question-card');
                const reponsesList = questionCard.querySelector('.reponses-list');
                const rIndex = reponseIndex++;
                const html = `
                    <div class="reponse-item" data-reponse-index="${rIndex}">
                        <div class="form-group">
                            <label>Réponse</label>
                            <input type="text" class="form-control form-control-sm" name="questions[${questionIdx}][reponses][${rIndex}][reponse]" placeholder="Texte de la réponse" required>
                        </div>
                        <div class="form-group" style="min-width: 100px;">
                            <label>Correcte</label>
                            <select class="form-select form-select-sm" name="questions[${questionIdx}][reponses][${rIndex}][est_correcte]">
                                <option value="1">Oui</option>
                                <option value="0">Non</option>
                            </select>
                        </div>
                        <button type="button" class="btn-remove-reponse" title="Supprimer cette réponse">
                            <i class="fas fa-times-circle"></i>
                        </button>
                    </div>
                `;
                const emptyMsg = reponsesList.querySelector('.alert-light');
                if (emptyMsg) emptyMsg.remove();
                reponsesList.appendChild(createElementFromHTML(html));
            }

            // Suppression d'une question
            const removeQuestion = e.target.closest('.btn-remove-question');
            if (removeQuestion) {
                const questionCard = removeQuestion.closest('.question-card');
                if (questionCard) {
                    questionCard.remove();
                    if (questionsContainer.querySelectorAll('.question-card').length === 0) {
                        emptyMessage.style.display = 'block';
                    }
                }
            }

            // Suppression d'une réponse
            const removeReponse = e.target.closest('.btn-remove-reponse');
            if (removeReponse) {
                const reponseItem = removeReponse.closest('.reponse-item');
                if (reponseItem) {
                    reponseItem.remove();
                    const reponsesList = reponseItem.closest('.reponses-list');
                    if (reponsesList && reponsesList.querySelectorAll('.reponse-item').length === 0) {
                        const emptyMsg = document.createElement('div');
                        emptyMsg.className = 'alert alert-light alert-sm py-1 px-2 mb-1 text-muted small';
                        emptyMsg.style.fontSize = '0.8rem';
                        emptyMsg.textContent = 'Aucune réponse. Cliquez sur "Ajouter une réponse".';
                        reponsesList.appendChild(emptyMsg);
                    }
                }
            }
        });

        function createElementFromHTML(htmlString) {
            const div = document.createElement('div');
            div.innerHTML = htmlString.trim();
            return div.firstChild;
        }
    });
</script>
@endpush