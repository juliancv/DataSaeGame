###################
DataSae Game 2020
###################

El siguiente documento contiene la información necesaria para ejecutar dentro de un ambiente de docker
el juego desarrollado para cumplir con el reto de programación enviado por la empresa DataSAE.

#### Requerimientos ####

Servidor web con php 7.3
Servidor de base de datos con mysql 8

El aplicativo se desarrollo baja el framework de php codeignaiter 3.1

##########################
Installación del ambiente.
##########################

1) Clonar dentro del directorio requerido la rama master del repositorio.
2) Ejecutar el comando docker-composer up dentro de este para que se corran las imagenes del servidor de base de datos y el servidor web. 
3) Cargar dentro del servidor de base de datos el archivo gameDataSae_dumpDB.sql suministrado.
4) Configurar en el archivo src/application/config/config la ip del servidor de base de datos desplegado en la intancia de docker.
     * docker container ls , tomar el id del contenedor y Ejecutar
     * docker container inpect {ID_CONTENEDOR}, y tomar la ip que se encuentra dentro de la varible networks- IPAddres:

Para abrir el aplicativo, se debe ejecutar la url http://localhost:8000/game/

########################
Manual de uso
########################
-> Modulo jugar:
     Permite visualizar las apuestas y ultimo resultado de las apuestas.
     Para realizar una apuesta se debe dar click el botón Generar apuesta y Posteriormente en jugar.
     * En caso de que se encuentre activo el juego automático este se ejecuta cada minuto, ejecutando 
     las acciones de Generar apuesta y Jugar.
-> Módulo Administrar usuarios.
     Permite listar, editar, eliminar y agregar datos de los usuarios.
     * El valor minimo de dinero por defecto siempre será minimo 10.000.
-> Módulo Cambiar Automático.
     Este permite modificar el parámetro si el juego apuesta de manera automática o no.

Desarrollado por: Julian Stevan Vergaño Canacuan.