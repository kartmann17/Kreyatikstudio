import { Link, useForm, Head } from '@inertiajs/react';
import PublicLayout from '@/Layouts/PublicLayout';

export default function Welcome({ seo, latestArticles }) {
    const { data, setData, post, processing } = useForm({
        name: '',
        email: '',
        object_message: '',
        message: '',
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post('/send-email');
    };

    return (
        <PublicLayout seo={seo}>
            <Head>
                {/* Schema.org Organization pour le SEO local */}
                <script type="application/ld+json">
                    {JSON.stringify({
                        "@context": "https://schema.org",
                        "@type": "ProfessionalService",
                        "name": "Kréyatik Studio",
                        "alternateName": "Kreyatik Studio Développeur Web Freelance",
                        "description": "Développeur web freelance spécialisé en création de sites internet, e-commerce, applications Laravel, SaaS et CRM sur-mesure à Rochefort (Charente-Maritime). Expert en SEO, React et développement web moderne.",
                        "url": "https://kreyatikstudio.fr",
                        "logo": "https://kreyatikstudio.fr/images/Studiosansfond.png",
                        "image": "https://kreyatikstudio.fr/images/STUDIOcolibri.png",
                        "email": "contact@kreyatikstudio.fr",
                        "telephone": "+33695800663",
                        "address": {
                            "@type": "PostalAddress",
                            "streetAddress": "2 rue du petit port marchand",
                            "addressLocality": "Rochefort",
                            "postalCode": "17300",
                            "addressRegion": "Charente-Maritime",
                            "addressCountry": "FR"
                        },
                        "geo": {
                            "@type": "GeoCoordinates",
                            "latitude": "45.9369",
                            "longitude": "-0.9609"
                        },
                        "areaServed": [
                            {
                                "@type": "City",
                                "name": "Rochefort"
                            },
                            {
                                "@type": "State",
                                "name": "Charente-Maritime"
                            },
                            {
                                "@type": "Country",
                                "name": "France"
                            }
                        ],
                        "priceRange": "€€",
                        "openingHoursSpecification": {
                            "@type": "OpeningHoursSpecification",
                            "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
                            "opens": "09:00",
                            "closes": "18:00"
                        },
                        "sameAs": [
                            "https://www.facebook.com/share/1AtjVczpEJ/",
                            "https://www.instagram.com/kreyatik_17/"
                        ],
                        "founder": {
                            "@type": "Person",
                            "name": "Lionel Blanchet",
                            "jobTitle": "Développeur Web Fullstack Freelance"
                        },
                        "hasOfferCatalog": {
                            "@type": "OfferCatalog",
                            "name": "Services de Développement Web",
                            "itemListElement": [
                                {
                                    "@type": "Offer",
                                    "itemOffered": {
                                        "@type": "Service",
                                        "name": "Création de site internet sur-mesure",
                                        "description": "Développement de sites web modernes et performants avec Laravel, React et TailwindCSS"
                                    }
                                },
                                {
                                    "@type": "Offer",
                                    "itemOffered": {
                                        "@type": "Service",
                                        "name": "E-commerce et boutiques en ligne",
                                        "description": "Solutions e-commerce complètes avec paiement sécurisé et gestion des stocks"
                                    }
                                },
                                {
                                    "@type": "Offer",
                                    "itemOffered": {
                                        "@type": "Service",
                                        "name": "Applications SaaS et CRM",
                                        "description": "Développement d'applications web complexes sur-mesure (SaaS, CRM, outils métier)"
                                    }
                                },
                                {
                                    "@type": "Offer",
                                    "itemOffered": {
                                        "@type": "Service",
                                        "name": "Référencement SEO",
                                        "description": "Optimisation SEO on-page, Core Web Vitals et stratégie de référencement naturel"
                                    }
                                }
                            ]
                        }
                    })}
                </script>

                {/* Schema.org WebSite pour la recherche */}
                <script type="application/ld+json">
                    {JSON.stringify({
                        "@context": "https://schema.org",
                        "@type": "WebSite",
                        "name": "Kréyatik Studio",
                        "url": "https://kreyatikstudio.fr",
                        "potentialAction": {
                            "@type": "SearchAction",
                            "target": "https://kreyatikstudio.fr/blog?search={search_term_string}",
                            "query-input": "required name=search_term_string"
                        }
                    })}
                </script>

                {/* Schema.org BreadcrumbList */}
                <script type="application/ld+json">
                    {JSON.stringify({
                        "@context": "https://schema.org",
                        "@type": "BreadcrumbList",
                        "itemListElement": [
                            {
                                "@type": "ListItem",
                                "position": 1,
                                "name": "Accueil",
                                "item": "https://kreyatikstudio.fr"
                            }
                        ]
                    })}
                </script>
            </Head>

            <main className="main-page">
                {/* Hero Section */}
                <section className="hero-section" aria-labelledby="hero-title">
                    <div className="hero-background">
                        <picture>
                            <source
                                media="(max-width: 768px)"
                                srcSet="/images/compose-768.jpg"
                            />
                            <source
                                media="(max-width: 1280px)"
                                srcSet="/images/compose-1280.jpg"
                            />
                            <source
                                media="(max-width: 1536px)"
                                srcSet="/images/compose-1536.jpg"
                            />
                            <img
                                src="/images/compose-1920.jpg"
                                alt="Kreyatik Studio - Développeur Web Freelance spécialisé en création sites internet Rochefort, développement web moderne et référencement SEO expert"
                                className="hero-bg-image"
                                loading="eager"
                                width="1920"
                                height="1080"
                            />
                        </picture>
                        <div className="hero-overlay"></div>
                        <div className="hero-particles"></div>
                    </div>
                    <div className="hero-container">
                        <div className="hero-content">
                            <div className="hero-badge" aria-label="Badge développeur web">
                                <span className="badge-text">🚀 Développeur Web Kreyatik Studio</span>
                            </div>
                            <h1 id="hero-title" className="hero-title">
                                <span className="title-line">Transformons vos</span>
                                <span className="title-highlight">idées en succès</span>
                                <span className="title-line">digital</span>
                            </h1>
                            <p className="hero-description">
                                <strong>Kreyatik Studio</strong> - Votre partenaire digital de confiance pour des sites web
                                <span className="highlight-text">performants</span>, <span className="highlight-text">innovants</span> et
                                <span className="highlight-text">rentables</span>. Expertise en développement web, design UX/UI et marketing digital.
                                <strong>Développeur web freelance Rochefort</strong>, <strong>création site internet</strong>, <strong>développement web</strong>,
                                <strong>design graphique</strong> et <strong>référencement naturel</strong>.
                            </p>
                            <div className="hero-actions">
                                <a href="#why-choose" className="btn btn-primary" aria-label="Découvrir nos avantages">
                                    <span>🎯 Découvrir nos avantages</span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                        <path d="M5 12h14M12 5l7 7-7 7" />
                                    </svg>
                                </a>
                                <a href="#contact" className="btn btn-secondary" aria-label="Audit gratuit SEO">
                                    <span>📊 Audit gratuit SEO</span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                        <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-1.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22" />
                                    </svg>
                                </a>
                            </div>
                            <div className="hero-stats" role="region" aria-label="Statistiques du développeur freelance">
                                <div className="stat-item">
                                    <span className="stat-number" data-target="+10">+10</span>
                                    <span className="stat-label">Projets réalisés</span>
                                </div>
                                <div className="stat-item">
                                    <span className="stat-number" data-target="98%">98%</span>
                                    <span className="stat-label"> Clients satisfaits</span>
                                </div>
                                <div className="stat-item">
                                    <span className="stat-number" data-target="24h">24h</span>
                                    <span className="stat-label"> Temps de réponse</span>
                                </div>
                            </div>
                        </div>
                        <div className="hero-visual">
                            <div className="floating-elements">
                                <div className="floating-card card-1" aria-label="Design UX/UI">
                                    <div className="card-icon">🎨</div>
                                    <span>Design UX/UI</span>
                                </div>
                                <div className="floating-card card-2" aria-label="Performance Web">
                                    <div className="card-icon">⚡</div>
                                    <span>Performance Web</span>
                                </div>
                                <div className="floating-card card-3" aria-label="SEO Avancé">
                                    <div className="card-icon">🔍</div>
                                    <span>SEO Avancé</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {/* SERVICES */}
                <section className="services-section" id="services" aria-labelledby="services-title">
                    <div className="container">
                        <div className="section-header">
                            <span className="section-badge">💼 Nos Services</span>
                            <h2 id="services-title" className="section-title">Solutions Digitales Complètes pour Votre Entreprise</h2>
                            <p className="section-description">
                                De la <strong>conception créative</strong> à la <strong>mise en ligne optimisée</strong>,
                                nous accompagnons votre transformation digitale avec des solutions sur-mesure et des
                                <strong>technologies de pointe</strong>. <strong>Développeur web freelance Charente-Maritime</strong>,
                                <strong>création site e-commerce</strong>, <strong>développement application web</strong>,
                                <strong>design responsive</strong> et <strong>optimisation SEO</strong>.
                            </p>
                        </div>
                        <div className="services-grid">
                            <article className="service-card" itemScope itemType="https://schema.org/Service">
                                <div className="service-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                                    </svg>
                                </div>
                                <h3 itemProp="name">Développement Web Avancé Rochefort</h3>
                                <p itemProp="description">Sites vitrines, e-commerce, SAAS, applications web sur-mesure avec les dernières technologies. <strong>Développement Laravel</strong>, <strong>WordPress</strong>, <strong>React</strong>, <strong>Vue.js</strong> et <strong>PHP</strong>.</p>
                                <ul className="service-features">
                                    <li>📱 Responsive Design</li>
                                    <li>⚡ Performance optimisée</li>
                                    <li>🔒 Sécurité renforcée</li>
                                </ul>
                                <meta itemProp="provider" content="Kreyatik Studio" />
                            </article>
                            <article className="service-card" itemScope itemType="https://schema.org/Service">
                                <div className="service-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                        <path d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z" />
                                    </svg>
                                </div>
                                <h3 itemProp="name">Design & UX Créatif Professionnel</h3>
                                <p itemProp="description">Interfaces modernes et intuitives qui captent l'attention et convertissent vos visiteurs en clients. <strong>Design graphique</strong>, <strong>maquette site web</strong>, <strong>identité visuelle</strong> et <strong>logo design</strong>.</p>
                                <ul className="service-features">
                                    <li>🎨 Design System</li>
                                    <li>👥 User Experience</li>
                                    <li>📐 Prototypage</li>
                                    <li>🎯 Conversion optimisée</li>
                                </ul>
                                <meta itemProp="provider" content="Kreyatik Studio" />
                            </article>
                            <article className="service-card" itemScope itemType="https://schema.org/Service">
                                <div className="service-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                        <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-1.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22" />
                                    </svg>
                                </div>
                                <h3 itemProp="name">SEO & Marketing Digital Expert</h3>
                                <p itemProp="description">Optimisation pour les moteurs de recherche et stratégies marketing digital performantes pour booster votre visibilité. <strong>Référencement naturel</strong>, <strong>Google Ads</strong>, <strong>réseaux sociaux</strong> et <strong>content marketing</strong>.</p>
                                <ul className="service-features">
                                    <li>🔍 Référencement naturel</li>
                                    <li>📊 Analytics & Tracking</li>
                                    <li>📝 Content Marketing</li>
                                    <li>📈 ROI mesurable</li>
                                </ul>
                                <meta itemProp="provider" content="Kreyatik Studio" />
                            </article>
                        </div>
                    </div>
                </section>

                {/* POURQUOI NOUS CHOISIR */}
                <section className="why-choose-section" id="why-choose" aria-labelledby="why-choose-title">
                    <div className="container">
                        <div className="section-header">
                            <span className="section-badge">🎯 Pourquoi Nous Choisir</span>
                            <h2 id="why-choose-title" className="section-title">Votre Succès, Notre Priorité</h2>
                            <p className="section-description">
                                Nous nous différencions par notre <strong>approche personnalisée</strong>, notre <strong>expertise technique</strong>
                                et notre <strong>engagement total</strong> envers votre réussite digitale.
                                <strong>développeur web freelance</strong>, <strong>webdesigner Rochefort</strong> et <strong>expert SEO</strong>.
                            </p>
                        </div>
                        <div className="why-choose-grid">
                            <article className="why-choose-card" itemScope itemType="https://schema.org/Service">
                                <div className="why-choose-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                    </svg>
                                </div>
                                <h3 itemProp="name">Excellence Technique</h3>
                                <p itemProp="description">Technologies de pointe, code propre et optimisé, respect des standards web les plus élevés. <strong>Développement web moderne</strong>, <strong>technologies web</strong> et <strong>architectures performantes</strong>.</p>
                                <div className="why-choose-features">
                                    <span className="feature-tag">⚡ Performance</span>
                                    <span className="feature-tag">🔒 Sécurité</span>
                                    <span className="feature-tag">📱 Responsive</span>
                                </div>
                            </article>
                            <article className="why-choose-card" itemScope itemType="https://schema.org/Service">
                                <div className="why-choose-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                        <circle cx="9" cy="7" r="4" />
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                    </svg>
                                </div>
                                <h3 itemProp="name">Accompagnement Personnalisé</h3>
                                <p itemProp="description">Un suivi sur-mesure, des conseils d'experts et une relation de confiance durable. <strong>Conseil digital</strong>, <strong>accompagnement projet</strong> et <strong>formation utilisateurs</strong>.</p>
                                <div className="why-choose-features">
                                    <span className="feature-tag">🤝 Disponibilité</span>
                                    <span className="feature-tag">💬 Communication</span>
                                    <span className="feature-tag">📞 Support</span>
                                </div>
                            </article>
                            <article className="why-choose-card" itemScope itemType="https://schema.org/Service">
                                <div className="why-choose-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                        <path d="M9 12l2 2 4-4" />
                                        <path d="M21 12c-1 0-2-1-2-2s1-2 2-2 2 1 2 2-1 2-2 2z" />
                                        <path d="M3 12c1 0 2-1 2-2s-1-2-2-2-2 1-2 2 1 2 2 2z" />
                                        <path d="M12 3c0 1-1 2-2 2s-2-1-2-2 1-2 2-2 2 1 2 2z" />
                                        <path d="M12 21c0-1 1-2 2-2s2 1 2 2-1 2-2 2-2-1-2-2z" />
                                    </svg>
                                </div>
                                <h3 itemProp="name">Solutions Sur-Mesure</h3>
                                <p itemProp="description">Chaque projet est unique. Nous créons des solutions adaptées à vos besoins spécifiques. <strong>Site web sur mesure</strong>, <strong>application personnalisée</strong> et <strong>développement spécifique</strong>.</p>
                                <div className="why-choose-features">
                                    <span className="feature-tag">🎨 Design Unique</span>
                                    <span className="feature-tag">⚙️ Fonctionnalités</span>
                                    <span className="feature-tag">📊 Analytics</span>
                                </div>
                            </article>
                            <article className="why-choose-card" itemScope itemType="https://schema.org/Service">
                                <div className="why-choose-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                        <polyline points="22,4 12,14.01 9,11.01" />
                                    </svg>
                                </div>
                                <h3 itemProp="name">Garanties & Engagement</h3>
                                <p itemProp="description">Satisfaction garantie, maintenance incluse et support réactif pour votre tranquillité. <strong>Maintenance site web</strong>, <strong>hébergement web</strong> et <strong>support technique</strong>.</p>
                                <div className="why-choose-features">
                                    <span className="feature-tag">✅ Garantie</span>
                                    <span className="feature-tag">🔧 Maintenance</span>
                                    <span className="feature-tag">📞 Support 24h</span>
                                </div>
                            </article>
                        </div>
                    </div>
                </section>

                {/* PROCESS */}
                <section className="process-section" id="process" aria-labelledby="process-title">
                    <div className="container">
                        <div className="section-header">
                            <span className="section-badge">🚀 Notre Processus</span>
                            <h2 id="process-title" className="section-title">Une Méthodologie Éprouvée</h2>
                            <p className="section-description">
                                Un processus en <strong>4 étapes</strong> pour garantir la réussite de votre projet digital
                                et vous accompagner vers l'excellence. <strong>Méthodologie agile</strong>, <strong>gestion projet web</strong>
                                et <strong>développement itératif</strong>.
                            </p>
                        </div>

                        <div className="process-timeline">
                            {/* Étape 1 */}
                            <div className="process-step" data-step="1">
                                <div className="process-visual">
                                    <div className="process-icon-wrapper">
                                        <div className="process-icon">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                                <path d="M9 12l2 2 4-4"/>
                                                <path d="M21 12c-1 0-2-1-2-2s1-2 2-2 2 1 2 2-1 2-2 2z"/>
                                                <path d="M3 12c1 0 2-1 2-2s-1-2-2-2-2 1-2 2 1 2 2 2z"/>
                                                <path d="M12 3c0 1-1 2-2 2s-2-1-2-2 1-2 2-2 2 1 2 2z"/>
                                                <path d="M12 21c0-1 1-2 2-2s2 1 2 2-1 2-2 2-2-1-2-2z"/>
                                            </svg>
                                        </div>
                                        <div className="process-number">01</div>
                                        <div className="process-connector"></div>
                                    </div>
                                </div>
                                <div className="process-content">
                                    <div className="process-header">
                                        <h3>📋 Analyse & Stratégie</h3>
                                    </div>
                                    <p>Étude approfondie de vos besoins, analyse de la concurrence et définition de la stratégie digitale optimale. <strong>Audit SEO</strong>, <strong>étude de marché</strong> et <strong>analyse concurrentielle</strong>.</p>
                                    <div className="process-features">
                                        <div className="feature-item">
                                            <div className="feature-icon">🔍</div>
                                            <span>Audit de votre présence actuelle</span>
                                        </div>
                                        <div className="feature-item">
                                            <div className="feature-icon">📊</div>
                                            <span>Analyse de la concurrence</span>
                                        </div>
                                        <div className="feature-item">
                                            <div className="feature-icon">🎯</div>
                                            <span>Définition des objectifs</span>
                                        </div>
                                    </div>
                                    <div className="process-deliverables">
                                        <span className="deliverable-tag">📄 Brief créatif</span>
                                        <span className="deliverable-tag">📈 Plan stratégique</span>
                                        <span className="deliverable-tag">🎨 Moodboard</span>
                                    </div>
                                </div>
                            </div>

                            {/* Étape 2 */}
                            <div className="process-step" data-step="2">
                                <div className="process-visual">
                                    <div className="process-icon-wrapper">
                                        <div className="process-icon">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                                            </svg>
                                        </div>
                                        <div className="process-number">02</div>
                                        <div className="process-connector"></div>
                                    </div>
                                </div>
                                <div className="process-content">
                                    <div className="process-header">
                                        <h3>🎨 Design & Conception</h3>
                                    </div>
                                    <p>Création de maquettes, design d'interface et validation de l'expérience utilisateur. <strong>Maquette site web</strong>, <strong>wireframe</strong>, <strong>design d'interface</strong> et <strong>prototypage</strong>.</p>
                                    <div className="process-features">
                                        <div className="feature-item">
                                            <div className="feature-icon">✏️</div>
                                            <span>Maquettes et wireframes</span>
                                        </div>
                                        <div className="feature-item">
                                            <div className="feature-icon">🎨</div>
                                            <span>Design d'interface</span>
                                        </div>
                                        <div className="feature-item">
                                            <div className="feature-icon">👥</div>
                                            <span>Validation UX/UI</span>
                                        </div>
                                    </div>
                                    <div className="process-deliverables">
                                        <span className="deliverable-tag">📱 Maquettes</span>
                                        <span className="deliverable-tag">🎨 Design System</span>
                                        <span className="deliverable-tag">📋 Guide Style</span>
                                    </div>
                                </div>
                            </div>

                            {/* Étape 3 */}
                            <div className="process-step" data-step="3">
                                <div className="process-visual">
                                    <div className="process-icon-wrapper">
                                        <div className="process-icon">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                                <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
                                            </svg>
                                        </div>
                                        <div className="process-number">03</div>
                                        <div className="process-connector"></div>
                                    </div>
                                </div>
                                <div className="process-content">
                                    <div className="process-header">
                                        <h3>⚡ Développement & Tests</h3>
                                    </div>
                                    <p>Développement technique, intégration et tests rigoureux pour garantir la qualité. <strong>Programmation web</strong>, <strong>développement front-end</strong>, <strong>développement back-end</strong> et <strong>tests qualité</strong>.</p>
                                    <div className="process-features">
                                        <div className="feature-item">
                                            <div className="feature-icon">💻</div>
                                            <span>Développement front/back</span>
                                        </div>
                                        <div className="feature-item">
                                            <div className="feature-icon">🔧</div>
                                            <span>Intégration des fonctionnalités</span>
                                        </div>
                                        <div className="feature-item">
                                            <div className="feature-icon">✅</div>
                                            <span>Tests et optimisation</span>
                                        </div>
                                    </div>
                                    <div className="process-deliverables">
                                        <span className="deliverable-tag">🌐 Site fonctionnel</span>
                                        <span className="deliverable-tag">📱 Version mobile</span>
                                        <span className="deliverable-tag">⚡ Performance optimisée</span>
                                    </div>
                                </div>
                            </div>

                            {/* Étape 4 */}
                            <div className="process-step" data-step="4">
                                <div className="process-visual">
                                    <div className="process-icon-wrapper">
                                        <div className="process-icon">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                                                <polyline points="22,4 12,14.01 9,11.01"/>
                                            </svg>
                                        </div>
                                        <div className="process-number">04</div>
                                    </div>
                                </div>
                                <div className="process-content">
                                    <div className="process-header">
                                        <h3>🚀 Mise en Ligne & Suivi</h3>
                                    </div>
                                    <p>Déploiement, formation et accompagnement post-lancement pour votre réussite. <strong>Mise en ligne site</strong>, <strong>hébergement web</strong>, <strong>formation utilisateur</strong> et <strong>maintenance site</strong>.</p>
                                    <div className="process-features">
                                        <div className="feature-item">
                                            <div className="feature-icon">🔒</div>
                                            <span>Déploiement sécurisé</span>
                                        </div>
                                        <div className="feature-item">
                                            <div className="feature-icon">👨‍💼</div>
                                            <span>Formation utilisateurs</span>
                                        </div>
                                        <div className="feature-item">
                                            <div className="feature-icon">📈</div>
                                            <span>Suivi et maintenance</span>
                                        </div>
                                    </div>
                                    <div className="process-deliverables">
                                        <span className="deliverable-tag">🌍 Site en ligne</span>
                                        <span className="deliverable-tag">📚 Documentation</span>
                                        <span className="deliverable-tag">🛠️ Support</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div className="process-cta">
                            <div className="cta-content">
                                <h3>Prêt à lancer votre projet ?</h3>
                                <p>Découvrez comment notre processus peut transformer votre vision en réalité digitale. <strong>Devis gratuit</strong>, <strong>étude de faisabilité</strong> et <strong>accompagnement personnalisé</strong>.</p>
                                <div className="cta-actions">
                                    <a href="#contact-form" className="btn btn-primary btn-large">
                                        <span>🚀 Démarrer mon projet</span>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                            <path d="M5 12h14M12 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                    <Link href="/Portfolio" className="btn btn-outline btn-large">
                                        <span>👀 Voir nos réalisations</span>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                            <circle cx="12" cy="12" r="3"/>
                                        </svg>
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {/* TESTIMONIALS */}
                <section className="testimonials-section" aria-labelledby="testimonials-title" style={{ marginTop: '-2rem' }}>
                    <div className="container">
                        <div className="section-header">
                            <span className="section-badge">💬 Témoignages</span>
                            <h2 id="testimonials-title" className="section-title">Ils Nous Font Confiance</h2>
                        </div>
                        <div className="testimonials-grid">
                            <article className="testimonial-card" itemScope itemType="https://schema.org/Review">
                                <div className="testimonial-content">
                                    <div className="testimonial-quote">
                                        <svg viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                                        </svg>
                                    </div>
                                    <p className="testimonial-text" itemProp="reviewBody">
                                        "Une équipe exceptionnelle qui a su comprendre nos besoins et créer un site parfaitement adapté.
                                        Les résultats dépassent nos attentes avec une augmentation de 300% du trafic ! <strong>Site e-commerce</strong>
                                        et <strong>référencement naturel</strong> au top."
                                    </p>
                                    <div className="testimonial-author">
                                        <div className="author-info">
                                            <h4 itemProp="author">Romain G.</h4>
                                            <span>Fondateur, Loukart</span>
                                            <div className="rating" itemProp="reviewRating" itemScope itemType="https://schema.org/Rating">
                                                <meta itemProp="ratingValue" content="5" />
                                                <meta itemProp="bestRating" content="5" />
                                                <span className="stars">⭐⭐⭐⭐⭐</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div itemProp="itemReviewed" itemScope itemType="https://schema.org/Organization">
                                        <meta itemProp="name" content="Kreyatik Studio" />
                                        <meta itemProp="url" content={typeof window !== 'undefined' ? window.location.origin : ''} />
                                    </div>
                                </div>
                            </article>
                            <article className="testimonial-card" itemScope itemType="https://schema.org/Review">
                                <div className="testimonial-content">
                                    <div className="testimonial-quote">
                                        <svg viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                                        </svg>
                                    </div>
                                    <p className="testimonial-text" itemProp="reviewBody">
                                        "Réactivité, créativité et professionnalisme. Kreyatik Studio a transformé notre vision
                                        en une réalité digitale exceptionnelle. ROI immédiat ! <strong>Application web</strong>
                                        et <strong>design moderne</strong> parfait."
                                    </p>
                                    <div className="testimonial-author">
                                        <div className="author-info">
                                            <h4 itemProp="author">Fred L.</h4>
                                            <span>Fondateur, Snack</span>
                                            <div className="rating" itemProp="reviewRating" itemScope itemType="https://schema.org/Rating">
                                                <meta itemProp="ratingValue" content="5" />
                                                <meta itemProp="bestRating" content="5" />
                                                <span className="stars">⭐⭐⭐⭐⭐</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div itemProp="itemReviewed" itemScope itemType="https://schema.org/Organization">
                                        <meta itemProp="name" content="Kreyatik Studio" />
                                        <meta itemProp="url" content={typeof window !== 'undefined' ? window.location.origin : ''} />
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </section>

                {/* BLOG ARTICLES */}
                <section className="testimonials-section" aria-labelledby="blog-title">
                    <div className="container">
                        <div className="section-header">
                            <span className="section-badge">📖 Blog</span>
                            <h2 id="blog-title" className="section-title">Nos Derniers Articles</h2>
                            <p className="section-description">
                                Découvrez nos conseils d'experts, astuces et actualités du <strong>développement web</strong>,
                                <strong>référencement SEO</strong> et <strong>marketing digital</strong>.
                            </p>
                        </div>

                        {latestArticles && latestArticles.length > 0 ? (
                            <>
                                <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '1.5rem', maxWidth: '900px', margin: '0 auto' }} className="articles-grid">
                                    <style dangerouslySetInnerHTML={{ __html: `
                                        @media (max-width: 768px) {
                                            .articles-grid {
                                                grid-template-columns: 1fr !important;
                                                gap: 1.5rem !important;
                                            }
                                        }
                                    ` }} />
                                    {latestArticles.slice(0, 2).map((article) => {
                                        const publishedDate = article.published_at || article.created_at;
                                        const readTime = Math.ceil(article.content.replace(/<[^>]*>/g, '').split(/\s+/).length / 200);

                                        return (
                                            <article key={article.id} style={{ background: 'white', borderRadius: '16px', boxShadow: '0 4px 20px rgba(0,0,0,0.08)', overflow: 'hidden', transition: 'all 0.3s ease', border: '1px solid #f1f5f9', display: 'flex' }} itemScope itemType="https://schema.org/BlogPosting">
                                                {article.image ? (
                                                    <div style={{ width: '160px', minWidth: '160px', background: '#f8fafc', flexShrink: 0 }}>
                                                        <img
                                                            src={`/storage/${article.image}`}
                                                            alt={`Image de l'article ${article.title}`}
                                                            style={{ width: '100%', height: '100%', objectFit: 'cover' }}
                                                            loading="lazy"
                                                            itemProp="image"
                                                        />
                                                    </div>
                                                ) : (
                                                    <div style={{ width: '160px', minWidth: '160px', background: 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)', display: 'flex', alignItems: 'center', justifyContent: 'center', flexShrink: 0 }}>
                                                        <svg viewBox="0 0 24 24" fill="none" stroke="white" strokeWidth="2" style={{ width: '28px', height: '28px' }}>
                                                            <path d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                                        </svg>
                                                    </div>
                                                )}

                                                <div style={{ flex: 1, padding: '0.875rem', display: 'flex', flexDirection: 'column', justifyContent: 'space-between', minHeight: '120px' }}>
                                                    <div>
                                                        <div style={{ display: 'flex', alignItems: 'center', marginBottom: '0.375rem', fontSize: '0.65rem', color: '#64748b' }}>
                                                            <svg style={{ width: '10px', height: '10px', marginRight: '0.25rem' }} fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                            </svg>
                                                            <time dateTime={new Date(publishedDate).toISOString().split('T')[0]} itemProp="datePublished">
                                                                {new Date(publishedDate).toLocaleDateString('fr-FR', { day: '2-digit', month: 'short', year: 'numeric' })}
                                                            </time>
                                                            <span style={{ margin: '0 0.375rem', color: '#d1d5db' }}>•</span>
                                                            <span>{readTime} min</span>
                                                        </div>

                                                        <h3 style={{ fontSize: '0.875rem', fontWeight: 600, lineHeight: 1.3, marginBottom: '0.375rem', color: 'var(--text-dark)' }} itemProp="headline">
                                                            <Link href={`/blog/${article.slug}`} style={{ color: 'inherit', textDecoration: 'none' }} itemProp="url">
                                                                {article.title.substring(0, 45)}{article.title.length > 45 ? '...' : ''}
                                                            </Link>
                                                        </h3>

                                                        <p style={{ fontSize: '0.75rem', color: '#64748b', lineHeight: 1.4, marginBottom: '0.5rem' }} itemProp="description">
                                                            {article.content.replace(/<[^>]*>/g, '').substring(0, 60)}{article.content.replace(/<[^>]*>/g, '').length > 60 ? '...' : ''}
                                                        </p>
                                                    </div>

                                                    <div style={{ marginTop: 'auto' }}>
                                                        <Link href={`/blog/${article.slug}`} style={{ background: 'var(--primary-blue)', color: 'white', padding: '0.375rem 0.75rem', borderRadius: '5px', fontSize: '0.75rem', fontWeight: 500, textDecoration: 'none', display: 'inline-flex', alignItems: 'center', gap: '0.25rem', transition: 'all 0.3s ease' }}>
                                                            Lire
                                                            <svg style={{ width: '10px', height: '10px' }} fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5l7 7-7 7"/>
                                                            </svg>
                                                        </Link>
                                                    </div>
                                                </div>

                                                <meta itemProp="author" content="Kreyatik Studio" />
                                                <meta itemProp="publisher" content="Kreyatik Studio" />
                                            </article>
                                        );
                                    })}
                                </div>

                                <div style={{ textAlign: 'center', marginTop: '3rem' }}>
                                    <Link href="/blog" className="btn btn-outline">
                                        <span>📚 Voir tous nos articles</span>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                            <path d="M5 12h14M12 5l7 7-7 7"/>
                                        </svg>
                                    </Link>
                                </div>
                            </>
                        ) : (
                            <div style={{ textAlign: 'center', padding: '3rem 0' }}>
                                <div style={{ fontSize: '3rem', marginBottom: '1rem' }}>📝</div>
                                <h3>Articles en préparation</h3>
                                <p>Nous travaillons sur de nouveaux contenus passionnants. Revenez bientôt !</p>
                            </div>
                        )}
                    </div>
                </section>

                {/* CTA */}
                <section className="cta-section" id="contact" aria-labelledby="cta-title">
                    <div className="container">
                        <div className="cta-content">
                            <h2 id="cta-title">🚀 Prêt à Transformer Votre Présence Digitale ?</h2>
                            <p>Discutons de votre projet et créons ensemble quelque chose d'<strong>extraordinaire</strong> qui génère des <strong>résultats concrets</strong>. <strong>Développeur web freelance Rochefort</strong>, <strong>développeur web Charente-Maritime</strong>, <strong>création site internet</strong> et <strong>référencement SEO</strong>.</p>
                            <div className="cta-actions">
                                <a href="#contact-form" className="btn btn-primary btn-large" aria-label="Commencer votre projet">
                                    <span>🎯 Commencer votre projet</span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                        <path d="M5 12h14M12 5l7 7-7 7" />
                                    </svg>
                                </a>
                                <a href="tel:+33695800663" className="btn btn-outline btn-large" aria-label="Appelez-nous">
                                    <span>📞 Appelez-nous</span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                        <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>

                {/* CONTACT */}
                <section className="contact-section" id="contact-form" aria-labelledby="contact-title">
                    <div className="container">
                        <div className="section-header">
                            <div className="section-badge">Contact</div>
                            <h2 id="contact-title" className="section-title">💼 Parlons de Votre Projet</h2>
                            <p className="section-description">Remplissez le formulaire ci-dessous et nous vous recontacterons dans les <strong>24h</strong> avec une proposition personnalisée. <strong>Devis gratuit</strong>, <strong>étude de faisabilité</strong> et <strong>conseil expert</strong>.</p>
                        </div>

                        <div className="contact-grid">
                            <div className="contact-info">
                                <div className="contact-info-header">
                                    <h3>Nos Coordonnées</h3>
                                    <p>N'hésitez pas à nous contacter directement ou à utiliser le formulaire. <strong>Développeur web freelance Rochefort</strong>, <strong>développeur web Charente-Maritime</strong> et <strong>expert digital</strong>.</p>
                                </div>

                                <div className="contact-details">
                                    <div className="contact-item">
                                        <div className="contact-icon">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                                <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z" />
                                            </svg>
                                        </div>
                                        <div className="contact-text">
                                            <h4>Téléphone</h4>
                                            <p><a href="tel:+33695800663">+33 6 95 80 06 63</a></p>
                                        </div>
                                    </div>

                                    <div className="contact-item">
                                        <div className="contact-icon">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                                <polyline points="22,6 12,13 2,6" />
                                            </svg>
                                        </div>
                                        <div className="contact-text">
                                            <h4>Email</h4>
                                            <p><a href="mailto:kreyatik@gmail.com">kreyatik@gmail.com</a></p>
                                        </div>
                                    </div>

                                    <div className="contact-item">
                                        <div className="contact-icon">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
                                                <circle cx="12" cy="10" r="3" />
                                            </svg>
                                        </div>
                                        <div className="contact-text">
                                            <h4>Adresse</h4>
                                            <p>2 rue du petit port marchand<br />17300 Rochefort, France</p>
                                        </div>
                                    </div>
                                </div>

                                <div className="contact-extra">
                                    <div className="contact-benefit">
                                        <div className="benefit-icon">⚡</div>
                                        <div className="benefit-text">
                                            <h4>Réponse Rapide</h4>
                                            <p>Nous répondons sous 24h</p>
                                        </div>
                                    </div>
                                    <div className="contact-benefit">
                                        <div className="benefit-icon">🎯</div>
                                        <div className="benefit-text">
                                            <h4>Devis Gratuit</h4>
                                            <p>Estimation personnalisée</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div className="contact-form-container">
                                <div className="form-header">
                                    <h3>Envoyez-nous un message</h3>
                                    <p>Décrivez votre projet et nous vous répondrons rapidement. <strong>Devis site web</strong>, <strong>étude projet</strong> et <strong>conseil digital</strong>.</p>
                                </div>

                                <form onSubmit={handleSubmit} className="contact-form" id="contactForm" itemScope itemType="https://schema.org/ContactPage">
                                    <div className="form-row">
                                        <div className="form-group">
                                            <label htmlFor="name" className="form-label">Nom complet *</label>
                                            <input
                                                type="text"
                                                id="name"
                                                name="name"
                                                placeholder="Votre nom complet"
                                                required
                                                className="form-input"
                                                itemProp="name"
                                                value={data.name}
                                                onChange={e => setData('name', e.target.value)}
                                            />
                                        </div>
                                        <div className="form-group">
                                            <label htmlFor="email" className="form-label">Email *</label>
                                            <input
                                                type="email"
                                                id="email"
                                                name="email"
                                                placeholder="Votre email"
                                                required
                                                className="form-input"
                                                itemProp="email"
                                                value={data.email}
                                                onChange={e => setData('email', e.target.value)}
                                            />
                                        </div>
                                    </div>

                                    <div className="form-group">
                                        <label htmlFor="object" className="form-label">Objet *</label>
                                        <input
                                            type="text"
                                            id="object"
                                            name="object_message"
                                            placeholder="Objet de votre message"
                                            required
                                            className="form-input"
                                            value={data.object_message}
                                            onChange={e => setData('object_message', e.target.value)}
                                        />
                                    </div>

                                    <div className="form-group">
                                        <label htmlFor="message" className="form-label">Message *</label>
                                        <textarea
                                            id="message"
                                            name="message"
                                            placeholder="Décrivez votre projet, vos besoins, votre budget..."
                                            rows="6"
                                            required
                                            className="form-textarea"
                                            itemProp="description"
                                            value={data.message}
                                            onChange={e => setData('message', e.target.value)}
                                        ></textarea>
                                    </div>

                                    <button type="submit" className="btn btn-primary btn-full" aria-label="Envoyer le message" disabled={processing}>
                                        <span>📤 Envoyer le message</span>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                            <line x1="22" y1="2" x2="11" y2="13" />
                                            <polygon points="22,2 15,22 11,13 2,9 22,2" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </PublicLayout>
    );
}
