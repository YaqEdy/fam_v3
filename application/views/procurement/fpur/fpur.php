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
                            FPUR </a>
                    </li>
                    <li class="linav" id="linav2">
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                            FPUM </a>
                    </li>
                    <li class="linav" id="linav3">
                        <a href="#tab_2_3" data-toggle="tab" id="navitab_2_3" class="anavitab">MY
                            FPUR & FPUM </a>
                    </li>

                </ul> 
                 
                    
                </div>
                <div class="tab-content">

                    <div class="tab-pane fade active in" id="tab_2_1">
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
                        <br>&nbsp;
                        <table class="table table-striped table-bordered table-hover text_kanan" id="table_fpur" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>NO PR</th>   
                                    <th>Tanggal Request</th>
                                    <th>Request Type</th>
                                    <th>Total HPS</th>
                                    <th>HPS/Item</th>
                                    <th>Kelengkapan</th>
                                    <th>Jenis Pengadaan</th>
                                    <th>Tipe Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot></tfoot>
                        </table>
                    </div>

                    <div class="tab-pane fade" id="tab_2_2">
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
                        <br>&nbsp;
                        <table class="table table-striped table-bordered table-hover text_kanan" id="" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>NO.</th>
                                    <!-- <th>NO PR</th> -->
                                    <th>Type FPUR</th>
                                    <th>NO FPUR</th>
                                    <th>Tanggal Request</th>
                                    <th>Request Type</th>
                                    <th>Total HPS</th>
                                    <th>Kelengkapan</th>
                                    <th>Jenis Pengadaan</th>
                                    <th>Tipe Pembayaran</th>
                                    <th>ACT.</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i=1;
                                    foreach ($fpum as $data) {
                                ?>
                                <tr>
                                    <td><?php echo $i?></td>
                                    <!-- <td><?php echo $data->RequestID?></td> -->
                                    <td><?php echo $data->TYPE_FPUR?></td>
                                    <td><?php echo $data->NO_FPUR?></td>
                                    <td><?php echo $data->Tgl_Req?></td>
                                    <td><?php echo $data->ReqTypeName?></td>
                                    <td><?php echo $data->HargaHPS?></td>
                                    <td><?php echo $data->Kelengkapan?></td>
                                    <td><?php echo $data->Jns_Pengadaan?></td>
                                    <td><?php echo $data->Tipe_Pembayaran?></td>
                                    <td><button value="<?php echo $data->ID_FPUR ?>" id="id_fpum" onclick="add_fpum(this.value)" class="btn btn-primary" data-toggle="modal" data-target="#mdl_fpum">Add FPUM</button></td>
                                </tr>
                                <?php
                                    $i++;
                                    }
                                ?>
                            </tbody>
                            <tfoot></tfoot>
                        </table>
                    </div>

                    <div class="tab-pane fade" id="tab_2_3">
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
                            <br>&nbsp;
                            <table class="table table-striped table-bordered table-hover text_kanan" id="" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>NO.</th>
                                        <!-- <th>NO PR</th> -->
                                        <th>Type FPUR</th>
                                        <th>NO FPUR</th>
                                        <th>Tanggal Request</th>
                                        <th>Request Type</th>
                                        <th>Total HPS</th>
                                        <th>Kelengkapan</th>
                                        <th>Jenis Pengadaan</th>
                                        <th>Tipe Pembayaran</th>
                                        <!-- <th>ACT.</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $i=1;
                                        foreach ($my_fpur_fpum as $data) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i?></td>
                                        <!-- <td><?php echo $data->RequestID?></td> -->
                                        <td><?php echo $data->TYPE_FPUR?></td>
                                        <td><?php echo $data->NO_FPUR?></td>
                                        <td><?php echo $data->Tgl_Req?></td>
                                        <td><?php echo $data->ReqTypeName?></td>
                                        <td><?php echo $data->HargaHPS?></td>
                                        <td><?php echo $data->Kelengkapan?></td>
                                        <td><?php echo $data->Jns_Pengadaan?></td>
                                        <td><?php echo $data->Tipe_Pembayaran?></td>
                                        <!-- <td><button value="<?php echo $data->ID_FPUR ?>" id="id_fpum" onclick="add_fpum(this.value)" class="btn btn-primary" data-toggle="modal" data-target="#mdl_fpum">Add FPUM</button></td> -->
                                    </tr>
                                    <?php
                                        $i++;
                                        }
                                    ?>
                                </tbody>
                                <tfoot></tfoot>
                            </table>
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


<!-- Modal 1-->
<div class="modal fade draggable-modal" id="mdl_1" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
                        <div class="btnSC">
                            <button type="submit" class="btn btn-success">Save</button>
                            <button type="button" class="btn btn-default close_st" data-dismiss="modal">Close</button>

                        </div>
        </div>
    </div>
</div>

<!-- Modal fpur-->
<div class="modal fade draggable-modal" id="mdl_fpur" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
        <form action="fpur/save_fpur" method="post" enctype="multipart/form-data">
            <div class="modal-header">                
                
            </div>
            <div class="modal-body">
                
                    <div class="panel panel-inverse">
                        <!--<hr class="dotted">-->
                        <div class="validator-form form-horizontal">
                             <input type="text" name="id_pr" id="id_pr" class="form-control hidden" >
                            <div class="form-group">
                                <label class="control-label col-sm-3">Type FPUR</label>
                                <div class="col-sm-7">
                                    <input type="radio" name="type_fpur" value="1"> Reimbursement &nbsp;
                                    <input type="radio" name="type_fpur" value="2"> UM-FPUR 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">No. FPUR</label>
                                <div class="col-sm-7">
                                    <input type="text" name="no_fpur" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Jumlah</label>
                                <div class="col-sm-7">
                                    <input type="text" name="jml" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Nama Rekening</label>
                                <div class="col-sm-7">
                                    <input type="text" name="nm_rekening" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">No. Rekening</label>
                                <div class="col-sm-7">
                                    <input type="text" name="no_rekening" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Bank</label>
                                <div class="col-sm-7">
                                    <input type="text" name="bank" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Alamat bank</label>
                                <div class="col-sm-7">
                                    <textarea name="alamat_bank" class="form-control"></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label col-sm-3">Document Kelengkapan</label>
                                <div class="col-sm-7">
                                    <input type="file" name="doc_kelengkapan" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="btnSC">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-default close_st" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mdl_DPR">Detail PR</button>                 
                </div>

            </div>

                </form>
        </div>
    </div>
</div>

<!-- Modal fpum-->
<div class="modal fade draggable-modal" id="mdl_fpum" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
        <form action="fpur/save_fpum" method="post" enctype="multipart/form-data">
            <div class="modal-header">                
                
            </div>
            <div class="modal-body">
                <div class="panel panel-inverse">
                    <!--<hr class="dotted">-->
                    <div class="validator-form form-horizontal">
                        <div id="datafpur">
                            
                        </div>
                        
                    </div>
                </div>  
            </div>
            <div class="modal-footer">
                <div class="btnSC">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-default close_st" data-dismiss="modal">Close</button> 
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mdl_DPR">Detail PR</button>               
                </div>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- Modal DPR-->
<div class="modal fade draggable-modal" id="mdl_DPR" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
        <form action="fpur/" method="post" enctype="multipart/form-data">
            <div class="modal-header">                
                
            </div>
            <div class="modal-body">
                <div class="panel panel-inverse">
                    <div class="validator-form form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-sm-3">No_PR</label>
                            <div class="col-sm-4">
                            </div>
                            <label class="control-label col-sm-3">Tanggal PR</label>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Request Type</label>
                            <div class="col-sm-4">
                            </div>
                            <label class="control-label col-sm-3">Tanggal PR</label>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Branch</label>
                            <div class="col-sm-4">
                            </div>
                            <label class="control-label col-sm-3">Category Name</label>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Divisi</label>
                            <div class="col-sm-4">
                            </div>
                            <label class="control-label col-sm-3">Periode</label>
                        </div>

                         <div class="form-group">
                             <label class="control-label">
                        <center>------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</center>       
                        </label>
                                <label class="control-label col-sm-2">Total HPS</label>
                                <div class="col-sm-2">
                                    <input type="text" name="HPS" class="form-control">
                                </div>
                                <label class="control-label col-sm-2">Total Item</label>
                                <div class="col-sm-2">
                                    <input type="text" name="Item" class="form-control">
                                </div>
                                <label class="control-label col-sm-2">Total QTY</label>
                                <div class="col-sm-1">
                                    <input type="text" name="QTY" class="form-control">
                                </div>
                        <label class="control-label">
                        <center>------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</center>
                        </label>
                        </div>
                        <div class="form-group">
                            <table class="table table-striped table-bordered table-hover" id="" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <!-- <th>NO PR</th> -->
                                    <th>Item Type</th>
                                    <th>QTY</th>
                                    <th>Total HPS</th>
                                    <th>HPS/Item</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        </div> 
                        <div class="form-group">
                                <label class="control-label col-sm-3">Dok. Kelengkapan PR</label>
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-danger">Lihat</button>
                                </div>
                            </div>
                        <div class="form-group">
                                <label class="control-label col-sm-3">Prioritas</label>
                                <div class="col-sm-7">
                                    <input type="checkbox" name="type_fpur" value="1"> Prioritas
                                </div>
                            </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Kelengkaan</label>
                            <div class="col-sm-7">
                                <input type="radio" name="type_fpur" value="L"> Lengkap &nbsp;
                                <input type="radio" name="type_fpur" value="TL"> Tidak Lengkap 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Type Pembayaran</label>
                            <div class="col-sm-7">
                                <select class="form-control" name="pbyr">
                                    <option>FPUR</option>
                                    <option>FPUM</option>
                                </select> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Catatan </label>
                            <div class="col-sm-7">
                                <textarea class="form-control" name="cttn"></textarea> 
                            </div>
                        </div> 
                        <label class="control-label">
                        <center>-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</center>
                        </label>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Type Pembayaran</label>
                            <div class="col-sm-7">
                                <select class="form-control" name="pbyr">
                                    <option>FPUR</option>
                                    <option>FPUM</option>
                                </select> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">PIC</label>
                            <div class="col-sm-7">
                                <select class="form-control" name="pbyr">
                                    <option>STS</option>
                                    <option>FPUM</option>
                                </select> 
                            </div>
                        </div>  
                    </div>
                </div>  
            </div>
            <div class="modal-footer">
                <div class="btnSC">
                    <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-chevron-right"></i></button>             
                </div>
            </div>
        </form>
        </div>
    </div>
</div>

<?php $this->load->view('app.min.inc.php'); ?>
<?php $this->load->view('procurement/fpur/fpur.js.php'); ?>