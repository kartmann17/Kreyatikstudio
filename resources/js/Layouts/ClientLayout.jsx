import { useState } from 'react';
import { Link, usePage, router } from '@inertiajs/react';

export default function ClientLayout({ children, pageTitle = 'Espace Client' }) {
    const { auth, flash } = usePage().props;
    const [sidebarCollapsed, setSidebarCollapsed] = useState(false);
    const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
    const [userDropdownOpen, setUserDropdownOpen] = useState(false);

    const navigation = [
        {
            name: 'Tableau de bord',
            href: '/client/dashboard',
            icon: 'fa-tachometer-alt',
            active: route().current('client.dashboard')
        },
        {
            name: 'Mon profil',
            href: '/client/profile',
            icon: 'fa-user',
            active: route().current('client.profile.*')
        },
        {
            name: 'Mes projets',
            href: '/client/projects',
            icon: 'fa-project-diagram',
            active: route().current('client.projects.*')
        },
        {
            name: 'Mes tickets',
            href: '/client/tickets',
            icon: 'fa-bug',
            active: route().current('client.tickets.*')
        },
        {
            name: 'Retour au site',
            href: '/',
            icon: 'fa-home',
            active: false
        },
    ];

    const handleLogout = (e) => {
        e.preventDefault();
        router.post('/logout');
    };

    const getAvatarUrl = () => {
        return auth.user?.profile_photo_url ||
            `https://ui-avatars.com/api/?name=${encodeURIComponent(auth.user?.name || 'User')}&color=7F9CF5&background=EBF4FF`;
    };

    return (
        <div className="flex h-screen overflow-hidden">
            {/* Desktop Sidebar */}
            <aside className={`${sidebarCollapsed ? 'w-20' : 'w-64'} bg-gray-800 text-white hidden md:block transition-all duration-200`}>
                <div className="flex flex-col h-full">
                    {/* Logo */}
                    <div className="flex items-center justify-center h-16 px-4 bg-gray-900">
                        <div className="flex items-center">
                            <img src="/images/Studiosansfond.png" alt="Kréyatik Studio" className="h-8 w-auto" />
                            {!sidebarCollapsed && (
                                <span className="ml-2 text-xl font-bold">Kréyatik Studio</span>
                            )}
                        </div>
                    </div>

                    {/* User Profile */}
                    <div className="flex items-center p-4 border-b border-gray-700">
                        <div className="flex-shrink-0">
                            <img
                                className="h-10 w-10 rounded-full"
                                src={getAvatarUrl()}
                                alt={auth.user?.name}
                            />
                        </div>
                        {!sidebarCollapsed && (
                            <div className="ml-3">
                                <p className="text-sm font-medium text-white">{auth.user?.name}</p>
                                <p className="text-xs text-gray-400">Client</p>
                            </div>
                        )}
                    </div>

                    {/* Navigation */}
                    <nav className="mt-4 flex-grow overflow-y-auto">
                        <ul className="px-2">
                            {navigation.map((item) => (
                                <li key={item.name} className="mb-1">
                                    <Link
                                        href={item.href}
                                        className={`flex items-center px-4 py-2 rounded-lg ${
                                            item.active
                                                ? 'bg-gray-900 text-white'
                                                : 'text-gray-400 hover:text-white hover:bg-gray-700'
                                        }`}
                                    >
                                        <i className={`fas ${item.icon} w-5 h-5 mr-3`}></i>
                                        {!sidebarCollapsed && <span>{item.name}</span>}
                                    </Link>
                                </li>
                            ))}
                        </ul>
                    </nav>

                    {/* Logout */}
                    <div className="p-4 border-t border-gray-700">
                        <button
                            onClick={handleLogout}
                            className="flex items-center w-full px-4 py-2 rounded-lg text-gray-400 hover:text-white hover:bg-gray-700"
                        >
                            <i className="fas fa-sign-out-alt w-5 h-5 mr-3"></i>
                            {!sidebarCollapsed && <span>Déconnexion</span>}
                        </button>
                    </div>
                </div>
            </aside>

            {/* Mobile Sidebar Overlay */}
            {mobileMenuOpen && (
                <div className="fixed inset-0 bg-gray-800 bg-opacity-75 z-40 md:hidden">
                    <div className="relative pt-4 pb-3 h-full overflow-y-auto bg-gray-800 w-64">
                        {/* Mobile Header */}
                        <div className="flex items-center justify-between px-4">
                            <div className="flex items-center">
                                <img src="/images/Studiosansfond.png" alt="Kréyatik Studio" className="h-8 w-auto mr-2" />
                                <span className="text-xl font-bold text-white">Kréyatik Studio</span>
                            </div>
                            <button
                                onClick={() => setMobileMenuOpen(false)}
                                className="text-gray-400 hover:text-white"
                            >
                                <i className="fas fa-times text-lg"></i>
                            </button>
                        </div>

                        {/* Mobile User Profile */}
                        <div className="flex items-center p-4 border-b border-gray-700">
                            <img className="h-10 w-10 rounded-full" src={getAvatarUrl()} alt={auth.user?.name} />
                            <div className="ml-3">
                                <p className="text-sm font-medium text-white">{auth.user?.name}</p>
                                <p className="text-xs text-gray-400">Client</p>
                            </div>
                        </div>

                        {/* Mobile Navigation */}
                        <nav className="mt-4">
                            <ul className="px-2">
                                {navigation.map((item) => (
                                    <li key={item.name} className="mb-1">
                                        <Link
                                            href={item.href}
                                            className={`flex items-center px-4 py-2 rounded-lg ${
                                                item.active
                                                    ? 'bg-gray-900 text-white'
                                                    : 'text-gray-400 hover:text-white hover:bg-gray-700'
                                            }`}
                                            onClick={() => setMobileMenuOpen(false)}
                                        >
                                            <i className={`fas ${item.icon} w-5 h-5 mr-3`}></i>
                                            <span>{item.name}</span>
                                        </Link>
                                    </li>
                                ))}
                            </ul>
                        </nav>

                        {/* Mobile Logout */}
                        <div className="p-4 mt-6 border-t border-gray-700">
                            <button
                                onClick={handleLogout}
                                className="flex items-center w-full px-4 py-2 rounded-lg text-gray-400 hover:text-white hover:bg-gray-700"
                            >
                                <i className="fas fa-sign-out-alt w-5 h-5 mr-3"></i>
                                <span>Déconnexion</span>
                            </button>
                        </div>
                    </div>
                </div>
            )}

            {/* Main Content */}
            <div className="flex flex-col flex-1 overflow-hidden">
                {/* Top Navbar */}
                <header className="bg-white shadow-sm z-10">
                    <div className="flex items-center justify-between h-16 px-4 md:px-6">
                        {/* Mobile menu button */}
                        <button
                            onClick={() => setMobileMenuOpen(true)}
                            className="md:hidden text-gray-600 hover:text-gray-900"
                        >
                            <i className="fas fa-bars text-lg"></i>
                        </button>

                        {/* Desktop sidebar toggle */}
                        <button
                            onClick={() => setSidebarCollapsed(!sidebarCollapsed)}
                            className="hidden md:block text-gray-600 hover:text-gray-900"
                        >
                            <i className="fas fa-bars text-lg"></i>
                        </button>

                        <h1 className="text-xl font-bold text-gray-800 md:ml-4">{pageTitle}</h1>

                        {/* User dropdown */}
                        <div className="relative">
                            <button
                                onClick={() => setUserDropdownOpen(!userDropdownOpen)}
                                className="flex items-center focus:outline-none"
                            >
                                <span className="hidden md:block mr-2 text-sm text-gray-700">{auth.user?.name}</span>
                                <img className="h-8 w-8 rounded-full" src={getAvatarUrl()} alt={auth.user?.name} />
                            </button>

                            {/* Dropdown menu */}
                            {userDropdownOpen && (
                                <div className="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                                    <Link
                                        href="/client/profile"
                                        className="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        onClick={() => setUserDropdownOpen(false)}
                                    >
                                        Mon profil
                                    </Link>
                                    <div className="border-t border-gray-100"></div>
                                    <button
                                        onClick={handleLogout}
                                        className="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    >
                                        Déconnexion
                                    </button>
                                </div>
                            )}
                        </div>
                    </div>
                </header>

                {/* Main content area */}
                <main className="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50">
                    {/* Flash messages */}
                    {flash?.success && (
                        <div className="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 m-4" role="alert">
                            <p>{flash.success}</p>
                        </div>
                    )}

                    {flash?.error && (
                        <div className="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 m-4" role="alert">
                            <p>{flash.error}</p>
                        </div>
                    )}

                    {/* Page Content */}
                    {children}
                </main>
            </div>
        </div>
    );
}
