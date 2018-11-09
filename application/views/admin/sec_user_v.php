
<!-- END PAGE BREADCRUMB -->
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<!-- KONTEN DI SINI YA -->
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
                            Data user </a>
                    </li>
                    <li class="linav" id="linav2">
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                            Form data user</a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab_2_1">
                        <div class="scroller" style="height:400px; ">
                            <div class="row">
                                <div class="col-md-12">
                                    <button id="id_Reload" style="display: none;"></button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">

                                    <table class="table table-striped table-bordered table-hover text_kanan" id="table_gridUSER">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>
                                                    User ID
                                                </th>
                                                <th>
                                                    User Name
                                                </th>
                                                <th>
                                                    Nama Karyawan
                                                </th>
                                                <th>
                                                    User Group
                                                </th>
                                                <th>
                                                   Aksi
                                                </th>
                                            <!--     <th>
                                                   idsdm
                                                </th>
                                                <th>
                                                   iduser
                                                </th>
 -->
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
                         <div class="col-md-4">
                                 <!--   <div class="form-group"> -->
                
                                    <!-- <input type="text" id="edit_user" name="edit_user" value="1"> -->
                                <!-- </div> -->
                                </div>
                    <div class="tab-pane fade" id="tab_2_2">
                        <!-- BEGIN FORM-->

                        <form role="form" method="post" class="form-horizontal cls_from_sec_user cls_form_validate "
                              action="<?php echo base_url('admin/sec_user/home'); ?>" id="idFormUser" novalidate="novalidate">    
                 
                            <div class="form-body">
                                <!--                                <div class="alert alert-danger display-hide">
                                                                    <button class="close" data-close="alert"></button> You have some form errors. Please check below. 
                                                                </div>-->

                                <div class="alert alert-success display-hide">
                                    <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                <div class="form-group hidden">
                                    <label class="control-label col-md-3">User id 

                                    </label>
                                    <div class="col-md-9">
                                        <input id="id_userId" class="form-control"
                                               type="text" name="userId" readonly/>
                                    </div>
                                </div>
                            <input class="form-control" type="hidden" id="idsdm3" name="idsdm" />
                            <input class="form-control" type="text" id="user_id3" name="user_id" style="display: none;" />
                            <div class="row">
                                <div class="col-md-12">
                            <div class="form-group">
                        <label class="control-label col-md-3">NIK
                    <span class="required" aria-required="true"> * </span> 
                    </label>
                <div class="col-md-6">
            <input required="required" class="form-control" type="text" id="nik" name="nik"/>
                </div><a class="btn btn-sm btn-primary" href="#" id="btnUpdate" data-toggle="modal" data-target="#myModalsha">Pilih</a> 
                    </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">User name 
                                <span class="required" aria-required="true"> * </span>
                                    </label>
                                <div class="col-md-6">
                            <input required="required" class="form-control" type="text" id="user_name" name="user_name"/>
                        </div>
                    </div>
                <div class="form-group">
                     <label class="control-label col-md-3">Nama 
                     <span class="required" aria-required="true"> * </span>
                 </label>
             <div class="col-md-6">
          <input required="required" class="form-control" type="text" id="name"  name="name"/>
            </div>
                </div>
                <div class="form-group">
                     <label class="control-label col-md-3">Email 
                     <span class="required" aria-required="true"> * </span>
                 </label>
             <div class="col-md-6">
          <input required="required" class="form-control" type="text" id="email"  name="email"/>
            </div>
                </div>

            <div class="form-group">
               <label class="control-label col-md-3">Branch
                   <span class="required" aria-required="true"> * </span>
                     </label>
                       <div class="col-md-6">
                         <?php
                         $data = array();
                         $data[''] = '';
                         foreach ($dd_Branch as $k) :
                            $data[$k->FLEX_VALUE] = $k->BRANCH_DESC;
                         endforeach;
                         echo form_dropdown('FLEX_VALUE_BRANCH', $data, '', 'id="id_branch" class="form-control" required');
                         ?>
                     </div>
                </div>

             <div class="form-group">
                <label class="control-label col-md-3">Divisi
                    <span class="required" aria-required="true"> * </span>
                     </label>
                       <div class="col-md-6">
                         <?php
                         $data = array();
                         $data[''] = '';
                          foreach ($dd_divisi as $k) :
                            $data[$k->FLEX_VALUE] = $k->DIV_DESC;
                          endforeach;
                         echo form_dropdown('FLEX_VALUE_DIVISI', $data, '', 'id="id_division" class="form-control" required');
                         ?>                                      
                    </div>
                </div> 

             <div class="form-group">
               <label class="control-label col-md-3">Posisi
                   <span class="required" aria-required="true"> * </span>
                     </label>
                       <div class="col-md-6">
                         <?php
                         $data = array();
                         $data[''] = '';
                        foreach ($dd_Position as $k) :
                            // $data[trim($row['ZoneID'])] = $row['ZoneName'];
                            $data[$k->PositionID] = $k->PositionName;
                        endforeach;
                         echo form_dropdown('PositionID', $data, '', 'id="id_position" class="form-control" required');
                         ?>
                     </div>
                </div> 

            <div class="form-group">
               <label class="control-label col-md-3">Zonasi
                   <span class="required" aria-required="true"> * </span>
                     </label>
                       <div class="col-md-6">
                         <?php
                         $data = array();
                         $data[''] = '';
                          foreach ($dd_Zona as $k) :
                            // $data[trim($row['ZoneID'])] = $row['ZoneName'];
                            $data[$k->ZoneID] = $k->ZoneName;
                          endforeach;
                         echo form_dropdown('ZoneID', $data, '', 'id="id_zone" class="form-control" required');
                         ?>
                     </div>
                </div>

            <div class="form-group">
               <label class="control-label col-md-3">Grup Status
                   <span class="required" aria-required="true"> * </span>
                     </label>
                       <div class="col-md-6">
                         <?php
                         $data = array();
                         $data[''] = '';
                         foreach ($group_user as $row) :
                             $data[$row['usergroup_id']] = $row['usergroup_desc'];
                         endforeach;
                         echo form_dropdown('userGroup', $data, '', 'id="id_groupUser" class="form-control" required');
                         ?>
                     </div>
                </div>

                              
             <div class="form-group">
                <label class="control-label col-md-3">Status User
                     <span class="required" aria-required="true"> * </span>
                         </label>
                      <div class="col-md-6">
                         <?php
                         $data = array();
                         $data[''] = '';
                         foreach ($statususer as $k) :
                             $data[$k->statususer_id] = $k->statususer_desc;
                         endforeach;
                         echo form_dropdown('statusUser', $data, '', 'id="id_statusUser" class="form-control" required');
                         ?>                                   
                    </div>
                </div>
            </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-3 col-md-9">
                    &nbsp;&nbsp;&nbsp;<button type ="submit" name="btnSimpan" class="btn blue" id="id_btnSimpan">
                            <i class="fa fa-check"></i> Simpan </button>
                    <button id="id_btnBatal" type="reset" class="btn default"><i class="fa fa-refresh"></i> Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
