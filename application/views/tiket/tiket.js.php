<script>
    // var dataTable, dataTable1, dataTable2, dataTable3;
    // var iStatus = '%';
    // var iSearch = 'ItemName';
    // var iZone = 1;
    // var iID_PR = '';
    // var iSES = '';

    jQuery(document).ready(function () {
        ComponentsDateTimePickers.init();
        loadGridDPR_Tiket();
        $( "#datepicker" ).datepicker();
    });

   

    btnStart();

    function search(e) {
        iSearch = e;
    }

    $('#id_formRoom').submit(function (event) {
        alert('ASD');
        event.preventDefault();

        $.ajax({
            url: "simpan", // json datasource
            type: 'POST',
            data: new FormData(this),
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (e) {
                    // $("#nama_barang2").val($("#nama_barang").val());

                // alert('asd');
                if(e.act){
                    UIToastr.init(e.tipePesan, e.pesan);
                    iPID=e.iPid;
                    $("#id_btnBatal").trigger('click');
                }else{
                    UIToastr.init(e.tipePesan, e.pesan);
                }
            },
            complete:function(e){
                $('#idGridAnggotaKel').DataTable().ajax.reload();
            }
        });       
    });


        function getNum(elem) {

    }

        window.onload = function () {
                $('#id_bank2').hide();
                $('#id_bank3').hide();
                
            };

      function hidden() {
                 document.getElementById('id_bank2').style.display = "none";
                 document.getElementById('id_bank3').style.display = "none";
               
            }

            var ibank=0;
            function addbank() {

                // alert('addbank');
                if(ibank==0){
                    $('#id_bank2').show();
                }else if(ibank==1){
                    $('#id_bank3').show();
                }
                ibank=ibank+1;

                //     if (elem == '0') { 
                //     $('#id_bank2').hide();
                //     $('#id_bank3').hide();
               
                // }else if(elem == '1'){
                //     $('#id_bank2').show();
                //     $('#id_bank3').show();
                   
                // } else{
                //     $('#id_bank2').hide();
                //     $('#id_bank2').hide();
                //     $('#id_bank3').hide();
                // }

}

       $("#id_btnSimpan").click(function () {
        $('#idTmpAksiBtn').val('1');

    });

    $('#id_btnUbah').click(function () {
        $('#idTmpAksiBtn').val('2');
    });
    $('#id_btnHapus').click(function () {
        $('#idTmpAksiBtn').val('3');
    });


</script>