@extends('layouts.app')

@section('title', 'Paramètres — Administration')

@section('page_title', 'Paramètres de la plateforme')
@section('page_icon', 'fa-cog')

@section('breadcrumb')
    <li><a href="{{ route('admin.dashboard') }}">Administration</a></li>
    <li class="active">Paramètres</li>
@endsection

@section('contenu')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.parametres.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    {{-- Informations générales --}}
                    <div class="col-md-6">
                        <h5 class="fw-bold mb-3"><i class="fas fa-info-circle me-2 text-primary"></i>Informations générales</h5>
                        <div class="mb-3">
                            <label class="form-label">Nom du site</label>
                            <input type="text" name="nom_site" class="form-control" value="{{ $parametres['nom_site'] }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Slogan</label>
                            <input type="text" name="slogan" class="form-control" value="{{ $parametres['slogan'] }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email de contact</label>
                            <input type="email" name="email_contact" class="form-control" value="{{ $parametres['email_contact'] }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email support</label>
                            <input type="email" name="email_support" class="form-control" value="{{ $parametres['email_support'] }}">
                        </div>
                    </div>

                    {{-- Paramètres avancés --}}
                    <div class="col-md-6">
                        <h5 class="fw-bold mb-3"><i class="fas fa-sliders-h me-2 text-success"></i>Paramètres avancés</h5>
                        <div class="mb-3">
                            <label class="form-label">Nombre maximal de tentatives par quiz</label>
                            <input type="number" name="nombre_tentatives_quiz" class="form-control" value="{{ $parametres['nombre_tentatives_quiz'] }}" min="1">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Seuil de réussite par défaut (%)</label>
                            <input type="number" name="seuil_reussite_default" class="form-control" value="{{ $parametres['seuil_reussite_default'] }}" min="0" max="100">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Durée de session (minutes)</label>
                            <input type="number" name="session_lifetime" class="form-control" value="{{ $parametres['session_lifetime'] }}" min="10">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Thème par défaut</label>
                            <select name="theme" class="form-select">
                                <option value="light" {{ $parametres['theme'] == 'light' ? 'selected' : '' }}>Clair</option>
                                <option value="dark" {{ $parametres['theme'] == 'dark' ? 'selected' : '' }}>Sombre</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Langue par défaut</label>
                            <select name="langue" class="form-select">
                                <option value="fr" {{ $parametres['langue'] == 'fr' ? 'selected' : '' }}>Français</option>
                                <option value="en" {{ $parametres['langue'] == 'en' ? 'selected' : '' }}>Anglais</option>
                            </select>
                        </div>
                    </div>

                    {{-- Options binaires --}}
                    <div class="col-12">
                        <hr class="my-2">
                        <h5 class="fw-bold mb-3"><i class="fas fa-toggle-on me-2 text-warning"></i>Options de la plateforme</h5>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="maintenance" name="maintenance" {{ $parametres['maintenance'] ? 'checked' : '' }}>
                                    <label class="form-check-label" for="maintenance">Mode maintenance</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="inscriptions_ouvertes" name="inscriptions_ouvertes" {{ $parametres['inscriptions_ouvertes'] ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inscriptions_ouvertes">Inscriptions ouvertes</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Boutons --}}
                    <div class="col-12">
                        <hr>
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fas fa-save me-2"></i> Enregistrer les modifications
                        </button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="fas fa-times me-2"></i> Annuler
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection