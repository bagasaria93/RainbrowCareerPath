<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Level_jabatan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Level_jabatan_model');
    }

    public function index() {
        $data['level_jabatan'] = $this->Level_jabatan_model->get_all();
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('level_jabatan/index', $data);
        $this->load->view('templates/footer');
    }

    public function add() {
        $data['action'] = 'add';
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('level_jabatan/form', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id) {
        $data['level_jabatan'] = $this->Level_jabatan_model->get_by_id($id);
        $data['action'] = 'edit';
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('level_jabatan/form', $data);
        $this->load->view('templates/footer');
    }

    public function save() {
        $data = array(
            'nama_level' => $this->input->post('nama_level')
        );

        $id = $this->input->post('id');
        
        if ($id) {
            $this->Level_jabatan_model->update($id, $data);
        } else {
            $this->Level_jabatan_model->insert($data);
        }
        
        redirect('level_jabatan');
    }

    public function delete($id) {
        $this->Level_jabatan_model->delete($id);
        redirect('level_jabatan');
    }
}