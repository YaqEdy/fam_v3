<div class="tab">
    <div class="form-group m-form__group m--margin-top-10">
        <h5 class="m-portlet__head-text"><strong>Detail PR</strong></h5>
    </div>
    <div class="form-horizontal col-md-12">
        <div class="form-group col-md-6">
            <label class="col-sm-6 control-label" style="text-align: left;">No PR</label>
            <div class="col-sm-6">
                <p class="form-control-static"><?php echo $po->RequestID; ?></p>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="col-sm-6 control-label" style="text-align: left;">Tanggal PR</label>
            <div class="col-sm-6">
                <p class="form-control-static"><?php echo $po->DATE; ?></p>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="col-sm-6 control-label" style="text-align: left;">Request Type</label>
            <div class="col-sm-6">
                <p class="form-control-static"><?php echo $po->ReqTypeName; ?></p>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="col-sm-6 control-label" style="text-align: left;">Branch</label>
            <div class="col-sm-6">
                <p class="form-control-static"><?php echo $po->BRANCH_DESC; ?></p>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="col-sm-6 control-label" style="text-align: left;">Category Name</label>
            <div class="col-sm-6">
                <p class="form-control-static"><?php echo $po->ReqCategoryName; ?></p>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="col-sm-6 control-label" style="text-align: left;">Divisi</label>
            <div class="col-sm-6">
                <p class="form-control-static"><?php echo $po->DIV_DESC; ?></p>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="col-sm-6 control-label" style="text-align: left;">Nama Project</label>
            <div class="col-sm-6">
                <p class="form-control-static"><?php echo $po->PROJECT_NAME; ?></p>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="col-sm-6 control-label" style="text-align: left;">Periode</label>
            <div class="col-sm-6">
                <p class="form-control-static">1</p>
            </div>
        </div>

    </div>
    <div class="m-portlet__body">
        <div class="form-group m-form__group col-md-4">
            <label for="example-text-input" class="col-2 col-form-label">Total HPS</label>
            <div class="col-2">
                <input class="form-control m-input" type="text" value="<?php echo $thps; ?>" id="example-text-input" readonly>
            </div>
        </div>
        <div class="form-group m-form__group col-md-4">
            <label for="example-text-input" class="col-2 col-form-label">Total Item</label>
            <div class="col-2">
                <input class="form-control m-input" type="text" value="<?php echo $titem; ?>" id="example-text-input" readonly>
            </div>
        </div>
        <div class="form-group m-form__group col-md-4">
            <label for="example-text-input" class="col-2 col-form-label">Total QTY</label>
            <div class="col-2">
                <input class="form-control m-input" type="text" value="<?php echo $tqty; ?>" id="example-text-input" readonly>
            </div>
        </div>
    </div>
    <div class="m-portlet__body col-md-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Item Name</th>
                    <th scope="col">Item Type</th>
                    <th scope="col">QTY</th>
                    <th scope="col">Total HPS</th>
                    <th scope="col">HPS/Item</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($item as $bar) { ?>
                    <tr>
                        <td><?php echo $bar->ItemName ?></td>
                        <td><?php echo $bar->ItemTypeName ?></td>
                        <td><?php echo $bar->Qty ?></td>
                        <td><?php echo $bar->total ?></td>
                        <td><?php echo $bar->HargaHPS ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="m-portlet__body">
        <div class="form-group m-form__group col-md-12">
            <label class="col-sm-2 col-form-label">Prioritas</label>
            <div class="m-radio-inline col-sm-6">
                <button disabled="" type="button" class="btn btn-success" id="m_blockui_2_1">Lihat</button>
                <button disabled="" type="button" class="btn btn-brand" id="m_blockui_2_1">Download</button>
                <button disabled="" type="button" class="btn btn-primary" id="m_blockui_2_1">Upload</button>
            </div>
        </div>
        <div class="form-group m-form__group col-md-12">
            <label class="col-sm-2 col-form-label">Prioritas</label>
            <div class="m-radio-inline col-sm-6">
                <label class="m-radio">
                    <input type="radio" name="example_3" value="1" disabled> Prioritas
                    <span></span>
                </label>
            </div>
        </div>
        <div class="form-group m-form__group col-md-12">
            <label class="col-sm-2 col-form-label">Kelengkapan</label>
            <div class="m-radio-inline col-sm-6">
                <label class="m-radio">
                    <input type="radio" name="example_3" value="1" disabled> Lengkap
                    <span></span>
                </label>
                <label class="m-radio">
                    <input type="radio" name="example_3" value="1" disabled> Tidak Lengkap
                    <span></span>
                </label>

            </div>
        </div>

        <div class="form-group m-form__group col-md-12">
            <label for="example-text-input" class="col-sm-2 col-form-label">Tipe Pembayaran</label>
            <div class="col-sm-6">
                <select class="form-control m-input" id="example-getting-started" disabled>
                    <option value="1">1</option>
                </select>
            </div>
        </div>
        <div class="form-group m-form__group col-md-12">
            <label for="example-text-input" class="col-sm-2 col-form-label">Jenis Pengadaan</label>
            <div class="col-sm-6">
                <select class="form-control m-input" id="exampleSelect1" disabled>
                    <option>1</option>
                </select>
            </div>
        </div>
        <div class="form-group col-md-12">
            <label for="exampleTextarea" class="col-sm-2 col-form-label">Catatan</label>
            <div class="col-sm-6">
                <textarea class="form-control" id="exampleTextarea" rows="3" disabled></textarea>
            </div>
        </div>
    </div>
    <div class="m-portlet__body">
        <div class="form-group m-form__group col-md-12">
            <label for="example-text-input" class="col-sm-2 col-form-label">Tipe Pembayaran</label>
            <div class="col-sm-6">
                <select class="form-control m-input" id="exampleSelect1" disabled>
                    <option>1</option>
                </select>
            </div>
        </div>
        <div class="form-group m-form__group col-md-12">
            <label for="example-text-input" class="col-sm-2 col-form-label">PIC</label>
            <div class="col-sm-6">
                <select class="form-control m-input" id="exampleSelect1" disabled>
                    <option>1</option>
                </select>
            </div>
        </div>
    </div>
    <div class="m-portlet__body col-md-12">
        <div class="form-group m-form__group col-md-6">
            <label for="example-text-input" class="col-sm-4 col-form-label">Jenis Pengadaan</label>
            <div class="col-sm-8">
                <select class="form-control m-input" id="exampleSelect1" disabled>
                    <option>1</option>
                </select>
            </div>
        </div>
        <div class="form-group m-form__group col-md-6">
            <label for="example-text-input" class="col-sm-4 col-form-label">BOD</label>
            <div class="col-sm-8">
                <select class="form-control m-input" id="exampleSelect1" disabled>
                    <option>1</option>
                </select>
            </div>
        </div>
    </div>
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-settings font-red"></i>
            <span class="caption-subject font-red sbold uppercase">List Vendor</span>
        </div>
    </div>
    <div class="m-portlet__body col-md-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Nama Vendor</th>
                    <th scope="col">Wilayah</th>
                    <th scope="col">Status WP</th>
                    <th scope="col">Barang & Jasa</th>
                    <th scope="col">Harga Penawaran</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listvendor as $vl) { ?>
                    <tr>
                        <td><?php echo $vl->VendorName; ?></td>
                        <td><?php echo $vl->City; ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-settings font-red"></i>
            <span class="caption-subject font-red sbold uppercase">Vendor Pemenang</span>
        </div>
    </div>
    <div class="m-portlet__body col-md-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Nama Vendor</th>
                    <th scope="col">Wilayah</th>
                    <th scope="col">Status WP</th>
                    <th scope="col">Barang & Jasa</th>
                    <th scope="col">Harga Penawaran</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listvendors as $vl) { ?>
                    <tr>
                        <td><?php echo $vl->VendorName; ?></td>
                        <td><?php echo $vl->City; ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>
</div>
<div class="tab">
    <div class="form-group m-form__group m--margin-top-10">
        <h5 class="m-portlet__head-text"><strong>PA</strong></h5>
    </div>
    <div class="m-portlet__body">
        <div class="form-group m-form__group col-md-12">
            <label for="example-text-input" class="col-sm-2 col-form-label">No PA</label>
            <div class="col-sm-4">
                <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="123455" disabled>
            </div>
        </div>
        <div class="form-group m-form__group col-md-12">
            <label for="example-text-input" class="col-sm-2 col-form-label">PA Approval</label>
            <div class="col-sm-4">
                <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="YGT" disabled>
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="YTH" disabled>
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="YPP" disabled>
            </div>
        </div>
        <div class="form-group m-form__group col-md-12">
            <label for="example-text-input" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-4">
                <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Approval" disabled>
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Approval" disabled>
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Textbox" disabled>
            </div>
        </div>
    </div>
    <div class="form-group m-form__group m--margin-top-10">
        <h5 class="m-portlet__head-text"><strong>Cek Anggaran</strong></h5>
    </div>
    <div class="m-portlet__body">
        <div class="form-group m-form__group col-md-6">
            <label for="example-text-input" class="col-sm-4 col-form-label">Sisa Anggaran</label>
            <div class="col-sm-8">
                <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Sisa Anggaran" disabled>
            </div>
        </div>
        <div class="form-group m-form__group col-md-6">
            <label for="example-text-input" class="col-sm-4 col-form-label">Anggaran Terpakai</label>
            <div class="col-sm-8">
                <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Anggaran Terpakai" disabled>
            </div>
        </div>
    </div>
    <div class="m-portlet__body">
        <div class="form-group m-form__group col-md-6">
            <label for="example-text-input" class="col-sm-4 col-form-label">Entity PNM</label>
            <div class="col-sm-8">
                <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" disabled>
            </div>
        </div>
        <div class="form-group m-form__group col-md-6">
            <label for="example-text-input" class="col-sm-4 col-form-label">LOB</label>
            <div class="col-sm-8">
                <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" disabled>
            </div>
        </div>
        <div class="form-group m-form__group col-md-6">
            <label for="example-text-input" class="col-sm-4 col-form-label">Main Account</label>
            <div class="col-sm-8">
                <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" disabled>
            </div>
        </div>
        <div class="form-group m-form__group col-md-6">
            <label for="example-text-input" class="col-sm-4 col-form-label">Divisi</label>
            <div class="col-sm-8">
                <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" disabled>
            </div>
        </div>
        <div class="form-group m-form__group col-md-6">
            <label for="example-text-input" class="col-sm-4 col-form-label">Sub Account</label>
            <div class="col-sm-8">
                <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" disabled>
            </div>
        </div>
        <div class="form-group m-form__group col-md-6">
            <label for="example-text-input" class="col-sm-4 col-form-label">Business Type</label>
            <div class="col-sm-8">
                <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" disabled>
            </div>
        </div>
    </div>
    <div class="m-portlet__body">
        <div class="form-group m-form__group col-md-12">
            <label for="example-text-input" class="col-sm-2 col-form-label">COA</label>
            <div class="col-sm-6">
                <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="COA" disabled>
            </div>
        </div>
        <div class="form-group m-form__group col-md-12">
            <label for="example-text-input" class="col-sm-2 col-form-label">Anggaran</label>
            <div class="col-sm-6">
                <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Anggaran Terpakai" disabled>
            </div>
        </div>
        <div class="form-group m-form__group col-md-12">
            <label for="example-text-input" class="col-sm-2 col-form-label">PA Approval</label>
            <div class="col-sm-6">
                <select class="form-control m-input" id="exampleSelect1" disabled>
                    <option>1</option>
                </select>
            </div>
        </div>
        <div class="form-group m-form__group col-md-12">
            <label for="example-text-input" class="col-sm-2 col-form-label">Budget Disetujui</label>
            <div class="col-sm-6">
                <textarea class="form-control" id="exampleTextarea" rows="3" disabled></textarea>
            </div>
        </div>
        <div class="form-group m-form__group col-md-12">
            <label for="example-text-input" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-6">
                <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Status" disabled>
            </div>
        </div>
    </div>
    <div class="form-group m-form__group m--margin-top-10">
        <h5 class="m-portlet__head-text"><strong>BMWP BOD</strong></h5>
    </div>
    <div class="m-portlet__body">
        <div class="form-group m-form__group col-md-12">
            <label for="example-text-input" class="col-sm-2 col-form-label">No PA</label>
            <div class="col-sm-4">
                <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="123455" disabled>
            </div>
        </div>
        <div class="form-group m-form__group col-md-12">
            <label for="example-text-input" class="col-sm-2 col-form-label">BOD Approval</label>
            <div class="col-sm-4">
                <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="YGT" disabled>
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="YTH" disabled>
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="YPP" disabled>
            </div>
        </div>
        <div class="form-group m-form__group col-md-12">
            <label for="example-text-input" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-4">
                <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Approval" disabled>
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Approval" disabled>
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Textbox" disabled>
            </div>
        </div>
    </div>
</div>
<!-- <div style="overflow:auto;"> -->
<!-- <div style="float:right;"> -->
<button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
<button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
<!-- </div> -->
<!-- </div> -->
<div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <!--<span class="step"> </span>-->
</div>