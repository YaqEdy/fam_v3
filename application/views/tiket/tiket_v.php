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
                    Add PR to Inv </a>
                </li>
                <li class="linav" id="linav5">
                    <a href="#tab_2_5" data-toggle="tab" id="navitab_2_5" class="anavitab">
                    Set Termin </a>
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
                            <!-- <div class="form-group col-md-3"></div> -->
                            <div class="form-group col-md-6">
                               <label><b>Tipe Request</b></label>
                               <input type="text" name="tiperequest" id="tiperequest" class="form-control">
                           </div>
                       </div>
                       <hr width="100%">
                       <div class="col-md-12">
                        <div class="form-group col-md-6">
                            <label><b>No Memo, SPD, dll</b></label>
                            <input type="text" required="required" name="NO_SPD" id="NO_SPD" class="form-control" >
                            <br>
                            <label><b>Tanggal PR, Tiket BOX</b></label>
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
                                <!-- </div> -->
                                <!--  <button class="btn btn blue" href="#"  data-toggle="modal"  data-target="#myModalpilihtravel">Pilih</button>&nbsp; -->
                                <!--         <a class="btn btn-md btn-primary" href="#" id="btnUpdate" data-toggle="modal" data-target="#myUpload">Upload</a>  -->
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
                                                                         <option value="1">KTP</option>
                                                                         <option value="2">SIM</option>
                                                                         <option value="3">PASPOR</option>
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
                                                                             <option value="1">KTP</option>
                                                                             <option value="2">SIM</option>
                                                                             <option value="3">PASPOR</option>
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
                                                                                 <option value="1">KTP</option>
                                                                                 <option value="2">SIM</option>
                                                                                 <option value="3">PASPOR</option>
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
                                                                                     <option value="1">KTP</option>
                                                                                     <option value="2">SIM</option>
                                                                                     <option value="3">PASPOR</option>
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
                                                                            <i class="fa glyphicon glyphicon-arrow-right" ></i>&nbsp;Teruskan</button>  

                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <!-- </div> -->
                                                            </form>
                                                            <!-- end col-12 -->
                                                            <!--                         </div> -->
                                                            <!-- END ROW-->


                                                        </div>

  <!-- =========================================== END TAB ============================================================= -->
      <div class="tab-pane fade" id="tab_2_2">
           <div class="scroller" style="height:750px; ">
            <!-- <div class="scroller" style="width:1200px; "> -->
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
          <input type="text" required="" name="mulai" id="mulai"  class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
     </div>
         <div class="form-group col-md-3">
              <label>Sampai</label>
                  <input type="text" required="" name="sampai" id="sampai" class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
             </div>
        </div>
     <div class="form-group col-md-12">
         <button class="btn btn blue" href="#"  onclick="pilihtravel()" data-toggle="modal"  data-target="#myModalpilihtravel">Pilih</button>&nbsp;
             </div>
      <!-- <div id="divBudget"> -->
        <!-- <div class="row" style="margin-top: 6%;"> -->
           <div class="col-md-12" >
            <br>
            <div style="overflow-x:auto;">
            <table class="table table-striped table-responsive table-bordered table-hover text_kanan" style="width:1200px;" id="TabelPilihTravel">
                         <thead>
                            <tr>
                                 <th>No</th>
                                <th></th>
                                <th>No PR</th>     
                                <th>Tgl PR</th>
                                <th>No SPD</th>
                                <th>File SPD</th>
                                <th>Via</th>
                                <th>An</th>
                                <th>Jenis Identitas</th>
                                <th>No Identitas</th>
                                <th>Asal</th>
                                <th>Tujuan</th>
                                <th>Kategori Perjalanan</th>
                                <th>Tanggal Berangkat</th>
                                <th>Tanggal Pulang</th>
                            </tr>
                        </thead>
                    </table>
                 </div>
              </div>
          <!-- </div> -->
          </div>
  <!-- end col-12 -->
      <!-- </div> -->
      </div>
    <!-- END ROW-->
