@extends('layouts.app')

@section('title', 'Détail de la formation — Espace Apprenant')

@section('page_title', $formation['titre'])
@section('page_icon', 'fa-info-circle')

@section('breadcrumb')
    <li><a href="{{ route('home') }}">Accueil</a></li>
    <li><a href="{{ route('apprenant.mes-cours') }}">Mes cours</a></li>
    <li class="active">{{ $formation['titre'] }}</li>
@endsection

@section('page_actions')
    <a href="{{ route('apprenant.mes-cours') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
        <i class="fas fa-arrow-left"></i> Retour
    </a>
@endsection

@section('contenu')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h4 class="fw-bold">{{ $formation['titre'] }}</h4>
                    <p class="text-muted">{{ $formation['description'] }}</p>
                    <div class="d-flex flex-wrap gap-3 mt-3">
                        <span><i class="fas fa-user-chalk text-primary me-1"></i>Formateur : {{ $formation['formateur'] }}</span>
                        <span><i class="fas fa-chart-line text-success me-1"></i>Progression : {{ $formation['progression'] }}%</span>
                        <span class="badge {{ $formation['statut'] == 'termine' ? 'bg-success' : 'bg-primary' }}">
                            {{ $formation['statut'] == 'termine' ? 'Terminé' : 'En cours' }}
                        </span>
                    </div>

                    <hr class="my-4">
                    <h5 class="fw-bold"><i class="fas fa-cubes me-2"></i>Modules</h5>
                    <ul class="list-group mt-3">
                        @foreach($formation['modules'] as $module)
                            <li class="list-group-item d-flex align-items-center gap-3">
                                @if($module['termine'])
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span class="fw-semibold text-decoration-line-through text-muted">{{ $module['titre'] }}</span>
                                    <span class="ms-auto badge bg-success">Terminé</span>
                                @else
                                    <i class="fas fa-circle text-muted"></i>
                                    <span class="fw-semibold">{{ $module['titre'] }}</span>
                                    <span class="ms-auto badge bg-secondary">En cours</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="display-1 fw-bold text-primary">{{ $formation['progression'] }}%</div>
                    <p class="text-muted">Progression globale</p>
                    <div class="progress" style="height: 10px;">
                        <div class="progress-bar bg-success" style="width: {{ $formation['progression'] }}%; border-radius: 10px;"></div>
                    </div>
                    @if($formation['statut'] != 'termine')
                        <a href="#" class="btn btn-primary rounded-pill mt-3 w-100">
                            <i class="fas fa-play me-1"></i>Reprendre la formation
                        </a>
                    @endif
                </div>
            </div>

            <div class="card shadow-sm border-0 mt-3">
                <div class="card-body">
                    <h6 class="fw-bold"><i class="fas fa-info-circle me-2"></i>Informations</h6>
                    <ul class="list-unstyled">
                        <li><span class="text-muted">Statut :</span> <span class="badge {{ $formation['statut'] == 'termine' ? 'bg-success' : 'bg-primary' }}">{{ $formation['statut'] == 'termine' ? 'Terminé' : 'En cours' }}</span></li>
                        <li class="mt-2"><span class="text-muted">Progression :</span> {{ $formation['progression'] }}%</li>
                        <li class="mt-2"><span class="text-muted">Modules terminés :</span> {{ collect($formation['modules'])->where('termine', true)->count() }} / {{ count($formation['modules']) }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection