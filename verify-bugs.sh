#!/bin/bash
# Script de vérification automatique des bugs identifiés
# Date: 2025-11-03

echo "═══════════════════════════════════════════════════════════════"
echo " 🔍 VÉRIFICATION BUGS - Analyse Automatique"
echo "═══════════════════════════════════════════════════════════════"
echo ""

ERRORS=0
WARNINGS=0

# Vérifier qu'on est dans le bon dossier
if [ ! -f "artisan" ]; then
    echo "❌ Erreur: Ce script doit être exécuté depuis la racine du projet Laravel"
    exit 1
fi

echo "✅ Dossier projet: $(pwd)"
echo ""

# ═══════════════════════════════════════════════════════════════
# TESTS CRITIQUE
# ═══════════════════════════════════════════════════════════════

echo "═══════════════════════════════════════════════════════════════"
echo " 🚨 TESTS CRITIQUE"
echo "═══════════════════════════════════════════════════════════════"
echo ""

# Test 1: TimeLog durée bug
echo "1️⃣  Test TimeLog - Durée secondes vs minutes..."
if grep -q "floor(\$this->duration / 60)" app/Models/TimeLog.php; then
    echo "   🔴 BUG DÉTECTÉ: TimeLog calcule durée comme minutes au lieu de secondes"
    echo "      Fichier: app/Models/TimeLog.php ligne ~99"
    echo "      Impact: Toutes les durées sont fausses (facteur x60)"
    ERRORS=$((ERRORS + 1))
else
    echo "   ✅ TimeLog calcul OK"
fi
echo ""

# Test 2: Client authorization
echo "2️⃣  Test Sécurité - Client ProjectController..."
if grep -q "findOrFail(\$id)" app/Http/Controllers/Client/ProjectController.php 2>/dev/null; then
    if ! grep -q "where('client_id'" app/Http/Controllers/Client/ProjectController.php 2>/dev/null; then
        echo "   🔴 FAILLE SÉCURITÉ: Client peut voir projets d'autres clients"
        echo "      Fichier: app/Http/Controllers/Client/ProjectController.php"
        echo "      Impact: FUITE DE DONNÉES"
        ERRORS=$((ERRORS + 1))
    else
        echo "   ✅ Vérification client_id présente"
    fi
else
    echo "   ℹ️  Fichier Client/ProjectController non trouvé ou pas de méthode show()"
fi
echo ""

# Test 3: User sans client_id
echo "3️⃣  Test Middleware - User sans client_id..."
if [ -f "app/Http/Middleware/EnsureUserHasClient.php" ]; then
    echo "   ✅ Middleware EnsureUserHasClient existe"
else
    echo "   🟠 AVERTISSEMENT: Pas de middleware pour vérifier client_id"
    echo "      Impact: User sans client_id peut accéder espace client"
    WARNINGS=$((WARNINGS + 1))
fi
echo ""

# Test 4: Fichier cache emergency public
echo "4️⃣  Test Sécurité - Fichier cache public..."
if [ -f "public/clear-cache-emergency.php" ]; then
    echo "   🔴 RISQUE SÉCURITÉ: Fichier cache accessible publiquement"
    echo "      Fichier: public/clear-cache-emergency.php"
    echo "      Action: SUPPRIMER IMMÉDIATEMENT"
    ERRORS=$((ERRORS + 1))
else
    echo "   ✅ Pas de fichier cache emergency public"
fi
echo ""

# ═══════════════════════════════════════════════════════════════
# TESTS HAUTE PRIORITÉ
# ═══════════════════════════════════════════════════════════════

echo "═══════════════════════════════════════════════════════════════"
echo " 🟠 TESTS HAUTE PRIORITÉ"
echo "═══════════════════════════════════════════════════════════════"
echo ""

# Test 5: Constants Task inutilisés
echo "5️⃣  Test Incohérence - Constants Task..."
if grep -q "const STATUS_TODO" app/Models/Task.php; then
    # Vérifier s'ils sont utilisés
    if grep -q "self::STATUS_TODO\|Task::STATUS_TODO" app/Models/Task.php app/Http/Controllers/Admin/TaskController.php 2>/dev/null; then
        echo "   ✅ Constants Task utilisés"
    else
        echo "   🟠 INCOHÉRENCE: Constants définis mais pas utilisés"
        echo "      Fichier: app/Models/Task.php lignes 46-57"
        echo "      Impact: Code confus, valeurs en dur partout"
        WARNINGS=$((WARNINGS + 1))
    fi
