<?php
$get_target = select_query("target_monthly",array('monthly','daily'),array('year' => date("Y"), 'month' => date("M") ));
$get_currency = select_query("country_cost_master",array('currency'), array());
$get_bd_ids = execute_query("SELECT emp_id FROM `employees_master` where `manager_id` = '".$_SESSION['emp_id']."'");

$get_bd_ids_record = array_values($get_bd_ids);
array_push($get_bd_ids_record, $_SESSION['emp_id']);
$get_bd_ids_values = array();
foreach($get_bd_ids as $key => $val)
{
   array_push($get_bd_ids_values, $val['emp_id']);
}
$get_bd_ids_record = implode(",",$get_bd_ids_values);

if(($_SESSION['emp_role'] == "Sales") ||( $_SESSION['emp_role'] == "team_leader_sales") || ( $_SESSION['emp_role'] == "sales_lead")){
    date_default_timezone_set("Asia/Calcutta");
    $today_date = new DateTime();
    $get_today_date =  $today_date->format('Y-m-d');
    $get_wc = execute_query("SELECT ticket_payment.p_id, ticket_payment.ticket_id, ticket_payment.transaction_date, ticket_payment.transaction_id, ticket_payment.accounts_approval_date, ticket_payment.accounts_approval_by, ticket_payment.status, ticket_payment.date_added, ticket_payment.invoice_number, ticket_payment.payment_attached_by, ticket_payment.inr_rate, ticket_payment.total_value, ticket_payment.wordcount,sum(ticket_payment.amount_received) as get_total_val,invoice_master.extra_charges,invoice_master.std_rate FROM ticket_payment join invoice_master on ticket_payment.ticket_id = invoice_master.ticket_id where `created_by` = ".$_SESSION['emp_id']." and ticket_payment.date_added LIKE '$get_today_date %' and ticket_payment.status = 'success' GROUP BY ticket_payment.ticket_id");
    $get_final_value = 0;
    $calculateExtraWordCount = 0;

    foreach($get_wc as $key => $val){

        if(!empty($val['status']))
        {
            $wordCount = 0;
            if($val['extra_charges'] != '')
            {
                $calculateExtraWordCount = ((($val['wordcount'] / ($val['total_value'] - $val['extra_charges']))* $val['extra_charges']));
            }

            $wordCount = $val['wordcount']+$calculateExtraWordCount;

            $get_value = (($val['get_total_val'] / $val['total_value'])* $wordCount);
            $get_final_value += $get_value;
            $calculateExtraWordCount = 0;
        }
    }
    
    $first_day_this_month = date('Y-m-01');
    $get_monthly_date = date('Y-m-d',strtotime("+1 days"));
    $get_wc_cu = execute_query("SELECT ticket_payment.p_id, ticket_payment.ticket_id, ticket_payment.transaction_date, ticket_payment.transaction_id, ticket_payment.accounts_approval_date, ticket_payment.accounts_approval_by, ticket_payment.status, ticket_payment.date_added, ticket_payment.invoice_number, ticket_payment.payment_attached_by, ticket_payment.inr_rate, ticket_payment.total_value, ticket_payment.wordcount, sum(ticket_payment.amount_received) as get_total_val, invoice_master.extra_charges,invoice_master.std_rate FROM ticket_payment join invoice_master on ticket_payment.ticket_id = invoice_master.ticket_id where `created_by` = ".$_SESSION['emp_id']." and (ticket_payment.date_added BETWEEN  '$first_day_this_month' AND '$get_monthly_date') and ticket_payment.status = 'success' GROUP BY ticket_payment.ticket_id");
    $get_Cu_final_value = 0;
    $get_dashboard_value = array();
    $calculateExtraWordCountMonthly = 0;

    foreach($get_wc_cu as $key => $val){

        if(!empty($val['status']))
        {
            $wordCountMonthly = 0;
            if($val['extra_charges'] != '')
            {
                $calculateExtraWordCountMonthly = ((($val['wordcount'] / ($val['total_value'] - $val['extra_charges']))* $val['extra_charges']));

            }
            $wordCountMonthly = $val['wordcount']+round($calculateExtraWordCountMonthly,2);
            $get_cu_value = (($val['get_total_val'] / $val['total_value'])* $wordCountMonthly);
            $get_Cu_final_value += $get_cu_value;
            array_push($get_dashboard_value,$get_Cu_final_value);
            $calculateExtraWordCountMonthly = 0;
        }
    }
    
}

