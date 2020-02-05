<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
    Clase controladora de las funciones relacionadas a los jugadores
*/

class Game extends CI_Controller {

    public function __construct(){
		parent::__construct();
    }
    
    public function index(){

        $this->load->view('base_header'); //Cabecera de la plantilla

        /* Se carga el modelo de datos */
        $this->load->model('PartidaModel');
        /* Se carga el listado de jugadores desde el modelo */
        $listaJugadores = $this->PartidaModel->getApuestas();

        /**
         * Se carga el listado con los ultimos registros de ganancias
         */
        $listaResultados = $this->PartidaModel->getResultadosApuestas();

        $this->load->view('game/principal', ['jugadores' => $listaJugadores, 'resultadosApu' => $listaResultados]); // se carga la vista principal del juego
        
        $this->load->view('base_footer'); //Footer de la plantilla
    }
   
}
