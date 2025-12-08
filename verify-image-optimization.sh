#!/bin/bash

echo "🔍 Vérification de l'optimisation des images..."
echo "================================================"
echo ""

# Couleurs
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Compteurs
success=0
errors=0

# Fonction de vérification
check_file() {
    local file=$1
    local name=$2

    if [ -f "$file" ]; then
        local size=$(du -h "$file" | cut -f1)
        echo -e "${GREEN}✅ $name${NC} ($size)"
        ((success++))
    else
        echo -e "${RED}❌ $name - FICHIER MANQUANT${NC}"
        ((errors++))
    fi
}

# Vérifier les images optimisées
echo "📁 Images Optimisées (public/images/optimized/):"
echo "------------------------------------------------"
check_file "public/images/optimized/compose.webp" "compose.webp (Hero Desktop)"
check_file "public/images/optimized/compose-mobile.webp" "compose-mobile.webp (Hero Mobile)"
check_file "public/images/optimized/Studiosansfond.webp" "Studiosansfond.webp (Logo)"
check_file "public/images/optimized/STUDIO.webp" "STUDIO.webp (Logo Alt)"

echo ""
echo "📁 Images Originales (Fallback):"
echo "------------------------------------------------"
check_file "public/images/compose.png" "compose.png (Fallback)"
check_file "public/images/Studiosansfond.png" "Studiosansfond.png (Fallback)"

echo ""
echo "📊 Comparaison des Tailles:"
echo "------------------------------------------------"

if [ -f "public/images/compose.png" ] && [ -f "public/images/optimized/compose.webp" ]; then
    original_size=$(stat -f%z "public/images/compose.png")
    optimized_size=$(stat -f%z "public/images/optimized/compose.webp")
    mobile_size=$(stat -f%z "public/images/optimized/compose-mobile.webp")

    # Calcul des économies
    savings=$((original_size - optimized_size))
    percentage=$((100 * savings / original_size))

    echo "compose.png:"
    echo "  Original:  $(numfmt --to=iec-i --suffix=B $original_size)"
    echo "  Desktop:   $(numfmt --to=iec-i --suffix=B $optimized_size) (économie: ${percentage}%)"
    echo "  Mobile:    $(numfmt --to=iec-i --suffix=B $mobile_size)"
fi

echo ""

if [ -f "public/images/Studiosansfond.png" ] && [ -f "public/images/optimized/Studiosansfond.webp" ]; then
    original_size=$(stat -f%z "public/images/Studiosansfond.png")
    optimized_size=$(stat -f%z "public/images/optimized/Studiosansfond.webp")

    savings=$((original_size - optimized_size))
    percentage=$((100 * savings / original_size))

    echo "Studiosansfond.png:"
    echo "  Original:  $(numfmt --to=iec-i --suffix=B $original_size)"
    echo "  Optimisé:  $(numfmt --to=iec-i --suffix=B $optimized_size) (économie: ${percentage}%)"
fi

echo ""
echo "================================================"
echo -e "Résultat: ${GREEN}${success} succès${NC} - ${RED}${errors} erreurs${NC}"
echo ""

if [ $errors -eq 0 ]; then
    echo -e "${GREEN}✨ Toutes les images sont optimisées et accessibles !${NC}"
    echo ""
    echo "📋 Prochaines étapes:"
    echo "  1. Tester le site en local"
    echo "  2. Vérifier l'affichage des images"
    echo "  3. Tester sur mobile et desktop"
    echo "  4. Vérifier avec Google PageSpeed Insights"
    exit 0
else
    echo -e "${RED}⚠️  Certains fichiers sont manquants !${NC}"
    echo "Relancez le script d'optimisation: php optimize-images.php"
    exit 1
fi
