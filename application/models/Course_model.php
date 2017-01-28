<?php

  class Course_model extends CI_Model {
    public function __construct() {
      $this->load->database();
    }

    public function get_course($id = NULL) {
      $this->db->select('*');
      $this->db->from('course');

      if(!is_null($id))
        $this->db->where('id', $id);

      $this->db->order_by('id', 'ASC');

      $query = $this->db->get();

      if(!is_null($id))
        return $query->row_array();
      else
        return $query->result_array();
    }

    public function get_student($id) {
      $this->db->select('student.id, first_name, last_name');
      $this->db->from('student');
      $this->db->join('course', 'course.id = student.course_id');
      $this->db->where('course_id', $id);
      $this->db->order_by('student.id', 'ASC');

      $query = $this->db->get();
      return $query->result_array();
    }

    public function get_student_count($id) {
      $this->db->from('student');
      $this->db->join('course', 'course.id = student.course_id');
      $this->db->where('course_id', $id);

      return $this->db->count_all_results();
    }

    public function insert_course() {
      $data = array(
        'id' => $this->input->post('course_code'),
        'course_name' => ucwords($this->input->post('course_name')),
        'tuition_fee' => $this->input->post('tuition_fee'),
      );

      return $this->db->insert('course', $data);
    }

    public function delete() {
      return $this->db->delete( 'course', array('id' => $this->input->post('id')) );
    }

    public function update_course() {
      $data = array(
        'id' => $this->input->post('course_code'),
        'course_name' => ucwords($this->input->post('course_name')),
        'tuition_fee' => $this->input->post('tuition_fee'),
      );

      $this->db->where('id', $this->input->post('course_code'));
      return $this->db->update('course', $data);
    }
  }

?>