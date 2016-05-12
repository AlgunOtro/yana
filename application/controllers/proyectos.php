<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Proyectos extends MY_Controlador_Base {
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
        $this->load->model('proyectos/proyectos_model');
        $data['rows'] = $this->proyectos_model->obtener_nombre();
        $data['total'] = $this->proyectos_model->num_registros();
        $this->load->view('plantilla/cabecera');
        $this->load->view('proyectos/proyectos_view',$data);
        $this->load->view('plantilla/pie');
    }

    function editar()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $offset = ($page-1)*$rows;

        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $this->load->model('proyectos/proyectos_model');
        $data['rows'] = $this->proyectos_model->obtener_todo($rows,$offset,$sort,$order);
        $this->load->view('plantilla/cabecera');
        $this->load->view('proyectos/proyectos_form',$data);
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

    public function postCURL($_url, $_param)
    {
        $postData = '';
        //create name value pairs seperated by &
        foreach($_param as $k => $v) 
        { 
          $postData .= $k . '='.$v.'&'; 
      }
      rtrim($postData, '&');

      $user_agent = 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36';
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,$_url);
      curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);   
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_HEADER, false); 
      curl_setopt($ch, CURLOPT_POST, count($postData));
      curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);    
       
      $output=curl_exec($ch);

      curl_close($ch);

      return $output;
  }
}

/* End of file proyectos.php */
/* Location: ./application/core/proyectos.php */