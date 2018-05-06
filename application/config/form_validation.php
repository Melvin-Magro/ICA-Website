<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(

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
    )
);
