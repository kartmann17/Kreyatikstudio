<?php

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Contrôleurs d'authentification
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

// Contrôleurs publics
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NosOffresController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\PortfolioPublicController;
use App\Http\Controllers\LegalController;

// Contrôleurs d'administration
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\TimerController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\StatsController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\PricingPlanController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ArticleController;

// Route API pour publication d'article depuis n8n
use App\Http\Controllers\Api\ArticleController as ApiArticleController;

// Sitemap
use App\Http\Controllers\SitemapController;


/*
|--------------------------------------------------------------------------
| ROUTES PUBLIQUES
|--------------------------------------------------------------------------
*/

// Page d'accueil
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

//Page Mention Légale
Route::get('/MentionLegal', [LegalController::class, 'mentionsLegales'])->name('mentionslegales');

//Plan du site
Route::get('/plandusite', [LegalController::class, 'planDuSite'])->name('plan-du-site');

//Page CGV
Route::get('/CGV', [LegalController::class, 'cgv'])->name('cgv');

//Page confidentialité
Route::get('/confidentialite', [LegalController::class, 'confidentialite'])->name('confidentialite');


// Pages statiques
Route::get('/NosOffres', [NosOffresController::class, 'index'])->name('nos-offres');

// Blog public
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{article:slug}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/ConditionTarifaire', [LegalController::class, 'conditionsTarifaires'])->name('conditions-tarifaires');

// Page portfolio publique avec récupération des données
Route::get('/Portfolio', [PortfolioPublicController::class, 'index'])->name('portfolio');

// Page de contact
Route::get('/Contact', [LegalController::class, 'contact'])->name('contact');
Route::post('/contact/send', [ContactController::class, 'send'])
    ->middleware('throttle:3,60') // 3 tentatives par heure par IP
    ->name('send.email');

// Pages E-E-A-T
Route::get('/a-propos', [LegalController::class, 'aPropos'])->name('a-propos');
Route::get('/methode-travail', [LegalController::class, 'methodeTravail'])->name('methode-travail');
Route::get('/temoignages-clients', [LegalController::class, 'temoignagesClients'])->name('temoignages-clients');

// Redirection SEO : /home vers / (éviter contenu dupliqué)
Route::get('/home', function () {
    return redirect('/', 301);
})->name('home');

/*
|--------------------------------------------------------------------------
| ROUTES D'AUTHENTIFICATION
|--------------------------------------------------------------------------
*/

// Routes d'authentification automatiques Laravel avec vérification email
Auth::routes(['verify' => true]);

// Routes d'authentification personnalisées
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Routes de réinitialisation de mot de passe
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

/*
|--------------------------------------------------------------------------
| ROUTES POUR TOUS LES UTILISATEURS AUTHENTIFIÉS
|--------------------------------------------------------------------------
*/

