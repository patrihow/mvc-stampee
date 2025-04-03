# 📮 Stampee - Plateforme d'enchères de timbres

## 📖 Description du projet

**Stampee** est une plateforme d’enchères en ligne conçue pour les collectionneurs et collectionneuses de timbres du monde entier. Son objectif est d’offrir un espace dédié permettant aux utilisateurs de publier et de participer à des enchères de timbres rares.

### 🎯 Objectifs du projet

- Permettre aux membres d'ajouter et de gérer leurs enchères.
- Faciliter la recherche des enchères en cours et passées.
- Assurer une accessibilité optimale sur tous les appareils.

## 🚀 Technologies utilisées

- **HTML, CSS, JavaScript** : Développement de l’interface utilisateur et des interactions dynamiques.
- **PHP (MVC)** : Gestion de la logique serveur avec l’architecture Modèle-Vue-Contrôleur.
- **MySQL Workbench** : Conception et gestion de la base de données.
- **Composer** : Gestionnaire de dépendances PHP.
- **Twig** : Moteur de templates assurant une séparation claire entre la logique et l’affichage.

## 🔗 Liens utiles

- 📌 **Documentation des sprints** : [Planification sur Figma](https://www.figma.com/design/dAj2pv5iFMMb82QyRQ9K8E/Sprints-Stampee?node-id=2067-476\&t=rLKQX5RVbomiS1KE-1)
- 📂 **Dépôt GitHub - Backend (MVC)** : [Voir le dépôt](https://github.com/patrihow/mvc-stampee)
- 📂 **Dépôt GitHub - Frontend (HTML/CSS)** : [Voir le dépôt](https://github.com/patrihow/stampee)
- 🌍 **Version en ligne sur GitHub Pages** : [Accéder à Stampee](https://patrihow.github.io/stampee/)
- 🌐 **Site web sur Webdev** : https://e2496037.webdev.cmaisonneuve.qc.ca/mvc-stampee/

## 📅 Planification et avancement

### 🏁 Sprint 1 - Terminé

- **Date limite** : Vendredi **28 mars 2025**
- **Présentation client** : Lundi **31 mars 2025**
- 📂 **Branche active** : [dev-sprint1](https://github.com/patrihow/mvc-stampee/tree/dev-sprint1)

### 🔜 Objectifs des prochains sprints

| Sprint   | Objectif                          | Date limite       | Présentation     |
|----------|-----------------------------------|-------------------|------------------|
| Sprint 0 | Préparation du projet            | ✅ 19 mars 2025   | ✅ 20 mars 2025  |
| Sprint 1 | Gestion des utilisateurs         | ✅ 28 mars 2025   | ✅ 31 mars 2025  |
| Sprint 2 | Gestion des timbres et images    | 📅 3 avril 2025   | 📅 4 avril 2025  |
| Sprint 3 | Gestion des enchères et filtrage | 📅 10 avril 2025  | 📅 11 avril 2025 |

## 📌 Sprint 1 : Gestion des utilisateurs

La première phase du projet a permis de mettre en place un système permettant aux utilisateurs de s’inscrire, de se connecter et de gérer leur profil sur la plateforme. Cette fonctionnalité essentielle garantit une expérience fluide et sécurisée aux membres de Stampee.

### 🛠 Principales étapes du Sprint 1

1. **Création des tables "user" et "privilege"**
2. **Développement des modèles User et Privilege**
3. **Sécurisation des mots de passe et authentification**
4. **Création du formulaire d'inscription et gestion des erreurs**
5. **Mise en place du contrôleur UserController**
6. **Implémentation du login/logout via AuthController**
7. **Configuration des routes et de la navigation**

## 📌 Sprint 2 : Gestion des timbres

Cette étape vise à développer un système permettant aux utilisateurs d’ajouter, d’afficher et de modifier un timbre avec ses images.

Trois vues seront créées : `create.php` pour l’ajout, `show.php` pour l’affichage et `edit.php` pour la modification. Les routes associées seront configurées dans `web.php`. La gestion des images inclura le téléchargement d’une image principale ainsi que d’images supplémentaires.

Un système de validation sera mis en place dans `Validator.php` afin de contrôler la présence des fichiers, leur format et leur taille. Enfin, des tests seront réalisés afin d’assurer le bon fonctionnement et l’intégration de cette fonctionnalité.

### 📌 Objectifs de la fonctionnalité

- **Création des vues** : Ajout, affichage et modification des timbres.
- **Configuration des routes** : Définition des chemins dans `web.php`.
- **Développement des contrôleurs** : Gestion de l’ajout, de la modification et de la suppression des timbres.
- **Téléchargement et stockage sécurisé** des images.
- **Validation des formats et dimensions** des fichiers image.

## 📚 Ressources et documentation

- **PHP et MVC avec Composer & Twig** : [Voir le cours](https://good4college.com/online-course/object-oriented-php-with-mvc-composer-and-twig/fr#209) - Sprint 1
- **Gestion des privilèges et accès en PHP MVC** : [Voir le cours](https://good4college.com/online-course/object-oriented-php-mvc-login-access-and-privilege-management/fr#307) - Sprint 1
- **Système de connexion et inscription en PHP MVC** : [Voir le cours Udemy](https://alithya.udemy.com/course/php-mvc-login) - Sprint 1
- **Gestion des images** : [Voir l’exemple](https://editor.datatables.net/examples/advanced/upload-many.html) - Sprint 2
- **Ajout d’images multiples en PHP et MySQL** : [Voir la vidéo](https://www.youtube.com/watch?v=h5CWDUZWYTo) - Sprint 2

## 🏆 Auteure

Conçu et développé avec 💖 par [@patrihow](https://github.com/patrihow)

📌 *Dernière mise à jour : 31 mars 2025*

