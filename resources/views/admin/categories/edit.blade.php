@extends('layouts.app')

@section('title', 'Modifier une catégorie — Administration')

@section('page_title', 'Modifier une catégorie')
@section('page_icon', 'fa-edit')

@section('breadcrumb')
    <li><a href="{{ route('admin.categories.index') }}">Catégories</a></li>
    <li class="active">Modifier</li>
@endsection

@section('contenu')
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.categories.update', $category['id']) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nom <span class="text-danger">*</span></label>
                        <input type="text" name="nom" class="form-control" value="{{ $category['nom'] }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Statut</label>
                        <select name="etat" class="form-select">
                            <option value="1" {{ $category['etat'] == 'Actif' ? 'selected' : '' }}>Actif</option>
                            <option value="2" {{ $category['etat'] == 'Inactif' ? 'selected' : '' }}>Inactif</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="4">{{ $category['description'] }}</textarea>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fas fa-save me-2"></i> Mettre à jour
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