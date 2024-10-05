<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Classes extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (!$this->rbac->hasPrivilege('class', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'classes/index');
        $data['title']      = 'Add Class';
        $data['title_list'] = 'Class List';

        $this->form_validation->set_rules(
            'class', $this->lang->line('class'), array(
                'required',
                array('class_exists', array($this->class_model, 'class_exists')),
            )
        );
        $this->form_validation->set_rules(
            'unit_price', $this->lang->line('unit_price'), array('required')
        );
        $this->form_validation->set_rules(
            'class_code', $this->lang->line('class_code'), array('required')
        );
        $this->form_validation->set_rules(
            'training_system', $this->lang->line('training_system'), array('required')
        );
        if ($this->form_validation->run() == false) {

        } else {
            $class       = $this->input->post('class');
            $class_array = array(
                'class'                 => $this->input->post('class'),
                'class_code'            => $this->input->post('class_code'),
                'unit_price'            => $this->input->post('unit_price'),
                'training_system_id'    => $this->input->post('training_system'),
            );
            $sections = $this->input->post('sections');
            $this->classsection_model->add($class_array, $sections);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('classes');
        }
        $search_training_system     = isset($_GET['training_system_id']) ? $_GET['training_system_id'] : ''; 
        $vehicle_result             = $this->section_model->get();
        $data['vehiclelist']        = $vehicle_result;
        $vehroute_result            = $this->classsection_model->getByID(null,$search_training_system);
        $data['vehroutelist']       = $vehroute_result;
        $data['trainingsystem']     = $this->training_system_model->get();
        $data['admissionintake']    = $this->admission_intake_model->get();
        $this->load->view('layout/header', $data);
        $this->load->view('class/classList', $data);
        $this->load->view('layout/footer', $data);
    }

    public function delete($id)
    {
        if (!$this->rbac->hasPrivilege('class', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Fees Master List';
        $this->class_model->remove($id);

        $student_delete=$this->student_model->getUndefinedStudent();
        if(!empty($student_delete)){
            $delte_student_array=array();
            foreach ($student_delete as $student_key => $student_value) {

                $delte_student_array[]=$student_value->id;
            }
            $this->student_model->bulkdelete($delte_student_array);
        }
     
        redirect('classes');
    }

    public function edit($id)
    {
        if (!$this->rbac->hasPrivilege('class', 'can_edit')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'classes/index');
        $data['title']      = 'Edit Class';
        $data['id']         = $id;
        $vehroute           = $this->classsection_model->getByID($id);
        $data['vehroute']   = $vehroute;
        $data['title_list'] = 'Fees Master List';
        $this->form_validation->set_rules(
            'unit_price', $this->lang->line('unit_price'), array('required')
        );
        $this->form_validation->set_rules(
            'class_code', $this->lang->line('class_code'), array('required')
        );
        $this->form_validation->set_rules(
            'class', $this->lang->line('class'), array(
                'required',
                array('class_exists', array($this->class_model, 'class_exists')),
            )
        );
        if ($this->form_validation->run() == false) {
            $vehicle_result       = $this->section_model->get();
            $data['vehiclelist']  = $vehicle_result;
            $routeList            = $this->route_model->get();
            $data['routelist']    = $routeList;
            $vehroute_result      = $this->classsection_model->getByID();
            $data['vehroutelist'] = $vehroute_result;
            $this->load->view('layout/header', $data);
            $this->load->view('class/classEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $class_id      = $this->input->post('pre_class_id');
            $class_array = array(
                'id'            => $class_id,
                'unit_price'    => $this->input->post('unit_price'),
                'class_code'    => $this->input->post('class_code'),
                'class'         => $this->input->post('class'),
            );
            $this->classsection_model->update($class_array);

            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('update_message') . '</div>');
            redirect('classes/index');
        }
    }

    public function get_section($id)
    {
        $data['sections'] = $this->class_model->get_section($id);
        $this->load->view('class/_section_list', $data);
    }
    
    public function getByTrainingSystem()
    {
        $training_system_id = $this->input->get('training_system_id');
        $data     = $this->classsection_model->getClassByTrainingSystem($training_system_id);
        echo json_encode($data);
    }
    
    public function getTeacherBySubject()
    {
        $subject_id = $this->input->get('subject_id');
        $data       = $this->staff_model->getTeacherBySubject($subject_id);
        echo json_encode($data);
    }
}
