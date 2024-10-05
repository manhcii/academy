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
            if ($this->rbac->hasPrivilege('credit', 'can_add') && false) {
                ?>
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= $this->lang->line('add_student_section_credit'). ' '.$credit['section_credit_name'] ?></h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div> 
                    <form action="<?php echo site_url('credits/addStudent') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php 
                                    echo $this->session->flashdata('msg');
                                    $this->session->unset_userdata('msg');
                                ?>
                            <?php } ?>  
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('student_list'); ?></label><small class="req"> *</small>
                                <select id="students" name="students[]" class="form-control" multiple="multiple">
                                    <?php
                                    foreach ($students as $key => $student) {
                                    ?>
                                        <option value="<?php echo $student['id'] ?>"><?php echo $student["firstname"]; ?></option>
                                    <?php }
                                    ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('students[]'); ?></span>
                            </div>
                            <input type="hidden" name="section_credit_id" id="" value="<?=$credit['id']?>" />
                            
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
            <?php } ?>
            <div class="col-md-12">           
            
                <div class="box box-primary">
                    <div class="title-header ptbnull">
                        <div><h3 class="box-title titlefix"><?= $this->lang->line('student_list'). ' lớp '.$credit['section_credit_name'] ?></h3>
                        <div class="pull-right">
                            <a href="<?php echo site_url('credits/listStudents/'.$credit['id']) ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Thêm sinh viên vào lớp</a>
                        </div></div>
                        
                    </div>
                    
                    <div class="box-body ">
                        <div class="table-responsive mailbox-messages overflow-visible">
                            
                            <div class="download_label"><?php echo $this->lang->line('section_credit_list'); ?></div>
                            
                            <table class="table table-striped table-bordered table-hover example">
                                
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('admission_no'); ?></th>
                                        <th><?php echo $this->lang->line('student_name'); ?></th>
                                        <th><?php echo $this->lang->line('mobile_number'); ?></th>
                                        <th>Điểm thường xuyên</th>
                                        <th>Điểm giữa kỳ</th>
                                        <th>Số tiết nghỉ</th>
                                        <th>Điểm chuyên cần</th>
                                        <?php
                                            if ($this->rbac->hasPrivilege('credit', 'can_edit') && $this->rbac->hasPrivilege('credit', 'can_delete')) {
                                        ?>
                                        <th class="text-right noExport "><?php echo $this->lang->line('action'); ?></th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>                                   

                                    <?php
                                    if ($studentcredits) {
                                        $count = 1;
                                        foreach ($studentcredits as $student) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $student['admission_no']; ?>
                                                </td>
                                                <td class="mailbox-name">
                                                    <a href="<?php echo base_url(); ?>student/view/<?php echo $student['id'] ?>"><?php echo $student['firstname'] ?></a>
                                                </td>
                                                <td>
                                                    <?=$student['mobileno'];?>
                                                </td>
                                                <td class="mailbox-name"></td>
                                                <td class="mailbox-name"></td>
                                                <td class="mailbox-name"></td>
                                                <td class="mailbox-name"></td>
                                                <?php
                                                    if ($this->rbac->hasPrivilege('credit', 'can_edit') && $this->rbac->hasPrivilege('credit', 'can_delete')) {
                                                ?>
                                                <td class="mailbox-date pull-right ">
                                                    <?php
                                                    if ($this->rbac->hasPrivilege('credit', 'can_edit')) {
                                                        ?>
                                                        <a style="display:none" href="<?php echo base_url(); ?>credits/edit/<?php echo $sectionCredit->id ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <?php
                                                    }
                                                    if ($this->rbac->hasPrivilege('credit', 'can_delete')) {
                                                        ?>
                                                        <a href="<?php echo base_url(); ?>credits/deleteStudent/<?=$credit['id'] ?>/<?=$student['id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line("section_will_also_delete_all_students_under_this_section_so_be_careful_as_this_action_is_irreversible"); ?>');">
                                                            <i class="fa fa-remove"></i>
                                                        </a>
                                                    <?php } ?>
                                                </td>
                                                <?php } ?>
                                            </tr>
                                            <?php
                                        }
                                        $count++;
                                    }
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
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        $('#students').select2();
    });
</script>