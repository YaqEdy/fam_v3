
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
                            <li class="linav" id="linav2">
                                <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                                    Group </a>
                            </li>
                            <li class="linav" id="linav2">
                                <a href="#tab_2_3" data-toggle="tab" id="navitab_2_3" class="anavitab">
                                    Status </a>
                            </li>
                        </ul>     
                        <div class="tab-content"> 
                            <div class="tab-pane fade active in" id="tab_2_1">
                                <form role="form" method="post" class="cls_from_sec_room" 
                                      id="id_formRoom_flow"  enctype="multipart/form-data" > 
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
                                                        <input required="required" class="form-control" id="nama_flow" name="nama_flow" type="number" min="1" max="100" step="1" />
                                                    </div>
                                                       <div class="form-group">
                                                        <label>Status dari</label>
                                                        <?php
                                                        $data = array();
                                                        $data[''] = '';
                                                        foreach ($dd_status as $row) :
                                                            $data[$row->id] = $row->status;
                                                        endforeach;
                                                        echo form_dropdown('status_dari', $data, '', 'id="id_status_x" class="form-control  input-sm select2me" required="required"');
                                                        ?>
                                                     </div>
                                                     <div class="form-group">
                                                        <label>Status ke</label>
                                                        <?php
                                                        $data = array();
                                                        $data[''] = '';
                                                        foreach ($dd_status as $row) :
                                                            $data[$row->id] = $row->status;
                                                        endforeach;
                                                        echo form_dropdown('status_ke', $data, '', 'id="id_status" class="form-control  input-sm select2me"');
                                                        ?>
                                                    </div>
                                               
                                                    <div class="form-group">
                                                        <label>Aksi</label> <span >*</span>
                                                        <input  class="form-control"
                                                               type="text" id="action" name="action"/>
                                                    </div>  
                                                </div>                                                 
                                            </div>
                                            <!-- HIDDEN INPUT -->
                                            <input type="text" id="idTmpAksiBtn" class="hidden">
                                            <!-- END HIDDEN INPUT -->

                                        </div>
                                        <!--END ROW 1 -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-actions">

                                                    <button name="btnSimpan" onclick="reload_()" type="submit" class="btn blue" id="id_btnSimpan">Simpan</button>
                                                    <button name="btnUbah" onclick="" class="btn yellow" id="id_btnUbah">
                                                        <!--<i cla
                                                            ss="fa fa-edit"></i>--> Ubah
                                                    </button>

                                                    <button id="id_btnBatal" type="reset" class="btn default">Batal</button>
                                                </div>
                                            </div>

                                        </div>

                                </form>    


                                <div class="col-md-12">&nbsp;</div>

                                <!--       <div class="col-sm-4">
                                          <div class="form-group" id="displaydivisi">
                                              <label class="control-label col-sm-4">Zone Name</label>
                                              <div class="col-sm-7">
                                                  <div id="ddZone3"></div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-md-2">Search Param :</div>
                                      <div class="col-md-2">
                                          <select id="cat_itemclass" name="cat_itemclass" onchange="search(this.value)" class="form-control">
                                              <option value="ItemName">Item Name</option>
                                              <option value="ZoneName">Zone</option>
                                          </select>
                                      </div> -->


                                <div class="col-md-12">

                                    <table class="table table-striped table-bordered table-hover text_kanan" id="table_gridflow">
                                        <thead>
                                            <tr>
                                                <th class='row-2'>ID</th>     
                                                <th class='row-md-3'>Flow Id</th>
                                                <th class='row-md-3'>Nama Flow ID</th>
                                                <th class='row-md-6'>Status dari</th>
                                                <th class='row-md-5'>Status ke</th>
                                                <th class='row-md-3'>Aksi</th>
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
                                </form>
                            </div>
                        </div>
                        <!--=================================================== GROUP =========================================================-->

                        <div class="tab-pane fade active" id="tab_2_2">
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
                                            <input class="form-control hidden" type="text" id="id_data" name="id_data"/>
                                            <!-- HIDDEN INPUT -->
                                            <input type="text" id="idTmpAksiBtn" class="hidden">
                                            <!-- END HIDDEN INPUT -->

                                        </div>


                                        <div class="col-md-12">&nbsp;</div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <input class="form-control hidden" type="text" id="id_data" name="id_data"/>
                                                <div class="form-body">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Input Grup</label> <span class="required">*</span>
                                                            <input required="required" class="form-control"
                                                                   type="text" id="grup_input" name="grup_input"/>
                                                        </div>
                                                    </div>                                                 
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-actions">

                                                        <button name="btnSimpan" target="_blank" class="btn blue" id="id_btnSimpan">
                                                            <!--<i class="fa fa-check"></i>--> Simpan</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">&nbsp;</div>

                                            <br>
                                            <div class="col-md-12">
                                                <table class="table table-striped table-bordered table-hover text_kanan" id="table_gridgroup">
                                                    <thead>
                                                        <tr>
                                                            <th class='row-2'>ID</th>     
                                                            <th class='row-md-3'>Group</th>
                                                            <th>Opsi</th>
                                          <!--                   <th></th> -->
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
                            </form>
                        </div>
                    </div>
                    <!-- =================================================== STATUS ==================================================== -->
                    <div class="tab-pane fade active" id="tab_2_3">
                        <form role="form" method="post" class="cls_from_sec_room" id="id_formRoom_STATUS"  enctype="multipart/form-data" > 
                            <div class="scroller" style="height:810px; ">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button id="id_Reload" style="display: none;"></button>
                                    </div>
                                </div>   
                                <div class="row">
                                    <input class="form-control hidden" type="text" id="id_data" name="id_data"/>
                                    <!-- HIDDEN INPUT -->
                                    <input type="text" id="idTmpAksiBtn" class="hidden">
                                    <!-- END HIDDEN INPUT -->
                                </div>
                                <div class="col-md-12">&nbsp;</div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <input class="form-control hidden" type="text" id="id_data" name="id_data"/>
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
                                                echo form_dropdown('id', $data, '', 'id="id" class="form-control  input-sm select2me" required="required"');
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
                                                <button name="btnSimpan" onclick="reload2()"  class="btn blue" id="id_btnSimpan">Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">&nbsp;</div>
                                    <br>
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
                                <!-- END ROW-->
                        </form>
                    </div>




                    <!-- END VALIDATION STATES-->


                    <!-- ============================================= javascript ============================================================== -->

                    <?php $this->load->view('app.min.inc.php'); ?>
                    <?php $this->load->view('master_v/flow/master_flow.js.php'); ?>
