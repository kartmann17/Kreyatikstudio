import { useEffect } from 'react';
import { Link, Head } from '@inertiajs/react';
import PublicLayout from '@/Layouts/PublicLayout';

const Star = () => (
    <svg viewBox="0 0 20 20" fill="currentColor" style={{ width: 16, height: 16, color: '#D4A017' }}>
        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
    </svg>
);

const testimonials = [
    {
        name: 'Frédéric Lepelleux',
        role: 'Président',
        company: 'CEPR17 — Club Entreprises de Rochefort',
        site: 'cepr17.fr',
        initials: 'FL',
        color: '#1B3A5C',
        type: 'Site vitrine & Association',
        quote: "Lionel a su comprendre les enjeux d'un club d'entreprises local et livrer un site à la hauteur de notre image. Professionnel, réactif et de très bon conseil. Nos adhérents ont immédiatement remarqué la qualité du travail.",
        stars: 5,
    },
    {
        name: 'Amélie Davin',
        role: 'Experte Immobilier',
        company: 'Immobilier Rochefort',
        site: 'immobilier-rochefort.fr',
        initials: 'AD',
        color: '#0099CC',
        type: 'Site vitrine immobilier',
        quote: "Mon site me différencie vraiment de la concurrence locale. Kréyatik Studio a parfaitement capté l'identité que je souhaitais projeter. Depuis la mise en ligne, les contacts qualifiés ont augmenté de façon significative sur le secteur de Rochefort.",
        stars: 5,
    },
    {
        name: 'Alexandra Mazer',
        role: 'Diététicienne',
        company: 'Avec Alex',
        site: 'avecalex.fr',
        initials: 'AM',
        color: '#00A86B',
        type: 'Site vitrine + Webapp suivi diététique',
        quote: "Lionel a livré bien plus qu'un site vitrine : une véritable application de gestion avec un espace admin complet et un espace patient personnalisé. Mes patients suivent leur parcours en temps réel, je gère mes consultations depuis un seul outil. Un gain de temps considérable au quotidien.",
        stars: 5,
    },
    {
        name: 'Équipe Batikko',
        role: 'Fondateurs',
        company: 'Batikko',
        site: 'batikko.com',
        initials: 'BT',
        color: '#D4A017',
        type: 'SaaS — Gestion BTP',
        quote: "Développer un SaaS métier pour le BTP est un défi technique et UX considérable. Kréyatik Studio a relevé ce challenge avec brio : architecture robuste, interface intuitive pour nos utilisateurs terrain, et des délais tenus. Un vrai partenaire technique.",
        stars: 5,
    },
    {
        name: 'Équipe Clubixa',
        role: 'Direction',
        company: 'Clubixa',
        site: 'clubixa.fr',
        initials: 'CX',
        color: '#7C3AED',
        type: 'SaaS — Gestion salle de sport',
        quote: "Notre plateforme de gestion pour salles de sport devait être à la fois puissante et simple d'utilisation. Kréyatik Studio a livré exactement cela : un outil que nos clients adorent utiliser au quotidien. La qualité du code est exemplaire.",
        stars: 5,
    },
    {
        name: 'Damien Spriet',
        role: 'Fondateur',
        company: 'InSport Studios',
        site: 'insportstudios.fr',
        initials: 'DS',
        color: '#DC2626',
        type: 'Site internet & application',
        quote: "InSport Studios avait besoin d'une présence digitale forte et d'un outil de gestion performant. Lionel a su dépasser nos attentes sur les deux tableaux. Son expertise technique et son sens du design font vraiment la différence.",
        stars: 5,
    },
];

const clients = [
    { name: 'CEPR17', site: 'cepr17.fr' },
    { name: 'Immobilier Rochefort', site: 'immobilier-rochefort.fr' },
    { name: 'Avec Alex', site: 'avecalex.fr' },
    { name: 'Batikko', site: 'batikko.com' },
    { name: 'Clubixa', site: 'clubixa.fr' },
    { name: 'InSport Studios', site: 'insportstudios.fr' },
];

