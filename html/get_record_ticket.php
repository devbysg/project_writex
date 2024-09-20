    <!-- main header @e -->
    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Ticket Records</h3>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block nk-block-lg" style="width: 1225px;">
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
                                    </tbody>
                                </table>
                                <!-- New Tickets Table Start -->
                                <table class="nk-tb-list nk-tb-ulist  nowrap table" id="getrecordListing" data-auto-responsive="false">
                                    <thead>
                                        <tr>
                                            <th>Ticket</th>		
                                            <th>Created On</th>			
                                            <th>Cutomer Details</th>
                                            <th>Assigned Date</th>	
                                            <th>Deadline</th>	
                                            <th>Remaining Date</th>	
                                            <th>Ticket Status</th>
                                        </tr>
                                    </thead>
                                </table>
                                <!-- New Tickets Table Ends -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
// var minDate, maxDate;
 
// Custom filtering function which will search data in column four between two values

$(document).ready(function(){	
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
                var dataRecords = $('#getrecordListing').DataTable({
                    "lengthChange": true,
                    "processing": true,
                    "order":[],
                    "ajax":{
                        url:"ajax/ajax_action.php",
                        type:"POST",
                        // data:{action:'data_role'},
                        data:{action:'getlistRecords'},
                        dataType:"json"
                    },
                    // this dom will enable extension option
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
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