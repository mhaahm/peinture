# Site de Peinture 

C'est un site de présentation des différent type de peinture 
pour un peintre

## Environnement de développement

### Pré-requis
* PHP 7.4
* Composer
* Symfony CLI
* Docker
* Docker-compose
* nodejs

Vous pouvez vérifier les pré-requis (sauf docker-compose )
avec la commande suivante symfony 

```bash
symfony check:requirements
```
```bash
composer install
npm install
npm run build
docker-compose up -d
symfony serve -d
```

### Ajouter des données de fixture
Il faut lancer la commande 
```bash
symfony console d:f:l
```
