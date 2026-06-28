@extends('layouts.app')

@section('title', 'Créer une formation — Administration')

@section('page_title', 'Créer une formation')
@section('page_icon', 'fa-plus-circle')

@section('breadcrumb')
    <li><a href="{{ route('admin.formations.index') }}">Formations</a></li>
    <li class="active">Créer</li>
@endsection

@section('contenu')
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.formations.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label">Titre <span class="text-danger">*</span></label>
                        <input type="text" name="titre" class="form-control" placeholder="Ex: Sécurité chimique avancée" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Catégorie <span class="text-danger">*</span></label>
                        <select name="categorie_id" class="form-select" required>
                            <option value="">Choisir...</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat['id'] }}">{{ $cat['nom'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="Décrivez la formation..."></textarea>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Formateur <span class="text-danger">*</span></label>
                        <select name="formateur_id" class="form-select" required>
                            <option value="">Choisir un formateur...</option>
                            @foreach($formateurs as $formateur)
                                <option value="{{ $formateur['id'] }}">{{ $formateur['nom'] }} ({{ $formateur['email'] }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Niveau <span class="text-danger">*</span></label>
                        <select name="niveau" class="form-select" required>
                            <option value="debutant">Débutant</option>
                            <option value="intermediaire" selected>Intermédiaire</option>
                            <option value="avance">Avancé</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Durée (minutes) <span class="text-danger">*</span></label>
                        <input type="number" name="duree_minutes" class="form-control" placeholder="120" required>
                    </div>

                    <div class="col-md-6">
                        <div class="form-check form-switch mt-4">
                            <input class="form-check-input" type="checkbox" id="est_publie" name="est_publie" checked>
                            <label class="form-check-label" for="est_publie">Publier immédiatement</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fas fa-save me-2"></i> Créer la formation
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