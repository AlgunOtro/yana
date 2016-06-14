<?php
/**
 * Archivo MY_Admin_Model.php
 *
 * Contiene la Clase MY_Admin_Model que extiende de la Clase CI_Model
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
 * Modelo MY_Admin_Model
 *
 * Permite gestionar el modelo del módulo Administración de Usuarios de la aplicación
 *
 * @package Atuk\Usuarios
 * @author Byron Oña
 * @version v1.0.0
 */
class MY_Admin_Model extends CI_Model
{
	
	/**
	 * @var string $nombre_tabla Nombre de la tabla
	 */
	private $nombre_tabla = '';

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
	 * Obtener nombre tabla
	 *
	 * Obtiene el nombre de la tabla
	 *
	 * @return string
	 */
	function obtener_nombre_tabla()
	{
		return $this->nombre_tabla;
	}

	/**
	 * Establecer nombre tabla
	 *
	 * Establece el nombre de la tabla
	 *
	 * @param string $nombre_tabla Nombre de la tabla
	 *
	 * @return void
	 */
	function establecer_nombre_tabla($nombre_tabla = '')
	{
		$this->nombre_tabla = $nombre_tabla;
	}

	/**
	 * Obtener
	 *
     * Recupera todos los registros en la BD 
     *
     * @param int $rows
     * @param int $offset
     * @param string $sort
     * @param string $order
     * 
     * @return array
     */
	public function obtener($rows,$offset,$sort,$order)
	{
        //con el total de resultados cambiar la consulta para recuperar todos (hasta maximo 100 registros) o solo 10 para la paginación
        //actualmente esta para que recupere 10 registros
		$this->db->from($this->obtener_nombre_tabla());
		$resultado = $this->db->get('',$rows, $offset);
		return $resultado->result_array();
	}

    /**
     * Número de registros
     *
     * Recupera la cantidad de todos registros en la BD
     *
     * @return  int
     */
    public function num_registros()
    {
    	$this->db->from($this->obtener_nombre_tabla());
    	return $this->db->count_all_results();
    }

    /**
     * Obtener Id
     *
     * Recupera el ID de un registro
     * 
     * @param string $nombre Nombre del registro
     *
     * @return int
     */
    function obtener_id($nombre='')
    {
    	$resultado = $this->db->select('id')->from($this->obtener_nombre_tabla())->where('nombre',$nombre)->get();
    	foreach ($resultado->row() as $key => $value)
    		return $value;
    	return 0;
    }

    /**
     * Existe
     *
     * Verificar si existe el nombre del registro
     * 
     * @param string $nombre Nombre del registro
     *
     * @return bool
     */
    function existe($data = '')
    {
    	unset($data['creado']);
    	unset($data['modificado']);
    	$resultado = $this->db->select('id')->from($this->obtener_nombre_tabla())->where($data)->get();
    	return $resultado->num_rows();
    }

    /**
     * Guardar Actualizar
     *
     * Actualiza el usuario y el rol asociado al usuario
     * 
     * @return string
     */
    function guardar_actualizar()
    {
        //Recibir datos por POST
    	$id = isset($_POST['id']) ? $this->security->xss_clean(intval($_POST['id'])) : 0;
    	$esNuevo = isset($_POST['isNewRecord']) ? $this->security->xss_clean(mb_strtolower(strval($_POST['isNewRecord']))) : '';
    	unset($_POST['id']);
    	unset($_POST['isNewRecord']);
    	foreach ($this->input->post() as $key => $value)
    	{
    		$data[$key] = $value;
    	}
    	//Verificar si el registro ya existe
    	if ($this->existe($data))
    	{
    		return 'El registro ya existe.';
    	}
    	else
    	{
        	//Es nuevo el registro
    		if ($esNuevo)
    		{
    			foreach ($this->input->post() as $key => $value)
    			{
    				$data[$key] = $value;
    			}
                //Preparar INSERT a la BD
    			$query = $this->db->insert($this->obtener_nombre_tabla(), $data);
                //Destruir la variable utilizada para hacer el INSERT
    			$data = NULL;
    			if ($query)
    			{
    				return $query;
    			}
    			else
    			{
                    // 1. El INSERT no se ejecutó
    				return 'No se guardó el registro.';
    			}
    		}
    		else
    		{
            	//Ejecutar si el ID es diferente de 0
    			if ($id != 0)
    			{
    				foreach ($this->input->post() as $key => $value)
    				{
    					$data[$key] = $value;
    				}
                	//Preparar UPDATE a la BD
    				$this->db->where('id', $id);
    				$query = $this->db->update($this->obtener_nombre_tabla(), $data);
                	//Destruir la variable utilizada para hacer el UPDATE
    				$data = NULL;
                	//Retornar TRUE si el UPDATE fue correcto
    				if ($query)
    				{
    					return $query;
    				}
    				else
    				{
                    	// 1. El UPDATE no se ejecutó
    					return 'No se actualizó el registro.';
    				}
    			}
    			else
    			{
                	// 0. El ID del registro no existe
    				return 'No existe el Id del registro.';
    			}
    		}
    	}
    }
}

/* End of file MY_Admin_Model.php */
/* Location: ./application/core/MY_Admin_Model.php */