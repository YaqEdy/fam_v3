
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
                            History PR</a>
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
                                        <label><b>No SPD</b></label>
                                        <input type="text"  autocomplete="OFF" required="required" name="NO_SPD" id="NO_SPD" class="form-control" >
                                        <br>
                                    <div class="input-group col-md-12">
                                         <label><b>Tanggal PR</b></label>
                                                <div class="input-group"> 
                                                    <input class="form-control date-picker" readonly required="required" size="16" type="text" id="tanggal_pr" name="tanggal_pr" autocomplete="OFF" />&nbsp;
                                                    <span class="input-group-btn" style='vertical-align: top;'>
                                                        <a href="javascript:;" disabled class="btn btn-icon-only " >
                                                            <i class="glyphicon glyphicon-calendar"></i></a>
                                                    </span>
                                                </div>
                                        </div>
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
                                                        Maximum upload size only <strong>5 MB</strong>.
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="" id="pulangpergi">
                                    <div class="col-md-12">
                                        <div class="form-group col-md-2">
                                            <center><label><b>Akomodasi</b></label>
                                                            <select required="required" name="akomodasi" class="form-control" id="akomodasi">
                                                                <option value="">- Select -</option>
                                                                <option value="PESAWAT">PESAWAT</option>
                                                                <option value="KERETA">KERETA</option>
                                                            </select></center>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <center><label><b>Maskapai/Armada</b></label>
                                            <input type="text" required=""  autocomplete="OFF" name="note" id="note" class="form-control" ></input>
                                        </center>
                                    </div>
                                <div class="form-group col-md-2">
                            <center><label><b>Asal</b></label>
                                 <input type="text" required=""  autocomplete="OFF" name="asal_berangkat" id="asal_berangkat" class="form-control" ></center>
                            </div>
                        <div class="form-group col-md-2">
                            <center><label><b>Tujuan</b></label>
                                <input type="text" required=""  autocomplete="OFF" name="tujuan_berangkat" id="tujuan_berangkat"  class="form-control" ></center>
                                    </div>
                                <div class="input-group col-md-2">
                                    <center><label><b>Tanggal Berangkat</b></label>
                                        <div class="input-group"> 
                                            <input style="width:200px;" class="form-control date-picker" readonly size="16" type="text" id="tanggal_berangkat" name="tanggal_berangkat" />
                                            <span class="input-group-btn">
                                            <button class="btn default date-set" type="button">
                                            <i class="fa fa-calendar"></i>
                                            </button>
                                                <a href="javascript:;" class="btn btn-icon-only green" onclick="addjadwal()">
                                                <i class="fa fa-plus"></i></a></center>
                                            </span>
                                        </div>
                                    </div>
                                        <div id="pulangpergi1" hidden>
                                            <div class="col-md-12">
                                                <div class="form-group col-md-4"> </div>
                                                <div class="form-group col-md-2">
                                                    <center><label><b>Asal</b></label>
                                                        <input type="text"  autocomplete="OFF"  name="asal_pulang" id="asal_pulang" class="form-control" ></center>
                                                </div>
                                                <!--             <div class="form-group col-md-4"></div> -->

                                                <div class="form-group col-md-2">
                                                    <center><label><b>Tujuan</b></label>
                                                        <input type="text"  autocomplete="OFF"  name="tujuan_pulang" id="tujuan_pulang"  class="form-control" ></center>
                                                </div>
                                                <div class="input-group col-md-2">
                                                    <center><label><b>Tanggal Pulang</b></label>
                                                        <div class="input-group"> 
                                                            <input style="width:200px;" class="form-control date-picker" readonly size="16" type="text" value="" id="tanggal_pulang" name="tanggal_pulang" />
                                                            <span class="input-group-btn">
                                                        <button class="btn default date-set" type="button">
                                                            <i class="fa fa-calendar"></i>
                                                        </button>
                                                           <a href="javascript:;" class="btn btn-icon-only red" onclick="deleterow()">
                                                                <i class="fa fa-times"></i></a></center>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                     </div>
                    <hr width="100%">
                        <div class="col-sm-12">
                            <center><a href="javascript:;" style="width:150px;" class="btn btn-outline btn-icon-only yellow" onclick="addbank()">
                                <i class="fa fa-plus"></i>Tambah Karyawan</a></center>
                        </div>
