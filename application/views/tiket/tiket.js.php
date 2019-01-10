<script>

    var dataTable, dataTable1, dataTable2, dataTable3, dataTable4, dataTable5, dataTable7;
    var iStatus = '%';
    var iSearch = 'NO_SPD';
    var iZone = 1;
    var iID_TIKET = '';
    var iID_TIKET_DETAIL = '';
    var iSES = '';
    var num = 1;

    jQuery(document).ready(function () {
        ComponentsDateTimePickers.init();
        loadGridPilihTiket();
        loadGridAddPopUpPR_inv();
        loadGridPilihPRpopUp();
        loadGridPilihEtiket();
        loadGridAddPRto_Inv();
        loadGridInvoicePembayaran();
        loadGridPaymentGoal();
        loadGridHistoryPR();
        // loadGridPopUpHistoryPR();

    });

    function deleterow() {
        document.getElementById('pulangpergi1').style.display = "none";
    }

    function getNum(elem) {

    }

    function rld_setPR() {
        // alert('new');
        $('#TabelEtiket').DataTable().ajax.reload();
    }

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }

    window.onload = function () {
        $('#id_bank2').hide();
        $('#id_bank3').hide();
        $('#id_bank4').hide();

    };

    window.onload2 = function () {
        $('#pulangpergi1').hide();

    };

    function hidden() {
        document.getElementById('id_bank2').style.display = "none";
        document.getElementById('id_bank3').style.display = "none";
        document.getElementById('id_bank4').style.display = "none";

    }

    function hiddenjadwal() {
        document.getElementById('pulangpergi1').style.display = "none";
    }

    function reloaddong() {
        window.location.reload()
    }

    var pp = 0;
    function addjadwal() {
        if (pp == 0) {
            $('#pulangpergi1').show();
        }
        pp = pp + 1;
    }

    var ibank = 1;
    function addbank() {
        if (ibank == 1) {
            $('#id_bank2').show();
        } else if (ibank == 2) {
            $('#id_bank3').show();
        } else if (ibank == 3) {
            $('#id_bank4').show();
        }
        if (ibank < 4) {
            ibank = ibank + 1;
        }
    }

    $('#id_form_spd2').submit(function (event) {
        // alert('asd');
        var r = confirm('Do you want to save this file ?');
        if (r == true) {
            $.ajax({
                url: "simpan_spd", // json datasource
                type: 'POST',
                data: new FormData(this),
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (e) {
                    if (e.act) {
                        UIToastr.init(e.tipePesan, e.pesan);
                        iPID = e.iPid;
                        alert(data.data_res[i].Image);
                        // console.log(idata);
                        $('#Image').val(data.data_res[i].Image);
                        $('#ID_TIKET').val(data.data_res[i].ID_TIKET);
                        $("#id_btnBatal22").trigger('click');

                    } else {
                        UIToastr.init(e.tipePesan, e.pesan);
                    }
                },
            });
            event.preventDefault();
        } else {//if(r)
            return false;
        }
    });

    $('#id_formRoom_flow').submit(function (event) {
        // alert('asd');
        var r = confirm('Apakah data yang di input sudah benar ?');
        if (r == true) {
            $.ajax({
                url: "simpan/" + ibank, // json datasource
                type: 'POST',
                data: new FormData(this),
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (e) {
                    pageLoad(1);
                    if (e.act) {
                        UIToastr.init(e.tipePesan, e.pesan);
                        iPID = e.iPid;
                        $("#id_btnBatal22").trigger('click');
                        event.preventDefault();
                    } else {
                        UIToastr.init(e.tipePesan, e.pesan);
                    }
                },
            });

        } else {//if(r)
            return false;
        }

    });

    function pilihPR() {
        var selected = dataTable.column(1).checkboxes.selected();
        // console.log(selected); 
        iID_TIKET = iID_TIKET + selected.join(',');
        console.log(iID_TIKET);
        $.ajax({
            url: "teruskan_tiketPR", // json datasource
            type: 'POST',
            data: {sID_TIKET: iID_TIKET},
            cache: false,
            dataType: "JSON",
            success: function (e) {
                $("#").val($("#").val());
                pageLoad(1);
                // alert('asd');
                if (e.act) {
                    UIToastr.init(e.tipePesan, e.pesan);
                    iPID = e.iPid;
                    $("#").trigger('click');
                } else {
                    UIToastr.init(e.tipePesan, e.pesan);
                }
            },
            complete: function (e) {
                $('#TabelPilihTravel').DataTable().ajax.reload();
            }
        });
    }

    function loadGridPilihTiket() {

        dataTable = $('#TabelPilihTravel').DataTable({
            // "order": [[ 0, "asc" ],[6, "desc" ]],
            "columnDefs": [
                {"targets": [-1], "searchable": false, "orderable": false},
                {"targets": [2], "visible": false, "searchable": false, "orderable": false},
                {"targets": [1], "checkboxes": {"selectRow": true}},
                {"targets": [4], "searchable": false, "orderable": false},
            ],
            "select": {"style": "multi"},
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            //                // set the initial value
            "pageLength": 5,
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "<?php echo base_url("/tiket/tiket/ajax_GridPRTiket"); ?>", // json datasource
                type: "post", // method  , by default get

                error: function () {  // error handling
                    $(".TabelPilihTravel-error").html("");
                    // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $('#TabelPilihTravel tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                    $("#TabelPilihTravel_processing").css("display", "none");

                }
            }
        });
    }

    function loadGridHistoryPR() {

        dataTable5 = $('#TableHistoryPR').DataTable({
            // "order": [[ 0, "asc" ],[6, "desc" ]],
            "columnDefs": [
                {"targets": [-1], "searchable": false, "orderable": false},
                {"targets": [2], "visible": false, "searchable": false, "orderable": false},
                // {"targets": [1], "checkboxes": {"selectRow": true}},
                {"targets": [4], "searchable": false, "orderable": false},
            ],
            "select": {"style": "multi"},
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            //                // set the initial value
            "pageLength": 5,
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "<?php echo base_url("/tiket/tiket/ajax_GridHistoryPRTiket"); ?>", // json datasource
                type: "post", // method  , by default get

                error: function () {  // error handling
                    $(".TableHistoryPR-error").html("");
                    // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $('#TableHistoryPR tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                    $("#TableHistoryPR_processing").css("display", "none");

                }
            }
        });
    }

    function loadGridPilihPRpopUp() {

        dataTable1 = $('#table_grid_PilihTravel').DataTable({
            initComplete: function () {
                $("div.toolbar").append('<div class="col-md-8">\n\
            <div class="row">\n\
                <div class="col-md-1"></div>\n\
                </div>\n\
            </div>\n\
        </div>');
                // dd_Zone("A");
            }, "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            //                // set the initial value
            "pageLength": 5,
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "<?php echo base_url("/tiket/tiket/Pilih_tiketPopUp"); ?>", // json datasource
                type: "post", // method  , by default get
                data: function (z) {
                    z.sID_TIKET = iID_TIKET;
                    // z.sZone = iZone;
                },
                error: function () {  // error handling
                    $(".table_grid_PilihTravel-error").html("");
                    // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $('#table_grid_PilihTravel tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                    $("#table_grid_PilihTravel_processing").css("display", "none");
                }
            },
            "columnDefs": [
                {"targets": [-1], "orderable": false, "searchable": false},
            ],
            "scrollx": true,
        });

    }


    function loadGridPilihEtiket() {

        dataTable6 = $('#TabelEtiket').DataTable({
            // "order": [[ 0, "asc" ],[6, "desc" ]],
            "columnDefs": [
                {"targets": [-1], "searchable": false, "orderable": false},
                {"targets": [1], "visible": false, "searchable": false, "orderable": false},
                {"targets": [4], "searchable": false, "orderable": false},
            ],
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            //                // set the initial value
            "pageLength": 5,
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "<?php echo base_url("/tiket/tiket/ajax_Grid_Etiket"); ?>", // json datasource
                type: "post", // method  , by default get
                data: function (z) {
                    z.sSearch = iSearch;
                    z.sZone = iZone;
                },
                error: function () {  // error handling
                    $(".TabelEtiket-error").html("");
                    // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $('#TabelEtiket tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                    $("#TabelEtiket_processing").css("display", "none");

                }
            }
        });


    }


    function loadGridAddPRto_Inv() {

        dataTable3 = $('#table_AddPrto_Inv').DataTable({
            // "order": [[ 0, "asc" ],[6, "desc" ]],
            "columnDefs": [
                {"targets": [-1], "searchable": false, "orderable": false},
                {"targets": [1], "visible": false, "searchable": false, "orderable": false},
                {"targets": [4], "searchable": false, "orderable": false},
            ],
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            //                // set the initial value
            "pageLength": 5,
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "<?php echo base_url("/tiket/tiket/ajax_GridAddPRtoInv"); ?>", // json datasource
                type: "post", // method  , by default get
                data: function (z) {
                    z.sID_TIKET = iID_TIKET;
                    // z.sZone = iZone;
                },
                error: function () {  // error handling
                    $(".table_AddPrto_Inv-error").html("");
                    // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $('#table_AddPrto_Inv tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                    $("#table_AddPrto_Inv_processing").css("display", "none");

                }
            }
        });
    }

    function loadGridAddPopUpPR_inv() {

        dataTable2 = $('#table_grid_Popup_Invoice').DataTable({
            "bPaginate": false,
            "bFilter": false,
            "bInfo": false,
            // "order": [[ 0, "asc" ],[6, "desc" ]],  
            "columnDefs": [
                {"targets": [-1], "searchable": false, "orderable": false},
            ], "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            //                // set the initial value
            "pageLength": 5,
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "<?php echo base_url("/tiket/tiket/Pilih_tiketPopUpInvoice"); ?>", // json datasource
                type: "post", // method  , by default get
                data: function (z) {
                    z.sID_TIKET = iID_TIKET;
                    // z.sZone = iZone;
                },
                error: function () {  // error handling
                    $(".table_grid_Popup_Invoice-error").html("");
                    // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $('#table_grid_Popup_Invoice tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                    $("#table_grid_Popup_Invoice_processing").css("display", "none");
                }
            },
            "columnDefs": [
                {"targets": [-1], "orderable": false, "searchable": false},
                {"targets": [0], "checkboxes": {"selectRow": true}},
            ],
                    "select": {"style": "multi"},
        });
    }


    function loadGridInvoicePembayaran() {

        dataTable4 = $('#table_Invoice').DataTable({
            // dom: 'C<"clear">l<"toolbar">frtip',
            initComplete: function () {
                $("div.toolbar").append('<div class="col-md-8">\n\
            <div class="row">\n\
                <div class="col-md-1"></div>\n\
                </div>\n\
            </div>\n\
        </div>');
                // dd_Zone("A");
            }, "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            //                // set the initial value
            "pageLength": 5,
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "<?php echo base_url("/tiket/tiket/ajax_Grid_InvoicePembayaran"); ?>", // json datasource
                type: "post", // method  , by default get
                data: function (z) {
                    z.sID_TIKET = iID_TIKET;
                    // z.sZone = iZone;
                },
                error: function () {  // error handling
                    $(".table_Invoice-error").html("");
                    // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $('#table_Invoice tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                    $("#table_Invoice_processing").css("display", "none");
                }
            },
            "columnDefs": [
                {"targets": [-1], "orderable": false, "searchable": false},
                // {"targets": [0], "checkboxes": {"selectRow": true}},
            ],
            // "select": {"style": "multi"},
        });
    }

    function loadGridPaymentGoal() {

        dataTable4 = $('#Table_payment').DataTable({
            // dom: 'C<"clear">l<"toolbar">frtip',
            initComplete: function () {
                $("div.toolbar").append('<div class="col-md-8">\n\
            <div class="row">\n\
                <div class="col-md-1"></div>\n\
                </div>\n\
            </div>\n\
        </div>');
                // dd_Zone("A");
            }, "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            //                // set the initial value
            "pageLength": 5,
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "<?php echo base_url("/tiket/tiket/ajax_Grid_Payment"); ?>", // json datasource
                type: "post", // method  , by default get
                data: function (z) {
                    z.sID_TIKET = iID_TIKET;
                    // z.sZone = iZone;
                },
                error: function () {  // error handling
                    $(".Table_payment-error").html("");
                    // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $('#Table_payment tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                    $("#Table_payment_processing").css("display", "none");
                }
            },
            "columnDefs": [
                {"targets": [-1], "orderable": false, "searchable": false},
                // {"targets": [0], "checkboxes": {"selectRow": true}},
            ],
            // "select": {"style": "multi"},
        });
    }

    var icetak = document.getElementById("idCetak");
    function onc_tglkrm() {
        icetak.setAttribute('href', '<?php echo base_url("/tiket/tiket/downloadTiket"); ?>?sID_TIKET=' + iID_TIKET + '&sTgl_kirim=' + $("#tanggal_kirim").val() + '&sVendor=' + $("#VendorNameID").val());

    }
    ;
    function onc_vendor() {
        icetak.setAttribute('href', '<?php echo base_url("/tiket/tiket/downloadTiket"); ?>?sID_TIKET=' + iID_TIKET + '&sTgl_kirim=' + $("#tanggal_kirim").val() + '&sVendor=' + $("#VendorNameID").val());
    }
    ;

    function pilihtravel() {
        var selected = dataTable.column(1).checkboxes.selected();
        console.log(selected);
        iID_TIKET = iID_TIKET + selected.join(',');
        // loadGridPilihPRpopUp(iID_TIKET);
        console.log(iID_TIKET);
        $('#table_grid_PilihTravel').DataTable().ajax.reload();
        $('#btnCloseModalPilihTravel').trigger('click');
    }


    function pilihtermin(id) {

        iID_TIKET = id;
        // loadGridPilihPRpopUp(iID_TIKET);
        console.log(iID_TIKET);
        $('#btnCloseModalDataTOTALINVOICE').trigger('click');
        $('#table_grid_Popup_Invoice').DataTable().ajax.reload();

    }


    $('#id_formSetTermin').submit(function (event) {
        event.preventDefault();
        var iID_TIKET_DETAIL_='';
        var selected = dataTable2.column(0).checkboxes.selected();
        iID_TIKET_DETAIL_ = iID_TIKET_DETAIL_ + selected.join(',');
        var r = confirm('Apakah anda yakin dengan nominal yang anda Input ?');
        if (r == true) {
            $.ajax({
                url: "simpan_termin?ID_TIKET=" + iID_TIKET + "&sID_TIKET_DETAIL=" + iID_TIKET_DETAIL_, // json datasource
                type: 'POST',
                data: new FormData(this),
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (e) {
                    if (e.act) {
                        iPID = e.iPid;
                        UIToastr.init(e.tipePesan, e.pesan);
                    } else {
                        UIToastr.init(e.tipePesan, e.pesan);                        
                    }
                },
                complete: function (e) {
                    setTimeout(function () {
                        $('#btnCloseModalDataBarang3').trigger('click');
                        $('#table_Invoice').DataTable().ajax.reload();
                        $('#table_AddPrto_Inv').DataTable().ajax.reload();

                    }, 500);

                }
            });
        } else {
            return false;
        }
    });

    // ==========================================PAYMENT============================================

    function addRow(tableID) {
        var jml = parseFloat($('#jml').val());
        jml = jml + 1;
        $('#jml').val(jml);

        // loads();
        var table = document.getElementById(tableID);
        // loads();
        var rowCount = table.rows.length;
        var row = table.insertRow(rowCount);
        var cell1 = row.insertCell(0);
        var element1 = document.createElement("input");
        element1.type = "checkbox";
        element1.name = "chkbox[]";
        cell1.appendChild(element1);
        var cell2 = row.insertCell(1);
        cell2.innerHTML = rowCount;
        var cell3 = row.insertCell(2);
        cell3.innerHTML = "<input data-date-format='dd-mm-yyyy' autocomplete='OFF' type='text' class='form-control input-sm date-picker' id='idtglpay" + rowCount + "' name='tglpay" + rowCount + "'/>";
        // var cell4 = row.insertCell(3);
        // cell4.innerHTML = "<input data-date-format='dd-mm-yyyy' type='date' class ='form-control date-picker' id='idtglakt" + rowCount + "' name='tglakt" + rowCount +"'disabled/>";
        var cell5 = row.insertCell(3);
        cell5.innerHTML = "<input class ='form-control' autocomplete='OFF' type='text' id='idpay_" + rowCount + "' name='pay" + rowCount + "'/>";
        var cell6 = row.insertCell(4);
        cell6.innerHTML = "<input class ='form-control' type='text' id='nilpay_" + rowCount + "' name='nilpay" + rowCount + "' readonly/>";
        var cell7 = row.insertCell(5);
        cell7.innerHTML = "<input class ='btn blue' type='button' value='Pembayaran' id='id_btnSimpan" + rowCount + "' name='btnSimpan" + rowCount + "'disabled/>";
        ComponentsDateTimePickers.init();
    }

    function addRow2(tableID) {
        var jml = parseFloat($('#jml').val());
        jml = jml + 1;
        $('#jml').val(jml);



        // loads();
        var table = document.getElementById(tableID);
        // loads();
        var rowCount = table.rows.length;
        var row = table.insertRow(rowCount);

        var cell1 = row.insertCell(0);
        var element1 = document.createElement("input");
        element1.type = "checkbox";
        element1.name = "chkbox[]";
        cell1.appendChild(element1);

        var cell2 = row.insertCell(1);
        cell2.innerHTML = rowCount;

        var cell3 = row.insertCell(2);
        cell3.innerHTML = "<input data-date-format='dd-mm-yyyy' type='date' class ='form-control date-picker' id='idtglpay" + rowCount + "' name='tglpay_" + rowCount + "'/>";

        var cell4 = row.insertCell(3);
        cell4.innerHTML = "<input data-date-format='dd-mm-yyyy' type='date' class ='form-control date-picker' id='idtglakt" + rowCount + "' name='tglakt_" + rowCount + "'disabled/>";


        var cell5 = row.insertCell(4);
        cell5.innerHTML = "<input class ='form-control' type='text' id='idpay__" + rowCount + "' name='pay_" + rowCount + "'/>";

        var cell6 = row.insertCell(5);
        cell6.innerHTML = "<input class ='form-control' type='text' id='nilpay__" + rowCount + "' name='nilpay_" + rowCount + "' />";
        //  var cell7 = row.insertCell(6);
        // cell7.innerHTML = "<input class ='btn blue' type='button' value='Sudah Bayar' id='id_btnSimpan" + rowCount + "' name='btnSimpan" + rowCount +"'disabled/>";
        var cell7 = row.insertCell(6);
        cell7.innerHTML = "<label><input type='radio' name='status" + rowCount + "' value='0'> Belum Lunas</label><br><label> <input type='radio' name='status" + rowCount + "' value='1'> Sudah Lunas </label><br>";

    }

    function deleteRow(tableID) {
        try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;

            for (var i = 1; i < rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if (null != chkbox && true == chkbox.checked) {
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                    var jml = parseFloat($('#jml').val());
                    jml = jml - 1;
                    $('#jml').val(jml)
                }
            }
        } catch (e) {
            alert(e);
        }
    }

    function deleteRow2(tableID) {
        try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
            for (var i = 1; i < rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if (null != chkbox && true == chkbox.checked) {
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                    var jml = parseFloat($('#jml').val());
                    jml = jml - 1;
                    $('#jml').val(jml)
                }
            }
        } catch (e) {
            alert(e);
        }
    }

    function checkAll(ele) {
        var checkboxes = document.getElementsByTagName('input');
        if (ele.checked) {
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].type == 'checkbox') {
                    checkboxes[i].checked = true;
                }
            }
        } else {
            for (var i = 0; i < checkboxes.length; i++) {
                // console.log(i)
                if (checkboxes[i].type == 'checkbox') {
                    checkboxes[i].checked = false;
                }
            }
        }
    }

    function checkAll2(ele) {
        var checkboxes = document.getElementsByTagName('input');
        if (ele.checked) {
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].type == 'checkbox') {
                    checkboxes[i].checked = true;
                }
            }
        } else {
            for (var i = 0; i < checkboxes.length; i++) {
                // console.log(i)
                if (checkboxes[i].type == 'checkbox') {
                    checkboxes[i].checked = false;
                }
            }
        }
    }

    $('#dataTableinv').on('focusout', 'tr td input', function () {
        // alert();
        var y = document.getElementById("dataTableinv").rows.length;
        idxTmp = this.id;
        idxArr = idxTmp.split('_');
        namaidx = idxArr[0];
        idx = idxArr[1];
        tot = 0;
        for (i = 1; i <= (y + 1); i++) {
            value = $('#idpay_' + i).val();
            if (value != '' && typeof (value) != 'undefined') {
                tot += parseFloat(CleanNumber($('#idpay_' + i).val()));
                nilpay = parseFloat(CleanNumber($('#payment').val())) * parseFloat(CleanNumber($('#idpay_' + i).val())) / 100;
                nipay2 = number_format(nilpay, 2);
                $('#nilpay_' + i).val(nipay2);
            }
        }
        if (tot > 100) {
            alert('Jumlah Bobot Tidak Boleh Lebih besar dari 100%');
            $('#idpay_' + idx).val(0);
            $('#nilpay_' + idx).val(0);
        }
    });

       function tampildetailhistory(input) {
        // alert('erv');
        $('#ModalHistoryPR').trigger("click");
        // $('#table_gridUSER').on('click', '#btnUpdate2');
        $.post("tampil_data_History",
                {
                    'ID_TIKET': input //id yang dilempar
                },
                function (data) {
                    console.log(data);
                    if (data.data_history.length > 0) {
                        // $group = '1';
                        for (i = 0; i < data.data_history.length; i++) {
                            $('#ID_PR').val(data.data_history[i].ID_TIKET);
                            $('#POP_AN').val(data.data_history[i].AN_TIKET);
                            $('#id_data').val(input);
                            $("#id_btnSimpan420").attr("disabled", false);
                            // id_groupUser_edit
                        }
                    }
                }, "JSON");
    }

    function editData(input) {
        // alert('erv');
        $('#myModalUploadEtiket').trigger("click");
        // $('#table_gridUSER').on('click', '#btnUpdate2');
        $.post("tampil_data",
                {
                    'ID_TIKET': input //id yang dilempar
                },
                function (data) {
                    console.log(data);
                    if (data.data_res.length > 0) {
                        // $group = '1';
                        for (i = 0; i < data.data_res.length; i++) {
                            $('#ID_TIKET_E').val(data.data_res[i].ID_TIKET);
                            $('#id_data').val(input);
                            $("#id_btnSimpan420").attr("disabled", false);
                            // id_groupUser_edit
                        }
                    }
                }, "JSON");
    }

    function editDataSPD(input) {
        // alert('eky');
        $('#myModaluploadSPD').trigger("click");
        // $('#table_gridUSER').on('click', '#btnUpdate2');
        $.post("tampil_data_spd",
                {
                    'ID_TIKET': input //id yang dilempar
                },
                function (data) {
                    console.log(data);
                    if (data.data_res.length > 0) {
                        // $group = '1';
                        for (i = 0; i < data.data_res.length; i++) {
                            $('#ID_TIKET_SPD').val(data.data_res[i].ID_TIKET);
                            $('#id_data').val(input);
                            $("#buttonnyahidup").attr("disabled", false);
                            // id_groupUser_edit
                        }
                    }
                }, "JSON");
    }


         function uploadEtiket() {
        var file_data = $('#Image_Etiket').prop('files')[0];
        var form_data = new FormData();
        form_data.append('ID_TIKET', $("#ID_TIKET_E").val());
        // form_data.append('tgl_ass', $("#txt_tgl_Ass").val());
        form_data.append('fileUpload', file_data);
        $.ajax({
            url: "<?php echo base_url("/tiket/tiket/ubah_etiket"); ?>", // json datasource
            dataType: "JSON", // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (e) {
                if (e.istatus == true) {
                    alert(e.iremarks);
                    $("#idAss").empty();
                    $("#idAss").append('<a href="#" ><i class="jstree-icon jstree-themeicon glyphicon glyphicon-ok icon-state-success jstree-themeicon-custom"></i></a>');
                    $('#btnCloseModalEtiket').trigger('click');
                    $('#Image_Etiket').val('');
                    $('#TabelEtiket').DataTable().ajax.reload();
                }
            }
        });
    }


    function uploadUpdateSPD() {
        var file_data = $('#Image_update').prop('files')[0];
        var form_data = new FormData();
        form_data.append('ID_TIKET', $("#ID_TIKET_SPD").val());
        // form_data.append('tgl_ass', $("#txt_tgl_Ass").val());
        form_data.append('fileUpload', file_data);
        $.ajax({
            url: "<?php echo base_url("/tiket/tiket/ubah_SPD"); ?>", // json datasource
            dataType: "JSON", // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (e) {
                $('#btnCloseModalDataBarang9').trigger('click');
                $('#TabelEtiket').DataTable().ajax.reload();
                if (e.istatus == true) {
                    alert(e.iremarks);
                    $("#idAss").empty();
                    $("#idAss").append('<a href="#" ><i class="jstree-icon jstree-themeicon glyphicon glyphicon-ok icon-state-success jstree-themeicon-custom"></i></a>');
                    $('#TabelEtiket').DataTable().ajax.reload();
                    $('#btnCloseModalUploadSPD').trigger('click');

                }

            }
        });

    }


    $('#id_forminv').submit(function (event) {
        var r = confirm('Do you want to save this file ?');
        if (r == true) {
            $.ajax({
                url: "simpan_invoice", // json datasource
                type: 'POST',
                data: new FormData(this),
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (e) {
                    if (e.act) {
                        UIToastr.init(e.tipePesan, e.pesan);
                        iPID = e.iPid;
                        $('#btnCloseModalDataTOTALINVOICE').trigger('click');
                        $('#Table_payment').DataTable().ajax.reload();
                        $("#id_btnBatal22").trigger('click');
                    } else {
                        UIToastr.init(e.tipePesan, e.pesan);
                    }
                },
                complete: function (e) {
                    $('#idGridAnggotaKel').DataTable().ajax.reload();
                    $('#table_Invoice').DataTable().ajax.reload();
                    
                }
            });
            event.preventDefault();
        } else {//if(r)
            return false;
        }

    });



    function editpayment(input, NILAI, ID_TERMIN_DETAIL) {
        // alert('ek');
        $.ajax({
            url: "<?php echo base_url("/tiket/tiket/tampil_payment"); ?>", // json datasource
            dataType: "HTML", // what to expect back from the PHP script, if anything
            cache: false,
            type: 'post',
            data: {ID_TIKET: input, sNILAI: NILAI, sID_TERMIN_DETAIL: ID_TERMIN_DETAIL},
            success: function (e) {
                console.log(e);

                // $("$idforminvoice").empty();
                $("#idforminvoice").html(e);
                $("#add_doc").click(function () {
                    num++;
                    console.log(num);
                    $('.dokumen').append('<div class="form-group m-form__group col-md-4"><label for="exampleInputtext1">Nama Dokumen</label><select class="form-control m-input dok" id="dok' + num + '" name="nama_dokumen[]" required><option value="">Pilih Dokumen</option></select></div><div class="form-group m-form__group col-md-4"><label for="exampleInputtext1">No Dokumen</label><input type="text" class="form-control m-input"  name="no_dokumen[]" required></div><div class="form-group m-form__group col-md-4"><label for="exampleInputtext1">Tanggal</label><input type="date" class="form-control m-input datepicker" name="tanggal[]" required></div>');

                    $('#dok' + num + '').html(doc_data);
                    // $('#ID_TIKET2').val(data.data_res[i].ID_TIKET);
                });
            }

        });

    }


</script>

