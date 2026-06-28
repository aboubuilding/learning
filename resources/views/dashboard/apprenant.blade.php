@extends('layouts.app')

@section('title', 'Mon espace — Apprenant')

@section('page_title', 'Mes cours')
@section('page_icon', 'fa-user-graduate')

@section('breadcrumb')
    <li><a href="{{ route('home') }}">Accueil</a></li>
    <li class="active">Mes cours</li>
@endsection

@section('page_actions')
    <a href="#" class="btn btn-sm btn-outline-primary">
        <i class="fas fa-search"></i> Rechercher
    </a>
@endsection

@section('contenu')
    @php
        // Données calculées une seule fois pour rester cohérentes entre le texte et les barres
        $completion = rand(50, 90);
        $coursesInProgress = rand(2, 6);
        $coursesTotal = rand($coursesInProgress + 3, 15);
        $certificatesCount = rand(1, 5);
        $lastCertificateDate = \Carbon\Carbon::now()->subDays(rand(1, 30))->format('d/m/Y');
        $userName = auth()->user()->prenom ?? auth()->user()->name ?? 'Apprenant';
    @endphp

    {{-- ===== EN-TÊTE DE BIENVENUE ===== --}}
    <div class="welcome-banner mb-4">
        <div class="welcome-text">
            <span class="welcome-eyebrow">{{ \Carbon\Carbon::now()->translatedFormat('l d F Y') }}</span>
            <h4 class="welcome-title">Bonjour {{ $userName }} <span class="wave-emoji">👋</span></h4>
            <p class="welcome-sub mb-0">Voici un aperçu de votre progression et de vos prochaines étapes.</p>
        </div>
        <div class="welcome-gauge" aria-hidden="true">
            <svg viewBox="0 0 120 120">
                <circle cx="60" cy="60" r="48" fill="none" stroke="rgba(255,255,255,0.15)" stroke-width="10"/>
                <circle cx="60" cy="60" r="48" fill="none" stroke="#EAA14F" stroke-width="10" stroke-linecap="round"
                        stroke-dasharray="{{ 2 * 3.1416 * 48 }}"
                        stroke-dashoffset="{{ (2 * 3.1416 * 48) * (1 - $completion / 100) }}"
                        transform="rotate(-90 60 60)"/>
                <text x="60" y="56" text-anchor="middle" fill="#fff" font-size="24" font-weight="800" font-family="Kumbh Sans, sans-serif">{{ $completion }}%</text>
                <text x="60" y="74" text-anchor="middle" fill="rgba(255,255,255,0.7)" font-size="9" letter-spacing="1" font-family="IBM Plex Mono, monospace">GLOBAL</text>
            </svg>
        </div>
    </div>

    {{-- ===== STATISTIQUES GLOBALES ===== --}}
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="stat-card gradient-primary">
                <div class="stat-icon"><i class="fas fa-chart-pie"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Taux de complétion</span>
                    <span class="stat-value">{{ $completion }}%</span>
                    <div class="progress mt-2">
                        <div class="progress-bar" style="width: {{ $completion }}%;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card gradient-success">
                <div class="stat-icon"><i class="fas fa-book-open"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Cours en cours</span>
                    <span class="stat-value">{{ $coursesInProgress }}</span>
                    <span class="stat-sub">sur {{ $coursesTotal }} au total</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card gradient-warning">
                <div class="stat-icon"><i class="fas fa-certificate"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Certificats obtenus</span>
                    <span class="stat-value">{{ $certificatesCount }}</span>
                    <span class="stat-sub">dernier : {{ $lastCertificateDate }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== MES FORMATIONS ===== --}}
    <div class="card content-card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0"><i class="fas fa-book me-2 text-icon"></i>Mes formations</h5>
            <span class="badge badge-soft-primary rounded-pill">{{ $coursesInProgress }} en cours</span>
        </div>
        <div class="card-body p-0">
            @for ($i = 0; $i < 4; $i++)
                @php
                    $progress = rand(20, 100);
                    $completed = $progress == 100;
                    $formateur = fake()->name();
                    $titre = fake()->sentence(4);
                    $themes = ['Produits chimiques', 'Réglementation', 'Sécurité', 'Recouvrement des coûts'];
                    $theme = $themes[$i % count($themes)];
                @endphp
                <div class="course-item">
                    <div class="course-thumb">
                        <i class="fas {{ ['fa-flask','fa-file-contract','fa-shield-halved','fa-coins'][$i % 4] }}"></i>
                    </div>
                    <div class="course-info flex-grow-1">
                        <span class="course-theme">{{ $theme }}</span>
                        <h6 class="mb-0">{{ $titre }}</h6>
                        <span class="course-trainer"><i class="fas fa-chalkboard-teacher me-1"></i>{{ $formateur }}</span>
                    </div>
                    <div class="course-progress">
                        <div class="progress">
                            <div class="progress-bar {{ $completed ? 'bar-success' : 'bar-teal' }}" style="width: {{ $progress }}%;"></div>
                        </div>
                        <span class="progress-pct">{{ $progress }}%</span>
                        @if ($completed)
                            <span class="badge badge-soft-success rounded-pill"><i class="fas fa-check-circle me-1"></i>Terminé</span>
                        @else
                            <a href="#" class="btn btn-continue">
                                <i class="fas fa-play"></i> Continuer
                            </a>
                        @endif
                    </div>
                </div>
            @endfor
        </div>
    </div>

    {{-- ===== DERNIERS QUIZ ===== --}}
    <div class="card content-card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0"><i class="fas fa-question-circle me-2 text-icon-amber"></i>Derniers quiz</h5>
            <a href="#" class="link-all">Voir tout <i class="fas fa-arrow-right ms-1"></i></a>
        </div>
        <div class="card-body p-0">
            @for ($i = 0; $i < 3; $i++)
                @php
                    $score = rand(40, 95);
                    $reussi = $score >= 60;
                @endphp
                <div class="quiz-item">
                    <div class="quiz-icon"><i class="fas fa-file-circle-question"></i></div>
                    <div class="quiz-info flex-grow-1">
                        <h6 class="mb-0">{{ Str::ucfirst(fake()->sentence(3)) }}</h6>
                        <span class="quiz-date"><i class="fas fa-clock me-1"></i>il y a {{ rand(1, 12) }} jours</span>
                    </div>
                    <div class="quiz-score">
                        <span class="score-num {{ $reussi ? 'score-good' : 'score-bad' }}">{{ $score }}%</span>
                    </div>
                    @if ($reussi)
                        <span class="badge badge-soft-success rounded-pill"><i class="fas fa-check me-1"></i>Réussi</span>
                    @else
                        <span class="badge badge-soft-warning rounded-pill"><i class="fas fa-rotate-right me-1"></i>À repasser</span>
                    @endif
                    <a href="#" class="btn btn-quiz-view">Voir</a>
                </div>
            @endfor
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
        --red: #D9534F;
        --red-soft: #FBEAEA;
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

    h4, h5, h6, .stat-value, .welcome-title { font-family: var(--font); }

    /* ===== EN-TÊTE DE BIENVENUE ===== */
    .welcome-banner {
        background: linear-gradient(135deg, var(--petrol) 0%, var(--petrol-dark) 100%);
        border-radius: var(--radius-lg);
        padding: 2rem 2.25rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1.5rem;
        color: #fff;
        position: relative;
        overflow: hidden;
        animation: fadeUp 0.5s ease both;
    }
    .welcome-banner::before {
        content: "";
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(255,255,255,0.06) 1px, transparent 1px);
        background-size: 20px 20px;
        opacity: 0.6;
    }
    .welcome-text { position: relative; z-index: 2; }
    .welcome-eyebrow {
        font-family: var(--font-mono);
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--amber);
        font-weight: 500;
    }
    .welcome-title { color: #fff; font-weight: 800; font-size: 1.6rem; margin: 0.35rem 0 0.4rem; }
    .wave-emoji { display: inline-block; animation: wave 2.2s infinite; transform-origin: 70% 70%; }
    @keyframes wave { 0%, 60%, 100% { transform: rotate(0); } 10% { transform: rotate(14deg); } 20% { transform: rotate(-8deg); } 30% { transform: rotate(14deg); } 40% { transform: rotate(-4deg); } }
    .welcome-sub { color: rgba(255,255,255,0.75); font-size: 0.92rem; }
    .welcome-gauge { position: relative; z-index: 2; width: 96px; height: 96px; flex: none; }
    .welcome-gauge svg { width: 100%; height: 100%; }

    @media (max-width: 768px) {
        .welcome-banner { flex-direction: column; text-align: center; padding: 1.75rem; }
    }

    /* ===== STATS CARDS ===== */
    .stat-card {
        position: relative;
        padding: 1.5rem;
        border-radius: var(--radius-lg);
        color: #fff;
        display: flex;
        align-items: center;
        gap: 1.25rem;
        box-shadow: 0 10px 28px rgba(15, 59, 67, 0.1);
        transition: transform 0.25s, box-shadow 0.25s;
        overflow: hidden;
        height: 100%;
        min-height: 124px;
        animation: fadeUp 0.5s ease both;
    }
    .stat-card:hover { transform: translateY(-4px); box-shadow: 0 16px 36px rgba(15, 59, 67, 0.16); }

    .stat-card .stat-icon {
        font-size: 1.6rem;
        width: 56px;
        height: 56px;
        background: rgba(255,255,255,0.18);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .stat-card .stat-content { flex: 1; }
    .stat-card .stat-label {
        font-size: 0.76rem; font-weight: 600; text-transform: uppercase;
        letter-spacing: 0.05em; opacity: 0.85; display: block; margin-bottom: 0.25rem;
    }
    .stat-card .stat-value { font-size: 1.9rem; font-weight: 800; display: block; line-height: 1.15; }
    .stat-card .stat-sub { font-size: 0.8rem; opacity: 0.85; display: block; margin-top: 0.25rem; }

    .stat-card .progress { height: 6px; background: rgba(255,255,255,0.2); border-radius: 10px; overflow: hidden; }
    .stat-card .progress-bar { background: #fff; border-radius: 10px; transition: width 0.6s ease; }

    .gradient-primary { background: linear-gradient(135deg, var(--petrol) 0%, var(--teal) 100%); }
    .gradient-success { background: linear-gradient(135deg, #1A6E40 0%, var(--green) 100%); }
    .gradient-warning { background: linear-gradient(135deg, var(--amber-dark) 0%, var(--amber) 100%); }

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
    .content-card .card-header h5 { color: var(--petrol); font-weight: 700; }
    .text-icon { color: var(--teal); }
    .text-icon-amber { color: var(--amber-dark); }

    .badge-soft-primary { background: var(--teal-soft); color: var(--teal); }
    .badge-soft-success { background: var(--green-soft); color: var(--green); }
    .badge-soft-warning { background: var(--amber-soft); color: var(--amber-dark); }
    .badge { font-weight: 600; font-size: 0.72rem; padding: 0.4rem 0.8rem; }

    .link-all { font-size: 0.85rem; font-weight: 600; color: var(--teal); }
    .link-all:hover { color: var(--teal-light); }

    /* ===== LISTE DES FORMATIONS ===== */
    .course-item {
        display: flex;
        align-items: center;
        gap: 1.1rem;
        padding: 1.1rem 1.5rem;
        border-bottom: 1px solid var(--mist);
        transition: background 0.15s;
    }
    .course-item:last-child { border-bottom: none; }
    .course-item:hover { background: var(--sand); }

    .course-thumb {
        width: 46px; height: 46px; flex: none;
        border-radius: 12px;
        background: var(--teal-soft);
        color: var(--teal);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.05rem;
    }

    .course-theme {
        font-family: var(--font-mono);
        font-size: 0.68rem;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: var(--teal);
        font-weight: 500;
        display: block;
        margin-bottom: 0.15rem;
    }
    .course-info h6 { color: var(--petrol); font-size: 0.96rem; font-weight: 700; }
    .course-trainer { font-size: 0.8rem; color: var(--ink-soft); }

    .course-progress {
        display: flex; align-items: center; gap: 0.9rem; flex-wrap: wrap;
        justify-content: flex-end;
    }
    .course-progress .progress { width: 110px; height: 6px; background: var(--mist); border-radius: 10px; overflow: hidden; }
    .course-progress .progress-bar { border-radius: 10px; transition: width 0.6s ease; }
    .bar-teal { background: linear-gradient(90deg, var(--teal), var(--teal-light)); }
    .bar-success { background: linear-gradient(90deg, #1A6E40, var(--green)); }
    .progress-pct { font-size: 0.82rem; font-weight: 700; color: var(--petrol); width: 38px; }

    .btn-continue {
        display: inline-flex; align-items: center; gap: 6px;
        background: var(--teal); color: #fff;
        font-size: 0.8rem; font-weight: 600;
        padding: 0.45rem 0.95rem;
        border-radius: 999px;
        transition: all 0.2s;
    }
    .btn-continue:hover { background: var(--teal-light); color: #fff; transform: translateY(-1px); }

    /* ===== LISTE DES QUIZ ===== */
    .quiz-item {
        display: flex;
        align-items: center;
        gap: 1.1rem;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid var(--mist);
        transition: background 0.15s;
    }
    .quiz-item:last-child { border-bottom: none; }
    .quiz-item:hover { background: var(--sand); }

    .quiz-icon {
        width: 42px; height: 42px; flex: none;
        border-radius: 12px;
        background: var(--amber-soft);
        color: var(--amber-dark);
        display: flex; align-items: center; justify-content: center;
        font-size: 1rem;
    }
    .quiz-info h6 { color: var(--petrol); font-size: 0.92rem; font-weight: 700; }
    .quiz-date { font-size: 0.78rem; color: var(--ink-soft); }

    .quiz-score { width: 56px; text-align: center; }
    .score-num { font-family: var(--font-mono); font-weight: 700; font-size: 1rem; }
    .score-good { color: var(--green); }
    .score-bad { color: var(--amber-dark); }

    .btn-quiz-view {
        font-size: 0.8rem; font-weight: 600;
        color: var(--teal);
        border: 1.5px solid var(--mist);
        padding: 0.4rem 0.9rem;
        border-radius: 999px;
        transition: all 0.2s;
    }
    .btn-quiz-view:hover { border-color: var(--teal); background: var(--teal-soft); }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(12px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .stat-card { flex-direction: column; text-align: center; padding: 1.25rem; }
        .stat-card .stat-icon { margin-bottom: 0.4rem; }
        .course-item { flex-wrap: wrap; }
        .course-progress { width: 100%; justify-content: space-between; margin-top: 0.5rem; }
        .course-progress .progress { flex: 1; width: auto; }
        .quiz-item { flex-wrap: wrap; row-gap: 0.6rem; }
        .quiz-score { width: auto; }
    }

    @media (max-width: 576px) {
        .stat-card .stat-value { font-size: 1.5rem; }
        .welcome-title { font-size: 1.3rem; }
    }
</style>
@endpush