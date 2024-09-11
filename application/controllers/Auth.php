<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Usuarios_model');
    }

    public function index() {
        $nro_factura = $this->input->get('nro_factura');

        
        $data = array(
            'nro_factura' => $nro_factura,
        );

        
        // Cargar vistas
        $this->load->view('layouts/header');
        $this->load->view('admin/reportes/turnos', $data); // Aquí cargamos la vista correcta
        $this->load->view('layouts/footer');
    }

    public function login()
    {
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        $res = $this->Usuarios_model->login($username, $password);

        if (!$res) {
            $this->session->set_flashdata("error", "El usuario y/o contraseña son incorrectos");
            redirect(base_url());
        } else {
            $data = array(
                'id' => $res->id,
                'nombre' => $res->nombres,
                'rol' => $res->rol_id,
                'login' => TRUE
            );
            $this->session->set_userdata($data);
            redirect(base_url() . "dashboard");
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }
}

