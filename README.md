# fulll

# Step 
docker compose up -d --build

docker compose exec php bash

composer install

# Exercice Algo Full

-> lancer la commande 

`bin/console app:algo ARGS_OPTIONNEL`


# Exercice Back -  Full

-> lancer la migration Doctrine pour mettre son mapping a jour.

`bin/console doctrine:migrations:migrate`


### Création de la flotte pour un user
`bin/console fleet:create userID`

`bin/console fleet:create 1`


### Ajouter un véhicule à la flotte

`bin/console fleet:register-vehicle fleetID plateNumber`

`bin/console fleet:register-vehicle 1 XX-000-XX`

### Localiser le véhicule par flotte et plaque

`bin/console fleet:register-vehicle fleetID plateNumber lat long`

`bin/console fleet:register-vehicle 1 XX-000-XX 45.3 5.98898`



### Question de la Step 3

### For code quality, you can use some tools : which one and why (in a few words) ?

-> Lint/Prettier – Formate automatiquement le code pour avoir une cohérence entre tous les devs.

-> SonarQube – Analyze le code 

-> PhpUnit - Test Unitaires


### you can consider to setup a ci/cd process : describe the necessary actions in a few words

Créer un fichier de pipeline de conf

install les dependances si besoin, (composer, yarn, npm )

gestion des tests

analyze du code - eslint par exemple

Deploiement vers un conteneur docker par exemple

on peut avoir un systeme d'alerte en cas d'erreur
