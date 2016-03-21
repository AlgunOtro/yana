<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permisos extends MY_Admin_Ctrl {
	/**
     * Controlador Permisos
     *
     * @author Byron Oña
     */

	function __construct(){
		parent::__construct();
	}

	function index() {
		redirect($this->router->class.'/listar');
	}

    /**
     * Eliminar los datos en la BD
     *
     * @return void
     */
    function eliminar_data() {
        $this->load->model('usuarios/permisos_model');
        //Recuperar los errores desde el modelo
        $resultados = $this->permisos_model->eliminar();
        if( $resultados === TRUE ) {
            $arr_res = array('success' => TRUE);
        } else {
            $arr_res = array('isError' => TRUE,'msg' => $resultados);
        }
        echo json_encode($arr_res);
    }

    function probar_modelo() {
        $this->load->model('usuarios/permisos_model');
        var_dump( $this->permisos_model->obtener() );
        //var_dump( $this->objetos_model->existe('usuarios') );
    }
}

/* End of file permisos.php */
/* Location: ./application/controllers/permisos.php */