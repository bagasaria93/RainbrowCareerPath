<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departemen extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Departemen_model');
    }

    public function index() {
        $data['departemen'] = $this->Departemen_model->get_all();
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('departemen/index', $data);
        $this->load->view('templates/footer');
    }

    public function add() {
        $data['action'] = 'add';
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('departemen/form', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id) {
        $data['departemen'] = $this->Departemen_model->get_by_id($id);
        $data['action'] = 'edit';
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('departemen/form', $data);
        $this->load->view('templates/footer');
    }

    public function save() {
        $data = array(
            'nama_departemen' => $this->input->post('nama_departemen')
        );

        $id = $this->input->post('id');
        
        if ($id) {
            $this->Departemen_model->update($id, $data);
        } else {
            $this->Departemen_model->insert($data);
        }
        
        redirect('departemen');
    }

    public function delete($id) {
        $this->Departemen_model->delete($id);
        redirect('departemen');
    }
}