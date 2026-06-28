@extends('layouts.app')

@section('title', 'Mes certificats — AquaForm')

@section('page_title', 'Mes certificats')
@section('page_icon', 'fa-certificate')

@section('breadcrumb')
    <li><a href="{{ route('home') }}">Accueil</a></li>
    <li class="active">Certificats</li>
@endsection

@section('contenu')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    {{-- ===== STATISTIQUES ===== --}}
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="stat-card gradient-primary">
                <div class="stat-icon"><i class="fas fa-certificate"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Certificats obtenus</span>
                    <span class="stat-value">{{ $stats['total'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card gradient-success">
                <div class="stat-icon"><i class="fas fa-star"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Score moyen</span>
                    <span class="stat-value">{{ $stats['moyenne_score'] }}%</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card gradient-warning">
                <div class="stat-icon"><i class="fas fa-clock"></i></div>
                <div class="stat-content">
                    <span class="stat-label">Dernier certificat</span>
                    <span class="stat-value" style="font-size: 1.2rem;">
                        {{ $stats['dernier'] ? \Carbon\Carbon::parse($stats['dernier']['date_delivrance'])->format('d/m/Y') : 'Aucun' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== LISTE DES CERTIFICATS ===== --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-transparent d-flex justify-content-between align-items-center py-3">
            <h5 class="fw-bold mb-0"><i class="fas fa-list-ul me-2 text-primary"></i>Certificats obtenus</h5>
            <span class="text-muted small">{{ $stats['total'] }} certificat(s)</span>
        </div>
        <div class="card-body p-0">
            @forelse($certificats as $certificat)
                <div class="d-flex flex-wrap align-items-center justify-content-between p-3 border-bottom">
                    <div class="flex-grow-1 me-3" style="min-width: 150px;">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-certificate text-success fs-4"></i>
                            <div>
                                <h6 class="mb-0 fw-semibold">{{ $certificat['titre'] }}</h6>
                                <span class="text-muted small">
                                    <i class="fas fa-user-chalk me-1"></i>{{ $certificat['formateur'] }}
                                    <span class="mx-1">·</span>
                                    <i class="fas fa-hashtag me-1"></i>{{ $certificat['numero'] }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <span class="text-muted small">
                            <i class="fas fa-calendar-alt me-1"></i>
                            {{ \Carbon\Carbon::parse($certificat['date_delivrance'])->format('d/m/Y') }}
                        </span>
                        <span class="badge bg-success rounded-pill">
                            <i class="fas fa-star me-1"></i>{{ $certificat['score'] }}%
                        </span>
                        <div class="btn-group btn-group-sm" role="group">
                            <a href="{{ route('apprenant.certificats.show', $certificat['id']) }}" class="btn btn-outline-primary" title="Voir">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('apprenant.certificats.download', $certificat['id']) }}" class="btn btn-outline-success" title="Télécharger">
                                <i class="fas fa-download"></i>
                            </a>
                            <button type="button" class="btn btn-outline-info" title="Partager" data-bs-toggle="modal" data-bs-target="#shareModal{{ $certificat['id'] }}">
                                <i class="fas fa-share-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Modal de partage --}}
                <div class="modal fade" id="shareModal{{ $certificat['id'] }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Partager le certificat</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                            </div>
                            <form action="{{ route('apprenant.certificats.share', $certificat['id']) }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <p>Envoyer le certificat <strong>{{ $certificat['titre'] }}</strong> par email.</p>
                                    <div class="mb-3">
                                        <label class="form-label">Adresse email du destinataire</label>
                                        <input type="email" name="email" class="form-control" placeholder="destinataire@exemple.com" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Message (optionnel)</label>
                                        <textarea name="message" class="form-control" rows="3" placeholder="Votre message..."></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-paper-plane me-1"></i> Envoyer
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5">
                    <i class="fas fa-certificate fa-4x text-muted opacity-25 mb-3"></i>
                    <h5 class="text-muted">Aucun certificat pour le moment</h5>
                    <p class="text-muted small">Terminez vos formations pour obtenir des certificats.</p>
                    <a href="{{ route('apprenant.dashboard') }}" class="btn btn-primary rounded-pill mt-2">
                        <i class="fas fa-play me-1"></i> Voir mes formations
                    </a>
                </div>
            @endforelse
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
    .gradient-primary { background: linear-gradient(135deg, #0F3B43 0%, #1A7E86 100%); }
    .gradient-success { background: linear-gradient(135deg, #1A6E40 0%, #2D9B5E 100%); }
    .gradient-warning { background: linear-gradient(135deg, #B47D2A 0%, #EAA14F 100%); }
</style>
@endpush