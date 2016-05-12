<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Compras extends CI_Controller {
	/**
     * Compras
     *
     * @author Byron Oña
     */

	public function __construct(){
		parent::__construct();
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
	function listar()
    {
        $this->load->view('plantilla/cabecera');
		$this->load->view('carro_view');
        $this->load->view('plantilla/pie');
	}

    /**
     * Agrega un producto al carro de compras
     *
     * @param int
     * @return bool
     */
     function agregar_producto()
    {
        $data = json_decode($this->input->post('data'));
        print_r($data);
        if( 1 ) {
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

/* End of file compras.php */
/* Location: ./application/core/compras.php */