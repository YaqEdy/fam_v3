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
                <div class="tab-content">
                  
                                <!-- <div class="tab-pane fade" id="tab_2_2"> -->
                                    <div class="scroller" style="height:750px; ">
                                        <!-- <div class="scroller" style="width:1200px; "> -->
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
                                        <div class="col-md-12">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <button class="btn btn blue" href="#"  onclick="pilihtravel()" data-toggle="modal"  data-target="#myModalpilihtravel">Cetak & Pilih Travel</button>&nbsp;
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12" >
                                                <br>
                                                <table class="table table-striped table-bordered table-hover text_kanan" id="TabelPilihTravel">
                                                    <thead>
                                                        <tr>
                                                            <th>No PR</th>
                                                            <th></th>
                                                            <th>No PR</th>     
                                                            <th>Tgl PR</th>
                                                            <th>No SPD</th>
                                                            <th>File SPD</th>
                                                            <th>Via</th>
                                                            <th>Maskapai</th>
                                                            <th>Asal</th>
                                                            <th>Tujuan</th>
                                                            <th>Tanggal Berangkat</th>
                                                            <th>Tanggal Pulang</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                <!-- </div> -->
                                    </div>
                                </div>
<!-- ========================================= Modal Pilih Travel ========================================= -->
        <div class="modal fade draggable-modal" id="myModalpilihtravel" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close"  data-dismiss="modal" id="btnCloseModalcetakxl">&times;</button>
                        <h4 class="modal-title">Pilih Travel</h4>
                    </div>
                    <form role="form" method="post" class="cls_from_sec_room" id="id_formRoom"  enctype="multipart/form-data" >
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-body">
                                    <div class="col-md-12">
                                        <div class="form-group col-md-3">
                                            <label>Tanggal Kirim</label>
                                            <input type="text" value="<?php echo date('d-m-Y') ?>" name="tanggal_kirim" id="tanggal_kirim" onchange="onc_tglkrm()"  class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group col-md-6">
                                            <!-- <div class="form-group"> -->
                                            <label>Vendor</label> <span class="">*</span>
                                            <?php
                                            $data = array();
                                            $data[''] = '';
                                            foreach ($dd_vendor as $row) :
                                                $data[$row->VendorName] = $row->VendorName;
                                            endforeach;
                                            echo form_dropdown('VendorName', $data, '', 'id="VendorNameID"  onchange="onc_vendor()" class="form-control  input-sm select2me"');
                                            ?>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <h4>Data Pesanan</h4>
                                        <table class="table table-striped table-bordered table-hover text_kanan" id="table_grid_PilihTravel">
                                            <thead>
                                                <tr> 
                                                    <th>PR Detail</th>
                                                    <th>An.Tiket</th>
                                                    <th>Gender</th>
                                                    <th>No HP</th>
                                                    <th>Jenis Identitas</th>
                                                    <th>No Identitas</th>
                                                    <th>Divisi</th>
                                                    <th>Jabatan</th>
                                                    <th>Id Karyawan</th>
                                                    <!--<th></th>-->
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>         
                        </div>
                        <div class="modal-footer">
                            <a id="idCetak" onclick="rld_setPR()" class="btn btn-sm btn-success" href="<?php echo base_url("/tiket/tiket/downloadTiket"); ?>"><i class="fa fa-download"></i>&nbsp;Cetak</a>
                            <!--                 <button type="button" class="btn dark btn-outline" data-dismiss="modal">Teruskan</button> -->
                        </div>
                         </form> 
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
<!-- =============================================== END TAB =========================================================== -->

        <?php $this->load->view('app.min.inc.php'); ?>
        <?php $this->load->view('tiket/tiket.js.php'); ?>
        <script>

        </script>

