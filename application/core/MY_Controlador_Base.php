<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controlador_Base extends CI_Controller {
	/**
     * Controlador Base
     *
     * @author Byron Oña
     */
	private $tiene_acceso = NULL;
    private $modelo = NULL;

	public function __construct(){
		parent::__construct();
        $this->modelo = $this->router->class.'_model';
        $this->load->model('proyectos/'.$this->modelo);
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
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $offset = ($page-1)*$rows;

        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        
        $modelo = $this->modelo;
        //$modelo = $this->router->class.'_model';
        //$this->load->model('proyectos/'.$modelo);
        
        $resultado = array();
        $resultado['total'] = $this->$modelo->num_registros();
        $resultado['rows'] = $this->$modelo->obtener_todo($rows,$offset,$sort,$order);
        echo json_encode($resultado);
    }

    /**
     * Guarda en la BD los respectivos datos
     * 
     * @return void
     */
    function guardar_data() {
        $modelo = $this->modelo;
        //$modelo = $this->router->class.'_model';
        //$this->load->model('proyectos/'.$modelo);
        $respuesta = $this->$modelo->guardar_actualizar();
        if( $respuesta === TRUE ) {
            $resultado = array('success' => TRUE);
        } else{
            $resultado = array(
                'isError' => TRUE,
                'message' => $respuesta
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
        $modelo = $this->modelo;
        //$modelo = $this->router->class.'_model';
        //$this->load->model('proyectos/'.$modelo);
        $respuesta = $this->$modelo->guardar_actualizar();
        if( $respuesta === TRUE ) {
            $resultado = array('success' => TRUE);
        } else{
            $resultado = array(
                'isError' => TRUE,
                'message' => $respuesta
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
        $modelo = $this->modelo;
        //$modelo = $this->router->class.'_model';
        //$this->load->model('proyectos/'.$modelo);

        if( $this->$modelo->eliminar() === TRUE ) {
            $resultado = array('success' => TRUE);
        } else{
            $resultado = array(
                'isError' => TRUE,
                'message' => $resultado
            );
        }
        echo json_encode($resultado);
    }

    function establecer_nombre_modelo($nombre='')
    {
        $this->modelo = $nombre;
    }
}

/* End of file MY_Controlador_Base.php */
/* Location: ./application/core/MY_Controlador_Base.php */