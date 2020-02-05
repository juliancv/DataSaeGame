<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generador extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    /**
     * Esta función se encarga de retornar el color con el cual se va a realizar la apuesta o el juego como tal.
     * Este genera un aleatoreo entre 1 y 100, siento negro y blanco los números del 1 al 98 y verde los 99 y 100.
     * Para diferenciar entre negro y blanco asumiremos blanco los pares y negro los impares.
     * Si el aletoreo es 99 o 100 el resultado es verde.
     * Con lo anterior tenemos que se conserva una probabilidad de apuesta como de juego de:
     *  -> negro 49 %
     *  -> blaco 49 %
     *  -> verde 2  %
     */

    public function generarColor(){

        $color = null;

        //Se genera el número a evaluar

        $numeroAle = mt_rand(1,100);

        if($numeroAle == 99 || $numeroAle == 100 ){
            $color = 'Verde'; 
        }else{
            //Se evalua la paridad del número para generar el color respectivo
            if($numeroAle % 2 == 0){
                $color = 'Blanco';
            }else{
                $color = 'Negro';
            }

        }

        return $color;
    }

    /**
     *  Este método retorna la cantidad de dinero a ser apostada por un jugador de manera aleatore entre 
     *  el 8% y 15% de su saldo, siempre y cuando este sea mayor a 1000, en caso contrario se apuesta el monto total.
     */

     public function generarCantidadApuesta($capitalJugador){

        $apostar = 0;

        if($capitalJugador <= 1000){
            $apostar = $capitalJugador;
        }else{
            //se genera un aleatoreo entre 8 y 15 parar extraer la cantidad a aportar

            $porInversion = mt_rand(8,15);

            $apostar = ($capitalJugador * $porInversion) / 100;

        }

        return $apostar;
     }


    /**
     * Método que se encarga de realizar las apuestas inciales de los jugadores.
     * En caso de que ya se haya apostado y no jugado, los valores se sobreescriben en la base de datos.
     */
    public function generar(){
        
        // Se carga el modelo de los jugadores
        $this->load->model('JugadorModel');
        /* Se carga el listado de jugadores desde el modelo */
        $listaJugadores = $this->JugadorModel->getAllJugadores();

        $datosAlmacenar = [];

        foreach ($listaJugadores as $jugador){

            $id_jugador = $jugador->jug_id;
            $capital = $jugador->jug_dinero;

            //Se llama al método que genera el color al que se va a apostar
            $colorApuesta =  $this->generarColor();
            //Se llama al método que genera la cantidad a apostar
            $apuesta = $this->generarCantidadApuesta($capital);

            $jugador = [$id_jugador, $colorApuesta, $apuesta];

            array_push($datosAlmacenar, $jugador);
        }

        //Se hace el llamado al modelo encargado de almacenar los datos en la tabla de apuestas.

       // Se carga el modelo de las partidas
        $this->load->model('PartidaModel');

        $this->PartidaModel->saveApuestas($datosAlmacenar);
        $this->PartidaModel->saveGiroRuleta($this->generarColor());



        redirect(base_url());

    }
    
    /**
     * Metodo que se encarga de hacer la evaluación de las apuestas en contraste a lo determininado en la ruleta
     */

     public function jugar(){

        // Se carga el modelo de las partidas
        $this->load->model('PartidaModel');

        $apuestaPorPersona = $this->PartidaModel->getUltimasApuestas();
        $colorRuleta = $this->PartidaModel->getUltimoGiroRuleta()->ru_color;
        
        //Este arreglo contiene los resultados de las evaluaciones del juego;
        $resultadoApuestas = [];

        foreach ($apuestaPorPersona as $persona){

            $ganancia = 0;
            $asierto = false;

            if($persona->ap_color == $colorRuleta){
                               
                $asierto = true;

                if($colorRuleta == 'Verde'){
                    $ganancia = $persona->ap_cantidad * 15;
                }else{
                    $ganancia = $persona->ap_cantidad * 2;
                }

            }else{

               $ganancia = $persona->ap_cantidad * -1;
            }

            $resultado = [$persona->ap_jug_id, $persona->ap_cantidad, $persona->ap_color,$ganancia,$colorRuleta];

            array_push($resultadoApuestas,$resultado);

        }

        //Se reinician los resultados dentro de los registros de la base de datos 
        $this->PartidaModel->reiniciarResultados();

        //Se almacena dentro de la base de datos los resultados del juego
        $this->PartidaModel->saveResultados($resultadoApuestas);
        
        //Se actualiza la cantidad de dinero de cada jugador con los resultados obtenidos
        $this->load->model('JugadorModel');//Se carga el modelo con el que se relaciona la clase
        //Método que se encarga de actualizar el dinero de cada jugador.
        $this->JugadorModel->actualizarDinero($resultadoApuestas);
        //Se reinician las apustas con los nuevos montos de dinero
        $this->PartidaModel->reiniciarApuesta();

        redirect(base_url());
     }

}