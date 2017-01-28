<?php
  class Job_model extends CI_Model {
    public function __construct() {
      $this->load->database();
    }

    public function new_id() {
      $this->db->select_max('id');
      $query = $this->db->get('employee');
      $id = $query->row()->id;

      if(substr($id, 0, 4) == date('Y'))
        return $id + 1;
      else
        return date("Y")."10001";
    }

    public function get_job($id = NULL) {
      if(is_null($id))
        $this->db->select('job.id, job.title, job.rank, job.salary, COUNT(employee.id) AS "count"');
      else
        $this->db->select('*');

      $this->db->from('job');

      if(is_null($id)) {
        $this->db->join('employee', 'employee.job_id = job.id', 'left');
        $this->db->group_by('job.id');
      }

      if(!is_null($id))
        $this->db->where('id', $id);

      $this->db->order_by('rank', 'ASC');

      $query = $this->db->get();

      if(is_null($id))
        return $query->result_array();
      else
        return $query->row_array();
    }

    public function get_rank() {
      $this->db->select('rank');
      $this->db->distinct();
      $this->db->from('job');
      $this->db->order_by('rank', 'ASC');

      $query = $this->db->get();
      return $query->result_array();
    }

    public function insert_job() {
      $data = array(
        'id' => uniqid(),
        'title' => ucwords($this->input->post('title')),
        'rank' => $this->input->post('rank'),
        'salary' => $this->input->post('salary')
      );

      // return $this->db->set($data)->get_compiled_insert('job');
      return $this->db->insert('job', $data);
    }

    public function update_job() {
      $this->db->reset_query();

      $data = array(
        'title' => ucwords($this->input->post('title')),
        'rank' => $this->input->post('rank'),
        'salary' => $this->input->post('salary')
      );

      $this->db->where('id', $this->input->post('id'));
      return $this->db->update('job', $data);
      // return $this->db->set($data)->get_compiled_update('job');
    }


    public function delete() {
     return $this->db->delete('job', array('id' => $this->input->post('id')));
    }
  }

?>