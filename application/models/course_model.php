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

    #NOBODY TOUCH THIS PLS GHAX TGHIDXK KEMM DOMT NIDGHI PLS TNX - LOVE REJXIL XOXOXOOX
	public function all_courses($level = NULL) {

		// these lines are preparing the
		// query to be run.
		$this->db->select('*')
				 ->order_by('course_level', 'asc');

        if ($level == 1)
        {
            $this->db->where('course_level', 1);
        }
        else if ($level == 2)
        {
            $this->db->where('course_level <=', 3);
        }
        else if ($level == 4)
        {
            $this->db->where('course_level', 4);
        }
        else if ($level == 6)
        {
            $this->db->where('course_level >=', 5);
        }


		// run the query using the parameters
		// above and below.
		return $this->db->get('tbl_course');

	}

    // public function all_courses() {
    //
	// 	// these lines are preparing the
	// 	// query to be run.
	// 	$this->db->select('*')
    //              ->where('course_level', 6)
	// 			 ->order_by('course_name', 'asc');
    //
	// 	return $this->db->get('tbl_course');
    //
	// }

    public function delete_course($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_course');
    }

    public function get_course($id) {

        //run a query and return the row immediately
        return $this->db->select('*')
                ->where('id', $id)
                ->get('tbl_course')
                ->row_array();
    }

    public function update_course($id, $course_name, $course_level) {

            if ($this->check_course($id, $course_name, $course_level)) {
                return TRUE;
            }

            //this is the data that needs to change
            $data = array();

            if (!empty($course_name)) $data['course_name'] = $course_name;
            if (!empty($course_level)) $data['course_level'] = $course_level;

        //this is the entire update query
        $this->db->where('id', $id)
                ->update('tbl_course', $data);

        //TRUE or FALSE if there has been a change
        return $this->db->affected_rows() == 1;

    }

    public function check_course($id, $course_name, $course_level) {

            //this is the data that needs to change
            $data = array('id' => $id);
            if (!empty($course_name)) $data['course_name'] = $course_name;
            if (!empty($course_level)) $data['course_level'] = $course_level;


        //TRUE or FALSE if there has been a change
        return $this->db->get_where('tbl_course', $data)->num_rows() == 1;

    }

}
