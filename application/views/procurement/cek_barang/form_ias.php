<!-- BEGIN PAGE BREADCRUMB --> 

<style type="text/css">
    


    table#table_gridCategory th:nth-child(2){
        display: none;
    } 
    table#table_gridCategory td:nth-child(2){
        display: none;
    }

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}
</style>
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
                    <span class="caption-subject font-red sbold uppercase">Cek Item</span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="javascript:;" class="fullscreen">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                  <form role="form"  method="post" id="id_from_sec_group_user"  action="<?php echo base_url('procurement/cek_barang/savedata'); ?>">
                <div class="form-horizontal col-md-12">
                    <input type="hidden" name="id_po" value="<?php echo $ias->ID_PO?>">
                    <input type="hidden" name="id_item" value="<?php echo $ias->ITEM_ID?>">
                    <div class="form-group col-md-6">
                        <label class="col-sm-4 control-label" style="text-align: left;">No PR</label>
                        <div class="col-sm-4">
                            <input type="hidden" name="id_pr" value="<?php echo $ias->ID_PR?>">
                            <p class="form-control-static"><?php echo $ias->ID_PR?></p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-sm-4 control-label" style="text-align: left;">Tanggal PR</label>
                        <div class="col-sm-4">
                            <input type="hidden" name="id_pa" value="<?php echo $ias->TGL_PR?>">
                            <p class="form-control-static"><?php echo $ias->TGL_PR?></p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-sm-4 control-label" style="text-align: left;">Request Type</label>
                        <div class="col-sm-4">
                            <input type="hidden" value="<?php echo $ias->ReqCategoryID?>">
                            <p class="form-control-static"><?php echo $ias->ReqCategoryID?></p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-sm-4 control-label" style="text-align: left;">Branch</label>
                        <div class="col-sm-4">
                            <input type="hidden" value="<?php echo $ias->BRANCH_DESC?>">
                            <p class="form-control-static"><?php echo $ias->BRANCH_DESC?></p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-sm-4 control-label" style="text-align: left;">Category Name</label>
                        <div class="col-sm-4">
                            <input type="hidden" value="<?php echo $ias->ReqCategoryID?>">
                            <p class="form-control-static"><?php echo $ias->ReqCategoryID?></p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-sm-4 control-label" style="text-align: left;">Divisi</label>
                        <div class="col-sm-4">
                            <input type="hidden" value="<?php echo $ias->ID_PO?>">
                            <p class="form-control-static"><?php echo $ias->ID_PO?></p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-sm-4 control-label" style="text-align: left;">Nama Project</label>
                        <div class="col-sm-4">
                            <input type="hidden" value="<?php echo $ias->NAMA_BARANG?>">
                            <p class="form-control-static"><?php echo $ias->NAMA_BARANG?></p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-sm-4 control-label" style="text-align: left;">Periode</label>
                        <div class="col-sm-4">
                            <input type="hidden" value="<?php echo $ias->ID_PO?>">
                            <p class="form-control-static"><?php echo $ias->ID_PO?></p>
                        </div>
                    </div>
                </div>
                
                <div class="form-group m-form__group m--margin-top-10">
                    <h5 class="m-portlet__head-text"><strong>PO</strong></h5>
                </div>
                <div class="m-portlet__body col-md-12">
                    <div class="form-group m-form__group col-md-6">
                        <label class="col-md-6 control-label" for="exampleInputtext1">Jumlah Barang</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control m-input" name="jumlah_barang">
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-6">
                        <label class="col-md-6 control-label" for="exampleInputtext1">Jenis Barang</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-input" name="jenis_barang">
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body col-md-12">
                    <div class="form-group m-form__group col-md-6">
                        <label class="col-md-6 control-label" for="exampleInputtext1">Belum Terima</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control m-input" name="belum_terima">
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body col-md-12">
                    <div class="form-group m-form__group col-md-12">
                        <label class="col-md-3 control-label" for="exampleInputtext1">Nama Barang</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-input" name="nama_barang" value="<?php echo $ias->NAMA_BARANG?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body col-md-12">
                    <div class="form-group m-form__group col-md-12">
                        <label class="col-md-3 control-label" for="exampleInputtext1">QTY</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control m-input" name="qty">
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body col-md-12">
                    <div class="form-group m-form__group col-md-12">
                        <label class="col-md-3 control-label" for="exampleInputtext1">Tanggal Terima</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control m-input datepicker" name="tgl_terima">
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">QTY</th>
                                <th scope="col">Tanggal Terima</th>
                                <th scope="col">Penerima</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row" colspan="4">Example data</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- <div style="overflow:auto;"> -->
                    <!-- <div style="float:right;"> -->
                            <button type="submit" name="repr" value="PR" class="btn blue">RePR</button>
                            <button type="submit" name="repo" value="PO" class="btn blue">RePO</button>
                            <button type="submit" name="simpan" value="Simpan" class="btn blue">Simpan</button>
                    <!-- </div> -->
                <!-- </div> -->
                </form>

                </div>

            </div>
        </div>
        <!-- END VALIDATION STATES-->
    </div>
</div>


<!-- END PAGE CONTENT-->

<!-- Modal UPDATE-->



<?php $this->load->view('app.min.inc.php'); ?>

