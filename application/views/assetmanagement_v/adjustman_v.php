<table class="table table-striped table-bordered table-hover text_kanan" id="idTabeladjustman">
    <thead>
        <tr>
            <th>
                ASSET NUMBERS
            </th>
            <th>
                ADJUSTED COST
            </th>
           <!--  <th>
               SALVAGE VALUE
            </th> -->
            <th>
                LIFE YEARS
            </th>

        </tr>
    </thead>
    <tbody id="id_row_adjustman">
        <?php if(count($adjustman>0)){foreach ($adjustman as $data) { ?>
            <tr>
                <td><?php echo $data['ASSET_NUMBER']; ?></td>
                <td><?php echo number_format($data['ADJUSTED_COST']); ?></td>
                <td><?php echo $data['LIFE_YEARS']; ?></td>
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
<!--<input type="text" name="idnya_adjst" class="hidden" value="<?php echo $data['ASSET_NUMBER']; ?>">-->
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label col-sm-4">ADJUSTED COST</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="id_adjust_cost" name="adjust_cost" autocomplete="off">
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label col-sm-4">SALVAGE VALUE</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="id_salvage_val" name="salvage_val" autocomplete="off">
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label col-sm-4">LIFE YEARS</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="id_life_years" name="life_years" autocomplete="off">
            </div>
        </div>
    </div>
</div>