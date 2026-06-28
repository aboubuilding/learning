@extends('layouts.app')

@section('title', 'Statistiques globales — Administration')

@section('page_title', 'Statistiques globales')
@section('page_icon', 'fa-chart-pie')

@section('breadcrumb')
    <li><a href="{{ route('admin.dashboard') }}">Administration</a></li>
    <li class="active">Statistiques</li>
@endsection

@section('page_actions')
    <a href="#" class="btn btn-sm btn-success rounded-pill">
        <i class="fas fa-file-export"></i> Exporter (Excel)
    </a>
    <a href="#" class="btn btn-sm btn-outline-secondary rounded-pill">
        <i class="fas fa-print"></i> Imprimer
    </a>
@endsection

@section('contenu')
    {{-- ===== KPI CARDS ===== --}}
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card gradient-primary">
                <div class="stat-icon"><i class="fas fa-users"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Utilisateurs</span>
                    <span class="stat-value">{{ $stats['total_utilisateurs'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card gradient-success">
                <div class="stat-icon"><i class="fas fa-graduation-cap"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Formations</span>
                    <span class="stat-value">{{ $stats['total_formations'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card gradient-info">
                <div class="stat-icon"><i class="fas fa-pen-alt"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Inscriptions</span>
                    <span class="stat-value">{{ $stats['total_inscriptions'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card gradient-warning">
                <div class="stat-icon"><i class="fas fa-certificate"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Certificats délivrés</span>
                    <span class="stat-value">{{ $stats['certificats_delivres'] }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== DEUXIÈME LIGNE KPI ===== --}}
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card gradient-teal">
                <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Taux de complétion moyen</span>
                    <span class="stat-value">{{ $stats['taux_completion_moyen'] }}%</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card gradient-purple">
                <div class="stat-icon"><i class="fas fa-question-circle"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Quiz tentés</span>
                    <span class="stat-value">{{ $stats['quiz_tentes'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card gradient-pink">
                <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Quiz réussis</span>
                    <span class="stat-value">{{ $stats['quiz_reussis'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card gradient-dark">
                <div class="stat-icon"><i class="fas fa-percent"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Taux de réussite quiz</span>
                    <span class="stat-value">{{ $stats['taux_reussite_quiz'] }}%</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== GRAPHIQUES ===== --}}
    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center py-3">
                    <h5 class="fw-bold mb-0"><i class="fas fa-chart-bar me-2 text-primary"></i>Évolution des inscriptions</h5>
                    <span class="text-muted small">Derniers 12 mois</span>
                </div>
                <div class="card-body">
                    <canvas id="inscriptionsChart" height="220"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-transparent py-3">
                    <h5 class="fw-bold mb-0"><i class="fas fa-chart-pie me-2 text-primary"></i>Répartition par catégorie</h5>
                </div>
                <div class="card-body">
                    <canvas id="categoriesChart" height="220"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== DEUXIÈME LIGNE DE GRAPHIQUES ===== --}}
    <div class="row g-4 mt-2">
        <div class="col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent py-3">
                    <h5 class="fw-bold mb-0"><i class="fas fa-trophy me-2 text-warning"></i>Top 5 formations les plus suivies</h5>
                </div>
                <div class="card-body">
                    <canvas id="topFormationsChart" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent py-3">
                    <h5 class="fw-bold mb-0"><i class="fas fa-users-cog me-2 text-info"></i>Répartition des rôles</h5>
                </div>
                <div class="card-body">
                    <canvas id="rolesChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== TABLEAU DE COMPLÉTION (extrait) ===== --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center py-3">
                    <h5 class="fw-bold mb-0"><i class="fas fa-check-double me-2 text-success"></i>Taux de complétion par formation</h5>
                    <a href="{{ route('admin.statistiques.completion') }}" class="btn btn-sm btn-outline-primary rounded-pill">
                        Voir le détail <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Formation</th>
                                    <th>Taux</th>
                                    <th>Inscrits</th>
                                    <th>Terminés</th>
                                    <th>Progression</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(array_slice($completion_formations, 0, 5) as $formation)
                                    <tr>
                                        <td><span class="fw-semibold">{{ $formation['titre'] }}</span></td>
                                        <td>
                                            <span class="fw-bold">{{ $formation['taux'] }}%</span>
                                        </td>
                                        <td>{{ rand(15, 45) }}</td>
                                        <td>{{ round(rand(15, 45) * ($formation['taux'] / 100)) }}</td>
                                        <td>
                                            <div class="progress" style="width: 100px; height: 6px;">
                                                <div class="progress-bar bg-success" style="width: {{ $formation['taux'] }}%;"></div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
    .gradient-teal { background: linear-gradient(135deg, #0E4B55 0%, #1A7E86 100%); }
    .gradient-purple { background: linear-gradient(135deg, #4A2C6E 0%, #7E57A7 100%); }
    .gradient-pink { background: linear-gradient(135deg, #8E2A5A 0%, #D45A8A 100%); }
    .gradient-dark { background: linear-gradient(135deg, #1A1A2E 0%, #3D3D5C 100%); }
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
    }
</style>
@endpush

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Évolution des inscriptions
        const ctx1 = document.getElementById('inscriptionsChart').getContext('2d');
        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($inscriptions_mensuelles)) !!},
                datasets: [{
                    label: 'Inscriptions',
                    data: {!! json_encode(array_values($inscriptions_mensuelles)) !!},
                    backgroundColor: 'rgba(26, 126, 134, 0.6)',
                    borderColor: '#1A7E86',
                    borderWidth: 2,
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } },
                    x: { grid: { display: false } }
                }
            }
        });

        // 2. Répartition par catégorie
        const ctx2 = document.getElementById('categoriesChart').getContext('2d');
        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode(array_keys($categories)) !!},
                datasets: [{
                    data: {!! json_encode(array_values($categories)) !!},
                    backgroundColor: ['#1A7E86', '#EAA14F', '#2D9B5E', '#2980B9', '#A569BD'],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom' } },
                cutout: '65%'
            }
        });

        // 3. Top 5 formations
        const ctx3 = document.getElementById('topFormationsChart').getContext('2d');
        new Chart(ctx3, {
            type: 'horizontalBar',
            data: {
                labels: {!! json_encode(array_column($top_formations, 'titre')) !!},
                datasets: [{
                    label: 'Inscriptions',
                    data: {!! json_encode(array_column($top_formations, 'inscriptions')) !!},
                    backgroundColor: 'rgba(234, 161, 79, 0.7)',
                    borderColor: '#EAA14F',
                    borderWidth: 2,
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                indexAxis: 'y',
                plugins: { legend: { display: false } },
                scales: {
                    x: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } },
                    y: { grid: { display: false } }
                }
            }
        });

        // 4. Répartition des rôles
        const ctx4 = document.getElementById('rolesChart').getContext('2d');
        new Chart(ctx4, {
            type: 'pie',
            data: {
                labels: {!! json_encode(array_keys($roles_repartition)) !!},
                datasets: [{
                    data: {!! json_encode(array_values($roles_repartition)) !!},
                    backgroundColor: ['#1A7E86', '#2D9B5E', '#EAA14F'],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom' } }
            }
        });
    });
</script>
@endsection