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
                    <form id="formadd" action="<?php echo site_url('admin/enquiry/add') ?>" method="post" enctype="multipart/form-data" class="ptt10">
                        <div class="bozero">
                            <h4 class="pagetitleh-whitebg">Thêm mới hồ sơ</h4>
                            <div class="around10">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="pwd">Họ</label>
                                            <input type="text" id="first_name_add" autocomplete="off" class="form-control" value="<?php echo set_value('first_name'); ?>" name="first_name">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="pwd"><?php echo $this->lang->line('name'); ?></label><small class="req"> *</small>
                                            <input type="text" id="name_add" autocomplete="off" class="form-control" value="<?php echo set_value('name'); ?>" name="name">
                                            <span id="name_add_error" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="pwd"><?php echo $this->lang->line('phone'); ?></label><small class="req"> *</small> <small class="req"><span id="phone_error_message"></span></small>
                                            <input id="number" autocomplete="off" name="contact" placeholder="" type="text" class="form-control" value="<?php echo set_value('contact'); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="pwd">Mã hồ sơ</label>
                                            <input type="text" id="profile_code" autocomplete="off" class="form-control" value="<?php echo set_value('profile_code'); ?>" name="profile_code">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="pwd">CCCD</label>
                                            <input type="text" id="cccd" autocomplete="off" class="form-control" value="<?php echo set_value('cccd'); ?>" name="cccd">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label><?php echo $this->lang->line('email'); ?></label>
                                            <input type="text" value="<?php echo set_value('email'); ?>" name="email" class="form-control">
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
                                                    <option value="<?php echo $value['province_id'] ?>" <?php if (set_value('province_id') == $value['province_id']) { ?> selected="" <?php } ?>><?php echo $value['name'] ?></option>
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
                                            <textarea name="address" class="form-control"><?php echo set_value('address'); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="email"><?php echo $this->lang->line('description'); ?></label>
                                            <textarea name="description" class="form-control"><?php echo set_value('description'); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="pwd"><?php echo $this->lang->line('note'); ?></label>
                                            <textarea name="note" class="form-control"><?php echo set_value('note'); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Dân tộc</label>
                                            <input type="text" value="<?php echo set_value('nation'); ?>" name="nation" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Tôn giáo</label>
                                            <input type="text" value="<?php echo set_value('religion'); ?>" name="religion" class="form-control">
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
                                            <input type="text" value="<?php echo set_value('graduation_year_thpt'); ?>" name="graduation_year_thpt" class="form-control">
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
                                                        <option  value="<?php echo $key ?>"><?php echo $value ?></option>
                                                    <?php }?>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Trường THPT</label>
                                            <input type="text" value="<?php echo set_value('graduation_school_thpt'); ?>" name="graduation_school_thpt" class="form-control">
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
                                            <input type="text" value="<?php echo set_value('graduation_professional_year'); ?>" name="graduation_professional_year" class="form-control">
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
                                                    <option  value="<?php echo $key ?>"><?php echo $value ?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Ngành tốt nghiệp chuyên môn</label>
                                            <input type="text" value="<?php echo set_value('graduation_department_professional'); ?>" name="graduation_department_professional" class="form-control">
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
                                                    <option  value="<?php echo $key ?>"><?php echo $value ?></option>
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
                                                                if (set_value('training_system_id') == $item['id']) {
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
                                            <input type="text" value="<?php echo set_value('graduation_professional_school'); ?>" name="graduation_professional_school" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h4 class="pagetitleh2">CBTS và Nguồn</h4>
                            <div class="around10">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="pwd"><?php echo $this->lang->line('date'); ?></label>
                                            <input type="text" id="date" name="date" class="form-control date" value="<?php echo set_value('date', date($this->customlib->getSchoolDateFormat())); ?>" readonly="">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Cán bộ tuyển sinh</label>
                                            <?php 
                                                $role = $this->customlib->getStaffRole();
                                                $role_id  = json_decode($role)->id;
                                                $stff_id = $this->customlib->getLoggedInUserData()['id'];
                                            ?>
                                            <select name="assigned" class="form-control">
                                                <option value=""><?php echo $this->lang->line('select') ?></option>
                                                <?php foreach ($stff_list as $key => $stff_list_value) { ?>
                                                    <option 
                                                    <?php 
                                                        $role = $this->customlib->getStaffRole();
                                                        $role_id  = json_decode($role)->id;
                                                        $stff_id = $this->customlib->getLoggedInUserData()['id'];
                                                        if($role_id == 13 && $stff_id == $stff_list_value['id']):
                                                    ?>
                                                    selected
                                                    <?php endif; ?>
                                                    value="<?php echo $stff_list_value['id']; ?>"><?php echo $this->customlib->getStaffFullName($stff_list_value['name'], $stff_list_value['surname'],  $stff_list_value['employee_id']); ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div><!--./form-group-->
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Cán bộ Data</label>
                                            <select name="cb_data" class="form-control">
                                                <option value=""><?php echo $this->lang->line('select') ?></option>
                                                <?php foreach ($cb_data as $value) { ?>
                                                    <option 
                                                    value="<?php echo $value['id']; ?>"><?php echo $this->customlib->getStaffFullName($value['name'], $value['surname'],  $value['employee_id']); ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div><!--./form-group-->
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Đối tác</label>
                                            <select name="doi_tac" class="form-control">
                                                <option value=""><?php echo $this->lang->line('select') ?></option>
                                                <?php foreach ($doi_tac as $key => $value) { ?>
                                                    <option 
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
                                                    <option value="<?php echo $value['reference']; ?>" <?php if (set_value('reference') == $value['reference']) { ?>selected="" <?php } ?>><?php echo $value['reference']; ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div><!--./form-group-->
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="pwd"><?php echo $this->lang->line('source'); ?></label>
                                            <select name="source" class="form-control">
                                                <option value=""><?php echo $this->lang->line('select') ?></option>
                                                <?php foreach ($sourcelist as $key => $value) { ?>
                                                    <option value="<?php echo $value['source']; ?>"><?php echo $value['source']; ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div><!--./form-group-->
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Lệ phí tuyển sinh</label>
                                            <input type="text" value="<?php echo set_value('le_phi'); ?>" placeholder="Lệ phí tuyển sinh" name="le_phi" class="form-control">
                                        </div>
                                    </div>
                                </div><!--./row-->
                            </div>
                            <h4 class="pagetitleh2">Đăng Ký Tuyển Sinh</h4>
                            <div class="around10">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="pwd"><?php echo $this->lang->line('class'); ?></label>
                                            <select name="class" class="form-control">
                                                <option value=""><?php echo $this->lang->line('select') ?></option>
                                                <?php
                                                foreach ($class_list as $key => $value) {
                                                ?>
                                                    <option value="<?php echo $value['id'] ?>" <?php if (set_value('class') == $value['id']) { ?> selected="" <?php } ?>><?php echo $value['class'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div><!--./form-group-->
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
                                                                if (set_value('training_system_id') == $item['id']) {
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
                                                    <option  value="<?php echo $key ?>"><?php echo $value ?></option>
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
                                                    <option value="<?php echo $value['id'] ?>" <?php if (set_value('class') == $value['id']) { ?> selected="" <?php } ?>><?php echo $value['visitors_purpose'] ?></option>
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
                                                    <option value="<?php echo $value['id'] ?>" <?php if (set_value('class') == $value['id']) { ?> selected="" <?php } ?>><?php echo $value['complaint_type'] ?></option>
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
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="2" class="text-right">Điểm TB xét tuyển</td>
                                                            <td colspan="2">
                                                                 &nbsp;&nbsp;&nbsp;&nbsp;<span class="average_score">0.0</span>
                                                                <input type="hidden" value="0" name="average_score">
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
                                                            <th><?php echo $this->lang->line('title'); ?></th>
                                                            <th><?php echo $this->lang->line('documents'); ?></th>
                                                            <th class="text-center">Hoạt động</th>
                                                        </tr>
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
                            </div><!--./col-md-12-->
                        </div><!--./row-->
                        <div>
                            <div class="box-footer col-md-12">
                                <button type="submit" class="btn btn-info pull-right" id="submit" data-loading-text="<i class='fa fa-spinner fa-spin '></i> <?php echo $this->lang->line('please_wait'); ?>"><?php echo $this->lang->line('save') ?></button>
                            </div>
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
    $(document).on('change', '#province_id', function(e) {
        $('#district_id').html("");
        $('#ward_id').html("");
        var province_id = $(this).val();
        getDistrictByProvince(province_id, 0);
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
</script>
