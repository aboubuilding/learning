@extends('layouts.env')

@section('title', 'Tableau de bord — Formateur')

@section('page_title', 'Mes formations')
@section('page_icon', 'fa-chalkboard-teacher')

@section('breadcrumb')
    <li><a href="#">Accueil</a></li>
    <li class="active">Formations</li>
@endsection

@section('page_actions')
    <a href="#" class="btn btn-sm btn-success">
        <i class="fas fa-plus-circle"></i> Nouvelle formation
    </a>
    <a href="#" class="btn btn-sm btn-outline-secondary">
        <i class="fas fa-file-export"></i> Exporter
    </a>
@endsection

@section('contenu')
    {{-- Statistiques rapides --}}
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                        <i class="fas fa-book-open fa-2x text-primary"></i>
                    </div>
                    <div>
                        <h6 class="text-muted small fw-bold">Cours actifs</h6>
                        <h3 class="fw-bold mb-0">{{ rand(3, 10) }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                        <i class="fas fa-users fa-2x text-success"></i>
                    </div>
                    <div>
                        <h6 class="text-muted small fw-bold">Apprenants</h6>
                        <h3 class="fw-bold mb-0">{{ rand(50, 200) }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                        <i class="fas fa-clipboard-list fa-2x text-warning"></i>
                    </div>
                    <div>
                        <h6 class="text-muted small fw-bold">Quiz à noter</h6>
                        <h3 class="fw-bold mb-0">{{ rand(2, 8) }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-info bg-opacity-10 p-3 me-3">
                        <i class="fas fa-certificate fa-2x text-info"></i>
                    </div>
                    <div>
                        <h6 class="text-muted small fw-bold">Certificats émis</h6>
                        <h3 class="fw-bold mb-0">{{ rand(10, 40) }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Liste des cours avec progression --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0"><i class="fas fa-list-ul text-primary me-2"></i>Vos formations</h5>
            <span class="text-muted small">{{ rand(1, 5) }} en cours</span>
        </div>
        <div class="card-body">
            @for ($i = 0; $i < 4; $i++)
                <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                    <div>
                        <h6 class="mb-0 fw-semibold">{{ fake()->sentence(3) }}</h6>
                        <span class="text-muted small">{{ ['Débutant', 'Intermédiaire', 'Avancé'][rand(0,2)] }}</span>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div class="progress" style="width: 100px; height: 6px;">
                            <div class="progress-bar bg-success" style="width: {{ rand(40, 95) }}%"></div>
                        </div>
                        <span class="small fw-bold">{{ rand(40, 95) }}%</span>
                        <a href="#" class="btn btn-sm btn-outline-primary">Gérer</a>
                    </div>
                </div>
            @endfor
        </div>
    </div>
@endsection