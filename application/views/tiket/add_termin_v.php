<!-- BEGIN PAGE BREADCRUMB --> 

<!-- END PAGE BREADCRUMB -->
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<!-- KONTEN DI SINI YA -->
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
                                        <div class="col-md-12"></div>
                                        <div class="col-md-12"></div>
                                        <div id="divBudget">
                                            <div class="col-md-12" >
                                                <br>
                                                <table class="table table-striped table-bordered table-hover text_kanan" id="table_AddPrto_Inv">
                                                    <thead>
                                                        <tr>
                                                            <th>NO PR</th>  
                                                            <th>Tanggal PR</th>
                                                            <th>No SPD</th>
                                                            <th>File SPD</th>
                                                            <th>Akomodasi</th>
                                                            <th>Asal</th>
                                                            <th>Tujuan</th>
                                                            <th>Tanggal Berangkat</th>
                                                            <th>Tanggal Pulang</th>
                                                            <th>Status</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                </div>
        <!-- =============================================modal SET TERMIN========================================= -->
        <div class="modal fade draggable-modal" id="myModalInvoice" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close"  data-dismiss="modal" id="btnCloseModalDataBarang3">&times;</button>
                        <h4 class="modal-title">PR Invoice</h4>
                    </div>
<form role="form" method="post" class="cls_from_sec_room" id="id_formSetTermin"  enctype="multipart/form-data" >
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-body">

                                    <div class="col-md-12">
                                        <h4>Invoice</h4>
                                        <!-- <div style="overflow-x:auto;">  -->
                                        <table class="table table-striped table-bordered table-hover text_kanan" id="table_grid_Popup_Invoice">
                                            <thead>
                                                <tr> 
                                                    <!-- <th></th> -->
                                                    <th>No PR</th>
                                                    <th>Tgl PR</th>
                                                    <th>An.</th>
                                                    <th>Jns Identitas</th>
                                                    <th>No Identitas</th> 
                                                    <th>ID Karyawan</th>    

                                                </tr>
                                            </thead>
                                        </table>
                                    </div>

                                    <div class="col-md-6"> 
                                        <div class="form-group">
                                          <!-- <input type="text" id="ID_TIKET" name="ID_TIKET"> -->
                                            <label>Payment</label> <span class="required ">*</span> 
                                            <label>Nominal pembayaran yang di input harus termasuk pajak</label>
                                            <input required="required" class="form-control nomor" type="text" id="payment" name="payment"/>

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group" id="asli">
                                            <label>Payment Termin <span class="required">*</span></label>  
                                            <div class="table-responsive">
                                                <div class="box-body table-responsive no-padding">
                                                    <TABLE class="table table-striped table-bordered table-hover table-responsive" id="dataTableinv" border="1">
                                                        <tr>
                                                            <th><INPUT type="checkbox" onchange="checkAll(this)" name="chk[]" /></th>
                                                            <th>Termin</th>
                                                            <th>Tanggal Jatuh tempo</th>
                                                            <!-- <th>Tanggal Aktual</th> -->
                                                            <th>Presentase</th>
                                                            <th>Nilai</th>                                          
                                                            <th> Keterangan </th>
                                                        </tr>
                                                        <INPUT type="button" class="btn btn-xs btn-primary" value="Add Row" onclick="addRow('dataTableinv')" />&nbsp;
                                                        <INPUT type="button" class="btn btn-xs btn-danger" value="Delete Row" onclick="deleteRow('dataTableinv')" />
                                                    </TABLE>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="editan">

                                        </div>
                                    </div>
                                    <input type="hidden" id="jml" value="0" name="jml" hidden> 
                                </div>
                            </div>         
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                            <button  type="submit" class="btn btn-sm btn-success"><i class="fa fa-download"></i>&nbsp;Teruskan</button>
                            <!-- onclick="teruskan()"  -->
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- ============================================================================================= -->

        <?php $this->load->view('app.min.inc.php'); ?>
        <?php $this->load->view('tiket/tiket.js.php'); ?>
        <script>

        </script>

