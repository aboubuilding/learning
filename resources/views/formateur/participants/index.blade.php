@extends('layouts.app')

@section('title', 'Mes participants — AquaForm')

@section('page_title', 'Participants à mes formations')
@section('page_icon', 'fa-users')

@section('breadcrumb')
    <li><a href="{{ route('home') }}">Accueil</a></li>
    <li><a href="{{ route('formateur.dashboard') }}">Tableau de bord</a></li>
    <li class="active">Participants</li>
@endsection

@section('contenu')
    {{-- Statistiques --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="stat-card gradient-primary">
                <div class="stat-icon"><i class="fas fa-users"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Total inscrits</span>
                    <span class="stat-value">{{ count($participants) }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card gradient-success">
                <div class="stat-icon"><i class="fas fa-user-check"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Actifs</span>
                    <span class="stat-value">{{ collect($participants)->where('statut', 'active')->count() }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card gradient-warning">
                <div class="stat-icon"><i class="fas fa-hourglass-half"></i></div>
                <div class="stat-content">
                    <span class="stat-label">En attente</span>
                    <span class="stat-value">{{ collect($participants)->where('statut', 'en_attente')->count() }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card gradient-info">
                <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Progression moyenne</span>
                    <span class="stat-value">{{ round(collect($participants)->avg('progression')) }}%</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Filtre par formation --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body py-3">
            <form method="GET" class="row g-2">
                <div class="col-md-4">
                    <select name="formation" class="form-select" onchange="this.form.submit()">
                        <option value="">Toutes les formations</option>
                        @foreach($formations as $formation)
                            <option value="{{ $formation['id'] }}" {{ request('formation') == $formation['id'] ? 'selected' : '' }}>
                                {{ $formation['titre'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary rounded-pill w-100">Filtrer</button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('formateur.participants.index') }}" class="btn btn-outline-secondary rounded-pill w-100">Réinitialiser</a>
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
                            <th>Participant</th>
                            <th>Email</th>
                            <th>Formation</th>
                            <th>Statut</th>
                            <th>Progression</th>
                            <th>Inscrit le</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($participants as $participant)
                            @php
                                $formationNom = collect($formations)->firstWhere('id', $participant['formation_id'])['titre'] ?? 'N/A';
                            @endphp
                            <tr>
                                <td><span class="fw-semibold">{{ $participant['nom'] }}</span></td>
                                <td>{{ $participant['email'] }}</td>
                                <td>{{ $formationNom }}</td>
                                <td>
                                    <span class="badge {{ $participant['statut'] == 'active' ? 'bg-success' : ($participant['statut'] == 'en_attente' ? 'bg-warning' : 'bg-danger') }}">
                                        {{ ucfirst(str_replace('_', ' ', $participant['statut'])) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="progress" style="width: 80px; height: 6px;">
                                            <div class="progress-bar bg-success" style="width: {{ $participant['progression'] }}%;"></div>
                                        </div>
                                        <span class="fw-bold small">{{ $participant['progression'] }}%</span>
                                    </div>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($participant['date_inscription'])->format('d/m/Y') }}</td>
                                <td class="text-end">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('formateur.participants.show', $participant['id']) }}" class="btn btn-outline-info rounded-pill" title="Voir le détail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-primary rounded-pill" title="Modifier le statut" data-bs-toggle="modal" data-bs-target="#statutModal{{ $participant['id'] }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('formateur.participants.destroy', $participant['id']) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger rounded-pill" title="Désinscrire" onclick="return confirm('Désinscrire définitivement ce participant ?')">
                                                <i class="fas fa-user-minus"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center py-4 text-muted">Aucun participant trouvé.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODALES STATUT (pour chaque participant) --}}
    @foreach($participants as $participant)
    <div class="modal fade" id="statutModal{{ $participant['id'] }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('formateur.participants.updateStatut', $participant['id']) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Modifier le statut</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>{{ $participant['nom'] }}</strong></p>
                        <div class="mb-3">
                            <label class="form-label">Nouveau statut</label>
                            <select name="statut" class="form-select">
                                <option value="en_attente" {{ $participant['statut'] == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                <option value="active" {{ $participant['statut'] == 'active' ? 'selected' : '' }}>Actif</option>
                                <option value="terminee" {{ $participant['statut'] == 'terminee' ? 'selected' : '' }}>Terminé</option>
                                <option value="annulee" {{ $participant['statut'] == 'annulee' ? 'selected' : '' }}>Annulé</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary rounded-pill">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
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
        min-height: 85px;
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
        font-size: 1.3rem;
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
    .gradient-warning { background: linear-gradient(135deg, #B47D2A 0%, #EAA14F 100%); }
    .gradient-info { background: linear-gradient(135deg, #1A5276 0%, #2980B9 100%); }
    .btn-group .btn {
        border-radius: 20px;
        margin: 0 2px;
    }
</style>
@endpush

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Confirmation suppression
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Désinscrire définitivement ce participant de la formation ?')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endpush