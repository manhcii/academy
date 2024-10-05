<?php

class Classcreditteacher_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    public function getClassCreditTeacher($id = null)
    {

        if (!empty($id)) {
            $query = $this->db->select('staff.*,class_credit_teacher.id as ctid,class_credit_teacher.class_id,class_credit_teacher.section_id,classes.class,sections.section')->join("staff", "class_credit_teacher.staff_id = staff.id")->join("classes", "class_credit_teacher.class_id = classes.id")->join("sections", "class_credit_teacher.section_id = sections.id")->where("class_credit_teacher.id", $id)->get("class_credit_teacher");
            return $query->row_array();
        } else {
            $query = $this->db->select('staff.*,class_credit_teacher.id as ctid,classes.class,sections.section')->join("staff", "class_credit_teacher.staff_id = staff.id")->join("classes", "class_credit_teacher.class_id = classes.id")->join("sections", "class_credit_teacher.section_id = sections.id")->get("class_credit_teacher");
            return $query->row_array();
        }
    }

    public function addClassCreditTeacher($data)
    {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        if (isset($data["id"])) {
            $this->db->where("id", $data["id"])->update("class_credit_teacher", $data);
            $message   = UPDATE_RECORD_CONSTANT . " On  class teacher id " . $data["id"];
            $action    = "Update";
            $record_id = $data["id"];
            $this->log($message, $record_id, $action);
        } else {
            $this->db->insert("class_credit_teacher", $data);
            $id        = $this->db->insert_id();
            $message   = INSERT_RECORD_CONSTANT . " On class teacher id " . $id;
            $action    = "Insert";
            $record_id = $id;
            $this->log($message, $record_id, $action);
        }
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

    public function teacherByClassCreditSection($subject_id, $section_credit_id)
    {
        $query = $this->db->select('staff.*,class_credit_teacher.id as ctid,class_credit_teacher.subject_id,class_credit_teacher.section_credit_id,section_credits.section_credit_name,subjects.name as subjects_name')->join("staff", "class_credit_teacher.staff_id = staff.id")->join("subjects", "class_credit_teacher.subject_id = subjects.id")->join("section_credits", "class_credit_teacher.section_credit_id = section_credits.id")->where("class_credit_teacher.subject_id", $subject_id)->where("class_credit_teacher.section_credit_id", $section_credit_id)->where("staff.is_active", 1)->where("class_credit_teacher.session_id", $this->current_session)->get("class_credit_teacher");
        return $query->result_array();
    }

    public function updateTeacher($previd, $class_id, $section_id)
    {
        $data = array('class_id' => $class_id, 'section_id' => $section_id);
        $this->db->set('class_id', 'class_id', false);
        $this->db->set('section_id', 'section_id', false);
        $this->db->where_in('id', $previd);
        $this->db->update('class_credit_teacher', $data);
    }

    public function getclasscreditbyuser($id)
    {
        $query = $this->db->select("classes.*")->join("classes", "class_credit_teacher.class_id = classes.id")->where("class_credit_teacher.staff_id", $id)->get("class_credit_teacher");
        return $query->result_array();
    }

    public function classcreditbysubjectteacher($id, $classes)
    {
        $query = $this->db->query("select * from subject_timetable st where st.staff_id='" . $id . "' ");
        $subject_teacher = $query->result_array();
    }

    public function delete($class_id, $section_id, $array)
    {
        $this->db->where('class_id', $class_id);
        $this->db->where('section_id', $section_id);
        if (!empty($array)) {
            $this->db->where_in('staff_id', $array);
        }
        $this->db->delete('class_credit_teacher');
    }

    public function getsubjectbyteacher($id)
    {
        $query = $this->db->select("classes.*,teacher_subjects.subject_id")
            ->join("classes", "class_sections.class_id = classes.id ")
            ->where("teacher_subjects.teacher_id", $id)
            ->where_in('classes.id', 'select class_sections.class_id from class_sections inner join teacher_subjects on (class_sections.id = teacher_subjects.class_section_id) group by class_sections.class_id')
            ->get("teacher_subjects");

        return $query->result_array();
    }

}