// Redirection après connexion selon le rôle
Route::middleware(['auth', 'verified'])->group(function () {
    // Redirection vers le dashboard approprié selon le rôle
    Route::get('/dashboard', function () {
        $user = Auth::user();
        if ($user->isAdmin() || $user->isStaff()) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('client.dashboard');
        }
    })->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| ROUTES D'ADMINISTRATION (protégées par auth)
|--------------------------------------------------------------------------
*/

// Dashboard et pages principales
Route::middleware(['auth', 'verified', 'role:admin,staff'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Gestion des projets avec timer
    Route::get('/projects-timer', [DashboardController::class, 'projectsTimer'])->name('projects.timer');

    /*
    |--------------------------------------------------------------------------
    | GESTION DES ARTICLES
    |--------------------------------------------------------------------------
    */
    Route::resource('articles', ArticleController::class);
    Route::post('articles/{article}/toggle-publish', [ArticleController::class, 'togglePublish'])->name('articles.toggle-publish');

    /*
    |--------------------------------------------------------------------------
    | PROFIL ADMINISTRATEUR
    |--------------------------------------------------------------------------
    */
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::put('/update', [ProfileController::class, 'update'])->name('update');
        Route::put('/update-password', [ProfileController::class, 'updatePassword'])->name('update-password');
        Route::put('/update-preferences', [ProfileController::class, 'updatePreferences'])->name('update-preferences');
    });

    /*
    |--------------------------------------------------------------------------
    | GESTION DES PROJETS
    |--------------------------------------------------------------------------
    */
    Route::prefix('projects')->name('projects.')->group(function () {
        Route::get('/', [ProjectController::class, 'index'])->name('index');
        Route::get('/create', [ProjectController::class, 'create'])->name('create');
        Route::post('/', [ProjectController::class, 'store'])->name('store');
        Route::get('/{id}', [ProjectController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [ProjectController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ProjectController::class, 'update'])->name('update');
        Route::delete('/{id}', [ProjectController::class, 'destroy'])->name('destroy');
        Route::put('/{id}/update-status', [ProjectController::class, 'updateStatus'])->name('update-status');
    });

    /*
    |--------------------------------------------------------------------------
    | GESTION DES TÂCHES
    |--------------------------------------------------------------------------
    */
    Route::prefix('tasks')->name('tasks.')->group(function () {
        Route::get('/', [TaskController::class, 'index'])->name('index');
        Route::post('/', [TaskController::class, 'store'])->name('store');
        Route::get('/{id}', [TaskController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [TaskController::class, 'edit'])->name('edit');
        Route::put('/{id}', [TaskController::class, 'update'])->name('update');
        Route::delete('/{id}', [TaskController::class, 'destroy'])->name('destroy');
        Route::get('/project/{projectId}', [TaskController::class, 'getTasksByProject'])->name('by-project');
        Route::post('/update-progress', [TaskController::class, 'updateProgress'])->name('update.progress');
    });

    /*
    |--------------------------------------------------------------------------
    | GESTION DU TEMPS ET TIMERS
    |--------------------------------------------------------------------------
    */
    Route::prefix('timer')->name('timer.')->group(function () {
        Route::get('/', [TimerController::class, 'index'])->name('index');
        Route::post('/store', [TimerController::class, 'store'])->name('store');
        Route::post('/log-time', [TimerController::class, 'logTime'])->name('logTime');
        Route::get('/logs/{period?}', [TimerController::class, 'getLogs'])->name('logs');
        Route::put('/{id}', [TimerController::class, 'update'])->name('update');
        Route::delete('/{id}', [TimerController::class, 'destroy'])->name('destroy');
    });

    // Route pour l'enregistrement du temps depuis d'autres vues
    Route::post('/time/log', [TimerController::class, 'logTime'])->name('time.log');

    /*
    |--------------------------------------------------------------------------
    | GESTION DES CLIENTS
    |--------------------------------------------------------------------------
    */
    Route::prefix('clients')->name('clients.')->group(function () {
        Route::get('/', [ClientController::class, 'index'])->name('index');
        Route::get('/create', [ClientController::class, 'create'])->name('create');
        Route::post('/', [ClientController::class, 'store'])->name('store');
        Route::get('/{id}', [ClientController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [ClientController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ClientController::class, 'update'])->name('update');
        Route::delete('/{id}', [ClientController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/assign-project', [ClientController::class, 'assignToProject'])->name('assign-project');
    });

    /*
    |--------------------------------------------------------------------------
    | GESTION DU PORTFOLIO
    |--------------------------------------------------------------------------
    */
    Route::prefix('portfolio')->name('portfolio.')->group(function () {
        Route::get('/', [PortfolioController::class, 'index'])->name('index');
        Route::get('/create', [PortfolioController::class, 'create'])->name('create');
        Route::post('/', [PortfolioController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PortfolioController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PortfolioController::class, 'update'])->name('update');
        Route::delete('/{id}', [PortfolioController::class, 'destroy'])->name('destroy');
        Route::post('/order', [PortfolioController::class, 'updateOrder'])->name('order');
        Route::put('/{id}/visibility', [PortfolioController::class, 'toggleVisibility'])->name('visibility');
    });

    /*
    |--------------------------------------------------------------------------
    | GESTION DES DÉPENSES
    |--------------------------------------------------------------------------
    */
    Route::prefix('expenses')->name('expenses.')->group(function () {
        Route::get('/', [ExpenseController::class, 'index'])->name('index');
        Route::get('/create', [ExpenseController::class, 'create'])->name('create');
        Route::post('/', [ExpenseController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ExpenseController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ExpenseController::class, 'update'])->name('update');
        Route::delete('/{id}', [ExpenseController::class, 'destroy'])->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | GESTION DES MESSAGES DE CONTACT
    |--------------------------------------------------------------------------
    */
    Route::prefix('contact-messages')->name('contact-messages.')->group(function () {
        Route::get('/', [ContactMessageController::class, 'index'])->name('index');
        Route::get('/unread-count', [ContactMessageController::class, 'getUnreadCount'])->name('unread-count');
        Route::get('/{id}', [ContactMessageController::class, 'show'])->name('show');
        Route::put('/{id}/mark-as-read', [ContactMessageController::class, 'markAsRead'])->name('mark-as-read');
        Route::post('/mark-multiple-as-read', [ContactMessageController::class, 'markMultipleAsRead'])->name('mark-multiple-as-read');
        Route::delete('/{id}', [ContactMessageController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/reply', [ContactMessageController::class, 'reply'])->name('reply');
    });

    /*
    |--------------------------------------------------------------------------
    | STATISTIQUES ET RAPPORTS
    |--------------------------------------------------------------------------
    */
    Route::prefix('stats')->name('stats.')->group(function () {
        Route::get('/', [StatsController::class, 'index'])->name('index');
        Route::post('/report', [StatsController::class, 'generateReport'])->name('report');
    });

    /*
    |--------------------------------------------------------------------------
    | PARAMÈTRES
    |--------------------------------------------------------------------------
    */
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('index');
        Route::put('/update', [SettingsController::class, 'updateAccount'])->name('update');
        Route::put('/seo', [SettingsController::class, 'updateSeo'])->name('seo');
        Route::put('/seo/page/{page}', [SettingsController::class, 'updatePageSeo'])->name('seo.page');
    });

    /*
    |--------------------------------------------------------------------------
    | GESTION DES UTILISATEURS
    |--------------------------------------------------------------------------
    */
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
        Route::patch('/{id}/change-to-client', [UserController::class, 'changeToClient'])->name('change-to-client');
    });

    /*
    |--------------------------------------------------------------------------
    | GESTION DES TARIFS
    |--------------------------------------------------------------------------
    */
    Route::prefix('pricing-plans')->name('pricing-plans.')->group(function () {
        Route::get('/', [PricingPlanController::class, 'index'])->name('index');
        Route::get('/create', [PricingPlanController::class, 'create'])->name('create');
        Route::post('/', [PricingPlanController::class, 'store'])->name('store');
        Route::get('/{pricingPlan}', [PricingPlanController::class, 'show'])->name('show');
        Route::get('/{pricingPlan}/edit', [PricingPlanController::class, 'edit'])->name('edit');
        Route::put('/{pricingPlan}', [PricingPlanController::class, 'update'])->name('update');
        Route::delete('/{pricingPlan}', [PricingPlanController::class, 'destroy'])->name('destroy');
        Route::get('/{pricingPlan}/delete', [PricingPlanController::class, 'forceDelete'])->name('force-delete');
        Route::post('/order', [PricingPlanController::class, 'updateOrder'])->name('order');
    });

    /*
    |--------------------------------------------------------------------------
    | SYSTÈME DE TICKETS / BUGTRACKER
    |--------------------------------------------------------------------------
    */
    Route::prefix('tickets')->name('tickets.')->group(function () {
        Route::get('/', [TicketController::class, 'index'])->name('index');
        Route::get('/new-count', [TicketController::class, 'getNewTicketsCount'])->name('new-count');
        Route::get('/create', [TicketController::class, 'create'])->name('create');
        Route::post('/', [TicketController::class, 'store'])->name('store');
        Route::get('/{id}', [TicketController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [TicketController::class, 'edit'])->name('edit');
        Route::put('/{id}', [TicketController::class, 'update'])->name('update');
        Route::delete('/{id}', [TicketController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/comment', [TicketController::class, 'addComment'])->name('comment.add');
        Route::post('/{id}/status', [TicketController::class, 'changeStatus'])->name('status.change');
        Route::post('/{id}/assign', [TicketController::class, 'assign'])->name('assign');
    });
});

/*
|--------------------------------------------------------------------------
| ROUTES CLIENT
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', 'role:client'])->prefix('client')->name('client.')->group(function () {

    // Dashboard client
    Route::get('/dashboard', [App\Http\Controllers\Client\DashboardController::class, 'index'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | PROFIL CLIENT
    |--------------------------------------------------------------------------
    */
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [App\Http\Controllers\Client\ProfileController::class, 'index'])->name('index');
        Route::put('/update', [App\Http\Controllers\Client\ProfileController::class, 'update'])->name('update');
        Route::put('/update-password', [App\Http\Controllers\Client\ProfileController::class, 'updatePassword'])->name('update-password');
        Route::put('/update-preferences', [App\Http\Controllers\Client\ProfileController::class, 'updatePreferences'])->name('update-preferences');
    });

    /*
    |--------------------------------------------------------------------------
    | PROJETS CLIENT
    |--------------------------------------------------------------------------
    */
    Route::prefix('projects')->name('projects.')->group(function () {
        Route::get('/', [App\Http\Controllers\Client\ProjectController::class, 'index'])->name('index');
        Route::get('/{id}', [App\Http\Controllers\Client\ProjectController::class, 'show'])->name('show');
    });

    /*
    |--------------------------------------------------------------------------
    | TICKETS CLIENT
    |--------------------------------------------------------------------------
    */
    Route::prefix('tickets')->name('tickets.')->group(function () {
        Route::get('/', [App\Http\Controllers\Client\TicketController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\Client\TicketController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\Client\TicketController::class, 'store'])->name('store');
        Route::get('/{id}', [App\Http\Controllers\Client\TicketController::class, 'show'])->name('show');
        Route::post('/{id}/comment', [App\Http\Controllers\Client\TicketController::class, 'addComment'])->name('comment.add');
        Route::post('/{id}/reply', [App\Http\Controllers\Client\TicketController::class, 'addComment'])->name('reply');
        Route::post('/{id}/close', [App\Http\Controllers\Client\TicketController::class, 'close'])->name('close');
        Route::get('/attachment/{id}', [App\Http\Controllers\Client\TicketController::class, 'downloadAttachment'])->name('attachment.download');
    });
});

/*
    |--------------------------------------------------------------------------
    | SiteMap
    |--------------------------------------------------------------------------
    */
Route::get('/sitemap.xml', [SitemapController::class, 'index']);

// Route API pour publication d'article depuis n8n - SÉCURISÉE
Route::post('/api/articles/publish', [ApiArticleController::class, 'publish'])
    ->middleware(['throttle:10,1', 'auth:sanctum'])
    ->name('api.articles.publish');
