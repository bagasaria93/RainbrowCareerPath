<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Level_jabatan_model extends CI_Model {

    public function get_all() {
        $this->db->order_by('nama_level', 'ASC');
        return $this->db->get('level_jabatan')->result();
    }

    public function get_by_id($id) {
        $this->db->where('id', $id);
        return $this->db->get('level_jabatan')->row();
    }

    public function insert($data) {
        return $this->db->insert('level_jabatan', $data);
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('level_jabatan', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('level_jabatan');
    }
}