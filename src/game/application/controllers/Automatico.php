<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
    Clase controladora de las funciones relacionadas a los jugadores
*/

class Automatico extends CI_Controller {

    public function __construct(){
		parent::__construct();
    }

    /**
     * Este método se encarga de cambiar los datos del juego automatico
     */
    public function cambiar(){

    $this->load->view('base_header'); //Cabecera de la plantilla
       
    $this->load->model('AutomaticoModel'); //Se carga el modelo con el que se relaciona la clase
    $valorEditar = $this->AutomaticoModel->getUltimoValor();    
    
    $this->load->view('automatico/editar', ['valorEditar' => $valorEditar ]);// Vista de edición del parámetro de juego automático

    $this->load->view('base_footer'); //Footer de la plantilla

    }

    /**
     * Metodo que actualiza el registro en la bd
     */
    public function actualizar(){

        $this->load->model('AutomaticoModel'); //Se carga el modelo con el que se relaciona la clase
        $valorEditar = $this->AutomaticoModel->updateAutomatico();  
        
        return redirect(base_url('index.php/automatico/cambiar'));
        
    }

}