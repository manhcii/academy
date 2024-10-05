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
            if ($this->rbac->hasPrivilege('credit', 'can_add')) {
                ?>
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $this->lang->line('add_section_credit'); ?></h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div> 
                    <form action="<?php echo site_url('credits/index') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php 
                                    echo $this->session->flashdata('msg');
                                    $this->session->unset_userdata('msg');
                                ?>
                            <?php } ?>  
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('section_credit_name'); ?> </label><small class="req"> *</small>
                                <input autofocus="" id="section_credit_name" name="section_credit_name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('section_credit_name'); ?>" />
                                <span class="text-danger"><?php echo form_error('section'); ?></span>
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mã lớp </label><small class="req"> *</small>
                                <input autofocus="" id="section_credit_code" name="section_credit_code" placeholder="" type="text" class="form-control"  value="<?php echo set_value('section_credit_code'); ?>" />
                                <span class="text-danger"><?php echo form_error('section_credit_code'); ?></span>
                            </div>
                            
        
                            <div class="form-group">
                                <div><label for="exampleInputEmail1">Học phần</label><small class="req"> *</small></div>
        
        
                                <div>
                                    <?php
                                    foreach ($subjectlist as $subject) {
                                        ?>
                                        <div class="checkbox">
                                            <label>
                                                <input type="radio" name="section_credits[]" value="<?php echo $subject['id'] ?>" <?php echo set_checkbox('section_credits[]', $subject['id']); ?> ><?php echo $subject['name']?>
                                            </label>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
        
                                <span class="text-danger"><?php echo form_error('subjects[]'); ?></span>
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
                        <div><h3 class="box-title titlefix"><?php echo $this->lang->line('section_credit_list'); ?></h3></div>
                        <!--<div class="col-12">-->
                        <!--    <div class="col-sm-12 mx-3">-->
                        <!--        <div class="form-group">-->
                        <!--            <select autofocus="" id="class_id" name="class_id" class="form-control" autocomplete="off">-->
                        <!--                <option value=""><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Chuyên ngành đào tạo</font></font></option>-->
                        <!--                                                          <option value="1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Lớp 1</font></font></option>-->
                        <!--                                                                                                  <option value="2"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Lớp 2</font></font></option>-->
                        <!--                                                                                                  <option value="3"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Lớp 3</font></font></option>-->
                        <!--                                                                                                  <option value="4"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Lớp 4</font></font></option>-->
                        <!--                                                                                                  <option value="5"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Lớp 5</font></font></option>-->
                        <!--                                                                                                  <option value="6"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">lớp 6</font></font></option>-->
                        <!--                                                                                                  <option value="7"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">lớp 6</font></font></option>-->
                        <!--                                                                                                  <option value="8"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">7</font></font></option>-->
                        <!--                                                                                                                                            </select>-->
                        <!--             <span class="text-danger" id="error_class_id"></span>-->
                        <!--        </div>-->
                        <!--         <button type="submit" class="btn btn-primary btn-sm pull-right" name="class_search" data-loading-text="Please wait.." value="class_search" autocomplete="off"><i class="fa fa-search"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Tìm kiếm</font></font></font></font></button>-->
                        <!--    </div>-->
                        <!--</div>-->
                    </div>
                    
                    <div class="box-body ">
                        <div class="table-responsive mailbox-messages overflow-visible">
                            
                            <div class="download_label"><?php echo $this->lang->line('section_credit_list'); ?></div>
                            
                            <table class="table table-striped table-bordered table-hover example">
                                
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('section_credit'); ?></th>
                                        <th>Mã lớp học phần</th>
                                        <th>Học phần</th>
                                        <?php
                                            if ($this->rbac->hasPrivilege('credit', 'can_edit') && $this->rbac->hasPrivilege('credit', 'can_delete')) {
                                        ?>
                                        <th class="text-right noExport "><?php echo $this->lang->line('action'); ?></th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>                                  
                                    <?php
                                    $count = 1;
                                    foreach ($sectionCreditList as $sectionCredit) {
                                        ?>
                                        <tr>
                                            <td class="mailbox-name">
                                                <a href="<?php echo base_url(); ?>credits/view/<?php echo $sectionCredit->id ?>"><?php echo $sectionCredit->section_credit_name ?></a>
                                            </td>
                                            <td>
                                                <?php echo $sectionCredit->section_credit_code; ?>
                                            </td>
                                            <td>
                                                <?php
                                                    $vehicles = $sectionCredit->vehicles;
                                                    if (!empty($vehicles)) {
                                                        foreach ($vehicles as $key => $value) {
                                                            echo "<div>" . $value->name . "</div>";
                                                        }
                                                    }
                                                ?>
                                            </td>
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
                                                    <a href="<?php echo base_url(); ?>credits/delete/<?php echo $sectionCredit->id ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line("section_will_also_delete_all_students_under_this_section_so_be_careful_as_this_action_is_irreversible"); ?>');">
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