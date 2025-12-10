import { Link } from '@inertiajs/react';
import { Head } from '@inertiajs/react';
import PublicLayout from '@/Layouts/PublicLayout';

export default function BlogIndex({ articles, seo }) {
    // Fonction pour formater la date en français
    const formatDate = (dateString) => {
        if (!dateString) return '';
        const date = new Date(dateString);
        return date.toLocaleDateString('fr-FR', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    };

    // Fonction pour calculer le temps de lecture
    const calculateReadingTime = (content) => {
        if (!content) return '5 min';
        const wordsPerMinute = 200;
        const textLength = content.replace(/<[^>]*>/g, '').split(/\s+/).length;
        const minutes = Math.ceil(textLength / wordsPerMinute);
        return `${minutes} min`;
    };

    return (
        <PublicLayout seo={seo}>
            <Head>
                <title>{seo?.title || 'Blog - Kréyatik Studio'}</title>
                <meta name="description" content={seo?.description || "Découvrez nos articles, conseils et actualités sur le développement web, le design et le marketing digital."} />
            </Head>

            {/* Hero Section */}
            <div className="relative bg-gradient-to-br from-blue-900 to-blue-800 text-white py-20 overflow-hidden">
                <div className="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PHBhdGggZD0iTTM2IDE0YzAtNi42MjctNS4zNzMtMTItMTItMTJTMTIgNy4zNzMgMTIgMTRzNS4zNzMgMTIgMTIgMTIgMTItNS4zNzMgMTItMTJ6Ii8+PC9nPjwvZz48L3N2Zz4=')] opacity-20"></div>
                <div className="container mx-auto px-4 text-center relative z-10">
                    <div className="inline-block bg-white/10 backdrop-blur-sm rounded-full px-6 py-2 mb-6 animate-fade-in">
                        <span className="text-sm font-medium tracking-wide">Notre Blog</span>
                    </div>
                    <h1 className="text-4xl md:text-6xl font-bold mb-6 animate-fade-in">
                        Actualités & Conseils
                    </h1>
                    <p className="text-xl md:text-2xl text-blue-100 max-w-3xl mx-auto animate-fade-in animation-delay-200">
                        Découvrez nos articles, guides et actualités sur le développement web, le design et le marketing digital
                    </p>
                </div>
            </div>

            {/* Articles Grid */}
            <div className="bg-gradient-to-b from-gray-50 to-white py-16">
                <div className="container mx-auto px-4">
                    {articles.data && articles.data.length > 0 ? (
                        <>
                            {/* Featured Article (premier article) */}
                            {articles.data[0] && (
                                <Link
                                    href={`/blog/${articles.data[0].slug}`}
                                    className="block mb-16 group"
                                >
                                    <div className="bg-white rounded-2xl shadow-xl overflow-hidden transform hover:scale-[1.02] transition-all duration-300 hover:shadow-2xl">
                                        <div className="grid md:grid-cols-2 gap-0">
                                            <div className="relative h-64 md:h-auto overflow-hidden">
                                                {articles.data[0].featured_image ? (
                                                    <img
                                                        src={articles.data[0].featured_image}
                                                        alt={articles.data[0].title}
                                                        className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                                    />
                                                ) : (
                                                    <div className="w-full h-full bg-gradient-to-br from-[#0099CC] to-[#00A86B]"></div>
                                                )}
                                                <div className="absolute top-4 left-4">
                                                    <span className="inline-block bg-gradient-to-r from-[#0099CC] to-[#00A86B] text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                                                        ⭐ Article Vedette
                                                    </span>
                                                </div>
                                            </div>
                                            <div className="p-8 md:p-12 flex flex-col justify-center">
                                                <div className="flex items-center gap-4 mb-4 text-sm text-gray-600">
                                                    <span className="flex items-center gap-1">
                                                        <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                        {formatDate(articles.data[0].published_at)}
                                                    </span>
                                                    <span className="flex items-center gap-1">
                                                        <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        {calculateReadingTime(articles.data[0].content)}
                                                    </span>
                                                </div>
                                                <h2 className="text-3xl md:text-4xl font-bold mb-4 text-gray-900 group-hover:text-[#0099CC] transition-colors">
                                                    {articles.data[0].title}
                                                </h2>
                                                <p className="text-gray-600 text-lg mb-6 line-clamp-3">
                                                    {articles.data[0].excerpt}
                                                </p>
                                                <div className="flex items-center gap-2 text-[#0099CC] font-semibold group-hover:gap-4 transition-all">
                                                    <span>Lire l'article</span>
                                                    <svg className="w-5 h-5 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </Link>
                            )}

                            {/* Autres Articles */}
                            {articles.data.length > 1 && (
                                <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                                    {articles.data.slice(1).map((article) => (
                                        <Link
                                            key={article.id}
                                            href={`/blog/${article.slug}`}
                                            className="group"
                                        >
                                            <article className="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:scale-[1.03] transition-all duration-300 hover:shadow-2xl h-full flex flex-col">
                                                <div className="relative h-56 overflow-hidden">
                                                    {article.featured_image ? (
                                                        <img
                                                            src={article.featured_image}
                                                            alt={article.title}
                                                            className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                                        />
                                                    ) : (
                                                        <div className="w-full h-full bg-gradient-to-br from-[#0099CC] to-[#00A86B]"></div>
                                                    )}
                                                    <div className="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                                </div>

                                                <div className="p-6 flex-1 flex flex-col">
                                                    <div className="flex items-center gap-3 mb-3 text-sm text-gray-500">
                                                        <span className="flex items-center gap-1">
                                                            <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                            </svg>
                                                            {formatDate(article.published_at)}
                                                        </span>
                                                        <span className="flex items-center gap-1">
                                                            <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                            {calculateReadingTime(article.content)}
                                                        </span>
                                                    </div>

                                                    <h3 className="text-xl font-bold mb-3 text-gray-900 group-hover:text-[#0099CC] transition-colors line-clamp-2">
                                                        {article.title}
                                                    </h3>

                                                    <p className="text-gray-600 mb-4 line-clamp-3 flex-1">
                                                        {article.excerpt}
                                                    </p>

                                                    <div className="flex items-center gap-2 text-[#0099CC] font-semibold mt-auto group-hover:gap-3 transition-all">
                                                        <span>Lire la suite</span>
                                                        <svg className="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 5l7 7-7 7" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </article>
                                        </Link>
                                    ))}
                                </div>
                            )}
                        </>
                    ) : (
                        <div className="text-center py-20">
                            <div className="inline-block p-8 bg-white rounded-2xl shadow-lg">
                                <svg className="w-20 h-20 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                </svg>
                                <p className="text-xl text-gray-600 font-medium">Aucun article disponible pour le moment</p>
                                <p className="text-gray-500 mt-2">Revenez bientôt pour découvrir nos nouveaux contenus</p>
                            </div>
                        </div>
                    )}

                    {/* Pagination */}
                    {articles.links && articles.links.length > 3 && (
                        <div className="mt-16 flex justify-center items-center gap-2">
                            {articles.links.map((link, index) => {
                                const isActive = link.active;
                                const isDisabled = !link.url;

                                return (
                                    <Link
                                        key={index}
                                        href={link.url || '#'}
                                        disabled={isDisabled}
                                        className={`
                                            px-4 py-2 rounded-lg font-medium transition-all duration-200
                                            ${isActive
                                                ? 'bg-gradient-to-r from-[#0099CC] to-[#00A86B] text-white shadow-lg scale-110'
                                                : isDisabled
                                                    ? 'bg-gray-200 text-gray-400 cursor-not-allowed'
                                                    : 'bg-white text-gray-700 hover:bg-gray-50 hover:text-[#0099CC] shadow hover:shadow-md'
                                            }
                                        `}
                                        dangerouslySetInnerHTML={{ __html: link.label }}
                                    />
                                );
                            })}
                        </div>
                    )}
                </div>
            </div>
        </PublicLayout>
    );
}
