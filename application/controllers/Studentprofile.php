<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Credits extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
    }
    
    public function create()
    {
        if (!$this->rbac->hasPrivilege('student', 'can_add')) {
            access_denied();
        }

        $data["month"] = $this->customlib->getMonthDropdown();
        $this->session->set_userdata('top_menu', 'Student Profile');
        $this->session->set_userdata('sub_menu', 'student/createprofile');
        
        $this->form_validation->set_rules('lastname', $this->lang->line('last_name'), 'trim|required|xss_clean');
        
        $this->form_validation->set_rules(
            'mobileno', $this->lang->line('mobile_no'), array(
                'xss_clean',
                array('check_student_mobile_exists', array($this->student_model, 'check_student_mobile_no_exists')),
            )
        );
        
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header');
            $this->load->view('student/createprofile', $data);
            $this->load->view('layout/footer');
        } else {

            $data = array(
                'book_title'  => $this->input->post('book_title'),
                'book_no'     => $this->input->post('book_no'),
                'isbn_no'     => $this->input->post('isbn_no'),
                'subject'     => $this->input->post('subject'),
                'rack_no'     => $this->input->post('rack_no'),
                'publish'     => $this->input->post('publish'),
                'author'      => $this->input->post('author'),
                'qty'         => $this->input->post('qty'),
                'perunitcost' => $perunitcost,
                'description' => $this->input->post('description'),
            );

            if (isset($_POST['postdate']) && $_POST['postdate'] != '') {
                $data['postdate'] = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('postdate')));
            } else {
                $data['postdate'] = null;
            }
            $this->book_model->addbooks($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/book/getall');
        }
    }

    public function index()
    {
        if (!$this->rbac->hasPrivilege('credits', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'credits/index');
        $data['title'] = 'Section List';

        $section_result      = $this->section_model->getByID(); 
        $data['sectionlist'] = $section_result;
        
        $section_credit_result      = $this->credit_model->getByID(); 
        $data['sectionCreditList']  = $section_credit_result;
        
        $class_result       = $this->class_model->get();
        $data['classlist']  = $class_result;
        
        $subject_result        = $this->subject_model->get();
        $data['subjectlist']   = $subject_result;
        
        $this->form_validation->set_rules('section_credit_name', $this->lang->line('section_credit_name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_credits[]', $this->lang->line('subject'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_credit_code', $this->lang->line('section_credit_code'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('credit/creditList', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'section_credit_name' => $this->input->post('section_credit_name'),
                'section_credit_code' => $this->input->post('section_credit_code'),
            );
            $sectionCredits = $this->input->post('section_credits');

            $this->credit_model->add($data,$sectionCredits);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('credits/index');
        }
    }

    public function view($id)
    {
        if (!$this->rbac->hasPrivilege('credits', 'can_view')) {
            access_denied();
        }
        $data['title']   = 'Section List';
        $section         = $this->section_model->get($id);
        $data['section'] = $section;
        $this->load->view('layout/header', $data);
        $this->load->view('credits/sectionShow', $data);
        $this->load->view('layout/footer', $data);
    }

    public function delete($id)
    {
        if (!$this->rbac->hasPrivilege('credits', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Credits List';
        $this->credit_model->remove($id);

        // $student_delete=$this->student_model->getUndefinedStudent();
        // if(!empty($student_delete)){
        //     $delte_student_array=array();
        //     foreach ($student_delete as $student_key => $student_value) {

        //         $delte_student_array[]=$student_value->id;
        //     }
        //     $this->student_model->bulkdelete($delte_student_array);
        // }        
        redirect('credits/index');
    }

    public function getByClass()
    {
        $class_id = $this->input->get('class_id');
        $data     = $this->section_model->getClassCreditBySection($class_id);
        echo json_encode($data);
    }
    
    public function getBySubject()
    {
        $subject_id = $this->input->get('subject_id');
        $data     = $this->credit_model->getClassCreditBySubject($subject_id);
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
        if (!$this->rbac->hasPrivilege('credits', 'can_edit')) {
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
        
        $class_result        = $this->class_model->get();
        $data['classlist']   = $class_result;
        
        $classes             = $this->input->post('classes');
        
        $this->form_validation->set_rules('section', $this->lang->line('section'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_code', $this->lang->line('section_code'), 'trim|required|xss_clean');
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
            redirect('credits/index');
        }
    }

}
