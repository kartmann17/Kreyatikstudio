import { useState, useEffect, useRef } from 'react';
import { Link, usePage, Head } from '@inertiajs/react';

export default function PublicLayout({ children, seo }) {
    const { flash } = usePage().props;
    const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
    const [scrolled, setScrolled] = useState(false);
    const [loading, setLoading] = useState(true);
    const canvasRef = useRef(null);

    // Preloader — only on first visit (session)
    useEffect(() => {
        if (sessionStorage.getItem('kr-loaded')) {
            setLoading(false);
            return;
        }
        const timer = setTimeout(() => {
            setLoading(false);
            sessionStorage.setItem('kr-loaded', '1');
        }, 2800);
        return () => clearTimeout(timer);
    }, []);

    // Handle scroll effect
    useEffect(() => {
        const handleScroll = () => {
            setScrolled(window.scrollY > 50);
        };
        window.addEventListener('scroll', handleScroll);
        return () => window.removeEventListener('scroll', handleScroll);
    }, []);

    // Canvas particle preloader animation
    useEffect(() => {
        const canvas = canvasRef.current;
        if (!canvas || !loading) return;

        const ctx = canvas.getContext('2d');
        let rafId = null;

        const W = canvas.width = window.innerWidth;
        const H = canvas.height = window.innerHeight;

        // Use the transparent-background logo so pixel sampling works correctly
        const img = new Image();
        img.src = '/images/Studiosansfond.png';

        img.onload = () => {
            // Scale logo to a good sampling size (large enough for detail)
            const maxLogoW = Math.min(320, W * 0.55);
            const maxLogoH = Math.min(220, H * 0.4);
            const scale = Math.min(maxLogoW / img.naturalWidth, maxLogoH / img.naturalHeight);
            const logoW = Math.round(img.naturalWidth * scale);
            const logoH = Math.round(img.naturalHeight * scale);

            // Draw logo on offscreen canvas to read pixel data
            const offscreen = document.createElement('canvas');
            offscreen.width = logoW;
            offscreen.height = logoH;
            const offCtx = offscreen.getContext('2d');
            offCtx.drawImage(img, 0, 0, logoW, logoH);
            const { data } = offCtx.getImageData(0, 0, logoW, logoH);

            // Center logo on screen (slightly above center)
            const offsetX = Math.round((W - logoW) / 2);
            const offsetY = Math.round((H - logoH) / 2) - 40;

            // Sample every Nth pixel where alpha is significant → these are the target positions
            const targets = [];
            const step = 2; // denser sampling = more particles = better logo shape

            for (let y = 0; y < logoH; y += step) {
                for (let x = 0; x < logoW; x += step) {
                    const i = (y * logoW + x) * 4;
                    const alpha = data[i + 3];
                    if (alpha > 60) {
                        targets.push({ x: x + offsetX, y: y + offsetY, alpha });
                    }
                }
            }

            if (targets.length === 0) return;

            // Cap to a performant count, randomise which targets are used
            const MAX = Math.min(targets.length, 1200);
            const chosen = [...targets].sort(() => Math.random() - 0.5).slice(0, MAX);

            // Particle palette — cyan / white / light-blue so they're always visible on dark bg
            const palette = ['#0099CC', '#00d4ff', '#ffffff', '#22b8e8', '#80e8ff'];

            const particles = chosen.map((t) => {
                // Start scattered around the center in a wide burst
                const angle = Math.random() * Math.PI * 2;
                const dist = 300 + Math.random() * Math.max(W, H) * 0.6;
                return {
                    x: W / 2 + Math.cos(angle) * dist,
                    y: H / 2 + Math.sin(angle) * dist,
                    tx: t.x,
                    ty: t.y,
                    color: palette[Math.floor(Math.random() * palette.length)],
                    alpha: (t.alpha / 255) * 0.9 + 0.1,
                    size: Math.random() * 2 + 0.8,
                    easing: 0.06 + Math.random() * 0.06, // faster convergence
                    vx: 0,
                    vy: 0,
                    exploding: false,
                };
            });

            const start = performance.now();

            const tick = (now) => {
                const t = (now - start) / 1000;

                // Slightly fade previous frame for a comet-trail feel during convergence
                ctx.fillStyle = t < 1.8 ? 'rgba(10,22,40,0.35)' : 'rgba(10,22,40,0.6)';
                ctx.fillRect(0, 0, W, H);

                // Subtle glow for the whole canvas during hold phase
                if (t >= 1.8 && t < 2.3) {
                    ctx.shadowBlur = 12;
                    ctx.shadowColor = '#0099CC';
                } else {
                    ctx.shadowBlur = 0;
                }

                for (const p of particles) {
                    if (t < 1.8) {
                        // Converge toward logo
                        p.x += (p.tx - p.x) * p.easing;
                        p.y += (p.ty - p.y) * p.easing;
                    } else if (t < 2.3) {
                        // Formed — micro-oscillation to look alive
                        p.x = p.tx + Math.sin(now * 0.002 + p.ty) * 0.6;
                        p.y = p.ty + Math.cos(now * 0.0018 + p.tx) * 0.6;
                    } else {
                        // Explode outward (direction = away from center)
                        if (!p.exploding) {
                            p.exploding = true;
                            const angle = Math.atan2(p.ty - H / 2, p.tx - W / 2) + (Math.random() - 0.5) * 2;
                            const speed = 5 + Math.random() * 14;
                            p.vx = Math.cos(angle) * speed;
                            p.vy = Math.sin(angle) * speed - 3;
                        }
                        p.x += p.vx;
                        p.y += p.vy;
                        p.vy += 0.2;
                        p.vx *= 0.97;
                    }

                    ctx.globalAlpha = p.alpha;
                    ctx.beginPath();
                    ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
                    ctx.fillStyle = p.color;
                    ctx.fill();
                }

                ctx.globalAlpha = 1;
                ctx.shadowBlur = 0;

                if (t < 2.8) {
                    rafId = requestAnimationFrame(tick);
                }
            };

            rafId = requestAnimationFrame(tick);
        };

        return () => {
            if (rafId) cancelAnimationFrame(rafId);
        };
    }, [loading]);

    // Custom cursor (desktop only)
    useEffect(() => {
        if (window.matchMedia('(pointer: coarse)').matches) return; // skip touch devices
        const cursor = document.createElement('div');
        cursor.className = 'kr-cursor';
        const dot = document.createElement('div');
        dot.className = 'kr-cursor-dot';
        document.body.appendChild(cursor);
        document.body.appendChild(dot);

        let cx = 0, cy = 0, dx = 0, dy = 0;
        const onMove = (e) => { cx = e.clientX; cy = e.clientY; dot.style.left = cx + 'px'; dot.style.top = cy + 'px'; };
        const raf = () => {
            dx += (cx - dx) * 0.15; dy += (cy - dy) * 0.15;
            cursor.style.left = dx + 'px'; cursor.style.top = dy + 'px';
            requestAnimationFrame(raf);
        };
        window.addEventListener('mousemove', onMove);
        requestAnimationFrame(raf);

        // Grow on interactive elements
        const grow = () => cursor.classList.add('kr-cursor--hover');
        const shrink = () => cursor.classList.remove('kr-cursor--hover');
        const watchEls = () => {
            document.querySelectorAll('a, button, [role="button"], input, textarea, .bento-card, .why-card, .testimonial-card, .blog-card').forEach(el => {
                el.addEventListener('mouseenter', grow);
                el.addEventListener('mouseleave', shrink);
            });
        };
        watchEls();
        const mo = new MutationObserver(watchEls);
        mo.observe(document.body, { childList: true, subtree: true });

        return () => {
            window.removeEventListener('mousemove', onMove);
            cursor.remove(); dot.remove(); mo.disconnect();
        };
    }, []);

    const navigation = [
        { name: 'Accueil', href: '/', icon: 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6' },
        { name: 'À propos', href: '/a-propos', icon: 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z' },
        { name: 'Méthode', href: '/methode-travail', icon: 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2' },
        { name: 'Portfolio', href: '/portfolio', icon: 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z' },
    ];

    // SEO defaults
    const title = seo?.title || 'Kréyatik Studio Développeur Web Freelance Rochefort | Laravel, E-commerce & Applications';
    const description = seo?.description || 'Développeur web freelance à Rochefort : création de sites internet, e-commerce & applications Laravel sur-mesure. Expert SEO, solutions digitales performantes. Devis gratuit.';
    const ogImage = seo?.image || 'https://kreyatikstudio.fr/images/STUDIOcolibri.png';
    const absoluteOgImage = ogImage.startsWith('http') ? ogImage : `https://kreyatikstudio.fr${ogImage}`;

    return (
        <>
            <Head>
                <title>{title}</title>
                <meta name="description" content={description} />
                <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />
                <meta property="og:type" content="website" />
                <meta property="og:title" content={title} />
                <meta property="og:description" content={description} />
                <meta property="og:image" content={absoluteOgImage} />
                <meta property="og:image:width" content="1200" />
                <meta property="og:image:height" content="630" />
                <meta property="og:url" content={seo?.canonical_url || window.location.href} />
                <meta property="og:site_name" content="Kréyatik Studio" />
                <meta property="og:locale" content="fr_FR" />
                <meta name="twitter:card" content="summary_large_image" />
                <meta name="twitter:title" content={title} />
                <meta name="twitter:description" content={description} />
                <meta name="twitter:image" content={absoluteOgImage} />
                <link rel="canonical" href={seo?.canonical_url || window.location.href} />
            </Head>

            {/* Preloader — Particle Logo */}
            <div className={`kr-preloader ${loading ? '' : 'kr-preloader--done'}`} aria-hidden="true">
                <canvas ref={canvasRef} className="kr-preloader__canvas"></canvas>
                <div className="kr-preloader__text-wrap">
                    {'Kréyatik Studio'.split('').map((char, i) => (
                        <span key={i} className="kr-preloader__letter" style={{ animationDelay: `${1.4 + i * 0.04}s` }}>
                            {char === ' ' ? '\u00A0' : char}
                        </span>
                    ))}
                </div>
                <div className="kr-preloader__progress">
                    <div className="kr-preloader__progress-bar"></div>
                </div>
            </div>

            <div className="site-wrapper min-h-screen flex flex-col">
                {/* Navbar */}
                <nav className={`navbar ${scrolled ? 'scrolled' : ''}`}>
                    <div className="navbar-container">
                        {/* Logo */}
                        <Link href="/" className="logo-link">
                            <img src="/images/Studiosansfond.png" alt="Logo Kréyatik Studio" className="logo-img" />
                        </Link>

                        {/* Desktop Navigation */}
                        <ul className="desktop-nav">
                            {navigation.map((item) => (
                                <li key={item.name}>
                                    <Link href={item.href} className="nav-link">
                                        {item.name}
                                    </Link>
                                </li>
                            ))}
                        </ul>

                        {/* CTA Button Desktop */}
                        <Link href="/contact" className="cta-button">
                            Devis gratuit
                        </Link>

                        {/* Burger animé */}
                        <button
                            className={`mobile-menu-toggle ${mobileMenuOpen ? 'is-open' : ''}`}
                            onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
                            aria-label={mobileMenuOpen ? 'Fermer le menu' : 'Ouvrir le menu'}
                            aria-expanded={mobileMenuOpen}
                        >
                            <span className="burger-bar"></span>
                            <span className="burger-bar"></span>
                            <span className="burger-bar"></span>
                        </button>
                    </div>
                </nav>

                {/* ── Overlay plein écran ── */}
                <div className={`nav-overlay ${mobileMenuOpen ? 'nav-overlay--open' : ''}`} aria-hidden={!mobileMenuOpen}>
                    <div className="nav-overlay__inner">
                        {/* Liens principaux */}
                        <nav className="nav-overlay__links">
                            {navigation.map((item, i) => (
                                <Link
                                    key={item.name}
                                    href={item.href}
                                    className="nav-overlay__link"
                                    style={{ transitionDelay: mobileMenuOpen ? `${0.12 + i * 0.07}s` : '0s' }}
                                    onClick={() => setMobileMenuOpen(false)}
                                >
                                    <span className="nav-overlay__num">0{i + 1}</span>
                                    <span className="nav-overlay__name">{item.name}</span>
                                    <span className="nav-overlay__arrow">↗</span>
                                </Link>
                            ))}
                        </nav>

                        {/* Bas : CTA + contact */}
                        <div className="nav-overlay__bottom" style={{ transitionDelay: mobileMenuOpen ? '0.46s' : '0s' }}>
                            <Link href="/contact" className="nav-overlay__cta" onClick={() => setMobileMenuOpen(false)}>
                                Démarrer un projet →
                            </Link>
                            <div className="nav-overlay__contact">
                                <a href="tel:0695800663">06 95 80 06 63</a>
                                <a href="mailto:kreyatik@gmail.com">kreyatik@gmail.com</a>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Main Content */}
                <main className="flex-grow">
                    {children}
                </main>

                {/* Footer */}
                <footer className="footer">

                    {/* ── Big CTA statement ── */}
                    <div className="footer-cta">
                        <span className="footer-cta__overline">Un projet en tête ?</span>
                        <Link href="/contact" className="footer-cta__headline">
                            <span className="footer-cta__words">
                                <span className="footer-cta__word">Travaillons</span>
                                <span className="footer-cta__word">ensemble.</span>
                            </span>
                            <span className="footer-cta__arrow" aria-hidden="true">↗</span>
                        </Link>
                    </div>

                    {/* ── Separator ── */}
                    <div className="footer-rule"></div>

                    {/* ── Bottom bar ── */}
                    <div className="footer-bar">
                        {/* Left : logo + socials */}
                        <div className="footer-bar__left">
                            <Link href="/" className="footer-bar__logo-link">
                                <img src="/images/Studiosansfond.png" alt="Kréyatik Studio" className="footer-bar__logo" />
                            </Link>
                            <div className="footer-bar__socials">
                                <a href="https://www.facebook.com/share/1AtjVczpEJ/" aria-label="Facebook" className="footer-bar__social" target="_blank" rel="noopener noreferrer">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                </a>
                                <a href="https://www.instagram.com/kreyatik_17/" aria-label="Instagram" className="footer-bar__social" target="_blank" rel="noopener noreferrer">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>

                        {/* Center : nav links */}
                        <nav className="footer-bar__nav" aria-label="Footer navigation">
                            <Link href="/" className="footer-bar__link">Accueil</Link>
                            <Link href="/a-propos" className="footer-bar__link">À propos</Link>
                            <Link href="/methode-travail" className="footer-bar__link">Méthode</Link>
                            <Link href="/portfolio" className="footer-bar__link">Portfolio</Link>
                            <Link href="/blog" className="footer-bar__link">Blog</Link>
                            <Link href="/contact" className="footer-bar__link">Contact</Link>
                        </nav>

                        {/* Right : legal + copy */}
                        <div className="footer-bar__right">
                            <div className="footer-bar__legal">
                                <Link href="/mentions-legales" className="footer-bar__legal-link">Mentions légales</Link>
                                <Link href="/confidentialite" className="footer-bar__legal-link">Confidentialité</Link>
                                <Link href="/cgv" className="footer-bar__legal-link">CGV</Link>
                                <Link href="/plan-du-site" className="footer-bar__legal-link">Plan du site</Link>
                            </div>
                            <p className="footer-bar__copy">
                                © {new Date().getFullYear()} Kréyatik Studio — Rochefort
                            </p>
                        </div>
                    </div>

                </footer>
            </div>

            <style jsx>{`
                /* Custom Cursor */
                :global(.kr-cursor) {
                    position: fixed;
                    width: 40px;
                    height: 40px;
                    border: 1.5px solid rgba(27, 58, 92, 0.3);
                    border-radius: 50%;
                    pointer-events: none;
                    z-index: 99998;
                    transform: translate(-50%, -50%);
                    transition: width 0.35s cubic-bezier(0.16, 1, 0.3, 1),
                                height 0.35s cubic-bezier(0.16, 1, 0.3, 1),
                                border-color 0.3s ease,
                                background 0.3s ease;
                    mix-blend-mode: difference;
                    background: transparent;
                }
                :global(.kr-cursor--hover) {
                    width: 70px;
                    height: 70px;
                    border-color: rgba(0, 153, 204, 0.5);
                    background: rgba(0, 153, 204, 0.06);
                }
                :global(.kr-cursor-dot) {
                    position: fixed;
                    width: 6px;
                    height: 6px;
                    background: #1B3A5C;
                    border-radius: 50%;
                    pointer-events: none;
                    z-index: 99998;
                    transform: translate(-50%, -50%);
                }

                /* Hide default cursor on desktop when custom is active */
                @media (pointer: fine) {
                    :global(html) {
                        cursor: none !important;
                    }
                    :global(a, button, input, textarea, select, [role="button"]) {
                        cursor: none !important;
                    }
                }

                /* Smooth scroll */
                :global(html) {
                    scroll-behavior: smooth;
                }

                /* ====== PRELOADER ====== */
                .kr-preloader {
                    position: fixed;
                    inset: 0;
                    z-index: 99999;
                    background: #0A1628;
                    overflow: hidden;
                    transition: transform 1.1s cubic-bezier(0.76, 0, 0.24, 1),
                                opacity 0.4s ease 0.7s;
                }
                .kr-preloader--done {
                    transform: translateY(-100%);
                    opacity: 0;
                    pointer-events: none;
                }

                /* Canvas fills the whole preloader */
                .kr-preloader__canvas {
                    position: absolute;
                    inset: 0;
                    width: 100%;
                    height: 100%;
                    pointer-events: none;
                }

                /* Text appears below the particle logo */
                .kr-preloader__text-wrap {
                    position: absolute;
                    bottom: 18%;
                    left: 50%;
                    transform: translateX(-50%);
                    display: flex;
                    gap: 0;
                    font-family: 'Syne', sans-serif;
                    font-size: clamp(1rem, 2.5vw, 1.5rem);
                    font-weight: 700;
                    letter-spacing: 0.25em;
                    text-transform: uppercase;
                    color: rgba(255, 255, 255, 0.85);
                    white-space: nowrap;
                    overflow: hidden;
                }
                .kr-preloader__letter {
                    display: inline-block;
                    opacity: 0;
                    transform: translateY(16px);
                    animation: letterIn 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
                }
                @keyframes letterIn {
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }

                /* Progress bar at bottom */
                .kr-preloader__progress {
                    position: absolute;
                    bottom: 0;
                    left: 0;
                    right: 0;
                    height: 2px;
                    background: rgba(255, 255, 255, 0.06);
                }
                .kr-preloader__progress-bar {
                    height: 100%;
                    background: linear-gradient(90deg, #0099CC, #00d4ff);
                    width: 0%;
                    animation: progressFill 2.4s cubic-bezier(0.4, 0, 0.2, 1) 0.1s forwards;
                }
                @keyframes progressFill {
                    0%   { width: 0%; }
                    30%  { width: 20%; }
                    70%  { width: 65%; }
                    90%  { width: 85%; }
                    100% { width: 100%; }
                }

                /* ====== NAVBAR ====== */
                .navbar {
                    position: fixed;
                    top: 0; left: 0; right: 0;
                    z-index: 1000;
                    background: transparent;
                    transition: background 0.5s ease, box-shadow 0.5s ease, padding 0.4s ease;
                }

                .navbar.scrolled {
                    background: rgba(255, 255, 255, 0.97);
                    backdrop-filter: blur(24px);
                    -webkit-backdrop-filter: blur(24px);
                    box-shadow: 0 1px 0 rgba(0, 0, 0, 0.07);
                }

                .navbar-container {
                    max-width: 1400px;
                    margin: 0 auto;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding: 1.75rem 2.5rem;
                    transition: padding 0.4s ease;
                }

                .navbar.scrolled .navbar-container {
                    padding: 1rem 2.5rem;
                }

                /* Logo — toujours visible */
                .logo-link {
                    display: flex;
                    align-items: center;
                    flex-shrink: 0;
                    transition: opacity 0.3s ease;
                }

                .logo-link:hover {
                    opacity: 0.8;
                }

                .logo-img {
                    height: 48px;
                    width: auto;
                    object-fit: contain;
                    transition: height 0.4s ease;
                }

                .navbar.scrolled .logo-img {
                    height: 40px;
                }

                /* Desktop nav */
                .desktop-nav {
                    display: none;
                    list-style: none;
                    margin: 0; padding: 0;
                    align-items: center;
                    gap: 0;
                }

                .nav-link {
                    display: block;
                    font-family: 'Outfit', sans-serif;
                    font-size: 0.75rem;
                    font-weight: 500;
                    letter-spacing: 0.14em;
                    text-transform: uppercase;
                    color: rgba(255, 255, 255, 0.82);
                    text-decoration: none;
                    padding: 0.5rem 1.1rem;
                    white-space: nowrap;
                    position: relative;
                    transition: color 0.3s ease;
                }

                /* Underline animation */
                .nav-link::after {
                    content: '';
                    position: absolute;
                    bottom: 0; left: 1.1rem; right: 1.1rem;
                    height: 1px;
                    background: #0099CC;
                    transform: scaleX(0);
                    transform-origin: left;
                    transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
                }

                .nav-link:hover { color: #fff; }
                .nav-link:hover::after { transform: scaleX(1); }

                /* Scrolled state — liens sombres */
                .navbar.scrolled .nav-link {
                    color: #374151;
                }
                .navbar.scrolled .nav-link:hover {
                    color: #0099CC;
                }

                /* CTA pill */
                .cta-button {
                    display: none;
                    align-items: center;
                    font-family: 'Outfit', sans-serif;
                    font-size: 0.75rem;
                    font-weight: 600;
                    letter-spacing: 0.12em;
                    text-transform: uppercase;
                    text-decoration: none;
                    padding: 0.6rem 1.5rem;
                    border-radius: 100px;
                    border: 1px solid rgba(255, 255, 255, 0.5);
                    color: white;
                    background: transparent;
                    transition: background 0.3s ease, border-color 0.3s ease, color 0.3s ease;
                    white-space: nowrap;
                }

                .cta-button:hover {
                    background: #0099CC;
                    border-color: #0099CC;
                    color: white;
                }

                .navbar.scrolled .cta-button {
                    border-color: #0099CC;
                    color: #0099CC;
                }

                .navbar.scrolled .cta-button:hover {
                    background: #0099CC;
                    color: white;
                }

                /* ====== BURGER ANIMÉ ====== */
                .mobile-menu-toggle {
                    display: none;
                    flex-direction: column;
                    justify-content: center;
                    gap: 5px;
                    background: transparent;
                    border: none;
                    cursor: pointer;
                    padding: 6px;
                    width: 38px;
                    height: 38px;
                    position: relative;
                    z-index: 10001;
                    flex-shrink: 0;
                }

                .burger-bar {
                    display: block;
                    width: 24px;
                    height: 1.5px;
                    background: rgba(255, 255, 255, 0.9);
                    transition: transform 0.45s cubic-bezier(0.16, 1, 0.3, 1),
                                opacity 0.3s ease,
                                background 0.3s ease;
                    transform-origin: center;
                }

                /* Burger → X */
                .mobile-menu-toggle.is-open .burger-bar:nth-child(1) {
                    transform: translateY(6.5px) rotate(45deg);
                }
                .mobile-menu-toggle.is-open .burger-bar:nth-child(2) {
                    opacity: 0;
                    transform: scaleX(0);
                }
                .mobile-menu-toggle.is-open .burger-bar:nth-child(3) {
                    transform: translateY(-6.5px) rotate(-45deg);
                }

                /* Sur fond blanc scrollé */
                .navbar.scrolled .burger-bar {
                    background: #1a1a2e;
                }
                /* Quand overlay ouvert, toujours blanc (overlay est sombre) */
                .mobile-menu-toggle.is-open .burger-bar {
                    background: rgba(255, 255, 255, 0.9) !important;
                }

                /* ====== OVERLAY PLEIN ÉCRAN ====== */
                .nav-overlay {
                    position: fixed;
                    inset: 0;
                    z-index: 10000;
                    background: #07111F;
                    transform: translateY(-100%);
                    transition: transform 0.8s cubic-bezier(0.76, 0, 0.24, 1);
                    pointer-events: none;
                    display: flex;
                    flex-direction: column;
                }

                .nav-overlay--open {
                    transform: translateY(0);
                    pointer-events: all;
                }

                .nav-overlay__inner {
                    display: flex;
                    flex-direction: column;
                    justify-content: space-between;
                    height: 100%;
                    padding: 6rem 2rem 2.5rem;
                    overflow-y: auto;
                }

                /* Liens */
                .nav-overlay__links {
                    display: flex;
                    flex-direction: column;
                }

                .nav-overlay__link {
                    display: flex;
                    align-items: center;
                    gap: 1rem;
                    text-decoration: none;
                    border-bottom: 1px solid rgba(255, 255, 255, 0.06);
                    padding: 1.1rem 0;
                    opacity: 0;
                    transform: translateY(24px);
                    transition: opacity 0.55s ease, transform 0.55s cubic-bezier(0.16, 1, 0.3, 1);
                }

                .nav-overlay--open .nav-overlay__link {
                    opacity: 1;
                    transform: translateY(0);
                }

                .nav-overlay__num {
                    font-family: 'Outfit', sans-serif;
                    font-size: 0.65rem;
                    font-weight: 500;
                    color: #0099CC;
                    letter-spacing: 0.1em;
                    flex-shrink: 0;
                    margin-top: 6px;
                }

                .nav-overlay__name {
                    font-family: 'Syne', sans-serif;
                    font-size: clamp(2rem, 9vw, 3.5rem);
                    font-weight: 700;
                    letter-spacing: -0.02em;
                    color: white;
                    flex: 1;
                    line-height: 1;
                    transition: color 0.25s ease;
                }

                .nav-overlay__arrow {
                    font-size: clamp(1.2rem, 4vw, 1.8rem);
                    color: rgba(255, 255, 255, 0.15);
                    transition: color 0.25s ease, transform 0.25s ease;
                    flex-shrink: 0;
                }

                .nav-overlay__link:hover .nav-overlay__name { color: #0099CC; }
                .nav-overlay__link:hover .nav-overlay__arrow {
                    color: #0099CC;
                    transform: translate(4px, -4px);
                }

                /* Bas de l'overlay */
                .nav-overlay__bottom {
                    display: flex;
                    flex-direction: column;
                    gap: 1.25rem;
                    opacity: 0;
                    transform: translateY(12px);
                    transition: opacity 0.5s ease, transform 0.5s ease;
                    padding-top: 2rem;
                }

                .nav-overlay--open .nav-overlay__bottom {
                    opacity: 1;
                    transform: translateY(0);
                }

                .nav-overlay__cta {
                    display: inline-block;
                    font-family: 'Outfit', sans-serif;
                    font-size: 0.78rem;
                    font-weight: 600;
                    letter-spacing: 0.1em;
                    text-transform: uppercase;
                    text-decoration: none;
                    background: #0099CC;
                    color: white;
                    padding: 0.875rem 2rem;
                    border-radius: 100px;
                    align-self: flex-start;
                    transition: background 0.3s ease;
                }

                .nav-overlay__cta:hover { background: #007aa3; }

                .nav-overlay__contact {
                    display: flex;
                    flex-direction: column;
                    gap: 0.2rem;
                }

                .nav-overlay__contact a {
                    font-family: 'Outfit', sans-serif;
                    font-size: 0.85rem;
                    color: rgba(255, 255, 255, 0.3);
                    text-decoration: none;
                    transition: color 0.25s ease;
                }

                .nav-overlay__contact a:hover { color: rgba(255, 255, 255, 0.7); }

                .site-wrapper {
                    padding-top: 0;
                }

                /* ====== FOOTER ====== */
                .footer {
                    background: #07111F;
                    color: #fff;
                    overflow: hidden;
                }

                /* Big CTA */
                .footer-cta {
                    padding: 6rem 5vw 5rem;
                    display: flex;
                    flex-direction: column;
                    gap: 1.5rem;
                }

                .footer-cta__overline {
                    font-family: 'Outfit', sans-serif;
                    font-size: 0.85rem;
                    font-weight: 500;
                    letter-spacing: 0.2em;
                    text-transform: uppercase;
                    color: #0099CC;
                }

                .footer-cta__headline {
                    display: flex;
                    align-items: flex-start;
                    justify-content: space-between;
                    text-decoration: none;
                    color: inherit;
                    gap: 2rem;
                }

                .footer-cta__words {
                    display: block;
                    font-family: 'Syne', sans-serif;
                    font-size: clamp(3.5rem, 9vw, 9rem);
                    font-weight: 800;
                    line-height: 0.95;
                    letter-spacing: -0.03em;
                    color: #ffffff;
                    position: relative;
                }

                /* Animated underline sweep on hover */
                .footer-cta__words::after {
                    content: '';
                    display: block;
                    height: 3px;
                    background: #0099CC;
                    transform: scaleX(0);
                    transform-origin: left;
                    transition: transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
                    margin-top: 0.5rem;
                }

                .footer-cta__headline:hover .footer-cta__words::after {
                    transform: scaleX(1);
                }

                .footer-cta__word {
                    display: block;
                }

                .footer-cta__arrow {
                    font-size: clamp(2rem, 5vw, 5rem);
                    font-family: 'Syne', sans-serif;
                    font-weight: 300;
                    color: rgba(255,255,255,0.25);
                    flex-shrink: 0;
                    align-self: flex-end;
                    transition: color 0.4s ease, transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
                    line-height: 1;
                }

                .footer-cta__headline:hover .footer-cta__arrow {
                    color: #0099CC;
                    transform: translate(6px, -6px);
                }

                /* Separator */
                .footer-rule {
                    height: 1px;
                    background: rgba(255, 255, 255, 0.08);
                    margin: 0 5vw;
                }

                /* Bottom bar */
                .footer-bar {
                    display: grid;
                    grid-template-columns: auto 1fr auto;
                    align-items: center;
                    gap: 3rem;
                    padding: 2.5rem 5vw 3rem;
                }

                .footer-bar__left {
                    display: flex;
                    flex-direction: column;
                    gap: 1rem;
                }

                .footer-bar__logo-link {
                    display: inline-block;
                    opacity: 0.85;
                    transition: opacity 0.3s ease;
                }

                .footer-bar__logo-link:hover {
                    opacity: 1;
                }

                .footer-bar__logo {
                    height: 44px;
                    width: auto;
                    object-fit: contain;
                }

                .footer-bar__socials {
                    display: flex;
                    gap: 0.75rem;
                }

                .footer-bar__social {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    width: 36px;
                    height: 36px;
                    border: 1px solid rgba(255,255,255,0.12);
                    border-radius: 50%;
                    color: rgba(255,255,255,0.5);
                    text-decoration: none;
                    transition: all 0.3s ease;
                }

                .footer-bar__social:hover {
                    border-color: #0099CC;
                    color: #0099CC;
                    transform: translateY(-2px);
                }

                /* Nav */
                .footer-bar__nav {
                    display: flex;
                    flex-wrap: wrap;
                    justify-content: center;
                    gap: 0.25rem 2.5rem;
                }

                .footer-bar__link {
                    font-family: 'Outfit', sans-serif;
                    font-size: 0.9rem;
                    font-weight: 400;
                    color: rgba(255,255,255,0.45);
                    text-decoration: none;
                    letter-spacing: 0.01em;
                    transition: color 0.25s ease;
                    white-space: nowrap;
                }

                .footer-bar__link:hover {
                    color: #fff;
                }

                /* Right */
                .footer-bar__right {
                    display: flex;
                    flex-direction: column;
                    align-items: flex-end;
                    gap: 0.5rem;
                }

                .footer-bar__legal {
                    display: flex;
                    gap: 1.5rem;
                    flex-wrap: wrap;
                    justify-content: flex-end;
                }

                .footer-bar__legal-link {
                    font-size: 0.78rem;
                    color: rgba(255,255,255,0.3);
                    text-decoration: none;
                    letter-spacing: 0.02em;
                    transition: color 0.25s ease;
                    white-space: nowrap;
                }

                .footer-bar__legal-link:hover {
                    color: rgba(255,255,255,0.7);
                }

                .footer-bar__copy {
                    font-size: 0.78rem;
                    color: rgba(255,255,255,0.25);
                    letter-spacing: 0.03em;
                }

                @media (max-width: 900px) {
                    .footer-cta {
                        padding: 4rem 6vw 3rem;
                        /* prevent arrow from being clipped */
                        overflow: visible;
                    }
                    .footer-cta__headline {
                        /* stack vertically on small screens so arrow isn't squeezed */
                        flex-direction: column;
                        align-items: flex-start;
                        gap: 1rem;
                    }
                    .footer-cta__arrow {
                        align-self: flex-start;
                    }
                    .footer-bar {
                        grid-template-columns: 1fr;
                        gap: 2rem;
                        padding: 2rem 6vw 2.5rem;
                        align-items: center;
                        text-align: center;
                    }
                    .footer-bar__left {
                        align-items: center;
                    }
                    .footer-bar__socials {
                        justify-content: center;
                    }
                    .footer-bar__nav {
                        justify-content: center;
                        gap: 0.25rem 1.5rem;
                    }
                    .footer-bar__right {
                        align-items: center;
                    }
                    .footer-bar__legal {
                        justify-content: center;
                    }
                    .footer-rule {
                        margin: 0 6vw;
                    }
                }

                /* Responsive Design */
                @media (min-width: 1024px) {
                    .desktop-nav { display: flex; }
                    .cta-button { display: flex; }
                    .mobile-menu-toggle { display: none; }
                }

                @media (max-width: 1023px) {
                    .mobile-menu-toggle {
                        display: flex;
                    }

                    .navbar-container {
                        padding: 1.25rem 1.5rem;
                    }

                    .logo-img {
                        height: 48px;
                    }

                    .site-wrapper {
                        padding-top: 0;
                    }

                    .footer-top {
                        grid-template-columns: 1fr;
                        gap: 2rem;
                    }

                    .footer-content {
                        padding: 3rem 1.5rem 1.5rem;
                    }
                }

                @media (max-width: 640px) {
                    .logo-img {
                        height: 42px;
                    }

                    .navbar-container {
                        padding: 0.875rem 1.25rem;
                    }

                    .mobile-nav {
                        padding: 1.25rem 1.25rem 1.5rem;
                    }

                    .mobile-nav-link {
                        font-size: 1rem;
                        padding: 0.875rem 1rem;
                    }

                    .mobile-cta-button {
                        font-size: 1rem;
                        padding: 0.875rem 1.25rem;
                    }

                    .footer-logo {
                        height: 50px;
                    }
                }
            `}</style>
        </>
    );
}
