import { Link } from '@inertiajs/react';
import ClientLayout from '@/Layouts/ClientLayout';

export default function ProjectShow({ project, tasks, taskProgress }) {
    const getStatusBadgeClass = (status) => {
        switch (status) {
            case 'en attente':
                return 'bg-gray-100 text-gray-800';
            case 'en cours':
                return 'bg-blue-100 text-blue-800';
            case 'terminé':
                return 'bg-green-100 text-green-800';
            case 'annulé':
                return 'bg-red-100 text-red-800';
            default:
                return 'bg-indigo-100 text-indigo-800';
        }
    };

    const getPriorityBadgeClass = (priority) => {
        switch (priority) {
            case 'basse':
                return 'bg-blue-100 text-blue-800';
            case 'moyenne':
                return 'bg-yellow-100 text-yellow-800';
            case 'haute':
                return 'bg-red-100 text-red-800';
            default:
                return 'bg-gray-100 text-gray-800';
        }
    };

    const getProgressBarClass = (progress) => {
        if (progress < 30) return 'bg-red-500';
        if (progress < 70) return 'bg-yellow-500';
        return 'bg-green-500';
    };

    const formatDate = (dateString) => {
        if (!dateString) return 'Non définie';
        const date = new Date(dateString);
        return date.toLocaleDateString('fr-FR');
    };

    const calculateDaysRemaining = () => {
        if (!project.end_date) return 'Non défini';
        const endDate = new Date(project.end_date);
        const today = new Date();
        const diffTime = endDate - today;
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

        if (diffDays > 0) {
            return `${diffDays} jours`;
        } else if (diffDays < 0) {
            return `Dépassé de ${Math.abs(diffDays)} jours`;
        }
        return "Aujourd'hui";
    };

    const isDaysRemainingNegative = () => {
        if (!project.end_date) return false;
        const endDate = new Date(project.end_date);
        const today = new Date();
        return endDate < today;
    };

    const completedTasks = tasks.filter(t => t.is_completed).length;

    return (
        <ClientLayout pageTitle={project.name}>
            <div className="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
                {/* Breadcrumb */}
                <div className="mb-4">
                    <nav className="flex" aria-label="Breadcrumb">
                        <ol className="inline-flex items-center space-x-1 md:space-x-3">
                            <li className="inline-flex items-center">
                                <Link href="/client/dashboard" className="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                                    <i className="fas fa-home mr-2"></i>
                                    Tableau de bord
                                </Link>
                            </li>
                            <li>
                                <div className="flex items-center">
                                    <svg className="w-3 h-3 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fillRule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clipRule="evenodd"></path>
                                    </svg>
                                    <Link href="/client/projects" className="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">Projets</Link>
                                </div>
                            </li>
                            <li aria-current="page">
                                <div className="flex items-center">
                                    <svg className="w-3 h-3 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fillRule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clipRule="evenodd"></path>
                                    </svg>
                                    <span className="ml-1 text-sm font-medium text-gray-500 md:ml-2">{project.name}</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>

                <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    {/* Main Content */}
                    <div className="lg:col-span-2">
                        {/* Project Details */}
                        <div className="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                            <div className="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                                <h2 className="text-xl font-semibold text-gray-800">Détails du projet</h2>
                                <span className={`px-3 py-1 text-xs font-medium rounded-full ${getStatusBadgeClass(project.status)}`}>
                                    {project.status.charAt(0).toUpperCase() + project.status.slice(1)}
                                </span>
                            </div>
                            <div className="p-6">
                                <div className="mb-6">
                                    <h2 className="text-2xl font-bold text-gray-800 mb-2">{project.name}</h2>

                                    {/* Project Progress */}
                                    <div className="mb-4">
                                        <div className="flex justify-between items-center mb-2">
                                            <span className="text-sm font-medium text-gray-700">Progression du projet</span>
                                            <span className="text-sm font-bold text-gray-900">{project.manual_progress || 0}%</span>
                                        </div>
                                        <div className="w-full bg-gray-200 rounded-full h-3">
                                            <div
                                                className={`h-3 rounded-full transition-all duration-500 ${getProgressBarClass(project.manual_progress || 0)}`}
                                                style={{ width: `${project.manual_progress || 0}%` }}
                                            ></div>
                                        </div>
                                    </div>

                                    {/* Task Progress */}
                                    {tasks.length > 0 && (
                                        <div>
                                            <div className="flex justify-between items-center mb-2">
                                                <span className="text-sm text-gray-600">Progression des tâches</span>
                                                <span className="text-sm text-gray-600">{taskProgress}%</span>
                                            </div>
                                            <div className="w-full bg-gray-200 rounded-full h-2">
                                                <div className="bg-blue-500 h-2 rounded-full transition-all duration-300" style={{ width: `${taskProgress}%` }}></div>
                                            </div>
                                        </div>
                                    )}
                                </div>

                                <div className="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                    <div>
                                        <h6 className="text-sm font-medium text-gray-500 mb-1">Date de début</h6>
                                        <p className="text-gray-800">{formatDate(project.start_date)}</p>
                                    </div>
                                    <div>
                                        <h6 className="text-sm font-medium text-gray-500 mb-1">Date de fin</h6>
                                        <p className="text-gray-800">{formatDate(project.end_date)}</p>
                                    </div>
                                </div>

                                <div className="mb-6">
                                    <h6 className="text-sm font-medium text-gray-500 mb-1">Description</h6>
                                    <p className="text-gray-800">{project.description || 'Aucune description disponible.'}</p>
                                </div>

                                {project.notes && (
                                    <div className="mb-4">
                                        <h6 className="text-sm font-medium text-gray-500 mb-1">Notes</h6>
                                        <p className="text-gray-800">{project.notes}</p>
                                    </div>
                                )}
                            </div>
                        </div>

                        {/* Tasks */}
                        <div className="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                            <div className="px-6 py-4 border-b border-gray-200">
                                <h2 className="text-lg font-semibold text-gray-800">Tâches ({tasks.length})</h2>
                            </div>
                            <div className="p-6">
                                {tasks.length === 0 ? (
                                    <div className="text-center py-8">
                                        <div className="mx-auto bg-gray-100 rounded-full p-3 w-16 h-16 flex items-center justify-center mb-4">
                                            <i className="fas fa-tasks text-gray-400 text-2xl"></i>
                                        </div>
                                        <h5 className="text-lg font-medium text-gray-700 mb-1">Aucune tâche disponible</h5>
                                        <p className="text-gray-500 text-sm">Aucune tâche n'a encore été créée pour ce projet.</p>
                                    </div>
                                ) : (
                                    <div className="overflow-x-auto">
                                        <table className="min-w-full divide-y divide-gray-200">
                                            <thead className="bg-gray-50">
                                                <tr>
                                                    <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                                                    <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                                    <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Priorité</th>
                                                    <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Échéance</th>
                                                </tr>
                                            </thead>
                                            <tbody className="bg-white divide-y divide-gray-200">
                                                {tasks.map((task) => (
                                                    <tr key={task.id}>
                                                        <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{task.name}</td>
                                                        <td className="px-6 py-4 whitespace-nowrap">
                                                            <span className={`px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${task.is_completed ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'}`}>
                                                                {task.is_completed ? 'Terminée' : 'En cours'}
                                                            </span>
                                                        </td>
                                                        <td className="px-6 py-4 whitespace-nowrap">
                                                            <span className={`px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${getPriorityBadgeClass(task.priority)}`}>
                                                                {task.priority ? task.priority.charAt(0).toUpperCase() + task.priority.slice(1) : 'N/A'}
                                                            </span>
                                                        </td>
                                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{formatDate(task.due_date)}</td>
                                                    </tr>
                                                ))}
                                            </tbody>
                                        </table>
                                    </div>
                                )}
                            </div>
                        </div>
                    </div>

                    {/* Sidebar */}
                    <div className="lg:col-span-1">
                        {/* Team */}
                        <div className="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                            <div className="px-6 py-4 border-b border-gray-200">
                                <h2 className="text-lg font-semibold text-gray-800">Équipe du projet</h2>
                            </div>
                            <div className="p-6">
                                {project.assignedUsers && project.assignedUsers.length > 0 ? (
                                    <ul className="divide-y divide-gray-200">
                                        {project.assignedUsers.map((user, index) => (
                                            <li key={index} className="py-3 flex items-center">
                                                <div className="w-10 h-10 bg-blue-100 text-blue-800 rounded-full flex items-center justify-center font-medium mr-3">
                                                    {user.name.charAt(0)}
                                                </div>
                                                <div>
                                                    <p className="text-sm font-medium text-gray-900">{user.name}</p>
                                                    <p className="text-xs text-gray-500">{user.role}</p>
                                                </div>
                                            </li>
                                        ))}
                                    </ul>
                                ) : (
                                    <div className="text-center py-8">
                                        <div className="mx-auto bg-gray-100 rounded-full p-3 w-16 h-16 flex items-center justify-center mb-4">
                                            <i className="fas fa-users text-gray-400 text-2xl"></i>
                                        </div>
                                        <h5 className="text-lg font-medium text-gray-700 mb-1">Aucun membre assigné</h5>
                                        <p className="text-gray-500 text-sm">Aucun membre n'a encore été assigné à ce projet.</p>
                                    </div>
                                )}
                            </div>
                        </div>

                        {/* Statistics */}
                        <div className="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                            <div className="px-6 py-4 border-b border-gray-200">
                                <h2 className="text-lg font-semibold text-gray-800">Statistiques</h2>
                            </div>
                            <div className="p-6">
                                <div className="mb-4">
                                    <h6 className="text-sm font-medium text-gray-500 mb-1">Tâches terminées</h6>
                                    <p className="text-gray-800 font-medium">{completedTasks} / {tasks.length}</p>
                                </div>
                                <div className="mb-4">
                                    <h6 className="text-sm font-medium text-gray-500 mb-1">Jours restants</h6>
                                    <p className={`font-medium ${isDaysRemainingNegative() ? 'text-red-600' : 'text-gray-800'}`}>
                                        {calculateDaysRemaining()}
                                    </p>
                                </div>
                                {project.budget && (
                                    <div>
                                        <h6 className="text-sm font-medium text-gray-500 mb-1">Budget</h6>
                                        <p className="text-gray-800 font-medium">
                                            {new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(project.budget)}
                                        </p>
                                    </div>
                                )}
                            </div>
                        </div>

                        {/* Support */}
                        <div className="bg-white rounded-lg shadow-md overflow-hidden">
                            <div className="px-6 py-4 border-b border-gray-200">
                                <h2 className="text-lg font-semibold text-gray-800">Support</h2>
                            </div>
                            <div className="p-6">
                                <p className="text-gray-600 mb-4">Vous avez des questions ou besoin d'aide concernant ce projet?</p>
                                <Link
                                    href={`/client/tickets/create?project_id=${project.id}`}
                                    className="inline-flex items-center justify-center w-full px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors"
                                >
                                    <i className="fas fa-ticket-alt mr-2"></i> Créer un nouveau ticket
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </ClientLayout>
    );
}
