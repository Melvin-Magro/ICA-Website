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


     public function sign_in()
     {
          $data = array(
              'page_title'    => 'Login',
              'form_action'   => 'sign_in/submit',
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

     # This function is used to check for login errors
    public function sign_in_check()
    {
        # 1. Check the form for validation errors
        if ($this->fv->run('Sign_In') === FALSE)
        {
            echo validation_errors();
            return;
        }

        #2. Retrieve the data for checking
        $email     = $this->input->post('email');
        $password  = $this->input->post('password');

        #3. Use the System model to verify the password
        # This avoid exposing information
        $check = $this->system->check_password($email, $password);

        #4. If check came back as false, the password is wrong
        if ($check === FALSE)
        {
            echo "The email and password don't match.";
            return;
        }

        #5. Retrieve the information from the database
        $code = bin2hex($this->encryption->create_key(16));

        #6. Try to log in
        $data = $this->system->set_login_data($check, $code);

        #7. Stops the code if there is any errors
        if ($data === FALSE)
        {
            echo "Sorry, we were unable to log you in";
            return;
        }

        #8. We'll check back in an hour
        $data['refresh'] = time() + 60 * 60;

        #9. Write everything to CodeIgiter's cookies
        $this->session->set_userdata($data);

        #10. Redirect home
        redirect('/');

    }

    # The logout page
  public function logout()
  {
      # 1. Remove the login data from the database
      $data = $this->session->userdata;
      $this->system->delete_session($data['id'], $data['session_code']);

      # 2. Remove the information from the session.
      $this->session->unset_userdata(array(
          'id', 'email', 'name', 'surname', 'session_code'
      ));

      # 3. Take the user home
      redirect('/');

  }

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
                    'content'       => 'Register'
                )
            )
        );

        $this->load->view('form', $data);
	}

    public function register_submit()
    {
        # 1. Check the form for validation errors
        //var_dump($this->fv->run('register')); return;
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

 }
