<table class="table table-striped table-bordered table-hover text_kanan" id="idTabeladjustman">
    <thead>
        <tr>
            <th>
                PERIOD NAME
            </th>
            <th>
                TOTAL AMOUNT
            </th>
            <th>
                NET BOO VALUE
            </th>

        </tr>
    </thead>
    <tbody id="id_row_adjustman">
        
        

        <?php if(count($depresi>=1)){foreach ($depresi as $data) { ?>
            <tr>
                <td><?php echo $data['PERIOD_NAME']; ?></td>
                <td><?php echo number_format($data['TOTAL_AMOUNT'],2); ?></td>
                <td><?php echo number_format($data['NET_BOOK_VALUE'],2); ?></td>
            </tr>  
        <?php }}else{ ?>
            
            <tr>
                <td colspan="3">Data Tidak Ditemukan</td>
            </tr>
        <?php } ?>

    </tbody>
    <tfoot>

    </tfoot>
</table>

