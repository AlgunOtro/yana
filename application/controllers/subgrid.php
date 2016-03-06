<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Subgrid extends MY_Controlador_Base {

	/**
	 * Controlador Subgrid.
	 *
	 * @author Byron Oña
	 */
	function __construct(){
		parent::__construct();
	}

	/**
     * Recupera desde la BD los datos existentes en formato JSON
     * 
     * @return void
     */
    function obtener_detalle() {
        $modelo = 'detalle_model';
        $this->load->model($modelo);
        
        $resultado = array();
        $resultado['total'] = $this->$modelo->num_registros();
        $resultado['rows'] = $this->$modelo->obtener();
        echo json_encode($resultado);
    }

    /**
     * Guarda en la BD los respectivos datos
     * 
     * @return void
     */
    function guardar_detalle() {
        $modelo = 'detalle_model';
        //$modelo = $this->router->class.'_model';
        $this->load->model($modelo);
        if( $this->$modelo->insertar() ) {
            $resultado = array('success' => TRUE);
        } else{
            $resultado = array(
                'isError' => TRUE,
                'message' => 'No se guardaron los datos.'
            );
        }
        echo json_encode($resultado);
    }

    /**
     * Actualiza en la BD los respectivos datos
     * 
     * @return void
     */
    function actualizar_detalle() {
         $modelo = 'detalle_model';
        //$modelo = $this->router->class.'_model';
        $this->load->model($modelo);

        if( $this->$modelo->actualizar() ) {
            $resultado = array('success' => TRUE);
        } else{
            $resultado = array(
                'isError' => TRUE,
                'message' => 'No se guardaron los datos.'
            );
        }
        echo json_encode($resultado);
    }

    /**
     * Elimina en la BD el registro respectivo
     * 
     * @return void
     */
    function eliminar_detalle() {
         $modelo = 'detalle_model';
        //$modelo = $this->router->class.'_model';
        $this->load->model($modelo);

        if( $this->$modelo->eliminar() ) {
            $resultado = array('success' => TRUE);
        } else{
            $resultado = array(
                'isError' => TRUE,
                'message' => 'No se guardaron los datos.'
            );
        }
        echo json_encode($resultado);
    }
}

/* End of file subgrid.php */
/* Location: ./application/controllers/subgrid.php */