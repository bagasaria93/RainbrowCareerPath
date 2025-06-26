<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departemen_model extends CI_Model {

    public function get_all() {
        $this->db->order_by('nama_departemen', 'ASC');
        return $this->db->get('departemen')->result();
    }

    public function get_by_id($id) {
        $this->db->where('id', $id);
        return $this->db->get('departemen')->row();
    }

    public function insert($data) {
        return $this->db->insert('departemen', $data);
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('departemen', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('departemen');
    }
}