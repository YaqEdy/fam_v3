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
                   
                </div>
            </div>
            <div class="portlet-body">
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab_2_1">
                        <br>&nbsp;
                        <div class="row">
                            <div class="form-group m-form__group col-md-3">
                                <label for="exampleInputtext1">TGL Mulai</label>
                                <input type="text" class="form-control m-input pxb date-picker" onchange="ddMulai(this.value)" class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
                            </div>
                            <div class="form-group m-form__group col-md-3">
                                <label for="exampleInputtext1">TGL Selesai</label>
                                <input type="text" class="form-control m-input pxb date-picker" onchange="ddSampai(this.value)" class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
                            </div>
                            <div class="form-group m-form__group col-md-3">
                                <label for="exampleInputtext1">&nbsp;</label>
                                <button id="filter_report" class="btn btn-success" style="margin-top: 24px">FILTER</button>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>    
            </div>

        </div>
    </div>
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit  bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-list font-red"></i>
                    <span class="caption-subject font-red sbold uppercase">Table Report Penghapusan</span>
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
                    <div class="tab-pane fade active in" id="tab_2_1" style="overflow-x: scroll;">
                        <div class="form-group m-form__group col-md-3">
                            <label for="exampleInputtext1">&nbsp;</label>
                            <button id="export_excel" class="btn btn-success" style="margin-top: 24px">Excel</button>
                            <button id="export_pdf" class="btn btn-success" style="margin-top: 24px">PDF</button>
                        </div>
                        <table class="table table-striped table-bordered table-hover text_kanan" id="table_report">
                            <tr class="table_caption">
                            <tr>
                            <thead>
                                <tr>
                                    <th>Asset Number</th>  
                                    <th>Book Name</th>   
                                    <th>Tanggal Penghapusan</th>
                                    <th>Jumlah</th>
                                    <th>Harga Jual</th>
                                    <th>Nama Transaksi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot></tfoot>
                        </table>
                    </div>
                </div>    
            </div>

        </div>
    </div>
    <!-- END VALIDATION STATES-->
</div>
</div>
<?php $this->load->view('app.min.inc.php'); ?>
<?php $this->load->view('reports/penghapusan/index.js.php'); ?>