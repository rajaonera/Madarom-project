#  Mad'Arom – Backend Laravel

**Mad'Arom** est une plateforme e-commerce moderne spécialisée dans la vente de produits aromatiques à Madagascar. Ce backend, développé en **Laravel 10**, propose une architecture modulaire, sécurisée et extensible pour gérer les utilisateurs, produits, commandes et préférences utilisateur.

---

##  Fonctionnalités principales

-  Authentification avec token sécurisé (Sanctum)
-  Gestion des produits, catégories et sous-catégories
-  Panier dynamique stocké en cache (lié à l’utilisateur)
-  Préférences utilisateur (langue, dernière URL) stockées en cache
-  Système de commandes et suivi
-  Logging, pagination, filtrage
-  Architecture RESTful propre et modulaire

---

##  Stack technique

| Technologie       | Usage                          |
|------------------|--------------------------------|
| Laravel 10        | Framework principal            |
| PHP 8.2           | Langage backend                |
| MySQL             | Base de données relationnelle  |
| Laravel Sanctum   | Authentification API           |
| Cache (Redis/File)| Stockage sessions/panier/langue|
| Postman           | Test d'API                     |
| Railway / VPS     | Déploiement (prévu)            |

---

##  Installation

```bash
git clone https://github.com/rajaonera/madarom-project.git
cd madarom-backend

# Installation des dépendances
composer install

# Configuration environnement
cp .env.example .env
php artisan key:generate

# Configuration de la base de données
# puis :
php artisan migrate --seed

# Lancer le serveur
php artisan serve
