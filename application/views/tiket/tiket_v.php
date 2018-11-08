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
                            Request Tiket </a>
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
                <!--  <form class="validator-form form-horizontal" id="id_formRoom" action="tiket/simpan" enctype="multipart/form-data" method="POST"> -->
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
                                    <input type="text" required="required" name="nomemo" id="nomemo" class="form-control" >
                                </div>
                                <!-- <div class="form-group col-md-4"></div> -->
                                <div class="form-group col-md-6">
                                    <label><b>Tanggal PR, Tiket BOX</b></label>
                                    <input type="date" required="required" name="tanggal_pr" id="tanggal_pr" size="16" class="form-control">
                                </div>
                            </div>

                             <div class="col-md-12">
                            <div class="form-group col-md-4">
                                    <label><b>Pilih</b></label>
                                    <input  class="form-control" type="text" id="" name=""/>
                                </div>
                                <div class="form-group col-md-4">
                                    <h3></h3>
                                    <button class="btn btn blue" href="#"  data-toggle="modal"  data-target="#myModalpilihtravel">Pilih</button>&nbsp;
                <a class="btn btn-md btn-primary" href="#" id="btnUpdate" data-toggle="modal" data-target="#myUpload">Upload</a> 
                                </div>
                            </div>
 
                          <div class="col-md-12">
                            <div class="form-group col-md-4">
                                    <center><label><b>Asal</b></label>
                                    <input type="text" required="" name="asal" id="asal" class="form-control" ></center>
                                </div>
                                 <div class="form-group col-md-4 align">
                                <center> <label><b>Pulang</b></label>
                                    <br>
                                     <input type="checkbox" id="pulang" name="pulang[]" value="pulang" ></center>
                                 </div>
                                <div class="form-group col-md-4">
                                    <center><label><b>Tujuan</b></label>
                                    <input type="text" required="" name="tujuan" id="tujuan"  class="form-control" ></center>
                                </div>
                              
                          </div>

                        <div class="col-md-12">
                            <div class="form-group col-md-4">
                                   <center><label><b>Tanggal Berangkat</b></label>
                                     <input class="form-control form-control-inline date-picker" size="16" type="date" value="" id="StartDate" name="StartDate" /></center>
                                </div>
                                <div class="form-group col-md-4">
                                    <center><label><b>Tanggal Pulang</b></label>
                                       <input class="form-control form-control-inline date-picker" size="16" type="date" value="" id="enddate" name="enddate" /></center>
                                </div>
                                <div class="form-group col-md-4">
                                   <center><label><b>An Tiket</b></label>
                                    <input type="text" required="" name="sampai" id="sampai" class="form-control"></center>
                                </div>
                              
                          </div>

                         <div class="col-md-12">
                            <div class="form-group col-md-4">
                                    <center><label><b>Jenis Identitas</b></label>
                                     <select required="required" name="jnsidentitas" class="form-control" id="jnsidentitas" onchange="getNum(this.value)">
                                         <option value="">- Select -</option>
                                         <option value="0">KTP</option>
                                         <option value="1">SIM</option>
                                         <option value="2">KITAS</option>
                                         <option value="3">PASPOR</option>
                                         <option value="4">BUKU NIKAH</option>
                                         <option value="5">LAINNYA</option>
                                    </select>
                                </div></center>
                                 <div class="form-group col-md-4">
                                    <center><label><b>No Identitas</b></label>
                                    <input type="number" required="required" name="no_identitas" id="no_identitas" class="form-control input-sm " >
                                </div></center>
                                <div class="form-group col-md-4">
                                    <center><label><b>ID Karyawan</b></label>
                                    <input type="text" required="required" name="id_karyawan" id="id_karyawan" class="form-control input-sm " >
                                </div></center>
                          </div>

                            <div class="col-md-12">
                            <div class="form-group col-md-5"></div>
                            <div class="form-group col-md-7">
                            <button class="btn btn-lg btn-primary" id="id_btnSimpan" name="btnSimpan" type="submit"><i class="fa glyphicon glyphicon-arrow-right" ></i>&nbsp;Teruskan</button>   
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
                                    <input type="text" required="" name="mulai" id="mulai" onchange="ddMulai(this.value)" class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Sampai</label>
                                    <input type="text" required="" name="sampai" id="sampai" onchange="ddSampai(this.value)" class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn blue" data-toggle="modal"  data-target="#myModalpilih">Pilih</button>
                            </div>

                            <div id="divBudget">
                                <div class="col-md-12" >
                                    <br>
                                    <table class="table table-striped table-bordered table-hover text_kanan" id="request">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>NO PR</th>     
                                                <th>Tanggal PR</th>
                                                <th>No SPD</th>
                                                <th>File SPD</th>
                                                <th>Akomodasi</th>
                                                <th>An Tiket</th>
                                                <th>Jenis Identitas</th>
                                                <th>No Identitas</th>
                                                <th>Asal</th>
                                                <th>Tujuan</th>
                                                <th>Kategori Perjalanan</th>
                                                <th>Tanggal Berangkat</th>
                                                <th>Tanggal Pulang</th>
                                                <!-- <th>Status Akhir</th> -->
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
                                                <td>Selesai</td>
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
                 
                    </div>
