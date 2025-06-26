<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model(array('Karyawan_model', 'Departemen_model', 'Level_jabatan_model'));
    }

    public function index() {
        $filters = array(
            'search' => $this->input->get('search'),
            'departemen' => $this->input->get('departemen'),
            'status_karyawan' => $this->input->get('status_karyawan'),
            'status_penempatan' => $this->input->get('status_penempatan'),
            'tanggal_dari' => $this->input->get('tanggal_dari'),
            'tanggal_sampai' => $this->input->get('tanggal_sampai')
        );
        
        $data['karyawan'] = $this->Karyawan_model->get_all($filters);
        $data['departemen_list'] = $this->Departemen_model->get_all();
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('karyawan/index', $data);
        $this->load->view('templates/footer');
    }

    public function add() {
        $data['departemen_list'] = $this->Departemen_model->get_all();
        $data['level_jabatan_list'] = $this->Level_jabatan_model->get_all();
        $data['action'] = 'add';
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('karyawan/form', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id) {
        $data['karyawan'] = $this->Karyawan_model->get_by_id($id);
        $data['departemen_list'] = $this->Departemen_model->get_all();
        $data['level_jabatan_list'] = $this->Level_jabatan_model->get_all();
        $data['action'] = 'edit';
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('karyawan/form', $data);
        $this->load->view('templates/footer');
    }

    public function save() {
        $data = array(
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'no_hp' => $this->input->post('no_hp'),
            'email' => $this->input->post('email'),
            'departemen_id' => $this->input->post('departemen_id'),
            'level_jabatan_id' => $this->input->post('level_jabatan_id'),
            'tanggal_masuk' => $this->input->post('tanggal_masuk'),
            'gaji' => $this->input->post('gaji'),
            'status_penempatan' => $this->input->post('status_penempatan'),
            'status_karyawan' => $this->input->post('status_karyawan')
        );

        $id = $this->input->post('id');
        
        if ($id) {
            $this->Karyawan_model->update($id, $data);
        } else {
            $this->Karyawan_model->insert($data);
        }
        
        redirect('karyawan');
    }

    public function update_status_penempatan() {
        $id = $this->input->post('id');
        $status_penempatan = $this->input->post('status_penempatan');
        
        $data = array('status_penempatan' => $status_penempatan);
        $result = $this->Karyawan_model->update($id, $data);
        
        echo json_encode(array('success' => $result));
    }

    public function detail($id) {
        $this->load->model('Training_model');
        $this->load->model('Pelamar_model');
        
        $data['karyawan'] = $this->Karyawan_model->get_by_id($id);
        
        // Get training data if exists
        if($data['karyawan']->training_id) {
            $data['training_data'] = $this->Training_model->get_by_id($data['karyawan']->training_id);
        } else {
            $data['training_data'] = null;
        }
        
        // Get pelamar data if exists
        if($data['karyawan']->pelamar_id) {
            $data['pelamar_data'] = $this->Pelamar_model->get_by_id($data['karyawan']->pelamar_id);
        } else {
            $data['pelamar_data'] = null;
        }
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('karyawan/detail', $data);
        $this->load->view('templates/footer');
    }

    public function delete($id) {
        $this->Karyawan_model->delete($id);
        redirect('karyawan');
    }
}