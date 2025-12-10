import { Link } from '@inertiajs/react';
import ClientLayout from '@/Layouts/ClientLayout';

export default function Dashboard({ stats, recentProjects, recentTickets }) {
    const getStatusBadgeClass = (status, type = 'project') => {
        if (type === 'project') {
            if (status === 'en-cours') return 'bg-green-100 text-green-800';
            if (status === 'terminé') return 'bg-blue-100 text-blue-800';
            return 'bg-gray-100 text-gray-800';
        } else {
            if (status === 'ouvert') return 'bg-red-100 text-red-800';
            if (status === 'en-cours') return 'bg-amber-100 text-amber-800';
            if (status === 'résolu') return 'bg-green-100 text-green-800';
            return 'bg-gray-100 text-gray-800';
        }
    };

    const getProgressBarClass = (progress) => {
        if (progress < 30) return 'bg-red-500';
        if (progress < 70) return 'bg-yellow-500';
        return 'bg-green-500';
    };

    const formatDate = (dateString) => {
        const date = new Date(dateString);
        return date.toLocaleDateString('fr-FR');
    };

    const truncate = (text, length = 100) => {
        if (!text) return '';
        return text.length > length ? text.substring(0, length) + '...' : text;
    };

    const statCards = [
        {
            title: 'PROJETS',
            value: stats.projectCount,
            gradient: 'from-blue-500 to-blue-600',
            textColor: 'text-blue-100',
            link: '/client/projects',
            icon: (
                <svg xmlns="http://www.w3.org/2000/svg" className="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            )
        },
        {
            title: 'PROJETS ACTIFS',
            value: stats.activeProjects,
            gradient: 'from-green-500 to-green-600',
            textColor: 'text-green-100',
            link: '/client/projects',
            icon: (
                <svg xmlns="http://www.w3.org/2000/svg" className="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            )
        },
        {
            title: 'TICKETS',
            value: stats.ticketCount,
            gradient: 'from-cyan-500 to-cyan-600',
            textColor: 'text-cyan-100',
            link: '/client/tickets',
            icon: (
                <svg xmlns="http://www.w3.org/2000/svg" className="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                </svg>
            )
        },
        {
            title: 'TICKETS OUVERTS',
            value: stats.openTickets,
            gradient: 'from-amber-500 to-amber-600',
            textColor: 'text-amber-100',
            link: '/client/tickets',
            icon: (
                <svg xmlns="http://www.w3.org/2000/svg" className="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            )
        }
    ];

    return (
        <ClientLayout pageTitle="Tableau de bord client">
            <div className="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
                {/* Statistiques */}
                <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                    {statCards.map((card, index) => (
                        <div key={index} className={`bg-gradient-to-br ${card.gradient} rounded-lg shadow-md overflow-hidden`}>
                            <div className="p-5">
                                <div className="flex items-center justify-between">
                                    <div>
                                        <h6 className={`text-xs font-bold uppercase tracking-wider mb-1 ${card.textColor}`}>
                                            {card.title}
                                        </h6>
                                        <h2 className="text-3xl font-bold text-white">{card.value}</h2>
                                    </div>
                                    <div className="ml-4 bg-white/10 p-3 rounded-lg">
                                        {card.icon}
                                    </div>
                                </div>
                                <div className="mt-4">
                                    <Link
                                        href={card.link}
                                        className="flex justify-between items-center text-white text-sm font-medium group hover:underline"
                                    >
                                        <span>Voir les détails</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" className="h-4 w-4 transform transition group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                        </svg>
                                    </Link>
                                </div>
                            </div>
                        </div>
                    ))}
                </div>

                <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    {/* Projets récents */}
                    <div className="bg-white rounded-lg shadow-md overflow-hidden">
                        <div className="flex justify-between items-center px-5 py-4 border-b border-gray-100">
                            <h2 className="text-lg font-semibold text-gray-800">Projets récents</h2>
                            <Link
                                href="/client/projects"
                                className="text-sm font-medium text-blue-600 hover:text-blue-700 flex items-center"
                            >
                                Voir tous
                                <svg xmlns="http://www.w3.org/2000/svg" className="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </Link>
                        </div>
                        <div className="p-5">
                            {recentProjects && recentProjects.length > 0 ? (
                                recentProjects.map((project) => (
                                    <Link
                                        key={project.id}
                                        href={`/client/projects/${project.id}`}
                                        className="block mb-3 last:mb-0 p-3 rounded-lg border border-gray-100 hover:bg-gray-50 transition-colors"
                                    >
                                        <div className="flex justify-between items-start">
                                            <h3 className="font-medium text-gray-800">{project.title}</h3>
                                            <span className={`ml-2 px-2.5 py-0.5 text-xs font-medium ${getStatusBadgeClass(project.status)} rounded-full`}>
                                                {project.status.charAt(0).toUpperCase() + project.status.slice(1)}
                                            </span>
                                        </div>
                                        <p className="text-sm text-gray-600 mt-1.5 leading-relaxed">
                                            {truncate(project.description)}
                                        </p>

                                        {/* Barre de progression */}
                                        <div className="mt-3">
                                            <div className="flex justify-between items-center mb-1">
                                                <span className="text-xs text-gray-500">Progression</span>
                                                <span className="text-xs font-medium text-gray-700">
                                                    {project.manual_progress || 0}%
                                                </span>
                                            </div>
                                            <div className="w-full bg-gray-200 rounded-full h-2">
                                                <div
                                                    className={`h-2 rounded-full transition-all duration-300 ${getProgressBarClass(project.manual_progress || 0)}`}
                                                    style={{ width: `${project.manual_progress || 0}%` }}
                                                ></div>
                                            </div>
                                        </div>

                                        <div className="mt-2 text-xs text-gray-500 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" className="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {formatDate(project.created_at)}
                                        </div>
                                    </Link>
                                ))
                            ) : (
                                <div className="py-12 text-center">
                                    <div className="bg-gray-50 inline-flex p-4 rounded-full mx-auto mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" className="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                    </div>
                                    <p className="text-gray-500 text-sm">Aucun projet récent</p>
                                    <Link
                                        href="/client/projects"
                                        className="mt-3 inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-700"
                                    >
                                        Voir tous les projets
                                        <svg xmlns="http://www.w3.org/2000/svg" className="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                        </svg>
                                    </Link>
                                </div>
                            )}
                        </div>
                    </div>

                    {/* Tickets récents */}
                    <div className="bg-white rounded-lg shadow-md overflow-hidden">
                        <div className="flex justify-between items-center px-5 py-4 border-b border-gray-100">
                            <h2 className="text-lg font-semibold text-gray-800">Tickets récents</h2>
                            <Link
                                href="/client/tickets"
                                className="text-sm font-medium text-blue-600 hover:text-blue-700 flex items-center"
                            >
                                Voir tous
                                <svg xmlns="http://www.w3.org/2000/svg" className="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </Link>
                        </div>
                        <div className="p-5">
                            {recentTickets && recentTickets.length > 0 ? (
                                recentTickets.map((ticket) => (
                                    <Link
                                        key={ticket.id}
                                        href={`/client/tickets/${ticket.id}`}
                                        className="block mb-3 last:mb-0 p-3 rounded-lg border border-gray-100 hover:bg-gray-50 transition-colors"
                                    >
                                        <div className="flex justify-between items-start">
                                            <h3 className="font-medium text-gray-800">{ticket.title}</h3>
                                            <span className={`ml-2 px-2.5 py-0.5 text-xs font-medium ${getStatusBadgeClass(ticket.status, 'ticket')} rounded-full`}>
                                                {ticket.status.charAt(0).toUpperCase() + ticket.status.slice(1)}
                                            </span>
                                        </div>
                                        <p className="text-sm text-gray-600 mt-1.5 leading-relaxed">
                                            {truncate(ticket.description)}
                                        </p>
                                        <div className="mt-2 text-xs text-gray-500 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" className="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {formatDate(ticket.created_at)}
                                        </div>
                                    </Link>
                                ))
                            ) : (
                                <div className="py-12 text-center">
                                    <div className="bg-gray-50 inline-flex p-4 rounded-full mx-auto mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" className="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                        </svg>
                                    </div>
                                    <p className="text-gray-500 text-sm">Aucun ticket récent</p>
                                    <Link
                                        href="/client/tickets"
                                        className="mt-3 inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-700"
                                    >
                                        Voir tous les tickets
                                        <svg xmlns="http://www.w3.org/2000/svg" className="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                        </svg>
                                    </Link>
                                </div>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </ClientLayout>
    );
}
