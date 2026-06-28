{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="AquaForm — Plateforme e-learning pour les métiers de l'eau">

    <title>@yield('title', 'Tableau de bord') — AquaForm</title>

    <!-- Favicon (goutte d'eau) -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%230F3B43'%3E%3Cpath d='M12 2C12 2 5 11.5 5 16a7 7 0 0014 0C19 11.5 12 2 12 2Z'/%3E%3C/svg%3E">

    <!-- Bootstrap & FontAwesome (CDN si assets non disponibles) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Select2, daterangepicker (CDN si besoin) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css">

    <!-- Google Fonts : Kumbh Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- App CSS (si vous avez des fichiers locaux) -->
    {{-- <link rel="stylesheet" href="{{ asset('app/assets/css/style.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('app/assets/css/mystyle.css') }}"> --}}

    <style>
        /* ============================================================
           VARIABLES GLOBALES — Palette AquaForm
        ============================================================ */
        :root {
            --aqua-petrol: #0F3B43;
            --aqua-petrol-dark: #082A2F;
            --aqua-teal: #1A7E86;
            --aqua-teal-light: #24A1A9;
            --aqua-teal-mist: #E6F3F2;
            --aqua-amber: #EAA14F;
            --aqua-amber-dark: #D48A3A;
            --aqua-sand: #FAF8F4;
            --aqua-ink: #161D1C;
            --aqua-ink-soft: #556B67;
            --aqua-mist: #DFEAE8;
            --aqua-white: #FFFFFF;
            --aqua-danger: #c0392b;
            --aqua-success: #1a6e40;

            --app-radius: 12px;
            --app-shadow: 0 8px 32px rgba(15, 59, 67, 0.06);
            --app-transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ============================================================
           RESET & BASE
        ============================================================ */
        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'Kumbh Sans', sans-serif;
            background: var(--aqua-sand);
            color: var(--aqua-ink);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ============================================================
           PAGE WRAPPER
        ============================================================ */
        .app-page-wrapper {
            display: flex;
            flex-direction: column;
            flex: 1;
            min-height: 0;
        }

        /* ============================================================
           BARRE DE CONTEXTE (titre page + breadcrumb + actions)
        ============================================================ */
        .app-page-header {
            background: var(--aqua-white);
            border-bottom: 1px solid var(--aqua-mist);
            padding: 0.9rem 1.6rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.75rem;
        }
        .app-page-header-left {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }
        .app-page-title-main {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--aqua-petrol);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .app-page-title-main .title-icon {
            width: 30px;
            height: 30px;
            background: var(--aqua-teal-mist);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            color: var(--aqua-teal);
            flex-shrink: 0;
        }
        .app-breadcrumb {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.75rem;
            color: var(--aqua-ink-soft);
        }
        .app-breadcrumb li + li::before {
            content: '/';
            margin-right: 0.3rem;
            opacity: 0.5;
        }
        .app-breadcrumb a {
            color: var(--aqua-teal);
            text-decoration: none;
            font-weight: 500;
        }
        .app-breadcrumb a:hover { text-decoration: underline; }
        .app-page-header-right {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        /* ============================================================
           ZONE DE CONTENU PRINCIPALE
        ============================================================ */
        .app-content-area {
            flex: 1;
            padding: 1.5rem 1.6rem;
        }

        /* ============================================================
           DARK THEME (optionnel)
        ============================================================ */
        html[data-theme="dark"] body {
            background: #121E1B;
            color: #D4E8DA;
        }
        html[data-theme="dark"] .app-page-header {
            background: #162B1E;
            border-color: #234733;
        }
        html[data-theme="dark"] .app-content-area {
            background: #121E1B;
        }
        html[data-theme="dark"] .app-page-title-main {
            color: #7DDBA0;
        }

        /* ============================================================
           RESPONSIVE
        ============================================================ */
        @media (max-width: 768px) {
            .app-content-area { padding: 1rem; }
            .app-page-header { padding: 0.75rem 1rem; }
        }
    </style>

    @stack('css')
    @yield('css')
</head>

<body>

{{-- ===== HEADER STICKY (version AquaForm) ===== --}}
@include('layouts.partials._header')

{{-- ===== WRAPPER PRINCIPAL ===== --}}
<div class="app-page-wrapper">

    {{-- Barre titre / breadcrumb / actions --}}
    @hasSection('page_title')
    <div class="app-page-header">
        <div class="app-page-header-left">
            <h1 class="app-page-title-main">
                <span class="title-icon">
                    <i class="fas @yield('page_icon', 'fa-droplet')"></i>
                </span>
                @yield('page_title')
            </h1>
            @hasSection('breadcrumb')
            <ul class="app-breadcrumb" aria-label="Fil d'Ariane">
                <li><a href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>
                @yield('breadcrumb')
            </ul>
            @endif
        </div>
        <div class="app-page-header-right">
            @yield('page_actions')
        </div>
    </div>
    @endif

    {{-- Contenu de la vue enfant --}}
    <main class="app-content-area" role="main" id="main-content">
        @yield('contenu')
    </main>

    {{-- Footer --}}
    @include('layouts.partials._footer')

</div>{{-- /.app-page-wrapper --}}

{{-- ===== SCRIPTS ===== --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
{{-- ApexCharts (si nécessaire) --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.37.1/apexcharts.min.js"></script>

{{-- Vos scripts personnalisés --}}
{{-- <script src="{{ asset('app/assets/js/script.js') }}"></script> --}}

@stack('js')
@yield('js')

</body>
</html>