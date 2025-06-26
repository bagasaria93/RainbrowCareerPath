<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trainer extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model(array('Trainer_model', 'Departemen_model'));
    }

    public function index() {
        $filters = array(
            'search' => $this->input->get('search'),
            'departemen' => $this->input->get('departemen')
        );
        
        $data['trainer'] = $this->Trainer_model->get_all($filters);
        $data['departemen_list'] = $this->Departemen_model->get_all();
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('trainer/index', $data);
        $this->load->view('templates/footer');
    }

    public function add() {
        $data['departemen_list'] = $this->Departemen_model->get_all();
        $data['action'] = 'add';
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('trainer/form', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id) {
        $data['trainer'] = $this->Trainer_model->get_by_id($id);
        $data['departemen_list'] = $this->Departemen_model->get_all();
        $data['action'] = 'edit';
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('trainer/form', $data);
        $this->load->view('templates/footer');
    }

    public function save() {
        $data = array(
            'nama_trainer' => $this->input->post('nama_trainer'),
            'departemen_id' => $this->input->post('departemen_id'),
            'no_hp' => $this->input->post('no_hp'),
            'email' => $this->input->post('email')
        );

        $id = $this->input->post('id');
        
        if ($id) {
            $this->Trainer_model->update($id, $data);
        } else {
            $this->Trainer_model->insert($data);
        }
        
        redirect('trainer');
    }

    public function delete($id) {
        $this->Trainer_model->delete($id);
        redirect('trainer');
    }
}