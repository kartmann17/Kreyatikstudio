<x-header :seoData="$SEOData ?? null">
<x-slot name="slot">
<main class="main-page">


  <section class="hero-section" aria-labelledby="hero-title">
    <div class="hero-background">
      <picture>
        <source media="(max-width: 768px)" srcset="{{ asset('images/optimized/compose-mobile.webp') }}" type="image/webp" width="768" height="432">
        <source media="(min-width: 769px)" srcset="{{ asset('images/optimized/compose.webp') }}" type="image/webp" width="1920" height="1080">
        <img src="{{ asset('images/compose.png') }}" alt="Kreyatik Studio - Développeur Web Freelance spécialisé en création sites internet Rochefort, développement web moderne et référencement SEO expert" class="hero-bg-image" loading="eager" width="1920" height="1080">
      </picture>
      <div class="hero-overlay"></div>
      <div class="hero-particles"></div>
    </div>
    <div class="hero-container">
      <div class="hero-content">
        <div class="hero-badge" aria-label="Badge développeur web">
          <span class="badge-text">🚀 Développeur Web Kreyatik Studio</span>
        </div>
        <h1 id="hero-title" class="hero-title">
          <span class="title-line">Transformons vos</span>
          <span class="title-highlight">idées en succès</span>
          <span class="title-line">digital</span>
        </h1>
        <p class="hero-description">
          <strong>Kreyatik Studio</strong> - Votre partenaire digital de confiance pour des sites web
          <span class="highlight-text">performants</span>, <span class="highlight-text">innovants</span> et
          <span class="highlight-text">rentables</span>. Expertise en développement web, design UX/UI et marketing digital.
          <strong>Développeur web freelance Rochefort</strong>, <strong>création site internet</strong>, <strong>développement web</strong>,
          <strong>design graphique</strong> et <strong>référencement naturel</strong>.
        </p>
        <div class="hero-actions">
          <a href="#why-choose" class="btn btn-primary" aria-label="Découvrir nos avantages">
            <span>🎯 Découvrir nos avantages</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
          </a>
          <a href="#contact" class="btn btn-secondary" aria-label="Audit gratuit SEO">
            <span>📊 Audit gratuit SEO</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-1.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22" />
            </svg>
          </a>
        </div>
        <div class="hero-stats" role="region" aria-label="Statistiques du développeur freelance">
          <div class="stat-item">
            <span class="stat-number" data-target="+10">+10</span>
            <span class="stat-label">Projets réalisés</span>
          </div>
          <div class="stat-item">
            <span class="stat-number" data-target="98%">98%</span>
            <span class="stat-label"> Clients satisfaits</span>
          </div>
          <div class="stat-item">
            <span class="stat-number" data-target="24h">24h</span>
            <span class="stat-label"> Temps de réponse</span>
          </div>
        </div>
      </div>
      <div class="hero-visual">
        <div class="floating-elements">
          <div class="floating-card card-1" aria-label="Design UX/UI">
            <div class="card-icon">🎨</div>
            <span>Design UX/UI</span>
          </div>
          <div class="floating-card card-2" aria-label="Performance Web">
            <div class="card-icon">⚡</div>
            <span>Performance Web</span>
          </div>
          <div class="floating-card card-3" aria-label="SEO Avancé">
            <div class="card-icon">🔍</div>
            <span>SEO Avancé</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- SERVICES-->
  <section class="services-section" id="services" aria-labelledby="services-title">
    <div class="container">
      <div class="section-header">
        <span class="section-badge">💼 Nos Services</span>
        <h2 id="services-title" class="section-title">Solutions Digitales Complètes pour Votre Entreprise</h2>
        <p class="section-description">
          De la <strong>conception créative</strong> à la <strong>mise en ligne optimisée</strong>,
          nous accompagnons votre transformation digitale avec des solutions sur-mesure et des
          <strong>technologies de pointe</strong>. <strong>Développeur web freelance Charente-Maritime</strong>,
          <strong>création site e-commerce</strong>, <strong>développement application web</strong>,
          <strong>design responsive</strong> et <strong>optimisation SEO</strong>.
        </p>
      </div>
      <div class="services-grid">
        <article class="service-card" itemscope itemtype="https://schema.org/Service">
          <div class="service-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
            </svg>
          </div>
          <h3 itemprop="name">Développement Web Avancé Rochefort</h3>
          <p itemprop="description">Sites vitrines, e-commerce, SAAS, applications web sur-mesure avec les dernières technologies. <strong>Développement Laravel</strong>, <strong>WordPress</strong>, <strong>React</strong>, <strong>Vue.js</strong> et <strong>PHP</strong>.</p>
          <ul class="service-features">
            <li>📱 Responsive Design</li>
            <li>⚡ Performance optimisée</li>
            <li>🔒 Sécurité renforcée</li>
          </ul>
          <meta itemprop="provider" content="Kreyatik Studio">
        </article>
        <article class="service-card" itemscope itemtype="https://schema.org/Service">
          <div class="service-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z" />
            </svg>
          </div>
          <h3 itemprop="name">Design & UX Créatif Professionnel</h3>
          <p itemprop="description">Interfaces modernes et intuitives qui captent l'attention et convertissent vos visiteurs en clients. <strong>Design graphique</strong>, <strong>maquette site web</strong>, <strong>identité visuelle</strong> et <strong>logo design</strong>.</p>
          <ul class="service-features">
            <li>🎨 Design System</li>
            <li>👥 User Experience</li>
            <li>📐 Prototypage</li>
            <li>🎯 Conversion optimisée</li>
          </ul>
          <meta itemprop="provider" content="Kreyatik Studio">
        </article>
        <article class="service-card" itemscope itemtype="https://schema.org/Service">
          <div class="service-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-1.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22" />
            </svg>
          </div>
          <h3 itemprop="name">SEO & Marketing Digital Expert</h3>
          <p itemprop="description">Optimisation pour les moteurs de recherche et stratégies marketing digital performantes pour booster votre visibilité. <strong>Référencement naturel</strong>, <strong>Google Ads</strong>, <strong>réseaux sociaux</strong> et <strong>content marketing</strong>.</p>
          <ul class="service-features">
            <li>🔍 Référencement naturel</li>
            <li>📊 Analytics & Tracking</li>
            <li>📝 Content Marketing</li>
            <li>📈 ROI mesurable</li>
          </ul>
          <meta itemprop="provider" content="Kreyatik Studio">
        </article>
      </div>
    </div>
  </section>

  <!-- POURQUOI NOUS CHOISIR -->
  <section class="why-choose-section" id="why-choose" aria-labelledby="why-choose-title">
    <div class="container">
      <div class="section-header">
        <span class="section-badge">🎯 Pourquoi Nous Choisir</span>
        <h2 id="why-choose-title" class="section-title">Votre Succès, Notre Priorité</h2>
        <p class="section-description">
          Nous nous différencions par notre <strong>approche personnalisée</strong>, notre <strong>expertise technique</strong>
          et notre <strong>engagement total</strong> envers votre réussite digitale.
          <strong>développeur web freelance</strong>, <strong>webdesigner Rochefort</strong> et <strong>expert SEO</strong>.
        </p>
      </div>
      <div class="why-choose-grid">
        <article class="why-choose-card" itemscope itemtype="https://schema.org/Service">
          <div class="why-choose-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
            </svg>
          </div>
          <h3 itemprop="name">Excellence Technique</h3>
          <p itemprop="description">Technologies de pointe, code propre et optimisé, respect des standards web les plus élevés. <strong>Développement web moderne</strong>, <strong>technologies web</strong> et <strong>architectures performantes</strong>.</p>
          <div class="why-choose-features">
            <span class="feature-tag">⚡ Performance</span>
            <span class="feature-tag">🔒 Sécurité</span>
            <span class="feature-tag">📱 Responsive</span>
          </div>
        </article>
        <article class="why-choose-card" itemscope itemtype="https://schema.org/Service">
          <div class="why-choose-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
              <circle cx="9" cy="7" r="4" />
              <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
              <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            </svg>
          </div>
          <h3 itemprop="name">Accompagnement Personnalisé</h3>
          <p itemprop="description">Un suivi sur-mesure, des conseils d'experts et une relation de confiance durable. <strong>Conseil digital</strong>, <strong>accompagnement projet</strong> et <strong>formation utilisateurs</strong>.</p>
          <div class="why-choose-features">
            <span class="feature-tag">🤝 Disponibilité</span>
            <span class="feature-tag">💬 Communication</span>
            <span class="feature-tag">📞 Support</span>
          </div>
        </article>
        <article class="why-choose-card" itemscope itemtype="https://schema.org/Service">
          <div class="why-choose-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M9 12l2 2 4-4" />
              <path d="M21 12c-1 0-2-1-2-2s1-2 2-2 2 1 2 2-1 2-2 2z" />
              <path d="M3 12c1 0 2-1 2-2s-1-2-2-2-2 1-2 2 1 2 2 2z" />
              <path d="M12 3c0 1-1 2-2 2s-2-1-2-2 1-2 2-2 2 1 2 2z" />
              <path d="M12 21c0-1 1-2 2-2s2 1 2 2-1 2-2 2-2-1-2-2z" />
            </svg>
          </div>
          <h3 itemprop="name">Solutions Sur-Mesure</h3>
          <p itemprop="description">Chaque projet est unique. Nous créons des solutions adaptées à vos besoins spécifiques. <strong>Site web sur mesure</strong>, <strong>application personnalisée</strong> et <strong>développement spécifique</strong>.</p>
          <div class="why-choose-features">
            <span class="feature-tag">🎨 Design Unique</span>
            <span class="feature-tag">⚙️ Fonctionnalités</span>
            <span class="feature-tag">📊 Analytics</span>
          </div>
        </article>
        <article class="why-choose-card" itemscope itemtype="https://schema.org/Service">
          <div class="why-choose-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
              <polyline points="22,4 12,14.01 9,11.01" />
            </svg>
          </div>
          <h3 itemprop="name">Garanties & Engagement</h3>
          <p itemprop="description">Satisfaction garantie, maintenance incluse et support réactif pour votre tranquillité. <strong>Maintenance site web</strong>, <strong>hébergement web</strong> et <strong>support technique</strong>.</p>
          <div class="why-choose-features">
            <span class="feature-tag">✅ Garantie</span>
            <span class="feature-tag">🔧 Maintenance</span>
            <span class="feature-tag">📞 Support 24h</span>
          </div>
        </article>
      </div>
    </div>
  </section>

  <!-- PROCESS  -->
  <section class="process-section" id="process" aria-labelledby="process-title">
    <div class="container">
      <div class="section-header">
        <span class="section-badge">🚀 Notre Processus</span>
        <h2 id="process-title" class="section-title">Une Méthodologie Éprouvée</h2>
        <p class="section-description">
          Un processus en <strong>4 étapes</strong> pour garantir la réussite de votre projet digital
          et vous accompagner vers l'excellence. <strong>Méthodologie agile</strong>, <strong>gestion projet web</strong>
          et <strong>développement itératif</strong>.
        </p>
      </div>

      <div class="process-timeline">
        <!-- Étape 1 -->
        <div class="process-step" data-step="1">
          <div class="process-visual">
            <div class="process-icon-wrapper">
              <div class="process-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M9 12l2 2 4-4"/>
                  <path d="M21 12c-1 0-2-1-2-2s1-2 2-2 2 1 2 2-1 2-2 2z"/>
                  <path d="M3 12c1 0 2-1 2-2s-1-2-2-2-2 1-2 2 1 2 2 2z"/>
                  <path d="M12 3c0 1-1 2-2 2s-2-1-2-2 1-2 2-2 2 1 2 2z"/>
                  <path d="M12 21c0-1 1-2 2-2s2 1 2 2-1 2-2 2-2-1-2-2z"/>
                </svg>
              </div>
              <div class="process-number">01</div>
              <div class="process-connector"></div>
            </div>
          </div>
          <div class="process-content">
            <div class="process-header">
              <h3>📋 Analyse & Stratégie</h3>
            </div>
            <p>Étude approfondie de vos besoins, analyse de la concurrence et définition de la stratégie digitale optimale. <strong>Audit SEO</strong>, <strong>étude de marché</strong> et <strong>analyse concurrentielle</strong>.</p>
            <div class="process-features">
              <div class="feature-item">
                <div class="feature-icon">🔍</div>
                <span>Audit de votre présence actuelle</span>
              </div>
              <div class="feature-item">
                <div class="feature-icon">📊</div>
                <span>Analyse de la concurrence</span>
              </div>
              <div class="feature-item">
                <div class="feature-icon">🎯</div>
                <span>Définition des objectifs</span>
              </div>
            </div>
            <div class="process-deliverables">
              <span class="deliverable-tag">📄 Brief créatif</span>
              <span class="deliverable-tag">📈 Plan stratégique</span>
              <span class="deliverable-tag">🎨 Moodboard</span>
            </div>
          </div>
        </div>

        <!-- Étape 2 -->
        <div class="process-step" data-step="2">
          <div class="process-visual">
            <div class="process-icon-wrapper">
              <div class="process-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                </svg>
              </div>
              <div class="process-number">02</div>
              <div class="process-connector"></div>
            </div>
          </div>
          <div class="process-content">
            <div class="process-header">
              <h3>🎨 Design & Conception</h3>
            </div>
            <p>Création de maquettes, design d'interface et validation de l'expérience utilisateur. <strong>Maquette site web</strong>, <strong>wireframe</strong>, <strong>design d'interface</strong> et <strong>prototypage</strong>.</p>
            <div class="process-features">
              <div class="feature-item">
                <div class="feature-icon">✏️</div>
                <span>Maquettes et wireframes</span>
              </div>
              <div class="feature-item">
                <div class="feature-icon">🎨</div>
                <span>Design d'interface</span>
              </div>
              <div class="feature-item">
                <div class="feature-icon">👥</div>
                <span>Validation UX/UI</span>
              </div>
            </div>
            <div class="process-deliverables">
              <span class="deliverable-tag">📱 Maquettes</span>
              <span class="deliverable-tag">🎨 Design System</span>
              <span class="deliverable-tag">📋 Guide Style</span>
            </div>
          </div>
        </div>

        <!-- Étape 3 -->
        <div class="process-step" data-step="3">
          <div class="process-visual">
            <div class="process-icon-wrapper">
              <div class="process-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
                </svg>
              </div>
              <div class="process-number">03</div>
              <div class="process-connector"></div>
            </div>
          </div>
          <div class="process-content">
            <div class="process-header">
              <h3>⚡ Développement & Tests</h3>
            </div>
            <p>Développement technique, intégration et tests rigoureux pour garantir la qualité. <strong>Programmation web</strong>, <strong>développement front-end</strong>, <strong>développement back-end</strong> et <strong>tests qualité</strong>.</p>
            <div class="process-features">
              <div class="feature-item">
                <div class="feature-icon">💻</div>
                <span>Développement front/back</span>
              </div>
              <div class="feature-item">
                <div class="feature-icon">🔧</div>
                <span>Intégration des fonctionnalités</span>
              </div>
              <div class="feature-item">
                <div class="feature-icon">✅</div>
                <span>Tests et optimisation</span>
              </div>
            </div>
            <div class="process-deliverables">
              <span class="deliverable-tag">🌐 Site fonctionnel</span>
              <span class="deliverable-tag">📱 Version mobile</span>
              <span class="deliverable-tag">⚡ Performance optimisée</span>
            </div>
          </div>
        </div>

        <!-- Étape 4 -->
        <div class="process-step" data-step="4">
          <div class="process-visual">
            <div class="process-icon-wrapper">
              <div class="process-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                  <polyline points="22,4 12,14.01 9,11.01"/>
                </svg>
              </div>
              <div class="process-number">04</div>
            </div>
          </div>
          <div class="process-content">
            <div class="process-header">
              <h3>🚀 Mise en Ligne & Suivi</h3>
            </div>
            <p>Déploiement, formation et accompagnement post-lancement pour votre réussite. <strong>Mise en ligne site</strong>, <strong>hébergement web</strong>, <strong>formation utilisateur</strong> et <strong>maintenance site</strong>.</p>
            <div class="process-features">
              <div class="feature-item">
                <div class="feature-icon">🔒</div>
                <span>Déploiement sécurisé</span>
              </div>
              <div class="feature-item">
                <div class="feature-icon">👨‍💼</div>
                <span>Formation utilisateurs</span>
              </div>
              <div class="feature-item">
                <div class="feature-icon">📈</div>
                <span>Suivi et maintenance</span>
              </div>
            </div>
            <div class="process-deliverables">
              <span class="deliverable-tag">🌍 Site en ligne</span>
              <span class="deliverable-tag">📚 Documentation</span>
              <span class="deliverable-tag">🛠️ Support</span>
            </div>
          </div>
        </div>
      </div>


      <div class="process-cta">
        <div class="cta-content">
          <h3>Prêt à lancer votre projet ?</h3>
          <p>Découvrez comment notre processus peut transformer votre vision en réalité digitale. <strong>Devis gratuit</strong>, <strong>étude de faisabilité</strong> et <strong>accompagnement personnalisé</strong>.</p>
          <div class="cta-actions">
            <a href="#contact-form" class="btn btn-primary btn-large">
              <span>🚀 Démarrer mon projet</span>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M5 12h14M12 5l7 7-7 7"/>
              </svg>
            </a>
            <a href="/Portfolio" class="btn btn-outline btn-large">
              <span>👀 Voir nos réalisations</span>
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

  <section class="testimonials-section" aria-labelledby="testimonials-title" style="margin-top: -2rem;">
    <div class="container">
      <div class="section-header">
        <span class="section-badge">💬 Témoignages</span>
        <h2 id="testimonials-title" class="section-title">Ils Nous Font Confiance</h2>
      </div>
      <div class="testimonials-grid">
        <article class="testimonial-card" itemscope itemtype="https://schema.org/Review">
          <div class="testimonial-content">
            <div class="testimonial-quote">
              <svg viewBox="0 0 24 24" fill="currentColor">
                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
              </svg>
            </div>
            <p class="testimonial-text" itemprop="reviewBody">
              "Une équipe exceptionnelle qui a su comprendre nos besoins et créer un site parfaitement adapté.
              Les résultats dépassent nos attentes avec une augmentation de 300% du trafic ! <strong>Site e-commerce</strong>
              et <strong>référencement naturel</strong> au top."
            </p>
            <div class="testimonial-author">
              <div class="author-info">
                <h4 itemprop="author">Romain G.</h4>
                <span>Fondateur, Loukart</span>
                <div class="rating" itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
                  <meta itemprop="ratingValue" content="5">
                  <meta itemprop="bestRating" content="5">
                  <span class="stars">⭐⭐⭐⭐⭐</span>
                </div>
              </div>
            </div>
            <div itemprop="itemReviewed" itemscope itemtype="https://schema.org/Organization">
              <meta itemprop="name" content="Kreyatik Studio">
              <meta itemprop="url" content="{{ url('/') }}">
            </div>
          </div>
        </article>
        <article class="testimonial-card" itemscope itemtype="https://schema.org/Review">
          <div class="testimonial-content">
            <div class="testimonial-quote">
              <svg viewBox="0 0 24 24" fill="currentColor">
                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
              </svg>
            </div>
            <p class="testimonial-text" itemprop="reviewBody">
              "Réactivité, créativité et professionnalisme. Kreyatik Studio a transformé notre vision
              en une réalité digitale exceptionnelle. ROI immédiat ! <strong>Application web</strong>
              et <strong>design moderne</strong> parfait."
            </p>
            <div class="testimonial-author">
              <div class="author-info">
                <h4 itemprop="author">Fred L.</h4>
                <span>Fondateur, Snack</span>
                <div class="rating" itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
                  <meta itemprop="ratingValue" content="5">
                  <meta itemprop="bestRating" content="5">
                  <span class="stars">⭐⭐⭐⭐⭐</span>
                </div>
              </div>
            </div>
            <div itemprop="itemReviewed" itemscope itemtype="https://schema.org/Organization">
              <meta itemprop="name" content="Kreyatik Studio">
              <meta itemprop="url" content="{{ url('/') }}">
            </div>
          </div>
        </article>
      </div>
    </div>
  </section>

  <!-- BLOG ARTICLES -->
  <section class="testimonials-section" aria-labelledby="blog-title">
    <div class="container">
      <div class="section-header">
        <span class="section-badge">📖 Blog</span>
        <h2 id="blog-title" class="section-title">Nos Derniers Articles</h2>
        <p class="section-description">
          Découvrez nos conseils d'experts, astuces et actualités du <strong>développement web</strong>,
          <strong>référencement SEO</strong> et <strong>marketing digital</strong>.
        </p>
      </div>

      @if(isset($latestArticles) && $latestArticles->count() > 0)
        <div class="articles-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; max-width: 900px; margin: 0 auto;">
          <style>
            @media (max-width: 768px) {
              .articles-grid {
                grid-template-columns: 1fr !important;
                gap: 1.5rem !important;
              }
            }
          </style>
          @foreach($latestArticles->take(2) as $article)
            <article style="background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); overflow: hidden; transition: all 0.3s ease; border: 1px solid #f1f5f9; display: flex;" itemscope itemtype="https://schema.org/BlogPosting">
                @if($article->image)
                  <div style="width: 160px; min-width: 160px; background: #f8fafc; flex-shrink: 0;">
                    <img src="{{ asset('storage/' . $article->image) }}"
                         alt="Image de l'article {{ $article->title }}"
                         style="width: 100%; height: 100%; object-fit: cover;"
                         loading="lazy"
                         itemprop="image">
                  </div>
                @else
                  <div style="width: 160px; min-width: 160px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" style="width: 28px; height: 28px;">
                      <path d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                  </div>
                @endif

              <div style="flex: 1; padding: 0.875rem; display: flex; flex-direction: column; justify-content: space-between; min-height: 120px;">
                <div>
                  <div style="display: flex; align-items: center; margin-bottom: 0.375rem; font-size: 0.65rem; color: #64748b;">
                    <svg style="width: 10px; height: 10px; margin-right: 0.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <time datetime="{{ $article->published_at ? $article->published_at->format('Y-m-d') : $article->created_at->format('Y-m-d') }}" itemprop="datePublished">
                      {{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}
                    </time>
                    <span style="margin: 0 0.375rem; color: #d1d5db;">•</span>
                    <span>{{ ceil(str_word_count(strip_tags($article->content)) / 200) }} min</span>
                  </div>

                  <h3 style="font-size: 0.875rem; font-weight: 600; line-height: 1.3; margin-bottom: 0.375rem; color: var(--text-dark);" itemprop="headline">
                    <a href="{{ route('blog.show', $article->slug) }}" style="color: inherit; text-decoration: none;" itemprop="url">
                      {!! html_entity_decode(Str::limit($article->title, 45)) !!}
                    </a>
                  </h3>

                  <p style="font-size: 0.75rem; color: #64748b; line-height: 1.4; margin-bottom: 0.5rem;" itemprop="description">
                    {!! Str::limit(html_entity_decode(strip_tags($article->content)), 60) !!}
                  </p>
                </div>

                <div style="margin-top: auto;">
                  <a href="{{ route('blog.show', $article->slug) }}" style="background: var(--primary-blue); color: white; padding: 0.375rem 0.75rem; border-radius: 5px; font-size: 0.75rem; font-weight: 500; text-decoration: none; display: inline-flex; align-items: center; gap: 0.25rem; transition: all 0.3s ease;">
                    Lire
                    <svg style="width: 10px; height: 10px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                  </a>
                </div>
              </div>

              <meta itemprop="author" content="Kreyatik Studio">
              <meta itemprop="publisher" content="Kreyatik Studio">
            </article>
          @endforeach
        </div>

        <div style="text-align: center; margin-top: 3rem;">
          <a href="{{ route('blog') }}" class="btn btn-outline">
            <span>📚 Voir tous nos articles</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M5 12h14M12 5l7 7-7 7"/>
            </svg>
          </a>
        </div>
      @else
        <div style="text-align: center; padding: 3rem 0;">
          <div style="font-size: 3rem; margin-bottom: 1rem;">📝</div>
          <h3>Articles en préparation</h3>
          <p>Nous travaillons sur de nouveaux contenus passionnants. Revenez bientôt !</p>
        </div>
      @endif
    </div>
  </section>

  <!-- CTA  -->
  <section class="cta-section" id="contact" aria-labelledby="cta-title">
    <div class="container">
      <div class="cta-content">
        <h2 id="cta-title">🚀 Prêt à Transformer Votre Présence Digitale ?</h2>
        <p>Discutons de votre projet et créons ensemble quelque chose d'<strong>extraordinaire</strong> qui génère des <strong>résultats concrets</strong>. <strong>Développeur web freelance Rochefort</strong>, <strong>développeur web Charente-Maritime</strong>, <strong>création site internet</strong> et <strong>référencement SEO</strong>.</p>
        <div class="cta-actions">
          <a href="#contact-form" class="btn btn-primary btn-large" aria-label="Commencer votre projet">
            <span>🎯 Commencer votre projet</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
          </a>
          <a href="tel:+33695800663" class="btn btn-outline btn-large" aria-label="Appelez-nous">
            <span>📞 Appelez-nous</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z" />
            </svg>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- CONTACT -->
  <section class="contact-section" id="contact-form" aria-labelledby="contact-title">
    <div class="container">
      <div class="section-header">
        <div class="section-badge">Contact</div>
        <h2 id="contact-title" class="section-title">💼 Parlons de Votre Projet</h2>
        <p class="section-description">Remplissez le formulaire ci-dessous et nous vous recontacterons dans les <strong>24h</strong> avec une proposition personnalisée. <strong>Devis gratuit</strong>, <strong>étude de faisabilité</strong> et <strong>conseil expert</strong>.</p>
      </div>

      <div class="contact-grid">

        <div class="contact-info">
          <div class="contact-info-header">
            <h3>Nos Coordonnées</h3>
            <p>N'hésitez pas à nous contacter directement ou à utiliser le formulaire. <strong>Développeur web freelance Rochefort</strong>, <strong>développeur web Charente-Maritime</strong> et <strong>expert digital</strong>.</p>
          </div>

          <div class="contact-details">
            <div class="contact-item">
              <div class="contact-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z" />
                </svg>
              </div>
              <div class="contact-text">
                <h4>Téléphone</h4>
                <p><a href="tel:+33695800663">+33 6 95 80 06 63</a></p>
              </div>
            </div>

            <div class="contact-item">
              <div class="contact-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                  <polyline points="22,6 12,13 2,6" />
                </svg>
              </div>
              <div class="contact-text">
                <h4>Email</h4>
                <p><a href="mailto:kreyatik@gmail.com">kreyatik@gmail.com</a></p>
              </div>
            </div>

            <div class="contact-item">
              <div class="contact-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
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

          <div class="contact-extra">
            <div class="contact-benefit">
              <div class="benefit-icon">⚡</div>
              <div class="benefit-text">
                <h4>Réponse Rapide</h4>
                <p>Nous répondons sous 24h</p>
              </div>
            </div>
            <div class="contact-benefit">
              <div class="benefit-icon">🎯</div>
              <div class="benefit-text">
                <h4>Devis Gratuit</h4>
                <p>Estimation personnalisée</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Formulaire de contact -->
        <div class="contact-form-container">
          <div class="form-header">
            <h3>Envoyez-nous un message</h3>
            <p>Décrivez votre projet et nous vous répondrons rapidement. <strong>Devis site web</strong>, <strong>étude projet</strong> et <strong>conseil digital</strong>.</p>
          </div>

          <form action="{{ route('send.email') }}" method="post" class="contact-form" id="contactForm" itemscope itemtype="https://schema.org/ContactPage">
            @csrf
            <div class="form-row">
              <div class="form-group">
                <label for="name" class="form-label">Nom complet *</label>
                <input type="text" id="name" name="name" placeholder="Votre nom complet" required class="form-input" itemprop="name">
              </div>
              <div class="form-group">
                <label for="email" class="form-label">Email *</label>
                <input type="email" id="email" name="email" placeholder="Votre email" required class="form-input" itemprop="email">
              </div>
            </div>

            <div class="form-group">
              <label for="object" class="form-label">Objet *</label>
              <input type="text" id="object" name="object_message" placeholder="Objet de votre message" required class="form-input">
            </div>

            <div class="form-group">
              <label for="message" class="form-label">Message *</label>
              <textarea id="message" name="message" placeholder="Décrivez votre projet, vos besoins, votre budget..." rows="6" required class="form-textarea" itemprop="description"></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-full" aria-label="Envoyer le message">
              <span>📤 Envoyer le message</span>
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
</x-slot>
</x-header>

<x-footer />