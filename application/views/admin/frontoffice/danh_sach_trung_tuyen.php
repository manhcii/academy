<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-ioxhost"></i> <?php echo $this->lang->line('front_office'); ?>
        </h1>
    </section>
    <style>
        .ml-20 {
            margin-left: 5rem;
        }
    </style>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> Danh sách trúng tuyển</h3>
                    </div>
                    <div class="col-md-12">
                        <?php echo $this->session->flashdata('msg');
                        $this->session->unset_userdata('msg'); ?>
                    </div>
                    <form role="form" action="<?php echo site_url('admin/enquiry/danh_sach_trung_tuyen') ?>" method="post" class="">
                        <div class="box-body row">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="col-sm-6 col-md-2 col-lg-2">
                                <div class="form-group">
                                    <label>Cán bộ tuyển sinh</label>
                                    <select id="stff" name="stff" class="form-control">
                                        <option value="">Tất cả</option>
                                        <?php foreach ($stff_list as $key => $value): ?>
                                            <option 
                                            <?php if (isset($stff) && $value["id"] == $stff) :?> selected <?php endif;?>
                                            value="<?php echo $value["id"] ?>">
                                                <?php echo $this->customlib->getStaffFullName($value['name'], $value['surname'],  $value['employee_id']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-2 col-lg-2">
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('class'); ?></label>
                                    <select id="class" name="class" class="form-control">
                                        <option value="">Tất cả</option>
                                        <?php foreach ($class_list as $key => $value) {
                                        ?>
                                            <option <?php
                                                    if ($value["id"] == $selected_class) {
                                                        echo "selected";
                                                    }
                                                    ?> value="<?php echo $value["id"] ?>"><?php echo $value["class"] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-2 col-lg-2">
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('source'); ?></label>
                                    <select id="source" name="source" class="form-control">
                                        <option value="">Tất cả</option>
                                        <?php foreach ($sourcelist as $key => $value) {
                                        ?>
                                            <option <?php
                                                    if ($value["source"] == $source_select) {
                                                        echo "selected";
                                                    }
                                                    ?> value="<?php echo $value["source"] ?>"><?php echo $value["source"] ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('source'); ?></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-2 col-lg-2">
                                <div class="form-group">
                                    <label>Khóa học</label>
                                    <select name="khoa_hoc" class="form-control">
                                        <option value="">Tất cả</option>
                                        <?php
                                        foreach ($khoa_tuyen_sinhs as $key => $value) {
                                        ?>
                                            <option
                                            <?php if (isset($khoa_hoc) && $value["id"] == $khoa_hoc) {
                                                        echo "selected";
                                                    }
                                            ?>
                                            value="<?php echo $value['id'] ?>"><?php echo $value['visitors_purpose'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-2 col-lg-2">
                                <div class="form-group">
                                    <label>Đợt tuyển sinh</label>
                                    <select id="dot_tuyen_sinh" name="dot_tuyen_sinh" class="form-control">
                                        <option value="">Tất cả</option>
                                        <?php foreach ($dot_tuyen_sinhs as $key => $value): ?>
                                            <option 
                                            <?php if (isset($dot_tuyen_sinh) && $value["id"] == $dot_tuyen_sinh) :?> selected <?php endif;?>
                                            value="<?php echo $value["id"] ?>"><?php echo $value["complaint_type"] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-2 col-lg-2">
                                <div class="form-group">
                                    <label>Cán bộ Data</label>
                                    <select id="cb_data" name="cb_data" class="form-control">
                                        <option value="">Tất cả</option>
                                        <?php foreach ($cb_datas as $key => $value): ?>
                                            <option 
                                            <?php if (isset($cb_data) && $value["id"] == $cb_data) :?> selected <?php endif;?>
                                            value="<?php echo $value["id"] ?>">
                                                <?php echo $this->customlib->getStaffFullName($value['name'], $value['surname'],  $value['employee_id']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-2 col-lg-2">
                                <div class="form-group">
                                    <label>Đối tác</label>
                                    <select id="doi_tac" name="doi_tac" class="form-control">
                                        <option value="">Tất cả</option>
                                        <?php foreach ($doi_tacs as $key => $value): ?>
                                            <option 
                                            <?php if (isset($doi_tac) && $value["id"] == $doi_tac) :?> selected <?php endif;?>
                                            value="<?php echo $value['id']; ?>">
                                                <?php echo $value['name']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-2 col-lg-2">
                                <div class="form-group">
                                    <label>Ngày<small class="req"> *</small></label>
                                    <input type="text" autocomplete="off" name="daterange" class="form-control" value="<?php echo set_value('daterange') ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group pl10">
                                    <label class="displayblock opacity d-sm-none">&nbsp;</label>
                                    <button type="submit" name="search" value="search_filter" class="btn btn-primary smallbtn28 btn-sm pull-right"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="ptt10">
                        <div class="bordertop">
                            <div class="box-body">
                                <div class="download_label"><?php echo $this->lang->line('admission_enquiry_list'); ?></div>
                                <div class="mailbox-messages">
                                    <div class="table-responsive overflow-visible-lg">
                                        <table class="table table-hover table-striped table-bordered" id="enquirytable">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">STT</th>
                                                    <th><?php echo $this->lang->line('name'); ?></th>
                                                    <th><?php echo $this->lang->line('phone'); ?></th>
                                                    <th>Chuyên ngành đăng ký</th>
                                                    <th><?php echo $this->lang->line('source'); ?></th>
                                                    <th><?php echo $this->lang->line('enquiry_date'); ?></th>
                                                    <th>Cán bộ tuyển sinh</th>
                                                    <th>Đợt xét tuyển</th>
                                                    <th>Khóa học</th>
                                                    <th>Trạng thái</th>
                                                    <th class="text-right noExport1"><?php echo $this->lang->line('action'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                if (empty($danh_sach_xet_tuyen)) {
                                                ?>
                                                    <?php
                                                } else {
                                                    $i=1;
                                                    foreach ($danh_sach_xet_tuyen as $key => $value) {
                                                        $current_date = date("Y-m-d");
                                                        $next_date    = $value["next_date"];
                                                        if (empty($next_date)) {
                                                            $next_date = $value["follow_up_date"];
                                                        }
                                                    ?>
                                                        <tr>
                                                            <td class="text-center"><?= $i; ?></td>
                                                            <td class="mailbox-name"><?php echo $value['name']; ?> </td>
                                                            <td class="mailbox-name"><?php echo $value['contact']; ?> </td>
                                                            <td class="mailbox-name"><?php echo $value['classname']; ?></td>
                                                            <td class="mailbox-name"><?php echo $value['source']; ?></td>
                                                            <td class="mailbox-name"> <?php
                                                                                        if (!empty($value["date"])) {
                                                                                            echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($value['date']));
                                                                                        }
                                                                                        ?></td>
                                                            <td class="mailbox-name"><?php echo $value['staff_name'] . " " . $value['staff_surname']; ?></td>
                                                            <td> <?php echo $value["dot_tuyen_sinh"] ? $value["dot_tuyen_sinh"] : 'Đang cập nhật' ?></td>
                                                            <td> <?php echo $value["khoa_hoc"] ? $value["dot_tuyen_sinh"] : 'Đang cập nhật' ?></td>
                                                            <td> <?php echo $enquiry_status[$value["status"]] ?></td>
                                                            <td class="mailbox-date text-right white-space-nowrap">
                                                                <?php if ($this->rbac->hasPrivilege('follow_up_admission_enquiry', 'can_view')) { ?>
                                                                    <a class="btn btn-default btn-xs" onclick="follow_up('<?php echo $value['id']; ?>', '<?php echo $value['status']; ?>', '<?php echo $value['created_by']; ?>');" data-target="#follow_up" data-toggle="modal" title="<?php echo $this->lang->line('follow_up_admission_enquiry'); ?>">
                                                                        <i class="fa fa-phone"></i>
                                                                    </a>
                                                                <?php }
                                                                ?>
                                                                <?php 
                                                                if(
                                                                    ($value["status"] != 'won' 
                                                                    && $value["status"] != 'profile_approved'
                                                                    && $value["status"] != 'enrolled' ) || $this->rbac->hasPrivilege('browse_profile', 'can_edit')
                                                                ): ?>
                                                                <?php if ($this->rbac->hasPrivilege('admission_enquiry', 'can_edit')) { ?>
                                                                    <a href="<?php echo base_url('admin/enquiry/details/' . $value['id'] . '/' . $value['status']) ?>" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i>
                                                                    </a>
                                                                <?php } ?>
                                                                <?php endif; ?>
                                                                <?php 
                                                                    if(
                                                                    ($value["status"] != 'won' 
                                                                    && $value["status"] != 'profile_approved'
                                                                    && $value["status"] != 'enrolled' ) || $this->rbac->hasPrivilege('browse_profile', 'can_edit')
                                                                ):
                                                                ?>
                                                                <?php if ($this->rbac->hasPrivilege('admission_enquiry', 'can_delete')) { ?>
                                                                    <a href="#" class="btn btn-default btn-xs" data-toggle="tooltip" title="" onclick="delete_enquiry('<?php echo $value["id"] ?>')" data-original-title="<?php echo $this->lang->line('delete'); ?>">
                                                                        <i class="fa fa-remove"></i>
                                                                    </a>
                                                                <?php } ?>
                                                                <?php endif; ?>
                                                            </td>
                                                        </tr>
                                                <?php
                                                    $i++;}
                                                }
                                                ?>
                                            </tbody>
                                        </table><!-- /.table -->
                                    </div>
                                </div><!-- /.mail-box-messages -->
                            </div><!-- /.box-body -->
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <div class="modal fade" id="myModaledit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-media-content">
                <div class="modal-header modal-media-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="box-title"><?php echo $this->lang->line('edit_admission_enquiry'); ?></h4>
                </div>
                <div class="modal-body pt0 pb0" id="getdetails">
                    <div id="alert_message">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalAddStudent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-media-content">
                <div class="modal-header modal-media-header d-flex justify-content-between align-items-center">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="box-title">Nhập học sinh viên</h4>
                    <h5><strong>Tổng số</strong>: <span class="count_student">0</span> hồ sơ</h5>
                </div>
                <div class="modal-body pt0 pb0">
                    <form action="<?= base_url('student/addStudent') ?>" onsubmit="return false" method="post" id="addStudents" class="ptt10">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="pwd"><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
                                            <select name="class_id" id="class_id" class="form-control">
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label><small class="req"> *</small>
                                            <select id="section_id" name="section_id" class="form-control">
                                                <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            </select>
                                            <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('subject_group'); ?></label><small class="req"> *</small>
                                            <select id="subject_group" name="subject_group" class="form-control">
                                                <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                <?php
                                                foreach ($subjectgroupList as $key => $value) {
                                                ?>
                                                    <option value="<?php echo $value['id'] ?>" <?php if (set_value('subject_group') == $value['id']) { ?> selected="" <?php } ?>><?php echo $value['class'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                        </div>
                                    </div>
                                </div><!--./row-->
                            </div><!--./col-md-12-->
                        </div><!--./row-->
                        <div class="row">
                            <div class="box-footer col-md-12">
                                <button type="submit" class="btn btn-info pull-right" id="submit" data-loading-text="<i class='fa fa-spinner fa-spin '></i> <?php echo $this->lang->line('please_wait'); ?>"><?php echo $this->lang->line('save') ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="follow_up" tabindex="-1" role="dialog" aria-labelledby="follow_up">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-media-content">
                <div class="modal-body pt0 pb0 pr-xl-1" id="getdetails_follow_up">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(e) {
        $('#myModal,#follow_up,#myModaledit').modal({
            backdrop: 'static',
            keyboard: false,
            show: false
        });
    });

    $("#openModalAddStudent").click(function() {
        var count_student = $('.student_select:checked').length;
        if (count_student > 0) {
            $("#modalAddStudent").modal();
            $('.count_student').html(count_student);
        } else {
            alert('Vui lòng lựa chọn sinh viên.')
        }
    });

    $(".openmodal").click(function() {
        $('#formadd').trigger("reset");
        $("#myModal").modal();
    });
</script>
<script>
    $(document).ready(function() {
        moment.lang('en', {
            week: {
                dow: start_week
            }
        });
        $('#enquiry_date').daterangepicker({
            locale: {
                format: calendar_date_time_format
            }
        });
    });

    function getRecord(id, status) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/enquiry/details/' + id + '/' + status,
            success: function(result) {
                $('#getdetails').html(result);
            }
        });
    }

    function postRecord(id) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/enquiry/editpost/' + id,
            type: 'POST',
            data: $("#myForm1").serialize(),
            dataType: 'json',
            success: function(data) {
                if (data.status == "fail") {
                    var message = "";
                    $.each(data.error, function(index, value) {
                        message += value;
                    });
                    errorMsg(message);
                } else {
                    successMsg(data.message);
                    window.location.reload(true);
                }
            },
            error: function() {
                alert("<?php echo $this->lang->line('fail'); ?>");
            }
        });
    }

    $("#formadd").on('submit', (function(e) {
        e.preventDefault();
        var $this = $(this).find("button[type=submit]:focus");
        $.ajax({
            url: "<?php echo site_url("admin/enquiry/add/") ?>",
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $this.button('loading');

            },
            success: function(res) {
                if (res.status == "fail") {
                    var message = "";
                    $.each(res.error, function(index, value) {
                        message += value;
                    });
                    errorMsg(message);
                } else {
                    successMsg(res.message);
                    window.location.reload(true);
                }
            },
            error: function(xhr) { // if error occured
                alert("<?php echo $this->lang->line('error_occurred_please_try_again'); ?>");
                $this.button('reset');
            },
            complete: function() {
                $this.button('reset');
            }
        });
    }));
    $(document).ready(function () {
    $("#addStudents").validate({
		rules: {
    			class_id: "required",
    			section_id: "required",
    			subject_group: "required", 
    		},
    		messages: {
    			class_id: "Please select your class",
    			section_id: "Please select your section",
    			subject_group: "Please select your subject group",
    		},
    		submitHandler: function() {
    			var $this = $(this).find("button[type=submit]:focus");
                var items = [];
                var class_id = $('#class_id').val();
                var section_id = $('#section_id').val();
                var subject_group_id = $('#subject_group').val();
                $('.student_select:checked').each(function() {
                   items.push(this.value); 
                });
                $.ajax({
                    url: "<?php echo site_url("student/addStudent/") ?>",
                    type: "POST",
                    data: {
        				items: items,
        				class_id: class_id,
        				section_id: section_id,
        				subject_group_id: subject_group_id
        			},
                    dataType: 'json',
                    beforeSend: function() {
                        $this.button('loading');
                    },
                    success: function(res) {
                        // if (res.status == "fail") {
                        //     var message = "";
                        //     $.each(res.error, function(index, value) {
                        //         message += value;
                        //     });
                        //     errorMsg(message);
                        // } else {
                            successMsg(res.message);
                            window.location.reload(true);
                        // }
                    },
                    error: function(xhr) { // if error occured
                        window.location.reload(true);
                    },
                    complete: function() {
                        window.location.reload(true);
                        $this.button('reset');
                    }
                });
    		}
    	});
    });
    function delete_enquiry(id) {
        if (confirm('<?php echo $this->lang->line('delete_confirm') ?>')) {
            $.ajax({
                url: '<?php echo base_url(); ?>admin/enquiry/delete/' + id,
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                    if (data.status == "fail") {
                        var message = "";
                        $.each(data.error, function(index, value) {
                            message += value;
                        });
                        errorMsg(message);
                    } else {
                        successMsg(data.message);
                        window.location.reload(true);
                    }
                }
            })
        }
    }

    function follow_up(id, status, created_by) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/enquiry/follow_up/' + id + '/' + status + '/' + created_by,
            success: function(data) {
                $('#getdetails_follow_up').html(data);
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/enquiry/follow_up_list/' + id,
                    success: function(data) {
                        $('#timeline').html(data);
                    },
                    error: function() {
                        alert("<?php echo $this->lang->line('fail'); ?>");
                    }
                });
            },
            error: function() {
                alert("<?php echo $this->lang->line('fail'); ?>");
            }
        });
    }

    function update() {
        window.location.reload(true);
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        
        $(function() {
            $('input[name="daterange"]').daterangepicker();
        });
        
        $('input[name="daterange"]').on('cancel.daterangepicker', function (ev, picker) {
            $(this).val('<?= date("m/d/Y", time()).' - '.date("m/d/Y", time()) ?>');
        });
        
        $("#enquirytable").DataTable({
            searching: true,
            paging: true,
            bSort: true,
            info: false,
            dom: "Bfrtip",
            buttons: [

                {
                    extend: 'copyHtml5',
                    text: '<i class="fa fa-files-o"></i>',
                    titleAttr: 'Copy',
                    title: $('.download_label').html(),
                    exportOptions: {
                        columns: ':visible'
                    }
                },

                {
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-file-excel-o"></i>',
                    titleAttr: 'Excel',
                    title: $('.download_label').html(),
                    exportOptions: {
                        columns: ':visible'
                    }
                },

                {
                    extend: 'csvHtml5',
                    text: '<i class="fa fa-file-text-o"></i>',
                    titleAttr: 'CSV',
                    title: $('.download_label').html(),
                    exportOptions: {
                        columns: ':visible'
                    }
                },

                {
                    extend: 'pdfHtml5',
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    titleAttr: 'PDF',
                    title: $('.download_label').html(),
                    exportOptions: {
                        columns: ':visible'

                    }
                },

                {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i>',
                    titleAttr: 'Print',
                    title: $('.download_label').html(),
                    customize: function(win) {
                        $(win.document.body)
                            .css('font-size', '10pt');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    },
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    },
                },

                {
                    extend: 'colvis',
                    text: '<i class="fa fa-columns"></i>',
                    titleAttr: 'Columns',
                    title: $('.download_label').html(),
                    postfixButtons: ['colvisRestore']
                },
            ]
        });
    });

    $('#number').blur(function() {
        $('#phone_error_message').html('');
        $.ajax({
            url: '<?php echo base_url(); ?>admin/enquiry/check_number',
            type: 'POST',
            data: {
                phone_number: $('#number').val()
            },
            dataType: 'json',
            success: function(data) {
                if (data.status == "success") {
                    $('#phone_error_message').html('(' + data.message + ')');
                }
            }
        })
    })

    $("#selectAll").click(function() {
        $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
    });

    $("input[type=checkbox]").click(function() {
        if (!$(this).prop("checked")) {
            $("#selectAll").prop("checked", false);
        }
    });

    // getSectionByClass
    $(document).on('change', '#class_id', function(e) {
        $('#section_id').html("");
        var class_id = $(this).val();
        getSectionByClass(class_id, 0);
    });

    // getSubjectGroupByClass
    $(document).on('change', '#class_id', function(e) {
        $('#section_id').html("");
        var class_id = $(this).val();
        getSubjectGroupByClass(class_id, 0);
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
    
    function getSubjectGroupByClass(class_id) {
        if (class_id != "") {
            $('#subject_group').html("");
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
                url: base_url + "admin/subjectgroup/getGroupByClass",
                data: {
                    'class_id': class_id
                },
                dataType: "json",
                beforeSend: function() {
                    $('#subject_group').addClass('dropdownloading');
                },
                success: function(data) {
                    $.each(data, function(i, obj) {
                        var sel = "";
                        if (section_id == obj.section_id) {
                            sel = "selected";
                        }
                        div_data += "<option value=" + obj.id + " " + sel + ">" + obj.class + "</option>";
                    });
                    $('#subject_group').append(div_data);
                },
                complete: function() {
                    $('#subject_group').removeClass('dropdownloading');
                }
            });
        }
    }
</script>