@extends('layouts.app')

@section('title', $cours['titre'] . ' — AquaForm')

@section('page_title', $cours['titre'])
@section('page_icon', 'fa-book-open')

@section('breadcrumb')
    <li><a href="{{ route('home') }}">Accueil</a></li>
    <li><a href="{{ route('apprenant.progression.index') }}">Ma progression</a></li>
    <li class="active">{{ $cours['titre'] }}</li>
@endsection

@section('page_actions')
    <a href="{{ route('apprenant.progression.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
        <i class="fas fa-arrow-left me-1"></i> Retour
    </a>
@endsection

@section('contenu')
    <div class="row g-4">
        {{-- Colonne principale --}}
        <div class="col-lg-8">
            {{-- En-tête du cours --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h4 class="fw-bold">{{ $cours['titre'] }}</h4>
                            <p class="text-muted">{{ $cours['description'] }}</p>
                            <span class="badge bg-secondary"><i class="fas fa-user-chalk me-1"></i>{{ $cours['formateur'] }}</span>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-primary rounded-pill fs-6">{{ $cours['progression'] }}%</span>
                            <div class="progress mt-1" style="width: 120px; height: 6px;">
                                <div class="progress-bar bg-success" style="width: {{ $cours['progression'] }}%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Liste des modules --}}
            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent py-3">
                    <h5 class="fw-bold mb-0"><i class="fas fa-cubes me-2"></i>Modules</h5>
                </div>
                <div class="card-body p-0">
                    @foreach($cours['modules'] as $module)
                        <div class="module-item p-3 border-bottom">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-3">
                                    @if($module['termine'])
                                        <i class="fas fa-check-circle text-success fs-5"></i>
                                    @else
                                        <i class="fas fa-circle text-muted fs-5"></i>
                                    @endif
                                    <div>
                                        <h6 class="mb-0 fw-semibold">{{ $module['titre'] }}</h6>
                                        <span class="text-muted small">{{ $module['duree'] }}</span>
                                    </div>
                                </div>
                                <span class="badge {{ $module['termine'] ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $module['termine'] ? 'Terminé' : 'En cours' }}
                                </span>
                            </div>

                            {{-- Ressources du module --}}
                            @if(!empty($module['ressources']))
                                <div class="mt-2 ps-4">
                                    @foreach($module['ressources'] as $ressource)
                                        <div class="d-flex align-items-center gap-2 py-1">
                                            {{-- Icône selon le type --}}
                                            <i class="fas {{ $ressource['type'] == 'video' ? 'fa-play-circle' : ($ressource['type'] == 'pdf' ? 'fa-file-pdf' : ($ressource['type'] == 'diaporama' ? 'fa-slideshare' : 'fa-book')) }} text-primary"></i>
                                            
                                            {{-- Lien vers la ressource (toujours cliquable) --}}
                                            <a href="{{ route('apprenant.ressource.show', $ressource['id']) }}" 
                                               class="small {{ $ressource['termine'] ? 'text-success text-decoration-line-through' : '' }}">
                                                {{ $ressource['titre'] }}
                                            </a>

                                            {{-- Téléchargement direct pour les PDF (optionnel) --}}
                                            @if($ressource['type'] == 'pdf')
                                                <a href="{{ route('apprenant.ressource.download', $ressource['id']) }}" 
                                                   class="btn btn-sm btn-outline-secondary rounded-pill ms-auto"
                                                   title="Télécharger le PDF">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            @endif

                                            {{-- Statut terminé ou bouton "Lire" --}}
                                            @if($ressource['termine'])
                                                <i class="fas fa-check-circle text-success ms-2"></i>
                                            @else
                                                <a href="{{ route('apprenant.ressource.show', $ressource['id']) }}" 
                                                   class="btn btn-sm btn-outline-primary rounded-pill ms-2">
                                                    <i class="fas fa-play me-1"></i> Lire
                                                </a>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Quiz --}}
            @if(!empty($cours['quiz']))
                <div class="card shadow-sm border-0 mt-4">
                    <div class="card-header bg-transparent py-3">
                        <h5 class="fw-bold mb-0"><i class="fas fa-question-circle me-2 text-warning"></i>Quiz</h5>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @foreach($cours['quiz'] as $quiz)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $quiz['titre'] }}</span>
                                    <div class="d-flex align-items-center gap-2">
                                        @if($quiz['score'] !== null)
                                            <span class="fw-bold">{{ $quiz['score'] }}%</span>
                                            <span class="badge {{ $quiz['reussi'] ? 'bg-success' : 'bg-danger' }}">
                                                {{ $quiz['reussi'] ? '✅ Réussi' : '❌ Échec' }}
                                            </span>
                                        @else
                                            <a href="#" class="btn btn-sm btn-primary rounded-pill">Commencer</a>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>

        {{-- Colonne latérale --}}
        <div class="col-lg-4">
            {{-- Progression --}}
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fas fa-chart-line fa-3x text-primary opacity-50"></i>
                    <h2 class="fw-bold mt-2">{{ $cours['progression'] }}%</h2>
                    <span class="text-muted">Progression globale</span>
                    <div class="progress mt-2" style="height: 8px;">
                        <div class="progress-bar bg-success" style="width: {{ $cours['progression'] }}%;"></div>
                    </div>
                </div>
            </div>

            {{-- Ressources par type --}}
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-header bg-transparent py-3">
                    <h6 class="fw-bold mb-0"><i class="fas fa-folder-open me-2"></i>Ressources</h6>
                </div>
                <div class="card-body">
                    @foreach($ressourcesParType as $type => $ressources)
                        @php
                            $total = $ressources->count();
                            $termines = $ressources->filter(fn($r) => $r['termine'])->count();
                        @endphp
                        <div class="d-flex justify-content-between align-items-center py-1">
                            <span class="text-muted small">{{ ucfirst($type) }}</span>
                            <span>{{ $termines }}/{{ $total }}</span>
                        </div>
                    @endforeach
                    <hr>
                    <div class="d-flex justify-content-between fw-semibold">
                        <span>Total</span>
                        <span>{{ $ressourcesTerminees }}/{{ $totalRessources }}</span>
                    </div>
                </div>
            </div>

            {{-- Certificat --}}
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-body text-center">
                    @if($cours['progression'] == 100)
                        <i class="fas fa-certificate fa-3x text-success"></i>
                        <h6 class="fw-bold mt-2">Certificat disponible</h6>
                        <a href="#" class="btn btn-sm btn-success rounded-pill mt-2">
                            <i class="fas fa-download me-1"></i> Télécharger
                        </a>
                    @else
                        <i class="fas fa-certificate fa-3x text-muted opacity-50"></i>
                        <h6 class="fw-bold mt-2 text-muted">Certificat non disponible</h6>
                        <p class="text-muted small">Terminez tous les modules pour l'obtenir.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
<style>
    .module-item {
        transition: background 0.15s;
    }
    .module-item:hover {
        background: #f8faf9;
    }
    .module-item .ps-4 {
        padding-left: 2.5rem !important;
    }
    .module-item .btn-sm {
        padding: 0.15rem 0.6rem;
        font-size: 0.7rem;
    }
</style>
@endpush