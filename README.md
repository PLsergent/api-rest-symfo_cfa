# Gestion de catalogue V0
# Application minimale � installer comme fil rouge de test 
# du cours API en Symfony
#
# Symfony 5.0.8, PHP 7.3.11, MySQL 8.0.18
#
# Pour l'installation, les commandes suivantes vous permettront :
# de rapatrier touts les d�pendances (vendor)
# de cr�er la base de donn�es
# d'y cr�er les tables SQL
# de cr�er un jeu de donn�es dans la base de donn�es (fixtures)

### Installation :

- `composer install`
- `php bin/console doctrine:database:create`
- `php bin/console d:m:m`
- `php bin/console d:f:l --no-interaction`

### OpenSSL note :

- Generate private key: 
`openssl genrsa -des3 -out mykey.pem 2048`

- Extract public key from myley.pem:
`openssl rsa -in mykey.pem -pubout -out pubkey.pem`