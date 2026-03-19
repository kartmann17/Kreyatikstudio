import { useEffect } from 'react';
import { Link } from '@inertiajs/react';
import PublicLayout from '@/Layouts/PublicLayout';

export default function MethodeTravail({ seo }) {
    useEffect(() => {
        const els = document.querySelectorAll('.reveal');
        const obs = new IntersectionObserver((entries) => {
            entries.forEach((e) => { if (e.isIntersecting) { e.target.classList.add('revealed'); obs.unobserve(e.target); } });
        }, { rootMargin: '0px 0px -60px 0px', threshold: 0.1 });
        els.forEach((el) => obs.observe(el));
        return () => obs.disconnect();
    }, []);

    return (
        <PublicLayout seo={seo}>
            <main className="main-page">

                {/* ===== HERO ===== */}
                <section className="hero-section"  aria-labelledby="methode-title">
                    <div className="hero-background">
                        <div style={{ position: 'absolute', inset: 0, background: 'linear-gradient(135deg, #0F2640 0%, #1B3A5C 50%, #0F2640 100%)' }}></div>
                        <div className="hero-mesh" aria-hidden="true"></div>
                    </div>
                    <div className="hero-container">
                        <div className="hero-content" style={{ maxWidth: 700 }}>
                            <div className="hero-badge reveal">
                                <span className="badge-dot"></span>
                                <span className="badge-text">Notre Méthode de Travail</span>
                            </div>
                            <h1 id="methode-title" className="hero-title">
                                <span className="title-line reveal reveal-delay-1">Processus</span>
                                <span className="title-highlight reveal reveal-delay-2">éprouvé et transparent</span>
                            </h1>
                            <p className="hero-description reveal reveal-delay-3">
                                Une méthode transparente et éprouvée, pensée pour les entreprises de Rochefort, La Rochelle
                                et toute la Charente-Maritime. De l'audit initial au déploiement, on travaille ensemble.
                            </p>
                        </div>
                    </div>
                </section>

                {/* ===== 5 ÉTAPES (WHY GRID) ===== */}
                <section className="services-section" aria-labelledby="steps-title">
                    <div className="container">
                        <div className="section-header">
                            <span className="section-tag reveal">5 Étapes</span>
                            <h2 id="steps-title" className="section-title reveal reveal-delay-1">Un Parcours <span className="text-gradient">Adaptatif</span></h2>
                            <p className="section-description reveal reveal-delay-2">Une méthode flexible qui s'ajuste selon la taille et les contraintes de votre projet.</p>
                        </div>

                        <div className="why-grid" style={{ gridTemplateColumns: 'repeat(5, 1fr)' }}>
                            {[
                                { num: '01', title: 'Audit & Analyse', time: '2-5 jours' },
                                { num: '02', title: 'Conception & Design', time: '1-2 semaines' },
                                { num: '03', title: 'Développement', time: '2-8 semaines' },
                                { num: '04', title: 'Tests & Optimisation', time: '3-5 jours' },
                                { num: '05', title: 'Déploiement & Suivi', time: '2-3 jours' },
                            ].map((step, i) => (
                                <article key={step.num} className={`why-card reveal ${i > 0 ? `reveal-delay-${i}` : ''}`} style={{ textAlign: 'center' }}>
                                    <div className="why-card-number" style={{ position: 'static', fontSize: '2.5rem', marginBottom: 12 }}>{step.num}</div>
                                    <h3 style={{ fontSize: '1rem' }}>{step.title}</h3>
                                    <p style={{ fontSize: '0.85rem', color: 'var(--cyan)', fontWeight: 600 }}>{step.time}</p>
                                </article>
                            ))}
                        </div>

                        {/* Délais */}
                        <div className="process-cta reveal" style={{ marginTop: 48 }}>
                            <div className="cta-inner" style={{ padding: '40px 32px' }}>
                                <h3 style={{ fontSize: '1.5rem', marginBottom: 24 }}>Délais variables selon le projet</h3>
                                <div style={{ display: 'grid', gridTemplateColumns: 'repeat(3, 1fr)', gap: 20, maxWidth: 700, margin: '0 auto' }}>
                                    {[
                                        { type: 'Projets Simples', desc: 'Site vitrine, landing page', time: '1-3 semaines' },
                                        { type: 'Projets Standards', desc: 'E-commerce, site corporate', time: '4-8 semaines' },
                                        { type: 'Projets Complexes', desc: 'SaaS, CRM, application', time: '8-16 semaines' },
                                    ].map(p => (
                                        <div key={p.type} style={{ background: 'rgba(255,255,255,0.1)', borderRadius: 16, padding: 20, border: '1px solid rgba(255,255,255,0.15)' }}>
                                            <h4 style={{ color: 'white', fontSize: '1rem', fontWeight: 700, marginBottom: 4 }}>{p.type}</h4>
                                            <p style={{ color: 'rgba(255,255,255,0.7)', fontSize: '0.85rem', marginBottom: 8 }}>{p.desc}</p>
                                            <p style={{ color: 'var(--gold)', fontSize: '0.95rem', fontWeight: 700 }}>{p.time}</p>
                                        </div>
                                    ))}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {/* ===== DÉTAIL DES ÉTAPES (TIMELINE) ===== */}
                <section className="process-section" style={{ background: 'var(--bg-soft)' }} aria-labelledby="detail-title">
                    <div className="container">
                        <div className="section-header">
                            <span className="section-tag reveal">En Détail</span>
                            <h2 id="detail-title" className="section-title reveal reveal-delay-1">Chaque Étape <span className="text-gradient">Expliquée</span></h2>
                            <p className="section-description reveal reveal-delay-2">Transparence totale sur notre façon de travailler.</p>
                        </div>

                        <div className="process-timeline">
                            <div className="timeline-line" aria-hidden="true"></div>
                            {[
                                { num: '01', title: 'Audit & Analyse Approfondie', desc: 'Entretiens, définition des personas, cartographie des fonctionnalités, audit SEO et étude concurrentielle.', tags: ['Cahier des charges', 'Audit technique', 'Stratégie digitale'] },
                                { num: '02', title: 'Conception & Design UX/UI', desc: 'Architecture du site, wireframes, prototypes interactifs, design haute fidélité et validation de la charte graphique.', tags: ['Maquettes validées', 'Prototype interactif', 'Design system'] },
                                { num: '03', title: 'Développement Technique', desc: 'Architecture Laravel sécurisée, APIs REST, intégration responsive mobile-first, accessibilité WCAG et optimisation SEO.', tags: ['Code documenté', 'Tests fonctionnels', 'Pré-production'] },
                                { num: '04', title: 'Tests & Optimisation', desc: 'Tests navigateurs, tests de performance, optimisation Core Web Vitals, audit SEO final et corrections.', tags: ['Tests complets', 'Performance optimale', 'SEO validé'] },
                                { num: '05', title: 'Déploiement & Suivi', desc: 'Mise en ligne sécurisée, formation à l\'utilisation du back-office, suivi post-lancement et maintenance.', tags: ['Site en ligne', 'Formation', 'Support continu'] },
                            ].map((step, i) => (
                                <div key={step.num} className={`process-step reveal ${i > 0 ? `reveal-delay-${Math.min(i, 3)}` : ''}`}>
                                    <div className="step-marker"><span className="step-number">{step.num}</span></div>
                                    <div className="step-content"><h3>{step.title}</h3><p>{step.desc}</p><div className="step-deliverables">{step.tags.map(t => <span key={t}>{t}</span>)}</div></div>
                                </div>
                            ))}
                        </div>
                    </div>
                </section>

                {/* ===== COMMUNICATION (BENTO) ===== */}
                <section className="services-section" aria-labelledby="comm-title">
                    <div className="container">
                        <div className="section-header">
                            <span className="section-tag reveal">Collaboration</span>
                            <h2 id="comm-title" className="section-title reveal reveal-delay-1">Communication & <span className="text-gradient">Outils</span></h2>
                            <p className="section-description reveal reveal-delay-2">Transparence et collaboration efficace tout au long de votre projet.</p>
                        </div>

                        <div className="bento-grid" style={{ gridTemplateColumns: 'repeat(3, 1fr)' }}>
                            {[
                                { title: 'Communication Régulière', desc: 'Points hebdomadaires programmés, Slack/Teams pour les échanges quotidiens, rapports d\'avancement et disponibilité garantie en journée.', glow: 'bento-glow-cyan' },
                                { title: 'Gestion de Projet', desc: 'Trello ou Notion pour le suivi en temps réel, planning détaillé et mis à jour, versionning Git professionnel et environnements de test dédiés.', glow: 'bento-glow-gold' },
                                { title: 'Mesure & Analytics', desc: 'Google Analytics 4 configuré, Search Console optimisée, monitoring des performances en continu et rapports mensuels automatisés.', glow: 'bento-glow-green' },
                            ].map((card, i) => (
                                <article key={card.title} className={`bento-card reveal ${i > 0 ? `reveal-delay-${i}` : ''}`}>
                                    <div className={`bento-glow ${card.glow}`}></div>
                                    <div className="bento-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5">
                                            {i === 0 && <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" />}
                                            {i === 1 && <><rect x="3" y="4" width="18" height="18" rx="2" /><path d="M16 2v4M8 2v4M3 10h18" /></>}
                                            {i === 2 && <><path d="M3 3v18h18" /><path d="m19 9-5 5-4-4-3 3" /></>}
                                        </svg>
                                    </div>
                                    <h3>{card.title}</h3>
                                    <p>{card.desc}</p>
                                </article>
                            ))}
                        </div>
                    </div>
                </section>

                {/* ===== CTA ===== */}
                <section className="cta-section" aria-labelledby="methode-cta-title">
                    <div className="cta-bg-mesh" aria-hidden="true"></div>
                    <div className="container">
                        <div className="cta-content reveal">
                            <h2 id="methode-cta-title">Prêt à <span className="text-gradient-light">démarrer votre projet</span> ?</h2>
                            <p>Chaque projet est unique. Discutons de vos besoins pour établir un planning adapté à vos objectifs.</p>
                            <div className="cta-actions">
                                <Link href="/contact" className="btn btn-primary btn-large"><span>Démarrer mon projet</span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M5 12h14M12 5l7 7-7 7" /></svg></Link>
                                <Link href="/portfolio" className="btn btn-glass btn-large"><span>Voir nos réalisations</span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" /><circle cx="12" cy="12" r="3" /></svg></Link>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </PublicLayout>
    );
}
