<!-- BEGIN PAGE BREADCRUMB -->
<!-- Include Twitter Bootstrap and jQuery: -->

<!-- Include Twitter Bootstrap and jQuery: -->
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
    font-size: 14px;
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
    padding: 10px 15px;
    font-size: 14px;
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
                    <span class="caption-subject font-red sbold uppercase">PO</span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="javascript:;" class="fullscreen">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php $l = 1;
                        foreach ($listvendors as $vendor) {
                            ?>
                            <form role="form" id="form<?php echo $l; ?>" class="form" method="post" id="id_from_sec_group_user" action="<?php echo base_url('procurement/po/savedata'); ?>">
                                <div class="form-group m-form__group m--margin-top-10">
                                    <h5 class="m-portlet__head-text"><strong>PO VENDOR <?php echo $vendor->VendorName; ?></strong></h5>
                                </div>
                                <div class="col-md-12" style="margin-bottom: 10px;">
                                    <a class="btn dark btn-outline sbold" data-toggle="modal" href="#modalPoID"> Detail Data </a><br>
                                </div>
                                <div class="m-portlet__body col-md-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nama Dokumen</th>
                                                <th scope="col">Validasi</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $nama_po ?></td>
                                                <td><input  type="checkbox" name="check[]" value="<?php echo $nama_po ?>"></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $nama_spk ?></td>
                                                <td><input  type="checkbox" name="check[]" value="<?php echo $nama_spk ?>"></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $nama_kpbj ?></td>
                                                <td><input  type="checkbox" name="check[]" value="<?php echo $nama_kpbj ?>"></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $nama_psw ?></td>
                                                <td><input  type="checkbox" name="check[]" value="<?php echo $nama_psw ?>"></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="m-portlet__body col-md-12">
                                    <div class="form-group m-form__group col-md-4">
                                        <label for="exampleInputtext1">Jumlah Barang</label>
                                        <input type="text" class="form-control m-input" id="jmlbrg<?php echo $l ?>" aria-describedby="textHelp" placeholder="Jumlah Barang" name="jmlbrg" readonly="">
                                    </div>
                                    <div class="form-group m-form__group col-md-4">
                                        <label for="exampleInputtext1">Jenis Barang</label>
                                        <input type="text" class="form-control m-input" id="jnsbrg<?php echo $l ?>" aria-describedby="textHelp" placeholder="Jenis Barang" name="jnsbrg" readonly="">
                                    </div>
                                    <div class="form-group m-form__group col-md-4">
                                        <label for="exampleInputtext1">Sub Total</label>
                                        <input type="text" class="form-control m-input" id="hargatotal_<?php echo $l ?>" aria-describedby="textHelp" placeholder="Sub Total" name="subtotal" readonly="">
                                    </div>
                                    <div class="form-group m-form__group col-md-4">
                                        <label for="exampleInputtext1">PPN</label>
                                        <input type="text" class="form-control m-input" id="ppn<?php echo $l ?>" aria-describedby="textHelp" placeholder="PPN" name="ppn" readonly="">
                                    </div>
                                    <div class="form-group m-form__group col-md-4">
                                        <label for="exampleInputtext1">Presentase</label>
                                        <div class="col-md-12">
                                            <div class="col-md-6">
                                                <input class="form-control m-input" value="10" name="presentase" id="presen<?php echo $l ?>" type="number" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <button type="button" class="btn red col-md-6" id="edit_presentase<?php echo $l ?>">Edit</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group col-md-4">
                                        <label for="exampleInputtext1">Disc</label>
                                        <input type="number" name="disc" class="form-control m-input" id="disc<?php echo $l ?>" aria-describedby="textHelp" placeholder="Disc" value="0">
                                    </div>
                                    <div class="form-group m-form__group col-md-4">
                                        <label for="exampleInputtext1">PPH</label>
                                        <input type="number" name="pph" class="form-control m-input" id="pph<?php echo $l ?>" aria-describedby="textHelp" placeholder="PPH" value="0">
                                    </div>
                                    <div class="form-group m-form__group col-md-4">
                                        <label for="exampleInputtext1">Total</label>
                                        <input type="text" name="totalall" class="form-control m-input" id="totalall<?php echo $l ?>" aria-describedby="textHelp" placeholder="Total" readonly="">
                                    </div>
                                </div>
                                <input type="hidden" name="id_pr" value="<?php echo $po->RequestID ?>">
                                <input type="hidden" name="id_vendor" value="<?php echo trim($vendor->VendorID) ?>">
                                <input type="hidden" name="redirect" value="ada">

                                <!--batas-->

                                <!--end batas-->

                                <div class="form-group m-form__group m--margin-top-10">
                                    <?php if (trim($po->ReqTypeID) == '3') { ?>
                                    <h5 class="m-portlet__head-text"><strong>Sewa Barang dan Bangunan</strong></h5>
                                    <?php } else { ?>
                                    <h5 class="m-portlet__head-text"><strong>Detail Barang Dan Harga</strong></h5>
                                    <?php } ?>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <table class="table table-bordered table-hover" >
                                            <thead>
                                                <tr>
                                                    <th>Nama Barang</th>
                                                    <th>QTY</th>
                                                    <!--Sewa-->
                                                    <?php if (trim($po->ReqTypeID) == '3') { ?>
                                                    <th>Jenis Periode</th>                                
                                                    <th>Start Periode</th>                                
                                                    <th>End Periode</th>                                
                                                    <th>Notif</th>                                
                                                    <?php } ?>
                                                    <th>Harga Satuan</th>
                                                    <th>Harga</th>
                                                    <th>Hapus</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1;
                                                foreach ($item as $list) {
                                                    ?>
                                                    <tr id="row<?php echo $i . $l; ?>">
                                                        <td><input type="hidden" name="itemid[]" value="<?php echo $list->ItemID ?>">
                                                            <input type="text" name="barang[]" value="<?php echo $list->ItemName ?>"></td>
                                                            <td><input class="brg<?php echo $l; ?>" type="number" name="qty[]" id="qty<?php echo $i ?>" value="<?php echo $list->Qty ?>"></td>
                                                            <!--Sewa-->
                                                            <?php if (trim($po->ReqTypeID) != '3') {
                                                                $ihidden = "hidden";
                                                            } else {
                                                                $ihidden = "";
                                                            } ?>
                                                            <td class="<?php echo $ihidden ?>">
                                                                <!-- <input class="" type="text" name="jns_periode[]" id="jns_periode<?php echo $i ?>" value="<?php echo $list->JNS_PERIODE ?>"> -->
                                                                <select name="jns_periode[]" id="jns_periode<?php echo $i ?>" class="form-control input-small" onchange="periodeSewa(this.value)">
                                                                    <option disabled="" value="">-Select-</option>
                                                                    <?php if ($list->JNS_PERIODE == 'Hari'){ ?>
                                                                    <option selected="" value="Hari">Hari</option>
                                                                    <?php } else {  ?>
                                                                    <option value="Hari">Hari</option>
                                                                    <?php }

                                                                    if ($list->JNS_PERIODE == 'Bulan'){ ?>
                                                                    <option selected="" value="Bulan">Bulan</option>
                                                                    <?php } else {  ?>
                                                                    <option value="Bulan">Bulan</option>
                                                                    <?php } 

                                                                    if ($list->JNS_PERIODE == 'Tahun'){ ?>
                                                                    <option selected="" value="Tahun">Tahun</option>
                                                                    <?php } else {  ?>
                                                                    <option value="Tahun">Tahun</option>
                                                                    <?php }  ?>
                                                                </select>
                                                            </td>

                                                            <td class="<?php echo $ihidden ?>"><input class="date-picker2" type="text" name="start_periode[]" id="start_periode<?php echo $i ?>" value="<?php echo $list->START_PERIODE ?>"></td>
                                                            <td class="<?php echo $ihidden ?>"><input class="date-picker2" type="text" name="end_periode[]" id="end_periode<?php echo $i ?>" value="<?php echo $list->END_PERIODE ?>"></td>

                                                            <td class="<?php echo $ihidden ?>"><input class="date-picker" data-date-format="dd/mm/yyyy" type="text" name="notif[]" id="notif<?php echo $i ?>" value="<?php echo $list->NOTIF ?>"></td>

                                                            <td><input type="text" name="satuan_X[]" class="nomor_edit" id="satuan_X<?php echo $i ?>" value="<?php echo "Rp " . number_format($list->HargaHPS, 0) ?>"></td>
                                                            <td><input type="text" name="hargatotal_X[]" class="nomor_edit" id="total_X<?php echo $i ?>" value="<?php echo "Rp " . number_format($list->total, 0) ?>"></td>
                                                            <td class="hidden"><input type="number" name="satuan[]" class="satuan<?php echo $l; ?>" id="satuan<?php echo $i ?>" value="<?php echo $list->HargaHPS ?>"></td>
                                                            <td class="hidden"><input type="number" name="hargatotal[]" class="total<?php echo $l; ?>" id="total<?php echo $i ?>" value="<?php echo $list->total ?>"></td>
                                                            <td><button onclick="dltRow('<?php echo $i; ?>', '<?php echo $l; ?>')">Delete</button></td>
                                                        </tr>
                                                        <?php $i++;
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group m--margin-top-10 col-md-12">
                                        <div class="col-md-3">
                                            <h5 class="m-portlet__head-text"><strong>Termin</strong></h5>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="mt-checkbox">
                                                <input name="detailPerBrg" type="checkbox" id="detailPerBrgID<?php echo $l; ?>"> Detail Persentase Brg
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="mt-checkbox">
                                                <input type="checkbox" id="detail<?php echo $l; ?>"> Detail Terima
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="form-group m-form__group col-md-3" id="notdetail<?php echo $l; ?>">
                                            <input type="text" class="form-control m-input datepicker" name="dterima" id="dterima<?php echo $l; ?>" aria-describedby="textHelp" placeholder="dd/mm/yyyy" required>
                                        </div>
                                    </div>
                                    <div class="tanda termin<?php echo $l; ?>">
                                        <div class="m-portlet__body col-md-12">
                                            <div class="form-group m-form__group col-md-3">
                                                <input type="hidden" name="term[]" value="1">
                                                <label for="exampleInputtext1">Persentase</label>
                                                <input type="number" class="form-control m-input form<?php echo $l; ?>" name="persentase[]" id="presentase<?php echo $l; ?>" aria-describedby="textHelp" placeholder="Persentase" required>
                                            </div>
                                            <div class="form-group m-form__group col-md-3">
                                                <label for="exampleInputtext1">Nilai</label>
                                                <input type="text" class="form-control m-input" id="nilai<?php echo $l; ?>" name="nilai[]" aria-describedby="textHelp" placeholder="Nilai" readonly required>
                                            </div>
                                            <div class="form-group m-form__group col-md-3">
                                                <label for="exampleInputtext1">Tanggal Jatuh Tempo</label>
                                                <input type="text" class="form-control m-input datepicker" name="tempo[]" aria-describedby="textHelp" placeholder="Tanggal Jatuh Tempo" required>
                                            </div>
                                            <div class="form-group m-form__group col-md-3 terima<?php echo $l; ?>" hidden>
                                                <label for="exampleInputtext1">Tgl Akhir Penerimaan Barang</label>
                                                <input type="text" class="form-control m-input datepicker" name="akhir[]" aria-describedby="textHelp" placeholder="Tgl Akhir Penerimaan Barang">
                                            </div>

                                            <div class="form-group m-form__group col-md-3">
                                                <label for="exampleInputtext1">Persentase Brg</label><input type="number" class="form-control m-input presentaseClsBrgId<?php echo $l; ?>" name="persentaseBrg[]" disabled=""  id="presentaseBrgId<?php echo $l; ?>" aria-describedby="textHelp" placeholder="Persentase Brg">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-portlet__body col-md-12 text-center">
                                        <button name="btnSimpan" type="button" class="btn green" id="add_termin<?php echo $l; ?>">Tambah Termin</button>
                                    </div>
                                </form>
                                <?php $l++;
                            }
                            ?>

                            <button type="button" id="btnSubmit" onclick="submit()">Submit</button>
                        </div>
                    </div>


                </div>

            </div>
        </div>
        <!-- END VALIDATION STATES-->
    </div>
    <!-- /.modal -->
    <div class="modal fade" id="modalPoID" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Detail Data</h4>
                </div>
                <div class="modal-body"> <?php echo $this->load->view('procurement/po/modalData') ?></div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <!--<button type="button" class="btn green">Save changes</button>-->
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- END PAGE CONTENT-->

    <!-- Modal UPDATE-->



    <?php $this->load->view('app.min.inc.php'); ?>

    <script>
        var viewMode = "";
        var minViewMode = "";
        var formatDate = "dd-mm-yyyy";

        var $ = jQuery.noConflict();
        $(document).ready(function () {

            ComponentsDateTimePickers.init();
            var valCheck;       

            // $('#add_termin1').attr("disabled","disabled");
            for (var l = 1; l <= $(".tanda").length; l++) {
                $("#detailPerBrgID" + l).change(function () {
                    var kelas2 = $(this).attr('id');
                    var form2 = kelas2.substring(kelas2.length - 1, kelas2.length);
                    if (this.checked) {
                        $('.presentaseClsBrgId' + form2).removeAttr("disabled"); 
                        valCheck = '1';
                        // $('#add_termin' + form2).removeAttr("disabled");
                    } else {
                        $('.presentaseClsBrgId' + form2).attr("disabled","disabled");
                        $('.presentaseClsBrgId' + form2).val(0);
                        valCheck = '0';
                        // $('#add_termin' + form2).attr("disabled","disabled");
                    }
                });

                $("#detail" + l).change(function () {
                    var kelas = $(this).attr('id');
                    var form = kelas.substring(kelas.length - 1, kelas.length);
                    if (this.checked) {
                        $('.terima' + form).show();
                        $('#notdetail' + form).hide();
                        $('#dterima' + form).removeAttr('required');
                    } else {
                        $('.terima' + form).hide();
                        $('#notdetail' + form).show();
                        $('#dterima' + form).attr('required');
                    }
                });

                $('#edit_presentase' + l).click(function () {
                    var kelas = $(this).attr('id');
                    var form = kelas.substring(kelas.length - 1, kelas.length);
                    $('#presen' + form).attr('readonly', false);
                });

                var sum = 0;
                var brg = 0;

                $('.total' + l).each(function () {
                    sum += parseInt(this.value);
                });

                $('.brg' + l).each(function () {
                    brg += parseInt(this.value);
                });

                $('#hargatotal_' + l).val(number_format(sum,0));
                $('#hargatotal' + l).val(number_format(sum,0));
                $('#ppn' + l).val(number_format(sum * 0.1,0));
                $('#jmlbrg' + l).val(number_format(brg,0));
                $('#jnsbrg' + l).val($('.brg' + l).length);
                $('#totalall' + l).val(number_format((sum * 0.1) + sum,0));
            }

            myDate();
        });

        function myDate() {
            $('.date-picker2').datepicker({
                orientation: "left",
                format: formatDate,
                viewMode: viewMode,
                minViewMode: minViewMode,
                autoclose: true
            });
        }

        function periodeSewa(val) {
            $('.date-picker2').datepicker('remove');
            if (val == 'Hari') {
                viewMode = "";
                minViewMode = "";
                formatDate = "dd-mm-yyyy";
            } else if (val == 'Bulan') {
                viewMode = "months";
                minViewMode = "months";
                formatDate = "mm-yyyy";
            } else if (val == 'Tahun') {
                viewMode = "years";
                minViewMode = "years";
                formatDate = "yyyy";
            } else {
                viewMode = "";
                minViewMode = "";
                formatDate = "dd-mm-yyyy";
            }
            myDate();
        }

    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the crurrent tab
    var seluruh = $('.tanda').length;

    function dltRow(row, form) {
        var sum = 0;
        var brg = 0;
        $('#row' + row + form).remove();
        console.log('.total' + form);
        $('.total' + form).each(function () {
            sum += parseInt(this.value);
        });
        $('.brg' + form).each(function () {
            brg += parseInt(this.value);
        });
        $('#hargatotal_' + form).val(sum);
        $('#hargatotal' + form).val(sum);
        $('#jmlbrg' + form).val(brg);
        $('#jnsbrg' + form).val($('.brg' + form).length);
        hitung2(form);
    }
    
    function showTab(n) {
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
//        alert(x.length);
//        if (n == (x.length - 1)) {
    if(n == 1){
//            document.getElementById("nextBtn").innerHTML = "Submit";
//            $("#nextBtn").attr('onclick', 'submit()');
$("#nextBtn").hide();
} else {
    $("#nextBtn").show();
    document.getElementById("nextBtn").innerHTML = "Next";
    $("#nextBtn").attr('onclick', 'nextPrev(1)');
}
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n)
    }

    function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm())
            return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form...
        if (currentTab >= x.length) {
            // ... the form gets submitted:
            document.getElementById("regForm").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
                // add an "invalid" class to the field:
                y[i].className += " invalid";
                // and set the current valid status to false
                valid = true;
            }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " active";
    }
    $(document).on('click', '.datepicker', function () {
        $(this).datepicker({
            orientation: "left",
            format: "dd/mm/yyyy",
            autoclose: true
        }).focus();
        $(this).removeClass('datepicker');
    });

    var num = $(".tanda").length;
    var n = 1;

    for (var l = 1; l <= $(".tanda").length; l++) {
        $("#add_termin" + l).click({param: l}, add_termin);
    }

    function add_termin(e) {
        console.log(e.data.param);
        num++;

        if ($('#detail' + e.data.param).is(":checked")) {
            $('.termin' + e.data.param).append('<div class="m-portlet__body col-md-12"><div class="form-group m-form__group m--margin-top-10 col-md-12"><div class="form-group m-form__group col-md-3"><label for="exampleInputtext1">Persentase</label><input type="number" class="form-control m-input form' + e.data.param + '" name="persentase[]" id="presentase' + num + '" aria-describedby="textHelp" placeholder="Persentase"></div><div class="form-group m-form__group col-md-3"><label for="exampleInputtext1">Nilai</label><input type="text" class="form-control m-input" id="nilai' + num + '" name="nilai[]" aria-describedby="textHelp" placeholder="Nilai" readonly></div><div class="form-group m-form__group col-md-3"><label for="exampleInputtext1">Tanggal Jatuh Tempo</label><input type="text" class="form-control m-input datepicker" id="exampleInputtext1" name="tempo[]" aria-describedby="textHelp" placeholder="Tanggal Jatuh Tempo"></div><div class="form-group m-form__group col-md-3 terima' + e.data.param + '"><label for="exampleInputtext1">Tgl Akhir Penerimaan Barang</label><input type="text" class="form-control m-input datepicker" name="akhir[]" aria-describedby="textHelp" placeholder="Tgl Akhir Penerimaan Barang"></div></div><div class="form-group m-form__group col-md-3" persbrg' + e.data.param + '"><label for="exampleInputtext1">Persentase Brg</label><input type="number" class="form-control m-input form' + e.data.param + ' presentaseClsBrgId' + e.data.param + '" name="persentaseBrg[]" id="presentaseBrgId' + num + '" aria-describedby="textHelp" placeholder="Persentase"></div></div>');
        } else {
            $('.termin' + e.data.param).append('<input type="hidden" name="term[]" value="' + num + '"><div class="m-portlet__body col-md-12"><div class="form-group m-form__group col-md-3"><label for="exampleInputtext1">Persentase</label><input type="number" class="form-control m-input form' + e.data.param + '" name="persentase[]" id="presentase' + num + '" aria-describedby="textHelp" placeholder="Persentase"></div><div class="form-group m-form__group col-md-3"><label for="exampleInputtext1">Nilai</label><input type="text" class="form-control m-input" id="nilai' + num + '" name="nilai[]" aria-describedby="textHelp" placeholder="Nilai" readonly></div><div class="form-group m-form__group col-md-3"><label for="exampleInputtext1">Tanggal Jatuh Tempo</label><input type="text" class="form-control m-input datepicker" id="exampleInputtext1" name="tempo[]" aria-describedby="textHelp" placeholder="Tanggal Jatuh Tempo"></div><div class="form-group m-form__group col-md-3 terima' + e.data.param + '" hidden><label for="exampleInputtext1">Tgl Akhir Penerimaan Barang</label><input type="text" class="form-control m-input datepicker" name="akhir[]" aria-describedby="textHelp" placeholder="Tgl Akhir Penerimaan Barang"></div><div class="form-group m-form__group col-md-3" persbrg' + e.data.param + '" ><label for="exampleInputtext1">Persentase Brg</label><input type="number" class="form-control m-input form' + e.data.param + ' presentaseClsBrgId' + e.data.param + '" name="persentaseBrg[]" id="presentaseBrgId' + num + '" aria-describedby="textHelp" placeholder="Persentase"></div></div>');
        }

        $("input[name='persentase[]']").on("keyup", function () {
            var kelas = $(this).attr('class');
            var form = kelas.substring(kelas.length - 1, kelas.length);
            //        var total = $('#hargatotal'+form).val();
            var total = CleanNumber($('#totalall' + form).val());
            var percent = ($(this).val()) / 100;
            var id = $(this).attr('id');
            var lastid = id.substring(id.length - 1, id.length);
            $('#nilai' + lastid + '').val(number_format(percent * total,0));
        });
    }


    function submit() {
        var persentasi = $("input[name='presentase[]']");
        
        var cekDok = $("input[name='check[]']");
        var cc = 0;
        for (var i=0;i<cekDok.length;i++){
            if ( cekDok[i].checked ) {
              cc = cc+1;
          }
      }
      if(cc <=0){
        alert('ceklis salah satu dokumen');
        return false;
    }
//    alert(num);
var tmp = 0;
var tmp2 = 0;
for (var i = 1; i <= num; i++) {
    var isi = parseInt($('#presentase' + i).val());
    var isi2 = parseInt($('#presentaseBrgId' + i).val());
    tmp = tmp + isi;
    tmp2 = tmp2 + isi2;
}

if (tmp != 100) {
    alert("Jumlah Persentase maupun Persentase Brg harus 100");
    return false;
}
var ckbrg = document.getElementById("detailPerBrgID1");

if (ckbrg.checked && tmp2 !=100) {
    alert("Jumlah Persentase maupun Persentase Brg harus 100");
    return false;
}


var c = confirm("Simpan Data ?");
if(c == true){
    for (var m = 1; m <= $(".form").length; m++) {
        var url = $("#form" + m).attr('action');
    //        alert(url);
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: $("#form" + m).attr('action'),
        data: $("#form" + m).serialize(),
        success: function (response) {
            ajaxModal();
            $('.modal_json').fadeIn('fast');
            UIToastr.init(response.tipePesan, response.pesan);

            if (response.act == '1') {
             location.href = "<?php echo base_url('procurement/po/home') ?>";
         }
     }
 });
}
$('#btnSubmit').attr("disabled","disabled");
}else{
    return false;
}


}


