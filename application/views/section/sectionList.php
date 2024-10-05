<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('academics'); ?> <small><?php echo $this->lang->line('student_fees1'); ?></small>        </h1>
    </section>
    <!-- Main content -->
    <style>
    @media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
}
</style>
    <section class="content">
        <div class="row">
            <?php
            if ($this->rbac->hasPrivilege('section', 'can_add')) {
                ?>
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $this->lang->line('add_section'); ?></h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div> 
                    <form action="<?php echo site_url('sections/index') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php 
                                    echo $this->session->flashdata('msg');
                                    $this->session->unset_userdata('msg');
                                ?>
                            <?php } ?>  
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('section_name'); ?> </label><small class="req"> *</small>
                                <input autofocus="" id="section" name="section" placeholder="" type="text" class="form-control"  value="<?php echo set_value('section'); ?>" />
                                <span class="text-danger"><?php echo form_error('section'); ?></span>
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mã lớp </label><small class="req"> *</small>
                                <input autofocus="" id="section_code" name="section_code" placeholder="" type="text" class="form-control"  value="<?php echo set_value('section_code'); ?>" />
                                <span class="text-danger"><?php echo form_error('section_code'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('admission_intake'); ?></label><small class="req"> *</small>
                                <select id="admission_intake" name="admission_intake_id" class="form-control">
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    <?php
                                        if (!empty($admissionintake)) {
                                            foreach ($admissionintake as $item) { ?>
                                                <option value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option> 
                                            <?php }
                                        }
                                    ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('training_system'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('homeroom_teacher'); ?></label><small class="req"> *</small>


                                <select id="homeroom_teacher_id" name="homeroom_teacher_id" class="form-control">
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    <?php
                                        if (!empty($teacherlist)) {
                                            foreach ($teacherlist as $tvalue) { ?>
                                                <option value="<?php echo $tvalue['id']; ?>"><?php echo $tvalue['name'] . " " . $tvalue['surname'] . " (" . $tvalue['employee_id'] . ")"; ?></option> 
                                            <?php }
                                        }
                                    ?>
                                </select>

                                <span class="text-danger"><?php echo form_error('teachers[]'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('training_system'); ?></label><small class="req"> *</small>
                                <select id="training_system" name="training_system" class="form-control">
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
                                <span class="text-danger"><?php echo form_error('training_system'); ?></span>
                            </div>
                            <div class="form-group"> <!-- Radio group !-->
                                <div class="class_radios">
                                </div>
                                <span class="text-danger"><?php echo form_error('classes[]'); ?></span>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
            <?php } ?>
            <div class="col-md-<?php
            if ($this->rbac->hasPrivilege('class', 'can_add')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">           
            
                <div class="box box-primary">
                    <div class="title-header ptbnull">
                        <div><h3 class="box-title titlefix"><?php echo $this->lang->line('section_list'); ?></h3></div>
                        <div class="col-12">
                            <div class="col-sm-12 mx-3">
                                <div class="form-group">
                                <!--    <select autofocus="" id="training_system_id" name="training_system_id" class="form-control" autocomplete="off">-->
                                <!--        <option value=""><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Chuyên ngành đào tạo</font></font></option>-->
                                <!--                                                  <option value="1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Lớp 1</font></font></option>-->
                                <!--                                                                                          <option value="2"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Lớp 2</font></font></option>-->
                                <!--                                                                                          <option value="3"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Lớp 3</font></font></option>-->
                                <!--                                                                                          <option value="4"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Lớp 4</font></font></option>-->
                                <!--                                                                                          <option value="5"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Lớp 5</font></font></option>-->
                                <!--                                                                                          <option value="6"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">lớp 6</font></font></option>-->
                                <!--                                                                                          <option value="7"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">lớp 6</font></font></option>-->
                                <!--                                                                                          <option value="8"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">7</font></font></option>-->
                                <!--                                                                                                                                    </select>-->
                                <!--     <span class="text-danger" id="error_training_system_id"></span>-->
                                <!--</div>-->
                                <!-- <button type="submit" class="btn btn-primary btn-sm pull-right" name="class_search" data-loading-text="Please wait.." value="class_search" autocomplete="off"><i class="fa fa-search"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Tìm kiếm</font></font></font></font></button>-->
                            </div>
                        </div>
                    </div>
                    
                    <div class="box-body ">
                        <div class="table-responsive mailbox-messages overflow-visible">
                            
                            <div class="download_label"><?php echo $this->lang->line('section_list'); ?></div>
                            
                            <table class="table table-striped table-bordered table-hover example">
                                
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('section'); ?></th>
                                        <th>Chuyên ngành</th>
                                        <th>Mã lớp</th>
                                        <th><?php echo $this->lang->line('training_system'); ?></th>
                                        <th><?php echo $this->lang->line('admission_intake'); ?></th>
                                        <th><?php echo $this->lang->line('homeroom_teacher'); ?></th>
                                        <?php
                                            if ($this->rbac->hasPrivilege('section', 'can_edit') && $this->rbac->hasPrivilege('section', 'can_delete')) {
                                        ?>
                                        <th class="text-right noExport "><?php echo $this->lang->line('action'); ?></th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>                                   

                                    <?php
                                    $count = 1;
                                    foreach ($sectionlist as $section) {
                                        ?>
                                        <tr>
                                            <td class="mailbox-name">
                                                <a href="<?php echo base_url(); ?>student/search/<?php echo $section->id ?>"><?php echo $section->section ?></a>
                                            </td>
                                            <td>
                                                <?php
                                                    $vehicles = $section->vehicles;
                                                    if (!empty($vehicles)) {
    
    
                                                        foreach ($vehicles as $key => $value) {
    
    
                                                            echo "<div>" . $value->class . "</div>";
                                                        }
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo $section->section_code; ?>
                                            </td>
                                            <td>
                                                <? foreach ($trainingsystem as $item) { if($item['id'] == $section->training_system_id) { echo $item['name']; }} ?>
                                            </td>
                                            <td>
                                                <? foreach ($admissionintake as $item) { if($item['id'] == $section->admission_intake_id) { echo $item['name']; }} ?>
                                            </td>
                                            <td>
                                                <? foreach ($teacherlist as $item) { if($item['id'] == $section->homeroom_teacher_id) { echo $item['name']; }} ?>
                                            </td>
                                            <?php
                                                if ($this->rbac->hasPrivilege('section', 'can_edit') && $this->rbac->hasPrivilege('section', 'can_delete')) {
                                            ?>
                                            <td class="mailbox-date pull-right ">
                                                <?php
                                                if ($this->rbac->hasPrivilege('section', 'can_edit')) {
                                                    ?>
                                                    <a href="<?php echo base_url(); ?>sections/edit/<?php echo $section->id ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <?php
                                                }
                                                if ($this->rbac->hasPrivilege('section', 'can_delete')) {
                                                    ?>
                                                    <a href="<?php echo base_url(); ?>sections/delete/<?php echo $section->id ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line("section_will_also_delete_all_students_under_this_section_so_be_careful_as_this_action_is_irreversible"); ?>');">
                                                        <i class="fa fa-remove"></i>
                                                    </a>
                                                <?php } ?>
                                            </td>
                                            <?php } ?>
                                        </tr>
                                        <?php
                                    }
                                    $count++;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> 

        </div> 
    </section>
</div>
<script>
    var section_id = <?php echo $section_id; ?>;
    var training_system_id = '<?php echo set_value('training_system_id', 0) ?>';
    $(document).ready(function () {
        getClassByClass(training_system_id, 0);
        $(document).on('change', '#training_system', function (e) {
            var training_system_id = $(this).val();
            getClassByClass(training_system_id, 0);
        });
    });

    function getClassByClass(training_system_id, section_id) {
        $('.class_radio').html('');
        if (training_system_id !== "" && training_system_id !== 0) {
            var div_data = "<label class='control-label'><?php echo $this->lang->line('class'); ?></label><small class='req'> *</small>";
            $.ajax({
                type: "GET",
                url: base_url + "classes/getByTrainingSystem",
                data: {'training_system_id': training_system_id},
                dataType: "json",
                beforeSend: function () {

                },
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        var check = "";
                        if (obj.id == section_id) {
                            check = "checked";
                        }
                        div_data += "<div class='checkbox'>";
                        div_data += "<label>";
                        div_data += "<input type='radio' class='content_available' name='classes[]' value='" + obj.id + "' " + check + ">" + obj.class;

                        div_data += "</label>";
                        div_data += "</div>";

                    });
                    $('.class_radios').html(div_data);
                },
                error: function (xhr) { // if error occured
                    alert("<?php echo $this->lang->line('error_occurred_please_try_again'); ?>");

                },
                complete: function () {

                }
            });
        }
    }
</script>