</div>
<!-- </div> -->
 <!-- =============================================== END TAB ========================================== -->
                                                    <div class="tab-pane fade" id="tab_2_3">
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
                                                                        <input type="text" required="" name="mulai" id="mulai"  class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <label>Sampai</label>
                                                                        <input type="text" required="" name="sampai" id="sampai" class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <!-- <button class="btn btn blue" onclick="onLihat()">Lihat</button> -->
                                                                </div>

                                                                <div id="divBudget">
                                                                    <div class="col-md-12" >
                                                                        <br>
                                                                        <div style="overflow-x:auto;">
                                                                        <table class="table table-striped table-bordered table-hover text_kanan" id="up">
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
                                                                                    <th>Aksi</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>5</td>
                                                                                    <td>12-12-2018</td>
                                                                                    <td>1234</td>
                                                                                    <td>Ada</td>
                                                                                    <td>Susi</td>
                                                                                    <td>KTP</td>
                                                                                    <td>1234</td>
                                                                                    <td>Ada</td>
                                                                                    <td>Susi</td>
                                                                                    <td>KTP</td>
                                                                                    <td>1234</td>
                                                                                    <td>Ada</td>
                                                                                    <td>Susi</td>
                                                                                    <td>KTP</td>
                                                                                    <td>12343243432334</td>
                                                                                    <!--         <td>JKT</td> -->
                                                                                    <td><a href="#" data-toggle="modal"  data-target="#myModalUploadEtiket" class="btn btn-xs btn-primary">Upload E-Tiket</a></td>
                                                                                </tr>
                                                                                <tr>
                                                                                </tr>
                                                                            </tbody>
                                                                            <tfoot>


                                                                            </tfoot>
                                                                        </table>
                                                                    </div>
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
                                                                            <input type="text" required="" name="mulai" id="mulai"  class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label>Sampai</label>
                                                                            <input type="text" required="" name="sampai" id="sampai"  class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <button class="btn btn blue" onclick="onLihat()">Pilih</button>
                                                                    </div>
                           <!--  <div class="col-md-12">
                                <button class="btn btn blue" onclick="onLihat()">Lihat</button>
                            </div> -->

                            <div id="divBudget">
                                <div class="col-md-12" >
                                    <br>
                                    <table class="table table-striped table-bordered table-hover text_kanan" id="add">
                                        <thead>
                                            <tr>
                                                <th></th>     
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
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="checkbox" name="check"></td>
                                                <td>12</td>
                                                <td>12-12-2018</td>
                                                <td>1234</td>
                                                <td>Ada</td>
                                                <td>Susi</td>
                                                <td>KTP</td>
                                                <td>12343243432334</td>
                                                <td>JKT</td>
                                                <td>BDO</td>
                                                <td>PP</td>
                                                <td>12-12-2012</td>
                                                <td>12-12-2012</td>
                                                <td>Pending</td>
                                                <td>21-21-2012</td>
                                                <td></td>
                                                <td>
                                                    <a href="#" class="btn btn-xs btn-primary spd">SPD</a><a href="#" class="btn btn-xs btn-primary spd">Tiket</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" name="check"></td>
                                                <td>12</td>
                                                <td>12-12-2018</td>
                                                <td>1234</td>
                                                <td>Ada</td>
                                                <td>Susi</td>
                                                <td>KTP</td>
                                                <td>12343243432334</td>
                                                <td>JKT</td>
                                                <td>BDO</td>
                                                <td>PP</td>
                                                <td>12-12-2012</td>
                                                <td>12-12-2012</td>
                                                <td>Pending</td>
                                                <td>21-21-2012</td>
                                                <td></td>
                                                <td>
                                                    <a href="#" class="btn btn-xs btn-primary spd">SPD</a><a href="#" class="btn btn-xs btn-primary spd">Tiket</a>
                                                </td>
                                            </tr>
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
                    <div class="tab-pane fade" id="tab_2_5">
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
                                        <input type="text" required="" name="mulai" id="mulai"  class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Sampai</label>
                                        <input type="text" required="" name="sampai" id="sampai" class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
                                    </div>
                                </div>
                           <!--  <div class="col-md-12">
                                <button class="btn btn blue" onclick="onLihat()">Lihat</button>
                            </div> -->

                            <div id="divBudget">
                                <div class="col-md-12" >
                                    <br>
                                    <table class="table table-striped table-bordered table-hover text_kanan" id="set">
                                        <thead>
                                            <tr>
                                                <th></th>     
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
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="checkbox" name="check"></td>
                                                <td>12</td>
                                                <td>12-12-2018</td>
                                                <td>1234</td>
                                                <td>Ada</td>
                                                <td>Susi</td>
                                                <td>KTP</td>
                                                <td>12343243432334</td>
                                                <td>JKT</td>
                                                <td>BDO</td>
                                                <td>PP</td>
                                                <td>12-12-2012</td>
                                                <td>12-12-2012</td>
                                                <td>Pending</td>
                                                <td>21-21-2012</td>
                                                <td></td>
                                                <td>
                                                    <a href="#" class="btn btn-xs btn-primary spd">SPD</a><a href="#" class="btn btn-xs btn-primary spd">Tiket</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" name="check"></td>
                                                <td>12</td>
                                                <td>12-12-2018</td>
                                                <td>1234</td>
                                                <td>Ada</td>
                                                <td>Susi</td>
                                                <td>KTP</td>
                                                <td>12343243432334</td>
                                                <td>JKT</td>
                                                <td>BDO</td>
                                                <td>PP</td>
                                                <td>12-12-2012</td>
                                                <td>12-12-2012</td>
                                                <td>Pending</td>
                                                <td>21-21-2012</td>
                                                <td></td>
                                                <td>
                                                    <a href="#" class="btn btn-xs btn-primary spd">SPD</a><a href="#" class="btn btn-xs btn-primary spd">Tiket</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>


                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn blue" onclick="onLihat()">Pilih</button>
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
                                        <input type="text" required="" name="mulai" id="mulai"  class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Sampai</label>
                                        <input type="text" required="" name="sampai" id="sampai" class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn blue" onclick="onLihat()">Lihat</button>
                                </div>

                                <div id="divBudget">
                                    <div class="col-md-12" >
                                        <br>
                                        <table class="table table-striped table-bordered table-hover text_kanan" id="payment">
                                            <thead>
                                                <tr>
                                                    <th>Invoice Group</th>     
                                                    <th>Tanggal Invoice</th>
                                                    <th>Jumlah PR</th>
                                                    <th>Travel</th>
                                                    <th>Jumlah Invoice</th>
                                                    <th>Status Payment</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>212</td>
                                                    <td>21-12-2012</td>
                                                    <td>21</td>
                                                    <td>Trans</td>
                                                    <td>13</td>
                                                    <td>Pending</td>
                                                </tr>
                                                <tr>
                                                    <td>212</td>
                                                    <td>21-12-2012</td>
                                                    <td>21</td>
                                                    <td>Trans</td>
                                                    <td>13</td>
                                                    <td>Pending</td>
                                                </tr>
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
                    </div>    
                </div>

            </div>
        </div>
        <!-- END VALIDATION STATES-->
    </div>
