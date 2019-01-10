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
                                            <div class="col-md-12" >
                                                <br>
                                                <!-- <div style="overflow-x:auto;"> -->
                                                <table class="table table-striped table-bordered table-hover text_kanan" id="TabelEtiket">
                                                    <thead>
                                                        <tr>
                                                            <th>NO PR</th>     
                                                            <th>Tanggal PR</th>
                                                            <th>No SPD</th>
                                                            <th>File SPD</th>
                                                            <th>An Tiket</th>
                                                            <th>Jenis Identitas</th>
                                                            <th>No Identitas</th>
                                                            <th>Asal</th>
                                                            <th>Tujuan</th>
                                                            <th>Kategori Perjalanan</th>
                                                            <th>Tanggal Berangkat</th>
                                                            <th>Tanggal Pulang</th>
                                                            <th>Akomodasi</th>
                                                            <th>Tanggal Request</th>
                                                            <th>Travel</th>
                                                            <th>E-Tiket</th>
                                                            <td>Upload SPD</td>
                                                            <td>Upload Etiket</td>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

<!-- ========================================== Upload E- Tiket =========================================== -->
        <div class="modal fade" id="myModalUploadEtiket" tabindex="-1" role="dialog" aria-hidden="true">
            <form role="form" class="cls_from_sec_room" id="id_form_Etiket" method="POST">
                <!-- <form role="form" method="post" class="cls_from_sec_room" id="id_form_Etiket"  >  -->
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" id="btnCloseModalEtiket">&times;</button>
                            <h4 class="modal-title">Upload E-Tiket</h4>
                        </div>
                        <!-- <form role="form" method="post" class="cls_from_sec_room" id="id_formRoom"  enctype="multipart/form-data" > -->
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-body">
                                    <div class="col-md-12">
                                        <div class="form-group col-md-1"></div>
                                        <div class="form-group col-md-10">
                                            <input type="text" name="ID_TIKET_E" id="ID_TIKET_E" style="display: none;"  />
                                            <div class="form-group">
                                                <label>Please select a file to upload <b>E-Tiket</b> :</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"> <i class="fa fa-file"></i>
                                                    </span> <input type="file" name="Image_Etiket[]" class="form-control" 
                                                                   id="Image_Etiket" multiple>
                                                </div>
                                            </div>
                                            <div class="panel panel-danger">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Note</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <ul>
                                                        <li>
                                                            Maximum upload size only <strong>5 MB</strong>.
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>         
                        </div>
                        <div class="modal-footer">
                            <button type="button" onclick="uploadEtiket()" disabled="false" name="btnSimpan" class="btn green" id="id_btnSimpan420"  > <i class="fa fa-save">&nbsp;</i>Save</button>
                        </div>
                        <!-- </form> -->
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </form>
        </div>
        <!-- ================================================== End ==================================================== -->
        <!-- =============================================== modal spd ulang ============================================ -->
        <div class="modal fade" id="myModaluploadSPD" tabindex="-1" role="dialog" aria-hidden="true">
            <form role="form" method="post" class="cls_from_sec_room" id="id_form_spd2"  > 
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" id="btnCloseModalUploadSPD">&times;</button>
                            <h4 class="modal-title">Upload SPD</h4>
                        </div>
                        <!-- <form role="form" method="post" class="cls_from_sec_room" id="id_formRoom"  enctype="multipart/form-data" > -->
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-body">
                                    <div class="col-md-12">
                                        <div class="form-group col-md-1"></div>
                                        <div class="form-group col-md-10">
                                            <div class="form-group">
                                                <input type="text" name="ID_TIKET_SPD" id="ID_TIKET_SPD"  style="display: none;"/>
                                                <label><b>Upload SPD apabila belum tersedia :</b></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"> <i class="fa fa-file"></i>
                                                    </span> <input type="file" name="Image_update[]" class="form-control" 
                                                                   id="Image_update" multiple>
                                                </div>
                                            </div>
                                            <div class="panel panel-danger">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Note</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <ul>
                                                        <li>
                                                            Maximum upload size only <strong>5 MB</strong>.
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>         
                        </div>
                        <div class="modal-footer">
                             <button type="button" onclick="uploadUpdateSPD()" disabled="false"  name="btnSimpan" class="btn green" id="buttonnyahidup"  > <i class="fa fa-save">&nbsp;</i>Save</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </form>  
                
        </div>
        <!-- ============================================ end ===================================================== -->

        <?php $this->load->view('app.min.inc.php'); ?>
        <?php $this->load->view('tiket/tiket.js.php'); ?>
        <script>

        </script>

