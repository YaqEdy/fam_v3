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
					<h5 class="sbold uppercase">Approval</h5>
                        <div class="panel panel-inverse">
                            <hr class="dotted">
                            <!--tambahkan enctype="multipart/form-data" u/ upload-->
                            <!--<form class="validator-form form-horizontal" id="datasavez" enctype="multipart/form-data"  action="<?php echo base_url(); ?>procurement/requestproc/add_requestproc/prc" method="POST">-->
                            <form class="validator-form form-horizontal" id="fm_apppr" enctype="multipart/form-data" method="POST">
                                <div class="validator-form form-horizontal">
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">ID </label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="RequestID" name="RequestID"  value="<?=$approve_pr->RequestID?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">FLOW ID </label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="flow_id" name="flow_id"  value="<?=$approve_pr->flow_id?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Status </label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="status" name="status"  value="<?=$approve_pr->status?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Branch </label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="pengadaan" name="pengadaan"  value="<?=$approve_pr->BranchID?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">ReqTypeID </label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="pengadaan" name="pengadaan"  value="<?=$approve_pr->ReqTypeID?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">ReqCategoryID </label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="pengadaan" name="pengadaan"  value="<?=$approve_pr->ReqCategoryID?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3"></label>
                                        <div class="col-sm-7">
                                            <div id="prosessloading"/>
                                            <button type="submit" class="btn btn-primary" id="appreq" name="appreq" value="Submit" >Approve</button>       
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
	
    $("#fm_apppr").submit(function (e) {  // passing down the event 
        // console.log(document.getElementById('Rkt').value);
        // e.preventDefault(); // could also use: return false;
		// alert("hsj");
        $.ajax({
            url: "<?php echo base_url("/procurement/purchase_request/app_requestproc"); ?>",
            type: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            dataType: "JSON",
            success: function (e) {
				$("#fm_apppr")[0].reset();
                if (e.istatus) {
                    alert(e.iremarks);
                } else {
                    alert(e.iremarks);
                }
				// alert(e.iremarks);
				window.location = "<?php echo base_url("/procurement/purchase_request/list_approve"); ?>";

            },
            error: function (e) {
                alert("error");
            }
        });
    });

</script>



