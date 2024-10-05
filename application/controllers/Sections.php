<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Sections extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (!$this->rbac->hasPrivilege('section', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'sections/index');
        $data['title'] = 'Section List';

        $section_result      = $this->section_model->getByID(); 
        
        $data['sectionlist'] = $section_result;
        $data['section_id'] = 0;
        $data['trainingsystem']     = $this->training_system_model->get();
        $data['admissionintake']    = $this->admission_intake_model->get();
        $teacherlist = $this->staff_model->getStaffbyrole($role = 2);
        $data['teacherlist'] = $teacherlist;
        
        $this->form_validation->set_rules('section', $this->lang->line('section'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('classes[]', $this->lang->line('class'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_code', $this->lang->line('section_code'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('section/sectionList', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'section' => $this->input->post('section'),
                'section_code' => $this->input->post('section_code'),
                'training_system_id' => $this->input->post('training_system_id'),
                'admission_intake_id' => $this->input->post('admission_intake_id'),
                'homeroom_teacher_id' => $this->input->post('homeroom_teacher_id'),

            );
            $classes = $this->input->post('classes');
            $this->section_model->add($data,$classes);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('sections/index');
        }
    }

    public function view($id)
    {
        if (!$this->rbac->hasPrivilege('section', 'can_view')) {
            access_denied();
        }
        $data['title']   = 'Section List';
        $section         = $this->section_model->get($id);
        $data['section'] = $section;
        $this->load->view('layout/header', $data);
        $this->load->view('section/sectionShow', $data);
        $this->load->view('layout/footer', $data);
    }

    public function delete($id)
    {
        if (!$this->rbac->hasPrivilege('section', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Section List';
        $this->section_model->remove($id);

        $student_delete=$this->student_model->getUndefinedStudent();
        if(!empty($student_delete)){
            $delte_student_array=array();
            foreach ($student_delete as $student_key => $student_value) {

                $delte_student_array[]=$student_value->id;
            }
            $this->student_model->bulkdelete($delte_student_array);
        }        
        redirect('sections/index');
    }

    public function getByClass()
    {
        $class_id = $this->input->get('class_id');
        $data     = $this->section_model->getClassBySection($class_id);
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

                $data = $this->section_model->getClassTeacherSection($class_id);
            } else {

                $data = $this->section_model->getSubjectTeacherSection($class_id, $id);
            }
        } else {
            $data = $this->section_model->getClassBySection($class_id);
        }
        echo json_encode($data);
    }

    public function edit($id)
    {
        if (!$this->rbac->hasPrivilege('section', 'can_edit')) {
            access_denied();
        }
        $data['title']       = 'Section List';
        $section_result      = $this->section_model->get();
        $data['sectionlist'] = $section_result;
        $data['title']       = 'Edit Section';
        $data['id']          = $id;
        $section             = $this->section_model->get($id);
        $data['section']     = $section;
        $vehroute            = $this->section_model->getByID($id);
        $data['vehroute']    = $vehroute;
        $section_result      = $this->section_model->getByID(); 
        $data['sectionlist'] = $section_result;
        $data['class_id']    = $vehroute[0]->vehicles[0]->class_id;
        $data['training_system_id']    = $section['training_system_id'];
        $class_result        = $this->class_model->get();
        $data['classlist']   = $class_result;
        $data['trainingsystem']     = $this->training_system_model->get();
        $data['admissionintake']    = $this->admission_intake_model->get();
        $teacherlist = $this->staff_model->getStaffbyrole($role = 2);
        $data['teacherlist'] = $teacherlist;
        
        $classes             = $this->input->post('classes');
        
        $this->form_validation->set_rules('section', $this->lang->line('section'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_code', $this->lang->line('section_code'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('classes[]', $this->lang->line('class'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('section/sectionEdit', $data);
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
                    'training_system_id' => $this->input->post('training_system_id'),
                    'admission_intake_id' => $this->input->post('admission_intake_id'),
                    'homeroom_teacher_id' => $this->input->post('homeroom_teacher_id'),
                );
                foreach ($add_result as $vec_add_key => $vec_add_value) {
                    $vehicle_batch_array[] = $vec_add_value;
                }
                $this->section_model->add($section_array, $vehicle_batch_array);
            } else {
                $classes = $this->input->post('classes');
                $section_array = array(
                    'id'    => $section_id,
                    'section' => $this->input->post('section'),
                    'section_code' => $this->input->post('section_code'),
                    'training_system_id' => $this->input->post('training_system_id'),
                    'admission_intake_id' => $this->input->post('admission_intake_id'),
                    'homeroom_teacher_id' => $this->input->post('homeroom_teacher_id'),
                );
                $this->section_model->update($section_array);
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
}
