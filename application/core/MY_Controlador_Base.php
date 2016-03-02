<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controlador_Base extends CI_Controller {
	/**
     * Controlador Base
     *
     * @author Byron Oña
     */
	private $tiene_acceso = NULL;

	public function __construct(){
		parent::__construct();
	}

    function index() {
        redirect($this->router->class.'/listar');
    }

	/**
     * Llama a la vista desde la que se cargan los datos.
     *
     * @return void
     */
	function listar() {
        $this->load->view('plantilla/cabecera');
		$this->load->view($this->router->class.'_view');
        $this->load->view('plantilla/pie');
	}

    /**
     * Recupera desde la BD los datos existentes en formato JSON
     * 
     * @return void
     */
    function obtener_data() {
        $modelo = 'maestro_model';
        //$modelo = $this->router->class.'_model';
        $this->load->model($modelo);
        
        $resultado = array();
        $resultado['total'] = $this->$modelo->num_registros();
        $resultado['rows'] = $this->$modelo->obtener_todo();
        echo json_encode($resultado);
    }

    /**
     * Guarda en la BD los respectivos datos
     * 
     * @return void
     */
    function guardar_data() {
        $modelo = 'maestro_model';
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
    function actualizar_data() {
         $modelo = 'maestro_model';
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
    function eliminar_data() {
         $modelo = 'maestro_model';
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

/* End of file MY_Controlador_Base.php */
/* Location: ./application/core/MY_Controlador_Base.php */