@extends('layouts.app')

@section('title', 'Gestion des catégories — Administration')

@section('page_title', 'Gestion des catégories')
@section('page_icon', 'fa-tags')

@section('breadcrumb')
    <li><a href="{{ route('admin.dashboard') }}">Administration</a></li>
    <li class="active">Catégories</li>
@endsection

@section('page_actions')
    <a href="{{ route('admin.categories.create') }}" class="btn btn-sm btn-primary rounded-pill">
        <i class="fas fa-plus-circle"></i> Nouvelle catégorie
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
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Formations</th>
                            <th>Statut</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr data-statut="{{ $category['etat'] }}">
                                <td>{{ $category['id'] }}</td>
                                <td><strong>{{ $category['nom'] }}</strong></td>
                                <td>{{ Str::limit($category['description'], 50) }}</td>
                                <td><span class="badge bg-info">{{ $category['formations_count'] }}</span></td>
                                <td>
                                    <span class="badge {{ $category['etat'] == 'Actif' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $category['etat'] }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.categories.show', $category['id']) }}" class="btn btn-outline-info" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.categories.edit', $category['id']) }}" class="btn btn-outline-primary" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $category['id']) }}" method="POST" class="d-inline delete-form">
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
                            <tr><td colspan="6" class="text-center py-4 text-muted">Aucune catégorie trouvée.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer bg-white border-0 py-3 px-4">
            <div class="text-muted small">
                <i class="fas fa-chart-simple me-1"></i> {{ count($categories) }} catégorie(s)
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const statutFilter = document.getElementById('statutFilter');
        const rows = document.querySelectorAll('tbody tr');

        function filterTable() {
            const search = searchInput.value.toLowerCase().trim();
            const statut = statutFilter.value;

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                const rowStatut = row.dataset.statut || '';

                let show = true;
                if (search && !text.includes(search)) show = false;
                if (statut && rowStatut !== statut) show = false;

                row.style.display = show ? '' : 'none';
            });
        }

        searchInput.addEventListener('keyup', filterTable);
        statutFilter.addEventListener('change', filterTable);

        // Confirmation suppression
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Supprimer définitivement cette catégorie ?')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endsection