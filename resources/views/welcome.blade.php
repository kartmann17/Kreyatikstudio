<x-header :seoData="$SEOData ?? null">
<x-slot name="slot">
<main class="main-page">

  {{-- GRAIN OVERLAY --}}
  <div class="grain-overlay" aria-hidden="true"></div>

  {{-- ==================== HERO ==================== --}}
  <section class="hero-section" aria-labelledby="hero-title">
    <div class="hero-background">
      <picture>
        <source media="(max-width: 768px)" srcset="{{ asset('images/optimized/compose-mobile.webp') }}" type="image/webp" width="768" height="432">
        <source media="(min-width: 769px)" srcset="{{ asset('images/optimized/compose.webp') }}" type="image/webp" width="1920" height="1080">
        <img src="{{ asset('images/compose.png') }}" alt="Kreyatik Studio - Développeur Web Freelance spécialisé en création sites internet Rochefort, développement web moderne et référencement SEO expert" class="hero-bg-image" loading="eager" width="1920" height="1080">
      </picture>
      <div class="hero-overlay"></div>
      <div class="hero-mesh" aria-hidden="true"></div>
    </div>

    <div class="hero-container">
      <div class="hero-content">
        <div class="hero-badge reveal" aria-label="Badge développeur web">
          <span class="badge-dot"></span>
          <span class="badge-text">Kreyatik Studio</span>
        </div>
        <h1 id="hero-title" class="hero-title">
          <span class="title-line reveal reveal-delay-1">Transformons vos</span>
          <span class="title-highlight reveal reveal-delay-2">idées en succès</span>
          <span class="title-line reveal reveal-delay-3">digital</span>
        </h1>
        <p class="hero-description reveal reveal-delay-4">
          <strong>Kreyatik Studio</strong> - Votre partenaire digital de confiance pour des sites web
          <span class="highlight-text">performants</span>, <span class="highlight-text">innovants</span> et
          <span class="highlight-text">rentables</span>. Expertise en développement web, design UX/UI et marketing digital.
          <strong>Développeur web freelance Rochefort</strong>, <strong>création site internet</strong>, <strong>développement web</strong>,
          <strong>design graphique</strong> et <strong>référencement naturel</strong>.
        </p>
        <div class="hero-actions reveal reveal-delay-5">
          <a href="#why-choose" class="btn btn-primary" aria-label="Découvrir nos avantages">
            <span>Découvrir nos avantages</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
          </a>
          <a href="#contact" class="btn btn-glass" aria-label="Audit gratuit SEO">
            <span>Audit gratuit SEO</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
          </a>
        </div>
      </div>

      <div class="hero-metrics reveal reveal-delay-5" role="region" aria-label="Statistiques du développeur freelance">
        <div class="metric-card">
          <span class="metric-number" data-target="+10">+10</span>
          <span class="metric-label">Projets réalisés</span>
        </div>
        <div class="metric-card">
          <span class="metric-number" data-target="98%">98%</span>
          <span class="metric-label">Clients satisfaits</span>
        </div>
        <div class="metric-card">
          <span class="metric-number" data-target="24h">24h</span>
          <span class="metric-label">Temps de réponse</span>
        </div>
      </div>
    </div>

    <div class="hero-scroll-hint" aria-hidden="true">
      <div class="scroll-mouse">
        <div class="scroll-wheel"></div>
      </div>
    </div>
  </section>

  {{-- ==================== SERVICES (BENTO GRID) ==================== --}}
  <section class="services-section" id="services" aria-labelledby="services-title">
    <div class="container">
      <div class="section-header">
        <span class="section-tag reveal">Nos Services</span>
        <h2 id="services-title" class="section-title reveal reveal-delay-1">Solutions Digitales <span class="text-gradient">Complètes</span></h2>
        <p class="section-description reveal reveal-delay-2">
          De la <strong>conception créative</strong> à la <strong>mise en ligne optimisée</strong>,
          nous accompagnons votre transformation digitale avec des solutions sur-mesure.
        </p>
      </div>

      <div class="bento-grid">
        <article class="bento-card bento-large reveal" itemscope itemtype="https://schema.org/Service">
          <div class="bento-glow bento-glow-cyan"></div>
          <div class="bento-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
            </svg>
          </div>
          <h3 itemprop="name">Développement Web Avancé</h3>
          <p itemprop="description">Sites vitrines, e-commerce, SAAS, applications web sur-mesure avec les dernières technologies. <strong>Développement Laravel</strong>, <strong>WordPress</strong>, <strong>React</strong>, <strong>Vue.js</strong> et <strong>PHP</strong>.</p>
          <div class="bento-tags">
            <span>Responsive Design</span>
            <span>Performance</span>
            <span>Sécurité</span>
          </div>
          <meta itemprop="provider" content="Kreyatik Studio">
        </article>

        <article class="bento-card reveal reveal-delay-1" itemscope itemtype="https://schema.org/Service">
          <div class="bento-glow bento-glow-gold"></div>
          <div class="bento-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <path d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z" />
            </svg>
          </div>
          <h3 itemprop="name">Design & UX Créatif</h3>
          <p itemprop="description">Interfaces modernes et intuitives qui captent l'attention et convertissent. <strong>Design graphique</strong>, <strong>identité visuelle</strong> et <strong>logo design</strong>.</p>
          <div class="bento-tags">
            <span>Design System</span>
            <span>UX/UI</span>
            <span>Prototypage</span>
          </div>
          <meta itemprop="provider" content="Kreyatik Studio">
        </article>

        <article class="bento-card reveal reveal-delay-2" itemscope itemtype="https://schema.org/Service">
          <div class="bento-glow bento-glow-green"></div>
          <div class="bento-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <path d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
          </div>
          <h3 itemprop="name">SEO & Marketing Digital</h3>
          <p itemprop="description">Optimisation moteurs de recherche et stratégies marketing digital pour booster votre visibilité. <strong>Référencement naturel</strong>, <strong>Google Ads</strong> et <strong>content marketing</strong>.</p>
          <div class="bento-tags">
            <span>SEO</span>
            <span>Analytics</span>
            <span>ROI</span>
          </div>
          <meta itemprop="provider" content="Kreyatik Studio">
        </article>
      </div>
    </div>
  </section>

  {{-- ==================== POURQUOI NOUS CHOISIR ==================== --}}
  <section class="why-section" id="why-choose" aria-labelledby="why-choose-title">
    <div class="container">
      <div class="section-header">
        <span class="section-tag reveal">Pourquoi Nous</span>
        <h2 id="why-choose-title" class="section-title reveal reveal-delay-1">Votre Succès, <span class="text-gradient">Notre Priorité</span></h2>
        <p class="section-description reveal reveal-delay-2">
          Nous nous différencions par notre <strong>approche personnalisée</strong>, notre <strong>expertise technique</strong>
          et notre <strong>engagement total</strong> envers votre réussite digitale.
        </p>
      </div>

      <div class="why-grid">
        <article class="why-card reveal" itemscope itemtype="https://schema.org/Service">
          <div class="why-card-number">01</div>
          <div class="why-card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
            </svg>
          </div>
          <h3 itemprop="name">Excellence Technique</h3>
          <p itemprop="description">Technologies de pointe, code propre et optimisé, respect des standards web les plus élevés. <strong>Développement web moderne</strong> et <strong>architectures performantes</strong>.</p>
          <div class="why-tags">
            <span>Performance</span>
            <span>Sécurité</span>
            <span>Responsive</span>
          </div>
        </article>

        <article class="why-card reveal reveal-delay-1" itemscope itemtype="https://schema.org/Service">
          <div class="why-card-number">02</div>
          <div class="why-card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
              <circle cx="9" cy="7" r="4" />
              <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
              <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            </svg>
          </div>
          <h3 itemprop="name">Accompagnement Personnalisé</h3>
          <p itemprop="description">Un suivi sur-mesure, des conseils d'experts et une relation de confiance durable. <strong>Conseil digital</strong> et <strong>formation utilisateurs</strong>.</p>
          <div class="why-tags">
            <span>Disponibilité</span>
            <span>Communication</span>
            <span>Support</span>
          </div>
        </article>

        <article class="why-card reveal reveal-delay-2" itemscope itemtype="https://schema.org/Service">
          <div class="why-card-number">03</div>
          <div class="why-card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z" />
              <path d="M2 12h20" />
              <path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z" />
            </svg>
          </div>
          <h3 itemprop="name">Solutions Sur-Mesure</h3>
          <p itemprop="description">Chaque projet est unique. Nous créons des solutions adaptées à vos besoins spécifiques. <strong>Site web sur mesure</strong> et <strong>développement spécifique</strong>.</p>
          <div class="why-tags">
            <span>Design Unique</span>
            <span>Sur-Mesure</span>
            <span>Analytics</span>
          </div>
        </article>

        <article class="why-card reveal reveal-delay-3" itemscope itemtype="https://schema.org/Service">
          <div class="why-card-number">04</div>
          <div class="why-card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
              <polyline points="22,4 12,14.01 9,11.01" />
            </svg>
          </div>
          <h3 itemprop="name">Garanties & Engagement</h3>
          <p itemprop="description">Satisfaction garantie, maintenance incluse et support réactif pour votre tranquillité. <strong>Maintenance site web</strong> et <strong>support technique</strong>.</p>
          <div class="why-tags">
            <span>Garantie</span>
            <span>Maintenance</span>
            <span>Support 24h</span>
          </div>
        </article>
      </div>
    </div>
  </section>

  {{-- ==================== PROCESSUS ==================== --}}
  <section class="process-section" id="process" aria-labelledby="process-title">
    <div class="container">
      <div class="section-header">
        <span class="section-tag reveal">Notre Processus</span>
        <h2 id="process-title" class="section-title reveal reveal-delay-1">Une Méthodologie <span class="text-gradient">Éprouvée</span></h2>
        <p class="section-description reveal reveal-delay-2">
          Un processus en <strong>4 étapes</strong> pour garantir la réussite de votre projet digital.
        </p>
      </div>

      <div class="process-timeline">
        <div class="timeline-line" aria-hidden="true"></div>

        <div class="process-step reveal" data-step="1">
          <div class="step-marker">
            <span class="step-number">01</span>
          </div>
          <div class="step-content">
            <h3>Analyse & Stratégie</h3>
            <p>Étude approfondie de vos besoins, analyse de la concurrence et définition de la stratégie digitale optimale. <strong>Audit SEO</strong>, <strong>étude de marché</strong> et <strong>analyse concurrentielle</strong>.</p>
            <div class="step-deliverables">
              <span>Brief créatif</span>
              <span>Plan stratégique</span>
              <span>Moodboard</span>
            </div>
          </div>
        </div>

        <div class="process-step reveal reveal-delay-1" data-step="2">
          <div class="step-marker">
            <span class="step-number">02</span>
          </div>
          <div class="step-content">
            <h3>Design & Conception</h3>
            <p>Création de maquettes, design d'interface et validation de l'expérience utilisateur. <strong>Maquette site web</strong>, <strong>wireframe</strong> et <strong>prototypage</strong>.</p>
            <div class="step-deliverables">
              <span>Maquettes</span>
              <span>Design System</span>
              <span>Guide Style</span>
            </div>
          </div>
        </div>

        <div class="process-step reveal reveal-delay-2" data-step="3">
          <div class="step-marker">
            <span class="step-number">03</span>
          </div>
          <div class="step-content">
            <h3>Développement & Tests</h3>
            <p>Développement technique, intégration et tests rigoureux pour garantir la qualité. <strong>Programmation web</strong>, <strong>front-end</strong>, <strong>back-end</strong> et <strong>tests qualité</strong>.</p>
            <div class="step-deliverables">
              <span>Site fonctionnel</span>
              <span>Version mobile</span>
              <span>Performance</span>
            </div>
          </div>
        </div>

        <div class="process-step reveal reveal-delay-3" data-step="4">
          <div class="step-marker">
            <span class="step-number">04</span>
          </div>
          <div class="step-content">
            <h3>Mise en Ligne & Suivi</h3>
            <p>Déploiement, formation et accompagnement post-lancement pour votre réussite. <strong>Mise en ligne</strong>, <strong>hébergement</strong>, <strong>formation</strong> et <strong>maintenance</strong>.</p>
            <div class="step-deliverables">
              <span>Site en ligne</span>
              <span>Documentation</span>
              <span>Support</span>
            </div>
          </div>
        </div>
      </div>

      <div class="process-cta reveal">
        <div class="cta-inner">
          <h3>Prêt à lancer votre projet ?</h3>
          <p>Découvrez comment notre processus peut transformer votre vision en réalité digitale.</p>
          <div class="cta-actions">
            <a href="#contact-form" class="btn btn-primary btn-large">
              <span>Démarrer mon projet</span>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M5 12h14M12 5l7 7-7 7"/>
              </svg>
            </a>
            <a href="/Portfolio" class="btn btn-glass btn-large">
              <span>Voir nos réalisations</span>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                <circle cx="12" cy="12" r="3"/>
              </svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- ==================== TÉMOIGNAGES ==================== --}}
  <section class="testimonials-section" aria-labelledby="testimonials-title">
    <div class="container">
      <div class="section-header">
        <span class="section-tag reveal">Témoignages</span>
        <h2 id="testimonials-title" class="section-title reveal reveal-delay-1">Ils Nous Font <span class="text-gradient">Confiance</span></h2>
      </div>
      <div class="testimonials-grid">
        <article class="testimonial-card reveal" itemscope itemtype="https://schema.org/Review">
          <div class="testimonial-stars" aria-label="5 étoiles">
            <svg viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            <svg viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            <svg viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            <svg viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            <svg viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
          </div>
          <blockquote class="testimonial-text" itemprop="reviewBody">
            "Une équipe exceptionnelle qui a su comprendre nos besoins et créer un site parfaitement adapté.
            Les résultats dépassent nos attentes avec une augmentation de 300% du trafic !"
          </blockquote>
          <div class="testimonial-author">
            <div class="author-avatar">RG</div>
            <div class="author-info">
              <h4 itemprop="author">Romain G.</h4>
              <span>Fondateur, Loukart</span>
            </div>
          </div>
          <div itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
            <meta itemprop="ratingValue" content="5">
            <meta itemprop="bestRating" content="5">
          </div>
          <div itemprop="itemReviewed" itemscope itemtype="https://schema.org/Organization">
            <meta itemprop="name" content="Kreyatik Studio">
            <meta itemprop="url" content="{{ url('/') }}">
          </div>
        </article>

        <article class="testimonial-card reveal reveal-delay-1" itemscope itemtype="https://schema.org/Review">
          <div class="testimonial-stars" aria-label="5 étoiles">
            <svg viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            <svg viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            <svg viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            <svg viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            <svg viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
          </div>
          <blockquote class="testimonial-text" itemprop="reviewBody">
            "Réactivité, créativité et professionnalisme. Kreyatik Studio a transformé notre vision
            en une réalité digitale exceptionnelle. ROI immédiat !"
          </blockquote>
          <div class="testimonial-author">
            <div class="author-avatar">FL</div>
            <div class="author-info">
              <h4 itemprop="author">Fred L.</h4>
              <span>Fondateur, Snack</span>
            </div>
          </div>
          <div itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
            <meta itemprop="ratingValue" content="5">
            <meta itemprop="bestRating" content="5">
          </div>
          <div itemprop="itemReviewed" itemscope itemtype="https://schema.org/Organization">
            <meta itemprop="name" content="Kreyatik Studio">
            <meta itemprop="url" content="{{ url('/') }}">
          </div>
        </article>
      </div>
    </div>
  </section>

  {{-- ==================== BLOG ==================== --}}
  <section class="blog-section" aria-labelledby="blog-title">
    <div class="container">
      <div class="section-header">
        <span class="section-tag reveal">Blog</span>
        <h2 id="blog-title" class="section-title reveal reveal-delay-1">Nos Derniers <span class="text-gradient">Articles</span></h2>
        <p class="section-description reveal reveal-delay-2">
          Découvrez nos conseils d'experts, astuces et actualités du <strong>développement web</strong>,
          <strong>référencement SEO</strong> et <strong>marketing digital</strong>.
        </p>
      </div>

      @if(isset($latestArticles) && $latestArticles->count() > 0)
        <div class="blog-grid">
          @foreach($latestArticles->take(2) as $index => $article)
            <article class="blog-card reveal {{ $index > 0 ? 'reveal-delay-1' : '' }}" itemscope itemtype="https://schema.org/BlogPosting">
              <div class="blog-card-image">
                @if($article->image)
                  <img src="{{ asset('storage/' . $article->image) }}"
                       alt="Image de l'article {{ $article->title }}"
                       loading="lazy"
                       itemprop="image">
                @else
                  <div class="blog-card-placeholder">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                      <path d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                  </div>
                @endif
              </div>
              <div class="blog-card-body">
                <div class="blog-card-meta">
                  <time datetime="{{ $article->published_at ? $article->published_at->format('Y-m-d') : $article->created_at->format('Y-m-d') }}" itemprop="datePublished">
                    {{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}
                  </time>
                  <span class="meta-sep"></span>
                  <span>{{ ceil(str_word_count(strip_tags($article->content)) / 200) }} min de lecture</span>
                </div>
                <h3 itemprop="headline">
                  <a href="{{ route('blog.show', $article->slug) }}" itemprop="url">
                    {!! html_entity_decode(Str::limit($article->title, 60)) !!}
                  </a>
                </h3>
                <p itemprop="description">
                  {!! Str::limit(html_entity_decode(strip_tags($article->content)), 100) !!}
                </p>
                <a href="{{ route('blog.show', $article->slug) }}" class="blog-card-link">
                  Lire l'article
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                  </svg>
                </a>
              </div>
              <meta itemprop="author" content="Kreyatik Studio">
              <meta itemprop="publisher" content="Kreyatik Studio">
            </article>
          @endforeach
        </div>

        <div class="blog-cta reveal">
          <a href="{{ route('blog') }}" class="btn btn-glass">
            <span>Voir tous nos articles</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M5 12h14M12 5l7 7-7 7"/>
            </svg>
          </a>
        </div>
      @else
        <div class="blog-empty reveal">
          <h3>Articles en préparation</h3>
          <p>Nous travaillons sur de nouveaux contenus passionnants. Revenez bientôt !</p>
        </div>
      @endif
    </div>
  </section>

  {{-- ==================== CTA ==================== --}}
  <section class="cta-section" id="contact" aria-labelledby="cta-title">
    <div class="cta-bg-mesh" aria-hidden="true"></div>
    <div class="container">
      <div class="cta-content reveal">
        <h2 id="cta-title">Prêt à Transformer Votre <span class="text-gradient-light">Présence Digitale</span> ?</h2>
        <p>Discutons de votre projet et créons ensemble quelque chose d'<strong>extraordinaire</strong> qui génère des <strong>résultats concrets</strong>.</p>
        <div class="cta-actions">
          <a href="#contact-form" class="btn btn-primary btn-large" aria-label="Commencer votre projet">
            <span>Commencer votre projet</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
          </a>
          <a href="tel:+33695800663" class="btn btn-glass btn-large" aria-label="Appelez-nous">
            <span>Appelez-nous</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z" />
            </svg>
          </a>
        </div>
      </div>
    </div>
  </section>

  {{-- ==================== CONTACT ==================== --}}
  <section class="contact-section" id="contact-form" aria-labelledby="contact-title">
    <div class="container">
      <div class="section-header">
        <span class="section-tag reveal">Contact</span>
        <h2 id="contact-title" class="section-title reveal reveal-delay-1">Parlons de Votre <span class="text-gradient">Projet</span></h2>
        <p class="section-description reveal reveal-delay-2">Remplissez le formulaire ci-dessous et nous vous recontacterons dans les <strong>24h</strong> avec une proposition personnalisée.</p>
      </div>

      <div class="contact-grid">
        <div class="contact-info reveal">
          <div class="contact-info-header">
            <h3>Nos Coordonnées</h3>
            <p>N'hésitez pas à nous contacter directement ou via le formulaire.</p>
          </div>

          <div class="contact-details">
            <a href="tel:+33695800663" class="contact-item">
              <div class="contact-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                  <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z" />
                </svg>
              </div>
              <div class="contact-text">
                <h4>Téléphone</h4>
                <p>+33 6 95 80 06 63</p>
              </div>
            </a>

            <a href="mailto:kreyatik@gmail.com" class="contact-item">
              <div class="contact-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                  <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                  <polyline points="22,6 12,13 2,6" />
                </svg>
              </div>
              <div class="contact-text">
                <h4>Email</h4>
                <p>kreyatik@gmail.com</p>
              </div>
            </a>

            <div class="contact-item">
              <div class="contact-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                  <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
                  <circle cx="12" cy="10" r="3" />
                </svg>
              </div>
              <div class="contact-text">
                <h4>Adresse</h4>
                <p>2 rue du petit port marchand<br>17300 Rochefort, France</p>
              </div>
            </div>
          </div>

          <div class="contact-badges">
            <div class="contact-badge">
              <span class="badge-icon-el">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
              </span>
              <div>
                <strong>Réponse Rapide</strong>
                <span>Sous 24h</span>
              </div>
            </div>
            <div class="contact-badge">
              <span class="badge-icon-el">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22,4 12,14.01 9,11.01"/></svg>
              </span>
              <div>
                <strong>Devis Gratuit</strong>
                <span>Sans engagement</span>
              </div>
            </div>
          </div>
        </div>

        <div class="contact-form-container reveal reveal-delay-1">
          <div class="form-header">
            <h3>Envoyez-nous un message</h3>
            <p>Décrivez votre projet et nous vous répondrons rapidement.</p>
          </div>

          <form action="{{ route('send.email') }}" method="post" class="contact-form" id="contactForm" itemscope itemtype="https://schema.org/ContactPage">
            @csrf
            <div class="form-row">
              <div class="form-group">
                <label for="name" class="form-label">Nom complet</label>
                <input type="text" id="name" name="name" placeholder="Votre nom complet" required class="form-input" itemprop="name" autocomplete="name">
              </div>
              <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" placeholder="Votre email" required class="form-input" itemprop="email" autocomplete="email">
              </div>
            </div>

            <div class="form-group">
              <label for="object" class="form-label">Objet</label>
              <input type="text" id="object" name="object_message" placeholder="Objet de votre message" required class="form-input">
            </div>

            <div class="form-group form-group-grow">
              <label for="message" class="form-label">Message</label>
              <textarea id="message" name="message" placeholder="Décrivez votre projet, vos besoins, votre budget..." rows="5" required class="form-textarea" itemprop="description"></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-full" aria-label="Envoyer le message">
              <span>Envoyer le message</span>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="22" y1="2" x2="11" y2="13" />
                <polygon points="22,2 15,22 11,13 2,9 22,2" />
              </svg>
            </button>
          </form>

          <div class="form-messages">
            <div id="error-message" class="message message-error hidden" role="alert"></div>
            <div id="success-message" class="message message-success hidden" role="alert"></div>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>

{{-- Scroll Reveal Script --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Intersection Observer for scroll reveals
  const revealElements = document.querySelectorAll('.reveal');
  const observerOptions = {
    root: null,
    rootMargin: '0px 0px -60px 0px',
    threshold: 0.1
  };

  const revealObserver = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('revealed');
        revealObserver.unobserve(entry.target);
      }
    });
  }, observerOptions);

  revealElements.forEach(function(el) {
    revealObserver.observe(el);
  });

  // Counter animation for hero metrics
  const metrics = document.querySelectorAll('.metric-number');
  const metricsObserver = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('counted');
        metricsObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.5 });

  metrics.forEach(function(el) { metricsObserver.observe(el); });

  // Parallax on hero background
  var heroSection = document.querySelector('.hero-section');
  if (heroSection && window.matchMedia('(prefers-reduced-motion: no-preference)').matches) {
    window.addEventListener('scroll', function() {
      var scrollY = window.scrollY;
      if (scrollY < window.innerHeight) {
        var heroImg = heroSection.querySelector('.hero-bg-image');
        if (heroImg) {
          heroImg.style.transform = 'scale(1.1) translateY(' + (scrollY * 0.15) + 'px)';
        }
      }
    }, { passive: true });
  }
});
</script>

</x-slot>
</x-header>

<x-footer />
