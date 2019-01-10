<div class="row">
    <table class="table table-striped table-bordered table-hover text_kanan" id="idTabeladjustman">
        <thead>
            <tr>
                <th>
                    ASSET NUMBERS
                </th>
                <th>
                    ASSET DESCRIPTION
                </th>
                <th>
                    CATEGORY
                </th>

            </tr>
        </thead>
        <tbody id="id_row_adjustman">

            <?php if(count($reclass>0)){foreach ($reclass as $data) { ?>
                <tr>
                    <td><?php echo $data['ASSET_NUMBER']; ?></td>
                    <td><?php echo $data['ASSET_DESCRIPTION']; ?></td>
                    <td><?php echo $data['CATEGORY']; ?></td>
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
    <!--<input type="text" name="idnya_rcls" class="hidden" value="<?php echo $data['ASSET_NUMBER']; ?>">-->

    <!-- <div class="col-md-6">
        <div class="form-group">
            <label class="control-label col-sm-4">ASSET KATEGORI - UMUR FISKAL</label>
            <div class="col-sm-8">
                <select name="assetListKategory" id="id_assetListKategory" class="form-control" onchange="pilihItemType(this.value)">
                    <option value="-">Pilih</option> 
                    <?php foreach ($itemClass as $value) { ?>
                    <option value="<?php echo trim($value->ClassCode).'#'.trim($value->umurfiskal).'#'.$value->IClassID ?>"><?php echo "(".trim($value->ClassCode).")".$value->IClassName.'-'.$value->umurfiskal ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div> -->

       <div class="col-md-6">
        <div class="form-group">
            <label class="control-label col-sm-4">ASSET KATEGORI - UMUR FISKAL</label>
            <div class="col-sm-8">
                <select name="assetListKategory" id="id_assetListKategory" class="form-control" onchange="pilihItemType(this.value)">
                    <option value="-">Pilih</option> 
                    <?php foreach ($itemClass as $value) { ?>
                    <option value="<?php echo trim($value->ClassCode).'#'.trim($value->umurfiskal).'#'.$value->IClassID ?>"><?php echo "(".trim($value->ClassCode).")".$value->IClassName?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label col-sm-4">JENIS BARANG</label>
            <div class="col-sm-8">
                
                <select name="jnsbrg" id="id_jnsbrg" class="form-control input-sm select2me">
                    <option></option>
                </select>
               
            </div>
        </div>
    </div>

</div>
<!--<script type="text/javascript" src="<?php echo base_url('metronic/global/plugins/select2/js/select2.full.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('metronic/global/scripts/app.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('metronic/global/plugins/select2/js/select2.min.js'); ?>"></script>-->

<script>
    
    $(document).ready(function () {
            $("#id_jnsbrg").select2({
                placeholder: "Please Select",
                width : "100%",
            });
//            $('#id_jnsbrg').select2('val','');

        }
    )
   function pilihItemType(valueId) {
       
       var res = valueId.split("#");
       var idnya = res[2];
       $.ajax({
            type: "POST",
            cache: false,
            dataType: "JSON",
            url: "<?php echo base_url("assetmanagement/assetlist/cariBrg"); ?>", // json datasource
            data: {idnya: idnya},
            success: function (e) {
                $('#id_jnsbrg').select2('val','');
                var select= $('#id_jnsbrg');
                select.empty().append(e);
//                 select.append(e);
                 
            }
            
        });
   }
</script>