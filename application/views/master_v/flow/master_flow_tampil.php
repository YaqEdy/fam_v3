
<style type="text/css">

    table#table_gridflow th:nth-child(1){
        display: none;
    } 
    table#table_gridflow td:nth-child(1){
        display: none;
    }
    
</style>


<div class="row">
    <div class="col-md-12">

        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit  bordered">
            <div class="portlet-body">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-red"></i>
                        <span class="caption-subject font-red sbold uppercase"><?php echo $menu_header; ?></span>
                    </div>
                    <div class="portlet-body">
                        <ul class="nav nav-pills">

                         <li class="linav active" id="linav1">
                                <a href="#tab_2_1" data-toggle="tab" id="navitab_2_1" class="anavitab">
                                    Flow </a>
                            </li>
                           
                            <li class="linav " id="linav2">
                                <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                                    Status </a>
                            </li>

<!--                            <li class="linav " id="linav2">
                                <a href="#tab_2_3" data-toggle="tab" id="navitab_2_3" class="anavitab">
                                    Group </a>
                            </li>-->
                            

                        </ul>     
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="tab_2_1">
                                <form role="form" method="post" class="cls_from_sec_room" id="id_formRoom_flow"  enctype="multipart/form-data" > 

                               

                                    <div class="scroller" style="height:810px; ">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button id="id_Reload" style="display: none;"></button>
                                            </div>
                                        </div>   
                                        <div class="row">
                                            <input class="form-control hidden" type="text" id="id_data" name="id_data"/>
                                            <div class="form-body">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Flow ID</label> <span class="required">*</span>
                                                        <input required="required" class="form-control" id="id_flow_id" name="id_flow_id" type="number" min="1" max="100" step="1" />
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Nama Flow ID</label> <span class="required">*</span>
                                                        <input required="required" class="form-control" id="id_nama_flow" name="id_nama_flow" type="text" min="1" max="100" step="1" />
                                                    </div>

                                                    <!-- <div class="form-group">
                                                        <label>Status Dari</label> <span class="required">*</span>
                                                        <input required="required" class="form-control" id="id_status_dari" name="id_status_dari" type="text" min="1" max="100" step="1" />
                                                    </div> -->

                                                    <div class="form-group">
                                                        <label>Status Dari</label>
                                                        <?php
                                                        $data = array();
                                                        $data[''] = '';
                                                        foreach ($dd_status as $k) :
                                                            $data[$k->id] = $k->status;
                                                        endforeach;
                                                        echo form_dropdown('id', $data, '', 'id="id_status_dari" name="id_status_dari" class="form-control" required');
                                                        ?>
                                                    </div>

                                                    <div class="form-group">
                                                        <label >Aksi</label><span class="required">*</span>
                                                            <select class="form-control" type="text" id="id_aksi" name="id_aksi" >
                                                              <option value="" >--Select--</option>
                                                              <option value="Approve">Approve</option>
                                                              <option value="Reject">Reject</option>
                                                            </select>
                                                       
                                                          <input  id="idTmpAksiBtn"  name="idTmpAksiBtn" data-required="1" class="form-control input-sm hidden" type="text"> 
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Status Ke</label>
                                                        <?php
                                                        $data = array();
                                                        $data[''] = '';
                                                        foreach ($dd_status as $k) :
                                                            $data[$k->id] = $k->status;
                                                        endforeach;
                                                        echo form_dropdown('id', $data, '', 'id="id_status_ke" name="id_status_ke" class="form-control" required');
                                                        ?>
                                                    </div>

                                                     <!-- <div class="form-group">
                                                        <label>Status Ke</label> <span class="required">*</span>
                                                        <input required="required" class="form-control" id="id_status_ke" name="id_status_ke" type="text" min="1" max="100" step="1" />
                                                    </div> -->

                                                    <div class="form-group">
                                                        <label>Tipe</label>
                                                        <?php
                                                        $data = array();
                                                        $data[''] = '';
                                                         foreach ($dd_tipe as $k) :
                                                            $data[$k->ID_TYPE] = $k->TYPE_DESC;
                                                            endforeach;
                                                            echo form_dropdown('ID_TYPE', $data, '', 'id="id_tipe" name="id_tipe" class="form-control" required');
                                                        ?>
                                                     </div>

                                                     <div class="form-group">
                                                        <label>Min HPS</label> <span class="required">*</span>
                                                        <input required="required" class="form-control" id="id_min_hps" name="id_min_hps" type="number" min="1" max="100" step="1" />
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Max HPS</label> <span class="required">*</span>
                                                        <input required="required" class="form-control" id="id_max_hps" name="id_max_hps" type="number" min="1" max="100" step="1" />
                                                    </div>
                                                
                                                
                                                </div>                                                 
                                            </div>
                                            <!-- HIDDEN INPUT -->
                                            <input type="text" id="idTmpAksiBtn" class="hidden">
                                            <!-- END HIDDEN INPUT -->

                                        </div>
                                        <!--END ROW 1 -->
                                       

                                </form>    

                                 <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-actions">

                                                    <button name="btnSimpan" value="simpan"  class="btn blue" id="id_btnSimpan">
                                                        <!--<i class="fa fa-check"></i>--> Simpan
                                                    </button>
                                                    <button name="btnflowUbah" class="btn yellow" id="id_btnflowUbah" >
                                                        <!--<i class="fa fa-edit"></i>--> Ubah
                                                    </button>

                                                     <button id="id_btnBatal" type="reset" class="btn default" onclick="btlflow()"><i class="fa fa-refresh"></i> Batal</button>
                                                </div>
                                            </div>

                                        </div>


                                <div class="col-md-12">&nbsp;</div>
                                <div class="col-md-12">

                                    <table class="table table-striped table-bordered table-hover text_kanan" id="table_gridflow">
                                        <thead>
                                            <tr>
                                                <th class='row-2'>ID</th>     
                                                <th class='row-md-3'>Flow Id</th>
                                                <th class='row-md-3'>Nama Flow ID</th>
                                                <th class='row-md-6'>Status dari</th>
                                                <th class='row-md-3'>Aksi</th>
                                                <th class='row-md-5'>Status ke</th>
                                                <th class='row-md-5'>Tipe</th>
                                                <th class='row-md-5'>Min Hps</th>
                                                <th class='row-md-5'> Max Hps &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                
                                                  <th>Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                        </tbody>
                                        <tfoot>


                                        </tfoot>
                                    </table>
                                </div>
                                <!-- end col-12 -->                   
                                <!-- END ROW-->
                                <!-- </form> -->
                            </div>
                        </div>
                

                    <!--=================================================== GROUP =========================================================-->

                   
                    <div class="tab-pane fade" id="tab_2_2">
                        <form role="form" method="post" class="cls_from_sec_room" id="id_formRoom_STATUS"  enctype="multipart/form-data" > 
                            <div class="scroller" style="height:810px; ">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button id="id_Reload" style="display: none;"></button>
                                    </div>
                                </div>   
                                <div class="row">
                                    <!-- <input class="form-control hidden " type="text" id="id_data" name="id_data"/> -->
                                    <!-- HIDDEN INPUT -->
                                    <input type="text" id="idTmpAksiBtn" class="hidden">
                                    <!-- END HIDDEN INPUT -->
                                </div>
                                <div class="col-md-12">&nbsp;</div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <input class="form-control hidden " type="text" id="id_id" name="id_id"/>
                                        <div class="form-body">

                                            <div class="col-md-4">
                                               <div class="form-group">
                                                <label>GROUP</label>
                                                <?php
                                                $data = array();
                                                $data[''] = '';
                                                foreach ($dd_grup as $row) :
                                                    $data[$row->id] = $row->grup;
                                                endforeach;
                                                echo form_dropdown('grup_status', $data, '', 'id="id_grup_status" class="form-control " required="required"');
                                                ?>
                                          </div>
                                                <div class="form-group">
                                                    <label>Input Status</label> <span class="required">*</span>
                                                    <input required="required" class="form-control" type="text" id="input_status" name="input_status"/>
                                                </div>
                                            </div>                                                 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-actions">
                                                <button name="btnSimpanstatus" onclick="reload2()"  class="btn blue" id="id_btnSimpanstatus">Simpan</button>

                                                    <button name="btnubahStatus" class="btn yellow" id="id_btnubahstatus" >
                                                        <i class="fa fa-edit"></i> Ubah </button> 

                                                     <button id="id_btnBatal" name="id_btnBatal" type="reset" class="btn default" onclick="btlstatus()"> <i class="fa fa-refresh"></i> Batal</button>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">&nbsp;</div>
                                    
                                    <div class="col-md-12">
                                        <table class="table table-striped table-bordered table-hover text_kanan" id="table_gridstatus">
                                            <thead>
                                                <tr>
                                                    <th >ID</th>   
                                                    <th >Group</th>   
                                                    <th >Status</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>           
                                            </tbody>
                                            <tfoot>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <!-- end col-12 -->                   
                              </div>  <!-- END ROW-->
                        </form>
                    </div>

                     <!-- =================================================== STATUS ==================================================== -->

                      <div class="tab-pane fade" id="tab_2_3">
                            <form role="form" method="post" class="cls_from_sec_room" 
                                  id="id_formRoom_grup"  enctype="multipart/form-data" > 
                                <div class="scroller" style="height:810px; ">
                                    <div class="scroller" style="height:810px; ">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button id="id_Reload" style="display: none;"></button>
                                            </div>
                                        </div>   
                                        <div class="row">
                                            <!-- <input class="form-control hidden" type="text" id="id_data" name="id_data"/> -->
                                            <!-- HIDDEN INPUT -->
                                            <input type="text" id="idTmpAksiBtn" class="hidden">
                                            <!-- END HIDDEN INPUT -->

                                        </div>


                                        <div class="col-md-12">&nbsp;</div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <input class="form-control hidden " type="text" id="id_group" name="id_group"/>
                                                <div class="form-body">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Input Grup</label> <span class="required">*</span>
                                                            <input required="required" class="form-control"
                                                                   type="text" id="grup" name="grup"/>
                                                        </div>
                                                    </div>                                                 
                                                </div>
                                            </div>

                                            <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-actions">

                                                <button name="btnSimpan" value="simpan"  class="btn blue" id="id_btnSimpangroup">
                                                        <i class="fa fa-check"></i> Simpan</button>
                                                    <button name="btnflowUbah" class="btn yellow" id="id_btnflowUbahgroup" >
                                                        <i class="fa fa-edit"></i> Ubah </button> 

                                                     <button id="id_btnBatal" type="reset" class="btn default" onclick="btlgrup()"><i class="fa fa-refresh"></i> Batal</button>
                                                </div>
                                            </div>

                                        </div>

                                            <div class="col-md-12">&nbsp;</div>

                                            
                                            <div class="col-md-12">
                                                <table class="table table-striped table-bordered table-hover text_kanan" id="table_gridgroup">
                                                    <thead>
                                                        <tr>
                                                            <th class='row-2'>ID</th>     
                                                            <th class='row-md-3'>Group</th>
                                                            <th>Opsi</th>
                                     
                                                        </tr>
                                                    </thead>
                                                    <tbody>                                        
                                                    </tbody>
                                                    <tfoot>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- end col-12 -->                   
                                        <!-- END ROW-->
                                    </div>
                                    </div>
                            </form>
                        </div>
                      


                   
                </div>
            </div>
        </div>
    </div>
</div>


<?php $this->load->view('app.min.inc.php'); ?>
<?php $this->load->view('master_v/flow/master_flow.js.php'); ?>
