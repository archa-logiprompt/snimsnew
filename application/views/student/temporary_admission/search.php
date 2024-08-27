<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<style type="text/css">

</style>

<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('student_information'); ?>
            <small><?php echo $this->lang->line('student1'); ?></small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i>
                            <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>
                    <div class="box-body">
                        <?php if ($this->session->flashdata('msg')) { ?>
                            <div class="alert alert-success"> <?php echo $this->session->flashdata('msg') ?> </div>
                        <?php } ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <form role="form"
                                        action="<?php echo site_url('admin/temporary_admission/search') ?>"
                                        method="post" class="">
                                        <?php echo $this->customlib->getCSRF(); ?>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('class'); ?></label> <small
                                                    class="req"> *</small>
                                                <select autofocus="" id="class_id" name="class_id" class="form-control">
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    <?php
                                                    foreach ($classlist as $class) {
                                                    ?>
                                                        <option value="<?php echo $class['id'] ?>" <?php if (set_value('class_id') == $class['id'])
                                                                                                        echo "selected=selected" ?>><?php echo $class['class'] ?></option>
                                                    <?php
                                                        $count++;
                                                    }
                                                    ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('section'); ?></label><small
                                                    class="req"> *</small>
                                                <select id="section_id" name="section_id" class="form-control">
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo "Sessions" ?></label><small
                                                    class="req"> *</small>
                                                <select id="session_list" name="session_list" class="form-control">
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    <?php foreach ($sessionlist as $session) { ?>
                                                        <option value="<?php echo $session['id'] ?>" <?php if (set_value('class_id') == $session['id'])
                                                                                                            echo "selected=selected" ?>><?php echo $session['session'] ?></option>
                                                    <?php $count++;
                                                    } ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <button type="submit" name="search" value="search_filter"
                                                    class="btn btn-primary btn-sm pull-right checkbox-toggle"><i
                                                        class="fa fa-search"></i>
                                                    <?php echo $this->lang->line('search'); ?></button>
                                            </div>
                                        </div>
                                </div>

                                </form>
                            </div>
                            <!-- <div class="col-md-6">
                                <div class="row">
                                    <form role="form" action="<?php echo site_url('student/search') ?>" method="post" class="">
                                        <?php echo $this->customlib->getCSRF(); ?>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('search_by_keyword'); ?></label>
                                                <input type="text" name="search_text" class="form-control"   placeholder="<?php echo $this->lang->line('search_by_student_name'); ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <button type="submit" name="search" value="search_full" class="btn btn-primary pull-right btn-sm checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <?php
                if (isset($resultlist)) {
                    //var_dump($resultlist);
                ?>
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><i
                                        class="fa fa-list"></i> <?php echo $this->lang->line('list'); ?>
                                    <?php echo $this->lang->line('view'); ?></a></li>
                            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false"><i
                                        class="fa fa-newspaper-o"></i> <?php echo $this->lang->line('details'); ?>
                                    <?php echo $this->lang->line('view'); ?></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="download_label"> <?php echo $this->Setting_model->getCurrentSchoolName(); ?></br>
                                <?php echo $title; ?></div>
                            <div class="tab-pane active table-responsive no-padding" id="tab_1">
                                <table class="table table-striped table-bordered table-hover example" cellspacing="0"
                                    width="100%">
                                    <thead>
                                        <tr>

                                            <th><?php echo $this->lang->line('student_name'); ?></th>
                                            <th><?php echo $this->lang->line('class'); ?></th>
                                            <th><?php echo $this->lang->line('email'); ?></th>
                                            <th><?php echo $this->lang->line('mobile_no'); ?></th>
                                            <th><?php echo "Payment Status" ?></th>
                                            <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <?php
                                        if (empty($resultlist)) {
                                        ?>
                                            <!-- <tr>
                                                                <td colspan="12" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?></td>
                                                            </tr> -->
                                            <?php
                                        } else {
                                            $count = 1;

                                            foreach ($resultlist as $student) {
                                            ?>
                                                <tr>

                                                    <td>
                                                        <a
                                                            href="<?php echo base_url(); ?>student/view/<?php echo $student['id']; ?>"><?php echo $student['firstname'] . " " . $student['lastname']; ?>
                                                        </a>
                                                    </td>
                                                    <td><?php echo $student['class'] . "(" . $student['section'] . ")" ?></td>



                                                    <td><?php echo $student['email']; ?></td>


                                                    <td><?php echo $student['phone']; ?></td>

                                                    <td>
                                                        <?php if (isset($student['status']) && $student['status'] == '3'): ?>
                                                            Payment Approved
                                                        <?php elseif (isset($student['transaction_id']) && ($student['totalAmount'] > $student['paidAmount'])): ?>
                                                            Partially Paid
                                                        <?php elseif (isset($student['transaction_id']) && !empty($student['transaction_id'])): ?>
                                                            Paid
                                                        <?php else: ?>
                                                            Pending
                                                        <?php endif; ?>
                                                    </td>

                                                    <td class="pull-right">

                                                        <?php $show_button = ($student['picked_by'] == $userdata['id']) || (array_key_exists("Cashier", $role) || $student['action'] == '1'); ?>
                                                        <?php if ($student['financial_verification'] == '0' && (array_key_exists("Finance Controller", $role))): ?>
                                                            <a href="<?php echo base_url(); ?>admin/temporary_admission/show/<?php echo $student['id'] ?>"
                                                                class="btn btn-success btn-xs" data-toggle="tooltip"
                                                                title="<?php echo $this->lang->line('show'); ?>">
                                                                <i class="fa fa-reorder"></i> <?php echo "Show"; ?>
                                                            </a>
                                                        <?php endif; ?>
                                                        <?php if ($show_button): ?>
                                                            <a href="<?php echo base_url(); ?>admin/temporary_admission/show/<?php echo $student['id'] ?>"
                                                                class="btn btn-success btn-xs" data-toggle="tooltip"
                                                                title="<?php echo $this->lang->line('show'); ?>">
                                                                <i class="fa fa-reorder"></i> <?php echo "Show"; ?>
                                                            </a>
                                                        <?php endif; ?>
                                                        <?php if ($student['picked_by'] == $userdata['id']): ?>
                                                            <a href="<?php echo base_url(); ?>admin/temporary_admission/home/<?php echo $student['id'] ?>"
                                                                class="btn btn-success btn-xs"
                                                                data-toggle="tooltip"
                                                                title="<?php echo $this->lang->line('show'); ?>"
                                                                target="_blank">
                                                                <i class="fa fa-reorder"></i> <?php echo "Proceed to counseling"; ?>
                                                            </a>

                                                        <?php endif; ?>
                                                        <?php

                                                        $show_pickup = $student['picked_by'];
                                                        if ($show_pickup == null && !(array_key_exists("Cashier", $role)) && !(array_key_exists("Finance Controller", $role))) : ?>
                                                            <a href="<?php echo base_url(); ?>admin/temporary_admission/pickup/<?php echo $student['current_student_id']; ?>"
                                                                class="btn btn-primary btn-xs" target="_blank" data-toggle="tooltip"
                                                                title="<?php echo $this->lang->line('pickup'); ?>">
                                                                <i class="fa fa-hand-paper"></i> <?php echo "Pickup"; ?>
                                                            </a>
                                                        <?php endif; ?>


                                                        <?php $show_button = $student['picked_by'] == $userdata['id']; ?>
                                                        <?php if ($show_button): ?>
                                                            <button type="button"
                                                                onclick="leave(<?php echo $student['current_student_id'] ?>)"
                                                                class="btn btn-danger btn-xs" data-toggle="tooltip"
                                                                title="<?php echo $this->lang->line('leave'); ?>">
                                                                <i class="fa fa-sign-out"></i> <?php echo "Leave" ?>
                                                            </button>
                                                    </td>
                                                <?php endif; ?>

                                                </tr>
                                        <?php
                                                $count++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="tab_2">
                                <?php if (empty($resultlist)) {
                                ?>
                                    <div class="alert alert-info"><?php echo $this->lang->line('no_record_found'); ?></div>
                                    <?php
                                } else {
                                    $count = 1;
                                    foreach ($resultlist as $student) {

                                        if (empty($student["image"])) {
                                            $image = "uploads/student_images/no_image.png";
                                        } else {
                                            $image = $student['image'];
                                        }
                                    ?>
                                        <div class="carousel-row">
                                            <div class="slide-row">
                                                <div id="carousel-2" class="carousel slide slide-carousel" data-ride="carousel">
                                                    <div class="carousel-inner">
                                                        <div class="item active">
                                                            <a
                                                                href="<?php echo base_url(); ?>student/view/<?php echo $student['id'] ?>">
                                                                <img class="img-responsive img-thumbnail width150"
                                                                    alt="<?php echo $student["firstname"] . " " . $student["lastname"] ?>"
                                                                    src="<?php echo base_url() . $image; ?>" alt="Image"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="slide-content">
                                                    <h4><a
                                                            href="<?php echo base_url(); ?>student/view/<?php echo $student['id'] ?>">
                                                            <?php echo $student['firstname'] . " " . $student['lastname'] ?></a>
                                                    </h4>
                                                    <div class="row">
                                                        <div class="col-xs-6 col-md-6">
                                                            <address>
                                                                <strong><b><?php echo $this->lang->line('class'); ?>:
                                                                    </b><?php echo $student['class'] . "(" . $student['section'] . ")" ?></strong><br>
                                                                <b><?php echo $this->lang->line('admission_no'); ?>:
                                                                </b><?php echo $student['admission_no'] ?><br />
                                                                <b><?php echo $this->lang->line('date_of_birth'); ?>:
                                                                    <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['dob'])); ?><br>
                                                                    <b><?php echo $this->lang->line('gender'); ?>:&nbsp;</b><?php echo $student['gender'] ?><br>
                                                            </address>
                                                        </div>
                                                        <div class="col-xs-6 col-md-6">
                                                            <b><?php echo $this->lang->line('local_identification_no'); ?>:&nbsp;</b><?php echo $student['samagra_id'] ?><br>
                                                            <b><?php echo $this->lang->line('guardian_name'); ?>:&nbsp;</b><?php echo $student['guardian_name'] ?><br>
                                                            <b><?php echo $this->lang->line('guardian_phone'); ?>: </b> <abbr
                                                                title="Phone"><i class="fa fa-phone-square"></i>&nbsp;</abbr>
                                                            <?php echo $student['guardian_phone'] ?><br>
                                                            <b><?php echo $this->lang->line('current_address'); ?>:&nbsp;</b><?php echo $student['current_address'] ?>
                                                            <?php echo $student['city'] ?><br>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="slide-footer">
                                                    <span class="pull-right buttons">
                                                        <a href="<?php echo base_url(); ?>student/view/<?php echo $student['id'] ?>"
                                                            class="btn btn-default btn-xs" data-toggle="tooltip"
                                                            title="<?php echo $this->lang->line('show'); ?>">
                                                            <i class="fa fa-reorder"></i>
                                                        </a>
                                                        <?php
                                                        if ($this->rbac->hasPrivilege('student', 'can_edit')) {
                                                        ?>
                                                            <a href="<?php echo base_url(); ?>student/edit/<?php echo $student['id'] ?>"
                                                                class="btn btn-default btn-xs" data-toggle="tooltip"
                                                                title="<?php echo $this->lang->line('edit'); ?>">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                        <?php }
                                                        if ($this->rbac->hasPrivilege('collect_fees', 'can_add')) {
                                                        ?>
                                                            <a href="<?php echo base_url(); ?>studentfee/addfee/<?php echo $student['id'] ?>"
                                                                class="btn btn-default btn-xs" data-toggle="tooltip" title=""
                                                                data-original-title="<?php echo $this->lang->line('add_fees'); ?>">
                                                                <?php echo $currency_symbol; ?>
                                                            </a>
                                                        <?php } ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                    $count++;
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    function getSectionByClass(class_id, section_id) {
        if (class_id != "" && section_id != "") {
            $('#section_id').html("");
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "sections/getByClass",
                data: {
                    'class_id': class_id
                },
                dataType: "json",
                success: function(data) {
                    $.each(data, function(i, obj) {
                        var sel = "";
                        if (section_id == obj.section_id) {
                            sel = "selected";
                        }
                        div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
                    });
                    $('#section_id').append(div_data);
                }
            });
        }
    }
    $(document).ready(function() {
        var class_id = $('#class_id').val();
        var section_id = '<?php echo set_value('section_id') ?>';
        getSectionByClass(class_id, section_id);
        $(document).on('change', '#class_id', function(e) {
            $('#section_id').html("");
            var class_id = $(this).val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "sections/getByClass",
                data: {
                    'class_id': class_id
                },
                dataType: "json",
                success: function(data) {
                    $.each(data, function(i, obj) {
                        div_data += "<option value=" + obj.section_id + ">" + obj.section + "</option>";
                    });
                    $('#section_id').append(div_data);
                }
            });
        });
    });


    function leave(id) {
        $.ajax({
            type: "POST",
            url: base_url + "admin/temporary_admission/leave",
            data: {
                'id': id
            },
            success: function(data) {
                window.location.reload();
            }
        });
    }
</script>