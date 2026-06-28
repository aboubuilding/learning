@extends('layouts.app')

@section('title', 'Créer une catégorie — Administration')

@section('page_title', 'Créer une catégorie')
@section('page_icon', 'fa-plus-circle')

@section('breadcrumb')
    <li><a href="{{ route('admin.categories.index') }}">Catégories</a></li>
    <li class="active">Créer</li>
@endsection

@section('contenu')
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nom <span class="text-danger">*</span></label>
                        <input type="text" name="nom" class="form-control" placeholder="Ex: Sécurité" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Statut</label>
                        <select name="etat" class="form-select">
                            <option value="1">Actif</option>
                            <option value="2">Inactif</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="Décrivez la catégorie..."></textarea>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fas fa-save me-2"></i> Créer la catégorie
                        </button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            Annuler
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection