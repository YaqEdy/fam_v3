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
                            Check Request</a>
                    </li>
                    <li class="linav" id="linav2">
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                            Close Check Request</a>
                    </li>

                </ul> 
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab_2_1">
						<div id="list_approval"></div>
                    </div>
               
					<!--end--> 
					<div class="tab-pane fade" id="tab_2_2">
						<div id="list_approval2"></div>
					</div>
				</div>
            </div>

        </div>   
    </div>

</div>
</div>
<!-- END VALIDATION STATES-->
</div>
</div>


<?php $this->load->view('app.min.inc.php'); ?>
<script>
	$(document).ready( function () {
		get_list_approve(4);
		get_close_list_approve('4-1');
	} );
	
    function get_list_approve(grup){
		$.post('<?=base_url()?>procurement/purchase_request/get_list_check_request', {
			grup:grup
		},
		function(data){
			$("#list_approval").html(data);
		}).complete(function(){
			$('#datatables').DataTable();
		 })
	}
	
    function get_close_list_approve(status){
		 $.post('<?=base_url()?>procurement/purchase_request/get_list_close_check_request', {
			 status:status
		 }).success(function(data){
			 $("#list_approval2").html(data);
		 }).complete(function(){
			$("#datatables2").DataTable({
				"order": [[ 0, "desc" ]]
			});
		 })
	 }

</script>

