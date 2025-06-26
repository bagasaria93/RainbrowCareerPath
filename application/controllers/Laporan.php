<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model(array('Pelamar_model', 'Training_model', 'Status_model', 'Departemen_model', 'Trainer_model'));
    }

    public function pelamar() {
        $filters = array(
            'search' => $this->input->get('search'),
            'status' => $this->input->get('status'),
            'departemen' => $this->input->get('departemen'),
            'tanggal_dari' => $this->input->get('tanggal_dari'),
            'tanggal_sampai' => $this->input->get('tanggal_sampai')
        );
        
        $data['pelamar'] = $this->Pelamar_model->get_all($filters);
        $data['status_list'] = $this->Status_model->get_all();
        $data['departemen_list'] = $this->Departemen_model->get_all();
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan/pelamar', $data);
        $this->load->view('templates/footer');
    }

    public function training() {
        $filters = array(
            'search' => $this->input->get('search'),
            'jenis' => $this->input->get('jenis'),
            'status' => $this->input->get('status'),
            'trainer' => $this->input->get('trainer'), // Tambahkan filter trainer
            'tanggal_dari' => $this->input->get('tanggal_dari'),
            'tanggal_sampai' => $this->input->get('tanggal_sampai')
        );
        
        $data['training'] = $this->Training_model->get_all($filters);
        $data['trainer_list'] = $this->Trainer_model->get_all(); // Tambahkan list trainer
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan/training', $data);
        $this->load->view('templates/footer');
    }
}