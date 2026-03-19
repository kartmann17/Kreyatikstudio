import { Link, Head } from '@inertiajs/react';
import PublicLayout from '@/Layouts/PublicLayout';
import { useState, useEffect } from 'react';

const Star = () => (
    <svg viewBox="0 0 20 20" fill="currentColor" style={{ width: 20, height: 20 }}>
        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
    </svg>
);

export default function Portfolio({ portfolioItems, seo }) {
    const [selectedCategory, setSelectedCategory] = useState('all');
    const categories = ['all', 'E-commerce', 'Vitrine', 'Application', 'Landing Page'];
    const filteredItems = selectedCategory === 'all' ? portfolioItems : portfolioItems?.filter(item => item.technology?.includes(selectedCategory));

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
                <title>{seo?.title || 'Portfolio - Nos Réalisations Web | Kréyatik Studio'}</title>
                <meta name="description" content={seo?.description || "Découvrez les réalisations de Kréyatik Studio : sites e-commerce, applications Laravel, sites vitrine et landing pages."} />
            </Head>

            <main className="main-page">
                <div className="grain-overlay" aria-hidden="true"></div>

                {/* ===== HERO ===== */}
                <section className="hero-section"  aria-labelledby="portfolio-title">
                    <div className="hero-background">
                        <div style={{ position: 'absolute', inset: 0, background: 'linear-gradient(135deg, #0F2640 0%, #1B3A5C 50%, #0F2640 100%)' }}></div>
                        <div className="hero-mesh" aria-hidden="true"></div>
                    </div>
                    <div className="hero-container">
                        <div className="hero-content" style={{ maxWidth: 700, textAlign: 'center', margin: '0 auto' }}>
                            <div className="hero-badge reveal" style={{ justifyContent: 'center' }}>
                                <span className="badge-dot"></span>
                                <span className="badge-text">+{portfolioItems?.length || 0} projets — Charente-Maritime & France</span>
                            </div>
                            <h1 id="portfolio-title" className="hero-title" style={{ textAlign: 'center' }}>
                                <span className="title-line reveal reveal-delay-1">Des Sites Web Qui</span>
                                <span className="title-highlight reveal reveal-delay-2">Génèrent des Résultats</span>
                            </h1>
                            <p className="hero-description reveal reveal-delay-3" style={{ textAlign: 'center', margin: '0 auto 2.5rem' }}>
                                Des réalisations pour des entreprises de Rochefort, La Rochelle, Saintes et au-delà.
                                Chaque projet a un seul objectif : transformer vos visiteurs en clients.
                            </p>
                        </div>

                        <div className="hero-metrics reveal reveal-delay-4" style={{ maxWidth: 800, margin: '0 auto' }}>
                            <div className="metric-card"><span className="metric-number">100%</span><span className="metric-label">Clients satisfaits</span></div>
                            <div className="metric-card"><span className="metric-number">+200%</span><span className="metric-label">ROI moyen</span></div>
                            <div className="metric-card"><span className="metric-number">48h</span><span className="metric-label">Premier rendu</span></div>
                            <div className="metric-card"><span className="metric-number">24/7</span><span className="metric-label">Support dédié</span></div>
                        </div>
                    </div>
                </section>

                {/* ===== TÉMOIGNAGES ===== */}
                <section className="testimonials-section" aria-labelledby="temoignages-title">
                    <div className="container">
                        <div className="section-header">
                            <span className="section-tag reveal">Témoignages</span>
                            <h2 id="temoignages-title" className="section-title reveal reveal-delay-1">Ils Nous Font <span className="text-gradient">Confiance</span></h2>
                        </div>
                        <div className="testimonials-grid" style={{ gridTemplateColumns: 'repeat(3, 1fr)' }}>
                            {[
                                { initials: 'PM', name: 'Pierre M.', role: 'E-commerce', text: '"Mon CA a triplé en 6 mois grâce à mon nouveau site. Meilleur investissement de l\'année !"' },
                                { initials: 'SL', name: 'Sophie L.', role: 'Artisan', text: '"Ultra réactif, professionnel et créatif. Mon site convertit 3x mieux qu\'avant !"' },
                                { initials: 'MD', name: 'Marc D.', role: 'Consultant', text: '"Des vrais experts qui comprennent le business. Résultats au-delà de mes attentes !"' },
                            ].map((t, i) => (
                                <article key={t.initials} className={`testimonial-card reveal ${i > 0 ? `reveal-delay-${i}` : ''}`}>
                                    <div className="testimonial-stars" style={{ color: 'var(--gold)' }}>{[...Array(5)].map((_, j) => <Star key={j} />)}</div>
                                    <blockquote className="testimonial-text">{t.text}</blockquote>
                                    <div className="testimonial-author">
                                        <div className="author-avatar">{t.initials}</div>
                                        <div className="author-info"><h4>{t.name}</h4><span>{t.role}</span></div>
                                    </div>
                                </article>
                            ))}
                        </div>
                    </div>
                </section>

                {/* ===== PORTFOLIO GRID ===== */}
                <section className="services-section" aria-labelledby="realisations-title">
                    <div className="container">
                        <div className="section-header">
                            <span className="section-tag reveal">Réalisations</span>
                            <h2 id="realisations-title" className="section-title reveal reveal-delay-1">Nos Projets Qui <span className="text-gradient">Performent</span></h2>
                            <p className="section-description reveal reveal-delay-2">Chaque projet est pensé pour générer du trafic qualifié et convertir.</p>
                        </div>

                        {/* Filtres */}
                        <div className="reveal" style={{ display: 'flex', flexWrap: 'wrap', justifyContent: 'center', gap: 10, marginBottom: 48 }}>
                            {categories.map(cat => (
                                <button
                                    key={cat}
                                    onClick={() => setSelectedCategory(cat)}
                                    className={selectedCategory === cat ? 'btn btn-primary' : 'btn btn-glass'}
                                    style={{ padding: '10px 24px', fontSize: '0.9rem' }}
                                >
                                    {cat === 'all' ? 'Tous les projets' : cat}
                                </button>
                            ))}
                        </div>

                        {/* Grid */}
                        {portfolioItems && portfolioItems.length > 0 ? (
                            <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fill, minmax(340px, 1fr))', gap: 24 }}>
                                {(filteredItems || portfolioItems).map((item, index) => (
                                    <article
                                        key={item.id}
                                        className={`bento-card reveal ${index > 0 && index <= 3 ? `reveal-delay-${index}` : ''}`}
                                        style={{ padding: 0, cursor: item.url ? 'pointer' : 'default', overflow: 'hidden' }}
                                        onClick={() => item.url && window.open(item.url, '_blank')}
                                    >
                                        <div style={{ height: 220, overflow: 'hidden', background: 'var(--bg-soft)' }}>
                                            <img
                                                src={`/storage/${item.path}`}
                                                alt={item.title}
                                                style={{ width: '100%', height: '100%', objectFit: 'cover', transition: 'transform 0.6s cubic-bezier(0.16,1,0.3,1)' }}
                                                loading={index < 6 ? 'eager' : 'lazy'}
                                                onMouseOver={e => e.currentTarget.style.transform = 'scale(1.06)'}
                                                onMouseOut={e => e.currentTarget.style.transform = 'scale(1)'}
                                            />
                                        </div>
                                        <div style={{ padding: 24 }}>
                                            <h3 style={{ marginBottom: 8 }}>{item.title}</h3>
                                            <p style={{ marginBottom: 16, fontSize: '0.9rem' }}>{item.description}</p>
                                            {item.technology && (
                                                <div className="bento-tags">
                                                    {item.technology.split(',').slice(0, 4).map((tech, i) => (
                                                        <span key={i}>{tech.trim()}</span>
                                                    ))}
                                                </div>
                                            )}
                                        </div>
                                    </article>
                                ))}
                            </div>
                        ) : (
                            <div style={{ textAlign: 'center', padding: '60px 0' }}>
                                <h3>Nouveaux projets en cours</h3>
                                <p>Nous préparons des réalisations exceptionnelles.</p>
                            </div>
                        )}
                    </div>
                </section>

                {/* ===== CTA ===== */}
                <section className="cta-section" aria-labelledby="portfolio-cta-title">
                    <div className="cta-bg-mesh" aria-hidden="true"></div>
                    <div className="container">
                        <div className="cta-content reveal">
                            <h2 id="portfolio-cta-title">Votre projet mérite la <span className="text-gradient-light">même attention</span></h2>
                            <p>Discutons de vos objectifs et créons ensemble un site qui génère des résultats concrets.</p>
                            <div className="cta-actions">
                                <Link href="/contact" className="btn btn-primary btn-large"><span>Demander un devis gratuit</span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M5 12h14M12 5l7 7-7 7" /></svg></Link>
                                <Link href="/methode-travail" className="btn btn-glass btn-large"><span>Notre méthode</span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2" /></svg></Link>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </PublicLayout>
    );
}
