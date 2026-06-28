@extends('layouts.app')

@section('title', 'Gestion des inscriptions — Administration')

@section('page_title', 'Gestion des inscriptions')
@section('page_icon', 'fa-pen-alt')

@section('breadcrumb')
    <li><a href="{{ route('admin.dashboard') }}">Administration</a></li>
    <li class="active">Inscriptions</li>
@endsection

@section('page_actions')
    <a href="#" class="btn btn-sm btn-success rounded-pill">
        <i class="fas fa-file-export"></i> Exporter
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
            <form class="row g-3" method="GET" action="{{ route('admin.inscriptions.index') }}">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0"><i class="fas fa-search"></i></span>
                        <input type="text" name="q" class="form-control border-start-0" placeholder="Rechercher un apprenant, une formation..." value="{{ request('q') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="statut" class="form-select">
                        <option value="">Tous statuts</option>
                        <option value="en_attente" {{ request('statut') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                        <option value="active" {{ request('statut') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="terminee" {{ request('statut') == 'terminee' ? 'selected' : '' }}>Terminée</option>
                        <option value="annulee" {{ request('statut') == 'annulee' ? 'selected' : '' }}>Annulée</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="formation" class="form-select">
                        <option value="">Toutes formations</option>
                        @foreach($formations as $formation)
                            <option value="{{ $formation }}" {{ request('formation') == $formation ? 'selected' : '' }}>{{ $formation }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100 rounded-pill">
                        <i class="fas fa-filter me-1"></i> Filtrer
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
                            <th>Apprenant</th>
                            <th>Formation</th>
                            <th>Date d'inscription</th>
                            <th>Progression</th>
                            <th>Statut</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($inscriptions as $inscription)
                            <tr>
                                <td>{{ $inscription['id'] }}</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fw-semibold">{{ $inscription['apprenant'] }}</span>
                                        <span class="text-muted small">{{ $inscription['email'] }}</span>
                                    </div>
                                </td>
                                <td>{{ $inscription['formation'] }}</td>
                                <td>{{ \Carbon\Carbon::parse($inscription['date_inscription'])->format('d/m/Y') }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="progress" style="width: 80px; height: 6px;">
                                            <div class="progress-bar bg-success" style="width: {{ $inscription['progression'] }}%;"></div>
                                        </div>
                                        <span class="small fw-bold">{{ $inscription['progression'] }}%</span>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $statutColors = [
                                            'en_attente' => 'bg-warning',
                                            'active' => 'bg-primary',
                                            'terminee' => 'bg-success',
                                            'annulee' => 'bg-danger',
                                        ];
                                    @endphp
                                    <span class="badge {{ $statutColors[$inscription['statut']] ?? 'bg-secondary' }}">
                                        {{ ucfirst(str_replace('_', ' ', $inscription['statut'])) }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.inscriptions.show', $inscription['id']) }}" class="btn btn-outline-info" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.inscriptions.edit', $inscription['id']) }}" class="btn btn-outline-primary" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @if($inscription['statut'] == 'en_attente')
                                            <form action="{{ route('admin.inscriptions.validate', $inscription['id']) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-success" title="Valider">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                        @endif
                                        @if($inscription['statut'] != 'annulee' && $inscription['statut'] != 'terminee')
                                            <form action="{{ route('admin.inscriptions.cancel', $inscription['id']) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger" title="Annuler" onclick="return confirm('Annuler cette inscription ?')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('admin.inscriptions.destroy', $inscription['id']) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" title="Supprimer">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center py-4 text-muted">Aucune inscription trouvée.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-0 py-3 px-4">
            <div class="text-muted small">
                <i class="fas fa-chart-simple me-1"></i> {{ count($inscriptions) }} inscription(s)
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Confirmation suppression
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Supprimer définitivement cette inscription ?')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endsection