<div class="content-wrapper">   
    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('academics'); ?> <small><?php echo $this->lang->line('student_fees1'); ?></small>        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php
            if ($this->rbac->hasPrivilege('section', 'can_add') || $this->rbac->hasPrivilege('section', 'can_edit')) {
                ?>
                <div class="col-md-4">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('edit_section'); ?></h3>
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
                                <input type="hidden" name="pre_section_id" value="<?php echo $vehroute[0]->id; ?>" >
                                <?php
                                foreach ($vehroute[0]->vehicles as $v_key => $v_value) {
                                    ?>
                                    <input type="hidden" name="prev_classes[]" value="<?php echo $v_value->id; ?>">
                                    <?php
                                }
                                ?>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label><small class="req"> *</small>
                                    <input autofocus="" id="section" name="section" placeholder="" type="text" class="form-control"  value="<?php echo set_value('section', $section['section']); ?>" />
                                    <span class="text-danger"><?php echo form_error('section'); ?></span>
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mã lớp </label><small class="req"> *</small>
                                    <input autofocus="" id="section_code" name="section_code" placeholder="" type="text" class="form-control"  value="<?php echo set_value('section_code',$section['section_code']); ?>" />
                                    <span class="text-danger"><?php echo form_error('section_code'); ?></span>
                                </div>
                                
                                <div class="form-group">
                                    <div><label for="exampleInputEmail1">Chuyên ngành đào tạo</label><small class="req"> *</small></div>
            
            
                                    <div>
                                        <?php
                                        foreach ($classlist as $class) {
                                            ?>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="radio" name="classes[]" value="<?php echo $class['id'] ?>" <?php echo set_checkbox('classes[]', $class['id'],check_in_array($class['id'], $vehroute[0]->vehicles)); ?> ><?php echo $class['class'] ?>
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
            <?php } ?>
            <div class="col-md-<?php
            if ($this->rbac->hasPrivilege('section', 'can_add') || $this->rbac->hasPrivilege('section', 'can_edit')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">             
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('section_list'); ?></h3>
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
                                        <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>                                   

                                    <?php
                                    $count = 1;
                                    foreach ($sectionlist as $section) {
                                        ?>
                                        <tr>
                                            <td class="mailbox-name"> <?php echo $section->section ?></td>
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
                                            <td class="mailbox-date pull-right">
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
<?php

function check_in_array($find, $array) {

    foreach ($array as $element) {
        if ($find == $element->id) {
            return TRUE;
        }
    }
    return FALSE;
}
?>