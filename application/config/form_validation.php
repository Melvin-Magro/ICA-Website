<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(

    # Login rules
    'Sign_In'         => array(
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|valid_email'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required'
        )
    ),

    # The register form rules
    'register'      => array(
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required'
        ),
        array(
            'field' => 'surname',
            'label' => 'Surname',
            'rules' => 'required'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|valid_email|is_unique[tbl_users.email]'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required|min_length[8]|password_strength'
        )
    ),

    #Course upload form rules
    'upload_course'     => array(
            array(
				'field' => 'course_name',
				'label' => 'course name',
				'rules' => 'required|min_length[5]'
			),
            array(
				'field' => 'course_level',
				'label' => 'course level',
				'rules' => 'required|min_length[1]'
			),
        )
);
