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
                            PR Grup </a>
                    </li>
                    <li class="linav" id="linav2">
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                            PR Divisi </a>
                    </li>
                </ul> 
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab_2_1">
                        <!--<div class="scroller" style="height:400px; ">-->
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                                    <div class="visual">
                                        <i class="fa fa-comments"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="1449">1449</span>
                                        </div>
                                        <div class="desc"> PR Group </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                                    <div class="visual">
                                        <i class="fa fa-shopping-cart"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="549">549</span>
                                        </div>
                                        <div class="desc"> PR Group-Onproses </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                                    <div class="visual">
                                        <i class="fa fa-bar-chart-o"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="12,5">123</span> </div>
                                        <div class="desc"> PR Group-Done </div>
                                    </div>
                                </a>
                            </div>
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
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                <div class="form-group">
                                    <div class="col-md-3">
                                             <label>Mulai</label>
                                                    <input class="form-control form-control-inline input-medium date-picker" size="16" type="text" value="" id="StartDate" name="StartDate" />
                                                </div>
                                             <label>Sampai</label>
                                                    <input class="form-control form-control-inline input-medium date-picker" size="16" type="text" value="" id="enddate" name="enddate" />
                                                </div>
                                            </div> 
                                        </div>
                            </div>

                   <div class="row">
                      &nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-md btn-primary" name="" id="" data-toggle="modal" data-target="#myModal" >Pilih</button>
                            <div id="divBudget">
                                <div class="col-md-12" >
                                    <br>
                                    <table class="table table-striped table-bordered table-hover text_kanan" id="tabel_atk_pr_group">
                                        <thead>
                                            <tr>
                                                <th>NO PR</th>     
                                                <th>Tanggal PR Group</th>
                                                <!-- <th>Tipe Request</th> -->
                                                <!-- <th>Nama Category</th> -->
                                                <th>Nama Project</th>
                                                <th>Branch</th>
                                                <!-- <th>Divisi</th> -->
                                                <th>Status Akhir</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>  
                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                    <br>     
                                </div>
                            </div>
                            <!-- end col-12 -->
                        </div>
                        <!-- END ROW-->
                        <!--</div>-->
                    </div>


                    <div class="tab-pane fade" id="tab_2_2">
                        <!--<div class="scroller" style="height:400px; ">-->
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                                    <div class="visual">
                                        <i class="fa fa-comments"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="1449">1449</span>
                                        </div>
                                        <div class="desc"> Jumlah PR Masuk </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                                    <div class="visual">
                                        <i class="fa fa-shopping-cart"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="549">549</span>
                                        </div>
                                        <div class="desc"> Jumlah PR Tergroup </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                                    <div class="visual">
                                        <i class="fa fa-bar-chart-o"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="12,5">123</span> </div>
                                        <div class="desc"> Jumlah PR Belum Tergroup </div>
                                    </div>
                                </a>
                            </div>
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
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group col-md-2">
                                    <label>Mulai</label>
                                    <input type="text" required="" name="mulai" id="mulai" class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Sampai</label>
                                    <input type="text" required="" name="sampai" id="sampai" class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
                                </div>
                         </div>
                            <div id="divBudget">
                                <div class="col-md-12" >
                                    <br>
                                    <table class="table table-striped table-bordered table-hover text_kanan" id="tabel_atk_pr_Divisi">
                                        <thead>
                                            <tr>
                                                <th>NO PR</th>     
                                                <th>Tanggal Request</th>
                                                <th>No PR Group</th>
                                                <th>Tanggal PR Group</th>
                                                <th>Tipe Request</th>
                                                <th>Nama Category</th>
                                                <th>Nama Project</th>
                                                <th>Branch</th>
                                                <th>Divisi</th>
                                                <th>Aksi</th>
                                            </tr>
                                              </thead>
                                              <tbody>           
                                              </tbody>
                                              <tfoot>
                                              </tfoot>
                                              </table>
                                            <br> 
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

    <!-- ===================================================================================================================== -->
 <div class="modal fade bs-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
         <button type="button" class="close"  data-dismiss="modal" id="btnCloseModalDataBarang2">&times;</button>
               <h4 class="modal-title">Alat Tulis Kantor</h4>
           </div>
<div class="modal-body"> 
<div class="row">
    <div class="col-md-12">
   &nbsp;&nbsp;<button class="btn btn-md btn btn-info" data-toggle="modal" data-target="#myModalAdd"><i class="fa glyphicon glyphicon-plus"></i>&nbsp;Add PR</button>
