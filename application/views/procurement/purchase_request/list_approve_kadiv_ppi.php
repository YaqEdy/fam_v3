<!-- BEGIN PAGE BREADCRUMB --> 

<!-- END PAGE BREADCRUMB -->
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<!-- KONTEN DI SINI YA -->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit  bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-red"></i>
                    <span class="caption-subject font-red sbold uppercase"><?php echo $menu_header; ?></span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="javascript:;" class="fullscreen">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <ul class="nav nav-pills">
                    <li class="linav active" id="linav1">
                        <a href="#tab_2_1" data-toggle="tab" id="navitab_2_1" class="anavitab">
                            Approve PR</a>
                    </li>
                    <li class="linav" id="linav2">
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                            List Pengajuan</a>
                    </li>

                </ul> 
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab_2_1">
                        <div class="panel panel-inverse">
                            <hr class="dotted">
                            <div id="table_approverequest"></div>
                            <hr class="dotted">
                        	<button type="button" class="btn green-jungle" onclick="processApprove()" style="float:right"><i class="fa fa-check"></i> Approve</button>
                        </div>
						<div style="float:right">
						</div>
                    </div>
					<div class="tab-pane fade" id="tab_2_2">
						<div class="row">
							<input type="hidden" class="form-control" name="src" id="src"/>
							<div class="col-md-12" id="table_outReq">
								<div id="table_allrequest"></div>
							</div>
							<!-- end col-12 -->
						</div>
					</div>
                </div>
                <!--end--> 
            </div>

        </div>   
    </div>

</div>


<!-- END PAGE CONTENT-->

<?php $this->load->view('app.min.inc.php'); ?>

<script>
	var RequestID = "";

    jQuery(document).ready(function () {
        loadGridApproveRequest();
        loadGridAllRequest();
    });
	
	function loadGridApproveRequest(){
		// alert();
		$.post('<?= base_url("/procurement/purchase_request/get_list_approve_request");?>', {
		},
		function(data){
			$("#table_approverequest").html(data);
			$('#datatables_approverequest').DataTable({
				"aaSorting": [],
				"columnDefs": [
					{"targets": [-1], "orderable": false, "searchable": false},
					{"targets": [0], "orderable": false},
					{"targets": [1], "orderable": false},
					{"targets": [2], "orderable": false},
					{"targets": [3], "orderable": false},
					{"targets": [4], "orderable": false},
					{"targets": [5], "orderable": false},
					{"targets": [6], "orderable": false},
					{"targets": [7], "orderable": false},
					{"targets": [8], "checkboxes": {"selectRow": true}},
				]
			});
		})
	}	
	function loadGridAllRequest(){
		// alert();
		$.post('<?= base_url("/procurement/purchase_request/get_list_all_request_after");?>', {
			status:'6-1'
		},
		function(data){
			$("#table_allrequest").html(data);
			$('#datatables_allrequest').DataTable({
				"aaSorting": []
			});
		})
	}	

    function processApprove() {
		dataTable = $('#datatables_approverequest').DataTable();
        var rows_selected = dataTable.column(8).checkboxes.selected();
		console.log(RequestID);
        RequestID = RequestID + rows_selected.join(",");
		console.log(RequestID);
		var last_str = RequestID.charAt( RequestID.length-1 );
		console.log(last_str);
		if(last_str !== ','){RequestID = RequestID + ',';}
		console.log(RequestID);
		
		$.post('<?= base_url("/procurement/purchase_request/app_requestproc_checklist");?>', {
			RequestID:RequestID
		},
		function(data){
			alert(data);
			location.reload();
		})
    }

</script>


