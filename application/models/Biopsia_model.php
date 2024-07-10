<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Biopsia_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->db2 = $this->load->database('second_db', TRUE);
        $this->db_salutte = $this->load->database('salutte2', TRUE);
    }

    public function buscarPorNServicio($n_servicio) {
        $sql_first = "SELECT 
                    e.nro_servicio AS n_servicio,
                    s.nombre_servicio AS servicio,
                    tde.nombre AS tipo_estudio,
                    ps.persona_salutte_id AS paciente_id,
                    e.diagnostico AS diagnostico,
                    e.fecha_carga AS fecha_carga,
                    e.estado_estudio AS estado,
                    dt.macro AS macro
                FROM estudio e
                JOIN servicio s ON e.servicio_id = s.id
                JOIN tipo_de_estudio tde ON e.tipo_estudio_id = tde.id
                JOIN personal ps ON e.personal_id = ps.id
                JOIN detalle_estudio dt ON e.detalle_estudio_id = dt.id
                WHERE e.nro_servicio = ?";
    
    
    $result_first = $this->db2->query($sql_first, [$n_servicio])->row_array();
    
    return $result_first;
    }

    public function obtenerDatosDePaciente($paciente_id) {
        $sql_second = "SELECT 
                        p.id AS paciente_id,
                        p.nombres AS nombres,
                        p.apellidos AS apellidos,
                        p.documento as documento,
                        p.fecha_nacimiento as fecha_nacimiento,
                        p.sexo as sexo,
                        os.nombre AS obra_social
                    FROM persona p
                    inner JOIN persona_plan pp ON p.id = pp.persona_id
                    inner JOIN plan pl ON pp.plan_id = pl.id
                    inner JOIN obra_social os ON pl.obra_social_id = os.id
                    inner join persona_plan_por_defecto pppd ON pp.id = pppd.persona_plan_id 
                    WHERE p.id = ?";
        
        $result_second = $this->db_salutte->query($sql_second, [$paciente_id])->row_array();

        return $result_second;
    }

    public function obtenerProfesionales(){

        $sql4 = "SELECT DISTINCT
                        p.id,
                        p.nombres as nombres_profesional, 
                        p.apellidos as apellidos_profesional
                    FROM persona p
                    INNER JOIN personal pe ON pe.persona_id = p.id
                    INNER JOIN asignacion a ON pe.id = a.personal_id
                    INNER JOIN especialidad es ON a.especialidad_id = es.id
                    WHERE p.id IN (106780, 198041)";

        $query = $this->db_salutte->query($sql4);
        return $query->result_array(); 
    }

    public function obtenerServicio(){
        $sql5 = "SELECT DISTINCT 
                        e.nombre as nombre
                    FROM especialidad e 
                    INNER JOIN departamento d on d.id = e.departamento_id";

        $query = $this->db_salutte->query($sql5);
        return $query->result_array(); 
    }


    public function actualizarEstudio($nro_servicio, $data) {
        // Construir la consulta de actualización
        $sql_actualizar = "UPDATE estudio e
                           INNER JOIN servicio s ON e.servicio_id = s.id
                           INNER JOIN tipo_de_estudio tde ON e.tipo_estudio_id = tde.id
                           INNER JOIN detalle_estudio dt ON e.detalle_estudio_id = dt.id
                           INNER JOIN personal ps ON e.personal_id = ps.id
                           SET s.nombre_servicio = ?,
                               tde.nombre = ?,
                               e.diagnostico = ?,
                               e.fecha_carga = ?,
                               e.estado_estudio = ?,
                               dt.macro = ?
                           WHERE e.nro_servicio = ?";

        // Preparar los datos
        $params = [
            $data['servicio'],
            $data['tipo_estudio'],
            $data['diagnostico'],
            $data['fecha_carga'],
            $data['estado_estudio'],
            $data['macro'],
            /*$data['profesional_salutte_id'], // Agregado el profesional_salutte_id
            $data['macro'],                  // Asumiendo que 'macro' viene en $data
            $data['micro'],                  // Asumiendo que 'micro' viene en $data
            $data['conclusion'],             // Asumiendo que 'conclusion' viene en $data
            $data['observacion'],            // Asumiendo que 'observacion' viene en $data
            $data['observacion_interna'],*/
            $nro_servicio
        ];

        // Ejecutar la consulta
        $query = $this->db2->query($sql_actualizar, $params);

        // Retornar el resultado de la ejecución
        return $query;

    }

}
