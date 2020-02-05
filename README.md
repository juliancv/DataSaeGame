###################
DataSae Game 2020
###################

El siguiente documento contiene la información necesaria para ejecutar dentro de un ambiente de docker
el juego desarrollado para cumplir con el reto de programación enviado por la empresa DataSAE.

#### Requerimientos ####

Servidor web con php 7.3
Servidor de base de datos con mysql 8

##########################
Installación del ambiente.
##########################

1) Clonar dentro del directorio requerido la rama master del repositorio.
2) Ejecutar el comando docker-composer up dentro de este para que se corran las imagenes del servidor de base de datos y el servidor web. 
3) Cargar dentro del servidor de base de datos el archivo gameDataSae_dumpDB.sql suministrado.
4) Configurar en el archivo src/application/config/config la ip del servidor de base de datos desplegado en la intancia de docker.
     * docker container ls , tomar el id del contenedor y Ejecutar
     * docker container inpect {ID_CONTENEDOR}, y tomar la ip que se encuentra dentro de la varible networks- IPAddres:

Desarrollado por: Julian Stevan Vergaño Canacuan.