@extends('layouts.app')

@section('title', 'Détail du certificat — AquaForm')

@section('page_title', 'Détail du certificat')
@section('page_icon', 'fa-certificate')

@section('breadcrumb')
    <li><a href="{{ route('home') }}">Accueil</a></li>
    <li><a href="{{ route('apprenant.certificats.index') }}">Certificats</a></li>
    <li class="active">Détail</li>
@endsection

@section('page_actions')
    <a href="{{ route('apprenant.certificats.download', $certificat['id']) }}" class="btn btn-sm btn-success rounded-pill">
        <i class="fas fa-download me-1"></i> Télécharger
    </a>
    <a href="{{ route('apprenant.certificats.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
        <i class="fas fa-arrow-left me-1"></i> Retour
    </a>
@endsection

@section('contenu')
    <div class="row g-4">
        {{-- Certificat --}}
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="certificate-preview text-center p-5 border rounded-4" style="background: linear-gradient(135deg, #f8faf9 0%, #e8f0ee 100%);">
                        <div class="certificate-icon mb-3">
                            <i class="fas fa-certificate text-success" style="font-size: 4rem;"></i>
                        </div>
                        <h2 class="fw-bold text-primary">Certificat de complétion</h2>
                        <p class="text-muted">Ce certificat atteste que</p>
                        <h3 class="fw-bold">{{ $certificat['apprenant'] }}</h3>
                        <p class="text-muted">a suivi avec succès la formation</p>
                        <h4 class="fw-bold">{{ $certificat['titre'] }}</h4>
                        <p class="text-muted">d'une durée de {{ $certificat['duree_formation'] }}</p>
                        <hr class="my-3" style="max-width: 200px; margin-left: auto; margin-right: auto;">
                        <div class="row justify-content-center">
                            <div class="col-6">
                                <span class="text-muted small">Numéro</span>
                                <div class="fw-bold">{{ $certificat['numero'] }}</div>
                            </div>
                            <div class="col-6">
                                <span class="text-muted small">Score</span>
                                <div class="fw-bold text-success">{{ $certificat['score'] }}%</div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="text-muted small">Délivré le</span>
                            <div class="fw-bold">{{ \Carbon\Carbon::parse($certificat['date_delivrance'])->format('d/m/Y') }}</div>
                        </div>
                        <div class="mt-4 pt-3 border-top">
                            <span class="text-muted small">Formateur</span>
                            <div>{{ $certificat['formateur'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Informations supplémentaires --}}
        <div class="col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="fw-bold mb-3"><i class="fas fa-info-circle me-2 text-primary"></i>Informations</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <span class="text-muted small">Formation</span>
                            <div class="fw-semibold">{{ $certificat['titre'] }}</div>
                        </li>
                        <li class="mb-2">
                            <span class="text-muted small">Apprenant</span>
                            <div class="fw-semibold">{{ $certificat['apprenant'] }}</div>
                        </li>
                        <li class="mb-2">
                            <span class="text-muted small">Email</span>
                            <div class="fw-semibold">{{ $certificat['email'] }}</div>
                        </li>
                        <li class="mb-2">
                            <span class="text-muted small">Date de complétion</span>
                            <div class="fw-semibold">{{ \Carbon\Carbon::parse($certificat['date_completion'])->format('d/m/Y') }}</div>
                        </li>
                        <li class="mb-2">
                            <span class="text-muted small">Score</span>
                            <div class="fw-semibold text-success">{{ $certificat['score'] }}%</div>
                        </li>
                        <li class="mb-2">
                            <span class="text-muted small">Numéro</span>
                            <div class="fw-semibold">{{ $certificat['numero'] }}</div>
                        </li>
                    </ul>

                    <hr>

                    <div class="d-grid gap-2">
                        <a href="{{ route('apprenant.certificats.download', $certificat['id']) }}" class="btn btn-success">
                            <i class="fas fa-download me-1"></i> Télécharger PDF
                        </a>
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#shareModal">
                            <i class="fas fa-share-alt me-1"></i> Partager
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal de partage --}}
    <div class="modal fade" id="shareModal" tabindex="-1" aria-hidden="true">
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
@endsection

@push('css')
<style>
    .certificate-preview {
        border: 2px solid rgba(26, 126, 134, 0.15);
        background: linear-gradient(135deg, #f8faf9 0%, #e8f0ee 100%);
    }
    .certificate-icon {
        color: #1A7E86;
    }
</style>
@endpush