#!/bin/bash
# Script de déploiement des corrections SEO
# Date: 2025-11-03

echo "🚀 Déploiement corrections SEO - Google Search Console"
echo "═══════════════════════════════════════════════════════"
echo ""

# Vérifier qu'on est dans le bon dossier
if [ ! -f "artisan" ]; then
    echo "❌ Erreur: Ce script doit être exécuté depuis la racine du projet Laravel"
    exit 1
fi

echo "✅ Dossier projet: $(pwd)"
echo ""

# 1. Nettoyer les caches Laravel
echo "🧹 Nettoyage caches Laravel..."
php artisan view:clear
php artisan cache:clear
php artisan config:clear
php artisan route:clear
rm -rf storage/framework/views/*.php
echo "   ✅ Caches nettoyés"
echo ""

# 2. Vérifier que les fichiers modifiés existent
echo "🔍 Vérification fichiers modifiés..."

files_to_check=(
    "resources/views/auth/login.blade.php"
    "resources/views/auth/register.blade.php"
    "resources/views/admin/layout.blade.php"
    "resources/views/client/layout.blade.php"
    "public/robots.txt"
)

for file in "${files_to_check[@]}"; do
    if [ -f "$file" ]; then
        echo "   ✅ $file"
    else
        echo "   ❌ MANQUANT: $file"
        exit 1
    fi
done
echo ""

# 3. Vérifier que les balises noindex sont présentes
echo "🔍 Vérification balises noindex..."

grep -q 'name="robots" content="noindex' resources/views/auth/login.blade.php && echo "   ✅ login.blade.php" || echo "   ⚠️  login.blade.php (pas de noindex)"
grep -q 'name="robots" content="noindex' resources/views/auth/register.blade.php && echo "   ✅ register.blade.php" || echo "   ⚠️  register.blade.php (pas de noindex)"
grep -q 'name="robots" content="noindex' resources/views/admin/layout.blade.php && echo "   ✅ admin/layout.blade.php" || echo "   ⚠️  admin/layout.blade.php (pas de noindex)"
grep -q 'name="robots" content="noindex' resources/views/client/layout.blade.php && echo "   ✅ client/layout.blade.php" || echo "   ⚠️  client/layout.blade.php (pas de noindex)"
echo ""

# 4. Vérifier robots.txt
echo "🔍 Vérification robots.txt..."
grep -q 'Disallow: /dashboard' public/robots.txt && echo "   ✅ /dashboard bloqué" || echo "   ⚠️  /dashboard non bloqué"
grep -q 'Disallow: /login' public/robots.txt && echo "   ✅ /login bloqué" || echo "   ⚠️  /login non bloqué"
grep -q 'Disallow: /client/' public/robots.txt && echo "   ✅ /client/ bloqué" || echo "   ⚠️  /client/ non bloqué"
echo ""

# 5. Tester le site localement
echo "🧪 Test site local..."
if command -v curl &> /dev/null; then
    # Démarrer serveur temporairement (si pas déjà démarré)
    if ! lsof -i:8000 &> /dev/null; then
        echo "   Démarrage serveur test..."
        php artisan serve --port=8000 &> /dev/null &
        SERVER_PID=$!
        sleep 3

        # Test homepage
        HTTP_CODE=$(curl -s -o /dev/null -w "%{http_code}" http://localhost:8000)
        if [ "$HTTP_CODE" = "200" ]; then
            echo "   ✅ Homepage accessible (HTTP $HTTP_CODE)"
        else
            echo "   ❌ Erreur homepage (HTTP $HTTP_CODE)"
            kill $SERVER_PID 2>/dev/null
            exit 1
        fi

        # Test login page
        HTTP_CODE=$(curl -s -o /dev/null -w "%{http_code}" http://localhost:8000/login)
        if [ "$HTTP_CODE" = "200" ]; then
            echo "   ✅ Page login accessible (HTTP $HTTP_CODE)"
        else
            echo "   ❌ Erreur page login (HTTP $HTTP_CODE)"
            kill $SERVER_PID 2>/dev/null
            exit 1
        fi

        kill $SERVER_PID 2>/dev/null
    else
        echo "   ℹ️  Serveur déjà en cours d'exécution sur port 8000"
    fi
else
    echo "   ⚠️  curl non disponible, skip tests HTTP"
fi
echo ""

# 6. Régénérer cache config
echo "♻️  Régénération cache configuration..."
php artisan config:cache
echo "   ✅ Config cache régénéré"
echo ""

# 7. Résumé des modifications
echo "═══════════════════════════════════════════════════════"
echo "✅ DÉPLOIEMENT LOCAL TERMINÉ!"
echo "═══════════════════════════════════════════════════════"
echo ""
echo "📝 Modifications appliquées:"
echo "   • Balise noindex ajoutée sur /login"
echo "   • Balise noindex ajoutée sur /register"
echo "   • Balise noindex ajoutée sur layout admin"
echo "   • Balise noindex ajoutée sur layout client"
echo "   • robots.txt mis à jour (/dashboard bloqué)"
echo ""
echo "🚀 Prochaines étapes:"
echo ""
echo "1️⃣  DÉPLOYER SUR PRODUCTION:"
echo "   git add ."
echo "   git commit -m \"SEO: Ajout noindex sur pages privées + robots.txt\""
echo "   git push origin main"
echo ""
echo "2️⃣  SUR LE SERVEUR DE PRODUCTION:"
echo "   ssh user@kreyatikstudio.fr"
echo "   cd /var/www/kreyatikstudio.fr"
echo "   git pull"
echo "   php artisan view:clear && php artisan cache:clear"
echo ""
echo "3️⃣  SOUS-DOMAINES (via FTP ou SSH):"
echo "   • Uploader robots-subdomain-mail.txt → mail.kreyatikstudio.fr/robots.txt"
echo "   • Uploader robots-subdomain-autoecole.txt → autoecole.kreyatikstudio.fr/robots.txt"
echo ""
echo "4️⃣  GOOGLE SEARCH CONSOLE:"
echo "   • Aller sur: https://search.google.com/search-console"
echo "   • Indexation > Suppressions"
echo "   • Demander suppression: mail.kreyatikstudio.fr/*"
echo "   • Demander suppression: autoecole.kreyatikstudio.fr/*"
echo "   • Demander suppression: /login, /client/dashboard, /home"
echo "   • Demander suppression: www.kreyatikstudio.fr/*"
echo ""
echo "📖 Documentation complète: SEO-FIXES-GSC.md"
echo ""
