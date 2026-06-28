@extends('layouts.app')

@section('title', 'Créer un module — Administration')

@section('page_title', 'Créer un module')
@section('page_icon', 'fa-plus-circle')

@section('breadcrumb')
    <li><a href="{{ route('admin.modules.index') }}">Modules</a></li>
    <li class="active">Créer</li>
@endsection

@section('contenu')
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.modules.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label">Titre <span class="text-danger">*</span></label>
                        <input type="text" name="titre" class="form-control" placeholder="Ex: Introduction aux produits chimiques" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Ordre <span class="text-danger">*</span></label>
                        <input type="number" name="ordre" class="form-control" placeholder="1" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Décrivez le contenu du module..."></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Formation associée <span class="text-danger">*</span></label>
                        <select name="formation_id" class="form-select" required>
                            <option value="">Choisir une formation...</option>
                            @foreach($formations as $formation)
                                <option value="{{ $formation['id'] }}">{{ $formation['titre'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Formateur responsable <span class="text-danger">*</span></label>
                        <select name="formateur_id" class="form-select" required>
                            <option value="">Choisir un formateur...</option>
                            @foreach($formateurs as $formateur)
                                <option value="{{ $formateur['id'] }}">{{ $formateur['nom'] }} ({{ $formateur['email'] }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <div class="form-check form-switch mt-4">
                            <input class="form-check-input" type="checkbox" id="statut" name="statut" checked>
                            <label class="form-check-label" for="statut">Actif</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fas fa-save me-2"></i> Créer le module
                        </button>
                        <a href="{{ route('admin.modules.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            Annuler
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection