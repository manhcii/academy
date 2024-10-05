<aside class="main-sidebar" id="alert2">
    <?php if ($this->rbac->hasPrivilege('student', 'can_view')) {?>
        <form class="navbar-form navbar-left search-form2" role="search"  action="<?php echo site_url('admin/admin/search'); ?>" method="POST">
            <?php echo $this->customlib->getCSRF(); ?>
            <div class="input-group ">
                <input type="text"  name="search_text" class="form-control search-form" placeholder="<?php echo $this->lang->line('search_by_student_name'); ?>">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" style="padding: 3px 12px !important;border-radius: 0px 30px 30px 0px; background: #fff;" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
    <?php }?>
    <?php echo activate_main_menu('front_office'); ?>
    <section class="sidebar" id="sibe-box">
        
        <?php  //$this->load->view('layout/top_sidemenu');?>
        <ul class="sidebar-menu verttop">
            <!-- //================== văn phòng tuyển sinh ======================= -->
            <?php 
                if (
                    $this->rbac->hasPrivilege('admission_enquiry', 'can_view')  ||
                    $this->rbac->hasPrivilege('visitor_book', 'can_view')       ||
                    $this->rbac->hasPrivilege('phon_call_log', 'can_view')      ||
                    $this->rbac->hasPrivilege('postal_dispatch', 'can_view')    ||
                    $this->rbac->hasPrivilege('postal_receive', 'can_view')     ||
                    $this->rbac->hasPrivilege('complaint', 'can_view')          ||
                    $this->rbac->hasPrivilege('setup_font_office', 'can_view')  ||
                    $this->rbac->hasPrivilege('subject', 'can_view') ||
                    $this->rbac->hasPrivilege('class', 'can_view')
                ):
            ?>
            <li class="treeview <?php echo activate_main_menu('front_office'); ?>">
                <a href="#">
                    <i class="fa fa-ioxhost ftlayer"></i> <span>Tuyển Sinh</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if ($this->rbac->hasPrivilege('admission_enquiry', 'can_view')):?>
                    <li class="<?php echo activate_submenu('enquiry', explode(',', 'index,create')); ?>"><a href="<?= base_url('admin/enquiry')?>"><i class="fa fa-angle-double-right"></i>Quản lý hồ sơ</a></li>
                    <?php endif; ?>
                    <li class="<?php echo activate_submenu('enquiry', explode(',', 'danh_sach_xet_tuyen')); ?>"><a href="<?= base_url('admin/enquiry/danh_sach_xet_tuyen')?>"><i class="fa fa-angle-double-right"></i>Hồ sơ xét tuyển theo đợt</a></li>
                    <li class="<?php echo activate_submenu('enquiry', explode(',', 'danh_sach_tuyen_sinh')); ?>"><a href="<?= base_url('admin/enquiry/danh_sach_tuyen_sinh')?>"><i class="fa fa-angle-double-right"></i>Danh sách tuyển sinh</a></li>
                    <li class="<?php echo activate_submenu('enquiry', explode(',', 'danh_sach_trung_tuyen')); ?>"><a href="<?= base_url('admin/enquiry/danh_sach_trung_tuyen')?>"><i class="fa fa-angle-double-right"></i>Danh sách trúng tuyển</a></li>
                    <li class="<?php echo activate_submenu('generalcall', explode(',', 'index,edit')); ?>"><a href="<?= base_url('admin/generalcall')?>"><i class="fa fa-angle-double-right"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Đối tác</font></font></a></li>
                    <?php if ($this->rbac->hasPrivilege('phone_call_log', 'can_view')):?>
                    <li class="<?php echo activate_submenu('generalcall', explode(',', 'index,edit')); ?>"><a href="<?= base_url('admin/generalcall')?>"><i class="fa fa-angle-double-right"></i>Nhật ký cuộc gọi điện thoại</a></li>
                    <?php endif; ?>
                    <!--<li><a href="<?= base_url('admin/bao_cao_tuyen_sinh')?>"><i class="fa fa-angle-double-right"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Báo cáo</font></font></a></li>-->
                    <?php if ($this->rbac->hasPrivilege('setup_font_office', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/source')?>"><i class="fa fa-angle-double-right"></i>Thiết lập</a></li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>
            
            <!-- //================== THÔNG TIN SV ======================= -->
            <?php 
                if (
                    $this->rbac->hasPrivilege('student', 'can_view')            ||
                    $this->rbac->hasPrivilege('student', 'can_add')             ||
                    $this->rbac->hasPrivilege('student_history', 'can_view')    ||
                    $this->rbac->hasPrivilege('student_categories', 'can_view') ||
                    $this->rbac->hasPrivilege('student_houses', 'can_view')     ||
                    $this->rbac->hasPrivilege('disable_student', 'can_view')    ||
                    $this->rbac->hasPrivilege('disable_reason', 'can_view')     ||
                    $this->rbac->hasPrivilege('online_admission', 'can_view')   ||
                    $this->rbac->hasPrivilege('multiclass_student', 'can_view') ||
                    $this->rbac->hasPrivilege('disable_reason', 'can_view')
                    
                ):
            ?>
            <li class="treeview <?php echo activate_main_menu('student_information'); ?>">
                <a href="#">
                    <i class="fa fa-user-plus ftlayer"></i> <span>Quản lý sinh viên</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if ($this->rbac->hasPrivilege('student', 'can_view')):?>
                    <li class="<?php echo activate_submenu('student', explode(',', 'search,view')); ?>"><a href="<?= base_url('student/search')?>"><i class="fa fa-angle-double-right"></i>Thông Tin SV</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('student', 'can_add')):?>
                    <li class=""><a href="javascript:void(0)"><i class="fa fa-angle-double-right"></i>Quản lý Văn bằng chứng chỉ</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('student', 'can_delete')):?>
                    <li class=""><a href="javascript:void(0)"><i class="fa fa-angle-double-right"></i>Khảo sát việc làm</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('student_categories', 'can_view')):?>
                    <li class=""><a href="javascript:void(0)"><i class="fa fa-angle-double-right"></i>Khảo sát SV  theo chủ đề </a></li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>
            
            <!-- //================== Chương trình đào tạo ======================= -->
            <?php 
                if (
                    $this->rbac->hasPrivilege('manage_lesson_plan', 'can_view')            ||
                    $this->rbac->hasPrivilege('manage_syllabus_status', 'can_view')        ||
                    $this->rbac->hasPrivilege('lesson', 'can_view')            ||
                    $this->rbac->hasPrivilege('topic', 'can_view')             ||
                    $this->rbac->hasPrivilege('subject_group', 'can_view')     ||
                    $this->rbac->hasPrivilege('copy_old_lesson', 'can_view')   ||
                    $this->rbac->hasPrivilege('training_system', 'can_view')
                ):
            ?>
            <li class="treeview <?php echo activate_main_menu('lesson_plan'); ?>">
                <a href="#">
                    <i class="fa fa-list-alt ftlayer"></i> <span>Chương trình đào tạo</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if ($this->rbac->hasPrivilege('subject_group', 'can_view')):?>
                    <li class="<?php echo activate_submenu('subject_group', explode(',', 'index,edit,add,view')); ?>"><a href="<?= base_url('admin/subjectgroup')?>"><i class="fa fa-angle-double-right"></i>Chương trình đào tạo</a></li>
                    <?php endif; ?>
                    <li class=""><a href="<?= base_url('admin/training_system')?>"><i class="fa fa-angle-double-right"></i>Bậc đào tạo</a></li>
                    <?php if ($this->rbac->hasPrivilege('class', 'can_view')):?>
                    <li class=""><a href="<?= base_url('classes')?>"><i class="fa fa-angle-double-right"></i>Chuyên ngành</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('subject', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/subject')?>"><i class="fa fa-angle-double-right"></i>Học phần</a></li>
                    <?php endif; ?>
                    <li class="<?php echo activate_submenu('studentfee', explode(',', 'index,addfee,searchpayment,feesearch')); ?>"><a href="<?= base_url('studentfee')?>"><i class="fa fa-angle-double-right"></i>Học phí</a></li>

                </ul>
            </li>
            <?php endif; ?>
            
            <!-- //================== Kỳ thi ======================= -->
            <?php 
                if (
                    $this->rbac->hasPrivilege('exam_group', 'can_view')            ||
                    $this->rbac->hasPrivilege('exam_result', 'can_view')             ||
                    $this->rbac->hasPrivilege('design_admit_card', 'can_view')    ||
                    $this->rbac->hasPrivilege('print_admit_card', 'can_view') ||
                    $this->rbac->hasPrivilege('design_marksheet', 'can_view')     ||
                    $this->rbac->hasPrivilege('print_marksheet', 'can_view')    ||
                    $this->rbac->hasPrivilege('marks_grade', 'can_view')
                ):
            ?>
            <li class="treeview <?php echo activate_main_menu('examinations'); ?>">
                <a href="#">
                    <i class="fa fa-user-plus ftlayer"></i> <span>Kỳ thi</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if ($this->rbac->hasPrivilege('exam_group', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/examgroup')?>"><i class="fa fa-angle-double-right"></i>Nhóm thi</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('student_attendance', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/exam_schedule')?>"><i class="fa fa-angle-double-right"></i>Lịch thi</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('exam_result', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/examresult')?>"><i class="fa fa-angle-double-right"></i>Kiểm tra kết quả</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('design_admit_card', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/admitcard')?>"><i class="fa fa-angle-double-right"></i>Thẻ chấp nhận thiết kế</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('print_admit_card', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/examresult/admitcardy')?>"><i class="fa fa-angle-double-right"></i>In thẻ tiếp nhận</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('design_marksheet', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/marksheet')?>"><i class="fa fa-angle-double-right"></i>Bảng đánh dấu thiết kế</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('print_marksheet', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/examresult/marksheet')?>"><i class="fa fa-angle-double-right"></i>In bảng đánh dấu</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('marks_grade', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/grade')?>"><i class="fa fa-angle-double-right"></i>Điểm lớp</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('marks_division', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/marksdivision')?>"><i class="fa fa-angle-double-right"></i>Bộ phận đánh dấu</a></li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>
            
            <!-- //================== Kiểm tra trực tuyến ======================= -->
            <?php 
                if (
                    $this->rbac->hasPrivilege('online_examination', 'can_view')  ||
                    $this->rbac->hasPrivilege('question_bank', 'can_view') 
                ):
            ?>
            <li class="treeview <?php echo activate_main_menu('online_examinations'); ?>">
                <a href="#">
                    <i class="fa fa-user-plus ftlayer"></i> <span>Kiểm tra trực tuyến</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if ($this->rbac->hasPrivilege('online_examination', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/onlineexam')?>"><i class="fa fa-angle-double-right"></i>Thi trực tuyến</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('question_bank', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/question')?>"><i class="fa fa-angle-double-right"></i>Ngân hàng câu hỏi</a></li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>
            
            <!-- //================== Đào tạo giảng dạy ======================= -->
            
            <?php 
                if (
                    $this->rbac->hasPrivilege('class_timetable', 'can_view')            ||
                    $this->rbac->hasPrivilege('teachers_timetable', 'can_view')             ||
                    $this->rbac->hasPrivilege('assign_class_teacher', 'can_view')    ||
                    $this->rbac->hasPrivilege('promote_student', 'can_view') ||
                    $this->rbac->hasPrivilege('section', 'can_view') 
                ):
            ?>
            <li class="treeview <?php echo activate_main_menu('academics'); ?>">
                <a href="#">
                    <i class="fa fa-mortar-board ftlayer"></i> <span>Đào tạo &amp; giảng dạy</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if ($this->rbac->hasPrivilege('class_timetable', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/timetable/classreport')?>"><i class="fa fa-angle-double-right"></i>Thời khóa biểu lớp học</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('teachers_time_table', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/timetable/mytimetable')?>"><i class="fa fa-angle-double-right"></i>Thời khóa biểu giáo viên</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('assign_class_teacher', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/teacher/assign_class_teacher')?>"><i class="fa fa-angle-double-right"></i>Phân công giáo viên</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('assign_class_teacher', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/teacher/assign_class_credit_teacher')?>"><i class="fa fa-angle-double-right"></i>Phân công giáo viên lớp học phần</a></li>
                    <?php endif; ?>
                    
                    <?php if ($this->rbac->hasPrivilege('promote_student', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/stdtransfer')?>"><i class="fa fa-angle-double-right"></i>Thúc đẩy sinh viên</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('section', 'can_view')):?>
                    <li class=""><a href="<?= base_url('sections')?>"><i class="fa fa-angle-double-right"></i>Lớp hành chính</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('credits', 'can_view')):?>
                    <li class=""><a href="<?= base_url('credits')?>"><i class="fa fa-angle-double-right"></i>Lớp học phần</a></li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>
            <!-- //================== Quản lý học phần ======================= -->
            
            <?php 
                if (
                    $this->rbac->hasPrivilege('subject_marks_report', 'can_view')            ||
                    $this->rbac->hasPrivilege('template_marks_report', 'can_view')             ||
                    $this->rbac->hasPrivilege('cbse_exam', 'can_view')    ||
                    $this->rbac->hasPrivilege('cbse_exam_print_marksheet', 'can_view') ||
                    $this->rbac->hasPrivilege('cbse_exam_grade', 'can_view')     ||
                    $this->rbac->hasPrivilege('cbse_exam_assign_observation', 'can_view')    ||
                    $this->rbac->hasPrivilege('cbse_exam_observation', 'can_view') ||
                    $this->rbac->hasPrivilege('cbse_exam_observation_parameter', 'can_view')||
                    $this->rbac->hasPrivilege('cbse_exam_assessment', 'can_view')||
                    $this->rbac->hasPrivilege('cbse_exam_term', 'can_view')||
                    $this->rbac->hasPrivilege('cbse_exam_template', 'can_view')||
                    $this->rbac->hasPrivilege('cbse_exam_schedule', 'can_view')
                ):
            ?>
            <li class="treeview <?php echo activate_main_menu('cbse_exam'); ?>">
                <a href="#">
                    <i class="fa fa-file-text-o"></i> <span>Quản lý học phần</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if ($this->rbac->hasPrivilege('cbse_exam', 'can_view')):?>
                    <li class=""><a href="<?= base_url('cbseexam/exam')?>"><i class="fa fa-angle-double-right"></i>Lớp học phần</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('cbse_exam_schedule', 'can_view')):?>
                    <li class=""><a href="<?= base_url('cbseexam/exam/examtimetable')?>"><i class="fa fa-angle-double-right"></i>Lịch thi</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('cbse_exam_print_marksheet', 'can_view')):?>
                    <li class=""><a href="<?= base_url('cbseexam/result/marksheet')?>"><i class="fa fa-angle-double-right"></i>In bảng đánh dấu</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('cbse_exam_grade', 'can_view')):?>
                    <li class=""><a href="<?= base_url('cbseexam/grade/gradelist')?>"><i class="fa fa-angle-double-right"></i>lớp thi</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('cbse_exam_assign_observation', 'can_view')):?>
                    <li class=""><a href="<?= base_url('cbseexam/observation/assign')?>"><i class="fa fa-angle-double-right"></i>chỉ định quan sát</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('cbse_exam_observation', 'can_view')):?>
                    <li class=""><a href="<?= base_url('cbseexam/observation')?>"><i class="fa fa-angle-double-right"></i>Quan sát</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('cbse_exam_observation_parameter', 'can_view')):?>
                    <li class=""><a href="<?= base_url('cbseexam/observationparameter')?>"><i class="fa fa-angle-double-right"></i>Tham số quan sát</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('cbse_exam_assessment', 'can_view')):?>
                    <li class=""><a href="<?= base_url('cbseexam/assessment')?>"><i class="fa fa-angle-double-right"></i>Đánh giá</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('cbse_exam_term', 'can_view')):?>
                    <li class=""><a href="<?= base_url('cbseexam/term')?>"><i class="fa fa-angle-double-right"></i>Khóa học</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('cbse_exam_template', 'can_view')):?>
                    <li class=""><a href="<?= base_url('cbseexam/template')?>"><i class="fa fa-angle-double-right"></i>Mẫu</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('subject_marks_report', 'can_view') && $this->rbac->hasPrivilege('template_marks_report', 'can_view')):?>
                    <li class=""><a href="<?= base_url('cbseexam/report/index')?>"><i class="fa fa-angle-double-right"></i>Báo cáo</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('cbse_exam_setting', 'can_view')):?>
                    <li class=""><a href="<?= base_url('cbseexam/setting/index')?>"><i class="fa fa-angle-double-right"></i>Cài đặt</a></li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>

            <!-- //================== Kế hoạch đào tạo ======================= -->
            <?php 
                if (
                    $this->rbac->hasPrivilege('staff', 'can_view')            ||
                    $this->rbac->hasPrivilege('approve_leave_request', 'can_view')             ||
                    $this->rbac->hasPrivilege('apply_leave', 'can_view')    ||
                    $this->rbac->hasPrivilege('leave_types', 'can_view') ||
                    $this->rbac->hasPrivilege('teachers_rating', 'can_view') ||
                    $this->rbac->hasPrivilege('department', 'can_view')            ||
                    $this->rbac->hasPrivilege('designation', 'can_view')             ||
                    $this->rbac->hasPrivilege('disable_staff', 'can_view') 
                ):
            ?>
            <li class="treeview <?php echo activate_main_menu('human_resource'); ?>">
                <a href="#">
                    <i class="fa fa-sitemap ftlayer"></i> <span>Quản lý nhân sự</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if ($this->rbac->hasPrivilege('staff', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/staff')?>"><i class="fa fa-angle-double-right"></i>Danh sách nhân viên</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('staff_attendance', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/staffattendance')?>"><i class="fa fa-angle-double-right"></i>Chấm công của nhân viên</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('staff_payroll', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/payroll')?>"><i class="fa fa-angle-double-right"></i>Lương bổng</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('approve_leave_request', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/leaverequest/leaverequest')?>"><i class="fa fa-angle-double-right"></i>Phê duyệt yêu cầu nghỉ phép</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('apply_leave', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/staff/leaverequest')?>"><i class="fa fa-angle-double-right"></i>Áp dụng nghỉ phép</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('leave_types', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/leavetypes')?>"><i class="fa fa-angle-double-right"></i>Loại nghỉ phép</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('teachers_rating', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/staff/rating')?>"><i class="fa fa-angle-double-right"></i>Đánh giá giáo viên</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('department', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/department/department')?>"><i class="fa fa-angle-double-right"></i>Khoa</a></li><?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('department', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/position/position')?>"><i class="fa fa-angle-double-right"></i>Chức vụ</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('designation', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/designation/designation')?>"><i class="fa fa-angle-double-right"></i>Trình độ học vấn</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('disable_staff', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/staff/disablestafflist')?>"><i class="fa fa-angle-double-right"></i>Nhân viên khuyết tật</a></li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>
            <!-- //================== Thiết lập ======================= -->
            <?php 
                if (
                    $this->rbac->hasPrivilege('general_setting', 'can_view')            ||
                    $this->rbac->hasPrivilege('session_setting', 'can_view')             ||
                    $this->rbac->hasPrivilege('notification_setting', 'can_view')    ||
                    $this->rbac->hasPrivilege('sms_setting', 'can_view') ||
                    $this->rbac->hasPrivilege('email_setting', 'can_view') ||
                    $this->rbac->hasPrivilege('payment_methods', 'can_view')            ||
                    $this->rbac->hasPrivilege('languages', 'can_view')             ||
                    $this->rbac->hasPrivilege('user_status', 'can_view')  ||
                    $this->rbac->hasPrivilege('backup_restore', 'can_view')  ||
                    $this->rbac->hasPrivilege('print_header_footer', 'can_view')  ||
                    $this->rbac->hasPrivilege('backup', 'can_view')  ||
                    $this->rbac->hasPrivilege('front_cms_setting', 'can_view')  ||
                    $this->rbac->hasPrivilege('custom_fields', 'can_view')  ||
                    $this->rbac->hasPrivilege('currency', 'can_view')  ||
                    $this->rbac->hasPrivilege('student_profile_update', 'can_view')  ||
                    $this->rbac->hasPrivilege('system_fields', 'can_view')  ||
                    $this->rbac->hasPrivilege('online_admission', 'can_view')  ||
                    $this->rbac->hasPrivilege('sidebar_menu', 'can_view')  ||
                    $this->rbac->hasPrivilege('language_switcher', 'can_view') 
                ):
            ?>
            <li class="treeview <?php echo activate_main_menu('system_settings'); ?>">
                <a href="#">
                    <i class="fa fa-gears ftlayer"></i> <span>Thiết lập hệ thống</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if ($this->rbac->hasPrivilege('general_setting', 'can_view')):?>
                    <li class=""><a href="<?= base_url('schsettings')?>"><i class="fa fa-angle-double-right"></i>Cài đặt chung</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('session_setting', 'can_view')):?>
                    <li class=""><a href="<?= base_url('sessions')?>"><i class="fa fa-angle-double-right"></i>Cài đặt phiên</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('notification_setting', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/notification/setting')?>"><i class="fa fa-angle-double-right"></i>Cài đặt thông báo</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('sms_setting', 'can_view')):?>
                    <li class=""><a href="<?= base_url('smsconfig')?>"><i class="fa fa-angle-double-right"></i>Cài đặt tin nhắn SMS</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('email_setting', 'can_view')):?>
                    <li class=""><a href="<?= base_url('emailconfig')?>"><i class="fa fa-angle-double-right"></i>Cài đặt email</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('payment_methods', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/paymentsettings')?>"><i class="fa fa-angle-double-right"></i>Phương thức thanh toán</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('print_header_footer', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/print_headerfooter')?>"><i class="fa fa-angle-double-right"></i>In Header Footer</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('front_cms_setting', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/frontcms')?>"><i class="fa fa-angle-double-right"></i>Cài đặt CMS phía trước</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('superadmin', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/roles')?>"><i class="fa fa-angle-double-right"></i>Quyền</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('backup', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/admin/backup')?>"><i class="fa fa-angle-double-right"></i>Phục hồi dữ liệu đã lưu</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('languages', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/language')?>"><i class="fa fa-angle-double-right"></i>ngôn ngữ</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('currency', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/currency')?>"><i class="fa fa-angle-double-right"></i>Tiền tệ</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('user_status', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/users')?>"><i class="fa fa-angle-double-right"></i>người dùng</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('superadmin', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/module')?>"><i class="fa fa-angle-double-right"></i>Mô-đun</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('custom_fields', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/customfield')?>"><i class="fa fa-angle-double-right"></i>Trường tùy chỉnh</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('superadmin', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/captcha')?>"><i class="fa fa-angle-double-right"></i>Cài đặt hình ảnh xác thực</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('system_fields', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/systemfield')?>"><i class="fa fa-angle-double-right"></i>Trường hệ thống</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('student_profile_update', 'can_view')):?>
                    <li class=""><a href="<?= base_url('student/profilesetting')?>"><i class="fa fa-angle-double-right"></i>Cập nhật hồ sơ sinh viên</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('online_admission', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/onlineadmission/admissionsetting')?>')?>"><i class="fa fa-angle-double-right"></i>Nhập học trực tuyến</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('superadmin', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/admin/filetype')?>"><i class="fa fa-angle-double-right"></i>Loại tập tin</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('sidebar_menu', 'can_view')):?>
                    <li class="active"><a href="<?= base_url('admin/sidemenu')?>"><i class="fa fa-angle-double-right"></i>Menu thanh bên</a></li>
                    <?php endif; ?>
                    <?php if ($this->rbac->hasPrivilege('superadmin', 'can_view')):?>
                    <li class=""><a href="<?= base_url('admin/updater')?>"><i class="fa fa-angle-double-right"></i>Cập nhật hệ thống</a></li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>
        </ul>
    </section>
</aside>