if(($_SESSION['emp_role'] == "team_leader_sales") || ($_SESSION['emp_role'] == "sales_lead")){
    date_default_timezone_set("Asia/Calcutta");
    $today_date = date("Y-m-d");
    $monthStartDate = date('Y-m-01');

    $currentDateForMonthlyPurpose =  date("Y-m-d",strtotime("+1 days")); //increase the current date 1 day

$getAllBdesCountMonthly = execute_query("SELECT ticket_payment.p_id, ticket_payment.ticket_id, ticket_payment.transaction_date, ticket_payment.transaction_id, ticket_payment.accounts_approval_date, ticket_payment.accounts_approval_by, ticket_payment.status, ticket_payment.date_added, ticket_payment.invoice_number, ticket_payment.payment_attached_by, ticket_payment.inr_rate, ticket_payment.total_value, ticket_payment.wordcount,sum(ticket_payment.amount_received) as get_total_val,invoice_master.extra_charges,invoice_master.std_rate FROM ticket_payment join invoice_master on ticket_payment.ticket_id = invoice_master.ticket_id where `created_by` In (".$get_bd_ids_record.") and (ticket_payment.date_added BETWEEN  '$monthStartDate' AND '$currentDateForMonthlyPurpose') GROUP BY ticket_payment.ticket_id");

   $getFinalValueMonthly = 0;

   $calculateExtraWordCountTL = 0;

    if(!empty($getAllBdesCountMonthly))
    {
        $wordCountTL = 0;
        foreach($getAllBdesCountMonthly as $value)
        {
            if($value['extra_charges'] != '')
            {
                $calculateExtraWordCountTL = ((($value['wordcount'] / ($value['total_value'] - $value['extra_charges']))* $value['extra_charges']));
            }


            $wordCountTL = $value['wordcount']+round($calculateExtraWordCountTL,2);


            $getReportMonthly = (($value['get_total_val'] / $value['total_value'])* $wordCountTL);    
            $getFinalValueMonthly += $getReportMonthly;
            $calculateExtraWordCountTL = 0;
        }
    }

   $getAllBdesCount = execute_query("SELECT ticket_payment.p_id, ticket_payment.ticket_id, ticket_payment.transaction_date, ticket_payment.transaction_id, ticket_payment.accounts_approval_date, ticket_payment.accounts_approval_by, ticket_payment.status, ticket_payment.date_added, ticket_payment.invoice_number, ticket_payment.payment_attached_by, ticket_payment.inr_rate, ticket_payment.total_value, ticket_payment.wordcount,sum(ticket_payment.amount_received) as get_total_val,invoice_master.extra_charges,invoice_master.std_rate FROM ticket_payment join invoice_master on ticket_payment.ticket_id = invoice_master.ticket_id where `created_by` In (".$get_bd_ids_record.") and (ticket_payment.date_added LIKE '$today_date %') GROUP BY ticket_payment.ticket_id");

   $getDailyFinalValue = 0;
   $calculateExtraWordCountTLCU = 0;
   if(!empty($getAllBdesCount))
   {
    $wordCountCumTL = 0;
        foreach($getAllBdesCount as $value)
        {

            if($value['extra_charges'] != '')
            {
                $calculateExtraWordCountTLCU = ((($value['wordcount'] / ($value['total_value'] - $value['extra_charges']))* $value['extra_charges']));
            }


            $wordCountCumTL = $value['wordcount']+round($calculateExtraWordCountTLCU,2);

            $getDailyReport = (($value['get_total_val'] / $value['total_value'])* $wordCountCumTL);    
            $getDailyFinalValue += $getDailyReport;
            $calculateExtraWordCountTLCU = 0;
        }
   }

        
}
$first_day_january_month = date('Y-01-01');
$last_day_january_month = date('Y-02-01');
$get_data_january = get_wc($first_day_january_month, $last_day_january_month);
// print_r(date('Y'));
// if((date('Y')) % 4 == 0 ){
//     print_r("a");
// }
// else{
//     print_r("b");
// }
// die("ccc");
$first_day_february_month = date('Y-02-01');
// if ((date('Y')) % 400 == 0)
//         //  print("It is a leap year");
//          $last_day_february_month = date('Y-01-29');  
//       else if ((date('Y')) % 100 == 0)
//         //  print("It is not a leap year");
//          $last_day_february_month = date('Y-01-28');  
//       else if ((date('Y')) % 4 == 0)
//         //  print("It is a leap year");
//          $last_day_february_month = date('Y-01-29');  
//       else
//         //  print("It is not a leap year");
//          $last_day_february_month = date('Y-01-28'); 
         $last_day_february_month = date('Y-03-01');   
