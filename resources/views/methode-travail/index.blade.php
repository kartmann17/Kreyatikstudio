<x-header :seoData="$SEOData ?? null" />

<!-- HowTo Schema for Méthode de Travail -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "HowTo",
    "@id": "https://kreyatikstudio.fr/methode-travail",
    "name": "Méthode de Création de Site Web - Processus en 5 Étapes",
    "description": "Découvrez notre méthode de création web flexible en 5 étapes : audit, conception, développement, tests et déploiement. Un processus structuré qui s'adapte à la complexité de chaque projet.",
    "url": "https://kreyatikstudio.fr/methode-travail",
    "image": "{{ secure_asset('images/STUDIOcolibri.png') }}",
    "totalTime": "P14D",
    "estimatedCost": {
        "@type": "MonetaryAmount",
        "currency": "EUR",
        "value": "2500"
    },
    "supply": [
        {
            "@type": "HowToSupply",
            "name": "Brief client et cahier des charges"
        },
        {
            "@type": "HowToSupply",
            "name": "Contenu et médias du site"
        },
        {
            "@type": "HowToSupply",
            "name": "Hébergement web"
        }
    ],
    "tool": [
        {
            "@type": "HowToTool",
            "name": "Laravel Framework"
        },
        {
            "@type": "HowToTool",
            "name": "TailwindCSS"
        },
        {
            "@type": "HowToTool",
            "name": "Git & GitHub"
        },
        {
            "@type": "HowToTool",
            "name": "Figma pour le design"
        }
    ],
    "step": [
        {
            "@type": "HowToStep",
            "position": 1,
            "name": "Audit & Analyse",
            "text": "Analyse complète de vos besoins et audit de l'existant. Étude de la concurrence, définition des objectifs et des fonctionnalités clés.",
            "url": "https://kreyatikstudio.fr/methode-travail#audit",
            "itemListElement": [
                {
                    "@type": "HowToDirection",
                    "text": "Réunion de découverte pour comprendre vos besoins et objectifs"
                },
                {
                    "@type": "HowToDirection",
                    "text": "Analyse de votre présence digitale actuelle"
                },
                {
                    "@type": "HowToDirection",
                    "text": "Étude de la concurrence et benchmark"
                },
                {
                    "@type": "HowToDirection",
                    "text": "Définition du cahier des charges et des spécifications techniques"
                }
            ],
            "image": "{{ secure_asset('images/STUDIOcolibri.png') }}"
        },
        {
            "@type": "HowToStep",
            "position": 2,
            "name": "Conception & Design",
            "text": "Création de maquettes, wireframes et validation du design avant développement. Design UX/UI optimisé pour la conversion.",
            "url": "https://kreyatikstudio.fr/methode-travail#design",
            "itemListElement": [
                {
                    "@type": "HowToDirection",
                    "text": "Création de wireframes et maquettes fonctionnelles"
                },
                {
                    "@type": "HowToDirection",
                    "text": "Design d'interface responsive (desktop, tablette, mobile)"
                },
                {
                    "@type": "HowToDirection",
                    "text": "Validation du design avec le client"
                },
                {
                    "@type": "HowToDirection",
                    "text": "Création du design system et guide de style"
                }
            ],
            "image": "{{ secure_asset('images/STUDIOcolibri.png') }}"
        },
        {
            "@type": "HowToStep",
            "position": 3,
            "name": "Développement",
            "text": "Développement technique front-end et back-end avec les meilleures pratiques. Code propre, sécurisé et optimisé.",
            "url": "https://kreyatikstudio.fr/methode-travail#developpement",
            "itemListElement": [
                {
                    "@type": "HowToDirection",
                    "text": "Mise en place de l'architecture et des bases de données"
                },
                {
                    "@type": "HowToDirection",
                    "text": "Développement front-end avec TailwindCSS"
                },
                {
                    "@type": "HowToDirection",
                    "text": "Développement back-end avec Laravel"
                },
                {
                    "@type": "HowToDirection",
                    "text": "Intégration des fonctionnalités spécifiques"
                },
                {
                    "@type": "HowToDirection",
                    "text": "Optimisation des performances et du SEO"
                }
            ],
            "image": "{{ secure_asset('images/STUDIOcolibri.png') }}"
        },
        {
            "@type": "HowToStep",
            "position": 4,
            "name": "Tests & Validation",
            "text": "Tests complets sur tous les navigateurs et appareils. Correction des bugs et validation finale avant mise en ligne.",
            "url": "https://kreyatikstudio.fr/methode-travail#tests",
            "itemListElement": [
                {
                    "@type": "HowToDirection",
                    "text": "Tests fonctionnels de toutes les features"
                },
                {
                    "@type": "HowToDirection",
                    "text": "Tests de compatibilité multi-navigateurs"
                },
                {
                    "@type": "HowToDirection",
                    "text": "Tests responsive sur différents appareils"
                },
                {
                    "@type": "HowToDirection",
                    "text": "Tests de performance et optimisation"
                },
                {
                    "@type": "HowToDirection",
                    "text": "Validation par le client"
                }
            ],
            "image": "{{ secure_asset('images/STUDIOcolibri.png') }}"
        },
        {
            "@type": "HowToStep",
            "position": 5,
            "name": "Déploiement & Suivi",
            "text": "Mise en ligne sécurisée, formation client et accompagnement post-lancement. Support et maintenance inclus.",
            "url": "https://kreyatikstudio.fr/methode-travail#deploiement",
            "itemListElement": [
                {
                    "@type": "HowToDirection",
                    "text": "Configuration de l'hébergement et du nom de domaine"
                },
                {
                    "@type": "HowToDirection",
                    "text": "Déploiement sécurisé en production"
                },
                {
                    "@type": "HowToDirection",
                    "text": "Configuration des outils analytics et SEO"
                },
                {
                    "@type": "HowToDirection",
                    "text": "Formation client à l'utilisation du site"
                },
                {
                    "@type": "HowToDirection",
                    "text": "Support et maintenance post-lancement"
                }
            ],
            "image": "{{ secure_asset('images/STUDIOcolibri.png') }}"
        }
    ],
    "author": {
        "@id": "https://kreyatikstudio.fr/#founder"
    },
    "inLanguage": "fr-FR",
    "isPartOf": {
        "@id": "https://kreyatikstudio.fr/#website"
    }
}
</script>

