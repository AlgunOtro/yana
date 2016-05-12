<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Tareas extends CI_Controller {
    /**
     * Tareas
     *
     * @author Byron Oña
     */

    public function __construct()
    {
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
    function listar($id = '')
    {
      $data['e1'] = array();
      $data['e2'] = array();
      $data['e3'] = array();
      $this->load->model('proyectos/tareas_model');
      $resultado['rows'] = $this->tareas_model->obtener($id);
      for ($i=0; $i < count($resultado['rows']); $i++) {
        switch ($resultado['rows'][$i]['estado']) {
          case 1:
            array_push($data['e1'], $resultado['rows'][$i]);
            break;
          case 2:
            array_push($data['e2'], $resultado['rows'][$i]);
            break;
          case 3:
            array_push($data['e3'], $resultado['rows'][$i]);
            break;
          default:
            break;
        }
      }
      $this->load->view('plantilla/cabecera');
      $this->load->view('proyectos/tareas_view',$data);
      $this->load->view('plantilla/pie');
    }

    function test_model($value='')
    {
      $this->load->model('proyectos/proyectos_model');
      $data['rows'] = $this->proyectos_model->obtener_nombre();
      $data['total'] = $this->proyectos_model->num_registros();
      $this->load->view('plantilla/cabecera');
      $this->load->view('proyectos/proyectos_view',$data);
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

  /* End of file tareas.php */
/* Location: ./application/core/tareas.php */