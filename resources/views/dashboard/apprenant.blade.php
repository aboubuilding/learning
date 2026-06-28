@extends('layouts.env')

@section('title', 'Mon espace — Apprenant')

@section('page_title', 'Mes cours')
@section('page_icon', 'fa-user-graduate')

@section('breadcrumb')
    <li><a href="#">Accueil</a></li>
    <li class="active">Mes cours</li>
@endsection

@section('page_actions')
    <a href="#" class="btn btn-sm btn-outline-primary">
        <i class="fas fa-search"></i> Rechercher
    </a>
@endsection

@section('contenu')
    {{-- Progression globale --}}
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-center p-3">
                <h5 class="text-muted small fw-bold">Taux de complétion</h5>
                <div class="display-4 fw-bold text-primary">{{ rand(50, 90) }}%</div>
                <div class="progress" style="height: 8px;">
                    <div class="progress-bar bg-primary" style="width: {{ rand(50, 90) }}%"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-center p-3">
                <h5 class="text-muted small fw-bold">Cours en cours</h5>
                <div class="display-4 fw-bold text-success">{{ rand(2, 6) }}</div>
                <span class="text-muted small">sur {{ rand(8, 15) }} au total</span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-center p-3">
                <h5 class="text-muted small fw-bold">Certificats obtenus</h5>
                <div class="display-4 fw-bold text-warning">{{ rand(1, 5) }}</div>
                <span class="text-muted small">dernier : {{ \Carbon\Carbon::now()->subDays(rand(1,30))->format('d/m/Y') }}</span>
            </div>
        </div>
    </div>

    {{-- Liste des cours avec progression --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-transparent">
            <h5 class="fw-bold mb-0"><i class="fas fa-book me-2 text-primary"></i>Mes formations</h5>
        </div>
        <div class="card-body">
            @for ($i = 0; $i < 4; $i++)
                <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                    <div>
                        <h6 class="mb-0 fw-semibold">{{ fake()->sentence(4) }}</h6>
                        <span class="text-muted small">Formateur : {{ fake()->name() }}</span>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div class="progress" style="width: 120px; height: 6px;">
                            <div class="progress-bar bg-success" style="width: {{ rand(20, 100) }}%"></div>
                        </div>
                        <span class="small fw-bold">{{ rand(20, 100) }}%</span>
                        @if (rand(0,1))
                            <span class="badge bg-success">Terminé</span>
                        @else
                            <a href="#" class="btn btn-sm btn-primary">Continuer</a>
                        @endif
                    </div>
                </div>
            @endfor
        </div>
    </div>

    {{-- Derniers quiz --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent">
                    <h5 class="fw-bold mb-0"><i class="fas fa-question-circle text-warning me-2"></i>Derniers quiz</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr><th>Quiz</th><th>Score</th><th>Statut</th><th></th></tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < 3; $i++)
                                <tr>
                                    <td>{{ fake()->sentence(2) }}</td>
                                    <td>{{ rand(40, 95) }}%</td>
                                    <td><span class="badge {{ rand(0,1) ? 'bg-success' : 'bg-warning' }}">{{ rand(0,1) ? 'Réussi' : 'En attente' }}</span></td>
                                    <td><a href="#" class="btn btn-sm btn-outline-primary">Voir</a></td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection