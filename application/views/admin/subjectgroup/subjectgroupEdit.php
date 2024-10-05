<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php
            if ($this->rbac->hasPrivilege('subject_group', 'can_add')) {
            ?>
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('edit_subject_group'); ?></h3>
                        </div><!-- /.box-header -->
                        <form id="form1" action="<?php echo site_url('admin/subjectgroup/edit/' . $subjectgroup->id) ?>" id="employeeform" name="employeeform" method="post" accept-charset="utf-8">

                            <div class="box-body">
                                <?php if ($this->session->flashdata('msg')) {
                                ?>
                                    <?php echo $this->session->flashdata('msg');
                                    $this->session->unset_userdata('msg'); ?>
                                <?php } ?>
                                <?php
                                if (isset($error_message)) {
                                    echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                                }
                                ?>
                                <?php echo $this->customlib->getCSRF(); ?>
                                <input type="hidden" value="<?php echo set_value('id', $subjectgroup->id); ?>" name="id">

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('class'); ?> </label><small class="req"> *</small>
                                        <select id="class_id" name="class_id" class="form-control">
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php
                                            foreach ($classlist as $class) {
                                            ?>
                                                <option value="<?php echo $class['id'] ?>" <?php
                                                                                            if (set_value('class_id', $class_id) == $class['id']) {
                                                                                                echo "selected=selected";
                                                                                            }
                                                                                            ?>>
                                                    <?php echo $class['class'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">Bậc đào tạo </label><small class="req"> *</small>
                                        <select id="training_system" name="training_system" class="form-control">
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <option <?php if($subjectgroup->training_system == 'University'){echo 'selected';} ?> value="University">Đại học</option>
                                            <option <?php if($subjectgroup->training_system == 'College'){echo 'selected';} ?> value="College">Cao đẳng chính quy</option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('training_system'); ?></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('subject') ?></label><small class="req"> *</small>
                                    <table class="table table-striped table-bordered">
                                      <thead>
                                        <tr>
                                          <th scope="col">STT</th>
                                          <th scope="col"><?php echo $this->lang->line('subject') ?><small class="req"> *</small>
                                          </th>
                                          <th scope="col">Số tín chỉ<small class="req"> *</small></th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                    <?php
                                    $i=1;foreach ($subjectlist as $subject) {
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $i; ?></th>
                                            <td>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="subject[]" value="<?php echo $subject['id'] ?>" <?php echo set_checkbox('subject[]', $subject['id'], getSelectedSubjects($subjectgroup, $subject['id']) ? true : false); ?>><?php echo $subject['name'] ?>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <input class="form-control" name="credit[]" 
                                                <?php 
                                                    if(!set_checkbox('subject[]', $subject['id'], getSelectedSubjects($subjectgroup, $subject['id']) ? true : false))
                                                    {
                                                        echo 'disabled';
                                                    }
                                                ?>
                                                required value="<?php echo getCreditSubjects($subjectgroup, $subject['id']) ?>" type="number">
                                            </td>
                                        </tr>
                                        <?php
                                        $i++;}
                                        ?>
                                      </tbody>
                                    </table>
                                    <span class="text-danger"><?php echo form_error('subject[]'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mục tiêu đào tạo</label>
                                    <textarea class="form-control ckeditor" id="description" name="description" placeholder="" rows="3" placeholder="Enter ..."><?php echo set_value('description', $subjectgroup->description); ?></textarea>
                                    <span class="text-danger"></span>
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
        </div>
        <div class="row">
            <!-- left column -->
            <!-- right column -->
            <div class="col-md-12">
            </div><!--/.col (right) -->
        </div> <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php
    function getSelectedSubjects($subjectgroup, $find)
    {
        if (isset($_POST['subject'])) {
            if (!empty($_POST['subject'])) {
                foreach ($_POST['subject'] as $selected_subject_key => $selected_subject_value) {
                    if ($selected_subject_value == $find) {
                        return true;
                    }
                }
                return false;
            }
        } else {
            foreach ($subjectgroup->group_subject as $subjetct_key => $subjetct_value) {
    
                if ($subjetct_value->subject_id == $find) {
                    return true;
                }
            }
        }
    
        return false;
    }
    function getCreditSubjects($subjectgroup, $find)
    {
        foreach ($subjectgroup->group_subject as $subjetct_key => $subjetct_value) {
            if ($subjetct_value->subject_id == $find) {
                return $subjetct_value->credit;
            }
        }
    }
?>
<script src="<?php echo base_url(); ?>backend/plugins/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>backend/js/ckeditor_config.js"></script>
<script>
    CKEDITOR.replaceAll('ckeditor');
    $('input[type="checkbox"]').change(function(){
        if($(this).is(':checked'))
        {
            $(this).parents('tr').find('input[type="number"]').prop('disabled', false);
        }
        else
        {
            $(this).parents('tr').find('input[type="number"]').prop('disabled', true);
        }
    })
    var post_section_array = <?php echo json_encode($section_array); ?>;
    $(document).ready(function() {
        var post_class_id = '<?php echo set_value('class_id', $class_id) ?>';
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
        });
    });

    $(".no_print").css("display", "block");
    document.getElementById("print").style.display = "block";
    document.getElementById("btnExport").style.display = "block";

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

    function fnExcelReport() {
        var tab_text = "<table border='2px'><tr >";
        var textRange;
        var j = 0;
        tab = document.getElementById('headerTable'); // id of table

        for (j = 0; j < tab.rows.length; j++) {
            tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
        }

        tab_text = tab_text + "</table>";
        tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
        tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // remove if u want images in your table
        tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

        var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE ");

        if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) // If Internet Explorer
        {
            txtArea1.document.open("txt/html", "replace");
            txtArea1.document.write(tab_text);
            txtArea1.document.close();
            txtArea1.focus();
            sa = txtArea1.document.execCommand("SaveAs", true, "Say Thanks to Sumit.xls");
        } else //other browser not tested on IE 11
            sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));

        return (sa);
    }
</script>