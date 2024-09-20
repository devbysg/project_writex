<?php
include_once('../html/constant.php');
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
                                <h3 class="nk-block-title page-title">Get WC Details</h3>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <!-- Div Nav Start -->
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3" role="tablist">
                                <li class="nav-item" role="presentation" onclick="get_jan(this)">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem1" aria-selected="true" role="tab"><em class=""></em><span>January</span></a>
                                </li>
                                <li class="nav-item" role="presentation" onclick="get_feb(this)">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem2" aria-selected="false" role="tab"><em class=""></em><span>February</span></a>
                                </li>
                                <li class="nav-item" role="presentation" onclick="get_mar(this)">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem3" aria-selected="false" role="tab" tabindex="-1"><em class=""></em><span>March</span></a>
                                </li>
                                <li class="nav-item" role="presentation" onclick="get_apr(this)">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem4" aria-selected="false" role="tab" tabindex="-1"><em class=""></em><span>April</span></a>
                                </li>
                                <li class="nav-item" role="presentation" onclick="get_may(this)">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem5" aria-selected="false" role="tab" tabindex="-1"><em class=""></em><span>May</span></a>
                                </li>
                                <li class="nav-item" role="presentation" onclick="get_jun(this)">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem6" aria-selected="false" role="tab" tabindex="-1"><em class=""></em><span>June</span></a>
                                </li>
                                <li class="nav-item" role="presentation" onclick="get_jul(this)">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem7" aria-selected="false" role="tab" tabindex="-1"><em class=""></em><span>July</span></a>
                                </li>
                                <li class="nav-item" role="presentation" onclick="get_aug(this)">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem8" aria-selected="false" role="tab" tabindex="-1"><em class=""></em><span>August</span></a>
                                </li>
                                <li class="nav-item" role="presentation" onclick="get_sep(this)">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem9" aria-selected="false" role="tab" tabindex="-1"><em class=""></em><span>September</span></a>
                                </li>
                                <li class="nav-item" role="presentation" onclick="get_oct(this)">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem10" aria-selected="false" role="tab" tabindex="-1"><em class=""></em><span>October</span></a>
                                </li>
                                <li class="nav-item" role="presentation" onclick="get_nov(this)">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem11" aria-selected="false" role="tab" tabindex="-1"><em class=""></em><span>November</span></a>
                                </li>
                                <li class="nav-item" role="presentation" onclick="get_dec(this)">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem12" aria-selected="false" role="tab" tabindex="-1"><em class=""></em><span>December</span></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                            <div class="tab-pane active show" id="tabItem1" role="tabpanel">
                                    <!-- New Tickets Table Start -->
                                    <table class="nk-tb-list nk-tb-ulist  nowrap table" id="rec_jan" data-auto-responsive="false">
                                        <thead>
                                            <tr>
                                                <th>Emp ID</th>
                                                <th>Name</th>
                                                <th>Role</th>
                                                <th>Payment ID</th>
                                                <th>Ticket ID</th>
                                                <th>Cumulative Value</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <!-- New Tickets Table Ends -->
                                </div>
                            <div class="tab-pane" id="tabItem2" role="tabpanel">
                                    <!-- New Tickets Table Start -->
                                    <table class="nk-tb-list nk-tb-ulist  nowrap table" id="rec_feb" data-auto-responsive="false">
                                        <thead>
                                            <tr>
                                                <th>Emp ID</th>
                                                <th>Name</th>
                                                <th>Role</th>
                                                <th>Payment ID</th>
                                                <th>Ticket ID</th>
                                                <th>Cumulative Value</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <!-- New Tickets Table Ends -->
                                </div>
                                <div class="tab-pane" id="tabItem3" role="tabpanel">
                                    <!-- table content starts -->
                                                <table class="nk-tb-list nk-tb-ulist  nowrap table" id="rec_mar" data-auto-responsive="false">
                                                    <thead>
                                                        <tr>
                                                            <th>Emp ID</th>
                                                            <th>Name</th>
                                                            <th>Role</th>
                                                            <th>Payment ID</th>
                                                            <th>Ticket ID</th>
                                                            <th>Cumulative Value</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                    <!-- table content ends -->
                                </div>
                                <div class="tab-pane" id="tabItem4" role="tabpanel">
                                    <!-- table content starts -->
                                                <table class="nk-tb-list nk-tb-ulist  nowrap table" id="rec_apr" data-auto-responsive="false">
                                                    <thead>
                                                        <tr>
                                                            <th>Emp ID</th>
                                                            <th>Name</th>
                                                            <th>Role</th>
                                                            <th>Payment ID</th>
                                                            <th>Ticket ID</th>
                                                            <th>Cumulative Value</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                    <!-- table content ends -->
                                </div>
                                <div class="tab-pane" id="tabItem5" role="tabpanel">
                                    <!-- table content starts -->
                                                <table class="nk-tb-list nk-tb-ulist  nowrap table" id="rec_may" data-auto-responsive="false">
                                                    <thead>
                                                        <tr>
                                                            <th>Emp ID</th>
                                                            <th>Name</th>
                                                            <th>Role</th>
                                                            <th>Payment ID</th>
                                                            <th>Ticket ID</th>
                                                            <th>Cumulative Value</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                    <!-- table content ends -->
                                </div>
                                <div class="tab-pane" id="tabItem6" role="tabpanel">
                                    <!-- table content starts -->
                                                <table class="nk-tb-list nk-tb-ulist  nowrap table" id="rec_jun" data-auto-responsive="false">
                                                    <thead>
                                                        <tr>
                                                            <th>Emp ID</th>
                                                            <th>Name</th>
                                                            <th>Role</th>
                                                            <th>Payment ID</th>
                                                            <th>Ticket ID</th>
                                                            <th>Cumulative Value</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                    <!-- table content ends -->
                                </div>
                                <div class="tab-pane" id="tabItem7" role="tabpanel">
                                    <!-- table content starts -->
                                                <table class="nk-tb-list nk-tb-ulist  nowrap table" id="rec_jul" data-auto-responsive="false">
                                                    <thead>
                                                        <tr>
                                                            <th>Emp ID</th>
                                                            <th>Name</th>
                                                            <th>Role</th>
                                                            <th>Payment ID</th>
                                                            <th>Ticket ID</th>
                                                            <th>Cumulative Value</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                    <!-- table content ends -->
                                </div>
                                <div class="tab-pane" id="tabItem8" role="tabpanel">
                                    <!-- table content starts -->
                                                <table class="nk-tb-list nk-tb-ulist  nowrap table" id="rec_aug" data-auto-responsive="false">
                                                    <thead>
                                                        <tr>
                                                            <th>Emp ID</th>
                                                            <th>Name</th>
                                                            <th>Role</th>
                                                            <th>Payment ID</th>
                                                            <th>Ticket ID</th>
                                                            <th>Cumulative Value</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                    <!-- table content ends -->
                                </div>
                                <div class="tab-pane" id="tabItem9" role="tabpanel">
                                    <!-- table content starts -->
                                                <table class="nk-tb-list nk-tb-ulist  nowrap table" id="rec_sep" data-auto-responsive="false">
                                                    <thead>
                                                        <tr>
                                                            <th>Emp ID</th>
                                                            <th>Name</th>
                                                            <th>Role</th>
                                                            <th>Payment ID</th>
                                                            <th>Ticket ID</th>
                                                            <th>Cumulative Value</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                    <!-- table content ends -->
                                </div>
                                <div class="tab-pane" id="tabItem10" role="tabpanel">
                                    <!-- table content starts -->
                                                <table class="nk-tb-list nk-tb-ulist  nowrap table" id="rec_oct" data-auto-responsive="false">
                                                    <thead>
                                                        <tr>
                                                            <th>Emp ID</th>
                                                            <th>Name</th>
                                                            <th>Role</th>
                                                            <th>Payment ID</th>
                                                            <th>Ticket ID</th>
                                                            <th>Cumulative Value</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                    <!-- table content ends -->
                                </div>
                                <div class="tab-pane" id="tabItem11" role="tabpanel">
                                    <!-- table content starts -->
                                                <table class="nk-tb-list nk-tb-ulist  nowrap table" id="rec_nov" data-auto-responsive="false">
                                                    <thead>
                                                        <tr>
                                                            <th>Emp ID</th>
                                                            <th>Name</th>
                                                            <th>Role</th>
                                                            <th>Payment ID</th>
                                                            <th>Ticket ID</th>
                                                            <th>Cumulative Value</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                    <!-- table content ends -->
                                </div>
                                <div class="tab-pane" id="tabItem12" role="tabpanel">
                                    <!-- table content starts -->
                                                <table class="nk-tb-list nk-tb-ulist  nowrap table" id="rec_dec" data-auto-responsive="false">
                                                    <thead>
                                                        <tr>
                                                            <th>Emp ID</th>
                                                            <th>Name</th>
                                                            <th>Role</th>
                                                            <th>Payment ID</th>
                                                            <th>Ticket ID</th>
                                                            <th>Cumulative Value</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                    <!-- table content ends -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Div Nav Ends -->
                </div>
            </div>
        </div>
    </div>

