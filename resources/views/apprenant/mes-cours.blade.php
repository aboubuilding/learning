@extends('layouts.app')

@section('title', 'Mes cours — Espace Apprenant')

@section('page_title', 'Mes cours')
@section('page_icon', 'fa-book-open')

@section('breadcrumb')
    <li><a href="{{ route('home') }}">Accueil</a></li>
    <li class="active">Mes cours</li>
@endsection

@section('page_actions')
    <a href="#" class="btn btn-sm btn-outline-primary rounded-pill">
        <i class="fas fa-search"></i> Rechercher
    </a>
@endsection

@section('contenu')
    {{-- Statistiques rapides --}}
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card gradient-primary">
                <div class="stat-icon"><i class="fas fa-book"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Total</span>
                    <span class="stat-value">{{ $stats['total'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card gradient-success">
                <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Terminés</span>
                    <span class="stat-value">{{ $stats['termines'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card gradient-info">
                <div class="stat-icon"><i class="fas fa-spinner"></i></div>
                <div class="stat-content">
                    <span class="stat-label">En cours</span>
                    <span class="stat-value">{{ $stats['en_cours'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card gradient-warning">
                <div class="stat-icon"><i class="fas fa-clock"></i></div>
                <div class="stat-content">
                    <span class="stat-label">À faire</span>
                    <span class="stat-value">{{ $stats['a_faire'] }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Liste des cours --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-transparent d-flex justify-content-between align-items-center py-3">
            <h5 class="fw-bold mb-0"><i class="fas fa-list-ul me-2 text-primary"></i>Mes formations</h5>
            <span class="badge bg-primary rounded-pill">{{ $stats['en_cours'] }} en cours</span>
        </div>
        <div class="card-body p-0">
            @forelse($mes_cours as $cours)
                <div class="course-item d-flex flex-wrap align-items-center justify-content-between p-3 border-bottom">
                    <div class="course-info flex-grow-1 me-3">
                        <h6 class="mb-0 fw-semibold">{{ $cours['titre'] }}</h6>
                        <span class="text-muted small"><i class="fas fa-user-chalk me-1"></i>{{ $cours['formateur'] }}</span>
                        <span class="text-muted small ms-3"><i class="far fa-calendar-alt me-1"></i>{{ \Carbon\Carbon::parse($cours['date_inscription'])->format('d/m/Y') }}</span>
                    </div>
                    <div class="course-progress d-flex align-items-center gap-3 flex-wrap">
                        <div class="progress" style="width: 120px; height: 6px;">
                            <div class="progress-bar bg-success" style="width: {{ $cours['progression'] }}%; border-radius: 10px;"></div>
                        </div>
                        <span class="fw-bold small">{{ $cours['progression'] }}%</span>
                        @if($cours['statut'] == 'termine')
                            <span class="badge bg-success rounded-pill"><i class="fas fa-check-circle me-1"></i>Terminé</span>
                        @elseif($cours['statut'] == 'en_cours')
                            <a href="{{ route('apprenant.formation.show', $cours['id']) }}" class="btn btn-sm btn-primary rounded-pill px-3">
                                <i class="fas fa-play me-1"></i>Continuer
                            </a>
                        @else
                            <a href="{{ route('apprenant.formation.show', $cours['id']) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                <i class="fas fa-eye me-1"></i>Découvrir
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-5">
                    <i class="fas fa-book-open fa-3x text-muted opacity-50"></i>
                    <p class="text-muted mt-3">Vous n'êtes inscrit à aucune formation pour le moment.</p>
                    <a href="{{ route('home') }}" class="btn btn-primary rounded-pill">Explorer le catalogue</a>
                </div>
            @endforelse
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

    .course-item {
        background: #fff;
        transition: background 0.15s;
    }
    .course-item:hover {
        background: #f8faf9;
    }
    .course-item:last-child {
        border-bottom: none !important;
    }
    .course-info h6 {
        color: #0F3B43;
        font-size: 0.95rem;
    }
    .course-info .text-muted {
        font-size: 0.8rem;
    }
    @media (max-width: 768px) {
        .course-item {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 0.75rem;
        }
        .course-progress {
            width: 100%;
            justify-content: space-between;
        }
        .course-progress .progress {
            flex: 1;
        }
    }
</style>
@endpush