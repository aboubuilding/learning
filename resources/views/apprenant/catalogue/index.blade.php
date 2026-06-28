@extends('layouts.app')

@section('title', 'Catalogue des formations — AquaForm')

@section('page_title', 'Catalogue des formations')
@section('page_icon', 'fa-book-open')

@section('breadcrumb')
    <li><a href="{{ route('home') }}">Accueil</a></li>
    <li class="active">Catalogue</li>
@endsection

@section('page_actions')
    <a href="#" class="btn btn-sm btn-outline-secondary rounded-pill">
        <i class="fas fa-print"></i> Imprimer
    </a>
@endsection

@section('contenu')
    {{-- Barre de recherche et filtres --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('apprenant.catalogue.index') }}" id="filterForm">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0"><i class="fas fa-search"></i></span>
                            <input type="text" name="q" class="form-control border-start-0" placeholder="Rechercher une formation..." value="{{ request('q') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select name="categorie" class="form-select">
                            <option value="">Toutes catégories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ request('categorie') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="niveau" class="form-select">
                            <option value="">Tous niveaux</option>
                            @foreach($niveaux as $niveau)
                                <option value="{{ $niveau }}" {{ request('niveau') == $niveau ? 'selected' : '' }}>{{ $niveau }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100 rounded-pill">
                            <i class="fas fa-filter me-1"></i> Filtrer
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Résultat / compteur --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted small">{{ count($formations) }} formation(s) disponible(s)</span>
        <div>
            <a href="#" class="btn btn-sm btn-outline-secondary rounded-pill"><i class="fas fa-th"></i></a>
            <a href="#" class="btn btn-sm btn-outline-secondary rounded-pill"><i class="fas fa-list"></i></a>
        </div>
    </div>

    {{-- Grille des formations --}}
    <div class="row g-4">
        @forelse($formations as $formation)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0 hover-card">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge bg-secondary">{{ $formation['categorie'] }}</span>
                            <span class="badge {{ $formation['niveau'] == 'Débutant' ? 'bg-success' : ($formation['niveau'] == 'Intermédiaire' ? 'bg-warning' : 'bg-danger') }}">
                                {{ $formation['niveau'] }}
                            </span>
                        </div>
                        <h5 class="card-title fw-bold">{{ $formation['titre'] }}</h5>
                        <p class="card-text text-muted small flex-grow-1">{{ Str::limit($formation['description'], 120) }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <div>
                                <span class="text-muted small"><i class="fas fa-user-chalk me-1"></i>{{ $formation['formateur'] }}</span>
                            </div>
                            <div>
                                <span class="text-muted small"><i class="far fa-clock me-1"></i>{{ $formation['duree'] }}</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <div>
                                <span class="text-warning"><i class="fas fa-star"></i> {{ $formation['rating'] }}</span>
                                <span class="text-muted small">({{ $formation['avis'] }})</span>
                            </div>
                            @if($formation['est_inscrit'])
                                <span class="badge bg-success">Inscrit</span>
                            @endif
                        </div>
                        <div class="mt-3 d-grid gap-2">
                            <a href="{{ route('apprenant.catalogue.show', $formation['id']) }}" class="btn btn-outline-primary rounded-pill">
                                <i class="fas fa-eye me-1"></i> Voir les détails
                            </a>
                            @if($formation['est_inscrit'])
                                @if($formation['progression'] == 100)
                                    <a href="#" class="btn btn-success rounded-pill">
                                        <i class="fas fa-check-circle me-1"></i> Terminé
                                    </a>
                                @else
                                    <a href="#" class="btn btn-primary rounded-pill">
                                        <i class="fas fa-play me-1"></i> Continuer ({{ $formation['progression'] }}%)
                                    </a>
                                @endif
                            @else
                                <a href="#" class="btn btn-primary rounded-pill">
                                    <i class="fas fa-plus-circle me-1"></i> S'inscrire
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">Aucune formation trouvée</h4>
                <p class="text-muted">Essayez de modifier vos critères de recherche.</p>
            </div>
        @endforelse
    </div>
@endsection

@push('css')
<style>
    .hover-card {
        transition: transform 0.2s, box-shadow 0.2s;
        border-radius: 16px;
        overflow: hidden;
    }
    .hover-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(15, 59, 67, 0.12) !important;
    }
    .card-title {
        font-size: 1rem;
    }
    .badge {
        font-weight: 600;
    }
</style>
@endpush