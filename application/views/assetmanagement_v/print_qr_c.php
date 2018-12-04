<!DOCTYPE html>
<html>
    <body>

        <?php
        $count_qr = count($qr_code);
        for ($i = 0; $i < $count_qr; $i++) {
            ?>
            <table border="1">
                <tr align="center">
                    <td><img src="<?php echo base_url('metronic/img/logo.png'); ?>"/></td>
                    <!--<td rowspan="3" style="padding: 10px" id="qr_code<?php echo $i ?>"></td>-->
                    <td rowspan="3" style="padding: 10px"><div id="qr_code<?php echo $i ?>"></div></td>
                </tr>
                <tr align="center"><td>PNM</td></tr>
                <tr align="center"><td><div id="qr_desc<?php echo $i ?>"><?php echo $qr_code[$i]->QRCODE ?></div></td></tr>
            </table>
            <br>

        <?php } ?>    
        <input type="hidden" id="idcount_qr" value="<?php echo $count_qr ?>"/>





        <script src="<?php echo base_url('metronic/global/plugins/jquery.min.js'); ?>" type="text/javascript"></script>
        <!--QR Code-->
        <script src="<?php echo base_url('metronic/qr_code/qrcode.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('metronic/qr_code/qrcode.min.js'); ?>" type="text/javascript"></script>




        <script>
            $(document).ready(function () {
                for (i = 0; i < $("#idcount_qr").val(); i++) {
                    $("#qr_code" + i).empty();
                    var qrcode = new QRCode("qr_code" + i);
                    qrcode.makeCode($("#qr_desc" + i).text());
                }
                window.print();
            });
        </script>   

    </body>
</html>