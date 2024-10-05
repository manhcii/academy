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
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">Danh sách lớp học phần</h3>
                        <div class="box-tools pull-right">
                            <?php if ($this->rbac->hasPrivilege('section_class', 'can_add')) {?>
                            <a href="<?php echo base_url().'sectionclass/add' ?>" class="btn btn-primary btn-sm">Thêm lớp học phần</a>
                            <?php }?>

                        </div><!-- /.box-tools -->
                    </div>
                    
                    <div class="box-body ">
                        <div class="table-responsive mailbox-messages overflow-visible">
                            
                            <div class="download_label"><?php echo $this->lang->line('section_list'); ?></div>
                            
                            <table class="table table-striped table-bordered table-hover example">
                                
                                <thead>
                                    <tr>
                                        <th>Môn học</th>
                                        <th>Mã lớp độc lập</th>
                                        <th>Bậc đào tạo</th>
                                        <th>Ngày tạo</th>
                                        <th>Ngày bắt đầu</th>
                                        <th>Ngày kết thúc</th>
                                        <th>Số tín chỉ</th>
                                        <th>Trạng thái</th>
                                        <th>Giáo viên phụ trách</th>
                                        <?php
                                            if ($this->rbac->hasPrivilege('section_class', 'can_edit') && $this->rbac->hasPrivilege('section_class', 'can_delete')) {
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
                                                <a href="<?php echo base_url(); ?>student/search/<?php echo $section->id ?>"><?php echo $section->subject ? $section->subject->name : '' ?></a>
                                            </td>
                                            <td>
                                                <?php echo $section->section_class_code; ?>
                                            </td>
                                            <td>
                                                <?php echo $this->lang->line($section->training_system); ?>
                                            </td>
                                            <td>
                                                <?php echo date($this->customlib->getSchoolDateFormat(), strtotime($section->created_at)); ?>
                                            </td>
                                            <td>
                                                <?php echo date($this->customlib->getSchoolDateFormat(), strtotime($section->section_class_date_start)); ?>
                                            </td>
                                            <td>
                                                <?php echo date($this->customlib->getSchoolDateFormat(), strtotime($section->section_class_date_end)); ?>    
                                            </td>
                                            <td></td>
                                            <td>
                                                <span class="label label-success"><?php echo $this->lang->line('approved') ?></span>
                                            </td>
                                            <td>
                                                <?php if($section->teacher): ?>
                                                <a href="<?php echo base_url(); ?>admin/staff/profile/<?php echo $section->teacher->staff_id ?>"><?php echo $section->teacher ? ($section->teacher->name . " " . $section->teacher->surname) : '' ?></a>
                                                <?php endif ?>
                                            </td>
                                            <?php
                                                if ($this->rbac->hasPrivilege('section_class', 'can_edit') && $this->rbac->hasPrivilege('section_class', 'can_delete')) {
                                            ?>
                                            <td class="mailbox-date pull-right ">
                                                <a href="<?php echo base_url(); ?>sectionclass/addstudent/<?php echo $section->id ?>" class="btn btn-default btn-xs" title="<?php echo $this->lang->line('edit'); ?>" data-toggle="tooltip">
                                                    <i class="fa fa-users" aria-hidden="true"></i>
                                                </a>
                                                <?php
                                                if ($this->rbac->hasPrivilege('section_class', 'can_edit')) {
                                                    ?>
                                                    <a href="<?php echo base_url(); ?>sectionclass/edit/<?php echo $section->id ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <?php
                                                }
                                                if ($this->rbac->hasPrivilege('section_class', 'can_delete')) {
                                                    ?>
                                                    <a href="<?php echo base_url(); ?>sectionclass/delete/<?php echo $section->id ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line("section_will_also_delete_all_students_under_this_section_so_be_careful_as_this_action_is_irreversible"); ?>');">
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