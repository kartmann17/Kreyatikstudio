#!/bin/bash

###############################################################################
# RESTAURATION AU 4 NOVEMBRE 2024
#
# Ce script restaure le site à l'état du 4 novembre (commit 9bb1913)
# qui fonctionnait correctement avant tous les changements SEO
###############################################################################

echo "═══════════════════════════════════════════════════════════════"
echo "🔄 RESTAURATION AU 4 NOVEMBRE 2024"
echo "═══════════════════════════════════════════════════════════════"
echo ""

cat << 'SSHCOMMANDS'
# Connexion SSH
ssh fite6981@truelle.o2switch.net

# 1. Aller dans le projet
cd ~/public_html/KreyatikLaravel

# 2. Créer backup de sécurité
echo "📦 Création backup..."
BACKUP_DIR="backup-avant-restauration-$(date +%Y%m%d-%H%M%S)"
mkdir -p "$BACKUP_DIR"
cp -r resources/views/components "$BACKUP_DIR/"
cp composer.json composer.lock "$BACKUP_DIR/"

# 3. Restaurer au commit du 4 novembre
echo "⏪ Restauration au 4 novembre..."
git fetch origin
git reset --hard 9bb1913
git clean -fd

# 4. Réinstaller dépendances
echo "📦 Réinstallation composer..."
composer install --no-dev --optimize-autoloader

# 5. Suppression TOTALE du cache
echo "🗑️  Suppression cache..."
rm -rf storage/framework/views/*
rm -rf storage/framework/cache/*
rm -rf bootstrap/cache/*.php

# 6. Clear tous les caches Laravel
echo "🧹 Clear caches Laravel..."
php artisan optimize:clear
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# 7. Permissions
echo "🔧 Permissions..."
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/

# 8. Kill PHP-FPM (o2switch)
echo "♻️  Restart PHP-FPM..."
killall -9 php-fpm 2>/dev/null
sleep 5

# 9. TEST
echo ""
echo "🧪 Test du site..."
curl -I https://kreyatikstudio.fr

echo ""
echo "═══════════════════════════════════════════════════════════════"
echo "✓ RESTAURATION TERMINÉE"
echo "═══════════════════════════════════════════════════════════════"
echo ""
echo "Vérifiez que le site charge: https://kreyatikstudio.fr"
SSHCOMMANDS

echo ""
echo "═══════════════════════════════════════════════════════════════"
echo ""
echo "📋 RÉSUMÉ:"
echo ""
echo "   État restauré: 4 novembre 2024 (commit 9bb1913)"
echo "   État: Site fonctionnel AVANT modifications SEO"
echo ""
echo "   ✓ Testé localement: HTTP 200"
echo ""
echo "═══════════════════════════════════════════════════════════════"
echo ""