<!-- END FORM-->
     </div>    
        </div>
            </div>
                </div>
<!-- END VALIDATION STATES-->
                         </div>
                               </div>
<!-- END PAGE CONTENT-->

<!-- <============================================== Modal Pilih ==========================================> -->
            <div id="myModalsha" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-lg">
     <!--   <div class="modal-dialog"> -->
 <div class="modal-content">
      <!-- <div class="modal-responsive"> -->
            <div class="modal-header">
                <button type="button" class="close"  data-dismiss="modal" id="btnCloseModalDataBarang2">&times;</button>
            <h4 class="modal-title">Pilih User</h4>
        <div class="modal-body">
    <div class="row" id="itemmodal">
         <div class="col-md-12">
            <form role="form" method="post" class="cls_from_sec_room" id="id_formRoom"  enctype="multipart/form-data" >
                <div class="portlet light bordered">
                    <div class="portlet-body">
            <!--  <form role="form" method="post" class="cls_from_sec_user"id="idFormUser" >-->
    <input class="form-control hidden" enctype="multipart/form-data" type="text" id="profile_id_sdm" name="profile_id_sdm"/>  
<div class="row">
    <div class="form-body">
        <div class="col-md-12">
            <table class="table table-striped table-bordered table-hover text_kanan" id="table_gridUpdateUser">
            <thead>
                    <tr>    
                        <th class='row-2'>NO</th>    
                            <th class='row-md-3'>NIK</th>
                            <th class='row-md-3'>Nama</th>
                            <th class='row-md-6'>Username</th>
                            <th class='row-md-5'>Email</th>
                            <!--<th class='row-md-6'>Unit Kerja</th>-->
                            <th class='row-md-3'>Opsi</th>
                             <th class='row-md-3'>idsdm</th> 
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
    </div> 
         </form>    
            </div>
                </div>
                    </div>
                        </div>
                             </div>
                                 </div>
                                     </div>
                                          </div>
