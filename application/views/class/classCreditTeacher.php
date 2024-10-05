<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i> <?php //echo $this->lang->line('academics'); ?></h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php
            if ($this->rbac->hasPrivilege('assign_class_credit_teacher', 'can_add')) {
                ?>
                <div class="col-md-4">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('assign_class_credit_teacher'); ?></h3>
                        </div><!-- /.box-header -->
                        <form id="form1" action="<?php echo base_url() ?>admin/teacher/assign_class_credit_teacher"  method="post" accept-charset="utf-8">
                            <div class="box-body">
                                <?php 
                                    if ($this->session->flashdata('msg')) { 
                                        echo $this->session->flashdata('msg');
                                        $this->session->unset_userdata('msg');
                                    }
                                ?>

                                <?php
                                if (isset($error_message)) {
                                    echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                                }
                                ?>
                                <?php echo $this->customlib->getCSRF(); ?>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('subject'); ?></label><small class="req"> *</small>
                                    <select class="form-control" name="subject" id="subject_id">
                                        <option value=''><?php echo $this->lang->line('subject') ?></option>
                                        <?php
                                        foreach ($subjectlist as $subject_key => $subject_value) {
                                            ?>

                                            <option value="<?php echo $subject_value["id"] ?>" <?php echo set_select('name', $subject_value["id"], set_value('name')); ?>><?php echo $subject_value["name"] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>

                                    <span class="text-danger"><?php echo form_error('subject'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('section_credit'); ?></label><small class="req"> *</small>


                                    <select class="form-control" id="section_credit_id" name="section_credit">
                                        <option value=""><?php echo $this->lang->line('section_credit') ?></option> 
                                    </select>

                                    <span class="text-danger"><?php echo form_error('section_credit'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('class_teacher'); ?></label><small class="req"> *</small>
                                    <select class="form-control" name="teachers" id="teachers">
                                        <option value=''><?php echo $this->lang->line('select') ?></option>
                                        <?php
                                        foreach ($teacherlist as $tvalue) {
                                            ?>

                                            <option value="<?php echo $tvalue["id"] ?>" <?php echo set_select('teachers', $tvalue["id"], set_value('teachers')); ?>><?php echo $tvalue['name'] . " " . $tvalue['surname'] . " (" . $tvalue['employee_id'] . ")"; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>

                                    <span class="text-danger"><?php echo form_error('teachers'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('supervisory_inspection'); ?></label><small class="req"> *</small>

                                    <select class="form-control" name="supervisory_inspection" id="supervisory_inspection">
                                        <option value=''><?php echo $this->lang->line('supervisory_inspection') ?></option>
                                        <?php
                                        foreach ($teacherlist as $tvalue) {
                                            ?>

                                            <option value="<?php echo $tvalue["id"] ?>" <?php echo set_select('supervisory_inspection', $tvalue["id"], set_value('supervisory_inspection')); ?>><?php echo $tvalue['name'] . " " . $tvalue['surname'] . " (" . $tvalue['employee_id'] . ")"; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>

                                    <span class="text-danger"><?php echo form_error('supervisory_inspection'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('academic_advisor'); ?></label><small class="req"> *</small>


                                    <select class="form-control" name="academic_advisor" id="academic_advisor">
                                        <option value=''><?php echo $this->lang->line('academic_advisor') ?></option>
                                        <?php
                                        foreach ($teacherlist as $tvalue) {
                                            ?>

                                            <option value="<?php echo $tvalue["id"] ?>" <?php echo set_select('academic_advisor', $tvalue["id"], set_value('academic_advisor')); ?>><?php echo $tvalue['name'] . " " . $tvalue['surname'] . " (" . $tvalue['employee_id'] . ")"; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>

                                    <span class="text-danger"><?php echo form_error('academic_advisor'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('technical_support'); ?></label><small class="req"> *</small>

                                    <select class="form-control" name="technical_support" id="technical_support">
                                        <option value=''><?php echo $this->lang->line('technical_support') ?></option>
                                        <?php
                                        foreach ($teacherlist as $tvalue) {
                                            ?>

                                            <option value="<?php echo $tvalue["id"] ?>" <?php echo set_select('technical_support', $tvalue["id"], set_value('technical_support')); ?>><?php echo $tvalue['name'] . " " . $tvalue['surname'] . " (" . $tvalue['employee_id'] . ")"; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>

                                    <span class="text-danger"><?php echo form_error('technical_support'); ?></span>
                                </div>

                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>
                        </form>
                    </div>

                </div><!--/.col (right) -->
                <!-- left column -->
            <?php } ?>
            <div class="col-md-<?php
            if ($this->rbac->hasPrivilege('assign_class_credit_teacher', 'can_add')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('class_credit_teacher_list'); ?></h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages overflow-visible">
                            <div class="download_label"><?php echo $this->lang->line('class_credit_teacher_list'); ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>

                                        <th><?php echo $this->lang->line('subject'); ?>
                                        </th>
                                        <th><?php echo $this->lang->line('credits'); ?>
                                        </th>
                                        <th><?php echo $this->lang->line('class_teacher'); ?>
                                        <th><?php echo $this->lang->line('supervisory_inspection'); ?>
                                        <th><?php echo $this->lang->line('academic_advisor'); ?>
                                        <th><?php echo $this->lang->line('technical_support'); ?>
                                        </th>

                                        <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;

                                    foreach ($assignteacherlist as $teacher) {
                                        ?>
                                        <tr>
                                            <td class="mailbox-name">
                                                <?php echo $teacher["name"]; ?>

                                            </td>


                                            <td>

                                                <?php echo $teacher["section_credit_name"]; ?>

                                            </td>
                                            <td>
                                                <?php foreach ($tlist[$i] as $key => $tsvalue) {
                                                    ?>

                                                    <?php echo $tsvalue['name'] . " " . $tsvalue['surname'] . " (" . $tsvalue['employee_id'] . ")" . "<br/>"; ?>
                                                    <input type="hidden"  name="teacherid[]" value="<?php echo $tsvalue["id"] ?>" >
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php foreach ($teacherlist as $item) {
                                                       echo $item['id'] == $teacher['supervisory_inspection'] ? $item['name'] . " " . $item['surname'] . " (" . $item['employee_id'] . ")" : '';
                                            } ?>
                                            </td>
                                            <td>
                                                <?php foreach ($teacherlist as $item) {
                                                       echo $item['id'] == $teacher['academic_advisor'] ? $item['name'] . " " . $item['surname'] . " (" . $item['employee_id'] . ")" : '';
                                            } ?>
                                            </td>
                                            <td>
                                                <?php foreach ($teacherlist as $item) {
                                                       echo $item['id'] == $teacher['technical_support'] ? $item['name'] . " " . $item['surname'] . " (" . $item['employee_id'] . ")" : '';
                                            } ?>
                                            </td>
                                            <td class="mailbox-date pull-right">
                                                <?php
                                                if ($this->rbac->hasPrivilege('assign_class_credit_teacher', 'can_edit')) {
                                                    ?>
                                                    <a href="<?php echo base_url(); ?>admin/teacher/update_class_teacher/<?php echo $teacher["section_credit_id"]; ?>/<?php echo $teacher["subject_id"]; ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <?php
                                                }
                                                if ($this->rbac->hasPrivilege('assign_class_credit_teacher', 'can_delete')) {
                                                    ?>
                                                    <a href="<?php echo base_url(); ?>admin/teacher/classteacherdelete/<?php echo $teacher["section_credit_id"]; ?>/<?php echo $teacher["subject_id"]; ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
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
        <div class="row">
            <!-- left column -->

            <!-- right column -->
            <div class="col-md-12">

            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">
    function getSectionCreditBySubject(subject_id, section_id) {
        if (subject_id != "") {
            $('#section_credit_id').html("");
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "credits/getBySubject",
                data: {'subject_id': subject_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        var sel = "";
                        if (section_id == obj.section_id) {
                            sel = "selected";
                        }
                        div_data += "<option value=" + obj.subject_id + " " + sel + ">" + obj.section + "</option>";
                    });

                    $('#section_credit_id').append(div_data);
                }
            });
        }
    }
    function getSectionByClass(class_id, section_id) {
        if (class_id != "") {
            $('#section_credit_id').html("");
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "credits/getByClass",
                data: {'class_id': class_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        var sel = "";
                        if (section_id == obj.section_id) {
                            sel = "selected";
                        }
                        div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
                    });

                    $('#section_id').append(div_data);
                }
            });
        }
    }
    $(document).ready(function () {
        $(document).on('change', '#subject_id', function (e) {
            $('#section_credit_id').html("");
            var subject_id = $(this).val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "credits/getBySubject",
                data: {'subject_id': subject_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        div_data += "<option value=" + obj.id + ">" + obj.section_credit_name + "</option>";
                    });

                    $('#section_credit_id').append(div_data);
                }
            });
        });
        
        $(document).on('change', '#subject_id', function (e) {
            $('#teachers').html("");
            var subject_id = $(this).val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "classes/getTeacherBySubject",
                data: {'subject_id': subject_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        div_data += "<option value=" + obj.id + ">" + obj.name + ' ' + obj.surname + "(" + obj.employee_id + ")" + "</option>";
                    });

                    $('#teachers').append(div_data);
                }
            });
        });
        var subject_id = $('#subject_id').val();
        var section_id = '<?php echo set_value('section') ?>';

        getSectionCreditBySubject(subject_id, section_id);
        $(document).on('change', '#feecategory_id', function (e) {
            $('#feetype_id').html("");
            var feecategory_id = $(this).val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "feemaster/getByFeecategory",
                data: {'feecategory_id': feecategory_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        div_data += "<option value=" + obj.id + ">" + obj.type + "</option>";
                    });

                    $('#feetype_id').append(div_data);
                }
            });
        });
    });

</script>