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
                    <span class="caption-subject font-red sbold uppercase">FORM PENILAIAN VENDOR</span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="javascript:;" class="fullscreen">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <form role="form"  method="post" id="id_from_sec_group_user" enctype="multipart/form-data" action="<?php echo base_url('procurement/penilaian_vendor/submit/'.$ID_PO_DETAIL); ?>">

                <div class="form-group m-form__group m--margin-top-10">
                    <h5 class="m-portlet__head-text"><strong>Penilaian Vendor</strong></h5>
                </div>

                <?php
                    $i = 1;
                    foreach ($nilai as $item) {
                ?>

                <div class="m-portlet__body col-md-12 penilaian">
                    <input type="hidden" name="vars[]" id="vars1" value="<?php echo $item->BOBOT;?>">
                    <input type="hidden" name="variable[]" id="variable1" value="<?php echo $item->VARIABEL;?>">
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">Variable</label>
                        <select class="form-control m-input varia" name="varia[]" id="varia_<?php echo $i;?>" required value="<?php echo $item->VARIABEL ?>">
                            <option value="">Pilih Variabel</option>
                            <?php 
                                foreach ($variables as $variable) {
                                    $selected = $variable->ID_VNILAI == $item->VARIABEL ? "selected" : "";
                                    echo '<option value="'.$variable->ID_VNILAI.'" '.$selected.'>'.$variable->VARIABEL.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">Penilaian</label>
                        <input type="number" class="form-control m-input penilaian" id="nilai_<?php echo $i;?>" name="penilaian[]" required value="<?php echo $item->PENILAIAN ?>">
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">Penilaian X Bobot</label>
                        <input type="text" class="form-control m-input pxb" id="pxb_<?php echo $i;?>" name="pxb[]" readonly value="<?php echo $item->BOBOT * $item->PENILAIAN / 100 ?>">
                    </div>
                </div>

                <?php 
                    $i++;
                    }
                ?>
                <div id="additional_form"></div>
                <div class="m-portlet__body col-md-12 text-center">
                    <button name="btnVal" type="button" class="btn green" id="add_val">Tambah Penilaian</button>
                </div>
                <div class="form-group col-md-12" style="margin-top: 2%;">
                    <label class="col-sm-3 control-label" style="text-align: left;"><strong>Nilai Akhir</strong></label>
                    <div class="col-sm-3">
                        <input class="form-control m-input" id="akhir" name="akhir" type="text" readonly>
                    </div>
                </div>
               
                <a href="<?php echo base_url('procurement/penilaian_vendor/')?>" class="btn red">Cancel</a>
                <button type="submit" class="btn blue">Send</button>
                </form>
            </div>

        </div>
    </div>
</div>



<?php $this->load->view('app.min.inc.php'); ?>

<script type="text/javascript">
    var variables = [
        <?php 
                foreach ($variables as $variable) {
        ?>
        { 
            ID_VNILAI : <?php echo $variable->ID_VNILAI; ?>,
            VARIABEL : "<?php echo $variable->VARIABEL;?>",
            BOBOT : <?php echo $variable->BOBOT;?>
        },
        <?php 
                }
        ?>
    ]

    $( document ).ready(function() {
        hitungNilai();
    });

    var count = <?php echo $i;?>;
    $( "#add_val" ).click(function() {
        $('#additional_form').append(
            '<div class="m-portlet__body col-md-12 penilaian template_form">'+
            '<input type="hidden" name="vars[]" id="vars_'+count+'">'+
            '<input type="hidden" name="variable[]" id="variable_'+count+'">'+
            '<div class="form-group m-form__group col-md-4">'+
            '<label for="exampleInputtext1">Variable</label>'+
            '<select class="form-control m-input varia" name="varia[]" id="varia_'+count+'" required>'+
            '<option value="">Pilih Variabel</option>'+
            '<?php 
            foreach ($variables as $variable) {
            echo '<option value="'.$variable->ID_VNILAI.'" >'.$variable->VARIABEL.'</option>';
            }
            ?>'+
            '</select>'+
            '</div>'+
            '<div class="form-group m-form__group col-md-4">'+
            '<label for="exampleInputtext1">Penilaian</label>'+
            '<input value="0" type="number" class="form-control m-input penilaian" id="nilai_'+count+'" name="penilaian[]" required>'+
            '</div>'+
            '<div class="form-group m-form__group col-md-4">'+
            '<label for="exampleInputtext1">Penilaian X Bobot</label>'+
            '<input value="0" type="text" class="form-control m-input pxb" id="pxb_'+count+'" name="pxb[]" readonly>'+
            '</div>'+
            '</div>'
        );
        count++;
    });

    $(document).on('change', ".varia", function() {
        let id = $(this).attr('id').substring(6)
        let obj = variables.find(o => o.ID_VNILAI.toString() === $(this).val());
        let nilai = $('#nilai_'+id).val();
        console.log('nilai', nilai)
        $('#pxb_'+id).attr('value', obj.BOBOT * nilai / 100);
        $('#vars_'+id).attr('value', obj.BOBOT);
        $('#variable_'+id).attr('value', obj.ID_VNILAI);
        hitungNilai();
    });

    $(document).on('keyup', ".penilaian", function() {
        let id = $(this).attr('id').substring(6)
        let varia = $('#varia_'+id).val();
        let nilai = $('#nilai_'+id).val();
        let obj = variables.find(o => o.ID_VNILAI.toString() === varia);
        $('#pxb_'+id).attr('value', obj.BOBOT * nilai / 100);
        hitungNilai();
    });

    function hitungNilai(){
        let total = 0;
        $(".varia").each(function() {
            let id = $(this).attr('id').substring(6)
            let bobot = $('#pxb_'+id).val()
            total += parseFloat(bobot)
        });
        $('#akhir').val(total)
    }
    
</script>