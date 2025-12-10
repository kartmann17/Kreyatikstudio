# Guide de Déploiement - Correction Portfolio

## 🐛 Problème
Erreurs 403 sur tous les fichiers du portfolio en production car la base de données ne contient pas les entrées correspondantes.

## ✅ Solution
1. Import de tous les éléments portfolio dans la base de données via un seeder
2. Correction du SEOService pour utiliser la configuration au lieu de la BDD pour les pages statiques
3. Ajout du support favicon
4. Ajout du champ URL pour les projets portfolio

## 📦 Fichiers Modifiés/Ajoutés

### Nouveaux Fichiers
- `database/seeders/PortfolioSeeder.php` - Seeder pour importer les 11 éléments du portfolio
- `database/migrations/2025_12_10_094153_add_url_to_portfolio_items_table.php` - Migration pour le champ URL
- `deploy-portfolio-fix.sh` - Script de déploiement complet
- `import-portfolio-production.sh` - Script d'import portfolio uniquement
- Favicons (multiple tailles) + `site.webmanifest`

### Fichiers Modifiés
- `app/Services/SEOService.php` - Utilise maintenant `config/seo.php` pour les pages statiques
- `resources/views/app.blade.php` - Ajout des liens favicon

## 🚀 Déploiement en Production

### Option 1 : Déploiement Complet (Recommandé)
```bash
# Sur le serveur de production
cd /chemin/vers/le/projet
git pull origin main
bash deploy-portfolio-fix.sh
```

Le script effectue automatiquement :
- Mise en maintenance
- Pull des modifications
- Installation dépendances (Composer + NPM)
- Build des assets
- Migrations
- Import du portfolio (seeder)
- Optimisation des caches
- Sortie de maintenance

### Option 2 : Import Portfolio Uniquement
Si vous avez déjà déployé le code mais besoin d'importer juste les données :

```bash
# Sur le serveur de production
cd /chemin/vers/le/projet
bash import-portfolio-production.sh
```

OU manuellement :

```bash
php artisan db:seed --class=PortfolioSeeder --force
php artisan cache:clear
php artisan config:clear
```

### Option 3 : Commandes Manuelles
```bash
# 1. Pull des modifications
git pull origin main

# 2. Installer dépendances
composer install --no-dev --optimize-autoloader
npm install
npm run build

# 3. Migrations
php artisan migrate --force

# 4. Import portfolio
php artisan db:seed --class=PortfolioSeeder --force

# 5. Optimisation
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
php artisan cache:clear
```

## 📊 Vérification Post-Déploiement

### 1. Vérifier le nombre d'items portfolio
```bash
php artisan tinker --execute='echo \App\Models\PortfolioItem::count() . " items\n";'
```
Attendu : **11 items**

### 2. Tester la page Portfolio
Accéder à : `https://votre-domaine.com/Portfolio`

### 3. Vérifier les logs
```bash
tail -f storage/logs/laravel.log
```

### 4. Vérifier que les fichiers sont accessibles
Les 11 fichiers suivants doivent être accessibles en HTTP :
- homepagein_1747059906.png
- homepageloukart_1747060414.png
- enregistrement-de-lecran-2025-05-12-a-163638_1747061025.mp4
- capture-decran-2025-05-12-a-164618_1747061550.png
- enregistrement-de-lecran-2025-05-12-a-172647_1747063895.mp4
- capture-decran-2025-07-22-a-014307_1753141851.png
- capture-decran-2025-08-28-a-095821_1757625692.png
- capture-decran-2025-09-21-a-163042_1758465282.png
- capture-decran-2025-11-25-a-003006_1764027239.png
- kreyatik-studio-developpeur-web-la-rochell-rochefort-royan-wwwkreyatikstudiofr_1764115456.png
- capture-decran-2025-12-06-a-144557_1765028781.png

Test URL : `https://votre-domaine.com/storage/images/portfolio/[nom-fichier]`

## ⚠️ Points d'Attention

### Permissions Fichiers
Si les erreurs 403 persistent après l'import, vérifier les permissions :
```bash
chmod -R 755 storage/app/public/images/portfolio/
chmod -R 755 public/storage/
```

### Symlink Storage
Vérifier que le lien symbolique existe :
```bash
ls -la public/storage
# Doit pointer vers ../storage/app/public
```

Si absent :
```bash
php artisan storage:link
```

### Base de Données
Le seeder utilise `truncate()` qui supprime TOUS les items portfolio existants avant d'importer les nouveaux. Si vous avez des items personnalisés, modifier le seeder avant de l'exécuter.

## 🎨 Bonus : Favicon
Le déploiement inclut aussi :
- Favicon en multiples tailles (16x16, 32x32, 48x48)
- Apple Touch Icon (180x180)
- Android Chrome icons (192x192, 512x512)
- Manifeste PWA (`site.webmanifest`)
- Couleur de thème (#0099CC)

Visible immédiatement après déploiement dans l'onglet du navigateur.

## 📞 Support
En cas de problème :
1. Vérifier les logs : `storage/logs/laravel.log`
2. Vérifier la connexion DB
3. Vérifier les permissions fichiers
4. Tester en local d'abord

---

✅ **Commit actuel** : Fix: Portfolio 403 errors & Add favicon support
📅 **Date** : 10 décembre 2025
👨‍💻 **Développeur** : Claude Code + Lionel Blanchet
