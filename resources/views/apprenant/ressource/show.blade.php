@extends('layouts.app')

@section('title', $ressource['titre'] . ' — AquaForm')

@section('page_title', $ressource['titre'])
@section('page_icon', 'fa-play-circle')

@section('breadcrumb')
    <li><a href="{{ route('home') }}">Accueil</a></li>
    <li><a href="{{ route('apprenant.progression.index') }}">Ma progression</a></li>
    <li><a href="{{ route('apprenant.cours.show', $cours['id']) }}">{{ $cours['titre'] }}</a></li>
    <li class="active">{{ $ressource['titre'] }}</li>
@endsection

@section('page_actions')
    <a href="{{ route('apprenant.cours.show', $cours['id']) }}" class="btn btn-sm btn-outline-secondary rounded-pill">
        <i class="fas fa-arrow-left me-1"></i> Retour au cours
    </a>
@endsection

@section('contenu')
<div class="row g-4">
    {{-- Colonne principale --}}
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                {{-- Titre --}}
                <h4 class="fw-bold">{{ $ressource['titre'] }}</h4>
                <p class="text-muted">{{ $ressource['description'] ?? 'Aucune description disponible.' }}</p>

                {{-- ========== LECTEUR VIDÉO YOUTUBE AVEC CONTROLES ========== --}}
                <div class="video-wrapper mt-3 position-relative">
                    @php
                        // Extraire l'ID de la vidéo YouTube depuis l'URL
                        $videoId = null;
                        $url = $ressource['url'];
                        if (strpos($url, 'youtube.com/watch') !== false) {
                            parse_str(parse_url($url, PHP_URL_QUERY), $params);
                            $videoId = $params['v'] ?? null;
                        } elseif (strpos($url, 'youtu.be/') !== false) {
                            $videoId = substr($url, strpos($url, 'youtu.be/') + 9);
                        } elseif (strpos($url, 'youtube.com/embed/') !== false) {
                            $videoId = substr($url, strpos($url, 'embed/') + 6);
                        }
                    @endphp

                    @if($videoId)
                        {{-- Lecteur YouTube avec contrôles et bouton play --}}
                        <div class="ratio ratio-16x9">
                            <iframe id="youtubePlayer"
                                    src="https://www.youtube.com/embed/{{ $videoId }}?enablejsapi=1&rel=0&showinfo=0&modestbranding=1"
                                    allowfullscreen
                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                    loading="lazy">
                            </iframe>
                        </div>

                        {{-- Contrôles supplémentaires sous la vidéo --}}
                        <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                            <div>
                                <span class="badge bg-secondary"><i class="fas fa-clock me-1"></i> Durée : 10:30</span>
                                <span class="badge bg-secondary ms-2"><i class="fas fa-calendar-alt me-1"></i> Ajoutée le {{ now()->format('d/m/Y') }}</span>
                            </div>
                            <div class="d-flex gap-2">
                                <button class="btn btn-sm btn-outline-primary rounded-pill" id="playBtn">
                                    <i class="fas fa-play me-1"></i> Lecture
                                </button>
                                <button class="btn btn-sm btn-outline-secondary rounded-pill" id="pauseBtn">
                                    <i class="fas fa-pause me-1"></i> Pause
                                </button>
                            </div>
                        </div>
                    @else
                        {{-- Fallback si l'URL n'est pas reconnue --}}
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i> Impossible de lire cette vidéo. L'URL n'est pas valide.
                        </div>
                    @endif
                </div>

                {{-- Bouton "Marquer comme terminée" --}}
                @if(!$ressource['termine'])
                    <div class="mt-4">
                        <button class="btn btn-success rounded-pill px-4" id="markCompletedBtn">
                            <i class="fas fa-check-circle me-2"></i> Marquer comme terminée
                        </button>
                    </div>
                @else
                    <div class="mt-4">
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i> Ressource terminée
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Colonne latérale --}}
    <div class="col-lg-4">
        {{-- État de la ressource --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <h6 class="fw-bold">État de la ressource</h6>
                @if($ressource['termine'])
                    <div class="alert alert-success mb-0">
                        <i class="fas fa-check-circle me-1"></i> Terminée
                    </div>
                @else
                    <div class="alert alert-warning mb-0">
                        <i class="fas fa-hourglass-half me-1"></i> Non terminée
                    </div>
                @endif
            </div>
        </div>

        {{-- Progression du cours --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body text-center">
                <i class="fas fa-chart-line fa-2x text-primary opacity-50"></i>
                <h6 class="fw-bold mt-2">Progression du cours</h6>
                <h3 class="fw-bold">{{ $cours['progression'] }}%</h3>
                <div class="progress mt-2" style="height: 6px;">
                    <div class="progress-bar bg-success" style="width: {{ $cours['progression'] }}%;"></div>
                </div>
                <span class="text-muted small">{{ $cours['taux_completion'] ?? 0 }}% complété</span>
            </div>
        </div>

        {{-- Informations complémentaires --}}
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6 class="fw-bold">Informations</h6>
                <div class="d-flex justify-content-between py-1">
                    <span class="text-muted">Type</span>
                    <span class="fw-semibold">Vidéo</span>
                </div>
                <div class="d-flex justify-content-between py-1">
                    <span class="text-muted">Cours</span>
                    <span class="fw-semibold">{{ $cours['titre'] }}</span>
                </div>
                <div class="d-flex justify-content-between py-1">
                    <span class="text-muted">Format</span>
                    <span class="fw-semibold">YouTube</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ===== CONTROLE DE LA VIDÉO YOUTUBE VIA API =====
        var player;
        function onYouTubeIframeAPIReady() {
            var iframe = document.getElementById('youtubePlayer');
            if (iframe) {
                player = new YT.Player(iframe, {
                    events: {
                        'onReady': onPlayerReady
                    }
                });
            }
        }

        function onPlayerReady(event) {
            // La vidéo est prête
        }

        // Boutons Play / Pause
        document.getElementById('playBtn')?.addEventListener('click', function() {
            if (player && player.playVideo) {
                player.playVideo();
            } else {
                // Fallback : recharger l'iframe avec autoplay
                var iframe = document.getElementById('youtubePlayer');
                if (iframe) {
                    var src = iframe.src;
                    if (src.indexOf('autoplay=1') === -1) {
                        iframe.src = src + (src.indexOf('?') === -1 ? '?' : '&') + 'autoplay=1';
                    }
                }
            }
        });

        document.getElementById('pauseBtn')?.addEventListener('click', function() {
            if (player && player.pauseVideo) {
                player.pauseVideo();
            }
        });

        // ===== MARQUER COMME TERMINÉE =====
        const markBtn = document.getElementById('markCompletedBtn');
        if (markBtn) {
            markBtn.addEventListener('click', function(e) {
                e.preventDefault();
                if (confirm('Marquer cette ressource comme terminée ?')) {
                    fetch('{{ route('apprenant.ressource.mark-completed', $ressource['id']) }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Mettre à jour l'interface
                            const cardBody = markBtn.closest('.card-body');
                            // Supprimer le bouton et afficher le succès
                            markBtn.remove();
                            const alertDiv = document.createElement('div');
                            alertDiv.className = 'alert alert-success mt-3';
                            alertDiv.innerHTML = '<i class="fas fa-check-circle me-2"></i> Ressource terminée !';
                            cardBody.appendChild(alertDiv);
                            // Mettre à jour la progression du cours
                            const progressionSpan = document.querySelector('.fw-bold');
                            if (progressionSpan && data.progression) {
                                progressionSpan.textContent = data.progression + '%';
                                const progressBar = document.querySelector('.progress-bar');
                                if (progressBar) {
                                    progressBar.style.width = data.progression + '%';
                                }
                            }
                            toastr.success('Ressource marquée comme terminée. Progression mise à jour !');
                        }
                    })
                    .catch(error => {
                        toastr.error('Une erreur est survenue.');
                        console.error(error);
                    });
                }
            });
        }

        // ===== CHARGEMENT DE L'API YOUTUBE =====
        // Charger l'API YouTube si elle n'est pas déjà chargée
        if (typeof YT === 'undefined') {
            var tag = document.createElement('script');
            tag.src = 'https://www.youtube.com/iframe_api';
            var firstScriptTag = document.getElementsByTagName('script')[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
        } else {
            // Si l'API est déjà chargée, initialiser directement
            onYouTubeIframeAPIReady();
        }

        // Toastr (si non défini)
        if (typeof toastr !== 'undefined') {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                positionClass: 'toast-top-right',
                timeOut: 3000,
            };
        }
    });
</script>
@endpush