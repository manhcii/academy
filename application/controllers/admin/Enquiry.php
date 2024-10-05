<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Enquiry extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('media_storage');
        $this->load->library('form_validation');
        $this->load->model("enquiry_model");
        $this->load->model("province_model");
        $this->load->model("training_system_model");
        $this->config->load("payroll");
        $this->enquiry_status = $this->config->item('enquiry_status');
        $this->graduation_rank = $this->config->item('graduation_rank');
        $this->train_type = $this->config->item('train_type');
    }

    public function index()
    {

        if (!$this->rbac->hasPrivilege('admission_enquiry', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'front_office');
        $this->session->set_userdata('sub_menu', 'admin/enquiry');
        $data['class_list']     = $this->class_model->get();
        $subjectgroupList         = $this->subjectgroup_model->get();
        $data['subjectgroupList'] = $subjectgroupList;
        $data["selected_class"] = "";
        $data["source_select"]  = "";
        $data["status"]         = "active";
        $data['stff_list']      = $this->staff_model->get();
            $stff                   = $this->input->post("stff");
            $class                  = $this->input->post("class");
            $source                 = $this->input->post("source");
            $khoa_hoc                 = $this->input->post("khoa_hoc");
            $dot_tuyen_sinh           = $this->input->post("dot_tuyen_sinh");
            $cb_data                  = $this->input->post("cb_data");
            $doi_tac                  = $this->input->post("doi_tac");
            $daterange              = $this->input->post("daterange") ? $this->input->post("daterange") : date("Y-m-d", time()).'-'.date("Y-m-d", time());
            $daterange              = explode('-',str_replace(' ','',$daterange));
            
            if(date("Y-m-d", time()) == date("Y-m-d", strtotime($daterange[0]))  && date("Y-m-d", time()) == date("Y-m-d", strtotime($daterange[1])))
            {
                
                $date_from = $date_to = null;
            }
            else
            {
                $date_from              = $this->input->post("daterange") ? date("Y-m-d", strtotime($daterange[0])) : '';
                $date_to                = $this->input->post("daterange") ? date("Y-m-d", strtotime($daterange[1])) : '';
            }
            $data["stff"]               = $stff;
            $data["doi_tac"]  = $source;
            $data["cb_data"] = $cb_data;
            $data["dot_tuyen_sinh"]  = $dot_tuyen_sinh;
            $data["khoa_hoc"] = $khoa_hoc;
            $data["source_select"]  = $source;
            $data["selected_class"] = $class;
            $enquiry_list           = $this->enquiry_model->searchEnquiry($class, $source, $date_from, $date_to, $khoa_hoc, $dot_tuyen_sinh, $cb_data, $doi_tac, $stff);
        
        foreach ($enquiry_list as $key => $value) {
            $follow_up                          = $this->enquiry_model->getFollowByEnquiry($value["id"]);
            $enquiry_list[$key]["followupdate"] = isset($follow_up["date"]) ? $follow_up["date"] : '';
            $enquiry_list[$key]["next_date"]    = isset($follow_up["next_date"]) ? $follow_up["next_date"] : '';
            $enquiry_list[$key]["response"]     = isset($follow_up["response"]) ? $follow_up["response"] : '';
            $enquiry_list[$key]["note"]         = isset($follow_up["note"]) ? $follow_up["note"] : '';
            $enquiry_list[$key]["followup_by"]  = isset($follow_up["followup_by"]) ? $follow_up["followup_by"] : '';
        }
        $data['enquiry_list']   = $enquiry_list;
        $data['enquiry_status'] = $this->enquiry_status;
        $data['Reference']      = $this->enquiry_model->get_reference();
        $data['sourcelist']     = $this->enquiry_model->getComplaintSource();
        $data['stff_list']      = $this->staff_model->getEmployee(13);
        $data['khoa_tuyen_sinhs']        = $this->enquiry_model->get_khoa_tuyen_sinh();
        $data['dot_tuyen_sinhs']         = $this->enquiry_model->getComplaintType();
        $data['doi_tacs']                = $this->enquiry_model->getDoiTac();
        $data['cb_datas']                = $this->staff_model->getEmployee(20);
        $this->load->view('layout/header');
        $this->load->view('admin/frontoffice/enquiryview', $data);
        $this->load->view('layout/footer');
    }
    
    public function danh_sach_xet_tuyen()
    {
        if (!$this->rbac->hasPrivilege('admission_enquiry', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'front_office');
        $this->session->set_userdata('sub_menu', 'admin/enquiry/danh_sach_trung_tuyen');
        $data['class_list']     = $this->class_model->get();
        $subjectgroupList         = $this->subjectgroup_model->get();
        $data['subjectgroupList'] = $subjectgroupList;
        $data["selected_class"] = "";
        $data["source_select"]  = "";
        $data["status"]         = "active";
        $data['stff_list']      = $this->staff_model->get();
            $stff                     = $this->input->post("stff");
            $class                    = $this->input->post("class");
            $source                   = $this->input->post("source");
            $khoa_hoc                 = $this->input->post("khoa_hoc");
            $dot_tuyen_sinh           = $this->input->post("dot_tuyen_sinh");
            $cb_data                  = $this->input->post("cb_data");
            $doi_tac                  = $this->input->post("doi_tac");
            $daterange              = $this->input->post("daterange") ? $this->input->post("daterange") : date("Y-m-d", time()).'-'.date("Y-m-d", time());
            $daterange              = explode('-',str_replace(' ','',$daterange));
            
            if(date("Y-m-d", time()) == date("Y-m-d", strtotime($daterange[0]))  && date("Y-m-d", time()) == date("Y-m-d", strtotime($daterange[1])))
            {
                
                $date_from = $date_to = null;
            }
            else
            {
                $date_from              = $this->input->post("daterange") ? date("Y-m-d", strtotime($daterange[0])) : '';
                $date_to                = $this->input->post("daterange") ? date("Y-m-d", strtotime($daterange[1])) : '';
            }
            $data["stff"]   = $stff;
            $data["doi_tac"]  = $source;
            $data["cb_data"] = $cb_data;
            $data["dot_tuyen_sinh"]  = $dot_tuyen_sinh;
            $data["khoa_hoc"] = $khoa_hoc;
            $data["source_select"]  = $source;
            $data["selected_class"] = $class;
            $danh_sach_xet_tuyen           = $this->enquiry_model->searchDanhSachXetTuyen($class, $source, $date_from, $date_to, $khoa_hoc, $dot_tuyen_sinh, $cb_data, $doi_tac, $stff);
        foreach ($danh_sach_xet_tuyen as $key => $value) {
            $follow_up                          = $this->enquiry_model->getFollowByEnquiry($value["id"]);
            $danh_sach_xet_tuyen[$key]["followupdate"] = isset($follow_up["date"]) ? $follow_up["date"] : '';
            $danh_sach_xet_tuyen[$key]["next_date"]    = isset($follow_up["next_date"]) ? $follow_up["next_date"] : '';
            $danh_sach_xet_tuyen[$key]["response"]     = isset($follow_up["response"]) ? $follow_up["response"] : '';
            $danh_sach_xet_tuyen[$key]["note"]         = isset($follow_up["note"]) ? $follow_up["note"] : '';
            $danh_sach_xet_tuyen[$key]["followup_by"]  = isset($follow_up["followup_by"]) ? $follow_up["followup_by"] : '';
        }
        $data['danh_sach_xet_tuyen']   = $danh_sach_xet_tuyen;
        $data['enquiry_status'] = $this->enquiry_status;
        $data['Reference']      = $this->enquiry_model->get_reference();
        $data['sourcelist']     = $this->enquiry_model->getComplaintSource();
        $data['stff_list']      = $this->staff_model->getEmployee(13);
        $data['khoa_tuyen_sinhs']        = $this->enquiry_model->get_khoa_tuyen_sinh();
        $data['dot_tuyen_sinhs']         = $this->enquiry_model->getComplaintType();
        $data['doi_tacs']                = $this->enquiry_model->getDoiTac();
        $data['cb_datas']                = $this->staff_model->getEmployee(20);
        $this->load->view('layout/header');
        $this->load->view('admin/frontoffice/danh_sach_xet_tuyen', $data);
        $this->load->view('layout/footer');
    }
    
    public function danh_sach_tuyen_sinh()
    {
        if (!$this->rbac->hasPrivilege('admission_enquiry', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'front_office');
        $this->session->set_userdata('sub_menu', 'admin/enquiry/danh_sach_trung_tuyen');
        $data['class_list']     = $this->class_model->get();
        $subjectgroupList         = $this->subjectgroup_model->get();
        
        $data['subjectgroupList'] = $subjectgroupList;
        $data["selected_class"]         = "";
        $data["source_select"]          = "";
        $data['stff_list']              = $this->staff_model->get();
            $stff                       = $this->input->post("stff");
            $class                      = $this->input->post("class");
            $source                     = $this->input->post("source");
            $khoa_hoc                   = $this->input->post("khoa_hoc");
            $dot_tuyen_sinh             = $this->input->post("dot_tuyen_sinh");
            $cb_data                    = $this->input->post("cb_data");
            $doi_tac                    = $this->input->post("doi_tac");
            $daterange                  = $this->input->post("daterange") ? $this->input->post("daterange") : date("Y-m-d", time()).'-'.date("Y-m-d", time());
            $daterange                  = explode('-',str_replace(' ','',$daterange));
            
            if(date("Y-m-d", time()) == date("Y-m-d", strtotime($daterange[0]))  && date("Y-m-d", time()) == date("Y-m-d", strtotime($daterange[1])))
            {
                
                $date_from = $date_to = null;
            }
            else
            {
                $date_from              = $this->input->post("daterange") ? date("Y-m-d", strtotime($daterange[0])) : '';
                $date_to                = $this->input->post("daterange") ? date("Y-m-d", strtotime($daterange[1])) : '';
            }
            $data["stff"]               = $stff;
            $data["source_select"]      = $source;
            $data["doi_tac"]            = $source;
            $data["cb_data"]            = $cb_data;
            $data["dot_tuyen_sinh"]     = $dot_tuyen_sinh;
            $data["khoa_hoc"]           = $khoa_hoc;
            $data["selected_class"]     = $class;
            $danh_sach_xet_tuyen           = $this->enquiry_model->searchDanhSachTuyenSinh($class, $source, $date_from, $date_to, $khoa_hoc, $dot_tuyen_sinh, $cb_data, $doi_tac, $stff);;
        foreach ($danh_sach_xet_tuyen as $key => $value) {
            $follow_up                          = $this->enquiry_model->getFollowByEnquiry($value["id"]);
            $danh_sach_xet_tuyen[$key]["followupdate"] = isset($follow_up["date"]) ? $follow_up["date"] : '';
            $danh_sach_xet_tuyen[$key]["next_date"]    = isset($follow_up["next_date"]) ? $follow_up["next_date"] : '';
            $danh_sach_xet_tuyen[$key]["response"]     = isset($follow_up["response"]) ? $follow_up["response"] : '';
            $danh_sach_xet_tuyen[$key]["note"]         = isset($follow_up["note"]) ? $follow_up["note"] : '';
            $danh_sach_xet_tuyen[$key]["followup_by"]  = isset($follow_up["followup_by"]) ? $follow_up["followup_by"] : '';
        }
        $data['danh_sach_xet_tuyen']   = $danh_sach_xet_tuyen;
        $data['enquiry_status'] = $this->enquiry_status;
        $data['Reference']      = $this->enquiry_model->get_reference();
        $data['sourcelist']     = $this->enquiry_model->getComplaintSource();
        $data['stff_list']      = $this->staff_model->getEmployee(13);
        $data['khoa_tuyen_sinh']        = $this->enquiry_model->get_khoa_tuyen_sinh();
        $data['dot_tuyen_sinh']         = $this->enquiry_model->getComplaintType();
        $data['doi_tac']                = $this->enquiry_model->getDoiTac();
        $data['cb_data']                = $this->staff_model->getEmployee(20);
        $this->load->view('layout/header');
        $this->load->view('admin/frontoffice/danh_sach_tuyen_sinh', $data);
        $this->load->view('layout/footer');
    }
    
    public function danh_sach_trung_tuyen()
    {
        if (!$this->rbac->hasPrivilege('admission_enquiry', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'front_office');
        $this->session->set_userdata('sub_menu', 'admin/enquiry/danh_sach_trung_tuyen');
        $data['class_list']     = $this->class_model->get();
        $subjectgroupList         = $this->subjectgroup_model->get();
        
        $data['subjectgroupList'] = $subjectgroupList;
        $data["selected_class"]         = "";
        $data["source_select"]          = "";
        $data["status"]                 = "active";
        $data['stff_list']              = $this->staff_model->get();
            $stff                       = $this->input->post("stff");
            $class                      = $this->input->post("class");
            $source                     = $this->input->post("source");
            $khoa_hoc                   = $this->input->post("khoa_hoc");
            $dot_tuyen_sinh             = $this->input->post("dot_tuyen_sinh");
            $cb_data                    = $this->input->post("cb_data");
            $doi_tac                    = $this->input->post("doi_tac");
            $daterange                  = $this->input->post("daterange") ? $this->input->post("daterange") : date("Y-m-d", time()).'-'.date("Y-m-d", time());
            $daterange                  = explode('-',str_replace(' ','',$daterange));
            
            if(date("Y-m-d", time()) == date("Y-m-d", strtotime($daterange[0]))  && date("Y-m-d", time()) == date("Y-m-d", strtotime($daterange[1])))
            {
                
                $date_from = $date_to = null;
            }
            else
            {
                $date_from              = $this->input->post("daterange") ? date("Y-m-d", strtotime($daterange[0])) : '';
                $date_to                = $this->input->post("daterange") ? date("Y-m-d", strtotime($daterange[1])) : '';
            }
            $data["stff"]               = $stff;
            $data["source_select"]      = $source;
            $data["doi_tac"]            = $source;
            $data["cb_data"]            = $cb_data;
            $data["dot_tuyen_sinh"]     = $dot_tuyen_sinh;
            $data["khoa_hoc"]           = $khoa_hoc;
            $data["selected_class"]     = $class;
            $danh_sach_xet_tuyen           = $this->enquiry_model->searchDanhSachTrungTuyen($class, $source, $date_from, $date_to, $khoa_hoc, $dot_tuyen_sinh, $cb_data, $doi_tac, $stff);;
        foreach ($danh_sach_xet_tuyen as $key => $value) {
            $follow_up                          = $this->enquiry_model->getFollowByEnquiry($value["id"]);
            $danh_sach_xet_tuyen[$key]["followupdate"] = isset($follow_up["date"]) ? $follow_up["date"] : '';
            $danh_sach_xet_tuyen[$key]["next_date"]    = isset($follow_up["next_date"]) ? $follow_up["next_date"] : '';
            $danh_sach_xet_tuyen[$key]["response"]     = isset($follow_up["response"]) ? $follow_up["response"] : '';
            $danh_sach_xet_tuyen[$key]["note"]         = isset($follow_up["note"]) ? $follow_up["note"] : '';
            $danh_sach_xet_tuyen[$key]["followup_by"]  = isset($follow_up["followup_by"]) ? $follow_up["followup_by"] : '';
        }
        $data['danh_sach_xet_tuyen']   = $danh_sach_xet_tuyen;
        $data['enquiry_status'] = $this->enquiry_status;
        $data['Reference']      = $this->enquiry_model->get_reference();
        $data['sourcelist']     = $this->enquiry_model->getComplaintSource();
        $data['stff_list']      = $this->staff_model->getEmployee(13);
        $data['khoa_tuyen_sinh']        = $this->enquiry_model->get_khoa_tuyen_sinh();
        $data['dot_tuyen_sinh']         = $this->enquiry_model->getComplaintType();
        $data['doi_tac']                = $this->enquiry_model->getDoiTac();
        $data['cb_data']                = $this->staff_model->getEmployee(20);
        $this->load->view('layout/header');
        $this->load->view('admin/frontoffice/danh_sach_trung_tuyen', $data);
        $this->load->view('layout/footer');
    }
    
    public function create()
    {
        if (!$this->rbac->hasPrivilege('admission_enquiry', 'can_add')) {
            access_denied();
        }
        
        $data['class_list']     = $this->class_model->get();
        $data['provinces']      = $this->province_model->get();
        $data['enquiry_status'] = $this->enquiry_status;
        $data['graduation_rank']= $this->graduation_rank;
        $data['train_type']     = $this->train_type;
        $data['trainingsystem'] = $this->training_system_model->get();
        $data['Reference']      = $this->enquiry_model->get_reference();
        $data['stff_list']      = $this->staff_model->getEmployee(13);
        $data['khoa_tuyen_sinh']        = $this->enquiry_model->get_khoa_tuyen_sinh();
        $data['dot_tuyen_sinh']         = $this->enquiry_model->getComplaintType();
        $data['doi_tac']                = $this->enquiry_model->getDoiTac();
        $data['cb_data']                = $this->staff_model->getEmployee(20);
        $data['sourcelist']             = $this->enquiry_model->getComplaintSource();
        $this->load->view('layout/header', $data);
        $this->load->view('admin/frontoffice/enquirycreate', $data);
        $this->load->view('layout/footer', $data);
    }
    public function add()
    {
        if (!$this->rbac->hasPrivilege('admission_enquiry', 'can_add')) {
            access_denied();
        }
        $this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('contact', $this->lang->line('phone'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $msg = array(
                'name'    => form_error('name'),
                'contact' => form_error('contact'),          
            );
            $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
            redirect('/admin/enquiry/create', $array);
        } else {
            $userdata   = $this->customlib->getUserData();
            $created_by = $userdata["id"];

            $enquiry = array(
                'first_name'     => $this->input->post('first_name'),
                'name'           => $this->input->post('name'),
                'profile_code'   => $this->input->post('profile_code'),
                'cccd'           => $this->input->post('cccd'),
                'contact'        => $this->input->post('contact'),
                
                'province_id'    => $this->input->post('province_id'),
                'district_id'    => $this->input->post('district_id'),
                'ward_id'        => $this->input->post('ward_id'),
                'address'        => $this->input->post('address'),
                'reference'      => $this->input->post('reference'),
                
                'nation'         => $this->input->post('nation'),
                'religion'       => $this->input->post('religion'),
                
                'graduation_year_thpt'                  => $this->input->post('graduation_year_thpt'),
                'graduation_rank_thpt'                  => $this->input->post('graduation_rank_thpt'),
                'graduation_school_thpt'                => $this->input->post('graduation_school_thpt'),
                'graduation_professional_year'          => $this->input->post('graduation_professional_year'),
                'graduation_rank_professional'          => $this->input->post('graduation_rank_professional'),
                'graduation_department_professional'    => $this->input->post('graduation_department_professional'),
                'graduation_train_type_professional'    => $this->input->post('graduation_train_type_professional'),
                'graduation_train_level_professional'   => $this->input->post('graduation_train_level_professional'),
                'graduation_professional_school'        => $this->input->post('graduation_professional_school'),

                
                'date'           => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                'description'    => $this->input->post('description'),
                'note'           => $this->input->post('note'),
                'source'         => $this->input->post('source'),
                'subject_arr'    => $this->input->post('subject_arr') ? json_encode($this->input->post('subject_arr')) : null,
                'average_score'  => $this->input->post('average_score'),
                'email'          => $this->input->post('email'),
                'assigned'       => IsNullOrEmptyString($this->input->post('assigned')) ? NULL :$this->input->post('assigned'),
                'cb_data'        => IsNullOrEmptyString($this->input->post('cb_data')) ? NULL :$this->input->post('cb_data'),
                'doi_tac'        => IsNullOrEmptyString($this->input->post('doi_tac')) ? NULL :$this->input->post('doi_tac'),
                'le_phi'         => $this->input->post('le_phi'),
                
                'class_id'       => IsNullOrEmptyString($this->input->post('class')) ? NULL :$this->input->post('class'),
                'training_register_level'       => $this->input->post('training_register_level'),
                'training_register_type'       => $this->input->post('training_register_type'),
                'khoa_hoc'       => $this->input->post('khoa_hoc'),
                'dot_tuyen_sinh' => $this->input->post('dot_tuyen_sinh'),
                
                'no_of_child'    => $this->input->post('no_of_child'),
                'status'         => 'active',
                'created_by'     => $created_by,
            );
            $insert_id = $this->enquiry_model->add($enquiry);
            
            $upload_dir_path  = $this->customlib->getFolderPath() . './uploads/student_documents/' . $insert_id . '/';
            $upload_directory = './uploads/student_documents/' . $insert_id . '/';
            $files  = $_FILES;
            if (!is_dir($upload_dir_path) && !mkdir($upload_dir_path)) {
                die("Error creating folder $upload_dir_path");
            }
            // add file
            if ($files) {
                $i= 0;
                foreach ($files as $key => $value)
                {
                    $title_doc    = $this->input->post('title'.$key);
                    $imp          = $this->media_storage->fileupload($key, $upload_directory);
                    $data_img     = array('enquiry_id' => $insert_id, 'title' => $title_doc, 'doc' => $imp);
                    $this->student_model->adddoc($data_img);
                    $i++;
                }
            }
            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        }
        redirect('/admin/enquiry', $array);
    }

    public function delete($id)
    {
        if (!$this->rbac->hasPrivilege('admission_enquiry', 'can_delete')) {
            access_denied();
        }
        if (!empty($id)) {
            $this->enquiry_model->enquiry_delete($id);
            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('delete_message'));
        }
        echo json_encode($array);
    }

    public function follow_up($enquiry_id, $status, $created_by)
    {

        if (!$this->rbac->hasPrivilege('follow_up_admission_enquiry', 'can_view')) {
            access_denied();
        }
        $data['id']              = $enquiry_id;
        $data['enquiry_data']    = $this->enquiry_model->getenquiry_list($enquiry_id, $status);
        
         
        if(!empty($data['enquiry_data']['assigned'])){
            $data['assigned_staff'] = $this->staff_model->get($data['enquiry_data']['assigned']);
        
        }else{
            $data['assigned_staff'] = '';  
        }
        $data['enquiry_doc']     = $this->student_model->getenquirydoc($enquiry_id);
        $data['next_date']       = $this->enquiry_model->next_follow_up_date($enquiry_id);
        $data['created_by']      = $this->staff_model->get($created_by);
        $data['enquiry_status']  = $this->enquiry_status;
        $userdata                = $this->customlib->getUserData();
        $login_staff_id          = $userdata["id"];
        $getStaffRole            = $this->customlib->getStaffRole();
        $staffrole               = json_decode($getStaffRole);
        $data['staff_role']      = $staffrole->id;
        $data['login_staff_id']  = $login_staff_id;
        $data['superadmin_rest'] = $this->session->userdata['admin']['superadmin_restriction'];
        $this->load->view('admin/frontoffice/follow_up_modal', $data);
    }

    public function follow_up_insert()
    {
        if (!$this->rbac->hasPrivilege('follow_up_admission_enquiry', 'can_add')) {
            access_denied();
        }

        $this->form_validation->set_rules('response', $this->lang->line('response'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('date', $this->lang->line('follow_up_date'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $msg = array(
                'response'       => form_error('response'),
                'date'           => form_error('date'),
            );

            $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
        } else {
            $staff_id = $this->customlib->getStaffID();

            $follow_up = array(
                'date'        => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                'response'    => $this->input->post('response'),
                'note'        => $this->input->post('note'),
                'followup_by' => $staff_id,
                'enquiry_id'  => $this->input->post('enquiry_id'),
            );
            $this->enquiry_model->add_follow_up($follow_up);
            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        }

        echo json_encode($array);
    }

    public function follow_up_list($id)
    {
        $data['id']             = $id;
        $data['follow_up_list'] = $this->enquiry_model->getfollow_up_list($id);
        $this->load->view('admin/frontoffice/followuplist', $data);
    }

    public function details($id, $status)
    {
        if (!$this->rbac->hasPrivilege('admission_enquiry', 'can_view')) {
            access_denied();
        }
        $data['enquiry_doc'] = $this->student_model->getenquirydoc($id);
        $data['source']       = $this->enquiry_model->getComplaintSource();
        $data['enquiry_type'] = $this->enquiry_model->get_enquiry_type();
        $data['Reference']    = $this->enquiry_model->get_reference();        
        $data['class_list']   = $this->enquiry_model->getclasses();        
        $data['provinces']      = $this->province_model->get();
        $data['enquiry_status'] = $this->enquiry_status;
        $data['graduation_rank']= $this->graduation_rank;
        $data['train_type']     = $this->train_type;
        $data['trainingsystem'] = $this->training_system_model->get();
        $data['enquiry_data'] = $this->enquiry_model->getenquiry_list($id, $status);
        $data['stff_list']    = $this->staff_model->getEmployee(13);
        $data['khoa_tuyen_sinh']      = $this->enquiry_model->get_khoa_tuyen_sinh();
        $data['dot_tuyen_sinh']      = $this->enquiry_model->getComplaintType();
        $data['doi_tac']                = $this->enquiry_model->getDoiTac();
        $data['cb_data']                = $this->staff_model->getEmployee(20);
        $this->load->view('layout/header');
        $this->load->view('admin/frontoffice/enquiryedit', $data);
        $this->load->view('layout/footer');
    }

    public function editpost($id)
    {

        if (!$this->rbac->hasPrivilege('admission_enquiry', 'can_edit')) {
            access_denied();
        }
        $this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('contact', $this->lang->line('phone'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            $msg = array(
                'name'    => form_error('name'),
                'contact' => form_error('contact'),
            );

            $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
        } else {
            $enquiry_update = array(
                'first_name'     => $this->input->post('first_name'),
                'name'           => $this->input->post('name'),
                'profile_code'   => $this->input->post('profile_code'),
                'cccd'           => $this->input->post('cccd'),
                'contact'        => $this->input->post('contact'),
                
                'province_id'    => $this->input->post('province_id'),
                'district_id'    => $this->input->post('district_id'),
                'ward_id'        => $this->input->post('ward_id'),
                'address'        => $this->input->post('address'),
                'reference'      => $this->input->post('reference'),

                'nation'         => $this->input->post('nation'),
                'religion'       => $this->input->post('religion'),
                
                'graduation_year_thpt'                  => $this->input->post('graduation_year_thpt'),
                'graduation_rank_thpt'                  => $this->input->post('graduation_rank_thpt'),
                'graduation_school_thpt'                => $this->input->post('graduation_school_thpt'),
                'graduation_professional_year'          => $this->input->post('graduation_professional_year'),
                'graduation_rank_professional'          => $this->input->post('graduation_rank_professional'),
                'graduation_department_professional'    => $this->input->post('graduation_department_professional'),
                'graduation_train_type_professional'    => $this->input->post('graduation_train_type_professional'),
                'graduation_train_level_professional'   => $this->input->post('graduation_train_level_professional'),
                'graduation_professional_school'        => $this->input->post('graduation_professional_school'),
                
                'class_id'       => IsNullOrEmptyString($this->input->post('class')) ? NULL :$this->input->post('class'),
                'training_register_level'       => $this->input->post('training_register_level'),
                'training_register_type'       => $this->input->post('training_register_type'),
                'khoa_hoc'       => $this->input->post('khoa_hoc'),
                'dot_tuyen_sinh' => $this->input->post('dot_tuyen_sinh'),
                
                'date'           => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                'description'    => $this->input->post('description'),
                'note'           => $this->input->post('note'),
                'subject_arr'    => $this->input->post('subject_arr') ? json_encode($this->input->post('subject_arr')) : null,
                'average_score'  => $this->input->post('average_score'),
                'source'         => $this->input->post('source'),
                'email'          => $this->input->post('email'),
                'assigned'       => empty2null($this->input->post('assigned')),
                'cb_data'        => empty2null($this->input->post('cb_data')),
                'doi_tac'        => empty2null($this->input->post('doi_tac')),
                'le_phi'         => $this->input->post('le_phi'),
                
            );
            $this->enquiry_model->enquiry_update($id, $enquiry_update);
            $upload_dir_path  = $this->customlib->getFolderPath() . './uploads/student_documents/' . $id . '/';
            $upload_directory = './uploads/student_documents/' . $id . '/';
            $files  = $_FILES;
            if (!is_dir($upload_dir_path) && !mkdir($upload_dir_path)) {
                die("Error creating folder $upload_dir_path");
            }
            // add file
            if ($files) {
                $i= 0;
                foreach ($files as $key => $value)
                {
                    $title_doc    = $this->input->post('title'.$key);
                    $imp          = $this->media_storage->fileupload($key, $upload_directory);
                    $data_img     = array('enquiry_id' => $id, 'title' => $title_doc, 'doc' => $imp);
                    $this->student_model->adddoc($data_img);
                    $i++;
                }
            }
            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('update_message'));
        }
        redirect('/admin/enquiry', $array);
    }

    public function follow_up_delete($follow_up_id, $enquiry_id)
    {
        if (!$this->rbac->hasPrivilege('follow_up_admission_enquiry', 'can_delete')) {
            access_denied();
        }
        $this->enquiry_model->delete_follow_up($follow_up_id);
        $data['id']             = $enquiry_id;
        $data['follow_up_list'] = $this->enquiry_model->getfollow_up_list($enquiry_id);
        $this->load->view('admin/frontoffice/followuplist', $data);
    }

    public function check_default($post_string)
    {
        return $post_string == '' ? false : true;
    }

    public function change_status()
    {
        $id     = $this->input->post("id");
        $status = $this->input->post("status");
        if (!empty($id)) {
            $data = array('id' => $id, 'status' => $status);
            $this->enquiry_model->changeStatus($data);
            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        } else {
            $array = array('status' => 'fail', 'error' => '', 'message' => $this->lang->line('update_message'));
        }

        echo json_encode($array);
    }
    
    public function profile_approved()
    {
        $id     = $this->input->post("id");
        if (!empty($id)) {
            $data = array('id' => $id, 'status' => 'profile_approved');
            $this->enquiry_model->changeStatus($data);
            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        } else {
            $array = array('status' => 'fail', 'error' => '', 'message' => $this->lang->line('update_message'));
        }

        echo json_encode($array);
    }
    
    public function profile_won()
    {
        $id     = $this->input->post("id");
        if (!empty($id)) {
            $data = array('id' => $id, 'status' => 'won');
            $this->enquiry_model->changeStatus($data);
            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        } else {
            $array = array('status' => 'fail', 'error' => '', 'message' => $this->lang->line('update_message'));
        }

        echo json_encode($array);
    }

    public function check_number()
    {
        $phone_number = $this->input->post("phone_number");
        $check_number = $this->enquiry_model->check_number($phone_number);
        if (!empty($check_number)) {
            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('number_is_already_exists_and_name_is') . '  ' . $check_number['name']);
        } else {
            $array = array('status' => 'fail', 'error' => '', 'message' => '');
        }
        echo json_encode($array);
    }
    
    public function bao_cao_tuyen_sinh()
    {       
        $role            = $this->customlib->getStaffRole();
        $role_id         = json_decode($role)->id;
        $data['role_id'] = $role_id;

        $staffid       = $this->customlib->getStaffID();
        $notifications = $this->notification_model->getUnreadStaffNotification($staffid, $role_id);

        $data['notifications'] = $notifications;
        $input                 = $this->setting_model->getCurrentSessionName();

        list($a, $b)  = explode('-', $input);
        $Current_year = $a;
        if (strlen($b) == 2) {
            $Next_year = substr($a, 0, 2) . $b;
        } else {
            $Next_year = $b;
        }
        $data['mysqlVersion'] = $this->setting_model->getMysqlVersion();
        $data['sqlMode']      = $this->setting_model->getSqlMode();
        //========================== Current Attendence ==========================
        $current_date       = date('Y-m-d');
        $data['title']      = 'Dashboard';
        $Current_start_date = date('01');
        $Current_date       = date('d');
        $Current_month      = date('m');
        $month_collection   = 0;
        $month_expense      = 0;
        $total_students     = 0;
        $total_teachers     = 0;
        $ar                 = $this->startmonthandend();
        $year_str_month     = $Current_year . '-' . $ar[0] . '-01';
        $year_end_month     = date("Y-m-t", strtotime($Next_year . '-' . $ar[1] . '-01'));
        $getDepositeAmount  = $this->studentfeemaster_model->getDepositAmountBetweenDate($year_str_month, $year_end_month);
        $student_transport_fee = $this->studenttransportfee_model->getTransportDepositAmountBetweenDate($year_str_month, $year_end_month);
        
        //======================Current Month Collection ==============================
        $first_day_this_month     = date('Y-m-01');
        // $current_month_collection = $this->studentfeemaster_model->getDepositAmountBetweenDate($first_day_this_month, $current_date);
        $month_collection         = $this->whatever($getDepositeAmount, $first_day_this_month, $current_date);
        $month_transport_collection         = $this->whatever($student_transport_fee, $first_day_this_month, $current_date);

        $data['month_collection'] = $month_collection+$month_transport_collection;

        $tot_students = $this->studentsession_model->getTotalStudentBySession();
        if (!empty($tot_students)) {
            $total_students = $tot_students->total_student;
        }

        $data['total_students'] = $total_students;
        $tot_roles              = $this->role_model->get();
        foreach ($tot_roles as $key => $value) {

            $count_roles[$value["name"]] = $this->role_model->count_roles($value["id"]);

        }
        $data["roles"] = $count_roles;

        //======================== get collection by month ==========================
        $start_month = strtotime($year_str_month);
        $start       = strtotime($year_str_month);
        $end         = strtotime($year_end_month);
        $coll_month  = array();
        $s           = array();
        $total_month = array();
        while ($start_month <= $end) {
            $total_month[] = $this->lang->line(strtolower(date('F', $start_month)));
            $month_start   = date('Y-m-d', $start_month);
            $month_end     = date("Y-m-t", $start_month);
            $return        = $this->whatever($getDepositeAmount, $month_start, $month_end);
            $tranport_amt      = $this->whatever($student_transport_fee,  $month_start, $month_end);
            
            if (!IsNullOrEmptyString($return) || !IsNullOrEmptyString($tranport_amt)) {
                $s[] = convertBaseAmountCurrencyFormat($return+$tranport_amt);
            } else {
                $s[] = "0.00";
            }

            $start_month = strtotime("+1 month", $start_month);
        }
        //======================== getexpense by month ==============================
        $ex                  = array();
        $start_session_month = strtotime($year_str_month);
        while ($start_session_month <= $end) {

            $month_start = date('Y-m-d', $start_session_month);
            $month_end   = date("Y-m-t", $start_session_month);

            $expense_monthly = $this->expense_model->getTotalExpenseBwdate($month_start, $month_end);

            if (!empty($expense_monthly)) {
                $amt  = 0;
                $ex[] = $amt + convertBaseAmountCurrencyFormat($expense_monthly->amount);
            }

            $start_session_month = strtotime("+1 month", $start_session_month);
        }

        $data['yearly_collection'] = $s;
       
        $data['yearly_expense']    = $ex;
        $data['total_month']       = $total_month;

        //======================= current month collection /expense ===================
     
        // hardcoded '01' for first day
        $startdate       = date('m/01/Y');
        $enddate         = date('m/t/Y');
        $start           = strtotime($startdate);
        $end             = strtotime($enddate);
        $currentdate     = $start;
        $month_days      = array();
        $days_collection = array();
        while ($currentdate <= $end) {
            $cur_date          = date('Y-m-d', $currentdate);
            $month_days[]      = date('d', $currentdate);
            $coll_amt          = $this->whatever($getDepositeAmount, $cur_date, $cur_date);
            $tranport_amt      = $this->whatever($student_transport_fee, $cur_date, $cur_date);
            $days_collection[] = convertBaseAmountCurrencyFormat($coll_amt+$tranport_amt);
            $currentdate       = strtotime('+1 day', $currentdate);
        }
        $data['current_month_days'] = $month_days;
        $data['days_collection']    = $days_collection;


        //======================= current month /expense ==============================
        // hardcoded '01' for first day

        $startdate    = date('m/01/Y');
        $enddate      = date('m/t/Y');
        $start        = strtotime($startdate);
        $end          = strtotime($enddate);
        $currentdate  = $start;
        $days_expense = array();
        while ($currentdate <= $end) {
            $cur_date       = date('Y-m-d', $currentdate);
            $month_days[]   = date('d', $currentdate);
            $currentdate    = strtotime('+1 day', $currentdate);
            $ct             = $this->getExpensebyday($cur_date);
            $days_expense[] = convertBaseAmountCurrencyFormat($ct);
        }

        $data['days_expense']        = $days_expense;
        $student_fee_history         = $this->studentfee_model->getTodayStudentFees();
        $data['student_fee_history'] = $student_fee_history;

        $event_colors         = array("#03a9f4", "#c53da9", "#757575", "#8e24aa", "#d81b60", "#7cb342", "#fb8c00", "#fb3b3b");
        $data["event_colors"] = $event_colors;
        $userdata             = $this->customlib->getUserData();
        $data["role"]         = $userdata["user_type"];
        $start_date           = date('Y-m-01');
        $end_date             = date('Y-m-t');
        $current_month        = date('F');

        $student_due_fee       = $this->studentfeemaster_model->getFeesAwaiting($start_date, $end_date);
        $student_transport_fee = $this->studentfeemaster_model->getTransportFeesByDueDate($start_date, $end_date);

        $data['fees_awaiting'] = $student_due_fee;

        $total_fess    = 0;
        $total_paid    = 0;
        $total_unpaid  = 0;
        $total_partial = 0;

        if (!empty($student_transport_fee)) {

            foreach ($student_transport_fee as $transport_fees_key => $transport_fees_value) {

                $amount_to_be_taken = 0;
                if ($transport_fees_value->fees > 0) {
                    $amount_to_be_taken = $transport_fees_value->fees;
                }

                if ($amount_to_be_taken > 0) {
                    $total_fess++;

                    if (is_string($transport_fees_value->amount_detail) && is_array(json_decode($transport_fees_value->amount_detail, true)) && (json_last_error() == JSON_ERROR_NONE)) {
                        $amount_paid_details = (json_decode($transport_fees_value->amount_detail));
                        $amt_                = 0;
                        foreach ($amount_paid_details as $amount_paid_detail_key => $amount_paid_detail_value) {
                            $amt_ = $amt_ + $amount_paid_detail_value->amount;
                        }

                        if (($amt_ + $amount_paid_detail_value->amount_discount) >= $amount_to_be_taken) {
                            $total_paid++;
                        } elseif (($amt_ + $amount_paid_detail_value->amount_discount) < $amount_to_be_taken) {
                            $total_partial++;
                        }
                    } else {
                        $total_unpaid++;
                    }

                }
            }
        }

        if (!empty($data['fees_awaiting'])) {

            foreach ($data['fees_awaiting'] as $awaiting_key => $awaiting_value) {

                $amount_to_be_taken = 0;
                if ($awaiting_value->is_system) {
                    if ($awaiting_value->amount > 0) {
                        $amount_to_be_taken = $awaiting_value->amount;
                    }
                } elseif ($awaiting_value->is_system == 0) {
                    if ($awaiting_value->fee_amount > 0) {
                        $amount_to_be_taken = $awaiting_value->fee_amount;
                    }
                }

                if ($amount_to_be_taken > 0) {
                    $total_fess++;

                    if (is_string($awaiting_value->amount_detail) && is_array(json_decode($awaiting_value->amount_detail, true)) && (json_last_error() == JSON_ERROR_NONE)) {
                        $amount_paid_details = (json_decode($awaiting_value->amount_detail));
                        $amt_                = 0;
                        foreach ($amount_paid_details as $amount_paid_detail_key => $amount_paid_detail_value) {
                            $amt_ = $amt_ + $amount_paid_detail_value->amount;
                        }

                        if (($amt_ + $amount_paid_detail_value->amount_discount) >= $amount_to_be_taken) {
                            $total_paid++;
                        } elseif (($amt_ + $amount_paid_detail_value->amount_discount) < $amount_to_be_taken) {
                            $total_partial++;
                        }
                    } else {
                        $total_unpaid++;
                    }

                }
            }
        }

        $incomegraph = $this->income_model->getIncomeHeadsData($start_date, $end_date);
        foreach ($incomegraph as $key => $value) {
            $incomegraph[$key]['total'] = convertBaseAmountCurrencyFormat($value['total']);
        }
        $data['incomegraph'] = $incomegraph;

        $expensegraph = $this->expense_model->getExpenseHeadData($start_date, $end_date);
        foreach ($expensegraph as $key => $value) {
            $expensegraph[$key]['total'] = convertBaseAmountCurrencyFormat($value['total']);
            if (!empty($value['total'])) {
                $month_expense = $month_expense + convertBaseAmountCurrencyFormat($value['total']);
            }
        }
        $data['expensegraph']  = $expensegraph;
        $data['month_expense'] = $month_expense;

        $enquiry       = $this->admin_model->getAllEnquiryCount($start_date, $end_date);
        $total_counter = $total_paid + $total_unpaid + $total_partial;

        $data['fees_overview'] = array(
            'total_unpaid'     => $total_unpaid,
            'unpaid_progress'  => ($total_counter > 0) ? (($total_unpaid * 100) / $total_counter) : 0,
            'total_paid'       => $total_paid,
            'paid_progress'    => ($total_counter > 0) ? (($total_paid * 100) / $total_counter) : 0,
            'total_partial'    => $total_partial,
            'partial_progress' => ($total_counter > 0) ? (($total_partial * 100) / $total_counter) : 0,
        );

        $total_enquiry = $enquiry['total'];

        if ($total_enquiry > 0) {

            $data['enquiry_overview'] = array(
                'won'              => $enquiry['complete'],
                'won_progress'     => ($enquiry['complete'] * 100) / $total_enquiry,
                'active'           => $enquiry['active'],
                'active_progress'  => ($enquiry['active'] * 100) / $total_enquiry,
                'passive'          => $enquiry['passive'],
                'passive_progress' => ($enquiry['passive'] * 100) / $total_enquiry,
                'dead'             => $enquiry['dead'],
                'dead_progress'    => ($enquiry['dead'] * 100) / $total_enquiry,
                'lost'             => $enquiry['lost'],
                'lost_progress'    => ($enquiry['lost'] * 100) / $total_enquiry,
            );

        } else {

            $data['enquiry_overview'] = array(
                'won'              => 0,
                'won_progress'     => 0,
                'active'           => 0,
                'active_progress'  => 0,
                'passive'          => 0,
                'passive_progress' => 0,
                'dead'             => 0,
                'dead_progress'    => 0,
                'lost'             => 0,
                'lost_progress'    => 0,
            );

        }

        $data['total_paid'] = $total_paid;
        $data['total_fees'] = $total_fess;
        if ($total_fess > 0) {
            $data['fessprogressbar'] = ($total_paid * 100) / $total_fess;
        } else {
            $data['fessprogressbar'] = 0;
        }

        $data['total_enquiry']  = $total_enquiry  = $enquiry['total'];
        $data['total_complete'] = $complete_enquiry = $enquiry['complete'];
        if ($total_enquiry > 0) {
            $data['fenquiryprogressbar'] = ($complete_enquiry * 100) / $total_enquiry;
        } else {
            $data['fenquiryprogressbar'] = 0;
        }

        $bookoverview      = $this->book_model->bookoverview($start_date, $end_date);
        $bookduereport     = $this->bookissue_model->dueforreturn($start_date, $end_date);
        $forreturndata     = $this->bookissue_model->forreturn($start_date, $end_date);
        $dueforreturn      = $bookduereport[0]['total'];
        $forreturn         = $forreturndata[0]['total'];
        $total_qty         = $bookoverview[0]['qty'];
        $total_issued      = $bookoverview[0]['total_issue'];
        $availble          = '0';
        $availble_progress = 0;
        $issued_progress   = 0;

        if ($total_qty > 0) {
            $availble          = $total_qty - $total_issued;
            $availble_progress = ($availble * 100) / $total_qty;
            $issued_progress   = ($total_issued * 100) / $total_qty;
        }

        $data['book_overview'] = array(
            'total'             => $total_qty,
            'total_progress'    => 100,
            'availble'          => $availble,
            'availble_progress' => round($availble_progress, 2),
            'total_issued'      => $total_issued,
            'issued_progress'   => round($issued_progress, 2),
            'dueforreturn'      => $dueforreturn,
            'forreturn'         => $forreturn,
        );

        $Attendence                   = $this->stuattendence_model->getTodayDayAttendance($total_students);
        $data['attendence_data']      = $Attendence;
        $Staffattendence              = $this->Staff_model->getTodayDayAttendance();
        $data['Staffattendence_data'] = $Staffattendence;
        $getTotalStaff                = $this->Staff_model->getTotalStaff();
        $data['getTotalStaff_data']   = $getTotalStaff;
        if ($getTotalStaff > 0) {$percentTotalStaff_data = ($Staffattendence * 100) / ($getTotalStaff);} else { $percentTotalStaff_data = '0';}
        $data['percentTotalStaff_data'] = $percentTotalStaff_data;
        $data['sch_setting']            = $this->sch_setting_detail;

        if ($data['sch_setting']->attendence_type == 0) {
            $data['std_graphclass'] = "col-lg-3 col-md-6 col-sm-6";
        } else {
            $data['std_graphclass'] = "col-lg-4 col-md-6 col-sm-6";
        }

        $this->load->view('layout/header', $data);
        $this->load->view('admin/frontoffice/bao_cao', $data);
        $this->load->view('layout/footer', $data);
    }
}
