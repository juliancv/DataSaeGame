<?php

class JugadorModel extends CI_Model{

    /*
    Metodo que retorna todos los jugadores almacenados en la base de datos
    */
    
    public function getAllJugadores(){

        $query = $this->db->get('jugadores');

        if($query->num_rows() > 0){

            return $query->result();
        }
    }

    /* Método que se encarga de enviar los datos del formulario a la base de datos */
    public function insert_jugador(){
       
        /*Se valida que el valor ingresado del dinero sea mayor a 10000 sino se ingresa el valor de defecto */
        if( $this->input->post('dinero') < 10000 ){
            
            $dineroIngresado = 10000;

        }else{

            $dineroIngresado = $this->input->post('dinero');
        }

        $data = array(
            'jug_nombre' => $this->input->post('nombre'),
            'jug_apellido' => $this->input->post('apellido'),
            'jug_edad' => $this->input->post('edad'),
            'jug_dinero' => $dineroIngresado
        );

        return $this->db->insert('jugadores', $data);
    }

    /**
     *  Método que se encarga de eliminar de la base de datos el registro seleccionado
     *  El borrado se hace de manera física sin embargo se pude instanciar como lógico. 
     */
    public function delete($id)    {
    
        $this->db->where('jug_id', $id);
        $this->db->delete('jugadores');
        
        return redirect(base_url('index.php/jugador'));
    }


    /**
     *  Metodo que retorna la información de un único jugador
     */

    public function getOneJugador($id){
       
        $datosJugador = $this->db->get_where('jugadores', array('jug_id' => $id))->row();
       
        return $datosJugador;
    }

    /**
     * Metodo que se encarga de realizar la actualización de los datos del jugador
     */

     public function updateRegistro(){
       
        /* Se valida que el valor ingresado del dinero sea mayor a 10000 sino se ingresa el valor de defecto
            La única manera de que el valor sea inferior es en caso de que el jugador pierda una apuesta */

        if( $this->input->post('dinero_edit') < 10000 ){
            
            $dineroIngresado = 10000;

        }else{

            $dineroIngresado = $this->input->post('dinero_edit');
        }
        
        //se captura el id del objeto a editar
        $id = $this->input->post('jug_id');

        $data = array(
            'jug_nombre' => $this->input->post('nombre_edit'),
            'jug_apellido' => $this->input->post('apellido_edit'),
            'jug_edad' => $this->input->post('edad_edit'),
            'jug_dinero' => $dineroIngresado
        );

        $this->db->where('jug_id',$id);
        
        return $this->db->update('jugadores',$data);

     }

     /**
      * Método que se encarga de actualizar la cantidad de dinero de cada registro de los jugadores.
      */
     public function actualizarDinero($resultadoApuestas){

        foreach($resultadoApuestas as $resultado){

            $id  =   $resultado [0];
            $ganancia = $resultado[3];

            $this->db->select('jug_dinero');
            $this->db->from('jugadores');
            $this->db->where('jug_id',$id);

            $saldoAnterior = $this->db->get()->row()->jug_dinero;

            $nuevoSaldo = $saldoAnterior + $ganancia;

            $data = array(
                'jug_dinero' => $nuevoSaldo
            );

            $this->db->where('jug_id',$id);
            $this->db->update('jugadores',$data);
        }

     }
    

}