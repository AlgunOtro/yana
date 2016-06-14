<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Proyectos extends MY_Admin_Ctrl {
	/**
     * Compras
     *
     * @author Byron Oña
     */

	public function __construct(){
		parent::__construct();
        $this->establecer_nombre_modulo('proyectos/');
	}

    function index()
    {
        redirect($this->router->class.'/listar');
    }

	/**
     * Llama a la vista desde la que se cargan los datos.
     *
     * @return void
     */
    function editar()
    {
        $this->load->model('proyectos/proyectos_model');
        $data['rows'] = $this->proyectos_model->obtener_nombre();
        $data['total'] = $this->proyectos_model->num_registros();
        $this->load->view('plantilla/cabecera');
        $this->load->view('proyectos/proyectos',$data);
        $this->load->view('plantilla/pie');
    }

    /*function obtener_todo()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $offset = ($page-1)*$rows;

        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $this->load->model('proyectos/proyectos_model');
        $data['rows'] = $this->proyectos_model->obtener_todo($rows,$offset,$sort,$order);
        $this->load->view('plantilla/cabecera');
        $this->load->view('proyectos/proyectos_view',$data);
        $this->load->view('plantilla/pie');
    }*/
}

/* End of file proyectos.php */
/* Location: ./application/core/proyectos.php */