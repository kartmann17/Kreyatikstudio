# ⚡ Commandes Rapides - Optimisations Performance

**Pour référence rapide** - Commandes essentielles pour gérer les optimisations

---

## 🧪 Tester les Optimisations (Local)

```bash
# Test complet de toutes les optimisations
./test-optimizations.sh

# Résultat attendu: "🎉 Toutes les optimisations sont actives!"
```

---

## 🚀 Déploiement Production

```bash
# Déploiement automatisé complet
./deploy-optimized.sh

# Ou manuellement:
php artisan down
git pull origin main
composer install --no-dev --optimize-autoloader
npm ci && npm run build
./optimize-images.sh
php artisan migrate --force
php artisan optimize
sudo systemctl restart php8.2-fpm nginx
php artisan up
```

---

## 🖼️ Optimiser les Images

```bash
# Optimiser toutes les images (JPG/PNG)
./optimize-images.sh

# Gain typique: -50% à -70% de taille
```

---

## 🗄️ Gestion du Cache

### Nettoyer le Cache

```bash
# Nettoyer TOUT
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# OU utiliser la commande custom
php artisan cache:clear-all
```

### Invalider des Clés Spécifiques

```bash
php artisan tinker

# Homepage articles
>>> Cache::forget('homepage.articles');

# Articles similaires (remplacer 123 par ID article)
>>> Cache::forget('article.123.similar');

# Pricing plans
>>> Cache::forget('pricing.plans');

# Nettoyer tout
>>> Cache::flush();

# Quitter
>>> exit;
```

### Créer les Caches Optimisés

```bash
# Pour production
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
php artisan optimize

# Résultat: Site 30-50% plus rapide
```

---

## 🔍 Vérifications

### Tester Redis

```bash
# 1. Vérifier que Redis fonctionne
redis-cli ping
# Devrait afficher: PONG

# 2. Tester le cache Laravel avec Redis
php artisan tinker
>>> Cache::put('test', 'hello', 60);
>>> Cache::get('test');
# Devrait afficher: "hello"
>>> exit;
```

### Tester la Compression

```bash
# Vérifier compression Gzip/Brotli
curl -I https://kreyatikstudio.fr | grep -i content-encoding

# Devrait afficher:
# content-encoding: br    (Brotli - meilleur)
# OU
# content-encoding: gzip  (Gzip - bon)
```

### Tester PageSpeed

```bash
# Ouvrir dans le navigateur:
https://pagespeed.web.dev/

# Tester: https://kreyatikstudio.fr
# Score attendu: 85-95 (mobile), 95-100 (desktop)
```

---

## 🔧 Build Production

### Assets (CSS/JS)

```bash
# Build optimisé pour production
npm run build

# Résultat:
# - Fichiers minifiés
# - Console.log supprimés
# - Vendors séparés
# - -50% de taille
```

### Laravel

```bash
# Optimisation complète Laravel
php artisan optimize

# Inclut:
# - config:cache
# - route:cache
# - view:cache
# - event:cache
```

---

## 🔄 Après Modification de Contenu

### Si vous modifiez un Article

```bash
php artisan tinker
>>> Cache::forget('homepage.articles');
>>> Cache::forget('article.ID.similar');  # Remplacer ID
>>> exit;
```

### Si vous modifiez les Offres

```bash
php artisan tinker
>>> Cache::forget('pricing.plans');
>>> exit;
```

### Si vous modifiez la Config

```bash
php artisan config:clear
php artisan config:cache
```

---

## 📊 Monitoring Performance

### Vérifier les Stats Redis

```bash
# Statistiques Redis
redis-cli info stats

# Surveiller en temps réel
redis-cli monitor
```

### Logs Laravel

```bash
# Logs en temps réel
tail -f storage/logs/laravel.log

# Rechercher des erreurs
grep ERROR storage/logs/laravel.log
```

---

## 🆘 Dépannage Rapide

### Redis ne fonctionne pas

```bash
# Démarrer Redis
sudo systemctl start redis

# Vérifier status
sudo systemctl status redis

# Redémarrer
sudo systemctl restart redis
```

### Cache non invalidé

```bash
# Nettoyer tout
php artisan cache:clear
php artisan config:clear

# Redémarrer PHP
sudo systemctl restart php8.2-fpm
```

### Site lent après déploiement

```bash
# 1. Vérifier que Redis fonctionne
redis-cli ping

# 2. Recréer les caches
php artisan optimize

# 3. Vérifier les logs
tail -f storage/logs/laravel.log
```

---

## 📈 Commandes de Mesure

### Temps de Réponse

```bash
# Mesurer temps de chargement
curl -o /dev/null -s -w 'Time: %{time_total}s\n' https://kreyatikstudio.fr

# Résultat attendu: < 1s
```

### Taille des Réponses

```bash
# Vérifier la taille avec compression
curl -H "Accept-Encoding: gzip,deflate" -I https://kreyatikstudio.fr

# Vérifier Content-Length (devrait être petit)
```

---

## 🎯 Checklist Rapide

**Avant déploiement:**
```bash
☐ ./test-optimizations.sh  # Tout doit être vert
☐ npm run build             # Assets buildés
☐ ./optimize-images.sh      # Images optimisées
```

**Déploiement:**
```bash
☐ ./deploy-optimized.sh     # Déploiement automatique
```

**Après déploiement:**
```bash
☐ redis-cli ping            # PONG
☐ curl -I site | grep encoding  # br ou gzip
☐ PageSpeed Insights        # Score > 85
```

---

## 📚 Fichiers Documentation

- **Guide complet**: `OPTIMISATION-PERFORMANCE.md`
- **Résumé**: `OPTIMISATIONS-RESUME.md`
- **Ce fichier**: `COMMANDES-PERFORMANCE.md` (aide-mémoire)

---

**Astuce Pro**: Ajoutez ces commandes à vos alias bash:

```bash
# Dans ~/.bashrc ou ~/.zshrc
alias art='php artisan'
alias cache-clear='php artisan cache:clear-all'
alias cache-prod='php artisan optimize'
alias deploy='./deploy-optimized.sh'
alias test-perf='./test-optimizations.sh'
```

**Gain de temps**: 80% de commandes en moins à taper! 🚀
