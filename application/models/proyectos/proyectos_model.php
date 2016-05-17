<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Proyectos_model
 *
 * Representa los datos de Proyectos
 *
 * @author Byron Oña
 *
 */
class Proyectos_model extends CI_Model {

    public $limit;
    public $offset;
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
    public function obtener_nombre()
    {
        $resultado = $this->db->select('id,nombre')
        ->from($this->table_name_proyectos)
        ->order_by('id')
        ->get();
        return $resultado->result_array();
    }

    /**
     * Recuperar todos los registros en la BD 
     * 
     * @return array
     */
    public function obtener_todo($rows,$offset,$sort,$order)
    {
        $resultado = $this->db->from($this->table_name_proyectos)->limit($rows,$offset)
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
        $this->db->from($this->table_name_proyectos);
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
        $resultado = $this->db->select('id')->from($this->table_name_proyectos)->where('nombre',$nombre)->get();
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
        $resultado = $this->db->select('id')->from($this->table_name_proyectos)->where('nombre',$nombre)->get();
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
        $estado = isset($_POST['estado']) ? $this->security->xss_clean(trim(mb_strtolower(strval($_POST['estado'])))) : NULL;
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
                if( ! is_null($usuario) ) { $data['usuario'] = $usuario; $cambios .= '/usuario:'.$usuario.'/';}
                if( ! is_null($estado) ) { $data['estado'] = $estado; $cambios .= '/estado:'.$estado.'/';}
                if( ! is_null($creado) ) { $data['creado'] = $creado; $cambios .= '/creado:'.$creado.'/';}
                if( ! is_null($direccion_ip) ) { $data['direccion_ip'] = $direccion_ip; $cambios .= '/direccion_ip:'.$direccion_ip.'/';}
                if( ! is_null($cambios) ) { $data['cambios'] = $cambios; }

                $query = $this->db->insert($this->table_name_proyectos, $data);
                //Destruir la variable utilizada para hacer el INSERT
                unset($data['nombre']);
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
                if( ! is_null($usuario) ) { $data['usuario'] = $usuario; $cambios .= '/usuario:'.$usuario.'/';}
                if( ! is_null($estado) ) { $data['estado'] = $estado; $cambios .= '/estado:'.$estado.'/';}
                if( ! is_null($direccion_ip) ) { $data['direccion_ip'] = $direccion_ip; $cambios .= '/direccion_ip:'.$direccion_ip.'/';}
                if( ! is_null($cambios) ) { $data['cambios'] = $cambios; }
                //$data = array('nombre' => $nombre,'usuario' => $usuario,'estado' => $estado,'direccion_ip'=>$direccion_ip);
                $this->db->where('id', $id);
                $query = $this->db->update($this->table_name_proyectos, $data);
                //Destruir la variable utilizada para hacer el UPDATE
                unset($data['nombre']);
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
        $res = $this->db->delete($this->table_name_proyectos, array('id' => $id));
        if($res) {
            return $res;
        } else {
            $resultado .= 'El permiso no se eliminó. ';
        }
        return $resultado;
    }
}

/* End of file proyectos_model.php */
/* Location: ./application/models/usuarios/proyectos_model.php */