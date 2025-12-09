# 🔴 Problème Récurrent: Cache Blade Corrompu chez O2Switch

Date : 9 décembre 2024  
Hébergeur : o2switch (serveur truelle)

---

## 🚨 SYMPTÔMES

### ParseError Récurrents

**Erreur typique** :
```
ParseError - Internal Server Error
syntax error, unexpected end of file, expecting "elseif" or "else" or "endif"
```

**Pages affectées jusqu'ici** :
- ✅ Homepage (résolu)
- ✅ Header global (résolu)
- 🔴 **Page À propos** (actuel)

**Pattern** : Après chaque `git pull`, le cache Blade se corrompt.

---

## 🔍 DIAGNOSTIC TECHNIQUE

### Pourquoi ça arrive chez O2Switch ?

#### 1. **Cache OPcache Agressif**

O2switch utilise **OPcache** (cache PHP) très agressif :
- Les fichiers PHP compilés sont mis en cache
- Le TTL (Time To Live) est long
- Le cache n'est pas invalidé automatiquement après `git pull`

#### 2. **Processus PHP-FPM Persistants**

- Les workers PHP-FPM gardent les fichiers en mémoire
- Même après `rm -f`, les processus ont déjà chargé l'ancien cache
- Les nouveaux fichiers ne sont pas rechargés immédiatement

#### 3. **Timing de Compilation Blade**

Voici ce qui se passe lors d'un déploiement :

```
1. git pull (nouveau code)
   ↓
2. Laravel compile header.blade.php
   ↓
3. MAIS le header inclut footer.blade.php
   ↓
4. footer.blade.php N'EST PAS ENCORE compilé (ancien cache)
   ↓
5. RÉSULTAT: Fichier compilé MIXTE (nouveau + ancien)
   ↓
6. ParseError: directives Blade déséquilibrées
```

#### 4. **rm -rf vs rm -f**

Sur o2switch, `rm -rf storage/framework/views/*` peut échouer silencieusement :
- Permissions spécifiques
- Fichiers verrouillés par PHP
- Wildcard expansion limitée

**Solution** : `rm -f storage/framework/views/*.php` (plus spécifique)

---

## ✅ SOLUTION IMMÉDIATE

### Commandes à Exécuter sur le Serveur

```bash
ssh fite6981@truelle.o2switch.net
cd public_html/KreyatikLaravel

# 1. Supprimer TOUT le cache
rm -f storage/framework/views/*.php
rm -rf storage/framework/cache/data/*

# 2. Clear tous les caches Laravel
php artisan view:clear
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan optimize:clear

# 3. Permissions
chmod -R 775 storage/framework/views
chmod -R 775 storage/framework/cache

# 4. Tester
curl -I https://kreyatikstudio.fr/a-propos
# Doit retourner: HTTP/2 200
```

---

## 🛡️ SOLUTION PERMANENTE

### Option A : Script de Déploiement Automatique

Créer un fichier `deploy.sh` sur le serveur :

```bash
#!/bin/bash
# /home/fite6981/public_html/KreyatikLaravel/deploy.sh

echo "🚀 Déploiement Kreyatik Studio"

# 1. Pull le code
git pull origin main

# 2. CRITIQUE: Vider le cache IMMÉDIATEMENT
rm -f storage/framework/views/*.php
rm -rf storage/framework/cache/data/*

# 3. Clear tous les caches
php artisan view:clear
php artisan cache:clear  
php artisan config:clear
php artisan route:clear

# 4. Rebuild les caches optimisés
php artisan config:cache
php artisan route:cache

# 5. Permissions
chmod -R 775 storage/

# 6. Test
echo "Test du site..."
if curl -I https://kreyatikstudio.fr 2>&1 | grep -q "HTTP/2 200"; then
    echo "✅ Site OK"
else
    echo "❌ ERREUR - Site DOWN"
    exit 1
fi

echo "✅ Déploiement terminé"
```

**Usage** :
```bash
ssh fite6981@truelle.o2switch.net
cd public_html/KreyatikLaravel
bash deploy.sh
```

### Option B : Hook Git Post-Merge

Créer `.git/hooks/post-merge` :

```bash
#!/bin/bash
# Exécuté automatiquement après chaque git pull

rm -f storage/framework/views/*.php
rm -rf storage/framework/cache/data/*
php artisan optimize:clear
chmod -R 775 storage/

echo "✅ Cache cleared après git pull"
```

Rendre exécutable :
```bash
chmod +x .git/hooks/post-merge
```

### Option C : Désactiver OPcache pour Laravel (Risqué)

Créer `.user.ini` à la racine :
```ini
opcache.enable=0
```

⚠️ **Déconseillé** : Réduit les performances

### Option D : Forcer Revalidation OPcache

