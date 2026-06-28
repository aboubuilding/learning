@extends('layouts.app')

@section('title', 'Journal d\'activités — Administration')

@section('page_title', 'Journal d\'activités')
@section('page_icon', 'fa-history')

@section('breadcrumb')
    <li><a href="{{ route('admin.dashboard') }}">Administration</a></li>
    <li class="active">Journal</li>
@endsection

@section('page_actions')
    <a href="{{ route('admin.journal.export') }}" class="btn btn-sm btn-success rounded-pill">
        <i class="fas fa-file-export"></i> Exporter (CSV)
    </a>
    <a href="#" class="btn btn-sm btn-outline-secondary rounded-pill">
        <i class="fas fa-sync-alt"></i> Rafraîchir
    </a>
@endsection

@section('contenu')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    {{-- Filtres --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.journal.index') }}" class="row g-3">
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0"><i class="fas fa-search"></i></span>
                        <input type="text" name="q" class="form-control border-start-0" placeholder="Rechercher..." value="{{ $query ?? '' }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <select name="utilisateur" class="form-select">
                        <option value="">Tous utilisateurs</option>
                        @foreach($utilisateurs as $user)
                            <option value="{{ $user }}" {{ ($utilisateur ?? '') == $user ? 'selected' : '' }}>{{ $user }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="action" class="form-select">
                        <option value="">Toutes actions</option>
                        @foreach($actions as $actionName)
                            <option value="{{ $actionName }}" {{ ($action ?? '') == $actionName ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('_', ' ', $actionName)) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="date" name="date_debut" class="form-control" placeholder="Date début" value="{{ $date_debut ?? '' }}">
                </div>
                <div class="col-md-2">
                    <input type="date" name="date_fin" class="form-control" placeholder="Date fin" value="{{ $date_fin ?? '' }}">
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary w-100 rounded-pill">
                        <i class="fas fa-filter"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Tableau --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>#</th>
                            <th>Utilisateur</th>
                            <th>Action</th>
                            <th>Description</th>
                            <th>IP</th>
                            <th>Temps</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pagedLogs as $log)
                            <tr>
                                <td>{{ $log['id'] }}</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fw-semibold">{{ $log['utilisateur'] }}</span>
                                        <span class="text-muted small">{{ $log['email'] }}</span>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $actionColors = [
                                            'connexion' => 'bg-primary',
                                            'deconnexion' => 'bg-secondary',
                                            'consultation_formation' => 'bg-info',
                                            'quiz_tente' => 'bg-warning',
                                            'telechargement' => 'bg-success',
                                            'inscription_cours' => 'bg-primary',
                                            'modification_cours' => 'bg-warning',
                                            'ajout_utilisateur' => 'bg-success',
                                            'progression' => 'bg-info',
                                        ];
                                        $actionIcons = [
                                            'connexion' => 'fa-sign-in-alt',
                                            'deconnexion' => 'fa-sign-out-alt',
                                            'consultation_formation' => 'fa-eye',
                                            'quiz_tente' => 'fa-question-circle',
                                            'telechargement' => 'fa-download',
                                            'inscription_cours' => 'fa-pen-alt',
                                            'modification_cours' => 'fa-edit',
                                            'ajout_utilisateur' => 'fa-user-plus',
                                            'progression' => 'fa-chart-line',
                                        ];
                                    @endphp
                                    <span class="badge {{ $actionColors[$log['action']] ?? 'bg-secondary' }}">
                                        <i class="fas {{ $actionIcons[$log['action']] ?? 'fa-circle' }} me-1"></i>
                                        {{ ucfirst(str_replace('_', ' ', $log['action'])) }}
                                    </span>
                                </td>
                                <td>{{ $log['description'] }}</td>
                                <td><code>{{ $log['adresse_ip'] }}</code></td>
                                <td>
                                    @if($log['temps_passe'])
                                        {{ floor($log['temps_passe'] / 60) }}min {{ $log['temps_passe'] % 60 }}s
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($log['date'])->format('d/m/Y H:i:s') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center py-4 text-muted">Aucune activité trouvée.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        @if($total > 0)
            <div class="card-footer bg-white border-0 py-3 px-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div class="text-muted small">
                    <i class="fas fa-chart-simple me-1"></i> {{ $total }} activité(s) — Page {{ $page }} sur {{ $totalPages }}
                </div>
                <nav>
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item {{ $page <= 1 ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $page > 1 ? route('admin.journal.index', array_merge(request()->query(), ['page' => $page - 1])) : '#' }}">Précédent</a>
                        </li>
                        @for($i = 1; $i <= $totalPages; $i++)
                            <li class="page-item {{ $i == $page ? 'active' : '' }}">
                                <a class="page-link" href="{{ route('admin.journal.index', array_merge(request()->query(), ['page' => $i])) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="page-item {{ $page >= $totalPages ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $page < $totalPages ? route('admin.journal.index', array_merge(request()->query(), ['page' => $page + 1])) : '#' }}">Suivant</a>
                        </li>
                    </ul>
                </nav>
            </div>
        @endif
    </div>
@endsection

@push('css')
<style>
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
    }
    .table td {
        font-size: 0.9rem;
    }
    code {
        background: #f4f6f5;
        padding: 0.15rem 0.5rem;
        border-radius: 4px;
        font-size: 0.8rem;
    }
    .badge i {
        font-size: 0.7rem;
    }
    .pagination .page-link {
        border-radius: 6px;
        margin: 0 2px;
        border: none;
        color: #1A7E86;
        font-weight: 600;
    }
    .pagination .page-item.active .page-link {
        background: #1A7E86;
        color: #fff;
    }
    .pagination .page-item.disabled .page-link {
        color: #ccc;
    }
</style>
@endpush