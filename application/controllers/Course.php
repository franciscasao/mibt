<?php

  class Course extends CI_Controller {
    public function __construct() {
      parent::__construct();
      $this->load->model('course_model');
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
      $data['tab'] = 'course';
      $data['title'] = 'Course | List';
      $data['course'] = $this->course_model->get_course();

      $this->load->view('templates/header', $data);
      $this->load->view('course/list', $data);
      $this->load->view('templates/footer', $data);
    }

    public function new_course() {
      $data['tab'] = 'course';
      $data['title'] = 'Course | New';

      $this->form_validation->set_rules(
        'course_code', 'Course Code', 
        'required|is_unique[course.id]',
        array(
          'required' => 'Please provide the %s.',
          'is_unique' => 'This %s already exists.'
        )
      );
      $this->form_validation->set_rules('course_name', 'Course Name', 'required', array('required' => 'Please provide the %s.'));
      $this->form_validation->set_rules('tuition_fee', 'Tuition Fee', 'required', array('required' => 'Please provide the %s.'));

      if($this->form_validation->run() === FALSE) {
        $this->load->view('templates/header', $data);
        $this->load->view('course/new', $data);
        $this->load->view('templates/footer', $data);
      } else {
        if($this->course_model->insert_course())
          $this->session->set_userdata(array('message' => "A new course has been successfully added!"));
        
        redirect(base_url('course'), 'location');
      }
    }

    public function view($id) {
      $data['tab'] = 'course';
      $data['title'] = 'Course | Details';
      $data['course'] = $this->course_model->get_course($id);
      $data['student'] = $this->course_model->get_student($id);
      $data['count'] = $this->course_model->get_student_count($id);

      $this->load->view('templates/header', $data);
      $this->load->view('course/view', $data);
      $this->load->view('templates/footer', $data);
    }

    public function edit($id) {
      $data['tab'] = 'course';
      $data['title'] = 'Course | Details';
      $data['course'] = $this->course_model->get_course($id);

      $this->form_validation->set_rules('course_code', 'Course Code', 'required', array('required' => 'Please provide the %s.'));
      $this->form_validation->set_rules('course_name', 'Course Name', 'required', array('required' => 'Please provide the %s.'));
      $this->form_validation->set_rules('tuition_fee', 'Tuition Fee', 'required', array('required' => 'Please provide the %s.'));

      if($this->form_validation->run() === FALSE) {

        $this->load->view('templates/header', $data);
        $this->load->view('course/edit', $data);
        $this->load->view('templates/footer', $data);
      } else {
        if($this->course_model->update_course())
          $this->session->set_userdata(array('message' => "The course has been successfully updated!"));
        
        redirect(base_url('course'), 'location');
      }
    }

    public function delete_course() {
      if($this->course_model->delete())
        $this->session->set_userdata(array('message' => "The course has been successfully deleted!"));

      redirect(base_url('course'), 'location');
    }
  }

?>