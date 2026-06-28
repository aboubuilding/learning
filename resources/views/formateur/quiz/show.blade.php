@extends('layouts.app')

@section('title', $quiz['titre'] . ' — AquaForm')

@section('page_title', $quiz['titre'])
@section('page_icon', 'fa-question-circle')

@section('breadcrumb')
    <li><a href="{{ route('home') }}">Accueil</a></li>
    <li><a href="{{ route('formateur.quiz.index') }}">Quiz</a></li>
    <li class="active">{{ $quiz['titre'] }}</li>
@endsection

@section('page_actions')
    <a href="{{ route('formateur.quiz.edit', $quiz['id']) }}" class="btn btn-sm btn-primary rounded-pill">
        <i class="fas fa-edit me-1"></i> Modifier
    </a>
    <a href="{{ route('formateur.quiz.results', $quiz['id']) }}" class="btn btn-sm btn-success rounded-pill">
        <i class="fas fa-chart-bar me-1"></i> Résultats
    </a>
    <a href="{{ route('formateur.quiz.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
        <i class="fas fa-arrow-left me-1"></i> Retour
    </a>
@endsection

@section('contenu')
    <div class="row g-4">
        <div class="col-lg-8">
            {{-- Informations générales --}}
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <span class="text-muted small">Formation</span>
                            <div class="fw-semibold">{{ $quiz['formation'] }}</div>
                        </div>
                        <div class="col-md-4">
                            <span class="text-muted small">Module</span>
                            <div class="fw-semibold">{{ $quiz['module'] ?? 'Global' }}</div>
                        </div>
                        <div class="col-md-4">
                            <span class="text-muted small">Score minimal</span>
                            <div class="fw-semibold">{{ $quiz['score_minimal'] }}%</div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <span class="text-muted small">Tentatives max</span>
                            <div class="fw-semibold">{{ $quiz['nombre_tentatives'] }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Questions --}}
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-header bg-transparent py-3">
                    <h5 class="fw-bold mb-0"><i class="fas fa-list-ol me-2 text-primary"></i>Questions</h5>
                </div>
                <div class="card-body p-0">
                    @foreach($quiz['questions'] as $index => $question)
                        <div class="p-3 border-bottom">
                            <div class="d-flex justify-content-between">
                                <h6 class="fw-semibold">Q{{ $index+1 }}: {{ $question['question'] }}</h6>
                                <span class="badge bg-secondary">{{ $question['points'] }} pts</span>
                            </div>
                            <ul class="list-unstyled ms-3 mb-0">
                                @foreach($question['reponses'] as $reponse)
                                    <li class="small {{ $reponse['est_correcte'] ? 'text-success fw-semibold' : 'text-muted' }}">
                                        <i class="fas {{ $reponse['est_correcte'] ? 'fa-check-circle' : 'fa-circle' }} me-1"></i>
                                        {{ $reponse['reponse'] }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Colonne latérale : statistiques --}}
        <div class="col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fas fa-chart-pie fa-3x text-primary opacity-50"></i>
                    <h6 class="fw-bold mt-2">Statistiques du quiz</h6>
                    <div class="d-flex justify-content-between mt-3">
                        <div>
                            <span class="text-muted small">Tentatives</span>
                            <div class="fw-bold">{{ $quiz['statistiques']['tentatives'] }}</div>
                        </div>
                        <div>
                            <span class="text-muted small">Score moyen</span>
                            <div class="fw-bold">{{ $quiz['statistiques']['score_moyen'] }}%</div>
                        </div>
                        <div>
                            <span class="text-muted small">Taux réussite</span>
                            <div class="fw-bold">{{ $quiz['statistiques']['reussite'] }}%</div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="text-muted small">Meilleur score</span>
                        <div class="fw-bold text-success">{{ $quiz['statistiques']['meilleur_score'] }}%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection