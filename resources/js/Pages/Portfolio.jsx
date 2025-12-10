import { Link, Head } from '@inertiajs/react';
import PublicLayout from '@/Layouts/PublicLayout';
import { useState } from 'react';

export default function Portfolio({ portfolioItems, seo }) {
    const [selectedCategory, setSelectedCategory] = useState('all');

    const categories = ['all', 'E-commerce', 'Vitrine', 'Application', 'Landing Page'];

    const filteredItems = selectedCategory === 'all'
        ? portfolioItems
        : portfolioItems?.filter(item => item.technology?.includes(selectedCategory));

    return (
        <PublicLayout seo={seo}>
            <Head>
                <title>{seo?.title || 'Portfolio - Nos Réalisations Web | Kréyatik Studio'}</title>
                <meta name="description" content={seo?.description || "Découvrez nos créations web : sites e-commerce, applications Laravel, landing pages performantes. +50 clients satisfaits. Votre projet mérite l'excellence !"} />
            </Head>

            {/* Hero Section Ultra-Déclencheur */}
            <section className="relative min-h-[90vh] flex items-center justify-center overflow-hidden bg-gradient-to-br from-blue-900 to-blue-800 pt-24 pb-12">
                <div className="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PHBhdGggZD0iTTM2IDE0YzAtNi42MjctNS4zNzMtMTItMTItMTJTMTIgNy4zNzMgMTIgMTRzNS4zNzMgMTIgMTIgMTIgMTItNS4zNzMgMTItMTJ6Ii8+PC9nPjwvZz48L3N2Zz4=')] opacity-20"></div>

                <div className="container mx-auto px-4 relative z-10 text-center">
                    <div className="inline-flex items-center gap-2 bg-[#00A86B]/20 backdrop-blur-sm border border-[#00A86B]/30 rounded-full px-6 py-3 mb-8 animate-fade-in">
                        <div className="w-2 h-2 bg-[#00A86B] rounded-full animate-pulse"></div>
                        <span className="text-[#00A86B] font-semibold text-sm">+{portfolioItems?.length || 0} Projets Livrés</span>
                    </div>

                    <h1 className="text-5xl md:text-7xl font-black text-white mb-6 leading-tight animate-fade-in">
                        Des Sites Web Qui<br />
                        Génèrent des Résultats
                    </h1>

                    <p className="text-xl md:text-2xl text-white mb-8 max-w-3xl mx-auto leading-relaxed animate-fade-in animation-delay-200">
                        Chaque projet que nous créons a un objectif : <strong>convertir vos visiteurs en clients</strong>.
                        Découvrez comment nous transformons des idées en machines à vendre.
                    </p>

                    {/* Stats Impressionnantes */}
                    <div className="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-4xl mx-auto mb-12">
                        <div className="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20 transform hover:scale-105 transition-transform">
                            <div className="text-4xl font-black text-white mb-2">100%</div>
                            <div className="text-sm text-white">Clients Satisfaits</div>
                        </div>
                        <div className="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20 transform hover:scale-105 transition-transform">
                            <div className="text-4xl font-black text-white mb-2">+200%</div>
                            <div className="text-sm text-white">ROI Moyen</div>
                        </div>
                        <div className="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20 transform hover:scale-105 transition-transform">
                            <div className="text-4xl font-black text-white mb-2">48h</div>
                            <div className="text-sm text-white">Premier Rendu</div>
                        </div>
                        <div className="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20 transform hover:scale-105 transition-transform">
                            <div className="text-4xl font-black text-white mb-2">24/7</div>
                            <div className="text-sm text-white">Support Dédié</div>
                        </div>
                    </div>

                    {/* CTA Principal */}
                    <Link
                        href="/contact"
                        className="inline-flex items-center gap-3 bg-gradient-to-r from-[#0099CC] to-[#00A86B] text-white px-10 py-5 rounded-full font-bold text-lg shadow-2xl hover:shadow-[#0099CC]/50 transform hover:scale-105 transition-all duration-300 animate-fade-in animation-delay-400"
                    >
                        <span>Créer Mon Projet Maintenant</span>
                        <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={3} d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </Link>

                    <p className="text-sm text-blue-200 mt-4 animate-fade-in animation-delay-600">
                        ⚡ Devis gratuit sous 24h • Sans engagement • Paiement en 3 fois
                    </p>
                </div>

                <div className="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
                    <svg className="w-8 h-8 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                    </svg>
                </div>
            </section>

            {/* Section Preuve Sociale */}
            <section className="py-16 bg-white border-b border-gray-200">
                <div className="container mx-auto px-4">
                    <div className="max-w-6xl mx-auto">
                        <div className="text-center mb-12">
                            <h2 className="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                                Ils Nous Font Confiance
                            </h2>
                            <p className="text-xl text-gray-600">Et Génèrent du CA Grâce à Nos Créations</p>
                        </div>

                        <div className="grid md:grid-cols-3 gap-8">
                            <div className="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-8 border-2 border-gray-200">
                                <div className="flex items-center gap-2 mb-4">
                                    <svg className="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <svg className="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <svg className="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <svg className="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <svg className="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                </div>
                                <p className="text-gray-700 font-medium mb-4">"Mon CA a triplé en 6 mois grâce à mon nouveau site. Meilleur investissement de l'année !"</p>
                                <p className="text-sm font-semibold text-gray-900">— Pierre M., E-commerce</p>
                            </div>

                            <div className="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-8 border-2 border-gray-200">
                                <div className="flex items-center gap-2 mb-4">
                                    {[...Array(5)].map((_, i) => (
                                        <svg key={i} className="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    ))}
                                </div>
                                <p className="text-gray-700 font-medium mb-4">"Ultra réactif, professionnel et créatif. Mon site convertit 3x mieux qu'avant !"</p>
                                <p className="text-sm font-semibold text-gray-900">— Sophie L., Artisan</p>
                            </div>

                            <div className="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-8 border-2 border-gray-200">
                                <div className="flex items-center gap-2 mb-4">
                                    {[...Array(5)].map((_, i) => (
                                        <svg key={i} className="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    ))}
                                </div>
                                <p className="text-gray-700 font-medium mb-4">"Des vrais experts qui comprennent le business. Résultats au-delà de mes attentes !"</p>
                                <p className="text-sm font-semibold text-gray-900">— Marc D., Consultant</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {/* Portfolio Grid */}
            <section className="py-20 bg-gradient-to-b from-gray-50 to-white">
                <div className="container mx-auto px-4">
                    <div className="max-w-6xl mx-auto text-center mb-16">
                        <h2 className="text-4xl md:text-6xl font-black text-gray-900 mb-6">
                            Nos Réalisations qui <span className="text-transparent bg-clip-text bg-gradient-to-r from-[#0099CC] to-[#00A86B]">Performent</span>
                        </h2>
                        <p className="text-xl text-gray-600 mb-12 max-w-3xl mx-auto">
                            Chaque projet est pensé pour <strong>générer du trafic qualifié</strong> et <strong>convertir vos visiteurs en clients</strong>
                        </p>

                        {/* Filtres */}
                        <div className="flex flex-wrap justify-center gap-3 mb-12">
                            {categories.map(cat => (
                                <button
                                    key={cat}
                                    onClick={() => setSelectedCategory(cat)}
                                    className={`px-6 py-3 rounded-full font-semibold transition-all duration-300 ${
                                        selectedCategory === cat
                                            ? 'bg-gradient-to-r from-[#0099CC] to-[#00A86B] text-white shadow-lg scale-105'
                                            : 'bg-white text-gray-700 border-2 border-gray-200 hover:border-[#0099CC]'
                                    }`}
                                >
                                    {cat === 'all' ? 'Tous les Projets' : cat}
                                </button>
                            ))}
                        </div>
                    </div>

                    {/* Grid */}
                    {portfolioItems && portfolioItems.length > 0 ? (
                        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
                            {(filteredItems || portfolioItems).map((item, index) => (
                                <div
                                    key={item.id}
                                    className="group relative bg-white rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 cursor-pointer"
                                    onClick={() => item.url && window.open(item.url, '_blank')}
                                >
                                    {/* Image */}
                                    <div className="relative aspect-video overflow-hidden">
                                        <img
                                            src={`/storage/${item.path}`}
                                            alt={item.title}
                                            className="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                            loading={index < 6 ? 'eager' : 'lazy'}
                                        />
                                        <div className="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                                        {/* Badge */}
                                        <div className="absolute top-4 left-4 pointer-events-none">
                                            <span className="bg-gradient-to-r from-[#0099CC] to-[#00A86B] text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                                                ✨ Projet #{index + 1}
                                            </span>
                                        </div>

                                        {/* Hover Overlay */}
                                        <div className="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none">
                                            <div className="bg-white/90 backdrop-blur-sm rounded-2xl px-8 py-4 transform scale-90 group-hover:scale-100 transition-transform duration-500">
                                                <p className="text-gray-900 font-bold text-lg">Voir le Projet</p>
                                            </div>
                                        </div>
                                    </div>

                                    {/* Content */}
                                    <div className="p-6">
                                        <h3 className="text-2xl font-bold text-gray-900 mb-3 group-hover:text-[#0099CC] transition-colors">
                                            {item.title}
                                        </h3>
                                        <p className="text-gray-600 mb-4 line-clamp-2">
                                            {item.description}
                                        </p>

                                        {/* Technologies */}
                                        {item.technology && (
                                            <div className="flex flex-wrap gap-2 mb-4">
                                                {item.technology.split(',').slice(0, 3).map((tech, i) => (
                                                    <span key={i} className="bg-gray-100 text-[#0099CC] px-3 py-1 rounded-full text-xs font-semibold border border-gray-300">
                                                        {tech.trim()}
                                                    </span>
                                                ))}
                                            </div>
                                        )}

                                        {/* Stats */}
                                        <div className="flex items-center justify-between pt-4 border-t border-gray-200">
                                            <div className="flex items-center gap-2 text-sm">
                                                <div className="w-2 h-2 bg-[#00A86B] rounded-full animate-pulse"></div>
                                                <span className="text-gray-600 font-medium">Livré avec succès</span>
                                            </div>
                                            <svg className="w-6 h-6 text-[#0099CC] transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>
                    ) : (
                        <div className="text-center py-20">
                            <div className="w-32 h-32 mx-auto mb-8 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center">
                                <svg className="w-16 h-16 text-[#0099CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            <h3 className="text-3xl font-bold text-gray-900 mb-4">Nouveaux Projets en Cours</h3>
                            <p className="text-xl text-gray-600 mb-8">Nous préparons des réalisations exceptionnelles</p>
                        </div>
                    )}
                </div>
            </section>

            {/* Section Urgence + CTA Final */}
            <section className="relative py-24 bg-gradient-to-br from-blue-900 to-blue-800 overflow-hidden">
                <div className="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PHBhdGggZD0iTTM2IDE0YzAtNi42MjctNS4zNzMtMTItMTItMTJTMTIgNy4zNzMgMTIgMTRzNS4zNzMgMTIgMTIgMTIgMTItNS4zNzMgMTItMTJ6Ii8+PC9nPjwvZz48L3N2Zz4=')] opacity-20"></div>

                <div className="container mx-auto px-4 relative z-10">
                    <div className="max-w-5xl mx-auto text-center">
                        {/* Badge Urgence */}
                        <div className="inline-flex items-center gap-3 bg-[#00A86B]/20 backdrop-blur-sm border border-[#00A86B]/30 rounded-full px-6 py-3 mb-8 animate-pulse">
                            <svg className="w-5 h-5 text-[#00A86B]" fill="currentColor" viewBox="0 0 20 20">
                                <path fillRule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clipRule="evenodd" />
                            </svg>
                            <span className="text-[#00A86B] font-bold">Offre Limitée : -20% sur votre premier projet</span>
                        </div>

                        <h2 className="text-4xl md:text-6xl font-black text-white mb-6 leading-tight">
                            Votre Concurrent A Déjà<br />
                            Un Meilleur Site Que Vous
                        </h2>

                        <p className="text-2xl text-white mb-12 leading-relaxed max-w-3xl mx-auto">
                            Chaque jour sans site performant = des clients perdus au profit de vos concurrents.
                            <strong> Passez à l'action maintenant.</strong>
                        </p>

                        {/* Double CTA */}
                        <div className="flex flex-col sm:flex-row gap-6 justify-center mb-12">
                            <Link
                                href="/contact"
                                className="group inline-flex items-center justify-center gap-3 bg-gradient-to-r from-[#0099CC] to-[#00A86B] text-white px-12 py-6 rounded-full font-bold text-xl shadow-2xl hover:shadow-[#0099CC]/50 transform hover:scale-105 transition-all duration-300"
                            >
                                <svg className="w-7 h-7 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                <span>Je Veux Mon Devis Gratuit</span>
                            </Link>

                            <Link
                                href="/methode-travail"
                                className="group inline-flex items-center justify-center gap-3 bg-white/10 backdrop-blur-sm border-2 border-white/30 text-white px-12 py-6 rounded-full font-bold text-xl hover:bg-white/20 transform hover:scale-105 transition-all duration-300"
                            >
                                <span>Notre Méthode</span>
                                <svg className="w-6 h-6 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </Link>
                        </div>

                        {/* Garanties */}
                        <div className="grid md:grid-cols-3 gap-6 max-w-4xl mx-auto">
                            <div className="bg-white/5 backdrop-blur-sm rounded-2xl p-6 border border-white/10">
                                <svg className="w-12 h-12 text-[#00A86B] mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <h3 className="text-white font-bold text-lg mb-2">Satisfait ou Remboursé</h3>
                                <p className="text-blue-200 text-sm">Garantie 30 jours</p>
                            </div>

                            <div className="bg-white/5 backdrop-blur-sm rounded-2xl p-6 border border-white/10">
                                <svg className="w-12 h-12 text-[#0099CC] mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                <h3 className="text-white font-bold text-lg mb-2">Livraison Express</h3>
                                <p className="text-blue-200 text-sm">Premier rendu en 48h</p>
                            </div>

                            <div className="bg-white/5 backdrop-blur-sm rounded-2xl p-6 border border-white/10">
                                <svg className="w-12 h-12 text-[#00A86B] mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <h3 className="text-white font-bold text-lg mb-2">Paiement Flexible</h3>
                                <p className="text-blue-200 text-sm">En 3 fois sans frais</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </PublicLayout>
    );
}
