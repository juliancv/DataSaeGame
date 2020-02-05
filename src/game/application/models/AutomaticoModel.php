<?php

class AutomaticoModel extends CI_Model{

    /**
     * Este método retorna el estado de juego autatico
     */
    public function getUltimoValor(){

        $this->db->select('jue_au_automatico');
        $this->db->from('juegoAutomatico');
        $this->db->where('jug_au_id', '1');
        $saldoAnterior = $this->db->get()->row()->jue_au_automatico;

        return $saldoAnterior;
    }

    public function updateAutomatico(){

        $cambio = $this->input->post('cambiar_sel');

        $data = array(
            'jue_au_automatico' => $cambio
        );

        $this->db->where('jug_au_id', '1');
        $this->db->update('juegoAutomatico', $data);
    }

}


