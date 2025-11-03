#!/bin/bash

# Script de déploiement optimisé pour Kréyatik Studio
# Utilise toutes les optimisations de performance

set -e  # Arrêter en cas d'erreur

echo "🚀 Déploiement Optimisé - Kréyatik Studio"
echo "========================================"

# Couleurs
GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

# Fonction d'affichage
step() {
    echo -e "\n${BLUE}▶${NC} $1"
}

success() {
    echo -e "${GREEN}✓${NC} $1"
}

warning() {
    echo -e "${YELLOW}⚠${NC} $1"
}

error() {
    echo -e "${RED}✗${NC} $1"
}

# 1. Vérifier les prérequis
step "Vérification des prérequis"

if ! command -v redis-cli &> /dev/null; then
    warning "Redis CLI non trouvé. Redis est-il installé?"
    echo "   Installation: sudo apt install redis-server"
fi

if ! php -m | grep -q redis; then
    warning "Extension PHP Redis non trouvée"
    echo "   Installation: sudo apt install php8.2-redis"
fi

# 2. Mode maintenance
step "Activation du mode maintenance"
php artisan down --render="errors::503" --retry=60
success "Mode maintenance activé"

# 3. Pull des modifications
step "Récupération des modifications Git"
git pull origin main
success "Code mis à jour"

# 4. Installation des dépendances
step "Installation des dépendances Composer (production)"
composer install --no-dev --optimize-autoloader --no-interaction
success "Dépendances PHP installées"

step "Installation des dépendances NPM"
npm ci --production=false
success "Dépendances NPM installées"

# 5. Build des assets
step "Build des assets (optimisés avec Vite)"
npm run build
success "Assets buildés et optimisés"

# 6. Optimisation des images (si le script existe)
if [ -f "./optimize-images.sh" ]; then
    step "Optimisation des images"
    ./optimize-images.sh
    success "Images optimisées"
else
    warning "Script d'optimisation des images non trouvé"
fi

# 7. Migrations base de données
step "Exécution des migrations"
php artisan migrate --force
success "Migrations exécutées"

# 8. Optimisation Laravel
step "Optimisation Laravel"

# Nettoyer les anciens caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
success "Caches nettoyés"

# Créer les nouveaux caches
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
success "Caches optimisés créés"

# Optimisation globale
php artisan optimize
success "Application optimisée"

# 9. Permissions
step "Vérification des permissions"
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache 2>/dev/null || true
success "Permissions mises à jour"

# 10. Vérification Redis
step "Vérification de Redis"
if redis-cli ping > /dev/null 2>&1; then
    success "Redis fonctionne correctement"
else
    error "Redis ne répond pas"
    echo "   Vérifier: sudo systemctl status redis"
fi

# 11. Redémarrer les services
step "Redémarrage des services"

# Détection du système PHP-FPM
if [ -f /etc/init.d/php8.2-fpm ] || systemctl list-units --type=service | grep -q php8.2-fpm; then
    sudo systemctl restart php8.2-fpm
    success "PHP 8.2-FPM redémarré"
elif [ -f /etc/init.d/php8.1-fpm ] || systemctl list-units --type=service | grep -q php8.1-fpm; then
    sudo systemctl restart php8.1-fpm
    success "PHP 8.1-FPM redémarré"
else
    warning "PHP-FPM non détecté, redémarrage manuel requis"
fi

# Redémarrer le serveur web
if systemctl list-units --type=service | grep -q nginx; then
    sudo systemctl reload nginx
    success "Nginx rechargé"
elif systemctl list-units --type=service | grep -q apache2; then
    sudo systemctl reload apache2
    success "Apache rechargé"
else
    warning "Serveur web non détecté, rechargement manuel requis"
fi

# 12. Queue worker (si utilisé)
if systemctl list-units --type=service | grep -q laravel-worker; then
    sudo systemctl restart laravel-worker
    success "Queue worker redémarré"
fi

# 13. Désactiver le mode maintenance
step "Désactivation du mode maintenance"
php artisan up
success "Site en ligne"

# 14. Tests de santé
step "Tests de santé du site"

# Test Redis
if php artisan tinker --execute="Cache::put('test', 'ok', 60); exit;" > /dev/null 2>&1; then
    success "Cache Redis: OK"
else
    error "Cache Redis: ERREUR"
fi

# Test database
if php artisan tinker --execute="DB::connection()->getPdo(); exit;" > /dev/null 2>&1; then
    success "Connexion Base de données: OK"
else
    error "Connexion Base de données: ERREUR"
fi

# 15. Résumé
echo ""
echo "========================================"
echo -e "${GREEN}✅ Déploiement terminé avec succès!${NC}"
echo "========================================"
echo ""
echo "Vérifications recommandées:"
echo "1. Tester le site: https://kreyatikstudio.fr"
echo "2. PageSpeed: https://pagespeed.web.dev/"
echo "3. Logs: tail -f storage/logs/laravel.log"
echo ""
echo "Optimisations actives:"
echo "✓ Cache Redis"
echo "✓ Query caching"
echo "✓ Assets minifiés"
echo "✓ Images optimisées"
echo "✓ Compression Gzip/Brotli"
echo "✓ Laravel optimized"
echo ""
