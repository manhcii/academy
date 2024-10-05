<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Ward_model extends MY_Model
{

    public function get($id = null) {
        $this->db->select()->from('sections');
        if ($id != null) {
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('id');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }
    
    public function getByID($id = null)
    {
        $this->db->select()->from('sections');
        if ($id != null) {
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('id');
        }

        $query = $this->db->get();
        if ($id != null) {
            $vehicle_routes = $query->result_array();

            $array = array();
            if (!empty($vehicle_routes)) {
                foreach ($vehicle_routes as $vehicle_key => $vehicle_value) {
                    $vec_route     = new stdClass();
                    $vec_route->id = $vehicle_value['id'];
                    $vec_route->route_id = $vehicle_value['section'];
                    $vec_route->section_code = $vehicle_value['section_code'];
                    $vec_route->homeroom_teacher_id = $vehicle_value['homeroom_teacher_id'];
                    $vec_route->admission_intake_id = $vehicle_value['admission_intake_id'];
                    $vec_route->training_system_id = $vehicle_value['training_system_id'];
                    $vec_route->vehicles = $this->getVechileByRoute($vehicle_value['id']);
                    $array[]             = $vec_route;
                }
            }
            return $array;
        } else {
            $vehicle_routes = $query->result_array();
            $array          = array();
            if (!empty($vehicle_routes)) {
                foreach ($vehicle_routes as $vehicle_key => $vehicle_value) {
                    $vec_route        = new stdClass();
                    $vec_route->id    = $vehicle_value['id'];
                    $vec_route->section = $vehicle_value['section'];
                    $vec_route->section_code = $vehicle_value['section_code'];
                    $vec_route->admission_intake_id = $vehicle_value['admission_intake_id'];
                    $vec_route->training_system_id = $vehicle_value['training_system_id'];
                    $vec_route->homeroom_teacher_id = $vehicle_value['homeroom_teacher_id'];
                    $vec_route->vehicles = $this->getVechileByRoute($vehicle_value['id']);
                    $array[]             = $vec_route;
                }
            }
            return $array;
        }
    }
    
    public function getVechileByRoute($route_id)
    {
        $this->db->select('class_sections.id as class_section_id,class_sections.class_id,class_sections.section_id,classes.*')->from('class_sections');
        $this->db->join('classes', 'classes.id = class_sections.class_id');
        $this->db->where('class_sections.section_id', $route_id);
        $this->db->order_by('class_sections.id', 'asc');
        $query                 = $this->db->get();
        return $vehicle_routes = $query->result();
    }

    public function remove($id) {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->where('id', $id);
        $this->db->delete('sections');
        $message = DELETE_RECORD_CONSTANT . " On sections id " . $id;
        $action = "Delete";
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

    public function getClassBySectionAll($classid) {

        $this->db->select('class_sections.id,class_sections.section_id,sections.section');
        $this->db->from('class_sections');
        $this->db->join('sections', 'sections.id = class_sections.section_id');
        $this->db->where('class_sections.class_id', $classid);
        $this->db->order_by('class_sections.id');
        $query = $this->db->get();
        $section = $query->result_array();

        return $section;
    }
 
    public function getWardByDistrict($district_id) {
        $this->db->select('*');
        $this->db->from('wards');
        $this->db->where('wards.district_id', $district_id);
        $this->db->order_by('wards.ward_id');
        $query = $this->db->get();
        $wards = $query->result_array();
        return $wards;
    }

    public function getClassTeacherSection($classid) {

        $userdata = $this->customlib->getUserData();
        if (($userdata["role_id"] == 2)) {
            $id = $userdata["id"];
        
            $query = $this->db->select("class_teacher.section_id ")->join('sections', 'sections.id = class_teacher.section_id')->join('class_sections', 'sections.id = class_sections.section_id')->where(array('class_teacher.class_id' => $classid, 'class_teacher.staff_id' => $id))->group_by("class_teacher.section_id")->get("class_teacher");
            $result = $query->result_array();

            foreach ($result as $key => $value) {
                $query2 = $this->db->select('class_sections.id,sections.section')
                        ->join('sections', 'sections.id = class_sections.section_id')
                        ->where('sections.section_id', $value['section_id'])
                        ->get('class_sections');
                $result2 = $query2->row_array();
                $result[$key]['id'] = $result2['id'];
                $result[$key]['section'] = $result2['section'];
            }
            return $result;
        }
    }

    public function getSubjectTeacherSection($classid, $id) {

        $query = $this->db->select("class_sections.id,sections.section,class_sections.section_id")->join("class_sections", "teacher_subjects.class_section_id = class_sections.id")->join('sections', 'sections.id = class_sections.section_id')->where(array('class_sections.class_id' => $classid, 'teacher_subjects.teacher_id' => $id))->get("teacher_subjects");

        return $query->result_array();
    }

    public function getClassNameBySection($classid, $sectionid) {
        $this->db->select('class_sections.id,class_sections.section_id,sections.section,classes.class');
        $this->db->from('class_sections');
        $this->db->join('sections', 'sections.id = class_sections.section_id');
        $this->db->join('classes', 'classes.id = class_sections.class_id');
        $this->db->where('class_sections.class_id', $classid);
        $this->db->where('class_sections.section_id', $sectionid);
        $this->db->order_by('class_sections.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getClassAndSectionNameByClassIDSectionID($classid, $sectionid) {
        $this->db->select('class_sections.id,class_sections.section_id,sections.section,classes.class');
        $this->db->from('class_sections');
        $this->db->join('sections', 'sections.id = class_sections.section_id');
        $this->db->join('classes', 'classes.id = class_sections.class_id');
        $this->db->where('class_sections.class_id', $classid);
        $this->db->where('class_sections.section_id', $sectionid);
        $this->db->order_by('class_sections.id');
        $query = $this->db->get();
        return $query->row();
    }


    public function add($data,$classes) {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('sections', $data);
            $message = UPDATE_RECORD_CONSTANT . " On sections id " . $data['id'];
            $action = "Update";
            $record_id = $data['id'];
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
        } else {
            $this->db->insert('sections', $data);
            $id = $this->db->insert_id();
            $message = INSERT_RECORD_CONSTANT . " On sections id " . $id;
            $action = "Insert";
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
        $classes_array = array();
        foreach ($classes as $vec_key => $vec_value) {

            $vehicle_array = array(
                'class_id'   => $vec_value,
                'section_id' => $record_id,
            );

            $classes_array[] = $vehicle_array;
        }
        $this->db->insert_batch('class_sections', $classes_array);
    }
    public function update($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('sections', $data);
        }
    }
}
