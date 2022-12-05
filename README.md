# Projet LAB5 - GTI619

## Lancer le projet

Le projet fonctionne sous docker, de la même manière que le squelette donné dans l'énoncé.

```shell
npm install
composer install
cd <racine_projet>/vendor/bin
./sail up -d
./sail artisan migrate
./sail artisan db:seed
```

## Récupérer le certificat root CA pour le navigateur

1) Récupérer l'id du conteneur Caddy
````shell
docker ps
````

2) Copier le certificat

````shell
docker cp {container_id}:/config/caddy/pki/authorities/local/root.crt {endroit_ou_vous_voulez_copier}
````

3) Installer le certificat dans le navigateur

## Auteurs

Antoine Merle,
Charles-Antoine Barrière,
et Hamza Laghrieb
