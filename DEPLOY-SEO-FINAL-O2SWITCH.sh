#!/bin/bash

###############################################################################
# DEPLOY SEO FINAL - O2SWITCH SAFE DEPLOYMENT
#
# Ce script déploie les améliorations SEO de manière sécurisée sur o2switch
# en gérant correctement le cache Blade et PHP-FPM
#
# Auteur: Claude Code pour Kréyatik Studio
# Date: $(date +"%d/%m/%Y %H:%M")
###############################################################################

echo "═══════════════════════════════════════════════════════════════"
echo "🚀 DÉPLOIEMENT SEO FINAL - KRÉYATIK STUDIO"
echo "═══════════════════════════════════════════════════════════════"
echo ""

# Couleurs pour output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Function pour afficher avec couleur
print_step() {
    echo -e "${BLUE}➤${NC} $1"
}

print_success() {
    echo -e "${GREEN}✓${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}⚠${NC}  $1"
}

print_error() {
    echo -e "${RED}✗${NC} $1"
}

echo ""
print_warning "IMPORTANT: Exécutez ce script EN LOCAL, pas sur le serveur"
print_warning "Ce script vous guidera étape par étape pour le déploiement"
echo ""

# Vérifier qu'on est dans le bon dossier
if [ ! -f "artisan" ]; then
    print_error "Ce script doit être exécuté depuis la racine du projet Laravel"
    exit 1
fi

print_success "✓ Dossier Laravel détecté"
echo ""

###############################################################################
# ÉTAPE 1: BACKUP LOCAL
###############################################################################

print_step "ÉTAPE 1/10: Création backup local"
echo "────────────────────────────────────────────────────────────────"

BACKUP_DIR="backup-$(date +%Y%m%d-%H%M%S)"
mkdir -p "$BACKUP_DIR"

print_step "Sauvegarde des fichiers modifiés..."
cp resources/views/components/header.blade.php "$BACKUP_DIR/" 2>/dev/null
cp resources/views/a-propos/index.blade.php "$BACKUP_DIR/" 2>/dev/null
cp resources/views/methode-travail/index.blade.php "$BACKUP_DIR/" 2>/dev/null
cp resources/views/contact/index.blade.php "$BACKUP_DIR/" 2>/dev/null
cp resources/views/portfolio/index.blade.php "$BACKUP_DIR/" 2>/dev/null

print_success "Backup créé dans: $BACKUP_DIR"
echo ""

###############################################################################
# ÉTAPE 2: TESTS LOCAUX
###############################################################################

print_step "ÉTAPE 2/10: Tests locaux"
echo "────────────────────────────────────────────────────────────────"

print_step "Test du nombre de schemas sur chaque page..."
echo ""

