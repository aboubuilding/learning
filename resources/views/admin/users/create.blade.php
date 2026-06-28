@extends('layouts.app')

@section('title', 'Ajouter un utilisateur — Administration')

@section('page_title', 'Ajouter un utilisateur')
@section('page_icon', 'fa-user-plus')

@section('breadcrumb')
    <li><a href="{{ route('admin.users.index') }}">Utilisateurs</a></li>
    <li class="active">Ajouter</li>
@endsection

@section('contenu')
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Prénom</label>
                        <input type="text" name="prenom" class="form-control" placeholder="Prénom" value="Jean">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control" placeholder="Nom" value="Dupont">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" value="jean.dupont@exemple.com">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Rôle</label>
                        <select name="role" class="form-select">
                            <option value="Apprenant">Apprenant</option>
                            <option value="Formateur">Formateur</option>
                            <option value="Administrateur">Administrateur</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Mot de passe</label>
                        <input type="password" name="password" class="form-control" placeholder="Mot de passe" value="password">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Confirmer</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmer" value="password">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fas fa-save me-2"></i> Créer l'utilisateur
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