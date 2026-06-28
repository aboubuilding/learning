@extends('layouts.app')

@section('title', 'Détail formation — Historique')

@section('page_title', 'Détail de la formation')
@section('page_icon', 'fa-info-circle')

@section('breadcrumb')
    <li><a href="{{ route('home') }}">Accueil</a></li>
    <li><a href="{{ route('apprenant.progression.index') }}">Ma progression</a></li>
    <li><a href="{{ route('apprenant.historique.index') }}">Historique</a></li>
    <li class="active">{{ $formation['titre'] }}</li>
@endsection

@section('page_actions')
    <a href="{{ route('apprenant.historique.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
        <i class="fas fa-arrow-left me-1"></i> Retour
    </a>
@endsection

@section('contenu')
    <div class="row g-4">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h4 class="fw-bold">{{ $formation['titre'] }}</h4>
                    <p class="text-muted">
                        <span class="badge bg-secondary">{{ $formation['categorie'] }}</span>
                        <span class="ms-2"><i class="fas fa-user-chalk me-1"></i>{{ $formation['formateur'] }}</span>
                        @if($formation['certificat'])
                            <span class="ms-2 badge bg-success"><i class="fas fa-certificate me-1"></i>{{ $formation['certificat'] }}</span>
                        @endif
                    </p>

                    <div class="row mt-3">
                        <div class="col-md-3">
                            <span class="text-muted small">Statut</span>
                            <div>
                                <span class="badge {{ $formation['statut'] == 'terminee' ? 'bg-success' : 'bg-primary' }}">
                                    {{ $formation['statut'] == 'terminee' ? 'Terminée' : 'En cours' }}
                                </span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <span class="text-muted small">Progression</span>
                            <div class="fw-bold">{{ $formation['progression'] }}%</div>
                            <div class="progress mt-1" style="height: 4px;">
                                <div class="progress-bar bg-success" style="width: {{ $formation['progression'] }}%;"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <span class="text-muted small">Temps passé</span>
                            <div class="fw-bold">{{ $formation['temps_passe'] }}</div>
                        </div>
                        <div class="col-md-3">
                            <span class="text-muted small">Période</span>
                            <div class="fw-bold small">
                                {{ $formation['date_debut'] ? \Carbon\Carbon::parse($formation['date_debut'])->format('d/m/Y') : '-' }}
                                @if($formation['date_fin'])
                                    → {{ \Carbon\Carbon::parse($formation['date_fin'])->format('d/m/Y') }}
                                @endif
                            </div>
                        </div>
                    </div>

                    @if($formation['note'] && $formation['evaluation'])
                        <hr class="my-3">
                        <div class="d-flex align-items-start gap-2">
                            <i class="fas fa-star text-warning mt-1"></i>
                            <div>
                                <span class="fw-bold">Note : {{ $formation['note'] }}/5</span>
                                <p class="text-muted mb-0">{{ $formation['evaluation'] }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card shadow-sm border-0 mt-4">
                <div class="card-header bg-transparent py-3">
                    <h5 class="fw-bold mb-0"><i class="fas fa-cubes me-2"></i>Modules suivis</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @foreach($formation['modules'] as $module)
                            <li class="list-group-item d-flex align-items-center gap-3">
                                @if($module['termine'])
                                    <i class="fas fa-check-circle text-success"></i>
                                @else
                                    <i class="fas fa-circle text-muted"></i>
                                @endif
                                <span class="fw-semibold">{{ $module['titre'] }}</span>
                                <span class="text-muted small ms-auto">{{ $module['duree'] }}</span>
                                <span class="badge {{ $module['termine'] ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $module['termine'] ? 'Terminé' : 'En cours' }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent py-3">
                    <h5 class="fw-bold mb-0"><i class="fas fa-question-circle me-2 text-warning"></i>Quiz</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @foreach($formation['quiz'] as $quiz)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ $quiz['titre'] }}</span>
                                <span class="badge {{ $quiz['reussi'] ? 'bg-success' : 'bg-danger' }}">
                                    {{ $quiz['score'] }}%
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            @if($formation['certificat'])
                <div class="card shadow-sm border-0 mt-4">
                    <div class="card-body text-center">
                        <i class="fas fa-certificate fa-4x text-success opacity-75"></i>
                        <h6 class="fw-bold mt-2">Certificat obtenu</h6>
                        <p class="text-muted small">N° {{ $formation['certificat'] }}</p>
                        <a href="#" class="btn btn-sm btn-success rounded-pill w-100">
                            <i class="fas fa-download me-1"></i> Télécharger
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection