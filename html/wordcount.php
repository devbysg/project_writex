
    <!-- main header @e -->
    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Word Count</h3>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt">
                                                <a href="#" data-target="addCountry" class="toggle btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                                <a href="#" data-target="addCountry" id="addCountries" class="toggle btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add Word Count</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <!-- Data Table -->
                    <div class="nk-block nk-block-lg">
                                        
                                        <div class="card card-bordered card-preview">
                                            <div class="card-inner">
                                                <table class="nk-tb-list nk-tb-ulist nowrap table" id="Wordcountlistings" data-auto-responsive="false">
                                                <thead>
                                                        <tr>
                                                            <!-- <th><input type="checkbox" class="custom-control-input" id="emp_data"></th> -->
                                                            <th>Country ID</th>
                                                            <th>Country Name</th>					
                                                            <th>Currency</th>
                                                            <th>Rate</th>
                                                            <th>Mobile Extension</th>	
                                                            <th>Dissertion Rate</th>				
                                                            <th>Action</th>	
                                                        </tr>
                                                    </thead>
                                                    
                                                </table>
                                            </div>
                                        </div><!-- .card-preview -->
                                    </div>
                    </div><!-- .nk-block -->
                    <div class="nk-add-product toggle-slide toggle-slide-right" data-content="addCountry" data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
                        <!-- Modal -->
                        <div class="nk-block" id="recordModal">
                            <div class="row g-3">
                            <form action="" id="countryform" method="POST">
                                <div class="row g-3">
                                        <!-- Pass this hidden tag to prevent error form submit -->
                                <input type="hidden" name="action" value="" id="action">
                                <input type="hidden" class="form-control" id="country_id" name="country_id">
                                    <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="country_id">Country ID</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="country_id" id="country_id">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                
                                                <div class="form-control-wrap">
                                                    <input type="hidden" class="form-control" name="hidden" id="action">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="country_name">Country Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="name" id="name_country">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="extension-code">Extension Code</label>
                                                <div class="form-control-wrap">
                                                    <input type="number" class="form-control" name="country_code" id="code_extension">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="std_rate">Rate</label>
                                                <div class="form-control-wrap">
                                                    <input type="number" class="form-control" name="rate" id="rate">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="currency">Currency</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="currency" id="currency">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label" for="word-count">Word Count</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" value="1000" name="word_count" class="form-control" id="word_count">
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label" for="Dissertion-rate">Dissertion Rate</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="rate_dissertion" class="form-control" id="rate_dissertion">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add New</span></button>
                                        </div>
                                    </div>
                            </form>
                            </div><!-- Modal End -->
                        </div><!-- .nk-block -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="modal fade" tabindex="-1" role="dialog" id="modalTabs">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h4 class="title">Update Profile</h4>
                    <ul class="nk-nav nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#tabItem1">Tab Title</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tabItem2">Another Title</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Edit Exchange Rate Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="UpdateExchange">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md text-center3">
                    <h4 class="title">Edit Exchange Rate</h4>
                    <hr>
                    <form action="" id="UpdateExchangeForm" method="POST">
                            <div class="row g-3">
                                    <!-- Pass this hidden tag to prevent error form submit -->
                            <!-- <input type="hidden" name="action" value="" id="action">
                            <input type="hidden" class="form-control" id="edit_exchange_rate" name="exchange_rate"> -->
                            <!-- <input type="hidden" name="exchange_rate" value="" class="form-control" id="edit_exchange_rate"> -->
                                    <input type="hidden" name="action" value="" id="editExchange">
                                    <!-- <input type="hidden" class="form-control edit_country_id" id="edit_country_id" name="emp_id"> -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="product-title">Country ID</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control edit_country_id" name="country_id" id="edit_country_id" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-12">
                                        <div class="form-group">
                                            
                                            <div class="form-control-wrap">
                                                <input type="hidden" class="form-control" name="hidden" id="action">
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="country_name">Country Name</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" name="name" id="edit_name_country">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="extension-code">Extension Code</label>
                                            <div class="form-control-wrap">
                                                <input type="number" class="form-control" name="country_code" id="edit_code_extension">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="std_rate">Rate</label>
                                            <div class="form-control-wrap">
                                                <input type="number" class="form-control" name="rate" id="edit_rate">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="currency">Currency</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" name="currency" id="edit_currency">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="word-count">Word Count</label>
                                            <div class="form-control-wrap">
                                                <input type="text" name="word_count" class="form-control" id="edit_word_count">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="Dissertion-rate">Dissertion Rate</label>
                                            <div class="form-control-wrap">
                                                <input type="text" name="rate_dissertion" class="form-control" id="edit_rate_dissertion">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" id="button-edit-exchange" class="btn btn-primary"><em class="icon ni ni-pen"></em><span>Update Record</span></button>
                                    </div>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script>
        $(document).ready(function(){	
            datatable();
        });  
        function datatable(){ 
            if ( $.fn.DataTable.isDataTable('#Wordcountlistings') ) {
                $('#Wordcountlistings').DataTable().destroy();
                }

                $('#Wordcountlistings tbody').empty();
                var dataRecords = $('#Wordcountlistings').DataTable({
                "lengthChange": true,
                "processing": true,
                "order":[],
                "ajax":{
                    url:"ajax/ajax_action.php",
                    type:"POST",
                    // data:{action:'data_role'},
                    data:{action:'listWordCount'},
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
        }
        $('#addCountries').click(function(){
            $('#ticket_modal_header').html("<i class='fa fa-plus'></i> New Employee");
            $('#action').val('addCountry');
	    });
        $("#recordModal").on('submit','#countryform', function(event){ 
            event.preventDefault();
            $('#save').attr('disabled','disabled');
            $.ajax({
                url:"ajax/ajax_action3.php",
                method:"POST",
                data:new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function() {
                    $("#button-add").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){				
                    $('#insert_emp')[0].reset();
                    $(".nk-add-product").removeClass("content-active");
                    $("body").removeClass("toggle-shown");
                    $("#button-add").html('<button type="submit" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add New</span></button>');
                    // location.reload();
                }
            })
        }); 
        function edit_rate_chart(el){
            var rate_ex = $(el).data('id');
            $.ajax({
                url: "ajax/ajax_action.php",
                method: "POST",
                data:{action: 'getExchangeDetails',
                    get_id_country: rate_ex},
                dataType: "json",
                success: function(data){
                    $("#UpdateExchange").trigger( "reset" );               
                    $('#UpdateExchange').modal('show'); 
                    // console.log(data);
                    // console.log(data.data[0]);
                    $('.edit_country_id').val(data.data[0]['country_id']);
                    $('#edit_name_country').val(data.data[0]['country_name']);
                    $('#edit_code_extension').val(data.data[0]['country_mobile_extention']);
                    $('#edit_rate').val(data.data[0]['rate']);
                    $('#edit_currency').val(data.data[0]['currency']);
                    $('#edit_word_count').val(data.data[0]['word_limit']);
                    $('#edit_rate_dissertion').val(data.data[0]['dissertation_rate']);
                    $('#editExchange').val('updateExchangeRate');
                }
                
            });
        }
    // Update Exchange Rate Submit Button
    $("#UpdateExchange").on('submit','#UpdateExchangeForm', function(event){ 
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
            $("#button-edit-exchange").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
        },
        success:function(data){	
            $("#button-edit-exchange").html('<button type="submit" id="button-edit-exchange" class="btn btn-primary"><em class="icon ni ni-pen"></em><span>Update Record</span></button>');
            $('#UpdateExchange').modal('toggle');
            datatable();
        }
    })
});
    </script>