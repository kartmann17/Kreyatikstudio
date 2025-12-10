# 🚀 Guide de Déploiement Production - Kreyatik Studio

## 📋 Résumé des Modifications

### ✅ Corrections & Améliorations
1. **Portfolio 403 Fix** - Import de 11 éléments portfolio en base de données
2. **SEO Service Fix** - Correction utilisation config au lieu de BDD pour pages statiques
3. **Optimisation Images** - Réduction hero image de 4.19MB à 165KB-973KB
4. **Favicon** - Support complet multi-tailles + PWA
5. **URL Portfolio** - Champ URL ajouté pour projets cliquables

## 🎯 Performance Gains

### Images Hero
- **Mobile** : 4.19MB → 165KB (-96%)
- **Tablette** : 4.19MB → 427KB (-90%)
- **Desktop** : 4.19MB → 973KB (-76%)
- **Impact LCP** : Amélioration de 3-4 secondes

### Portfolio
- 11 projets avec images/vidéos
- Chargement optimisé
- URLs cliquables

## 🚀 Déploiement Automatisé

### Option 1 : Script Complet (Recommandé)
```bash
# Sur le serveur de production
cd /chemin/vers/kreyatikstudio
git pull origin main
bash deploy-complete.sh
```

**Ce script effectue automatiquement** :
- ✅ Mise en maintenance
- ✅ Pull Git
- ✅ Installation dépendances (Composer + NPM)
- ✅ Build assets optimisés
- ✅ Migrations DB
- ✅ Import portfolio
- ✅ Vérification symlink storage
- ✅ Optimisation caches Laravel
- ✅ Sortie de maintenance
- ✅ Affichage statistiques

### Option 2 : Scripts Spécifiques

#### Import Portfolio Uniquement
```bash
bash import-portfolio-production.sh
```

#### Fix Portfolio + Favicon
```bash
bash deploy-portfolio-fix.sh
```

### Option 3 : Commandes Manuelles
```bash
# 1. Pull modifications
git pull origin main

# 2. Dépendances
composer install --no-dev --optimize-autoloader
npm ci
npm run build

# 3. Base de données
php artisan migrate --force
php artisan db:seed --class=PortfolioSeeder --force

# 4. Vérifier symlink
php artisan storage:link

# 5. Optimisation
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
php artisan cache:clear
```

## 📊 Vérifications Post-Déploiement

### 1. Portfolio
```bash
# Vérifier nombre d'items
php artisan tinker --execute='echo \App\Models\PortfolioItem::count() . " items\n";'
```
**Attendu** : 11 items

### 2. Page Portfolio
Tester : `https://kreyatikstudio.fr/Portfolio`
- ✅ 11 projets affichés
- ✅ Images chargées (pas de 403)
- ✅ Projets cliquables (si URL définie)

### 3. Image Hero Homepage
Tester : `https://kreyatikstudio.fr`
- ✅ Image chargée rapidement
- ✅ Version responsive selon device
- ✅ PageSpeed Insights amélioré

### 4. Favicon
- ✅ Visible dans l'onglet navigateur
- ✅ Logo Kreyatik Studio affiché

### 5. Fichiers Accessibles
Tester accès direct :
```
https://kreyatikstudio.fr/storage/images/portfolio/homepagein_1747059906.png
https://kreyatikstudio.fr/images/compose-768.jpg
https://kreyatikstudio.fr/favicon.ico
```

## ⚠️ Problèmes Possibles & Solutions

### Erreur 403 sur Images Portfolio
```bash
# Vérifier permissions
chmod -R 755 storage/app/public/images/portfolio/
chmod -R 755 public/storage/

# Recréer symlink si nécessaire
rm public/storage
php artisan storage:link
```

### Portfolio Vide
```bash
# Réimporter le seeder
php artisan db:seed --class=PortfolioSeeder --force
php artisan cache:clear
```

### Images Anciennes Versions en Cache
```bash
# Vider cache navigateur
# OU ajouter versioning :
# /images/compose-768.jpg?v=2
```

### Erreurs NPM Build
```bash
# Nettoyer et réinstaller
rm -rf node_modules package-lock.json
npm install
npm run build
```

### Base de Données Erreurs
```bash
# Vérifier connexion
php artisan tinker --execute='echo "DB OK\n";'

# Voir logs
tail -f storage/logs/laravel.log
```

## 📁 Fichiers Déployés

### Nouveaux Fichiers
```
database/seeders/PortfolioSeeder.php
database/migrations/2025_12_10_094153_add_url_to_portfolio_items_table.php
public/images/compose-768.jpg
public/images/compose-1280.jpg
public/images/compose-1536.jpg
public/images/compose-1920.jpg
public/favicon*.png
public/apple-touch-icon.png
public/android-chrome-*.png
public/site.webmanifest
deploy-complete.sh
deploy-portfolio-fix.sh
import-portfolio-production.sh
```

### Fichiers Modifiés
```
app/Services/SEOService.php
resources/js/Pages/Welcome.jsx
resources/views/app.blade.php
```

## 🔄 Workflow Déploiement Futur

Pour les prochains déploiements :

```bash
# 1. Local : développer et tester
git add .
git commit -m "Feature: Description"
git push origin main

# 2. Production : déployer
cd /chemin/vers/projet
bash deploy-complete.sh
```

## 📈 Métriques à Surveiller

### Google PageSpeed Insights
- **Performance** : Devrait passer en vert (>90)
- **LCP** : Amélioration significative (-3 à -4 secondes)
- **CLS** : Stable (images avec dimensions)

### Google Search Console
- Vérifier indexation
- Pas d'erreurs 404/403
- Sitemap à jour

### Analytics
- Temps de chargement réduit
- Taux de rebond potentiellement amélioré
- Meilleure UX mobile

## 📞 Support

En cas de problème :
1. Consulter logs : `storage/logs/laravel.log`
2. Vérifier permissions fichiers
3. Tester en local d'abord
4. Vérifier connexion base de données
5. Contacter l'hébergeur si nécessaire

## 🎉 Checklist Finale

Après déploiement, vérifier :
- [ ] Site accessible
- [ ] Page Portfolio : 11 projets
- [ ] Images chargées (pas de 403)
- [ ] Hero image rapide
- [ ] Favicon visible
- [ ] Pas d'erreurs en console
- [ ] PageSpeed Insights amélioré
- [ ] Mobile responsive

---

✅ **Version** : v1.0 - Production Ready
📅 **Date** : 10 décembre 2025
👨‍💻 **Développeur** : Claude Code + Lionel Blanchet
🌐 **Site** : https://kreyatikstudio.fr
