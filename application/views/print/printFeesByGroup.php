<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<style type="text/css">
    @media print {
        .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
            float: left;
        }
        .col-sm-12 {
            width: 100%;
        }
        .col-sm-11 {
            width: 91.66666667%;
        }
        .col-sm-10 {
            width: 83.33333333%;
        }
        .col-sm-9 {
            width: 75%;
        }
        .col-sm-8 {
            width: 66.66666667%;
        }
        .col-sm-7 {
            width: 58.33333333%;
        }
        .col-sm-6 {
            width: 50%;
        }
        .col-sm-5 {
            width: 41.66666667%;
        }
        .col-sm-4 {
            width: 33.33333333%;
        }
        .col-sm-3 {
            width: 25%;
        }
        .col-sm-2 {
            width: 16.66666667%;
        }
        .col-sm-1 {
            width: 8.33333333%;
        }
        .col-sm-pull-12 {
            right: 100%;
        }
        .col-sm-pull-11 {
            right: 91.66666667%;
        }
        .col-sm-pull-10 {
            right: 83.33333333%;
        }
        .col-sm-pull-9 {
            right: 75%;
        }
        .col-sm-pull-8 {
            right: 66.66666667%;
        }
        .col-sm-pull-7 {
            right: 58.33333333%;
        }
        .col-sm-pull-6 {
            right: 50%;
        }
        .col-sm-pull-5 {
            right: 41.66666667%;
        }
        .col-sm-pull-4 {
            right: 33.33333333%;
        }
        .col-sm-pull-3 {
            right: 25%;
        }
        .col-sm-pull-2 {
            right: 16.66666667%;
        }
        .col-sm-pull-1 {
            right: 8.33333333%;
        }
        .col-sm-pull-0 {
            right: auto;
        }
        .col-sm-push-12 {
            left: 100%;
        }
        .col-sm-push-11 {
            left: 91.66666667%;
        }
        .col-sm-push-10 {
            left: 83.33333333%;
        }
        .col-sm-push-9 {
            left: 75%;
        }
        .col-sm-push-8 {
            left: 66.66666667%;
        }
        .col-sm-push-7 {
            left: 58.33333333%;
        }
        .col-sm-push-6 {
            left: 50%;
        }
        .col-sm-push-5 {
            left: 41.66666667%;
        }
        .col-sm-push-4 {
            left: 33.33333333%;
        }
        .col-sm-push-3 {
            left: 25%;
        }
        .col-sm-push-2 {
            left: 16.66666667%;
        }
        .col-sm-push-1 {
            left: 8.33333333%;
        }
        .col-sm-push-0 {
            left: auto;
        }
        .col-sm-offset-12 {
            margin-left: 100%;
        }
        .col-sm-offset-11 {
            margin-left: 91.66666667%;
        }
        .col-sm-offset-10 {
            margin-left: 83.33333333%;
        }
        .col-sm-offset-9 {
            margin-left: 75%;
        }
        .col-sm-offset-8 {
            margin-left: 66.66666667%;
        }
        .col-sm-offset-7 {
            margin-left: 58.33333333%;
        }
        .col-sm-offset-6 {
            margin-left: 50%;
        }
        .col-sm-offset-5 {
            margin-left: 41.66666667%;
        }
        .col-sm-offset-4 {
            margin-left: 33.33333333%;
        }
        .col-sm-offset-3 {
            margin-left: 25%;
        }
        .col-sm-offset-2 {
            margin-left: 16.66666667%;
        }
        .col-sm-offset-1 {
            margin-left: 8.33333333%;
        }
        .col-sm-offset-0 {
            margin-left: 0%;
        }
        .visible-xs {
            display: none !important;
        }
        .hidden-xs {
            display: block !important;
        }
        table.hidden-xs {
            display: table;
        }
        tr.hidden-xs {
            display: table-row !important;
        }
        th.hidden-xs,
        td.hidden-xs {
            display: table-cell !important;
        }
        .hidden-xs.hidden-print {
            display: none !important;
        }
        .hidden-sm {
            display: none !important;
        }
        .visible-sm {
            display: block !important;
        }
        table.visible-sm {
            display: table;
        }
        tr.visible-sm {
            display: table-row !important;
        }
        th.visible-sm,
        td.visible-sm {
            display: table-cell !important;
        }
    }
</style>

