<?php
  class Employee_model extends CI_Model {
    public function __construct() {
      $this->load->database();
    }

    public function get_employee($id = NULL) {
      if(is_null($id))
        $this->db->select('employee.id, employee.first_name, employee.last_name, employee.email, employee.gender, job.title');
      else
        $this->db->select('employee.id, employee.first_name, employee.middle_name, employee.last_name, employee.email, employee.birthday, employee.gender, employee.address, employee.salary, employee.contact_no, employee.job_id, job.title');
      $this->db->from('employee');
      $this->db->join('job', 'job.id = employee.job_id');
      $this->db->order_by('job.rank', 'ASC');

      if(!is_null($id))
        $this->db->where('employee.id', $id);

      $query = $this->db->get();

      if(is_null($id))
        return $query->result_array();
      else
        return $query->row_array();
    }

    public function new_id() {
      $this->db->select_max('id');
      $this->db->not_like('id', '999999999');
      $query = $this->db->get('employee');
      $id = $query->row()->id;

      if(substr($id, 0, 4) == date('Y'))
        return $id + 1;
      else
        return date("Y")."10001";
    }

    public function get_name($id) {
      $this->db->select('first_name, last_name');
      $this->db->from('employee');
      $this->db->where('id', $id);
      $query = $this->db->get();

      $result = $query->row();
      return $result->first_name.' '.$result->last_name;
    }

    public function get_authentication($id) {
      $this->db->select('authentication');
      $this->db->from('employee');
      $this->db->where('id', $id);
      $query = $this->db->get();

      $result = $query->row();
      return $result->authentication;
    }

    public function check($id, $pass) {
      if(empty($pass) || empty($id))
        return FALSE;

      $this->db->select('id');
      $this->db->from('employee');
      $this->db->like('id', $id);

      if($this->db->count_all_results() == 0)
        return FALSE;
      else {
        $this->db->select('password');
        $this->db->from('employee');
        $this->db->where('id', $id);
        $query = $this->db->get();

        $result = $query->row();
        if(password_verify($pass, $result->password))
          return TRUE;
        else
          return FALSE;
      }
    }

    public function get_employee_by_job($job_id) {
      $this->db->select('id, first_name, last_name, date_employed');
      $this->db->from('employee');
      $this->db->where('position', $job_id);

      $query = $this->db->get();
      return $query->result_array();
    }

    public function get_position() {
      $this->db->select('id, title, salary');
      $this->db->from('job');
      $this->db->order_by('rank', 'DESC');

      $query = $this->db->get();
      return $query->result_array();
    }

    public function update_user() {
      $this->db->reset_query();
      
      $id = $this->session->userdata('id');
      $data = array(
        'first_name' => ucwords($this->input->post('fname')),
        'middle_name' => ucwords($this->input->post('mname')),
        'last_name' => ucwords($this->input->post('lname')),
        'birthday' => $this->input->post('birthday'),
        'email' => $this->input->post('email'),
        'contact_no' => substr($this->input->post('contact_no'), 1),
        'address' => $this->input->post('address')
      );

      $this->db->where('id', $id);
      return $this->db->update('employee', $data);
      // return $this->db->set($data)->get_compiled_update('employee');
    }

    public function update_password() {
      $this->db->reset_query();

      if($this->check($this->session->userdata('id'), $this->input->post('password'))){
        $data = array('password' => password_hash($this->input->post('new_password'), PASSWORD_DEFAULT));

        $this->db->where('id', $this->session->userdata('id'));
        return $this->db->update('employee', $data);
        // return $this->db->set($data)->get_compiled_update('employee');
      } else {
        return FALSE;
      }
    }

    public function create() {
      $data = array(
        'id' => substr($this->input->post('id'), 1),
        'first_name' => ucwords($this->input->post('fname')),
        'middle_name' => ucwords($this->input->post('mname')),
        'last_name' => ucwords($this->input->post('lname')),
        'birthday' => $this->input->post('birthday'),
        'contact_no' => $this->input->post('contact_no'),
        'email' => $this->input->post('email'),
        'gender' => ucwords($this->input->post('gender')),
        'job_id' => $this->input->post('position'),
        'salary' => $this->input->post('salary'),
        'address' => ucwords($this->input->post('address')),
        'authentication' => 'employee',
        'date_employed' => date('Y-m-d'),
        'archive' => FALSE,
        'password' => password_hash($this->input->post('birthday'), PASSWORD_DEFAULT),
      );

      // return $this->db->set($data)->get_compiled_insert('employee');
      return $this->db->insert('employee', $data);
    }

    public function update() {
      $data = array(
        'id' => substr($this->input->post('id'), 1),
        'first_name' => ucwords($this->input->post('fname')),
        'middle_name' => ucwords($this->input->post('mname')),
        'last_name' => ucwords($this->input->post('lname')),
        'birthday' => $this->input->post('birthday'),
        'contact_no' => $this->input->post('contact_no'),
        'email' => $this->input->post('email'),
        'gender' => ucwords($this->input->post('gender')),
        'job_id' => $this->input->post('position'),
        'salary' => $this->input->post('salary'),
        'address' => ucwords($this->input->post('address')),
      );

      $this->db->where('id', substr($this->input->post('id'), 1));
      return $this->db->update('employee', $data);
      // return $this->db->set($data)->get_compiled_update('employee');
    }

    public function delete() {
     return $this->db->delete('employee', array( 'id' => substr($this->input->post('id'), 1) ));
    }
  }

?>