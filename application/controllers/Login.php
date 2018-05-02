<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller { //changing the name of welcome to website

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

         $this->load->view('login', $data);
 	}
 }
