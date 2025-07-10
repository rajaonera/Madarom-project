# Mad’arom V2

## Objectif du projet

Créer un site web professionnel pour la marque Mad’arom avec une architecture backend sécurisée, réutilisable, et un frontend attractif. Le projet couvre les 4 premières pages du site :
- Landing page de la marque
- Catalogue produits
- Détails d’un produit
- Informations sur la marque

Le backend est développé avec Laravel (PHP), le frontend par un autre développeur (Vue.js, React ou autre).

---

## Structure du projet

- **Backend (Laravel)** : API REST, gestion base de données, sécurité, logique métier.
- **Frontend** : Interface utilisateur, navigation, affichage visuel, interactions.

---

## Configuration & installation

### Prérequis

- PHP >= 8.1
- Composer
- Node.js & npm/yarn (pour frontend)
- Serveur MySQL/MariaDB
- Serveur Apache/Nginx (optionnel en local)

### Backend - Installation

1. Cloner le dépôt
2. Copier `.env.example` en `.env`
3. Configurer les variables de base de données dans `.env`
4. Installer les dépendances :
   ```bash
   composer install
### Générer la clé d’application :

bash
```
php artisan key:generate
Migrer la base de données :

bash
```
php artisan migrate
(Optionnel) Lancer le serveur local :

bash
```
php artisan serve
Frontend - Installation
Aller dans le dossier frontend

Installer les dépendances :

bash
```
npm install
Lancer le serveur de développement :

bash
```
npm run dev
Fonctionnalités principales du sprint 1
Landing page de présentation de la marque
```

### Catalogue affichant tous les produits

Page détails d’un produit avec description complète

Page d’informations sur la marque (histoire, valeurs, contact)

### Rôles et tâches
#### Backend (Responsable : Smooth)
Préparer la base de données et les migrations (produits, catégories, utilisateurs si besoin)

Créer les API REST pour :

Liste des produits

Détails d’un produit

Informations générales (marque)

Sécuriser l’accès aux API

Gérer la configuration et les variables d’environnement

Documenter les endpoints API (ex : Swagger, Postman)

Tester les API avec PHPUnit ou Postman

Mettre en place le logging et gestion des erreurs

S’assurer de la conformité aux normes de sécurité (validation, protection CSRF, CORS)

#### Frontend (Responsable : Collaborateur)
Construire les interfaces des 4 pages en respectant la charte graphique

Consommer les API backend pour afficher les données

Assurer une navigation fluide et responsive

Implémenter les composants réutilisables (cartes produits, navbar, footer)

Optimiser l’accessibilité et la performance

Tester sur plusieurs navigateurs et mobiles

Gérer la configuration frontend (routes, state management si nécessaire)

Workflow de collaboration
Chaque développeur travaille sur sa branche dédiée (ex: backend-dev, frontend-dev)

Pull requests sur main après revue de code

Communication via tickets et daily standup

Documentation et mise à jour du README à chaque nouvelle fonctionnalité

### Bonnes pratiques
Respecter les normes PSR pour PHP

Suivre les conventions de nommage du framework choisi

Valider toutes les entrées utilisateurs côté backend

Garder le code propre, commenté et testable

Ne pas hardcoder les données sensibles (utiliser .env)

Gérer les erreurs proprement et afficher des messages clairs

Sécuriser les routes et les accès API

Faire des commits clairs et fréquents

### Ressources utiles
Laravel Documentation

PHPUnit Testing

Frontend Framework Docs (ex: Vue.js)

Git Flow Workflow

Contact & support
Backend : Smooth (Responsable)

Frontend : Adala

