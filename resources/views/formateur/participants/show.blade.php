@extends('layouts.app')

@section('title', 'Détail du participant — AquaForm')

@section('page_title', 'Détail du participant')
@section('page_icon', 'fa-user-circle')

@section('breadcrumb')
    <li><a href="{{ route('home') }}">Accueil</a></li>
    <li><a href="{{ route('formateur.dashboard') }}">Tableau de bord</a></li>
    <li><a href="{{ route('formateur.participants.index') }}">Participants</a></li>
    <li class="active">{{ $participant['nom'] }}</li>
@endsection

@section('page_actions')
    <a href="{{ route('formateur.participants.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
        <i class="fas fa-arrow-left me-1"></i> Retour à la liste
    </a>
    <a href="#" class="btn btn-sm btn-outline-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#statutModal">
        <i class="fas fa-edit me-1"></i> Modifier statut
    </a>
    <form action="{{ route('formateur.participants.destroy', $participant['id']) }}" method="POST" class="d-inline delete-form">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill" onclick="return confirm('Désinscrire définitivement ce participant ?')">
            <i class="fas fa-user-minus me-1"></i> Désinscrire
        </button>
    </form>
@endsection

@section('contenu')
    <div class="row g-4">
        <div class="col-lg-4">
            {{-- Infos --}}
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="avatar-circle mx-auto mb-3" style="width: 80px; height: 80px; background: var(--aq-secondary); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: 700;">
                        {{ strtoupper(substr($participant['nom'], 0, 1)) }}
                    </div>
                    <h5 class="fw-bold">{{ $participant['nom'] }}</h5>
                    <p class="text-muted">{{ $participant['email'] }}</p>
                    <div class="d-flex justify-content-center gap-2">
                        <span class="badge {{ $participant['statut'] == 'active' ? 'bg-success' : ($participant['statut'] == 'en_attente' ? 'bg-warning' : 'bg-danger') }}">
                            {{ ucfirst(str_replace('_', ' ', $participant['statut'])) }}
                        </span>
                        <span class="badge bg-secondary">Inscrit le {{ \Carbon\Carbon::parse($participant['date_inscription'])->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>

            {{-- Progression --}}
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-body text-center">
                    <i class="fas fa-chart-line fa-2x text-primary opacity-50"></i>
                    <h2 class="fw-bold mt-2">{{ $participant['progression'] }}%</h2>
                    <span class="text-muted">Progression globale</span>
                    <div class="progress mt-2" style="height: 8px;">
                        <div class="progress-bar bg-success" style="width: {{ $participant['progression'] }}%;"></div>
                    </div>
                    <p class="text-muted small mt-2">Temps passé : {{ $participant['temps_total'] }}</p>
                </div>
            </div>

            {{-- Certificat --}}
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-body text-center">
                    @if($participant['certificat'])
                        <i class="fas fa-certificate fa-3x text-success"></i>
                        <h6 class="fw-bold mt-2">Certificat obtenu</h6>
                        <a href="#" class="btn btn-sm btn-success rounded-pill mt-2">
                            <i class="fas fa-download me-1"></i> Télécharger
                        </a>
                    @else
                        <i class="fas fa-certificate fa-3x text-muted opacity-50"></i>
                        <h6 class="fw-bold mt-2 text-muted">Certificat non disponible</h6>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            {{-- Modules --}}
            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent py-3">
                    <h5 class="fw-bold mb-0"><i class="fas fa-cubes me-2 text-primary"></i>Modules suivis</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @foreach($participant['modules'] as $module)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ $module['titre'] }}</span>
                                <span class="badge {{ $module['termine'] ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $module['termine'] ? '✅ Terminé' : 'En cours' }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- Quiz --}}
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-header bg-transparent py-3">
                    <h5 class="fw-bold mb-0"><i class="fas fa-question-circle me-2 text-warning"></i>Quiz tentés</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @foreach($participant['quiz'] as $quiz)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ $quiz['titre'] }}</span>
                                <div class="d-flex align-items-center gap-2">
                                    @if($quiz['score'] !== null)
                                        <span class="fw-bold">{{ $quiz['score'] }}%</span>
                                        <span class="badge {{ $quiz['reussi'] ? 'bg-success' : 'bg-danger' }}">
                                            {{ $quiz['reussi'] ? 'Réussi' : 'Échec' }}
                                        </span>
                                    @else
                                        <span class="text-muted">Non tenté</span>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- MODALE STATUT --}}
    <div class="modal fade" id="statutModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('formateur.participants.updateStatut', $participant['id']) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Modifier le statut</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>{{ $participant['nom'] }}</strong></p>
                        <div class="mb-3">
                            <label class="form-label">Nouveau statut</label>
                            <select name="statut" class="form-select">
                                <option value="en_attente" {{ $participant['statut'] == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                <option value="active" {{ $participant['statut'] == 'active' ? 'selected' : '' }}>Actif</option>
                                <option value="terminee" {{ $participant['statut'] == 'terminee' ? 'selected' : '' }}>Terminé</option>
                                <option value="annulee" {{ $participant['statut'] == 'annulee' ? 'selected' : '' }}>Annulé</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary rounded-pill">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Confirmation suppression
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Désinscrire définitivement ce participant de la formation ?')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endpush