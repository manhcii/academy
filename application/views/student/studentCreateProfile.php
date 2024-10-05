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
                <div class="col-md-4">
                    <div class="box box-primary">
                    <form id="form1" action="<?php echo site_url('student/createprofile') ?>" id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        <div class="">
                            <div class="bozero">
                                <h4 class="pagetitleh-whitebg"><?php echo $this->lang->line('add_student_profile'); ?></h4>
                                <div class="around10">
                                    <?php if ($this->session->flashdata('msg')) {
                                    ?>
                                        <?php
                                        echo $this->session->flashdata('msg');
                                        $this->session->unset_userdata('msg');
                                        ?>
                                    <?php } ?>

                                    <?php //if (isset($error_message)) {
                                    ?>
                                    <!--<div class="alert alert-warning"><?php //echo $error_message; 
                                                                            ?></div> -->
                                    <?php //}
                                    ?>
                                    <?php echo $this->customlib->getCSRF(); ?>
                                    <input type="hidden" name="sibling_name" value="<?php echo set_value('sibling_name'); ?>" id="sibling_name_next">
                                    <input type="hidden" name="sibling_id" value="<?php echo set_value('sibling_id', 0); ?>" id="sibling_id">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('first_name'); ?></label>
                                                <input id="firstname" name="firstname" placeholder="" type="text" class="form-control" value="<?php echo set_value('firstname'); ?>" />
                                                <span class="text-danger"><?php echo form_error('firstname'); ?></span>
                                            </div>
                                        </div>
                                        <?php if ($sch_setting->middlename) { ?>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('middle_name'); ?></label>
                                                    <input id="middlename" name="middlename" placeholder="" type="text" class="form-control" value="<?php echo set_value('middlename'); ?>" />
                                                    <span class="text-danger"><?php echo form_error('middlename'); ?></span>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if ($sch_setting->lastname) { ?>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('last_name'); ?><small class="req"> *</small></label>
                                                    <input id="lastname" name="lastname" placeholder="" type="text" class="form-control" value="<?php echo set_value('lastname'); ?>" />
                                                    <span class="text-danger"><?php echo form_error('lastname'); ?></span>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputFile"> <?php echo $this->lang->line('gender'); ?></label>
                                                <select class="form-control" name="gender">
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    <?php
                                                    foreach ($genderList as $key => $value) {
                                                    ?>
                                                        <option value="<?php echo $key; ?>" <?php
                                                                                            if (set_value('gender') == $key) {
                                                                                                echo "selected";
                                                                                            }
                                                                                            ?>><?php echo $value; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('gender'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('date_of_birth'); ?></label>
                                                <input id="dob" name="dob" placeholder="" type="text" class="form-control date" value="<?php echo set_value('dob'); ?>" />
                                                <span class="text-danger"><?php echo form_error('dob'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        
                                        <?php if ($sch_setting->mobile_no) { ?>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('mobile_number'); ?><small class="req"> *</small></label>
                                                    <input id="mobileno" name="mobileno" placeholder="" type="text" class="form-control" value="<?php echo set_value('mobileno'); ?>" />
                                                    <span class="text-danger"><?php echo form_error('mobileno'); ?></span>
                                                </div>
                                            </div>
                                        <?php }
                                        if ($sch_setting->student_email) { ?>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('email'); ?></label>
                                                    <input id="email" name="email" placeholder="" type="text" class="form-control" value="<?php echo set_value('email'); ?>" />
                                                    <span class="text-danger"><?php echo form_error('email'); ?></span>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="row">
                                        <?php
                                        echo display_custom_fields('students');
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right" id="addloader"><?php echo $this->lang->line('save'); ?></button>
                        </div>
                    </form>
                </div>
                </div>
                <div class="col-md-<?php
            if ($this->rbac->hasPrivilege('student', 'can_add')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('list_student_profile'); ?></h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages overflow-visible">
                            <div class="download_label"><?php echo $this->lang->line('class_credit_teacher_list'); ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>

                                        <th><?php echo $this->lang->line('student_name'); ?>
                                        </th>
                                        <th><?php echo $this->lang->line('date_of_birth'); ?>
                                        </th>
                                        <th><?php echo $this->lang->line('gender'); ?>
                                        <th><?php echo $this->lang->line('mobile_number'); ?>
                                        <th><?php echo $this->lang->line('email'); ?>
                                        </th>

                                        <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($studentprofilelist as $studentprofile) {
                                        ?>
                                        <tr>
                                            <td class="mailbox-name">
                                                <?php echo $studentprofile["firstname"] .' '. $studentprofile["middlename"] . ' ' . $studentprofile["lastname"]; ?>

                                            </td>
                                            <td>
                                                <?php echo $studentprofile["dob"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $studentprofile["gender"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $studentprofile["mobileno"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $studentprofile["email"]; ?>
                                            </td>
                                            <td class="mailbox-date pull-right">
                                                <?php
                                                if ($this->rbac->hasPrivilege('student', 'can_edit')) {
                                                    ?>
                                                    <a href="<?php echo base_url(); ?>student/editprofile/<?php echo $studentprofile["id"]; ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <?php
                                                }
                                                if ($this->rbac->hasPrivilege('student', 'can_delete')) {
                                                    ?>
                                                    <a href="<?php echo base_url(); ?>student/deleteprofile/<?php echo $studentprofile["id"]; ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                        <i class="fa fa-remove"></i>
                                                    </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                    ?>

                                </tbody>
                            </table><!-- /.table -->



                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                </div>
            </div><!--/.col (left) -->
            <!-- right column -->
            </div>
        </div>
</div>
</section>
</div>

<div class="modal fade" id="mySiblingModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title title modal_title"></h4>
            </div>
            <div class="modal-body pb0">
                <div class="form-horizontal">
                    <div class="box-body pt0 pb0">
                        <input type="hidden" class="form-control" id="transport_student_session_id" value="0" readonly="readonly" />
                        <div class="form-group">
                            <div class="sibling_msg">
                            </div>
                            <label for="inputEmail3" class="col-sm-2 control-label"><?php echo $this->lang->line('class'); ?></label>
                            <div class="col-sm-10">
                                <select id="sibiling_class_id" name="sibiling_class_id" class="form-control">
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    <?php
                                    foreach ($classlist as $class) {
                                    ?>
                                        <option value="<?php echo $class['id'] ?>" <?php
                                                                                    if (set_value('sibiling_class_id') == $class['id']) {
                                                                                        echo "selected=selected";
                                                                                    }
                                                                                    ?>><?php echo $class['class'] ?></option>
                                    <?php
                                        $count++;
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label"><?php echo $this->lang->line('section'); ?></label>
                            <div class="col-sm-10">
                                <select id="sibiling_section_id" name="sibiling_section_id" class="form-control">
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                </select>
                                <span class="text-danger" id="transport_amount_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label"><?php echo $this->lang->line('student'); ?>
                            </label>
                            <div class="col-sm-10">
                                <select id="sibiling_student_id" name="sibiling_student_id" class="form-control">
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                </select>
                                <span class="text-danger" id="sibiling_student_id
"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary add_sibling" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"><i class="fa fa-user"></i> <?php echo $this->lang->line('add'); ?></button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#addloader').on('click', function() {
        $('#addloader').html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i><?php echo $this->lang->line('loading'); ?>');
    });


    $(document).ready(function() {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy']) ?>';
        var class_id = $('#class_id').val();
        var section_id = '<?php echo set_value('section_id', 0) ?>';
        var hostel_id = $('#hostel_id').val();
        var hostel_room_id = '<?php echo set_value('hostel_room_id', 0) ?>';
        var vehroute_id = '<?php echo set_value('vehroute_id', 0) ?>';
        var route_pickup_point_id = '<?php echo set_value('route_pickup_point_id', 0) ?>';
        getHostel(hostel_id, hostel_room_id);
        getSectionByClass(class_id, section_id);
        get_pickup_point(vehroute_id, route_pickup_point_id);

        $(document).on('change', '#class_id', function(e) {
            $('#section_id').html("");
            var class_id = $(this).val();
            getSectionByClass(class_id, 0);
        });

        $(".color").colorpicker();

        $("#btnreset").click(function() {
            $("#form1")[0].reset();
        });

        $(document).on('change', '#hostel_id', function(e) {
            var hostel_id = $(this).val();
            getHostel(hostel_id, 0);
        });

        function getSectionByClass(class_id, section_id) {

            if (class_id != "") {
                $('#section_id').html("");
                var base_url = '<?php echo base_url() ?>';
                var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                var url = "<?php
                            $userdata = $this->customlib->getUserData();
                            if (($userdata["role_id"] == 2)) {
                                echo "getClassTeacherSection";
                            } else {
                                echo "getByClass";
                            }
                            ?>";

                $.ajax({
                    type: "GET",
                    url: base_url + "sections/getByClass",
                    data: {
                        'class_id': class_id
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $('#section_id').addClass('dropdownloading');
                    },
                    success: function(data) {
                        $.each(data, function(i, obj) {
                            var sel = "";
                            if (section_id == obj.section_id) {
                                sel = "selected";
                            }
                            div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
                        });
                        $('#section_id').append(div_data);
                    },
                    complete: function() {
                        $('#section_id').removeClass('dropdownloading');
                    }
                });
            }
        }

        $(document).on('change', '#vehroute_id', function() {

            var vehroute_id = $(this).val();
            get_pickup_point(vehroute_id, 0);
        });

        function get_pickup_point(vehroute_id, pickuppoint_id) {
            if (vehroute_id != "") {

                var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                $.ajax({
                    url: baseurl + 'admin/pickuppoint/get_pickupdropdownlist',
                    type: "POST",
                    data: {
                        vehroute_id: vehroute_id
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        $('#pickup_point').html('');
                    },
                    success: function(res) {

                        $.each(res, function(index, value) {
                            var sel = "";
                            if (pickuppoint_id == value.route_pickup_point_id) {
                                sel = "selected";
                            }

                            div_data += "<option  value=" + value.route_pickup_point_id + " " + sel + ">" + value.name + "</option>";
                        });

                        $('#pickup_point').html(div_data);
                    },
                    error: function(xhr) { // if error occured
                        alert("<?php echo $this->lang->line('error_occurred_please_try_again'); ?>");
                    },
                    complete: function() {

                    }
                });
            }

        }

        function getHostel(hostel_id, hostel_room_id) {
            if (hostel_room_id == "") {
                hostel_room_id = 0;
            }

            if (hostel_id != "") {
                $('#hostel_room_id').html("");

                var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                $.ajax({
                    type: "GET",
                    url: baseurl + "admin/hostelroom/getRoom",
                    data: {
                        'hostel_id': hostel_id
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $('#hostel_room_id').addClass('dropdownloading');
                    },
                    success: function(data) {
                        $.each(data, function(i, obj) {
                            var sel = "";
                            if (hostel_room_id == obj.id) {
                                sel = "selected";
                            }

                            div_data += "<option value=" + obj.id + " " + sel + ">" + obj.room_no + " (" + obj.room_type + ")" + "</option>";

                        });
                        $('#hostel_room_id').append(div_data);
                    },
                    complete: function() {
                        $('#hostel_room_id').removeClass('dropdownloading');
                    }
                });
            }
        }
    });

    function auto_fill_guardian_address() {
        if ($("#autofill_current_address").is(':checked')) {
            $('#current_address').val($('#guardian_address').val());
        }
    }

    function auto_fill_address() {
        if ($("#autofill_address").is(':checked')) {
            $('#permanent_address').val($('#current_address').val());
        }
    }

    $('input:radio[name="guardian_is"]').change(
        function() {
            if ($(this).is(':checked')) {
                var value = $(this).val();
                if (value == "father") {
                    var father_relation = "<?php echo $this->lang->line('father'); ?>";
                    $('#guardian_name').val($('#father_name').val());
                    $('#guardian_phone').val($('#father_phone').val());
                    $('#guardian_occupation').val($('#father_occupation').val());
                    $('#guardian_relation').val(father_relation);
                } else if (value == "mother") {
                    var mother_relation = "<?php echo $this->lang->line('mother'); ?>";
                    $('#guardian_name').val($('#mother_name').val());
                    $('#guardian_phone').val($('#mother_phone').val());
                    $('#guardian_occupation').val($('#mother_occupation').val());
                    $('#guardian_relation').val(mother_relation);
                } else {
                    $('#guardian_name').val("");
                    $('#guardian_phone').val("");
                    $('#guardian_occupation').val("");
                    $('#guardian_relation').val("")
                }
            }
        });
</script>

<script type="text/javascript">
    $(".mysiblings").click(function() {
        $('.sibling_msg').html("");
        $('.modal_title').html('<b>' + "<?php echo $this->lang->line('add_sibling'); ?>" + '</b>');
        $('#mySiblingModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    });
</script>

<script type="text/javascript">
    $(document).on('change', '#sibiling_class_id', function(e) {
        $('#sibiling_section_id').html("");
        var class_id = $(this).val();
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        $.ajax({
            type: "GET",
            url: base_url + "sections/getByClass",
            data: {
                'class_id': class_id
            },
            dataType: "json",
            success: function(data) {
                $.each(data, function(i, obj) {
                    div_data += "<option value=" + obj.section_id + ">" + obj.section + "</option>";
                });
                $('#sibiling_section_id').append(div_data);
            }
        });
    });

    $(document).on('change', '#sibiling_section_id', function(e) {
        getStudentsByClassAndSection();
    });

    function getStudentsByClassAndSection() {

        $('#sibiling_student_id').html("");
        var class_id = $('#sibiling_class_id').val();
        var section_id = $('#sibiling_section_id').val();
        var student_id = '<?php echo set_value('student_id') ?>';
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        $.ajax({
            type: "GET",
            url: base_url + "student/getByClassAndSection",
            data: {
                'class_id': class_id,
                'section_id': section_id
            },
            dataType: "json",
            success: function(data) {
                $.each(data, function(i, obj) {
                    var sel = "";
                    if (section_id == obj.section_id) {
                        sel = "selected=selected";
                    }

                    if (obj.admission_no == null) {
                        div_data += "<option value=" + obj.id + ">" + obj.full_name + "</option>";
                    } else {
                        div_data += "<option value=" + obj.id + ">" + obj.full_name + " (" + obj.admission_no + ") " + "</option>";
                    }

                });
                $('#sibiling_student_id').append(div_data);
            }
        });
    }

    $(document).on('click', '.add_sibling', function() {
        var student_id = $('#sibiling_student_id').val();
        var base_url = '<?php echo base_url() ?>';
        if (student_id.length > 0) {
            $.ajax({
                type: "GET",
                url: base_url + "student/getStudentRecordByID",
                data: {
                    'student_id': student_id
                },
                dataType: "json",
                success: function(data) {
                    $('#sibling_name').text("<?php echo $this->lang->line('sibling'); ?> : " + data.full_name);
                    $('#sibling_name_next').val(data.firstname + " " + data.lastname);
                    $('#sibling_id').val(student_id);
                    $('#father_name').val(data.father_name);
                    $('#father_phone').val(data.father_phone);
                    $('#father_occupation').val(data.father_occupation);
                    $('#mother_name').val(data.mother_name);
                    $('#mother_phone').val(data.mother_phone);
                    $('#mother_occupation').val(data.mother_occupation);
                    $('#guardian_name').val(data.guardian_name);
                    $('#guardian_relation').val(data.guardian_relation);
                    $('#guardian_address').val(data.guardian_address);
                    $('#guardian_phone').val(data.guardian_phone);
                    $('#state').val(data.state);
                    $('#city').val(data.city);
                    $('#pincode').val(data.pincode);
                    $('#current_address').val(data.current_address);
                    $('#permanent_address').val(data.permanent_address);
                    $('#guardian_occupation').val(data.guardian_occupation);
                    $("input[name=guardian_is][value='" + data.guardian_is + "']").prop("checked", true);
                    $('#mySiblingModal').modal('hide');
                }
            });
        } else {
            $('.sibling_msg').html("<div class='alert alert-danger text-center'><?php echo $this->lang->line('no_student_selected') ?></div>");
        }
    });
</script>

<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/js/savemode.js"></script>

<script>
    $('#transport_feemaster_id').multiselect({
        columns: 1,
        placeholder: '<?php echo $this->lang->line('select_month') ?>',
        search: true
    });

    $('#fee_session_group_id').multiselect({
        columns: 1,
        placeholder: '<?php echo $this->lang->line('select_fees') ?>',
        search: true
    });
</script>
<script type="text/javascript">
    var total_fees_alloted = parseFloat($("input[name='total_post_fees']").val());
    $(document).ready(function() {
        $(document).on('change', '.fee_group_chk', function() {

            if ($(this).prop("checked")) {
                total_fees_alloted += parseFloat($(this).closest('div').find('span.fee_group_total').data('amount'));
            } else {
                total_fees_alloted -= parseFloat($(this).closest('div').find('span.fee_group_total').data('amount'));
            }
            //==============
            $.ajax({
                type: "POST",
                url: base_url + "admin/currency/getAmountFormat",
                data: {
                    'total_fees_alloted': total_fees_alloted
                },
                dataType: "json",
                beforeSend: function() {
                    $('#fade').css("display", "block");
                    $('#modal').css("display", "block");
                },
                success: function(data) {
                    console.log(data);
                    $('.total_fees_alloted').text(data.amount);
                    $("#fade").fadeOut(1000);
                    $("#modal").fadeOut(1000);
                },
                error: function(xhr) { // if error occured
                    $("#fade").fadeOut(1000);
                    $("#modal").fadeOut(1000);
                },
                complete: function() {
                    $("#fade").fadeOut(1000);
                    $("#modal").fadeOut(1000);
                }
            });
            //==============

        });
    });
</script>