<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $siteName ?? 'AquaForm' }} — Plateforme de formation du secteur de l'eau</title>

    <!-- ===== POLICE KUMBH SANS ===== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- ===== FONTAWESOME 6 (GRATUIT) ===== -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @stack('css')

    <style>
        /* ===== VARIABLES ===== */
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
            --radius-md: 16px;
            --radius-lg: 24px;
            --maxw: 1220px;
            --font: 'Kumbh Sans', sans-serif;
            --shadow: 0 10px 30px rgba(15, 59, 67, 0.08);
            --transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ===== RESET ===== */
        * { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; -webkit-font-smoothing: antialiased; }
        body {
            font-family: var(--font);
            background: var(--sand);
            color: var(--ink);
            line-height: 1.6;
            font-size: 16px;
        }
        h1, h2, h3, h4 {
            font-weight: 800;
            color: var(--petrol);
            line-height: 1.15;
            letter-spacing: -0.02em;
            margin-bottom: 0.5em;
        }
        h1 { font-size: 3.2rem; }
        h2 { font-size: 2.4rem; }
        h3 { font-size: 1.5rem; }
        h4 { font-size: 1.1rem; font-weight: 700; }
        p { margin-bottom: 1.25em; color: var(--ink-soft); }
        a { color: inherit; text-decoration: none; transition: var(--transition); }
        img, svg { display: block; max-width: 100%; height: auto; }

        .wrap { max-width: var(--maxw); margin: 0 auto; padding: 0 32px; }
        section { padding: 100px 0; }
        .section-head { max-width: 680px; margin-bottom: 60px; }
        .section-head .mono {
            font-weight: 600;
            color: var(--teal);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-size: 0.78rem;
            margin-bottom: 12px;
            display: block;
        }
        .section-head h2 { margin-bottom: 18px; }
        .section-head p { font-size: 1.08rem; line-height: 1.7; }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-weight: 700;
            font-size: 0.95rem;
            padding: 14px 28px;
            border-radius: 999px;
            border: 2px solid transparent;
            transition: var(--transition);
            cursor: pointer;
        }
        .btn:hover { transform: translateY(-2px); box-shadow: var(--shadow); }
        .btn-amber { background: var(--amber); color: var(--petrol); }
        .btn-amber:hover { background: var(--amber-dark); color: var(--white); }
        .btn-ghost { color: var(--white); border-color: rgba(255,255,255,0.4); background: transparent; }
        .btn-ghost:hover { background: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.7); }
        .btn-outline { background: transparent; border-color: var(--petrol); color: var(--petrol); }
        .btn-outline:hover { background: var(--petrol); color: var(--white); }

        /* ===== TOPBAR ===== */
        .topbar {
            background: var(--petrol);
            color: var(--white);
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        }
        .topbar .wrap {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 32px;
            gap: 32px;
        }
        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 800;
            font-size: 1.4rem;
            color: var(--white);
        }
        .logo .fa-droplet { font-size: 1.8rem; color: var(--amber); }
        nav.primary-nav {
            display: flex;
            gap: 32px;
            font-weight: 600;
            font-size: 0.98rem;
        }
        nav.primary-nav a {
            opacity: 0.85;
            transition: var(--transition);
            cursor: pointer;
            position: relative;
        }
        nav.primary-nav a:hover,
        nav.primary-nav a.active {
            opacity: 1;
            color: var(--amber);
        }
        nav.primary-nav a.active::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--amber);
            border-radius: 2px;
        }
        .nav-actions { display: flex; gap: 14px; align-items: center; }
        .nav-actions .btn { padding: 10px 22px; font-size: 0.9rem; }
        @media (max-width: 992px) { nav.primary-nav { display: none; } }

        /* ===== HERO ===== */
        .hero {
            background: linear-gradient(160deg, var(--petrol) 0%, #082A2F 100%);
            color: var(--white);
            padding: 100px 0 80px;
            position: relative;
            overflow: hidden;
        }
        .hero .wrap {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 70px;
            align-items: center;
            position: relative;
            z-index: 2;
        }
        .hero .eyebrow { color: var(--amber); font-weight: 600; margin-bottom: 20px; display: block; }
        .hero h1 { color: var(--white); margin-bottom: 28px; }
        .hero h1 em { color: var(--amber); font-style: normal; }
        .hero p.lead {
            font-size: 1.15rem;
            color: rgba(255,255,255,0.85);
            max-width: 580px;
            margin-bottom: 40px;
            line-height: 1.7;
        }
        .hero-cta { display: flex; gap: 16px; flex-wrap: wrap; margin-bottom: 44px; }
        .hero-tags { display: flex; gap: 12px; flex-wrap: wrap; }
        .tag {
            font-weight: 600;
            font-size: 0.8rem;
            color: rgba(255,255,255,0.8);
            border: 1px solid rgba(255,255,255,0.2);
            padding: 8px 16px;
            border-radius: 999px;
            background: rgba(255,255,255,0.05);
            transition: var(--transition);
        }
        .tag:hover { background: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.4); }

        .gauge-art {
            display: flex;
            justify-content: center;
            align-items: center;
            filter: drop-shadow(0 10px 30px rgba(0,0,0,0.2));
        }
        .gauge-art svg { width: 100%; max-width: 400px; height: auto; }

        @media (max-width: 992px) {
            .hero .wrap { grid-template-columns: 1fr; text-align: center; }
            .hero p.lead { margin-left: auto; margin-right: auto; }
            .hero-cta, .hero-tags { justify-content: center; }
            .gauge-art { order: -1; margin-bottom: 40px; }
        }

        /* ===== STATS ===== */
        .stats {
            background: var(--white);
            border-bottom: 1px solid var(--mist);
            margin-top: -30px;
            border-radius: var(--radius-md) var(--radius-md) 0 0;
            box-shadow: 0 -10px 30px rgba(0,0,0,0.03);
            position: relative;
            z-index: 10;
        }
        .stats .wrap {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            padding: 50px 32px;
            gap: 32px;
        }
        .stat {
            display: flex;
            align-items: center;
            gap: 20px;
            background: var(--sand);
            padding: 20px;
            border-radius: var(--radius-md);
            border: 1px solid transparent;
            transition: var(--transition);
        }
        .stat:hover { border-color: var(--mist); background: var(--white); transform: translateY(-3px); box-shadow: var(--shadow); }
        .stat-icon {
            font-size: 2rem;
            width: 56px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: var(--teal-mist);
            color: var(--teal);
            flex-shrink: 0;
            transition: var(--transition);
        }
        .stat:hover .stat-icon { background: var(--teal); color: var(--white); }
        .stat .num { font-weight: 800; font-size: 1.8rem; color: var(--petrol); letter-spacing: -0.03em; line-height: 1; margin-bottom: 2px; }
        .stat .label { font-size: 0.88rem; font-weight: 600; color: var(--ink-soft); }

        @media (max-width: 1024px) { .stats .wrap { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 640px) { .stats .wrap { grid-template-columns: 1fr; } }

        /* ===== CATALOGUE ===== */
        .catalogue-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
        }
        .cat-card {
            background: var(--white);
            border: 1px solid var(--mist);
            border-radius: var(--radius-md);
            padding: 32px;
            transition: var(--transition);
            display: flex;
            flex-direction: column;
        }
        .cat-card:hover {
            border-color: var(--teal);
            transform: translateY(-5px);
            box-shadow: var(--shadow);
        }
        .cat-card .icon {
            width: 56px;
            height: 56px;
            background: var(--teal-mist);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            color: var(--teal);
            margin-bottom: 24px;
            transition: var(--transition);
        }
        .cat-card:hover .icon { background: var(--teal); color: var(--white); }
        .cat-card h3 { font-size: 1.15rem; margin-bottom: 10px; }
        .cat-card p { font-size: 0.93rem; margin-bottom: 20px; flex-grow: 1; }
        .cat-card .go {
            font-weight: 700;
            color: var(--teal);
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .cat-card .go i { transition: var(--transition); }
        .cat-card:hover .go i { transform: translateX(4px); }

        @media (max-width: 1100px) { .catalogue-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 640px) { .catalogue-grid { grid-template-columns: 1fr; } }

        /* ===== PARCOURS ===== */
        .parcours { background: var(--teal-mist); position: relative; }
        .steps {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            counter-reset: step;
        }
        .step {
            background: var(--white);
            padding: 32px;
            border-radius: var(--radius-md);
            border: 1px solid var(--mist);
            transition: var(--transition);
            position: relative;
        }
        .step:hover { border-color: var(--teal); box-shadow: var(--shadow); }
        .step .step-num {
            font-weight: 700;
            font-size: 0.85rem;
            color: var(--teal);
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .step .step-num::before {
            counter-increment: step;
            content: counter(step);
            display: flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            background: var(--teal);
            color: var(--white);
            border-radius: 50%;
            font-weight: 800;
            font-size: 0.9rem;
        }
        .step h3 { font-size: 1.15rem; margin-bottom: 12px; }
        .step p { font-size: 0.93rem; margin: 0; }

        @media (max-width: 1024px) { .steps { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 640px) { .steps { grid-template-columns: 1fr; } }

        /* ===== ROLES ===== */
        .roles-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
        .role-card {
            border-radius: var(--radius-lg);
            padding: 40px;
            color: var(--white);
            transition: var(--transition);
            display: flex;
            flex-direction: column;
        }
        .role-card:hover { transform: translateY(-5px); box-shadow: 0 15px 40px rgba(0,0,0,0.15); }
        .role-card.apprenant { background: var(--teal); }
        .role-card.formateur { background: var(--petrol); }
        .role-card.admin { background: #2F2419; }

        .role-card .mono {
            font-weight: 600;
            opacity: 0.7;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-size: 0.78rem;
            margin-bottom: 14px;
            display: block;
        }
        .role-card h3 { color: var(--white); font-size: 1.4rem; margin-bottom: 24px; }
        .role-card ul { margin: 0; padding: 0; list-style: none; display: flex; flex-direction: column; gap: 12px; }
        .role-card li {
            padding-left: 28px;
            position: relative;
            opacity: 0.9;
            line-height: 1.4;
        }
        .role-card li::before {
            content: "✓";
            position: absolute;
            left: 0;
            color: rgba(255,255,255,0.6);
            font-weight: 800;
        }

        @media (max-width: 992px) { .roles-grid { grid-template-columns: 1fr; } }

        /* ===== FORMATS ===== */
        .formats {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 60px;
            align-items: center;
        }
        .formats-list { display: flex; flex-direction: column; gap: 28px; }
        .format-item {
            display: flex;
            gap: 20px;
            align-items: flex-start;
            background: var(--white);
            padding: 24px;
            border-radius: var(--radius-md);
            border: 1px solid var(--mist);
            transition: var(--transition);
        }
        .format-item:hover { border-color: var(--teal); transform: translateX(5px); box-shadow: var(--shadow); }
        .format-item .icon {
            width: 50px;
            height: 50px;
            background: var(--teal-mist);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            color: var(--teal);
            flex-shrink: 0;
            transition: var(--transition);
        }
        .format-item:hover .icon { background: var(--teal); color: var(--white); }
        .format-item h4 { margin-bottom: 6px; }
        .format-item p { font-size: 0.93rem; margin: 0; }

        .player-mock {
            background: var(--petrol);
            border-radius: var(--radius-lg);
            padding: 24px;
            box-shadow: 0 15px 50px rgba(0,0,0,0.15);
            border: 4px solid #144952;
        }
        .player-mock .screen {
            background: #082328;
            border-radius: 12px;
            aspect-ratio: 16/10;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
        }
        .player-mock .screen .fa-play-circle {
            font-size: 4rem;
            color: var(--amber);
            filter: drop-shadow(0 4px 10px rgba(234,161,79,0.3));
            position: relative;
            z-index: 2;
        }
        .player-bar {
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .player-bar .track {
            flex: 1;
            height: 6px;
            background: rgba(255,255,255,0.15);
            border-radius: 99px;
            position: relative;
            overflow: hidden;
        }
        .player-bar .track::after {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 72%;
            background: var(--amber);
            border-radius: 99px;
        }
        .player-bar span {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.78rem;
            color: #9FC6C3;
            font-weight: 500;
        }
        @media (max-width: 992px) { .formats { grid-template-columns: 1fr; } }

        /* ===== BANNER ===== */
        .banner {
            background: linear-gradient(135deg, var(--amber) 0%, #F5B973 100%);
            border-radius: var(--radius-lg);
            padding: 50px;
            display: grid;
            grid-template-columns: 1.4fr 0.6fr;
            gap: 40px;
            align-items: center;
            box-shadow: 0 15px 40px rgba(234,161,79,0.15);
            position: relative;
            overflow: hidden;
        }
        .banner h3 { font-size: 1.8rem; color: var(--petrol); margin-bottom: 16px; }
        .banner p { color: #5F4B27; font-size: 1rem; margin-bottom: 28px; max-width: 520px; line-height: 1.6; }
        .banner .mono { font-weight: 600; color: #8A6A2C; margin-bottom: 12px; display: block; text-transform: uppercase; letter-spacing: 0.08em; font-size: 0.78rem; }
        .banner .btn-outline { border-color: var(--petrol); color: var(--petrol); background: rgba(255,255,255,0.1); }
        .banner .btn-outline:hover { background: var(--petrol); color: var(--white); }
        .banner-art { display: flex; justify-content: flex-end; }
        .banner-art .fa-droplet { font-size: 8rem; color: var(--petrol); opacity: 0.15; }
        @media (max-width: 900px) {
            .banner { grid-template-columns: 1fr; text-align: center; padding: 40px; }
            .banner p { margin-left: auto; margin-right: auto; }
            .banner-art { display: none; }
        }

        /* ===== NEWS ===== */
        .news-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 28px; }
        .news-card {
            background: var(--white);
            border: 1px solid var(--mist);
            border-radius: var(--radius-md);
            overflow: hidden;
            transition: var(--transition);
            display: flex;
            flex-direction: column;
        }
        .news-card:hover { border-color: var(--teal); transform: translateY(-5px); box-shadow: var(--shadow); }
        .news-card .thumb {
            height: 150px;
            background: var(--teal-mist);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: var(--teal);
            border-bottom: 1px solid var(--mist);
            transition: var(--transition);
        }
        .news-card:hover .thumb { background: var(--teal); color: var(--white); }
        .news-card .body { padding: 28px; flex-grow: 1; display: flex; flex-direction: column; }
        .news-card .mono {
            font-weight: 600;
            color: var(--teal);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-size: 0.78rem;
            margin-bottom: 12px;
            display: block;
        }
        .news-card h4 { font-size: 1.1rem; margin-bottom: 12px; flex-grow: 1; }
        .news-card p { font-size: 0.9rem; margin: 0; }
        @media (max-width: 992px) { .news-grid { grid-template-columns: 1fr; } }

        /* ===== CTA FINAL ===== */
        .cta-final {
            background: var(--petrol);
            color: var(--white);
            text-align: center;
            border-radius: var(--radius-lg);
            padding: 80px 40px;
            box-shadow: 0 20px 50px rgba(15,59,67,0.2);
            position: relative;
            overflow: hidden;
        }
        .cta-final h2 { color: var(--white); margin-bottom: 20px; }
        .cta-final p { color: rgba(255,255,255,0.8); max-width: 580px; margin: 0 auto 40px; font-size: 1.1rem; }
        .cta-final .hero-cta { justify-content: center; }

        /* ===== FOOTER ===== */
        footer {
            background: #09262B;
            color: #9FC6C3;
            padding: 80px 0 32px;
            font-size: 0.93rem;
        }
        .footer-grid {
            display: grid;
            grid-template-columns: 1.5fr repeat(4, 1fr);
            gap: 40px;
            padding-bottom: 50px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            margin-bottom: 32px;
        }
        .footer-grid .logo { color: var(--white); font-size: 1.5rem; margin-bottom: 18px; }
        .footer-grid .logo .fa-droplet { color: var(--amber); }
        .footer-grid p.about { font-size: 0.9rem; max-width: 280px; line-height: 1.6; color: rgba(255,255,255,0.7); }
        .footer-col h5 {
            font-weight: 600;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--white);
            opacity: 0.9;
            margin-bottom: 20px;
        }
        .footer-col ul { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 12px; }
        .footer-col a { opacity: 0.8; }
        .footer-col a:hover { opacity: 1; color: var(--amber); transform: translateX(3px); }

        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
            flex-wrap: wrap;
            gap: 16px;
            color: rgba(255,255,255,0.6);
        }
        .social { display: flex; gap: 18px; align-items: center; }
        .social a { opacity: 0.6; transition: var(--transition); font-size: 1.4rem; color: var(--white); }
        .social a:hover { opacity: 1; transform: scale(1.1); }

        @media (max-width: 1100px) { .footer-grid { grid-template-columns: 1.5fr repeat(2, 1fr); } }
        @media (max-width: 768px) {
            .footer-grid { grid-template-columns: 1fr; text-align: center; }
            .footer-grid p.about { margin-left: auto; margin-right: auto; }
            .footer-bottom { justify-content: center; text-align: center; }
            .social { justify-content: center; margin-top: 10px; }
        }
    </style>
</head>

<body>

<!-- ===== TOP BAR ===== -->
<header class="topbar">
    <div class="wrap">
        <a href="/" class="logo">
            <i class="fas fa-droplet"></i>
            <span>{{ $siteName ?? 'AquaForm' }}</span>
        </a>
        <nav class="primary-nav" id="primaryNav">
            <a href="#catalogue" data-section="catalogue">Catalogue</a>
            <a href="#parcours" data-section="parcours">Étapes</a>
            <a href="#roles" data-section="roles">Accès</a>
            <a href="#contenus" data-section="contenus">Ressources</a>
            <a href="#actualites" data-section="actualites">Actualités</a>
        </nav>
        <div class="nav-actions">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-ghost">Tableau de bord</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-ghost">Connexion</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-amber">Créer un compte</a>
                    @endif
                @endauth
            @else
                <a class="btn btn-ghost" href="#">Connexion</a>
                <a class="btn btn-amber" href="#">Créer un compte</a>
            @endif
        </div>
    </div>
</header>

<!-- ===== HERO ===== -->
<section class="hero">
    <div class="wrap">
        <div class="hero-content">
            <span class="eyebrow mono">{{ $heroEyebrow ?? 'Plateforme e-learning du secteur de l\'eau' }}</span>
            <h1>{!! $heroTitle ?? 'Formez vos équipes à la <em>sécurité</em>, à la <em>réglementation</em> et à la gestion des <em>produits chimiques</em>' !!}</h1>
            <p class="lead">{{ $heroLead ?? 'AquaForm rassemble les compétences essentielles des opérateurs de l\'eau et de l\'assainissement : manipulation des produits chimiques, conformité réglementaire, recouvrement des coûts et sécurité au poste de travail — accessibles en ligne, suivies pas à pas, validées par quiz et certificats.' }}</p>
            <div class="hero-cta">
                <a class="btn btn-amber" href="#catalogue">Parcourir le catalogue</a>
                <a class="btn btn-ghost" href="#">Découvrir la plateforme</a>
            </div>
            <div class="hero-tags">
                <span class="tag">Opérateurs</span>
                <span class="tag">Techniciens</span>
                <span class="tag">Responsables HSE</span>
                <span class="tag">Administrateurs</span>
            </div>
        </div>
        <div class="gauge-art" aria-hidden="true">
            <svg viewBox="0 0 360 360" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="180" cy="180" r="150" stroke="#144952" stroke-width="2" stroke-dasharray="6 10"/>
                <circle cx="180" cy="180" r="120" fill="none" stroke="#0F3B43" stroke-width="24"/>
                <circle cx="180" cy="180" r="120" fill="none" stroke="#EAA14F" stroke-width="24" stroke-linecap="round" stroke-dasharray="565" stroke-dashoffset="150" transform="rotate(-90 180 180)"/>
                <circle cx="180" cy="180" r="86" fill="#0F3B43" stroke="#24A1A9" stroke-width="3"/>
                <text x="180" y="175" text-anchor="middle" fill="#fff" font-family="Kumbh Sans, sans-serif" font-size="48" font-weight="800">72%</text>
                <text x="180" y="202" text-anchor="middle" fill="#9FC6C3" font-family="IBM Plex Mono, monospace" font-size="14" letter-spacing="2" font-weight="500">PROGRESSION</text>
                <g stroke="#1A7E86" stroke-width="2.5">
                    <line x1="180" y1="45" x2="180" y2="65"/>
                    <line x1="315" y1="180" x2="295" y2="180"/>
                    <line x1="180" y1="315" x2="180" y2="295"/>
                    <line x1="45" y1="180" x2="65" y2="180"/>
                </g>
                <circle cx="272" cy="108" r="10" fill="#EAA14F" stroke="#0F3B43" stroke-width="3"/>
            </svg>
        </div>
    </div>
</section>

<!-- ===== STATS ===== -->
<div class="stats">
    <div class="wrap">
        @php $defaultStats = [
            ['label' => 'Modules de formation', 'value' => '120+', 'icon' => 'fa-book-open', 'color' => '#1A7E86'],
            ['label' => 'Apprenants formés', 'value' => '8 400+', 'icon' => 'fa-users', 'color' => '#EAA14F'],
            ['label' => 'Taux de réussite', 'value' => '86%', 'icon' => 'fa-chart-line', 'color' => '#1A7E86'],
            ['label' => 'Certificats délivrés', 'value' => '5 900+', 'icon' => 'fa-certificate', 'color' => '#EAA14F'],
        ]; @endphp
        @foreach($stats ?? $defaultStats as $stat)
        <div class="stat">
            <div class="stat-icon" style="color: {{ $stat['color'] ?? '#1A7E86' }};">
                <i class="fas {{ $stat['icon'] ?? 'fa-circle' }}"></i>
            </div>
            <div>
                <div class="num">{{ $stat['value'] ?? '0' }}</div>
                <div class="label">{{ $stat['label'] ?? 'Statistique' }}</div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- ===== CATALOGUE ===== -->
<section id="catalogue" class="section" data-section="catalogue">
    <div class="wrap">
        <div class="section-head">
            <span class="mono">Catalogue de formations</span>
            <h2>Des parcours organisés par thématique métier</h2>
            <p>Recherchez par thème, niveau ou format, et inscrivez-vous en un clic depuis chaque fiche de cours détaillée.</p>
        </div>
        <div class="catalogue-grid">
            @php $defaultCats = [
                ['nom' => 'Produits chimiques', 'description' => 'Stockage, dosage et manipulation sécurisée des réactifs de traitement.', 'icon' => 'fa-flask'],
                ['nom' => 'Réglementation', 'description' => 'Textes en vigueur, normes de qualité et obligations de conformité du secteur.', 'icon' => 'fa-gavel'],
                ['nom' => 'Recouvrement des coûts', 'description' => 'Tarification, facturation et stratégies de viabilité financière des services.', 'icon' => 'fa-coins'],
                ['nom' => 'Sécurité au travail', 'description' => 'Équipements (EPI), procédures d\'urgence et prévention des accidents.', 'icon' => 'fa-shield-alt'],
            ]; @endphp
            @foreach($categories ?? $defaultCats as $cat)
            <div class="cat-card">
                <div class="icon"><i class="fas {{ $cat['icon'] ?? 'fa-folder-open' }}"></i></div>
                <h3>{{ $cat['nom'] ?? 'Catégorie' }}</h3>
                <p>{{ $cat['description'] ?? '' }}</p>
                <a href="#" class="go">Voir les cours <i class="fas fa-arrow-right"></i></a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ===== PARCOURS ===== -->
<section id="parcours" class="parcours section" data-section="parcours">
    <div class="wrap">
        <div class="section-head">
            <span class="mono">Comment ça marche</span>
            <h2>De l'inscription au certificat, en quatre étapes simples</h2>
        </div>
        <div class="steps">
            <div class="step">
                <span class="step-num">01</span>
                <h3>Créez votre compte</h3>
                <p>Identifiant sécurisé, profil personnalisé avec votre rôle.</p>
            </div>
            <div class="step">
                <span class="step-num">02</span>
                <h3>Suivez les modules</h3>
                <p>Vidéos, diaporamas interactifs et PDF téléchargeables.</p>
            </div>
            <div class="step">
                <span class="step-num">03</span>
                <h3>Passez les quiz</h3>
                <p>Correction immédiate et tentatives supplémentaires si besoin.</p>
            </div>
            <div class="step">
                <span class="step-num">04</span>
                <h3>Obtenez votre certificat</h3>
                <p>Généré automatiquement dès la réussite atteinte.</p>
            </div>
        </div>
    </div>
</section>

<!-- ===== ROLES ===== -->
<section id="roles" class="section" data-section="roles">
    <div class="wrap">
        <div class="section-head">
            <span class="mono">Profils &amp; accès</span>
            <h2>Trois niveaux d'accès, des droits adaptés à chacun</h2>
        </div>
        <div class="roles-grid">
            <div class="role-card apprenant">
                <span class="mono">Apprenant</span>
                <h3>Se former à son propre rythme</h3>
                <ul>
                    <li>Tableau de bord personnel</li>
                    <li>Suivi des cours en cours et terminés</li>
                    <li>Historique complet et certificats</li>
                    <li>Catalogue complet accessible</li>
                </ul>
            </div>
            <div class="role-card formateur">
                <span class="mono">Formateur</span>
                <h3>Concevoir et évaluer</h3>
                <ul>
                    <li>Création de modules et quiz</li>
                    <li>Paramétrage des seuils de réussite</li>
                    <li>Suivi des résultats des apprenants</li>
                    <li>Gestion de groupes de formation</li>
                </ul>
            </div>
            <div class="role-card admin">
                <span class="mono">Administrateur</span>
                <h3>Piloter la plateforme</h3>
                <ul>
                    <li>Statistiques globales et exports</li>
                    <li>Gestion des utilisateurs et inscriptions</li>
                    <li>Journalisation complète des activités</li>
                    <li>Configuration système</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- ===== CONTENUS ===== -->
<section id="contenus" class="contenus section" style="background: var(--white);" data-section="contenus">
    <div class="wrap formats">
        <div>
            <div class="section-head" style="margin-bottom: 40px;">
                <span class="mono">Ressources pédagogiques</span>
                <h2>Des contenus pensés pour la réalité du terrain</h2>
            </div>
            <div class="formats-list">
                @php $defaultFeatures = [
                    ['titre' => 'Vidéos de formation', 'desc' => 'Intégrées ou via lien externe, lisibles sur tout support.', 'icon' => 'fa-video'],
                    ['titre' => 'Diaporamas interactifs', 'desc' => 'Tutoriels pas à pas pour s\'approprier les procédures.', 'icon' => 'fa-sliders-h'],
                    ['titre' => 'Documents & fiches techniques', 'desc' => 'PDF, textes réglementaires, téléchargeables pour hors connexion.', 'icon' => 'fa-file-pdf'],
                ]; @endphp
                @foreach($features ?? $defaultFeatures as $feature)
                <div class="format-item">
                    <div class="icon"><i class="fas {{ $feature['icon'] ?? 'fa-file' }}"></i></div>
                    <div>
                        <h4>{{ $feature['titre'] ?? 'Fonctionnalité' }}</h4>
                        <p>{{ $feature['desc'] ?? '' }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="player-mock" aria-hidden="true">
            <div class="screen">
                <i class="fas fa-play-circle"></i>
            </div>
            <div class="player-bar">
                <span>04:12</span>
                <div class="track"></div>
                <span>09:50</span>
            </div>
        </div>
    </div>
</section>

<!-- ===== BANNER ===== -->
<section>
    <div class="wrap">
        <div class="banner">
            <div>
                <span class="mono">{{ $webinarTag ?? 'Prochaine session en direct' }}</span>
                <h3>{{ $webinarTitle ?? 'Manipulation sécurisée des produits chlorés — Webinaire formateurs' }}</h3>
                <p>{{ $webinarDesc ?? 'Rejoignez nos experts pour une session pratique sur les protocoles de sécurité et les seuils de réussite à fixer pour vos équipes. Inscription obligatoire pour recevoir le lien.' }}</p>
                <a class="btn btn-outline" href="{{ $webinarLink ?? '#' }}">S'inscrire au webinaire</a>
            </div>
            <div class="banner-art"><i class="fas fa-droplet"></i></div>
        </div>
    </div>
</section>

<!-- ===== ACTUALITES ===== -->
<section id="actualites" class="section" data-section="actualites">
    <div class="wrap">
        <div class="section-head">
            <span class="mono">Actualités</span>
            <h2>Les dernières publications de la communauté {{ $siteName ?? 'AquaForm' }}</h2>
        </div>
        <div class="news-grid">
            @php $defaultNews = [
                ['categorie' => 'Réglementation', 'titre' => 'Mise à jour des seuils de qualité de l\'eau potable', 'desc' => 'Nouveau module disponible suite au décret du 12 mai.', 'icon' => 'fa-gavel'],
                ['categorie' => 'Sécurité', 'titre' => 'Nouveau parcours EPI complet', 'desc' => 'Cinq modules vidéo et un quiz final à seuil renforcé.', 'icon' => 'fa-shield-alt'],
                ['categorie' => 'Plateforme', 'titre' => 'Export des rapports disponible en Excel', 'desc' => 'Fonctionnalité pour les administrateurs.', 'icon' => 'fa-file-excel'],
            ]; @endphp
            @forelse($news ?? $defaultNews as $item)
            <div class="news-card">
                <div class="thumb"><i class="fas {{ $item['icon'] ?? 'fa-newspaper' }}"></i></div>
                <div class="body">
                    <span class="mono">{{ $item['categorie'] ?? 'Actualité' }}</span>
                    <h4>{{ $item['titre'] ?? 'Titre' }}</h4>
                    <p>{{ $item['desc'] ?? '' }}</p>
                </div>
            </div>
            @empty
            <p>Aucune actualité récente pour le moment.</p>
            @endforelse
        </div>
    </div>
</section>

<!-- ===== CTA FINAL ===== -->
<section>
    <div class="wrap">
        <div class="cta-final">
            <h2>Prêt à former efficacement vos équipes ?</h2>
            <p>Créer votre compte gratuitement en quelques secondes et accédez au catalogue complet de formations sur les produits chimiques, la réglementation, le recouvrement des coûts et la sécurité au poste de travail.</p>
            <div class="hero-cta">
                <a class="btn btn-amber" href="#">Créer un compte</a>
                <a class="btn btn-ghost" href="#catalogue">Explorer le catalogue</a>
            </div>
        </div>
    </div>
</section>

<!-- ===== FOOTER ===== -->
<footer>
    <div class="wrap">
        <div class="footer-grid">
            <div>
                <div class="logo">
                    <i class="fas fa-droplet"></i>
                    <span>{{ $siteName ?? 'AquaForm' }}</span>
                </div>
                <p class="about">{{ $footerAbout ?? 'La plateforme e-learning dédiée à l\'excellence technique des professionnels de l\'eau et de l\'assainissement.' }}</p>
            </div>
            <div class="footer-col">
                <h5>Formations</h5>
                <ul>
                    <li><a href="#">Produits chimiques</a></li>
                    <li><a href="#">Réglementation</a></li>
                    <li><a href="#">Recouvrement</a></li>
                    <li><a href="#">Sécurité HSE</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h5>Plateforme</h5>
                <ul>
                    <li><a href="#">Tableau de bord</a></li>
                    <li><a href="#">Certificats</a></li>
                    <li><a href="#">Profils &amp; accès</a></li>
                    <li><a href="#">Rapports</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h5>Assistance</h5>
                <ul>
                    <li><a href="#">Centre d'aide</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Statut du service</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h5>Légal</h5>
                <ul>
                    <li><a href="#">Mentions légales</a></li>
                    <li><a href="#">Confidentialité</a></li>
                    <li><a href="#">Cookies</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <span>© {{ date('Y') }} {{ $siteName ?? 'AquaForm' }} — Tous droits réservés.</span>
            <div class="social">
                <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                <a href="#" aria-label="Email"><i class="fas fa-envelope"></i></a>
            </div>
        </div>
    </div>
</footer>

<!-- ===== SCRIPT DE NAVIGATION ACTIVE ===== -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sections = document.querySelectorAll('.section');
        const navLinks = document.querySelectorAll('.primary-nav a');

        function setActiveLink(sectionId) {
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('data-section') === sectionId) {
                    link.classList.add('active');
                }
            });
        }

        // Intersection Observer
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const sectionId = entry.target.getAttribute('data-section');
                    setActiveLink(sectionId);
                }
            });
        }, {
            rootMargin: '-20% 0px -30% 0px',
            threshold: 0.3
        });

        sections.forEach(section => {
            observer.observe(section);
        });

        // Clic sur un lien de navigation
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1);
                const targetSection = document.getElementById(targetId);
                if (targetSection) {
                    navLinks.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                    targetSection.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });

        // Si aucun lien actif, activer le premier (Catalogue)
        if (!document.querySelector('.primary-nav a.active')) {
            const firstLink = document.querySelector('.primary-nav a');
            if (firstLink) firstLink.classList.add('active');
        }
    });
</script>

</body>
</html>