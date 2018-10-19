<!-- BEGIN PAGE BREADCRUMB --> 

<!-- END PAGE BREADCRUMB -->
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<!-- KONTEN DI SINI YA -->
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
                <ul class="nav nav-pills">
                    <li class="linav active" id="linav1">
                        <a href="#tab_2_1" data-toggle="tab" id="navitab_2_1" class="anavitab">
                            Upload IAS </a>
                    </li>
                    <li class="linav" id="linav2">
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                            Payment </a>
                    </li>

                </ul> 
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab_2_1">
                        <!--<div class="scroller" style="height:400px; ">-->
                        <div class="row">
                            <div class="col-md-12">
                                <?php if($this->session->flashdata('success')): ?>
                                    <div class="alert alert-success">
                                        <strong>Success!</strong> <?php echo $this->session->flashdata('success');?> 
                                    </div>
                                <?php endif ?>
                                <?php if($this->session->flashdata('error')): ?>
                                    <div class="alert alert-danger">
                                        <strong>Error!</strong> <?php echo $this->session->flashdata('error');?> 
                                    </div>
                                <?php endif ?>
                                <button id="id_Reload" style="display: none;"></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group col-md-3">
                                    <label>Mulai</label>
                                    <input type="text" required="" name="mulai" id="mulai" onchange="ddMulai(this.value)" class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Sampai</label>
                                    <input type="text" required="" name="sampai" id="sampai" onchange="ddSampai(this.value)" class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn blue" onclick="onLihat()">Lihat</button>
                            </div>

                            <div id="divBudget">
                                <div class="col-md-12" >
                                    <br>
                                    <table class="table table-striped table-bordered table-hover text_kanan" id="table_gridBudget">
                                        <thead>
                                            <tr>
                                                <th>NO PR</th>     
                                                <th>Tanggal Request</th>
                                                <th>Request Name</th>
                                                <th>Project Name</th>
                                                <th>Branch</th>
                                                <th>Status Akhir</th>
                                                <th>Status Cek</th>
                                                <th>No PO</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                        </tbody>
                                        <tfoot>


                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <!-- end col-12 -->
                        </div>
                        <!-- END ROW-->
                        <!--</div>-->
                    </div>
                    <div class="tab-pane fade" id="tab_2_2">
                        <br>&nbsp;
                        <table class="table table-striped table-bordered table-hover text_kanan" id="table_gridSetting">
                            <thead>
                                <tr>
                                    <th>NO PR</th>     
                                    <th>Tanggal Request</th>
                                    <th>Request Name</th>
                                    <th>Project Name</th>
                                    <th>Branch</th>
                                    <th>Status Akhir</th>
                                    <th>Status Cek</th>
                                    <th>No PO</th>
                                    <th>Status Pembayaran</th>
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


<!-- END PAGE CONTENT-->

<!--Modal Add-->
<div id="myadd" class="modal fade" >
    <form class="validator-form form-horizontal" id="datasave" action="" enctype="multipart/form-data" method="POST">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Budget</h4>
                </div>
                <div class="modal-body" >
                    <div class="form-group">
                        <label class="control-label col-sm-3">Upload File (.xlsx/.xls)</label>
                        <div class="col-sm-7">
                            <input type="file" class="form-control" name="namafile" id="namafile" required>                
                        </div>
                    </div>  
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="signup" value="Submit" id="simandata">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="closeupload">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Modal UPDATE-->
<div class="modal fade draggable-modal" id="mdl_Update" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">                
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">

                <div class="panel panel-inverse">
                    <hr class="dotted">
                    <div class="validator-form form-horizontal">
                        <input type="hidden" id="BudgetID">
                        <div class="form-group">
                            <label class="control-label col-sm-3">Budget COA</label>
                            <div class="col-sm-7">
                                <input type="text" requered="" name="BudgetCOA" class="form-control" id="BudgetCOA">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Branch Name </label>
                            <div class="col-sm-7">
                                <div id="ddBranch"></div>
                            </div>
                        </div>        
                        <div class="form-group" id="displaydivisi">
                            <label class="control-label col-sm-3">Division Name</label>
                            <div class="col-sm-7">
                                <div id="ddDivisi"></div>
                            </div>
                        </div>        

                        <div class="form-group">
                            <label class="control-label col-sm-3">Budget Value</label>
                            <div class="col-sm-7">
                                <input type="text" requered="" name="BudgetValue" class="form-control nomor" id="BudgetValue">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Period</label>
                            <div class="col-sm-7">
                                <input type="text" requered="" name="period" class="form-control nomor1" id="period">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <div class="btnSC">
                        <button type="button" class="btn btn-success save" onclick="clickUpdate()">Save</button>
                        <button type="button" class="btn btn-success update" onclick="clickUpdate()">Update</button>
                        <button type="button" class="btn btn-warning close_" data-dismiss="modal">Close</button>                
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal TRANSFER-->
<div class="modal fade draggable-modal" id="mdl_Transfer" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">                
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">TRANSFER BUDGET</h4>
            </div>
            <div class="modal-body">
                <form id="idTransfer">
                    <div class="panel panel-inverse">
                        <!--<hr class="dotted">-->
                        <div class="validator-form form-horizontal">
                            <input type="hidden" id="BudgetID">
                            <div class="form-group">
                                <label class="control-label col-sm-3">Tanggal</label>
                                <div class="col-sm-7">                                
                                    <input type="text" requered="" name="tf_tanggal" id="id_tf_tanggal" class="form-control input-sm date-picker" data-date-format="dd-mm-yyyy">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Name </label>
                                <div class="col-sm-7">
                                    <input type="text" requered="" name="tf_nama" class="form-control" id="id_tf_nama">
                                </div>
                            </div>        
                            <div class="form-group" id="displaydivisi">
                                <label class="control-label col-sm-3">Posisi</label>
                                <div class="col-sm-7">
                                    <input type="text" requered="" name="tf_posisi" class="form-control" id="id_tf_posisi">
                                </div>
                            </div>        

                            <div class="form-group">
                                <label class="control-label col-sm-3">Branch/Divisi Asal</label>
                                <div class="col-sm-7">
                                    <?php
                                    $data = array();
                                    $data[''] = '';
                                    foreach ($dd_Division as $row) :
                                        $data[$row->DivisionID] = $row->DivisionName;
                                    endforeach;
                                    echo form_dropdown('tf_asal', $data, '', 'id="dd_tf_asal" class="form-control  input-sm select2me" required="required" onchange="dd_BranchTF(this.value)" ');
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Branch/Divisi Tujuan</label>
                                <div class="col-sm-7">
                                    <div id="DD_divTujuan"></div>
                                </div>
                            </div>
                            <div class="form-group" id="displaydivisi">
                                <label class="control-label col-sm-3">Jumlah</label>
                                <div class="col-sm-7">
                                    <input type="text" requered="" name="tf_jumlah" class="form-control nomor" id="id_tf_jumlah">
                                </div>
                            </div>        

                        </div>
                    </div>


                    <div class="modal-footer">
                        <div class="btnSC">
                            <button type="submit" class="btn btn-success">OK</button>
                            <button type="button" class="btn btn-default close_tf" data-dismiss="modal">Close</button>                
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Setting-->
<div class="modal fade draggable-modal" id="mdl_Setting" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">                
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">SETTING BUDGET</h4>
            </div>
            <div class="modal-body">
                <form id="idSetting">
                    <div class="panel panel-inverse">
                        <!--<hr class="dotted">-->
                        <div class="validator-form form-horizontal">
                            <input type="hidden" id="BudgetID">
                            <div class="form-group">
                                <label class="control-label col-sm-3">Tahun</label>
                                <div class="col-sm-7">                                
                                    <input type="text" requered="" name="st_Tahun" id="id_st_Tahun" class="form-control input-sm date-picker" data-date-format="yyyy">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Jenis Budget </label>
                                <div class="col-sm-7">
                                    <?php
                                    $data = array();
                                    $data[''] = '';
                                    foreach ($dd_jns_budget as $row) :
                                        $data[$row->ID_JNS_BUDGET] = $row->BUDGET_DESC;
                                    endforeach;
                                    echo form_dropdown('st_jns_budget', $data, '', 'id="id_st_jns_budget" class="form-control  input-sm select2me" required="required"');
                                    ?>
                                </div>
                            </div>       
                            <div class="form-group">
                                <label class="control-label col-sm-3">Detail </label>
                                <div class="col-sm-7">
                                    <select id="id_detail" name="detail" class="form-control">
                                        <option  value="0">Tidak Detail</option>
                                        <option  value="1">Detail</option>
                                    </select>
                                </div>
                            </div>       

                        </div>
                    </div>


                    <div class="modal-footer">
                        <div class="btnSC">
                            <button type="submit" class="btn btn-success">Save</button>
                            <button type="button" class="btn btn-default close_st" data-dismiss="modal">Close</button>                
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<?php $this->load->view('app.min.inc.php'); ?>
<?php $this->load->view('procurement/ias/ias.js.php'); ?>