<!-- =================================================== END TAB =========================================================== -->

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
                                    <input type="text" required="" name="mulai" id="mulai" onchange="ddMulai(this.value)" class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Sampai</label>
                                    <input type="text" required="" name="sampai" id="sampai" onchange="ddSampai(this.value)" class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <!-- <button class="btn btn blue" onclick="onLihat()">Lihat</button> -->
                            </div>

                            <div id="divBudget">
                                <div class="col-md-12" >
                                    <br>
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
                                    <input type="text" required="" name="mulai" id="mulai" onchange="ddMulai(this.value)" class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Sampai</label>
                                    <input type="text" required="" name="sampai" id="sampai" onchange="ddSampai(this.value)" class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
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
                                    <input type="text" required="" name="mulai" id="mulai" onchange="ddMulai(this.value)" class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Sampai</label>
                                    <input type="text" required="" name="sampai" id="sampai" onchange="ddSampai(this.value)" class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
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

<!-- ================================================= Modal Pilih Travel ===================================================== -->

<div class="modal fade bs-modal-lg" id="myModalpilihtravel" tabindex="-1" role="dialog" aria-hidden="true">
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
                <div class="form-group col-md-5">
            <label>Mulai</label>
         <input type="text" required="" name="mulai" id="mulai" class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
    </div>
         <div class="form-group col-md-5">
            <label>Sampai</label>
    <input type="text" required="" name="sampai" id="sampai" class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
 </div>
</div>
            <div class="col-md-12">
                <h4>Data Pesanan</h4>
                 <table class="table table-striped table-bordered table-hover text_kanan" id="table_grid_PilihTravel">
                      <thead>
                    <tr> 
                         <!-- <th class='row-2'>Pilih</th>     -->
                            <th class='row-md-3'>Akomodasi</th>
                            <th class='row-md-3'>An.Tiket</th>
                            <th class='row-md-6'>Jenis Identitas</th>
                            <th class='row-md-5'>No Identitas</th>
                            <th class='row-md-6'>Asal</th>
                            <th class='row-md-3'>Tujuan</th>
                             <th class='row-md-6'>Kategori Perjalanan</th> 
                             <th class='row-md-3'>Tgl Berangkat</th>
                             <th class='row-md-3'>Tgl Pulang</th>
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
 <div class="modal-footer">
      <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
           <button type="submit" name="btnSimpan" class="btn green" onclick="daftar_pr()" id="id_btnSimpan"  >&nbsp;</i>Kirim</button>
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

<?php $this->load->view('tiket/tiket.js.php'); ?>
<?php $this->load->view('app.min.inc.php'); ?>
<script>
    // $('#request').dataTable();
    // $('#up').dataTable();
    // $('#add').dataTable();
    // $('#set').dataTable();
    // $('#payment').dataTable();
</script>

