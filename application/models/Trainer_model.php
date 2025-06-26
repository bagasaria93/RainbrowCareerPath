<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trainer_model extends CI_Model {

    public function get_all($filters = array()) {
        $this->db->select('t.*, d.nama_departemen');
        $this->db->from('trainer t');
        $this->db->join('departemen d', 't.departemen_id = d.id', 'left');
        
        if (!empty($filters['search'])) {
            $this->db->group_start();
            $this->db->like('t.nama_trainer', $filters['search']);
            $this->db->or_like('t.no_hp', $filters['search']);
            $this->db->or_like('t.email', $filters['search']);
            $this->db->group_end();
        }
        
        if (!empty($filters['departemen'])) {
            $this->db->where('t.departemen_id', $filters['departemen']);
        }
        
        $this->db->order_by('t.nama_trainer', 'ASC');
        return $this->db->get()->result();
    }

    public function get_by_id($id) {
        $this->db->select('t.*, d.nama_departemen');
        $this->db->from('trainer t');
        $this->db->join('departemen d', 't.departemen_id = d.id', 'left');
        $this->db->where('t.id', $id);
        return $this->db->get()->row();
    }

    public function insert($data) {
        return $this->db->insert('trainer', $data);
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('trainer', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('trainer');
    }
}