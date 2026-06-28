@extends('layouts.app')

@section('title', 'Résultats du quiz — AquaForm')

@section('page_title', 'Résultats du quiz')
@section('page_icon', 'fa-chart-bar')

@section('breadcrumb')
    <li><a href="{{ route('home') }}">Accueil</a></li>
    <li><a href="{{ route('formateur.quiz.index') }}">Quiz</a></li>
    <li><a href="{{ route('formateur.quiz.show', $id) }}">Détail</a></li>
    <li class="active">Résultats</li>
@endsection

@section('page_actions')
    <a href="{{ route('formateur.quiz.show', $id) }}" class="btn btn-sm btn-outline-secondary rounded-pill">
        <i class="fas fa-arrow-left me-1"></i> Retour au quiz
    </a>
@endsection

@section('contenu')
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h4 class="fw-bold">Résultats du quiz</h4>
            <p class="text-muted">Visualisez les performances des apprenants pour ce quiz.</p>

            {{-- Statistiques globales (simulées) --}}
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h6 class="text-uppercase fs-6 opacity-75">Participants</h6>
                            <h2 class="mb-0">12</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h6 class="text-uppercase fs-6 opacity-75">Taux de réussite</h6>
                            <h2 class="mb-0">68%</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-dark">
                        <div class="card-body">
                            <h6 class="text-uppercase fs-6 opacity-75">Score moyen</h6>
                            <h2 class="mb-0">72%</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <h6 class="text-uppercase fs-6 opacity-75">Tentatives</h6>
                            <h2 class="mb-0">18</h2>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tableau des résultats détaillés --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th>Apprenant</th>
                            <th>Score</th>
                            <th>Statut</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < 5; $i++)
                            <tr>
                                <td><span class="fw-semibold">{{ fake()->name() }}</span></td>
                                <td>{{ rand(40, 100) }}%</td>
                                <td>
                                    <span class="badge {{ rand(0, 1) ? 'bg-success' : 'bg-danger' }}">
                                        {{ rand(0, 1) ? 'Réussi' : 'Échec' }}
                                    </span>
                                </td>
                                <td>{{ \Carbon\Carbon::now()->subDays(rand(1, 10))->format('d/m/Y') }}</td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection