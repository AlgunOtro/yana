<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Elementos extends MY_Controlador_Base
{
    /**
     * Elementos
     *
     * @author Byron Oña
     */
    public $modelo = '';

    public function __construct()
    {
        parent::__construct();
        log_message('debug', 'Controlador Elemento Iniciado');
        $this->modelo = 'elementos_model';
        $this->load->model('proyectos/'.$this->modelo);
    }

    function index()
    {
        redirect($this->router->class.'/editar');
    }

    /**
     * Llama a la vista desde la que se cargan los datos.
     *
     * @return void
     */
    function editar()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $offset = ($page-1)*$rows;

        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        
        $nombre_modelo = $this->modelo;
        //$modelo = 'elementos_model';
        //$this->load->model('proyectos/'.$modelo);
        $this->establecer_nombre_modelo($nombre_modelo);
        $data['rows'] = $this->$nombre_modelo->obtener_todo($rows,$offset,$sort,$order);
        $this->load->view('plantilla/cabecera');
        $this->load->view('proyectos/elementos_form',$data);
        $this->load->view('plantilla/pie');
    }

    function proyectos_data()
    {
        $modelo = 'proyectos_model';
        $this->load->model('proyectos/'.$modelo);
        $this->establecer_nombre_modelo($modelo);
        $data['rows'] = $this->proyectos_model->obtener_nombre();
        echo json_encode($data['rows']);
    }
    
    function obtener_detalle() {
        $modelo = 'tareas_model';
        $this->load->model('proyectos/'.$modelo);
        $resultado = array();
        $resultado['total'] = $this->$modelo->num_registros();
        $resultado['rows'] = $this->$modelo->obtener_por_elemento();
        echo json_encode($resultado);
    }

    /**
     * Guarda en la BD los respectivos datos
     * 
     * @return void
     */
    function guardar_detalle() {
        $modelo = 'tareas_model';
        $this->load->model('proyectos/'.$modelo);
        if( $this->$modelo->guardar_actualizar() ) {
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
        $modelo = 'tareas_model';
        $this->load->model('proyectos/'.$modelo);

        if( $this->$modelo->guardar_actualizar() ) {
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
        $modelo = 'tareas_model';
        $this->load->model('proyectos/'.$modelo);

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

/* End of file elementos.php */
/* Location: ./application/core/elementos.php */