</div>

<!-- END PAGE CONTENT-->

<!-- ============================================ Modal Pilih Travel ===================================================== -->

<div class="modal fade draggable-modal" id="myModalpilihtravel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
             <button type="button" class="close"  data-dismiss="modal" id="btnCloseModalDataBarang3">&times;</button>
             <h4 class="modal-title">Pilih Travel</h4>
         </div>
         <!-- <form role="form" method="post" class="cls_from_sec_room" id="id_formRoom"  enctype="multipart/form-data" > -->
            <div class="modal-body">
                <div class="row">
                    <div class="form-body">
                        <div class="col-md-12">
                            <div class="form-group col-md-3">
                                <label>Tanggal Kirim</label>
                                <input type="text" required="" name="tanggal_kirim" id="tanggal_kirim"  class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
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
                                        $data[$row->Raw_ID] = $row->VendorName;
                                    endforeach;
                                    echo form_dropdown('Raw_ID', $data, '', 'id="VendorNameID" class="form-control  input-sm select2me" required="required"');
                                    ?>
                                <!-- </div> -->
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group col-md-6">
                                <label>Mulai</label>
                                <input type="date-picker" required="" name="mulai" id="mulai" class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Sampai</label>
                                <input type="date-picker" required="" name="sampai" id="sampai" class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h4>Data Pesanan</h4>
                      <div style="overflow-x:auto;"> 
                        <table class="table table-striped table-bordered table-hover text_kanan" id="table_grid_PilihTravel">
                              <thead>
                                <tr> 
                                 <!-- <th class='row-2'>Pilih</th>     -->
                                 <th>Akomodasi</th>
                                 <th>An.Tiket</th>
                                 <th>Jenis Identitas</th>
                                 <th>No Identitas</th>
                                 <th>Asal</th>
                                 <th>Tujuan</th>
                                 <th>Kategori Perjalanan</th> 
                                 <th>Tgl Berangkat</th>
                                 <th>Tgl Pulang</th>
                             </tr>
                         </thead>
                         <tbody>                                           
                         </tbody>
                         <tfoot>
                         </tfoot>
                     </table>
                 </div>
              </div>
             </div>
         </div>         
     </div>
     <div class="modal-footer">
      <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
      <button type="button" name="btnSimpan" class="btn green" onclick="daftar_pr()" id="id_btnSimpan"  >&nbsp;</i>Kirim</button>
  </div>
  <!-- </form> -->
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>

