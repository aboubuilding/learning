@extends('layouts.app')

@section('title', 'Gestion des modules — Administration')

@section('page_title', 'Gestion des modules')
@section('page_icon', 'fa-cubes')

@section('breadcrumb')
    <li><a href="{{ route('admin.dashboard') }}">Administration</a></li>
    <li class="active">Modules</li>
@endsection

@section('page_actions')
    <a href="{{ route('admin.modules.create') }}" class="btn btn-sm btn-primary rounded-pill">
        <i class="fas fa-plus-circle"></i> Nouveau module
    </a>
    <a href="#" class="btn btn-sm btn-outline-secondary rounded-pill">
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

    <div class="card shadow-sm border-0">
        <div class="card-header bg-transparent py-3 px-4 d-flex flex-wrap justify-content-between align-items-center gap-2">
            <div class="d-flex gap-2 flex-wrap">
                <div class="input-group" style="width: 280px;">
                    <span class="input-group-text bg-transparent border-end-0"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control border-start-0" id="searchInput" placeholder="Rechercher...">
                </div>
                <select class="form-select" id="formationFilter" style="width: 180px;">
                    <option value="">Toutes formations</option>
                    <option value="Sécurité chimique avancée">Sécurité chimique avancée</option>
                    <option value="Introduction aux réglementations REACH">Introduction aux réglementations REACH</option>
                    <option value="Gestion des coûts en entreprise">Gestion des coûts en entreprise</option>
                </select>
                <select class="form-select" id="statutFilter" style="width: 150px;">
                    <option value="">Tous statuts</option>
                    <option value="Actif">Actif</option>
                    <option value="Inactif">Inactif</option>
                </select>
            </div>
            <span class="text-muted small"><i class="far fa-clock me-1"></i> {{ now()->format('d/m/Y H:i') }}</span>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>#</th>
                            <th>Titre</th>
                            <th>Formation</th>
                            <th>Formateur</th>
                            <th>Ordre</th>
                            <th>Statut</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($modules as $module)
                            <tr>
                                <td>{{ $module['id'] }}</td>
                                <td><strong>{{ $module['titre'] }}</strong></td>
                                <td>{{ $module['formation'] }}</td>
                                <td>{{ $module['formateur'] }}</td>
                                <td><span class="badge bg-secondary">{{ $module['ordre'] }}</span></td>
                                <td>
                                    <span class="badge {{ $module['statut'] == 'Actif' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $module['statut'] }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.modules.show', $module['id']) }}" class="btn btn-outline-info" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.modules.edit', $module['id']) }}" class="btn btn-outline-primary" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.modules.destroy', $module['id']) }}" method="POST" class="d-inline delete-form">
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
                            <tr><td colspan="7" class="text-center py-4 text-muted">Aucun module trouvé.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer bg-white border-0 py-3 px-4">
            <div class="text-muted small">
                <i class="fas fa-chart-simple me-1"></i> {{ count($modules) }} module(s)
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const formationFilter = document.getElementById('formationFilter');
        const statutFilter = document.getElementById('statutFilter');
        const rows = document.querySelectorAll('tbody tr');

        function filterTable() {
            const search = searchInput.value.toLowerCase().trim();
            const formation = formationFilter.value;
            const statut = statutFilter.value;

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                const rowFormation = row.cells[2]?.textContent.trim() || '';
                const rowStatut = row.cells[5]?.textContent.trim() || '';

                let show = true;
                if (search && !text.includes(search)) show = false;
                if (formation && rowFormation !== formation) show = false;
                if (statut && rowStatut !== statut) show = false;

                row.style.display = show ? '' : 'none';
            });
        }

        searchInput.addEventListener('keyup', filterTable);
        formationFilter.addEventListener('change', filterTable);
        statutFilter.addEventListener('change', filterTable);

        // Confirmation suppression
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Supprimer définitivement ce module ?')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endsection