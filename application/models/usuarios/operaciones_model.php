<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Operaciones_model
 *
 * Representa los datos de Operaciones
 *
 * @author Byron Oña
 *
 */
class Operaciones_model extends CI_Model {

    public $limit;
    public $offset;
    private $table_name_operaciones = 'OPERACIONES';

    function __construct() {
        parent::__construct();
    }

    /**
     * Recuperar todos los registros en la BD 
     * 
     * @return array
     */
    public function obtener() {
        $this->db->from($this->table_name_operaciones);
        $resultado = $this->db->get();
        return $resultado->result_array();
    }

    /**
     * Recuperar la cantidad de todos registros en la BD
     *
     * @return  int
     */
    public function num_registros() {
        $this->db->from($this->table_name_operaciones);
        return $this->db->count_all_results();
    }

    /**
     * Recupera el ID de la operación dado
     * 
     * @param string
     *
     * @return int
     */
    function obtener_id($operacion='') {
        /*$query = $this->db->query("SELECT ID FROM ".$this->table_name_operaciones." WHERE OPERACION = '".$operacion."'");*/
        $resultado = $this->db->select('id')->from($this->table_name_operaciones)->where('operacion',$operacion)->get();
        foreach ($resultado->row() as $key => $value)
            return $value;
        return 0;
    }

    /**
     * Verificar si existe el nombre de la operación
     * 
     * @param string
     *
     * @return bool
     */
    function existe($operacion='') {
        $resultado = $this->db->select('id')->from($this->table_name_operaciones)->where('operacion',$operacion)->get();
        //$query = $this->db->query("SELECT ID FROM ".$this->table_name_operaciones." WHERE OPERACION = '".$operacion."'");
        return $resultado->num_rows();
    }

    /**
     * Actualiza el nombre y la operación asociado al usuario
     * 
     * @return bool
     * Si falla
     * @return string
     */
    public function guardar_actualizar() {
        //Recibir datos por POST
        $id = isset($_POST['id']) ? $this->security->xss_clean(intval($_POST['id'])) : 0;
        $operacion = isset($_POST['operacion']) ? $this->security->xss_clean(trim(strtolower(strval($_POST['operacion'])))) : '';
        $estado = isset($_POST['estado']) ? $this->security->xss_clean(trim(strtolower(strval($_POST['estado'])))) : '';
        $esNuevo = isset($_POST['isNewRecord']) ? $this->security->xss_clean(strtolower(strval($_POST['isNewRecord']))) : '';
        //Es nuevo el registro
        if($esNuevo) {
            //Verificar si la operación ya existe
            $existe_operacion = $this->existe($operacion);
            if( $existe_operacion ) {
                return 'El nombre de la operación ya existe.';
            } else {
                //Preparar INSERT a la BD
                $data = array('operacion' => $operacion,'estado' => $estado);
                $query = $this->db->insert($this->table_name_operaciones, $data);
                //Destruir la variable utilizada para hacer el INSERT
                unset($data['operacion']);
                unset($data['estado']);
                //Retornar TRUE si el INSERT fue correcto
                if( $query ){
                    return $query;
                } else {
                    // 1. El INSERT de la operación no se ejecutó
                    return 'No se guardó la operación.';
                }
            }
        } else {
            //Ejecutar si el ID de la operación es diferente de 0
            if( $id != 0 ) {
                //Preparar UPDATE a la BD
                $data = array('operacion' => $operacion,'estado' => $estado);
                $this->db->where('id', $id);
                $query = $this->db->update($this->table_name_operaciones, $data);
                //Destruir la variable utilizada para hacer el UPDATE
                unset($data['operacion']);
                unset($data['estado']);
                //Retornar TRUE si el UPDATE fue correcto
                if( $query ){
                    return $query;
                } else {
                    // 1. El UPDATE de la operación no se ejecutó
                    return 'No se actualizó la operación.';
                }
            } else {
                // 0. El ID de la operación no existe
                return 'No existe la operación.';
            }
        }
    }
}

/* End of file operaciones_model.php */
/* Location: ./application/models/usuarios/operaciones_model.php */