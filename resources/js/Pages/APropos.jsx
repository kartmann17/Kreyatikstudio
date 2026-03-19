import { Link, Head } from '@inertiajs/react';
import { useEffect } from 'react';
import PublicLayout from '@/Layouts/PublicLayout';

export default function APropos({ seo }) {
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
            <Head>
                <script type="application/ld+json">{JSON.stringify({
                    "@context": "https://schema.org", "@type": "Person", "name": "Lionel Blanchet",
                    "jobTitle": "Développeur Web Freelance",
                    "description": "Développeur web freelance spécialisé en Laravel, SaaS, CRM et e-commerce à Rochefort.",
                    "url": "https://kreyatikstudio.fr/a-propos", "image": "/images/Studiosansfond.png",
                    "email": "contact@kreyatikstudio.fr",
                    "worksFor": { "@type": "Organization", "name": "Kréyatik Studio", "url": "https://kreyatikstudio.fr",
                        "address": { "@type": "PostalAddress", "addressLocality": "Rochefort", "postalCode": "17300", "addressRegion": "Charente-Maritime", "addressCountry": "FR" }
                    },
                    "knowsAbout": ["Laravel","PHP","Python","JavaScript","React","Flutter","TailwindCSS","E-commerce","SaaS","CRM","SEO"],
                    "sameAs": ["https://www.facebook.com/share/1AtjVczpEJ/","https://www.instagram.com/kreyatik_17/"]
                })}</script>
            </Head>

            <main className="main-page">
                <div className="grain-overlay" aria-hidden="true"></div>

                {/* ===== HERO ===== */}
                <section className="hero-section" aria-labelledby="about-title" >
                    <div className="hero-background">
                        <div style={{ position: 'absolute', inset: 0, background: 'linear-gradient(135deg, #0F2640 0%, #1B3A5C 50%, #0F2640 100%)' }}></div>
                        <div className="hero-mesh" aria-hidden="true"></div>
                    </div>
                    <div className="hero-container">
                        <div className="hero-content" style={{ maxWidth: 680 }}>
                            <div className="hero-badge reveal">
                                <span className="badge-dot"></span>
                                <span className="badge-text">À propos de Kréyatik Studio</span>
                            </div>
                            <h1 id="about-title" className="hero-title">
                                <span className="title-line reveal reveal-delay-1">De l'aéronautique au</span>
                                <span className="title-highlight reveal reveal-delay-2">développement web</span>
                            </h1>
                            <p className="hero-description reveal reveal-delay-3">
                                Passionné par le web depuis plusieurs années, j'ai quitté l'industrie aéronautique
                                pour en faire mon métier. La rigueur acquise dans l'aviation nourrit chacun de mes projets.
                                Basé à Rochefort, j'accompagne les entreprises de Charente-Maritime — La Rochelle,
                                Saintes, Royan et au-delà — dans leur transformation digitale.
                            </p>
                            <div className="hero-actions reveal reveal-delay-4">
                                <a href="#expertise" className="btn btn-primary">
                                    <span>Découvrir mon parcours</span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M5 12h14M12 5l7 7-7 7" /></svg>
                                </a>
                                <Link href="/contact" className="btn btn-glass" style={{ background: 'rgba(255,255,255,0.12)', color: 'white', borderColor: 'rgba(255,255,255,0.25)' }}>
                                    <span>Me contacter</span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" /></svg>
                                </Link>
                            </div>
                        </div>
                    </div>
                </section>

                {/* ===== EXPERTISE (BENTO) ===== */}
                <section className="services-section" id="expertise" aria-labelledby="expertise-title">
                    <div className="container">
                        <div className="section-header">
                            <span className="section-tag reveal">Expertise</span>
                            <h2 id="expertise-title" className="section-title reveal reveal-delay-1">Compétences <span className="text-gradient">Techniques</span></h2>
                            <p className="section-description reveal reveal-delay-2">
                                Des savoir-faire forgés par l'exigence industrielle et enrichis par la curiosité technologique.
                            </p>
                        </div>
                        <div className="bento-grid">
                            <article className="bento-card bento-large reveal">
                                <div className="bento-glow bento-glow-cyan"></div>
                                <div className="bento-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" /></svg></div>
                                <h3>Développement Backend</h3>
                                <p>Applications web robustes avec Laravel et PHP : plateformes SaaS, CRM sur-mesure et boutiques e-commerce. Python complète ma palette pour l'automatisation.</p>
                                <div className="bento-tags"><span>Laravel</span><span>PHP</span><span>Python</span><span>APIs REST</span><span>SaaS</span></div>
                            </article>
                            <article className="bento-card reveal reveal-delay-1">
                                <div className="bento-glow bento-glow-gold"></div>
                                <div className="bento-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5"><path d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z" /></svg></div>
                                <h3>Frontend Moderne</h3>
                                <p>Interfaces réactives avec React et TailwindCSS. Des expériences utilisateur fluides du prototype à la production.</p>
                                <div className="bento-tags"><span>React</span><span>TailwindCSS</span><span>Alpine.js</span><span>Vite</span></div>
                            </article>
                            <article className="bento-card reveal reveal-delay-2">
                                <div className="bento-glow bento-glow-green"></div>
                                <div className="bento-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5"><path d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg></div>
                                <h3>Mobile & SEO</h3>
                                <p>Applications mobiles avec Flutter et stratégies de référencement pour une visibilité durable.</p>
                                <div className="bento-tags"><span>Flutter</span><span>SEO</span><span>Core Web Vitals</span><span>Analytics</span></div>
                            </article>
                        </div>
                    </div>
                </section>

                {/* ===== PARCOURS (TIMELINE) ===== */}
                <section className="process-section" style={{ background: 'var(--bg-soft)' }} aria-labelledby="timeline-title">
                    <div className="container">
                        <div className="section-header">
                            <span className="section-tag reveal">Parcours</span>
                            <h2 id="timeline-title" className="section-title reveal reveal-delay-1">Une Reconversion <span className="text-gradient">Passionnée</span></h2>
                            <p className="section-description reveal reveal-delay-2">De l'industrie aéronautique au développement web, une transformation guidée par la passion.</p>
                        </div>
                        <div className="process-timeline">
                            <div className="timeline-line" aria-hidden="true"></div>
                            {[
                                { num: '01', title: 'Expérience Aéronautique', desc: 'Plusieurs années dans l\'industrie aéronautique, un environnement où la rigueur et la précision ne sont pas négociables.', tags: ['Rigueur', 'Méthode', 'Précision'] },
                                { num: '02', title: 'La Passion Devient Métier', desc: 'Fasciné par le web, la décision de changer de voie s\'est imposée. Formation intensive : HTML, CSS, JavaScript, PHP. Découverte de Laravel.', tags: ['Formation', 'Laravel', 'PHP'] },
                                { num: '03', title: 'Premiers Projets', desc: 'Sites vitrines, boutiques e-commerce, applications SaaS et CRM sur-mesure. Chaque projet confirme le choix de cette reconversion.', tags: ['E-commerce', 'SaaS', 'CRM'] },
                                { num: '04', title: 'Kréyatik Studio', desc: 'Création du studio à Rochefort pour accompagner les entreprises locales et nationales. Python, React et Flutter au service de vos projets.', tags: ['Python', 'React', 'Flutter'] },
                            ].map((step, i) => (
                                <div key={step.num} className={`process-step reveal ${i > 0 ? `reveal-delay-${i}` : ''}`}>
                                    <div className="step-marker"><span className="step-number">{step.num}</span></div>
                                    <div className="step-content"><h3>{step.title}</h3><p>{step.desc}</p><div className="step-deliverables">{step.tags.map(t => <span key={t}>{t}</span>)}</div></div>
                                </div>
                            ))}
                        </div>
                    </div>
                </section>

                {/* ===== VALEURS ===== */}
                <section className="why-section" aria-labelledby="values-title">
                    <div className="container">
                        <div className="section-header">
                            <span className="section-tag reveal">Valeurs</span>
                            <h2 id="values-title" className="section-title reveal reveal-delay-1">Ce Qui Me <span className="text-gradient">Guide</span></h2>
                            <p className="section-description reveal reveal-delay-2">Les principes au cœur de chaque collaboration.</p>
                        </div>
                        <div className="why-grid" style={{ gridTemplateColumns: 'repeat(2, 1fr)' }}>
                            {[
                                { num: '01', title: 'Rigueur & Précision', desc: 'L\'exigence aéronautique transposée au code. Chaque projet est abordé avec méthode.', tags: ['Qualité', 'Standards', 'Fiabilité'], icon: 'M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z' },
                                { num: '02', title: 'Adaptabilité', desc: 'Changer de carrière demande de se réinventer. Cette capacité se retrouve dans chaque défi technique.', tags: ['Flexibilité', 'Évolution'], icon: 'M22 11.08V12a10 10 0 1 1-5.93-9.14' },
                                { num: '03', title: 'Curiosité Technologique', desc: 'Python, React, Flutter : la technologie évolue vite et j\'évolue avec elle.', tags: ['Innovation', 'Veille'], icon: 'M13 10V3L4 14h7v7l9-11h-7z' },
                                { num: '04', title: 'Passion & Engagement', desc: 'Ce métier est un choix délibéré. Chaque projet bénéficie de l\'enthousiasme de quelqu\'un qui fait ce qu\'il aime.', tags: ['Motivation', 'Énergie'], icon: 'M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z' },
                            ].map((card, i) => (
                                <article key={card.num} className={`why-card reveal ${i > 0 ? `reveal-delay-${i}` : ''}`}>
                                    <div className="why-card-number">{card.num}</div>
                                    <div className="why-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5"><path d={card.icon} /></svg></div>
                                    <h3>{card.title}</h3><p>{card.desc}</p>
                                    <div className="why-tags">{card.tags.map(t => <span key={t}>{t}</span>)}</div>
                                </article>
                            ))}
                        </div>
                    </div>
                </section>

                {/* ===== TERRITOIRE ===== */}
<section style={{ background: '#07111F', padding: '5rem 0 4rem', overflow: 'hidden' }} aria-label="Lionel Blanchet développeur web — zone d'intervention">
    <div style={{ maxWidth: 1280, margin: '0 auto', padding: '0 32px' }}>
        <p className="reveal" style={{ fontFamily: "'Outfit', sans-serif", fontSize: '0.78rem', fontWeight: 500, letterSpacing: '0.22em', textTransform: 'uppercase', color: '#0099CC', marginBottom: '2.5rem', textAlign: 'center' }}>
            Je travaille avec vous
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
                    cursor: 'default',
                }}>{city.name}</span>
            ))}
        </div>
        <p className="reveal reveal-delay-2" style={{ fontFamily: "'Outfit', sans-serif", fontSize: '0.85rem', color: 'rgba(255,255,255,0.2)', textAlign: 'center', marginTop: '2rem', letterSpacing: '0.1em' }}>
            et partout en France en remote
        </p>
    </div>
</section>

                {/* ===== CTA ===== */}
                <section className="cta-section" aria-labelledby="about-cta-title">
                    <div className="cta-bg-mesh" aria-hidden="true"></div>
                    <div className="container">
                        <div className="cta-content reveal">
                            <h2 id="about-cta-title">Transformons votre vision en <span className="text-gradient-light">réalité digitale</span></h2>
                            <p>Mon parcours atypique allie rigueur industrielle et passion du web. Discutons de votre projet.</p>
                            <div className="cta-actions">
                                <Link href="/contact" className="btn btn-primary btn-large"><span>Discuter de mon projet</span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M5 12h14M12 5l7 7-7 7" /></svg></Link>
                                <Link href="/portfolio" className="btn btn-glass btn-large"><span>Voir mes réalisations</span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" /><circle cx="12" cy="12" r="3" /></svg></Link>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </PublicLayout>
    );
}
