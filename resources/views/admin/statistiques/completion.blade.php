@extends('layouts.app')

@section('title', 'Taux de complétion — Administration')

@section('page_title', 'Taux de complétion détaillé')
@section('page_icon', 'fa-check-double')

@section('breadcrumb')
    <li><a href="{{ route('admin.dashboard') }}">Administration</a></li>
    <li><a href="{{ route('admin.statistiques.index') }}">Statistiques</a></li>
    <li class="active">Taux de complétion</li>
@endsection

@section('page_actions')
    <a href="#" class="btn btn-sm btn-success rounded-pill">
        <i class="fas fa-file-export"></i> Exporter (Excel)
    </a>
    <a href="{{ route('admin.statistiques.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
        <i class="fas fa-arrow-left"></i> Retour
    </a>
@endsection

@section('contenu')
    {{-- Résumé KPI --}}
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card bg-success text-white shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase fs-6 opacity-75">Moyenne globale</h6>
                        <h2 class="mb-0">{{ $moyenne_globale }}%</h2>
                    </div>
                    <i class="fas fa-chart-simple fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-primary text-white shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase fs-6 opacity-75">Taux le plus élevé</h6>
                        <h2 class="mb-0">{{ $taux_eleve }}%</h2>
                    </div>
                    <i class="fas fa-arrow-up fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-danger text-white shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase fs-6 opacity-75">Taux le plus faible</h6>
                        <h2 class="mb-0">{{ $taux_faible }}%</h2>
                    </div>
                    <i class="fas fa-arrow-down fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Tableau détaillé --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>#</th>
                            <th>Formation</th>
                            <th>Inscrits</th>
                            <th>Terminés</th>
                            <th>En cours</th>
                            <th>Taux de complétion</th>
                            <th>Progression</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($formations as $formation)
                            <tr>
                                <td>{{ $formation['id'] }}</td>
                                <td><span class="fw-semibold">{{ $formation['titre'] }}</span></td>
                                <td>{{ $formation['inscrits'] }}</td>
                                <td>{{ $formation['termines'] }}</td>
                                <td>{{ $formation['en_cours'] }}</td>
                                <td>
                                    <span class="fw-bold">{{ $formation['taux'] }}%</span>
                                </td>
                                <td style="width: 150px;">
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-success" style="width: {{ $formation['taux'] }}%; border-radius: 10px;"></div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-0 py-3 px-4">
            <div class="text-muted small">
                <i class="fas fa-chart-simple me-1"></i> {{ count($formations) }} formation(s)
            </div>
        </div>
    </div>
@endsection