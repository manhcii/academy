<?php 
    $side_list = side_menu_list(1);
?>
<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('academics'); ?>     </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php
            if ($this->rbac->hasPrivilege('class', 'can_add')) {
                ?>  
                <div class="col-md-4">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('add_class'); ?></h3>
                        </div><!-- /.box-header -->
                        <form id="form1" action="<?php echo site_url('classes'); ?>" method="post" accept-charset="utf-8">
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
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
                                    <input autofocus="" id="class" name="class" placeholder="" type="text" class="form-control"  value="<?php echo set_value('class'); ?>" />
                                    <span class="text-danger"><?php echo form_error('class'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('class_code'); ?></label><small class="req"> *</small>
                                    <input autofocus="" id="class_code" name="class_code" placeholder="" type="text" class="form-control"  value="<?php echo set_value('class_code'); ?>" />
                                    <span class="text-danger"><?php echo form_error('class_code'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Đơn giá (/tín chỉ)</label><small class="req"> *</small>
                                    <input autofocus="" id="unit_price" name="unit_price" placeholder="" type="text" class="form-control"  value="<?php echo set_value('unit_price'); ?>" />
                                    <span class="text-danger"><?php echo form_error('unit_price'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('training_system'); ?></label><small class="req"> *</small>
                                    <select id="training_system" name="training_system" class="form-control">
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                            if (!empty($trainingsystem)) {
                                                foreach ($trainingsystem as $item) { ?>
                                                    <option value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option> 
                                                <?php }
                                            }
                                        ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('training_system'); ?></span>
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
            if ($this->rbac->hasPrivilege('class', 'can_add')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">Danh sách chuyên ngành</h3>
                        <div class="box-tools pull-right">
                            <form role="form" action="<?php echo site_url('classes') ?>" id="classes_search" method="get" class="class_search_form d-flex">
                                <select onchange="submitform('classes_search')" id="training_system" name="training_system_id" class="form-control">
                                    <option disabled selected value="">Hệ đào tạo</option>
                                    <?php
                                        if (!empty($trainingsystem)) {
                                            foreach ($trainingsystem as $item) { ?>
                                                <option <?= (isset($_GET['training_system_id']) && $_GET['training_system_id'] == $item['id']) ? 'selected' : ''  ?> value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option> 
                                            <?php }
                                        }
                                    ?>
                                </select>
                            </form>
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages overflow-visible">
                            <div class="download_label"><?php echo $this->lang->line('class_list'); ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>

                                        <th><?php echo $this->lang->line('class'); ?>
                                        </th>
                                        <th>Mã ngành</th>
                                        <th>Đơn giá (/tín chỉ)</th>
                                        <th><?php echo $this->lang->line('training_system'); ?></th>
                                        <?php
                                            if ($this->rbac->hasPrivilege('class', 'can_edit') && $this->rbac->hasPrivilege('class', 'can_delete')) {
                                        ?> 
                                        <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($vehroutelist as $vehroute) {
                                        ?>
                                        <tr>
                                            <td class="mailbox-name">
                                                <?php echo $vehroute->class; ?>

                                            </td>
                                            <td><?php echo $vehroute->class_code; ?></td>
                                            <td>
                                                <?php echo amountFormat($vehroute->unit_price).' '.$currency_symbol; ?>
                                            </td>
                                            <td>
                                                <?php
                                                    if (!empty($trainingsystem)) {
                                                        foreach ($trainingsystem as $item) {
                                                            if ($item['id'] == $vehroute->training_system_id) {
                                                                echo($item['name']);
                                                            }
                                                        }
                                                    }
                                                ?>
                                            </td>
                                            <?php
                                                if ($this->rbac->hasPrivilege('class', 'can_edit') && $this->rbac->hasPrivilege('class', 'can_delete')) {
                                            ?> 
                                            <td class="mailbox-date pull-right">
                                                <?php
                                                if ($this->rbac->hasPrivilege('class', 'can_edit')) {
                                                    ?>  
                                                    <a href="<?php echo base_url(); ?>classes/edit/<?php echo $vehroute->id; ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <?php
                                                }
                                                if ($this->rbac->hasPrivilege('class', 'can_delete')) {
                                                    ?>  
                                                    <a href="<?php echo base_url(); ?>classes/delete/<?php echo $vehroute->id; ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('deleting_class'); ?>');">
                                                        <i class="fa fa-remove"></i>
                                                    </a>
                                                <?php } ?>
                                            </td>
                                            <?php } ?>
                                        </tr>
                                        <?php
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
