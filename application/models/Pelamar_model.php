<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelamar_model extends CI_Model {

    public function get_all($filters = array()) {
        $this->db->select('p.*, s.nama_status, s.warna, d.nama_departemen, lj.nama_level, sr.nama_sumber');
        $this->db->from('pelamar p');
        $this->db->join('status s', 'p.status_id = s.id', 'left');
        $this->db->join('departemen d', 'p.departemen_id = d.id', 'left');
        $this->db->join('level_jabatan lj', 'p.level_jabatan_id = lj.id', 'left');
        $this->db->join('sumber sr', 'p.sumber_id = sr.id', 'left');
        
        if (!empty($filters['search'])) {
            $this->db->group_start();
            $this->db->like('p.nama_lengkap', $filters['search']);
            $this->db->or_like('p.no_hp', $filters['search']);
            $this->db->or_like('p.email', $filters['search']);
            $this->db->group_end();
        }
        
        if (!empty($filters['status'])) {
            $this->db->where('p.status_id', $filters['status']);
        }
        
        if (!empty($filters['departemen'])) {
            $this->db->where('p.departemen_id', $filters['departemen']);
        }
        
        if (!empty($filters['tanggal_dari'])) {
            $this->db->where('p.tanggal_apply >=', $filters['tanggal_dari']);
        }
        
        if (!empty($filters['tanggal_sampai'])) {
            $this->db->where('p.tanggal_apply <=', $filters['tanggal_sampai']);
        }
        
        $this->db->order_by('p.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_id($id) {
        $this->db->select('p.*, s.nama_status, d.nama_departemen, lj.nama_level, sr.nama_sumber');
        $this->db->from('pelamar p');
        $this->db->join('status s', 'p.status_id = s.id', 'left');
        $this->db->join('departemen d', 'p.departemen_id = d.id', 'left');
        $this->db->join('level_jabatan lj', 'p.level_jabatan_id = lj.id', 'left');
        $this->db->join('sumber sr', 'p.sumber_id = sr.id', 'left');
        $this->db->where('p.id', $id);
        return $this->db->get()->row();
    }

    public function insert($data) {
        return $this->db->insert('pelamar', $data);
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('pelamar', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('pelamar');
    }

    public function update_status($id, $status_id, $tanggal_mulai = null, $trainer_id = null, $emergency_name = null, $emergency_phone = null, $emergency_relation = null) {
        $data = array('status_id' => $status_id);
        
        if (in_array($status_id, array(6, 7, 8))) {
            $pelamar = $this->get_by_id($id);
            $jenis_training = '';
            $durasi = 14;
            
            if ($status_id == 6) {
                $jenis_training = 'BM';
            } elseif ($status_id == 7) {
                $jenis_training = 'SULAM';
            } elseif ($status_id == 8) {
                $jenis_training = 'HO';
                $durasi = 2;
            }
            
            $training_data = array(
                'pelamar_id' => $id,
                'jenis_training' => $jenis_training,
                'tanggal_mulai' => $tanggal_mulai,
                'tanggal_selesai' => tambah_hari($tanggal_mulai, $durasi),
                'durasi_hari' => $durasi
            );
            
            if ($trainer_id) {
                $training_data['trainer_id'] = $trainer_id;
            }
            
            if ($emergency_name) {
                $training_data['emergency_name'] = $emergency_name;
                $training_data['emergency_phone'] = $emergency_phone;
                $training_data['emergency_relation'] = $emergency_relation;
            }
            
            $this->db->insert('training', $training_data);
        }
        
        $this->db->where('id', $id);
        return $this->db->update('pelamar', $data);
    }

    public function get_count_by_status() {
        $this->db->select('s.nama_status, COUNT(p.id) as total');
        $this->db->from('status s');
        $this->db->join('pelamar p', 's.id = p.status_id', 'left');
        $this->db->group_by('s.id');
        return $this->db->get()->result();
    }
}