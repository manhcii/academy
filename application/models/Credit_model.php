<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Credit_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get($id = null) {
        $this->db->select()->from('section_credits');
        if ($id != null) {
            $this->db->where('section_credits.id', $id);
        } else {
            $this->db->order_by('section_credits.id');
        }
        
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }
    
    public function getStudentsInCredit($id = null) {
        $this->db->select('students.*')->from('section_credits');
        $this->db->join('section_credits_students', 'section_credits_students.section_credit_id = section_credits.id');
        $this->db->join('students', 'students.id = section_credits_students.student_id');
        if ($id != null) {
            $this->db->where('section_credits.id', $id);
        } else {
            $this->db->order_by('section_credits.id');
        }
        
        $query = $this->db->get();
        if ($id != null) {
            return $query->result_array();
        } else {
            return $query->result_array();
        }
    }
    
    public function addStudent($data)
    {
        foreach ($data['students'] as $student) {
            $data = [
                'section_credit_id' => $data['section_credit_id'],
                'student_id'        => $student,
                // 'session_id'        => $data['session_id']
            ];
            $this->db->insert('section_credits_students', $data);
            $subjectid_query = $this->db->select('subject_id')->from('section_credit_subjects')->where('section_credit_id', $data['section_credit_id'])->get();
            
            if ($subjectid_query->num_rows() > 0) {
                $subjectid = $subjectid_query->row()->subject_id;
            
                // Cập nhật status
                $this->db->set('status', 1)
                         ->where('student_id', $student)
                         ->where('subject_id', $subjectid)
                         ->update('subject_students');
            }
            
        }
    }
    
    public function getByID($id = null)
    {
        $this->db->select()->from('section_credits');
        if ($id != null) {
            $this->db->where('section_credits.id', $id);
        } else {
            $this->db->order_by('section_credits.id');
        }
        
        $query = $this->db->get();
        
        if ($id != null) {
            $vehicle_routes = $query->result_array();
            $array = array();
            if (!empty($vehicle_routes)) {
                foreach ($vehicle_routes as $vehicle_key => $vehicle_value) {
                    $vec_route                  = new stdClass();
                    $vec_route->id              = $vehicle_value['id'];
                    $vec_route->route_id        = $vehicle_value['section_credit_name'];
                    $vec_route->section_code    = $vehicle_value['section_credit_code'];
                    $vec_route->vehicles        = $this->getVechileByRoute($vehicle_value['id']);
                    $array[]                    = $vec_route;
                }
            }
            return $array;
        } else {
            $vehicle_routes = $query->result_array();
            $array          = array();
            if (!empty($vehicle_routes)) {
                foreach ($vehicle_routes as $vehicle_key => $vehicle_value) {
                    $vec_route                      = new stdClass();
                    $vec_route->id                  = $vehicle_value['id'];
                    $vec_route->section_credit_name = $vehicle_value['section_credit_name'];
                    $vec_route->section_credit_code = $vehicle_value['section_credit_code'];
                    $vec_route->vehicles            = $this->getVechileByRoute($vehicle_value['id']);
                    $array[]                        = $vec_route;
                }
            }
            return $array;
        }
    }
    
    public function getVechileByRoute($route_id)
    {
        $this->db->select('section_credit_subjects.id as section_credit_subject_id,section_credit_subjects.subject_id,section_credit_subjects.section_credit_id,subjects.*')->from('section_credit_subjects');
        $this->db->join('subjects', 'subjects.id = section_credit_subjects.subject_id	');
        $this->db->where('section_credit_subjects.section_credit_id', $route_id);
        $this->db->order_by('section_credit_subjects.id', 'asc');
        $query                 = $this->db->get();
        return $vehicle_routes = $query->result();
    }

    public function remove($id) {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->where('id', $id);
        $this->db->delete('section_credits');
        $message = DELETE_RECORD_CONSTANT . " On section credits id " . $id;
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
    
    public function removeStudent($id, $idStudent) {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->where('student_id', $idStudent);
        $this->db->where('section_credit_id', $id);
        $this->db->delete('section_credits_students');
        $message = DELETE_RECORD_CONSTANT . " On section credits student id " . $idStudent. " credit ". $id;
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
 
    public function getClassCreditBySection($classid) {
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
    
    public function getClassCreditBySubject($subjectid) {
        $userdata = $this->customlib->getUserData();
        $role_id = $userdata["role_id"];
        $carray = array();

        // if (isset($role_id) && ($userdata["role_id"] == 2) && ($userdata["class_teacher"] == "yes")) {

            // $section = $this->teacher_model->get_teacherrestricted_modesections($userdata["id"], $classid);
        // } else {
            $this->db->select('section_credit_subjects.id,section_credit_subjects.subject_id,section_credits.section_credit_name');
            $this->db->from('section_credit_subjects');
            $this->db->join('section_credits', 'section_credits.id = section_credit_subjects.section_credit_id');
            $this->db->where('section_credit_subjects.subject_id', $subjectid);
            $this->db->order_by('section_credits.id');
            $query = $this->db->get();
            $section = $query->result_array();
        // }

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


    public function add($data,$classes) {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('section_credits', $data);
            $message = UPDATE_RECORD_CONSTANT . " On section_credits id " . $data['id'];
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
            $this->db->insert('section_credits', $data);
            $id = $this->db->insert_id();
            $message = INSERT_RECORD_CONSTANT . " On section_credits id " . $id;
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
                'subject_id'                => $vec_value,
                'section_credit_id'         => $record_id,
            );

            $classes_array[] = $vehicle_array;
        }
        $this->db->insert_batch('section_credit_subjects', $classes_array);
    }
    public function update($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('section_credits', $data);
        }
    }
    public function getSectionCreditTeacher()
    {
        $query = $this->db->query('SELECT class_credit_teacher.*,section_credits.section_credit_name,subjects.name,section_credits.supervisory_inspection,section_credits.academic_advisor,section_credits.technical_support FROM `class_credit_teacher` INNER JOIN section_credits on section_credits.id=class_credit_teacher.section_credit_id INNER JOIN subjects on subjects.id=class_credit_teacher.subject_id where class_credit_teacher.session_id="' . $this->current_session . '" GROUP BY class_credit_teacher.section_credit_id , class_credit_teacher.subject_id ORDER by length(section_credits.section_credit_name), section_credits.section_credit_name');
        $result = $query->result_array();
        return $result;
    }
}
