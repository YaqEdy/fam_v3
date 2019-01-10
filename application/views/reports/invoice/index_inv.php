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
                                        <div class="col-md-12">
                                        </div>
                                        <div class="col-md-12">
                                        </div>
                                        <div id="divBudget">
                       <div class="form-group m-form__group col-md-3">
                            <label for="exampleInputtext1">&nbsp;</label>
                            <button id="export_excel" class="btn btn-success" style="margin-top: 24px">Excel</button>
                            <button id="export_pdf" class="btn btn-success" style="margin-top: 24px">PDF</button>
                                    </div>
                                            <div class="col-md-12" >
                                                <br>
                                                <!-- <div style="overflow-x:auto;"> -->
                                                <table class="table table-striped table-bordered table-hover text_kanan" id="table_inv_report">
                                                    <thead>
                                    <th>NO PR</th>  
                                    <th>Deskripsi/th>   
                                    <th>DIV/CAB</th>
                                    <th>Nama PIC</th>
                                    <th>Tanggal PR</th>
                                    <th>No PO</th>
                                    <th>Nilai PO</th>
                                    <th>Vendor Name</th>
                                    <th>Termin</th>
                                    <th>No INV</th>
                                    <th>No IAS</th>
                                    <th>Presentase (%)</th>
                                    <th>Nilai INV</th>
                                    <th>Batas Tgl Pembayaran</th>
                                    <th>Status Pembayaran</th>
                                 </tr>
                                                    </thead>
                                                    <tfoot>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

        <!-- ============================================ end ===================================================== -->

        <?php $this->load->view('app.min.inc.php'); ?>
        <?php $this->load->view('reports/invoice/index.js.php'); ?>
        <script>

        </script>

