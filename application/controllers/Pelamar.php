<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelamar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model(array('Pelamar_model', 'Status_model', 'Departemen_model', 'Level_jabatan_model', 'Sumber_model'));
    }

    public function index() {
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
        $this->load->view('pelamar/index', $data);
        $this->load->view('templates/footer');
    }

    public function add() {
        $data['status_list'] = $this->Status_model->get_all();
        $data['departemen_list'] = $this->Departemen_model->get_all();
        $data['level_jabatan_list'] = $this->Level_jabatan_model->get_all();
        $data['sumber_list'] = $this->Sumber_model->get_all();
        $data['action'] = 'add';
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pelamar/form', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id) {
        $data['pelamar'] = $this->Pelamar_model->get_by_id($id);
        $data['status_list'] = $this->Status_model->get_all();
        $data['departemen_list'] = $this->Departemen_model->get_all();
        $data['level_jabatan_list'] = $this->Level_jabatan_model->get_all();
        $data['sumber_list'] = $this->Sumber_model->get_all();
        $data['action'] = 'edit';
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pelamar/form', $data);
        $this->load->view('templates/footer');
    }

    public function save() {
        $data = array(
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'no_hp' => $this->input->post('no_hp'),
            'email' => $this->input->post('email'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'alamat' => $this->input->post('alamat'),
            'departemen_id' => $this->input->post('departemen_id'),
            'level_jabatan_id' => $this->input->post('level_jabatan_id'),
            'sumber_id' => $this->input->post('sumber_id'),
            'status_id' => $this->input->post('status_id'),
            'tanggal_apply' => $this->input->post('tanggal_apply'),
            'tanggal_interview' => $this->input->post('tanggal_interview'),
            'catatan' => $this->input->post('catatan')
        );

        $id = $this->input->post('id');
        
        if ($id) {
            $this->Pelamar_model->update($id, $data);
        } else {
            $this->Pelamar_model->insert($data);
        }
        
        redirect('pelamar');
    }

    public function delete($id) {
        $this->Pelamar_model->delete($id);
        redirect('pelamar');
    }

    public function detail($id) {
        $this->load->model('Training_model');
        $this->load->model('Karyawan_model');
        
        $data['pelamar'] = $this->Pelamar_model->get_by_id($id);
        
        // Get timeline/history
        $this->db->select('p.*, s.warna, "pelamar" as type, p.created_at as tanggal');
        $this->db->from('pelamar p');
        $this->db->join('status s', 'p.status_id = s.id', 'left');
        $this->db->where('p.id', $id);
        $pelamar_history = $this->db->get()->result();
        
        $this->db->select('t.*, "training" as type, t.created_at as tanggal, tr.nama_trainer');
        $this->db->from('training t');
        $this->db->join('trainer tr', 't.trainer_id = tr.id', 'left');
        $this->db->where('t.pelamar_id', $id);
        $training_history = $this->db->get()->result();
        
        $this->db->select('*, "karyawan" as type, created_at as tanggal');
        $this->db->from('karyawan');
        $this->db->where('pelamar_id', $id);
        $karyawan_history = $this->db->get()->result();
        
        // Combine and sort timeline
        $timeline = array_merge($pelamar_history, $training_history, $karyawan_history);
        usort($timeline, function($a, $b) {
            return strtotime($a->tanggal) - strtotime($b->tanggal);
        });
        
        $data['timeline'] = $timeline;
        $data['training_data'] = $this->Training_model->get_by_pelamar($id);
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pelamar/detail', $data);
        $this->load->view('templates/footer');
    }

    public function update_status() {
        $id = $this->input->post('id');
        $status_id = $this->input->post('status_id');
        $tanggal_mulai = $this->input->post('tanggal_mulai');
        $trainer_id = $this->input->post('trainer_id');
        $emergency_name = $this->input->post('emergency_name');
        $emergency_phone = $this->input->post('emergency_phone');
        $emergency_relation = $this->input->post('emergency_relation');
        
        $result = $this->Pelamar_model->update_status($id, $status_id, $tanggal_mulai, $trainer_id, $emergency_name, $emergency_phone, $emergency_relation);
        
        echo json_encode(array('success' => $result));
    }
}