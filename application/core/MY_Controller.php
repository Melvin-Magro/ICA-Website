<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	// this will load right before the
	// controllers we have in controllers/

	// magic method
	// is called/used when the class loads
	function __construct() {

		// REQUIRED
		// load the parent into its child
		// will add the plugins from autoload
		parent::__construct();
		$this->can_access();
		$this->config->load('permissions');

	}

	// We can use this to replace $this->load->view
	function build($pages = NULL, $data = NULL) {

		$nav = array(
			'shrink'	=> $this->router->class == 'home',

		);

		$footer = array(
			'nav'		=> $this->nav_links()
		);

		$this->load->view('templates/start');
		$this->load->view('templates/nav', $nav);
		$this->load->view($pages, $data);
		$this->load->view('templates/end', $footer);

	}

	# Can the user access this page?
	private function can_access()
	{

		#Use CodeIgniter's router to get the controller/page
		$cont = $this->router->class;
		$page = $this->router->method;

		$check = $this->check_login();

		#check for every page I have to be logged in/out
		if ($check && $cont == 'system')
		{
				switch ($page)
				{
					case 'logout':
					case 'register':
					case 'register_submit':
							break;
					default:
							redirect('http://icawebsite.local');
				}
		}
		else if (!$check)
		{
			if (($cont == 'system' && ($page == 'logout' || $page == 'register')))
			{
				redirect('http://icawebsite.local');
			}
		}
	}

# Check if the user is logged in
    protected function check_login()
    {
        # 1. Get the current session data into a variable.
        $data = $this->session->userdata;

        # 2. Stop here if there is no session data
        if (!array_key_exists('session_code', $data))
        {
            return FALSE;
        }

        # 3. If there is no refresh data or an hour has passed
        # check the login data.
        if (!array_key_exists('refresh', $data) || $data['refresh'] < time())
        {
            if ($this->system->check_data($data['id'], $data['email'], $data['session_code']))
            {
                $data['refresh'] = time() + 60 * 60;
                return TRUE;
            }

            return FALSE;
        }

        # We don't have to check the data
        return TRUE;

    }

# Manually check that the user has access to this page
  protected function has_permission($p_name)
  {

      # 1. Stop here if $p_name is a number
      if (is_int($p_name)) return FALSE;

      # 2. Retrieve the information we need
      $p_name = strtoupper($p_name);
      $role = strtolower($this->session->userdata('role'));
      $permissions = $this->config->item('permissions')[$role];


      # 3. check that the permission item actually exists
      if (!array_key_exists($p_name, $permissions)) return FALSE;
      return $permissions[$p_name];


  }

	// Use an associative array for the navigation

	function nav_links() {

		$nav1 = array(
				"Home"				=> "#page-top",
				"About"				=> "#about",
				"Courses"			=> "#courses",
				"Portfolio"		=> "#portfolio",
				"Contact"			=> "#contact",
		);

		$nav2 = array(
				"Foundation College"				=> "foundation",
				"Technical College"					=> "technical",
				"University College"				=> "university",
				"Part-Time Courses"					=> "part_time"
		);

		$nav3 = array();

		if ($this->check_login() && $this->has_permission('REGISTER', 'UPLOAD_COURSE'))
		{
			$nav3['Register']						= 'register';
			$nav3['Upload Course']			= 'upload_course';
		}
		if ($this->check_login())
		{
			$nav3['Logout']			= 'system/logout';
		}
		else
		{
			$nav3['Login']			= 'sign_in';
		}

		return [$nav1, $nav2, $nav3];

	}


}
