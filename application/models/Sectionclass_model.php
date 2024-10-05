<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sectionclass_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get($id = null) {
        $this->db->select()->from('section_classes');
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
        $this->db->select()->from('section_classes');
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
                    $vec_route->subject = $this->getSubjectByRoute($vehicle_value['id']);
                    $vec_route->teacher = $this->getTeacherByRoute($vehicle_value['id']);
                    $vec_route->section_class_code = $vehicle_value['section_class_code'];
                    $vec_route->training_system = $vehicle_value['training_system'];
                    $vec_route->section_class_date_start = $vehicle_value['section_class_date_start'];
                    $vec_route->section_class_date_end = $vehicle_value['section_class_date_end'];
                    $vec_route->created_at = $vehicle_value['created_at'];
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
                    $vec_route->subject = $this->getSubjectByRoute($vehicle_value['id']);
                    $vec_route->teacher = $this->getTeacherByRoute($vehicle_value['id']);
                    $vec_route->section_class_code = $vehicle_value['section_class_code'];
                    $vec_route->training_system = $vehicle_value['training_system'];
                    $vec_route->section_class_date_start = $vehicle_value['section_class_date_start'];
                    $vec_route->section_class_date_end = $vehicle_value['section_class_date_end'];
                    $vec_route->created_at = $vehicle_value['created_at'];
                    $array[]             = $vec_route;
                }
            }
            return $array;
        }
    }
    
    public function getSubjectByRoute($route_id)
    {
        $this->db->select('subject_section_classes.id as subject_class_section_id,subject_section_classes.subject_id,subject_section_classes.sectionclass_id,subjects.*')->from('subject_section_classes');
        $this->db->join('subjects', 'subjects.id = subject_section_classes.subject_id');
        $this->db->where('subject_section_classes.sectionclass_id', $route_id);
        $this->db->order_by('subject_section_classes.id', 'asc');
        $query                 = $this->db->get();
        return $vehicle_routes = $query->row();
    }
    
    public function getTeacherByRoute($route_id)
    {
        $this->db->select('section_class_teacher.id as section_class_teacher_id,section_class_teacher.staff_id,section_class_teacher.subject_id,section_class_teacher.subject_id,staff.name,staff.surname')->from('section_class_teacher');
        $this->db->join('staff', 'staff.id = section_class_teacher.staff_id');
        $this->db->where('section_class_teacher.sectionclass_id', $route_id);
        $this->db->order_by('section_class_teacher.id', 'asc');
        $query                 = $this->db->get();
        return $vehicle_routes = $query->row();
    }

    public function remove($id) {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->where('id', $id);
        $this->db->delete('section_classes');
        $message = DELETE_RECORD_CONSTANT . " On section_classes id " . $id;
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
 
    public function getClassBySection($classid) {
        $userdata = $this->customlib->getUserData();
        $role_id = $userdata["role_id"];
        $carray = array();

        if (isset($role_id) && ($userdata["role_id"] == 2) && ($userdata["class_teacher"] == "yes")) {

            $section = $this->teacher_model->get_teacherrestricted_modesections($userdata["id"], $classid);
        } else {
            $this->db->select('class_sections.id,class_sections.section_id,sections.section');
            $this->db->from('class_sections');
            $this->db->join('sections', 'sections.id = class_sections.section_id');
            $this->db->where('class_sections.class_id', $classid);
            $this->db->order_by('class_sections.id');
            $query = $this->db->get();
            $section = $query->result_array();
        }

        return $section;
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


    public function add($data,$subject) {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('section_classes', $data);
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
            $this->db->insert('section_classes', $data);
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
        $subject_section_classes_array = array();
        $vehicle_array = array(
            'subject_id'   => $subject,
            'sectionclass_id' => $record_id,
        );
        $subject_section_classes_array[] = $vehicle_array;
        $this->db->insert_batch('subject_section_classes', $subject_section_classes_array);
        return $record_id;
    }
    public function update($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('sections', $data);
        }
    }
}
