<?php
defined('BASEPATH') OR exit('No direct script access allowed');

# A config file always has a $config variable.

$config['permissions'] = array(
    'admin'     => array(
        'REGISTER'                  => TRUE,
        'UPLOAD_COURSE'             => TRUE,
        'CAN_DELETE'                => TRUE
    ),

    'user' => array(
        'REGISTER'                  => FALSE,
        'UPLOAD_COURSE'             => FALSE,
        'CAN_DELETE'                => FALSE
    )
);
