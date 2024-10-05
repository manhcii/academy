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
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thêm lớp học phần</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div> 
                    <form action="<?php echo site_url('sectionclass/add') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php 
                                    echo $this->session->flashdata('msg');
                                    $this->session->unset_userdata('msg');
                                ?>
                            <?php } ?>  
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Mã lớp độc lập </label><small class="req"> *</small>
                                    <input autofocus="" id="section_class_code" name="section_class_code" placeholder="Mã lớp độc lập" type="text" class="form-control"  value="<?php echo set_value('section_class_code'); ?>" />
                                    <span class="text-danger"><?php echo form_error('section_class_code'); ?></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Giáo viên phụ trách </label><small class="req"> *</small>
                                    <select class="form-control" name="teacher" id="teacher" autocomplete="off">
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($teacherlist as $key => $value) {
                                            ?>
                                            <option value="<?php echo $value['id']; ?>" <?php if (set_value('teacher') == $value['id']) echo "selected"; ?>>
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
                                    <input autofocus="" id="section_class_date_start" name="section_class_date_start" placeholder="dd/mm/YYYY" type="text" class="form-control date"  value="<?php echo set_value('section_class_date_start'); ?>" />
                                    <span class="text-danger"><?php echo form_error('section_class_date_start'); ?></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Ngày kết thúc </label><small class="req"> *</small>
                                    <input autofocus="" id="section_class_date_end" name="section_class_date_end" placeholder="dd/mm/YYYY" type="text" class="form-control date"  value="<?php echo set_value('section_class_code'); ?>" />
                                    <span class="text-danger"><?php echo form_error('section_class_date_end'); ?></span>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Bậc đào tạo </label><small class="req"> *</small>
                                    <select id="training_system" name="training_system" class="form-control">
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <option value="University">Đại học</option>
                                        <option value="College">Cao đẳng chính quy</option>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('training_system'); ?></span>
                                </div>
                            </div>
        
                            <div class="form-group">
                                <div><label for="exampleInputEmail1">Môn học</label><small class="req"> *</small></div>
        
        
                                <div>
                                    <?php
                                    foreach ($subjectlist as $subject) {
                                        ?>
                                        <div class="checkbox">
                                            <label>
                                                <input type="radio" name="subject" value="<?php echo $subject['id'] ?>" <?php echo set_checkbox('subject', $subject['id']); ?> ><?php echo $subject['name'] ?>
                                            </label>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
        
                                <span class="text-danger"><?php echo form_error('subject'); ?></span>
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