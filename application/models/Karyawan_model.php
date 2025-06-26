<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan_model extends CI_Model {

    public function get_all($filters = array()) {
        $this->db->select('k.*, d.nama_departemen, lj.nama_level');
        $this->db->from('karyawan k');
        $this->db->join('departemen d', 'k.departemen_id = d.id', 'left');
        $this->db->join('level_jabatan lj', 'k.level_jabatan_id = lj.id', 'left');
        
        if (!empty($filters['search'])) {
            $this->db->group_start();
            $this->db->like('k.nama_lengkap', $filters['search']);
            $this->db->or_like('k.no_hp', $filters['search']);
            $this->db->or_like('k.email', $filters['search']);
            $this->db->group_end();
        }
        
        if (!empty($filters['departemen'])) {
            $this->db->where('k.departemen_id', $filters['departemen']);
        }
        
        if (!empty($filters['status_karyawan'])) {
            $this->db->where('k.status_karyawan', $filters['status_karyawan']);
        }
        
        if (!empty($filters['status_penempatan'])) {
            $this->db->where('k.status_penempatan', $filters['status_penempatan']);
        }
        
        if (!empty($filters['tanggal_dari'])) {
            $this->db->where('k.tanggal_masuk >=', $filters['tanggal_dari']);
        }
        
        if (!empty($filters['tanggal_sampai'])) {
            $this->db->where('k.tanggal_masuk <=', $filters['tanggal_sampai']);
        }
        
        $this->db->order_by('k.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_id($id) {
        $this->db->select('k.*, d.nama_departemen, lj.nama_level');
        $this->db->from('karyawan k');
        $this->db->join('departemen d', 'k.departemen_id = d.id', 'left');
        $this->db->join('level_jabatan lj', 'k.level_jabatan_id = lj.id', 'left');
        $this->db->where('k.id', $id);
        return $this->db->get()->row();
    }

    public function insert($data) {
        return $this->db->insert('karyawan', $data);
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('karyawan', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('karyawan');
    }

    public function get_aktif_count() {
        $this->db->where('status_karyawan', 'AKTIF');
        return $this->db->count_all_results('karyawan');
    }

    public function get_count_by_departemen() {
        $this->db->select('d.nama_departemen, COUNT(k.id) as total');
        $this->db->from('departemen d');
        $this->db->join('karyawan k', 'd.id = k.departemen_id AND k.status_karyawan = "AKTIF"', 'left');
        $this->db->group_by('d.id');
        return $this->db->get()->result();
    }
}