for (var j = 1; j <= $("input[name='barang[]']").length; j++) {
    $("#qty" + j).on("keyup", {obj: j}, counter);
    $("#disc" + j).on("keyup", {obj: j}, hitung);
    $("#pph" + j).on("keyup", {obj: j}, hitung);
    $("#presen" + j).on("keyup", {obj: j}, hitung);
	
	$("#satuan_X" + j).on("keyup", {obj: j}, hSatuan);
}

function hSatuan(e){
	var obj = e.data.obj;
	var qty= parseInt($('#qty' + obj).val().replace(/,/g, ''));
	var satuan= parseInt($('#satuan_X' + obj).val().replace(/,/g, ''));
    $('#total_X' + obj).val(number_format(qty*satuan,0));
    $('#hargatotal_' + obj).val(number_format(qty*satuan,0));
	
	var sub = qty*satuan;
    var disc = $('#disc' + obj).val();
    var presentase = parseInt($('#presen' + obj).val());
    var pph = $('#pph' + obj).val();
    $('#ppn' + obj).val(number_format((sub - disc) * (presentase / 100),0))
    var ppn = (sub - disc) * (presentase / 100);
    $('#totalall' + obj).val(number_format((sub - disc) + ppn - pph,0));
}

function hitung(e) {
    var obj = e.data.obj;
    var sub = parseInt($('#hargatotal_' + obj).val().replace(/,/g, ''));
    var disc = $('#disc' + obj).val().replace(/,/g, '');
    var presentase = parseInt($('#presen' + obj).val());
    var pph = $('#pph' + obj).val().replace(/,/g, '');
    $('#ppn' + obj).val(number_format((sub - disc) * (presentase / 100),0));
    var ppn = parseInt($('#ppn' + obj).val().replace(/,/g, ''));
    $('#totalall' + obj).val(number_format((sub - disc) + ppn - pph,0));
}

