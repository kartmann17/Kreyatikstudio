#!/bin/bash

echo "📸 Import des données portfolio en production..."
echo ""

# Se connecter au serveur de production et exécuter le seeder
# Adapter selon votre configuration serveur

echo "Exécution du seeder..."
php artisan db:seed --class=PortfolioSeeder --force

echo ""
echo "Nettoyage du cache..."
php artisan cache:clear
php artisan config:clear

echo ""
echo "✅ Import terminé !"
php artisan tinker --execute='echo "📊 " . \App\Models\PortfolioItem::count() . " éléments de portfolio dans la base de données\n";'
