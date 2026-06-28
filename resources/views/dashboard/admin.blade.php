@extends('layouts.env')

@section('title', 'Tableau de bord — Administrateur')

@section('page_title', 'Administration')
@section('page_icon', 'fa-shield-alt')

@section('breadcrumb')
    <li><a href="#">Accueil</a></li>
    <li class="active">Administration</li>
@endsection

@section('page_actions')
    <button class="btn btn-sm btn-outline-primary" onclick="window.location.reload()">
        <i class="fas fa-sync-alt"></i> Rafraîchir
    </button>
    <a href="#" class="btn btn-sm btn-success">
        <i class="fas fa-file-export"></i> Exporter
    </a>
@endsection

@section('contenu')
    <div class="row g-4 mb-4">
        {{-- Statistiques globales --}}
        <div class="col-md-3">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted text-uppercase fw-bold small">Utilisateurs</h6>
                            <h2 class="mb-0 fw-bold">{{ rand(80, 150) }}</h2>
                            <span class="text-success small"><i class="fas fa-arrow-up"></i> +12%</span>
                        </div>
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                            <i class="fas fa-users fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted text-uppercase fw-bold small">Formations</h6>
                            <h2 class="mb-0 fw-bold">{{ rand(20, 50) }}</h2>
                            <span class="text-success small"><i class="fas fa-arrow-up"></i> +5%</span>
                        </div>
                        <div class="rounded-circle bg-info bg-opacity-10 p-3">
                            <i class="fas fa-graduation-cap fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted text-uppercase fw-bold small">Taux de complétion</h6>
                            <h2 class="mb-0 fw-bold">{{ rand(65, 90) }}%</h2>
                            <span class="text-warning small"><i class="fas fa-minus"></i> stable</span>
                        </div>
                        <div class="rounded-circle bg-success bg-opacity-10 p-3">
                            <i class="fas fa-chart-line fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted text-uppercase fw-bold small">Certificats délivrés</h6>
                            <h2 class="mb-0 fw-bold">{{ rand(100, 300) }}</h2>
                            <span class="text-success small"><i class="fas fa-arrow-up"></i> +8%</span>
                        </div>
                        <div class="rounded-circle bg-warning bg-opacity-10 p-3">
                            <i class="fas fa-certificate fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Graphique et tableau récent --}}
    <div class="row g-4">
        <div class="col-md-7">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0"><i class="fas fa-chart-bar text-primary me-2"></i>Évolution des inscriptions</h5>
                    <span class="text-muted small">Derniers 30 jours</span>
                </div>
                <div class="card-body">
                    <canvas id="adminChart" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent">
                    <h5 class="fw-bold mb-0"><i class="fas fa-users-cog text-primary me-2"></i>Dernières activités</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @for ($i = 0; $i < 5; $i++)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="badge bg-secondary me-2">{{ ['Connexion', 'Inscription', 'Quiz', 'Formation'][rand(0,3)] }}</span>
                                    <span class="small">{{ fake()->name() }}</span>
                                </div>
                                <span class="text-muted small">{{ fake()->time('H:i') }}</span>
                            </li>
                        @endfor
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Actions rapides --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="fw-bold"><i class="fas fa-bolt text-warning me-2"></i>Actions rapides</h5>
                    <div class="d-flex flex-wrap gap-2 mt-3">
                        <a href="#" class="btn btn-outline-primary"><i class="fas fa-user-plus"></i> Ajouter un utilisateur</a>
                        <a href="#" class="btn btn-outline-success"><i class="fas fa-plus-circle"></i> Créer une formation</a>
                        <a href="#" class="btn btn-outline-info"><i class="fas fa-file-alt"></i> Voir les rapports</a>
                        <a href="#" class="btn btn-outline-warning"><i class="fas fa-cog"></i> Gérer les rôles</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('adminChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['J1', 'J5', 'J10', 'J15', 'J20', 'J25', 'J30'],
                    datasets: [{
                        label: 'Inscriptions',
                        data: [12, 19, 15, 27, 22, 34, 40],
                        borderColor: '#2d7a4f',
                        backgroundColor: 'rgba(45,122,79,0.1)',
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } }
                }
            });
        });
    </script>
@endsection