<!-- WebPage Schema -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebPage",
    "@id": "https://kreyatikstudio.fr/methode-travail",
    "url": "https://kreyatikstudio.fr/methode-travail",
    "name": "Méthode de Travail - Processus de Création Web en 5 Étapes",
    "description": "Découvrez notre méthode de création web flexible : audit, conception, développement, tests et déploiement. Un processus adaptatif pour chaque projet.",
    "isPartOf": {
        "@id": "https://kreyatikstudio.fr/#website"
    },
    "about": {
        "@type": "Thing",
        "name": "Processus de développement web"
    },
    "inLanguage": "fr-FR",
    "datePublished": "2024-01-01T00:00:00+01:00",
    "dateModified": "{{ now()->toIso8601String() }}",
    "author": {
        "@id": "https://kreyatikstudio.fr/#founder"
    },
    "publisher": {
        "@id": "https://kreyatikstudio.fr/#organization"
    }
}
</script>

<main class="site-content" role="main">
  
  <!-- Hero Section -->
  <section class="hero-section bg-gradient-to-br from-blue-50 to-indigo-100 py-16 lg:py-24">
    <div class="container mx-auto px-4">
      <div class="text-center max-w-4xl mx-auto">
        <div class="inline-flex items-center bg-blue-100 text-blue-800 text-sm font-medium px-4 py-2 rounded-full mb-6">
          <span>🛠️ Notre Méthode de Travail</span>
        </div>
        <h1 class="text-4xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
          Processus
          <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">
            éprouvé
          </span>
          et transparent
        </h1>
        <p class="text-xl text-gray-600 mb-8 leading-relaxed">
          Découvrez notre <strong>méthode de création web flexible en 5 étapes</strong> : de l'audit initial au déploiement final.
          Un processus structuré qui s'adapte à la complexité et aux spécificités de chaque projet.
        </p>
      </div>
    </div>
  </section>

  <!-- Process Overview -->
  <section class="py-16 lg:py-24 bg-white">
    <div class="container mx-auto px-4">
      <div class="text-center max-w-3xl mx-auto mb-16">
        <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-6">Notre Processus Adaptatif</h2>
        <p class="text-xl text-gray-600">
          Une méthode flexible qui s'ajuste selon la taille, la complexité et les contraintes de votre projet
        </p>
      </div>
      
      <div class="grid md:grid-cols-2 lg:grid-cols-5 gap-8">
        <div class="text-center">
          <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-xl mb-4 mx-auto">1</div>
          <h3 class="text-lg font-bold text-gray-900 mb-2">Audit & Analyse</h3>
          <p class="text-sm text-blue-600 font-medium mb-2">2-5 jours</p>
          <p class="text-gray-600 text-sm">
            Analyse complète de vos besoins et audit de l'existant.
          </p>
        </div>

        <div class="text-center">
          <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center text-white font-bold text-xl mb-4 mx-auto">2</div>
          <h3 class="text-lg font-bold text-gray-900 mb-2">Conception & Design</h3>
          <p class="text-sm text-green-600 font-medium mb-2">1-2 semaines</p>
          <p class="text-gray-600 text-sm">
            Architecture, wireframes et maquettes UX/UI validées.
          </p>
        </div>

        <div class="text-center">
          <div class="w-16 h-16 bg-purple-600 rounded-full flex items-center justify-center text-white font-bold text-xl mb-4 mx-auto">3</div>
          <h3 class="text-lg font-bold text-gray-900 mb-2">Développement</h3>
          <p class="text-sm text-purple-600 font-medium mb-2">2-8 semaines</p>
          <p class="text-gray-600 text-sm">
            Développement front-end et back-end avec optimisations.
          </p>
        </div>

        <div class="text-center">
          <div class="w-16 h-16 bg-orange-600 rounded-full flex items-center justify-center text-white font-bold text-xl mb-4 mx-auto">4</div>
          <h3 class="text-lg font-bold text-gray-900 mb-2">Tests & Optimisation</h3>
          <p class="text-sm text-orange-600 font-medium mb-2">3-5 jours</p>
          <p class="text-gray-600 text-sm">
            Tests fonctionnels et optimisation SEO complète.
          </p>
        </div>

        <div class="text-center">
          <div class="w-16 h-16 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-xl mb-4 mx-auto">5</div>
          <h3 class="text-lg font-bold text-gray-900 mb-2">Déploiement & Suivi</h3>
          <p class="text-sm text-indigo-600 font-medium mb-2">2-3 jours + suivi</p>
          <p class="text-gray-600 text-sm">
            Mise en ligne et accompagnement post-lancement.
          </p>
        </div>
      </div>

      <!-- Flexibility Note -->
      <div class="mt-16 max-w-4xl mx-auto">
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-8 border border-blue-100">
          <div class="flex items-center mb-4">
            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center mr-4">
              <span class="text-white text-lg">⚡</span>
            </div>
            <h3 class="text-xl font-bold text-gray-900">Délais Variables Selon le Projet</h3>
          </div>
          <div class="grid md:grid-cols-3 gap-6 text-sm">
            <div>
              <h4 class="font-semibold text-gray-900 mb-2">🚀 Projets Simples</h4>
              <p class="text-gray-600">Site vitrine, landing page</p>
              <p class="text-blue-600 font-medium">1-3 semaines total</p>
            </div>
            <div>
              <h4 class="font-semibold text-gray-900 mb-2">⚙️ Projets Standards</h4>
              <p class="text-gray-600">E-commerce, site corporate</p>
              <p class="text-green-600 font-medium">4-8 semaines total</p>
            </div>
            <div>
              <h4 class="font-semibold text-gray-900 mb-2">🏗️ Projets Complexes</h4>
              <p class="text-gray-600">SaaS, CRM, applications sur-mesure</p>
              <p class="text-purple-600 font-medium">8-16 semaines total</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Detailed Steps -->
  <section class="py-16 lg:py-24 bg-gray-50">
    <div class="container mx-auto px-4">
      <div class="text-center max-w-3xl mx-auto mb-16">
        <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-6">Détail de Chaque Étape</h2>
      </div>
      
      <div class="max-w-4xl mx-auto space-y-8">
        <!-- Étape 1 -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
          <div class="flex items-center mb-6">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
              <span class="text-2xl">🔍</span>
            </div>
            <h3 class="text-2xl font-bold text-gray-900">Étape 1 : Audit & Analyse Approfondie</h3>
          </div>
          <div class="grid md:grid-cols-3 gap-6">
            <div>
              <h4 class="text-lg font-semibold text-gray-900 mb-3">🎯 Analyse des Besoins</h4>
              <ul class="text-gray-600 space-y-1">
                <li>• Entretiens avec les parties prenantes</li>
                <li>• Définition des personas utilisateurs</li>
                <li>• Cartographie des fonctionnalités</li>
                <li>• Établissement des KPIs de succès</li>
              </ul>
            </div>
            <div>
              <h4 class="text-lg font-semibold text-gray-900 mb-3">🕵️ Audit Technique</h4>
              <ul class="text-gray-600 space-y-1">
                <li>• Analyse de l'infrastructure existante</li>
                <li>• Audit SEO complet</li>
                <li>• Évaluation des performances</li>
                <li>• Points d'amélioration identifiés</li>
              </ul>
            </div>
            <div>
              <h4 class="text-lg font-semibold text-gray-900 mb-3">📊 Étude Concurrentielle</h4>
              <ul class="text-gray-600 space-y-1">
                <li>• Analyse des sites concurrents</li>
                <li>• Benchmarking des bonnes pratiques</li>
                <li>• Opportunités de différenciation</li>
                <li>• Veille technologique</li>
              </ul>
            </div>
          </div>
          <div class="mt-6 p-4 bg-blue-50 rounded-lg">
            <h4 class="font-semibold text-gray-900 mb-2">📄 Livrables</h4>
            <p class="text-gray-600">Cahier des charges détaillé, audit technique complet, stratégie digitale et planning projet.</p>
          </div>
        </div>

        <!-- Étape 2 -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
          <div class="flex items-center mb-6">
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
              <span class="text-2xl">🎨</span>
            </div>
            <h3 class="text-2xl font-bold text-gray-900">Étape 2 : Conception & Design UX/UI</h3>
          </div>
          <div class="grid md:grid-cols-3 gap-6">
            <div>
              <h4 class="text-lg font-semibold text-gray-900 mb-3">🗺️ Architecture</h4>
              <ul class="text-gray-600 space-y-1">
                <li>• Carte du site optimisée</li>
                <li>• Arborescence logique</li>
                <li>• Structuration des contenus</li>
                <li>• Maillage interne optimal</li>
              </ul>
            </div>
            <div>
              <h4 class="text-lg font-semibold text-gray-900 mb-3">📐 Wireframes</h4>
              <ul class="text-gray-600 space-y-1">
                <li>• Wireframes basse fidélité</li>
                <li>• Prototype interactif</li>
                <li>• Tests utilisateurs</li>
                <li>• Itérations basées sur retours</li>
              </ul>
            </div>
            <div>
              <h4 class="text-lg font-semibold text-gray-900 mb-3">🎭 Design Visuel</h4>
              <ul class="text-gray-600 space-y-1">
                <li>• Identité visuelle web</li>
                <li>• Maquettes haute fidélité</li>
                <li>• Design system complet</li>
                <li>• Validation charte graphique</li>
              </ul>
            </div>
          </div>
          <div class="mt-6 p-4 bg-green-50 rounded-lg">
            <h4 class="font-semibold text-gray-900 mb-2">📄 Livrables</h4>
            <p class="text-gray-600">Maquettes validées, prototype interactif, design system et spécifications techniques.</p>
          </div>
        </div>

        <!-- Étape 3 -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
          <div class="flex items-center mb-6">
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
              <span class="text-2xl">💻</span>
            </div>
            <h3 class="text-2xl font-bold text-gray-900">Étape 3 : Développement Technique</h3>
          </div>
          <div class="grid md:grid-cols-3 gap-6">
            <div>
              <h4 class="text-lg font-semibold text-gray-900 mb-3">⚙️ Backend</h4>
              <ul class="text-gray-600 space-y-1">
                <li>• Architecture Laravel sécurisée</li>
                <li>• Développement des APIs REST</li>
                <li>• Bases de données optimisées</li>
                <li>• Système d'authentification</li>
              </ul>
            </div>
            <div>
              <h4 class="text-lg font-semibold text-gray-900 mb-3">🎨 Frontend</h4>
              <ul class="text-gray-600 space-y-1">
                <li>• Intégration responsive</li>
                <li>• Interactions JavaScript modernes</li>
                <li>• Optimisation performances</li>
                <li>• Accessibilité WCAG 2.1 AA</li>
              </ul>
            </div>
            <div>
              <h4 class="text-lg font-semibold text-gray-900 mb-3">🔧 Intégrations</h4>
              <ul class="text-gray-600 space-y-1">
                <li>• CMS/Back-office intuitif</li>
                <li>• Outils d'analyse</li>
                <li>• Services tiers</li>
                <li>• Optimisation SEO technique</li>
              </ul>
            </div>
          </div>
          <div class="mt-6 p-4 bg-purple-50 rounded-lg">
            <h4 class="font-semibold text-gray-900 mb-2">📄 Livrables</h4>
            <p class="text-gray-600">Code source documenté, environnement de développement et version de test fonctionnelle.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Communication & Tools -->
  <section class="py-16 lg:py-24 bg-white">
    <div class="container mx-auto px-4">
      <div class="text-center max-w-3xl mx-auto mb-16">
        <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-6">Communication & Outils</h2>
        <p class="text-xl text-gray-600">
          Transparence totale et collaboration efficace tout au long du projet
        </p>
      </div>

      <div class="grid md:grid-cols-3 gap-8 max-w-4xl mx-auto">
        <div class="text-center p-6">
          <div class="text-4xl mb-4">💬</div>
          <h3 class="text-xl font-bold text-gray-900 mb-4">Communication Régulière</h3>
          <ul class="text-gray-600 space-y-2 text-left">
            <li>• Points hebdomadaires programmés</li>
            <li>• Slack/Teams pour échanges quotidiens</li>
            <li>• Rapports d'avancement détaillés</li>
            <li>• Disponibilité garantie en journée</li>
          </ul>
        </div>

        <div class="text-center p-6">
          <div class="text-4xl mb-4">📋</div>
          <h3 class="text-xl font-bold text-gray-900 mb-4">Gestion de Projet</h3>
          <ul class="text-gray-600 space-y-2 text-left">
            <li>• Trello/Notion pour le suivi</li>
            <li>• Planning détaillé et mis à jour</li>
            <li>• Versionning Git professionnel</li>
            <li>• Environnements de test dédiés</li>
          </ul>
        </div>

        <div class="text-center p-6">
          <div class="text-4xl mb-4">📊</div>
          <h3 class="text-xl font-bold text-gray-900 mb-4">Mesure & Analytics</h3>
          <ul class="text-gray-600 space-y-2 text-left">
            <li>• Google Analytics 4 configuré</li>
            <li>• Search Console optimisée</li>
            <li>• Monitoring des performances</li>
            <li>• Rapports mensuels automatisés</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="py-16 lg:py-24 bg-gradient-to-br from-blue-600 to-indigo-700">
    <div class="container mx-auto px-4 text-center">
      <div class="max-w-3xl mx-auto">
        <h2 class="text-3xl lg:text-4xl font-bold text-white mb-6">Prêt à démarrer votre projet ?</h2>
        <p class="text-xl text-blue-100 mb-8">
          Chaque projet est unique. Discutons de vos besoins pour établir ensemble un planning adapté 
          à vos objectifs, votre budget et vos contraintes de temps.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-50 transition-colors">
            <span>🚀 Démarrer mon projet</span>
          </a>
          <a href="{{ route('portfolio') }}" class="inline-flex items-center justify-center px-8 py-4 bg-transparent border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-blue-600 transition-colors">
            <span>👁️ Voir nos réalisations</span>
          </a>
        </div>
      </div>
    </div>
  </section>

</main>

<x-footer />