<script>
$(document).ready(function () {
    get_jan();
});
function get_jan(){ 

        if ( $.fn.DataTable.isDataTable('#rec_jan') ) {
            $('#rec_jan').DataTable().destroy();
            }

        $('#rec_jan tbody').empty();

        var dataRecords = $('#rec_jan').DataTable({
            "lengthChange": true,
            "processing": true,
            "order":[],
            "ajax":{
                url:"ajax/ajax_action.php",
                type:"POST",
                data:{action:'get_wc_data', mon: 'jan'},
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
}
function get_feb(){ 

        if ( $.fn.DataTable.isDataTable('#rec_feb') ) {
            $('#rec_feb').DataTable().destroy();
            }

        $('#rec_feb tbody').empty();

        var dataRecords = $('#rec_feb').DataTable({
            "lengthChange": true,
            "processing": true,
            "order":[],
            "ajax":{
                url:"ajax/ajax_action.php",
                type:"POST",
                data:{action:'get_wc_data', mon: 'feb'},
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
    }
function get_mar(){ 

if ( $.fn.DataTable.isDataTable('#rec_mar') ) {
    $('#rec_mar').DataTable().destroy();
    }

$('#rec_mar tbody').empty();

var dataRecords = $('#rec_mar').DataTable({
    "lengthChange": true,
    "processing": true,
    "order":[],
    "ajax":{
        url:"ajax/ajax_action.php",
        type:"POST",
        data:{action:'get_wc_data', mon: 'mar'},
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
}
function get_apr(){ 

if ( $.fn.DataTable.isDataTable('#rec_apr') ) {
    $('#rec_apr').DataTable().destroy();
    }

$('#rec_apr tbody').empty();

var dataRecords = $('#rec_apr').DataTable({
    "lengthChange": true,
    "processing": true,
    "order":[],
    "ajax":{
        url:"ajax/ajax_action.php",
        type:"POST",
        data:{action:'get_wc_data', mon: 'apr'},
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
}function get_may(){ 

if ( $.fn.DataTable.isDataTable('#rec_may') ) {
    $('#rec_may').DataTable().destroy();
    }

$('#rec_may tbody').empty();

var dataRecords = $('#rec_may').DataTable({
    "lengthChange": true,
    "processing": true,
    "order":[],
    "ajax":{
        url:"ajax/ajax_action.php",
        type:"POST",
        data:{action:'get_wc_data', mon: 'may'},
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
}function get_jun(){ 

if ( $.fn.DataTable.isDataTable('#rec_jun') ) {
    $('#rec_jun').DataTable().destroy();
    }

$('#rec_jun tbody').empty();

var dataRecords = $('#rec_jun').DataTable({
    "lengthChange": true,
    "processing": true,
    "order":[],
    "ajax":{
        url:"ajax/ajax_action.php",
        type:"POST",
        data:{action:'get_wc_data', mon: 'jun'},
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
}function get_jul(){ 

if ( $.fn.DataTable.isDataTable('#rec_jul') ) {
    $('#rec_jul').DataTable().destroy();
    }

$('#rec_jul tbody').empty();

var dataRecords = $('#rec_jul').DataTable({
    "lengthChange": true,
    "processing": true,
    "order":[],
    "ajax":{
        url:"ajax/ajax_action.php",
        type:"POST",
        data:{action:'get_wc_data', mon: 'jul'},
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
}function get_aug(){ 

if ( $.fn.DataTable.isDataTable('#rec_aug') ) {
    $('#rec_aug').DataTable().destroy();
    }

$('#rec_aug tbody').empty();

var dataRecords = $('#rec_aug').DataTable({
    "lengthChange": true,
    "processing": true,
    "order":[],
    "ajax":{
        url:"ajax/ajax_action.php",
        type:"POST",
        data:{action:'get_wc_data', mon: 'aug'},
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
}function get_sep(){ 

if ( $.fn.DataTable.isDataTable('#rec_sep') ) {
    $('#rec_sep').DataTable().destroy();
    }

$('#rec_sep tbody').empty();

var dataRecords = $('#rec_sep').DataTable({
    "lengthChange": true,
    "processing": true,
    "order":[],
    "ajax":{
        url:"ajax/ajax_action.php",
        type:"POST",
        data:{action:'get_wc_data', mon: 'sep'},
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
}function get_oct(){ 

if ( $.fn.DataTable.isDataTable('#rec_oct') ) {
    $('#rec_oct').DataTable().destroy();
    }

$('#rec_oct tbody').empty();

var dataRecords = $('#rec_oct').DataTable({
    "lengthChange": true,
    "processing": true,
    "order":[],
    "ajax":{
        url:"ajax/ajax_action.php",
        type:"POST",
        data:{action:'get_wc_data', mon: 'oct'},
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
}function get_nov(){ 

if ( $.fn.DataTable.isDataTable('#rec_nov') ) {
    $('#rec_nov').DataTable().destroy();
    }

$('#rec_nov tbody').empty();

var dataRecords = $('#rec_nov').DataTable({
    "lengthChange": true,
    "processing": true,
    "order":[],
    "ajax":{
        url:"ajax/ajax_action.php",
        type:"POST",
        data:{action:'get_wc_data', mon: 'nov'},
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
}function get_dec(){ 

if ( $.fn.DataTable.isDataTable('#rec_dec') ) {
    $('#rec_dec').DataTable().destroy();
    }

$('#rec_dec tbody').empty();

var dataRecords = $('#rec_dec').DataTable({
    "lengthChange": true,
    "processing": true,
    "order":[],
    "ajax":{
        url:"ajax/ajax_action.php",
        type:"POST",
        data:{action:'get_wc_data', mon: 'dec'},
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
}

</script>