else
    echo "   ℹ️  Pas de constants dans Task.php"
fi
echo ""

# Test 6: API articles permission
echo "6️⃣  Test Sécurité - API articles..."
if grep -q "api/articles/publish" routes/web.php; then
    if grep -q "role:admin" routes/web.php | grep -q "api/articles/publish"; then
        echo "   ✅ API articles protégé par rôle"
    else
        echo "   🟠 SÉCURITÉ: API articles sans vérification permission"
        echo "      Fichier: routes/web.php ligne ~437"
        echo "      Impact: N'importe qui peut publier articles"
        WARNINGS=$((WARNINGS + 1))
    fi
fi
echo ""

# Test 7: Ticket number random
echo "7️⃣  Test Fonctionnel - Numéro ticket..."
if grep -q "random_int" app/Models/Ticket.php; then
    echo "   🟠 RISQUE: Numéro ticket utilise random (risque collision)"
    echo "      Fichier: app/Models/Ticket.php ligne ~59"
    echo "      Impact: 2 tickets peuvent avoir même numéro"
    WARNINGS=$((WARNINGS + 1))
else
    echo "   ✅ Numéro ticket séquentiel"
fi
echo ""

# ═══════════════════════════════════════════════════════════════
# TESTS PRIORITÉ MOYENNE
# ═══════════════════════════════════════════════════════════════

echo "═══════════════════════════════════════════════════════════════"
echo " 🟡 TESTS PRIORITÉ MOYENNE"
echo "═══════════════════════════════════════════════════════════════"
echo ""

# Test 8: Relations User manquantes
echo "8️⃣  Test Relations - User model..."
MISSING_RELATIONS=0
if ! grep -q "function projects()" app/Models/User.php; then
    echo "   🟡 Relation manquante: User->projects()"
    MISSING_RELATIONS=$((MISSING_RELATIONS + 1))
fi
if ! grep -q "function tasks()" app/Models/User.php; then
    echo "   🟡 Relation manquante: User->tasks()"
    MISSING_RELATIONS=$((MISSING_RELATIONS + 1))
fi
if ! grep -q "function timeLogs()" app/Models/User.php; then
    echo "   🟡 Relation manquante: User->timeLogs()"
    MISSING_RELATIONS=$((MISSING_RELATIONS + 1))
fi
if ! grep -q "function createdTickets()" app/Models/User.php; then
    echo "   🟡 Relation manquante: User->createdTickets()"
    MISSING_RELATIONS=$((MISSING_RELATIONS + 1))
fi

if [ $MISSING_RELATIONS -gt 0 ]; then
    echo "   Total: $MISSING_RELATIONS relations manquantes"
    WARNINGS=$((WARNINGS + 1))
else
    echo "   ✅ Toutes les relations présentes"
fi
echo ""

# Test 9: N+1 queries
echo "9️⃣  Test Performance - N+1 queries..."
if grep -q "Project::with('client')->get()" app/Http/Controllers/Admin/ProjectController.php; then
    echo "   🟡 PERFORMANCE: Pas de pagination dans ProjectController"
    echo "      Fichier: app/Http/Controllers/Admin/ProjectController.php ligne ~34"
    echo "      Impact: Lenteur avec beaucoup de projets"
    WARNINGS=$((WARNINGS + 1))
else
    echo "   ✅ Pagination présente"
fi
echo ""

# Test 10: Routes dupliquées
echo "🔟 Test Routes - Duplicatas..."
COMMENT_COUNT=$(grep -c "'{id}/comment'" routes/web.php)
REPLY_COUNT=$(grep -c "'{id}/reply'" routes/web.php)
if [ "$COMMENT_COUNT" -gt 0 ] && [ "$REPLY_COUNT" -gt 0 ]; then
    echo "   🟡 Routes dupliquées: /comment et /reply appellent même méthode"
    echo "      Fichier: routes/web.php lignes ~422-423"
    WARNINGS=$((WARNINGS + 1))
