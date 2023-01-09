<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Status extends CI_Model
{
	function  __construct()
	{
		parent::__construct();

		//$this->load->database();
	}

	function insert($data)
	{
		$this->db->reconnect();
		$this->db->insert('task_queue', $data);
	}

	function update($session_id, $task, $status)
	{
		$data = array('task' => $task, 'status' => $status, 'reg_date' => date('Y-m-d H:i:s'));

		$this->db->reconnect();
		$this->db->update('task_queue', $data, array('session_id' => $session_id));
	}

	function select($session_id)
	{
		$this->db->reconnect();
		$query = $this->db->get_where('task_queue', array('session_id' => $session_id));

		return ($query->num_rows() > 0) ? $query->last_row() : FALSE;
	}

	function done($session_id, $status=5)
	{
		$data = array('status' => $status, 'reg_date' => date('Y-m-d H:i:s'));

		$this->db->reconnect();
		$this->db->update('task_queue', $data, array('session_id' => $session_id));
	}

	function graphs($session_id, $status=6)
	{
		$data = array('status' => $status, 'reg_date' => date('Y-m-d H:i:s'));

		$this->db->reconnect();
		$this->db->update('task_queue', $data, array('session_id' => $session_id));
	}
}
