{{-- resources/views/layouts/partials/_header-aqua.blade.php --}}

<style>
    /* ============================================================
       STYLES (inchangés)
    ============================================================ */
    @import url('https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@300;400;500;600;700;800;900&display=swap');

    :root {
        --aq-primary: #0F3B43;
        --aq-primary-dark: #082A2F;
        --aq-secondary: #1A7E86;
        --aq-secondary-light: #24A1A9;
        --aq-accent: #EAA14F;
        --aq-accent-dark: #D48A3A;
        --aq-bg-top: var(--aq-primary);
        --aq-bg-nav: var(--aq-secondary);
        --aq-text-light: #ffffff;
        --aq-text-muted: rgba(255, 255, 255, 0.7);
        --aq-border-light: rgba(255, 255, 255, 0.1);

        --aq-drop-bg: #ffffff;
        --aq-drop-text: #161D1C;
        --aq-drop-hover: #E6F3F2;
        --aq-drop-border: #DFEAE8;
        --aq-drop-shadow: 0 10px 36px rgba(0, 0, 0, 0.13);

        --aq-radius: 6px;
        --aq-top-height: 54px;
        --aq-nav-height: 44px;
        --aq-font: 'Kumbh Sans', sans-serif;
        --aq-transition: 0.2s ease;
    }

    html[data-theme="dark"] {
        --aq-drop-bg: #162B1E;
        --aq-drop-text: #D4E8DA;
        --aq-drop-hover: #234733;
        --aq-drop-border: #2D4D3A;
        --aq-drop-shadow: 0 10px 36px rgba(0, 0, 0, 0.4);
        --aq-bg-top: #07140F;
        --aq-bg-nav: #1A4A3A;
    }

    .hroot *,
    .hroot *::before,
    .hroot *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    .hroot {
        font-family: var(--aq-font);
        position: sticky;
        top: 0;
        z-index: 1000;
        width: 100%;
        background: var(--aq-bg-top);
    }

    .htop {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        height: var(--aq-top-height);
        padding: 0 20px;
        border-bottom: 1px solid var(--aq-border-light);
    }

    .hbrand {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        flex-shrink: 0;
        color: var(--aq-text-light);
    }

    .hbrand-icon {
        width: 36px;
        height: 36px;
        background: var(--aq-accent);
        border-radius: var(--aq-radius);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: var(--aq-primary);
        flex-shrink: 0;
        transition: background var(--aq-transition);
    }

    .hbrand:hover .hbrand-icon {
        background: var(--aq-accent-dark);
    }

    .hbrand-title {
        font-size: 18px;
        font-weight: 800;
        color: var(--aq-text-light);
        letter-spacing: 0.3px;
        line-height: 1;
        display: block;
    }

    .hbrand-sub {
        font-size: 10px;
        color: var(--aq-text-muted);
        letter-spacing: 0.9px;
        text-transform: uppercase;
        line-height: 1;
        margin-top: 3px;
        display: block;
        font-weight: 300;
    }

    .hsearch-wrap {
        flex: 1;
        max-width: 400px;
        margin: 0 auto;
        position: relative;
    }

    .hsearch-input {
        width: 100%;
        padding: 0.5rem 1rem 0.5rem 2.4rem;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid var(--aq-border-light);
        border-radius: 100px;
        font-family: var(--aq-font);
        font-size: 0.82rem;
        color: var(--aq-text-light);
        outline: none;
        transition: background var(--aq-transition), border-color var(--aq-transition);
    }

    .hsearch-input::placeholder {
        color: rgba(255, 255, 255, 0.35);
    }

    .hsearch-input:focus {
        background: rgba(255, 255, 255, 0.13);
        border-color: rgba(234, 161, 79, 0.5);
    }

    .hsearch-ico {
        position: absolute;
        left: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--aq-text-muted);
        font-size: 0.78rem;
        pointer-events: none;
    }

    .htop-right {
        display: flex;
        align-items: center;
        gap: 4px;
        flex-shrink: 0;
    }

    .hicon-btn {
        width: 34px;
        height: 34px;
        border-radius: var(--aq-radius);
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid var(--aq-border-light);
        color: var(--aq-text-muted);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        cursor: pointer;
        transition: background var(--aq-transition), color var(--aq-transition);
        position: relative;
        text-decoration: none;
    }

    .hicon-btn:hover {
        background: rgba(255, 255, 255, 0.14);
        color: var(--aq-text-light);
    }

    .hnotif-dot {
        position: absolute;
        top: 7px;
        right: 7px;
        width: 7px;
        height: 7px;
        background: var(--aq-accent);
        border-radius: 50%;
        border: 1.5px solid var(--aq-primary);
    }

    .hsep {
        width: 1px;
        height: 24px;
        background: var(--aq-border-light);
        margin: 0 6px;
        flex-shrink: 0;
    }

    .havatar-wrap {
        position: relative;
    }

    .havatar-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 0 10px 0 6px;
        height: 36px;
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid var(--aq-border-light);
        border-radius: var(--aq-radius);
        cursor: pointer;
        transition: background var(--aq-transition);
    }

    .havatar-btn:hover {
        background: rgba(255, 255, 255, 0.14);
    }

    .havatar-circle {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background: var(--aq-accent);
        color: var(--aq-primary);
        font-size: 11px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .havatar-name {
        font-size: 12px;
        font-weight: 600;
        color: var(--aq-text-light);
        line-height: 1;
        display: block;
    }

    .havatar-role {
        font-size: 10px;
        color: var(--aq-text-muted);
        line-height: 1;
        margin-top: 2px;
        display: block;
        font-weight: 300;
    }

    .havatar-caret {
        font-size: 10px;
        color: var(--aq-text-muted);
        margin-left: 2px;
        transition: transform var(--aq-transition);
    }

    .havatar-wrap.open .havatar-caret {
        transform: rotate(180deg);
    }

    .huser-drop {
        position: absolute;
        top: calc(100% + 6px);
        right: 0;
        width: 240px;
        background: var(--aq-drop-bg);
        border-radius: var(--aq-radius);
        box-shadow: var(--aq-drop-shadow);
        border: 1px solid var(--aq-drop-border);
        display: none;
        z-index: 9999;
        overflow: hidden;
    }

    .havatar-wrap.open .huser-drop {
        display: block;
    }

    .hudrop-header {
        padding: 14px 16px;
        background: var(--aq-drop-hover);
        border-bottom: 1px solid var(--aq-drop-border);
    }

    .hudrop-name {
        font-size: 13px;
        font-weight: 700;
        color: var(--aq-drop-text);
    }

    .hudrop-email {
        font-size: 11px;
        color: #999;
        margin-top: 2px;
    }

    .hudrop-role {
        display: inline-block;
        margin-top: 6px;
        background: var(--aq-secondary-light);
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 20px;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .hudrop-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 16px;
        font-size: 13px;
        color: var(--aq-drop-text);
        text-decoration: none;
        transition: background var(--aq-transition);
        cursor: pointer;
        background: none;
        border: none;
        width: 100%;
        text-align: left;
        font-family: var(--aq-font);
    }

    .hudrop-item:hover {
        background: var(--aq-drop-hover);
    }

    .hudrop-item i {
        font-size: 13px;
        color: var(--aq-secondary);
        width: 16px;
        flex-shrink: 0;
    }

    .hudrop-item.danger {
        color: #c0392b;
    }

    .hudrop-item.danger i {
        color: #c0392b;
    }

    .hudrop-item.danger:hover {
        background: #fff5f5;
    }

    .hudrop-div {
        height: 1px;
        background: var(--aq-drop-border);
        margin: 4px 0;
    }

    .hnav {
        background: var(--aq-bg-nav);
        height: var(--aq-nav-height);
        display: flex;
        align-items: stretch;
        padding: 0 8px;
        position: relative;
        z-index: 900;
        overflow: visible;
    }

    .hnav-items {
        display: flex;
        align-items: stretch;
        flex: 1;
        min-width: 0;
    }

    .hnav-item {
        position: relative;
        display: flex;
        align-items: stretch;
        flex-shrink: 0;
    }

    .hnav-trigger {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 0 14px;
        color: rgba(255, 255, 255, 0.93);
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        white-space: nowrap;
        text-decoration: none;
        transition: background var(--aq-transition);
        font-family: var(--aq-font);
        border: none;
        background: transparent;
        height: 100%;
        user-select: none;
    }

    .hnav-trigger > i:not(.caret) {
        font-size: 13px;
    }

    .hnav-trigger .caret {
        font-size: 10px;
        opacity: 0.7;
        margin-left: 1px;
        transition: transform var(--aq-transition);
    }

    .hnav-item.open > .hnav-trigger .caret {
        transform: rotate(180deg);
    }

    .hnav-item:hover > .hnav-trigger,
    .hnav-item.open > .hnav-trigger {
        background: rgba(0, 0, 0, 0.15);
        color: #fff;
    }

    .hnav-item.active > .hnav-trigger {
        background: rgba(0, 0, 0, 0.22);
        color: #fff;
    }

    .hnav-drop {
        position: absolute;
        top: var(--aq-nav-height);
        left: 0;
        min-width: 250px;
        background: var(--aq-drop-bg);
        border-radius: 0 0 var(--aq-radius) var(--aq-radius);
        box-shadow: var(--aq-drop-shadow);
        border: 1px solid var(--aq-drop-border);
        border-top: 3px solid var(--aq-accent);
        z-index: 99999;
        padding: 5px 0;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-4px);
        transition: opacity 0.15s ease, transform 0.15s ease, visibility 0s linear 0.15s;
        pointer-events: none;
    }

    .hnav-item.open > .hnav-drop {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
        transition: opacity 0.15s ease, transform 0.15s ease, visibility 0s linear 0s;
        pointer-events: auto;
    }

    .hnav-drop-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 16px;
        font-size: 13px;
        font-weight: 400;
        color: var(--aq-drop-text);
        text-decoration: none;
        transition: background 0.12s, padding-left 0.12s;
        line-height: 1.3;
        font-family: var(--aq-font);
        white-space: nowrap;
        cursor: pointer;
        background: none;
        border: none;
        width: 100%;
        text-align: left;
    }

    .hnav-drop-item:hover {
        background: var(--aq-drop-hover);
        padding-left: 20px;
    }

    .hnav-drop-item i {
        font-size: 13px;
        color: var(--aq-secondary);
        width: 16px;
        flex-shrink: 0;
    }

    .hnav-drop-div {
        height: 1px;
        background: var(--aq-drop-border);
        margin: 5px 0;
    }

    .hnav-more {
        position: relative;
        display: flex;
        align-items: stretch;
        flex-shrink: 0;
        margin-left: auto;
    }

    .hnav-more > .hnav-drop {
        left: auto;
        right: 0;
        min-width: 270px;
    }

    .hnav-more-title {
        padding: 8px 16px 3px;
        font-size: 10px;
        text-transform: uppercase;
        color: #9ab5a2;
        letter-spacing: 0.8px;
        font-weight: 700;
        font-family: var(--aq-font);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .hnav-more-title i {
        font-size: 11px;
        color: var(--aq-accent);
    }

    .hhamburger {
        display: none;
        flex-direction: column;
        gap: 4px;
        justify-content: center;
        width: 34px;
        height: 34px;
        cursor: pointer;
        padding: 6px;
        border-radius: var(--aq-radius);
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid var(--aq-border-light);
        flex-shrink: 0;
        transition: background var(--aq-transition);
    }

    .hhamburger:hover {
        background: rgba(255, 255, 255, 0.14);
    }

    .hhamburger span {
        display: block;
        width: 100%;
        height: 2px;
        background: rgba(255, 255, 255, 0.8);
        border-radius: 2px;
        transition: transform 0.25s, opacity 0.25s;
    }

    .hhamburger.open span:nth-child(1) {
        transform: translateY(6px) rotate(45deg);
    }

    .hhamburger.open span:nth-child(2) {
        opacity: 0;
    }

    .hhamburger.open span:nth-child(3) {
        transform: translateY(-6px) rotate(-45deg);
    }

    @media (max-width: 1100px) {
        .hnav-trigger {
            padding: 0 11px;
            font-size: 12px;
        }
    }

    @media (max-width: 768px) {
        .hhamburger {
            display: flex;
        }

        .hbrand-sub {
            display: none;
        }

        .hsearch-wrap {
            display: none;
        }

        .hnav {
            height: 0;
            overflow: hidden;
            flex-direction: column;
            padding: 0;
            transition: height 0.3s ease;
            display: flex;
            background: var(--aq-bg-nav);
        }

        .hnav.mobile-open {
            height: auto;
            padding: 6px 0;
            overflow: visible;
        }

        .hnav-item {
            flex-direction: column;
            height: auto;
            width: 100%;
        }

        .hnav-trigger {
            padding: 12px 16px;
            justify-content: space-between;
            height: auto;
            width: 100%;
            background: transparent !important;
        }

        .hnav-trigger:hover {
            background: rgba(0, 0, 0, 0.1) !important;
        }

        .hnav-drop {
            position: static;
            box-shadow: none;
            border: none;
            border-top: 2px solid rgba(255, 255, 255, 0.25);
            border-radius: 0;
            background: rgba(0, 0, 0, 0.12);
            transform: none !important;
            opacity: 1 !important;
            visibility: visible !important;
            pointer-events: auto !important;
            display: none;
            width: 100%;
        }

        .hnav-item.open > .hnav-drop {
            display: block;
        }

        .hnav-drop-item {
            color: rgba(255, 255, 255, 0.9);
            white-space: normal;
            padding: 10px 16px 10px 32px;
        }

        .hnav-drop-item:hover {
            background: rgba(0, 0, 0, 0.12);
            padding-left: 36px;
        }

        .hnav-drop-item i {
            color: rgba(255, 255, 255, 0.7);
        }

        .hnav-drop-div {
            background: rgba(255, 255, 255, 0.15);
        }

        .huser-drop {
            right: -10px;
            width: 220px;
        }

        .hnav-more {
            display: none !important;
        }
    }

    @media (max-width: 400px) {
        .havatar-name,
        .havatar-role {
            display: none;
        }

        .havatar-btn {
            padding: 0 6px;
        }
    }
</style>

<div class="hroot" id="header-aqua" role="banner">
    {{-- TOP BAR --}}
    <div class="htop">
        <a href="{{ route('home') }}" class="hbrand" title="Accueil AquaForm">
            <div class="hbrand-icon"><i class="fas fa-droplet"></i></div>
            <div>
                <span class="hbrand-title">AquaForm</span>
                <span class="hbrand-sub">Plateforme e-learning</span>
            </div>
        </a>

        <div class="hsearch-wrap" role="search">
            <i class="fas fa-search hsearch-ico"></i>
            <input type="search" class="hsearch-input" placeholder="Rechercher une formation…" id="hsearchInput" aria-label="Rechercher une formation">
        </div>

        <div class="htop-right">
            <button class="hhamburger" id="hhamburger" aria-label="Ouvrir le menu" aria-expanded="false" aria-controls="hnav-main">
                <span></span><span></span><span></span>
            </button>
            <button class="hicon-btn" id="aqThemeToggle" aria-label="Mode sombre/clair">
                <i class="fas fa-moon" id="aqThemeIcon"></i>
            </button>
            <a href="#" class="hicon-btn" title="Notifications" aria-label="Notifications">
                <i class="fas fa-bell"></i>
                <span class="hnotif-dot" aria-hidden="true"></span>
            </a>
            <a href="#" class="hicon-btn" title="Aide" aria-label="Aide">
                <i class="fas fa-question-circle"></i>
            </a>
            <div class="hsep" aria-hidden="true"></div>

            <div class="havatar-wrap" id="havatar-wrap">
                <button class="havatar-btn" id="havatar-btn" aria-haspopup="true" aria-expanded="false" aria-label="Menu utilisateur">
                    <div class="havatar-circle">
                        {{ strtoupper(substr(session('auth_user.name', 'U'), 0, 2)) }}
                    </div>
                    <div>
                        <span class="havatar-name">{{ session('auth_user.name', 'Utilisateur') }}</span>
                        <span class="havatar-role">{{ session('auth_user.role', 'Invité') }}</span>
                    </div>
                    <i class="fas fa-chevron-down havatarcaret" aria-hidden="true"></i>
                </button>
                <div class="huser-drop" id="huser-drop" role="menu">
                    <div class="hudrop-header">
                        <div class="hudrop-name">{{ session('auth_user.name', 'Nom Prénom') }}</div>
                        <div class="hudrop-email">{{ session('auth_user.email', 'utilisateur@aquaform.fr') }}</div>
                        <div class="hudrop-role">{{ session('auth_user.role', 'Utilisateur') }}</div>
                    </div>
                    <a href="#" class="hudrop-item" role="menuitem"><i class="fas fa-user-circle"></i> Mon profil</a>
                    <a href="#" class="hudrop-item" role="menuitem"><i class="fas fa-cog"></i> Paramètres</a>
                    <div class="hudrop-div"></div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="hudrop-item danger" role="menuitem">
                            <i class="fas fa-sign-out-alt"></i> Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- NAV BAR --}}
    <nav class="hnav" id="hnav-main" aria-label="Navigation principale">
        <div class="hnav-items" id="hnav-items">

            @php $role = session('auth_user.role', null); @endphp

            {{-- =============================================
                MENU APPRENANT (exclusif)
            ============================================= --}}
            @if($role === 'apprenant')
                <div class="hnav-item">
                    <a href="{{ route('apprenant.dashboard') }}" class="hnav-trigger">
                        <i class="fas fa-home"></i> Tableau de bord
                    </a>
                </div>
                <div class="hnav-item">
                    <a href="{{ route('apprenant.mes-cours') }}" class="hnav-trigger" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-book-open"></i> Mes cours 
                    </a>
                    
                </div>
                <div class="hnav-item">
                    <a href="#" class="hnav-trigger" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-chart-line"></i> Progression <i class="fas fa-chevron-down caret"></i>
                    </a>
                    <div class="hnav-drop" role="menu">
                        <a href="{{ route('apprenant.progression.index') }}" class="hnav-drop-item"><i class="fas fa-chart-bar"></i> Vue d'ensemble</a>
                        <a href="{{ route('apprenant.historique.index') }}" class="hnav-drop-item"><i class="fas fa-history"></i> Historique</a>
                    </div>
                </div>
                <div class="hnav-item">
                    <a href="{{ route('apprenant.certificats.index') }}" class="hnav-trigger"><i class="fas fa-certificate"></i> Certificats</a>
                </div>
                <div class="hnav-item">
                    <a href="{{ route('apprenant.catalogue.index') }}" class="hnav-trigger"><i class="fas fa-search"></i> Catalogue</a>
                </div>
            @endif

            {{-- =============================================
                MENU FORMATEUR (exclusif)
            ============================================= --}}
            @if($role === 'formateur')
                <div class="hnav-item">
                    <a href="{{ route('formateur.dashboard') }}" class="hnav-trigger">
                        <i class="fas fa-chalkboard-teacher"></i> Tableau de bord
                    </a>
                </div>
                <div class="hnav-item">
                    <a href="#" class="hnav-trigger" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-graduation-cap"></i> Mes formations <i class="fas fa-chevron-down caret"></i>
                    </a>
                    <div class="hnav-drop" role="menu">
                        <a href="{{ route('formateur.formations.index') }}" class="hnav-drop-item"><i class="fas fa-list-ul"></i> Toutes</a>
                        <a href="{{ route('formateur.formations.create') }}" class="hnav-drop-item"><i class="fas fa-plus-circle"></i> Nouvelle formation</a>
                    </div>
                </div>
                <div class="hnav-item">
                    <a href="{{ route('formateur.participants.index') }}" class="hnav-trigger"><i class="fas fa-users"></i> Participants</a>
                </div>
                <div class="hnav-item">
                    <a href="#" class="hnav-trigger" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-question-circle"></i> Quiz <i class="fas fa-chevron-down caret"></i>
                    </a>
                    <div class="hnav-drop" role="menu">
                        <a href="{{ route('formateur.quiz.index') }}" class="hnav-drop-item"><i class="fas fa-list-ul"></i> Gérer</a>
                        <a href="{{ route('formateur.quiz.create') }}" class="hnav-drop-item"><i class="fas fa-plus-circle"></i> Créer un quiz</a>
                    </div>
                </div>
            @endif

            {{-- =============================================
                MENU ADMINISTRATEUR (exclusif)
            ============================================= --}}
            @if($role === 'admin')
                <div class="hnav-item">
                    <a href="{{ route('admin.dashboard') }}" class="hnav-trigger">
                        <i class="fas fa-shield-alt"></i> Tableau de bord
                    </a>
                </div>
                <div class="hnav-item">
                    <a href="#" class="hnav-trigger" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-tasks"></i> Gestion <i class="fas fa-chevron-down caret"></i>
                    </a>
                    <div class="hnav-drop" role="menu">
