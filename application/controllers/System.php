<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System extends MY_Controller { //changing the name of welcome to website

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



     public function register()
	{
        $data = array(
            'page_title'    => 'Register',
            'form_action'   => 'register/submit',
            'form'          => array(
                'Name'          => array(
                    'type'          => 'text',
                    'placeholder'   => 'Joseph',
                    'name'          => 'name',
                    'id'            => 'input-name'
                ),
                'Surname'       => array(
                    'type'          => 'text',
                    'placeholder'   => 'Borg',
                    'name'          => 'surname',
                    'id'            => 'input-surname'
                ),
                'Email'         => array(
                    'type'          => 'email',
                    'placeholder'   => 'me@example.com',
                    'name'          => 'email',
                    'id'            => 'input-email'
                ),
                'Password'      => array(
                    'type'          => 'password',
                    'placeholder'   => 'password',
                    'name'          => 'password',
                    'id'            => 'input-password'
                ),
            ),
            'buttons'       => array(
                'submit'        => array(
                    'type'          => 'submit',
                    'content'       => 'Log In'
                )
            )
        );

        $this->load->view('form', $data);
	}

    public function register_submit()
    {
        # 1. Check the form for validation errors
        if ($this->fv->run('register') === FALSE)
        {
            echo validation_errors();
            return;
        }

        # 2. Retrieve the first set of data
        $email      = $this->input->post('email');
        $password   = $this->input->post('password');

        # 3. Generate a random keyword for added protection
        # Since the encrypted key is in binary, we should change it to a hex string (0-9, a-f)
        $salt       = bin2hex($this->encryption->create_key(8));

        # 3. Add them to the database, and retrieve the ID
        $id = $this->system->add_user($email, $password, $salt);

        # 4. If the ID didn't register, we can't continue.
        if ($id === FALSE)
        {
            echo "We couldn't register the user because of a database error.";
            return;
        }

        # 5. Retrieve the next data
        $name       = $this->input->post('name');
        $surname    = $this->input->post('surname');

        # 6. Add the details to the next table
        $check = $this->system->user_details($id, $name, $surname);

        # 7. If the query failed, delete the user to avoid partial data.
        if ($check === FALSE)
        {
            $this->system->delete_user($id);
            echo "We couldn't register the user because of a database error.";
            return;
        }

        # 8. Everything is fine, return to the home page.
        redirect('/');
    }

    public function Sign_In()
 	{
         $data = array(
             'page_title'    => 'Login',
             'form_action'   => 'login/submit',
             'form'          => array(
                 'Email'         => array(
                     'type'          => 'email',
                     'placeholder'   => 'me@example.com',
                     'name'          => 'email',
                     'id'            => 'input-email'
                 ),
                 'Password'      => array(
                     'type'          => 'password',
                     'placeholder'   => 'password',
                     'name'          => 'password',
                     'id'            => 'input-password'
                 )
             ),
             'buttons'       => array(
                 'submit'        => array(
                     'type'          => 'submit',
                     'content'       => 'Log In'
                 )
             )
         );

         $this->load->view('form', $data);
 	}
 }