else
    echo "   ✅ Pas de routes dupliquées détectées"
fi
echo ""

# Test 11: Dates hardcodées concours
echo "1️⃣1️⃣  Test Configuration - Dates concours..."
if grep -q "Carbon::create(2025, 10, 13)" app/Http/Controllers/ContestController.php 2>/dev/null; then
    echo "   🟡 MAINTENANCE: Dates concours hardcodées dans code"
    echo "      Fichier: app/Http/Controllers/ContestController.php"
    echo "      Impact: Doit modifier code pour changer dates"
    WARNINGS=$((WARNINGS + 1))
else
    echo "   ✅ Dates en configuration"
fi
echo ""

# ═══════════════════════════════════════════════════════════════
# TESTS QUALITÉ CODE
# ═══════════════════════════════════════════════════════════════

echo "═══════════════════════════════════════════════════════════════"
echo " ⚪ TESTS QUALITÉ CODE"
echo "═══════════════════════════════════════════════════════════════"
echo ""

# Test 12: Fichiers emergency
echo "1️⃣2️⃣  Test Organisation - Fichiers emergency root..."
EMERGENCY_FILES=$(find . -maxdepth 1 -type f \( -name "*URGENTE*" -o -name "*FIX-*" -o -name "*EMERGENCY*" \) | wc -l)
if [ "$EMERGENCY_FILES" -gt 0 ]; then
    echo "   ⚪ $EMERGENCY_FILES fichiers emergency dans root"
    echo "      Action: Déplacer vers /docs ou supprimer"
    find . -maxdepth 1 -type f \( -name "*URGENTE*" -o -name "*FIX-*" -o -name "*EMERGENCY*" \) | sed 's/^/      - /'
else
    echo "   ✅ Pas de fichiers emergency dans root"
fi
echo ""

# Test 13: URLs incohérentes
echo "1️⃣3️⃣  Test Routes - Nommage URLs..."
PASCAL_ROUTES=$(grep -c "Route::get('/[A-Z]" routes/web.php)
if [ "$PASCAL_ROUTES" -gt 0 ]; then
    echo "   ⚪ $PASCAL_ROUTES URLs en PascalCase détectées"
    echo "      Recommandation: Standardiser en kebab-case"
    grep "Route::get('/[A-Z]" routes/web.php | sed 's/^/      /'
else
    echo "   ✅ URLs cohérentes"
fi
echo ""

# ═══════════════════════════════════════════════════════════════
# RÉSUMÉ
# ═══════════════════════════════════════════════════════════════

echo "═══════════════════════════════════════════════════════════════"
echo " 📊 RÉSUMÉ"
echo "═══════════════════════════════════════════════════════════════"
echo ""

TOTAL=$((ERRORS + WARNINGS))

if [ $ERRORS -gt 0 ]; then
    echo "🔴 ERREURS CRITIQUES: $ERRORS"
fi

if [ $WARNINGS -gt 0 ]; then
    echo "🟠 AVERTISSEMENTS: $WARNINGS"
fi

if [ $TOTAL -eq 0 ]; then
    echo "✅ AUCUN PROBLÈME DÉTECTÉ!"
else
    echo ""
    echo "Total problèmes: $TOTAL"
fi

echo ""
echo "═══════════════════════════════════════════════════════════════"
echo " 📖 DOCUMENTATION COMPLÈTE"
echo "═══════════════════════════════════════════════════════════════"
echo ""
echo "  📄 ANALYSE-COMPLETE-BUGS.md  → Rapport détaillé (~50 issues)"
echo "  📄 SEO-FIXES-GSC.md          → Corrections SEO Google"
echo "  📄 SEO-ACTIONS-URGENTES.md   → Actions SEO rapides"
echo ""

if [ $ERRORS -gt 0 ]; then
    echo "⚠️  ATTENTION: Corriger les erreurs CRITIQUES immédiatement!"
    exit 1
elif [ $WARNINGS -gt 0 ]; then
    echo "ℹ️  Consulter ANALYSE-COMPLETE-BUGS.md pour plan d'action"
    exit 0
else
    echo "✅ Projet en bon état!"
    exit 0
fi
