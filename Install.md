Requisitos para instalar esta aplicación:
	- Xampp o Wammp con php 7.2 y MySQL.

 1) Configuración de PHP:
 	- Creación de PATH para poder ejecutar comandos PHP desde consola de Windows:
 		1) Abrir Panel de Control.
 		2) Abrir Sistema y Seguridad.
 		3) Abrir Sistema.
 		4) Abrir Configuración avanzada del sistema.
 		5) Abrir Variables de entorno.
 		6) Seleccionar dentro de la lista de Variables de usuario para usuario la opción Path y hacer click en editar.
 		7) Colocar el cursor al final y agregar ";UBICACION_DE_PHP7.2" (Por defecto en Wampp: C:\wamp64\bin\php\php7.2.10).
 		8) Aceptar y luego dar click en Aceptar nuevamente.

 2) Clonar el repositorio dentro de la carpeta www de Wampp o Xampp (Por defecto Wampp: C:\\wamp64\www\).
 	- Github Desktop:
 		1) Apretar las teclas Ctrl+Shift+O para abrir el menu de clonación.
 		2) Dentro del menú seleccionar URL.
 		3) Dentro del menú URL copiar en URL: https://github.com/Joante/Royal_Academy y luego seleccionar la carpeta de destino, la cual debería ser la carpeta www dentro del directorio de wampp o xampp.

 	- Git Bash: 
 		1) Dentro de la carpeta www ejecutar el siguiente comando:
 			- git clone https://github.com/Joante/Royal_Academy

 3) Configurar los parametros de la aplicación para su conexión con la base de datos:
 	1) Dentro de la carpeta /app/config del proyecto copiar el archivo parameters.yml.dist y nombrarlo parameters.yml
 	2) Modificar: 
 		- database_user: root
    	- database_password: null

    	Por los valores correspondientes.

 4) En la carpeta principal del proyecto correr el siguiente comando con la consola de Windows:
 	- install.bat

 	Esto instalara composer y creara la base de datos.