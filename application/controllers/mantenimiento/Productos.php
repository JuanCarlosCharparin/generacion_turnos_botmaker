<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {


    public function __construct() {
        parent::__construct();
        $this->load->model('Productos_model');
    }
	public function index()
	{
        $data = array(
            'productos' => $this->Productos_model->getProductos(),
        );
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/productos/list', $data);
		$this->load->view('layouts/footer');
	}

    public function add(){

        $this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/productos/add');
		$this->load->view('layouts/footer');

    }
    
    public function store(){

        $nombre = $this->input->post("nombre");
        $descripcion = $this->input->post("descripcion");
        $precio = $this->input->post("precio");
        $stock = $this->input->post("stock");
        $categoria_id = $this->input->post("categoria_id");

        $data = array(
            'nombre' => $nombre,
            'descripcion'=> $descripcion,
            'precio'=> $precio,
            'stock'=> $stock,
            'categoria_id'=> $categoria_id,
            'estado' => "1",
        
        );

        if ($this->Productos_model->save($data)){
            redirect(base_url()."mantenimiento/productos");
        }else {
            $this->session->set_flashdata("error","No se pudo guardar la producto");
            redirect(base_url()."mantenimiento/productos/add");
        }
    }

    public function edit($id){
        $data = array(
            'producto' => $this->Productos_model->getProducto($id),
        );

        $this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/productos/edit', $data);
		$this->load->view('layouts/footer');

    }
    public function update(){
        $idProducto = $this->input->post("idProducto");
        $nombre = $this->input->post("nombre");
        $descripcion = $this->input->post("descripcion");
        $precio = $this->input->post("precio");
        $stock = $this->input->post("stock");
        $categoria_id = $this->input->post("categoria_id");

        $data = array(
            'nombre'=> $nombre,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'stock' => $stock,
            'categoria_id' => $categoria_id,
        );

        if ($this->Productos_model->update($idProducto,$data)) {
            redirect(base_url()."mantenimiento/productos");
        }else {
            $this->session->set_flashdata("error","No se pudo actualizar la producto");
            redirect(base_url()."mantenimiento/productos/edit/". $idProducto);
        }
    }
    public function view($id){
        $data = array(
            'producto' => $this->Productos_model->getProducto($id),
        );
        $this->load->view("admin/productos/view", $data);
    }

    public function delete($id){
    
        $data = array(
            'estado' => "0",  
        );
        $this->Productos_model->update($id,$data);
        echo "mantenimiento/productos";

    }

    public function getCategoriaProducto($idProducto) {
        // Llamar al método del modelo para obtener la categoría del producto
        $categoria = $this->Productos_model->getCategoriaProducto($idProducto);
        
        // Verificar si se encontró la categoría
        if ($categoria !== null) {
            // Retornar la categoría (esto puede ser una vista, un JSON, etc.)
            echo "La categoría del producto es: " . $categoria;
        } else {
            // Manejar el caso en que no se encontró la categoría
            echo "No se encontró la categoría para el producto con ID: " . $idProducto;
        }
    }

}
