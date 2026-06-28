<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AquaForm | Connexion</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Kumbh Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <style>
        /* ============================================================
           RESET & VARIABLES
        ============================================================ */
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --petrol: #0F3B43;
            --teal: #1A7E86;
            --teal-light: #24A1A9;
            --teal-mist: #E6F3F2;
            --amber: #EAA14F;
            --amber-dark: #D48A3A;
            --sand: #FAF8F4;
            --ink: #161D1C;
            --ink-soft: #556B67;
            --mist: #DFEAE8;
            --white: #FFFFFF;
            --danger: #c0392b;
            --success: #1a6e40;
            --radius-sm: 8px;
            --radius-md: 16px;
            --radius-lg: 24px;
            --font: 'Kumbh Sans', sans-serif;
            --shadow: 0 10px 30px rgba(15, 59, 67, 0.08);
            --transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: var(--font);
            background: var(--sand);
            color: var(--ink);
            min-height: 100vh;
            display: flex;
            overflow: hidden;
        }

        /* ===================== PANNEAU GAUCHE ===================== */
        .left-panel {
            flex: 0 0 58%;
            background: linear-gradient(160deg, var(--petrol) 0%, #082A2F 100%);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 3rem 3.5rem 0;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse at 80% 10%, rgba(26, 126, 134, 0.15) 0%, transparent 55%),
                radial-gradient(ellipse at 10% 90%, rgba(15, 59, 67, 0.6) 0%, transparent 60%);
            pointer-events: none;
        }

        .panel-header { position: relative; z-index: 2; }

        .agency-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.15);
            color: rgba(255,255,255,0.9);
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 0.45rem 1rem;
            border-radius: 100px;
            margin-bottom: 2.5rem;
        }
        .agency-badge .dot {
            width: 6px;
            height: 6px;
            background: var(--amber);
            border-radius: 50%;
            animation: pulse-dot 2s ease-in-out infinite;
        }
        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50%       { opacity: 0.5; transform: scale(0.8); }
        }

        .panel-title {
            font-size: 2.4rem;
            font-weight: 900;
            color: var(--white);
            line-height: 1.2;
            margin-bottom: 1.2rem;
            max-width: 480px;
        }
        .panel-title .accent { color: var(--amber); }

        .panel-desc {
            font-size: 0.92rem;
            color: rgba(255,255,255,0.75);
            line-height: 1.7;
            max-width: 440px;
            margin-bottom: 2.5rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: var(--radius-md);
            overflow: hidden;
            max-width: 440px;
            position: relative;
            z-index: 2;
        }
        .stat-cell {
            padding: 1.1rem 1.2rem;
            background: rgba(255,255,255,0.03);
        }
        .stat-cell:hover { background: rgba(255,255,255,0.06); }
        .stat-num {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--amber);
            line-height: 1;
            margin-bottom: 0.3rem;
        }
        .stat-label {
            font-size: 0.7rem;
            font-weight: 500;
            color: rgba(255,255,255,0.65);
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        /* Scène illustration (identique) */
        .illustration-scene {
            position: relative;
            z-index: 1;
            margin-top: auto;
            height: 260px;
            display: flex;
            align-items: flex-end;
            overflow: visible;
        }
        .illustration-scene svg { width: 100%; height: 100%; }

        /* Pilules flottantes */
        .module-pills {
            position: absolute;
            z-index: 3;
            top: 30%;
            right: -18px;
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
        }
        .pill {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 100px;
            padding: 0.5rem 1rem 0.5rem 0.6rem;
            color: white;
            font-size: 0.75rem;
            font-weight: 500;
            white-space: nowrap;
            animation: float-pill 4s ease-in-out infinite;
        }
        .pill:nth-child(2) { animation-delay: 1.3s; }
        .pill:nth-child(3) { animation-delay: 2.6s; }
        .pill:nth-child(4) { animation-delay: 3.9s; }
        @keyframes float-pill {
            0%, 100% { transform: translateY(0); }
            50%       { transform: translateY(-5px); }
        }
        .pill-icon {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            flex-shrink: 0;
        }
        .pill-icon.blue   { background: var(--teal); }
        .pill-icon.amber  { background: var(--amber); }
        .pill-icon.teal   { background: #1a7a6e; }
        .pill-icon.purple { background: #6b4aab; }

        /* ===================== PANNEAU DROIT ===================== */
        .right-panel {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background: var(--sand);
            position: relative;
        }
        .right-panel::before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            width: 1px;
            background: linear-gradient(to bottom, transparent, var(--mist) 30%, var(--mist) 70%, transparent);
        }

        .form-card {
            width: 100%;
            max-width: 400px;
            animation: slide-up 0.7s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        }
        @keyframes slide-up {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .form-eyebrow {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--teal);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.8rem;
        }
        .form-eyebrow::before {
            content: '';
            display: block;
            width: 20px;
            height: 2px;
            background: var(--teal);
            border-radius: 2px;
        }
        .form-title {
            font-size: 1.9rem;
            font-weight: 900;
            color: var(--petrol);
            line-height: 1.2;
            margin-bottom: 0.5rem;
        }
        .form-subtitle {
            font-size: 0.85rem;
            color: var(--ink-soft);
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        /* Alerte erreurs Laravel */
        .alert {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            background: #fdf2f2;
            border-left: 3px solid var(--danger);
            border-radius: var(--radius-sm);
            padding: 0.85rem 1rem;
            margin-bottom: 1.5rem;
            font-size: 0.82rem;
            color: #7b2020;
        }
        .alert i { margin-top: 2px; flex-shrink: 0; }

        /* ---- Sélecteur de rôle ---- */
        .role-selector {
            display: flex;
            gap: 0.5rem;
            background: var(--white);
            border: 1.5px solid var(--mist);
            border-radius: var(--radius-md);
            padding: 4px;
            margin-bottom: 1.8rem;
        }
        .role-btn {
            flex: 1;
            padding: 0.55rem 0.4rem;
            border: none;
            border-radius: 12px;
            background: transparent;
            font-family: var(--font);
            font-size: 0.72rem;
            font-weight: 600;
            color: var(--ink-soft);
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
        }
        .role-btn i { font-size: 0.95rem; }
        .role-btn.active {
            background: var(--petrol);
            color: var(--white);
        }
        .role-btn:hover:not(.active) { background: var(--teal-mist); }

        /* ---- Champs ---- */
        .field { margin-bottom: 1.2rem; }
        .field-label {
            display: block;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 0.5rem;
        }
        .input-wrap { position: relative; }
        .input-wrap .ico {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--ink-soft);
            font-size: 0.85rem;
            pointer-events: none;
        }
        .field-input {
            width: 100%;
            padding: 0.85rem 1rem 0.85rem 2.7rem;
            border: 1.5px solid var(--mist);
            border-radius: var(--radius-md);
            background: var(--white);
            font-size: 0.88rem;
            color: var(--ink);
            font-family: var(--font);
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .field-input::placeholder { color: var(--ink-soft); }
        .field-input:focus {
            outline: none;
            border-color: var(--teal);
            box-shadow: 0 0 0 3px rgba(26, 126, 134, 0.12);
        }
        .field-input.is-invalid { border-color: var(--danger); }
        .field-error {
            color: var(--danger);
            font-size: 0.75rem;
            margin-top: 0.3rem;
            display: block;
        }
        .toggle-pw {
            position: absolute;
            right: 0.9rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--ink-soft);
            cursor: pointer;
            font-size: 0.85rem;
            padding: 0.3rem;
        }
        .toggle-pw:hover { color: var(--ink); }

        /* ---- Options ---- */
        .options-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.78rem;
            margin: 1.2rem 0 1.8rem;
        }
        .check-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            color: var(--ink-soft);
            font-weight: 500;
            user-select: none;
        }
        .check-label input[type="checkbox"] {
            width: 15px;
            height: 15px;
            accent-color: var(--teal);
            cursor: pointer;
        }
        .forgot-link {
            color: var(--teal);
            text-decoration: none;
            font-weight: 600;
        }
        .forgot-link:hover { text-decoration: underline; }

        /* ---- Bouton connexion ---- */
        .btn-login {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            width: 100%;
            padding: 0.95rem;
            background: var(--teal);
            color: var(--white);
            border: none;
            border-radius: var(--radius-md);
            cursor: pointer;
            font-family: var(--font);
            font-size: 0.9rem;
            font-weight: 700;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
            letter-spacing: 0.02em;
        }
        .btn-login:hover {
            background: var(--teal-light);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px -6px rgba(26, 126, 134, 0.45);
        }
        .btn-login:active { transform: translateY(0); }
        .btn-login i { font-size: 0.8rem; transition: transform 0.2s; }
        .btn-login:hover i { transform: translateX(4px); }
        .btn-login:disabled { opacity: 0.7; cursor: not-allowed; }

        /* ---- Lien d'inscription (amélioré) ---- */
        .register-link {
            margin-top: 1.2rem;
            text-align: center;
            font-size: 0.9rem;
            color: var(--ink-soft);
        }
        .register-link a {
            color: var(--teal);
            font-weight: 700;
            text-decoration: none;
            border-bottom: 1.5px solid transparent;
            transition: 0.2s;
        }
        .register-link a:hover {
            border-bottom-color: var(--teal);
            color: var(--teal-light);
        }

        /* ---- Modules chips ---- */
        .modules-hint {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-top: 2rem;
        }
        .modules-hint hr {
            flex: 1;
            border: none;
            border-top: 1px solid var(--mist);
        }
        .modules-hint span {
            font-size: 0.7rem;
            color: var(--ink-soft);
            font-weight: 500;
            white-space: nowrap;
        }
        .modules-row {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1rem;
            flex-wrap: wrap;
        }
        .module-chip {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.68rem;
            font-weight: 600;
            color: var(--ink-soft);
            background: var(--white);
            border: 1px solid var(--mist);
            border-radius: 100px;
            padding: 0.35rem 0.75rem;
        }
        .module-chip i { font-size: 0.62rem; color: var(--teal); }

        /* ---- Pied de page ---- */
        .form-footer {
            margin-top: 1.5rem;
            text-align: center;
            font-size: 0.68rem;
            color: var(--ink-soft);
            line-height: 1.6;
        }
        .form-footer strong { color: var(--ink); }

        /* ===================== MODAL ===================== */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 59, 67, 0.6);
            backdrop-filter: blur(6px);
            z-index: 999;
            align-items: center;
            justify-content: center;
        }
        .modal-overlay.open { display: flex; }
        .modal-box {
            background: var(--white);
            border-radius: var(--radius-lg);
            width: 90%;
            max-width: 400px;
            overflow: hidden;
            box-shadow: 0 30px 60px rgba(0,0,0,0.25);
            animation: slide-up 0.3s ease forwards;
        }
        .modal-head {
            padding: 1.2rem 1.4rem;
            border-bottom: 1px solid var(--mist);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .modal-head h3 {
            font-size: 1rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }
        .modal-head h3 i { color: var(--amber); }
        .btn-close-modal {
            background: none;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            color: var(--ink-soft);
        }
        .modal-body {
            padding: 1.4rem;
            font-size: 0.85rem;
            color: var(--ink-soft);
            line-height: 1.7;
        }
        .modal-email-wrap { position: relative; margin-top: 1rem; }
        .modal-email-wrap .ico {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--ink-soft);
            font-size: 0.85rem;
            pointer-events: none;
        }
        .modal-email-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.6rem;
            border: 1.5px solid var(--mist);
            border-radius: var(--radius-md);
            background: var(--sand);
            font-size: 0.88rem;
            color: var(--ink);
            font-family: var(--font);
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .modal-email-input::placeholder { color: var(--ink-soft); }
        .modal-email-input:focus {
            outline: none;
            border-color: var(--teal);
            box-shadow: 0 0 0 3px rgba(26, 126, 134, 0.12);
        }
        .modal-foot {
            padding: 1rem 1.4rem;
            border-top: 1px solid var(--mist);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 0.75rem;
        }
        .btn-modal-close {
            padding: 0.5rem 1.2rem;
            border-radius: 100px;
            border: 1.5px solid var(--mist);
            background: var(--white);
            font-family: var(--font);
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            color: var(--ink-soft);
        }
        .btn-modal-close:hover { background: var(--sand); }
        .btn-modal-send {
            padding: 0.5rem 1.4rem;
            border-radius: 100px;
            border: none;
            background: var(--teal);
            font-family: var(--font);
            font-size: 0.8rem;
            font-weight: 700;
            cursor: pointer;
            color: var(--white);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: background 0.2s;
        }
        .btn-modal-send:hover { background: var(--teal-light); }

        /* ===================== RESPONSIVE ===================== */
        @media (max-width: 860px) {
            body { flex-direction: column; overflow: auto; }
            .left-panel {
                flex: 0 0 auto;
                padding: 2rem 1.5rem 0;
                min-height: 300px;
            }
            .module-pills { display: none; }
            .right-panel { padding: 2rem 1.5rem; }
            .panel-title { font-size: 1.8rem; }
            .illustration-scene { height: 160px; }
        }
        @media (max-width: 480px) {
            .stats-grid { grid-template-columns: repeat(3, 1fr); }
            .role-btn { font-size: 0.65rem; }
        }
    </style>