<a href="{{ route('admin.users.index') }}" class="hnav-drop-item">
    <i class="fas fa-users"></i> Utilisateurs
</a>
                      <a href="{{ route('admin.formations.index') }}" class="hnav-drop-item">
    <i class="fas fa-graduation-cap"></i> Formations
</a>
                        <a href="{{ route('admin.modules.index') }}" class="hnav-drop-item"><i class="fas fa-cubes"></i> Modules</a>
                        <a href="{{ route('admin.categories.index') }}" class="hnav-drop-item"><i class="fas fa-tags"></i> Catégories</a>
                        <div class="hnav-drop-div"></div>
                        <a href="{{ route('admin.inscriptions.index') }}" class="hnav-drop-item">
    <i class="fas fa-pen-alt"></i> Inscriptions
</a>
                    
                    </div>
                </div>
                <div class="hnav-item">
                    <a href="#" class="hnav-trigger" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-chart-pie"></i> Rapports <i class="fas fa-chevron-down caret"></i>
                    </a>
                    <div class="hnav-drop" role="menu">
<a href="{{ route('admin.statistiques.index') }}" class="hnav-drop-item">
    <i class="fas fa-chart-line"></i> Statistiques globales
</a>
                      <a href="{{ route('admin.statistiques.completion') }}" class="hnav-drop-item">
    <i class="fas fa-check-double"></i> Taux de complétion
