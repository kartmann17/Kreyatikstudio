# Guide SEO Complet - Kréyatik Studio

## Statut Actuel des Optimisations

### ✅ Optimisations Déjà Faites

1. **Header SEO Optimisé** (`resources/views/components/header.blade.php`)
   - Meta title/description optimisés pour freelance
   - Données structurées JSON-LD (Schema.org Person + WebSite)
   - Meta tags mobile & performance
   - Open Graph optimisé pour réseaux sociaux
   - Géolocalisation Rochefort

2. **Configuration SEO** (`config/seo.php`)
   - Tous les textes repositionnés "freelance"
   - Descriptions optimisées pour chaque page
   - Keywords locaux ciblés

3. **Google Analytics GA4**
   - ID : `G-5WGQCL5M8S`
   - Conforme RGPD (chargement après consentement)
   - Tracking événement formulaire contact
   - Fonction `window.trackEvent()` disponible

4. **Performance**
   - DNS prefetch pour Google Fonts & CDN
   - Preconnect pour ressources critiques
   - Images avec alt optimisés

---

## Actions Prioritaires à Faire

### 1. Google Search Console (URGENT)

**Étape 1 : Créer le compte**
1. Aller sur https://search.google.com/search-console
2. Se connecter avec compte Google
3. Cliquer "Ajouter une propriété" → "Préfixe d'URL"
4. Entrer : `https://kreyatikstudio.fr`

**Étape 2 : Vérifier la propriété**

Vous allez recevoir une balise HTML à ajouter. Par exemple :
```html
<meta name="google-site-verification" content="ABC123XYZ..." />
```

Ajouter cette ligne dans `resources/views/components/header.blade.php` ligne 425 (déjà préparé) :
```blade
<!-- Google Search Console Verification -->
<meta name="google-site-verification" content="VOTRE_CODE_ICI" />
```

**Étape 3 : Soumettre le sitemap**
1. Dans Google Search Console → "Sitemaps"
2. Ajouter : `https://kreyatikstudio.fr/sitemap.xml`
3. Cliquer "Soumettre"

**Étape 4 : Vérifier robots.txt**
1. GSC → "Paramètres" → "Robots.txt"
2. Vérifier qu'il affiche bien le contenu de `/public/robots.txt`

---

### 2. Google Business Profile (CRITIQUE pour SEO local)

**Créer le profil :**
1. https://business.google.com
2. "Créer un profil"
3. Remplir :
   - Nom : **Lionel Blanchet - Développeur Web Freelance | Kréyatik Studio**
   - Catégorie principale : **Développeur de sites Web**
   - Catégories secondaires :
     - Consultant en informatique
     - Service de marketing internet
   - Adresse : **2 Rue du petit port marchand, 17300 Rochefort**
   - Téléphone : **+33 6 95 80 06 63**
   - Site web : **https://kreyatikstudio.fr**
   - Horaires : **Lun-Dim 9h-19h** (comme indiqué sur le site)

**Optimiser le profil :**
- [ ] Ajouter 10+ photos (workspace, projets, logo)
- [ ] Description (750 caractères max) :
```
Développeur web freelance basé à Rochefort (17), je crée des sites internet,
e-commerce et applications web sur-mesure avec Laravel, PHP et Tailwind CSS.
Expert en SEO et performance web, j'accompagne TPE/PME et entrepreneurs
de Charente-Maritime dans leur transformation digitale.
Devis gratuit, conseil personnalisé, réponse sous 24h.
```
- [ ] Ajouter services :
  - Création de site internet
  - Développement e-commerce
  - Application web Laravel
  - Optimisation SEO
  - Refonte de site web
- [ ] Obtenir 5-10 avis clients 5 étoiles (avec mots-clés)

---

### 3. Vérifier/Générer le Sitemap

**Vérifier le sitemap actuel :**
```bash
php artisan sitemap:generate
```

Le sitemap devrait être accessible à : `https://kreyatikstudio.fr/sitemap.xml`

**Contenu attendu :**
- Homepage (priority: 1.0)
- /NosOffres (priority: 0.9)
- /Portfolio (priority: 0.9)
- /Contact (priority: 0.8)
- Articles blog (priority: 0.7)
- Pages légales (priority: 0.3)

---

### 4. Créer Contenu Blog SEO

**Articles à créer (3-5 premiers mois) :**

1. **"Combien coûte un site web à Rochefort en 2025 ?"**
   - Mots-clés : prix site web rochefort, tarif développeur web
   - 1500-2000 mots
   - Inclure tableau comparatif

2. **"Développeur freelance vs Agence web : quel choix pour votre projet ?"**
   - Mots-clés : freelance vs agence, choisir développeur
   - Avantages freelance (proximité, flexibilité, tarifs)

3. **"Laravel vs WordPress : quelle solution pour votre e-commerce ?"**
   - Mots-clés : laravel e-commerce, développement sur-mesure
   - Expertise technique mise en avant

4. **"Guide du cahier des charges pour site web (Charente-Maritime)"**
   - Lead magnet téléchargeable
   - Formulaire contact intégré

5. **"TOP 10 sites internet de TPE/PME à Rochefort"**
   - SEO local
   - Backlinks potentiels

**Structure article optimisée :**
```blade
- H1 unique (60 caractères max)
- Meta description (155 caractères)
- Image mise en avant (1200x630px)
- Sous-titres H2/H3 avec mots-clés
- Liens internes vers /NosOffres et /Contact
- CTA à la fin
- Schema Article JSON-LD
```

---