</head>

<body>

{{-- ===================== MODAL MOT DE PASSE OUBLIÉ ===================== --}}
<div class="modal-overlay" id="forgotModal">
    <div class="modal-box">
        <div class="modal-head">
            <h3><i class="fas fa-envelope-open-text"></i> Réinitialisation du mot de passe</h3>
            <button class="btn-close-modal" id="modalClose" aria-label="Fermer">&times;</button>
        </div>
        <div class="modal-body">
            Saisissez votre adresse e-mail ci-dessous. Vous recevrez un lien pour réinitialiser votre mot de passe (vérifiez également vos spams).
            <div class="modal-email-wrap">
                <i class="ico fas fa-envelope"></i>
                <input type="email" id="resetEmail" class="modal-email-input" placeholder="votre.email@exemple.com">
            </div>
        </div>
        <div class="modal-foot">
            <button class="btn-modal-close" id="modalCancel">Annuler</button>
            <button class="btn-modal-send" id="modalSend">
                <i class="fas fa-paper-plane"></i> Envoyer le lien
            </button>
        </div>
    </div>
</div>

{{-- ===================== PANNEAU GAUCHE ===================== --}}
<div class="left-panel">
    <div class="panel-header">
        <div class="agency-badge">
            <span class="dot"></span>
            AquaForm — Plateforme e-learning
        </div>
        <h1 class="panel-title">
            Apprendre,<br>
            <span class="accent">progresser ensemble</span>
        </h1>
        <p class="panel-desc">
            Accédez à vos cours, suivez votre progression, passez vos évaluations et obtenez vos certificats de complétion depuis une plateforme centralisée.
        </p>
        <div class="stats-grid">
            <div class="stat-cell">
                <div class="stat-num">3</div>
                <div class="stat-label">Niveaux d'accès</div>
            </div>
            <div class="stat-cell">
                <div class="stat-num">100%</div>
                <div class="stat-label">En ligne</div>
            </div>
            <div class="stat-cell">
                <div class="stat-num">24/7</div>
                <div class="stat-label">Disponibilité</div>
            </div>
        </div>
    </div>

    <div class="illustration-scene">
        <svg viewBox="0 0 760 260" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMax meet">
            <!-- Sol / fond -->
            <rect x="0" y="200" width="760" height="60" rx="4" fill="rgba(10,20,60,0.35)"/>
            <!-- Bureau / table -->
            <rect x="120" y="170" width="520" height="14" rx="6" fill="rgba(200,180,120,0.35)"/>
            <rect x="148" y="184" width="10" height="28" rx="3" fill="rgba(200,180,120,0.2)"/>
            <rect x="602" y="184" width="10" height="28" rx="3" fill="rgba(200,180,120,0.2)"/>

            <!-- Moniteur -->
            <rect x="290" y="78" width="180" height="112" rx="10" fill="rgba(255,255,255,0.08)" stroke="rgba(255,255,255,0.2)" stroke-width="1.5"/>
            <rect x="296" y="84" width="168" height="90" rx="6" fill="rgba(26,126,134,0.48)"/>
            <rect x="296" y="84" width="168" height="14" rx="6" fill="rgba(15,59,67,0.7)"/>
            <circle cx="306" cy="91" r="3" fill="rgba(255,255,255,0.25)"/>
            <circle cx="315" cy="91" r="3" fill="rgba(255,255,255,0.25)"/>
            <circle cx="324" cy="91" r="3" fill="rgba(255,255,255,0.25)"/>
            <rect x="306" y="104" width="90" height="6" rx="3" fill="rgba(255,255,255,0.75)"/>
            <rect x="306" y="116" width="130" height="4" rx="2" fill="rgba(255,255,255,0.38)"/>
            <rect x="306" y="125" width="110" height="4" rx="2" fill="rgba(255,255,255,0.28)"/>
            <rect x="306" y="136" width="148" height="6" rx="3" fill="rgba(255,255,255,0.12)"/>
            <rect x="306" y="136" width="95" height="6" rx="3" fill="rgba(234,161,79,0.85)"/>
            <rect x="306" y="150" width="50" height="14" rx="5" fill="rgba(26,126,134,0.8)"/>
            <rect x="362" y="150" width="48" height="14" rx="5" fill="rgba(15,59,67,0.5)"/>
            <rect x="368" y="196" width="24" height="8" rx="3" fill="rgba(255,255,255,0.15)"/>
            <rect x="350" y="204" width="60" height="5" rx="2" fill="rgba(255,255,255,0.12)"/>

            <!-- Livres -->
            <rect x="158" y="138" width="18" height="40" rx="2" fill="rgba(26,126,134,0.65)"/>
            <rect x="178" y="143" width="16" height="35" rx="2" fill="rgba(234,161,79,0.75)"/>
            <rect x="196" y="136" width="20" height="42" rx="2" fill="rgba(26,110,64,0.65)"/>
            <rect x="218" y="146" width="14" height="32" rx="2" fill="rgba(107,74,171,0.65)"/>
            <rect x="234" y="150" width="16" height="28" rx="2" fill="rgba(26,126,134,0.45)"/>
            <rect x="254" y="155" width="4" height="23" rx="1" fill="rgba(255,255,255,0.1)"/>
            <rect x="510" y="143" width="18" height="35" rx="2" fill="rgba(234,161,79,0.6)"/>
            <rect x="530" y="136" width="20" height="42" rx="2" fill="rgba(26,126,134,0.55)"/>
            <rect x="552" y="148" width="15" height="30" rx="2" fill="rgba(26,110,64,0.6)"/>
            <rect x="569" y="140" width="18" height="38" rx="2" fill="rgba(107,74,171,0.5)"/>
            <rect x="589" y="152" width="14" height="26" rx="2" fill="rgba(234,161,79,0.45)"/>

            <!-- Casque audio -->
            <path d="M180 118 Q180 96 196 96 Q212 96 212 118" fill="none" stroke="rgba(255,255,255,0.22)" stroke-width="3"/>
            <rect x="175" y="114" width="6" height="14" rx="3" fill="rgba(255,255,255,0.28)"/>
            <rect x="211" y="114" width="6" height="14" rx="3" fill="rgba(255,255,255,0.28)"/>

            <!-- Tasse café -->
            <rect x="566" y="178" width="28" height="20" rx="5" fill="rgba(255,255,255,0.12)" stroke="rgba(255,255,255,0.2)" stroke-width="1"/>
            <path d="M594 184 Q605 184 605 190 Q605 196 594 196" fill="none" stroke="rgba(255,255,255,0.2)" stroke-width="1.5"/>
            <path d="M574 175 Q576 170 574 165" fill="none" stroke="rgba(255,255,255,0.15)" stroke-width="1.2" stroke-linecap="round"/>
            <path d="M580 174 Q582 168 580 162" fill="none" stroke="rgba(255,255,255,0.12)" stroke-width="1.2" stroke-linecap="round"/>

            <!-- Widgets flottants -->
            <rect x="50" y="88" width="92" height="48" rx="10" fill="rgba(255,255,255,0.07)" stroke="rgba(255,255,255,0.14)" stroke-width="1"/>
            <text x="60" y="103" fill="rgba(255,255,255,0.55)" font-size="7.5" font-family="Kumbh Sans,sans-serif" font-weight="600">Progression</text>
            <rect x="60" y="108" width="72" height="5" rx="2" fill="rgba(255,255,255,0.1)"/>
            <rect x="60" y="108" width="50" height="5" rx="2" fill="rgba(234,161,79,0.8)"/>
            <text x="115" y="114" fill="rgba(234,161,79,0.95)" font-size="6.5" font-family="Kumbh Sans,sans-serif" font-weight="700">70%</text>
            <text x="60" y="127" fill="rgba(255,255,255,0.38)" font-size="6.5" font-family="Kumbh Sans,sans-serif">3 cours complétés</text>

            <rect x="622" y="82" width="100" height="50" rx="10" fill="rgba(255,255,255,0.07)" stroke="rgba(255,255,255,0.14)" stroke-width="1"/>
            <text x="632" y="98" fill="rgba(255,255,255,0.55)" font-size="7.5" font-family="Kumbh Sans,sans-serif" font-weight="600">Certificat</text>
            <text x="632" y="112" fill="rgba(234,161,79,0.95)" font-size="8" font-weight="bold" font-family="Kumbh Sans,sans-serif">★ Obtenu</text>
            <text x="632" y="124" fill="rgba(255,255,255,0.35)" font-size="6.5" font-family="Kumbh Sans,sans-serif">Réglementation S1</text>

            <circle cx="88"  cy="60"  r="2"   fill="rgba(234,161,79,0.5)"/>
            <circle cx="672" cy="48"  r="2"   fill="rgba(234,161,79,0.5)"/>
            <circle cx="415" cy="32"  r="1.5" fill="rgba(255,255,255,0.4)"/>
            <circle cx="238" cy="52"  r="1.5" fill="rgba(255,255,255,0.35)"/>
            <circle cx="596" cy="66"  r="1.5" fill="rgba(255,255,255,0.35)"/>
            <circle cx="46"  cy="145" r="1.5" fill="rgba(255,255,255,0.2)"/>
            <circle cx="720" cy="130" r="1.5" fill="rgba(255,255,255,0.2)"/>
        </svg>

        <div class="module-pills">
            <div class="pill">
                <div class="pill-icon blue"><i class="fas fa-play-circle"></i></div>
                Vidéos de cours
            </div>
            <div class="pill">
                <div class="pill-icon amber"><i class="fas fa-question-circle"></i></div>
                Quiz & Évaluations
            </div>
            <div class="pill">
                <div class="pill-icon teal"><i class="fas fa-certificate"></i></div>
                Certificats
            </div>
            <div class="pill">
                <div class="pill-icon purple"><i class="fas fa-chart-line"></i></div>
                Suivi de progression
            </div>
        </div>
    </div>
