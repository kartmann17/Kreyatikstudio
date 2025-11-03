#!/bin/bash
# Commandes exactes à exécuter sur le serveur

echo "🧹 Nettoyage cache Laravel production..."

# Nettoyer tous les caches
php artisan view:clear
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# Supprimer fichiers Blade compilés
rm -rf storage/framework/views/*.php

# Régénérer cache config
php artisan config:cache

echo "✅ Cache nettoyé!"
echo ""
echo "🔍 Test du site..."
curl -I https://kreyatikstudio.fr | head -1
