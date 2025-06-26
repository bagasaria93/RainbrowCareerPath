<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Training_model extends CI_Model {

    public function get_all($filters = array()) {
        $this->db->select('t.*, p.nama_lengkap as nama_pelamar, tr.nama_trainer');
        $this->db->from('training t');
        $this->db->join('pelamar p', 't.pelamar_id = p.id');
        $this->db->join('trainer tr', 't.trainer_id = tr.id', 'left');
        
        if (!empty($filters['search'])) {
            $this->db->group_start();
            $this->db->like('p.nama_lengkap', $filters['search']);
            $this->db->or_like('t.jenis_training', $filters['search']);
            $this->db->group_end();
        }
        
        if (!empty($filters['jenis'])) {
            $this->db->where('t.jenis_training', $filters['jenis']);
        }
        
        if (!empty($filters['status'])) {
            $this->db->where('t.status', $filters['status']);
        }
        
        // Tambahkan filter trainer
        if (!empty($filters['trainer'])) {
            $this->db->where('t.trainer_id', $filters['trainer']);
        }
        
        if (!empty($filters['tanggal_dari'])) {
            $this->db->where('t.tanggal_mulai >=', $filters['tanggal_dari']);
        }
        
        if (!empty($filters['tanggal_sampai'])) {
            $this->db->where('t.tanggal_mulai <=', $filters['tanggal_sampai']);
        }
        
        $this->db->order_by('t.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_id($id) {
        $this->db->select('t.*, p.nama_lengkap as nama_pelamar, tr.nama_trainer');
        $this->db->from('training t');
        $this->db->join('pelamar p', 't.pelamar_id = p.id');
        $this->db->join('trainer tr', 't.trainer_id = tr.id', 'left');
        $this->db->where('t.id', $id);
        return $this->db->get()->row();
    }

    public function get_by_pelamar($pelamar_id) {
        $this->db->where('pelamar_id', $pelamar_id);
        return $this->db->get('training')->result();
    }

    public function insert($data) {
        return $this->db->insert('training', $data);
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('training', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('training');
    }

    public function transfer_to_karyawan($training_id) {
        $training = $this->get_by_id($training_id);
        
        if ($training) {
            $this->load->model('Pelamar_model');
            $pelamar = $this->Pelamar_model->get_by_id($training->pelamar_id);
            
            $karyawan_data = array(
                'pelamar_id' => $training->pelamar_id,
                'training_id' => $training_id,
                'nama_lengkap' => $pelamar->nama_lengkap,
                'no_hp' => $pelamar->no_hp,
                'email' => $pelamar->email,
                'departemen_id' => $pelamar->departemen_id,
                'level_jabatan_id' => $pelamar->level_jabatan_id,
                'tanggal_masuk' => date('Y-m-d')
            );
            
            $this->db->insert('karyawan', $karyawan_data);
            
            $this->Pelamar_model->update($training->pelamar_id, array('status_id' => 1));
            
            $this->update($training_id, array('status' => 'COMPLETED'));
            
            return true;
        }
        
        return false;
    }

    public function get_ongoing_count() {
        $this->db->where('status', 'ONGOING');
        return $this->db->count_all_results('training');
    }

    public function get_count_by_jenis() {
        $this->db->select('jenis_training, COUNT(*) as total');
        $this->db->group_by('jenis_training');
        return $this->db->get('training')->result();
    }
}