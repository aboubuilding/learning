@extends('layouts.app')

@section('title', $formation['titre'] . ' — AquaForm')

@section('page_title', $formation['titre'])
@section('page_icon', 'fa-chalkboard-teacher')

@section('breadcrumb')
    <li><a href="{{ route('home') }}">Accueil</a></li>
    <li><a href="{{ route('formateur.formations.index') }}">Mes formations</a></li>
    <li class="active">{{ $formation['titre'] }}</li>
@endsection

@section('page_actions')
    <a href="{{ route('formateur.formations.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
        <i class="fas fa-arrow-left me-1"></i> Retour à la liste
    </a>
    <a href="#" class="btn btn-sm btn-primary rounded-pill">
        <i class="fas fa-edit me-1"></i> Modifier la formation
    </a>
@endsection

@section('contenu')
    {{-- ===== INFORMATIONS GÉNÉRALES ===== --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-8">
                    <h4 class="fw-bold">{{ $formation['titre'] }}</h4>
                    <p class="text-muted">{{ $formation['description'] }}</p>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge bg-secondary">{{ $formation['categorie'] }}</span>
                        <span class="badge bg-info">{{ $formation['niveau'] }}</span>
                        <span class="badge bg-success">{{ $formation['statut'] }}</span>
                        <span class="badge bg-primary"><i class="fas fa-clock me-1"></i>{{ $formation['duree'] }}</span>
                    </div>
                </div>
                <div class="col-md-4 text-md-end">
                    <div><span class="text-muted small">Formateur</span><br><strong>{{ $formation['formateur'] }}</strong></div>
                    <div class="mt-2"><span class="text-muted small">Créée le</span><br><strong>{{ \Carbon\Carbon::parse($formation['date_creation'])->format('d/m/Y') }}</strong></div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== LISTE DES INSCRITS ===== --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-transparent d-flex justify-content-between align-items-center py-3">
            <h5 class="fw-bold mb-0"><i class="fas fa-users me-2 text-primary"></i>Apprenants inscrits ({{ count($inscrits) }})</h5>
            <span class="text-muted small">Progression moyenne : {{ round(collect($inscrits)->avg('progression')) }}%</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>Apprenant</th>
                            <th>Email</th>
                            <th>Progression</th>
                            <th>Inscrit le</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inscrits as $inscrit)
                            <tr>
                                <td><span class="fw-semibold">{{ $inscrit['nom'] }}</span></td>
                                <td>{{ $inscrit['email'] }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="progress" style="width: 80px; height: 6px;">
                                            <div class="progress-bar bg-success" style="width: {{ $inscrit['progression'] }}%;"></div>
                                        </div>
                                        <span class="fw-bold small">{{ $inscrit['progression'] }}%</span>
                                    </div>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($inscrit['date_inscription'])->format('d/m/Y') }}</td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-outline-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#modalInscrit{{ $inscrit['id'] }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ===== LISTE DES MODULES ET RESSOURCES ===== --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-transparent d-flex justify-content-between align-items-center py-3">
            <h5 class="fw-bold mb-0"><i class="fas fa-cubes me-2 text-primary"></i>Modules de la formation</h5>
            <button class="btn btn-sm btn-success rounded-pill" data-bs-toggle="modal" data-bs-target="#modalAjoutModule">
                <i class="fas fa-plus-circle me-1"></i> Ajouter un module
            </button>
        </div>
        <div class="card-body p-0">
            @forelse($modules as $module)
                <div class="module-item p-3 border-bottom">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="fw-bold mb-1">
                                <span class="badge bg-secondary me-2">{{ $module['ordre'] }}</span>
                                {{ $module['titre'] }}
                            </h6>
                            <span class="text-muted small">{{ count($module['ressources']) }} ressource(s)</span>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-outline-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#modalEditModule{{ $module['id'] }}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('formateur.modules.destroy', [$formation['id'], $module['id']]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill" onclick="return confirm('Supprimer ce module ?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Ressources du module --}}
                    @if(!empty($module['ressources']))
                        <div class="mt-2 ps-4">
                            @foreach($module['ressources'] as $ressource)
                                <div class="d-flex align-items-center gap-2 py-1">
                                    <i class="fas {{ $ressource['type'] == 'video' ? 'fa-play-circle' : ($ressource['type'] == 'pdf' ? 'fa-file-pdf' : ($ressource['type'] == 'diaporama' ? 'fa-slideshare' : 'fa-book')) }} text-primary" style="width: 20px;"></i>
                                    <span class="small">{{ $ressource['titre'] }}</span>
                                    <span class="badge bg-secondary ms-auto">{{ ucfirst($ressource['type']) }}</span>
                                    <form action="{{ route('formateur.ressources.destroy', $ressource['id']) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill" onclick="return confirm('Supprimer cette ressource ?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                            <div class="mt-2">
                                <button class="btn btn-sm btn-outline-success rounded-pill" data-bs-toggle="modal" data-bs-target="#modalAjoutRessource{{ $module['id'] }}">
                                    <i class="fas fa-plus-circle me-1"></i> Ajouter une ressource
                                </button>
                            </div>
                        </div>
                    @else
                        <div class="mt-2 ps-4 text-muted small">
                            <i>Aucune ressource pour ce module.</i>
                            <button class="btn btn-sm btn-outline-success rounded-pill ms-2" data-bs-toggle="modal" data-bs-target="#modalAjoutRessource{{ $module['id'] }}">
                                <i class="fas fa-plus-circle me-1"></i> Ajouter une ressource
                            </button>
                        </div>
                    @endif
                </div>
            @empty
                <div class="p-4 text-center text-muted">
                    Aucun module pour cette formation.
                    <br>
                    <button class="btn btn-sm btn-success rounded-pill mt-2" data-bs-toggle="modal" data-bs-target="#modalAjoutModule">
                        <i class="fas fa-plus-circle me-1"></i> Créer le premier module
                    </button>
                </div>
            @endforelse
        </div>
    </div>
