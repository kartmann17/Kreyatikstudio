#!/bin/bash

# Script d'optimisation des images pour production
# Utilise imagemagick et optipng pour réduire la taille des images

echo "🖼️  Optimisation des images..."

# Couleurs pour l'affichage
GREEN='\033[0;32m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Vérifier si ImageMagick est installé
if ! command -v convert &> /dev/null; then
    echo "⚠️  ImageMagick n'est pas installé. Installation recommandée:"
    echo "   macOS: brew install imagemagick"
    echo "   Linux: sudo apt-get install imagemagick"
    exit 1
fi

# Fonction pour optimiser les JPG/JPEG
optimize_jpg() {
    local file="$1"
    local size_before=$(stat -f%z "$file" 2>/dev/null || stat -c%s "$file" 2>/dev/null)

    # Optimiser avec ImageMagick (qualité 85%, progressive, strip metadata)
    convert "$file" -quality 85 -strip -interlace Plane "$file.tmp" 2>/dev/null

    if [ -f "$file.tmp" ]; then
        mv "$file.tmp" "$file"
        local size_after=$(stat -f%z "$file" 2>/dev/null || stat -c%s "$file" 2>/dev/null)
        local saved=$((size_before - size_after))
        local percent=$((saved * 100 / size_before))
        echo -e "${GREEN}✓${NC} $(basename "$file"): -${percent}% (${saved} bytes économisés)"
    fi
}

# Fonction pour optimiser les PNG
optimize_png() {
    local file="$1"

    if command -v optipng &> /dev/null; then
        local size_before=$(stat -f%z "$file" 2>/dev/null || stat -c%s "$file" 2>/dev/null)
        optipng -quiet -o2 "$file" 2>/dev/null
        local size_after=$(stat -f%z "$file" 2>/dev/null || stat -c%s "$file" 2>/dev/null)
        local saved=$((size_before - size_after))
        if [ $saved -gt 0 ]; then
            local percent=$((saved * 100 / size_before))
            echo -e "${GREEN}✓${NC} $(basename "$file"): -${percent}% (${saved} bytes économisés)"
        fi
    else
        # Utiliser convert si optipng n'est pas disponible
        convert "$file" -quality 95 -strip "$file.tmp" 2>/dev/null
        if [ -f "$file.tmp" ]; then
            mv "$file.tmp" "$file"
            echo -e "${GREEN}✓${NC} $(basename "$file"): optimisé"
        fi
    fi
}

# Optimiser les images dans public/images
if [ -d "public/images" ]; then
    echo -e "\n${BLUE}📁 Optimisation des images dans public/images${NC}"
    find public/images -type f \( -iname "*.jpg" -o -iname "*.jpeg" \) | while read file; do
        optimize_jpg "$file"
    done

    find public/images -type f -iname "*.png" | while read file; do
        optimize_png "$file"
    done
fi

# Optimiser les images dans public/storage
if [ -d "public/storage" ]; then
    echo -e "\n${BLUE}📁 Optimisation des images dans public/storage${NC}"
    find public/storage -type f \( -iname "*.jpg" -o -iname "*.jpeg" \) | while read file; do
        optimize_jpg "$file"
    done

    find public/storage -type f -iname "*.png" | while read file; do
        optimize_png "$file"
    done
fi

echo -e "\n${GREEN}✅ Optimisation terminée!${NC}"
