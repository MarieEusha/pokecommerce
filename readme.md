# Project Initializer

Modèle d'initialisation d'un projet Symfony avec configuration 
d'un environnement docker complet comprenant un container Nginx, un container MySQL, 
et un container PHP comprenant la partie applicative du projet.

| Service | Version |
|:--------|:--------|
| Symfony | ^6.0    |
| PHP     | ^8.1    |
| MySQL   | 8.0.27  |
| Nginx   | latest  |


## Prérequis

Avoir installé [docker et docker-compose](https://docs.docker.com/get-docker/) 

Avoir installé les packages nécessaires pour avoir accès à la commande `make` :
 - Linux :
```
sudo apt install build-essential
```
- Mac :
```
brew install make
```
- Windows :
    - Installer le package `make` via [chocolatey](https://chocolatey.org/) <br>
  ou
    - Installer une distribution linux en [WSL](https://docs.microsoft.com/fr-fr/windows/wsl/install) et installer le package Linux

(Recommandé) Avoir installé le [docker-hostmanager](https://github.com/iamluc/docker-hostmanager#usage) qui s'occupera de créer des virtualhost locaux pour vos projets


## Initialisation d'un projet

Afin d'initialiser un projet, il est nécessaire de configurer certaines variables utiles à la création des containers dans un fichier `docker/.env`

1. Créer le fichier `docker/.env` à partir du fichier `docker/.env.dist`
2. Éditer les variables suivantes dans le fichier `docker/.env` :

| Variable            | Description                                                               | Exemple      |
|:--------------------|:--------------------------------------------------------------------------|:-------------|
| PROJECT_NAME        | Nom du projet qui sera utilisé pour créer les container et le virtualhost | project      |
| PROJECT_ENV         | Environnement du projet pour lequel exécuter certaines commandes          | prod / dev   |
| NGINX_PORT          | Port utilisé par Nginx sur la machine hôte                                | 8080         |
| MYSQL_DATABASE      | Nom de la base de données à créer pour le projet                          | database     |             
| MYSQL_USER          | Nom de l'utilisateur courant utilisé dans le container MySQL              | user         |             
| MYSQL_PASSWORD      | Mot de passe de l'utilisateur courant utilisé dans le container MySql     | m0t_d3_p422e |             
| MYSQL_ROOT_PASSWORD | Mot de passe de l'utilisateur root du container MySql                     | m0t_d3_p422e |             
| MYSQL_PORT          | Port utilisé par MySQL sur la machine hôte                                | 33060        |

3. Créer le fichier `docker/nginx/project.conf` à partir du fichier `docker/nginx/project.conf.dist` et le modifier si besoin
4. Lancer la commande `docker network create local` pour créer un réseau docker nommé **local**
5. À la racine du projet, lancer la commande `make up` démarrer les containers
   (Lancer la commande `make up-dev` pour lancer les containers + le container **Blackfire**)
6. Lancer la commande `make bash` pour lancer un terminal dans le container PHP
7. Depuis le container PHP, lancer la commande `composer install`
8. Depuis le container PHP, lancer la commande `yarn install` pour installer les potentiels packages 
9. Depuis le container PHP, lancer la commande `yarn encore dev` pour build les assets en environnement dev
10. Depuis le container PHP, lancer la commande `php bin/console c:c`
11. Depuis le container PHP, lancer la commande `chown -R www-data:www-data var public` pour donner accès à l'utilisateur www-data aux dossiers var et public
    - Les droits doivent être réappliqués après chaque clear des cache. Les deux commandes peuvent être enchainées :
    ```
    php bin/console c:c && chown -R www-data:www-data var public
    ```
    Un alias `make cc` est disponible à la racine du projet
12. Lancer la commande `exit` pour sortir du container PHP
### 