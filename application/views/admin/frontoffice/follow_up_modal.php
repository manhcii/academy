<div class="modal-header modal-media-header d-flex justify-content-between align-items-center">
    <button type="button" class="close" onclick="update()" data-dismiss="modal">&times;</button>
    <h4 class="box-title"><?php echo $this->lang->line('follow_up_admission_enquiry'); ?></h4>
    <?php if( $enquiry_data['status'] == 'won'): ?>
    <button type="button" class="btn btn-info pull-right" onclick="changeApproved('<?php echo $enquiry_data['id'] ?>')" data-loading-text="<i class='fa fa-spinner fa-spin '></i> <?php echo $this->lang->line('please_wait'); ?>">Xét duyệt hồ sơ</button>
    <?php elseif($enquiry_data['status'] == 'active'): ?>
    <button type="button" class="btn btn-info pull-right" onclick="changeWon('<?php echo $enquiry_data['id'] ?>')" data-loading-text="<i class='fa fa-spinner fa-spin '></i> <?php echo $this->lang->line('please_wait'); ?>">Hoàn thiện hồ sơ</button>
    <?php endif ?>
    <?php if($enquiry_data['status'] == 'profile_approved'): ?>
    <button type="button" class="btn btn-success pull-right">Đã duyệt hồ sơ</button>
    <?php endif ?>
</div>
<div class="row row-eq">
    <div class="col-lg-8 col-md-8 col-sm-8 paddlr">
        <!-- general form elements -->
        <div class="bozero">
            <h4 class="pagetitleh2">Điểm xét tuyển</h4>
            <div>
                <table class="table table-subject">
                    <tbody>
                        <tr>
                            <th style="width: 10px">STT</th>
                            <th>Môn Xét Tuyển</th>
                            <th>Điểm</th>
                        </tr>
                        <?php 
                        
                            if($enquiry_data['subject_arr']):
                                $average_score = json_decode($enquiry_data['subject_arr']);
                        ?>
                        <?php $j=1;$i=0;foreach($average_score as $value): ?>
                        <tr class="tr-subject">
                            <td class="text-center"><?= $j; ?>.</td>
                            <td>
                                <?= $value[0] ?>
                            </td>
                            <td>
                                <?= $value[1] ?>
                            </td>
                        </tr>
                        <?php $j++;$i++;endforeach;endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" class="text-right">Điểm TB xét tuyển</td>
                            <td>
                                 &nbsp;&nbsp;&nbsp;&nbsp;<span class="average_score"><?= $enquiry_data['average_score'] ?></span>
                                <input type="hidden" value="<?= $enquiry_data['average_score'] ?>" name="average_score">
                            </td>
                        </tr>
                    </tfoot>
                </table>
                
            </div>
        </div>
        
        <div class="bozero">
            <h4 class="pagetitleh2">Tài liệu</h4>
            <div>
                <table class="table table-doc">
                    <tbody>
                        <?php if($enquiry_doc): ?>
                        <tr>
                            <th style="width: 20px">#</th>
                            <th>Tên File</th>
                            <th><?php echo $this->lang->line('documents'); ?></th>
                        </tr>
                        
                        <?php $i=1;foreach($enquiry_doc as $value): ?>
                        <tr class="tr-doc">
                            <td><?= $i ?>.</td>
                            <td><?= $value['title'] ?></td>
                            <td>
                                <a href="<?php echo site_url('student/download/' . $value['enquiry_id'] . "/" . $value['id']); ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line('download'); ?>">
                                    <i class="fa fa-download"></i> Tải xuống
                                </a>
                            </td>
                        </tr>
                        <?php $i++;endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center">Chưa có tài liệu nào.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <form id="folow_up_data" method="post" class="ptt10">
            <div class="row">
                <div class="col-lg-12 col-md-6 col-sm-12">
                    <div class="form-group">
                        
                        <label for="exampleInputEmail1"><?php echo $this->lang->line('follow_up_date'); ?></label><small class="req"> *</small>
                        <input type="hidden" id="enquiry_id" name="enquiry_id" value="<?php echo $enquiry_data['id'] ?>">
                        <input type="hidden" id="enquiry_status" name="enquiry_status" value="<?php echo $enquiry_data['status'] ?>">
                        <input type="hidden" id="created_by" name="created_by" value="<?php echo $enquiry_data['created_by'] ?>">
                        <input type="text" id="follow_date" name="date" class="form-control date" value="<?php echo set_value('follow_up_date', date($this->customlib->getSchoolDateFormat())); ?>">
                        <span class="text-danger" id="date_error"></span>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <label for="pwd"><?php echo $this->lang->line('response'); ?></label><small class="req"> *</small>
                        <textarea name="response" id="response" class="form-control" ><?php echo set_value('response'); ?></textarea>
                        <span class="text-danger" id="responce_error"></span>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <label for="pwd"><?php echo $this->lang->line('note'); ?></label>
                        <textarea name="note" id="note" class="form-control" ><?php echo set_value('note'); ?></textarea>
                    </div>
                </div>
            </div><!-- /.box-body -->
            <div class="box-footer pr0">
                <?php
if ($this->rbac->hasPrivilege('follow_up_admission_enquiry', 'can_add')) {
    ?>
                   <button type="submit" class="btn btn-info pull-right" id="submit" data-loading-text="<i class='fa fa-spinner fa-spin '></i> <?php echo $this->lang->line('please_wait'); ?>"><?php echo $this->lang->line('save') ?></button>
                    <?php
}
?>

            </div>
        </form>
        <div class="ptbnull">
            <div class="box-tools pull-right">
            </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="pt20">
            <div class="tab-pane active" id="timeline">
                <!-- The timeline -->
            </div>
        </div><!-- /.box-body -->
    </div><!--/.col (left) -->
    <div class="col-lg-4 col-md-4 col-sm-4 col-eq">
        <div class="taskside">
            <!-- /.box-tools -->
            <h5 class="pt0 task-info-created">
                <span class="text-dark"> <b><?php echo $this->lang->line('assigned'); ?></b>:
                <span class="text-dark"><?php if (!empty($assigned_staff)) {echo $assigned_staff['name'] . ' ' . $assigned_staff['surname'];?> <?php if ($assigned_staff['employee_id'] != '') {echo ' (' . $assigned_staff['employee_id'] . ')';}}?></span>
                </span>
            </h5>
            <hr class="taskseparator" />
            <div class="task-info task-single-inline-wrap ptt10">
                <h4 class="box-title titlefix pb5">Học viên (<?php print_r($enquiry_data['name']);?>)</h4>
                <h5><span class="text-dark"><?php echo $this->lang->line('enquiry_date'); ?>:</span> <?php print_r(date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($enquiry_data['date'])));?></h5>
                <h5><span class="text-dark"><?php echo $this->lang->line('phone'); ?>:</span> <?php echo $enquiry_data['contact']; ?></h5>
                <h5><span class="text-dark"><?php echo $this->lang->line('reference'); ?>:</span> <?php echo $enquiry_data['reference']; ?></h5>
                <h5><span class="text-dark"><?php echo $this->lang->line('source'); ?>:</span> <?php echo $enquiry_data['source']; ?></h5>
                <h5><span class="text-dark"><?php echo $this->lang->line('email'); ?>:</span> <?php echo $enquiry_data['email']; ?></h5>
                <h5><span class="text-dark"><?php echo $this->lang->line('address'); ?>:</span> <?php echo $enquiry_data['address']; ?></h5>
                <h5><span class="text-dark"><?php echo $this->lang->line('class'); ?>:</span> <?php echo $enquiry_data['classname']; ?></h5>
                <h5><span class="text-dark"><?php echo $this->lang->line('description'); ?>:</span> <?php echo $enquiry_data['description']; ?></h5>
                <h5><span class="text-dark"><?php echo $this->lang->line('note'); ?>:</span> <?php echo $enquiry_data['note']; ?></h5>
                <h5><span class="text-dark"><?php echo $this->lang->line('created_by'); ?>:</span>

                <?php if ($staff_role == 7) {?>

                    <?php echo $created_by['name'] . ' ' . $created_by['surname']; ?> <?php if ($created_by['employee_id'] != '') {echo ' (' . $created_by['employee_id'] . ')';}?>

                <?php } elseif ($staff_role != 7) {?>
                    <?php if ($superadmin_rest == 'enabled') {?>
                        <?php echo $created_by['name'] . ' ' . $created_by['surname']; ?> <?php if ($created_by['employee_id'] != '') {echo ' (' . $created_by['employee_id'] . ')';}?>
                    <?php } elseif ($login_staff_id == $created_by['id']) {?>
                        <?php echo $created_by['name'] . ' ' . $created_by['surname']; ?> <?php if ($created_by['employee_id'] != '') {echo ' (' . $created_by['employee_id'] . ')';}?>
                    <?php }?>
                <?php }?>
                </h5>
            </div>
        </div>
    </div>
</div>
<script>

    $("#folow_up_data").on('submit', (function (e) {
        e.preventDefault();
        var $this = $(this).find("button[type=submit]:focus");
        var id = $('#enquiry_id').val();
        var status = $('#enquiry_status').val();
        var responce = $('#response').val();
        var follow_date = $('#follow_date').val();
        var created_by = $('#created_by').val();

        $.ajax({
            url: "<?php echo site_url("admin/enquiry/follow_up_insert/") ?>",
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $this.button('loading');
            },
            success: function (res)
            {
                if (res.status == "fail") {
                    var message = "";
                    $.each(res.error, function (index, value) {
                        message += value;
                    });
                    errorMsg(message);
                } else {
                    successMsg(res.message);
                    follow_up_new(id, status, created_by);
                }
            },
            error: function (xhr) { // if error occured
                alert("<?php echo $this->lang->line('error_occurred_please_try_again'); ?>");
                $this.button('reset');
            },
            complete: function () {
                $this.button('reset');
            }
        });
    }));

    function follow_up_new(id, status, created_by) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/enquiry/follow_up/' + id + '/' + status+ '/' + created_by,
            success: function (data) {
                $('#getdetails_follow_up').html(data);
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/enquiry/follow_up_list/' + id,
                    success: function (data) {
                        $('#timeline').html(data);
                    },
                    error: function () {
                        alert("<?php echo $this->lang->line('fail'); ?>");
                    }
                });
            },
            error: function () {
                alert("<?php echo $this->lang->line('fail'); ?>");
            }
        });
    }

    function changeStatus(status, id, created_by) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/enquiry/change_status/',
            type: 'POST',
            dataType: 'json',
            data: {status: status, id: id},
            success: function (data) {
                if (data.status == "fail") {
                    errorMsg(data.message);
                } else {
                    successMsg(data.message);
                    follow_up_new(id, status, created_by);
                }
            }
        })
    }
    function changeApproved(id) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/enquiry/profile_approved/',
            type: 'POST',
            dataType: 'json',
            data: {id: id},
            success: function (data) {
                if (data.status == "fail") {
                    errorMsg(data.message);
                } else {
                    successMsg(data.message);
                    location.reload();
                }
            }
        })
    }
    function changeWon(id) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/enquiry/profile_won/',
            type: 'POST',
            dataType: 'json',
            data: {id: id},
            success: function (data) {
                if (data.status == "fail") {
                    errorMsg(data.message);
                } else {
                    successMsg(data.message);
                    location.reload();
                }
            }
        })
    }
</script>