<script>
$("input[name='dpp']").on("keyup", function(){
    var dpp = parseInt($(this).val());
    var ppn = parseInt($("input[name='ppn']").val());
    var pph = parseInt($("input[name='pph']").val());
    var denda = parseInt($("input[name='denda']").val());

    $("input[name='dibayarkan']").val(dpp + ppn - pph - denda);
});

$("input[name='ppn']").on("keyup", function(){
    var dpp = parseInt($("input[name='dpp']").val());
    var ppn = parseInt($(this).val());
    var pph = parseInt($("input[name='pph']").val());
    var denda = parseInt($("input[name='denda']").val());

    $("input[name='dibayarkan']").val(dpp + ppn - pph - denda);
});

$("input[name='pph']").on("keyup", function(){
    var dpp = parseInt($("input[name='dpp']").val());
    var ppn = parseInt($("input[name='ppn']").val());
    var pph = parseInt($(this).val());
    var denda = parseInt($("input[name='denda']").val());

    $("input[name='dibayarkan']").val(dpp + ppn - pph - denda);
});

$("input[name='denda']").on("keyup", function(){
    var dpp = parseInt($("input[name='dpp']").val());
    var ppn = parseInt($("input[name='ppn']").val());
    var pph = parseInt($("input[name='pph']").val());
    var denda = parseInt($(this).val());

    $("input[name='dibayarkan']").val(dpp + ppn - pph - denda);
});

var return_data = "<?php echo $var;?>";
$('#varia1').html(return_data);
// $('.varia').(function() {   
//      $.ajax({
//       url: "<?php echo base_url('procurement/ias/get_var');?>",
//       type: 'post',
//       cache: false,
//       success: function(return_data) {
//          $('.varia').html(return_data);
//       }
//    });
// });

var num = 1;

$(document).on('click', '.datepicker', function(){
   $(this).datepicker({
        orientation: "left",
        format: "dd/mm/yyyy",
        autoclose: true
    }).focus();
   $(this).removeClass('datepicker');
});

$("#add_doc").click(function(){
    $('.dokumen').append('<div class="form-group m-form__group col-md-4"><label for="exampleInputtext1">Nama Dokumen</label><input type="text" class="form-control m-input" name="nama_dokumen[]" required></div><div class="form-group m-form__group col-md-4"><label for="exampleInputtext1">No Dokumen</label><input type="text" class="form-control m-input"  name="no_dokumen[]" required></div><div class="form-group m-form__group col-md-4"><label for="exampleInputtext1">Tanggal</label><input type="text" class="form-control m-input datepicker" name="tanggal[]" required></div>');
});

$("#add_val").click(function(){
    num++;
    $('.penilaian').append('<input type="hidden" name="variable[]" id="variable'+num+'"><div class="form-group m-form__group col-md-4"><label for="exampleInputtext1">Variable</label><select id="varia'+num+'" class="form-control m-input varia" name="varia[]" required><option value="">Pilih Variabel</option></select></div><div class="form-group m-form__group col-md-4"><label for="exampleInputtext1">Penilaian</label><input type="number" id="nilai'+num+'" class="form-control m-input" name="penilaian[]" required></div><div class="form-group m-form__group col-md-4"><label for="exampleInputtext1">Penilaian X Bobot</label><input type="text" class="form-control m-input pxb" id="pxb'+num+'" name="pxb[]" required></div>');

    $('#varia'+num+'').html(return_data);

    $("input[name='penilaian[]']").on("keyup", function(){
        var total = $(this).val();
        var id = $(this).attr('id');
        var lastid = id.substring(id.length-1, id.length);
        var percent = $('#varia'+lastid+'').val()/100;
        $('#pxb'+lastid+'').val(percent*total);
        var sum = 0;
        $('.pxb').each(function(){
            sum += parseInt(this.value);
            $('#akhir').val(sum);
        });
    });

    $(".varia").change(function(){
        var id = $(this).attr('id');
        var lastid = id.substring(id.length-1, id.length);
        var total = $('#nilai'+lastid+'').val();
        $('#variable'+lastid+'').val($(this).find('option:selected').text());
        var percent = $(this).val()/100;
        $('#pxb'+lastid+'').val(percent*total);
        var sum = 0;
        $('.pxb').each(function(){
            sum += parseInt(this.value);
            $('#akhir').val(sum);
        });
    });

});


$("#varia1").change(function(){
        var id = $(this).attr('id');
        var lastid = id.substring(id.length-1, id.length);
        var total = $('#nilai'+lastid+'').val();
        $('#variable'+lastid+'').val($(this).find('option:selected').text());
        var percent = $(this).val()/100;
        $('#pxb'+lastid+'').val(percent*total);
        var sum = 0;
        $('.pxb').each(function(){
            sum += parseInt(this.value);
            $('#akhir').val(sum);
        });
    });

    $("#nilai1").on("keyup", function(){
        var total = $(this).val();
        var id = $(this).attr('id');
        var lastid = id.substring(id.length-1, id.length);
        var percent = $('#varia'+lastid+'').val()/100;
        $('#pxb'+lastid+'').val(percent*total);
        var sum = 0;
        $('.pxb').each(function(){
            sum += parseInt(this.value);
            $('#akhir').val(sum);
        });
        console.log(sum);
    });


</script>


<!-- END JAVASCRIPTS