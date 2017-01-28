<?php
  class Payment_model extends CI_Model {
    public function __construct() {
      $this->load->database();
    }

    public function get_payment($month, $year) {
      $this->db->select('payment.id, date_recorded, student_id, student.first_name, student.last_name, amount, employee_id');
      $this->db->from('payment');
      $this->db->join('student', 'student.id = payment.student_id');
      $this->db->where('date_recorded >=', $year.'-'.$month.'-01');
      $this->db->where('date_recorded <=', $year.'-'.$month.'-31');
      $this->db->order_by('date_recorded', 'DESC');

      $query = $this->db->get();
      return $query->result_array();
    }

    public function get_payment_by_id($id, $date = NULL) {
      $this->db->select('*');
      $this->db->from('payment');

      $data['id'] = $id;
      if(!is_null($date))
        $data['date_recorded'] = $date;

      $this->db->where($data);

      $query = $this->db->get();
      return $query->row_array();
    }

    public function get_year($latest = FALSE) {
      if($latest)
        $this->db->select_max('DATE_FORMAT(date_recorded, "%Y")', 'year');
      else
        $this->db->select('DATE_FORMAT(date_recorded, "%Y") AS "year", MAX(DATE_FORMAT(date_recorded, "%m")) AS "max_month"');
      $this->db->from('payment');
      $this->db->order_by('year', 'DESC');

      if(!$latest)
        $this->db->group_by('DATE_FORMAT(date_recorded, "%Y")');

      $query = $this->db->get();
      return $query->result_array();
    }

    public function get_month($year, $latest = FALSE) {
      if(empty($year))
        $year = 'default';
      if($latest)
        $this->db->select_max('DATE_FORMAT(date_recorded, "%m")', 'month');
      else
        $this->db->select('DISTINCT DATE_FORMAT(date_recorded, "%m") AS "month", DATE_FORMAT(date_recorded, "%M") as "month_name"');
      $this->db->from('payment');
      $this->db->where('DATE_FORMAT(date_recorded, "%Y") LIKE', $year);
      $this->db->order_by('month', 'ASC');

      $query = $this->db->get();
      return $query->result_array();
    }

    public function insert_payment() {
      $data = array(
        'id' => uniqid(),
        'date_recorded' => date('Y-m-d'),
        'amount' => $this->input->post('payment'),
        'employee_id' => $this->session->userdata('id'),
        'student_id' => substr($this->input->post('id'), 1)
      );

      // return $this->db->set($data)->get_compiled_insert('payment');
      return $this->db->insert('payment', $data);
    }

    public function update_payment() {
      $this->db->reset_query();

      $data = array(
        'id' => uniqid(),
        'date_recorded' => $this->input->post('enrollment_date'),
        'employee_id' => $this->session->userdata('id'),
        'amount' => $this->input->post('payment'),
        'student_id' => substr($this->input->post('id'), 1)
      );

      if( !empty( $this->input->post('payment_id') ) ) { // update
        $id = $this->input->post('payment_id');
        $data = array('amount' => $this->input->post('payment'));
      }

      if(!empty($this->input->post('payment_id'))) {
        $this->db->where('id', $id);
        return $this->db->update('payment', $data);
      } else
        return $this->db->insert('payment', $data);
    }

    public function delete() {
      $this->db->reset_query();

      return $this->db->delete('payment', array('id' => $this->input->post('id')));
    }
  }
?>