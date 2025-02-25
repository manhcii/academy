<div class="content-wrapper">  
    <section class="content-header">
        <h1>
            <i class="fa fa-ioxhost"></i> <?php echo $this->lang->line('front_office'); ?></h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-2">
                <div class="box border0">
                    <ul class="tablists">
                        <li><a href="<?php echo site_url('admin/source') ?>" class="<?= $_SERVER["REQUEST_URI"] == '/admin/source' ? 'active' : ''?>"><?php echo $this->lang->line('source'); ?></a></li>
                        <li><a href="<?php echo site_url('admin/visitorspurpose') ?>" class="<?= $_SERVER["REQUEST_URI"] == '/admin/visitorspurpose' ? 'active' : ''?>">Khóa học</a></li>
                        <li><a href="<?php echo site_url('admin/complainttype') ?>" class="<?= $_SERVER["REQUEST_URI"] == '/admin/complainttype' ? 'active' : ''?>">Đợt tuyển sinh</a></li>
                        <li><a href="<?php echo site_url('admin/reference') ?>" class="<?= $_SERVER["REQUEST_URI"] == '/admin/reference' ? 'active' : ''?>"><?php echo $this->lang->line('reference'); ?></a></li>
                    </ul>
                </div>
            </div><!--./col-md-3-->
            <?php if ($this->rbac->hasPrivilege('setup_font_office', 'can_add') || $this->rbac->hasPrivilege('setup_font_office', 'can_edit')) { ?>
                <div class="col-md-4">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Chỉnh sửa khóa học</h3>
                        </div><!-- /.box-header -->
                        <form id="form1" action="<?php echo site_url('admin/visitorspurpose/edit/' . $visitors_purpose_data['id']) ?>"   method="post"  >
                            <div class="box-body">                          
                                <?php echo $this->session->flashdata('msg'); $this->session->unset_userdata('msg'); ?>
                                <div class="form-group">
                                    <label for="pwd">Khóa học</label> <small class="req"> *</small> 
                                    <input class="form-control" id="description" name="visitors_purpose" value="<?php echo set_value('visitors_purpose', $visitors_purpose_data['visitors_purpose']); ?>"/>
                                    <span class="text-danger"><?php echo form_error('visitors_purpose'); ?></span>
                                </div>  
                                <div class="form-group">
                                    <label for="pwd"><?php echo $this->lang->line('description'); ?></label>
                                    <textarea class="form-control" id="description" name="description"rows="3"><?php echo set_value('description', $visitors_purpose_data['description']); ?></textarea>
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
            if ($this->rbac->hasPrivilege('setup_font_office', 'can_add') || $this->rbac->hasPrivilege('setup_font_office', 'can_edit')) {
                echo "6";
            } else {
                echo "10";
            }
            ?>">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">Danh sách khóa học</h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="download_label">Danh sách khóa học</div>
                        <div class="mailbox-messages table-responsive overflow-visible">
                            <table class="table table-hover table-striped table-bordered example">
                                <thead>
                                    <tr>                                    
                                        <th>Khóa học</th>
                                        <th><?php echo $this->lang->line('description'); ?></th>
                                        <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (empty($visitors_purpose_list)) {
                                        ?>
                                        <?php
                                    } else {
                                        foreach ($visitors_purpose_list as $key => $value) {                                   
                                            ?>
                                            <tr>
                                                <td class="mailbox-name"><?php echo $value['visitors_purpose'] ?></td>
                                                <td class="mailbox-name"><?php echo $value['description']; ?></td>
                                                <td class="mailbox-date text-right">
                                                    <?php if ($this->rbac->hasPrivilege('setup_font_office', 'can_edit')) { ?>
                                                    <a href="<?php echo base_url(); ?>admin/visitorspurpose/edit/<?php echo $value['id']; ?>"  class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('edit'); ?>">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <?php } ?>
                                                    <?php if ($this->rbac->hasPrivilege('setup_font_office', 'can_delete')) { ?>
                                                    <a href="<?php echo base_url(); ?>admin/visitorspurpose/delete/<?php echo $value['id']; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');" data-original-title="<?php echo $this->lang->line('delete'); ?>">
                                                        <i class="fa fa-remove"></i>
                                                    </a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
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
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!-- new END -->
</div><!-- /.content-wrapper -->

<script>
    $(document).ready(function () {
        $('.detail_popover').popover({
            placement: 'right',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });
    });
</script>