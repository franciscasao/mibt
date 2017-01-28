<?php
  
  class User extends CI_Controller {
    public function __construct() {
      parent::__construct();
      $this->load->model('employee_model');

      $this->load->helper(array('form', 'url'));
      $this->load->library(array('session', 'form_validation'));
      $this->form_validation->set_error_delimiters('<label class="error">', '</label>');
    }

    public function index() {
      $id = $this->input->post('emp_id');
      $id = substr($id, 1);
      $password = $this->input->post('password');

      if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(empty($id) || empty($password)) {
          $data["error"] = "Please complete the fields below.";
          $this->load->view('login', $data);
        } else if(!$this->employee_model->check($id, $password)) {
          $data["error"] = "You have entered an invalid ID Number or password.";
          $this->load->view('login', $data);
        } else {
          $userdata = array(
            'id' => $id,
            'name' => $this->employee_model->get_name($id),
            'authentication' => $this->employee_model->get_authentication($id)
          );
          $this->session->set_userdata($userdata);
          redirect('student', 'location');
        }
      } else {
        if(!empty($this->session->userdata('access'))) {
          $data["error"] = "The page you are trying to access requires you to log in first.";
          $this->session->unset_userdata('access');
          $this->load->view('login', $data);
        } else {
          $this->load->view('login');
        }
      }
    }

    public function logout() {
      $this->session->sess_destroy();
      redirect(base_url());
    }

    public function user() {
      $data['tab'] = NULL;
      $data['title'] = 'User Profile';

      if(isset($_POST['update_info'])) {
        $this->form_validation->set_rules('fname', 'first name', 'required');
        $this->form_validation->set_rules('lname', 'last name', 'required');
        $this->form_validation->set_rules('birthday', 'birthdate', 'required');
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('contact_no', 'contact number', 'required');
        $this->form_validation->set_rules('address', 'complete address', 'required');

        if($this->form_validation->run() === TRUE) {
          if($this->employee_model->update_user())
            $this->session->set_userdata(array('message' => "Profile has been successfully updated"));
        }
      }

      if(isset($_POST['change_pass'])) {
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('new_password', 'new password', 'required');
        $this->form_validation->set_rules('confirm_password', 'password', 'required|matches[new_password]');

        if($this->form_validation->run() === TRUE) {
          if($this->employee_model->update_password())
            $this->session->set_userdata(array('message' => "Password has been successfully updated."));
          else
            $this->session->set_userdata(array('error' => "Invalid password."));
        }
      }

      $data['user'] = $this->employee_model->get_employee($this->session->userdata('id'));
      $this->load->view('templates/header', $data);
      $this->load->view('user', $data);
      $this->load->view('templates/footer', $data);

    }
  }

?>