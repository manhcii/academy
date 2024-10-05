<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="box box-primary" id="subject_list">
            <div class="box-body">
                <h3 class="pagetitleh2" style="text-transform:uppercase">CHƯƠNG TRÌNH ĐÀO TẠO CHUYÊN NGÀNH <?php echo $subjectgroup->class;?></h3>
                <table class="table table-bordered table-striped" cellspacing="0" rules="all" border="1" id="ctl02_dvList" style="border-collapse:collapse;">
                    <tbody>
                        <tr>
                            <td class="k-table-view">
                                Bậc đào tạo
                            </td>
                            <td class="k-table-viewdetail">
                                <?php echo $this->lang->line($subjectgroup->training_system); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="k-table-view">
                                Chuyên ngành
                            </td>
                            <td class="k-table-viewdetail">
                                <?php 
                                    echo $subjectgroup->class;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="k-table-view">
                                Mã ngành
                            </td>
                            <td class="k-table-viewdetail">
                                <?php 
                                    echo $subjectgroup->class_code;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="k-table-view">
                                Mục tiêu đào tạo
                            </td>
                            <td class="k-table-viewdetail">
                                <?php echo $subjectgroup->description; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="k-table-view">
                                Khung chương trình
                            </td>
                            <td class="k-table-viewdetail">
                                <table class="table table-bordered table-striped" border="0" style="width: 100%;">
                                    <thead>
                                        <tr class="kTableHeader">
                                            <td class="td" style="text-align: center;" rowspan="2">
                                                <div style="cursor: pointer;">
                                                    STT
                                                </div>
                                            </td>
                                            <td class="td" style="text-align: center;" rowspan="2">Mã học phần
                                            </td>
                                            <td class="td" style="text-align: center;" rowspan="2">Tên học phần
                                            </td>
                                            <td class="td" style="text-align: center;" colspan="3">Số tín chỉ
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $credit=0;$i=1;foreach ($subjectgroup->group_subject as $group_subject_key => $group_subject_value): ?> 
                                        <tr class="kTableRow">
                                            <td class="td" style="text-align: center;"> <?php echo $i; ?></td>
                                            <td class="td"> <?php echo $group_subject_value->code; ?></td>
                                            <td class="td"><a><?php echo $group_subject_value->name; ?></a></td>
                                            <td class="td"> <?php echo number_format($group_subject_value->credit,2); ?></td>
                                        </tr>
                                        <?php $credit+=$group_subject_value->credit ;$i++;endforeach ?>
                                        <tr class="kTableRow">
                                            <td class="td" colspan="3"><b>Tổng số tín chỉ</b></td>
                                            <td class="td"><b><?php echo number_format($credit,2); ?></b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->