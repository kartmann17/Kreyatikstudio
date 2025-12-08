<?php
/**
 * Script d'optimisation d'images pour le site Kreyatik Studio
 * Convertit les images PNG volumineuses en WebP et crée des versions redimensionnées
 */

// Configuration
$imagesToOptimize = [
    'compose.png' => [
        'webp_quality' => 80,
        'max_width' => 1920,
        'max_height' => 1080,
        'create_mobile' => true,
        'mobile_width' => 768,
    ],
    'Studiosansfond.png' => [
        'webp_quality' => 90,
        'max_width' => 200,  // Taille affichée réelle
        'max_height' => 100,
        'create_mobile' => false,
    ],
    'STUDIO.png' => [
        'webp_quality' => 85,
        'max_width' => 800,
        'max_height' => 800,
        'create_mobile' => false,
    ],
];

$baseDir = __DIR__ . '/public/images/';
$outputDir = __DIR__ . '/public/images/optimized/';

// Créer le dossier de sortie
if (!file_exists($outputDir)) {
    mkdir($outputDir, 0755, true);
    echo "✅ Dossier 'optimized' créé\n\n";
}

// Fonction pour créer une version WebP optimisée
function convertToWebP($source, $destination, $quality = 80) {
    $info = getimagesize($source);

    if ($info === false) {
        return false;
    }

    // Charger l'image selon son type
    switch ($info['mime']) {
        case 'image/jpeg':
            $image = imagecreatefromjpeg($source);
            break;
        case 'image/png':
            $image = imagecreatefrompng($source);
            break;
        case 'image/gif':
            $image = imagecreatefromgif($source);
            break;
        default:
            return false;
    }

    if ($image === false) {
        return false;
    }

    // Convertir en WebP
    $result = imagewebp($image, $destination, $quality);
    imagedestroy($image);

    return $result;
}

// Fonction pour redimensionner une image
function resizeImage($source, $destination, $maxWidth, $maxHeight, $quality = 80, $format = 'webp') {
    $info = getimagesize($source);

    if ($info === false) {
        return false;
    }

    list($width, $height) = $info;

    // Calculer les nouvelles dimensions en gardant le ratio
    $ratio = min($maxWidth / $width, $maxHeight / $height);

    // Si l'image est déjà plus petite, on utilise ses dimensions
    if ($ratio >= 1) {
        $newWidth = $width;
        $newHeight = $height;
    } else {
        $newWidth = (int)($width * $ratio);
        $newHeight = (int)($height * $ratio);
    }

    // Charger l'image source
    switch ($info['mime']) {
        case 'image/jpeg':
            $imageSource = imagecreatefromjpeg($source);
            break;
        case 'image/png':
            $imageSource = imagecreatefrompng($source);
            break;
        case 'image/gif':
            $imageSource = imagecreatefromgif($source);
            break;
        default:
            return false;
    }

    if ($imageSource === false) {
        return false;
    }

    // Créer la nouvelle image
    $imageResized = imagecreatetruecolor($newWidth, $newHeight);

    // Préserver la transparence pour PNG
    if ($info['mime'] === 'image/png') {
        imagealphablending($imageResized, false);
        imagesavealpha($imageResized, true);
        $transparent = imagecolorallocatealpha($imageResized, 255, 255, 255, 127);
        imagefilledrectangle($imageResized, 0, 0, $newWidth, $newHeight, $transparent);
    }

    // Redimensionner
    imagecopyresampled($imageResized, $imageSource, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

    // Sauvegarder selon le format
    $result = false;
    if ($format === 'webp') {
        $result = imagewebp($imageResized, $destination, $quality);
    } elseif ($format === 'png') {
        $result = imagepng($imageResized, $destination, 9);
    } elseif ($format === 'jpg') {
        $result = imagejpeg($imageResized, $destination, $quality);
    }

    imagedestroy($imageSource);
    imagedestroy($imageResized);

    return $result ? ['width' => $newWidth, 'height' => $newHeight] : false;
}

// Formater la taille de fichier
function formatBytes($bytes, $precision = 2) {
    $units = ['B', 'KB', 'MB', 'GB'];
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= (1 << (10 * $pow));
    return round($bytes, $precision) . ' ' . $units[$pow];
}

echo "🚀 Démarrage de l'optimisation des images...\n\n";
echo "=" . str_repeat("=", 70) . "\n\n";

$totalSavings = 0;

// Optimiser chaque image
foreach ($imagesToOptimize as $filename => $config) {
    $sourcePath = $baseDir . $filename;

    if (!file_exists($sourcePath)) {
        echo "❌ Image non trouvée: $filename\n\n";
        continue;
    }

    $originalSize = filesize($sourcePath);
    $baseName = pathinfo($filename, PATHINFO_FILENAME);

    echo "📸 Traitement de: $filename\n";
    echo "   Taille originale: " . formatBytes($originalSize) . "\n";

    // 1. Créer version WebP principale
    $webpPath = $outputDir . $baseName . '.webp';
    $dimensions = resizeImage($sourcePath, $webpPath, $config['max_width'], $config['max_height'], $config['webp_quality']);

    if ($dimensions && file_exists($webpPath)) {
        $webpSize = filesize($webpPath);
        $savings = $originalSize - $webpSize;
        $totalSavings += $savings;
        $percentage = round(($savings / $originalSize) * 100, 1);

        echo "   ✅ WebP créé: {$dimensions['width']}x{$dimensions['height']}\n";
        echo "   📦 Taille WebP: " . formatBytes($webpSize) . " (économie de $percentage%)\n";
    } else {
        echo "   ❌ Échec création WebP\n";
    }

    // 2. Créer version mobile si nécessaire
    if ($config['create_mobile']) {
        $mobileWebpPath = $outputDir . $baseName . '-mobile.webp';
        $mobileDimensions = resizeImage($sourcePath, $mobileWebpPath, $config['mobile_width'], (int)($config['mobile_width'] * 9/16), $config['webp_quality']);

        if ($mobileDimensions && file_exists($mobileWebpPath)) {
            $mobileSize = filesize($mobileWebpPath);
            echo "   ✅ WebP mobile créé: {$mobileDimensions['width']}x{$mobileDimensions['height']}\n";
            echo "   📦 Taille mobile: " . formatBytes($mobileSize) . "\n";
        }
    }

    echo "\n";
}

echo "=" . str_repeat("=", 70) . "\n";
echo "✨ Optimisation terminée !\n";
echo "💾 Économie totale: " . formatBytes($totalSavings) . "\n";
echo "📂 Images optimisées dans: public/images/optimized/\n\n";

echo "📋 Prochaines étapes:\n";
echo "   1. Vérifiez les images dans le dossier 'optimized'\n";
echo "   2. Mettez à jour les vues pour utiliser les images WebP\n";
echo "   3. Implémentez un fallback PNG pour les navigateurs non compatibles\n";
echo "   4. Testez le site sur différents navigateurs\n\n";
