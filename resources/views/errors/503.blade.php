<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance - Kreyatik Studio</title>
    <meta name="description" content="Site en maintenance - Kreyatik Studio revient bientôt avec de nouvelles fonctionnalités">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-blue: #3B82F6;
            --primary-dark: #1E40AF;
            --secondary: #8B5CF6;
            --accent: #F59E0B;
            --text-dark: #1F2937;
            --text-light: #6B7280;
            --bg-light: #F8FAFC;
            --white: #FFFFFF;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Background Animation */
        .bg-animation {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Ccircle cx='20' cy='20' r='20'/%3E%3C/g%3E%3C/svg%3E");
            animation: float 20s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        /* Floating Elements */
        .floating-elements {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .floating-card {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            padding: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: white;
            animation: floatCard 15s ease-in-out infinite;
        }

        .floating-card:nth-child(1) {
            top: 15%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-card:nth-child(2) {
            top: 25%;
            right: 15%;
            animation-delay: 5s;
        }

        .floating-card:nth-child(3) {
            bottom: 20%;
            left: 15%;
            animation-delay: 10s;
        }

        .floating-card:nth-child(4) {
            bottom: 15%;
            right: 10%;
            animation-delay: 7s;
        }

        @keyframes floatCard {
            0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0.7; }
            50% { transform: translateY(-30px) rotate(5deg); opacity: 1; }
        }

        /* Main Container */
        .maintenance-container {
            background: var(--white);
            border-radius: 24px;
            padding: 3rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            text-align: center;
            max-width: 500px;
            width: 90%;
            position: relative;
            z-index: 10;
            animation: slideIn 1s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .maintenance-icon {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            animation: bounce 2s ease-in-out infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .maintenance-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .maintenance-subtitle {
            font-size: 1.125rem;
            color: var(--primary-blue);
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .maintenance-description {
            font-size: 1rem;
            color: var(--text-light);
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .maintenance-features {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin: 2rem 0;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            color: var(--text-light);
            padding: 0.5rem;
            background: var(--bg-light);
            border-radius: 8px;
        }

        .contact-info {
            background: linear-gradient(135deg, var(--primary-blue), var(--primary-dark));
            color: white;
            padding: 1.5rem;
            border-radius: 16px;
            margin-top: 2rem;
        }

        .contact-info h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
        }

        .contact-item:last-child {
            margin-bottom: 0;
        }

        .contact-item svg {
            width: 18px;
            height: 18px;
        }

        .contact-item a {
            color: white;
            text-decoration: none;
            font-weight: 500;
        }

        .contact-item a:hover {
            text-decoration: underline;
        }

        .progress-bar {
            width: 100%;
            height: 6px;
            background: var(--bg-light);
            border-radius: 3px;
            margin: 2rem 0;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary-blue), var(--secondary));
            border-radius: 3px;
            animation: progress 3s ease-in-out infinite;
        }

        @keyframes progress {
            0% { width: 0%; }
            50% { width: 75%; }
            100% { width: 100%; }
        }

        .back-soon {
            font-size: 0.875rem;
            color: var(--accent);
            font-weight: 600;
            margin-top: 1rem;
        }

        @media (max-width: 768px) {
            .maintenance-container {
                padding: 2rem;
                margin: 1rem;
            }

            .maintenance-title {
                font-size: 2rem;
            }

            .maintenance-features {
                grid-template-columns: 1fr;
            }

            .floating-card {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="bg-animation"></div>
    
    <div class="floating-elements">
        <div class="floating-card">🛠️ Mise à jour</div>
        <div class="floating-card">⚡ Performance</div>
        <div class="floating-card">🔒 Sécurité</div>
        <div class="floating-card">✨ Nouvelles fonctionnalités</div>
    </div>

    <div class="maintenance-container">
        <div class="maintenance-icon">🚧</div>
        
        <h1 class="maintenance-title">Site en maintenance</h1>
        <p class="maintenance-subtitle">Nous améliorons votre expérience !</p>
        
        <p class="maintenance-description">
            Notre équipe travaille actuellement sur de nouvelles fonctionnalités et des améliorations 
            pour vous offrir une meilleure expérience. Le site sera bientôt de retour en ligne.
        </p>

        <div class="maintenance-features">
            <div class="feature-item">
                <span>⚡</span>
                <span>Optimisation des performances</span>
            </div>
            <div class="feature-item">
                <span>🔒</span>
                <span>Renforcement de la sécurité</span>
            </div>
            <div class="feature-item">
                <span>✨</span>
                <span>Nouvelles fonctionnalités</span>
            </div>
            <div class="feature-item">
                <span>🎨</span>
                <span>Interface améliorée</span>
            </div>
        </div>

        <div class="progress-bar">
            <div class="progress-fill"></div>
        </div>

        <p class="back-soon">⏰ Retour prévu sous peu</p>

        <div class="contact-info">
            <h3>Besoin d'aide urgente ?</h3>
            <div class="contact-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
                <a href="tel:+33695800663">+33 6 95 80 06 63</a>
            </div>
            <div class="contact-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <a href="mailto:kreyatik@gmail.com">kreyatik@gmail.com</a>
            </div>
        </div>
    </div>
</body>
</html>