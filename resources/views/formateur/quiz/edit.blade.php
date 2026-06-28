@extends('layouts.app')

@section('title', 'Modifier le quiz — AquaForm')

@section('page_title', 'Modifier le quiz')
@section('page_icon', 'fa-edit')

@section('breadcrumb')
    <li><a href="{{ route('home') }}">Accueil</a></li>
    <li><a href="{{ route('formateur.quiz.index') }}">Quiz</a></li>
    <li><a href="{{ route('formateur.quiz.show', $quiz['id']) }}">{{ $quiz['titre'] }}</a></li>
    <li class="active">Modifier</li>
@endsection

@section('page_actions')
    <a href="{{ route('formateur.quiz.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
        <i class="fas fa-arrow-left me-1"></i> Retour à la liste
    </a>
@endsection

@section('contenu')
    <div class="card shadow-sm border-0">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i> Veuillez corriger les erreurs ci-dessous.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('formateur.quiz.update', $quiz['id']) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label">Titre du quiz <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('titre') is-invalid @enderror" name="titre" value="{{ old('titre', $quiz['titre']) }}" required>
                        @error('titre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Module associé <span class="text-danger">*</span></label>
                        <select class="form-select @error('module_id') is-invalid @enderror" name="module_id" required>
                            <option value="">Choisir un module</option>
                            @foreach($modules as $module)
                                <option value="{{ $module['id'] }}" {{ old('module_id', $quiz['module_id']) == $module['id'] ? 'selected' : '' }}>
                                    {{ $module['titre'] }}
                                </option>
                            @endforeach
                        </select>
                        @error('module_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Score minimal (%) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('score_minimal') is-invalid @enderror" name="score_minimal" value="{{ old('score_minimal', $quiz['score_minimal']) }}" min="0" max="100" required>
                        @error('score_minimal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tentatives maximales <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('nombre_max_tentatives') is-invalid @enderror" name="nombre_max_tentatives" value="{{ old('nombre_max_tentatives', $quiz['nombre_max_tentatives']) }}" min="1" required>
                        @error('nombre_max_tentatives')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Statut</label>
                        <select class="form-select @error('statut') is-invalid @enderror" name="statut">
                            <option value="brouillon" {{ old('statut', $quiz['statut']) == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                            <option value="publié" {{ old('statut', $quiz['statut']) == 'publié' ? 'selected' : '' }}>Publié</option>
                        </select>
                        @error('statut')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fas fa-save me-2"></i> Mettre à jour
                        </button>
                        <a href="{{ route('formateur.quiz.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            Annuler
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection