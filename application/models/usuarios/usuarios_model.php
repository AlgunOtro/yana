<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Usuarios_model
 *
 * Representa los datos de Usuarios
 *
 * @author Byron Oña
 *
 */
class Usuarios_model extends CI_Model {

    public $limit;
    public $offset;
    private $table_name_usuarios = 'usuarios';
    private $table_name_usuarios_roles = 'usuarios_roles';
    private $table_name_roles = 'roles';

    function __construct() {
        parent::__construct();
        log_message('debug', 'Clase Modelo Usuarios Iniciado');
    }

    /**
     * Recuperar todos los registros en la BD 
     * 
     * @return array
     */
    public function obtener() {
        $resultado = $this->db->select('t0.id,t0.usuario,t2.rol,t0.estado')
        ->from($this->table_name_usuarios.' t0')
        ->join($this->table_name_usuarios_roles.' t1','t0.id = t1.fk_usuario_id','left')
        ->join($this->table_name_roles.' t2','t1.fk_rol_id = t2.id','left')
        ->order_by('t0.id')
        ->get();
        return $resultado->result_array();
    }

    /**
     * Recuperar la cantidad de todos registros en la BD
     *
     * @return  int
     */
    public function num_registros() {
        $this->db->select('t0.id,t0.usuario,t2.rol,t0.estado')
        ->from($this->table_name_usuarios.' t0')
        ->join($this->table_name_usuarios_roles.' t1','t0.id = t1.fk_usuario_id','left')
        ->join($this->table_name_roles.' t2','t1.fk_rol_id = t2.id','left')
        ->order_by('t0.id')
        ->get();
        return $this->db->count_all_results();
    }

    /**
     * Recupera el ID del usuario dado
     * 
     * @param string
     *
     * @return int
     */
    function obtener_id_por_nombre($usuario='') {
        $resultado = $this->db->select('id')
        ->from($this->table_name_usuarios)
        ->where('usuario',$usuario)
        ->get();
        foreach ($resultado->result_array() as $row) {
            return $row['id'];
        }
        return FALSE;
    }

    /**
     * Verificar si existe el nombre de usuario
     * 
     * @param string
     *
     * @return bool
     */
    function existe($usuario='') {
        $resultado = $this->db->select('id')
        ->from($this->table_name_usuarios)
        ->where('usuario',$usuario)
        ->get();
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
        $usuario = isset($_POST['usuario']) ? $this->security->xss_clean(trim(strtolower(strval($_POST['usuario'])))) : '';
        $rol = isset($_POST['rol']) ? $this->security->xss_clean(trim(strtolower(strval($_POST['rol'])))) : '';
        $estado = isset($_POST['estado']) ? $this->security->xss_clean(trim(strtolower(strval($_POST['estado'])))) : '';
        $esNuevo = isset($_POST['isNewRecord']) ? $this->security->xss_clean(strtolower(strval($_POST['isNewRecord']))) : '';
        //Es nuevo el registro
        if($esNuevo) {
            // 1. Usuarios
            //Verificar si el nombre de usuario ya existe
            $existe_usuario = $this->existe($usuario);
            if( $existe_usuario ) {
                return 'El nombre de usuario ya existe.';
            } else {
                //Preparar INSERT a la BD
                $data = array('usuario' => $usuario,'usuario_generico' => $this->session->userdata('username'),'estado' => $estado);
                $query = $this->db->insert($this->table_name_usuarios, $data);
                //Ejecutar si el INSERT fue correcto
                if( $query ){
                    //Obtener el ID del usuario dado el nombre del usuario
                    $usuario_id = $this->usuarios_model->obtener_id_por_nombre($usuario);
                    //Destruir la variable utilizada para hacer el INSERT
                    unset($data['usuario']);
                    unset($data['estado']);
                    if( $usuario_id ) { 
                        //Obtener el ID del rol dado el nombre del rol
                        $this->load->model('usuarios/roles_model');
                        $rol_id = $this->roles_model->obtener_id($rol);
                        //Ejecutar si existe el rol ingresado
                        if( $rol_id ) {
                            // 2. Usuarios-Roles
                            //Preparar INSERT a la BD
                            $data = array(
                                'fk_rol_id' => $rol_id,
                                'fk_usuario_id' => $usuario_id
                                );
                            $query = $this->db->insert($this->table_name_usuarios_roles, $data);
                            //Destruir la variable utilizada para hacer el INSERT
                            unset($data['fk_rol_id']);
                            //Retornar TRUE si el INSERT fue correcto
                            if( $query ){
                                return $query;
                            } else {
                                // 3. El INSERT del rol no se ejecutó
                                return 'No se guardó el rol.';
                            }
                        } else {
                            // 2. El ID del rol no existe
                            return 'No existe el rol.';
                        }
                    } else {
                        // 0. El ID de usuario no existe
                        return 'No existe el usuario.';
                    }
                } else {
                    // 1. El INSERT del nombre no se ejecutó
                    return 'No se guardó el nombre.';
                }
            }
        } else {
            //Ejecutar si el ID de usuario es diferente de 0
            if( $id != 0 ) {
                //Preparar UPDATE a la BD
                $data = array('usuario' => $usuario,'usuario_generico' => $this->session->userdata('username'),'estado' => $estado);
                $this->db->where('id', $id);
                $query = $this->db->update($this->table_name_usuarios, $data);
                //Destruir la variable utilizada para hacer el UPDATE
                unset($data['usuario']);
                unset($data['estado']);
                //Ejecutar si el UPDATE fue correcto
                if( $query ){
                    //Obtener el ID del rol dado el nombre del rol
                    $this->load->model('usuarios/roles_model');
                    $rol_id = $this->roles_model->obtener_id($rol);
                    //Ejecutar si existe el rol ingresado
                    if( $rol_id ) {
                        //Preparar UPDATE a la BD
                        $data = array('fk_rol_id' => $rol_id);
                        $this->db->where('fk_usuario_id', $id);
                        $query = $this->db->update($this->table_name_usuarios_roles, $data);
                        //Destruir la variable utilizada para hacer el UPDATE
                        unset($data['fk_rol_id']);
                        //Retornar TRUE si el UPDATE fue correcto
                        if( $query ){
                            return $query;
                        } else {
                            // 3. El UPDATE del rol no se ejecutó
                            return 'No se actualizó el rol.';
                        }
                    } else {
                        // 2. El ID del rol no existe
                        return 'No existe el rol.';
                    }
                } else {
                    // 1. El UPDATE del nombre no se ejecutó
                    return 'No se actualizó el nombre.';
                }
            } else {
                // 0. El ID de usuario no existe
                return 'No existe el usuario.';
            }
        }
    }
}

/* End of file usuarios_model.php */
/* Location: ./application/models/usuarios/usuarios_model.php */