# Guide de Déploiement - OLDA Atelier

## Déploiement sur Cloudflare Pages

### Prérequis
- Compte Cloudflare
- Dépôt GitHub connecté à Cloudflare Pages
- Node.js installé localement (pour tests)

### Méthode 1 : Via Dashboard Cloudflare Pages

1. Connectez-vous à [Cloudflare Dashboard](https://dash.cloudflare.com/)
2. Allez dans **Pages** > **Create a project**
3. Sélectionnez votre dépôt GitHub
4. Configurez :
   - **Project name** : `olda`
   - **Production branch** : `main`
   - **Framework preset** : None
   - **Build command** : `npm install && npm run build`
   - **Build output directory** : `dist`
5. Cliquez sur **Save and Deploy**

### Méthode 2 : Via Wrangler CLI (ligne de commande)

```bash
# Installation de Wrangler (si pas déjà installé)
npm install -g wrangler

# Connexion à Cloudflare
wrangler login

# Déploiement
wrangler pages deploy dist --project-name=atelier-olda
```

### Méthode 3 : Automatique via GitHub Actions

Le projet est déjà configuré pour déployer automatiquement :
- Chaque push sur la branche `main` déclenche un build
- GitHub Actions exécute le workflow défini dans `.github/workflows/deploy.yml`
- Le site est déployé sur GitHub Pages ET Cloudflare Pages

## Tests Locaux Avant Déploiement

```bash
# Installation des dépendances
npm install

# Build de production
npm run build

# Prévisualisation locale
npm run preview
```

Le site sera accessible sur http://localhost:4173

## URLs de Production

Une fois déployé, votre site sera accessible à :
- **Cloudflare Pages** : https://olda.pages.dev
- **Domaine personnalisé** : (à configurer dans Cloudflare)

## Vérifications Post-Déploiement

- [ ] Site accessible
- [ ] Images chargent correctement
- [ ] Navigation fonctionne
- [ ] Panier fonctionne
- [ ] Formulaire de commande fonctionne (test EmailJS)
- [ ] Responsive mobile/tablette/desktop

## Mise à Jour du Site

Pour mettre à jour le site :
1. Faites vos modifications localement
2. Testez avec `npm run build && npm run preview`
3. Committez et poussez vers GitHub
4. Le déploiement automatique se déclenche

```bash
git add .
git commit -m "Description des changements"
git push origin main
```

## Résolution de Problèmes

### Le build échoue
- Vérifiez que Node.js version 18+ est installé
- Exécutez `npm install` pour installer les dépendances
- Vérifiez les logs de build dans Cloudflare Dashboard

### Les images ne s'affichent pas
- Vérifiez que le dossier `public/images/` contient toutes les images
- Vérifiez les chemins dans index.html (doivent être `/images/nom-fichier.jpg`)

### EmailJS ne fonctionne pas
- Vérifiez vos identifiants EmailJS dans index.html ligne 497-498
- Testez votre Service ID et Template ID sur emailjs.com

## Support

Pour toute question, contactez l'équipe de développement.
