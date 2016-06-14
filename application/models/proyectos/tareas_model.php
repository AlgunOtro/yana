<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Tareas_model
 *
 * Representa los datos de Tareas
 *
 * @author Byron Oña
 *
 */
class Tareas_model extends MY_Admin_Model {

    public $limit;
    public $offset;
    private $table_name_tareas = 'tareas';
    private $table_name_elementos = 'elementos';
    private $table_name_proyectos = 'proyectos';

    private $table_name_roles = 'roles';
    private $table_name_permisos = 'permisos';
    private $table_name_objetos = 'objetos';
    private $table_name_operaciones = 'operaciones';
    private $table_name_roles_permisos = 'roles_permisos';

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Recuperar la lista de nombres
     *
     * @return array
     */
    public function obtener($id = '')
    {
        $resultado = $this->db->select('t0.id,t0.nombre,t0.estado,t1.nombre elemento')
        ->from($this->table_name_tareas.' t0')
        ->join($this->table_name_elementos.' t1','t0.elemento_id = t1.id')
        ->join($this->table_name_proyectos.' t2','t1.proyecto_id = t2.id')
        ->where('t2.id',$id)
        ->order_by('t0.id')
        ->get();
        return $resultado->result_array();
    }
    public function obtener_por_elemento()
    {
        $proyecto_id = isset($_POST['proyecto_id']) ? intval($_POST['proyecto_id']) : 0;
        $elemento_id = isset($_POST['elemento_id']) ? intval($_POST['elemento_id']) : 0;
        $resultado = $this->db->select('t0.*')
        ->from($this->table_name_tareas.' t0')
        ->join($this->table_name_elementos.' t1','t0.elemento_id = t1.id')
        ->join($this->table_name_proyectos.' t2','t1.proyecto_id = t2.id')
        ->where('t2.id',$proyecto_id)
        ->where('t1.id',$elemento_id)
        ->order_by('t0.id')
        ->get();
        return $resultado->result_array();
    }

    /**
     * Recuperar todos los registros en la BD 
     * 
     * @return array
     */
    public function obtener_todo()
    {
        $resultado = $this->db->from($this->table_name_tareas)
        ->order_by('id')
        ->get();
        return $resultado->result_array();
    }

    /**
     * Recuperar la cantidad de todos registros en la BD
     *
     * @return  int
     */
    public function num_registros()
    {
        $this->db->from($this->table_name_tareas);
        return $this->db->count_all_results();
    }

    /**
     * Recupera el ID del rol dado
     * 
     * @param string
     *
     * @return int
     */
    function obtener_id_por_nombre($nombre='')
    {
        $resultado = $this->db->select('id')->from($this->table_name_tareas)->where('nombre',$nombre)->get();
        foreach ($resultado->result_array() as $row)
        {
            return $row['id'];
        }
        return FALSE;
    }

    /**
     * Verificar si existe el nombre del objeto
     * 
     * @param string
     *
     * @return bool
     */
    function existe($nombre='') {
        $resultado = $this->db->select('id')->from($this->table_name_tareas)->where('nombre',$nombre)->get();
        return $resultado->num_rows();
    }

    /**
     * Actualiza el usuario y el rol asociado al usuario
     * 
     * @return bool
     * Si falla
     * @return string
     */
    public function guardar_actualizar() {
        //Recibir datos por POST
        $id = isset($_POST['id']) ? $this->security->xss_clean(intval($_POST['id'])) : 0;
        $nombre = isset($_POST['nombre']) ? $this->security->xss_clean(trim(mb_strtoupper(strval($_POST['nombre'])))) : NULL;
        $elemento_id = isset($_POST['elemento_id']) ? $this->security->xss_clean(trim(intval($_POST['elemento_id']))) : NULL;
        $estado = isset($_POST['estado']) ? $this->security->xss_clean(trim(mb_strtolower(intval($_POST['estado'])))) : NULL;
        $esNuevo = isset($_POST['isNewRecord']) ? $this->security->xss_clean(mb_strtolower(strval($_POST['isNewRecord']))) : NULL;
        $usuario = $this->session->userdata('username');
        $direccion_ip = $this->input->ip_address();
        $creado = date('Y-m-d H:i:s');
        //Es nuevo el registro
        if($esNuevo) {
            //Verificar si el registro ya existe
            $existe_usuario = $this->existe($nombre);
            if( $existe_usuario ) {
                return 'El nombre del registro ya existe.';
            } else {
                //Preparar INSERT a la BD
                $cambios = '';
                if( ! is_null($nombre) ) { $data['nombre'] = $nombre; $cambios .= '/nombre:'.$nombre.'/'; }
                if( ! is_null($elemento_id) ) { $data['elemento_id'] = $elemento_id; $cambios .= '/elemento_id:'.$elemento_id.'/'; }
                if( ! is_null($usuario) ) { $data['usuario'] = $usuario; $cambios .= '/usuario:'.$usuario.'/';}
                if( ! is_null($estado) ) { $data['estado'] = $estado; $cambios .= '/estado:'.$estado.'/';}
                if( ! is_null($creado) ) { $data['creado'] = $creado; $cambios .= '/creado:'.$creado.'/';}
                if( ! is_null($direccion_ip) ) { $data['direccion_ip'] = $direccion_ip; $cambios .= '/direccion_ip:'.$direccion_ip.'/';}
                if( ! is_null($cambios) ) { $data['cambios'] = $cambios; }
                $query = $this->db->insert($this->table_name_tareas, $data);
                //Destruir la variable utilizada para hacer el INSERT
                unset($data['nombre']);
                unset($data['elemento_id']);
                unset($data['usuario']);
                unset($data['estado']);
                unset($data['creado']);
                unset($data['direccion_ip']);
                unset($data['cambios']);
                //Retornar TRUE si el INSERT fue correcto
                if( $query ){
                    return $query;
                } else {
                    // 1. El INSERT del registro no se ejecutó
                    return 'No se guardó el registro.';
                }
            }
        } else {
            //Ejecutar si el ID del registro es diferente de 0
            if( $id != 0 ) {
                //Preparar UPDATE a la BD
                $cambios = '';
                if( ! is_null($nombre) ) { $data['nombre'] = $nombre; $cambios .= '/nombre:'.$nombre.'/'; }
                if( ! is_null($elemento_id) ) { $data['elemento_id'] = $elemento_id; $cambios .= '/elemento_id:'.$elemento_id.'/'; }
                if( ! is_null($usuario) ) { $data['usuario'] = $usuario; $cambios .= '/usuario:'.$usuario.'/';}
                if( ! is_null($estado) ) { $data['estado'] = $estado; $cambios .= '/estado:'.$estado.'/';}
                if( ! is_null($direccion_ip) ) { $data['direccion_ip'] = $direccion_ip; $cambios .= '/direccion_ip:'.$direccion_ip.'/';}
                if( ! is_null($cambios) ) { $data['cambios'] = $cambios; }
                $this->db->where('id', $id);
                $query = $this->db->update($this->table_name_tareas, $data);
                //Destruir la variable utilizada para hacer el UPDATE
                unset($data['nombre']);
                unset($data['elemento_id']);
                unset($data['usuario']);
                unset($data['estado']);
                unset($data['direccion_ip']);
                unset($data['cambios']);
                //Retornar TRUE si el UPDATE fue correcto
                if( $query ){
                    return $query;
                } else {
                    // 1. El UPDATE del registro no se ejecutó
                    return 'No se actualizó el registro.';
                }
            } else {
                // 0. El ID del registro no existe
                return 'No existe el registro.';
            }
        }
    }

    function eliminar() {
        $resultado='';
        $id = isset($_POST['id']) ? $this->security->xss_clean(intval($_POST['id'])) : 0;
        $res = $this->db->delete($this->table_name_tareas, array('id' => $id));
        if($res) {
            return $res;
        } else {
            $resultado .= 'El permiso no se eliminó. ';
        }
        return $resultado;
    }

    function actualizar_estado()
    {
        $id = isset($_POST['id']) ? $this->security->xss_clean(intval($_POST['id'])) : 0;
        $estado = isset($_POST['estado']) ? $this->security->xss_clean(trim(mb_strtolower(intval($_POST['estado'])))) : NULL;
        $usuario = $this->session->userdata('username');
        $direccion_ip = $this->input->ip_address();
        
            if( $id != 0 ) {
                //Preparar UPDATE a la BD
                $cambios = '';
                if( ! is_null($usuario) ) { $data['usuario'] = $usuario; $cambios .= '/usuario:'.$usuario.'/';}
                if( ! is_null($estado) ) { $data['estado'] = $estado; $cambios .= '/estado:'.$estado.'/';}
                if( ! is_null($direccion_ip) ) { $data['direccion_ip'] = $direccion_ip; $cambios .= '/direccion_ip:'.$direccion_ip.'/';}
                if( ! is_null($cambios) ) { $data['cambios'] = $cambios; }
                $this->db->where('id', $id);
                $query = $this->db->update($this->table_name_tareas, $data);
                //Destruir la variable utilizada para hacer el UPDATE
                unset($data['usuario']);
                unset($data['estado']);
                unset($data['direccion_ip']);
                unset($data['cambios']);
                //Retornar TRUE si el UPDATE fue correcto
                if( $query ){
                    return $query;
                } else {
                    // 1. El UPDATE del registro no se ejecutó
                    return 'No se actualizó el registro.';
                }
            } else {
                // 0. El ID del registro no existe
                return 'No existe el registro.';
            }
    }
}

/* End of file tareas_model.php */
/* Location: ./application/models/usuarios/tareas_model.php */