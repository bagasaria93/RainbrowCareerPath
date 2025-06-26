<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Status_model');
    }

    public function index() {
        $data['status'] = $this->Status_model->get_all();
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('status/index', $data);
        $this->load->view('templates/footer');
    }

    public function add() {
        $data['action'] = 'add';
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('status/form', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id) {
        $data['status'] = $this->Status_model->get_by_id($id);
        $data['action'] = 'edit';
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('status/form', $data);
        $this->load->view('templates/footer');
    }

    public function save() {
        $data = array(
            'nama_status' => $this->input->post('nama_status'),
            'warna' => $this->input->post('warna')
        );

        $id = $this->input->post('id');
        
        if ($id) {
            $this->Status_model->update($id, $data);
        } else {
            $this->Status_model->insert($data);
        }
        
        redirect('status');
    }

    public function delete($id) {
        $this->Status_model->delete($id);
        redirect('status');
    }
}