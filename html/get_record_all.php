    <!-- main header @e -->
    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner" style="width: 2331px;">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">All Records</h3>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <!-- Data Table -->
                    <div class="nk-block nk-block-lg">
                                        
                                        <div class="card card-bordered card-preview">
                                            <div class="card-inner">

                                                <table cellspacing="5" cellpadding="5" border="0">
                                                    <tbody><tr>
                                                        <td>Minimum date:</td>
                                                        <td><input type="text" id="min" name="min"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Maximum date:</td>
                                                        <td><input type="text" id="max" name="max"></td>
                                                    </tr>
                                                </tbody></table>

                                                <table class="nk-tb-list nk-tb-ulist  nowrap table" id="rec_all" data-auto-responsive="false">
                                                    <thead>
                                                        <tr>
                                                            <th>p_id</th>
                                                            <th>ticket_id</th>
                                                            <th>transaction_date</th>		
                                                            <th>transaction_id</th>			
                                                            <th>accounts_approval_date</th>
                                                            <th>accounts_approval_by</th>
                                                            <th>status</th>
                                                            <th>date_added</th>
                                                            <th>payment_attached_by</th>
                                                            <th>inr_rate</th>
                                                            <th>total_value</th>
                                                            <th>wordcount</th>
                                                            <th>get_total_val</th>
                                                            <th>extra_charges</th>
                                                            <th>std_rate</th>
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

<script>
$(document).ready(function(){	
        $.fn.dataTable.ext.search.push( 
        function( settings, data, dataIndex ) {
            var min = $('#min').datepicker("getDate");
            var max = $('#max').datepicker("getDate");
            var date = new Date( data[7] );

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
    
            var dataRecords = $('#rec_all').DataTable({
                "lengthChange": true,
                "processing": true,
                "order":[],
                "ajax":{
                    url:"ajax/ajax_action.php",
                    type:"POST",
                    data:{action:'get_rec_all'},
                    dataType:"json"
                },
                // this dom will enable extension option
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel'
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
    });  

</script>