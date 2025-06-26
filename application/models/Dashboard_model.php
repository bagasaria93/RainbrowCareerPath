<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    public function get_stats() {
        $stats = array();
        
        $stats['total_pelamar'] = $this->db->count_all('pelamar');
        
        $this->db->where('status_id', 5);
        $stats['interview'] = $this->db->count_all_results('pelamar');
        
        $this->db->where('status_id', 6);
        $stats['training_bm'] = $this->db->count_all_results('pelamar');
        
        $this->db->where('status_id', 7);
        $stats['training_sulam'] = $this->db->count_all_results('pelamar');
        
        $this->db->where('status_id', 10);
        $stats['store_bm'] = $this->db->count_all_results('pelamar');
        
        $this->db->where('status_id', 11);
        $stats['store_sulam'] = $this->db->count_all_results('pelamar');
        
        $this->db->where('status_id', 9);
        $stats['head_office'] = $this->db->count_all_results('pelamar');
        
        $stats['trainer'] = $this->db->count_all('trainer');
        
        return $stats;
    }

    public function get_chart_status() {
        $this->db->select('s.nama_status, COUNT(p.id) as total');
        $this->db->from('status s');
        $this->db->join('pelamar p', 's.id = p.status_id', 'left');
        $this->db->group_by('s.id');
        $this->db->order_by('s.id', 'ASC');
        $query = $this->db->get();
        
        $result = $query->result();
        $labels = array();
        $data = array();
        
        foreach ($result as $row) {
            $labels[] = $row->nama_status;
            $data[] = (int)$row->total;
        }
        
        return array('labels' => $labels, 'data' => $data);
    }

    public function get_recent_pelamar($limit = 5) {
        $this->db->select('p.nama_lengkap, p.tanggal_apply, s.nama_status, s.warna');
        $this->db->from('pelamar p');
        $this->db->join('status s', 'p.status_id = s.id');
        $this->db->order_by('p.created_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }

    public function get_monthly_stats() {
        $this->db->select("DATE_FORMAT(tanggal_apply, '%Y-%m') as bulan, COUNT(*) as total");
        $this->db->from('pelamar');
        $this->db->where('tanggal_apply >=', date('Y-01-01'));
        $this->db->group_by('bulan');
        $this->db->order_by('bulan', 'ASC');
        return $this->db->get()->result();
    }

    // NEW METHODS FOR TRAINER-BASED STATISTICS

    public function get_all_trainers() {
        $this->db->select('id, nama_trainer');
        $this->db->from('trainer');
        $this->db->order_by('nama_trainer', 'ASC');
        return $this->db->get()->result();
    }

    public function get_trainer_chart_data($trainer_id = null) {
        // Base query
        $this->db->select('
            COUNT(CASE WHEN p.status_id = 5 THEN 1 END) as interview,
            COUNT(CASE WHEN p.status_id = 2 THEN 1 END) as phk,
            COUNT(CASE WHEN p.status_id = 3 THEN 1 END) as resign,
            COUNT(CASE WHEN p.status_id = 4 THEN 1 END) as failed,
            COUNT(CASE WHEN p.status_id IN (10, 11) THEN 1 END) as store
        ');
        $this->db->from('pelamar p');
        
        // Join with training table to get trainer info
        $this->db->join('training tr', 'p.id = tr.pelamar_id', 'left');
        
        // Filter by trainer if specified
        if ($trainer_id && $trainer_id != 'all') {
            $this->db->where('tr.trainer_id', $trainer_id);
        }
        
        $result = $this->db->get()->row();
        
        return array(
            'interview' => (int)$result->interview,
            'phk' => (int)$result->phk,
            'resign' => (int)$result->resign,
            'failed' => (int)$result->failed,
            'store' => (int)$result->store
        );
    }

    public function get_trainer_statistics($trainer_id = null) {
        $data = $this->get_trainer_chart_data($trainer_id);
        
        $total = $data['interview'] + $data['phk'] + $data['resign'] + $data['failed'] + $data['store'];
        $success = $data['store'];
        $failed_total = $data['phk'] + $data['resign'] + $data['failed'];
        
        $success_rate = $total > 0 ? round(($success / $total) * 100, 1) : 0;
        $failure_rate = $total > 0 ? round(($failed_total / $total) * 100, 1) : 0;
        
        return array(
            'total' => $total,
            'success' => $success,
            'failed_total' => $failed_total,
            'success_rate' => $success_rate,
            'failure_rate' => $failure_rate,
            'percentages' => array(
                'interview' => $total > 0 ? round(($data['interview'] / $total) * 100, 1) : 0,
                'phk' => $total > 0 ? round(($data['phk'] / $total) * 100, 1) : 0,
                'resign' => $total > 0 ? round(($data['resign'] / $total) * 100, 1) : 0,
                'failed' => $total > 0 ? round(($data['failed'] / $total) * 100, 1) : 0,
                'store' => $total > 0 ? round(($data['store'] / $total) * 100, 1) : 0
            )
        );
    }

    public function get_total_trainers() {
        return $this->db->count_all('trainer');
    }
}