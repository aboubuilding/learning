<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AquaForm | Inscription réussie</title>

    <!-- Kumbh Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --petrol: #0F3B43;
            --teal: #1A7E86;
            --teal-light: #24A1A9;
            --amber: #EAA14F;
            --sand: #F8F6F2;
            --ink: #161D1C;
            --white: #FFFFFF;
            --radius-lg: 24px;
            --font: 'Kumbh Sans', sans-serif;
        }

        body {
            font-family: var(--font);
            background: var(--sand);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .success-card {
            background: var(--white);
            max-width: 500px;
            width: 100%;
            padding: 3rem 2.5rem;
            border-radius: var(--radius-lg);
            box-shadow: 0 20px 60px rgba(15, 59, 67, 0.08);
            text-align: center;
            animation: slide-up 0.6s ease forwards;
        }

        @keyframes slide-up {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .success-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 80px;
            height: 80px;
            background: #e6f7f0;
            border-radius: 50%;
            font-size: 3rem;
            color: var(--teal);
            margin-bottom: 1.5rem;
        }

        h1 {
            font-size: 2rem;
            font-weight: 800;
            color: var(--petrol);
            margin-bottom: 0.8rem;
        }

        .subtitle {
            font-size: 1rem;
            color: #4F6561;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .btn-login {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            padding: 0.9rem 2.5rem;
            background: var(--teal);
            color: var(--white);
            border: none;
            border-radius: 50px;
            font-family: var(--font);
            font-size: 0.95rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 16px rgba(26, 126, 134, 0.2);
            cursor: pointer;
        }

        .btn-login:hover {
            background: var(--teal-light);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(26, 126, 134, 0.3);
        }

        .btn-login i {
            transition: transform 0.2s;
        }

        .btn-login:hover i {
            transform: translateX(4px);
        }

        .back-home {
            display: block;
            margin-top: 1.5rem;
            color: var(--ink);
            font-size: 0.85rem;
            opacity: 0.6;
            transition: 0.2s;
            text-decoration: none;
        }

        .back-home:hover {
            opacity: 1;
            color: var(--teal);
        }

        @media (max-width: 480px) {
            .success-card {
                padding: 2rem 1.5rem;
            }
            h1 { font-size: 1.6rem; }
            .success-icon { width: 60px; height: 60px; font-size: 2.2rem; }
        }
    </style>
</head>

<body>

    <div class="success-card">
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <h1>🎉 Félicitations !</h1>
        <p class="subtitle">
            Votre compte a été créé avec succès.<br>
            Vous pouvez dès maintenant accéder à votre espace de formation.
        </p>

        <a href="{{ route('login') }}" class="btn-login">
            <span>Se connecter</span>
            <i class="fas fa-arrow-right"></i>
        </a>

        <a href="{{ route('home') }}" class="back-home">
            Retour à l'accueil
        </a>
    </div>

</body>
</html>