<!-- <============================================== end Modal Pilih ==========================================> -->
                 <div id="myModaleki" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
    <!-- <div class="modal-dialog"> -->
    <div class="modal-content">
        <!-- <div class="modal-responsive"> -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" id="btnCloseModalDataBarang1">&times;</button>
                     <h4 class="modal-title">Pilih User</h4>
                 <div class="modal-body">
            <div class="row" id="itemmodal">
        <div class="col-md-12">
    <form action="<?php echo base_url('admin/sec_user/edit_user'); ?>" id="idFormUser2" method="POST">
       <!-- <form role="form" method="post" class="cls_from_sec_room" id="id_formRoom_no" > -->
            <div class="portlet light bordered">
                  <div class="portlet-body">
                        <!-- <form role="form" method="post" class="cls_from_sec_user"id="idFormUser" >-->
                <input class="form-control hidden" enctype="multipart/form-data" type="text" id="id_data" name="id_data"/>    
            <div class="row">
        <div class="form-body">
    <div class="col-md-12">
        <input class="form-control" type="text" id="idsdm2" name="idsdm" style="display: none;"  />
            <input class="form-control" type="text" id="user_id2" name="user_id" style="display: none;" />
                  <div class="form-group">
                        <label>Nik </label> <span class="required">*</span>
                        <input required="required" class="form-control" type="text" id="nik_edit" name="nik" value="">
                     </div>
                   <div class="form-group">
                        <label>Username </label> <span class="required">*</span>
                        <input required="required" class="form-control" type="text" id="user_name_edit" name="user_name"/>
                    </div>
                   <div class="form-group">
                        <label>Nama </label> <span class="required">*</span>
                        <input required="required" class="form-control" type="text" id="name_edit"  name="name"/>
                    </div>
                    <div class="form-group">
                        <label>Email </label> <span class="required">*</span>
                        <input required="required" class="form-control" type="text" id="email_edit"  name="email"/>
                    </div>


                   <div class="row">
                <div class="col-md-12">
                   <div class="form-group">

                                <div class="form-group">
                                    <label>Branch  </label>  <span class="">*</span>
                                 
                                        <?php
                                        $data = array();
                                        $data[''] = '';
                                        foreach ($dd_Branch as $k) :
                                            $data[$k->FLEX_VALUE] = $k->BRANCH_DESC;
                                        endforeach;
                                        echo form_dropdown('FLEX_VALUE_BRANCH', $data, '', 'id="id_branch_edit" class="select2me form-control" required');
                                        ?>     
                                </div>

                                <div class="form-group">
                                    <label>Divisi</label><span class="">*</span>
                                
                                        <?php
                                        $data = array();
                                        $data[''] = '';
                                        foreach ($dd_divisi as $k) :
                                            $data[$k->FLEX_VALUE] = $k->DIV_DESC;
                                        endforeach;
                                        echo form_dropdown('FLEX_VALUE_DIVISI', $data, '', 'id="id_division_edit" class="select2me form-control" required');
                                        ?>  
                                </div>

                                <div class="form-group">
                                    <label>Position  </label>  <span class="">*</span>
                                    
                                        <?php
                                        $data = array();
                                        $data[''] = '';
                                        foreach ($dd_Position as $k) :
                                            // $data[trim($row['ZoneID'])] = $row['ZoneName'];
                                           // $data[trim($row['PositionID'])] = $row['usergroup_desc'];
                                            $data[trim($k->PositionID)] = $k->PositionName;
                                        endforeach;
                                        echo form_dropdown('PositionID', $data, '', 'id="id_position_edit" class="select2me form-control" required');
                                        ?> 
                                </div>


                                <div class="form-group">
                                    <label>Zone  </label>  <span class="">*</span>
                                  
                                        <?php
                                        $data = array();
                                        $data[''] = '';
                                        foreach ($dd_Zona as $k) :
                                            // $data[trim($row['ZoneID'])] = $row['ZoneName'];
                                            $data[$k->ZoneID] = $k->ZoneName;
                                        endforeach;
                                        echo form_dropdown('ZoneID', $data, '', 'id="id_zone_edit" class="select2me form-control" required');
                                        ?>    
                                </div>
                                <div class="form-group">
                                    <label>Group User</label> <span class="">*</span>
                                    <!-- <div class="col-md-9"> -->
                                         <?php
                                         $data = array();
                                         $data[''] = '';
                                         foreach ($group_user as $row) :
                                         $data[trim($row['usergroup_id'])] = $row['usergroup_desc'];
                                         endforeach;
                                         echo form_dropdown('userGroup', $data, '', 'id="id_groupUser_edit"  class="select2me form-control" required');
                                         ?>    
                                </div>
                
                                <div class="form-group">
                                    <label>Status User  </label>  <span class="">*</span>
                                    
                                        <?php
                                        $data = array();
                                        $data[''] = '';
                                        foreach ($statususer as $k) :
                                            $data[$k->statususer_id] = $k->statususer_desc;
                                        endforeach;
                                        echo form_dropdown('statusUser', $data, '', 'id="id_statusUser_edit" class="select2me form-control" required');
                                        ?>                                             
                                    
                                </div>
                        
                           
                            
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type ="submit" value="simpan" onclick="reload2();"name="btnSimpan" class="btn blue" id="id_btnUbah">
                                            <i class="fa fa-check"></i> Simpan</button>
                                        <!-- <button id="id_btnBatal" type="reset" class="btn default"><i class="fa fa-refresh"></i> Batal</button>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div> 
            </div> 
                 </div>
                    </div>
                        </form>   
                            </div>
                        </div>
                     </div>
                 </div>
            </div>
        </div>
<!-- =================================================================================================================== -->


<?php $this->load->view('app.min.inc.php'); ?>
<?php $this->load->view('admin/sec_user_js.php'); ?>


<!-- END JAVASCRIPTS