export default function TemoignagesClients({ seo }) {
    useEffect(() => {
        const els = document.querySelectorAll('.reveal');
        const obs = new IntersectionObserver(
            (entries) => {
                entries.forEach((e) => {
                    if (e.isIntersecting) { e.target.classList.add('revealed'); obs.unobserve(e.target); }
                });
            },
            { rootMargin: '0px 0px -60px 0px', threshold: 0.1 }
        );
        els.forEach((el) => obs.observe(el));
        return () => obs.disconnect();
    }, []);

    return (
        <PublicLayout seo={seo}>
            <Head>
                <title>{seo?.title || 'Témoignages Clients — Kréyatik Studio Rochefort'}</title>
                <meta name="description" content="Découvrez les témoignages de nos clients : CEPR17, Immobilier Rochefort, Avec Alex, Batikko, Clubixa, InSport Studios. Ce qu'ils disent de Kréyatik Studio." />
            </Head>

            <main className="main-page">
                <div className="grain-overlay" aria-hidden="true"></div>

                {/* ===== HERO ===== */}
                <section className="hero-section" aria-labelledby="temoignages-title">
                    <div className="hero-background">
                        <div style={{ position: 'absolute', inset: 0, background: 'linear-gradient(135deg, #0F2640 0%, #1B3A5C 50%, #0F2640 100%)' }}></div>
                        <div className="hero-mesh" aria-hidden="true"></div>
                    </div>
                    <div className="hero-container">
                        <div className="hero-content" style={{ maxWidth: 720, textAlign: 'center', margin: '0 auto' }}>
                            <div className="hero-badge reveal" style={{ justifyContent: 'center' }}>
                                <span className="badge-dot"></span>
                                <span className="badge-text">+10 clients satisfaits · 100% recommandent</span>
                            </div>
                            <h1 id="temoignages-title" className="hero-title" style={{ textAlign: 'center' }}>
                                <span className="title-line reveal reveal-delay-1">Ce que disent</span>
                                <span className="title-highlight reveal reveal-delay-2">nos clients</span>
                            </h1>
                            <p className="hero-description reveal reveal-delay-3" style={{ textAlign: 'center', margin: '0 auto 2.5rem' }}>
                                Des entrepreneurs, associations et startups de Rochefort et d'ailleurs
                                qui ont choisi Kréyatik Studio pour leur transformation digitale.
                            </p>

                            {/* Stats */}
                            <div className="hero-metrics reveal reveal-delay-4" style={{ maxWidth: 600, margin: '0 auto' }}>
                                <div className="metric-card">
                                    <span className="metric-number">100%</span>
                                    <span className="metric-label">Clients satisfaits</span>
                                </div>
                                <div className="metric-card">
                                    <span className="metric-number">5★</span>
                                    <span className="metric-label">Note moyenne</span>
                                </div>
                                <div className="metric-card">
                                    <span className="metric-number">+10</span>
                                    <span className="metric-label">Projets livrés</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {/* ===== BANDE CLIENTS ===== */}
                <section style={{ background: '#07111F', padding: '3rem 0', borderBottom: '1px solid rgba(255,255,255,0.05)' }}>
                    <div style={{ maxWidth: 1280, margin: '0 auto', padding: '0 32px' }}>
                        <p style={{ fontFamily: "'Outfit', sans-serif", fontSize: '0.72rem', letterSpacing: '0.2em', textTransform: 'uppercase', color: '#0099CC', textAlign: 'center', marginBottom: '2rem' }}>
                            Ils nous font confiance
                        </p>
                        <div style={{ display: 'flex', flexWrap: 'wrap', justifyContent: 'center', gap: '0.75rem 2.5rem', alignItems: 'center' }}>
                            {clients.map((c) => (
                                <a
                                    key={c.site}
                                    href={`https://${c.site}`}
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    style={{
                                        fontFamily: "'Syne', sans-serif",
                                        fontSize: '0.95rem',
                                        fontWeight: 700,
                                        color: 'rgba(255,255,255,0.35)',
                                        textDecoration: 'none',
                                        letterSpacing: '0.04em',
                                        transition: 'color 0.25s ease',
                                    }}
                                    onMouseEnter={e => e.currentTarget.style.color = 'rgba(255,255,255,0.85)'}
                                    onMouseLeave={e => e.currentTarget.style.color = 'rgba(255,255,255,0.35)'}
                                >
                                    {c.name}
                                </a>
                            ))}
                        </div>
                    </div>
                </section>

                {/* ===== TÉMOIGNAGES GRILLE ===== */}
                <section className="services-section" style={{ background: 'var(--bg-soft)' }} aria-labelledby="avis-title">
                    <div className="container">
                        <div className="section-header">
                            <span className="section-tag reveal">Avis</span>
                            <h2 id="avis-title" className="section-title reveal reveal-delay-1">
                                Paroles de <span className="text-gradient">clients</span>
                            </h2>
                            <p className="section-description reveal reveal-delay-2">
                                Chaque projet est une collaboration. Voici comment nos clients ont vécu l'expérience Kréyatik Studio.
                            </p>
                        </div>

                        <div style={{
                            display: 'grid',
                            gridTemplateColumns: 'repeat(auto-fill, minmax(340px, 1fr))',
                            gap: '1.5rem',
                        }}>
                            {testimonials.map((t, i) => (
                                <article
                                    key={t.name}
                                    className={`reveal ${i > 0 ? `reveal-delay-${Math.min(i, 4)}` : ''}`}
                                    style={{
                                        background: 'white',
                                        borderRadius: 20,
                                        padding: '2rem',
                                        border: '1px solid var(--border)',
                                        boxShadow: 'var(--shadow-sm)',
                                        display: 'flex',
                                        flexDirection: 'column',
                                        gap: '1.5rem',
                                        transition: 'box-shadow 0.3s ease, transform 0.3s ease',
                                        cursor: 'default',
                                    }}
                                    onMouseEnter={e => { e.currentTarget.style.boxShadow = 'var(--shadow-md)'; e.currentTarget.style.transform = 'translateY(-4px)'; }}
                                    onMouseLeave={e => { e.currentTarget.style.boxShadow = 'var(--shadow-sm)'; e.currentTarget.style.transform = 'translateY(0)'; }}
                                >
                                    {/* Type de projet */}
                                    <span style={{
                                        display: 'inline-block',
                                        alignSelf: 'flex-start',
                                        fontFamily: "'Outfit', sans-serif",
                                        fontSize: '0.7rem',
                                        fontWeight: 600,
                                        letterSpacing: '0.12em',
                                        textTransform: 'uppercase',
                                        color: t.color,
                                        background: `${t.color}14`,
                                        padding: '0.3rem 0.75rem',
                                        borderRadius: 100,
                                    }}>
                                        {t.type}
                                    </span>

                                    {/* Étoiles */}
                                    <div style={{ display: 'flex', gap: 3 }}>
                                        {Array.from({ length: t.stars }).map((_, si) => <Star key={si} />)}
                                    </div>

                                    {/* Citation */}
                                    <blockquote style={{ margin: 0, flex: 1 }}>
                                        <span style={{
                                            fontFamily: "'Syne', sans-serif",
                                            fontSize: '3rem',
                                            lineHeight: 0.8,
                                            color: t.color,
                                            opacity: 0.2,
                                            display: 'block',
                                            marginBottom: '-0.5rem',
                                        }}>"</span>
                                        <p style={{
                                            fontFamily: "'Outfit', sans-serif",
                                            fontSize: '0.95rem',
                                            lineHeight: 1.7,
                                            color: 'var(--text-body)',
                                            margin: 0,
                                        }}>
                                            {t.quote}
                                        </p>
                                    </blockquote>

                                    {/* Auteur */}
                                    <div style={{ display: 'flex', alignItems: 'center', gap: '1rem', paddingTop: '1rem', borderTop: '1px solid var(--border)' }}>
                                        {/* Avatar initiales */}
                                        <div style={{
                                            width: 46,
                                            height: 46,
                                            borderRadius: '50%',
                                            background: t.color,
                                            display: 'flex',
                                            alignItems: 'center',
                                            justifyContent: 'center',
                                            fontFamily: "'Syne', sans-serif",
                                            fontWeight: 700,
                                            fontSize: '0.85rem',
                                            color: 'white',
                                            flexShrink: 0,
                                        }}>
                                            {t.initials}
                                        </div>
                                        <div style={{ flex: 1, minWidth: 0 }}>
                                            <p style={{ fontFamily: "'Syne', sans-serif", fontWeight: 700, fontSize: '0.9rem', color: 'var(--text)', margin: 0, lineHeight: 1.3 }}>
                                                {t.name}
                                            </p>
                                            <p style={{ fontFamily: "'Outfit', sans-serif", fontSize: '0.78rem', color: 'var(--text-muted)', margin: 0, lineHeight: 1.4 }}>
                                                {t.role} · {t.company}
                                            </p>
                                        </div>
                                        <a
                                            href={`https://${t.site}`}
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            style={{
                                                fontFamily: "'Outfit', sans-serif",
                                                fontSize: '0.72rem',
                                                color: t.color,
                                                textDecoration: 'none',
                                                opacity: 0.7,
                                                flexShrink: 0,
                                                transition: 'opacity 0.2s ease',
                                            }}
                                            onMouseEnter={e => e.currentTarget.style.opacity = '1'}
                                            onMouseLeave={e => e.currentTarget.style.opacity = '0.7'}
                                        >
                                            {t.site} ↗
                                        </a>
                                    </div>
                                </article>
                            ))}
                        </div>

                        {/* Et bien plus encore */}
                        <div className="reveal" style={{ textAlign: 'center', marginTop: '3rem', padding: '2rem', borderTop: '1px solid var(--border)' }}>
                            <p style={{
                                fontFamily: "'Syne', sans-serif",
                                fontSize: 'clamp(1.2rem, 3vw, 1.8rem)',
                                fontWeight: 700,
                                color: 'var(--text-muted)',
                                letterSpacing: '-0.01em',
                            }}>
                                et bien d'autres projets encore<span style={{ color: '#0099CC' }}>.</span>
                            </p>
                            <p style={{ fontFamily: "'Outfit', sans-serif", fontSize: '0.95rem', color: 'var(--text-muted)', marginTop: '0.5rem' }}>
                                Chaque collaboration est unique — <Link href="/contact" style={{ color: '#0099CC', textDecoration: 'none', fontWeight: 600 }}>parlons du vôtre</Link>.
                            </p>
                        </div>
                    </div>
                </section>

                {/* ===== CTA ===== */}
                <section className="cta-section" aria-labelledby="temoignages-cta-title">
                    <div className="cta-bg-mesh" aria-hidden="true"></div>
                    <div className="container">
                        <div className="cta-content reveal">
                            <h2 id="temoignages-cta-title">
                                Votre projet sera <span className="text-gradient-light">le prochain</span>
                            </h2>
                            <p>Rejoignez des clients satisfaits à Rochefort et partout en France. Discutons de votre projet.</p>
                            <div className="cta-actions">
                                <Link href="/contact" className="btn btn-primary btn-large">
                                    <span>Démarrer un projet</span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M5 12h14M12 5l7 7-7 7" /></svg>
                                </Link>
                                <Link href="/portfolio" className="btn btn-glass btn-large">
                                    <span>Voir le portfolio</span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" /><circle cx="12" cy="12" r="3" /></svg>
                                </Link>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </PublicLayout>
    );
}
