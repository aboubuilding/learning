@extends('layouts.app')

@section('title', 'Mes formations — AquaForm')

@section('page_title', 'Mes formations')
@section('page_icon', 'fa-chalkboard-teacher')

@section('breadcrumb')
    <li><a href="{{ route('home') }}">Accueil</a></li>
    <li class="active">Mes formations</li>
@endsection

@section('page_actions')
    <a href="#" class="btn btn-sm btn-primary rounded-pill">
        <i class="fas fa-plus-circle me-1"></i> Nouvelle formation
    </a>
    <a href="#" class="btn btn-sm btn-outline-secondary rounded-pill">
        <i class="fas fa-file-export me-1"></i> Exporter
    </a>
@endsection

@section('contenu')
    {{-- ===== STATISTIQUES ===== --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3 col-sm-6">
            <div class="stat-card gradient-primary">
                <div class="stat-icon"><i class="fas fa-graduation-cap"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Total formations</span>
                    <span class="stat-value">{{ count($formations) }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="stat-card gradient-success">
                <div class="stat-icon"><i class="fas fa-users"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Apprenants total</span>
                    <span class="stat-value">{{ collect($formations)->sum('inscriptions') }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="stat-card gradient-info">
                <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Progression moyenne</span>
                    <span class="stat-value">{{ round(collect($formations)->avg('progression_moyenne')) }}%</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="stat-card gradient-warning">
                <div class="stat-icon"><i class="fas fa-certificate"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Certificats émis</span>
                    <span class="stat-value">{{ rand(10, 50) }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== BARRE DE RECHERCHE ===== --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body py-3">
            <div class="row g-2">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control border-start-0" id="searchInput" placeholder="Rechercher une formation...">
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="niveauFilter">
                        <option value="">Tous niveaux</option>
                        <option value="Débutant">Débutant</option>
                        <option value="Intermédiaire">Intermédiaire</option>
                        <option value="Avancé">Avancé</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-select" id="statutFilter">
                        <option value="">Tous statuts</option>
                        <option value="Publiée">Publiée</option>
                        <option value="Brouillon">Brouillon</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-outline-secondary w-100 rounded-pill" id="resetFilters">
                        <i class="fas fa-undo me-1"></i> Réinitialiser
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== GRILLE DES FORMATIONS ===== --}}
    <div class="row g-4" id="formationsGrid">
        @forelse($formations as $formation)
            <div class="col-xl-4 col-md-6" data-niveau="{{ $formation['niveau'] }}" data-statut="Publiée">
                <div class="formation-card card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge {{ $formation['niveau'] == 'Avancé' ? 'bg-danger' : ($formation['niveau'] == 'Intermédiaire' ? 'bg-warning' : 'bg-success') }}">
                                {{ $formation['niveau'] }}
                            </span>
                            <span class="badge bg-secondary">{{ $formation['inscriptions'] }} inscrits</span>
                        </div>
                        <h5 class="fw-bold mb-2">{{ $formation['titre'] }}</h5>
                        <p class="text-muted small mb-3">
                            <i class="fas fa-user-chalk me-1"></i> {{ $formation['formateur'] ?? 'Non assigné' }}
                        </p>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="text-muted small">Progression moyenne</span>
                                <span class="fw-bold">{{ $formation['progression_moyenne'] }}%</span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-success" style="width: {{ $formation['progression_moyenne'] }}%;"></div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="badge bg-success">Publiée</span>
                            <a href="{{ route('formateur.formations.show', $formation['id']) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                <i class="fas fa-arrow-right me-1"></i> Gérer
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-graduation-cap fa-4x text-muted opacity-25"></i>
                    <h5 class="mt-3 text-muted">Aucune formation</h5>
                    <p class="text-muted small">Vous n'avez pas encore créé de formation.</p>
                    <a href="#" class="btn btn-primary rounded-pill mt-2">
                        <i class="fas fa-plus-circle me-1"></i> Créer ma première formation
                    </a>
                </div>
            </div>
        @endforelse
    </div>
@endsection

@push('css')
<style>
    /* ===== STATISTICS CARDS ===== */
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
    .gradient-info { background: linear-gradient(135deg, #1A5276 0%, #2980B9 100%); }
    .gradient-warning { background: linear-gradient(135deg, #B47D2A 0%, #EAA14F 100%); }

    /* ===== FORMATION CARDS ===== */
    .formation-card {
        transition: transform 0.2s, box-shadow 0.2s;
        border-radius: 14px;
        overflow: hidden;
    }
    .formation-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 36px rgba(15, 59, 67, 0.10) !important;
    }
    .formation-card .card-body {
        padding: 1.25rem;
    }
    .formation-card .badge {
        font-weight: 600;
        font-size: 0.7rem;
    }
    .formation-card .progress {
        background: #eef2f1;
    }
    .formation-card .progress-bar {
        border-radius: 10px;
    }

    /* ===== FILTERS BAR ===== */
    .input-group-text {
        color: #8a9aab;
    }
    .form-control:focus,
    .form-select:focus {
        border-color: #1A7E86;
        box-shadow: 0 0 0 3px rgba(26, 126, 134, 0.10);
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 576px) {
        .stat-card {
            padding: 1rem;
        }
        .stat-card .stat-value {
            font-size: 1.4rem;
        }
        .stat-card .stat-icon {
            width: 36px;
            height: 36px;
            font-size: 1rem;
        }
    }
</style>
@endpush

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const niveauFilter = document.getElementById('niveauFilter');
        const statutFilter = document.getElementById('statutFilter');
        const resetBtn = document.getElementById('resetFilters');
        const cards = document.querySelectorAll('#formationsGrid > .col-xl-4');

        function filterCards() {
            const search = searchInput.value.toLowerCase().trim();
            const niveau = niveauFilter.value;
            const statut = statutFilter.value;

            cards.forEach(card => {
                const text = card.textContent.toLowerCase();
                const cardNiveau = card.dataset.niveau;
                const cardStatut = card.dataset.statut;

                let show = true;
                if (search && !text.includes(search)) show = false;
                if (niveau && cardNiveau !== niveau) show = false;
                if (statut && cardStatut !== statut) show = false;

                card.style.display = show ? '' : 'none';
            });
        }

        searchInput.addEventListener('keyup', filterCards);
        niveauFilter.addEventListener('change', filterCards);
        statutFilter.addEventListener('change', filterCards);

        resetBtn.addEventListener('click', function() {
            searchInput.value = '';
            niveauFilter.value = '';
            statutFilter.value = '';
            filterCards();
        });
    });
</script>
@endpush