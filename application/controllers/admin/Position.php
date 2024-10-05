<?php

class Position extends Admin_Controller {

    function __construct() {

        parent::__construct();

        $this->load->helper('file');
        $this->config->load("payroll");
        $this->load->model('position_model');
        $this->load->model('staff_model');
    }

    function position() {

        $this->session->set_userdata('top_menu', 'HR');
        $this->session->set_userdata('sub_menu', 'admin/position/position');

        $positions = $this->position_model->get();
        $data["positions"] = $positions;
        $data["title"] = $this->lang->line('add_position');
        $this->form_validation->set_rules('name', $this->lang->line('position'), 'required');

        if ($this->form_validation->run()) {

            $name = $this->input->post("name");
            $id = $this->input->post("id");
            if (!empty($id)) {
                $data = array('name' => $name, 'status' => '1', 'id' => $id);
            } else {

                $data = array('name' => $name, 'status' => '1');
            }
            
            $insert_id = $this->position_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success">' . $this->lang->line('success_message') . '</div>');
            redirect("admin/position/position");
        } else {

            $this->load->view("layout/header");
            $this->load->view("admin/staff/position", $data);
            $this->load->view("layout/footer");
        }
    }

    function positionedit($id) {

        $result = $this->position_model->get($id);

        $data["result"] = $result;
        $data["title"] = $this->lang->line('edit_position');
        $position = $this->position_model->get();
        $data["positions"] = $position;
        $this->load->view("layout/header");
        $this->load->view("admin/staff/position", $data);
        $this->load->view("layout/footer");
    }

    function positiondelete($id) {

        $this->position_model->remove($id);
        redirect('admin/position/position');
    }

}

?>