### 5. Optimiser Images

**Images à optimiser :**
```bash
# Convertir en WebP (meilleure compression)
public/images/STUDIOcolibri.png → STUDIOcolibri.webp
public/images/Studiosansfond.png → Studiosansfond.webp

# Créer image OG par défaut optimisée
public/images/default-og.jpg → 1200x630px, <100KB
```

**Lazy loading :**
Ajouter `loading="lazy"` à toutes les images sauf :
- Logo header (déjà `loading="eager"`)
- Image hero homepage

---

### 6. Obtenir Backlinks Locaux

**Annuaires gratuits à cibler :**
- [ ] Google Business Profile (déjà en cours)
- [ ] PagesJaunes.fr (Rochefort)
- [ ] Yelp France
- [ ] CCI Charente-Maritime
- [ ] Annuaire La Rochelle / Rochefort
- [ ] Kompass
- [ ] 118000.fr
- [ ] Mappy

**Partenariats locaux :**
- [ ] Contacter entreprises clientes pour témoignage + lien
- [ ] Proposer article invité blog entreprises locales
- [ ] Inscription associations pro Rochefort

---

### 7. Tracking Événements GA4 Supplémentaires

Ajouter tracking pour :

**Homepage :**
```javascript
// Clic CTA "Devis gratuit"
<button onclick="trackEvent('cta_click', {
  'event_category': 'Engagement',
  'event_label': 'CTA Homepage - Devis Gratuit'
})">
```

**Portfolio :**
```javascript
// Clic projet
trackEvent('portfolio_view', {
  'project_name': 'Nom du projet'
})
```

**Offres :**
```javascript
// Clic offre
trackEvent('pricing_view', {
  'plan_name': 'Nom de l\'offre'
})
```

---

## Vérifications Post-Déploiement

### Tests à Faire

**1. Test Rich Results (Google)**
- URL : https://search.google.com/test/rich-results
- Vérifier : Schema Person + WebSite détectés

**2. PageSpeed Insights**
- URL : https://pagespeed.web.dev/
- Objectif : Score > 90 (mobile & desktop)
- Métriques :
  - LCP < 2.5s
  - FID < 100ms
  - CLS < 0.1

**3. Mobile-Friendly Test**
- URL : https://search.google.com/test/mobile-friendly
- Vérifier : "Page adaptée aux mobiles"

**4. Vérifier Robots.txt**
- https://kreyatikstudio.fr/robots.txt
- Doit afficher contenu complet

**5. Vérifier Sitemap**
- https://kreyatikstudio.fr/sitemap.xml
- Doit lister toutes pages publiques

**6. Test GA4**
- Aller sur site, accepter cookies
- Soumettre formulaire contact
- Vérifier dans GA4 → Rapports → Événements
- Événement `contact_form_submit` doit apparaître

---

## Timeline Réaliste SEO

### Semaine 1 (URGENT)
- [x] Optimiser header.blade.php ✅
- [x] Optimiser config/seo.php ✅
- [x] Configurer tracking GA4 formulaire ✅
- [ ] Créer Google Search Console
- [ ] Soumettre sitemap
- [ ] Créer Google Business Profile

### Semaine 2-3
- [ ] Optimiser images (WebP)
- [ ] Écrire 2 premiers articles blog
- [ ] Obtenir 3 premiers avis Google
- [ ] Inscrire 5 annuaires locaux

### Mois 2
- [ ] Publier 2 articles blog supplémentaires
- [ ] Obtenir 5 backlinks locaux
- [ ] Analyser positions GSC
- [ ] Ajuster stratégie mots-clés

### Mois 3-6
- [ ] Publier 1-2 articles/mois
- [ ] Maintenir avis Google (1-2/mois)
- [ ] Créer cas clients (lead magnets)
- [ ] Optimiser taux conversion

---

## Résultats Attendus

### Court terme (1-3 mois)
**Requêtes visées :**
- "développeur web freelance rochefort" → Top 3
- "création site internet rochefort" → Top 5
- "développeur laravel rochefort" → Top 3

### Moyen terme (3-6 mois)
- "développeur web rochefort" → Top 3
- "site e-commerce rochefort" → Top 5
- "freelance web charente-maritime" → Top 3

### Long terme (6-12 mois)
- "développeur laravel" → Top 30 France
- "freelance e-commerce sur-mesure" → Top 20
- 50+ visites organiques/jour

---

## Support & Ressources

**Outils SEO gratuits :**
- Google Search Console : https://search.google.com/search-console
- Google Analytics 4 : https://analytics.google.com
- Google Business Profile : https://business.google.com
- PageSpeed Insights : https://pagespeed.web.dev
- Rich Results Test : https://search.google.com/test/rich-results

**Documentation :**
- Laravel SEO Package : https://github.com/ralphjsmit/laravel-seo
- Schema.org : https://schema.org/Person
- Google SEO Guide : https://developers.google.com/search/docs

---

## Notes Importantes

1. **GA4 nécessite consentement cookies** : Les données ne sont collectées QUE si l'utilisateur accepte les cookies analytics
2. **Robots.txt déjà optimisé** : Bloque admin/client, autorise pages publiques
3. **RGPD compliant** : Cookie consent déjà configuré avec `devrabiul/laravel-cookie-consent`
4. **Sitemap dynamique** : Commande `php artisan sitemap:generate` à exécuter après chaque nouveau contenu

---

**Date de création** : 2025-11-03
**Version** : 1.0
**Contact** : Lionel Blanchet - kreyatik@gmail.com
