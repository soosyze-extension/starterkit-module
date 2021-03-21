# Starterkit module

![GitHub](https://img.shields.io/github/license/soosyze/starterkit-module.svg)
![GitHub tag](https://img.shields.io/github/tag/soosyze/starterkit-module.svg)
![PHP from Packagist](https://img.shields.io/badge/php-%3E%3D5.4-blue.svg)
![GitHub code size in bytes](https://img.shields.io/github/languages/code-size/soosyze/starterkit-module.svg)

Pour démarrer un module Soosyze avec une base de code standard.

## Sommaire

* [Fonctionnalités](/README.md#fonctionnalites)
* [Requirements](/README.md#requirements)
* [Installation](/README.md#installation)
* [License](/README.md#license)

## Fonctionnalités

### Routes et contrôleurs

Il s'agit d'une base de travail CRUD (Create/Read/Update/Delete). Il est conseillé, mais pas obligatoire de suivre les mêmes routes et méthodes.

| Route                         | Méthode HTTP* | Contrôleurs@methode | Fonction                                          |
|-------------------------------|---------------|---------------------|---------------------------------------------------|
| `starterkit/index`            | GET           | `Starterkit@index`  | Page d'accueil du module.                         |
| `starterkit/:id`              | GET           | `Starterkit@show`   | Page de contenu.                                  |
| `admin/starterkit`            | GET           | `Starterkit@admin`  | Page d'administration du module.                  |
| `admin/starterkit/item`       | GET           | `Starterkit@create` | Formulaire de création du module.                 |
| `admin/starterkit/item`       | POST          | `Starterkit@store`  | Fonction de validation et d'ajout du module.      |
| `admin/starterkit/:id/edit`   | GET           | `Starterkit@edit`   | Formulaire d'édition de votre module.             |
| `admin/starterkit/:id/edit`   | POST          | `Starterkit@update` | Fonction de validation et modification du module. |
| `admin/starterkit/:id/delete` | POST          | `Starterkit@delete` | Fonction de validation et suppression du module.  |

*Vous pouvez utiliser les méthodes HTTP que vous souhaitez, mais seules les actions GET et POST sont fonctionnelles avec les formulaires PHP.

### Services

* `starterkit` une base de service simple avec comme dépendance le service `query` pour créer des requêtes,
* `starterkit.hook.config` service utilisant les hooks du module de configuration,
* `starterkit.hook.user` service utilisant les hooks du module utilisateur pour les permissions,
* `starterkit.install` pour les appels aux hooks `install.user` (pour les permissions utilisateurs) et `install.menu` (pour les liens dans le menu).

### Installateur

La classe d'installateur est un service pour créer vos tables en base et insérer vos données.
Il implémente le hook `install.user` pour les permissions utilisateurs.

| Nom des permissions   | Utilisateurs autorisés                                   |
|-----------------------|----------------------------------------------------------|
| `starterkit.index `   | Utilisateurs non connectés, connectés et administrateurs |
| `starterkit.admin`    | Administrateurs                                          |
| `starterkit.created`  | **Supplanté par la permission `starterkit.admin`**       |
| `starterkit.edited`   | **Supplanté par la permission `starterkit.admin`**       |
| `starterkit.deleted`  | **Supplanté par la permission `starterkit.admin`**       |

Il implémente également le hook `install.menu` pour créer un lien dans le menu principal et d'administration.

### Vues

Le module est fournit avec 4 vues de base :

* `content-starterkit-form.php` pour le formulaire de création et d'édition,
* `content-starterkit-admin.php` pour votre page d'administration,
* `content-starterkit-index.php` pour votre page d'accueil,
* `content-starterkit-show.php` pour voir du contenu.

## Requirements

Starterkit module supporte jusqu'à présent toutes les versions de Soosyze CMS.

### Version PHP

| Version PHP                 | Starterkit module 1.x |
|-----------------------------|-----------------------|
| <= 5.3                      | ✗ Non supporté       |
| 5.4 / 5.5 / 5.6             | ✓ Supporté           |
| 7.0 / 7.1 / 7.2 / 7.3 / 7.4 | ✓ Supporté           |

## Installation

### Soosyze CMS

Après l'installation de Soosyze CMS sur votre serveur web (distant ou local) vous devez : 
* Télécharger l'archive du dépôt, 
* Décompresser l'archive avec dans un dossier nommé `Starterkit`, 
* Placer le dossier `Starterkit` dans le répertoire `app/modules` de Soosyze CMS. 
* Ouvrer un navigateur web, rendez-vous à l'adresse de votre site web et connectez-vous, 
* Vous rendre dans la page `Module`, sélectionner le module `Starterkit` et cliquer sur `Enregister`.

## License

Starterkit module est sous licence MIT. Voir le fichier de licence pour plus d'informations.