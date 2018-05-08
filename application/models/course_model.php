<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course_Model extends CI_Model {


    public function add_course($course_name, $course_level) {

        $data = array(
            'course_name'     => $course_name,
            'course_level'      => $course_level
        );

        //An INSERT query:
        // INSERT INTO tbl_users (cols) VALUES (cols)
        $this->db->insert('tbl_course', $data);

        //gives us whatever the primary key with auto increment value is
        return $this->db->insert_id();

    }

	public function all_users() {

		// these lines are preparing the
		// query to be run.
		$this->db->select('*')
				 ->order_by('name', 'asc');

		// run the query using the parameters
		// above and below.
		return $this->db->get('tbl_course');

	}

}
