{{-- resources/views/layouts/partials/_footer-aqua.blade.php --}}
<style>
    /* ============================================================
       FOOTER — AquaForm
    ============================================================ */
    .aq-footer {
        background    : #0F3B43;
        color         : rgba(255,255,255,.55);
        font-family   : 'Kumbh Sans', sans-serif;
        font-size     : 0.78rem;
        padding       : 0;
        margin-top    : auto;
        border-top    : 3px solid #1A7E86;
    }

    /* Bande supérieure colorée (ambiance eau) */
    .aq-footer-band {
        display        : flex;
        align-items    : stretch;
        height         : 4px;
    }
    .aq-footer-band span:nth-child(1) { flex: 1; background: #0F3B43; } /* Petrol */
    .aq-footer-band span:nth-child(2) { flex: 1; background: #1A7E86; } /* Teal */
    .aq-footer-band span:nth-child(3) { flex: 1; background: #EAA14F; } /* Amber */

    /* Corps du footer */
    .aq-footer-body {
        display        : flex;
        align-items    : center;
        justify-content: space-between;
        flex-wrap      : wrap;
        gap            : 1rem;
        padding        : 0.85rem 1.6rem;
    }

    /* Colonne gauche */
    .aq-footer-left {
        display    : flex;
        align-items: center;
        gap        : 0.75rem;
    }
    .aq-footer-logo {
        width          : 30px;
        height         : 30px;
        background     : #1A7E86;
        border-radius  : 50%;
        display        : flex;
        align-items    : center;
        justify-content: center;
        font-size      : 14px;
        color          : #EAA14F;
        flex-shrink    : 0;
    }
    .aq-footer-copy {
        line-height: 1.5;
    }
    .aq-footer-copy strong {
        color      : rgba(255,255,255,.85);
        font-weight: 700;
    }
    .aq-footer-copy small {
        display  : block;
        font-size: 0.68rem;
        color    : rgba(255,255,255,.35);
        margin-top: 1px;
    }

    /* Colonne droite */
    .aq-footer-right {
        display    : flex;
        align-items: center;
        gap        : 0.5rem;
        flex-wrap  : wrap;
    }
    .aq-footer-link {
        color          : rgba(255,255,255,.45);
        text-decoration: none;
        font-size      : 0.75rem;
        padding        : 0.25rem 0.6rem;
        border-radius  : 4px;
        transition     : color .15s, background .15s;
        display        : flex;
        align-items    : center;
        gap            : 0.3rem;
    }
    .aq-footer-link:hover {
        color     : rgba(255,255,255,.9);
        background: rgba(255,255,255,.06);
    }
    .aq-footer-link i { font-size: 0.7rem; }
    .aq-footer-sep {
        width     : 1px;
        height    : 14px;
        background: rgba(255,255,255,.12);
    }
    .aq-footer-version {
        display      : inline-flex;
        align-items  : center;
        gap          : 0.3rem;
        font-size    : 0.7rem;
        background   : rgba(255,255,255,.07);
        border       : 1px solid rgba(255,255,255,.1);
        border-radius: 100px;
        padding      : 0.2rem 0.6rem;
        color        : rgba(255,255,255,.4);
    }
    .aq-footer-version::before {
        content      : '';
        display      : inline-block;
        width        : 6px;
        height       : 6px;
        background   : #24A1A9;
        border-radius: 50%;
    }

    /* Dark theme */
    html[data-theme="dark"] .aq-footer { background: #082A2F; border-top-color: #1A7E86; }

    /* Responsive */
    @media (max-width: 640px) {
        .aq-footer-body {
            flex-direction: column;
            align-items   : flex-start;
            padding       : 0.85rem 1rem;
        }
        .aq-footer-right { gap: 0.3rem; }
    }
</style>

<footer class="aq-footer" role="contentinfo">

    {{-- Bande décorative aqua (3 couleurs) --}}
    <div class="aq-footer-band" aria-hidden="true">
        <span></span><span></span><span></span>
    </div>

    <div class="aq-footer-body">

        {{-- Gauche : logo + copyright --}}
        <div class="aq-footer-left">
            <div class="aq-footer-logo">
                <i class="fas fa-droplet"></i>
            </div>
            <div class="aq-footer-copy">
                <strong>AquaForm</strong> — Plateforme e-learning · &copy; {{ date('Y') }}
                <small>Formation en ligne pour les métiers de l'eau · Sécurité · Réglementation · Gestion des coûts</small>
            </div>
        </div>

        {{-- Droite : liens utiles + version --}}
        <div class="aq-footer-right">
            <a href="#" class="aq-footer-link">
                <i class="fas fa-question-circle"></i> Aide
            </a>
            <div class="aq-footer-sep"></div>
            <a href="#" class="aq-footer-link">
                <i class="fas fa-book-open"></i> Catalogue
            </a>
            <div class="aq-footer-sep"></div>
            <a href="#" class="aq-footer-link">
                <i class="fas fa-headset"></i> Support
            </a>
            <div class="aq-footer-sep"></div>
            <a href="#" class="aq-footer-link">
                <i class="fas fa-file-export"></i> Exporter
            </a>
            <div class="aq-footer-sep"></div>
            <span class="aq-footer-version">v1.0.0</span>
        </div>

    </div>
</footer>