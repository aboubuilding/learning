@extends('layouts.app')

@section('title', 'Gestion des utilisateurs — Administration')

@section('page_title', 'Gestion des utilisateurs')
@section('page_icon', 'fa-users-cog')

@section('breadcrumb')
    <li><a href="{{ route('admin.dashboard') }}">Administration</a></li>
    <li class="active">Utilisateurs</li>
@endsection

@section('page_actions')
    <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-primary rounded-pill">
        <i class="fas fa-user-plus"></i> Ajouter
    </a>
    <a href="#" class="btn btn-sm btn-outline-secondary rounded-pill">
        <i class="fas fa-file-export"></i> Exporter
    </a>
@endsection

@section('contenu')
    {{-- ===== STATISTIQUES ===== --}}
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card gradient-primary">
                <div class="stat-icon"><i class="fas fa-users"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Total utilisateurs</span>
                    <span class="stat-value">{{ count($users) }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card gradient-success">
                <div class="stat-icon"><i class="fas fa-user-check"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Actifs</span>
                    <span class="stat-value">{{ collect($users)->where('statut', 'Actif')->count() }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card gradient-info">
                <div class="stat-icon"><i class="fas fa-user-graduate"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Apprenants</span>
                    <span class="stat-value">{{ collect($users)->where('role', 'Apprenant')->count() }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card gradient-warning">
                <div class="stat-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Formateurs</span>
                    <span class="stat-value">{{ collect($users)->where('role', 'Formateur')->count() }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== TABLEAU ===== --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-transparent py-3 px-4 d-flex flex-wrap justify-content-between align-items-center gap-2">
            <div class="d-flex gap-2 flex-wrap">
                <div class="input-group" style="width: 280px;">
                    <span class="input-group-text bg-transparent border-end-0"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control border-start-0" id="searchInput" placeholder="Rechercher par nom, email...">
                </div>
                <select class="form-select" id="roleFilter" style="width: 150px;">
                    <option value="">Tous les rôles</option>
                    <option value="Apprenant">Apprenant</option>
                    <option value="Formateur">Formateur</option>
                    <option value="Administrateur">Administrateur</option>
                </select>
                <select class="form-select" id="statusFilter" style="width: 150px;">
                    <option value="">Tous statuts</option>
                    <option value="Actif">Actif</option>
                    <option value="Inactif">Inactif</option>
                </select>
            </div>
            <span class="text-muted small"><i class="far fa-clock me-1"></i> {{ now()->format('d/m/Y H:i') }}</span>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="usersTable">
                    <thead class="bg-light">
                        <tr>
                            <th>#</th>
                            <th>Nom complet</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Statut</th>
                            <th>Inscrit le</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="usersTbody">
                        @forelse($users as $user)
                            <tr data-role="{{ $user['role'] }}" data-status="{{ $user['statut'] }}">
                                <td>{{ $user['id'] }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar-circle" style="width: 32px; height: 32px; background: var(--aq-secondary); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.8rem;">
                                            {{ strtoupper(substr($user['prenom'], 0, 1) . substr($user['nom'], 0, 1)) }}
                                        </div>
                                        <span class="fw-semibold">{{ $user['prenom'] }} {{ $user['nom'] }}</span>
                                    </div>
                                </td>
                                <td>{{ $user['email'] }}</td>
                                <td>
                                    <span class="badge {{ $user['role'] == 'Administrateur' ? 'bg-danger' : ($user['role'] == 'Formateur' ? 'bg-info' : 'bg-primary') }}">
                                        {{ $user['role'] }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge {{ $user['statut'] == 'Actif' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $user['statut'] }}
                                    </span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($user['inscrit_le'])->format('d/m/Y') }}</td>
                                <td class="text-end">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.users.show', $user['id']) }}" class="btn btn-outline-info" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.users.edit', $user['id']) }}" class="btn btn-outline-primary" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $user['id']) }}" method="POST" class="d-inline delete-form">
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
                            <tr><td colspan="7" class="text-center py-4 text-muted">Aucun utilisateur trouvé.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer bg-white border-0 py-3 px-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div class="text-muted small">
                <i class="fas fa-chart-simple me-1"></i> <span id="userCount">{{ count($users) }}</span> utilisateur(s)
            </div>
            <nav>
                <ul class="pagination pagination-sm mb-0" id="pagination">
                    <li class="page-item disabled"><a class="page-link" href="#">Précédent</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">Suivant</a></li>
                </ul>
            </nav>
        </div>
    </div>
@endsection

@push('css')
<style>
    .stat-card {
        position: relative;
        padding: 1.5rem;
        border-radius: 16px;
        color: #fff;
        display: flex;
        align-items: center;
        gap: 1.25rem;
        box-shadow: 0 8px 24px rgba(15, 59, 67, 0.08);
        transition: transform 0.2s, box-shadow 0.2s;
        overflow: hidden;
        height: 100%;
        min-height: 100px;
    }
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 32px rgba(15, 59, 67, 0.15);
    }
    .stat-card .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(4px);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
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
        margin-bottom: 0.2rem;
    }
    .stat-card .stat-value {
        font-size: 2rem;
        font-weight: 800;
        line-height: 1.2;
        display: block;
    }
    .gradient-primary { background: linear-gradient(135deg, #0F3B43 0%, #1A7E86 100%); }
    .gradient-success { background: linear-gradient(135deg, #1A6E40 0%, #2D9B5E 100%); }
    .gradient-info { background: linear-gradient(135deg, #1A5276 0%, #2980B9 100%); }
    .gradient-warning { background: linear-gradient(135deg, #B47D2A 0%, #EAA14F 100%); }

    .avatar-circle {
        flex-shrink: 0;
    }
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
    .btn-group .btn {
        border-radius: 6px;
        margin: 0 1px;
    }
    @media (max-width: 768px) {
        .stat-card {
            flex-direction: column;
            text-align: center;
            padding: 1.25rem;
        }
        .stat-card .stat-icon {
            margin-bottom: 0.5rem;
        }
    }
</style>
@endpush

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const roleFilter = document.getElementById('roleFilter');
        const statusFilter = document.getElementById('statusFilter');
        const rows = document.querySelectorAll('#usersTbody tr');
        const countSpan = document.getElementById('userCount');

        function filterTable() {
            const search = searchInput.value.toLowerCase().trim();
            const selectedRole = roleFilter.value;
            const selectedStatus = statusFilter.value;

            let visibleCount = 0;
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                const rowRole = row.dataset.role;
                const rowStatus = row.dataset.status;

                let show = true;
                if (search && !text.includes(search)) show = false;
                if (selectedRole && rowRole !== selectedRole) show = false;
                if (selectedStatus && rowStatus !== selectedStatus) show = false;

                row.style.display = show ? '' : 'none';
                if (show) visibleCount++;
            });
            countSpan.textContent = visibleCount;
        }

        searchInput.addEventListener('keyup', filterTable);
        roleFilter.addEventListener('change', filterTable);
        statusFilter.addEventListener('change', filterTable);

        // Confirmation suppression
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Supprimer définitivement cet utilisateur ?')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endsection