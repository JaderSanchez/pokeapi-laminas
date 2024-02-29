# PokeAPI - Laminas
Esta es una prueba ténica para productos Eterna desarrollada por Jader Alejandro Sánchez Betancur el 29 de febrero del 2024

> ## Instalación
>Debe tener [Composer](https://getcomposer.org/) instalado y PHP en la version 8.1.4, en caso de no poder instalar PHP y/o composer, se recomienda usar [Docker](https://docs.docker.com/engine/install/) siguiendo los pasos de su pagina oficial para su instalación.

- Abrir una terminal o CMD y nos ubicamos en el directorio donde queremos clonar el projecto.

- Clonar el repositorio con el siguiente comando:
```bash
git clone https://github.com/JaderSanchez/pokeapi-laminas.git
```

- Entramos al proyecto con el siguiente comando:
```bash
cd pokeapi-laminas
```

- (Solo para docker) Ejecutamos el siguiente comando para crear un contenedor con PHP 8.1.4 y composer:
```bash
docker run --rm -ti -v .:/app -p 8080:8080 composer:2.2.9 bash
```

- Instalamos las dependencias con el siguiente comando:
```bash
composer install
```

- Iniciamos el servidor de desarrollo con el siguiente comando:
```bash
php -S 0.0.0.0:8080 -t public public/index.php
```
**Note:** Verificar que tenga el puerto 8080 disponible o elegir un puerto a su preferencia.

Finalmente en el navegador podemos ingresar a http://localhost:8080

**Note:** Para facilidades de esta prueba, se desplegó la [aplicación](http://44.214.221.7:8080/) en un servidor para quien desee usarla sin instalar el proyecto, estará disponible hasta el 7 de marzo de 2024