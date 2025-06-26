<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sumber extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Sumber_model');
    }

    public function index() {
        $data['sumber'] = $this->Sumber_model->get_all();
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('sumber/index', $data);
        $this->load->view('templates/footer');
    }

    public function add() {
        $data['action'] = 'add';
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('sumber/form', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id) {
        $data['sumber'] = $this->Sumber_model->get_by_id($id);
        $data['action'] = 'edit';
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('sumber/form', $data);
        $this->load->view('templates/footer');
    }

    public function save() {
        $data = array(
            'nama_sumber' => $this->input->post('nama_sumber')
        );

        $id = $this->input->post('id');
        
        if ($id) {
            $this->Sumber_model->update($id, $data);
        } else {
            $this->Sumber_model->insert($data);
        }
        
        redirect('sumber');
    }

    public function delete($id) {
        $this->Sumber_model->delete($id);
        redirect('sumber');
    }
}