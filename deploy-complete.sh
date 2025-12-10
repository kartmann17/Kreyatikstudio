#!/bin/bash

echo "🚀 Déploiement Complet - Kreyatik Studio"
echo "========================================"
echo ""

# Couleurs pour les messages
GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# 1. Mise en maintenance
echo -e "${YELLOW}📦 Mise en mode maintenance...${NC}"
php artisan down || echo "Déjà en maintenance ou erreur"

# 2. Pull des dernières modifications
echo -e "${BLUE}🔄 Récupération des dernières modifications Git...${NC}"
git pull origin main

# 3. Installation des dépendances
echo -e "${BLUE}📚 Installation des dépendances Composer...${NC}"
composer install --no-dev --optimize-autoloader --no-interaction

echo -e "${BLUE}📚 Installation des dépendances NPM...${NC}"
npm ci

# 4. Build des assets
echo -e "${BLUE}🏗️  Build des assets pour production...${NC}"
npm run build

# 5. Exécution des migrations
echo -e "${BLUE}🗄️  Exécution des migrations...${NC}"
php artisan migrate --force

# 6. Import des données portfolio
echo -e "${BLUE}📸 Import/Mise à jour des données portfolio...${NC}"
php artisan db:seed --class=PortfolioSeeder --force

# 7. Vérification du symlink storage
echo -e "${BLUE}🔗 Vérification du lien symbolique storage...${NC}"
if [ ! -L "public/storage" ]; then
    echo "Création du symlink storage..."
    php artisan storage:link
fi

# 8. Optimisation Laravel
echo -e "${BLUE}⚡ Optimisation des caches Laravel...${NC}"
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# 9. Nettoyage
echo -e "${BLUE}🧹 Nettoyage des anciens caches...${NC}"
php artisan cache:clear

# 10. Permissions (si nécessaire)
echo -e "${BLUE}🔒 Vérification des permissions...${NC}"
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage/app/public

# 11. Sortie du mode maintenance
echo -e "${GREEN}✅ Sortie du mode maintenance...${NC}"
php artisan up

# 12. Statistiques
echo ""
echo -e "${GREEN}🎉 Déploiement terminé avec succès !${NC}"
echo "========================================"
echo ""
echo -e "${BLUE}📊 Statistiques :${NC}"
php artisan tinker --execute='
echo "Portfolio Items: " . \App\Models\PortfolioItem::count() . " éléments\n";
echo "Articles Blog: " . \App\Models\Article::where("is_published", true)->count() . " publiés\n";
echo "Clients: " . \App\Models\Client::count() . " clients\n";
echo "Projets: " . \App\Models\Project::count() . " projets\n";
'
echo ""
echo -e "${GREEN}✅ Tout est prêt !${NC}"
echo -e "🌐 Visitez votre site : ${BLUE}https://kreyatikstudio.fr${NC}"