</div>

{{-- ===================== PANNEAU DROIT ===================== --}}
<div class="right-panel">
    <div class="form-card">

        <p class="form-eyebrow">Espace sécurisé</p>
        <h2 class="form-title">Connexion</h2>
        <p class="form-subtitle">Accédez à votre espace de formation personnalisé.</p>

        @if ($errors->any())
            <div class="alert">
                <i class="fas fa-exclamation-circle"></i>
                <div>{{ $errors->first() }}</div>
            </div>
        @endif

        {{-- Sélecteur de rôle --}}
        <div class="role-selector" id="roleSelector">
            <button type="button" class="role-btn active" data-role="apprenant" data-placeholder="apprenant@exemple.com">
                <i class="fas fa-user-graduate"></i>
                Apprenant
            </button>
            <button type="button" class="role-btn" data-role="formateur" data-placeholder="formateur@exemple.com">
                <i class="fas fa-chalkboard-teacher"></i>
                Formateur
            </button>
            <button type="button" class="role-btn" data-role="admin" data-placeholder="admin@exemple.com">
                <i class="fas fa-user-shield"></i>
                Admin
            </button>
        </div>

        <form action="{{ route('login') }}" method="POST" id="loginForm">
            @csrf
            <input type="hidden" name="role" id="selectedRole" value="apprenant">

            <div class="field">
                <label class="field-label" for="email">Adresse e-mail</label>
                <div class="input-wrap">
                    <i class="ico fas fa-envelope"></i>
                    <input type="email" id="email" name="email"
                           class="field-input @error('email') is-invalid @enderror"
                           placeholder="apprenant@exemple.com"
                           autocomplete="email" value="{{ old('email') }}">
                </div>
                @error('email') <span class="field-error">{{ $message }}</span> @enderror
            </div>

            <div class="field">
                <label class="field-label" for="password">Mot de passe</label>
                <div class="input-wrap">
                    <i class="ico fas fa-lock"></i>
                    <input type="password" id="password" name="password"
                           class="field-input @error('password') is-invalid @enderror"
                           placeholder="••••••••" autocomplete="current-password">
                    <button type="button" class="toggle-pw" id="togglePw" aria-label="Afficher le mot de passe">
                        <i class="far fa-eye" id="eyeIcon"></i>
                    </button>
                </div>
                @error('password') <span class="field-error">{{ $message }}</span> @enderror
            </div>

            <div class="options-row">
                <label class="check-label">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    Rester connecté
                </label>
                <a href="#" class="forgot-link" id="forgotLink">Mot de passe oublié ?</a>
            </div>

            <button type="submit" class="btn-login" id="loginBtn">
                <span>Se connecter</span>
                <i class="fas fa-arrow-right"></i>
            </button>

            {{-- LIEN D'INSCRIPTION (AMÉLIORÉ) --}}
            <div class="register-link">
                Vous n'avez pas encore de compte ?
                <a href="{{ route('register') }}">S'inscrire</a>
            </div>
        </form>

        <div class="modules-hint">
            <hr><span>Modules disponibles</span><hr>
        </div>
        <div class="modules-row">
            <div class="module-chip"><i class="fas fa-book-open"></i> Catalogue</div>
            <div class="module-chip"><i class="fas fa-video"></i> Vidéos</div>
            <div class="module-chip"><i class="fas fa-tasks"></i> Quiz</div>
            <div class="module-chip"><i class="fas fa-certificate"></i> Certificats</div>
            <div class="module-chip"><i class="fas fa-chart-bar"></i> Statistiques</div>
        </div>

        <div class="form-footer">
            <span>© {{ date('Y') }} — <strong>AquaForm</strong> · Plateforme e-learning</span><br>
            <span><i class="fas fa-shield-halved"></i> Connexion sécurisée · Accès réservé aux utilisateurs autorisés</span>
        </div>

    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    toastr.options = {
        closeButton:   true,
        progressBar:   true,
        positionClass: "toast-top-right",
        timeOut:       "5000",
    };

    @if(session('success'))
        toastr.success('{{ session('success') }}');
    @endif
    @if(session('error'))
        toastr.error('{{ session('error') }}');
    @endif

    $(document).ready(function () {
        // ---- Sélecteur de rôle ----
        $('.role-btn').on('click', function () {
            $('.role-btn').removeClass('active');
            $(this).addClass('active');
            const role = $(this).data('role');
            const placeholder = $(this).data('placeholder');
            $('#selectedRole').val(role);
            $('#email').attr('placeholder', placeholder);
        });

        // ---- Toggle mot de passe ----
        $('#togglePw').on('click', function () {
            const pw = $('#password');
            const icon = $('#eyeIcon');
            if (pw.attr('type') === 'password') {
                pw.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                pw.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });

        // ---- Modal mot de passe oublié ----
        $('#forgotLink').on('click', function (e) {
            e.preventDefault();
            $('#forgotModal').addClass('open');
            setTimeout(() => $('#resetEmail').focus(), 100);
        });
        $('#modalClose, #modalCancel').on('click', function () {
            $('#forgotModal').removeClass('open');
        });
        $('#forgotModal').on('click', function (e) {
            if (e.target === this) $(this).removeClass('open');
        });

        // ---- Envoi lien ----
        $('#modalSend').on('click', function () {
            const email = $('#resetEmail').val().trim();
            if (!email || !isValidEmail(email)) {
                toastr.warning('Veuillez saisir une adresse e-mail valide.');
                $('#resetEmail').focus();
                return;
            }
            toastr.info('Un lien de réinitialisation a été envoyé à <strong>' + email + '</strong>.');
            $('#forgotModal').removeClass('open');
            $('#resetEmail').val('');
        });

        // ---- Validation formulaire ----
        $('#loginForm').on('submit', function (e) {
            const email = $('#email').val().trim();
            const password = $('#password').val().trim();
            let hasError = false;

            $('.field-error').remove();
            $('.field-input').removeClass('is-invalid');

            if (!email) {
                showFieldError('email', 'Veuillez saisir votre adresse e-mail.');
                hasError = true;
            } else if (!isValidEmail(email)) {
                showFieldError('email', 'Adresse e-mail invalide.');
                hasError = true;
            }

            if (!password) {
                showFieldError('password', 'Veuillez saisir votre mot de passe.');
                hasError = true;
            } else if (password.length < 6) {
                showFieldError('password', 'Le mot de passe doit comporter au moins 6 caractères.');
                hasError = true;
            }

            if (hasError) {
                e.preventDefault();
                toastr.error('Veuillez corriger les erreurs ci-dessous.');
                return false;
            }

            const btn = $('#loginBtn');
            btn.prop('disabled', true);
            btn.html('<span>Connexion...</span> <i class="fas fa-spinner fa-spin"></i>');
        });

        // ---- Nettoyage erreurs à la saisie ----
        $('#email, #password').on('input', function () {
            $(this).removeClass('is-invalid');
            $(this).closest('.field').find('.field-error').remove();
        });

        function showFieldError(fieldId, message) {
            const input = $('#' + fieldId);
            input.addClass('is-invalid');
            input.closest('.field').append($('<span class="field-error"></span>').text(message));
        }

        function isValidEmail(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        }
    });
</script>

</body>
</html>