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
    			'courses'		=> $this->course_model->all_courses(2),
                'can_delete'    => $this->has_permission('CAN_DELETE')
    		);

            $this->build('course_list', $data);
        }
	}

	public function technical()
	{
        {
            $this->load->model('course_model');

            $data = array(
    			'courses'		=> $this->course_model->all_courses(4),
                'can_delete'    => $this->has_permission('CAN_DELETE')
    		);

            $this->build('course_list', $data);
        }
	}

    public function university()
	{
        {
            $this->load->model('course_model');
            //var_dump($this->session->userdata); exit;

            $data = array(
    			'courses'		=> $this->course_model->all_courses(6),
                'can_delete'    => $this->has_permission('CAN_DELETE')
    		);

            $this->build('course_list', $data);
        }
	}

    public function part_time()
	{
        {
            $this->load->model('course_model');

            $data = array(
    			'courses'		=> $this->course_model->all_courses(1),
                'can_delete'    => $this->has_permission('CAN_DELETE')
    		);

            $this->build('course_list', $data);
        }
	}

    public function delete($id)
    {
        // if ('CAN_DELETE') // Ask sir about this
        // {
        //     show_404();
        // }

        $this->load->model('course_model');
        $this->course_model->delete_course($id);

        redirect('http://icawebsite.local/#courses');
    }

    public function edit($id = NULL)
    {
        if ($id == 'submit') {
            $this->edit_submit();
            return;
        }

        $this->load->model('course_model');
        $user = $this->course_model->get_course($id);

        if ($user == NULL)
        {
            show_404();
            return;
        }

        $this->load->helper('form');

        $data = array(
            'properties'       => array(
                'page_title'    => 'Edit Course',
                'action'       => 'courses/edit/submit',
                'hidden'       => array('user_id'   => $user['id'])
            ),

            'form'      => $this->user_form($user)
        );

        $this->load->view('course_form', $data);

    }

    public function edit_submit()
    {
        //load the form validation library
		$this->load->library('form_validation');

		// load the users_model
		$this->load->model('course_model');

		//set the rules for each input
		//array(); -> empty array
		//for the edit, it will depend on the inputs being filled in
		$rules = array();

		$course_name = $this->input->post('course_name');
		if (!empty($course_name)) {
            $rules[] = array( //this is so if no changes have been made, data will remain the same. in the square brackets we have number of array (0,1,2 etc)
                'field' => 'course_name',
				'label' => 'course name',
				'rules' => 'required|min_length[5]'
			);
		}

        $course_level = $this->input->post('course_level');
		if (!empty($name)) {
            $rules[] = array(
                'field' => 'course_level',
				'label' => 'course level',
				'rules' => 'required|min_length[1]'
			);
		}

		$id = $this->input->post('user_id');

		//set the rules
		$this->form_validation->set_rules($rules);

		//check the form for validation errors
		if ($this->form_validation->run() === FALSE) {
			$this->edit($id);
			return;
		}

		//reload the page
		if (!$this->course_model->update_course($id, $course_name, $course_level)) {
			$this->form_validation->set_error('form', 'The course could not be updated.');
			$this->edit($id);
			return;

	}

	$this->edit($id);
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
            'page_title'    => 'Upload Course',
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
				'course_name'		=> NULL,
				'course_level'		=> NULL
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
