@extends('layouts.app')

@section('title', 'Tableau de bord — Formateur')

@section('page_title', 'Mes formations')
@section('page_icon', 'fa-chalkboard-teacher')

@section('breadcrumb')
    <li><a href="{{ route('home') }}">Accueil</a></li>
    <li class="active">Formations</li>
@endsection

@section('page_actions')
    <a href="#" class="btn btn-sm btn-primary rounded-pill">
        <i class="fas fa-plus-circle"></i> Nouvelle formation
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
                <div class="stat-icon"><i class="fas fa-book-open"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Cours actifs</span>
                    <span class="stat-value">{{ rand(3, 10) }}</span>
                    <span class="stat-trend up"><i class="fas fa-arrow-up"></i> +2</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card gradient-success">
                <div class="stat-icon"><i class="fas fa-users"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Apprenants</span>
                    <span class="stat-value">{{ rand(50, 200) }}</span>
                    <span class="stat-trend up"><i class="fas fa-arrow-up"></i> +12%</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card gradient-warning">
                <div class="stat-icon"><i class="fas fa-clipboard-list"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Quiz à noter</span>
                    <span class="stat-value">{{ rand(2, 8) }}</span>
                    <span class="stat-trend stable"><i class="fas fa-minus"></i> stable</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card gradient-info">
                <div class="stat-icon"><i class="fas fa-certificate"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Certificats émis</span>
                    <span class="stat-value">{{ rand(10, 40) }}</span>
                    <span class="stat-trend up"><i class="fas fa-arrow-up"></i> +5%</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== GRAPHIQUE ET DERNIÈRES ACTIVITÉS ===== --}}
    <div class="row g-4 mb-4">
        <div class="col-lg-7">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center py-3">
                    <h5 class="fw-bold mb-0"><i class="fas fa-chart-line me-2 text-primary"></i>Évolution des inscriptions</h5>
                    <span class="text-muted small">Derniers 30 jours</span>
                </div>
                <div class="card-body">
                    <canvas id="inscriptionsChart" height="220"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-transparent py-3">
                    <h5 class="fw-bold mb-0"><i class="fas fa-clock me-2 text-primary"></i>Dernières activités</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @for ($i = 0; $i < 5; $i++)
                            @php
                                $actions = ['Nouvelle inscription', 'Quiz complété', 'Nouvelle formation', 'Certificat délivré'];
                                $action = $actions[rand(0,3)];
                                $icon = ['fa-user-plus', 'fa-check-circle', 'fa-plus-circle', 'fa-certificate'][rand(0,3)];
                                $bgColor = ['bg-primary', 'bg-success', 'bg-warning', 'bg-info'][rand(0,3)];
                            @endphp
                            <li class="list-group-item d-flex align-items-center gap-3 py-3">
                                <span class="activity-icon {{ $bgColor }}">
                                    <i class="fas {{ $icon }}"></i>
                                </span>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold small">{{ $action }}</span>
                                    <span class="text-muted small d-block">{{ fake()->name() }}</span>
                                </div>
                                <span class="text-muted small">{{ fake()->time('H:i') }}</span>
                            </li>
                        @endfor
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== LISTE DES FORMATIONS ===== --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-transparent d-flex justify-content-between align-items-center py-3">
            <h5 class="fw-bold mb-0"><i class="fas fa-list-ul me-2 text-primary"></i>Vos formations</h5>
            <span class="badge bg-primary rounded-pill">{{ rand(1, 5) }} en cours</span>
        </div>
        <div class="card-body p-0">
            @for ($i = 0; $i < 4; $i++)
                @php
                    $progress = rand(40, 95);
                    $niveau = ['Débutant', 'Intermédiaire', 'Avancé'][rand(0,2)];
                    $titre = fake()->sentence(3);
                @endphp
                <div class="formation-item d-flex flex-wrap align-items-center justify-content-between p-3 border-bottom">
                    <div class="formation-info flex-grow-1 me-3">
                        <h6 class="mb-0 fw-semibold">{{ $titre }}</h6>
                        <span class="text-muted small"><i class="fas fa-signal me-1"></i>{{ $niveau }}</span>
                    </div>
                    <div class="formation-progress d-flex align-items-center gap-3 flex-wrap">
                        <div class="progress" style="width: 120px; height: 6px;">
                            <div class="progress-bar bg-success" style="width: {{ $progress }}%; border-radius: 10px;"></div>
                        </div>
                        <span class="fw-bold small">{{ $progress }}%</span>
                        <a href="#" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                            <i class="fas fa-cog me-1"></i> Gérer
                        </a>
                    </div>
                </div>
            @endfor
        </div>
        <div class="card-footer bg-transparent border-0 text-center py-3">
            <a href="#" class="btn btn-sm btn-outline-secondary rounded-pill">Voir toutes les formations</a>
        </div>
    </div>

    {{-- ===== QUIZ EN ATTENTE ===== --}}
    @if(rand(0,1))
        <div class="row mt-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-transparent d-flex justify-content-between align-items-center py-3">
                        <h5 class="fw-bold mb-0"><i class="fas fa-question-circle me-2 text-warning"></i>Quiz en attente de correction</h5>
                        <span class="badge bg-warning rounded-pill">{{ rand(1, 5) }} en attente</span>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @for ($i = 0; $i < 3; $i++)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="fw-semibold">{{ fake()->sentence(2) }}</span>
                                        <span class="text-muted small d-block">Soumis par {{ fake()->name() }}</span>
                                    </div>
                                    <div>
                                        <span class="badge bg-warning me-2">En attente</span>
                                        <a href="#" class="btn btn-sm btn-primary rounded-pill">Corriger</a>
                                    </div>
                                </li>
                            @endfor
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('css')
<style>
    /* ===== STATISTICS CARDS ===== */
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
    .stat-card .stat-trend {
        font-size: 0.7rem;
        font-weight: 600;
        display: inline-block;
        margin-top: 0.15rem;
        padding: 0.1rem 0.6rem;
        border-radius: 20px;
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(4px);
    }
    .stat-trend.up { color: #a8e6cf; }
    .stat-trend.stable { color: #ffd166; }

    .gradient-primary { background: linear-gradient(135deg, #0F3B43 0%, #1A7E86 100%); }
    .gradient-success { background: linear-gradient(135deg, #1A6E40 0%, #2D9B5E 100%); }
    .gradient-warning { background: linear-gradient(135deg, #B47D2A 0%, #EAA14F 100%); }
    .gradient-info { background: linear-gradient(135deg, #1A5276 0%, #2980B9 100%); }

    /* ===== ACTIVITY LIST ===== */
    .activity-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 0.85rem;
        flex-shrink: 0;
    }
    .activity-icon.bg-primary { background: #1A7E86; }
    .activity-icon.bg-success { background: #2D9B5E; }
    .activity-icon.bg-warning { background: #D48A3A; }
    .activity-icon.bg-info { background: #2980B9; }

    .list-group-item {
        border-color: #f0f2f1;
        transition: background 0.15s;
    }
    .list-group-item:hover {
        background: #fafbfa;
    }

    /* ===== FORMATION ITEMS ===== */
    .formation-item {
        background: #fff;
        transition: background 0.15s;
    }
    .formation-item:hover {
        background: #f8faf9;
    }
    .formation-item:last-child {
        border-bottom: none !important;
    }
    .formation-info h6 {
        color: #0F3B43;
        font-size: 0.95rem;
    }
    .formation-info .text-muted {
        font-size: 0.8rem;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .stat-card {
            flex-direction: column;
            text-align: center;
            padding: 1.25rem;
        }
        .stat-card .stat-icon {
            margin-bottom: 0.5rem;
        }
        .formation-item {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 0.75rem;
        }
        .formation-progress {
            width: 100%;
            justify-content: space-between;
        }
        .formation-progress .progress {
            flex: 1;
        }
    }
</style>
@endpush

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Graphique des inscriptions
        const ctx = document.getElementById('inscriptionsChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['J1', 'J5', 'J10', 'J15', 'J20', 'J25', 'J30'],
                datasets: [{
                    label: 'Inscriptions',
                    data: [5, 8, 12, 10, 15, 20, 18],
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
                        displayColors: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.05)', drawBorder: false },
                        ticks: {
                            stepSize: 5,
                            font: { size: 11, family: "'Kumbh Sans', sans-serif" }
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: {
                            font: { size: 11, family: "'Kumbh Sans', sans-serif" }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection