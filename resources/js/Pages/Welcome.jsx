import { Link, useForm, Head } from '@inertiajs/react';
import { useEffect, useRef } from 'react';
import PublicLayout from '@/Layouts/PublicLayout';

// Star SVG component
const Star = () => (
    <svg viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
);

export default function Welcome({ seo, latestArticles }) {
    const { data, setData, post, processing } = useForm({
        name: '',
        email: '',
        object_message: '',
        message: '',
    });

    const mainRef = useRef(null);

    // Scroll reveal observer
    useEffect(() => {
        const revealElements = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    observer.unobserve(entry.target);
                }
            });
        }, { rootMargin: '0px 0px -60px 0px', threshold: 0.1 });

        revealElements.forEach((el) => observer.observe(el));

        // Hero parallax
        const heroImg = document.querySelector('.hero-bg-image');
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        const handleScroll = () => {
            if (heroImg && !prefersReducedMotion && window.scrollY < window.innerHeight) {
                heroImg.style.transform = `scale(1.1) translateY(${window.scrollY * 0.15}px)`;
            }
        };
        window.addEventListener('scroll', handleScroll, { passive: true });

        return () => {
            observer.disconnect();
            window.removeEventListener('scroll', handleScroll);
        };
    }, []);

    const handleSubmit = (e) => {
        e.preventDefault();
        post('/send-email');
    };

    return (
        <PublicLayout seo={seo}>
            <Head>
                {/* Schema.org Organization */}
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
                            { "@type": "City", "name": "Rochefort" },
                            { "@type": "City", "name": "La Rochelle" },
                            { "@type": "City", "name": "Saintes" },
                            { "@type": "City", "name": "Royan" },
                            { "@type": "State", "name": "Charente-Maritime" },
                            { "@type": "Country", "name": "France" }
                        ],
                        "priceRange": "€€",
                        "openingHoursSpecification": [
                            {
                                "@type": "OpeningHoursSpecification",
                                "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
                                "opens": "09:00",
                                "closes": "19:00"
                            },
                            {
                                "@type": "OpeningHoursSpecification",
                                "dayOfWeek": "Saturday",
                                "opens": "09:00",
                                "closes": "12:00"
                            }
                        ],
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
                                { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Création de site internet sur-mesure", "description": "Développement de sites web modernes et performants avec Laravel, React et TailwindCSS" } },
                                { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "E-commerce et boutiques en ligne", "description": "Solutions e-commerce complètes avec paiement sécurisé et gestion des stocks" } },
                                { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Applications SaaS et CRM", "description": "Développement d'applications web complexes sur-mesure (SaaS, CRM, outils métier)" } },
                                { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Référencement SEO", "description": "Optimisation SEO on-page, Core Web Vitals et stratégie de référencement naturel" } }
                            ]
                        }
                    })}
                </script>
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
                <script type="application/ld+json">
                    {JSON.stringify({
                        "@context": "https://schema.org",
                        "@type": "BreadcrumbList",
                        "itemListElement": [{ "@type": "ListItem", "position": 1, "name": "Accueil", "item": "https://kreyatikstudio.fr" }]
                    })}
                </script>
            </Head>

            <main className="main-page" ref={mainRef}>
                {/* Grain Overlay */}
                <div className="grain-overlay" aria-hidden="true"></div>

                {/* ==================== HERO ==================== */}
                <section className="hero-section" aria-labelledby="hero-title">
                    <div className="hero-background">
                        <picture>
                            <source media="(max-width: 768px)" srcSet="/images/compose-768.jpg" />
                            <source media="(max-width: 1280px)" srcSet="/images/compose-1280.jpg" />
                            <source media="(max-width: 1536px)" srcSet="/images/compose-1536.jpg" />
                            <img src="/images/compose-1920.jpg" alt="Kreyatik Studio - Développeur Web Freelance spécialisé en création sites internet Rochefort" className="hero-bg-image" loading="eager" width="1920" height="1080" />
                        </picture>
                        <div className="hero-overlay"></div>
                        <div className="hero-mesh" aria-hidden="true"></div>
                    </div>

                    <div className="hero-container">
                        <div className="hero-content">
                            <div className="hero-badge reveal" aria-label="Badge développeur web">
                                <span className="badge-dot"></span>
                                <span className="badge-text">Kreyatik Studio</span>
                            </div>
                            <h1 id="hero-title" className="hero-title">
                                <span className="title-line reveal reveal-delay-1">Transformons vos</span>
                                <span className="title-highlight reveal reveal-delay-2">idées en succès</span>
                                <span className="title-line reveal reveal-delay-3">digital</span>
                            </h1>
                            <p className="hero-description reveal reveal-delay-4">
                                Studio web basé à Rochefort, au cœur de la Charente-Maritime. Nous concevons des sites{' '}
                                <span className="highlight-text">performants</span>, <span className="highlight-text">sur-mesure</span> et{' '}
                                <span className="highlight-text">rentables</span> pour les entreprises de la région et d'ailleurs.
                            </p>
                            <div className="hero-actions reveal reveal-delay-5">
                                <a href="#why-choose" className="btn btn-primary">
                                    <span>Découvrir nos avantages</span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M5 12h14M12 5l7 7-7 7" /></svg>
                                </a>
                                <a href="#contact" className="btn btn-glass">
                                    <span>Audit gratuit SEO</span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                                </a>
                            </div>
                        </div>

                        <div className="hero-metrics reveal reveal-delay-5" role="region" aria-label="Statistiques">
                            <div className="metric-card">
                                <span className="metric-number">+10</span>
                                <span className="metric-label">Projets réalisés</span>
                            </div>
                            <div className="metric-card">
                                <span className="metric-number">98%</span>
                                <span className="metric-label">Clients satisfaits</span>
                            </div>
                            <div className="metric-card">
                                <span className="metric-number">24h</span>
                                <span className="metric-label">Temps de réponse</span>
                            </div>
                        </div>
                    </div>

                    <div className="hero-scroll-hint" aria-hidden="true">
                        <div className="scroll-mouse"><div className="scroll-wheel"></div></div>
                    </div>
                </section>

                {/* ==================== SERVICES (BENTO) ==================== */}
                <section className="services-section" id="services" aria-labelledby="services-title">
                    <div className="container">
                        <div className="section-header">
                            <span className="section-tag reveal">Nos Services</span>
                            <h2 id="services-title" className="section-title reveal reveal-delay-1">Solutions Digitales <span className="text-gradient">Complètes</span></h2>
                            <p className="section-description reveal reveal-delay-2">
                                De la conception créative à la mise en ligne, nous accompagnons
                                votre transformation digitale avec des solutions sur-mesure.
                            </p>
                        </div>

                        <div className="bento-grid">
                            <article className="bento-card bento-large reveal" itemScope itemType="https://schema.org/Service">
                                <div className="bento-glow bento-glow-cyan"></div>
                                <div className="bento-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" /></svg>
                                </div>
                                <h3 itemProp="name">Développement Web Avancé</h3>
                                <p itemProp="description">Sites vitrines, e-commerce, SaaS et applications sur-mesure. Nous utilisons Laravel, React et les technologies les plus adaptées à chaque projet.</p>
                                <div className="bento-tags">
                                    <span>Responsive Design</span>
                                    <span>Performance</span>
                                    <span>Sécurité</span>
                                </div>
                                <meta itemProp="provider" content="Kreyatik Studio" />
                            </article>

                            <article className="bento-card reveal reveal-delay-1" itemScope itemType="https://schema.org/Service">
                                <div className="bento-glow bento-glow-gold"></div>
                                <div className="bento-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5"><path d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z" /></svg>
                                </div>
                                <h3 itemProp="name">Design & UX Créatif</h3>
                                <p itemProp="description">Interfaces modernes et intuitives qui captent l'attention et convertissent vos visiteurs. Du logo à l'expérience complète.</p>
                                <div className="bento-tags">
                                    <span>Design System</span>
                                    <span>UX/UI</span>
                                    <span>Prototypage</span>
                                </div>
                                <meta itemProp="provider" content="Kreyatik Studio" />
                            </article>

                            <article className="bento-card reveal reveal-delay-2" itemScope itemType="https://schema.org/Service">
                                <div className="bento-glow bento-glow-green"></div>
                                <div className="bento-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5"><path d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                                </div>
                                <h3 itemProp="name">SEO & Marketing Digital</h3>
                                <p itemProp="description">Stratégies de visibilité qui génèrent du trafic qualifié et des résultats mesurables. Référencement naturel, publicité en ligne et création de contenu.</p>
                                <div className="bento-tags">
                                    <span>SEO</span>
                                    <span>Analytics</span>
                                    <span>ROI</span>
                                </div>
                                <meta itemProp="provider" content="Kreyatik Studio" />
                            </article>
                        </div>
                    </div>
                </section>

                {/* ==================== TERRITOIRE ==================== */}
<section style={{ background: '#07111F', padding: '5rem 0 4rem', overflow: 'hidden' }} aria-label="Zone d'intervention Kréyatik Studio">
    <div style={{ maxWidth: 1280, margin: '0 auto', padding: '0 32px' }}>
        <p className="reveal" style={{ fontFamily: "'Outfit', sans-serif", fontSize: '0.78rem', fontWeight: 500, letterSpacing: '0.22em', textTransform: 'uppercase', color: '#0099CC', marginBottom: '2.5rem', textAlign: 'center' }}>
            Zone d'intervention
        </p>
        <div className="reveal reveal-delay-1" style={{ display: 'flex', flexWrap: 'wrap', alignItems: 'baseline', gap: '0 3rem', justifyContent: 'center' }}>
            {[
                { name: 'Rochefort', size: 'clamp(2.8rem, 7vw, 7rem)', opacity: 1 },
                { name: 'La Rochelle', size: 'clamp(2rem, 5vw, 5rem)', opacity: 0.45 },
                { name: 'Saintes', size: 'clamp(1.6rem, 4vw, 4rem)', opacity: 0.35 },
                { name: 'Royan', size: 'clamp(1.4rem, 3.5vw, 3.5rem)', opacity: 0.28 },
            ].map(city => (
                <span key={city.name} style={{
                    fontFamily: "'Syne', sans-serif",
                    fontSize: city.size,
                    fontWeight: 800,
                    letterSpacing: '-0.03em',
                    color: `rgba(255,255,255,${city.opacity})`,
                    lineHeight: 1.05,
                    transition: 'opacity 0.3s ease',
                    cursor: 'default',
                }}>{city.name}</span>
            ))}
        </div>
        <p className="reveal reveal-delay-2" style={{ fontFamily: "'Outfit', sans-serif", fontSize: '1rem', color: 'rgba(255,255,255,0.55)', textAlign: 'center', marginTop: '2.5rem', letterSpacing: '0.08em', display: 'flex', alignItems: 'center', justifyContent: 'center', gap: '0.75rem' }}>
            <span style={{ display: 'inline-block', width: 32, height: 1, background: 'rgba(0,153,204,0.6)' }}></span>
            et partout en France en remote
            <span style={{ display: 'inline-block', width: 32, height: 1, background: 'rgba(0,153,204,0.6)' }}></span>
        </p>
    </div>
</section>

                {/* ==================== POURQUOI NOUS ==================== */}
                <section className="why-section" id="why-choose" aria-labelledby="why-choose-title">
                    <div className="container">
                        <div className="section-header">
                            <span className="section-tag reveal">Pourquoi Nous</span>
                            <h2 id="why-choose-title" className="section-title reveal reveal-delay-1">Votre Succès, <span className="text-gradient">Notre Priorité</span></h2>
                            <p className="section-description reveal reveal-delay-2">
                                Une approche personnalisée, une expertise technique solide et un engagement total envers votre réussite digitale.
                            </p>
                        </div>

                        <div className="why-grid">
                            {[
                                { num: '01', title: 'Excellence Technique', desc: 'Technologies de pointe, code propre et optimisé, respect des standards web les plus élevés.', tags: ['Performance', 'Sécurité', 'Responsive'], icon: 'M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z' },
                                { num: '02', title: 'Accompagnement Personnalisé', desc: 'Un suivi sur-mesure, des conseils d\'experts et une relation de confiance durable.', tags: ['Disponibilité', 'Communication', 'Support'], icon: 'M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2' },
                                { num: '03', title: 'Solutions Sur-Mesure', desc: 'Chaque projet est unique. Nous créons des solutions adaptées à vos besoins spécifiques.', tags: ['Design Unique', 'Sur-Mesure', 'Analytics'], icon: 'M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z' },
                                { num: '04', title: 'Garanties & Engagement', desc: 'Satisfaction garantie, maintenance incluse et support réactif pour votre tranquillité.', tags: ['Garantie', 'Maintenance', 'Support 24h'], icon: 'M22 11.08V12a10 10 0 1 1-5.93-9.14' },
                            ].map((card, i) => (
                                <article key={card.num} className={`why-card reveal ${i > 0 ? `reveal-delay-${i}` : ''}`} itemScope itemType="https://schema.org/Service">
                                    <div className="why-card-number">{card.num}</div>
                                    <div className="why-card-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5"><path d={card.icon} /></svg>
                                    </div>
                                    <h3 itemProp="name">{card.title}</h3>
                                    <p itemProp="description">{card.desc}</p>
                                    <div className="why-tags">
                                        {card.tags.map(tag => <span key={tag}>{tag}</span>)}
                                    </div>
                                </article>
                            ))}
                        </div>
                    </div>
                </section>

                {/* ==================== PROCESSUS ==================== */}
                <section className="process-section" id="process" aria-labelledby="process-title">
                    <div className="container">
                        <div className="section-header">
                            <span className="section-tag reveal">Notre Processus</span>
                            <h2 id="process-title" className="section-title reveal reveal-delay-1">Une Méthodologie <span className="text-gradient">Éprouvée</span></h2>
                            <p className="section-description reveal reveal-delay-2">
                                Un processus en 4 étapes pour garantir la réussite de votre projet digital.
                            </p>
                        </div>

                        <div className="process-timeline">
                            <div className="timeline-line" aria-hidden="true"></div>

                            {[
                                { num: '01', title: 'Analyse & Stratégie', desc: 'Étude approfondie de vos besoins, analyse de la concurrence et définition de la stratégie digitale optimale.', tags: ['Brief créatif', 'Plan stratégique', 'Moodboard'] },
                                { num: '02', title: 'Design & Conception', desc: 'Création de maquettes, design d\'interface et validation de l\'expérience utilisateur.', tags: ['Maquettes', 'Design System', 'Guide Style'] },
                                { num: '03', title: 'Développement & Tests', desc: 'Développement technique, intégration et tests rigoureux pour garantir la qualité.', tags: ['Site fonctionnel', 'Version mobile', 'Performance'] },
                                { num: '04', title: 'Mise en Ligne & Suivi', desc: 'Déploiement, formation et accompagnement post-lancement pour votre réussite.', tags: ['Site en ligne', 'Documentation', 'Support'] },
                            ].map((step, i) => (
                                <div key={step.num} className={`process-step reveal ${i > 0 ? `reveal-delay-${i}` : ''}`} data-step={i + 1}>
                                    <div className="step-marker">
                                        <span className="step-number">{step.num}</span>
                                    </div>
                                    <div className="step-content">
                                        <h3>{step.title}</h3>
                                        <p>{step.desc}</p>
                                        <div className="step-deliverables">
                                            {step.tags.map(tag => <span key={tag}>{tag}</span>)}
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>

                        <div className="process-cta reveal">
                            <div className="cta-inner">
                                <h3>Prêt à lancer votre projet ?</h3>
                                <p>Découvrez comment notre processus peut transformer votre vision en réalité digitale.</p>
                                <div className="cta-actions">
                                    <a href="#contact-form" className="btn btn-primary btn-large">
                                        <span>Démarrer mon projet</span>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                    </a>
                                    <Link href="/portfolio" className="btn btn-glass btn-large">
                                        <span>Voir nos réalisations</span>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {/* ==================== TÉMOIGNAGES ==================== */}
                <section className="testimonials-section" aria-labelledby="testimonials-title">
                    <div className="container">
                        <div className="section-header">
                            <span className="section-tag reveal">Témoignages</span>
                            <h2 id="testimonials-title" className="section-title reveal reveal-delay-1">Ils Nous Font <span className="text-gradient">Confiance</span></h2>
                        </div>
                        <div className="testimonials-grid">
                            {[
                                { initials: 'RG', name: 'Romain G.', role: 'Fondateur, Loukart', text: '"Une équipe exceptionnelle qui a su comprendre nos besoins et créer un site parfaitement adapté. Les résultats dépassent nos attentes avec une augmentation de 300% du trafic !"' },
                                { initials: 'FL', name: 'Fred L.', role: 'Fondateur, Snack', text: '"Réactivité, créativité et professionnalisme. Kreyatik Studio a transformé notre vision en une réalité digitale exceptionnelle. ROI immédiat !"' },
                            ].map((t, i) => (
                                <article key={t.initials} className={`testimonial-card reveal ${i > 0 ? 'reveal-delay-1' : ''}`} itemScope itemType="https://schema.org/Review">
                                    <div className="testimonial-stars" aria-label="5 étoiles">
                                        {[...Array(5)].map((_, j) => <Star key={j} />)}
                                    </div>
                                    <blockquote className="testimonial-text" itemProp="reviewBody">{t.text}</blockquote>
                                    <div className="testimonial-author">
                                        <div className="author-avatar">{t.initials}</div>
                                        <div className="author-info">
                                            <h4 itemProp="author">{t.name}</h4>
                                            <span>{t.role}</span>
                                        </div>
                                    </div>
                                    <div itemProp="reviewRating" itemScope itemType="https://schema.org/Rating">
                                        <meta itemProp="ratingValue" content="5" />
                                        <meta itemProp="bestRating" content="5" />
                                    </div>
                                    <div itemProp="itemReviewed" itemScope itemType="https://schema.org/Organization">
                                        <meta itemProp="name" content="Kreyatik Studio" />
                                        <meta itemProp="url" content={typeof window !== 'undefined' ? window.location.origin : ''} />
                                    </div>
                                </article>
                            ))}
                        </div>
                    </div>
                </section>

                {/* ==================== BLOG ==================== */}
                <section className="blog-section" aria-labelledby="blog-title">
                    <div className="container">
                        <div className="section-header">
                            <span className="section-tag reveal">Blog</span>
                            <h2 id="blog-title" className="section-title reveal reveal-delay-1">Nos Derniers <span className="text-gradient">Articles</span></h2>
                            <p className="section-description reveal reveal-delay-2">
                                Conseils d'experts, retours d'expérience et actualités pour booster votre présence en ligne.
                            </p>
                        </div>

                        {latestArticles && latestArticles.length > 0 ? (
                            <>
                                <div className="blog-grid">
                                    {latestArticles.slice(0, 2).map((article, index) => {
                                        const publishedDate = article.published_at || article.created_at;
                                        const readTime = Math.ceil(article.content.replace(/<[^>]*>/g, '').split(/\s+/).length / 200);
                                        return (
                                            <article key={article.id} className={`blog-card reveal ${index > 0 ? 'reveal-delay-1' : ''}`} itemScope itemType="https://schema.org/BlogPosting">
                                                <div className="blog-card-image">
                                                    {article.image ? (
                                                        <img src={`/storage/${article.image}`} alt={`Image de l'article ${article.title}`} loading="lazy" itemProp="image" />
                                                    ) : (
                                                        <div className="blog-card-placeholder">
                                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5"><path d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                                        </div>
                                                    )}
                                                </div>
                                                <div className="blog-card-body">
                                                    <div className="blog-card-meta">
                                                        <time dateTime={new Date(publishedDate).toISOString().split('T')[0]} itemProp="datePublished">
                                                            {new Date(publishedDate).toLocaleDateString('fr-FR', { day: '2-digit', month: 'short', year: 'numeric' })}
                                                        </time>
                                                        <span className="meta-sep"></span>
                                                        <span>{readTime} min de lecture</span>
                                                    </div>
                                                    <h3 itemProp="headline">
                                                        <Link href={`/blog/${article.slug}`} itemProp="url">
                                                            {article.title.substring(0, 60)}{article.title.length > 60 ? '...' : ''}
                                                        </Link>
                                                    </h3>
                                                    <p itemProp="description">
                                                        {article.content.replace(/<[^>]*>/g, '').substring(0, 100)}{article.content.replace(/<[^>]*>/g, '').length > 100 ? '...' : ''}
                                                    </p>
                                                    <Link href={`/blog/${article.slug}`} className="blog-card-link">
                                                        Lire l'article
                                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                                    </Link>
                                                </div>
                                                <meta itemProp="author" content="Kreyatik Studio" />
                                                <meta itemProp="publisher" content="Kreyatik Studio" />
                                            </article>
                                        );
                                    })}
                                </div>
                                <div className="blog-cta reveal">
                                    <Link href="/blog" className="btn btn-glass">
                                        <span>Voir tous nos articles</span>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                    </Link>
                                </div>
                            </>
                        ) : (
                            <div className="blog-empty reveal">
                                <h3>Articles en préparation</h3>
                                <p>Nous travaillons sur de nouveaux contenus passionnants. Revenez bientôt !</p>
                            </div>
                        )}
                    </div>
                </section>

                {/* ==================== CTA ==================== */}
                <section className="cta-section" id="contact" aria-labelledby="cta-title">
                    <div className="cta-bg-mesh" aria-hidden="true"></div>
                    <div className="container">
                        <div className="cta-content reveal">
                            <h2 id="cta-title">Prêt à Transformer Votre <span className="text-gradient-light">Présence Digitale</span> ?</h2>
                            <p>Discutons de votre projet et créons ensemble quelque chose d'extraordinaire qui génère des résultats concrets.</p>
                            <div className="cta-actions">
                                <a href="#contact-form" className="btn btn-primary btn-large">
                                    <span>Commencer votre projet</span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M5 12h14M12 5l7 7-7 7" /></svg>
                                </a>
                                <a href="tel:+33695800663" className="btn btn-glass btn-large">
                                    <span>Appelez-nous</span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z" /></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>

                {/* ==================== CONTACT ==================== */}
                <section className="contact-section" id="contact-form" aria-labelledby="contact-title">
                    <div className="container">
                        <div className="section-header">
                            <span className="section-tag reveal">Contact</span>
                            <h2 id="contact-title" className="section-title reveal reveal-delay-1">Parlons de Votre <span className="text-gradient">Projet</span></h2>
                            <p className="section-description reveal reveal-delay-2">Remplissez le formulaire et nous vous recontacterons dans les 24h avec une proposition personnalisée.</p>
                        </div>

                        <div className="contact-grid">
                            <div className="contact-info reveal">
                                <div className="contact-info-header">
                                    <h3>Nos Coordonnées</h3>
                                    <p>N'hésitez pas à nous contacter directement ou via le formulaire.</p>
                                </div>

                                <div className="contact-details">
                                    <a href="tel:+33695800663" className="contact-item">
                                        <div className="contact-icon">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z" /></svg>
                                        </div>
                                        <div className="contact-text">
                                            <h4>Téléphone</h4>
                                            <p>+33 6 95 80 06 63</p>
                                        </div>
                                    </a>
                                    <a href="mailto:kreyatik@gmail.com" className="contact-item">
                                        <div className="contact-icon">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" /><polyline points="22,6 12,13 2,6" /></svg>
                                        </div>
                                        <div className="contact-text">
                                            <h4>Email</h4>
                                            <p>kreyatik@gmail.com</p>
                                        </div>
                                    </a>
                                    <div className="contact-item">
                                        <div className="contact-icon">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" /><circle cx="12" cy="10" r="3" /></svg>
                                        </div>
                                        <div className="contact-text">
                                            <h4>Adresse</h4>
                                            <p>2 rue du petit port marchand<br />17300 Rochefort, France</p>
                                        </div>
                                    </div>
                                </div>

                                <div className="contact-badges">
                                    <div className="contact-badge">
                                        <span className="badge-icon-el">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                        </span>
                                        <div>
                                            <strong>Réponse Rapide</strong>
                                            <span>Sous 24h</span>
                                        </div>
                                    </div>
                                    <div className="contact-badge">
                                        <span className="badge-icon-el">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22,4 12,14.01 9,11.01"/></svg>
                                        </span>
                                        <div>
                                            <strong>Devis Gratuit</strong>
                                            <span>Sans engagement</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div className="contact-form-container reveal reveal-delay-1">
                                <div className="form-header">
                                    <h3>Envoyez-nous un message</h3>
                                    <p>Décrivez votre projet et nous vous répondrons rapidement.</p>
                                </div>

                                <form onSubmit={handleSubmit} className="contact-form" id="contactForm" itemScope itemType="https://schema.org/ContactPage">
                                    <div className="form-row">
                                        <div className="form-group">
                                            <label htmlFor="name" className="form-label">Nom complet</label>
                                            <input type="text" id="name" name="name" placeholder="Votre nom complet" required className="form-input" itemProp="name" autoComplete="name" value={data.name} onChange={e => setData('name', e.target.value)} />
                                        </div>
                                        <div className="form-group">
                                            <label htmlFor="email" className="form-label">Email</label>
                                            <input type="email" id="email" name="email" placeholder="Votre email" required className="form-input" itemProp="email" autoComplete="email" value={data.email} onChange={e => setData('email', e.target.value)} />
                                        </div>
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="object" className="form-label">Objet</label>
                                        <input type="text" id="object" name="object_message" placeholder="Objet de votre message" required className="form-input" value={data.object_message} onChange={e => setData('object_message', e.target.value)} />
                                    </div>
                                    <div className="form-group form-group-grow">
                                        <label htmlFor="message" className="form-label">Message</label>
                                        <textarea id="message" name="message" placeholder="Décrivez votre projet, vos besoins, votre budget..." rows="5" required className="form-textarea" itemProp="description" value={data.message} onChange={e => setData('message', e.target.value)}></textarea>
                                    </div>
                                    <button type="submit" className="btn btn-primary btn-full" disabled={processing}>
                                        <span>{processing ? 'Envoi en cours...' : 'Envoyer le message'}</span>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><line x1="22" y1="2" x2="11" y2="13" /><polygon points="22,2 15,22 11,13 2,9 22,2" /></svg>
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