<!-- ============================================== End Modal ========================================================= -->

<!-- =================================================== Upload E- Tiket ============================================== -->
<div class="modal fade" id="myModalUploadEtiket" tabindex="-1" role="dialog" aria-hidden="true">
 <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close"  data-dismiss="modal" id="btnCloseModalDataBarang3">&times;</button>
         <h4 class="modal-title">Upload E-Tiket</h4>
     </div>
     <!-- <form role="form" method="post" class="cls_from_sec_room" id="id_formRoom"  enctype="multipart/form-data" > -->
        <div class="modal-body">
            <div class="row">
                <div class="form-body">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>QTY</label> <span class="required">*</span>
                            <input required="required" class="form-control" type="text" id="QTY" name="QTY"/>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>An.Tiket</label> <span class="required">*</span>
                            <input required="required" class="form-control" type="text" id="an_tiket" name="an_tiket"/>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Kode Booking</label> <span class="required">*</span>
                            <input required="required" class="form-control" type="text" id="kode_booking" name="kode_booking"/>
                        </div>
                    </div>
                </div>
            </div>         
        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button> -->
          <button type="submit" name="btnSimpan" class="btn green" onclick="daftar_pr()" id="id_btnSimpan"  > <i class="fa fa-save">&nbsp;</i>Save</button>
      </div>
      <!-- </form> -->
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>

<!-- ========================================================== End ========================================================== -->

<!-- ========================================================= MODAL UPLOAD ================================================ -->

<!--Modal Add-->
<div id="myUpload" class="modal fade" >
    <form class="validator-form form-horizontal" id="fmsaveUpload" action="" enctype="multipart/form-data" method="POST">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Upload</h4>
                </div>
                <div class="modal-body" >
       <!--              <div class="form-group">
                        <label class="control-label col-sm-3">Zone Name</label>
                        <div class="col-sm-7">
                            <div id="ddZone2"></div>                
                        </div>
                    </div>   -->
                    <div class="form-group">
                        <label class="control-label col-sm-3">Upload File (.xlsx/.xls)</label>
                        <div class="col-sm-7">
                            <input type="file" class="form-control" name="namafile" id="namafile" required>                
                        </div>
                    </div>  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="closeupload">Close</button>
                    <button type="submit" class="btn btn-primary" name="Submit" value="Submit" id="simandata">Save</button>     
                </div>
            </div>
        </div>
    </form>
