UPGRADE:

v0.2:
	Creacion de Login y de interfaz de alumno.

	Instrucciones:
		
		- Hacer un git fetch --all y un git pull.
		- Correr el script de creacionTablaUsuario.sql.
		- Modificar los siguientes campos dentro del archivo parameters.yml:
			- mailer_user: racademyunla@gmail.com
			- mailer_password: unla2019
		- Correr el siguiente comando en la carpeta raiz: php composer.phar dump-autoload
		- Correr el siguiente comando en la carpeta raiz: php bin/console cache:clear
		Fin.


################################################################
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