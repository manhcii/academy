<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice{color: #100f0f;}
    .select2-container--default .select2-selection--multiple .select2-selection__choice__display{padding-left: 16px;}
</style>    
<div class="content-wrapper">
    <section class="content-header">
        <h1><i class="fa fa-sitemap"></i> <?php echo $this->lang->line('human_resource'); ?></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form id="form1" action="<?php echo site_url('admin/staff/create') ?>" id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="alert alert-info">
                                Email nhân viên là tên người dùng đăng nhập, mật khẩu được tạo tự động và gửi đến email nhân viên. Quản trị viên cấp cao có thể thay đổi mật khẩu nhân viên trên trang hồ sơ nhân viên của họ.
                            </div>
                            <div class="tshadow mb25 bozero">
                                <div class="box-tools pull-right pt3">
                                    <a class="btn btn-sm btn-primary" href="<?php echo base_url(); ?>admin/staff/import" autocomplete="off"><i class="fa fa-plus"></i> <?php echo $this->lang->line('import_staff'); ?></a>
                                </div>
                                <h4 class="pagetitleh2"><?php echo $this->lang->line('basic_information'); ?> </h4>

                                <div class="around10">

                                    <?php if ($this->session->flashdata('msg')) {
                                    ?>
                                        <?php echo $this->session->flashdata('msg');
                                        $this->session->unset_userdata('msg'); ?>
                                    <?php } ?>
                                    <?php echo $this->customlib->getCSRF(); ?>

                                    <div class="row">
                                        <?php
                                        if (!$staffid_auto_insert) {
                                        ?>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('staff_id'); ?></label><small class="req"> *</small>
                                                    <input autofocus="" id="employee_id" name="employee_id" placeholder="" type="text" class="form-control" value="<?php echo set_value('employee_id') ?>" />
                                                    <span class="text-danger"><?php echo form_error('employee_id'); ?></span>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('role'); ?></label><small class="req"> *</small>
                                                <select id="role" name="role" class="form-control">
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    <?php
                                                    foreach ($roles as $key => $role) {
                                                    ?>
                                                        <option value="<?php echo $role['id'] ?>" <?php echo set_select('role', $role['id'], set_value('role')); ?>><?php echo $role["name"]; ?></option>
                                                    <?php }
                                                    ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('role'); ?></span>
                                            </div>
                                        </div>
                                        <?php if ($sch_setting->staff_designation) {
                                        ?>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('designation'); ?></label>

                                                    <select id="designation" name="designation" placeholder="" type="text" class="form-control">
                                                        <option value=""><?php echo $this->lang->line('select') ?></option>
                                                        <?php foreach ($designation as $key => $value) {
                                                        ?>
                                                            <option value="<?php echo $value["id"] ?>" <?php echo set_select('designation', $value['id'], set_value('designation')); ?>><?php echo $value["designation"] ?></option>
                                                        <?php }
                                                        ?>
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('designation'); ?></span>
                                                </div>
                                            </div>
                                        <?php }
                                        if ($sch_setting->staff_department) {
                                        ?>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('department'); ?></label>
                                                    <select id="department" name="department" placeholder="" type="text" class="form-control">
                                                        <option value=""><?php echo $this->lang->line('select') ?></option>
                                                        <?php foreach ($department as $key => $value) {
                                                        ?>
                                                            <option value="<?php echo $value["id"] ?>" <?php echo set_select('department', $value['id'], set_value('department')); ?>><?php echo $value["department_name"] ?></option>
                                                        <?php }
                                                        ?>
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('department'); ?></span>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('position'); ?></label><small class="req"> *</small>
                                                <select id="positions" name="positions[]" class="form-control" multiple="multiple">
                                                    <?php
                                                    foreach ($positions as $key => $position) {
                                                    ?>
                                                        <option value="<?php echo $position['id'] ?>" <?php echo set_select('positions[]', $position['id'], set_value('positions[]')); ?>><?php echo $position["name"]; ?></option>
                                                    <?php }
                                                    ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('positions[]'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('subject_teaching'); ?></label><small class="req"> *</small>
                                                <select id="subjects" name="subjects[]" class="form-control" multiple="multiple">
                                                    <?php
                                                    foreach ($subjects as $key => $subject) {
                                                    ?>
                                                        <option value="<?php echo $subject['id'] ?>" <?php echo set_select('subjects[]', $subject['id'], set_value('subjects[]')); ?>><?php echo $subject["name"]; ?></option>
                                                    <?php }
                                                    ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('subjects[]'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('graduate_expertise'); ?></label>
                                                    <textarea style="height: 32px;" id="graduate_expertise" name="graduate_expertise" placeholder="" class="form-control"><?php echo set_value('graduate_expertise') ?></textarea>
                                                    <span class="text-danger"><?php echo form_error('graduate_expertise'); ?></span>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('first_name'); ?></label><small class="req"> *</small>
                                                <input id="name" name="name" placeholder="" type="text" class="form-control" value="<?php echo set_value('name') ?>" />
                                                <span class="text-danger"><?php echo form_error('name'); ?></span>
                                            </div>
                                        </div>
                                        <?php if ($sch_setting->staff_last_name) { ?>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('last_name'); ?></label>
                                                    <input id="surname" name="surname" placeholder="" type="text" class="form-control" value="<?php echo set_value('surname') ?>" />
                                                    <span class="text-danger"><?php echo form_error('surname'); ?></span>
                                                </div>
                                            </div>
                                        <?php }
                                        if ($sch_setting->staff_father_name) { ?>
                                            <div style="display: none" class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('father_name'); ?></label>
                                                    <input id="father_name" name="father_name" placeholder="" type="text" class="form-control" value="<?php echo set_value('father_name') ?>" />
                                                    <span class="text-danger"><?php echo form_error('father_name'); ?></span>
                                                </div>
                                            </div>
                                        <?php }
                                        if ($sch_setting->staff_mother_name) { ?>
                                            <div style="display: none" class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('mother_name'); ?></label>
                                                    <input id="mother_name" name="mother_name" placeholder="" type="text" class="form-control" value="<?php echo set_value('mother_name') ?>" />
                                                    <span class="text-danger"><?php echo form_error('mother_name'); ?></span>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('class'); ?></label>

                                                <select id="class" name="class" placeholder="" type="text" class="form-control">
                                                    <option value=""><?php echo $this->lang->line('select') ?></option>
                                                    <?php foreach ($classlist as $key => $value) {
                                                    ?>
                                                        <option value="<?php echo $value["id"] ?>" <?php echo set_select('class', $value['id'], set_value('class')); ?>><?php echo $value["class"] ?></option>
                                                    <?php }
                                                    ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('class'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('type_of_teacher'); ?></label>

                                                <select id="type_of_teacher" name="type_of_teacher" placeholder="" type="text" class="form-control">
                                                    <option value=""><?php echo $this->lang->line('select') ?></option>
                                                    <?php foreach ($teachercategory as $key => $value) {
                                                    ?>
                                                        <option value="<?php echo $value["id"] ?>" <?php echo set_select('teachercategory', $value['id'], set_value('teachercategory')); ?>><?php echo $value["name"] ?></option>
                                                    <?php }
                                                    ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('class'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('email'); ?> (<?php echo $this->lang->line('login') . " " . $this->lang->line('username'); ?>)</label><small class="req"> *</small>
                                                <input id="email" name="email" placeholder="" type="text" class="form-control" value="<?php echo set_value('email') ?>" />
                                                <span class="text-danger"><?php echo form_error('email'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputFile"> <?php echo $this->lang->line('gender'); ?></label><small class="req"> *</small>
                                                <select class="form-control" name="gender">
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    <?php
                                                    foreach ($genderList as $key => $value) {
                                                    ?>
                                                        <option value="<?php echo $key; ?>" <?php echo set_select('gender', $key, set_value('gender')); ?>><?php echo $value; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('gender'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('date_of_birth'); ?></label><small class="req"> *</small>
                                                <input id="dob" name="dob" placeholder="" type="text" class="form-control date" value="<?php echo set_value('dob') ?>" />
                                                <span class="text-danger"><?php echo form_error('dob'); ?></span>
                                            </div>
                                        </div>
                                        <?php if ($sch_setting->staff_date_of_joining) { ?>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('date_of_joining'); ?></label>
                                                    <input id="date_of_joining" name="date_of_joining" value="<?= date('d/m/Y',time()) ?>" placeholder="" type="text" class="form-control date" value="<?php echo set_value('date_of_joining') ?>" />
                                                    <span class="text-danger"><?php echo form_error('date_of_joining'); ?></span>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="row">
                                        <?php if ($sch_setting->staff_phone) { ?>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('phone'); ?></label>
                                                    <input id="mobileno" name="contactno" placeholder="" type="text" class="form-control" value="<?php echo set_value('contactno') ?>" />
                                                    <span class="text-danger"><?php echo form_error('contactno'); ?></span>
                                                </div>
                                            </div>
                                        <?php }
                                        if ($sch_setting->staff_emergency_contact) { ?>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('emergency_contact_number'); ?></label>
                                                    <input id="mobileno" name="emergency_no" placeholder="" type="text" class="form-control" value="<?php echo set_value('emergency_no') ?>" />
                                                    <span class="text-danger"><?php echo form_error('emergency_no'); ?></span>
                                                </div>
                                            </div>
                                        <?php }
                                        if ($sch_setting->staff_marital_status) {
                                        ?>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('marital_status'); ?></label>
                                                    <select class="form-control" name="marital_status">
                                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                        <?php foreach ($marital_status as $makey => $mavalue) {
                                                        ?>
                                                            <option value="<?php echo $mavalue ?>" <?php echo set_select('marital_status', $mavalue, set_value('marital_status')); ?>><?php echo $mavalue; ?></option>

                                                        <?php } ?>

                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('marital_status'); ?></span>
                                                </div>
                                            </div>
                                        <?php }
                                        if ($sch_setting->staff_photo) { ?>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInputFile"><?php echo $this->lang->line('photo'); ?></label>
                                                    <div><input class="filestyle form-control" type='file' name='file' id="file" size='20' />
                                                    </div>
                                                    <span class="text-danger"><?php echo form_error('file'); ?></span>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="row">
                                        <?php if ($sch_setting->staff_current_address) { ?>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputFile"><?php echo $this->lang->line('current'); ?> <?php echo $this->lang->line('address'); ?></label>
                                                    <div><textarea name="address" class="form-control"><?php echo set_value('address'); ?></textarea>
                                                    </div>
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                        <?php }
                                        if ($sch_setting->staff_permanent_address) { ?>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputFile"><?php echo $this->lang->line('permanent_address'); ?></label>
                                                    <div><textarea name="permanent_address" class="form-control"><?php echo set_value('permanent_address'); ?></textarea>
                                                    </div>
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                        <?php }
                                        if ($sch_setting->staff_qualification) { ?>
                                            <div class="col-md-3">

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('qualification'); ?></label>
                                                    <textarea id="qualification" name="qualification" placeholder="" class="form-control"><?php echo set_value('qualification') ?></textarea>
                                                    <span class="text-danger"><?php echo form_error('qualification'); ?></span>
                                                </div>
                                            </div>
                                        <?php }
                                        if ($sch_setting->staff_work_experience) { ?>
                                            <div class="col-md-3">

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('work_experience'); ?></label>
                                                    <textarea id="work_exp" name="work_exp" placeholder="" class="form-control"><?php echo set_value('work_exp') ?></textarea>
                                                    <span class="text-danger"><?php echo form_error('work_exp'); ?></span>
                                                </div>
                                            </div>
                                        <?php }
                                        if ($sch_setting->staff_note) { ?>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputFile"><?php echo $this->lang->line('note'); ?></label>
                                                    <div><textarea name="note" class="form-control"><?php echo set_value('note'); ?></textarea>
                                                    </div>
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <div class="row">
                                        <?php
                                        echo display_custom_fields('staff');
                                        ?>
                                    </div>
                                </div>
                            </div>
                                <div class="tshadow mb25 bozero displaynone">
                                    <h4 class="pagetitleh2">Thông tin khác</h4>
                                    <div class="row around10">
                                        <?php if ($sch_setting->staff_epf_no) { ?>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('epf_no'); ?></label>
                                                    <input id="epf_no" name="epf_no" placeholder="" type="text" class="form-control" value="<?php echo set_value('epf_no') ?>" />
                                                    <span class="text-danger"><?php echo form_error('epf_no'); ?></span>
                                                </div>
                                            </div>
                                        <?php }
                                        if ($sch_setting->staff_basic_salary) { ?>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('basic_salary'); ?></label>
                                                    <input type="text" class="form-control" name="basic_salary" value="<?php echo set_value('basic_salary') ?>">
                                                </div>
                                            </div>
                                        <?php }
                                        if ($sch_setting->staff_contract_type) { ?>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('contract_type'); ?></label>
                                                    <select class="form-control" name="contract_type">
                                                        <option value=""><?php echo $this->lang->line('select') ?></option>
                                                        <?php foreach ($contract_type as $key => $value) { ?>
                                                            <option value="<?php echo $key ?>" <?php echo set_select('contract_type', $key, set_value('contract_type')); ?>><?php echo $value ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('contract_type'); ?></span>
                                                </div>
                                            </div>
                                        <?php }
                                        if ($sch_setting->staff_work_shift) { ?>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('work_shift'); ?></label>
                                                    <input id="shift" name="shift" placeholder="" type="text" class="form-control" value="<?php echo set_value('shift') ?>" />
                                                    <span class="text-danger"><?php echo form_error('shift'); ?></span>
                                                </div>
                                            </div>
                                        <?php }
                                        if ($sch_setting->staff_work_location) { ?>
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('work_location'); ?></label>
                                                    <input id="location" name="location" placeholder="" type="text" class="form-control" value="<?php echo set_value('location') ?>" />
                                                    <span class="text-danger"><?php echo form_error('location'); ?></span>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php if ($sch_setting->staff_social_media) { ?>
                                    <div class="tshadow mb25 bozero">
                                        <h4 class="pagetitleh2"><?php echo $this->lang->line('social_media_link'); ?>
                                        </h4>

                                        <div class="row around10">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('facebook_url'); ?></label>
                                                    <input id="bank_account_no" name="facebook" placeholder="" type="text" class="form-control" value="<?php echo set_value('facebook') ?>" />
                                                    <span class="text-danger"><?php echo form_error('facebook'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('twitter_url'); ?></label>
                                                    <input id="bank_account_no" name="twitter" placeholder="" type="text" class="form-control" value="<?php echo set_value('twitter') ?>" />
                                                    <span class="text-danger"><?php echo form_error('twitter_profile'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('linkedin_url'); ?></label>
                                                    <input id="bank_name" name="linkedin" placeholder="" type="text" class="form-control" value="<?php echo set_value('linkedin') ?>" />
                                                    <span class="text-danger"><?php echo form_error('linkedin'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('instagram_url'); ?></label>
                                                    <input id="instagram" name="instagram" placeholder="" type="text" class="form-control" value="<?php echo set_value('instagram') ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                                if ($sch_setting->staff_upload_documents) { ?>
                                            <div id='upload_documents_hide_show'>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="tshadow bozero">
                                                            <h4 class="pagetitleh2"><?php echo $this->lang->line('upload_documents'); ?></h4>

                                                            <div class="row around10">
                                                                <div class="col-md-6">
                                                                    <table class="table">
                                                                        <tbody>
                                                                            <tr>
                                                                                <th style="width: 10px">#</th>
                                                                                <th><?php echo $this->lang->line('title'); ?></th>
                                                                                <th><?php echo $this->lang->line('documents'); ?></th>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>1.</td>
                                                                                <td>File tài liệu</td>
                                                                                <td>
                                                                                    <input class="filestyle form-control" type='file' name='first_doc' id="doc1">
                                                                                    <span class="text-danger"><?php echo form_error('first_doc'); ?></span>
                                                                                </td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td>3.</td>
                                                                                <td>File tài liệu</td>
                                                                                <td>
                                                                                    <input class="filestyle form-control" type='file' name='third_doc' id="doc3">

                                                                                    <span class="text-danger"><?php echo form_error('third_doc'); ?></span>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <table class="table">
                                                                        <tbody>
                                                                            <tr>
                                                                                <th style="width: 10px">#</th>
                                                                                <th><?php echo $this->lang->line('title'); ?></th>
                                                                                <th><?php echo $this->lang->line('documents'); ?></th>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>2.</td>
                                                                                <td>File tài liệu</td>
                                                                                <td>
                                                                                    <input class="filestyle form-control" type='file' name='second_doc' id="doc2">
                                                                                    <span class="text-danger"><?php echo form_error('second_doc'); ?></span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>4.</td>
                                                                                <td>File tài liệu<input type="hidden" name='fourth_title' class="form-control" placeholder="Other Documents"></td>
                                                                                <td>
                                                                                    <input class="filestyle form-control" type='file' name='fourth_doc' id="doc4">
                                                                                    <span class="text-danger"><?php echo form_error('fourth_doc'); ?></span>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" id="submitbtn" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
</section>
</div>

<script>
    $(function() {
        $('#form1').submit(function() {
            $("#submitbtn").button('loading');
        });
    })
    $(document).ready(function() {
        $('#positions, #subjects').select2();
    });
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/js/savemode.js"></script>