</div>

<!-- ==================================== AJAX ============================================================= -->

<?php $this->load->view('app.min.inc.php'); ?>
<script>

      var dataTable, dataTable1, dataTable2, dataTable3;
    var iStatus = '%';
    var iSearch = 'NO_SPD';
    var iZone = 1;
    var iID_TIKET = '';
    var iSES = '';

    jQuery(document).ready(function () {
        ComponentsDateTimePickers.init();
        loadGridPilihTiket();
        loadGridPilihPRpopUp();

       });



    // function search(e) {
    //     iSearch = e;
    // }

    function deleterow() {
        document.getElementById('pulangpergi1').style.display = "none";
                       // $('#pulangpergi1').show();
                       // readyToStart('pulangpergi1');
//           $('#pulangpergi1').style.display = "none";
}


function getNum(elem) {

}

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

window.onload = function () {
    $('#id_bank2').hide();
    $('#id_bank3').hide();
    $('#id_bank4').hide();

};

window.onload2 = function () {
    $('#pulangpergi1').hide();

};

function hidden() {
 document.getElementById('id_bank2').style.display = "none";
 document.getElementById('id_bank3').style.display = "none";
 document.getElementById('id_bank4').style.display = "none";

}

function hiddenjadwal() {
 document.getElementById('pulangpergi1').style.display = "none";


}