</div> 
</div>
<br>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group col-md-3">
                <label>Total HPS</label>
                    <input type="text" readonly required="" name="total_hps" id="total_hps" onchange="" class="form-control">
                </div>
                    <div class="form-group col-md-3">
                        <label>Total Item</label>
                            <input type="text" readonly required="" name="total_item" id="total_item" onchange="" class="form-control">
                        </div>
                    <div class="form-group col-md-3">
                        <label>Total QTY</label>
                            <input type="text" readonly required="" name="total_qty" id="total_qty" onchange="" class="form-control">
                        </div>
                    </div>
        <div class="form-body">
            <div class="col-md-12">
                 <table class="table table-striped table-bordered table-hover text_kanan" id="table_grid_daftarPR">
               <thead>
                    <tr>  <h4>Daftar PR</h4>
                         <th class='row-2'>NO</th>    
                            <th class='row-md-3'>No PR</th>
                            <th class='row-md-3'>Tanggal Request</th>
                            <th class='row-md-6'>Type Request</th>
                            <th class='row-md-5'>Nama Kategori</th>
                            <th class='row-md-6'>Nama Project</th>
                            <th class='row-md-3'>Branch</th>
                             <th class='row-md-3'>Divisi</th> 
                    </tr>
                            </thead>
                            <tbody>                                           
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>
                </div>
         <div class="form-body">
            <div class="col-md-12">
                <table class="table table-striped table-bordered table-hover text_kanan" id="table_grid_daftarItemBarang">
                      <thead>
                          <h4>Daftar Item Barang</h4>
                    <tr>
                         <!-- <th>No</th>     -->
                            <th>Item Name</th>
                            <th>Item Type</th>
                            <th>QTY</th>
                            <th>HPS</th>
                            <th>No PR Div</th>
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
               </div>
           </div>
     <div class="modal-footer">
         <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
         <button type=" submit" class="btn btn-md btn-primary" onclick="teruskanPR()" name="" id="id_btnSimpan" ><i class="fa glyphicon glyphicon-arrow-right" ></i>&nbsp;Teruskan</button>
      </div>
     </div>
   <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
 </div>

<!-- ========================================= MODAL ADD ==================================================================== -->

 <div class="modal fade bs-modal-lg" id="myModalAdd" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
         <button type="button" class="close"  data-dismiss="modal" id="btnCloseModalDataBarang3">&times;</button>
               <h4 class="modal-title">Alat Tulis Kantor</h4>
           </div>
<!-- <form role="form" method="post" class="cls_from_sec_room" id="id_formRoom"  enctype="multipart/form-data" > -->
<div class="modal-body">
    <div class="row">
        <div class="form-body">
            <div class="col-md-12">
                 <table class="table table-striped table-bordered table-hover text_kanan" id="table_grid_PilihData">
                      <thead>
                    <tr>  <h4>Pilih Data</h4>
                         <!-- <th class='row-2'>Pilih</th>     -->
                            <th class='row-md-3'>No PR</th>
                            <th class='row-md-3'>Tanggal Request</th>
                            <th class='row-md-6'>Type Request</th>
                            <th class='row-md-5'>Nama Kategori</th>
                            <th class='row-md-6'>Nama Project</th>
                            <th class='row-md-3'>Branch</th>
                             <th class='row-md-6'>Divisi</th> 
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
           <button type="submit" name="btnSimpan" class="btn btn-success" onclick="daftar_pr()" id="id_btnSimpan"  > <i class="fa fa-save">&nbsp;</i>Save</button>
    </div>
  <!-- </form> -->
</div>
   <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
 </div>

<!-- ================================================= End Modal ======================================================== -->

<!-- ======================================================== Modal Update ======================================================== -->

<div class="modal fade" id="myModalUpdate" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
         <button type="button" class="close"  data-dismiss="modal" id="btnCloseModalDataBarang3">&times;</button>
               <h4 class="modal-title">Update ATK</h4>
           </div>
<!-- <form role="form" method="post" class="cls_from_sec_room" id="id_formRoom"  enctype="multipart/form-data" > -->
<div class="modal-body">
    <div class="row">
        <div class="form-body">
            <div class="col-md-8">
                    <div class="form-group">
                        <label>QTY</label> <span class="required">*</span>
                        <input required="required" class="form-control" type="text" id="Qty" name="Qty"/>
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
<!-- END PAGE CONTENT-->

<?php $this->load->view('app.min.inc.php'); ?>
<?php $this->load->view('atk_v/atk.js.php'); ?>
<script>
    $('#request').dataTable();
    $('#up').dataTable();
</script>

