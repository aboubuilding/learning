<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AquaForm | Inscription</title>

    <!-- Kumbh Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ===== RESET & VARIABLES ===== */
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --petrol: #0F3B43;
            --petrol-dark: #082A2F;
            --teal: #1A7E86;
            --teal-light: #24A1A9;
            --teal-alpha: rgba(26, 126, 134, 0.12);
            --amber: #EAA14F;
            --sand: #F8F6F2;
            --sand-light: #FCFBF9;
            --ink: #161D1C;
            --ink-soft: #4F6561;
            --ink-faint: #8DA39E;
            --mist: #DFEAE8;
            --white: #FFFFFF;
            --radius-sm: 8px;
            --radius-md: 14px;
            --radius-lg: 24px;
            --font: 'Kumbh Sans', sans-serif;
            --shadow-soft: 0 8px 32px rgba(15, 59, 67, 0.06);
            --transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: var(--font);
            background: var(--sand);
            color: var(--ink);
            min-height: 100vh;
            display: flex;
            align-items: stretch;
            overflow-x: hidden;
        }

        /* ===== LEFT PANEL ===== */
        .left-panel {
            flex: 0 0 52%;
            background: linear-gradient(160deg, var(--petrol) 0%, var(--petrol-dark) 100%);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 4rem 4.5rem;
            min-height: 100vh;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            top: -20%;
            right: -20%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(234, 161, 79, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .left-panel::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(26, 126, 134, 0.06) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .panel-content {
            position: relative;
            z-index: 2;
            max-width: 520px;
        }

        .agency-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 0.6rem 1.2rem;
            border-radius: 100px;
            margin-bottom: 2.5rem;
            align-self: flex-start;
        }

        .agency-badge .dot {
            width: 8px;
            height: 8px;
            background: var(--amber);
            border-radius: 50%;
            box-shadow: 0 0 16px rgba(234, 161, 79, 0.4);
            animation: pulse-dot 2s ease-in-out infinite;
        }

        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(0.8); }
        }

        .panel-title {
            font-size: 3.2rem;
            font-weight: 900;
            line-height: 1.08;
            color: var(--white);
            margin-bottom: 1.2rem;
            letter-spacing: -0.03em;
        }

        .panel-title .accent {
            color: var(--amber);
            position: relative;
        }

        .panel-title .accent::after {
            content: '';
            position: absolute;
            bottom: 2px;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--amber);
            border-radius: 4px;
            opacity: 0.4;
        }

        .panel-desc {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.75);
            line-height: 1.8;
            margin-bottom: 3rem;
            font-weight: 300;
            max-width: 440px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.06);
            padding: 1.2rem 1.5rem;
            border-radius: var(--radius-md);
            transition: var(--transition);
        }

        .stat-card:hover {
            background: rgba(255, 255, 255, 0.07);
            transform: translateY(-3px);
        }

        .stat-num {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--amber);
            line-height: 1;
            margin-bottom: 0.3rem;
        }

        .stat-label {
            font-size: 0.7rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.55);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* ===== RIGHT PANEL ===== */
        .right-panel {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 2.5rem;
            background: var(--sand-light);
        }

        .form-card {
            width: 100%;
            max-width: 480px;
            background: var(--white);
            padding: 3.2rem 3rem;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-soft);
            animation: slide-up 0.7s cubic-bezier(0.22, 1, 0.36, 1) forwards;
            border: 1px solid rgba(223, 234, 232, 0.3);
        }

        @keyframes slide-up {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .form-header {
            margin-bottom: 2.2rem;
            text-align: center;
        }

        .form-eyebrow {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--teal);
            margin-bottom: 0.4rem;
        }

        .form-title {
            font-size: 2rem;
            font-weight: 900;
            color: var(--petrol);
            line-height: 1.2;
            letter-spacing: -0.02em;
        }

        .form-title span {
            color: var(--teal);
        }

        /* Role selector */
        .role-selector {
            display: flex;
            background: var(--sand);
            border: 1px solid var(--mist);
            border-radius: 100px;
            padding: 4px;
            margin-bottom: 2rem;
        }

        .role-btn {
            flex: 1;
            padding: 0.7rem 0.8rem;
            border: none;
            border-radius: 100px;
            background: transparent;
            font-family: var(--font);
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--ink-soft);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: var(--transition);
        }

        .role-btn i {
            font-size: 0.9rem;
        }

        .role-btn.active {
            background: var(--teal);
            color: var(--white);
            box-shadow: 0 4px 12px rgba(26, 126, 134, 0.25);
        }

        .role-btn:not(.active):hover {
            background: var(--teal-alpha);
            color: var(--teal);
        }

        /* Form fields */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .field {
            margin-bottom: 1.2rem;
        }

        .form-grid .field {
            margin-bottom: 0;
        }

        .field-label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--petrol);
            margin-bottom: 0.5rem;
            padding-left: 0.2rem;
        }

        .field-label .optional {
            font-weight: 400;
            color: var(--ink-faint);
            font-size: 0.7rem;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap .ico {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--ink-faint);
            font-size: 0.95rem;
            transition: var(--transition);
            pointer-events: none;
        }

        .field-input {
            width: 100%;
            padding: 0.9rem 1.2rem 0.9rem 3rem;
            border: 1.5px solid var(--mist);
            border-radius: var(--radius-md);
            background: var(--white);
            font-size: 0.92rem;
            color: var(--ink);
            font-family: var(--font);
            transition: var(--transition);
        }

        .field-input::placeholder {
            color: var(--ink-faint);
            font-weight: 400;
            font-size: 0.88rem;
        }

        .field-input:focus {
            outline: none;
            border-color: var(--teal);
            box-shadow: 0 0 0 4px var(--teal-alpha);
        }

        .field-input:focus~.ico {
            color: var(--teal);
        }

        /* Bouton actif et amélioré */
        .btn-submit {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
            width: 100%;
            padding: 1.1rem;
            background: linear-gradient(135deg, var(--teal) 0%, var(--teal-light) 100%);
            color: var(--white);
            border: none;
            border-radius: var(--radius-md);
            font-family: var(--font);
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            transition: var(--transition);
            letter-spacing: 0.01em;
            margin-top: 1.8rem;
            box-shadow: 0 4px 16px rgba(26, 126, 134, 0.25);
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(26, 126, 134, 0.35);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-submit i {
            transition: transform 0.2s;
        }

        .btn-submit:hover i {
            transform: translateX(4px);
        }

        /* Form footer */
        .form-footer {
            margin-top: 1.8rem;
            text-align: center;
            font-size: 0.88rem;
            color: var(--ink-soft);
        }

        .form-footer a {
            color: var(--teal);
            font-weight: 700;
            text-decoration: none;
            border-bottom: 1.5px solid transparent;
            transition: var(--transition);
        }

        .form-footer a:hover {
            border-bottom-color: var(--teal);
            color: var(--teal-light);
        }

        .form-divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 1.5rem 0;
        }

        .form-divider::before,
        .form-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--mist);
        }

        .form-divider span {
            font-size: 0.7rem;
            font-weight: 600;
            color: var(--ink-faint);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            white-space: nowrap;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1024px) {
            .left-panel {
                flex: 0 0 48%;
                padding: 3rem 3rem;
            }
            .panel-title { font-size: 2.6rem; }
        }

        @media (max-width: 860px) {
            body { flex-direction: column; overflow-y: auto; }
            .left-panel {
                flex: 0 0 auto;
                padding: 3rem 2rem;
                min-height: 400px;
            }
            .left-panel::before,
            .left-panel::after { display: none; }
            .right-panel { padding: 2.5rem 1.5rem; }
            .form-card { padding: 2.5rem 2rem; max-width: 100%; }
            .panel-title { font-size: 2.2rem; }
            .stats-grid { gap: 0.8rem; }
            .stat-card { padding: 1rem 1.2rem; }
            .stat-num { font-size: 1.5rem; }
        }

        @media (max-width: 480px) {
            .form-grid { grid-template-columns: 1fr; gap: 0; }
            .form-grid .field { margin-bottom: 1.2rem; }
            .panel-title { font-size: 1.8rem; }
            .form-title { font-size: 1.6rem; }
            .form-card { padding: 2rem 1.5rem; }
            .role-btn { font-size: 0.65rem; padding: 0.6rem 0.4rem; gap: 4px; }
            .role-btn i { font-size: 0.8rem; }
            .stats-grid { grid-template-columns: repeat(3, 1fr); gap: 0.5rem; }
            .stat-card { padding: 0.8rem 0.8rem; text-align: center; }
            .stat-num { font-size: 1.2rem; }
            .stat-label { font-size: 0.6rem; }
            .left-panel { padding: 2rem 1.5rem; min-height: 320px; }
            .panel-desc { font-size: 0.85rem; margin-bottom: 2rem; }
            .agency-badge { font-size: 0.6rem; padding: 0.4rem 0.8rem; margin-bottom: 1.5rem; }
        }

        @media (max-width: 380px) {
            .stats-grid { grid-template-columns: 1fr 1fr; }
            .role-selector { flex-direction: column; border-radius: var(--radius-md); gap: 4px; padding: 6px; }
            .role-btn { border-radius: var(--radius-sm); padding: 0.6rem; }
        }
    </style>
