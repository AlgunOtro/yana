<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Objetos_model
 *
 * Representa los datos de Objetos
 *
 * @author Byron Oña
 *
 */
class Objetos_model extends CI_Model {

    public $limit;
    public $offset;
    private $table_name_objetos = 'OBJETOS';

    function __construct() {
        parent::__construct();
    }

    /**
     * Recuperar todos los registros en la BD 
     * 
     * @return array
     */
    public function obtener() { 
        $this->db->from($this->table_name_objetos);
        $resultado = $this->db->get();
        return $resultado->result_array();
    }

    /**
     * Recuperar la cantidad de todos registros en la BD
     *
     * @return  int
     */
    public function num_registros() {
        $this->db->from($this->table_name_objetos);
        return $this->db->count_all_results();
    }

    /**
     * Recupera el ID del objeto dado
     * 
     * @param string
     *
     * @return int
     */
    function obtener_id($nombre='') {
        $resultado = $this->db->select('id')->from($this->table_name_objetos)->where('nombre',$nombre)->get();
        foreach ($resultado->row() as $key => $value)
            return $value;
        return 0;
    }

    /**
     * Verificar si existe el nombre del objeto
     * 
     * @param string
     *
     * @return bool
     */
    function existe($nombre='') {
        $resultado = $this->db->select('id')->from($this->table_name_objetos)->where('nombre',$nombre)->get();
        return $resultado->num_rows();
    }

    /**
     * Actualiza el nombre y el objeto asociado al usuario
     * 
     * @return bool
     * Si falla
     * @return string
     */
    public function guardar_actualizar() {
        //Recibir datos por POST
        $id = isset($_POST['id']) ? $this->security->xss_clean(intval($_POST['id'])) : 0;
        $nombre = isset($_POST['nombre']) ? $this->security->xss_clean(trim(strtoupper(strval($_POST['nombre'])))) : '';
        $tipo = isset($_POST['tipo']) ? $this->security->xss_clean(trim(strtoupper(strval($_POST['tipo'])))) : '';
        $estado = isset($_POST['estado']) ? $this->security->xss_clean(trim(strtolower(strval($_POST['estado'])))) : '';
        $esNuevo = isset($_POST['isNewRecord']) ? $this->security->xss_clean(strtolower(strval($_POST['isNewRecord']))) : '';
        //Es nuevo el registro
        if($esNuevo) {
            //Verificar si el objeto ya existe
            $existe_usuario = $this->existe($nombre);
            if( $existe_usuario ) {
                return 'El nombre de objeto ya existe.';
            } else {
                //Preparar INSERT a la BD
                $data = array('nombre' => $nombre,'tipo' => $tipo,'estado' => $estado);
                $query = $this->db->insert($this->table_name_objetos, $data);
                //Destruir la variable utilizada para hacer el INSERT
                unset($data['nombre']);
                unset($data['tipo']);
                unset($data['estado']);
                //Retornar TRUE si el INSERT fue correcto
                if( $query ){
                    return $query;
                } else {
                    // 1. El INSERT del objeto no se ejecutó
                    return 'No se guardó el objeto.';
                }
            }
        } else {
            //Ejecutar si el ID del objeto es diferente de 0
            if( $id != 0 ) {
                //Preparar UPDATE a la BD
                $data = array('nombre' => $nombre,'tipo' => $tipo,'estado' => $estado);
                $this->db->where('id', $id);
                $query = $this->db->update($this->table_name_objetos, $data);
                //Destruir la variable utilizada para hacer el UPDATE
                unset($data['nombre']);
                unset($data['tipo']);
                unset($data['estado']);
                //Retornar TRUE si el UPDATE fue correcto
                if( $query ){
                    return $query;
                } else {
                    // 1. El UPDATE del objeto no se ejecutó
                    return 'No se actualizó el objeto.';
                }
            } else {
                // 0. El ID del objeto no existe
                return 'No existe el objeto.';
            }
        }
    }
}

/* End of file objetos_model.php */
/* Location: ./application/models/usuarios/objetos_model.php */