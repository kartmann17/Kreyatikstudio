#!/bin/bash
# Script pour nettoyer tous les caches Laravel

echo "🧹 Nettoyage de tous les caches Laravel..."

php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Supprimer manuellement les fichiers compilés Blade
rm -rf storage/framework/views/*.php 2>/dev/null

# Régénérer le cache de configuration
php artisan config:cache

echo "✅ Tous les caches ont été nettoyés avec succès!"
