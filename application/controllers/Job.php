<?php

  class Job extends CI_Controller {
    public function __construct() {
      parent::__construct();
      $this->load->model('job_model');
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
    }

    public function index() {
      $data['tab'] = 'job';
      $data['title'] = 'Job | List';
      $data['job'] = $this->job_model->get_job();

      $this->load->view('templates/header', $data);
      $this->load->view('job/list', $data);
      $this->load->view('templates/footer', $data);
    }

    public function new_job() {
      $data['tab'] = 'job';
      $data['title'] = 'Job | New';
      $data['rank'] = $this->job_model->get_rank();

      $this->form_validation->set_rules('title', 'job title', 'required');
      $this->form_validation->set_rules('rank', 'heirarchy', 'required');
      $this->form_validation->set_rules('salary', 'salary', 'required');

      if($this->form_validation->run() === FALSE) {
        $this->load->view('templates/header', $data);
        $this->load->view('job/new', $data);
        $this->load->view('templates/footer');
      } else {
        // echo $this->job_model->insert_job();
        if($this->job_model->insert_job())
          $this->session->set_userdata(array('message' => "A new job position has been successfully opened."));
        else
          $this->session->set_userdata(array('message' => "There was an error in adding a new job. Kindly refer this to the administrator."));

        redirect(base_url('job'), 'location');
      }
    }

    public function view_job($id) {
      $data['tab'] = 'job';
      $data['title'] = 'Job | More Details';
      $data['job'] = $this->job_model->get_job($id);
      $data['employee'] = $this->job_model->get_employee($id);

      $this->load->view('templates/header', $data);
      $this->load->view('job/view', $data);
      $this->load->view('templates/footer', $data);
    }

    public function edit($id) {
      $data['tab'] = 'job';
      $data['title'] = 'Job | Edit';
      $data['job'] = $this->job_model->get_job($id);
      $data['rank'] = $this->job_model->get_rank();

      $this->form_validation->set_rules('title', 'job title', 'required');
      $this->form_validation->set_rules('rank', 'heirarchy', 'required');
      $this->form_validation->set_rules('salary', 'salary', 'required');

      if($this->form_validation->run() === FALSE) {
        $this->load->view('templates/header', $data);
        $this->load->view('job/edit', $data);
        $this->load->view('templates/footer');
      } else {
        if($this->job_model->update_job())
          $this->session->set_userdata(array('message' => "The job position has been successfully udpated."));
        else
          $this->session->set_userdata(array('message' => "There was an error in updating the job. Kindly refer this to the administrator."));

        redirect(base_url('job'), 'location');
      }
    }

    public function delete() {
      if($this->job_model->delete())
        $this->session->set_userdata(array('message' => "Success! The job has been archived."));
      else
        $this->session->set_userdata(array('message' => "There was an error in archiving the job. Kindly refer this to the administrator."));

      redirect(base_url('job'));
    }
  }

?>