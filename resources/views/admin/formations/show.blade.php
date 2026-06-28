@extends('layouts.app')

@section('title', 'Détail de la formation — Administration')

@section('page_title', 'Détail de la formation')
@section('page_icon', 'fa-info-circle')

@section('breadcrumb')
    <li><a href="{{ route('admin.formations.index') }}">Formations</a></li>
    <li class="active">Détail</li>
@endsection

@section('page_actions')
    <a href="{{ route('admin.formations.edit', $formation['id']) }}" class="btn btn-sm btn-primary rounded-pill">
        <i class="fas fa-edit"></i> Modifier
    </a>
    <a href="{{ route('admin.formations.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
        <i class="fas fa-arrow-left"></i> Retour
    </a>
@endsection

@section('contenu')
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-8">
                    <h3 class="fw-bold">{{ $formation['titre'] }}</h3>
                    <p class="text-muted">{{ $formation['description'] }}</p>

                    <div class="row mt-4">
                        <div class="col-md-4">
                            <span class="text-muted small">Catégorie</span>
                            <div class="fw-semibold">{{ $formation['categorie'] }}</div>
                        </div>
                        <div class="col-md-4">
                            <span class="text-muted small">Formateur</span>
                            <div class="fw-semibold">{{ $formation['formateur'] }}</div>
                        </div>
                        <div class="col-md-4">
                            <span class="text-muted small">Niveau</span>
                            <div class="fw-semibold">{{ $formation['niveau'] }}</div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <span class="text-muted small">Durée</span>
                            <div class="fw-semibold">{{ $formation['duree'] }}</div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <span class="text-muted small">Statut</span>
                            <span class="badge {{ $formation['est_publie'] ? 'bg-success' : 'bg-warning' }}">
                                {{ $formation['est_publie'] ? 'Publiée' : 'Brouillon' }}
                            </span>
                        </div>
                        <div class="col-md-4 mt-3">
                            <span class="text-muted small">Inscriptions</span>
                            <div class="fw-semibold">{{ $formation['inscriptions'] }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-light border-0">
                        <div class="card-body text-center">
                            <i class="fas fa-users fa-3x text-primary opacity-50"></i>
                            <h2 class="fw-bold mt-2">{{ $formation['inscriptions'] }}</h2>
                            <span class="text-muted">Apprenants inscrits</span>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <h5 class="fw-bold"><i class="fas fa-cubes me-2"></i>Modules</h5>
            <div class="list-group mt-3">
                @forelse($formation['modules'] as $module)
                    <div class="list-group-item d-flex align-items-center gap-3">
                        <span class="badge bg-secondary rounded-pill">{{ $module['ordre'] }}</span>
                        <span class="fw-semibold">{{ $module['titre'] }}</span>
                    </div>
                @empty
                    <span class="text-muted">Aucun module défini.</span>
                @endforelse
            </div>
        </div>
    </div>
@endsection