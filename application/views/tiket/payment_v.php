
<style type="text/css">
    .table .spd{
        margin-top: 2px;
    }
</style>
<input type="hidden" id="id_userName" value="<?php echo $this->session->userdata('user_name'); ?>">
<input type="hidden" id="id_posisi" value="<?php echo $this->session->userdata('posisi_desc'); ?>">
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
                                <!-- <div class="tab-pane fade" id="tab_2_6"> -->
                                    <div class="scroller" style="height:400px; ">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <?php if ($this->session->flashdata('success')): ?>
                                                    <div class="alert alert-success">
                                                        <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?> 
                                                    </div>
                                                <?php endif ?>
                                                <?php if ($this->session->flashdata('error')): ?>
                                                    <div class="alert alert-danger">
                                                        <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?> 
                                                    </div>
                                                <?php endif ?>
                                                <button id="id_Reload" style="display: none;"></button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                            </div>
                                            <!--  <div class="col-md-12">
                                                 <button class="btn btn blue" onclick="onLihat()">Lihat</button>
                                             </div> -->

                                            <div id="divBudget">
                                                <div class="col-md-12" >
                                                    <br>
                                                    <table class="table table-striped table-bordered table-hover text_kanan" id="Table_payment">
                                                        <thead>
                                                            <tr>  
                                                                <th>NO PR</th>     
                                                                <!-- <th>Termin</th> -->
                                                                <th>Tanggal Invoice</th>
                                                                <th>Nilai</th>
                                                                <!-- <th>Jumlah Invoice</th> -->
                                                                <th>Status Payment</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                    </div>
                                </div>    
                            </div>
 
        <!-- =========================================== AJAX ============================================ -->

        <?php $this->load->view('app.min.inc.php'); ?>
        <?php $this->load->view('tiket/tiket.js.php'); ?>
        <script>

        </script>

