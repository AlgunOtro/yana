<?php
/**
 * Archivo MY_Admin_Ctrl.php
 *
 * Contiene la Clase MY_Admin_Ctrl que extiende de la Clase CI_Controller
 *
 * @package Atuk\Usuarios
 * @author Byron Oña
 * @copyright © 2015-2016 Byron Oña
 * @license GPL
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version v1.0.0
 */

/** No acceso directo */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controlador MY_Admin_Ctrl
 *
 * Permite gestionar el módulo Administración de Usuarios de la aplicación
 *
 * @package Atuk\Usuarios
 * @author Byron Oña
 * @version v1.0.0
 */
class MY_Admin_Ctrl extends CI_Controller
{
	/**
     * Constructor
     *
     * Carga la clase padre CI_Controller, el archivo de
     * idioma sigep en español, comprueba si ya tiene la
     * sesión activa, carga el modelo permiso_acceso y
     * comprueba si tiene acceso al recurso solicitado.
     *
     * @return  void
     */
	public function __construct()
    {
		parent::__construct();
		$this->lang->load('sigep','spanish');
		if ($this->session->userdata('logged_in'))
        {
            $this->load->model('inicio/permiso_acceso');
			if ( ! $this->permiso_acceso->tiene_acceso( $this->router->class, $this->session->userdata('username')))
            {
				redirect('inicio');
			}
		}
        else
        {
            redirect('inicio');
        }
	}

	/**
     * Llama a la vista desde la que se cargan los datos.
     *
     * @return void
     */
	function listar()
    {
		$data = array();
		$arr_menu = $this->permiso_acceso->obtener_permisos($this->session->userdata('username'));
		$menu['menu'] = $arr_menu;
		$data = array_merge($data,$menu);

		$this->load->view('plantilla/cabecera',$data);
		$this->load->view('usuarios/'.$this->router->class.'_view');
        $this->load->view('plantilla/pie');
	}

    /**
     * Recuperar los datos desde la BD en formato JSON
     * 
     * @return void
     */
    function roles_data()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $offset = ($page-1)*$rows;

        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'ID';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $this->load->model('usuarios/roles_model');
        $result = array();
        //$result["total"] = $this->roles_model->num_registros();
        $result = $this->roles_model->obtener($rows,$offset,$sort,$order);
        echo json_encode($result);
    }

    /**
     * Recuperar los datos desde la BD en formato JSON
     * 
     * @return void
     */
    function operaciones_data()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $offset = ($page-1)*$rows;

        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'ID';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $this->load->model('usuarios/operaciones_model');
        $result = array();
        //$result["total"] = $this->roles_model->num_registros();
        $result = $this->operaciones_model->obtener($rows,$offset,$sort,$order);
        echo json_encode($result);
    }

    /**
     * Recuperar los datos desde la BD en formato JSON
     * 
     * @return void
     */
    function objetos_data() {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $offset = ($page-1)*$rows;

        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'ID';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $this->load->model('usuarios/objetos_model');
        $result = array();
        //$result["total"] = $this->roles_model->num_registros();
        $result = $this->objetos_model->obtener($rows,$offset,$sort,$order);
        echo json_encode($result);
    }

    /**
     * Cambiar el formato de la fecha:
     * De 'ddmmyyyy hh24mm' a 'dd-mm-yyyy hh24:mm'
     *
     * @return string
     */
    protected function formatoFechaHora($fecha='')
    {
    	$fecha = substr($fecha, 0,2).'-'.substr($fecha, 2,2).'-'.substr($fecha, 4,4).' '.substr($fecha, 9,2).':'.substr($fecha, 11,2);
    	return $fecha;
    }
    function prueba_herencia()
    {
        echo 'Inicio prueba de herencia<br>';
        $modelo = $this->router->class.'_model';
        $this->load->model('usuarios/'.$modelo);
        $this->$modelo->establecer_nombre_tabla($this->router->class);
        echo $this->$modelo->obtener_nombre_tabla();

        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $offset = ($page-1)*$rows;

        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';

        $result["total"] = $this->$modelo->num_registros();
        $result["rows"] = $this->$modelo->obtener($rows,$offset,$sort,$order);
        echo json_encode($result);

    }

    /**
     * Recuperar los datos desde la BD en formato JSON
     * 
     * @return void
     */
    function obtener_data()
    {
        $modelo = $this->router->class.'_model';
        $this->load->model('usuarios/'.$modelo);
        $this->$modelo->establecer_nombre_tabla($this->router->class);

        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $offset = ($page-1)*$rows;

        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        
        $result = array();
        $result["total"] = $this->$modelo->num_registros();
        $result["rows"] = $this->$modelo->obtener($rows,$offset,$sort,$order);
        echo json_encode($result);
    }

    /**
     * Guardar y actualizar los datos en la BD
     *
     * @return void
     */
    function actualizar_data()
    {
        $modelo = $this->router->class.'_model';
        $this->load->model('usuarios/'.$modelo);
        $this->$modelo->establecer_nombre_tabla($this->router->class);

        //Recuperar los errores desde el modelo
        $resultados = $this->$modelo->guardar_actualizar();
        if ($resultados === TRUE)
        {
            $arr_res = array('success' => TRUE);
        }
        else
        {
            $arr_res = array('isError' => TRUE,'msg' => $resultados);
        }
        echo json_encode($arr_res);
    }
}

/* End of file MY_Usuarios_Ctrl.php */
/* Location: ./application/core/MY_Usuarios_Ctrl.php */