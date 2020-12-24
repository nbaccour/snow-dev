# snow-dev
#  Création d'un site communautaire de partage de figures de snowboard via le framework Symfony.

## Environnement utilisé durant le développement

* Symfony 5.2.1
* Composer 1.7.2
* //Bootstrap 4.2.1
* //jQuery 3.3.1
* PHPUnit 7.5.1
* Xampp Server 3.2.4
* Apache 2.4.46
* PHP 7.4.13
* MariaDB 10.4.17

## Installation
*  Clonez ou téléchargez le repository GitHub dans le dossier voulu :
*     https://github.com/nbaccour/snow-dev.git
* Configurez vos variables d'environnement tel que la connexion à la base de données ou votre serveur SMTP ou adresse mail dans le fichier .env.local qui devra être crée à la racine du projet en réalisant une copie du fichier .env.

* Téléchargez et installez les dépendances back-end du projet avec Composer :

*     composer install
*  Téléchargez et installez les dépendances front-end du projet avec Npm :
*     npm install
* Créer un build d'assets (grâce à Webpack Encore) avec Npm :
*     npm run build
*  Créez la base de données si elle n'existe pas déjà, taper la commande ci-dessous en vous plaçant dans le répertoire du projet :
*      php bin/console doctrine:database:create
* Créez les différentes tables de la base de données en appliquant les migrations :
*     php bin/console doctrine:migrations:migrate
* (Optionnel) Installer les fixtures pour avoir une démo de données fictives :
*     php bin/console doctrine:fixtures:load
*  Félications le projet est installé correctement, vous pouvez désormais commencer à l'utiliser à votre guise !
