@extends('layouts.app')

@section('title', 'Modifier la formation — AquaForm')

@section('page_title', 'Modifier la formation')
@section('page_icon', 'fa-edit')

@section('breadcrumb')
    <li><a href="{{ route('home') }}">Accueil</a></li>
    <li><a href="{{ route('formateur.formations.index') }}">Mes formations</a></li>
    <li class="active">Modifier</li>
@endsection

@section('page_actions')
    <a href="{{ route('formateur.formations.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
        <i class="fas fa-arrow-left me-1"></i> Retour à la liste
    </a>
@endsection

@section('contenu')
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('formateur.formations.update', $formation['id']) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    {{-- Titre --}}
                    <div class="col-md-8">
                        <label class="form-label" for="titre">Titre de la formation <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('titre') is-invalid @enderror" id="titre" name="titre" value="{{ old('titre', $formation['titre']) }}" required>
                        @error('titre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Catégorie --}}
                    <div class="col-md-4">
                        <label class="form-label" for="categorie_id">Catégorie <span class="text-danger">*</span></label>
                        <select class="form-select @error('categorie_id') is-invalid @enderror" id="categorie_id" name="categorie_id" required>
                            <option value="">Choisir une catégorie</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat['id'] }}" {{ old('categorie_id', $formation['categorie_id']) == $cat['id'] ? 'selected' : '' }}>
                                    {{ $cat['nom'] }}
                                </option>
                            @endforeach
                        </select>
                        @error('categorie_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="col-12">
                        <label class="form-label" for="description">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description', $formation['description']) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Niveau --}}
                    <div class="col-md-4">
                        <label class="form-label" for="niveau">Niveau <span class="text-danger">*</span></label>
                        <select class="form-select @error('niveau') is-invalid @enderror" id="niveau" name="niveau" required>
                            @foreach($niveaux as $niveau)
                                <option value="{{ $niveau }}" {{ old('niveau', $formation['niveau']) == $niveau ? 'selected' : '' }}>
                                    {{ $niveau }}
                                </option>
                            @endforeach
                        </select>
                        @error('niveau')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Durée --}}
                    <div class="col-md-4">
                        <label class="form-label" for="duree">Durée estimée <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('duree') is-invalid @enderror" id="duree" name="duree" value="{{ old('duree', $formation['duree']) }}" placeholder="ex: 8h, 2h30" required>
                        @error('duree')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Publication --}}
                    <div class="col-md-4 d-flex align-items-center">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="est_publie" name="est_publie" value="1" {{ old('est_publie', $formation['est_publie']) ? 'checked' : '' }}>
                            <label class="form-check-label" for="est_publie">Publier la formation</label>
                        </div>
                    </div>

                    {{-- Boutons --}}
                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fas fa-save me-2"></i> Mettre à jour
                        </button>
                        <a href="{{ route('formateur.formations.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="fas fa-times me-2"></i> Annuler
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection