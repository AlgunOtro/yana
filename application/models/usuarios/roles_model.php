<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Roles_model
 *
 * Representa los datos de Roles
 *
 * @author Byron Oña
 *
 */
class Roles_model extends CI_Model {

    public $limit;
    public $offset;
    private $table_name_roles = 'ROLES';

    function __construct() {
        parent::__construct();
        log_message('debug', 'Clase Modelo Roles Iniciado');
    }

    /**
     * Recuperar todos los registros en la BD 
     * 
     * @return array
     */
    public function obtener() { 
        /*$query = $this->db->query("SELECT T0.ID,T0.DESCRIPCION ROL,T0.ESTADO FROM ".$this->table_name_roles." T0 ORDER BY T0.ID");
        return $query->result_array();*/
        $this->db->from($this->table_name_roles);
        $resultado = $this->db->get('',$this->limit, $this->offset);
        return $resultado->result_array();
    }

    /**
     * Recuperar la cantidad de todos registros en la BD
     *
     * @return  int
     */
    public function num_registros() {
        /*$query = $this->db->query("SELECT T0.ID,T0.DESCRIPCION ROL,T0.ESTADO FROM ".$this->table_name_roles." T0 ORDER BY T0.ID");
        return $query->num_rows();*/
        $this->db->from($this->table_name_roles);
        return $this->db->count_all_results();
    }

    /**
     * Recupera el ID del rol dado
     * 
     * @param string
     *
     * @return int
     */
    function obtener_id($rol='') {
        /*$query = $this->db->query("SELECT ID FROM ".$this->table_name_roles." WHERE DESCRIPCION = '".$rol."'");
        foreach ($query->row() as $key => $value)
            return $value;
        return 0;*/$resultado = $this->db->select('id')->from($this->table_name_roles)->where('rol',$rol)->get();
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
    function existe($rol='') {
        /*$query = $this->db->query("SELECT ID FROM ".$this->table_name_roles." WHERE DESCRIPCION = '".$rol."'");
        return $query->num_rows();*/
        $resultado = $this->db->select('id')->from($this->table_name_roles)->where('rol',$rol)->get();
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
        $rol = isset($_POST['rol']) ? $this->security->xss_clean(trim(mb_strtolower(strval($_POST['rol'])))) : '';
        $estado = isset($_POST['estado']) ? $this->security->xss_clean(trim(mb_strtolower(strval($_POST['estado'])))) : '';
        $esNuevo = isset($_POST['isNewRecord']) ? $this->security->xss_clean(mb_strtolower(strval($_POST['isNewRecord']))) : '';
        //Es nuevo el registro
        if($esNuevo) {
            //Verificar si el nombre de usuario ya existe
            $existe_usuario = $this->existe($rol);
            if( $existe_usuario ) {
                return 'El nombre de rol ya existe.';
            } else {
                //Preparar INSERT a la BD
                $data = array('rol' => $rol,'estado' => $estado);
                $query = $this->db->insert($this->table_name_roles, $data);
                //Destruir la variable utilizada para hacer el INSERT
                unset($data['rol']);
                unset($data['estado']);
                if( $query ){
                    return $query;
                } else {
                    // 1. El INSERT del rol no se ejecutó
                    return 'No se guardó el rol.';
                }
            }
        } else {
            //Ejecutar si el ID de rol es diferente de 0
            if( $id != 0 ) {
                //Preparar UPDATE a la BD
                $data = array('rol' => $rol,'estado' => $estado);
                $this->db->where('id', $id);
                $query = $this->db->update($this->table_name_roles, $data);
                //Destruir la variable utilizada para hacer el UPDATE
                unset($data['rol']);
                unset($data['estado']);
                //Retornar TRUE si el UPDATE fue correcto
                if( $query ){
                    return $query;
                } else {
                    // 1. El UPDATE del rol no se ejecutó
                    return 'No se actualizó el rol.';
                }
            } else {
                // 0. El ID de rol no existe
                return 'No existe el rol.';
            }
        }
    }
}

/* End of file roles_model.php */
/* Location: ./application/models/usuarios/roles_model.php */