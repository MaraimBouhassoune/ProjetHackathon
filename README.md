## Installation de Départ

1. **Démarrer WAMP (ou XAMP ou autre)** :
   - Démarrer le serveur web Apache.
   - Démarrer le serveur de base de données MySQL.

2. **Charger la Base de Données** :
   - Importer le fichier SQL situé dans `modele/datas_sql/sql` (par exemple avec phpMyAdmin).

3. **Vérifier la Base de Données** :
   - Vérifier les administrateurs créés.
   - Vérifier les jurys créés.
   - Vérifier les participants créés.
   - Vérifier les hackathons créés, les projets créés.
   - Il existe un admin, jury et participant avec les identifiants `root-root`.

4. **Configurer la Connexion à la Base de Données** :
   - Mettre à jour les variables globales dans `modele/initialisation/tools/connexionBD.php` :
     ```php
     $dbname_global = 'hackathonsFW';
     $username_global = 'root';
     $password_global = '';
     ```

## Architecture du Projet

|- _readme.txt
|
|- index.php
|
|- ctrls : les controleurs
| |
| |- ctrl_xxx : les controleurs de l'application
| |
| |- appel_ctrl_xxx : les controleurs appelés par des formulaires souvent
| |
| |- apiHackathonsProjets : le controleur d'API
|
|- modele : la partie base de données
| |
| |- classes métiers : les classes
| | |- tests_unitaires
| |
| |- initialisation :
| | |- initialisation.php : les initialisation
| | |- tools
| | | |- connexionBD.php : la connexion à la bd
| | | |- debug.php : les fonctions de debug
| |
| |- datas_sql_json
| | |- sql
| | | |- Create_database_hackathon.sql : le code SQL de création de la BD
| | |- json
| | |- pour des fichiers JSON, inutile dans notre projet
|
|- views
| |- les vues
|
|- public : les fichiers publics pour le client
| |- css
| |- img
| |- pdf

yaml
Copier le code

Les controleurs sont tous dans le dossier `ctrls` :
- L'index appelle le controleur d'accueil.
- Tous les includes utilisent `../` pour accéder à la racine.
- Dans les vues, les formulaires appellent des controleurs "appel".

Nous n'utilisons pas de front_controleur ni de "routeur" :
- Tous nos controleurs sont directement dans le dossier `ctrls`, ce qui n'est pas très pratique.
- Cependant, écrire un routeur PHP à la main est fastidieux et peu utile, car tous les frameworks (Laravel, Node-Express, Flask, etc.) proposent des systèmes de routage intégrés.

## Hébergement
- L'application est hébergée sur Hostinger : [Lien vers le site hébergé](https://projethackathon.fr/).

---

Pour plus de détails sur le projet, consultez les fichiers spécifiques dans ce dépôt.