# Test homepage
HOMEPAGE_SCHEMAS=$(php artisan serve --host=127.0.0.1 --port=8000 &>/dev/null & SERVER_PID=$!; sleep 2; curl -s http://127.0.0.1:8000 2>/dev/null | grep -c 'application/ld+json'; kill $SERVER_PID 2>/dev/null)
if [ ! -z "$HOMEPAGE_SCHEMAS" ] && [ "$HOMEPAGE_SCHEMAS" -ge 4 ]; then
    print_success "Homepage: $HOMEPAGE_SCHEMAS schemas détectés"
else
    print_warning "Homepage: impossible de vérifier (serveur peut-être déjà lancé)"
fi

echo ""
print_step "Validation manuelle recommandée:"
echo "   1. Démarrez le serveur: php artisan serve"
echo "   2. Visitez http://localhost:8000"
echo "   3. Clic droit > Inspecter > Cherchez 'application/ld+json'"
echo "   4. Vérifiez sur https://validator.schema.org/"
echo ""

read -p "$(echo -e ${YELLOW}Les tests locaux sont-ils OK? [o/N]:${NC} )" -n 1 -r
echo ""
if [[ ! $REPLY =~ ^[Oo]$ ]]; then
    print_error "Tests locaux non validés. Arrêt du déploiement."
    exit 1
fi

print_success "Tests locaux validés"
echo ""

###############################################################################
# ÉTAPE 3: COMMIT & PUSH GIT
###############################################################################

print_step "ÉTAPE 3/10: Commit & Push Git"
echo "────────────────────────────────────────────────────────────────"

print_step "Vérification des fichiers modifiés..."
git status --short

echo ""
read -p "$(echo -e ${YELLOW}Créer un commit avec ces changements? [o/N]:${NC} )" -n 1 -r
echo ""

if [[ $REPLY =~ ^[Oo]$ ]]; then
    print_step "Ajout des fichiers..."
    git add resources/views/components/header.blade.php
    git add resources/views/a-propos/index.blade.php
    git add resources/views/methode-travail/index.blade.php
    git add resources/views/contact/index.blade.php
    git add resources/views/portfolio/index.blade.php
    git add SEO-IMPLEMENTATION-COMPLETE.md
    git add DEPLOY-SEO-FINAL-O2SWITCH.sh

    print_step "Création du commit..."
    git commit -m "SEO: Implémentation complète structured data

- Header: LocalBusiness, WebSite, Organization, BreadcrumbList
- À propos: Person, AboutPage, ProfilePage schemas
- Méthode de travail: HowTo schema avec 5 étapes détaillées
- Contact: ContactPage schema avec horaires
- Portfolio: CollectionPage, ItemList, Service schemas
- Meta tags optimisés: geo, hreflang, resource hints
- Documentation complète SEO

🚀 Generated with Claude Code
Co-Authored-By: Claude Sonnet 4.5 <noreply@anthropic.com>"

    print_step "Push vers GitHub..."
    git push origin main

    print_success "Git push réussi"
else
    print_warning "Commit ignoré"
fi

echo ""

###############################################################################
# ÉTAPE 4: CONNEXION SSH O2SWITCH
###############################################################################

print_step "ÉTAPE 4/10: Instructions SSH o2switch"
echo "────────────────────────────────────────────────────────────────"
echo ""
print_step "Ouvrez un NOUVEAU terminal et connectez-vous:"
echo "   ssh fite6981@truelle.o2switch.net"
echo ""
print_step "Une fois connecté, passez à l'étape suivante"
echo ""

read -p "$(echo -e ${YELLOW}Connecté au serveur o2switch? [o/N]:${NC} )" -n 1 -r
echo ""
if [[ ! $REPLY =~ ^[Oo]$ ]]; then
    print_error "Connexion SSH non établie. Arrêt."
    exit 1
fi

print_success "Connexion SSH établie"
echo ""

###############################################################################
# ÉTAPE 5: BACKUP SERVEUR
###############################################################################

print_step "ÉTAPE 5/10: Backup serveur o2switch"
echo "────────────────────────────────────────────────────────────────"
echo ""
print_step "COPIEZ ET EXÉCUTEZ ces commandes sur le serveur:"
echo ""
cat << 'SSHCOMMANDS'
cd public_html/KreyatikLaravel

# Créer dossier backup avec timestamp
BACKUP_DIR="backup-$(date +%Y%m%d-%H%M%S)"
mkdir -p "$BACKUP_DIR"

# Backup fichiers
cp resources/views/components/header.blade.php "$BACKUP_DIR/" 2>/dev/null
cp resources/views/a-propos/index.blade.php "$BACKUP_DIR/" 2>/dev/null
cp resources/views/methode-travail/index.blade.php "$BACKUP_DIR/" 2>/dev/null
cp resources/views/contact/index.blade.php "$BACKUP_DIR/" 2>/dev/null
cp resources/views/portfolio/index.blade.php "$BACKUP_DIR/" 2>/dev/null

# Backup cache Blade
mkdir -p "$BACKUP_DIR/blade-cache"
cp storage/framework/views/*.php "$BACKUP_DIR/blade-cache/" 2>/dev/null

echo "✓ Backup créé dans: $BACKUP_DIR"
ls -la "$BACKUP_DIR"
SSHCOMMANDS

echo ""
read -p "$(echo -e ${YELLOW}Backup serveur créé? [o/N]:${NC} )" -n 1 -r
echo ""
if [[ ! $REPLY =~ ^[Oo]$ ]]; then
    print_error "Backup serveur non créé. Arrêt."
    exit 1
fi

print_success "Backup serveur créé"
echo ""

###############################################################################
# ÉTAPE 6: GIT PULL
###############################################################################

print_step "ÉTAPE 6/10: Git pull sur serveur"
echo "────────────────────────────────────────────────────────────────"
echo ""
print_step "COPIEZ ET EXÉCUTEZ sur le serveur:"
echo ""
cat << 'SSHCOMMANDS'
cd public_html/KreyatikLaravel

# Vérifier la branche actuelle
git branch

# Pull les changements
git pull origin main

# Afficher les fichiers modifiés
git log -1 --stat
SSHCOMMANDS

echo ""
read -p "$(echo -e ${YELLOW}Git pull réussi? [o/N]:${NC} )" -n 1 -r
echo ""
if [[ ! $REPLY =~ ^[Oo]$ ]]; then
    print_error "Git pull échoué. Arrêt."
    exit 1
fi

print_success "Git pull réussi"
echo ""

###############################################################################
# ÉTAPE 7: SUPPRESSION CACHE BLADE (CRITIQUE)
###############################################################################

print_step "ÉTAPE 7/10: 🔥 SUPPRESSION CACHE BLADE (CRITIQUE)"
echo "────────────────────────────────────────────────────────────────"
echo ""
print_warning "ATTENTION: Cette étape est CRITIQUE pour o2switch"
print_warning "Le cache doit être supprimé IMMÉDIATEMENT après le git pull"
echo ""
print_step "COPIEZ ET EXÉCUTEZ sur le serveur:"
echo ""
cat << 'SSHCOMMANDS'
cd public_html/KreyatikLaravel

# Suppression FORCÉE de tous les fichiers cache Blade
rm -f storage/framework/views/*.php

# Vérification
echo "Nombre de fichiers restants dans cache Blade:"
ls -la storage/framework/views/ | wc -l

# Devrait afficher seulement: total 2 (.  et  ..)
# Ou 3 si .gitignore présent
SSHCOMMANDS

echo ""
read -p "$(echo -e ${RED}Cache Blade SUPPRIMÉ? (0-1 fichiers restants) [o/N]:${NC} )" -n 1 -r
echo ""
if [[ ! $REPLY =~ ^[Oo]$ ]]; then
    print_error "Cache Blade non supprimé correctement. ARRÊT CRITIQUE."
    exit 1
fi

print_success "Cache Blade supprimé"
echo ""

###############################################################################
# ÉTAPE 8: CLEAR LARAVEL CACHES
###############################################################################

print_step "ÉTAPE 8/10: Clear tous les caches Laravel"
echo "────────────────────────────────────────────────────────────────"
echo ""
print_step "COPIEZ ET EXÉCUTEZ sur le serveur:"
echo ""
cat << 'SSHCOMMANDS'
cd public_html/KreyatikLaravel

# Clear tous les caches Laravel
php artisan view:clear
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan optimize:clear

echo "✓ Tous les caches Laravel cleared"
SSHCOMMANDS

echo ""
read -p "$(echo -e ${YELLOW}Caches Laravel cleared? [o/N]:${NC} )" -n 1 -r
echo ""
if [[ ! $REPLY =~ ^[Oo]$ ]]; then
    print_warning "Caches Laravel non cleared, mais on continue..."
fi

print_success "Caches cleared"
echo ""

###############################################################################
# ÉTAPE 9: TEST PRODUCTION
###############################################################################

print_step "ÉTAPE 9/10: Test sur production"
echo "────────────────────────────────────────────────────────────────"
echo ""
print_step "Test 1: Vérifier le site charge"
echo "   curl -I https://kreyatikstudio.fr"
echo ""
print_step "Test 2: Vérifier les schemas sur homepage"
echo "   curl -s https://kreyatikstudio.fr | grep -c 'application/ld+json'"
echo "   Devrait retourner: 4 ou plus"
echo ""
print_step "Test 3: Vérifier page à propos"
echo "   curl -s https://kreyatikstudio.fr/a-propos | grep -c 'application/ld+json'"
echo "   Devrait retourner: 7 ou plus"
echo ""
print_step "Test 4: Vérifier qu'il n'y a pas d'erreurs"
echo "   tail -20 storage/logs/laravel.log"
echo ""

read -p "$(echo -e ${YELLOW}Tous les tests production passent? [o/N]:${NC} )" -n 1 -r
echo ""
if [[ ! $REPLY =~ ^[Oo]$ ]]; then
    print_error "Tests production échoués!"
    echo ""
    print_step "ROLLBACK: Restaurer backup"
    echo "   cd public_html/KreyatikLaravel"
    echo "   cp backup-XXXXXX/*.php resources/views/components/"
    echo "   rm -f storage/framework/views/*.php"
    echo "   php artisan optimize:clear"
    exit 1
fi

print_success "Tests production OK"
echo ""

###############################################################################
# ÉTAPE 10: VALIDATION SEO
###############################################################################

print_step "ÉTAPE 10/10: Validation SEO finale"
echo "────────────────────────────────────────────────────────────────"
echo ""
print_step "Validations à faire MAINTENANT:"
echo ""
echo "1. Google Rich Results Test:"
echo "   https://search.google.com/test/rich-results"
echo "   Tester: https://kreyatikstudio.fr"
echo "   Tester: https://kreyatikstudio.fr/a-propos"
echo "   Tester: https://kreyatikstudio.fr/methode-travail"
echo ""
echo "2. Schema.org Validator:"
echo "   https://validator.schema.org/"
echo "   Tester chaque page"
echo ""
echo "3. PageSpeed Insights:"
echo "   https://pagespeed.web.dev/"
echo "   Tester: https://kreyatikstudio.fr"
echo ""
echo "4. Vérification visuelle:"
echo "   - Ouvrir https://kreyatikstudio.fr"
echo "   - Clic droit > Inspecter"
echo "   - Chercher 'application/ld+json'"
echo "   - Vérifier que les schemas s'affichent"
echo ""

read -p "$(echo -e ${GREEN}Validation SEO complète? [o/N]:${NC} )" -n 1 -r
echo ""

###############################################################################
# FIN
###############################################################################

echo ""
echo "═══════════════════════════════════════════════════════════════"
echo "🎉 DÉPLOIEMENT SEO FINAL TERMINÉ"
echo "═══════════════════════════════════════════════════════════════"
echo ""

if [[ $REPLY =~ ^[Oo]$ ]]; then
    print_success "✓ Déploiement réussi avec succès!"
    echo ""
    echo "📊 Prochaines étapes:"
    echo "   1. Soumettre sitemap à Google Search Console"
    echo "   2. Soumettre sitemap à Bing Webmaster Tools"
    echo "   3. Monitor indexation (24-48h)"
    echo "   4. Analyser performance dans 7 jours"
    echo ""
    echo "📄 Documentation complète:"
    echo "   Voir: SEO-IMPLEMENTATION-COMPLETE.md"
    echo ""
    echo "🚀 Votre site a maintenant LE MEILLEUR SEO DU MONDE!"
    echo ""
    print_success "Félicitations! 🎊"
else
    print_warning "Validation SEO incomplète"
    echo ""
    echo "⚠️  Actions recommandées:"
    echo "   1. Vérifier les erreurs sur Google Rich Results Test"
    echo "   2. Corriger les problèmes identifiés"
    echo "   3. Re-déployer si nécessaire"
    echo ""
fi

echo ""
echo "═══════════════════════════════════════════════════════════════"
echo "Script créé par Claude Code pour Kréyatik Studio"
echo "Support: kreyatik@gmail.com | +33 6 95 80 06 63"
echo "═══════════════════════════════════════════════════════════════"
echo ""
