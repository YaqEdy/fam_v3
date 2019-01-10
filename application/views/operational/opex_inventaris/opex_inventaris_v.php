
<style>
    .lunas
    {
        background-color: #66ff99 !important;
    }    
</style>

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
                         <div class="tab-pane fade active in" id="tab_2_1">
                             <div class="scroller" style="height:400px; ">
                                 <!-- <div class="col-md-12"> -->
                                     <div class="row">
                                         <div class="col-md-4">
                                              <div class="form-group">
                                              <label>Mulai</label> <span>*</span>
                                               <input class="form-control" id="nama_flow" name="nama_flow" type="text"/>
                                            </div>
                                         </div>
                                                    <div class="col-md-4">
                                                    </div>
                          <div class="col-md-4">
                                <div class="form-group">
                                       <label>Sampai</label> <span>*</span>
                                        <input required="required" class="form-control" id="nama_flow" name="nama_flow" type="text" />
                                </div>
                            </div>
                                <div class="col-md-12">
                                    <button id="id_Reload" style="display: none;"></button>
                                </div>
                            </div>
                            <br>
                            <div class="row">
              
                                <div class="col-md-12">

                                    <table class="table table-striped table-bordered table-hover text_kanan" id="table_gridOpex">
                                        <thead>
                                            <tr>
                                                <th>NO</th>     
                                                <th>Zone</th>
                                                <th>Branch - Division</th>                
                                                <th>Unit</th>
                                                <th>QTY</th>
                                                <th>Tanggal Pengakuan Inventaris</th>
                                                <th>Inventaris ID</th>
                                                <th>Nama Inventaris</th>
                                                <th>Kode QR</th>


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
                            <!-- END ROW-->
                        </div>
                    </div>
                </div>    
            </div>

        </div>
    </div>
    <!-- END VALIDATION STATES-->
</div>
</div>



<?php $this->load->view('app.min.inc.php'); ?>
<?php $this->load->view('operational/opex_inventaris/opex_inventaris_js.php'); ?>

