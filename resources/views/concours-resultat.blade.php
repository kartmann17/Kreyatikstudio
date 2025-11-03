<x-header :seoData="$SEOData ?? null">
<x-slot name="slot">
<main class="main-page">

  <!-- Hero Section -->
  <section class="hero-section" aria-labelledby="results-hero-title">
    <div class="hero-background">
      <img src="{{ asset('images/compose.png') }}" alt="Résultats du Concours Kreyatik Studio" class="hero-bg-image" loading="eager" width="1920" height="1080">
      <div class="hero-overlay"></div>
      <div class="hero-particles"></div>
    </div>

    <div class="hero-container" style="text-align: center;">
      <!-- Badge -->
      <div class="results-badge" style="display: inline-block; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); padding: 12px 24px; border-radius: 50px; margin-bottom: 2rem; box-shadow: 0 4px 20px rgba(0,0,0,0.15);">
        <span style="font-size: 1.1rem; font-weight: 700; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
          🏆 RÉSULTATS DU CONCOURS
        </span>
      </div>

      <h1 id="results-hero-title" style="font-size: 3.5rem; font-weight: 900; margin-bottom: 1.5rem; color: white; text-shadow: 0 2px 20px rgba(0,0,0,0.3), 0 0 40px rgba(15, 23, 42, 0.5); line-height: 1.2;">
        Le Grand Gagnant<br>
        <span style="color: #fbbf24; text-shadow: 0 0 30px rgba(251, 191, 36, 0.8), 0 0 60px rgba(251, 191, 36, 0.5), 0 2px 20px rgba(0,0,0,0.3);">du Concours !</span>
      </h1>

      <p style="font-size: 1.3rem; color: white; max-width: 700px; margin: 2rem auto; text-shadow: 0 2px 10px rgba(0,0,0,0.3); line-height: 1.6;">
        Découvrez qui a remporté la <strong>création complète</strong> de son site web professionnel !
      </p>
    </div>
  </section>

  <!-- Section Résultat -->
  <section style="padding: 80px 20px; background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);">
    <div style="max-width: 1000px; margin: 0 auto;">

      <!-- Annonce du gagnant -->
      <div style="background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); padding: 3px; border-radius: 24px; margin-bottom: 60px; box-shadow: 0 10px 40px rgba(251, 191, 36, 0.3);">
        <div style="background: white; padding: 60px 40px; border-radius: 21px; text-align: center;">
          <div style="font-size: 4rem; margin-bottom: 20px;">🎉</div>
          <h2 style="font-size: 2rem; font-weight: 800; color: #1e293b; margin-bottom: 1rem;">Félicitations à</h2>

          <!-- Nom du gagnant - À PERSONNALISER -->
          <div style="font-size: 3.5rem; font-weight: 900; background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin: 30px 0; line-height: 1.2;">
            [Nom du Gagnant]
          </div>

          <p style="font-size: 1.2rem; color: #64748b; max-width: 600px; margin: 0 auto;">
            Qui remporte la création d'un site web professionnel d'une valeur de <strong>1 500€</strong> !
          </p>
        </div>
      </div>

      <!-- Détails du gain -->
      <div style="background: white; padding: 50px; border-radius: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.08); margin-bottom: 60px;">
        <h3 style="font-size: 2rem; font-weight: 800; color: #1e293b; margin-bottom: 2rem; text-align: center;">🎁 Ce que comprend le gain</h3>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px; margin-top: 40px;">
          <div style="text-align: center; padding: 30px; background: #f8fafc; border-radius: 16px; border: 2px solid #e2e8f0;">
            <div style="font-size: 2.5rem; margin-bottom: 15px;">📄</div>
            <h4 style="font-size: 1.2rem; font-weight: 700; color: #1e293b; margin-bottom: 10px;">5 Pages personnalisées</h4>
            <p style="color: #64748b; font-size: 0.95rem;">Hors mentions légales, CGV & CGU</p>
          </div>

          <div style="text-align: center; padding: 30px; background: #f8fafc; border-radius: 16px; border: 2px solid #e2e8f0;">
            <div style="font-size: 2.5rem; margin-bottom: 15px;">🚀</div>
            <h4 style="font-size: 1.2rem; font-weight: 700; color: #1e293b; margin-bottom: 10px;">SEO Optimisé</h4>
            <p style="color: #64748b; font-size: 0.95rem;">Référencement naturel optimisé</p>
          </div>

          <div style="text-align: center; padding: 30px; background: #f8fafc; border-radius: 16px; border: 2px solid #e2e8f0;">
            <div style="font-size: 2.5rem; margin-bottom: 15px;">🌐</div>
            <h4 style="font-size: 1.2rem; font-weight: 700; color: #1e293b; margin-bottom: 10px;">Nom de domaine</h4>
            <p style="color: #64748b; font-size: 0.95rem;">.fr ou .com au choix</p>
          </div>

          <div style="text-align: center; padding: 30px; background: #f8fafc; border-radius: 16px; border: 2px solid #e2e8f0;">
            <div style="font-size: 2.5rem; margin-bottom: 15px;">☁️</div>
            <h4 style="font-size: 1.2rem; font-weight: 700; color: #1e293b; margin-bottom: 10px;">Hébergement 1 an</h4>
            <p style="color: #64748b; font-size: 0.95rem;">Première année incluse</p>
          </div>

          <div style="text-align: center; padding: 30px; background: #f8fafc; border-radius: 16px; border: 2px solid #e2e8f0;">
            <div style="font-size: 2.5rem; margin-bottom: 15px;">🔧</div>
            <h4 style="font-size: 1.2rem; font-weight: 700; color: #1e293b; margin-bottom: 10px;">Support 6 mois</h4>
            <p style="color: #64748b; font-size: 0.95rem;">Assistance technique incluse</p>
          </div>

          <div style="text-align: center; padding: 30px; background: #f8fafc; border-radius: 16px; border: 2px solid #e2e8f0;">
            <div style="font-size: 2.5rem; margin-bottom: 15px;">📱</div>
            <h4 style="font-size: 1.2rem; font-weight: 700; color: #1e293b; margin-bottom: 10px;">Responsive Design</h4>
            <p style="color: #64748b; font-size: 0.95rem;">Parfait sur tous les appareils</p>
          </div>
        </div>
      </div>

      <!-- Remerciements -->
      <div style="background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%); padding: 50px; border-radius: 20px; text-align: center; color: white; box-shadow: 0 10px 40px rgba(59, 130, 246, 0.3);">
        <h3 style="font-size: 2rem; font-weight: 800; margin-bottom: 1rem;">Merci à tous les participants !</h3>
        <p style="font-size: 1.1rem; opacity: 0.95; max-width: 700px; margin: 0 auto; line-height: 1.6; color: white;">
          Nous avons été ravis de recevoir autant de participations. Merci pour votre enthousiasme et votre confiance.
          Restez connectés pour nos prochains événements !
        </p>

        <div style="margin-top: 2.5rem;">
          <a href="https://www.instagram.com/kreyatik_17/" target="_blank" rel="noopener noreferrer"
             class="instagram-btn"
             style="display: inline-flex; align-items: center; gap: 12px; background: linear-gradient(135deg, #E1306C 0%, #C13584 100%); color: white; padding: 16px 35px; border-radius: 50px; text-decoration: none; font-weight: 700; font-size: 1.1rem; transition: all 0.3s ease; box-shadow: 0 4px 20px rgba(225, 48, 108, 0.4);">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
            </svg>
            Suivez-nous sur Instagram
          </a>
        </div>
      </div>

      <!-- Statistiques du concours -->
      <div style="margin-top: 60px;">
        <h3 style="font-size: 1.8rem; font-weight: 800; color: #1e293b; margin-bottom: 2rem; text-align: center;">📊 Statistiques du concours</h3>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
          <div style="background: white; padding: 30px; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); text-align: center; border-top: 4px solid #3b82f6;">
            <div style="font-size: 2.5rem; font-weight: 900; color: #3b82f6; margin-bottom: 10px;">{{ $totalParticipants ?? '0' }}</div>
            <div style="font-size: 0.9rem; color: #64748b; font-weight: 600; text-transform: uppercase;">Participants</div>
          </div>

          <div style="background: white; padding: 30px; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); text-align: center; border-top: 4px solid #10b981;">
            <div style="font-size: 2.5rem; font-weight: 900; color: #10b981; margin-bottom: 10px;">{{ $daysTotal ?? '0' }}</div>
            <div style="font-size: 0.9rem; color: #64748b; font-weight: 600; text-transform: uppercase;">Jours de concours</div>
          </div>

          <div style="background: white; padding: 30px; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); text-align: center; border-top: 4px solid #f59e0b;">
            <div style="font-size: 2.5rem; font-weight: 900; color: #f59e0b; margin-bottom: 10px;">1 500€</div>
            <div style="font-size: 0.9rem; color: #64748b; font-weight: 600; text-transform: uppercase;">Valeur du gain</div>
          </div>
        </div>
      </div>

    </div>
  </section>

</main>
</x-slot>
</x-header>

<x-footer />

<style>
/* Animation du badge */
@keyframes pulse-gold {
  0%, 100% {
    transform: scale(1);
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
  }
  50% {
    transform: scale(1.05);
    box-shadow: 0 8px 30px rgba(251, 191, 36, 0.4);
  }
}

.results-badge {
  animation: pulse-gold 2s ease-in-out infinite;
}

/* Hover sur le bouton Instagram */
.instagram-btn:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 30px rgba(225, 48, 108, 0.5);
}

/* Responsive */
@media (max-width: 768px) {
  .hero-section h1 {
    font-size: 2rem !important;
  }

  .hero-section h1 span {
    font-size: 2.5rem !important;
  }
}
</style>
