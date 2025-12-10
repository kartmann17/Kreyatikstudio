import PublicLayout from '@/Layouts/PublicLayout';

export default function NosOffres({ pricingPlans, seo }) {
    return (
        <PublicLayout seo={seo}>
            <div className="min-h-screen bg-gray-50 py-12">
                <div className="container mx-auto px-4">
                    <h1 className="text-4xl font-bold text-center mb-4">Nos Offres</h1>
                    <p className="text-center text-gray-600 mb-12 max-w-2xl mx-auto">
                        Découvrez nos solutions adaptées à vos besoins
                    </p>

                    {pricingPlans && pricingPlans.length > 0 ? (
                        <div className="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                            {pricingPlans.map((plan) => (
                                <div key={plan.id} className={`bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition ${plan.is_highlighted ? 'border-2 border-blue-500 relative' : ''}`}>
                                    {plan.is_highlighted && (
                                        <div className="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-blue-500 text-white px-4 py-1 rounded-full text-sm font-semibold">
                                            {plan.highlight_text || 'Populaire'}
                                        </div>
                                    )}
                                    <h3 className="text-2xl font-bold mb-2">{plan.name}</h3>
                                    {plan.starting_text && (
                                        <p className="text-sm text-gray-500 mb-2">{plan.starting_text}</p>
                                    )}
                                    <div className="text-4xl font-bold text-blue-600 mb-6">
                                        {plan.is_custom_plan ? (
                                            <span className="text-2xl">{plan.custom_plan_text || 'Sur devis'}</span>
                                        ) : (
                                            <>
                                                {plan.monthly_price}€
                                                <span className="text-lg text-gray-600">/mois</span>
                                            </>
                                        )}
                                    </div>
                                    {plan.features && plan.features.length > 0 && (
                                        <ul className="space-y-2 mb-8">
                                            {plan.features.map((feature, index) => (
                                                <li key={index} className="flex items-start">
                                                    <span className="text-green-500 mr-2">✓</span>
                                                    <span>{feature}</span>
                                                </li>
                                            ))}
                                        </ul>
                                    )}
                                    <a
                                        href="/Contact"
                                        className="block w-full text-center bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition"
                                    >
                                        {plan.button_text || 'Choisir cette offre'}
                                    </a>
                                </div>
                            ))}
                        </div>
                    ) : (
                        <p className="text-center text-gray-600">Nos offres seront bientôt disponibles.</p>
                    )}
                </div>
            </div>
        </PublicLayout>
    );
}
