<style type="text/css">
    .liststyle1 {
        margin: 0;
        list-style: none;
        line-height: 28px;
    }
	
	.switchcheck {
    float: right !important;
   
	}
	

</style>

<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <i class="fa fa-money"></i> <?php echo $this->lang->line('fees_collection'); ?></h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php if ($this->rbac->hasPrivilege('fees_master', 'can_add')) { ?>
                <div class="col-md-4">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo "Add Admission fees" . " : " . $this->setting_model->getCurrentSessionName(); ?></h3>
                        </div><!-- /.box-header -->
                        <form action="<?php echo site_url("admin/feemaster/editadmissionfees/" . $id) ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">

                            <div class="box-body">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>

                                <?php echo $this->customlib->getCSRF(); ?>


                                
                                <div class="row">
                                    <div class="col-md-12">



                                            <!--<div class="form-group">
                                            <label for="exampleInputEmail1"><?php //echo $this->lang->line('year'); ?></label> <small class="req">*</small>

                                            <select autofocus="" id="year" name="year" class="form-control" >
                                                <option value=""><?php //echo $this->lang->line('select'); ?></option>
                                                <?php
                                                //foreach ($feeyearlist as $feeyear) {
                                                    ?>
                                                    <option value="<?php //echo $feeyear['id'] ?>"<?php
                                                    //if (set_value('year') == $feeyear['id']) {
                                                       // echo "selected =selected";
                                                    //}
                                                    ?>><?php //echo $feeyear['year'] ?></option>

                                                    <?php
                                                    //$count++;
                                                //}
                                                ?>
                                            </select>
                                            <span class="text-danger"><?php //echo form_error('year'); ?></span>
                                        </div>
-->

                                    <input name="id" type="hidden" class="form-control"  value="<?php echo set_value('id', $editadmissionfeelist['aid']); ?>" />

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('fees_group'); ?></label> <small class="req">*</small>

                                            <select autofocus="" id="fee_groups_id" name="fee_groups_id" class="form-control" >
                                                <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                <?php
                                                foreach ($admissionquotalist as $feegroup) {
                                                    ?>
                                                    <option value="<?php echo $feegroup['id'] ?>"<?php
                                                    if (set_value('fee_groups_id',$editadmissionfeelist['fee_groups_id']) == $feegroup['id']) {
                                                        echo "selected =selected";
                                                    }
                                                    ?>><?php echo $feegroup['name'] ?></option>

                                                    <?php
                                                    $count++;
                                                }
                                                ?>
                                            </select>
                                            <span class="text-danger"><?php echo form_error('fee_groups_id'); ?></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('fees_type'); ?></label><small class="req"> *</small>

                                            <select autofocus="" id="feetype_id" name="feetype_id" class="form-control" >
                                                <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                <?php
                                                foreach ($feetypeList as $feetype) {
                                                    ?>
                                                    <option value="<?php echo $feetype['id'] ?>"<?php
                                                    if (set_value('feetype_id',$editadmissionfeelist['feetype_id']) == $feetype['id']) {
                                                        echo "selected =selected";
                                                    }
                                                    ?>><?php echo $feetype['type'] ?></option>

                                                    <?php
                                                    $count++;
                                                }
                                                ?>
                                            </select>
                                            <span class="text-danger"><?php echo form_error('feetype_id'); ?></span>
                                        </div>


                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('due_date'); ?></label>
                                            <input id="due_date" name="due_date" placeholder="" type="text" class="form-control"  value="<?php echo $editadmissionfeelist['due_date']?>" readonly="readonly"/>
                                            <span class="text-danger"><?php echo form_error('due_date'); ?></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('amount'); ?></label><small class="req"> *</small>
                                            <input id="amount" name="amount" placeholder="" type="text" class="form-control"  value="<?php echo $editadmissionfeelist['amount'] ?>" />
                                            <span class="text-danger"><?php echo form_error('amount'); ?></span>
                                        </div>
                                       
                                        
                                       
                                        <div id="fineid" hidden>
                                        <div class="form-group" id="finetype" >
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('fine_type'); ?></label><small class="req"> *</small>

                                            <select  id="finetype_id" name="finetype_id" class="form-control">
                                                <option value="0"><?php echo $this->lang->line('select'); ?></option>
                                                
                                                  <option value="Monthly">Monthly</option>
                                                  <option value="Weekly">Weekly</option>
                                                  <option value="Daily">Daily</option>
                                                   
                                            </select>
                                            <span class="text-danger"><?php echo form_error('finetype_id'); ?></span>
                                        </div>
                                        
                                        <div class="form-group" id="amounttype">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('amount_type'); ?></label><small class="req"> *</small>

                                            <select  id="amounttype_id" name="amounttype_id" class="form-control" >
                                                <option value="0"><?php echo $this->lang->line('select'); ?></option>
                                               <option id="first" value="Fixed Amount">Fixed Amount</option>
                                                  <option id="second" value="Percentage">Percentage</option>
                                            </select>
                                            <span class="text-danger"><?php echo form_error('amounttype_id'); ?></span>
                                        </div>
                                        
                                     
                                        
                                         <div class="form-group"  id="fixamount" hidden>
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('fixed_amount'); ?></label><small class="req"> *</small>
                                            <input id="fixedamount" name="fixedamount" placeholder="" type="text" class="form-control"  value="<?php echo set_value('fixed_amount'); ?>" />
                                            <span class="text-danger"><?php echo form_error('fixed_amount'); ?></span>
                                        </div>
                                        
                                        <div class="form-group"  id="percent" hidden>
                                           <label for="exampleInputEmail1"><?php echo $this->lang->line('percentage'); ?></label><small class="req"> *</small>
                                            <input id="percentage" name="percentage" placeholder="" type="text" class="form-control"  value="<?php echo set_value('percentage'); ?>" />
                                            <span class="text-danger"><?php echo form_error('percentage'); ?></span>
                                        </div>

                                    </div>
                                    </div>
                                    <div class="col-md-6">

                                    </div>
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
            if ($this->rbac->hasPrivilege('fees_master', 'can_add')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">
                <!-- Horizontal Form -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo "Admission Fees List" . " : " . $this->setting_model->getCurrentSessionName(); ?></h3>

                    </div><!-- /.box-header -->

                    <div class="box-body">
                        <div class="download_label">
						<?php echo $this->Setting_model->getCurrentSchoolName();?></br>
						<?php echo $this->lang->line('fees_master_list') . " : " . $this->setting_model->getCurrentSessionName(); ?></div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th><?php echo "Admission Quota"; ?></th>
                                        <th><?php echo "Amount" ?></th>
                                      
                                      
                                       
                                    </tr>
                                </thead>
                         
                                <tbody>
                                    <?php 
                                       foreach ($admissionfeeslist as $index => $feegroup) {
                                        ?>
                                        <tr>
                                        <td class="mailbox-name">
                                                <a href="#" data-toggle="popover"
                                                    class="detail_popover"><?php echo $feegroup['name'] ?></a>

 
                                            </td>
                                            <td>
                                                <?php foreach ($arr[$index] as $key => $array) {
                                                    echo $array['type'] . "-" . $array['amount'] ?>
                                                    
                                                    <a href="<?php echo base_url(); ?>admin/feemaster/editadmissionfees/<?php echo $array['aid'] ?>"
                                                        class="btn btn-default btn-xs" data-toggle="tooltip"
                                                        title="<?php echo $this->lang->line('edit'); ?>">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <a href="<?php echo base_url(); ?>admin/feemaster/deleteadmissionfees/<?php echo $array['aid'] ?>"
                                                        class="btn btn-default btn-xs" data-toggle="tooltip"
                                                        title="<?php echo $this->lang->line('delete'); ?>"
                                                        onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                        <i class="fa fa-remove"></i>
                                                    </a>
                                                    <br>
                                                    <?php
                                                }
                                                ?>
                                            </td>


                                        
                                            
                                          
                                            <!-- <td class="mailbox-date pull-right">
                                            <?php
                                                if ($this->rbac->hasPrivilege('fees_group', 'can_edit')) {
                                                    ?>
                                                    <a href="<?php echo base_url(); ?>admin/feemaster/editadmissionfees/<?php echo $feegroup['aid'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                <?php } ?>
                                                
    <?php if ($this->rbac->hasPrivilege('fees_master', 'can_delete')) { ?>
                                                    <a href="<?php echo base_url(); ?>admin/feemaster/deleteadmissionfees/<?php echo $feegroup['aid'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                        <i class="fa fa-remove"></i>
                                                    </a>
    <?php } ?>

                                            </td> -->
                                        </tr>
                                        <?php
                                    }
                                    ?>

                                </tbody>
                            </table><!-- /.table -->
                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->


                    </form>
                </div>

            </div><!--/.col (right) -->
            <!-- left column -->


        </div>
        <div class="row">
            <!-- left column -->

            <!-- right column -->
            <div class="col-md-12">

            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">
    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';

        $('#date').datepicker({
            //  format: "dd-mm-yyyy",
            format: date_format,
            autoclose: true
        });

        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });

    });
</script>
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

        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
        $('#due_date').datepicker({
            format: date_format,
            autoclose: true
        });
    });


</script>
<script type="text/javascript">
    function valueChanged()
    {
        if ($('#enable_student_img').is(":checked"))
            $("#fineid").show();
			 
        // alert("Hii")
        else
            $("#fineid").hide();
			$("#fixamount").hide();
			$("#percent").hide();
			$("#amounttype_id").val(0);
			$("#finetype_id").val(0);
			
    }
	
	$('#amounttype_id').on('change', function() {
		var val=$(this).val();
		if(val=='Fixed Amount')
		{      $("#percent").hide();	
			  $("#fixamount").show();
			  
			  
		}
		else if(val=='Percentage')
		{
			$("#fixamount").hide();
		    $("#percent").show();	
		}
		
  
  
});
	
	
	
	
	
	
	
	
	
	
</script>
<script type="text/javascript">
    /*function valueChange()
    {
       { if ($('#first'))
            $("#fixamount").show();
			 
        // alert("Hii")
        else
            $("#fixamount").hide();}
			
			{ if ($('#second'))
            $("#percent").show();
			 
        // alert("Hii")
        else
            $("#percent").hide();}
	}*/
	
	
	
	
	
</script>

