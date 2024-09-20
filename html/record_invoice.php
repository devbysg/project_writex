<?php
// $country_desc = select_all("country_cost_master");
// $cat_desc = select_query("category_master",array("category_id","category_name"),array());

?>
    <!-- main header @e -->
    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Invoice Details</h3>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->                   
                    <!-- Data Table -->
                    <div class="nk-block nk-block-lg">
                                        
                                        <div class="card card-bordered card-preview">
                                            <div class="card-inner">
                                            <table cellspacing="5" cellpadding="5" border="0">
                                                    <tbody><tr>
                                                        <td>From:</td>
                                                        <td><input type="text" id="min" name="min"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>To:</td>
                                                        <td><input type="text" id="max" name="max"></td>
                                                    </tr>
                                                </tbody></table>
                                                <table class="nk-tb-list nk-tb-ulist  nowrap table" id="data_invoice" data-auto-responsive="false">
                                                <thead>
                                                        <tr>
                                                            <th>Invoice Number</th>
                                                            <th>Invoice Date</th>
                                                            <th>Customer Name</th>
                                                            <th>Ticket Amount</th>
                                                            <th>Currenecy</th>
                                                            <th>Convert to INR</th>
                                                            <th>Word Count</th>
                                                            <th>Created By</th>
                                                        </tr>
                                                </thead>
                                                    
                                                </table>
                                            </div>
                                        </div><!-- .card-preview -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>

<script>

        $(document).ready(function(){	
            // datatable();
            $.fn.dataTable.ext.search.push( 
        function( settings, data, dataIndex ) {
            // alert('dtest');
            var min = $('#min').datepicker("getDate");
            // alert(min);
            var max = $('#max').datepicker("getDate");
            var date = new Date( data[1] );

            if (
                ( min === null && max === null ) ||
                ( min === null && date <= max ) ||
                ( min <= date   && max === null ) ||
                ( min <= date   && date <= max )
            ) {
                return true;
            }
            return false;
        }
            );

            $('#min, #max').on('change', function () { 
                dataRecords.draw();
            });
        
        // function datatable(){ 
            // alert("nnn");
            var dataRecords = $('#data_invoice').DataTable({
                "lengthChange": true,
                "processing": true,
                "order":[],
                "ajax":{
                    url:"ajax/ajax_action.php",
                    type:"POST",
                    data:{action:'get_data_invoice'},
                    dataType:"json"
                },
                // this dom will enable extension option
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel'
                ],
                "columnDefs":[
                    {
                        "targets":[0, 1, 2],
                        "orderable":true,
                    },
                    { "width": "2%", "targets": 0 }
                ],
                "pageLength": 10
            });	
        // }
    }); 
    </script>