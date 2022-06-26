<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Login extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();

			$this->data["header"] = $this->load->view('style/header', '', true);
			$this->data["sidebar"] = $this->load->view('style/sidebar', '', true);
			$this->data["footer"] = $this->load->view('style/footer', '', true);
			$this->data["js"] = $this->load->view('style/js', '', true);
			$this->data["navbar"] = $this->load->view('style/navbar', '', true);
		}

		public function index()
		{
			$this->load->view('login', $this->data);
		}
	}
?>
