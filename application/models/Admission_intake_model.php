<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Admission_intake_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    public function getAll($id = null)
    {
        $this->db->select()->from('admission_intake');
        if ($id != null) {
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('id');
        }
        $query = $this->db->get();
        if ($id != null) {
            $trainingsystemlist = $query->row_array();
        } else {
            $trainingsystemlist = $query->result_array();
        }

        return $trainingsystemlist;
    }

    public function get($id = null, $classteacher = null)
    {
         
        $this->db->select()->from('admission_intake');
        if ($id != null) {
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('id');
        }
        $query = $this->db->get();
        if ($id != null) {
            $trainingsystemlist = $query->row_array();
        } else {
            $trainingsystemlist = $query->result_array();
        }

        return $trainingsystemlist;
    }

    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($id)
    {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->where('id', $id);
        $this->db->delete('admission_intake'); //class record delete.
        $message   = DELETE_RECORD_CONSTANT . " On admission_intake id " . $id;
        $action    = "Delete";
        $record_id = $id;
        $this->log($message, $record_id, $action);
        //======================Code End==============================
        $this->db->trans_complete(); # Completing transaction
        /* Optional */
        if ($this->db->trans_status() === false) {
            # Something went wrong.
            $this->db->trans_rollback();
            return false;
        } else {
            //return $return_value;
        }
    }

    /**
     * This function will take the post data passed from the controller
     * If id is present, then it will do an update
     * else an insert. One function doing both add and edit.
     * @param $data
     */
    public function add($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('admission_intake', $data);
        } else {
            $this->db->insert('admission_intake', $data);
        }
    }

    public function check_data_exists($data)
    {
        $this->db->where('name', $data);

        $query = $this->db->get('admission_intake');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

}
