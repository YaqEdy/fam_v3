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
                            Form Request</a>
                    </li>
                    <li class="linav" id="linav2">
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                            Out Request</a>
                    </li>

                </ul> 
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab_2_1">
                        <div class="panel panel-inverse">
                            <hr class="dotted">
                            <!--tambahkan enctype="multipart/form-data" u/ upload-->
                            <form class="validator-form form-horizontal" id="fm_datasave" enctype="multipart/form-data" method="POST">
                                <div class="validator-form form-horizontal">
                                    <?php if($this->session->userdata('groupid') =='0' || $this->session->userdata('groupid') == '17'): ?>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Jenis</label>
                                        <div class="col-md-7">
                                            <select id="opex_capexID" name="opex_capex" class="form-control" onchange="check_JenisPR(this.value)">
                                                <option value="">-Pilih-</option>
                                                <option value="CAPEX">CAPEX</option>
                                                <option value="OPEX">OPEX</option>
                                            </select>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Jenis Pengadaan </label>
                                        <div class="col-md-7">
                                            <select id="JenisPR" name="JenisPR" class="form-control" onchange="check_JenisPR(this.value)">
                                                <option value="Baru">Baru</option>
                                                <option value="Tambahan">Tambahan</option>
                                                <option value="Ulang">Ulang</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group" id="PR_rev" style="display:none">
                                        <label class="control-label col-sm-3">PR Reverensi </label>
                                        <div class="col-sm-7">
                                            <input type="hidden" class="form-control" id="BranchID" name="BranchID"  value="<?php echo $this->session->userdata('BranchID'); ?>"/>
                                            <select name="PR_rev" class="form-control">
                                                <option selected="" disabled="" value="">-Select-</option>
                                                <?php foreach ($outReq as $outReqrow) { ?>
                                                    <option value="<?= $outReqrow['RequestID'] ?>"> 
                                                        PR-<?= $outReqrow['RequestID'] ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Request Type </label>
                                        <div class="col-sm-7">
                                            <input type="hidden" class="form-control" id="BranchID" name="BranchID"  value="<?php echo $this->session->userdata('BranchID'); ?>"/>
                                            <select id="ReqTypeID" name="ReqTypeID" class="form-control" onchange="onDDCategory()">
                                                <option selected="" disabled="" value="">-Select-</option>
                                                <?php foreach ($selreqtype as $row) { ?>
                                                    <option value="<?php echo $row->ReqTypeID; ?>"> 
                                                        <?php echo $row->ReqTypeName; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group" id="PR_sewa" style="display:none">
                                        <label class="control-label col-sm-3">Periode Sewa </label>
                                        <div class="col-sm-7 form-inline">
                                            <input type="number" class="form-control" id="SewaPeriodeNilai" name="SewaPeriodeNilai"/>
                                            <select name="SewaPeriodeSatuan" class="form-control input-small">
                                                <option selected="" disabled="" value="">-Select-</option>
                                                <option value="Hari">Hari</option>
                                                <option value="Bulan">Bulan</option>
                                                <option value="Tahun">Tahun</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group" id="PR_sewa_tgl" style="display:none">
                                        <label class="control-label col-sm-3">Per Tanggal </label>
                                        <div class="col-sm-7 form-inline">
                                            <input type="text" class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy" id="PeriodeTanggalDari" name="PeriodeTanggalDari" />
                                            &nbsp;&nbsp;-&nbsp;&nbsp;
                                            <input type="text" class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy" id="PeriodeTanggalSampai" name="PeriodeTanggalSampai"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Request Category</label>
                                        <div class="col-sm-7">
                                            <!--<input type="text" class="form-control" name="ProjectID" requered/>-->
                                            <div id="ddCategory"></div>
                                            <div id="load_reqcategory">
                                                <select id="ProjectID" name="ProjectID" class="form-control" disabled="true">
                                                    <option selected="" disabled="" value="">-Select-</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!--LOAD SEL OPTION RKT-->
                                    <div id="load_Rkt"  hidden></div>
                                    <div class="form-group" id="hdrAddBtn" hidden>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-7">
                                            <button onclick="itemList()" id="addbutton" class="btn btn-primary btn-xs" type="button">Add New Item</button>
                                        </div>
                                    </div>

                                    <!----------------------->
                                    <hr class="dotted">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-sm-4">Request Name</label>
                                            <div class="col-md-7">
                                                <input class="form-control" name="ProjectName">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-4">Nomor Memo </label>
                                            <div class="col-md-7">
                                                <input class="form-control" name="NomorMemo">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-sm-4">Branch </label>
                                            <div class="col-md-7">
                                                <select name="BranchID" class="form-control">
                                                    <option value="">- Branch -</option>
                                                    <?php
                                                    foreach ($ms_branch as $mb) {
                                                        if ($this->session->userdata('BranchID') == $mb['FLEX_VALUE']) {
                                                            $act_br = 'selected';
                                                        } else {
                                                            $act_br = '';
                                                        }
                                                        echo '
																<option value="' . $mb['FLEX_VALUE'] . '" ' . $act_br . '>' . $mb['BRANCH_DESC'] . '</option>
															';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-4">Division </label>
                                            <div class="col-md-7">
                                                <select name="DivisionID" class="form-control">
                                                    <option value="">- Division -</option>
                                                    <?php
                                                    foreach ($ms_divisi as $md) {
                                                        if ($this->session->userdata('DivisionID') == $md['FLEX_VALUE']) {
                                                            $act_div = 'selected';
                                                        } else {
                                                            $act_div = '';
                                                        }
                                                        echo '
																<option value="' . $md['FLEX_VALUE'] . '" ' . $act_div . '>' . $md['DIV_DESC'] . '</option>
															';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!----------------------->

                                    <hr class="dotted">
                                    <a href="#" onclick="itemList()" class="btn btn-success">Add Item</a>
                                    <div class="form-group" style="margin-top:1em">
                                        <div class="col-sm-12" align="center">
                                            <table class="table table-striped table-bordered table-hover text_kanan" id="table_gridItemProcess">
                                                <thead>
                                                    <tr>
                                                        <th>NO</th>     
                                                        <th>Image</th>
                                                        <th>Item Name</th>
                                                        <th>Item Type</th>
                                                        <th>Asset Type</th>
                                                        <th>Qty</th>
                                                        <th>Item Price</th>
                                                        <th>Keterangan</th>
                                                        <th class="sum">Total Price</th>
                                                        <th></th>

                                                    </tr>
                                                </thead>
                                                <tbody>


                                                </tbody>
                                                <tfoot>

                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-10 control-label"><b>Total Price Item :</b></label>
                                        <div class="col-md-2">
                                            <p id="myBudgetUsed" class="form-control-static nomor bold"></p>
                                            <input type="hidden" class="form-control" name="BudgetUsed" id="BudgetUsed">
                                        </div>
                                    </div>
                                    <hr class="dotted">

                                    <div id="load_termin"></div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Upload Dokument File Vendor khusus Request Type Project atau Project Non Pusat (zip max Upload file 7-8 mb):</label>
                                        <div class="col-sm-7">
                                            <input type="file" class="form-control" name="file_zip" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3"></label>
                                        <div class="col-sm-7">
                                            <div id="prosessloading"/>
                                            <button type="submit" class="btn btn-primary" id="reqsave" name="reqsave" value="Submit" >Save & Process</button>       
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div tabindex="-1" id="mdl_Add" class="modal fade draggable-modal" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" id="closetab" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title">ITEM</h4>
                                </div>
                                <div class="modal-header">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-sm-4">Class Item </label>
                                            <div class="col-md-7">
                                                <select id="ItemClass" name="ItemClass" class="form-control" onchange="getTypeItem(this.value)">
                                                    <option value="">- Class Item -</option>
                                                    <?php
                                                    foreach ($Mst_ItemClass as $ic) {
                                                        echo '<option value="' . $ic['IClassID'] . '">' . $ic['IClassName'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-sm-4">Type Item </label>
                                            <div class="col-md-7">
                                                <div id="drp_ItemType">
                                                    <select id="ItemType" name="ItemType" class="form-control">
                                                        <option value="">- Type Item -</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footern" id="table_gridItemList">
                                        <thead>
                                            <tr>
                                                <th>NO</th>     
                                                <th>Image</th>
                                                <th>Item</th>
                                                <th>Type</th>
                                                <th>Unit Price</th>
                                                <th></th>

                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                        <tfoot></tfoot>
                                    </table>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn green-jungle" onclick="processItem()" data-dismiss="modal"><i class="fa fa-check"></i> Process</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end--> 
                <div class="tab-pane fade" id="tab_2_2">
                    <div class="row">
                        <input type="hidden" class="form-control" name="src" id="src"/>

                        <div class="col-md-12" id="table_outReq">

                            <table class="table table-striped table-bordered table-hover dataTable no-footer" id="table_gridOutRequest" >
                                <thead>
                                    <tr>
                                        <th>NO</th>     
                                        <th>COA</th>
                                        <th>No PR</th>
                                        <th>Request Type</th>
                                        <th>Request Kategori</th>
                                        <th>Level Process</th>
                                        <th>Request Date</th>
                                        <th>Status</th>
                                        <th>Upload PR</th>
                                        <th></th>

                                    </tr>
                                </thead>
                                <tbody>


                                </tbody>
                                <tfoot>


                                </tfoot>
                            </table>
                        </div>
                        <!-- end col-12 -->
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
<!--Modal detail-->
<div id="mdl_DetailOR" class="modal fade" >
    <form class='validator-form form-horizontal' method='post' action='simpan_headlinevideo'>
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Detil Purchase Request (PR)</h4>
                </div>
                <div id="modal-body1" class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!--Modal delete-->
<div id="mdl_delete" class="modal fade" >
    <form class='validator-form form-horizontal' id="deletepr" action="" method="POST">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Hapus PR</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-sm-12">
                            Masukkan alasan penghapusan PR
                        </div>
                        <br><br>
                        <div class="col-sm-12">
                            <textarea style="radius:5px;" class="form-control" maxlength="450" id="note" name="note"  type="text"> </textarea> 
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="text" name="req" id="req" class="hidden">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="" value="Submit">Simpan</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!--Modal Upload-->
<div id="myUploadPR" class="modal fade" >
    <form class='validator-form form-horizontal' enctype="multipart/form-data" id="uploadpr" method="POST">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Uplaod PR</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-sm-12">
                            Uplaod Purchase Request (PR) yang sudah di TTD
                        </div>
                        <br><br>
                        <div class="col-sm-12">
                            <input type="file" class="form-control" name="FileUploadPR" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="hidden" name="requestid" id="requestid" >
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="submit_upload" value="Submit">Simpan</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="btnCloseUpload">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>

<?php $this->load->view('app.min.inc.php'); ?>
<?php $this->load->view('procurement/purchase_request/purchase_request.js.php'); ?>

