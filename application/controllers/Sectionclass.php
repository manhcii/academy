<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Sectionclass extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    public function index()
    {
        if (!$this->rbac->hasPrivilege('section_class', 'can_view')) {
            access_denied();
        }
        
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'sections/index');
        $data['title'] = 'Section List';

        $section_result      = $this->sectionclass_model->getByID(); 
        
        $data['sectionlist'] = $section_result;
    
        $this->load->view('layout/header', $data);
        $this->load->view('sectionclass/sectionClassList', $data);
        $this->load->view('layout/footer', $data);

    }
    
    public function add()
    {
        if (!$this->rbac->hasPrivilege('section_class', 'can_add')) {
            access_denied();
        }
        
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'sections/index');
        $data['title'] = 'Section Add';
        
        $teacherlist = $this->staff_model->getStaffbyrole($role = 2);
        $subject_result             = $this->subject_model->get();
        $data['teacherlist']        = $teacherlist;     
        $data['subjectlist']        = $subject_result;
        
        $this->form_validation->set_rules('section_class_code', $this->lang->line('section_class_code'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('subject', $this->lang->line('subject'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_class_date_start', $this->lang->line('section_class_date_start'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_class_date_end', $this->lang->line('section_class_date_end'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('teacher', $this->lang->line('teacher'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('sectionclass/sectionClassCreate', $data);
            $this->load->view('layout/footer', $data);
        } else {
            // section class data
            $data = array(
                'training_system' => $this->input->post('training_system'),
                'section_class_code' => $this->input->post('section_class_code'),
                'section_class_date_start' => $this->customlib->dateFormatToYYYYMMDD($this->input->post('section_class_date_start')),
                'section_class_date_end' => $this->customlib->dateFormatToYYYYMMDD($this->input->post('section_class_date_end')),
            );
            // teacher section class data
            $subjects = $this->input->post('subject');
            $sectionclass_id = $this->sectionclass_model->add($data,$subjects);

            $classteacherid = $this->input->post("classteacherid");
            if (isset($classteacherid)) {

                $data_section_class_teacher = array(
                    'id'                 => $classteacherid[$i],
                    'subject_id'         => $this->input->post('subject'),
                    'staff_id'           => $this->input->post('teacher'),
                    'session_id'         => $this->current_session,
                    'sectionclass_id'        => $sectionclass_id,
                );
            } else {
                $data_section_class_teacher = array(
                    'subject_id'             => $this->input->post('subject'),
                    'staff_id'               => $this->input->post('teacher'),
                    'session_id'             => $this->current_session,
                    'sectionclass_id'        => $sectionclass_id,
                );
            }
            $this->sectionclass_teacher_model->addSectionClassTeacher($data_section_class_teacher);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('sectionclass/index');
        }
    }

    public function view($id)
    {
        if (!$this->rbac->hasPrivilege('section_class', 'can_view')) {
            access_denied();
        }
        $data['title']   = 'Section List';
        $section         = $this->sectionclass_model->get($id);
        $data['section'] = $section;
        $this->load->view('layout/header', $data);
        $this->load->view('sectionclass/sectionShow', $data);
        $this->load->view('layout/footer', $data);
    }

    public function delete($id)
    {
        if (!$this->rbac->hasPrivilege('section_class', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Section List';
        $this->sectionclass_model->remove($id);

        // $student_delete=$this->student_model->getUndefinedStudent();

        // if(!empty($student_delete)){
        //     $delte_student_array=array();
        //     foreach ($student_delete as $student_key => $student_value) {

        //         $delte_student_array[]=$student_value->id;
        //     }
        //     $this->student_model->bulkdelete($delte_student_array);
        // }        
        redirect('sectionclass/index');
    }

    public function getByClass()
    {
        $class_id = $this->input->get('class_id');
        $data     = $this->sectionclass_model->getClassBySection($class_id);
        echo json_encode($data);
    }

    public function getClassTeacherSection()
    {
        $class_id = $this->input->get('class_id');
        $data     = array();
        $userdata = $this->customlib->getUserData();
        if (($userdata["role_id"] == 2) && ($userdata["class_teacher"] == "yes")) {
            $id    = $userdata["id"];
            $query = $this->db->where("staff_id", $id)->where("class_id", $class_id)->get("class_teacher");

            if ($query->num_rows() > 0) {

                $data = $this->sectionclass_model->getClassTeacherSection($class_id);
            } else {

                $data = $this->sectionclass_model->getSubjectTeacherSection($class_id, $id);
            }
        } else {
            $data = $this->sectionclass_model->getClassBySection($class_id);
        }
        echo json_encode($data);
    }

    public function edit($id)
    {
        if (!$this->rbac->hasPrivilege('section_class', 'can_edit')) {
            access_denied();
        }
        $data['title']       = 'Section class List';
        $section_result      = $this->sectionclass_model->get();
        $data['sectionlist'] = $section_result;
        $data['title']       = 'Edit Section Class';
        $data['id']          = $id;
        $teacherlist = $this->staff_model->getStaffbyrole($role = 2);
        $subject_result             = $this->subject_model->get();
        $data['teacherlist']        = $teacherlist;     
        $data['subjectlist']        = $subject_result;
        $section             = $this->sectionclass_model->get($id);
        $data['section']     = $section;
        $vehroute            = $this->sectionclass_model->getByID($id);
        $data['vehroute']    = $vehroute;
        $section_result      = $this->sectionclass_model->getByID(); 
        $data['sectionlist'] = $section_result;
        $class_result        = $this->class_model->get();
        $data['classlist']   = $class_result;
        
        $classes             = $this->input->post('classes');
        
        $this->form_validation->set_rules('section', $this->lang->line('section'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_code', $this->lang->line('section_code'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('sectionclass/sectionClassEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $classes       = $this->input->post('classes');
            $prev_classes  = $this->input->post('prev_classes');
            $route_id      = $this->input->post('route_id');
            $section_id    = $this->input->post('pre_section_id');
            if (!isset($prev_sections)) {
                $prev_sections = array();
            }
            $add_result    = array_diff($classes, $prev_classes);
            $delete_result = array_diff($prev_classes, $classes);
            $data = array(
                'id'      => $id,
                'section' => $this->input->post('section'),
            );
            if (!empty($add_result)) {
                $vehicle_batch_array = array();
                $section_array         = array(
                    'id'    => $section_id,
                    'section' => $this->input->post('section'),
                    'section_code' => $this->input->post('section_code'),
                );
                foreach ($add_result as $vec_add_key => $vec_add_value) {
                    $vehicle_batch_array[] = $vec_add_value;
                }
                $this->sectionclass_model->add($section_array, $vehicle_batch_array);
            } else {
                $classes = $this->input->post('classes');
                $section_array = array(
                    'id'    => $section_id,
                    'section' => $this->input->post('section'),
                    'section_code' => $this->input->post('section_code'),
                );
                $this->sectionclass_model->update($section_array);
            }

            if (!empty($delete_result)) {
                $classsection_delete_array = array();
                foreach ($delete_result as $vec_delete_key => $vec_delete_value) {
                    $classsection_delete_array[] = $vec_delete_value;
                }
                $this->classsection_model->remove($section_id, $classsection_delete_array);
            }
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('update_message') . '</div>');
            redirect('sections/index');
        }
    }
    
    public function addstudent($id)
    {
        if (!$this->rbac->hasPrivilege('section_class', 'can_view')) {
            access_denied();
        }
        $data['title']   = 'Section List';
        $section         = $this->sectionclass_model->get($id);
        $data['section'] = $section;
        $this->load->view('layout/header', $data);
        $this->load->view('sectionclass/sectionClassAddStudent', $data);
        $this->load->view('layout/footer', $data);
    }
}
