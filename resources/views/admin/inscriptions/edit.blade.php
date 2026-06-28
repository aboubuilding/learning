@extends('layouts.app')

@section('title', 'Modifier le statut — Administration')

@section('page_title', 'Modifier le statut de l\'inscription')
@section('page_icon', 'fa-edit')

@section('breadcrumb')
    <li><a href="{{ route('admin.inscriptions.index') }}">Inscriptions</a></li>
    <li class="active">Modifier le statut</li>
@endsection

@section('contenu')
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.inscriptions.update', $inscription['id']) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Apprenant</label>
                        <p class="fw-semibold">{{ $inscription['apprenant'] }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Formation</label>
                        <p class="fw-semibold">{{ $inscription['formation'] }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nouveau statut</label>
                        <select name="statut" class="form-select" required>
                            @foreach($statuts as $statut)
                                <option value="{{ $statut }}" {{ $inscription['statut'] == $statut ? 'selected' : '' }}>
                                    {{ ucfirst(str_replace('_', ' ', $statut)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fas fa-save me-2"></i> Mettre à jour
                        </button>
                        <a href="{{ route('admin.inscriptions.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            Annuler
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection