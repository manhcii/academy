<style type="text/css">
    @media print
    {
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
</style>
<div class="content-wrapper" style="min-height: 946px;">  
    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('academics'); ?></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php
            if ($this->rbac->hasPrivilege('subject', 'can_add')) {
                ?>        
                <div class="col-md-4">          
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('add_subject'); ?></h3>
                        </div>
                        <form id="form1" action="<?php echo site_url('admin/subject') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                            <div class="box-body">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg');
                                    $this->session->unset_userdata('msg'); ?>
                                <?php } ?>     
                                <?php echo $this->customlib->getCSRF(); ?>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('subject_name'); ?></label><small class="req"> *</small>
                                    <input autofocus="" id="category" name="name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('name'); ?>" />
                                    <span class="text-danger"><?php echo form_error('name'); ?></span>
                                </div>
                                <?php
                                foreach ($subject_types as $subject_type_key => $subject_type_value) {
                                    ?>

                                    <label class="radio-inline">
                                        <input type="radio" value="<?php echo $subject_type_key ?>" name="type" <?php echo set_radio('type', $subject_type_key, set_value('type')); ?> ><?php echo $subject_type_value; ?> 
                                    </label>
                                    <?php
                                }
                                ?>
                                <span class="text-danger"><?php echo form_error('type'); ?></span>

                                <div class="form-group"><br>
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('subject_code'); ?></label><small class="req"> *</small>
                                    <input id="category" name="code" placeholder="" type="text" class="form-control"  value="<?php echo set_value('code'); ?>" />
                                    <span class="text-danger"><?php echo form_error('code'); ?></span>
                                </div>
                                
                                <div class="form-group"><br>
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('course_credits'); ?></label><small class="req"> *</small>
                                    <input id="category" name="course_credits" placeholder="" type="number" class="form-control"  value="<?php echo set_value('course_credits'); ?>" />
                                    <span class="text-danger"><?php echo form_error('course_credits'); ?></span>
                                </div>
                                
                                <div class="form-group"><br>
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('lecture_hours'); ?></label>
                                    <input id="category" name="lecture_hours" placeholder="" type="number" class="form-control"  value="<?php echo set_value('lecture_hours'); ?>" />
                                    <span class="text-danger"><?php echo form_error('lecture_hours'); ?></span>
                                </div>
                                
                                <div class="form-group"><br>
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('lab_hours'); ?></label>
                                    <input id="category" name="lab_hours" placeholder="" type="number" class="form-control"  value="<?php echo set_value('lab_hours'); ?>" />
                                    <span class="text-danger"><?php echo form_error('lab_hours'); ?></span>
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('training_system'); ?></label><small class="req"> *</small>
                                    <select id="training_system" name="training_system_id" class="form-control">
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                            if (!empty($trainingsystem)) {
                                                foreach ($trainingsystem as $item) { ?>
                                                    <option value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option> 
                                                <?php }
                                            }
                                        ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('training_system_id'); ?></span>
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
                                    <select id="class" name="class" class="form-control">
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                            if (!empty($classes)) {
                                                foreach ($classes as $item) { ?>
                                                    <option value="<?php echo $item['id']; ?>"><?php echo $item['class']; ?></option> 
                                                <?php }
                                            }
                                        ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('class'); ?></span>
                                </div>
                                <div class="form-group" style="display: none">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('class_teacher'); ?></label><small class="req"> *</small>


                                    <?php
                                    foreach ($teacherlist as $tvalue) {
                                        ?>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="teachers[]" value="<?php echo $tvalue['id'] ?>" <?php echo set_checkbox('teachers[]', $tvalue['id']); ?> ><?php echo $tvalue['name'] . " " . $tvalue['surname'] . " (" . $tvalue['employee_id'] . ")"; ?>
                                            </label>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <span class="text-danger"><?php echo form_error('teachers[]'); ?></span>
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
            if ($this->rbac->hasPrivilege('subject', 'can_add')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">            
                <div class="box box-primary" id="sublist">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('subject_list'); ?></h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label"><?php echo $this->lang->line('subject_list'); ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('subject'); ?></th>
                                        <th><?php echo $this->lang->line('subject_code'); ?></th>
                                        <th><?php echo $this->lang->line('subject_type'); ?></th>
                                        <th><?php echo $this->lang->line('course_credits'); ?></th>
                                        <th><?php echo $this->lang->line('lecture_hours'); ?></th>
                                        <th><?php echo $this->lang->line('lab_hours'); ?></th>
                                        <th><?php echo $this->lang->line('training_system'); ?></th>
                                        <th><?php echo $this->lang->line('class'); ?></th>
                                        <?php
                                            if ($this->rbac->hasPrivilege('subject', 'can_edit') && $this->rbac->hasPrivilege('subject', 'can_delete')) {
                                        ?>
                                        <th class="text-right no-print noExport"><?php echo $this->lang->line('action'); ?></th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($subjectlist as $subject) {
                                        ?>
                                        <tr>
                                            <td class="mailbox-name"> <?php echo $subject['name'] ?></td>
                                            <td class="mailbox-name"><?php echo $subject['code'] ?></td>
                                            <td class="mailbox-name"><?php echo $this->lang->line($subject['type']) ?></td>
                                            <td class="mailbox-name"><?php echo $subject['course_credits'] ?></td>
                                            <td class="mailbox-name"><?php echo $subject['lecture_hours'] ?></td>
                                            <td class="mailbox-name"><?php echo $subject['lab_hours'] ?></td>
                                            <td class="mailbox-name"><?php
                                                foreach ($trainingsystem as $item) { if($item['id'] == $subject['training_system_id']) { echo $item['name']; }}
                                            ?></td>
                                            <td class="mailbox-name"><?php
                                                foreach ($classes as $item) { if($item['id'] == $subject['class']) { echo $item['class']; }}
                                            ?></td>
                                            <?php
                                                if ($this->rbac->hasPrivilege('subject', 'can_edit') && $this->rbac->hasPrivilege('subject', 'can_delete')) {
                                            ?>
                                            <td class="mailbox-date pull-right no-print">
                                                <?php
                                                if ($this->rbac->hasPrivilege('subject', 'can_edit')) {
                                                    ?>
                                                    <a href="<?php echo base_url(); ?>admin/subject/edit/<?php echo $subject['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <?php
                                                }
                                                if ($this->rbac->hasPrivilege('subject', 'can_delete')) {
                                                    ?>
                                                    <a href="<?php echo base_url(); ?>admin/subject/delete/<?php echo $subject['id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
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

<script type="text/javascript">
    $(document).ready(function () {
        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });
    });
</script>

<script type="text/javascript">
    var base_url = '<?php echo base_url() ?>';
    function printDiv(elem) {
        Popup(jQuery(elem).html());
    }

    function Popup(data)
    {
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({"position": "absolute", "top": "-1000000px"});
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html>');
        frameDoc.document.write('<head>');
        frameDoc.document.write('<title></title>');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/bootstrap/css/bootstrap.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/font-awesome.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/ionicons.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/AdminLTE.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/skins/_all-skins.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/iCheck/flat/blue.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/morris/morris.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/datepicker/datepicker3.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/daterangepicker/daterangepicker-bs3.css">');
        frameDoc.document.write('</head>');
        frameDoc.document.write('<body>');
        frameDoc.document.write(data);
        frameDoc.document.write('</body>');
        frameDoc.document.write('</html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);

        return true;
    }
</script>