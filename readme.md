# Sellercontrol WP Plugin
This is a plugin developed with [Antonella Framework](https://antonellaframework.com/), it is intended to be the UI, of the software [sellercontrol-node-v1](https://github.com/Gergab00/sellercontrol-node-v1)

Este es un plugin desarrollado con [Antonella Framework](https://antonellaframework.com/), esta pensado para ser la UI, del software [sellercontrol-node-v1](https://github.com/Gergab00/sellercontrol-node-v1). Este plugin esta pensado para funcionar junto con Woocommerce

## Comenzando 🚀

_Estas instrucciones te permitirán obtener una copia del proyecto en funcionamiento en tu máquina local para propósitos de desarrollo y pruebas._

Mira **Deployment** para conocer como desplegar el proyecto.


### Pre-requisitos 📋

_Que cosas necesitas para instalar el software y como instalarlas_

```
Da un ejemplo
```

### Instalación 🔧

_Una serie de ejemplos paso a paso que te dice lo que debes ejecutar para tener un entorno de desarrollo ejecutandose_

_Dí cómo será ese paso_

```
Da un ejemplo
```

_Y repite_

```
hasta finalizar
```

_Finaliza con un ejemplo de cómo obtener datos del sistema o como usarlos para una pequeña demo_

## Ejecutando las pruebas ⚙️

_Explica como ejecutar las pruebas automatizadas para este sistema_

### Analice las pruebas end-to-end 🔩

_Explica que verifican estas pruebas y por qué_

```
Da un ejemplo
```

### Y las pruebas de estilo de codificación ⌨️

_Explica que verifican estas pruebas y por qué_

```
Da un ejemplo
```

## Despliegue 📦

_Agrega notas adicionales sobre como hacer deploy_

## Construido con 🛠️

_Menciona las herramientas que utilizaste para crear tu proyecto_

* [Dropwizard](http://www.dropwizard.io/1.0.2/docs/) - El framework web usado
* [Maven](https://maven.apache.org/) - Manejador de dependencias
* [ROME](https://rometools.github.io/rome/) - Usado para generar RSS

## Contribuyendo 🖇️

Por favor lee el [CONTRIBUTING.md](https://gist.github.com/villanuevand/xxxxxx) para detalles de nuestro código de conducta, y el proceso para enviarnos pull requests.

## Wiki 📖

Puedes encontrar mucho más de cómo utilizar este proyecto en nuestra [Wiki](https://github.com/tu/proyecto/wiki)

## Versionado 📌

Usamos [SemVer](http://semver.org/) para el versionado. Para todas las versiones disponibles, mira los [tags en este repositorio](https://github.com/tu/proyecto/tags).

## Autores ✒️

_Menciona a todos aquellos que ayudaron a levantar el proyecto desde sus inicios_

* **Andrés Villanueva** - *Trabajo Inicial* - [villanuevand](https://github.com/villanuevand)
* **Fulanito Detal** - *Documentación* - [fulanitodetal](#fulanito-de-tal)

También puedes mirar la lista de todos los [contribuyentes](https://github.com/your/project/contributors) quíenes han participado en este proyecto. 

## Licencia 📄

Este proyecto está bajo la Licencia (Tu Licencia) - mira el archivo [LICENSE.md](LICENSE.md) para detalles

## Expresiones de Gratitud 🎁

* Comenta a otros sobre este proyecto 📢
* Invita una cerveza 🍺 o un café ☕ a alguien del equipo. 
* Da las gracias públicamente 🤓.
* Dona con cripto a esta dirección: `0xf253fc233333078436d111175e5a76a649890000`
* etc.


[![Total Downloads](https://poser.pugx.org/cehojac/antonella-framework-for-wp/downloads)](https://packagist.org/packages/cehojac/antonella-framework-for-wp)
[![Latest Unstable Version](https://poser.pugx.org/cehojac/antonella-framework-for-wp/v/unstable)](https://packagist.org/packages/cehojac/antonella-framework-for-wp)
[![License](https://poser.pugx.org/cehojac/antonella-framework-for-wp/license)](https://packagist.org/packages/cehojac/antonella-framework-for-wp)
[![Gitter](https://badges.gitter.im/Antonella-Framework/community.svg)](https://gitter.im/Antonella-Framework/community?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge)

Antonella Framework for WordPress
================================

Framework for develop WordPress plugins based on Model View Controller
You can read the full documentation in https://antonellaframework.com/documentacion

## Requeriments
* php (minimun 5.6) 
* composer
* git

## Instalation
create a folder for yours antonella framework's projects and execute

`composer create-project --prefer-dist cehojac/antonella-framework-for-wp:dev-master my-awesome-plugin`

my-awesome-plugin is your project's plugin

`cd my-awesome-plugin`

this is all!!- start your marvelous plugin in wordpress

## Basics

Antonella Framework have console functions:

`php antonella namespace FOO`

rename the namespace in all files

`php antonella make MyClassController`

create MyClassController.php file in src folder whit pre-data

`php antonella widget MyWidget`

create a Class for Widget Function

## Export you zip plugin

`php antonella makeup`
Compress your project in a .zip file 