$get_data_february = get_wc($first_day_february_month, $last_day_february_month);

$first_day_march_month = date('Y-03-01');
$last_day_march_month = date('Y-04-01');
$get_data_march = get_wc($first_day_march_month, $last_day_march_month);

$first_day_april_month = date('Y-04-01');
// $last_day_april_month = date('Y-04-30');
$last_day_april_month = date('Y-05-01');
$get_data_april = get_wc($first_day_april_month, $last_day_april_month);

$first_day_may_month = date('Y-05-01');
// $last_day_may_month = date('Y-05-31');
$last_day_may_month = date('Y-06-01');
$get_data_may = get_wc($first_day_may_month, $last_day_may_month);

$first_day_june_month = date('Y-06-01');
// $last_day_june_month = date('Y-06-30');
$last_day_june_month = date('Y-07-01');
$get_data_june = get_wc($first_day_june_month, $last_day_june_month);

$first_day_july_month = date('Y-07-01');
// $last_day_july_month = date('Y-07-31');
$last_day_july_month = date('Y-08-01');
$get_data_july = get_wc($first_day_july_month, $last_day_july_month);

$first_day_august_month = date('Y-08-01');
// $last_day_august_month = date('Y-08-31');
$last_day_august_month = date('Y-09-01');
$get_data_august = get_wc($first_day_august_month, $last_day_august_month);

$first_day_september_month = date('Y-09-01');
// $last_day_september_month = date('Y-09-30');
$last_day_september_month = date('Y-10-01');
$get_data_september = get_wc($first_day_september_month, $last_day_september_month);

$first_day_october_month = date('Y-10-01');
// $last_day_october_month = date('Y-10-31');
$last_day_october_month = date('Y-11-01');
$get_data_october = get_wc($first_day_october_month, $last_day_october_month);

$first_day_november_month = date('Y-11-01');
// $last_day_november_month = date('Y-11-30');
$last_day_november_month = date('Y-12-01');
$get_data_november = get_wc($first_day_november_month, $last_day_november_month);

$first_day_december_month = date('Y-12-01');
$last_day_december_month = date('Y-12-31');
$get_data_december = get_wc($first_day_december_month, $last_day_december_month);
?>

    <!-- main header @e -->
    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <?php 
                    if(($_SESSION['emp_role'] == "Sales") ||( $_SESSION['emp_role'] == "team_leader_sales") || (( $_SESSION['emp_role'] == "sales_lead"))){   
                    ?>
                    
                    <div class="row g-gs mb-4">
                        <!-- For Upper 1st Div -->
                            <!-- .col -->
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="nk-ecwg nk-ecwg3">
                                        <div class="card-inner pb-0">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h6 class="title">Today(Self)</h6>
                                                </div>
                                            </div>
                                            <div class="data">
                                                <div class="data-group">
                                                    <div class="amount fw-normal">
                                                        <?php 
                                                        echo (round($get_final_value,2));
                                                        ?></div>
                                                    <div class="info text-end">
                                                        <span style ="font-weight:bold;font-size: 20px;">
                                                        <?php 
                                                            if(!empty($get_target[0]['monthly']))
                                                            {
                                                                echo($get_target[0]['monthly']);
                                                            }
                                                        ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .card-inner -->
                                        <div class="nk-ecwg3-ck"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                            <canvas class="courseSells chartjs-render-monitor" id="totalSells" style="display: block; width: 487px; height: 66px;" width="487" height="66"></canvas>
                                        </div>
                                    </div><!-- .nk-ecwg -->
                                </div><!-- .card -->
                            </div><!-- .col -->
                        <!-- For Upper 1st Div Ends-->
                        <!-- For Upper 2nd Div -->
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="nk-ecwg nk-ecwg3">
                                        <div class="card-inner pb-0">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h6 class="title">Cumulative(Self)</h6>
                                                </div>
                                            </div>
                                            <div class="data">
                                                <div class="data-group">
                                                    <div class="amount fw-normal"><?php echo (round($get_Cu_final_value,2))?></div>
                                                    <div class="info text-end">
                                                        <span style ="font-weight:bold;font-size: 20px;">
                                                            <?php 
                                                            if(!empty($get_target[0]['daily']))
                                                            {
                                                                echo($get_target[0]['daily']);
                                                            }
                                                            ?>
                                                    </span>
                                                </div>
                                                </div>
                                            </div>
                                        </div><!-- .card-inner -->
                                        <div class="nk-ecwg3-ck"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                            <canvas class="courseSells chartjs-render-monitor" id="weeklySells" style="display: block; width: 487px; height: 66px;" width="487" height="66"></canvas>
                                        </div>
                                    </div><!-- .nk-ecwg -->
                                </div><!-- .card -->
                            </div><!-- .col -->
                        <!-- For Upper 2nd Div Ends-->
                    </div>
                    <?php }
                    ?>

                    <?php 
                    if(($_SESSION['emp_role'] == "team_leader_sales") || ( $_SESSION['emp_role'] == "sales_lead"))
                    {
                    ?>
                    <!-- for Team lead section -->
                    <div class="row g-gs mb-4">
                        <!-- For Upper 1st Div -->
                            <!-- .col -->
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="nk-ecwg nk-ecwg3">
                                        <div class="card-inner pb-0">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h6 class="title">Today(Teams)</h6>
                                                </div>
                                            </div>
                                            <div class="data">
                                                <div class="data-group">
                                                    <div class="amount fw-normal"><?php echo (round($getDailyFinalValue,2))?></div>
                                                    <div class="info text-end">
                                                        <span style ="font-weight:bold;font-size: 20px;">
                                                        <?php 
                                                        if($get_target)
                                                        {
                                                            echo($get_target[0]['monthly']);
                                                        }
                                                            ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .card-inner -->
                                        <div class="nk-ecwg3-ck"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                            <canvas class="courseSells chartjs-render-monitor" id="totalSells" style="display: block; width: 487px; height: 66px;" width="487" height="66"></canvas>
                                        </div>
                                    </div><!-- .nk-ecwg -->
                                </div><!-- .card -->
                            </div><!-- .col -->
                        <!-- For Upper 1st Div Ends-->
                        <!-- For Upper 2nd Div -->
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="nk-ecwg nk-ecwg3">
                                        <div class="card-inner pb-0">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h6 class="title">Cumulative(Teams)</h6>
                                                </div>
                                            </div>
                                            <div class="data">
                                                <div class="data-group">
                                                    <div class="amount fw-normal">
                                                    <?php 
                                                    if($getFinalValueMonthly)
                                                    {
                                                        echo (round(($getFinalValueMonthly),2));
                                                    }
                                                    ?></div>
                                                    <div class="info text-end"><span style ="font-weight:bold;font-size: 20px;">
                                                    <?php 
                                                    if(!empty($get_target[0]['daily']))
                                                    {
                                                        echo($get_target[0]['daily']);
                                                    }
                                                    ?></span></div>
                                                </div>
                                            </div>
                                        </div><!-- .card-inner -->
                                        <div class="nk-ecwg3-ck"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                            <canvas class="courseSells chartjs-render-monitor" id="weeklySells" style="display: block; width: 487px; height: 66px;" width="487" height="66"></canvas>
                                        </div>
                                    </div><!-- .nk-ecwg -->
                                </div><!-- .card -->
                            </div><!-- .col -->
                        <!-- For Upper 2nd Div Ends-->
                    </div>
                    <!-- teamlead section end -->
                    <?php } ?>
                    <!-- Monthly Data -->
                    <div class="nk-block nk-block-lg">  
                            <div class="card card-bordered card-preview">
                                <div class="card-inner">
                                    <table class="table table-bordered">
                                        <thead class="table-dark">
                                            <tr>
                                                <th scope="col">January</th>
                                                <th scope="col">February</th>
                                                <th scope="col">March</th>
                                                <th scope="col">April</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?=$get_data_january?></td>
                                                <td><?=$get_data_february?></td>
                                                <td><?=$get_data_march?></td>
                                                <td><?=$get_data_april?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-bordered">
                                        <thead class="table-dark">
                                            <tr>
                                                <th scope="col">May</th>
                                                <th scope="col">June</th>
                                                <th scope="col">July</th>
                                                <th scope="col">August</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?=$get_data_may?></td>
                                                <td><?=$get_data_june?></td>
                                                <td><?=$get_data_july?></td>
                                                <td><?=$get_data_august?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-bordered">
                                        <thead class="table-dark">
                                            <tr>
                                                <th scope="col">September</th>
                                                <th scope="col">October</th>
                                                <th scope="col">November</th>
                                                <th scope="col">December</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?=$get_data_september?></td>
                                                <td><?=$get_data_october?></td>
                                                <td><?=$get_data_november?></td>
                                                <td><?=$get_data_december?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- .card-preview -->
                        </div>
                    </div><!-- .nk-block -->
                    <!-- Data Table -->
                    <div class="nk-block nk-block-lg">  
                    
                            <div class="card card-bordered card-preview">
                                <div class="card-inner">
                                    <table class="nk-tb-list nk-tb-ulist  nowrap table" id="invoice_data" data-auto-responsive="false">
                                    <thead>
                                            <tr>
                                                <th>Ticket</th>
                                                <th>Customer Details</th>					
                                                <th>Date</th>
                                                <th>Status</th>	
                                                <th>Action</th>			
                                            </tr>
                                        </thead>
                                        
                                    </table>
                                </div>
                            </div><!-- .card-preview -->
                        </div>
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
    
<!-- Modal for Add Exchange Data -->
    <div class="modal fade" tabindex="-1" role="dialog" id="exchangeModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h4 class="title">Add Exchange Data</h4>
                    <hr>
                    <div class="row g-3">
                                <form  id="exchangeModalForm" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="action" value="addRecord" id="action">
                                    <input type="hidden" class="form-control" id="exchange_id" name="exchange_id">
                                    <?php foreach($get_currency as $key => $val){ ?>
                                    
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label" for="dissertion"><?php echo($val['currency'])?></label>
                                                <div class="form-control-wrap">
                                                    <input type="text" id="rate_dissertion" name="<?php echo($val['currency'])?>" /> <br />
                                                </div>
                                            </div>
                                    </div>
                                    <?php }?>
                                    <div class="col-12 mt-4" id="button-add">
                                        <button type="submit" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add Currency Exchange</span></button>
                                    </div>
                                </form>            
                </div>
            </div>
        </div>
    </div>
<!-- Modal for Add Exchange Data Ends -->
    <script>
                $(window).on('load', function() {
                    $.ajax({
                        url:"ajax/ajax_action.php",
                        method:"POST",
                        data:{action:'get_exchange_rates'},
                        dataType:"JSON",
                        success:function(data){ 
                                console.log(data);
                                if((data.data1.length == 0) && ((data.data2 == "Admin") || (data.data2 == "Accounts")))
                                {
                                    $('#exchangeModal').modal('show');
                                    $('#action').val('addExchangeValue');
                                }
                        }
                    })
                });
    $(document).ready(function(){	
        var dataRecords = $('#invoice_data').DataTable({
                 "processing": "<span class='fa-stack fa-lg'>\n\
                            <i class='fa fa-spinner fa-spin fa-stack-2x fa-fw'></i>\n\
                       </span>&emsp;Processing ...",
                "ajax":{
                    url:"ajax/ajax_action.php",
                    type:"POST",
                    // data:{action:'data_role'},
                    data:{action:'data_sales'},
                    dataType:"json"
                },
                "columnDefs":[
                    {
                        "targets":[0, 1, 2],
                        "orderable":true,
                    },
                    { "width": "2%", "targets": 0 }
                ],
                "pageLength": 10
        });	
    });
    $("#exchangeModal").on('submit','#exchangeModalForm', function(event){ 
            event.preventDefault();
            $('#save').attr('disabled','disabled');
            $.ajax({
                url:"ajax/ajax_action.php",
                method:"POST",
                data:new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                dataType:"JSON",
                beforeSend: function() {
                    $("#button-add-patment").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){	
                    $("#button-add-patment").html('<button type="submit" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add Cuurency Exchange</span></button>');
                    $('#exchangeModal').modal('toggle');
                  
                }
            })
        });
    </script>