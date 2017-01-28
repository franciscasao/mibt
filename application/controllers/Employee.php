<?php

  class Employee extends CI_Controller {
    public function __construct() {
      parent::__construct();
      $this->load->model('employee_model');
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
      $data['tab'] = 'employee';
      $data['title'] = 'Employee | List';

      $data['employee'] = $this->employee_model->get_employee();

      $this->load->view('templates/header', $data);
      $this->load->view('employee/list', $data);
      $this->load->view('templates/footer', $data);
    }

    public function view($id) {
      $data['tab'] = 'employee';
      $data['title'] = 'Employee | Profile';
      $data['employee'] = $this->employee_model->get_employee(substr($id, 1));

      $this->load->view('templates/header', $data);
      $this->load->view('employee/view', $data);
      $this->load->view('templates/footer', $data);
    }

    public function new_employee() {
      $data['tab'] = 'employee';
      $data['title'] = 'Employee | New';
      $data['new_id'] = $this->employee_model->new_id();
      $data['position'] = $this->employee_model->get_position();

      $this->form_validation->set_rules('fname', 'first name', 'required');
      $this->form_validation->set_rules('mname', 'middle name', 'required');
      $this->form_validation->set_rules('lname', 'last name', 'required');
      $this->form_validation->set_rules('birthday', 'birthday', 'required');
      $this->form_validation->set_rules('address', 'complete address', 'required');
      $this->form_validation->set_rules('email', 'email address', 'required');
      $this->form_validation->set_rules('gender', 'gender', 'required');
      $this->form_validation->set_rules('position', 'position', 'required');
      $this->form_validation->set_rules('salary', 'salary', 'required');

      if($this->form_validation->run() === FALSE) {
        $this->load->view('templates/header', $data);
        $this->load->view('employee/new', $data);
        $this->load->view('templates/footer');
      } else {
        // echo $this->employee_model->create();
        if($this->employee_model->create())
          $this->session->set_userdata(array('message' => "A new employee has been added!"));
        else
          $this->session->set_userdata(array('message' => "There was an error in adding a new job. Kindly refer this to the administrator."));

        redirect(base_url('employee'), 'location');
      }
    }

    public function edit($id) {
      $data['tab'] = 'employee';
      $data['title'] = 'Employee | Edit';
      $data['employee'] = $this->employee_model->get_employee(substr($id, 1));
      $data['job'] = $this->employee_model->get_position();

      $this->form_validation->set_rules('fname', 'first name', 'required');
      $this->form_validation->set_rules('mname', 'middle name', 'required');
      $this->form_validation->set_rules('lname', 'last name', 'required');
      $this->form_validation->set_rules('birthday', 'birthday', 'required');
      $this->form_validation->set_rules('address', 'complete address', 'required');
      $this->form_validation->set_rules('email', 'email address', 'required');
      $this->form_validation->set_rules('gender', 'gender', 'required');
      $this->form_validation->set_rules('position', 'position', 'required');
      $this->form_validation->set_rules('salary', 'salary', 'required');

      if($this->form_validation->run() === FALSE) {
        $this->load->view('templates/header', $data);
        $this->load->view('employee/edit', $data);
        $this->load->view('templates/footer');
      } else {
        // echo $this->employee_model->update();
        if($this->employee_model->update())
          $this->session->set_userdata(array('message' => "The employee has bee updated!"));
        else
          $this->session->set_userdata(array('message' => "There was an error in updating the employee. Kindly refer this to the administrator."));

        redirect(base_url('employee'), 'location');
      }
    }

    public function delete() {
      // echo $this->employee_model->delete();
      if($this->employee_model->delete())
        $this->session->set_userdata(array('message' => "The employee has been deleted."));
      else
        $this->session->set_userdata(array('message' => "There was an error in deleting the employee. Kindly refer this to the administrator."));

      redirect(base_url('employee'));
    }
  }

?>