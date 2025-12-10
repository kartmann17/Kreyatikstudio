import { Link, router } from '@inertiajs/react';
import ClientLayout from '@/Layouts/ClientLayout';
import { useState } from 'react';

export default function TicketsIndex({ tickets, stats, status: currentStatus }) {
    const [searchTerm, setSearchTerm] = useState('');

    const handleSearch = (e) => {
        e.preventDefault();
        router.get('/client/tickets', { search: searchTerm, status: currentStatus });
    };

    const filterByStatus = (status) => {
        router.get('/client/tickets', { status });
    };

    const getStatusBadgeClass = (status) => {
        switch (status) {
            case 'ouvert':
                return 'bg-red-100 text-red-800';
            case 'en-cours':
            case 'en cours':
                return 'bg-amber-100 text-amber-800';
            case 'résolu':
                return 'bg-green-100 text-green-800';
            case 'fermé':
                return 'bg-gray-100 text-gray-800';
            default:
                return 'bg-blue-100 text-blue-800';
        }
    };

    const getPriorityBadgeClass = (priority) => {
        switch (priority) {
            case 'basse':
                return 'bg-blue-100 text-blue-800';
            case 'moyenne':
                return 'bg-yellow-100 text-yellow-800';
            case 'haute':
                return 'bg-orange-100 text-orange-800';
            case 'urgente':
                return 'bg-red-100 text-red-800';
            default:
                return 'bg-gray-100 text-gray-800';
        }
    };

    const formatDate = (dateString) => {
        const date = new Date(dateString);
        return date.toLocaleDateString('fr-FR');
    };

    return (
        <ClientLayout pageTitle="Mes Tickets">
            <div className="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
                {/* Stats */}
                <div className="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
                    <div className="bg-white rounded-lg shadow-md p-4">
                        <div className="text-sm font-medium text-gray-500">Total</div>
                        <div className="text-2xl font-bold text-gray-800">{stats.total}</div>
                    </div>
                    <div className="bg-white rounded-lg shadow-md p-4">
                        <div className="text-sm font-medium text-gray-500">Ouvert</div>
                        <div className="text-2xl font-bold text-red-600">{stats.open}</div>
                    </div>
                    <div className="bg-white rounded-lg shadow-md p-4">
                        <div className="text-sm font-medium text-gray-500">En cours</div>
                        <div className="text-2xl font-bold text-amber-600">{stats.in_progress}</div>
                    </div>
                    <div className="bg-white rounded-lg shadow-md p-4">
                        <div className="text-sm font-medium text-gray-500">Résolu</div>
                        <div className="text-2xl font-bold text-green-600">{stats.resolved}</div>
                    </div>
                    <div className="bg-white rounded-lg shadow-md p-4">
                        <div className="text-sm font-medium text-gray-500">Fermé</div>
                        <div className="text-2xl font-bold text-gray-600">{stats.closed}</div>
                    </div>
                </div>

                {/* Actions & Filters */}
                <div className="bg-white rounded-lg shadow-md p-4 mb-6">
                    <div className="flex flex-col md:flex-row gap-4 justify-between items-center">
                        <form onSubmit={handleSearch} className="flex gap-2 w-full md:w-auto">
                            <input
                                type="text"
                                placeholder="Rechercher..."
                                value={searchTerm}
                                onChange={(e) => setSearchTerm(e.target.value)}
                                className="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            />
                            <button
                                type="submit"
                                className="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
                            >
                                Rechercher
                            </button>
                        </form>
                        <Link
                            href="/client/tickets/create"
                            className="inline-flex items-center px-4 py-2 bg-green-600 text-white font-medium rounded-md hover:bg-green-700"
                        >
                            <i className="fas fa-plus mr-2"></i>
                            Nouveau ticket
                        </Link>
                    </div>
                </div>

                {/* Tickets List */}
                <div className="bg-white rounded-lg shadow-md overflow-hidden">
                    <div className="border-b border-gray-200 px-5 py-4">
                        <h2 className="text-lg font-semibold text-gray-800">Liste des tickets</h2>
                    </div>
                    <div className="p-5">
                        {tickets.data && tickets.data.length > 0 ? (
                            <div className="overflow-x-auto">
                                <table className="min-w-full divide-y divide-gray-200">
                                    <thead className="bg-gray-50">
                                        <tr>
                                            <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Numéro</th>
                                            <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Titre</th>
                                            <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Projet</th>
                                            <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Priorité</th>
                                            <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                                            <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                            <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody className="bg-white divide-y divide-gray-200">
                                        {tickets.data.map((ticket) => (
                                            <tr key={ticket.id} className="hover:bg-gray-50">
                                                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    #{ticket.ticket_number || ticket.id}
                                                </td>
                                                <td className="px-6 py-4 text-sm font-medium text-gray-900">
                                                    {ticket.title}
                                                </td>
                                                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {ticket.project?.name || 'N/A'}
                                                </td>
                                                <td className="px-6 py-4 whitespace-nowrap">
                                                    <span className={`px-2 py-1 text-xs font-semibold rounded-full ${getPriorityBadgeClass(ticket.priority)}`}>
                                                        {ticket.priority.charAt(0).toUpperCase() + ticket.priority.slice(1)}
                                                    </span>
                                                </td>
                                                <td className="px-6 py-4 whitespace-nowrap">
                                                    <span className={`px-2 py-1 text-xs font-semibold rounded-full ${getStatusBadgeClass(ticket.status)}`}>
                                                        {ticket.status.charAt(0).toUpperCase() + ticket.status.slice(1)}
                                                    </span>
                                                </td>
                                                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {formatDate(ticket.created_at)}
                                                </td>
                                                <td className="px-6 py-4 whitespace-nowrap text-sm">
                                                    <Link
                                                        href={`/client/tickets/${ticket.id}`}
                                                        className="text-blue-600 hover:text-blue-900"
                                                    >
                                                        Voir
                                                    </Link>
                                                </td>
                                            </tr>
                                        ))}
                                    </tbody>
                                </table>
                            </div>
                        ) : (
                            <div className="text-center py-12">
                                <p className="text-gray-500">Aucun ticket trouvé</p>
                            </div>
                        )}
                    </div>
                </div>
            </div>
        </ClientLayout>
    );
}
