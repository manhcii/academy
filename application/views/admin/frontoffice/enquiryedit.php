<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<link href="<?php echo base_url(); ?>backend/multiselect/css/jquery.multiselect.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>backend/multiselect/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>backend/multiselect/js/jquery.multiselect.js"></script>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                        <form  action="<?php echo site_url('admin/enquiry/editpost/'.$enquiry_data['id']) ?>" id="myForm1" enctype="multipart/form-data" method="post">
                            <div class="bozero">
                                <h4 class="pagetitleh-whitebg">Thêm mới hồ sơ</h4>
                                <div class="around10">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="pwd">Họ</label>
                                                <input type="text" id="first_name_add" value="<?php echo set_value('first_name', $enquiry_data['first_name']); ?>" autocomplete="off" class="form-control" name="first_name">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="pwd"><?php echo $this->lang->line('name'); ?></label><small class="req"> *</small>  
                                                <input type="text" class="form-control" id="name_value" value="<?php echo set_value('name', $enquiry_data['name']); ?>" name="name">
                                                <span class="text-danger" id="name"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="pwd"><?php echo $this->lang->line('phone'); ?></label><small class="req"> *</small>
                                                <input id="number" name="contact" placeholder="" type="text" class="form-control"  value="<?php echo set_value('contact', $enquiry_data['contact']); ?>" />
                                                <span class="text-danger"><?php echo form_error('contact'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="pwd">Mã hồ sơ</label>
                                                <input type="text" id="profile_code" autocomplete="off" value="<?php echo set_value('profile_code', $enquiry_data['profile_code']); ?>" class="form-control" value="<?php echo set_value('profile_code'); ?>" name="profile_code">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="pwd">CCCD</label>
                                                <input type="text" id="cccd" autocomplete="off" class="form-control" value="<?php echo set_value('cccd', $enquiry_data['cccd']); ?>" value="<?php echo set_value('cccd'); ?>" name="cccd">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('email'); ?></label>
                                                <input type="text" value="<?php echo set_value('email', $enquiry_data['email']); ?>" name="email" class="form-control">
                                                <span class="text-danger"><?php echo form_error('email'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="pwd">Tỉnh/ Thành Phố</label>
                                                <select name="province_id" id="province_id" class="form-control">
                                                    <option value=""><?php echo $this->lang->line('select') ?></option>
                                                    <?php
                                                    foreach ($provinces as $key => $value) {
                                                    ?>
                                                        <option <?php
                                                        if ($enquiry_data['province_id'] == $value['province_id']) {
                                                            echo "selected";
                                                        }
                                                        ?> value="<?php echo $value['province_id'] ?>"><?php echo $value['name'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div><!--./form-group-->
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Quận/ Huyện</label>
                                                <select id="district_id" name="district_id" class="form-control">
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('district_id'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Phường/ Xã</label>
                                                <select id="ward_id" name="ward_id" class="form-control">
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('ward_id'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="email"><?php echo $this->lang->line('address'); ?></label> 
                                                <textarea name="address" class="form-control"><?php echo set_value('address', trim($enquiry_data['address'])) ?></textarea>
                                                <span class="text-danger"><?php echo form_error('address'); ?></span>
                                            </div>
                                        </div>
                                            <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="email"><?php echo $this->lang->line('description'); ?></label>
                                                <textarea name="description" class="form-control" ><?php echo set_value('description', $enquiry_data['description']); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="pwd"><?php echo $this->lang->line('note'); ?></label> 
                                                <textarea name="note" class="form-control" ><?php echo set_value('note', $enquiry_data['note']); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Dân tộc</label>
                                                <input type="text" value="<?php echo set_value('nation', $enquiry_data['nation']); ?>" name="nation" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Tôn giáo</label>
                                                <input type="text" value="<?php echo set_value('religion', $enquiry_data['religion']); ?>" name="religion" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="pagetitleh2">Học Văn Hóa THPT</h4>
                                <div class="around10">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Năm tốt nghiệp THPT</label>
                                                <input type="text" value="<?php echo set_value('graduation_year_thpt', $enquiry_data['graduation_year_thpt']); ?>" name="graduation_year_thpt" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Hạng tốt nghiệp THPT</label>
                                                    <select class="form-control" id="graduation_rank_thpt" name="graduation_rank_thpt">
                                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                        <?php
                                                            foreach ($graduation_rank as $key => $value) {
                                                                ?>
                                                            <option <?php if (set_value('graduation_rank_thpt', $enquiry_data['graduation_rank_thpt']) == $key) { ?> selected="" <?php } ?> value="<?php echo $key ?>"><?php echo $value ?></option>
                                                        <?php }?>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Trường THPT</label>
                                                <input type="text" value="<?php echo set_value('graduation_school_thpt', $enquiry_data['graduation_school_thpt']); ?>" name="graduation_school_thpt" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="pagetitleh2">Học Chuyên Môn</h4>
                                <div class="around10">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Năm tốt nghiệp chuyên môn</label>
                                                <input type="text" value="<?php echo set_value('graduation_professional_year', $enquiry_data['graduation_professional_year']); ?>" name="graduation_professional_year" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Hạng tốt nghiệp chuyên môn</label>
                                                <select id="graduation_rank_professional" name="graduation_rank_professional" class="form-control">
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    <?php
                                                        foreach ($graduation_rank as $key => $value) {
                                                            ?>
                                                        <option <?php if (set_value('graduation_rank_professional', $enquiry_data['graduation_rank_professional']) == $key) { ?> selected="" <?php } ?> value="<?php echo $key ?>"><?php echo $value ?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Ngành tốt nghiệp chuyên môn</label>
                                                <input type="text" value="<?php echo set_value('graduation_department_professional', $enquiry_data['graduation_department_professional']); ?>" name="graduation_department_professional" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Hình thức đào tạo chuyên môn</label>
                                                <select id="graduation_train_type_professional" name="graduation_train_type_professional" class="form-control">
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    <?php
                                                        foreach ($train_type as $key => $value) {
                                                            ?>
                                                        <option <?php if (set_value('graduation_train_type_professional', $enquiry_data['graduation_train_type_professional']) == $key) { ?> selected="" <?php } ?> value="<?php echo $key ?>"><?php echo $value ?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Bậc đào tạo chuyên môn</label>
                                                <select id="graduation_train_level_professional" name="graduation_train_level_professional" class="form-control">
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    <?php
                                                        if (!empty($trainingsystem)) {
                                                            foreach ($trainingsystem as $item) { ?>
                                                                <option
                                                                <?php
                                                                    if (set_value('class', $enquiry_data['graduation_train_level_professional']) == $item['id']) {
                                                                                echo "selected=selected";
                                                                            }
                                                                ?>
                                                                value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option> 
                                                            <?php }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Trường học chuyên môn</label>
                                                <input type="text" value="<?php echo set_value('graduation_professional_school', $enquiry_data['graduation_professional_school']); ?>" name="graduation_professional_school" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="pagetitleh2">CBTS và Nguồn</h4>
                                <div class="around10">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="pwd"><?php echo $this->lang->line('date'); ?><small class="req"> *</small></label>
                                                <input type="text" id="date_edit" name="date" class="form-control date" value="<?php
                                                if (!empty($enquiry_data['date'])) {
                                                    echo set_value('date', date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($enquiry_data['date'])));
                                                }
                                                ?>" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Cán bộ tuyển sinh</label>
                        						<select name="assigned" class="form-control">
                                                    <option value=""><?php echo $this->lang->line('select') ?></option>  
                                                    <?php foreach ($stff_list as $key => $stff_list_value) { ?>
                                                         <option value="<?php echo $stff_list_value['id']; ?>" <?php if ($stff_list_value['id'] == $enquiry_data['assigned']) { ?>selected=""<?php } ?> ><?php echo $stff_list_value['name'].' '.$stff_list_value['surname']; ?> (<?php echo $stff_list_value['employee_id']; ?>)</option>    
                                                    <?php }   ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Cán bộ Data</label>
                                                <select name="cb_data" class="form-control">
                                                    <option value=""><?php echo $this->lang->line('select') ?></option>
                                                    <?php foreach ($cb_data as $value) { ?>
                                                        <option 
                                                        <?php if ($value['id'] == $enquiry_data['cb_data']) { ?>selected=""<?php } ?>
                                                        value="<?php echo $value['id']; ?>"><?php echo $this->customlib->getStaffFullName($value['name'], $value['surname'],  $value['employee_id']); ?></option>
                                                    <?php }
                                                    ?>
                                                </select>
                                            </div><!--./form-group-->
                                        </div>
                                        <div class="col-sm-4">
                                            <?= $enquiry_data['doi_tac'] ?>
                                            <div class="form-group">
                                                <label>Đối tác</label>
                                                <select name="doi_tac" class="form-control">
                                                    <option value=""><?php echo $this->lang->line('select') ?></option>
                                                    <?php foreach ($doi_tac as $key => $value) { ?>
                                                        <option 
                                                        <?php if ($value['id'] == $enquiry_data['doi_tac']) { ?>selected=""<?php } ?>
                                                        value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                                    <?php }
                                                    ?>
                                                </select>
                                            </div><!--./form-group-->
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="pwd"><?php echo $this->lang->line('reference'); ?></label>   
                                                <select name="reference" class="form-control">
                                                    <option value=""><?php echo $this->lang->line('select') ?></option>
                                                    <?php foreach ($Reference as $key => $value) { ?>
                                                        <option value="<?php echo $value['reference']; ?>" <?php if (set_value('reference', $enquiry_data['reference']) == $value['reference']) { ?>selected=""<?php } ?>><?php echo $value['reference']; ?></option>    
                                                    <?php }
                                                    ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('reference'); ?></span>
                                            </div>
                                        </div>    
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="pwd"><?php echo $this->lang->line('source'); ?></label><small class="req"> *</small>
                                                <select name="source" class="form-control">
                                                    <option value=""><?php echo $this->lang->line('select') ?></option>
                                                    <?php foreach ($source as $key => $value) { ?>
                                                        <option value="<?php echo $value['source']; ?>"<?php
                                                        if ($enquiry_data['source'] == $value['source']) {
                                                            echo "selected";
                                                        }
                                                        ?>><?php echo $value['source']; ?></option>
                                                    <?php }
                                                    ?> 
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Lệ phí tuyển sinh</label>
                                                <input type="text" value="<?php echo set_value('le_phi', $enquiry_data['le_phi']); ?>" placeholder="Lệ phí tuyển sinh" name="le_phi" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="pagetitleh2">Đăng Ký Tuyển Sinh</h4>
                                <div class="around10">
                                    <div class="row">
                                       <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="pwd"><?php echo $this->lang->line('class'); ?></label> 
                                                <select name="class" class="form-control"  >
                                                    <option value="" selected=""><?php echo $this->lang->line('select') ?></option>
                                                    <?php
                                                    foreach ($class_list as $key => $value) {
                                                        ?>
                                                        <option value="<?php echo $value['id'] ?>" <?php if (set_value('class', $enquiry_data['class_id']) == $value['id']) { ?> selected="" <?php } ?>><?php echo $value['class'] ?></option>
                        
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Bậc đào tạo</label>
                                                <select class="form-control" id="training_register_level" name="training_register_level">
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    <?php
                                                        if (!empty($trainingsystem)) {
                                                            foreach ($trainingsystem as $item) { ?>
                                                                <option
                                                                <?php
                                                                    if (set_value('training_system_id', $enquiry_data['training_register_level']) == $item['id']) {
                                                                                echo "selected=selected";
                                                                            }
                                                                ?>
                                                                value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option> 
                                                            <?php }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Hình thức đào tạo</label>
                                                <select class="form-control" id="training_register_type" name="training_register_type">
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    <?php
                                                        foreach ($train_type as $key => $value) {
                                                            ?>
                                                        <option <?php if (set_value('training_register_type', $enquiry_data['training_register_type']) == $key) { ?> selected="" <?php } ?> value="<?php echo $key ?>"><?php echo $value ?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="pwd">Khóa học</label>
                                                <select name="khoa_hoc" class="form-control">
                                                    <option value=""><?php echo $this->lang->line('select') ?></option>
                                                    <?php
                                                    foreach ($khoa_tuyen_sinh as $key => $value) {
                                                    ?>
                                                        <option
                                                        <?php if (set_value('khoa_hoc', $enquiry_data['khoa_hoc']) == $value['id']) { ?> selected="" <?php } ?>
                                                        value="<?php echo $value['id'] ?>" <?php if (set_value('class') == $value['id']) { ?> selected="" <?php } ?>><?php echo $value['visitors_purpose'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div><!--./form-group-->
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="pwd">Đợt tuyển sinh</label>
                                                <select name="dot_tuyen_sinh" class="form-control">
                                                    <option value=""><?php echo $this->lang->line('select') ?></option>
                                                    <?php
                                                    foreach ($dot_tuyen_sinh as $key => $value) {
                                                    ?>
                                                        <option
                                                        <?php if (set_value('dot_tuyen_sinh', $enquiry_data['dot_tuyen_sinh']) == $value['id']) { ?> selected="" <?php } ?>
                                                        value="<?php echo $value['id'] ?>" <?php if (set_value('class') == $value['id']) { ?> selected="" <?php } ?>><?php echo $value['complaint_type'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div><!--./form-group-->
                                        </div>
                                    </div>
                                </div>
                                <div class="around10">
                                    <div class="row">
                                        <div>
                                            <div>
                                                <div class="col-lg-6">
                                                    <div class="bozero">
                                                        <h4 class="pagetitleh2">Điểm xét tuyển</h4>
                                                        <div>
                                                            <table class="table table-subject">
                                                                <tbody>
                                                                    <tr>
                                                                        <th style="width: 10px">STT</th>
                                                                        <th>Môn Xét Tuyển</th>
                                                                        <th>Điểm</th>
                                                                        <th class="text-center">Hoạt động</th>
                                                                    </tr>
                                                                    <?php 
                                                                        if(isset($enquiry_data['subject_arr']) && $enquiry_data['subject_arr'] != null):
                                                                            $average_score = json_decode($enquiry_data['subject_arr']);
                                                                    ?>
                                                                    <?php $j=1;$i=0;foreach($average_score as $value): ?>
                                                                    <tr class="tr-subject">
                                                                        <td class="text-center"><?= $j; ?>.</td>
                                                                        <td>
                                                                            <input value="<?= $value[0] ?>" type="text" name="subject_arr[<?= $i ?>][]" class="form-control" placeholder="">
                                                                        </td>
                                                                        <td>
                                                                            <input value="<?= $value[1] ?>" onkeyup="writing_point()" type="text" name="subject_arr[<?= $i ?>][]" class="point form-control" placeholder="">
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <a onclick="removeSubject(this)" class="btn btn-default btn-xs"><i class="fa fa-remove"></i></a>
                                                                        </td>
                                                                    </tr>
                                                                    <?php $j++;$i++;endforeach;endif; ?>
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td colspan="2" class="text-right">Điểm TB xét tuyển</td>
                                                                        <td colspan="2">
                                                                             &nbsp;&nbsp;&nbsp;&nbsp;<span class="average_score"><?= $enquiry_data['average_score'] ?></span>
                                                                            <input type="hidden" value="<?= $enquiry_data['average_score'] ?>" name="average_score">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="4" class="text-end"><button type="button" onclick="addSubject()" class="btn btn-info pull-right">Thêm môn học</button></td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="tshadow bozero">
                                                        <h4 class="pagetitleh2"><?php echo $this->lang->line('upload_documents'); ?></h4>
                                                        <div class="row around10">
                                                            <table class="table table-doc">
                                                                <tbody>
                                                                    <tr>
                                                                        <th style="width: 10px">#</th>
                                                                        <th>Tên File</th>
                                                                        <th><?php echo $this->lang->line('documents'); ?></th>
                                                                        <th class="text-center">Hoạt động</th>
                                                                    </tr>
                                                                    <?php $i=1;foreach($enquiry_doc as $value): ?>
                                                                    <tr class="tr-doc">
                                                                        <td><?= $i ?>.</td>
                                                                        <td><input type="text" name='title1' readonly="" value="<?= $value['title'] ?>" class="form-control" placeholder=""></td>
                                                                        <td>
                                                                            <a href="<?php echo site_url('student/download/' . $value['enquiry_id'] . "/" . $value['id']); ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line('download'); ?>">
                                                                                 <i class="fa fa-download"></i> Tải xuống
                                                                            </a>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <?php if ($this->rbac->hasPrivilege('student', 'can_delete')) { ?>
                                                                                <a href="<?php echo base_url(); ?>student/doc_delete/<?php echo $value['id'] . "/" . $value['enquiry_id']; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                                                    <i class="fa fa-remove"></i>
                                                                                </a>
                                                                            <?php } ?>
                                                                        </td>
                                                                    </tr>
                                                                    <?php $i++;endforeach; ?>
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td colspan="4" class="text-end"><button type="button" onclick="adddoc()" class="btn btn-info pull-right">Thêm tài liệu</button></td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!--./row-->                        
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
</div>
</section>
</div>
<script type="text/javascript">
    function addSubject() {
        var i = 1;
        var j = $('.tr-subject').length;
        var count_subject = $('.tr-subject').length + 1;
        var html='<tr class="tr-subject">'
            +'<td class="text-center">'+ count_subject +'.</td>'
            +'<td>'
            +    '<input type="text" name="subject_arr['+j+'][]" class="form-control" placeholder="">'
            +'</td>'
            +'<td>'
            +    '<input onkeyup="writing_point()" type="text" name="subject_arr['+j+'][]" class="point form-control" placeholder="">'
            +'</td>'
            +'<td class="text-center">'
            +'<a onclick="removeSubject(this)" class="btn btn-default btn-xs"><i class="fa fa-remove"></i></a>'
            +'</td>'
         '</tr>';
        $('.table-subject tbody').append(html)
    }
    function removeSubject(e)
    {
        $(e).parents('.tr-subject').remove()
        writing_point();
    }
    
    function adddoc()
    {
        var i = 1;
        var j = $('.tr-doc').length;
        var count_doc = $('.tr-doc').length + 1;
        var html='<tr class="tr-doc">'
                    +'<td>'+count_doc+'.</td>'
                    +'<td><input type="text" name="titledoc'+j+'" class="form-control" placeholder=""></td>'
                    +'<td>'
                        +'<input class="form-control file-doc" type="file" name="doc'+j+'" id="doc'+j+'">'
                        +'<span class="text-danger"><?php echo form_error('doc'); ?></span>'
                    +'</td>'
                    +'<td class="text-center">'
                        +'<a onclick="removeDoc(this)" class="btn btn-default btn-xs"><i class="fa fa-remove"></i></a>'
                    +'</td>'
                +'</tr>';
        $('.table-doc tbody').append(html)
    }
    
    function removeDoc(e)
    {
        $(e).parents('.tr-doc').remove()
    }
    
    function writing_point()
    {
        var average_score = 0;
        var i = 0;
        $('.point').each(function(){
            average_score += Number($(this).val());
            i++;
        })
        if(i)
        {
            average_score = average_score/i;
        }
        else
        {
            average_score = 0;
        }
        $('.average_score').text(average_score);
        $('input[name="average_score"]').val(average_score);
    }
</script>
<script>
$(document).ready(function () {
    var province_id = $('#province_id').val();
    var district_id = '<?php echo set_value('district_id', $enquiry_data['district_id']) ?>';
    var ward_id     = '<?php echo set_value('ward_id', $enquiry_data['ward_id']) ?>';
    getDistrictByProvince(province_id, district_id);
    getWardByDistrict(district_id,ward_id);

    $(document).on('change', '#province_id', function(e) {
        $('#district_id').html("");
        $('#ward_id').html("");
        var province_id = $(this).val();
        getDistrictByProvince(province_id, 0);
    });
    
    $(document).on('change', '#province_id', function(e) {
        getDistrictByProvince();
    });
    
    function getDistrictByProvince(province_id, district_id) {
        if (province_id != "") {
            $('#district_id').html("");
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "location/getDistrictByProvince",
                data: {
                    'province_id': province_id
                },
                dataType: "json",
                beforeSend: function() {
                    $('#district_id').addClass('dropdownloading');
                },
                success: function(data) {
                    $.each(data, function(i, obj) {
                        var sel = "";
                        if (district_id == obj.district_id) {
                            sel = "selected";
                        }
                        div_data += "<option value=" + obj.district_id + " " + sel + ">" + obj.name + "</option>";
                    });
                    $('#district_id').append(div_data);
                },
                complete: function() {
                    $('#district_id').removeClass('dropdownloading');
                }
            });
        }
    }
    
    $(document).on('change', '#district_id', function(e) {
        $('#ward_id').html("");
        var district_id = $(this).val();
        getWardByDistrict(district_id, 0);
    });
    
    function getWardByDistrict(district_id, ward_id) {
        if (district_id != "") {
            $('#ward_id').html("");
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "location/getWardByDistrict",
                data: {
                    'district_id': district_id
                },
                dataType: "json",
                beforeSend: function() {
                    $('#ward_id').addClass('dropdownloading');
                },
                success: function(data) {
                    $.each(data, function(i, obj) {
                        var sel = "";
                        if (ward_id == obj.ward_id) {
                            sel = "selected";
                        }
                        div_data += "<option value=" + obj.ward_id + " " + sel + ">" + obj.name + "</option>";
                    });
                    $('#ward_id').append(div_data);
                },
                complete: function() {
                    $('#ward_id').removeClass('dropdownloading');
                }
            });
        }
    }
});
</script>

