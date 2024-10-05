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
                    <div class="box-header">
                        <div class="box-body box-profile pt0 col-md-6">
                        <h3 class="box-title" style="margin-bottom: 15px;"><i class="fa fa-search"></i> Thông tin lớp học phần</h3>
                            <input autofocus="" id="section_credit_id" name="section_credit_id" type="hidden" value="<?=$credit['id']?>" />
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item listnoback border0">
                                    <b><?php echo $this->lang->line('section_credit_name'); ?></b> <a class="pull-right text-aqua"><?=$credit['section_credit_name']?></a>
                                </li>
                                <li class="list-group-item listnoback">
                                    <b>Mã lớp</b> <a class="pull-right text-aqua"><?=$credit['section_credit_code']?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <?php echo $this->session->flashdata('msg');
                        $this->session->unset_userdata('msg'); ?>
                    </div>
                    <? if (true) {?>
                        <form role="form" action="<?php echo site_url('credits/listStudents/'.$credit['id']) ?>" method="post" class="">
                            <div class="box-body row">
                                <?php echo $this->customlib->getCSRF(); ?>
                                <div class="col-sm-6 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('class'); ?></label>
                                        <select id="class" name="class" class="form-control">
                                            <option value="">Tất cả</option>
                                            <?php foreach ($class_list as $key => $value) {
                                            ?>
                                                <option <?= $value["id"] == $selected_class ? "selected" : ''?> value="<?php echo $value["id"] ?>"><?php echo $value["class"] ?></option>
                                            <?php } ?>
                                        </select>
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
                    <?}?>
                    <div class="ptt10">
                        <div class="bordertop">
                            <div class="box-header with-border">
                                <h3 class="box-title titlefix"> Danh sách sinh viên</h3>
                                <div class="box-tools pull-right">
                                    <?php if ($this->rbac->hasPrivilege('credits', 'can_edit')): ?>
                                    <button type="button" class="btn btn-sm btn-primary" id="addStudents"><i class="fa fa-plus"></i>Thêm học sinh vào lớp học phần</button>
                                    <?php endif; ?>
                                </div><!-- /.box-tools -->
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="download_label"><?php echo $this->lang->line('admission_enquiry_list'); ?></div>
                                <div class="mailbox-messages">
                                    <div class="table-responsive overflow-visible-lg">
                                        <table class="table table-hover table-striped table-bordered" id="enquirytable">
                                            <thead>
                                                <tr>
                                                    <?php if ($this->rbac->hasPrivilege('browse_profile', 'can_edit')): ?>
                                                    <th class="text-center noExport1"><input id="selectAll" type="checkbox"></th>
                                                    <?php endif; ?>
                                                    <th><?php echo $this->lang->line('admission_no'); ?></th>
                                                    <th><?php echo $this->lang->line('name');?></th>
                                                    <th><?php echo $this->lang->line('phone'); ?></th>
                                                    <th><?php echo $this->lang->line('email'); ?></th>
                                                    <th>Chuyên ngành</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                if (empty($students)) {
                                                ?>
                                                    <?php
                                                } else {
                                                    foreach ($students as $key => $value) { ?>
                                                        <tr>
                                                            <?php if ($this->rbac->hasPrivilege('credits', 'can_edit')): ?>
                                                            <td class="text-center"><input value="<?= $value["id"] ?>" class="student_select" type="checkbox"></td>
                                                            <?php endif; ?>
                                                            <td class="mailbox-name"><?php echo $value['admission_no']; ?></td>
                                                            <td class="mailbox-name"><a target="_blank" href="<?php echo base_url(); ?>student/view/<?php echo $value['id'] ?>"><?php echo $value['firstname'] ?></a> </td>
                                                            <td class="mailbox-name"><?php echo $value['mobileno']; ?> </td>
                                                            <td class="mailbox-name"><?php echo $value['email']; ?></td>
                                                            <td class="mailbox-name"><?= !empty($value['class']) ? $value['class'] : ''; ?></td>
                                                        </tr>
                                                <?php
                                                    }
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
    </section>>
</div>

<script>
    $(document).ready(function(e) {
        $('#myModal,#follow_up,#myModaledit').modal({
            backdrop: 'static',
            keyboard: false,
            show: false
        });
    });

    $("#addStudents").click(function() {
        var count_student = $('.student_select:checked').length;
        if (count_student > 0) {
            var items = [];
            var section_credit_id = $('#section_credit_id').val();
            $('.student_select:checked').each(function() {
               items.push(this.value); 
            });
            $.ajax({
                url: "<?php echo site_url("credits/addStudents/") ?>",
                type: "POST",
                data: {
    				students: items,
    				section_credit_id: section_credit_id
    			},
                dataType: 'json',
                success: function(res) {
                    successMsg(res.message);
                    window.location.reload(true);
                },
                error: function(xhr) {
                    window.location.reload(true);
                },
                complete: function() {
                    window.location.reload(true);
                    $this.button('reset');
                }
            });
        } else {
            alert('Vui lòng lựa chọn sinh viên.')
        }
    });

    $(".openmodal").click(function() {
        $('#formadd').trigger("reset");
        $("#myModal").modal();
    });
    
    $("#selectAll").click(function() {
        $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
    });

    $("input[type=checkbox]").click(function() {
        if (!$(this).prop("checked")) {
            $("#selectAll").prop("checked", false);
        }
    });
</script>