function hitung2(obj) {
    var sub = parseInt($('#hargatotal_' + obj).val().replace(/,/g, ''));
    var disc = parseInt($('#disc' + obj).val().replace(/,/g, ''));
    var presentase = $('#presen' + obj).val();
    var pph = $('#pph' + obj).val().replace(/,/g, '');
    $('#ppn' + obj).val(number_format((sub - disc) * (presentase / 100),0))
    var ppn = parseInt($('#ppn' + obj).val().replace(/,/g, ''));
    $('#totalall' + obj).val(number_format((sub - disc) + ppn - pph,0));
}

function counter(e) {
    var obj = e.data.obj;
    var sum = 0;
    var satuan = $("#satuan_X" + obj).val().replace(/,/g, '').replace('Rp ', '');
    var kelas = $("#satuan" + obj).attr('class');
    var form = kelas.substring(kelas.length - 1, kelas.length);
    var total = ($("#qty" + obj).val()) * satuan;
    $("#total_X" + obj).val(total);
	for (var j = 1; j <= $("input[name='hargatotal_X[]']").length; j++) {
		sum += parseInt($("#total_X" + obj).val().replace(/,/g, '').replace('Rp ', ''));
	}
    // $('.total_X' + form).each(function () {
        // sum += parseInt(this.value);
    // });
    $('#hargatotal_' + obj).val(number_format(sum,0));
	$('#total_X' + obj).val(number_format(total,0));

    hitung2(form);
}

for (var k = 1; k <= $("input[name='qty[]']").length; k++) {
    $("#satuan" + k).on("keyup", {obj: k}, counter);
}

$("input[name='persentase[]']").on("keyup", function () {
    var kelas = $(this).attr('class');
    var form = kelas.substring(kelas.length - 1, kelas.length);
//        var total = $('#hargatotal'+form).val();
var total = CleanNumber($('#totalall' + form).val());
var percent = ($(this).val()) / 100;
var id = $(this).attr('id');
var lastid = id.substring(id.length - 1, id.length);
$('#nilai' + lastid + '').val(number_format(percent * total,0));
});


</script>


<!-- END JAVASCRIPTS