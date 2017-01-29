<?php

  class Report extends CI_Controller {
    public function __construct() {
      parent::__construct();
      $this->load->model('payment_model');
      $this->load->helper(array('form', 'url'));
      $this->load->library(array('session', 'form_validation'));

      if(empty($this->session->userdata['id'])){
        $this->session->set_userdata(array('access' => 'no'));
        redirect(base_url());
      }

      if($this->session->userdata('authentication') == 'employee'){
        $this->session->set_userdata(array('error' => "Access denied!"));
        redirect(base_url('student'));
      }

      $this->form_validation->set_error_delimiters('<label class="error">', '</label>');
    }

    public function index() {
      $data['tab'] = 'report';
      $data['title'] = 'Reports';

      $this->load->view('templates/header', $data);
      $this->load->view('reports/index', $data);
      $this->load->view('templates/footer', $data);
    }
  }

?>