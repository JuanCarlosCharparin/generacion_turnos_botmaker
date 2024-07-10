<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estudio_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->db2 = $this->load->database('second_db', TRUE);
        $this->db_salutte = $this->load->database('salutte2', TRUE);
    }

    
    /*public function buscar($n_servicio, $servicio, $tipo_estudio, $paciente, $obra_social, $diagnostico, $fecha, $prof_sol, $estado) {
        $n_servicio = (int)$n_servicio;
    
        $sql1 = "SELECT 
            e.nro_servicio AS n_servicio,
            s.nombre_servicio AS servicio,
            tde.nombre AS tipo_estudio,
            ps.persona_salutte_id AS paciente_id,
            e.diagnostico_presuntivo AS diagnostico,
            e.fecha_carga AS fecha_carga,
            e.estado_estudio AS estado
         FROM estudio e
         JOIN servicio s ON e.servicio_id = s.id
         JOIN tipo_de_estudio tde ON e.tipo_estudio_id = tde.id
         JOIN personal ps ON e.personal_id = ps.id
         WHERE e.nro_servicio = ?";

    
        $resultados1 = $this->db2->query($sql1, array($n_servicio))->result_array();
        
    
        if (empty($resultados1)) {
            return [];
        }
    
        $persona_ids = array_column($resultados1, 'paciente_id');
    
        if (empty($persona_ids)) {
            return $resultados1;
        }
    
        $persona_ids_str = implode(',', $persona_ids);
        echo "Persona IDs: " . $persona_ids_str . "\n"; 
    
        $sql2 = "SELECT p.id AS persona_id, 
                         p.nombres, 
                         p.apellidos, 
                         os.nombre AS obra_social
                  FROM persona p
                  inner JOIN personal pr ON pr.persona_id = p.id
                  inner JOIN persona_plan pp ON p.id = pp.persona_id
                  inner JOIN plan pl ON pp.plan_id = pl.id
                  inner JOIN obra_social os ON pl.obra_social_id = os.id
                  inner join persona_plan_por_defecto pppd ON pp.id = pppd.persona_plan_id
                  WHERE p.id IN ($persona_ids_str);";
    
        $resultados2 = $this->db_salutte->query($sql2)->result_array();
        print_r($resultados2); 
    
        if (empty($resultados2)) {
            echo "No se encontraron personas con los IDs especificados en salutte2.\n";
        }
    
        $personas = array();
        foreach ($resultados2 as $row) {
            $personas[$row['persona_id']] = $row;
        }
    
        $resultados_combinados = array();
        foreach ($resultados1 as $row) {
            $paciente_id = $row['paciente_id'];
            if (isset($personas[$paciente_id])) {
                $paciente = $personas[$paciente_id];
                $resultados_combinados[] = array_merge($row, $paciente);
            } else {
                $resultados_combinados[] = array_merge($row, array(
                    
                ));
            }
        }
    
        return $resultados_combinados;
    }*/
    
    /*public function obtener_profesionales_solicitantes() {
        $sql4 = "SELECT DISTINCT
                    p.nombres,
                    p.apellidos
                FROM persona p
                INNER JOIN personal pe ON pe.persona_id = p.id
                INNER JOIN asignacion a ON pe.id = a.personal_id
                INNER JOIN especialidad es ON a.especialidad_id = es.id
                WHERE es.id = 900020";

    return $this->db_salutte->query($sql4)->result_array();
    }*/

    public function obtener_profesionales(){

        $sql4 = "SELECT DISTINCT
                        p.id,
                        p.nombres as nombres_profesional, 
                        p.apellidos as apellidos_profesional
                    FROM persona p
                    INNER JOIN personal pe ON pe.persona_id = p.id
                    INNER JOIN asignacion a ON pe.id = a.personal_id
                    INNER JOIN especialidad es ON a.especialidad_id = es.id
                    WHERE p.id in (106780, 198041);";

        $query = $this->db_salutte->query($sql4);
        return $query->result_array(); 
    }
    



    /*public function buscarPorNPaciente($persona_ids_str){
        $sql_second = "SELECT p.id, 
                    p.nombres, 
                    p.apellidos
                FROM persona p
                WHERE p.id IN ($persona_ids_str);"

    $result_second = $this->db_salutte->query($sql_second)->result_array();
            
    return $result_second;
    }*/

    public function insertar_estudio($data) {
        return $this->db2->insert('estudio', $data);
    }

    public function obtener_ultimo_servicio() {
        $sql_max = "SELECT MAX(nro_servicio) AS ultimo_servicio FROM estudio";
        $query = $this->db2->query($sql_max);
        $resultado = $query->row();
        
        return $resultado->ultimo_servicio;
    }

    public function insertar_codigo_nomenclador_ap($data) {
        $this->db2->insert('codigo_nomenclador_ap', $data);
    }


    public function filtrar_estudios($filtros) {
        // Query base
        $sql = "SELECT 
                    e.nro_servicio AS n_servicio,
                    s.nombre_servicio AS servicio,
                    tde.nombre AS tipo_estudio,
                    per.persona_salutte_id AS persona_id,
                    per.nombres AS nombres,
                    per.apellidos AS apellidos,
                    per.obra_social AS obra_social,
                    e.fecha_carga AS fecha_carga,
                    e.estado_estudio AS estado
                FROM estudio e
                INNER JOIN servicio s ON e.servicio_id = s.id
                INNER JOIN tipo_de_estudio tde ON e.tipo_estudio_id = tde.id
                INNER JOIN personal per ON e.personal_id = per.id
                WHERE 1=1";
    
        $params = array();
    
        // Agregar condiciones según los filtros recibidos
        if (!empty($filtros['n_servicio'])) {
            $sql .= " AND e.nro_servicio = ?";
            $params[] = $filtros['n_servicio'];
        }
        if (!empty($filtros['servicio'])) {
            $sql .= " AND s.nombre_servicio LIKE ?";
            $params[] = '%' . $filtros['servicio'] . '%';
        }
        if (!empty($filtros['tipo_estudio'])) {
            $sql .= " AND tde.nombre LIKE ?";
            $params[] = '%' . $filtros['tipo_estudio'] . '%';
        }
        if (!empty($filtros['paciente'])) {
            // Filtrar por nombres y apellidos del paciente
            $sql .= " AND (per.nombres LIKE ? OR per.apellidos LIKE ?)";
            $params[] = '%' . $filtros['paciente'] . '%';
            $params[] = '%' . $filtros['paciente'] . '%';
        }
    
        // Ejecutar consulta
        $query = $this->db2->query($sql, $params);
        return $query->result_array();
    }


    public function obtener_paciente($persona_salutte_id) {
        $sql = "SELECT  
                    p.id, 
                    p.nombres, 
                    p.apellidos,
                    os.nombre AS obra_social
                FROM persona p
                INNER JOIN persona_plan pp ON p.id = pp.persona_id
                INNER JOIN plan pl ON pp.plan_id = pl.id
                INNER JOIN obra_social os ON pl.obra_social_id = os.id
                INNER JOIN persona_plan_por_defecto pppd ON pp.id = pppd.persona_plan_id 
                WHERE p.id = ?";
    
        $query = $this->db_salutte->query($sql, array($persona_salutte_id));
        return $query->row_array();
    }

    public function obtener_profesionales_filtrar($profesional_id){

        $sql4 = "SELECT DISTINCT
                        p.id,
                        p.nombres as nombres_profesional, 
                        p.apellidos as apellidos_profesional
                    FROM persona p
                    INNER JOIN personal pe ON pe.persona_id = p.id
                    INNER JOIN asignacion a ON pe.id = a.personal_id
                    INNER JOIN especialidad es ON a.especialidad_id = es.id
                    WHERE p.id in (106780, 198041);";

        $query = $this->db_salutte->query($sql4, array($profesional_id));
        return $query->row_array();
    }




}    

