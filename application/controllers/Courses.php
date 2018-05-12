<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses extends MY_Controller { //changing the name of welcome to website

	# The constructor class
   function __construct()
   {
       parent::__construct();

       $this->load->library(array('form_validation' => 'fv'));
   }

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
	 */




	public function index() //TO HIDE CONTROL YOU REMOVE INDEX FILE
	{
		$this->load->model('users_model');

		$data = array(
			'users'		=> $this->users_model->all_users(),
			'courses'	=> $this->users_model->all_courses()
		);

		$this->build('welcome_message', $data);

	}

	// public function view($name) //TO HIDE CONTROL YOU REMOVE INDEX FILE
	// {
	//
	// 	switch ($name)
	// 	{
	// 		case 'foundation':
	// 			$this->foundation_courses();
	// 			break;
	//
	// 		default:
	// 			show_404();
	// 			break;
	// 	}
	// }

	public function foundation()
	{
        {
            $this->load->model('course_model');

            $data = array(
    			'courses'		=> $this->course_model->all_courses(2)
    		);

            $this->build('course_list', $data);
        }
	}

	public function technical()
	{
        {
            $this->load->model('course_model');

            $data = array(
    			'courses'		=> $this->course_model->all_courses(4)
    		);

            $this->build('course_list', $data);
        }
	}

    public function university()
	{
        {
            $this->load->model('course_model');

            $data = array(
    			'courses'		=> $this->course_model->all_courses(6)
    		);

            $this->build('course_list', $data);
        }
	}

	public function upload_course($submit = FALSE)
	{
	if ($submit == 'submit') {
        $this->course_submit();
        return;
	    }

		// load the form helper to get the function isndie the file otherwise known as a plugin
		$this->load->helper('form');
		// this array will contain all the inputs we will need
		$data = array(
			'properties'	=> array(
				'action'	=> 'courses/upload_course/submit',
				'hidden'	=> NULL
			),

			'form' => $this->user_form()
		);
		//the page itself
		$this->load->view('course_form', $data);
	}

	private function user_form($user = NULL) {

		//if no information was provided, to BE SAFE
		//create an empty reference
		if ($user == NULL) {
			$user = array (
				'email'		=> NULL,
				'name'		=> NULL,
				'surname'	=> NULL,
				'mobile_no'	=> NULL
			);
		}

		return array(
			'Course Name' => array(
				'type' 					=> 'text',
				'name' 					=> 'course_name',
				'placeholder'			 => 'Ex. Interactive Media',
				'id' 					=> 'course-name'
			),
			'Course Level' => array(
				'type' 				=> 'number',
				'name' 				=> 'course_level',
				'placeholder' 		=> 'Ex. 4',
				'id' 				=> 'course-level'
			)
		);
	}

	private function course_submit()
	{
		if ($this->fv->run('upload_course') === FALSE)
        {
            echo validation_errors();
            return;
        }

		$course_name         = $this->input->post('course_name');
        $course_level        = $this->input->post('course_level');

		// loads the users_model file to use its functions
        $this->load->model('course_model');

        $this->course_model->add_course($course_name, $course_level);

        redirect('courses/upload_course');

	}

}