Dans `.user.ini` :
```ini
opcache.revalidate_freq=0
opcache.validate_timestamps=1
```

Cela force OPcache à vérifier les changements à chaque requête.

---

## 📋 CHECKLIST DE DÉPLOIEMENT

Suivre **TOUJOURS** cette procédure :

### Avant le Déploiement
- [ ] Tester en local : `php artisan serve`
- [ ] Vérifier directives Blade équilibrées
- [ ] Commit et push sur GitHub

### Pendant le Déploiement
- [ ] SSH vers o2switch
- [ ] `git pull origin main`
- [ ] **IMMÉDIATEMENT** : `rm -f storage/framework/views/*.php`
- [ ] `php artisan optimize:clear`
- [ ] `chmod -R 775 storage/`

### Après le Déploiement
- [ ] Tester homepage : `curl -I https://kreyatikstudio.fr`
- [ ] Tester pages modifiées
- [ ] Vérifier logs : `tail -50 storage/logs/laravel.log`
- [ ] Tester navigation complète dans le navigateur

### Si Erreur
- [ ] `rm -f storage/framework/views/*.php`
- [ ] `php artisan optimize:clear`
- [ ] Si persiste : Redémarrer PHP-FPM via cPanel
- [ ] Si persiste : `git pull --force` puis clear cache

---

## 🔧 COMMANDES DE DIAGNOSTIC

### Vérifier le Cache Compilé

```bash
# Lister les fichiers cache
ls -lh storage/framework/views/

# Chercher des erreurs dans les fichiers compilés
grep -r "elseif\|endif" storage/framework/views/ | grep -v "endphp"

# Trouver le fichier cache d'une vue spécifique
php artisan view:cache
# Puis chercher dans storage/framework/views/
```

### Vérifier les Processus PHP

```bash
# Processus PHP actifs
ps aux | grep php-fpm

# Fichiers ouverts par PHP
lsof | grep storage/framework/views
```

### Vérifier OPcache

Créer `opcache-status.php` :
```php
<?php
phpinfo();
// Chercher section "Zend OPcache"
```

Ou via CLI :
```bash
php -i | grep opcache
```

---

## 📊 STATISTIQUES DES INCIDENTS

| Date | Page | Cause | Solution | Temps de résolution |
|------|------|-------|----------|---------------------|
| 8 déc 2024 | Homepage | Cache header corrompu | rm cache + clear | 30 min |
| 8 déc 2024 | Header global | Cache mixte après pull | rm cache + clear | 45 min |
| 9 déc 2024 | À propos | Cache après ajout navbar | rm cache + clear | En cours |

**Pattern** : Toujours après un `git pull` avec modifications de vues.

---

## 💡 RECOMMANDATIONS LONG TERME

### 1. Environnement de Staging

Créer `staging.kreyatikstudio.fr` :
- Tester TOUS les déploiements là-bas d'abord
- Même hébergeur, même config
- Si ça marche en staging → OK pour prod

### 2. CI/CD Automatisé

Utiliser GitHub Actions :
```yaml
name: Deploy to Production
on:
  push:
    branches: [main]
jobs:
  deploy:
    runs-on: ubuntu-latest
    steps:
      - name: Deploy via SSH
        run: |
          ssh ${{ secrets.SSH_USER }}@${{ secrets.SSH_HOST }} '
            cd /path/to/app
            git pull
            rm -f storage/framework/views/*.php
            php artisan optimize:clear
          '
```

### 3. Monitoring Post-Déploiement

Ajouter dans le script de déploiement :
```bash
# Envoyer notification si erreur
if [ $? -ne 0 ]; then
    curl -X POST https://api.telegram.org/bot.../sendMessage \
      -d chat_id=... \
      -d text="🚨 Déploiement échoué sur kreyatikstudio.fr"
fi
```

### 4. Health Check Endpoint

Créer `/health` :
```php
Route::get('/health', function() {
    return response()->json([
        'status' => 'ok',
        'cache' => Cache::has('test') ? 'working' : 'error',
        'database' => DB::connection()->getPdo() ? 'connected' : 'error'
    ]);
});
```

Tester après chaque déploiement.

---

## 🎯 CONCLUSION

**Le problème n'est PAS votre code** - Il est syntaxiquement correct.

**Le problème EST l'infrastructure o2switch** :
- Cache OPcache agressif
- Processus PHP-FPM persistants
- Timing de compilation Blade

**Solution** : Toujours vider le cache IMMÉDIATEMENT après `git pull`.

**Workflow idéal** :
```bash
git pull && rm -f storage/framework/views/*.php && php artisan optimize:clear
```

Une seule commande, aucune chance d'oublier.

---

*Document créé le 9 décembre 2024*  
*Kreyatik Studio - Diagnostic O2Switch Cache*  
*Version : 1.0*
