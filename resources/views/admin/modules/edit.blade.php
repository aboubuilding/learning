@extends('layouts.app')

@section('title', 'Modifier un module — Administration')

@section('page_title', 'Modifier un module')
@section('page_icon', 'fa-edit')

@section('breadcrumb')
    <li><a href="{{ route('admin.modules.index') }}">Modules</a></li>
    <li class="active">Modifier</li>
@endsection

@section('contenu')
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.modules.update', $module['id']) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label">Titre <span class="text-danger">*</span></label>
                        <input type="text" name="titre" class="form-control" value="{{ $module['titre'] }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Ordre <span class="text-danger">*</span></label>
                        <input type="number" name="ordre" class="form-control" value="{{ $module['ordre'] }}" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3">{{ $module['description'] }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Formation associée <span class="text-danger">*</span></label>
                        <select name="formation_id" class="form-select" required>
                            @foreach($formations as $formation)
                                <option value="{{ $formation['id'] }}" {{ $module['formation_id'] == $formation['id'] ? 'selected' : '' }}>
                                    {{ $formation['titre'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Formateur responsable <span class="text-danger">*</span></label>
                        <select name="formateur_id" class="form-select" required>
                            @foreach($formateurs as $formateur)
                                <option value="{{ $formateur['id'] }}" {{ $module['formateur_id'] == $formateur['id'] ? 'selected' : '' }}>
                                    {{ $formateur['nom'] }} ({{ $formateur['email'] }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <div class="form-check form-switch mt-4">
                            <input class="form-check-input" type="checkbox" id="statut" name="statut" {{ $module['statut'] == 'Actif' ? 'checked' : '' }}>
                            <label class="form-check-label" for="statut">Actif</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fas fa-save me-2"></i> Mettre à jour
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