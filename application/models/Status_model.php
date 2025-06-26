<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status_model extends CI_Model {

    public function get_all() {
        $this->db->order_by('id', 'ASC');
        return $this->db->get('status')->result();
    }

    public function get_by_id($id) {
        $this->db->where('id', $id);
        return $this->db->get('status')->row();
    }

    public function insert($data) {
        return $this->db->insert('status', $data);
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('status', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('status');
    }
}