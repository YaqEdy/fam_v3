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
                <div class="tab-content">
					<h5 class="sbold uppercase"><?=$approve_pr->status_request?></h5>
                        <div class="panel panel-inverse">
                            <hr class="dotted">
                            <div class="col-md-12">
								<div class="col-md-6">
									<div class="col-sm-12">
                                        <label class="control-label col-sm-4">Nomor PR </label>
                                        <div class="col-sm-7">
                                            <?=$approve_pr->RequestID?>
                                        </div>
                                    </div>
									<div class="col-sm-12">
                                        <label class="control-label col-sm-4">Request Type </label>
                                        <div class="col-sm-7">
                                            <?=$approve_pr->ReqTypeName?>
                                        </div>
                                    </div>
									<div class="col-sm-12">
                                        <label class="control-label col-sm-4">Request Category </label>
                                        <div class="col-sm-7">
                                            <?=$approve_pr->ReqCategoryName?>
                                        </div>
                                    </div>
									<div class="col-sm-12">
                                        <label class="control-label col-sm-4">Request Project </label>
                                        <div class="col-sm-7">
                                            <?=$approve_pr->ProjectName?>
                                        </div>
                                    </div>
								</div>
								<div class="col-md-6">
									<div class="col-sm-12">
                                        <label class="control-label col-sm-4">Request Date </label>
                                        <div class="col-sm-7">
                                            <?=date("d-m-Y", strtotime($approve_pr->CreateDate))?>
                                        </div>
                                    </div>
									<div class="col-sm-12">
                                        <label class="control-label col-sm-4">Jenis Request </label>
                                        <div class="col-sm-7">
                                            <?=$approve_pr->JenisPR?>
                                        </div>
                                    </div>
									<div class="col-sm-12">
                                        <label class="control-label col-sm-4">Branch </label>
                                        <div class="col-sm-7">
                                            <?=$approve_pr->BRANCH_DESC?>
                                        </div>
                                    </div>
									<div class="col-sm-12">
                                        <label class="control-label col-sm-4">Division </label>
                                        <div class="col-sm-7">
                                            <?=$approve_pr->DIV_DESC?>
                                        </div>
                                    </div>
								</div>
                            </div>
						</div>
						<div class="panel panel-inverse">
							<div class="col-md-12">
								<table class="table table-striped table-bordered table-hover" id="item_table">
								<thead>
									<tr align="center">
										<th>Item Name</th>
										<th>Quantity</th>
										<th>HPS</th>
										<th>Sub Total</th>
									</tr>
								</thead>
								<tbody>
									<?php
									foreach($item as $itm){
										echo '
									<tr>
										<td>'.$itm['ItemName'].'</td>
										<td>'.$itm['Qty'].'</td>
										<td align="right">Rp. '.number_format($itm['HargaHPS'],2,',','.').'</td>
										<td align="right">Rp. '.number_format($itm['harga_sub_total'],2,',','.').'</td>
									</tr>
										';
									}
									?>
									<tr>
										<td></td>
										<td></td>
										<td><b>Total</b></td>
										<td align="right"><b>Rp. <?=number_format($approve_pr->BudgetUsed,2,',','.')?></b></td>
									</tr>
								</tbody>
								</table>
							</div>	
						</div>
						<div class="panel panel-inverse">
							<hr class="dotted">
                            <div class="col-md-12">
                                            <table class="table table-striped table-bordered table-hover text_kanan" id="table_gridItemProcess">
                                                <thead>
                                                    <tr>
                                                        <th>NO</th>     
                                                        <th>Name</th>
                                                        <th>Wilayah</th>
                                                        <th>Status WP</th>
                                                        <th>Barang & Jasa</th>
                                                        <th>Harga Penawaran</th>

                                                    </tr>
                                                </thead>
                                                <tbody>


                                                </tbody>
                                                <tfoot>

                                                </tfoot>
                                            </table>
							</div>
						</div>
						<div class="panel panel-inverse">
							<hr class="dotted">
							
							<div class="col-md-12" style="margin-bottom:2em">
								<div class="col-md-6">
									<div class="col-sm-12">
                                        <label class="control-label col-sm-4">Jenis Pengadaan </label>
                                        <div class="col-sm-7">
                                            <?=$approve_pr->JenisPengadaan?>
                                        </div>
                                    </div>
									<div class="col-sm-12">
                                        <label class="control-label col-sm-4">Vendor Pemenang </label>
                                        <div class="col-sm-7">
                                            <?=$approve_pr->VendorPemenang?>
                                        </div>
                                    </div>
								</div>
								<div class="col-md-6">
									<div class="col-sm-12">
                                        <label class="control-label col-sm-4">Harga Vendor </label>
                                        <div class="col-sm-7">
                                            <?=$approve_pr->HargaVendor?>
                                        </div>
                                    </div>
									<div class="col-sm-12">
                                        <label class="control-label col-sm-4">PPN </label>
                                        <div class="col-sm-7">
                                            <?=$approve_pr->PPN?> %
                                        </div>
                                    </div>
								</div>
                            </div>
						</div>	
						<div class="panel panel-inverse">
							<hr class="dotted">
                            <hr class="dotted">
							
                        </div>

                    
					
                </div>
            </div>
			
			<hr class="dotted">
			<hr class="dotted">
			<hr class="dotted">
			<hr class="dotted">
			<i style="margin:2em;"></i>
			
			<div class="portlet-body">
                <div class="tab-content">
					<h5 class="sbold uppercase">Check Anggaran</h5>
                        <div class="panel panel-inverse">
                            <hr class="dotted">
                            <div class="col-md-12">
								<div class="col-md-6">
									<div class="col-sm-12">
                                        <label class="control-label col-sm-4">Sisa Anggaran </label>
                                        <div class="col-sm-7">
                                            <?=$approve_pr->RequestID?>
                                        </div>
                                    </div>
								</div>
								<div class="col-md-6">
									<div class="col-sm-12">
                                        <label class="control-label col-sm-4">Anggaran Terpakai </label>
                                        <div class="col-sm-7">
                                            <?=date("d-m-Y", strtotime($approve_pr->CreateDate))?>
                                        </div>
                                    </div>
								</div>
                            </div>
						</div>
						<div class="panel panel-inverse">
							<form class="" id="fm_apppr" enctype="multipart/form-data" method="POST">
                            	<div class="validator-form form-horizontal" style="margin-top:2em">
                                    <div class="form-group">
                                        <div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-sm-3">Entity PNM </label>
												<div class="col-md-9">
													<input type="text" class="form-control" id="EntityPNM" name="EntityPNM">
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-sm-3">Main Account </label>
												<div class="col-md-9">
													<input type="text" class="form-control" id="MainAccount" name="MainAccount">
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-sm-3">Sub Account </label>
												<div class="col-md-9">
													<input type="text" class="form-control" id="SubAccount" name="SubAccount">
												</div>
											</div>
										</div>
                                        <div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-sm-3">LOB </label>
												<div class="col-md-9">
													<input type="text" class="form-control" id="LOB" name="LOB">
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-sm-3">Division </label>
												<div class="col-md-9">
													<input type="text" class="form-control" id="Division_form" name="Division_form">
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-sm-3">Bisnis Type </label>
												<div class="col-md-9">
													<input type="text" class="form-control" id="BisnisType" name="BisnisType">
												</div>
											</div>
										</div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">COA </label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" id="COA" name="COA">
										</div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Anggaran </label>
                                        <div class="col-md-7">
                                            <select id="Anggaran" name="Anggaran" class="form-control">
												<option value="Dalam Anggaran">Dalam Anggaran</option>
												<option value="Diluar Anggaran">Diluar Anggaran</option>
											</select>
										</div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Budget Disetujui </label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" id="BudgetDisetujui" name="BudgetDisetujui">
										</div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Notes </label>
                                        <div class="col-md-7">
                                            <textarea id="notes" name="notes" class="form-control">
											</textarea>
										</div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Action </label>
                                        <div class="col-md-7">
                                            <select id="action" name="action" class="form-control">
												<option value="approve">Approve</option>
												<option value="revisi">Revisi</option>
												<option value="reject">Reject</option>
											</select>
										</div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
										</div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
											
										</div>
                                        <div class="col-sm-7">
                                            <div id="prosessloading"/>
											<input type="hidden" id="RequestID" name="RequestID" value="<?=$approve_pr->RequestID?>">
											<input type="hidden" id="flow_id" name="flow_id" value="<?=$approve_pr->flow_id?>">
											<input type="hidden" id="status" name="status" value="<?=$approve_pr->status?>">
											<input type="hidden" id="pic_po" name="pic_po" value="<?=$approve_pr->PIC_PO?>">
											<!--
											<button type="submit" class="btn btn-primary" id="appreq" name="appreq" value="Submit" >Submit</button>       
                                        	-->
											<a class="btn btn-primary" onclick="submit_app()">Submit</a>       
                                        </div>
                                    </div>
                                </div>
							</form>
                        </div>

                    
					
                </div>
            </div>

        </div>   
    </div>

</div>

<?php $this->load->view('app.min.inc.php'); ?>

<script>
	$(document).ready( function () {
		$('#item_table').DataTable({
			"aaSorting": [],
			"searching": false,
			"paging": false,
			"info": false
		});
	} );

	function go_to_list(){
		$(location).attr("href","<?php echo base_url("/procurement/purchase_request/list_request_anggaran")?>");
	}

    function submit_app() { 
		var action = document.getElementById('action').value;
		var RequestID = document.getElementById('RequestID').value;
		var flow_id = document.getElementById('flow_id').value;
		var status = document.getElementById('status').value;
		var notes = document.getElementById('notes').value;
		var pic_po = document.getElementById('pic_po').value;
		var EntityPNM = document.getElementById('EntityPNM').value;
		var MainAccount = document.getElementById('MainAccount').value;
		var SubAccount = document.getElementById('SubAccount').value;
		var LOB = document.getElementById('LOB').value;
		var Division_form = document.getElementById('Division_form').value;
		var BisnisType = document.getElementById('BisnisType').value;
		var COA = document.getElementById('COA').value;
		var Anggaran = document.getElementById('Anggaran').value;
		var BudgetDisetujui = document.getElementById('BudgetDisetujui').value;
        $.post('<?= base_url("/procurement/purchase_request/app_requestproc_anggaran");?>', {
			action:action,
			RequestID:RequestID,
			flow_id:flow_id,
			status:status,
			notes:notes,
			pic_po:pic_po,
			EntityPNM:EntityPNM,
			MainAccount:MainAccount,
			SubAccount:SubAccount,
			LOB:LOB,
			Division:Division_form,
			BisnisType:BisnisType,
			COA:COA,
			Anggaran:Anggaran,
			BudgetDisetujui:BudgetDisetujui
		},
		function(data){
			alert(data);
			go_to_list();
		})
		// alert(notes);
    }
	
    function VendorList() {
        $('#mdl_Add').modal({show: true});
        // dataTableItmPr.destroy();
		loadGridVendorList();
    }
	
	
	function loadGridVendorList() {
		$('#table_gridVendorList').dataTable().fnDestroy();
        $('#mdl_Add').modal({show: true});
        dataTable = $('#table_gridVendorList').DataTable({
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            retrieve: true,
            "pageLength": 5,
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "<?php echo base_url("/procurement/purchase_request/ajax_GridPopupVendorList"); ?>",
                type: "post", // method  , by default get
                error: function () {  // error handling
                    $(".table_gridItemList-error").html("");
                    $('#table_gridItemList tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                    $("#table_gridItemList_processing").css("display", "none");
                }
            },
            "columnDefs": [
                {"targets": [-1], "orderable": false, "searchable": false},
                {"targets": [0], "orderable": false},
                {"targets": [1], "orderable": false},
                {"targets": [2], "orderable": false},
                {"targets": [3], "orderable": false},
                {"targets": [4], "orderable": false},
                {"targets": [5], "checkboxes": {"selectRow": true}},
            ],
            "select": {"style": "multi"},
        });
    }

	
</script>



