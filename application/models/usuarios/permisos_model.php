<?php
/**
 * Archivo permisos_model.php
 *
 * Contiene la Clase Permisos_model que extiende de la Clase MY_Admin_Model
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
 * Modelo Permisos
 *
 * Este modelo gestiona los datos de los permisos de la sesión actual. Opera
 * con las siguientes tablas:
 * - roles
 * - permisos
 * - objetos
 * - operaciones
 * - roles_permisos
 *
 * @package Atuk\Usuarios
 * @author Byron Oña
 * @version v1.0.0
 */
class Permisos_model extends MY_Admin_Model
{

    public $limit;
    public $offset;
    private $table_name_roles = 'roles';
    private $table_name_permisos = 'permisos';
    private $table_name_objetos = 'objetos';
    private $table_name_operaciones = 'operaciones';
    private $table_name_roles_permisos = 'roles_permisos';

    /**
     * Constructor
     *
     * Carga la clase padre MY_Admin_Model
     *
     * @return  void
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Recuperar todos los registros en la BD 
     * 
     * @return array
     */
    public function obtener() {
        $resultado = $this->db->select('t0.descripcion,t3.id,t1.nombre objeto,t1.tipo,t2.operacion,t4.rol')
        ->from($this->table_name_permisos.' t0')
        ->join($this->table_name_objetos.' t1','t0.fk_objeto_id = t1.id')
        ->join($this->table_name_operaciones.' t2','t0.fk_operacion_id = t2.id')
        ->join($this->table_name_roles_permisos.' t3','t0.id = t3.fk_permiso_id')
        ->join($this->table_name_roles.' t4','t3.fk_rol_id = t4.id')
        ->order_by('t3.id')
        ->get();
        return $resultado->result_array();
    }

    /**
     * Recuperar la cantidad de todos registros en la BD
     *
     * @return  int
     */
    public function num_registros() {
        $this->db->select('t3.id,t1.nombre objeto,t1.tipo,t2.operacion,t4.rol')
        ->from($this->table_name_permisos.' t0')
        ->join($this->table_name_objetos.' t1','t0.fk_objeto_id = t1.id')
        ->join($this->table_name_operaciones.' t2','t0.fk_operacion_id = t2.id')
        ->join($this->table_name_roles_permisos.' t3','t0.id = t3.fk_permiso_id')
        ->join($this->table_name_roles.' t4','t3.fk_rol_id = t4.id')
        ->order_by('t3.id')
        ->get();
        return $this->db->count_all_results();
    }

    /**
     * Recupera el ID del rol dado
     * 
     * @param string
     *
     * @return int
     */
    function obtener_id_por_nombre($rol='') {
        $resultado = $this->db->select('id')->from($this->table_name_roles)->where('rol',$rol)->get();
        foreach ($resultado->result_array() as $row) {
            return $row['ID'];
        }
        return FALSE;
    }

    /**
     * Verificar si existe el nombre de objeto
     * 
     * @param string
     *
     * @return bool
     */
    function obtener_id_objeto($objeto='') {
        $resultado = $this->db->select('id')->from($this->table_name_objetos)->where('nombre',$objeto)->get();
        foreach ($resultado->row() as $key => $value)
            return $value;
        return 0;
    }

    /**
     * Verificar si existe el nombre de operación
     * 
     * @param string
     *
     * @return bool
     */
    function obtener_id_operacion($operacion='') {
        $resultado = $this->db->select('id')->from($this->table_name_operaciones)->where('operacion',$operacion)->get();
        foreach ($resultado->row() as $key => $value)
            return $value;
        return 0;
    }

    /**
     * Verificar si existe el nombre de rol
     * 
     * @param string
     *
     * @return bool
     */
    function obtener_id_permiso($objeto='',$operacion='') {
        $resultado = $this->db->select('id')->from($this->table_name_permisos)->where('fk_objeto_id',$objeto)->where('fk_operacion_id',$operacion)->get();
        foreach ($resultado->row() as $key => $value)
            return $value;
        return 0;
    }

    /**
     * Verificar si existe el nombre de rol
     * 
     * @param string
     *
     * @return bool
     */
    function existe_rol_permiso($rol='',$permiso='') {
        $resultado = $this->db->select('fk_rol_id')->from($this->table_name_roles_permisos)->where('fk_rol_id',$rol)->where('fk_permiso_id',$permiso)->get();
        return $resultado->num_rows();
    }

    /**
     * Actualiza el usuario y el rol asociado al usuario
     * 
     * @return bool
     * Si falla
     * @return string
     */
    public function guardar_actualizar()
	{
        var_dump(1);
        //Recibir datos por POST
        $resultado = '';
        $id = isset($_POST['id']) ? $this->security->xss_clean(intval($_POST['id'])) : 0;
        $objeto = isset($_POST['objeto']) ? $this->security->xss_clean(trim(ucfirst(strval($_POST['objeto'])))) : '';
        $operacion = isset($_POST['operacion']) ? $this->security->xss_clean(trim(mb_strtolower(strval($_POST['operacion'])))) : '';
        $rol = isset($_POST['rol']) ? $this->security->xss_clean(trim(mb_strtolower(strval($_POST['rol'])))) : '';
        $descripcion = isset($_POST['descripcion']) ? $this->security->xss_clean(trim(mb_strtolower(strval($_POST['descripcion'])))) : '';
        $esNuevo = isset($_POST['isNewRecord']) ? $this->security->xss_clean(mb_strtolower(strval($_POST['isNewRecord']))) : '';
        unset($_POST['id']);
        unset($_POST['isNewRecord']);

        $id_objeto = $this->obtener_id_objeto($objeto);
        if ($id_objeto)
        {
            var_dump(2);
            $resultado .= 'El objeto existe. ';
            $id_operacion = $this->obtener_id_operacion($operacion);
            if ($id_operacion)
            {
                var_dump(3);
                $resultado .= 'La operacion existe. ';
                $this->load->model('usuarios/roles_model');
                $this->roles_model->establecer_nombre_tabla('roles');
				$rol = array('rol' => $rol);
                $id_rol = $this->roles_model->obtener_id($rol);
                if ($id_rol)
                {
                    $resultado .= 'El rol existe. ';
                    $id_permiso = $this->obtener_id_permiso($id_objeto,$id_operacion);
                    if ($id_permiso)
                    {
                        $resultado .= 'El permiso existe. ';
                        //Preparar UPDATE a la BD
                        $data = array('descripcion' => $descripcion);
                        $this->db->where('fk_objeto_id', $id_objeto);
                        $this->db->where('fk_operacion_id', $id_operacion);
                        $query = $this->db->update($this->table_name_permisos, $data);
                        //Destruir la variable utilizada para hacer el UPDATE
                        unset($data['descripcion']);
                        //Ejecutar si el INSERT fue correcto
                        if ( ! $query)
                        {
                            $resultado .= 'No se actualizó la descripción del permiso. ';
                        }
                    }
                    else
                    {
                        $resultado .= 'El permiso no existe. ';
                        //Preparar INSERT a la BD
                        $data = array('fk_objeto_id' => $id_objeto,'fk_operacion_id' => $id_operacion,'descripcion' => $descripcion);
                        $query = $this->db->insert($this->table_name_permisos, $data);
                        //Destruir la variable utilizada para hacer el INSERT
                        unset($data['fk_objeto_id']);
                        unset($data['fk_operacion_id']);
                        unset($data['descripcion']);
                        //Ejecutar si el INSERT fue correcto
                        if ($query)
                        {
                            //Obtener ID de permiso insertado
                            $id_permiso = $this->obtener_id_permiso($id_objeto,$id_operacion);
                        }
                        else
                        {
                            $resultado .= 'No se guardó el permiso. ';
                        }
                    }
                    if ($id_permiso)
                    {
                        $existe_rol_permiso = $this->existe_rol_permiso($id_rol,$id_permiso);
                        if ($existe_rol_permiso)
                        {
                            $resultado .= 'El rol-permiso existe. ';
                        }
                        else
                        {
                            $resultado .= 'El rol-permiso no existe. ';
                            //Preparar INSERT o UPDATE a la BD
                            $data = array('fk_rol_id' => $id_rol,'fk_permiso_id' => $id_permiso);
                            if ($esNuevo)
                            {
                                $query = $this->db->insert($this->table_name_roles_permisos, $data);
                            }
                            else
                            {
                                if ($id)
                                {
                                    $this->db->where('id', $id);
                                    $query = $this->db->update($this->table_name_roles_permisos, $data);
                                }
                                else
                                {
                                    // 0. El ID del rol-permiso no existe
                                    $query = FALSE;
                                    $resultado .= 'El ID rol-permiso es incorrecto. ';
                                }
                            }
                            //Destruir la variable utilizada para hacer el INSERT
                            unset($data['fk_objeto_id']);
                            unset($data['fk_operacion_id']);
                            //Retornar TRUE si el INSERT o UPDATE fue correcto
                            if ($query)
                            {
                                return $query;
                            }
                        }
                    }
                    else
                    {
                        // 0. El ID del permiso no existe
                        $resultado .= 'El permiso no existe. ';
                    }
                    return $resultado;
                }
                else
                {
                    var_dump(4);
                    $resultado .= 'El rol no existe. ';
                    return $resultado;
                }
            }
            else
            {
                $resultado .= 'La operacion no existe. ';
                return $resultado;
            }
        }
        else
        {
            $resultado .= 'El objeto no existe. ';
            return $resultado;
        }
    }

    function eliminar() {
        $resultado='';
        $id = isset($_POST['id']) ? $this->security->xss_clean(intval($_POST['id'])) : 0;
        $res = $this->db->delete($this->table_name_roles_permisos, array('id' => $id));
        if($res) {
            return $res;
        } else {
            $resultado .= 'El permiso no se eliminó. ';
        }
        return $resultado;
    }
}

/* End of file permisos_model.php */
/* Location: ./application/models/usuarios/permisos_model.php */