@extends('layouts.app')

@section('title', 'Détail de la catégorie — Administration')

@section('page_title', 'Détail de la catégorie')
@section('page_icon', 'fa-info-circle')

@section('breadcrumb')
    <li><a href="{{ route('admin.categories.index') }}">Catégories</a></li>
    <li class="active">Détail</li>
@endsection

@section('page_actions')
    <a href="{{ route('admin.categories.edit', $category['id']) }}" class="btn btn-sm btn-primary rounded-pill">
        <i class="fas fa-edit"></i> Modifier
    </a>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
        <i class="fas fa-arrow-left"></i> Retour
    </a>
@endsection

@section('contenu')
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-8">
                    <h3 class="fw-bold">{{ $category['nom'] }}</h3>
                    <p class="text-muted">{{ $category['description'] }}</p>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <span class="text-muted small">Statut</span>
                            <div>
                                <span class="badge {{ $category['etat'] == 'Actif' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $category['etat'] }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-light border-0">
                        <div class="card-body text-center">
                            <i class="fas fa-graduation-cap fa-3x text-primary opacity-50"></i>
                            <h2 class="fw-bold mt-2">{{ count($category['formations']) }}</h2>
                            <span class="text-muted">Formations associées</span>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <h5 class="fw-bold"><i class="fas fa-book me-2"></i>Formations dans cette catégorie</h5>
            <div class="list-group mt-3">
                @forelse($category['formations'] as $formation)
                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <span>{{ $formation['titre'] }}</span>
                        <span class="badge bg-secondary">{{ $formation['niveau'] }}</span>
                    </a>
                @empty
                    <span class="text-muted">Aucune formation dans cette catégorie.</span>
                @endforelse
            </div>
        </div>
    </div>
@endsection