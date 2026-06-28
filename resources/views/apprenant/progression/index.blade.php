@extends('layouts.app')

@section('title', 'Ma progression — AquaForm')

@section('page_title', 'Vue d\'ensemble de ma progression')
@section('page_icon', 'fa-chart-line')

@section('breadcrumb')
    <li><a href="{{ route('home') }}">Accueil</a></li>
    <li class="active">Ma progression</li>
@endsection

@section('contenu')
    {{-- ===== EN-TÊTE APPRENANT ===== --}}
    <div class="d-flex align-items-center gap-3 mb-4">
        <div class="avatar-lg" style="width: 64px; height: 64px; background: var(--aq-secondary); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; font-weight: 700;">
            {{ strtoupper(substr($apprenant['prenom'], 0, 1) . substr($apprenant['nom'], 0, 1)) }}
        </div>
        <div>
            <h4 class="fw-bold mb-0">{{ $apprenant['prenom'] }} {{ $apprenant['nom'] }}</h4>
            <p class="text-muted mb-0">{{ $apprenant['email'] }}</p>
        </div>
    </div>

    {{-- ===== STATISTIQUES ===== --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="stat-card gradient-primary">
                <div class="stat-icon"><i class="fas fa-book-open"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Formations</span>
                    <span class="stat-value">{{ $stats['total_formations'] }}</span>
                    <span class="stat-sub">{{ $stats['terminees'] }} terminées</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card gradient-success">
                <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Taux de complétion</span>
                    <span class="stat-value">{{ $stats['taux_completion_global'] }}%</span>
                    <div class="progress mt-1" style="height: 4px;">
                        <div class="progress-bar bg-white" style="width: {{ $stats['taux_completion_global'] }}%;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card gradient-warning">
                <div class="stat-icon"><i class="fas fa-certificate"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Certificats</span>
                    <span class="stat-value">{{ $stats['certificats_obtenus'] }}</span>
                    <span class="stat-sub">obtenus</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card gradient-info">
                <div class="stat-icon"><i class="fas fa-clock"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Temps passé</span>
                    <span class="stat-value" style="font-size: 1.5rem;">{{ $stats['temps_total'] }}</span>
                    <span class="stat-sub">sur la plateforme</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== GRAPHIQUE DE PROGRESSION ===== --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-transparent d-flex justify-content-between align-items-center py-3">
            <h5 class="fw-bold mb-0"><i class="fas fa-chart-area me-2 text-primary"></i>Évolution de ma progression</h5>
            <span class="text-muted small">12 derniers mois</span>
        </div>
        <div class="card-body">
            <canvas id="progressionChart" height="180"></canvas>
        </div>
    </div>

    {{-- ===== FORMATIONS SUIVIES ===== --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-transparent d-flex justify-content-between align-items-center py-3">
            <h5 class="fw-bold mb-0"><i class="fas fa-list-ul me-2 text-primary"></i>Mes formations</h5>
            <div class="d-flex gap-2">
                <span class="badge bg-success rounded-pill">{{ $stats['terminees'] }} terminées</span>
                <span class="badge bg-primary rounded-pill">{{ $stats['en_cours'] }} en cours</span>
                <span class="badge bg-secondary rounded-pill">{{ $stats['non_commencees'] }} à commencer</span>
            </div>
        </div>
        <div class="card-body p-0">
            @foreach($formations as $formation)
                <div class="d-flex flex-wrap align-items-center justify-content-between p-3 border-bottom">
                    <div class="flex-grow-1 me-3" style="min-width: 150px;">
                        <h6 class="mb-0 fw-semibold">{{ $formation['titre'] }}</h6>
                        <span class="text-muted small">
                            <i class="fas fa-user-chalk me-1"></i>{{ $formation['formateur'] }}
                            <span class="mx-1">·</span>
                            <span class="badge bg-secondary">{{ $formation['categorie'] }}</span>
                        </span>
                    </div>
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <div class="text-center" style="min-width: 60px;">
                            <span class="fw-bold">{{ $formation['progression'] }}%</span>
                            <div class="progress" style="width: 80px; height: 4px;">
                                <div class="progress-bar bg-success" style="width: {{ $formation['progression'] }}%;"></div>
                            </div>
                        </div>
                        <span class="badge {{ $formation['statut'] == 'terminee' ? 'bg-success' : ($formation['statut'] == 'en_cours' ? 'bg-primary' : 'bg-secondary') }}">
                            {{ $formation['statut'] == 'terminee' ? '✓ Terminée' : ($formation['statut'] == 'en_cours' ? 'En cours' : 'À commencer') }}
                        </span>
                        <span class="text-muted small">{{ $formation['temps_passe'] }}</span>
                        @if($formation['statut'] == 'en_cours')
                            <a href="{{ route('apprenant.progression.show', $formation['id']) }}" class="btn btn-sm btn-primary rounded-pill">
                                <i class="fas fa-play me-1"></i> Continuer
                            </a>
                        @elseif($formation['statut'] == 'terminee')
                            <a href="#" class="btn btn-sm btn-outline-success rounded-pill">
                                <i class="fas fa-eye me-1"></i> Voir
                            </a>
                        @else
                            <a href="#" class="btn btn-sm btn-outline-primary rounded-pill">
                                <i class="fas fa-play me-1"></i> Démarrer
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- ===== DERNIERS QUIZ ===== --}}
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center py-3">
                    <h5 class="fw-bold mb-0"><i class="fas fa-question-circle me-2 text-warning"></i>Derniers quiz</h5>
                    <span class="badge bg-primary rounded-pill">{{ $stats['taux_reussite_quiz'] }}% de réussite</span>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @foreach($quiz_recents as $quiz)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="fw-semibold">{{ $quiz['titre'] }}</span>
                                    <span class="text-muted small d-block">{{ \Carbon\Carbon::parse($quiz['date'])->format('d/m/Y') }}</span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="fw-bold">{{ $quiz['score'] }}%</span>
                                    <span class="badge {{ $quiz['reussi'] ? 'bg-success' : 'bg-danger' }}">
                                        {{ $quiz['reussi'] ? '✅ Réussi' : '❌ Échec' }}
                                    </span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        {{-- ===== CERTIFICATS ===== --}}
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-transparent py-3">
                    <h5 class="fw-bold mb-0"><i class="fas fa-certificate me-2 text-success"></i>Certificats obtenus</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @foreach($certificats as $certificat)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="fw-semibold">{{ $certificat['titre'] }}</span>
                                    <span class="text-muted small d-block">N° {{ $certificat['numero'] }}</span>
                                </div>
                                <span class="text-muted small">{{ \Carbon\Carbon::parse($certificat['date'])->format('d/m/Y') }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <a href="#" class="btn btn-sm btn-outline-primary rounded-pill w-100">
                        <i class="fas fa-download me-1"></i> Télécharger tous les certificats
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== DERNIÈRES ACTIVITÉS ===== --}}
    <div class="card shadow-sm border-0 mt-4">
        <div class="card-header bg-transparent py-3">
            <h5 class="fw-bold mb-0"><i class="fas fa-history me-2 text-info"></i>Mes dernières activités</h5>
        </div>
        <div class="card-body p-0">
            <ul class="list-group list-group-flush">
                @foreach($activites_recentes as $activite)
                    <li class="list-group-item d-flex align-items-center gap-3">
                        <span class="badge bg-secondary rounded-pill">{{ \Carbon\Carbon::parse($activite['date'])->format('H:i') }}</span>
                        <div>
                            <span class="fw-semibold">{{ $activite['action'] }}</span>
                            @if($activite['formation'])
                                <span class="text-muted small"> — {{ $activite['formation'] }}</span>
                            @endif
                        </div>
                        <span class="ms-auto text-muted small">{{ \Carbon\Carbon::parse($activite['date'])->format('d/m/Y') }}</span>
                    </li>
                @endforeach
            </ul>
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
        min-height: 90px;
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
    .stat-card .stat-sub {
        font-size: 0.75rem;
        opacity: 0.8;
        display: block;
        margin-top: 2px;
    }
    .gradient-primary { background: linear-gradient(135deg, #0F3B43 0%, #1A7E86 100%); }
    .gradient-success { background: linear-gradient(135deg, #1A6E40 0%, #2D9B5E 100%); }
    .gradient-warning { background: linear-gradient(135deg, #B47D2A 0%, #EAA14F 100%); }
    .gradient-info { background: linear-gradient(135deg, #1A5276 0%, #2980B9 100%); }

    .list-group-item {
        border-color: #f0f2f1;
        transition: background 0.15s;
    }
    .list-group-item:hover {
        background: #fafbfa;
    }
    .list-group-item .badge {
        font-weight: 600;
    }
    .avatar-lg {
        flex-shrink: 0;
    }
</style>
@endpush

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Graphique de progression
        const ctx = document.getElementById('progressionChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode(array_keys($progression_mensuelle)) !!},
                datasets: [{
                    label: 'Progression (%)',
                    data: {!! json_encode(array_values($progression_mensuelle)) !!},
                    borderColor: '#1A7E86',
                    backgroundColor: 'rgba(26, 126, 134, 0.08)',
                    borderWidth: 3,
                    pointBackgroundColor: '#1A7E86',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#0F3B43',
                        titleColor: '#fff',
                        bodyColor: '#DFEAE8',
                        cornerRadius: 8,
                        padding: 10,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y + '%';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        grid: { color: 'rgba(0,0,0,0.05)', drawBorder: false },
                        ticks: {
                            stepSize: 20,
                            font: { size: 11, family: "'Kumbh Sans', sans-serif" },
                            callback: function(value) { return value + '%'; }
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: {
                            font: { size: 10, family: "'Kumbh Sans', sans-serif" }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection