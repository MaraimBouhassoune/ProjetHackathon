# Projet Hackathon

### Présentation du Contexte
Un hackathon est un événement créatif où des développeurs se réunissent pour un week-end de programmation collaborative sur un thème défini. Il vise à promouvoir l'innovation numérique au service de la société.

### Phases du Déroulement d’un Hackathon
1. **Accueil et Présentation** : Thème, projets retenus, constitution des équipes, planning, jury, etc.
2. **Travail en Équipe** : Remue-méninges, maquettage, prototypage avec l'accompagnement de mentors.
3. **Présentation des Prototypes** : Chaque équipe présente son prototype au jury.
4. **Délibération et Résultats** : Délibération du jury, proclamation des résultats et remise des récompenses.

### Étapes de l’Organisation d’un Hackathon
1. **Initialisation** : Choix du lieu, de la date, du thème, composition du jury, contact avec les organisateurs.
2. **Publication** : Édition et mise en ligne du planning, mise en ligne des projets proposés.
3. **Inscription** : Ouverture des inscriptions en ligne, possibilité pour les équipes de proposer un projet.
4. **Choix des Projets** : Sélection des projets retenus, constitution des équipes, affectation des coachs.
5. **Lancement** : Choix du chef de projet de chaque équipe, démarrage du hackathon.
6. **Clôture** : Livraison des prototypes pour la présentation au jury.
7. **Résultats** : Gestion des votes des membres du jury, édition des résultats.

### Application Hackathon
Développement d’une application web pour gérer les étapes d’organisation d’un hackathon : initialisation, publication, inscription, choix des projets, lancement, clôture et résultats. Une API mettra également à disposition les projets retenus au format JSON.

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

## Architecture du Projet

|- _readme.txt
|
|- index.php
|
|- ctrls : les controleurs
|   |
|   |- ctrl_xxx : les controleurs de l'application
|   |
|   |- appel_ctrl_xxx : les controleurs appelés par des formulaires souvent
|   |
|   |- apiHackathonsProjets : le controleur d'API
|
|- modele : la partie base de données
|   |
|   |- classes métiers : les classes
|   |   |- tests_unitaires
|   |
|   |- initialisation :
|   |   |- initialisation.php : les initialisations
|   |   |- tools
|   |       |- connexionBD.php : la connexion à la bd
|   |       |- debug.php : les fonctions de debug
|   |
|   |- datas_sql_json
|   |   |- sql
|   |       |- Create_database_hackathon.sql : le code SQL de création de la BD
|   |   |- json
|   |       |- pour des fichiers JSON, inutile dans notre projet
|
|- views
|   |- les vues
|
|- public : les fichiers publics pour le client
|   |- css
|   |- img
|   |- pdf

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
