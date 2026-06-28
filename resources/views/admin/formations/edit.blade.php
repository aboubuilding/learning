@extends('layouts.app')

@section('title', 'Modifier une formation — Administration')

@section('page_title', 'Modifier une formation')
@section('page_icon', 'fa-edit')

@section('breadcrumb')
    <li><a href="{{ route('admin.formations.index') }}">Formations</a></li>
    <li class="active">Modifier</li>
@endsection

@section('contenu')
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.formations.update', $formation['id']) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label">Titre <span class="text-danger">*</span></label>
                        <input type="text" name="titre" class="form-control" value="{{ $formation['titre'] }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Catégorie <span class="text-danger">*</span></label>
                        <select name="categorie_id" class="form-select" required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat['id'] }}" {{ $formation['categorie_id'] == $cat['id'] ? 'selected' : '' }}>
                                    {{ $cat['nom'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="4">{{ $formation['description'] }}</textarea>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Formateur <span class="text-danger">*</span></label>
                        <select name="formateur_id" class="form-select" required>
                            @foreach($formateurs as $formateur)
                                <option value="{{ $formateur['id'] }}" {{ $formation['formateur_id'] == $formateur['id'] ? 'selected' : '' }}>
                                    {{ $formateur['nom'] }} ({{ $formateur['email'] }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Niveau <span class="text-danger">*</span></label>
                        <select name="niveau" class="form-select" required>
                            <option value="debutant" {{ $formation['niveau'] == 'debutant' ? 'selected' : '' }}>Débutant</option>
                            <option value="intermediaire" {{ $formation['niveau'] == 'intermediaire' ? 'selected' : '' }}>Intermédiaire</option>
                            <option value="avance" {{ $formation['niveau'] == 'avance' ? 'selected' : '' }}>Avancé</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Durée (minutes) <span class="text-danger">*</span></label>
                        <input type="number" name="duree_minutes" class="form-control" value="{{ $formation['duree_minutes'] }}" required>
                    </div>

                    <div class="col-md-6">
                        <div class="form-check form-switch mt-4">
                            <input class="form-check-input" type="checkbox" id="est_publie" name="est_publie" {{ $formation['est_publie'] ? 'checked' : '' }}>
                            <label class="form-check-label" for="est_publie">Publiée</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fas fa-save me-2"></i> Mettre à jour
                        </button>
                        <a href="{{ route('admin.formations.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            Annuler
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection