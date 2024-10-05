<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Location extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("District_model");
        $this->load->model("Ward_model");
    }

    public function getDistrictByProvince()
    {
        $province_id = $this->input->get('province_id');
        $data     = $this->District_model->getDistrictByProvince($province_id);
        echo json_encode($data);
    }
    
    public function getWardByDistrict()
    {
        $district_id = $this->input->get('district_id');
        $data     = $this->Ward_model->getWardByDistrict($district_id);
        echo json_encode($data);
    }
}