@endsection

{{-- ============================================================
    MODALES
============================================================ --}}

{{-- MODALE AJOUT MODULE --}}
<div class="modal fade" id="modalAjoutModule" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('formateur.modules.store', $formation['id']) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-plus-circle me-2 text-success"></i>Ajouter un module</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Titre du module</label>
                        <input type="text" name="titre" class="form-control" placeholder="Ex: Introduction" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ordre</label>
                        <input type="number" name="ordre" class="form-control" placeholder="1, 2, 3..." value="{{ count($modules) + 1 }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODALES POUR CHAQUE MODULE : ÉDITION ET AJOUT RESSOURCE --}}
@foreach($modules as $module)
    {{-- Modale Édition Module --}}
    <div class="modal fade" id="modalEditModule{{ $module['id'] }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('formateur.modules.update', [$formation['id'], $module['id']]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fas fa-edit me-2 text-primary"></i>Modifier le module</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Titre</label>
                            <input type="text" name="titre" class="form-control" value="{{ $module['titre'] }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ordre</label>
                            <input type="number" name="ordre" class="form-control" value="{{ $module['ordre'] }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modale Ajout Ressource --}}
    <div class="modal fade" id="modalAjoutRessource{{ $module['id'] }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('formateur.ressources.store', $module['id']) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fas fa-plus-circle me-2 text-success"></i>Ajouter une ressource</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Titre</label>
                            <input type="text" name="titre" class="form-control" placeholder="Ex: Vidéo introduction" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Type</label>
                            <select name="type" class="form-select" required>
                                <option value="video">Vidéo</option>
                                <option value="pdf">PDF</option>
                                <option value="diaporama">Diaporama</option>
                                <option value="guide">Guide interactif</option>
                                <option value="lien">Lien externe</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">URL (ou chemin du fichier)</label>
                            <input type="text" name="url" class="form-control" placeholder="https://..." required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-success">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

{{-- MODALES POUR CHAQUE INSCRIT : DÉTAIL --}}
@foreach($inscrits as $inscrit)
    <div class="modal fade" id="modalInscrit{{ $inscrit['id'] }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-user me-2 text-primary"></i>{{ $inscrit['nom'] }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    {{-- On charge le contenu via AJAX ou directement --}}
                    <div id="inscritDetail{{ $inscrit['id'] }}">
                        <p class="text-muted">Chargement...</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

@push('js')
<script>
    // Chargement dynamique du détail d'un inscrit via AJAX
    document.querySelectorAll('[data-bs-toggle="modal"][data-bs-target^="#modalInscrit"]').forEach(btn => {
        btn.addEventListener('click', function() {
            const targetId = this.getAttribute('data-bs-target');
            const modal = document.querySelector(targetId);
            const container = modal.querySelector('[id^="inscritDetail"]');
            const inscritId = targetId.replace('#modalInscrit', '');
            if (container) {
                container.innerHTML = '<p class="text-muted">Chargement...</p>';
                fetch('/formateur/inscrits/' + inscritId)
                    .then(response => response.text())
                    .then(html => {
                        container.innerHTML = html;
                    })
                    .catch(err => {
                        container.innerHTML = '<p class="text-danger">Erreur de chargement.</p>';
                    });
            }
        });
    });
</script>
@endpush