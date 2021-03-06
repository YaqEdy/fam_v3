<!-- BEGIN PAGE BREADCRUMB -->

<!-- END PAGE BREADCRUMB -->
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row">
    <div class="col-md-12">
        <!-- KONTEN DI SINI YA -->
        <!--<img id="id_imgCR" src="<?php /* //echo base_url('metronic/img/rusun05.jpg'); */ ?>" alt=""/>-->
        <h3 class="font-grey-cascade">Procurement <small></small></h3>

        <?php foreach ($data_pr as $value) { ?>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat <?php echo $value->warna ?>">
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <label id="id_request" style="/*font-size: 50px;*/"><?php echo $value->nilai ?></label>
                    </div>
                    <div class="desc">
                        <?php echo $value->ket ?>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

        



        <h3 class="font-grey-cascade">Asset Management<small></small></h3>


        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat green">
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <label id="id_proses" style="font-size: 50px;"></label>
                    </div>
                    <div class="desc">
                        Asset Aktif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat green">
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <label id="id_proses" style="font-size: 50px;"></label>
                    </div>
                    <div class="desc">
                        Asset Hilang
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat green">
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <label id="id_proses" style="font-size: 50px;"></label>
                    </div>
                    <div class="desc">
                        Hibah
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat green">
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <label id="id_proses" style="font-size: 50px;"></label>
                    </div>
                    <div class="desc">
                        Request Jual
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat red-intense">
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <label id="id_proses" style="font-size: 50px;"></label>
                    </div>
                    <div class="desc">
                        Terjual
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat purple">
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <label id="id_proses" style="font-size: 50px;"></label>
                    </div>
                    <div class="desc">
                        Reject
                    </div>
                </div>
            </div>
        </div>



        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat  yellow-lemon">
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <label id="id_proses" style="font-size: 50px;"></label>
                    </div>
                    <div class="desc">
                        Hilang
                    </div>
                </div>
            </div>
        </div>




    </div>



</div>
<!-- BEGIN ROW -->

<!-- END ROW -->

<!-- END PAGE CONTENT-->

<!--[if lt IE 9]>
<script src="<?php echo base_url('metronic/global/plugins/respond.min.js'); ?>"></script>
<script src="<?php echo base_url('metronic/global/plugins/excanvas.min.js'); ?>"></script> 
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="<?php echo base_url('metronic/global/plugins/jquery.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/js.cookie.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery.blockui.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js'); ?>" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?php echo base_url('metronic/global/scripts/app.min.js'); ?>" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="<?php echo base_url('metronic/layouts/layout4/scripts/layout.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/layouts/layout4/scripts/demo.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/layouts/global/scripts/quick-sidebar.min.js'); ?>" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<script>
    jQuery(document).ready(function () {
        file();
    });

    function file() {
        id = '';
        $.post("<?php echo site_url('main/getdetail'); ?>",
                {
                    'id': id
                }, function (data)
        {
            if (data.data_file.length > 0) {
                for (i = 0; i < data.data_file.length; i++) {
                    var ket = data.data_file[i].ket;
                    var nilai = data.data_file[i].nilai;
                    // alert(ket);
                    // alert(nilai);
                    if (ket == 'id_request') {
                        jQuery("label[id='id_request']").html(nilai);
                    } else if (ket == 'id_proses') {
                        jQuery("label[id='id_proses']").html(nilai);
                    } else if (ket == 'id_close') {
                        jQuery("label[id='id_close']").html(nilai);
                    } else if (ket == 'id_reject') {
                        jQuery("label[id='id_reject']").html(nilai);
                    }
                }
            }
        }, "JSON");
    }


</script>