<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_Model extends CI_Model {

    # Register a user into the first table
    public function add_user($email, $password, $salt)
    {

        $data = array(
            'email'       => $email,
            'password'    => password_hash($salt.$password, CRYPT_BLOWFISH),
            'u_salt'        => strrev($salt)
        );

        $this->db->insert('tbl_users', $data);

        return $this->db->insert_id();
    }


    # Checks the user details table for unchanged/existing data
    public function check_user_details($id, $name, $surname)
    {

        $data = array(
            'user_id'       => $id,
            'u_name'        => $name,
            'u_surname'     => $surname
        );

        return $this->db->get_where('tbl_user_details', $data)->num_rows() == 1;
    }


    # Deletes a user from the database
    public function delete_user($id)
    {
        $this->db->delete('tbl_users', array('id' => $id));
    }

    # Associate user details with the login data
    public function user_details($id, $name, $surname)
    {
        if ($this->check_user_details($id, $name, $surname))
        {
            return TRUE;
        }

        $data = array(
            'user_id'       => $id,
            'u_name'        => $name,
            'u_surname'     => $surname,
            'u_creation'    => time()
        );

        $this->db->insert('tbl_user_details', $data);

        return $this->db->affected_rows() == 1;
    }
}
