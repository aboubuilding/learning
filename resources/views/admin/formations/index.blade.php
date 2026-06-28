@extends('layouts.app')

@section('title', 'Gestion des formations — Administration')

@section('page_title', 'Gestion des formations')
@section('page_icon', 'fa-graduation-cap')

@section('breadcrumb')
    <li><a href="{{ route('admin.dashboard') }}">Administration</a></li>
    <li class="active">Formations</li>
@endsection

@section('page_actions')
    <a href="{{ route('admin.formations.create') }}" class="btn btn-sm btn-primary rounded-pill">
        <i class="fas fa-plus-circle"></i> Nouvelle formation
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
                <select class="form-select" id="categorieFilter" style="width: 150px;">
                    <option value="">Toutes catégories</option>
                    <option value="Sécurité">Sécurité</option>
                    <option value="Réglementation">Réglementation</option>
                    <option value="Recouvrement des coûts">Recouvrement des coûts</option>
                    <option value="Produits chimiques">Produits chimiques</option>
                </select>
                <select class="form-select" id="statutFilter" style="width: 150px;">
                    <option value="">Tous statuts</option>
                    <option value="Publiée">Publiée</option>
                    <option value="Brouillon">Brouillon</option>
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
                            <th>Catégorie</th>
                            <th>Formateur</th>
                            <th>Niveau</th>
                            <th>Inscriptions</th>
                            <th>Statut</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($formations as $formation)
                            <tr>
                                <td>{{ $formation['id'] }}</td>
                                <td><strong>{{ $formation['titre'] }}</strong></td>
                                <td>{{ $formation['categorie'] }}</td>
                                <td>{{ $formation['formateur'] }}</td>
                                <td><span class="badge bg-secondary">{{ $formation['niveau'] }}</span></td>
                                <td>{{ $formation['inscriptions'] }}</td>
                                <td>
                                    <span class="badge {{ $formation['statut'] == 'Publiée' ? 'bg-success' : 'bg-warning' }}">
                                        {{ $formation['statut'] }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.formations.show', $formation['id']) }}" class="btn btn-outline-info" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.formations.edit', $formation['id']) }}" class="btn btn-outline-primary" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.formations.destroy', $formation['id']) }}" method="POST" class="d-inline delete-form">
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
                            <tr><td colspan="8" class="text-center py-4 text-muted">Aucune formation trouvée.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer bg-white border-0 py-3 px-4">
            <div class="text-muted small">
                <i class="fas fa-chart-simple me-1"></i> {{ count($formations) }} formation(s)
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const categorieFilter = document.getElementById('categorieFilter');
        const statutFilter = document.getElementById('statutFilter');
        const rows = document.querySelectorAll('tbody tr');

        function filterTable() {
            const search = searchInput.value.toLowerCase().trim();
            const categorie = categorieFilter.value;
            const statut = statutFilter.value;

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                const rowCategorie = row.cells[2]?.textContent.trim() || '';
                const rowStatut = row.cells[6]?.textContent.trim() || '';

                let show = true;
                if (search && !text.includes(search)) show = false;
                if (categorie && rowCategorie !== categorie) show = false;
                if (statut && rowStatut !== statut) show = false;

                row.style.display = show ? '' : 'none';
            });
        }

        searchInput.addEventListener('keyup', filterTable);
        categorieFilter.addEventListener('change', filterTable);
        statutFilter.addEventListener('change', filterTable);

        // Confirmation suppression
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Supprimer définitivement cette formation ?')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endsection