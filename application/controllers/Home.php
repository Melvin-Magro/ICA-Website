<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller { //changing the name of welcome to website

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 *///TO HIDE CONTROL YOU REMOVE INDEX FILE




	public function index()
	{

		$this->build('welcome_message');

	}

	public function success()
	{
		echo "You are logged in :)";
	}

	# THIS IS THE NAVIGATION EXAMPLE! :D
		function nav()
		{
			# if we're using hard-coded navs, we need the perms
			$role = strtolower($this->session->userdata('role'));

			$data = array(
				'nav'			=> $this->nav_links(),
				# The below is for hardcoded nav links
				'permissions'	=> $this->config->item('permissions')[$role]
			);

			$this->load->view('nav_page', $data);
		}
}
