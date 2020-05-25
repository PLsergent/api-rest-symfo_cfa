# Gestion de catalogue V0
Basic project to implement an API REST using symfony.

### Installation :

- `composer install`
- `php bin/console doctrine:database:create`
- `php bin/console d:m:m`
- `php bin/console d:f:l --no-interaction`

### OpenSSL note :

- Generate private key: 
`openssl genrsa -des3 -out mykey.pem 2048`

- Extract public key from mykey.pem:
`openssl rsa -in mykey.pem -pubout -out pubkey.pem`
