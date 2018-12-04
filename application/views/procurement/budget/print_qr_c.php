<!DOCTYPE html>
<html>
    <body>

        <?php
        $count_qr = count($qr_code);
        for ($i = 0; $i < $count_qr; $i++) {
            ?>
            <div id="qr_code_header">
                <div id="qr_code<?php echo $i ?>"></div>
                <div id="qr_desc<?php echo $i ?>"><?php echo $qr_code[$i]->QRCODE ?></div>
            </div>
        <?php } ?>    
        <input type="hidden" id="idcount_qr" value="<?php echo $count_qr ?>"/>

        
        
        
        
        <script src="<?php echo base_url('metronic/global/plugins/jquery.min.js'); ?>" type="text/javascript"></script>
        <!--QR Code-->
        <script src="<?php echo base_url('metronic/qr_code/qrcode.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('metronic/qr_code/qrcode.min.js'); ?>" type="text/javascript"></script>
        
        
        
        
        <script>
            $(document).ready(function () {
                console.log('ss');
                for (i = 0; i < $("#idcount_qr").val(); i++) {
                    $("#qr_code" + i).empty();
                    var qrcode = new QRCode("qr_code" + i);
                    qrcode.makeCode($("#qr_desc" + i).val());
                }
                window.print();
            });
        </script>   

    </body>
</html>