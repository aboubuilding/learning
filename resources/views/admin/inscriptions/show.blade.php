@extends('layouts.app')

@section('title', 'Détail de l\'inscription — Administration')

@section('page_title', 'Détail de l\'inscription')
@section('page_icon', 'fa-info-circle')

@section('breadcrumb')
    <li><a href="{{ route('admin.inscriptions.index') }}">Inscriptions</a></li>
    <li class="active">Détail</li>
@endsection

@section('page_actions')
    <a href="{{ route('admin.inscriptions.edit', $inscription['id']) }}" class="btn btn-sm btn-primary rounded-pill">
        <i class="fas fa-edit"></i> Modifier
    </a>
    <a href="{{ route('admin.inscriptions.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
        <i class="fas fa-arrow-left"></i> Retour
    </a>
@endsection

@section('contenu')
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-8">
                    <h4 class="fw-bold">{{ $inscription['apprenant'] }}</h4>
                    <p class="text-muted">{{ $inscription['email'] }}</p>

                    <div class="row mt-3">
                        <div class="col-md-4">
                            <span class="text-muted small">Formation</span>
                            <div class="fw-semibold">{{ $inscription['formation'] }}</div>
                        </div>
                        <div class="col-md-4">
                            <span class="text-muted small">Date d'inscription</span>
                            <div class="fw-semibold">{{ \Carbon\Carbon::parse($inscription['date_inscription'])->format('d/m/Y') }}</div>
                        </div>
                        <div class="col-md-4">
                            <span class="text-muted small">Statut</span>
                            <span class="badge {{ $inscription['statut'] == 'active' ? 'bg-primary' : ($inscription['statut'] == 'terminee' ? 'bg-success' : ($inscription['statut'] == 'en_attente' ? 'bg-warning' : 'bg-danger')) }}">
                                {{ ucfirst(str_replace('_', ' ', $inscription['statut'])) }}
                            </span>
                        </div>
                        <div class="col-md-4 mt-3">
                            <span class="text-muted small">Progression</span>
                            <div class="fw-semibold">{{ $inscription['progression'] }}%</div>
                            <div class="progress mt-1" style="height: 6px;">
                                <div class="progress-bar bg-success" style="width: {{ $inscription['progression'] }}%;"></div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <span class="text-muted small">Date début</span>
                            <div class="fw-semibold">{{ \Carbon\Carbon::parse($inscription['date_debut'])->format('d/m/Y') }}</div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <span class="text-muted small">Date fin prévue</span>
                            <div class="fw-semibold">{{ \Carbon\Carbon::parse($inscription['date_fin_prevue'])->format('d/m/Y') }}</div>
                        </div>
                        @if($inscription['date_completion'])
                            <div class="col-md-4 mt-3">
                                <span class="text-muted small">Date d'achèvement</span>
                                <div class="fw-semibold">{{ \Carbon\Carbon::parse($inscription['date_completion'])->format('d/m/Y') }}</div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-user-graduate fa-3x text-primary opacity-50"></i>
                            <h2 class="fw-bold mt-2">{{ $inscription['progression'] }}%</h2>
                            <span class="text-muted">Progression globale</span>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <h5 class="fw-bold"><i class="fas fa-cubes me-2"></i>Modules suivis</h5>
            <ul class="list-group mt-3">
                @forelse($inscription['modules'] as $module)
                    <li class="list-group-item d-flex align-items-center gap-3">
                        @if($module['termine'])
                            <i class="fas fa-check-circle text-success"></i>
                        @else
                            <i class="fas fa-circle text-muted"></i>
                        @endif
                        <span class="fw-semibold">{{ $module['titre'] }}</span>
                        <span class="ms-auto badge {{ $module['termine'] ? 'bg-success' : 'bg-secondary' }}">
                            {{ $module['termine'] ? 'Terminé' : 'En cours' }}
                        </span>
                    </li>
                @empty
                    <span class="text-muted">Aucun module suivi.</span>
                @endforelse
            </ul>

            <hr class="my-4">

            <h5 class="fw-bold"><i class="fas fa-question-circle me-2 text-warning"></i>Quiz tentés</h5>
            <ul class="list-group mt-3">
                @forelse($inscription['quiz'] as $quiz)
                    <li class="list-group-item d-flex align-items-center gap-3">
                        <span class="fw-semibold">{{ $quiz['titre'] }}</span>
                        <span class="ms-auto">
                            <span class="badge {{ $quiz['reussi'] ? 'bg-success' : 'bg-danger' }}">
                                {{ $quiz['score'] }}%
                            </span>
                        </span>
                    </li>
                @empty
                    <span class="text-muted">Aucun quiz tenté.</span>
                @endforelse
            </ul>
        </div>
    </div>
@endsection