<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Turnos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Turnos_model');
    }

    public function index() {
        $nro_factura = $this->input->get('nro_factura');

        
        $data = array(
        );

        
        // Cargar vistas
        $this->load->view('layouts/header');
        $this->load->view('admin/reportes/turnos', $data); // Aquí cargamos la vista correcta
        $this->load->view('layouts/footer');
    }

    public function getTurnosAjax()
    {
        $fecha = $this->input->get('fecha');

        $data = array(
            'turnos' => $this->Turnos_model->getTurnosByFecha($fecha),
        );
        // Cargamos solo la vista 'table' con los datos
        $this->load->view('admin/reportes/table', $data);
    }

    public function exportar()
	{
		$fecha = $this->input->get('fecha');
		$data = array(
			'turnos' => $this->Turnos_model->getTurnosByFecha($fecha),
            'fecha' => $fecha
		);
		$this->load->view('admin/reportes/exportar',$data);
	}
}