<!-- ================================================================================================================ -->
                                   <div class="row" id="id_bank1">
                                            <div class="col-md-12">
                                                <div class="form-group col-md-3">
                                                    <center><label><b>An.</b></label>
                                                        <input autocomplete="OFF" type="text" required="" name="atasnama1" id="atasnama1" class="form-control" ></center>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <center><label><b>Gender</b></label>
                                                            <select required="required" name="GENDER1" class="form-control" id="GENDER1">
                                                                <option value="">- Select -</option>
                                                                <option value="PRIA">PRIA</option>
                                                                <option value="WANITA">WANITA</option>
                                                            </select></center>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <center><label><b>No Telpon</b></label>
                                                        <input autocomplete="OFF" type="text" required="" name="NO_HP1" id="NO_HP1" class="form-control nomor1" ></center>
                                            </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <center><label><b>Jns Identitas</b></label>
                                                            <select  required="required" name="jnsidentitas1" class="form-control" id="jnsidentitas1">
                                                                <option value="">- Select -</option>
                                                                <option value="KTP">KTP</option>
                                                                <option value="SIM">SIM</option>
                                                                <option value="PASPOR">PASPOR</option>
                                                            </select></center>
                                                    </div>
                                                </div>
                                                </div>
                                            <div class="col-sm-12">
                                                <div class="form-group col-md-3">
                                                    <div class="form-group">
                                                        <center><label><b>Divisi</b></label></center>
                                                        <div class="input-group col-md-12">
                                                            <input autocomplete="OFF" type="text" required="" name="DIV1" id="DIV1" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="form-group col-md-3">
                                                    <div class="form-group">
                                                        <center><label><b>Jabatan</b></label></center>
                                                        <div class="input-group col-md-12">
                                                            <input  type="text" required="" name="JABATAN1" id="JABATAN1" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="form-group col-md-3">
                                                    <center><label><b>No Identitas</b></label>
                                                        <input autocomplete="OFF" type="text" class="form-control nomor1" id="no_identitas1" name="no_identitas1"></center>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label><b>ID Karyawan</b></label>
                                                        <div class="input-group col-md-12">
                                                            <input type="text" autocomplete="OFF" class="form-control" id="id_kyw1" name="id_kyw1">
                                                        </div>
                                                    </div>
                                                </div>
                                             </div>
                                         </div>
                 <!-- ============================================================================================== -->
                                        <div class="row" id="id_bank2">
                                            <hr width="100%">
                                            <div class="col-md-12">
                                                <div class="form-group col-md-3">
                                                    <center><label><b>An.</b></label>
                                                        <input autocomplete="OFF" type="text" name="atasnama2" id="atasnama2" class="form-control" ></center>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <center><label><b>Gender</b></label>
                                                            <select name="GENDER2" class="form-control" id="GENDER2">
                                                                <option value="">- Select -</option>
                                                                <option value="PRIA">PRIA</option>
                                                                <option value="WANITA">WANITA</option>
                                                            </select></center>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <center><label><b>No Telpon</b></label>
                                                        <input type="text" autocomplete="OFF" name="NO_HP2" id="NO_HP2" class="form-control nomor1" ></center>
                                            </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <center><label><b>Jns Identitas</b></label>
                                                            <select name="jnsidentitas2" class="form-control" id="jnsidentitas2">
                                                                <option value="">- Select -</option>
                                                                <option value="KTP">KTP</option>
                                                                <option value="SIM">SIM</option>
                                                                <option value="PASPOR">PASPOR</option>
                                                            </select></center>
                                                    </div>
                                                </div>
                                                </div>
                                            <div class="col-sm-12">
                                                <div class="form-group col-md-3">
                                                    <div class="form-group">
                                                        <center><label><b>Divisi</b></label></center>
                                                        <div class="input-group col-md-12">
                                                            <input autocomplete="OFF" type="text" name="DIV2" id="DIV2" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="form-group col-md-3">
                                                    <div class="form-group">
                                                        <center><label><b>Jabatan</b></label></center>
                                                        <div class="input-group col-md-12">
                                                            <input autocomplete="OFF" type="text" name="JABATAN2" id="JABATAN2" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="form-group col-md-3">
                                                    <center><label><b>No Identitas</b></label>
                                                        <input autocomplete="OFF" type="text" class="form-control nomor1" id="no_identitas2" name="no_identitas2"></center>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label><b>ID Karyawan</b></label>
                                                        <div class="input-group col-md-12">
                                                            <input autocomplete="OFF" type="text" class="form-control" id="id_kyw2" name="id_kyw2">
                                                        </div>
                                                    </div>
                                                </div>
                                             </div>
                                         </div>
 <!-- ================================================================================================================= -->
                                        <div class="row" id="id_bank3">
                                             <hr width="100%">
                                            <div class="col-md-12">
                                                <div class="form-group col-md-3">
                                                    <center><label><b>An.</b></label>
                                                        <input autocomplete="OFF" type="text" name="atasnama3" id="atasnama3" class="form-control" ></center>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <center><label><b>Gender</b></label>
                                                            <select name="GENDER3" class="form-control" id="GENDER3">
                                                                <option value="">- Select -</option>
                                                                <option value="PRIA">PRIA</option>
                                                                <option value="WANITA">WANITA</option>
                                                            </select></center>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <center><label><b>No Telpon</b></label>
                                                        <input autocomplete="OFF" type="text" name="NO_HP3" id="NO_HP3" class="form-control nomor1" ></center>
                                            </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <center><label><b>Jns Identitas</b></label>
                                                            <select name="jnsidentitas3" class="form-control" id="jnsidentitas3">
                                                                <option value="">- Select -</option>
                                                                <option value="KTP">KTP</option>
                                                                <option value="SIM">SIM</option>
                                                                <option value="PASPOR">PASPOR</option>
                                                            </select></center>
                                                    </div>
                                                </div>
                                                </div>
                                            <div class="col-sm-12">
                                                <div class="form-group col-md-3">
                                                    <div class="form-group">
                                                        <center><label><b>Divisi</b></label></center>
                                                        <div class="input-group col-md-12">
                                                            <input autocomplete="OFF" type="text" name="DIV3" id="DIV3" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="form-group col-md-3">
                                                    <div class="form-group">
                                                        <center><label><b>Jabatan</b></label></center>
                                                        <div class="input-group col-md-12">
                                                            <input autocomplete="OFF" type="text" name="JABATAN3" id="JABATAN3" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="form-group col-md-3">
                                                    <center><label><b>No Identitas</b></label>
                                                        <input autocomplete="OFF" type="text" class="form-control nomor1" id="no_identitas3" name="no_identitas3"></center>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label><b>ID Karyawan</b></label>
                                                        <div class="input-group col-md-12">
                                                            <input autocomplete="OFF" type="text" class="form-control" id="id_kyw3" name="id_kyw3">
                                                        </div>
                                                    </div>
                                                </div>
                                             </div>
                                         </div>
     <!-- =========================================================================================================== -->
                                        <div class="row" id="id_bank4">
                                            <hr width="100%">
                                            <div class="col-md-12">
                                                <div class="form-group col-md-3">
                                                    <center><label><b>An.</b></label>
                                                        <input autocomplete="OFF" type="text" name="atasnama4" id="atasnama4" class="form-control" ></center>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <center><label><b>Gender</b></label>
                                                            <select name="GENDER4" class="form-control" id="GENDER4">
                                                                <option value="">- Select -</option>
                                                                <option value="PRIA">PRIA</option>
                                                                <option value="WANITA">WANITA</option>
                                                            </select></center>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <center><label><b>No Telpon</b></label>
                                                        <input autocomplete="OFF" type="text" name="NO_HP4" id="NO_HP4" class="form-control nomor1" ></center>
                                            </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <center><label><b>Jns Identitas</b></label>
                                                            <select name="jnsidentitas4" class="form-control" id="jnsidentitas4">
                                                                <option value="">- Select -</option>
                                                                <option value="KTP">KTP</option>
                                                                <option value="SIM">SIM</option>
                                                                <option value="PASPOR">PASPOR</option>
                                                            </select></center>
                                                    </div>
                                                </div>
                                                </div>
                                            <div class="col-sm-12">
                                                <div class="form-group col-md-3">
                                                    <div class="form-group">
                                                        <center><label><b>Divisi</b></label></center>
                                                        <div class="input-group col-md-12">
                                                            <input autocomplete="OFF" type="text" name="DIV4" id="DIV4" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="form-group col-md-3">
                                                    <div class="form-group">
                                                        <center><label><b>Jabatan</b></label></center>
                                                        <div class="input-group col-md-12">
                                                            <input autocomplete="OFF" type="text" name="JABATAN4" id="JABATAN4" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="form-group col-md-3">
                                                    <center><label><b>No Identitas</b></label>
                                                        <input autocomplete="OFF" type="text" class="form-control nomor1" id="no_identitas4" name="no_identitas4"></center>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label><b>ID Karyawan</b></label>
                                                        <div class="input-group col-md-12">
                                                            <input autocomplete="OFF" type="text" class="form-control" id="id_kyw4" name="id_kyw4">
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
                                </form>
                            </div>
                        </div>
                    <!-- </div> -->
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
                                        </div>
                                        <div class="form-group col-md-12">
                             <!--                <button class="btn btn blue" href="#"  onclick="pilihtravel()" data-toggle="modal"  data-target="#myModalpilihtravel">Pilih</button>&nbsp; -->
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12" >
                                                <br>
                                                <table class="table table-striped table-bordered table-hover text_kanan" id="TableHistoryPR">
                                                    <thead>
                                                        <tr>
                                                            <!-- <th>No PR</th> -->
                                                            <!-- <th></th> -->
                                                            <th>No PR</th>
                                                            <th>No SPD</th>     
                                                            <th>Tgl PR</th>
                                                            <th>An. Tiket</th>
                                                            <th>DIV</th>
                                                            <th>JABATAN</th>
                                                            <th>File SPD</th>
                                                            <th>Via</th>
                                                            <th>Maskapai</th>
                                                            <th>Asal</th>
                                                            <th>Tujuan</th>
                                                            <th>Tanggal Berangkat</th>
                                                            <th>Tanggal Pulang</th>
                                                             <th>Aksi</th> 
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END ROW-->
                                </div>
        <!-- ========================================Modal Travel====================================== -->
        <div class="modal fade draggable-modal" id="ModalHistoryPR" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close"  data-dismiss="modal" id="btnCloseModalcetakxl">&times;</button>
                        <h4 class="modal-title">Note</h4>
                    </div>
                    <form role="form" method="post" class="cls_from_sec_room" id="id_formRoom"  enctype="multipart/form-data" >
                        <div class="modal-body">
                                           <div class="form-group col-md-4">
                                           <textarea class="form-control" rows="3"></textarea>
                                        </div>
                                    <button class="btn btn blue" href="#" data-toggle="modal"  data-target="#">Send</button>

                            <div class="row">
                                <div class="form-body">
                                    <div class="col-md-12">  
                                        <table class="table table-striped table-bordered table-hover text_kanan" id="table_popupHisto">
                                            <thead>
                                                <tr>
                                                <th>User</th> 
                                                <th>Note</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>         
                        </div>
                        <div class="modal-footer">
                            <a id="idCetak" class="btn btn-sm btn-success"><i class="fa fa-save"></i>&nbsp;Simpan</a>
                            <!--                 <button type="button" class="btn dark btn-outline" data-dismiss="modal">Teruskan</button> -->
                        </div>
                         </form> 
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <!-- =========================================== AJAX ============================================ -->

        <?php $this->load->view('app.min.inc.php'); ?>
        <?php $this->load->view('tiket/tiket.js.php'); ?>
        <script>

        </script>

