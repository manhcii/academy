<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary" id="subject_list">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">Chương trình đào tạo</h3>
                        <?php
                            if ($this->rbac->hasPrivilege('subject_group', 'can_add')) {
                        ?>
                        <div class="box-tools pull-right">
                            <a href="<?php echo base_url() ?>/admin/subjectgroup/add" class="btn btn-sm btn-primary miusttop5"><i class="fa fa-plus"></i> Thêm chương trình đào tạo</a>
                        </div><!-- /.box-tools -->
                        <?php }?>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?php if ($this->session->flashdata('msg')) {?>
                            <?php echo $this->session->flashdata('msg');
                            $this->session->unset_userdata('msg'); ?>
                        <?php } ?>
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label"><?php echo $this->lang->line('subject_group_list'); ?></div>

                            <a class="btn btn-default btn-xs pull-right" title="<?php echo $this->lang->line('print'); ?>" id="print" onclick="printDiv()"><i class="fa fa-print"></i></a>
                            <a class="btn btn-default btn-xs pull-right" title="<?php echo $this->lang->line('export'); ?>" id="btnExport" onclick="fnExcelReport();"> <i class="fa fa-file-excel-o"></i> </a>

                            <table class="table table-striped table-bordered table-hover dataTable " id="headerTable">
                                <thead>
                                    <tr>
                                        <th class="text-left">Chuyên ngành đào tạo</th>
                                        <th>Mã ngành</th>
                                        <th>Bậc đào tạo</th>
                                        <th>Tổng số tín chỉ</th>
                                        <?php
                                            if ($this->rbac->hasPrivilege('subject_group', 'can_edit') && $this->rbac->hasPrivilege('subject_group', 'can_delete')) {
                                        ?>
                                        <th class="text-right no_print"><?php echo $this->lang->line('action'); ?></th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($subjectgroupList as $subjectgroup) {
                                    ?>
                                        <tr>
                                            <td class="text-left">
                                                <a href="<?php echo base_url() ?>admin/subjectgroup/view/<?php echo $subjectgroup->id; ?>" data-toggle="popover"><?php echo $subjectgroup->class;?></a>
                                            </td>
                                            <td>
                                                <?php 
                                                    echo $subjectgroup->class_code;
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo $this->lang->line($subjectgroup->training_system); ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    $credit = 0;
                                                    foreach ($subjectgroup->group_subject as $key => $value)
                                                    {
                                                        $credit += $value->credit;
                                                    }
                                                    echo $credit. ' tín chỉ' ;
                                                ?>
                                            </td>
                                            <?php
                                                if ($this->rbac->hasPrivilege('subject_group', 'can_edit') && $this->rbac->hasPrivilege('subject_group', 'can_delete')) {
                                            ?>
                                            <td class="mailbox-date pull-right no_print">
                                                <?php
                                                if ($this->rbac->hasPrivilege('subject_group', 'can_edit')) {
                                                ?>
                                                    <a href="<?php echo base_url(); ?>admin/subjectgroup/edit/<?php echo $subjectgroup->id; ?>" class="btn btn-default btn-xs no_print displayinline" data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                <?php } ?>
                                                <?php
                                                if ($this->rbac->hasPrivilege('subject_group', 'can_delete')) {
                                                ?>
                                                    <a href="<?php echo base_url(); ?>admin/subjectgroup/delete/<?php echo $subjectgroup->id; ?>" class="btn btn-default btn-xs no_print displayinline" data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
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
        </div> <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
    var post_section_array = <?php echo json_encode($section_array); ?>;
    $(document).ready(function() {
        var post_class_id = '<?php echo set_value('class_id', 0) ?>';
        if (post_section_array !== null && post_section_array.length > 1) {

            $.each(post_section_array, function(i, elem) {

            });
        }

        getSectionByClass(post_class_id, 0);
        $('.detail_popover').popover({
            placement: 'right',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function() {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });

        $(document).on('change', '#class_id', function(e) {
            var class_id = $(this).val();
            getSectionByClass(class_id, 0);
        });
    });

    function getSectionByClass(class_id, section_array) {
        $('.section_checkbox').html('');
        if (class_id !== "" && class_id !== 0) {
            var div_data = "";
            $.ajax({
                type: "GET",
                url: base_url + "sections/getByClass",
                data: {
                    'class_id': class_id
                },
                dataType: "json",
                beforeSend: function() {

                },
                success: function(data) {
                    $.each(data, function(i, obj) {
                        console.log(post_section_array);
                        console.log();
                        var check = "";
                        if (jQuery.inArray(obj.id, post_section_array) !== -1) {
                            check = "checked";
                        }

                        div_data += "<div class='checkbox'>";
                        div_data += "<label>";
                        div_data += "<input type='checkbox' class='content_available' name='sections[]' value='" + obj.id + "' " + check + ">" + obj.section;

                        div_data += "</label>";
                        div_data += "</div>";

                    });
                    $('.section_checkbox').html(div_data);
                },
                error: function(xhr) { // if error occured
                    alert("<?php echo $this->lang->line('error_occurred_please_try_again'); ?>");

                },
                complete: function() {

                }
            });
        }
    }

    $(".no_print").css("display", "revert");
    document.getElementById("print").style.display = "revert";
    document.getElementById("btnExport").style.display = "revert";

    function printDiv() {
        $(".no_print").css("display", "none");
        document.getElementById("print").style.display = "none";
        document.getElementById("btnExport").style.display = "none";
        var divElements = document.getElementById('subject_list').innerHTML;
        var oldPage = document.body.innerHTML;
        document.body.innerHTML =
            "<html><head><title></title></head><body>" +
            divElements + "</body>";
        window.print();
        document.body.innerHTML = oldPage;
        location.reload(true);
    }
</script>