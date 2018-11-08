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
					<h5 class="sbold uppercase">List Request Anggaran</h5>
                    <div class="panel panel-inverse">
                        <hr class="dotted">
						<div id="list_request_anggaran">
						</div>
                    </div>
                </div>
            </div>

        </div>   
    </div>

</div>

<?php $this->load->view('app.min.inc.php'); ?>


<script>
	get_list_approve();
	
    function get_list_approve(){
		$.post('<?=base_url()?>procurement/purchase_request/get_list_request_anggaran', {
			
		},
		function(data){
			$("#list_request_anggaran").html(data);
		})
	}

</script>



