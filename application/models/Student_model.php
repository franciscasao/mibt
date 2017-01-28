<?php
  class Student_model extends CI_Model {
    public function __construct() {
      $this->load->database();
    }

    public function get_student($id = NULL) {
      if(is_null($id))
        $this->db->select('student.id, first_name, last_name, type, course_name');
      else
        $this->db->select('student.id, first_name, last_name, middle_name, birthday, gender, type, enrollment_date, discount_given, course_name, address, email, emergency_contact_no, emergency_contact_name, emergency_contact_relation');

      $this->db->from('student');
      $this->db->join('course', 'course.id = student.course_id');
      $this->db->order_by('student.id', 'ASC');

      if(!is_null($id))
        $this->db->where('student.id', $id);

      $query = $this->db->get();

      if(is_null($id))
        return $query->result_array();
      else
        return $query->row_array();
    }

    public function new_id() {
      $this->db->select_max('id');
      $query = $this->db->get('student');
      $id = $query->row()->id;

      if(substr($id, 0, 4) == date('Y'))
        return $id + 1;
      else
        return date("Y")."10001";
    }

    public function get_payment($id, $date_recorded) {
      $this->db->select("id, date_recorded, amount, employee_id");
      $this->db->from('payment');

      $data['student_id'] = $id;
      if(!empty($date_recorded)) 
        $data['date_recorded'] = $date_recorded;

      $this->db->where($data);
      $this->db->order_by('date_recorded', 'DESC');

      $query = $this->db->get();

      if(empty($date_recorded))
        return $query->result_array();
      else
        return $query->row_array();
    }

    public function get_tuition_fee($id) {
      $this->db->select('tuition_fee');
      $this->db->from('course');
      $this->db->where('id', $id);
      $query = $this->db->get();

      return doubleval($query->row()->tuition_fee);
    }

    public function get_balance($id) {
      $this->db->select('discount_given, course_id');
      $this->db->from('student');
      $this->db->where('id', $id);
      $query = $this->db->get();
      $discount_given = doubleval($query->row()->discount_given);

      $balance = $this->get_tuition_fee($query->row()->course_id);

      if(!empty($query->row()->discount_given))
        $balance = $balance - $discount_given;

      $this->db->select_sum('amount');
      // $this->db->from('payment');
      $this->db->where('student_id', $id);
      $this->db->group_by('student_id');

      if($this->db->count_all_results('payment', FALSE) > 0) {
        $query = $this->db->get();
        $balance = $balance - $query->row()->amount;
      }

      return $balance;
    }

    public function insert_student() {
      $data = array(
        'id' => substr($this->input->post('id'), 1),
        'first_name' => ucwords($this->input->post('fname')),
        'middle_name' => ucwords($this->input->post('mname')),
        'last_name' => ucwords($this->input->post('lname')),
        'type' => ucwords($this->input->post('type')),
        'birthday' => $this->input->post('birthday'),
        'gender' => ucwords($this->input->post('gender')),
        'discount_given' => $this->input->post('discount'),
        'enrollment_date' => date('Y-m-d'),
        'course_id' => $this->input->post('course'),
        'email' => $this->input->post('email'),
        'address' => ucwords($this->input->post('address')),
        'emergency_contact_name' => ucwords($this->input->post('emergency_name')),
        'emergency_contact_no' => $this->input->post('emergency_number'),
        'emergency_contact_relation' => $this->input->post('emergency_relation')
      );

      // return $this->db->set($data)->get_compiled_insert('students');
      return $this->db->insert('student', $data);
    }

    public function delete() {
      $id = substr($this->input->post('id'), 1);
      if($this->db->delete('payment', array('student_id' => $id)))
       return $this->db->delete('student', array('id' => $id));
    }

    public function update_student() {
      $this->db->reset_query();
      
      $id = substr($this->input->post('id'), 1);
      $data = array(
        'first_name' => ucwords($this->input->post('fname')),
        'middle_name' => ucwords($this->input->post('mname')),
        'last_name' => ucwords($this->input->post('lname')),
        'type' => ucwords($this->input->post('type')),
        'birthday' => $this->input->post('birthday'),
        'gender' => ucwords($this->input->post('gender')),
        'discount_given' => $this->input->post('discount'),
        'enrollment_date' => $this->input->post('enrollment_date'),
        'course_id' => $this->input->post('course'),
        'email' => $this->input->post('email'),
        'address' => ucwords($this->input->post('address')),
        'emergency_contact_name' => ucwords($this->input->post('emergency_name')),
        'emergency_contact_no' => $this->input->post('emergency_number'),
        'emergency_contact_relation' => $this->input->post('emergency_relation')
      );

      $this->db->where('id', $id);
      return $this->db->update('student', $data);
      // return $this->db->set($data)->get_compiled_update('student');
    }
  }
?>