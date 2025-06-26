<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Dashboard_model');
    }

    public function index() {
        // Get trainer filter from GET parameter
        $trainer_id = $this->input->get('trainer_id') ?: 'all';
        
        // Original stats for cards
        $data['stats'] = $this->Dashboard_model->get_stats();
        
        // New trainer-based chart data
        $chart_data = $this->Dashboard_model->get_trainer_chart_data($trainer_id);
        $data['trainer_chart_labels'] = json_encode(['Interview', 'PHK', 'Resign', 'Failed', 'Store']);
        $data['trainer_chart_data'] = json_encode(array_values($chart_data));
        
        // Trainer statistics
        $data['trainer_stats'] = $this->Dashboard_model->get_trainer_statistics($trainer_id);
        
        // Trainers list for dropdown
        $data['trainers'] = $this->Dashboard_model->get_all_trainers();
        $data['selected_trainer'] = $trainer_id;
        
        // Total trainers count
        $data['total_trainers'] = $this->Dashboard_model->get_total_trainers();
        
        // Recent pelamar (optional, commented out in view)
        $data['recent_pelamar'] = $this->Dashboard_model->get_recent_pelamar();
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/footer');
    }
}