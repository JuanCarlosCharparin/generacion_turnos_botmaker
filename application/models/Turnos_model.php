<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Turnos_model extends CI_Model
{

    public function getTurnosByFecha($fecha)
    {
        // Establecer el formato de fechas a español
        $this->db->query("SET lc_time_names = 'es_ES'");

        // Seleccionar las columnas deseadas
        $this->db->select('
            DATE_FORMAT(tp.fecha, "%d/%m/%Y") AS FECHATURNO,
            CONCAT(HOUR(tp.hora), " horas ", MINUTE(tp.hora), " minutos") AS HORATURNO,
            CONCAT(p.nombres, " ", p.apellidos) AS PACIENTETURNO,
            CONCAT("549", p.contacto_celular_codigo, p.contacto_celular_numero, " ") AS WHATSAPP,
            e.nombre AS ESPECIALIDADTURNO,
            CONCAT(p2.apellidos, ", ", p2.nombres) AS PROFESIONALTURNO
        ');

        // Definir las tablas y uniones
        $this->db->from('persona AS p');
        $this->db->join('persona_plan pp', 'p.id = pp.persona_id', 'inner');
        $this->db->join('plan pl', 'pp.plan_id = pl.id', 'inner');
        $this->db->join('direccion d', 'p.direccion_id = d.id', 'inner');
        $this->db->join('persona_usuario_portal pup', 'pup.persona_id = p.id', 'left');
        $this->db->join('usuario_portal up', 'pup.usuario_portal_id = up.id', 'left');
        $this->db->join('usuario_portal_celular upc', 'up.id = upc.id', 'left');
        $this->db->join('usuario_portal_email upe', 'up.id = upe.id', 'left');
        $this->db->join('turno_programado AS tp', 'p.id = tp.persona_id', 'inner');
        $this->db->join('turno_programado_call AS tpc', 'tp.id = tpc.id', 'left');
        $this->db->join('template_sms AS tsms', 'tsms.id = tpc.template_sms_id', 'left');
        $this->db->join('template_email AS temail', 'temail.id = tpc.template_sms_id', 'left');
        $this->db->join('agenda AS ag', 'ag.id = tp.agenda_id', 'inner');
        $this->db->join('asignacion AS asig', 'asig.id = ag.asignacion_id', 'inner');
        $this->db->join('lugar l', 'ag.lugar_id = l.id', 'left');
        $this->db->join('especialidad AS e', 'asig.especialidad_id = e.id', 'inner');
        $this->db->join('institucion AS inst', 'inst.id = asig.institucion_id', 'inner');
        $this->db->join('personal AS per', 'per.id = asig.personal_id', 'inner');
        $this->db->join('persona AS p2', 'p2.id = per.persona_id', 'inner');

        // Agregar las condiciones de la consulta
        $this->db->where('tp.estado_turno_id', '1');
        $this->db->where('tp.fecha', $fecha);
        $this->db->where('asig.activo', 1);
        $this->db->where('inst.id', 1);
        $this->db->where('p.contacto_celular_numero IS NOT NULL');
        $this->db->where_not_in('e.id', [
            500090, 6661520, 6661128, 6661575, 500800, 6661121, 
            6661328, 6661517, 6661521, 6661575, 6661313, 6661129, 
            6661301, 6661524, 500020, 6661258, 6661433, 6661538, 
            6661554, 6661130, 6661430, 6661431, 6661632
        ]);
        $this->db->not_like('e.nombre', 'terapia');
        $this->db->where('p.id !=', 30578);

        // Agrupar por documento y ordenar por hora del turno
        $this->db->group_by('p.documento');
        $this->db->order_by('HORATURNO', 'ASC');

        // Ejecutar la consulta
        $query = $this->db->get();

        // Devolver los resultados
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
}





