<?php

  class Student extends CI_Controller {
    public function __construct() {
      parent::__construct();
      $this->load->model('student_model');
      $this->load->helper(array('form', 'url'));
      $this->load->library(array('session', 'form_validation'));

      $this->form_validation->set_error_delimiters('<label class="error">', '</label>');

      if(empty($this->session->userdata['id'])){
        $this->session->set_userdata(array('access' => 'no'));
        redirect(base_url());
      }
    }

    public function index($message = NULL) {
      $data['tab'] = 'student';
      $data['title'] = 'Student | List';
      $data['message'] = $message;
      $data['student'] = $this->student_model->get_student();

      $this->load->view('templates/header', $data);
      $this->load->view('student/list', $data);
      $this->load->view('templates/footer', $data);
    }

    public function view($id) {
      $data['tab'] = 'student';
      $data['title'] = 'Student | Profile';

      $id = substr($id, 1);
      $data['student_id'] = $id;
      $data['student'] = $this->student_model->get_student($id);
      $data['payment'] = $this->student_model->get_payment($id, NULL);
      $data['balance'] = $this->student_model->get_balance($id);

      $this->load->view('templates/header', $data);
      $this->load->view('student/view', $data);
      $this->load->view('templates/footer');
    }

    public function new_student() {
      $this->load->model('course_model');
      $this->load->model('payment_model');

      $data['tab'] = 'student';
      $data['title'] = 'Student | New';
      $data['max_id'] = $this->student_model->new_id();

      $this->form_validation->set_rules('fname', 'first name', 'required');
      $this->form_validation->set_rules('lname', 'last name', 'required');
      $this->form_validation->set_rules('birthday', 'birthdate', 'required');
      $this->form_validation->set_rules('gender', 'gender', 'required');
      $this->form_validation->set_rules('type', 'type', 'required');
      $this->form_validation->set_rules('course', 'course', 'required');
      $this->form_validation->set_rules('address', 'address', 'required');

      $this->form_validation->set_rules('emergency_name', 'emergency contact name', 'required');
      $this->form_validation->set_rules('emergency_number', 'emergency contact number', 'required');
      $this->form_validation->set_rules('emergency_relation', 'emergency contact relation', 'required');

      $data['course'] = $this->course_model->get_course();
      if(empty($data['course'])){
        $this->session->set_userdata(array('error' => "There are no courses a new student can enroll to. Add a new course first."));
        redirect(base_url('course/new'), 'location');
      }

      if($this->form_validation->run() === FALSE) {
        $this->load->view('templates/header', $data);
        $this->load->view('student/new', $data);
        $this->load->view('templates/footer');
      } else {
        if($this->student_model->insert_student()) {
          if(!empty($this->input->post('payment'))) {
            if($this->payment_model->insert_payment())
              $this->session->set_userdata(array('message' => "A new student has been successfully added!"));
            else
              $this->session->set_userdata(array('message' => "There was an error in enrolling the new student. Kindly refer this to the administrator."));
          } else {
            $this->session->set_userdata(array('message' => "A new student has been successfully added!"));
          }
        } else {
          $this->session->set_userdata(array('message' => "There was an error in enrolling the new student. Kindly refer this to the administrator."));
        }

        redirect(base_url('student'), 'location');
      }
    }

    public function edit_student($id) {      
      $this->load->model('course_model');
      $this->load->model('payment_model');

      if(empty($id))
        redirect(base_url('student/new'));

      $id = substr($id, 1);
      $data['tab'] = 'student';
      $data['title'] = 'Student | Edit';
      $data['student'] = $this->student_model->get_student($id);
      $data['course'] = $this->course_model->get_course();
      $data['payment'] = $this->student_model->get_payment($id, $data['student']['enrollment_date']);
      $data['balance'] = $this->student_model->get_balance($id);

      $this->form_validation->set_rules('fname', 'first name', 'required');
      $this->form_validation->set_rules('lname', 'last name', 'required');
      $this->form_validation->set_rules('birthday', 'birthdate', 'required');
      $this->form_validation->set_rules('gender', 'gender', 'required');
      $this->form_validation->set_rules('type', 'type', 'required');
      $this->form_validation->set_rules('course', 'course', 'required');
      $this->form_validation->set_rules('address', 'address', 'required');

      $this->form_validation->set_rules('emergency_name', 'emergency contact name', 'required');
      $this->form_validation->set_rules('emergency_number', 'emergency contact number', 'required');
      $this->form_validation->set_rules('emergency_relation', 'emergency contact relation', 'required');

      if($this->form_validation->run() === FALSE) {
        $this->load->view('templates/header', $data);
        $this->load->view('student/edit', $data);
        $this->load->view('templates/footer');
      } else {
        // echo $this->payment_model->update_payment();
        if($this->student_model->update_student()) {
          if(!empty($this->input->post('payment'))) {
            if($this->payment_model->update_payment())
              $this->session->set_userdata(array('message' => "The student has been successfully updated!"));
            else
              $this->session->set_userdata(array('message' => "There was an error in updating the student. Kindly refer this to the administrator."));
          } else {
            $this->session->set_userdata(array('message' => "The student has been successfully updated!"));
          }
        } else {
          $this->session->set_userdata(array('message' => "There was an error in updating the student. Kindly refer this to the administrator."));
        }

        redirect(base_url('student'));
      }
    }

    public function delete_student() {
      if($this->session->userdata('authentication') == 'employee'){
        $this->session->set_userdata(array('error' => "Access denied!"));
        redirect(base_url('student'));
      }

      if($this->student_model->delete())
        $this->session->set_userdata(array('message' => "You have successfully deleted the student."));
      else
        $this->session->set_userdata(array('error' => "There was an error in deleting the student. Kindly refer this to the administrator."));

      redirect(base_url('student'));
    }
  }

?>