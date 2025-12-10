import { useState, useEffect } from 'react';
import { Link, usePage, Head } from '@inertiajs/react';

export default function PublicLayout({ children, seo }) {
    const { flash } = usePage().props;
    const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
    const [scrolled, setScrolled] = useState(false);

    // Handle scroll effect
    useEffect(() => {
        const handleScroll = () => {
            setScrolled(window.scrollY > 50);
        };
        window.addEventListener('scroll', handleScroll);
        return () => window.removeEventListener('scroll', handleScroll);
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
                                        <svg className="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d={item.icon} />
                                        </svg>
                                        <span>{item.name}</span>
                                    </Link>
                                </li>
                            ))}
                        </ul>

                        {/* CTA Button Desktop */}
                        <Link href="/contact" className="cta-button">
                            <span>Devis gratuit</span>
                            <svg className="cta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </Link>

                        {/* Mobile Menu Toggle */}
                        <button
                            className="mobile-menu-toggle"
                            onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
                            aria-label="Toggle menu"
                        >
                            <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                {mobileMenuOpen ? (
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
                                ) : (
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 6h16M4 12h16M4 18h16" />
                                )}
                            </svg>
                        </button>
                    </div>

                    {/* Mobile Navigation Menu */}
                    <div className={`mobile-nav ${mobileMenuOpen ? 'active' : ''}`}>
                        {navigation.map((item) => (
                            <Link
                                key={item.name}
                                href={item.href}
                                className="mobile-nav-link"
                                onClick={() => setMobileMenuOpen(false)}
                            >
                                <svg className="mobile-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d={item.icon} />
                                </svg>
                                <span>{item.name}</span>
                            </Link>
                        ))}
                        <Link href="/contact" className="mobile-cta-button" onClick={() => setMobileMenuOpen(false)}>
                            <span>Devis gratuit</span>
                            <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </Link>
                    </div>
                </nav>

                {/* Main Content */}
                <main className="flex-grow">
                    {children}
                </main>

                {/* Footer */}
                <footer className="footer">
                    <div className="footer-content">
                        {/* Top Section */}
                        <div className="footer-top">
                            {/* About Section */}
                            <div className="footer-section">
                                <Link href="/" className="footer-logo-link">
                                    <img src="/images/Studiosansfond.png" alt="Logo Kreyatik Studio" className="footer-logo" />
                                </Link>
                                <p className="footer-tagline">
                                    Création de sites web sur-mesure <br />
                                    Laravel • React • E-commerce
                                </p>
                                <div className="social-links">
                                    <a href="https://www.facebook.com/share/1AtjVczpEJ/" aria-label="Facebook" className="social-link" target="_blank" rel="noopener noreferrer">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                        </svg>
                                    </a>
                                    <a href="https://www.instagram.com/kreyatik_17/" aria-label="Instagram" className="social-link" target="_blank" rel="noopener noreferrer">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            {/* Links Section */}
                            <div className="footer-section">
                                <h3 className="footer-title">Navigation</h3>
                                <ul className="footer-links">
                                    <li><Link href="/" className="footer-link">Accueil</Link></li>
                                    <li><Link href="/portfolio" className="footer-link">Portfolio</Link></li>
                                    <li><Link href="/blog" className="footer-link">Blog</Link></li>
                                    <li><Link href="/contact" className="footer-link">Contact</Link></li>
                                </ul>
                            </div>

                            {/* Legal Section */}
                            <div className="footer-section">
                                <h3 className="footer-title">Informations légales</h3>
                                <ul className="footer-links">
                                    <li><Link href="/mentions-legales" className="footer-link">Mentions légales</Link></li>
                                    <li><Link href="/cgv" className="footer-link">CGV</Link></li>
                                    <li><Link href="/confidentialite" className="footer-link">Confidentialité</Link></li>
                                    <li><Link href="/plan-du-site" className="footer-link">Plan du site</Link></li>
                                </ul>
                            </div>

                            {/* Contact Section */}
                            <div className="footer-section">
                                <h3 className="footer-title">Contact</h3>
                                <div className="footer-contact">
                                    <p className="contact-item">
                                        <svg className="contact-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        2 rue du petit port marchand<br />17300 Rochefort
                                    </p>
                                    <p className="contact-item">
                                        <svg className="contact-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        <a href="mailto:kreyatik@gmail.com" className="footer-link">kreyatik@gmail.com</a>
                                    </p>
                                    <p className="contact-item">
                                        <svg className="contact-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        <a href="tel:0695800663" className="footer-link">06 95 80 06 63</a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        {/* Bottom Section */}
                        <div className="footer-bottom">
                            <p>&copy; {new Date().getFullYear()} Kréyatik Studio. Tous droits réservés.</p>
                            <p className="footer-credit">Conçu et développé avec ❤️ à Rochefort</p>
                        </div>
                    </div>
                </footer>
            </div>

            <style jsx>{`
                /* Navbar Styles */
                .navbar {
                    position: fixed;
                    top: 0;
                    left: 0;
                    right: 0;
                    width: 100%;
                    z-index: 1000;
                    background: rgba(255, 255, 255, 0.95);
                    backdrop-filter: blur(20px);
                    border-bottom: 1px solid rgba(0, 0, 0, 0.08);
                    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
                }

                .navbar.scrolled {
                    background: rgba(255, 255, 255, 0.98);
                    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
                    border-bottom: 1px solid rgba(0, 153, 204, 0.1);
                }

                .navbar-container {
                    max-width: 1400px;
                    margin: 0 auto;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding: 1rem 2.5rem;
                    position: relative;
                }

                .logo-link {
                    display: flex;
                    align-items: center;
                    transition: transform 0.3s ease, filter 0.3s ease;
                    z-index: 10;
                    position: relative;
                }

                .logo-link:hover {
                    transform: scale(1.05);
                    filter: drop-shadow(0 0 8px rgba(0, 153, 204, 0.3));
                }

                .logo-img {
                    height: 55px;
                    width: auto;
                    object-fit: contain;
                }

                .desktop-nav {
                    display: none;
                    list-style: none;
                    margin: 0;
                    padding: 0;
                    gap: 1rem;
                    align-items: center;
                }

                .nav-link {
                    display: flex;
                    align-items: center;
                    gap: 0.5rem;
                    color: #374151;
                    text-decoration: none;
                    font-weight: 500;
                    font-size: 0.95rem;
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    position: relative;
                    padding: 0.75rem 1.25rem;
                    border-radius: 12px;
                    white-space: nowrap;
                }

                .nav-icon {
                    width: 18px;
                    height: 18px;
                    transition: all 0.3s ease;
                    opacity: 0.7;
                }

                .nav-link:hover {
                    color: #0099CC;
                    background: linear-gradient(135deg, rgba(0, 153, 204, 0.08), rgba(0, 168, 107, 0.08));
                    transform: translateY(-2px);
                }

                .nav-link:hover .nav-icon {
                    opacity: 1;
                    transform: scale(1.1);
                }

                .nav-link:active {
                    transform: translateY(0);
                }

                /* CTA Button */
                .cta-button {
                    display: none;
                    align-items: center;
                    gap: 0.5rem;
                    background: linear-gradient(135deg, #0099CC, #00A86B);
                    color: white;
                    padding: 0.75rem 1.5rem;
                    border-radius: 12px;
                    font-weight: 600;
                    font-size: 0.95rem;
                    text-decoration: none;
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    box-shadow: 0 4px 15px rgba(0, 153, 204, 0.3);
                    position: relative;
                    overflow: hidden;
                }

                .cta-button::before {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: linear-gradient(135deg, #00A86B, #0099CC);
                    opacity: 0;
                    transition: opacity 0.3s ease;
                }

                .cta-button:hover::before {
                    opacity: 1;
                }

                .cta-button:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 6px 25px rgba(0, 153, 204, 0.4);
                }

                .cta-button span,
                .cta-button svg {
                    position: relative;
                    z-index: 1;
                }

                .cta-icon {
                    width: 18px;
                    height: 18px;
                    transition: transform 0.3s ease;
                }

                .cta-button:hover .cta-icon {
                    transform: translateX(4px);
                }

                .mobile-menu-toggle {
                    display: none;
                    background: rgba(0, 153, 204, 0.08);
                    border: none;
                    color: #0099CC;
                    cursor: pointer;
                    padding: 0.75rem;
                    border-radius: 12px;
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    box-shadow: 0 2px 8px rgba(0, 153, 204, 0.1);
                }

                .mobile-menu-toggle:hover {
                    background: rgba(0, 153, 204, 0.15);
                    transform: scale(1.05);
                    box-shadow: 0 4px 12px rgba(0, 153, 204, 0.2);
                }

                .mobile-menu-toggle:active {
                    transform: scale(0.95);
                }

                .mobile-nav {
                    display: none;
                    flex-direction: column;
                    position: absolute;
                    top: 100%;
                    left: 0;
                    right: 0;
                    background: rgba(255, 255, 255, 0.98);
                    backdrop-filter: blur(20px);
                    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
                    padding: 1.5rem 2rem 2rem;
                    gap: 0.5rem;
                    opacity: 0;
                    transform: translateY(-20px);
                    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                    pointer-events: none;
                    border-bottom: 2px solid rgba(0, 153, 204, 0.1);
                }

                .mobile-nav.active {
                    opacity: 1;
                    transform: translateY(0);
                    pointer-events: all;
                }

                .mobile-nav-link {
                    display: flex;
                    align-items: center;
                    gap: 1rem;
                    color: #374151;
                    text-decoration: none;
                    font-weight: 500;
                    font-size: 1.05rem;
                    padding: 1rem 1.25rem;
                    border-radius: 12px;
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    border: 1px solid transparent;
                }

                .mobile-nav-icon {
                    width: 22px;
                    height: 22px;
                    transition: all 0.3s ease;
                    opacity: 0.7;
                }

                .mobile-nav-link:hover {
                    background: linear-gradient(135deg, rgba(0, 153, 204, 0.1), rgba(0, 168, 107, 0.1));
                    color: #0099CC;
                    border-color: rgba(0, 153, 204, 0.2);
                    transform: translateX(8px);
                }

                .mobile-nav-link:hover .mobile-nav-icon {
                    opacity: 1;
                    transform: scale(1.1);
                }

                .mobile-cta-button {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    gap: 0.75rem;
                    background: linear-gradient(135deg, #0099CC, #00A86B);
                    color: white;
                    padding: 1rem 1.5rem;
                    border-radius: 12px;
                    font-weight: 600;
                    font-size: 1.05rem;
                    text-decoration: none;
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    box-shadow: 0 4px 15px rgba(0, 153, 204, 0.3);
                    margin-top: 1rem;
                    position: relative;
                    overflow: hidden;
                }

                .mobile-cta-button::before {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: linear-gradient(135deg, #00A86B, #0099CC);
                    opacity: 0;
                    transition: opacity 0.3s ease;
                }

                .mobile-cta-button:hover::before {
                    opacity: 1;
                }

                .mobile-cta-button span,
                .mobile-cta-button svg {
                    position: relative;
                    z-index: 1;
                }

                .mobile-cta-button:active {
                    transform: scale(0.98);
                }

                .site-wrapper {
                    padding-top: 0;
                }

                /* Footer Styles */
                .footer {
                    background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
                    color: #e5e7eb;
                    margin-top: auto;
                }

                .footer-content {
                    max-width: 1280px;
                    margin: 0 auto;
                    padding: 4rem 2rem 2rem;
                }

                .footer-top {
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                    gap: 3rem;
                    margin-bottom: 3rem;
                    padding-bottom: 3rem;
                    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                }

                .footer-section {
                    display: flex;
                    flex-direction: column;
                    gap: 1rem;
                }

                .footer-logo-link {
                    display: inline-block;
                    margin-bottom: 0.5rem;
                }

                .footer-logo {
                    height: 60px;
                    width: auto;
                    object-fit: contain;
                }

                .footer-tagline {
                    color: #9ca3af;
                    font-size: 0.95rem;
                    line-height: 1.6;
                    margin-bottom: 1rem;
                }

                .social-links {
                    display: flex;
                    gap: 1rem;
                }

                .social-link {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    width: 40px;
                    height: 40px;
                    background: rgba(255, 255, 255, 0.1);
                    color: white;
                    border-radius: 50%;
                    transition: all 0.3s ease;
                }

                .social-link:hover {
                    background: linear-gradient(135deg, #0099CC, #00A86B);
                    transform: translateY(-3px);
                    box-shadow: 0 5px 15px rgba(0, 153, 204, 0.3);
                }

                .footer-title {
                    font-size: 1.1rem;
                    font-weight: 600;
                    color: white;
                    margin-bottom: 0.5rem;
                }

                .footer-links {
                    list-style: none;
                    padding: 0;
                    margin: 0;
                    display: flex;
                    flex-direction: column;
                    gap: 0.75rem;
                }

                .footer-link {
                    color: #9ca3af;
                    text-decoration: none;
                    transition: all 0.3s ease;
                    font-size: 0.95rem;
                }

                .footer-link:hover {
                    color: #00A86B;
                    padding-left: 0.5rem;
                }

                .footer-contact {
                    display: flex;
                    flex-direction: column;
                    gap: 1rem;
                }

                .contact-item {
                    display: flex;
                    align-items: flex-start;
                    gap: 0.75rem;
                    color: #9ca3af;
                    font-size: 0.95rem;
                    line-height: 1.6;
                }

                .contact-icon {
                    width: 20px;
                    height: 20px;
                    flex-shrink: 0;
                    margin-top: 0.125rem;
                    color: #00A86B;
                }

                .footer-bottom {
                    text-align: center;
                    padding-top: 2rem;
                    color: #6b7280;
                    font-size: 0.9rem;
                }

                .footer-credit {
                    margin-top: 0.5rem;
                    color: #6b7280;
                }

                /* Responsive Design */
                @media (min-width: 1024px) {
                    .desktop-nav {
                        display: flex;
                    }

                    .cta-button {
                        display: flex;
                    }

                    .logo-link {
                        display: none;
                    }
                }

                @media (max-width: 1023px) {
                    .mobile-menu-toggle {
                        display: block;
                        z-index: 10;
                        position: relative;
                    }

                    .mobile-nav {
                        display: flex;
                    }

                    .navbar-container {
                        padding: 1rem 1.5rem;
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
