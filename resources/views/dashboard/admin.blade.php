@extends('layouts.app')

@section('title', 'Tableau de bord — Administrateur')

@section('page_title', 'Administration')
@section('page_icon', 'fa-shield-alt')

@section('breadcrumb')
    <li><a href="#">Accueil</a></li>
    <li class="active">Administration</li>
@endsection

@section('page_actions')
    <button class="btn btn-sm btn-outline-refresh" onclick="window.location.reload()">
        <i class="fas fa-sync-alt"></i> Rafraîchir
    </button>
    <a href="#" class="btn btn-sm btn-export">
        <i class="fas fa-file-export"></i> Exporter
    </a>
@endsection

@section('contenu')
    @php
        $usersCount = rand(80, 150);
        $coursesCount = rand(20, 50);
        $completionRate = rand(65, 90);
        $certificatesCount = rand(100, 300);
    @endphp

    {{-- ===== EN-TÊTE ===== --}}
    <div class="admin-banner mb-4">
        <div class="admin-banner-text">
            <span class="admin-eyebrow">{{ \Carbon\Carbon::now()->translatedFormat('l d F Y') }}</span>
            <h4 class="admin-title">Vue d'ensemble de la plateforme</h4>
            <p class="admin-sub mb-0">Activité globale, formations et résultats des apprenants en un coup d'œil.</p>
        </div>
        <div class="admin-banner-actions">
            <span class="live-pill"><span class="dot"></span> Données en direct</span>
        </div>
    </div>

    {{-- ===== STATISTIQUES GLOBALES ===== --}}
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="kpi-card">
                <div class="kpi-icon kpi-icon-teal"><i class="fas fa-users"></i></div>
                <div class="kpi-content">
                    <span class="kpi-label">Utilisateurs</span>
                    <h2 class="kpi-value">{{ $usersCount }}</h2>
                    <span class="kpi-trend trend-up"><i class="fas fa-arrow-up"></i> +12% ce mois</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="kpi-card">
                <div class="kpi-icon kpi-icon-petrol"><i class="fas fa-graduation-cap"></i></div>
                <div class="kpi-content">
                    <span class="kpi-label">Formations</span>
                    <h2 class="kpi-value">{{ $coursesCount }}</h2>
                    <span class="kpi-trend trend-up"><i class="fas fa-arrow-up"></i> +5% ce mois</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="kpi-card">
                <div class="kpi-icon kpi-icon-green"><i class="fas fa-chart-line"></i></div>
                <div class="kpi-content">
                    <span class="kpi-label">Taux de complétion</span>
                    <h2 class="kpi-value">{{ $completionRate }}%</h2>
                    <span class="kpi-trend trend-stable"><i class="fas fa-minus"></i> stable</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="kpi-card">
                <div class="kpi-icon kpi-icon-amber"><i class="fas fa-certificate"></i></div>
                <div class="kpi-content">
                    <span class="kpi-label">Certificats délivrés</span>
                    <h2 class="kpi-value">{{ $certificatesCount }}</h2>
                    <span class="kpi-trend trend-up"><i class="fas fa-arrow-up"></i> +8% ce mois</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== GRAPHIQUE ET ACTIVITÉS ===== --}}
    <div class="row g-4">
        <div class="col-md-7">
            <div class="card content-card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0"><i class="fas fa-chart-bar me-2 text-icon-teal"></i>Évolution des inscriptions</h5>
                    <span class="period-badge">30 derniers jours</span>
                </div>
                <div class="card-body">
                    <canvas id="adminChart" height="220"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card content-card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0"><i class="fas fa-users-cog me-2 text-icon-amber"></i>Dernières activités</h5>
                    <a href="#" class="link-all">Tout voir <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
                <div class="card-body p-0">
                    @php
                        $activityTypes = [
                            'Connexion'   => ['icon' => 'fa-right-to-bracket', 'class' => 'activity-teal'],
                            'Inscription' => ['icon' => 'fa-user-plus',        'class' => 'activity-amber'],
                            'Quiz'        => ['icon' => 'fa-square-poll-vertical', 'class' => 'activity-green'],
                            'Formation'   => ['icon' => 'fa-book-open',        'class' => 'activity-petrol'],
                        ];
                        $typeKeys = array_keys($activityTypes);
                    @endphp
                    @for ($i = 0; $i < 5; $i++)
                        @php
                            $type = $typeKeys[array_rand($typeKeys)];
                            $meta = $activityTypes[$type];
                        @endphp
                        <div class="activity-item">
                            <div class="activity-icon {{ $meta['class'] }}"><i class="fas {{ $meta['icon'] }}"></i></div>
                            <div class="activity-info flex-grow-1">
                                <span class="activity-type">{{ $type }}</span>
                                <span class="activity-name">{{ fake()->name() }}</span>
                            </div>
                            <span class="activity-time">{{ fake()->time('H:i') }}</span>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>

    {{-- ===== ACTIONS RAPIDES ===== --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card content-card">
                <div class="card-body">
                    <h5 class="fw-bold mb-3"><i class="fas fa-bolt me-2 text-icon-amber"></i>Actions rapides</h5>
                    <div class="quick-actions">
                        <a href="#" class="quick-action">
                            <span class="quick-icon qa-teal"><i class="fas fa-user-plus"></i></span>
                            <span class="quick-label">Ajouter un<br>utilisateur</span>
                        </a>
                        <a href="#" class="quick-action">
                            <span class="quick-icon qa-green"><i class="fas fa-plus-circle"></i></span>
                            <span class="quick-label">Créer une<br>formation</span>
                        </a>
                        <a href="#" class="quick-action">
                            <span class="quick-icon qa-petrol"><i class="fas fa-file-alt"></i></span>
                            <span class="quick-label">Voir les<br>rapports</span>
                        </a>
                        <a href="#" class="quick-action">
                            <span class="quick-icon qa-amber"><i class="fas fa-cog"></i></span>
                            <span class="quick-label">Gérer les<br>rôles</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@400;500;600;700;800&family=IBM+Plex+Mono:wght@500&display=swap" rel="stylesheet">

<style>
    :root {
        --petrol: #0F3B43;
        --petrol-dark: #082A2F;
        --teal: #1A7E86;
        --teal-light: #24A1A9;
        --teal-soft: #E6F3F2;
        --amber: #EAA14F;
        --amber-dark: #B47D2A;
        --amber-soft: #FCEFD9;
        --green: #2D9B5E;
        --green-soft: #E6F5EC;
        --ink: #161D1C;
        --ink-soft: #556B67;
        --mist: #DFEAE8;
        --sand: #FAF8F4;
        --radius-md: 14px;
        --radius-lg: 20px;
        --font: 'Kumbh Sans', sans-serif;
        --font-mono: 'IBM Plex Mono', monospace;
    }

    #content, .content-wrapper, .main-content { font-family: var(--font); }
    h2, h4, h5, h6 { font-family: var(--font); }

    /* ===== BOUTONS D'EN-TÊTE ===== */
    .btn-outline-refresh {
        border: 1.5px solid var(--mist); color: var(--ink-soft); background: #fff;
        border-radius: 999px; font-weight: 600; font-size: 0.82rem; padding: 0.45rem 1rem;
        transition: all 0.2s;
    }
    .btn-outline-refresh:hover { border-color: var(--teal); color: var(--teal); }

    .btn-export {
        background: var(--teal); color: #fff; border: none;
        border-radius: 999px; font-weight: 600; font-size: 0.82rem; padding: 0.45rem 1.1rem;
        transition: all 0.2s;
    }
    .btn-export:hover { background: var(--teal-light); color: #fff; transform: translateY(-1px); }

    /* ===== BANNIÈRE ===== */
    .admin-banner {
        background: linear-gradient(135deg, var(--petrol) 0%, var(--petrol-dark) 100%);
        border-radius: var(--radius-lg);
        padding: 1.75rem 2.25rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1.5rem;
        color: #fff;
        position: relative;
        overflow: hidden;
        animation: fadeUp 0.5s ease both;
    }
    .admin-banner::before {
        content: "";
        position: absolute; inset: 0;
        background-image: radial-gradient(rgba(255,255,255,0.06) 1px, transparent 1px);
        background-size: 20px 20px;
        opacity: 0.6;
    }
    .admin-banner-text, .admin-banner-actions { position: relative; z-index: 2; }
    .admin-eyebrow {
        font-family: var(--font-mono); font-size: 0.72rem; text-transform: uppercase;
        letter-spacing: 0.1em; color: var(--amber); font-weight: 500;
    }
    .admin-title { color: #fff; font-weight: 800; font-size: 1.5rem; margin: 0.35rem 0 0.4rem; }
    .admin-sub { color: rgba(255,255,255,0.75); font-size: 0.92rem; }

    .live-pill {
        display: inline-flex; align-items: center; gap: 8px;
        background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15);
        color: rgba(255,255,255,0.9); font-size: 0.78rem; font-weight: 600;
        padding: 0.5rem 1rem; border-radius: 999px;
    }
    .live-pill .dot {
        width: 7px; height: 7px; background: var(--amber); border-radius: 50%;
        box-shadow: 0 0 8px var(--amber); animation: pulse-dot 2s ease-in-out infinite;
    }
    @keyframes pulse-dot { 0%, 100% { opacity: 1; transform: scale(1); } 50% { opacity: 0.5; transform: scale(0.8); } }

    @media (max-width: 768px) {
        .admin-banner { flex-direction: column; text-align: center; padding: 1.5rem; }
    }

    /* ===== KPI CARDS ===== */
    .kpi-card {
        background: #fff;
        border-radius: var(--radius-lg);
        padding: 1.4rem 1.5rem;
        display: flex;
        align-items: center;
        gap: 1.1rem;
        box-shadow: 0 8px 24px rgba(15, 59, 67, 0.06);
        height: 100%;
        transition: transform 0.25s, box-shadow 0.25s;
        animation: fadeUp 0.5s ease both;
    }
    .kpi-card:hover { transform: translateY(-4px); box-shadow: 0 14px 32px rgba(15, 59, 67, 0.12); }

    .kpi-icon {
        width: 54px; height: 54px; flex: none;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.35rem;
    }
    .kpi-icon-teal   { background: var(--teal-soft);  color: var(--teal); }
    .kpi-icon-petrol { background: #E3ECEC; color: var(--petrol); }
    .kpi-icon-green  { background: var(--green-soft); color: var(--green); }
    .kpi-icon-amber  { background: var(--amber-soft); color: var(--amber-dark); }

    .kpi-label { font-size: 0.74rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--ink-soft); display: block; }
    .kpi-value { font-size: 1.85rem; font-weight: 800; color: var(--petrol); margin: 0.15rem 0; line-height: 1.1; }
    .kpi-trend { font-size: 0.78rem; font-weight: 600; display: inline-flex; align-items: center; gap: 4px; }
    .trend-up { color: var(--green); }
    .trend-stable { color: var(--amber-dark); }

    /* ===== CARTES DE CONTENU ===== */
    .content-card {
        border: none;
        border-radius: var(--radius-lg);
        box-shadow: 0 8px 24px rgba(15, 59, 67, 0.06);
        animation: fadeUp 0.6s ease both;
    }
    .content-card .card-header {
        background: transparent;
        border-bottom: 1px solid var(--mist);
        padding: 1.1rem 1.5rem;
    }
    .content-card .card-header h5 { color: var(--petrol); }
    .text-icon-teal { color: var(--teal); }
    .text-icon-amber { color: var(--amber-dark); }

    .period-badge {
        font-family: var(--font-mono); font-size: 0.72rem; text-transform: uppercase;
        letter-spacing: 0.05em; color: var(--ink-soft); background: var(--sand);
        padding: 0.35rem 0.75rem; border-radius: 999px;
    }

    .link-all { font-size: 0.83rem; font-weight: 600; color: var(--teal); }
    .link-all:hover { color: var(--teal-light); }

    /* ===== ACTIVITÉS ===== */
    .activity-item {
        display: flex; align-items: center; gap: 1rem;
        padding: 0.9rem 1.5rem;
        border-bottom: 1px solid var(--mist);
        transition: background 0.15s;
    }
    .activity-item:last-child { border-bottom: none; }
    .activity-item:hover { background: var(--sand); }

    .activity-icon {
        width: 38px; height: 38px; flex: none;
        border-radius: 11px;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.9rem;
    }
    .activity-teal   { background: var(--teal-soft); color: var(--teal); }
    .activity-amber  { background: var(--amber-soft); color: var(--amber-dark); }
    .activity-green  { background: var(--green-soft); color: var(--green); }
    .activity-petrol { background: #E3ECEC; color: var(--petrol); }

    .activity-type { font-family: var(--font-mono); font-size: 0.68rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--ink-soft); display: block; }
    .activity-name { font-size: 0.9rem; font-weight: 600; color: var(--petrol); }
    .activity-time { font-size: 0.8rem; color: var(--ink-soft); white-space: nowrap; }

    /* ===== ACTIONS RAPIDES ===== */
    .quick-actions { display: flex; flex-wrap: wrap; gap: 1rem; }
    .quick-action {
        flex: 1 1 180px;
        display: flex; flex-direction: column; align-items: center; text-align: center;
        gap: 0.7rem;
        padding: 1.3rem 1rem;
        border: 1.5px solid var(--mist);
        border-radius: var(--radius-md);
        color: var(--petrol);
        transition: all 0.2s;
    }
    .quick-action:hover { border-color: var(--teal); background: var(--teal-soft); transform: translateY(-3px); color: var(--petrol); }

    .quick-icon {
        width: 48px; height: 48px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.15rem;
        color: #fff;
    }
    .qa-teal   { background: var(--teal); }
    .qa-green  { background: var(--green); }
    .qa-petrol { background: var(--petrol); }
    .qa-amber  { background: var(--amber); }

    .quick-label { font-size: 0.85rem; font-weight: 600; line-height: 1.3; }

    @keyframes fadeUp { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }

    @media (max-width: 576px) {
        .kpi-value { font-size: 1.5rem; }
        .admin-title { font-size: 1.25rem; }
        .quick-action { flex: 1 1 45%; }
    }
</style>
@endpush

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('adminChart').getContext('2d');

            const gradient = ctx.createLinearGradient(0, 0, 0, 220);
            gradient.addColorStop(0, 'rgba(26, 126, 134, 0.28)');
            gradient.addColorStop(1, 'rgba(26, 126, 134, 0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['J1', 'J5', 'J10', 'J15', 'J20', 'J25', 'J30'],
                    datasets: [{
                        label: 'Inscriptions',
                        data: [12, 19, 15, 27, 22, 34, 40],
                        borderColor: '#1A7E86',
                        backgroundColor: gradient,
                        pointBackgroundColor: '#EAA14F',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7,
                        borderWidth: 3,
                        tension: 0.35,
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
                            titleFont: { family: 'Kumbh Sans' },
                            bodyFont: { family: 'Kumbh Sans' },
                            padding: 10,
                            cornerRadius: 8
                        }
                    },
                    scales: {
                        x: { grid: { display: false }, ticks: { font: { family: 'Kumbh Sans', size: 11 }, color: '#556B67' } },
                        y: { grid: { color: '#DFEAE8' }, ticks: { font: { family: 'Kumbh Sans', size: 11 }, color: '#556B67' } }
                    }
                }
            });
        });
    </script>
@endsection