#!/bin/bash

# Script de build pour production - Kreyatik Studio
# Usage: ./build-production.sh

set -e  # Arrêter en cas d'erreur

echo "🚀 Début du build pour production..."

# Couleurs pour les messages
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Fonction pour afficher les messages
print_status() {
    echo -e "${BLUE}[INFO]${NC} $1"
}

print_success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

print_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# Vérifier que nous sommes dans le bon répertoire
if [ ! -f "artisan" ]; then
    print_error "Ce script doit être exécuté depuis la racine du projet Laravel"
    exit 1
fi

print_status "Vérification de l'environnement..."

# Vérifier Node.js et npm
if ! command -v node &> /dev/null; then
    print_error "Node.js n'est pas installé"
    exit 1
fi

if ! command -v npm &> /dev/null; then
    print_error "npm n'est pas installé"
    exit 1
fi

print_success "Node.js et npm détectés"

# Vérifier PHP et Composer
if ! command -v php &> /dev/null; then
    print_error "PHP n'est pas installé"
    exit 1
fi

if ! command -v composer &> /dev/null; then
    print_error "Composer n'est pas installé"
    exit 1
fi

print_success "PHP et Composer détectés"

# Étape 1: Nettoyer les caches
print_status "Nettoyage des caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
print_success "Caches nettoyés"

# Étape 2: Installer les dépendances
print_status "Installation des dépendances PHP..."
composer install --no-dev --optimize-autoloader
print_success "Dépendances PHP installées"

print_status "Installation des dépendances Node.js..."
npm ci --production
print_success "Dépendances Node.js installées"

# Étape 3: Build des assets
print_status "Build des assets pour production..."
npm run build
print_success "Assets compilés"

# Étape 4: Optimisations Laravel
print_status "Optimisation des configurations..."
php artisan config:cache
print_success "Configuration mise en cache"

print_status "Optimisation des routes..."
php artisan route:cache
print_success "Routes mises en cache"

print_status "Optimisation des vues..."
php artisan view:cache
print_success "Vues mises en cache"

# Étape 5: Vérifications
print_status "Vérification des assets..."
if [ ! -d "public/build" ]; then
    print_error "Le dossier public/build n'existe pas"
    exit 1
fi

if [ ! -f "public/build/manifest.json" ]; then
    print_error "Le fichier manifest.json n'existe pas"
    exit 1
fi

print_success "Assets vérifiés"

# Étape 6: Permissions
print_status "Configuration des permissions..."
chmod -R 755 public/build/
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
print_success "Permissions configurées"

# Étape 7: Vérification finale
print_status "Vérification finale..."

# Vérifier que l'application peut démarrer
if php artisan --version &> /dev/null; then
    print_success "Laravel fonctionne correctement"
else
    print_error "Laravel ne peut pas démarrer"
    exit 1
fi

# Vérifier les variables d'environnement critiques
if [ -z "$APP_ENV" ]; then
    print_warning "APP_ENV n'est pas défini, utilisation de 'production'"
    export APP_ENV=production
fi

if [ "$APP_ENV" != "production" ]; then
    print_warning "APP_ENV n'est pas défini sur 'production'"
fi

# Étape 8: Rapport final
echo ""
echo "🎉 Build pour production terminé avec succès !"
echo ""
echo "📋 Checklist de déploiement :"
echo "  ✅ Assets compilés dans public/build/"
echo "  ✅ Cache Laravel optimisé"
echo "  ✅ Permissions configurées"
echo "  ✅ Dépendances installées"
echo ""
echo "🚀 Prochaines étapes :"
echo "  1. Uploader les fichiers sur le serveur"
echo "  2. Configurer les variables d'environnement"
echo "  3. Configurer le serveur web (Nginx/Apache)"
echo "  4. Configurer SSL/HTTPS"
echo "  5. Tester l'application"
echo ""
echo "📁 Fichiers à déployer :"
echo "  - Tout le projet (sauf node_modules/, .git/, etc.)"
echo "  - Fichier .env avec APP_ENV=production"
echo "  - Dossier public/build/ (assets compilés)"
echo ""
echo "🔒 Sécurité :"
echo "  - APP_DEBUG=false en production"
echo "  - SESSION_SECURE_COOKIE=true"
echo "  - HTTPS obligatoire"
echo "  - CSP restrictive activée"
echo ""

print_success "Build terminé ! Prêt pour le déploiement." 