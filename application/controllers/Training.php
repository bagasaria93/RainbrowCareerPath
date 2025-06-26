<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Training extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model(array('Training_model', 'Pelamar_model', 'Trainer_model'));
    }

    public function index() {
        $filters = array(
            'search' => $this->input->get('search'),
            'jenis' => $this->input->get('jenis'),
            'status' => $this->input->get('status'),
            'tanggal_dari' => $this->input->get('tanggal_dari'),
            'tanggal_sampai' => $this->input->get('tanggal_sampai')
        );
        
        $data['training'] = $this->Training_model->get_all($filters);
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('training/index', $data);
        $this->load->view('templates/footer');
    }

    public function add() {
        $data['pelamar_list'] = $this->Pelamar_model->get_all();
        $data['trainer_list'] = $this->Trainer_model->get_all();
        $data['action'] = 'add';
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('training/form', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id) {
        $training = $this->Training_model->get_by_id($id);
        $pelamar = $this->Pelamar_model->get_by_id($training->pelamar_id);
        
        $data['training'] = $training;
        $data['nama_pelamar'] = $pelamar->nama_lengkap;
        $data['pelamar_list'] = $this->Pelamar_model->get_all();
        $data['trainer_list'] = $this->Trainer_model->get_all();
        $data['action'] = 'edit';
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('training/form', $data);
        $this->load->view('templates/footer');
    }

    public function save() {
        $data = array(
            'pelamar_id' => $this->input->post('pelamar_id'),
            'jenis_training' => $this->input->post('jenis_training'),
            'trainer_id' => $this->input->post('trainer_id'),
            'tanggal_mulai' => $this->input->post('tanggal_mulai'),
            'tanggal_selesai' => $this->input->post('tanggal_selesai'),
            'durasi_hari' => $this->input->post('durasi_hari'),
            'nilai' => $this->input->post('nilai'),
            'catatan' => $this->input->post('catatan'),
            'status' => $this->input->post('status')
        );

        $id = $this->input->post('id');
        
        if ($id) {
            $this->Training_model->update($id, $data);
        } else {
            $this->Training_model->insert($data);
        }
        
        redirect('training');
    }

    public function delete($id) {
        $this->Training_model->delete($id);
        redirect('training');
    }

    public function detail($id) {
        $this->load->model('Pelamar_model');
        
        $data['training'] = $this->Training_model->get_by_id($id);
        $data['pelamar'] = $this->Pelamar_model->get_by_id($data['training']->pelamar_id);
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('training/detail', $data);
        $this->load->view('templates/footer');
    }

    public function transfer($id) {
        $result = $this->Training_model->transfer_to_karyawan($id);
        if ($result) {
            $this->session->set_flashdata('success', 'Training berhasil dipindah ke karyawan');
        } else {
            $this->session->set_flashdata('error', 'Gagal memindah training');
        }
        redirect('training');
    }
}