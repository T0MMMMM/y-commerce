
# Projet Final PHP - Site E-Commerce

Ce projet consiste à créer un site e-commerce complet en utilisant PHP. Voici les critères d'évaluation avec des cases à cocher pour suivre l'avancement du projet.

## Fonctionnalités Attendues

- [x] Une page `register` qui alimente la base de données et connecte l'utilisateur automatiquement.
- [x] La page de `login` qui connecte l'utilisateur et le redirige sur la page Accueil.
- [x] Les utilisateurs doivent être uniques.
- [x] Les articles de la page Accueil sont triés par date décroissante.
- [ ] La page de détail comprend le nom de l'auteur, le nom de l'article, le slug, la date, l'image et la description.
- [x] La page Product est accessible en méthode GET avec paramètres.
- [x] L'utilisateur peut ajouter un article dans son panier.
- [ ] La page Panier comporte tous les articles dans le panier, la possibilité de passer commande en fonction du solde de l'utilisateur, gérer le nombre d'articles et le CRUD.
- [ ] La page `edit` est accessible en méthode POST avec les bonnes informations de l'article.
- [ ] Seul l'utilisateur qui a créé un article ou un administrateur a la capacité de modifier des informations protégées (article / profil).
- [ ] L'utilisateur peut voir les articles qu'il a mis en vente et les informations de son compte.
- [x] Le CRUD sur les articles est complet et fonctionnel.
- [ ] La page Compte sert aussi bien à voir les informations d'un utilisateur qu'à voir ses propres informations (paramètre de la requête GET).
- [ ] Possibilité d'ajouter de l'argent à son solde.
- [ ] Si l'utilisateur n'est pas connecté, toutes les pages le redirigent vers la page de login, à l'exception de la page Accueil et Product.
- [ ] Le projet comprend toutes les entités obligatoires.
- [x] Les mots de passe des utilisateurs sont chiffrés.
- [ ] L’utilisateur peut modifier ses informations personnelles.
- [ ] Le site comprend au moins 1 administrateur.
- [ ] Bonne gestion des rôles.
- [ ] L’administrateur possède un panel admin qui lui permet de modifier tous les utilisateurs et tous les articles.

## Installation

1. **Cloner le dépôt** :
   ```bash
   git clone <URL_DU_DEPOT>
   ```

Configurer l'environnement :

Installer XAMPP, MAMP ou LAMP selon votre système d'exploitation.
Configurer PHP 8.
Démarrer les serveurs Apache et MySQL.
Configurer la base de données :

Importer le fichier php_exam_db.sql dans phpMyAdmin pour créer la base de données et les tables nécessaires.
Lancer le projet :

Placer le dossier php_exam dans le répertoire htdocs de XAMPP, MAMP ou /var/www pour LAMP.
Accéder au projet via localhost/php_exam (ou localhost:8888/php_exam pour MAMP).
Structure du Projet
Dossier php_exam : Contient tous les fichiers du projet.
Fichier index.php : Page d'accueil du site.
Dossier product : Contient les fichiers pour la gestion des articles.
Dossier admin : Contient les fichiers pour le panneau d'administration.
Contributions
Les contributions sont les bienvenues ! N'hésitez pas à ouvrir une issue ou à proposer une pull request.

Licence
Ce projet est sous licence MIT. Voir le fichier LICENSE pour plus de détails.