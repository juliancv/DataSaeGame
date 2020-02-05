<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
    Clase controladora de las funciones relacionadas a los jugadores
*/

class Jugador extends CI_Controller {

    public function __construct(){
		parent::__construct();
	}

    public function index(){
        /* Se carga el modelo de datos */
        $this->load->model('JugadorModel');
        /* Se carga el listado de jugadores desde el modelo */
        $listaJugadores = $this->JugadorModel->getAllJugadores();

        /* Se llama a la vista de listado */

        $this->load->view('base_header'); //Cabecera de la plantilla

        $this->load->view('jugadores/listar', ['listaJugadores' => $listaJugadores]);
        //$this->load->view('jugadores/listar');

        $this->load->view('base_footer'); //Footer de la plantilla
    }


    /*
        Este método se encarga de desplegar el formulario para agregar un nuevo jugador a la  base de datos
    */
    public function nuevo(){

        $this->load->view('base_header'); //Cabecera de la plantilla

        // $this->load->view('jugador/listar', ['listaJugadores' => $listaJugadores]);
        $this->load->view('jugadores/nuevo');

        $this->load->view('base_footer'); //Footer de la plantilla

    }

    /**
     *  Metodo que se encargar de pasar los datos al modelo para ser almacenados
     */

    public function store(){

        $this->load->model('JugadorModel');
        
        $this->JugadorModel->insert_jugador();

        redirect(base_url('index.php/jugador'));
    }

    /**
     *  Metodo encargado de eliminar el registro de la base de datos.
     */

    public function delete(){

        $this->load->model('JugadorModel');//Se carga el modelo con el que se relaciona la clase
        $id = $this->uri->segment(3); //Se obtiene el id desde la url que se desea eliminar
        $this->JugadorModel->delete($id);
    }

    /**
     *  Metodo que despliega la vista de edición de un resgistro.
     */

     public function editar(){

        $this->load->model('JugadorModel'); //Se carga el modelo con el que se relaciona la clase

        $this->load->view('base_header'); //Cabecera de la plantilla

        // $this->load->view('jugador/listar', ['listaJugadores' => $listaJugadores]);
        $id = $this->uri->segment(3); //Se obtiene el id desde la url que se desea eliminar
        $datosJugador = $this->JugadorModel->getOneJugador($id);

        $this->load->view('jugadores/editar', ['id' => $id, 'jugador' => $datosJugador]);

        $this->load->view('base_footer'); //Footer de la plantilla

     }

     /**
      * Este método se encarga de llamar al modelo para realizar la actualización
      */
     public function update(){

        $this->load->model('JugadorModel'); //Se carga el modelo con el que se relaciona la clase
        
        $this->JugadorModel->updateRegistro(); 

        return redirect(base_url('index.php/jugador'));
     }

}