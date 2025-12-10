import { Link } from '@inertiajs/react';
import { Head } from '@inertiajs/react';
import PublicLayout from '@/Layouts/PublicLayout';

export default function Sitemap({ seo }) {
    const mainPages = [
        { name: 'Accueil', href: '/' },
        { name: 'Nos Offres', href: '/nos-offres' },
        { name: 'Portfolio', href: '/portfolio' },
        { name: 'Contact', href: '/contact' },
        { name: 'À Propos', href: '/a-propos' },
        { name: 'Méthode de Travail', href: '/methode-travail' },
        { name: 'Témoignages Clients', href: '/temoignages-clients' },
        { name: 'Blog', href: '/blog' },
    ];

    const legalPages = [
        { name: 'Mentions Légales', href: '/mentions-legales' },
        { name: 'Politique de Confidentialité', href: '/confidentialite' },
        { name: 'CGV', href: '/cgv' },
    ];

    const clientPages = [
        { name: 'Connexion', href: '/login' },
        { name: 'Inscription', href: '/register' },
        { name: 'Tableau de bord', href: '/client/dashboard' },
    ];

    return (
        <PublicLayout seo={seo}>
            <Head>
                <title>{seo?.title || 'Plan du Site - Kréyatik Studio'}</title>
                <meta name="description" content={seo?.description || "Accédez facilement à toutes les pages de Kréyatik Studio : services, portfolio, contact, informations légales et espace client."} />
            </Head>

            <section className="min-h-[80vh] bg-gradient-to-b from-gray-50 to-white py-24 flex items-center justify-center">
                <div className="container mx-auto px-4">
                    <div className="max-w-5xl mx-auto">
                        {/* Header */}
                        <div className="text-center mb-16">
                            <h1 className="text-4xl md:text-5xl font-bold text-gray-900 mb-4 relative inline-block">
                                Plan du Site
                                <span className="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-24 h-1 bg-gradient-to-r from-[#0099CC] to-[#00A86B] rounded-full"></span>
                            </h1>
                            <p className="text-lg text-gray-600 mt-6 max-w-2xl mx-auto">
                                Retrouvez toutes les pages de notre site en un clin d'œil
                            </p>
                        </div>

                        {/* Grid des sections */}
                        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                            {/* Pages Principales */}
                            <div className="bg-white rounded-2xl shadow-lg p-8 transform transition-all duration-300 hover:scale-105 hover:shadow-2xl border-t-4 border-[#0099CC]">
                                <div className="flex flex-col items-center text-center mb-6">
                                    <div className="w-16 h-16 bg-gradient-to-br from-[#0099CC]/10 to-[#0099CC]/5 rounded-full flex items-center justify-center mb-4">
                                        <svg className="w-8 h-8 text-[#0099CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                    </div>
                                    <h2 className="text-2xl font-bold text-gray-900">Pages Principales</h2>
                                </div>
                                <ul className="space-y-4">
                                    {mainPages.map((page, index) => (
                                        <li key={index} className="flex justify-center">
                                            <Link
                                                href={page.href}
                                                className="inline-flex items-center text-gray-700 hover:text-[#0099CC] transition-all duration-200 group font-medium"
                                            >
                                                <span className="w-2 h-2 bg-[#0099CC] rounded-full mr-3 transform group-hover:scale-150 transition-transform"></span>
                                                {page.name}
                                            </Link>
                                        </li>
                                    ))}
                                </ul>
                            </div>

                            {/* Informations Légales */}
                            <div className="bg-white rounded-2xl shadow-lg p-8 transform transition-all duration-300 hover:scale-105 hover:shadow-2xl border-t-4 border-[#00A86B]">
                                <div className="flex flex-col items-center text-center mb-6">
                                    <div className="w-16 h-16 bg-gradient-to-br from-[#00A86B]/10 to-[#00A86B]/5 rounded-full flex items-center justify-center mb-4">
                                        <svg className="w-8 h-8 text-[#00A86B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <h2 className="text-2xl font-bold text-gray-900">Informations Légales</h2>
                                </div>
                                <ul className="space-y-4">
                                    {legalPages.map((page, index) => (
                                        <li key={index} className="flex justify-center">
                                            <Link
                                                href={page.href}
                                                className="inline-flex items-center text-gray-700 hover:text-[#00A86B] transition-all duration-200 group font-medium"
                                            >
                                                <span className="w-2 h-2 bg-[#00A86B] rounded-full mr-3 transform group-hover:scale-150 transition-transform"></span>
                                                {page.name}
                                            </Link>
                                        </li>
                                    ))}
                                </ul>
                            </div>

                            {/* Espace Client */}
                            <div className="bg-white rounded-2xl shadow-lg p-8 transform transition-all duration-300 hover:scale-105 hover:shadow-2xl border-t-4 border-gradient-to-r from-[#0099CC] to-[#00A86B]">
                                <div className="flex flex-col items-center text-center mb-6">
                                    <div className="w-16 h-16 bg-gradient-to-br from-[#0099CC]/10 via-purple-50 to-[#00A86B]/10 rounded-full flex items-center justify-center mb-4">
                                        <svg className="w-8 h-8 text-[#0099CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <h2 className="text-2xl font-bold text-gray-900">Espace Client</h2>
                                </div>
                                <ul className="space-y-4">
                                    {clientPages.map((page, index) => (
                                        <li key={index} className="flex justify-center">
                                            <Link
                                                href={page.href}
                                                className="inline-flex items-center text-gray-700 hover:text-[#0099CC] transition-all duration-200 group font-medium"
                                            >
                                                <span className="w-2 h-2 bg-gradient-to-r from-[#0099CC] to-[#00A86B] rounded-full mr-3 transform group-hover:scale-150 transition-transform"></span>
                                                {page.name}
                                            </Link>
                                        </li>
                                    ))}
                                </ul>
                            </div>
                        </div>

                        {/* CTA Final */}
                        <div className="mt-16 text-center">
                            <div className="bg-gradient-to-br from-blue-900 to-blue-800 rounded-2xl p-8 md:p-12 shadow-2xl">
                                <h3 className="text-2xl md:text-3xl font-bold text-white mb-4">
                                    Vous ne trouvez pas ce que vous cherchez ?
                                </h3>
                                <p className="text-blue-100 text-lg mb-6">
                                    Notre équipe est là pour vous aider
                                </p>
                                <Link
                                    href="/contact"
                                    className="inline-flex items-center gap-3 bg-gradient-to-r from-[#0099CC] to-[#00A86B] text-white px-8 py-4 rounded-full font-bold text-lg shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300"
                                >
                                    <span>Contactez-nous</span>
                                    <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </PublicLayout>
    );
}
