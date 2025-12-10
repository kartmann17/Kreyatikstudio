#!/bin/bash

echo "🚀 Déploiement de la correction du portfolio..."
echo ""

# 1. Mise en maintenance
echo "📦 Mise en mode maintenance..."
php artisan down

# 2. Pull des dernières modifications
echo "🔄 Récupération des dernières modifications..."
git pull origin main

# 3. Installation des dépendances
echo "📚 Installation des dépendances Composer..."
composer install --no-dev --optimize-autoloader

echo "📚 Installation des dépendances NPM..."
npm install

# 4. Build des assets
echo "🏗️  Build des assets pour production..."
npm run build

# 5. Exécution des migrations
echo "🗄️  Exécution des migrations..."
php artisan migrate --force

# 6. Import des données portfolio
echo "📸 Import des données portfolio..."
php artisan db:seed --class=PortfolioSeeder --force

# 7. Optimisation Laravel
echo "⚡ Optimisation des caches..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# 8. Nettoyage des anciens caches
echo "🧹 Nettoyage..."
php artisan cache:clear

# 9. Sortie du mode maintenance
echo "✅ Sortie du mode maintenance..."
php artisan up

echo ""
echo "🎉 Déploiement terminé avec succès !"
echo "📊 $(php artisan tinker --execute='echo \App\Models\PortfolioItem::count();') éléments de portfolio importés"
