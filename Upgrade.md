UPGRADE:

v0.1:
	- Hacer un git pull.
	- Crear la base de datos con el script: "CreateSchema1.2" ubicado en la carpeta /scripts.
	- Habilitar la extensión openssl dentro del php.ini.
	- Correr el siguiente comando en la carpeta raiz: php composer.phar dump-autoload
	- Correr el siguiente comando en la carpeta raiz: php bin/console cache:clear
	Fin.

C:\wamp64\www\Royal_Academy>php bin/console server:run

"symfony/templating": "^4.3",
composer.json linea 34