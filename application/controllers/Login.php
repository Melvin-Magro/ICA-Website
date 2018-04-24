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

     function userlogin()
     {
         $data['title'] = 'Login Form';
         $this->load->view("login", $data);
     }

     function login_validation()
     {
         $this->load->library('form_validation');
         $this->form_validation->set_rules('email', 'Email', 'required');
         $this->form_validation->set_rules('password', 'Password', 'required');
         //checks to see if it was successful in running the form. If not,
         //leaves the user in login page.
         if ($this->form_validation->run())
         {
             $email = $this->input->post('email');
             $password = $this->input->post('password');

             $this->load->model('users_model');
             if ($this->users_model->can_login($email, $password))
             {
                 $session_data = array(
                     'email'    => $email
                 );
                 $this->session->set_userdata($session_data);
                 redirect(base_url() . 'index.php?/Login/enter');
             }
             else
             {
                $this->session->set_flashdata('error', 'Invalid Email and/or Password');
                redirect(base_url() . 'index.php?/Login/userlogin');
             }
         }
         else
         {
             $this->userlogin();
         }
     }

     function enter()
     {
         if ($this->session->userdata('email') != '')
         {
             echo '<h2>Welcome - '.$this->session->userdata('email'). '<h2>';
             echo '<a href="'.base_url().'index.php?/Login/logout">Logout</a>';
         }

         else
         {
             redirect(base_url() . 'index.php?/Login/userlogin');
         }
     }

     function logout()
     {
         $this->session->unset_userdata('email');
         redirect(base_url() . 'index.php?/Login/userlogin');
     }
 }
