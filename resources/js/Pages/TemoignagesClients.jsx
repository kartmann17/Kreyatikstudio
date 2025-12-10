import PublicLayout from '@/Layouts/PublicLayout';

export default function TemoignagesClients({ seo }) {
    return (
        <PublicLayout seo={seo}>
            <div className="min-h-screen bg-gray-50 py-12">
                <div className="container mx-auto px-4">
                    <h1 className="text-4xl font-bold text-center mb-12">Témoignages Clients</h1>
                    <div className="max-w-4xl mx-auto">
                        <p className="text-center text-gray-600">Les témoignages seront affichés ici.</p>
                    </div>
                </div>
            </div>
        </PublicLayout>
    );
}
