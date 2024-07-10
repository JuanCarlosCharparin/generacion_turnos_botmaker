<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas_model extends CI_Model {

	public function getComprobantes(){
        
        $resultados = $this->db->get("tipo_comprobante");
        return $resultados->result();
    }
    public function getproductos($valor){
        $this->db->select("id,nombre as label,precio,stock");
        $this->db->from("productos");
        $this->db->like("nombre", $valor);
        $resultados = $this->db->get();
        return $resultados->result_array();
    }

    public function getVentas(){
        $this->db->select("v.*, c.nombres, tc.nombre as tipocomprobante");
        $this->db->from("ventas v");
        $this->db->join("clientes c", "v.cliente_id= c.id");
        $this->db->join("tipo_comprobante tc", "v.tipo_documento_id = tc.id");


        $resultados = $this->db->get();

        if ($resultados->num_rows()>0) {
            return $resultados->result();
        }else{
            return false;
        }
    }

    public function getVentasbyDate($fechainicio, $fechafin){

        $this->db->select("v.*, c.nombres, tc.nombre as tipocomprobante");
        $this->db->from("ventas v");
        $this->db->join("clientes c", "v.cliente_id= c.id");
        $this->db->join("tipo_comprobante tc", "v.tipo_documento_id = tc.id");

        $this->db->where("v.fecha >=", $fechainicio);
        $this->db->where("v.fecha <=", $fechafin);

        $resultados = $this->db->get();

        if ($resultados->num_rows()>0) {
            return $resultados->result();
        }else{
            return false;
        }
    }

}