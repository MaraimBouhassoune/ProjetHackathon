Installation de départ :
   Démarrer WAMP (ou XAMP ou autre) : 
      démarrer le serveur web appache
      démarrer le serveur de BD mysql
   
   Charger la BD : modele/datas_sql/sql
      par exemple avec phpmyadmin
   
   Regarder dans la BD :
      les administratateurs créés
      les jurys créés
      les participants créés
      les hackathons créés, les projets créés

      il existe un admin, jury et participant root-root

   Dans modele/initialisation/tools/connexionBD.php
      mettre à jour les variables globales : 
         $dbname_global = 'hackathonsFW';
         $username_global = 'root';
         $password_global = '';

Architecture
   |- _readme.txt
   | 
   |- index.php
   | 
   |-ctrs : les controleurs
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
   |   |   |- inialisation.php : les initialisation
   |   |   |- tools
   |   |   |   |- connexionBD.php : la connexion à la bd
   |   |   |   |- debug.php : les fonctions de debug
   |   |
   |   |- datas_sql_json
   |   |   |-sql
   |   |   |   |-Create_datababase_hackathon.sql : le code sql de création de la BD 
   |   |   |-json
   |   |       |-pour des fichiers json, inutile dans notre projet
   |
   |- views 
   |   |- les vues
   |
   |- public : les fichiers publics pour le client
   |   |- css
   |   |- img
   |   |- pdf
   |


Les controleurs sont tous mis dans le dossier ctrls : ce sont les pages de notre site :
   L'index appelle le controleur d'accueil 
   Tous les includes font un ../ => ils remontent à la racine 
      ensuite ils accèdent à ce qu'ils veulent en précisant le chemin
         pour les nav, c'est un ../ctrls 
   Dans les vues, il y a, dans les formulaires, des appels à des controleurs "appel"  
      Ces appels sont fait avec un ../ctrls/

On n'utilise pas de front_controleur et de "routeur" : 
   donc tous nos controleurs sont directment dans le dossier ctrls
      ce n'est pas très pratique !
   Mais écrire un routeur php "à la main", c'est fastidieux et peu utile 
      car tous les frameworks (laravel, node-express, flak, ...) proposent des systèmes de routage intégré natif propres et simples.