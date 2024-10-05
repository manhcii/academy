<div class="content-wrapper">   
    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('academics'); ?> <small><?php echo $this->lang->line('student_fees1'); ?></small>        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Chỉnh sửa lớp học phần</h3>
                    </div>
                    <form action="<?php echo site_url("sections/edit/" . $id) ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php 
                                    echo $this->session->flashdata('msg');
                                    $this->session->unset_userdata('msg');
                                ?>
                            <?php } ?>   
                            <?php echo $this->customlib->getCSRF(); ?>
                            <input type="hidden" name="id" value="<?php echo set_value('id', $vehroute[0]->id); ?>" >
                            <input type="hidden" name="pre_sectionclass_id" value="<?php echo $vehroute[0]->id; ?>" >
                            <input type="hidden" name="prev_subject" value="<?php echo $vehroute[0]->subject->id; ?>">

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Mã lớp </label><small class="req"> *</small>
                                    <input autofocus="" id="section_class_code" name="section_class_code" placeholder="" type="text" class="form-control"  value="<?php echo set_value('section_class_code',$section['section_class_code']); ?>" />
                                    <span class="text-danger"><?php echo form_error('section_class_code'); ?></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Giáo viên phụ trách </label><small class="req"> *</small>
                                    <select class="form-control" name="teacher" id="teacher" autocomplete="off">
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($teacherlist as $key => $value) {
                                            ?>
                                            <option value="<?php echo $value['id']; ?>" <?php if (set_value('teacher',$vehroute[0]->teacher->staff_id) == $value['id']) echo "selected"; ?>>
                                                <?php echo $value['name'] . " " . $value['surname'] . " (" . $value['employee_id'] . ")"; ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('section_class_code'); ?></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Ngày bắt đầu </label><small class="req"> *</small>
                                    <input autofocus="" id="section_class_date_start" name="section_class_date_start" placeholder="dd/mm/YYYY" type="text" class="form-control date"  value="<?php echo set_value('section_class_date_start',date($this->customlib->getSchoolDateFormat(), strtotime($section['section_class_date_start']))); ?>" />
                                    <span class="text-danger"><?php echo form_error('section_class_date_start'); ?></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Ngày kết thúc </label><small class="req"> *</small>
                                    <input autofocus="" id="section_class_date_end" name="section_class_date_end" placeholder="dd/mm/YYYY" type="text" class="form-control date"  value="<?php echo set_value('section_class_code',date($this->customlib->getSchoolDateFormat(), strtotime($section['section_class_date_end']))); ?>" />
                                    <span class="text-danger"><?php echo form_error('section_class_date_end'); ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div><label for="exampleInputEmail1">Chuyên ngành đào tạo</label><small class="req"> *</small></div>
        
        
                                <div>
                                    <?php
                                    foreach ($subjectlist as $subject) {
                                        ?>
                                        <div class="checkbox">
                                            <label>
                                                <input type="radio" name="subject" value="<?php echo $subject['id'] ?>" <?php echo set_checkbox('subject', $subject['id'],check_in_array($subject['id'], $vehroute[0]->subject)); ?> ><?php echo $subject['name'] ?>
                                            </label>
                                        </div>
                                        <?php
                                    }
                                    ?>
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
        </div> 
    </section>
</div>
<?php

function check_in_array($find, $obj) {

        if ($find == $obj->id) {
            return TRUE;
        }
    return FALSE;
}
?>