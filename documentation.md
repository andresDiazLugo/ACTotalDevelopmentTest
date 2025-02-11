# Instrucciones para Ejecutar el Proyecto

Sigue estos pasos para configurar y ejecutar el proyecto:

## Paso 1: Instalar dependencias de npm

Para instalar las dependencias necesarias de Node.js, ejecuta el siguiente comando en tu terminal:

npm install
## Paso 2: Instalar dependencias de PHP(Importante: Instalar PHP(version 8.4.3) y Composer(2.8.5) )
Para instalar las dependencias necesarias de PHP, ejecuta el siguiente comando en tu terminal:
composer install

## Paso 3: Colocar las variables de entorno en la carpeta raíz del proyecto
![alt text](/imgDocumentation/image.png)
## Paso 4: Crear una base de datos con mysql aca te dejo las instrucciones como puedes hacerlo
.En tu buscador de tus sistema operativo  busca mysql, haz click en la opcion MySQL Command line Client, una vez echo click se te abrira la consola
![alt text](/imgDocumentation/image-2.png)

.Coloca tus credenciales username en caso que te lo pida y tu contraseña, una vez colocado te aparecera algo parecido a esto 
![alt text](/imgDocumentation/image-3.png)

.En la consola debes colocar este comando (CREATE DATABASE actotaldevelopment;) este comando te creara una base de datos llamada actotaldevelopment es la que usamos en el local si quieres usala si no
deberas cambiar el nombre de la base de datos en el archivo .env con la base de datos que creaste. ejemplo:
![alt text](/imgDocumentation/image-1.png)
## Paso 5: Correr el script npm run start para levantar el servidor de php en modo local(importante tener php instalado)
npm run start