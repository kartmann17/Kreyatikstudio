#!/bin/bash

# Script de test des optimisations de performance
# Vérifie que toutes les optimisations sont actives

echo "🧪 Test des Optimisations de Performance"
echo "========================================"

# Couleurs
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
NC='\033[0m'

passed=0
failed=0

# Fonction de test
test_check() {
    local name="$1"
    local command="$2"

    if eval "$command" > /dev/null 2>&1; then
        echo -e "${GREEN}✓${NC} $name"
        ((passed++))
    else
        echo -e "${RED}✗${NC} $name"
        ((failed++))
    fi
}

echo ""
echo "1. Configuration Cache"
echo "----------------------"

# Test Redis dans .env
if grep -q "CACHE_STORE=redis" .env; then
    echo -e "${GREEN}✓${NC} CACHE_STORE=redis configuré"
    ((passed++))
else
    echo -e "${RED}✗${NC} CACHE_STORE=redis non configuré"
    ((failed++))
fi

if grep -q "SESSION_DRIVER=redis" .env; then
    echo -e "${GREEN}✓${NC} SESSION_DRIVER=redis configuré"
    ((passed++))
else
    echo -e "${RED}✗${NC} SESSION_DRIVER=redis non configuré"
    ((failed++))
fi

echo ""
echo "2. Redis Fonctionnel"
echo "--------------------"

if command -v redis-cli &> /dev/null; then
    if redis-cli ping > /dev/null 2>&1; then
        echo -e "${GREEN}✓${NC} Redis fonctionne (PONG reçu)"
        ((passed++))
    else
        echo -e "${RED}✗${NC} Redis ne répond pas"
        echo "   Démarrer: sudo systemctl start redis"
        ((failed++))
    fi
else
    echo -e "${YELLOW}⚠${NC} Redis CLI non installé (normal en local)"
    echo "   Installation: brew install redis (macOS)"
fi

# Test extension PHP Redis
if php -m | grep -q redis; then
    echo -e "${GREEN}✓${NC} Extension PHP Redis installée"
    ((passed++))
else
    echo -e "${RED}✗${NC} Extension PHP Redis manquante"
    echo "   Installation: brew install php-redis (macOS)"
    ((failed++))
fi

echo ""
echo "3. Fichiers d'Optimisation"
echo "--------------------------"

test_check "Middleware PerformanceHeaders.php existe" "[ -f app/Http/Middleware/PerformanceHeaders.php ]"
test_check "Script optimize-images.sh existe" "[ -f optimize-images.sh ]"
test_check "Script deploy-optimized.sh existe" "[ -f deploy-optimized.sh ]"
test_check "Documentation OPTIMISATION-PERFORMANCE.md" "[ -f OPTIMISATION-PERFORMANCE.md ]"

echo ""
echo "4. Optimisations Vite.js"
echo "------------------------"

if grep -q "minify: 'terser'" vite.config.js; then
    echo -e "${GREEN}✓${NC} Minification Terser activée"
    ((passed++))
else
    echo -e "${RED}✗${NC} Minification Terser non activée"
    ((failed++))
fi

if grep -q "drop_console" vite.config.js; then
    echo -e "${GREEN}✓${NC} Drop console.log configuré"
    ((passed++))
else
    echo -e "${RED}✗${NC} Drop console.log non configuré"
    ((failed++))
fi

echo ""
echo "5. Query Caching dans Contrôleurs"
echo "----------------------------------"

if grep -q "Cache::remember" app/Http/Controllers/WelcomeController.php; then
    echo -e "${GREEN}✓${NC} WelcomeController utilise le cache"
    ((passed++))
else
    echo -e "${RED}✗${NC} WelcomeController n'utilise pas le cache"
    ((failed++))
fi

if grep -q "Cache::remember" app/Http/Controllers/BlogController.php; then
    echo -e "${GREEN}✓${NC} BlogController utilise le cache"
    ((passed++))
else
    echo -e "${RED}✗${NC} BlogController n'utilise pas le cache"
    ((failed++))
fi

if grep -q "Cache::remember" app/Http/Controllers/NosOffresController.php; then
    echo -e "${GREEN}✓${NC} NosOffresController utilise le cache"
    ((passed++))
else
    echo -e "${RED}✗${NC} NosOffresController n'utilise pas le cache"
    ((failed++))
fi

echo ""
echo "6. Middleware Enregistré"
echo "------------------------"

if grep -q "PerformanceHeaders" bootstrap/app.php; then
    echo -e "${GREEN}✓${NC} PerformanceHeaders middleware enregistré"
    ((passed++))
else
    echo -e "${RED}✗${NC} PerformanceHeaders middleware non enregistré"
    ((failed++))
fi

echo ""
echo "7. Compression .htaccess"
echo "------------------------"

if grep -q "mod_deflate" public/.htaccess; then
    echo -e "${GREEN}✓${NC} Compression Gzip configurée (.htaccess)"
    ((passed++))
else
    echo -e "${RED}✗${NC} Compression Gzip non configurée"
    ((failed++))
fi

if grep -q "mod_expires" public/.htaccess; then
    echo -e "${GREEN}✓${NC} Cache headers configurés (.htaccess)"
    ((passed++))
else
    echo -e "${RED}✗${NC} Cache headers non configurés"
    ((failed++))
fi

echo ""
echo "8. Test Cache Laravel"
echo "---------------------"

# Test du cache Laravel
if php artisan tinker --execute="Cache::put('test_optim', 'works', 60); exit;" > /dev/null 2>&1; then
    if php artisan tinker --execute="echo Cache::get('test_optim'); exit;" 2>/dev/null | grep -q "works"; then
        echo -e "${GREEN}✓${NC} Cache Laravel fonctionne (read/write OK)"
        ((passed++))
        php artisan tinker --execute="Cache::forget('test_optim'); exit;" > /dev/null 2>&1
    else
        echo -e "${RED}✗${NC} Cache Laravel ne fonctionne pas correctement"
        ((failed++))
    fi
else
    echo -e "${RED}✗${NC} Impossible de tester le cache Laravel"
    ((failed++))
fi

echo ""
echo "========================================"
echo "Résultats"
echo "========================================"
echo -e "${GREEN}✓ Tests réussis: $passed${NC}"

if [ $failed -gt 0 ]; then
    echo -e "${RED}✗ Tests échoués: $failed${NC}"
    echo ""
    echo "⚠️  Certaines optimisations ne sont pas actives"
    echo "   Consultez OPTIMISATION-PERFORMANCE.md pour les résoudre"
    exit 1
else
    echo ""
    echo -e "${GREEN}🎉 Toutes les optimisations sont actives!${NC}"
    echo ""
    echo "Prochaines étapes:"
    echo "1. Déployer en production: ./deploy-optimized.sh"
    echo "2. Tester PageSpeed: https://pagespeed.web.dev/"
    echo "3. Monitorer les performances"
    exit 0
fi
