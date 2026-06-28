@extends('layouts.app')

@section('title', 'Gestion des quiz — AquaForm')

@section('page_title', 'Gestion des quiz')
@section('page_icon', 'fa-question-circle')

@section('breadcrumb')
    <li><a href="{{ route('home') }}">Accueil</a></li>
    <li><a href="{{ route('formateur.dashboard') }}">Tableau de bord</a></li>
    <li class="active">Quiz</li>
@endsection

@section('page_actions')
    <a href="{{ route('formateur.quiz.create') }}" class="btn btn-sm btn-primary rounded-pill">
        <i class="fas fa-plus-circle me-1"></i> Créer un quiz
    </a>
@endsection

@section('contenu')
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body py-3">
            <form method="GET" class="row g-2">
                <div class="col-md-4">
                    <select name="formation" class="form-select" onchange="this.form.submit()">
                        <option value="">Toutes les formations</option>
                        @foreach($formations as $formation)
                            <option value="{{ $formation['id'] }}" {{ request('formation') == $formation['id'] ? 'selected' : '' }}>
                                {{ $formation['titre'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary rounded-pill w-100">Filtrer</button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('formateur.quiz.index') }}" class="btn btn-outline-secondary rounded-pill w-100">Réinitialiser</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>Titre</th>
                            <th>Formation</th>
                            <th>Module</th>
                            <th>Questions</th>
                            <th>Tentatives</th>
                            <th>Score moyen</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($quizs as $quiz)
                            <tr>
                                <td><span class="fw-semibold">{{ $quiz['titre'] }}</span></td>
                                <td>{{ $formations[array_search($quiz['formation_id'], array_column($formations, 'id'))]['titre'] ?? 'N/A' }}</td>
                                <td>{{ $quiz['module_id'] ? 'Module '.$quiz['module_id'] : 'Global' }}</td>
                                <td>{{ $quiz['questions'] }}</td>
                                <td>{{ $quiz['tentatives'] }}</td>
                                <td>{{ $quiz['score_moyen'] }}%</td>
                                <td class="text-end">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('formateur.quiz.show', $quiz['id']) }}" class="btn btn-outline-info rounded-pill" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('formateur.quiz.results', $quiz['id']) }}" class="btn btn-outline-success rounded-pill" title="Résultats">
                                            <i class="fas fa-chart-bar"></i>
                                        </a>
                                        <a href="{{ route('formateur.quiz.edit', $quiz['id']) }}" class="btn btn-outline-primary rounded-pill" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('formateur.quiz.destroy', $quiz['id']) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger rounded-pill" title="Supprimer">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center py-4 text-muted">Aucun quiz trouvé.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Supprimer définitivement ce quiz ?')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endpush