</a>
                    </div>
                </div>
                <div class="hnav-item">
                    <a href="{{ route('admin.journal.index') }}" class="hnav-trigger"><i class="fas fa-history"></i> Journal</a>
                
                
                </div>
                <div class="hnav-item">
                    <a href="{{ route('admin.parametres.index') }}" class="hnav-trigger"><i class="fas fa-cog"></i> Paramètres</a>
                </div>
            @endif

            {{-- MENU INVITÉ (non connecté) --}}
            @if(!$role)
                <div class="hnav-item">
                    <a href="{{ route('login') }}" class="hnav-trigger"><i class="fas fa-sign-in-alt"></i> Connexion</a>
                </div>
                <div class="hnav-item">
                    <a href="{{ route('register') }}" class="hnav-trigger"><i class="fas fa-user-plus"></i> Inscription</a>
                </div>
            @endif

        </div>
    </nav>
</div>

<script>
    (function() {
        'use strict';

        const navItems = document.getElementById('hnav-items');
        const isMobile = () => window.innerWidth <= 768;

        const closeAll = () => {
            document.querySelectorAll('.hnav-item.open').forEach(el => {
                el.classList.remove('open');
                const trigger = el.querySelector(':scope > .hnav-trigger');
                if (trigger) trigger.setAttribute('aria-expanded', 'false');
            });
        };

        const openItem = (item) => {
            item.classList.add('open');
            const trigger = item.querySelector(':scope > .hnav-trigger');
            if (trigger) trigger.setAttribute('aria-expanded', 'true');
        };

        const bindNavItem = (item) => {
            if (item._bound) return;
            item._bound = true;

            const trigger = item.querySelector(':scope > .hnav-trigger');
            const dropdown = item.querySelector(':scope > .hnav-drop');
            if (!trigger || !dropdown) return;

            item.addEventListener('mouseenter', () => {
                if (isMobile()) return;
                closeAll();
                openItem(item);
            });

            item.addEventListener('mouseleave', () => {
                if (isMobile()) return;
                item.classList.remove('open');
                trigger.setAttribute('aria-expanded', 'false');
            });

            trigger.addEventListener('click', (e) => {
                if (!isMobile()) return;
                e.preventDefault();
                const wasOpen = item.classList.contains('open');
                closeAll();
                if (!wasOpen) openItem(item);
            });
        };

        const bindAllNavItems = () => {
            document.querySelectorAll('#hnav-items > .hnav-item:not(.hnav-more)').forEach(bindNavItem);
        };

        const rebuildMoreMenu = () => {
            const oldMore = navItems ? navItems.querySelector('.hnav-more') : null;
            if (oldMore) oldMore.remove();

            const items = Array.from((navItems || document).querySelectorAll(':scope > .hnav-item'));
            items.forEach(el => {
                el.style.display = '';
                el._bound = false;
            });

            if (isMobile()) {
                bindAllNavItems();
                return;
            }

            requestAnimationFrame(() => {
                const navBar = document.querySelector('.hnav');
                const available = navBar ? navBar.clientWidth - 100 : 9999;
                let total = 0;
                const hidden = [];

                items.forEach(item => {
                    total += item.offsetWidth;
                    if (total > available) {
                        hidden.push(item);
                        item.style.display = 'none';
                    }
                });

                if (hidden.length && navItems) {
                    const more = document.createElement('div');
                    more.className = 'hnav-item hnav-more';

                    const mTrig = document.createElement('a');
                    mTrig.href = '#';
                    mTrig.className = 'hnav-trigger';
                    mTrig.setAttribute('aria-haspopup', 'true');
                    mTrig.setAttribute('aria-expanded', 'false');
                    mTrig.innerHTML = '<i class="fas fa-ellipsis-h"></i>&nbsp;Plus&nbsp;<i class="fas fa-chevron-down caret"></i>';

                    const mDrop = document.createElement('div');
                    mDrop.className = 'hnav-drop';
                    mDrop.setAttribute('role', 'menu');

                    hidden.forEach((item, idx) => {
                        const trig = item.querySelector(':scope > .hnav-trigger');
                        const drop = item.querySelector(':scope > .hnav-drop');
                        if (!trig) return;

                        const icon = trig.querySelector('i:not(.caret)');
                        const label = trig.textContent.trim();

                        if (drop) {
                            const section = document.createElement('div');
                            section.className = 'hnav-more-title';
                            section.innerHTML = (icon ? icon.outerHTML : '') + ' ' + label;
                            mDrop.appendChild(section);
                            drop.querySelectorAll('.hnav-drop-item, .hnav-drop-div').forEach(n => {
                                mDrop.appendChild(n.cloneNode(true));
                            });
                            if (idx < hidden.length - 1) {
                                const sep = document.createElement('div');
                                sep.className = 'hnav-drop-div';
                                mDrop.appendChild(sep);
                            }
                        } else {
                            const a = document.createElement('a');
                            a.href = trig.getAttribute('href') || '#';
                            a.className = 'hnav-drop-item';
                            a.innerHTML = (icon ? icon.outerHTML : '') + ' ' + label;
                            mDrop.appendChild(a);
                        }
                    });

                    more.appendChild(mTrig);
                    more.appendChild(mDrop);
                    navItems.appendChild(more);

                    more.addEventListener('mouseenter', () => {
                        if (isMobile()) return;
                        closeAll();
                        openItem(more);
                    });

                    more.addEventListener('mouseleave', () => {
                        if (isMobile()) return;
                        more.classList.remove('open');
                        mTrig.setAttribute('aria-expanded', 'false');
                    });

                    mTrig.addEventListener('click', (e) => {
                        e.preventDefault();
                        if (!isMobile()) return;
                        const wasOpen = more.classList.contains('open');
                        closeAll();
                        if (!wasOpen) openItem(more);
                    });
                }
                bindAllNavItems();
            });
        };

        // Avatar dropdown
        const avatarWrap = document.getElementById('havatar-wrap');
        const avatarBtn = document.getElementById('havatar-btn');
        if (avatarWrap && avatarBtn) {
            const toggleAvatar = (open) => {
                avatarWrap.classList.toggle('open', open);
                avatarBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
            };

            avatarWrap.addEventListener('mouseenter', () => toggleAvatar(true));
            avatarWrap.addEventListener('mouseleave', () => toggleAvatar(false));
            avatarBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                const isOpen = avatarWrap.classList.contains('open');
                toggleAvatar(!isOpen);
            });

            document.addEventListener('click', (e) => {
                if (!avatarWrap.contains(e.target)) toggleAvatar(false);
            });
        }

        // Hamburger
        const hamburger = document.getElementById('hhamburger');
        const nav = document.getElementById('hnav-main');
        if (hamburger && nav) {
            hamburger.addEventListener('click', () => {
                const isOpen = nav.classList.toggle('mobile-open');
                hamburger.classList.toggle('open', isOpen);
                hamburger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            });
        }

        // Thème
        const themeBtn = document.getElementById('aqThemeToggle');
        const themeIcon = document.getElementById('aqThemeIcon');

        const applyTheme = (dark) => {
            document.documentElement.setAttribute('data-theme', dark ? 'dark' : 'light');
            if (themeIcon) {
                themeIcon.className = dark ? 'fas fa-sun' : 'fas fa-moon';
            }
            try {
                localStorage.setItem('aq-theme', dark ? 'dark' : 'light');
            } catch (_) { /* ignore */ }
        };

        if (themeBtn) {
            try {
                const saved = localStorage.getItem('aq-theme');
                if (saved) applyTheme(saved === 'dark');
            } catch (_) { /* ignore */ }

            themeBtn.addEventListener('click', () => {
                const current = document.documentElement.getAttribute('data-theme');
                applyTheme(current !== 'dark');
            });
        }

        // Surbrillance du lien actif
        const highlightActive = () => {
            const currentPath = window.location.pathname;
            document.querySelectorAll('.hnav-drop-item, #hnav-items > .hnav-item > .hnav-trigger[href]').forEach(el => {
                const href = el.getAttribute('href');
                if (href && href !== '#' && href === currentPath) {
                    const parent = el.closest('.hnav-item');
                    if (parent) parent.classList.add('active');
                }
            });
        };

        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(rebuildMoreMenu, 200);
        });

        rebuildMoreMenu();
        highlightActive();

        document.querySelectorAll('.hnav-item.active').forEach(item => {
            if (isMobile()) openItem(item);
        });

    })();
</script>