</head>

<body>

    <!-- ============================================================
    LEFT PANEL
    ============================================================ -->
    <div class="left-panel">
        <div class="panel-content">

            <div class="agency-badge">
                <span class="dot"></span>
                AquaForm — Excellence E-learning
            </div>

            <h1 class="panel-title">
                Propulsez votre<br>
                <span class="accent">carrière</span> dans les métiers de l'eau
            </h1>

            <p class="panel-desc">
                Rejoignez la communauté de référence. Accédez instantanément à des formations
                certifiantes, techniques et réglementaires, conçues par des experts du secteur.
            </p>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-num">120+</div>
                    <div class="stat-label">Modules Pro</div>
                </div>
                <div class="stat-card">
                    <div class="stat-num">100%</div>
                    <div class="stat-label">Fluidité en ligne</div>
                </div>
                <div class="stat-card">
                    <div class="stat-num">24/7</div>
                    <div class="stat-label">Accès illimité</div>
                </div>
            </div>

        </div>
    </div>

    <!-- ============================================================
    RIGHT PANEL (FORM)
    ============================================================ -->
    <div class="right-panel">
        <div class="form-card">

            <div class="form-header">
                <p class="form-eyebrow">Commencer gratuitement</p>
                <h2 class="form-title">Créer votre <span>compte</span></h2>
            </div>

            <!-- Sélecteur de rôle -->
            <div class="role-selector" id="roleSelector">
                <button class="role-btn active" data-role="apprenant">
                    <i class="fas fa-user-graduate"></i> Apprenant
                </button>
                <button class="role-btn" data-role="formateur">
                    <i class="fas fa-chalkboard-teacher"></i> Formateur
                </button>
            </div>

            <!-- Formulaire avec validation simple -->
            <form id="registerForm" action="{{ route('register.success') }}" method="GET">

                <div class="form-grid">
                    <div class="field">
                        <label class="field-label" for="prenom">Prénom</label>
                        <div class="input-wrap">
                            <i class="ico fas fa-user"></i>
                            <input type="text" id="prenom" class="field-input"
                                   placeholder="Prénom" value="Jean" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="nom">Nom</label>
                        <div class="input-wrap">
                            <i class="ico fas fa-user"></i>
                            <input type="text" id="nom" class="field-input"
                                   placeholder="Nom" value="Dupont" required>
                        </div>
                    </div>
                </div>

                <div class="field">
                    <label class="field-label" for="email">Adresse e-mail professionnelle</label>
                    <div class="input-wrap">
                        <i class="ico fas fa-envelope"></i>
                        <input type="email" id="email" class="field-input"
                               placeholder="j.dupont@entreprise.fr" value="jean.dupont@exemple.com" required>
                    </div>
                </div>

                <div class="field">
                    <label class="field-label" for="telephone">Téléphone <span class="optional">(optionnel)</span></label>
                    <div class="input-wrap">
                        <i class="ico fas fa-phone"></i>
                        <input type="tel" id="telephone" class="field-input"
                               placeholder="06 12 34 56 78" value="06 12 34 56 78">
                    </div>
                </div>

                <div class="field">
                    <label class="field-label" for="password">Mot de passe</label>
                    <div class="input-wrap">
                        <i class="ico fas fa-lock"></i>
                        <input type="password" id="password" class="field-input"
                               placeholder="••••••••••••" value="password123" required minlength="6">
                    </div>
                </div>

                <div class="field">
                    <label class="field-label" for="password_confirmation">Confirmer le mot de passe</label>
                    <div class="input-wrap">
                        <i class="ico fas fa-shield-alt"></i>
                        <input type="password" id="password_confirmation" class="field-input"
                               placeholder="••••••••••••" value="password123" required minlength="6">
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    <span>Créer mon accès gratuit</span>
                    <i class="fas fa-arrow-right"></i>
                </button>
            </form>

            <!-- Separator -->
            <div class="form-divider">
                <span>Déjà inscrit ?</span>
            </div>

            <div class="form-footer">
                <a href="{{ route('login') }}">Se connecter à mon espace</a>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Rôle interactif
            const roleButtons = document.querySelectorAll('.role-btn');
            const emailField = document.getElementById('email');
            const prenomField = document.getElementById('prenom');
            const nomField = document.getElementById('nom');

            const roleData = {
                apprenant: {
                    email: 'jean.dupont@exemple.com',
                    prenom: 'Jean',
                    nom: 'Dupont'
                },
                formateur: {
                    email: 'sophie.martin@exemple.com',
                    prenom: 'Sophie',
                    nom: 'Martin'
                }
            };

            roleButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    roleButtons.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    const role = this.dataset.role;
                    if (roleData[role]) {
                        emailField.value = roleData[role].email;
                        prenomField.value = roleData[role].prenom;
                        nomField.value = roleData[role].nom;
                    }
                });
            });

            // Validation simple avant soumission (pour démonstration)
            const form = document.getElementById('registerForm');
            form.addEventListener('submit', function(e) {
                const password = document.getElementById('password').value;
                const confirm = document.getElementById('password_confirmation').value;

                if (password !== confirm) {
                    e.preventDefault();
                    alert('Les mots de passe ne correspondent pas.');
                    return;
                }

                // Si tout est ok, on laisse le formulaire soumettre vers la route de succès.
                // Dans un environnement réel, on enverrait les données via POST.
                // Ici, c'est une démo GET.
            });
        });
    </script>

</body>
</html>