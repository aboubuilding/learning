@extends('layouts.app')

@section('title', 'Modifier un utilisateur — Administration')

@section('page_title', 'Modifier l\'utilisateur')
@section('page_icon', 'fa-user-edit')

@section('breadcrumb')
    <li><a href="{{ route('admin.users.index') }}">Utilisateurs</a></li>
    <li class="active">Modifier</li>
@endsection

@section('contenu')
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.users.update', $user['id']) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Prénom</label>
                        <input type="text" name="prenom" class="form-control" value="{{ $user['prenom'] }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control" value="{{ $user['nom'] }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $user['email'] }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Rôle</label>
                        <select name="role" class="form-select">
                            <option value="Apprenant" {{ $user['role'] == 'Apprenant' ? 'selected' : '' }}>Apprenant</option>
                            <option value="Formateur" {{ $user['role'] == 'Formateur' ? 'selected' : '' }}>Formateur</option>
                            <option value="Administrateur" {{ $user['role'] == 'Administrateur' ? 'selected' : '' }}>Administrateur</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Statut</label>
                        <select name="statut" class="form-select">
                            <option value="Actif" {{ $user['statut'] == 'Actif' ? 'selected' : '' }}>Actif</option>
                            <option value="Inactif" {{ $user['statut'] == 'Inactif' ? 'selected' : '' }}>Inactif</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fas fa-save me-2"></i> Mettre à jour
                        </button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            Annuler
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection