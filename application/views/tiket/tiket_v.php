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
                <ul class="nav nav-pills">
                    <li class="linav active" id="linav1">
                        <a href="#tab_2_1" data-toggle="tab" id="navitab_2_1" class="anavitab">
                            PR Tiket</a>
                    </li>
                    <li class="linav" id="linav2">
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                            Pilih Travel </a>
                    </li>
                    <li class="linav" id="linav3">
                        <a href="#tab_2_3" data-toggle="tab" id="navitab_2_3" class="anavitab">
                            Up Tiket </a>
                    </li>
                    <li class="linav" id="linav4">
                        <a href="#tab_2_4" data-toggle="tab" id="navitab_2_4" class="anavitab">
                            Add Termin PR </a>
                    </li>
                    <li class="linav" id="linav5">
                        <a href="#tab_2_5" data-toggle="tab" id="navitab_2_5" class="anavitab">
                            Invoice </a>
                    </li>
                    <li class="linav" id="linav6">
                        <a href="#tab_2_6" data-toggle="tab" id="navitab_2_6" class="anavitab">
                            Payment </a>
                    </li>

                </ul> 
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab_2_1">
                        <form role="form" method="post" class="cls_from_sec_room" id="id_formRoom_flow"  enctype="multipart/form-data" > 
                            <!-- <div class="scroller" style="height:400px; "> -->
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
                                    <!-- <div class="form-group col-md-3"></div> -->
                                    <div class="form-group col-md-6">
                                        <!-- <label><b>Tipe Request</b></label> -->
                                        <input type="hidden" name="tiperequest" id="tiperequest" class="form-control">
                                    </div>
                                </div>
                                <!-- <hr width="100%"> -->
                                <div class="col-md-12">
                                    <div class="form-group col-md-6">
                                        <label><b>No Memo, SPD, dll</b></label>
                                        <input type="text" required="required" name="NO_SPD" id="NO_SPD" class="form-control" >
                                        <br>
                                        <label><b>Tanggal PR, Tiket BOX</b></label>
                                   <!--      <input type="text" required="required" name="tanggal_pr" id="tanggal_pr" class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy"> -->
                                         <input type="date" required="required" name="tanggal_pr" id="tanggal_pr" size="16" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group col-md-6">
                                        <!--                             <h3></h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
                                        <!--       <div class="col-md-12"> -->
                                        <div class="form-group">
                                            <label>Please select a file to upload <b>SPD</b> :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"> <i class="fa fa-file"></i>
                                                </span> <input type="file" name="Image[]" class="form-control" 
                                                               id="Image" multiple>
                                            </div>
                                        </div>
                                        <div class="panel panel-danger">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Note</h3>
                                            </div>
                                            <div class="panel-body">
                                                <ul>
                                                    <li>
                                                        Maximum upload size only <strong>0 MB</strong>.
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="" id="pulangpergi">
                                    <div class="col-md-12">
                                        <!--             <div class="form-group col-md-4"></div> -->
                                        <div class="form-group col-md-2">
                                            <center><label><b>Akomodasi</b></label>
                                                <input type="text" required="" name="akomodasi" id="akomodasi" class="form-control" ></center>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <center><label><b>Note</b></label>
                                                <input type="text" required="" name="note" id="note" class="form-control" ></center>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <center><label><b>Asal</b></label>
                                                <input type="text" required="" name="asal_berangkat" id="asal_berangkat" class="form-control" ></center>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <center><label><b>Tujuan</b></label>
                                                <input type="text" required="" name="tujuan_berangkat" id="tujuan_berangkat"  class="form-control" ></center>
                                        </div>
                                        <div class="input-group col-md-2">
                                            <center><label><b>Tanggal Berangkat</b></label>
                                                <div class="input-group"> 
                                                    <input class="form-control date-picker" size="16" type="text" id="tanggal_berangkat" name="tanggal_berangkat" />&nbsp;
                                                    <span class="input-group-btn" style='vertical-align: top;'>
                                                        <a href="javascript:;" class="btn btn-icon-only green" onclick="addjadwal()">
                                                            <i class="fa fa-plus"></i></a></center>
                                                    </span>
                                                </div>
                                        </div>


                                        <div id="pulangpergi1" hidden>
                                            <div class="col-md-12">
                                                <div class="form-group col-md-4">
                                                                 <!--  <center><label><b>Akomodasi</b></label>
                                                                  <input type="text" required="" name="akomodasi_pulang" id="akomodasi" class="form-control" ></center> -->
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <center><label><b>Asal</b></label>
                                                        <input type="text"  name="asal_pulang" id="asal_pulang" class="form-control" ></center>
                                                </div>
                                                <!--             <div class="form-group col-md-4"></div> -->

                                                <div class="form-group col-md-2">
                                                    <center><label><b>Tujuan</b></label>
                                                        <input type="text"  name="tujuan_pulang" id="tujuan_pulang"  class="form-control" ></center>
                                                </div>
                                                <div class="input-group col-md-2">
                                                    <center><label><b>Tanggal Pulang</b></label>
                                                        <div class="input-group"> 
                                                            <input class="form-control e date-picker" size="16" type="text" value="" id="tanggal_pulang" name="tanggal_pulang" />&nbsp;
                                                            <span class="input-group-btn" style='vertical-align: top;'>
                                                                <a href="javascript:;" class="btn btn-icon-only red" onclick="deleterow()">
                                                                    <i class="fa fa-times"></i></a></center>
                                                            </span>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <hr width="100%"> -->
                                        <hr width="100%">
                                        <div class="row" id="id_bank1">
                                            <div class="col-md-12">
                                                <div class="form-group col-md-3">
                                                    <center><label><b>An.</b></label>
                                                        <input type="text" required="" name="atasnama1" id="atasnama1" class="form-control" ></center>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <center><label><b>Jns Identitas</b></label>
                                                            <select required="required" name="jnsidentitas1" class="form-control" id="jnsidentitas1">
                                                                <option value="">- Select -</option>
                                                                <option value="KTP">KTP</option>
                                                                <option value="SIM">SIM</option>
                                                                <option value="PASPOR">PASPOR</option>
                                                            </select></center>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <center><label><b>No Identitas</b></label>
                                                        <input type="number" class="form-control" id="no_identitas1" name="no_identitas1"></center>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label><b>ID Karyawan</b></label>
                                                        <div class="input-group col-md-12">
                                                            <!--   <div class="input-group">  -->
                                                            <input type="text" class="form-control" id="id_kyw1" name="id_kyw1">&nbsp;
                                                            <span class="input-group-btn" style='vertical-align: top;'>
                                                                <a href="javascript:;" class="btn btn-icon-only green" onclick="addbank()">
                                                                    <i class="fa fa-plus"></i></a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                 <!-- ============================================================================================== -->
                                        <div class="row" id="id_bank2">
                                            <div class="col-md-12">
                                                <div class="form-group col-md-3">
                                                    <center><label><b>An.</b></label>
                                                        <input type="text" name="atasnama2" id="atasnama2" class="form-control" ></center>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <center><label><b>Jns Identitas</b></label>
                                                            <select  name="jnsidentitas2" class="form-control" id="jnsidentitas2">
                                                                <option value="">- Select -</option>
                                                                <option value="KTP">KTP</option>
                                                                <option value="SIM">SIM</option>
                                                                <option value="PASPOR">PASPOR</option>
                                                            </select></center>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <center><label><b>No Identitas</b></label>
                                                        <input type="number" class="form-control" id="no_identitas2" name="no_identitas2"></center>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label><b>ID Karyawan</b></label>
                                                        <div class="input-group col-md-12">
                                                            <!--   <div class="input-group">  -->
                                                            <input type="text" class="form-control" id="id_kyw2" name="id_kyw2">&nbsp;

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ================================================================================================================= -->
                                        <div class="row" id="id_bank3">
                                            <div class="col-md-12">
                                                <div class="form-group col-md-3">
                                                    <center><label><b>An.</b></label>
                                                        <input type="text"  name="atasnama3" id="atasnama3" class="form-control" ></center>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <center><label><b>Jns Identitas</b></label>
                                                            <select  name="jnsidentitas3" class="form-control" id="jnsidentitas3">
                                                                <option value="">- Select -</option>
                                                                <option value="KTP">KTP</option>
                                                                <option value="SIM">SIM</option>
                                                                <option value="PASPOR">PASPOR</option>
                                                            </select></center>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <center><label><b>No Identitas</b></label>
                                                        <input type="number" class="form-control" id="no_identitas3" name="no_identitas3"></center>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label><b>ID Karyawan</b></label>
                                                        <div class="input-group col-md-12">
                                                            <!--   <div class="input-group">  -->
                                                            <input type="text" class="form-control" id="id_kyw3" name="id_kyw3">&nbsp;

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- =========================================================================================================== -->
                                        <div class="row" id="id_bank4">
                                            <div class="col-md-12">
                                                <div class="form-group col-md-3">
                                                    <center><label><b>An.</b></label>
                                                        <input type="text" name="atasnama4" id="atasnama4" class="form-control" ></center>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <center><label><b>Jns Identitas</b></label>
                                                            <select  name="jnsidentitas4" class="form-control" id="jnsidentitas4">
                                                                <option value="">- Select -</option>
                                                                <option value="KTP">KTP</option>
                                                                <option value="SIM">SIM</option>
                                                                <option value="PASPOR">PASPOR</option>
                                                            </select></center>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <center><label><b>No Identitas</b></label>
                                                        <input type="number" class="form-control" id="no_identitas4" name="no_identitas4"></center>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label><b>ID Karyawan</b></label>
                                                        <div class="input-group col-md-12">
                                                            <!--   <div class="input-group">  -->
                                                            <input type="text" class="form-control" id="id_kyw4" name="id_kyw4">&nbsp;

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- ======================================================================================================== -->


                                        <br>
                                        <div class="col-md-12">
                                            <div class="form-group col-md-5"></div>
                                            <div class="form-group col-md-7">
                                                <button type ="submit" name="btnSimpan" class="btn blue" id="id_btnSimpan">
                                                    <i class="fa glyphicon glyphicon-arrow-right"></i>&nbsp;Teruskan</button>  

                                            </div>
                                        </div>

                                    </div>
                                    <!-- </div> -->
                                    </form>
                                    <!-- end col-12 -->
                                    <!--</div> -->
                                    <!-- END ROW-->


                                </div>
                                <!-- ================================================ END TAB ========================================================= -->
                                <div class="tab-pane fade" id="tab_2_2">
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
                                          <!--   <div class="form-group col-md-3">
                                                <label>Mulai</label>
                                                <input type="text" required="" name="mulai" id="mulai"  class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Sampai</label>
                                                <input type="text" required="" name="sampai" id="sampai" class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
                                            </div> -->
                                        </div>
                                        <div class="form-group col-md-12">
                                            <button class="btn btn blue" href="#"  onclick="pilihtravel()" data-toggle="modal"  data-target="#myModalpilihtravel">Pilih</button>&nbsp;
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
                                                            <!-- <th>An</th> -->
                                                            <!-- <th>Jenis Identitas</th> -->
                                                            <!-- <th>No Identitas</th> -->
                                                            <th>Asal</th>
                                                            <th>Tujuan</th>
                                                            <!-- <th>Kategori Perjalanan</th> -->
                                                            <th>Tanggal Berangkat</th>
                                                            <th>Tanggal Pulang</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END ROW-->
                                </div>
                                <!-- </div> -->
                                <!-- =============================================== END TAB =========================================================== -->
                                <div class="tab-pane fade" id="tab_2_3">
                                    <!--<div class="scroller" style="height:400px; ">-->
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
                                           <!--  <div class="form-group col-md-3">
                                                <label>Mulai</label>
                                                <input type="text" required="" name="mulai" id="mulai"  class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Sampai</label>
                                                <input type="text" required="" name="sampai" id="sampai" class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
                                            </div> -->
                                        </div>
                                        <div class="col-md-12">
                                            <!-- <button class="btn btn blue" onclick="onLihat()">Lihat</button> -->
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
                                                            <th>Status Akhir</th>
                                                            <th>Tanggal Request</th>
                                                            <th>Travel</th>
                                                            <th>E-Tiket</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>


                                                    </tfoot>
                                                </table>
                                                <!-- </div> -->
                                            </div>
                                        </div>
                                        <!-- end col-12 -->
                                    </div>
                                    <!-- END ROW-->
                                    <!--</div>-->
                                </div>
                                <div class="tab-pane fade" id="tab_2_4">
                                    <!--<div class="scroller" style="height:400px; ">-->
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
                                            <!-- <div class="form-group col-md-3">
                                                <label>Mulai</label>
                                                <input type="text" required="" name="mulai" id="mulai"  class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Sampai</label>
                                                <input type="text" required="" name="sampai" id="sampai"  class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
                                            </div> -->
                                        </div>
                                        <div class="col-md-12">
                                            <!--  &nbsp;&nbsp;&nbsp;&nbsp; <button class="btn btn blue" href="#" onclick="pilihtermin()"  data-toggle="modal"  data-target="#myModalInvoice">Pilih</button> -->
                                        </div>
                                        <div id="divBudget">
                                            <div class="col-md-12" >
                                                <br>
                                                <table class="table table-striped table-bordered table-hover text_kanan" id="table_AddPrto_Inv">
                                                    <thead>
                                                        <tr>
                                                            <th>NO PR</th> 
                                                          <!--   <th></th>    -->  
                                                            <th>Tanggal PR</th>
                                                            <th>No SPD</th>
                                                            <th>File SPD</th>
                                                            <th>Akomodasi</th>
                                                            <th>Asal</th>
                                                            <th>Tujuan</th>
                                                            <!-- <th>Kategori Perjalanan</th> -->
                                                            <th>Tanggal Berangkat</th>
                                                            <th>Tanggal Pulang</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- end col-12 -->
                                    </div>
                                    <!-- END ROW-->
                                </div>
                                <!-- ========================================================================================================= -->
                                <div class="tab-pane fade" id="tab_2_5">
                                    <!--<div class="scroller" style="height:400px; ">-->
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
                                        <div id="divBudget">
                                            <div class="col-md-12" >
                                                <br>
                                                <table class="table table-striped table-bordered table-hover text_kanan" id="table_Invoice">
                                                    <thead>
                                                        <tr>  
                                                            <th>NO PR</th>     
                                                            <th>Termin</th>
                                                            <th>Persentase</th>
                                                            <th>Nilai</th>
                                                            <th>Tgl Jatuh Tempo</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <!-- <button class="btn btn blue" onclick="onLihat()">Pilih</button> -->
                                        </div>
                                        <!-- end col-12 -->
                                    </div>
                                    <!-- END ROW-->
                                    <!--</div>-->
                                </div>


                                <div class="tab-pane fade" id="tab_2_6">
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
                                            <!-- end col-12 -->
                                        </div>
                                        <!-- END ROW-->
                                    </div>
                                </div>    
                            </div>
                    </div>
                </div>
                <!-- END VALIDATION STATES-->
            </div>
        </div>
        <!-- END PAGE CONTENT-->
        <!-- ==================================== Modal Pilih Travel ================================== -->
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
                                                    <th>An.Tiket</th>
                                                    <th>Jenis Identitas</th>
                                                    <th>No Identitas</th>
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
        <!-- ========================================== End Modal =========================================== -->
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
                                            <input type="text" name="ID_TIKET_DETAIL" id="ID_TIKET_DETAIL" style="display: none;" />
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
                            <button type="button" onclick="uploadEtiket()" name="btnSimpan" class="btn green" id="id_btnSimpan"  > <i class="fa fa-save">&nbsp;</i>Save</button>
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
                                                <input type="text" name="ID_TIKET" id="ID_TIKET" style="display: none;" />
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
                            <button type="button" onclick="uploadUpdateSPD()"  name="btnSimpan" class="btn green" id="id_btnSimpan"  > <i class="fa fa-save">&nbsp;</i>Save</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </form>  
                
        </div>
        <!-- ======================================= end ==========================================a=== -->
        <!-- ==========================================modal SET TERMIN======================================= -->
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
                                                            <th>Tanggal Aktual</th>
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
                            <button  type="submit"  class="btn btn-sm btn-success"><i class="fa fa-download"></i>&nbsp;Teruskan</button>
                        </div>
                    </form>
                    <!-- </form> -->
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- ============================================================================================= -->

        <!-- ======================================= MODAL INVOICE ================================================ -->
        <div class="modal fade" id="ModalInputInvoice" tabindex="-1" role="dialog" aria-hidden="true">
            <form role="form" method="post" class="cls_from_sec_room" id="id_form_Invoice_pay"  > 
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" id="btnCloseModalDataTOTALINVOICE">&times;</button>
                            <h4 class="modal-title">INVOICE</h4>
                        </div>
                        <!-- <form role="form" method="post" class="cls_from_sec_room" id="id_formRoom"  enctype="multipart/form-data" > -->
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-body">
                                    <div class="col-md-6">
                                <input class="form-control" type="text" id="ID_TERMIN" name="ID_TERMIN" style="display: none;"    />
                                <input type="text" id="ID_TIKET2" name="ID_TIKET2" style="display: none;"   />
                                <input type="text" id="STATUS" name="STATUS" style="display: none;" />
                                        <label>Jumlah Pembayaran </label> <span class="">*</span>
                                        <input required="required" class="form-control"
                                               type="text" id="NILAI" name="NILAI" readonly  />

                                    </div>
                                </div>
                            </div>         
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

