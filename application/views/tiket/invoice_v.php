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
                <!-- <div class="tab-pane fade" id="tab_2_5"> -->
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
                            <div class="col-md-12">  </div>
                                <div id="divBudget">
                                    <div class="col-md-12" >
                                        <br>
                            <table class="table table-striped table-bordered table-hover text_kanan" id="table_Invoice">
                        <thead>
                                <tr>  
                                    <th>NO PR</th>     
                                    <th>Jumlah Termin</th>
                                    <th>TRAVEL</th>
                                    <th>Persentase</th>
                                    <th>Nilai</th>
                                    <th>Aksi</th>
                                </tr>
                                   </thead>
                             </table>
                       </div>
                    </div>
                <div class="col-md-12"></div>
            </div>
       </div>
        <!-- ======================================= MODAL INVOICE ======================================= -->
        <div class="modal fade" id="ModalInputInvoice" tabindex="-1" role="dialog" aria-hidden="true">
            <form role="form" method="post" class="cls_from_sec_room" id="id_forminv" enctype="multipart/form-data"  > 
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" id="btnCloseModalDataTOTALINVOICE">&times;</button>
                            <h4 class="modal-title">INVOICE</h4>
                        </div>
                        <div class="modal-body">
                    <div id="idforminvoice"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="btnSimpan" class="btn green" id="id_btnSimpan"  > <i class="fa fa-save">&nbsp;</i>Save</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </form>
        </div>
        <!-- =========================================== AJAX ============================================ -->

        <?php $this->load->view('app.min.inc.php'); ?>
        <?php $this->load->view('tiket/tiket.js.php'); ?>
        <script>

        </script>

