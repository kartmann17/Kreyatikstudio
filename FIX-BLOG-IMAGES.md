# Fix Blog Images - Articles Cards

## 🐛 Problème
Les images des articles n'apparaissaient pas sur les cartes du blog. À la place, un dégradé de couleur s'affichait.

## 🔍 Cause
Le composant React `Blog/Index.jsx` cherchait l'attribut `featured_image` sur les articles, mais le modèle Article ne fournissait que le champ brut `image` sans le préfixer avec le bon chemin storage.

### Code React (Blog/Index.jsx)
```jsx
{article.featured_image ? (
    <img
        src={article.featured_image}  // ❌ Attribut inexistant
        alt={article.title}
        className="w-full h-full object-cover"
    />
) : (
    <div className="w-full h-full bg-gradient-to-br from-[#0099CC] to-[#00A86B]"></div>
)}
```

### Modèle Article (avant)
```php
protected $fillable = [
    'title',
    'slug',
    'content',
    'image',  // ❌ Chemin brut sans préfixe 'storage/'
    // ...
];
```

## ✅ Solution

### 1. Ajout d'un Accesseur `featured_image`
Ajout dans `app/Models/Article.php` :

```php
/**
 * Get the featured image URL for display
 */
public function getFeaturedImageAttribute(): ?string
{
    if (!$this->image) {
        return null;
    }

    // Si le chemin commence par http, c'est une URL absolue
    if (str_starts_with($this->image, 'http')) {
        return $this->image;
    }

    // Sinon, construire le chemin depuis storage
    return asset('storage/' . $this->image);
}
```

### 2. Ajout de l'Attribut dans $appends
Pour que l'attribut soit inclus dans la sérialisation JSON :

```php
protected $appends = [
    'featured_image'
];
```

## 📊 Fonctionnement

### Avant
```json
{
    "id": 1,
    "title": "Mon Article",
    "image": "articles/mon-image.jpg",  // ❌ Chemin incomplet
    // pas de featured_image
}
```

### Après
```json
{
    "id": 1,
    "title": "Mon Article",
    "image": "articles/mon-image.jpg",
    "featured_image": "https://kreyatikstudio.fr/storage/articles/mon-image.jpg"  // ✅ URL complète
}
```

## 🎨 Résultat

### Avant
- ❌ Cartes blog affichent un dégradé bleu/vert
- ❌ Aucune image visible

### Après
- ✅ Images des articles affichées correctement
- ✅ URLs complètes générées automatiquement
- ✅ Support URLs absolues (CDN, etc.)

## 📝 Utilisation dans l'Admin

Lors de l'ajout d'un article dans le back-office, l'image uploadée doit être stockée dans :
```
storage/app/public/articles/
```

Et le champ `image` de la BDD doit contenir :
```
articles/nom-du-fichier.jpg
```

L'accesseur `featured_image` transformera automatiquement en :
```
https://kreyatikstudio.fr/storage/articles/nom-du-fichier.jpg
```

## 🚀 Déploiement

### 1. Push du Code
```bash
git push origin main
```

### 2. Sur le Serveur Production
```bash
git pull origin main
php artisan cache:clear
php artisan config:clear
```

### 3. Vérification
Accéder à : `https://kreyatikstudio.fr/blog`
- ✅ Les images des articles doivent s'afficher
- ✅ Pas de dégradé bleu/vert par défaut

## 🔧 Dépannage

### Images Toujours Absentes ?

1. **Vérifier le symlink storage** :
```bash
ls -la public/storage
# Doit pointer vers ../storage/app/public
```

2. **Vérifier que les images existent** :
```bash
ls -la storage/app/public/articles/
```

3. **Vérifier les permissions** :
```bash
chmod -R 755 storage/app/public/articles/
```

4. **Vérifier en base de données** :
```bash
php artisan tinker --execute='
$article = \App\Models\Article::first();
echo "Image field: " . $article->image . "\n";
echo "Featured image: " . $article->featured_image . "\n";
'
```

### Attribut featured_image null ?

Vérifier que le champ `image` en BDD contient bien un chemin :
```sql
SELECT id, title, image FROM articles WHERE is_published = 1;
```

Si vide, uploader une nouvelle image via le back-office admin.

## 📖 Documentation Connexe

- [OPTIMISATION-IMAGES.md](OPTIMISATION-IMAGES.md) - Optimisation des images
- [README-DEPLOIEMENT.md](README-DEPLOIEMENT.md) - Guide de déploiement

---

✅ **Commit** : Fix: Blog card images not displaying
📅 **Date** : 10 décembre 2025
👨‍💻 **Développeur** : Claude Code + Lionel Blanchet