<html lang="en">
    <head>
        <title><?php echo $this->lang->line('fees_receipt'); ?></title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap.min.css"> 
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/AdminLTE.min.css">
    </head>
    <body>       
        <div class="container">
            <div class="row">
                <div id="content" class="col-lg-12 col-sm-12 ">
                    <div class="invoice">
                        <div class="row header text-center">
                            <div class="col-sm-2">
                                <?php
                                if ($settinglist[0]['image'] != "") {
                                    ?>

                                    <img style="height:70px; " src="<?php echo base_url(); ?>/uploads/school_content/logo/<?php echo $settinglist[0]['image']; ?>">
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="col-sm-8">

                                <strong style="font-size: 20px;"><?php echo $settinglist[0]['name']; ?></strong><br>
                                <?php echo $settinglist[0]['address']; ?>

                                <?php echo $this->lang->line('phone'); ?>: <?php echo $settinglist[0]['phone']; ?><br>

                            </div><!--/col-->
                        </div>
                        <div class="row">                           
                            <div class="col-xs-6">
                                <br/>
                                <address>
                                    <strong><?php echo $feeList->firstname . " " . $feeList->lastname; ?></strong><br>

                                    <?php echo $this->lang->line('father_name'); ?>: <?php echo $feeList->father_name; ?><br>
                                    <?php echo $this->lang->line('class'); ?>: <?php echo $feeList->class . " (" . $feeList->section . ")"; ?>
                                </address>
                            </div>
                            <div class="col-xs-6 text-right">
                                <br/>
                                <address>
                                    <strong>Date: <?php
                                        $date = date('d-m-Y');

                                        echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($date));
                                        ?></strong><br/>

                                </address>                               
                            </div>
                        </div>
                        <hr style="margin-top: 0px;margin-bottom: 0px;" />
                        <div class="row">
                            <?php
                            if (!empty($feeList)) {
								
                                ?>

                                <table  style="border-left: 1px solid; border-bottom: 1px solid; border-right: 1px solid; border-top: 1px solid;" width="100%">
                                    <thead  style="border-bottom: 1px solid;">
                                  
                                    <th style="padding: 5px;"><?php echo $this->lang->line('fees_code'); ?></th>
                                    
                                   
                                    <th style="padding: 5px;" class="text text-left"><?php echo $this->lang->line('amount'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                     <th style="padding: 5px;" class=""><?php echo $this->lang->line('date'); ?></th>
                                    <th  style="padding: 5px;" class="text text-center"><?php echo $this->lang->line('payment_id'); ?></th>
                                    <th style="padding: 5px;" class="text text-center"><?php echo $this->lang->line('mode'); ?></th>
                                   
                                    <th style="padding: 5px;" class="text text-left"><?php echo $this->lang->line('paid'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                    <th style="padding: 5px;" class="text text-left"><?php echo $this->lang->line('fine'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                    <th style="padding: 5px;" class="text text-left" ><?php echo $this->lang->line('discount'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                    <th  style="padding: 5px;" class="text text-left"><?php echo $this->lang->line('balance'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                              <th></th>     
                                    </thead>
                                    <tbody>
                                        <?php
                                        $amount = 0;
                                        $discount = 0;
                                        $fine = 0;
                                        $total = 0;
                                        $grd_total = 0;

                                        if (empty($feeList)) {
                                            ?>
                                            <tr>
                                                <td colspan="11" class="text-danger text-center">
                                                    <?php echo $this->lang->line('no_transaction_found'); ?>
                                                </td>
                                            </tr>
                                            <?php
                                        } else {
                                            $fee_discount = 0;
                                            $fee_paid = 0;

                                            $fee_fine = 0;
                                            $alot_fee_discount = 0;
                                            if($feeList->is_system){
                                                $feeList->amount=$feeList->student_fees_master_amount;
                                            }
                                            if (!empty($feeList->amount_detail)) {
                                                $fee_deposits = json_decode(($feeList->amount_detail));

                                                foreach ($fee_deposits as $fee_deposits_key => $fee_deposits_value) {
                                                    $fee_paid = $fee_paid + $fee_deposits_value->amount;
                                                    $fee_discount = $fee_discount + $fee_deposits_value->amount_discount;
                                                    $fee_fine = $fee_fine + $fee_deposits_value->amount_fine;
                                                }
                                            }
                                            $feetype_balance = $feeList->amount - ($fee_paid + $fee_discount);
                                            ?>
                                            <tr style="height:30px;border-bottom: 1px dashed;" class="dark-gray">

                                               
                                                <td><?php echo $feeList->code; ?></td>
                                                
                                                
                                                <td class="text text-left"><?php echo $feeList->amount; ?></td>

                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class="text text-left"><?php
                                                    echo $fee_paid
                                                    ?></td>
                                                <td class="text text-left"><?php
                                                    echo number_format($fee_fine, 2, '.', '');
                                                    ?></td>
                                                <td class="text text-center"><?php
                                                    echo  number_format($fee_discount, 2, '.', '');
                                                    ?></td>
                                                <td class="text text-left"><?php
                                                    $display_none = "ss-none";
                                                    if ($feetype_balance > 0) {
                                                        $display_none = "";


                                                        echo number_format($feetype_balance, 2, '.', '');
                                                    }
                                                    ?>

                                                </td>
<td></td>


                                            </tr>

                                            <?php
                                            $fee_deposits = json_decode(($feeList->amount_detail));
                                            if (is_object($fee_deposits)) {


                                                foreach ($fee_deposits as $fee_deposits_key => $fee_deposits_value) {
                                                    ?>
                                                    <tr>
                                                     
                                                     <td></td><td></td>
                                                     
                                                      <td class="text text-left" style="border-bottom: 1px dashed;">

                                                            <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($fee_deposits_value->date)).'&nbsp&nbsp';   ?>
                                                        </td>
                                                        
                                                        <td class="text text-left"  style="border-bottom: 1px dashed;">
                                         <?php echo $fee_deposits_value->inv_no; ?>

                                                        </td>
                                                        
                                                        <td class="text text-left" style="border-bottom: 1px dashed;"><?php echo $fee_deposits_value->payment_mode; ?></td>
                 
                                                        <td  style="text-align:left; border-bottom: 1px dashed;"><?php echo  number_format($fee_deposits_value->amount, 2, '.', ''); ?></td>
                                                        <td style="text-align:left; border-bottom: 1px dashed;"><?php echo  number_format($fee_deposits_value->amount_fine, 2, '.', ''); ?></td>
                                                        <td style="text-align:center; border-bottom: 1px dashed;"><?php echo number_format($fee_deposits_value->amount_discount, 2, '.', ''); ?></td>
                                                        <td style="text-align:left; border-bottom: 1px dashed;"></td>
                                                        <td style="text-align:left; border-bottom: 1px dashed;"></td>

                                                    </tr>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>  
            </div>
        </div>
        <div class="clearfix"></div>
        <footer>           
        </footer>
    </body>
</html>
