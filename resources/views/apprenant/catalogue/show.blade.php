@extends('layouts.app')

@section('title', $formation['titre'] ?? 'Détail de la formation')

@section('page_title', $formation['titre'] ?? 'Détail de la formation')
@section('page_icon', 'fa-book-open')

@section('breadcrumb')
    <li><a href="{{ route('home') }}">Accueil</a></li>
    <li><a href="{{ route('apprenant.catalogue.index') }}">Catalogue</a></li>
    <li class="active">{{ $formation['titre'] ?? 'Détail' }}</li>
@endsection

@section('page_actions')
    <a href="{{ route('apprenant.catalogue.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
        <i class="fas fa-arrow-left me-1"></i> Retour au catalogue
    </a>
    @if(isset($formation['est_inscrit']) && !$formation['est_inscrit'])
        <a href="#" class="btn btn-sm btn-primary rounded-pill">
            <i class="fas fa-user-plus me-1"></i> S'inscrire
        </a>
    @endif
@endsection

@section('contenu')
    <div class="row g-4">
        {{-- Colonne principale --}}
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    {{-- Titre et catégorie --}}
                    <h3 class="fw-bold">{{ $formation['titre'] ?? 'Titre non défini' }}</h3>
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <span class="badge bg-secondary">{{ $formation['categorie'] ?? 'Non catégorisé' }}</span>
                        <span class="badge bg-info">{{ $formation['niveau'] ?? 'Non défini' }}</span>
                        @if(isset($formation['est_publie']) && $formation['est_publie'])
                            <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i> Publiée</span>
                        @else
                            <span class="badge bg-warning">Brouillon</span>
                        @endif
                    </div>

                    {{-- Description --}}
                    <div class="mb-4">
                        <h6 class="fw-bold">Description</h6>
                        <p>{{ $formation['description'] ?? 'Aucune description disponible.' }}</p>
                    </div>

                    {{-- Objectifs (si disponibles) --}}
                    @if(!empty($formation['objectifs']))
                    <div class="mb-4">
                        <h6 class="fw-bold">Objectifs pédagogiques</h6>
                        <ul>
                            @foreach($formation['objectifs'] as $objectif)
                                <li>{{ $objectif }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {{-- Informations complémentaires --}}
                    <div class="row g-3">
                        <div class="col-md-4">
                            <span class="text-muted small">Durée</span>
                            <div class="fw-semibold">{{ $formation['duree'] ?? 'Non spécifiée' }}</div>
                        </div>
                        <div class="col-md-4">
                            <span class="text-muted small">Formateur</span>
                            <div class="fw-semibold">{{ $formation['formateur'] ?? 'Non assigné' }}</div>
                        </div>
                        <div class="col-md-4">
                            <span class="text-muted small">Inscrits</span>
                            <div class="fw-semibold">{{ $formation['inscriptions'] ?? 0 }}</div>
                        </div>
                    </div>

                    {{-- Modules --}}
                    @if(!empty($formation['modules']))
                    <hr class="my-4">
                    <h5 class="fw-bold"><i class="fas fa-cubes me-2"></i>Modules</h5>
                    <ul class="list-group mt-3">
                        @foreach($formation['modules'] as $module)
                            <li class="list-group-item d-flex align-items-center gap-3">
                                <span class="badge bg-secondary rounded-pill">{{ $loop->iteration }}</span>
                                <span>{{ $module['titre'] ?? 'Module sans titre' }}</span>
                                <span class="ms-auto text-muted small">{{ $module['duree'] ?? '' }}</span>
                            </li>
                        @endforeach
                    </ul>
                    @endif

                    {{-- Quiz --}}
                    @if(!empty($formation['quiz']))
                    <hr class="my-4">
                    <h5 class="fw-bold"><i class="fas fa-question-circle me-2 text-warning"></i>Quiz associés</h5>
                    <ul class="list-group mt-3">
                        @foreach($formation['quiz'] as $quiz)
                            <li class="list-group-item d-flex align-items-center gap-3">
                                <span>{{ $quiz['titre'] ?? 'Quiz sans titre' }}</span>
                                <span class="ms-auto text-muted small">Score min: {{ $quiz['score_minimal'] ?? 70 }}%</span>
                            </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </div>

        {{-- Colonne latérale --}}
        <div class="col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="text-center">
                        <i class="fas fa-graduation-cap fa-4x text-primary opacity-50"></i>
                        <h5 class="fw-bold mt-3">{{ $formation['titre'] ?? 'Formation' }}</h5>
                        <p class="text-muted small">{{ $formation['categorie'] ?? '' }}</p>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Niveau</span>
                        <span class="fw-semibold">{{ $formation['niveau'] ?? 'Non défini' }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Durée</span>
                        <span class="fw-semibold">{{ $formation['duree'] ?? 'Non spécifiée' }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Inscrits</span>
                        <span class="fw-semibold">{{ $formation['inscriptions'] ?? 0 }}</span>
                    </div>

                    @if(isset($formation['est_inscrit']) && $formation['est_inscrit'])
                        <div class="alert alert-success mt-3 mb-0">
                            <i class="fas fa-check-circle me-1"></i> Vous êtes inscrit à cette formation
                        </div>
                        <a href="{{ route('apprenant.cours.show', $formation['id']) }}" class="btn btn-outline-primary w-100 mt-3 rounded-pill">
                            <i class="fas fa-play me-1"></i> Continuer
                        </a>
                    @else
                        <a href="#" class="btn btn-primary w-100 mt-3 rounded-pill">
                            <i class="fas fa-user-plus me-1"></i> S'inscrire
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection