<?php

class PartidaModel extends CI_Model{

    public function getApuestas(){

        $this->db->select("jugadores.jug_id,jugadores.jug_nombre,jugadores.jug_dinero,apuestas.ap_cantidad, apuestas.ap_color");
        $this->db->from('jugadores');
        $this->db->join('apuestas', 'jugadores.jug_id = apuestas.ap_jug_id', 'inner');
        $this->db->where('ap_registro_vigente',true);

        

        $query = $this->db->get();
        
        if($query->num_rows() != 0){
            return $query->result();
        }else{

            $this->db->select("jugadores.jug_id,jugadores.jug_nombre,jugadores.jug_dinero");
            $this->db->from('jugadores');
            $query = $this->db->get();

            if($query->num_rows() != 0){
                return  $query->result();
            }else{
                return false;
            }    
        }

    }


    /**
     * Metodo que se encarga de borrar los registros de las apuestas pasadas
     */

     public function reiniciarApuesta(){
        //Se desactivan todos los registros previos de la tabla de apuestas
        $data = array('ap_registro_vigente' => false );

        $this->db->where('ap_registro_vigente', true);
        $this->db->update('apuestas', $data);

     }

    /**
     * Método que se encarga de guardar los datos con las apuestas actuales
     */
    public function saveApuestas($listaApuestas){

        
        $this->reiniciarApuesta();

        foreach ($listaApuestas as $apuesta){
            $id_juga = $apuesta[0];
            $colorApu =  $apuesta[1];
            $cantidadApos = $apuesta[2];

            //Se insertan los registros dentro de la tabla de apuestas
            $data = array(  'ap_jug_id' => $id_juga,
                            'ap_cantidad' => $cantidadApos,
                            'ap_color' => $colorApu,
                            'ap_registro_vigente' => true );

            $this->db->insert('apuestas', $data);
        }


    }

    /**
     * Función que almacena el resultado de girar la ruleta
     */

     public function saveGiroRuleta($color){

        //Se desactivan todos los registros previos de la ruleta
        $data = array('ru_registro_vigente' => false );

        $this->db->where('ru_registro_vigente', true);
        $this->db->update('ruleta', $data);


        $data = array(  'ru_color' => $color,
                        'ru_registro_vigente' => true );

        $this->db->insert('ruleta', $data);

     }

    /**
     * Este método retorna la el ultimo resultado de la ruleta
     */
    public function getUltimoGiroRuleta(){

        $this->db->select("ruleta.ru_color");
        $this->db->from('ruleta');
        $this->db->where('ru_registro_vigente', true);

        $query = $this->db->get();

        if($query->num_rows() != 0){
            return  $query->row();
        }else{
            return null;
        }
    }


    /**
     * Este método retorna los datos de los jugadores relacionados con su ultima apuesta
     */

    public function getUltimasApuestas(){

        $this->db->select("apuestas.ap_jug_id,apuestas.ap_cantidad,apuestas.ap_color");
        $this->db->from('apuestas');
        $this->db->where('ap_registro_vigente', true);

        $query = $this->db->get();

        if($query->num_rows() != 0){
            return  $query->result();
        }else{
            return false;
        }    

    }


    /**
     * Método que almacena los resultados de las apuestas de cada jugador
     */
    public function saveResultados($resultadoApuestas){    
    
        foreach ($resultadoApuestas as $apuesta){
            $id_juga = $apuesta[0];
            $cantidadApos =  $apuesta[1];
            $colorApu =  $apuesta[2];
            $ganancia = $apuesta[3];
            $colorRuleta =  $apuesta[4];

            $resultadoApu = false;

            if($ganancia > 0){
                $resultadoApu = true;
            }

            //Se insertan los registros dentro de la tabla de apuestas
            $data = array(  'par_jug_id' => $id_juga,
                            'par_resultado' => $resultadoApu,
                            'par_ganancia' => $ganancia,
                            'par_color' => $colorApu,
                            'par_color_ruleta' => $colorRuleta,
                            'par_din_apostado' => $cantidadApos
                        );

            $this->db->insert('partidas', $data);
        }

    }

    /**
     * Este método retorna la lista con los últimos resultados obtenidos en el juego
     */

    public function getResultadosApuestas(){
        
        $this->db->select("jugadores.jug_nombre, partidas.*");
        $this->db->from('jugadores');
        $this->db->join('partidas', 'jugadores.jug_id = partidas.par_jug_id', 'inner');
        $this->db->where('par_registro_vigente',true);


        $query = $this->db->get();

        if($query->num_rows() != 0){
            return  $query->result();
        }else{
            return false;
        }
    }

    /**
     * Este método se encarga de reiniciar los resultados de las apuestas cambiando su estado vigente a false
     */
    public function reiniciarResultados(){
        //Se desactivan todos los registros previos de la tabla de apuestas
        $data = array('par_registro_vigente' => false );

        $this->db->where('par_registro_vigente', true);
        $this->db->update('partidas', $data);

    }

}