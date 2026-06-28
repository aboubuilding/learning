@extends('layouts.app')

@section('title', 'Détail du module — Administration')

@section('page_title', 'Détail du module')
@section('page_icon', 'fa-info-circle')

@section('breadcrumb')
    <li><a href="{{ route('admin.modules.index') }}">Modules</a></li>
    <li class="active">Détail</li>
@endsection

@section('page_actions')
    <a href="{{ route('admin.modules.edit', $module['id']) }}" class="btn btn-sm btn-primary rounded-pill">
        <i class="fas fa-edit"></i> Modifier
    </a>
    <a href="{{ route('admin.modules.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
        <i class="fas fa-arrow-left"></i> Retour
    </a>
@endsection

@section('contenu')
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-8">
                    <h3 class="fw-bold">{{ $module['titre'] }}</h3>
                    <p>{{ $module['description'] }}</p>

                    <div class="row mt-4">
                        <div class="col-md-4">
                            <span class="text-muted small">Formation</span>
                            <div class="fw-semibold">{{ $module['formation'] }}</div>
                        </div>
                        <div class="col-md-4">
                            <span class="text-muted small">Formateur</span>
                            <div class="fw-semibold">{{ $module['formateur'] }}</div>
                        </div>
                        <div class="col-md-4">
                            <span class="text-muted small">Ordre</span>
                            <div class="fw-semibold">{{ $module['ordre'] }}</div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <span class="text-muted small">Statut</span>
                            <span class="badge {{ $module['statut'] == 'Actif' ? 'bg-success' : 'bg-secondary' }}">
                                {{ $module['statut'] }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-light border-0">
                        <div class="card-body text-center">
                            <i class="fas fa-file-alt fa-3x text-primary opacity-50"></i>
                            <h5 class="fw-bold mt-2">{{ count($module['ressources']) }}</h5>
                            <span class="text-muted">Ressources associées</span>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <h5 class="fw-bold"><i class="fas fa-paperclip me-2"></i>Ressources du module</h5>
            <div class="list-group mt-3">
                @forelse($module['ressources'] as $ressource)
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-file me-2"></i> {{ $ressource['titre'] }}</span>
                        <span class="badge bg-secondary">{{ $ressource['type'] }}</span>
                    </div>
                @empty
                    <span class="text-muted">Aucune ressource associée.</span>
                @endforelse
            </div>
        </div>
    </div>
@endsection