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

        # checks the password provided by the user
    public function check_password($email, $password)
    {
        $info = $this->db->select('id, password, u_salt')
                    ->where('email', $email)
                    ->get('tbl_users')
                    ->row_array();
        $checkstr = strrev($info['u_salt']).$password;

        return
        password_verify($checkstr, $info['password']) ? $info['id'] : FALSE;

    }

    #Writes the login data and retrieve the user's information
    public function set_login_data($id, $code)
    {
        #1. write the login informtation or stop the code here
        if (!$this->persist($id, $code))
        {
            return FALSE;
        }

        return $this->db->select('tbl_users.id,
                            tbl_users.email AS email,
                            tbl_user_details.u_name AS name,
                            tbl_user_details.u_surname AS surname,
                            tbl_login_info.u_persistence AS session_code')
                        ->join('tbl_user_details', 'tbl_user_details.user_id = tbl_users.id', 'left')
                        ->join('tbl_login_info', 'tbl_login_info.user_id = tbl_users.id', 'left')
                        ->where('tbl_users.id', $id)
                        ->get('tbl_users')
                        ->row_array();

    }

    #Writes the login information to the database
    public function persist($id, $code)
    {
        $data = array(
            'user_id'       => $id,
            'u_login_time'  => time(),
            'u_persistence' => $code
        );

        $this->db->insert('tbl_login_info', $data);
        return $this->db->affected_rows() == 1;
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