var pp=0;
function addjadwal() {

                // alert('addbank');
                if(pp==0){
                    $('#pulangpergi1').show();
                }
                pp=pp+1;
            }

            var ibank=1;
            function addbank() {

                // alert('addbank');
                if(ibank==1){
                    $('#id_bank2').show();
                }else if(ibank==2){
                    $('#id_bank3').show();
                }else if(ibank==3){
                    $('#id_bank4').show();
                }
                if(ibank<4){
                    ibank=ibank+1;                    
                }
            }

            $('#id_formRoom_flow').submit(function (event) {
        // alert('asd');
        var r = confirm('Do you want to save this file ?');
        if (r == true) {
            $.ajax({
            url: "simpan/"+ibank, // json datasource
            type: 'POST',
            data: new FormData(this),
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (e) {
                if(e.act){
                    UIToastr.init(e.tipePesan, e.pesan);
                    iPID=e.iPid;
                    $("#id_btnBatal22").trigger('click');

                }else{
                    UIToastr.init(e.tipePesan, e.pesan);
                }
            },
        }); 
            event.preventDefault(); 
            } else {//if(r)
                return false;
            }

        });

      function pilihPR (){
         var selected = dataTable.column(1).checkboxes.selected();
        // console.log(selected); 
        iID_TIKET = iID_TIKET + selected.join(',');
        console.log(iID_TIKET);
        $.ajax({
            url: "teruskan_tiketPR", // json datasource
            type: 'POST',
            data: {sID_TIKET: iID_TIKET},
            cache: false,
            dataType: "JSON",
            success: function (e) {
                    $("#").val($("#").val());

                // alert('asd');
                if(e.act){
                    UIToastr.init(e.tipePesan, e.pesan);
                    iPID=e.iPid;
                    $("#").trigger('click');
                }else{
                    UIToastr.init(e.tipePesan, e.pesan);
                }
            },
              complete:function(e){
                    $('#TabelPilihTravel').DataTable().ajax.reload();
                    // $('#tabel_atk_pr_Divisi').DataTable().ajax.reload();
              }
          }); 
        // $('#btnCloseModalDataBarang2').trigger('click');
         // location.reload('#navitab_2_1');
   }


            function loadGridPilihTiket() {
              // iZone = $("#dd_id_zone_A").val();
            dataTable = $('#TabelPilihTravel').DataTable({
            dom: 'C<"clear">l<"toolbar">frtip',
            initComplete: function () {
                $("div.toolbar").append('<div class="col-md-8">\n\
                    <div class="row">\n\
                    <div class="col-md-1"></div>\n\
                    </div>\n\
                    </div>\n\
                    </div>');
                // dd_Zone("A");
            }, "lengthMenu": [
            [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
                ],
                //                // set the initial value
                "pageLength": 5,
                "processing": true,
                "serverSide": true,
                "ajax": {
                url: "<?php echo base_url("/tiket/tiket/ajax_GridPRTiket"); ?>", // json datasource
                type: "post", // method  , by default get
                data: function (z) {
                    // z.sSearch = iSearch;
                    // z.sZone = iZone;
                },
                error: function () {  // error handling
                    $(".TabelPilihTravel-error").html("");
                    // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $('#TabelPilihTravel tbody').html('<tbody class="employee-grid-error"><tr><th colspan="1">No data found in the server</th></tr></tbody>');
                    $("#TabelPilihTravel_processing").css("display", "none");

                }
            },
            "columnDefs": [
                {"targets": [-1], "orderable": false, "searchable": false},
                 {"targets": [1], "checkboxes": {"selectRow": true}},
//                {"targets": [0], "orderable": false},
//                {"targets": [1], "orderable": false},
//                {"targets": [2], "orderable": false},
//                {"targets": [3], "orderable": false},
//                {"targets": [4], "orderable": false},
//                {"targets": [5], "orderable": false},
                // {"targets": [6], "orderable": false},
                // {"targets": [7], "visible": true, "searchable": true},
                // {"targets": [8], "visible": false, "searchable": false},
            ],
                 "select": {"style": "multi"},
          });

    }


            function loadGridPilihPRpopUp() {
            // iZone = $("#dd_id_zone_A").val();
            dataTable1 = $('#table_grid_PilihTravel').DataTable({
            dom: 'C<"clear">l<"toolbar">frtip',
            initComplete: function () {
                $("div.toolbar").append('<div class="col-md-8">\n\
                    <div class="row">\n\
                    <div class="col-md-1"></div>\n\
                    </div>\n\
                    </div>\n\
                    </div>');
                // dd_Zone("A");
            }, "lengthMenu": [
            [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
                ],
                //                // set the initial value
                "pageLength": 5,
                "processing": true,
                "serverSide": true,
                "ajax": {
                url: "<?php echo base_url("/tiket/tiket/Pilih_tiketPopUp"); ?>", // json datasource
                type: "post", // method  , by default get
                data: function (z) {
                    z.sID_TIKET = iID_TIKET;
                    // z.sZone = iZone;
                },
                error: function () {  // error handling
                    $(".table_grid_PilihTravel-error").html("");
                    // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $('#table_grid_PilihTravel tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                    $("#table_grid_PilihTravel_processing").css("display", "none");

                }
            },
            "columnDefs": [
                {"targets": [-1], "orderable": false, "searchable": false},
                 // {"targets": [1], "checkboxes": {"selectRow": true}},
//                {"targets": [0], "orderable": false},
//                {"targets": [1], "orderable": false},
//                {"targets": [2], "orderable": false},
//                {"targets": [3], "orderable": false},
//                {"targets": [4], "orderable": false},
//                {"targets": [5], "orderable": false},
                // {"targets": [6], "orderable": false},
                // {"targets": [7], "visible": true, "searchable": true},
                // {"targets": [8], "visible": false, "searchable": false},
            ],
                 "scrollx": true,
          });

    }

    function pilihtravel(){
       var selected = dataTable.column(1).checkboxes.selected();
        console.log(selected); 
        iID_TIKET = iID_TIKET + selected.join(',');
        console.log(iID_TIKET);
      $('#table_grid_PilihTravel').DataTable().ajax.reload();
    }



</script>

