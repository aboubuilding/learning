@extends('layouts.app')

@section('title', 'Mon historique — AquaForm')

@section('page_title', 'Historique des formations suivies')
@section('page_icon', 'fa-history')

@section('breadcrumb')
    <li><a href="{{ route('home') }}">Accueil</a></li>
    <li><a href="{{ route('apprenant.progression.index') }}">Ma progression</a></li>
    <li class="active">Historique</li>
@endsection

@section('page_actions')
    <a href="#" class="btn btn-sm btn-outline-success rounded-pill">
        <i class="fas fa-file-export"></i> Exporter (PDF)
    </a>
@endsection

@section('contenu')
    {{-- ===== STATISTIQUES RÉSUMÉ ===== --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="stat-card gradient-primary">
                <div class="stat-icon"><i class="fas fa-book-open"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Total formations</span>
                    <span class="stat-value">{{ $stats['total'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card gradient-success">
                <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Terminées</span>
                    <span class="stat-value">{{ $stats['terminees'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card gradient-info">
                <div class="stat-icon"><i class="fas fa-clock"></i></div>
                <div class="stat-content">
                    <span class="stat-label">En cours</span>
                    <span class="stat-value">{{ $stats['en_cours'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card gradient-warning">
                <div class="stat-icon"><i class="fas fa-certificate"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Certificats</span>
                    <span class="stat-value">{{ $stats['certificats'] }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== FILTRES ===== --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form class="row g-3" method="GET" action="{{ route('apprenant.historique.index') }}">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0"><i class="fas fa-search"></i></span>
                        <input type="text" name="q" class="form-control border-start-0" placeholder="Rechercher une formation..." value="{{ request('q') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="statut" class="form-select">
                        <option value="">Tous les statuts</option>
                        <option value="terminee" {{ request('statut') == 'terminee' ? 'selected' : '' }}>Terminées</option>
                        <option value="en_cours" {{ request('statut') == 'en_cours' ? 'selected' : '' }}>En cours</option>
                        <option value="non_commencee" {{ request('statut') == 'non_commencee' ? 'selected' : '' }}>À commencer</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="categorie" class="form-select">
                        <option value="">Toutes catégories</option>
                        @foreach($categories as $categorie)
                            <option value="{{ $categorie }}" {{ request('categorie') == $categorie ? 'selected' : '' }}>{{ $categorie }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary w-100 rounded-pill">
                        <i class="fas fa-filter"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ===== TABLEAU HISTORIQUE ===== --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>Formation</th>
                            <th>Catégorie</th>
                            <th>Formateur</th>
                            <th>Date début</th>
                            <th>Date fin</th>
                            <th>Progression</th>
                            <th>Statut</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($historique as $item)
                            <tr>
                                <td>
                                    <span class="fw-semibold">{{ $item['titre'] }}</span>
                                    @if($item['certificat'])
                                        <span class="badge bg-success ms-1"><i class="fas fa-certificate me-1"></i>Certifié</span>
                                    @endif
                                </td>
                                <td><span class="badge bg-secondary">{{ $item['categorie'] }}</span></td>
                                <td>{{ $item['formateur'] }}</td>
                                <td>{{ $item['date_debut'] ? \Carbon\Carbon::parse($item['date_debut'])->format('d/m/Y') : '-' }}</td>
                                <td>{{ $item['date_fin'] ? \Carbon\Carbon::parse($item['date_fin'])->format('d/m/Y') : '-' }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="progress" style="width: 80px; height: 5px;">
                                            <div class="progress-bar bg-success" style="width: {{ $item['progression'] }}%;"></div>
                                        </div>
                                        <span class="fw-bold small">{{ $item['progression'] }}%</span>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $statutLabels = [
                                            'terminee' => ['label' => 'Terminée', 'class' => 'bg-success'],
                                            'en_cours' => ['label' => 'En cours', 'class' => 'bg-primary'],
                                            'non_commencee' => ['label' => 'À commencer', 'class' => 'bg-secondary'],
                                        ];
                                    @endphp
                                    <span class="badge {{ $statutLabels[$item['statut']]['class'] }}">
                                        {{ $statutLabels[$item['statut']]['label'] }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('apprenant.historique.show', $item['id']) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                        <i class="fas fa-eye"></i> Voir
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="text-center py-4 text-muted">Aucune formation trouvée.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-0 py-3 px-4">
            <div class="text-muted small">
                <i class="fas fa-chart-simple me-1"></i> {{ count($historique) }} formation(s)
                <span class="ms-3"><i class="fas fa-clock me-1"></i> Temps total : {{ $stats['temps_total'] }}</span>
            </div>
        </div>
    </div>
@endsection

@push('css')
<style>
    .stat-card {
        position: relative;
        padding: 1.25rem 1.5rem;
        border-radius: 16px;
        color: #fff;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: 0 8px 24px rgba(15, 59, 67, 0.08);
        transition: transform 0.2s, box-shadow 0.2s;
        overflow: hidden;
        height: 100%;
        min-height: 80px;
    }
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 32px rgba(15, 59, 67, 0.15);
    }
    .stat-card .stat-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(4px);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        flex-shrink: 0;
    }
    .stat-card .stat-content {
        flex: 1;
    }
    .stat-card .stat-label {
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        opacity: 0.85;
        display: block;
        margin-bottom: 0.1rem;
    }
    .stat-card .stat-value {
        font-size: 1.8rem;
        font-weight: 800;
        line-height: 1.2;
        display: block;
    }
    .gradient-primary { background: linear-gradient(135deg, #0F3B43 0%, #1A7E86 100%); }
    .gradient-success { background: linear-gradient(135deg, #1A6E40 0%, #2D9B5E 100%); }
    .gradient-info { background: linear-gradient(135deg, #1A5276 0%, #2980B9 100%); }
    .gradient-warning { background: linear-gradient(135deg, #B47D2A 0%, #EAA14F 100%); }

    .table > :not(caption) > * > * {
        padding: 0.75rem 0.75rem;
        vertical-align: middle;
    }
    .table th {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        color: #556B67;
        border-bottom-width: 1px;
        background-color: #f8faf9;
    }
    .table td {
        font-size: 0.9rem;
        vertical-align: middle;
    }
    .badge {
        font-weight: 600;
        padding: 0.35rem 0.7rem;
    }
</style>
@endpush