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
                    <span class="caption-subject font-red sbold uppercase">Upload Dokumen IAS Penilaian</span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="javascript:;" class="fullscreen">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                  <form role="form"  method="post" id="id_from_sec_group_user"  action="<?php echo base_url('procurement/ias/savedata'); ?>">
                <div class="form-horizontal col-md-12">
                    <div class="form-group col-md-12">
                        <label class="col-sm-4 control-label" style="text-align: left;">No PR</label>
                        <div class="col-sm-4">
                            <input type="hidden" name="id_pr" value="<?php echo $ias->ID_PR?>">
                            <p class="form-control-static"><?php echo $ias->ID_PR?></p>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="col-sm-4 control-label" style="text-align: left;">No PA</label>
                        <div class="col-sm-4">
                            <input type="hidden" name="id_pa" value="<?php echo $ias->ID_PA?>">
                            <p class="form-control-static"><?php echo $ias->ID_PA?></p>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="col-sm-4 control-label" style="text-align: left;">No PO</label>
                        <div class="col-sm-4">
                            <input type="hidden" name="id_po" value="<?php echo $ias->ID_PO?>">
                            <p class="form-control-static"><?php echo $ias->ID_PO?></p>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="col-sm-4">
                           <button type="button" class="btn blue">History</button>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="col-sm-3 control-label" style="text-align: left;">DPP</label>
                        <div class="col-sm-3">
                            <input class="form-control m-input" name="dpp" id="dpp" type="number" required>
                        </div>
                        <div class="col-md-3">
                            <label class="mt-checkbox">
                                <input type="checkbox" id="detail"> PKP
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            <label class="mt-checkbox">
                                <input type="checkbox" id="detail"> Include PPN
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="col-sm-3 control-label" style="text-align: left;">PPN</label>
                        <div class="col-sm-3">
                            <input class="form-control m-input" name="ppn" id="ppn" type="number" required>
                        </div>
                        <div class="col-sm-3">
                            <button type="button" class="btn red">Edit</button>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="col-sm-3 control-label" style="text-align: left;">PPH</label>
                        <div class="col-sm-3">
                            <input class="form-control m-input" name="pph" id="pph" type="number" required>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="col-sm-3 control-label" style="text-align: left;">Denda</label>
                        <div class="col-sm-3">
                            <input class="form-control m-input" name="denda" id="denda" type="number" required>
                        </div>
                        <div class="col-sm-3">
                            <button type="button" class="btn red">Edit</button>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="col-sm-3 control-label" style="text-align: left;">Nilai Dibayarkan</label>
                        <div class="col-sm-3">
                            <input class="form-control m-input" type="number" id="dibayarkan" name="dibayarkan" readonly>
                        </div>
                    </div>
                </div>
                
                <div class="form-group m-form__group m--margin-top-10">
                    <h5 class="m-portlet__head-text"><strong>Dokumen IAS</strong></h5>
                </div>
                <div class="m-portlet__body col-md-12 dokumen">
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">Nama Dokumen</label>
                        <input type="text" class="form-control m-input" name="nama_dokumen[]" required>
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">No Dokumen</label>
                        <input type="text" class="form-control m-input"  name="no_dokumen[]" required>
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">Tanggal</label>
                        <input type="text" class="form-control m-input datepicker" name="tanggal[]" required>
                    </div>
                </div>
                <div class="m-portlet__body col-md-12 text-center">
                    <button name="btnDoc" type="button" class="btn green" id="add_doc">Tambah Dokumen</button>
                </div>
                <div class="form-group m-form__group m--margin-top-10">
                    <h5 class="m-portlet__head-text"><strong>Penilaian Vendor</strong></h5>
                </div>
                <div class="m-portlet__body col-md-12 penilaian">
                    <input type="hidden" name="variable[]" id="variable1">
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">Variable</label>
                        <select class="form-control m-input varia" name="varia[]" id="varia1" required>
                            <option value="">Pilih Variabel</option>
                        </select>
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">Penilaian</label>
                        <input type="number" class="form-control m-input" id="nilai1" name="penilaian[]" required>
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">Penilaian X Bobot</label>
                        <input type="number" min="0" class="form-control m-input pxb" id="pxb1" name="pxb[]" required>
                    </div>
                </div>
                <div class="m-portlet__body col-md-12 text-center">
                    <button name="btnVal" type="button" class="btn green" id="add_val">Tambah Penilaian</button>
                </div>
                <div class="form-group col-md-12" style="margin-top: 2%;">
                    <label class="col-sm-3 control-label" style="text-align: left;"><strong>Nilai Akhir</strong></label>
                    <div class="col-sm-3">
                        <input class="form-control m-input" id="akhir" name="akhir" type="text">
                    </div>
                </div>
                
                <!-- <div style="overflow:auto;"> -->
                    <!-- <div style="float:right;"> -->
                            <a href="<?php echo base_url('procurement/ias/home')?>" class="btn red">Cancel</a>
                            <button type="submit" class="btn blue">Send</button>
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