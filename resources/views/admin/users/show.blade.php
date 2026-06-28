@extends('layouts.app')

@section('title', 'Détail de l\'utilisateur — Administration')

@section('page_title', 'Détail de l\'utilisateur')
@section('page_icon', 'fa-user-circle')

@section('breadcrumb')
    <li><a href="{{ route('admin.users.index') }}">Utilisateurs</a></li>
    <li class="active">Détail</li>
@endsection

@section('page_actions')
    <a href="{{ route('admin.users.edit', $user['id']) }}" class="btn btn-sm btn-primary rounded-pill">
        <i class="fas fa-edit"></i> Modifier
    </a>
    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
        <i class="fas fa-arrow-left"></i> Retour
    </a>
@endsection

@section('contenu')
    {{-- Info utilisateur --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-2 text-center">
                    <div class="avatar-circle" style="width: 100px; height: 100px; background: var(--aq-secondary); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; font-weight: 700; margin: 0 auto;">
                        {{ strtoupper(substr($user['prenom'], 0, 1) . substr($user['nom'], 0, 1)) }}
                    </div>
                    <span class="badge {{ $user['role'] == 'Administrateur' ? 'bg-danger' : ($user['role'] == 'Formateur' ? 'bg-info' : 'bg-primary') }} mt-2">{{ $user['role'] }}</span>
                </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="fw-bold text-muted small">Nom complet</div>
                            <div class="fs-5">{{ $user['prenom'] }} {{ $user['nom'] }}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="fw-bold text-muted small">Email</div>
                            <div>{{ $user['email'] }}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="fw-bold text-muted small">Téléphone</div>
                            <div>{{ $user['telephone'] ?? 'Non renseigné' }}</div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <div class="fw-bold text-muted small">Statut</div>
                            <span class="badge {{ $user['statut'] == 'Actif' ? 'bg-success' : 'bg-secondary' }}">{{ $user['statut'] }}</span>
                        </div>
                        <div class="col-md-4 mt-3">
                            <div class="fw-bold text-muted small">Inscrit le</div>
                            <div>{{ \Carbon\Carbon::parse($user['inscrit_le'])->format('d/m/Y') }}</div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <div class="fw-bold text-muted small">Dernière activité</div>
                            <div>{{ $user['activites_recentes'][0]['date'] ?? 'Aucune' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Activités de l'utilisateur --}}
    <div class="row g-4">
        {{-- Formations suivies --}}
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-transparent">
                    <h6 class="fw-bold mb-0"><i class="fas fa-book-open me-2 text-primary"></i>Formations suivies</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse($user['formations_suivies'] as $formation)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="fw-semibold">{{ $formation['titre'] }}</span>
                                    <span class="text-muted small d-block">Inscrit le {{ \Carbon\Carbon::parse($formation['date_inscription'])->format('d/m/Y') }}</span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="progress" style="width: 80px; height: 6px;">
                                        <div class="progress-bar bg-success" style="width: {{ $formation['progression'] }}%;"></div>
                                    </div>
                                    <span class="small fw-bold">{{ $formation['progression'] }}%</span>
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item text-muted text-center">Aucune formation suivie.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        {{-- Quiz tentés --}}
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-transparent">
                    <h6 class="fw-bold mb-0"><i class="fas fa-question-circle me-2 text-warning"></i>Quiz tentés</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse($user['quiz_tentatives'] as $quiz)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="fw-semibold">{{ $quiz['titre'] }}</span>
                                    <span class="text-muted small d-block">{{ \Carbon\Carbon::parse($quiz['date'])->format('d/m/Y') }}</span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="fw-bold">{{ $quiz['score'] }}%</span>
                                    <span class="badge {{ $quiz['reussi'] ? 'bg-success' : 'bg-warning' }}">
                                        {{ $quiz['reussi'] ? 'Réussi' : 'Échec' }}
                                    </span>
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item text-muted text-center">Aucun quiz tenté.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        {{-- Certificats obtenus --}}
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-transparent">
                    <h6 class="fw-bold mb-0"><i class="fas fa-certificate me-2 text-success"></i>Certificats obtenus</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse($user['certificats'] as $certificat)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="fw-semibold">{{ $certificat['titre'] }}</span>
                                <span class="text-muted small">Délivré le {{ \Carbon\Carbon::parse($certificat['date'])->format('d/m/Y') }}</span>
                            </li>
                        @empty
                            <li class="list-group-item text-muted text-center">Aucun certificat obtenu.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        {{-- Dernières activités (journal) --}}
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-transparent">
                    <h6 class="fw-bold mb-0"><i class="fas fa-history me-2 text-info"></i>Dernières activités</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse($user['activites_recentes'] as $activite)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ $activite['action'] }}</span>
                                <span class="text-muted small">{{ $activite['date'] }}</span>
                            </li>
                        @empty
                            <li class="list-group-item text-muted text-center">Aucune activité récente.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection