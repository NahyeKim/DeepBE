<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller
{
	function  __construct()
	{
		parent::__construct();

		$this->load->helper('url');
	}

	function index()
	{
		$this->load->view('home');
	}

	function home()
	{
		redirect('/');
	}

	function help()
	{
		$this->load->view('help');
	}

	function about()
	{
		$this->load->view('about');
	}

	function description()
	{
		$this->load->view('description');
	}

	function user($session_id)
	{
		$target_dir = "data/$session_id/";
		$index_page = base_url();

		if(file_exists($target_dir))
		{
			$this->load->view('status', array('session_id' => $session_id));	
		}
		else
		{
			echo "<script type='text/javascript'>alert('The requested session does not exist.'); window.location.replace('$index_page')</script>";
		}
	}
}
