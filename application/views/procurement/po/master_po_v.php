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
                  <form role="form"  method="post" id="id_from_sec_group_user"  action="<?php echo base_url('procurement/po/savedata'); ?>">
                <div class="tab">
                <div class="form-group m-form__group m--margin-top-10">
                    <h5 class="m-portlet__head-text"><strong>Detail PR</strong></h5>
                </div>
                <div class="form-horizontal col-md-12">
                    <div class="form-group col-md-6">
                        <label class="col-sm-6 control-label" style="text-align: left;">No PR</label>
                        <div class="col-sm-6">
                            <p class="form-control-static">1234</p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-sm-6 control-label" style="text-align: left;">Tanggal PR</label>
                        <div class="col-sm-6">
                            <p class="form-control-static">1234</p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-sm-6 control-label" style="text-align: left;">Request Type</label>
                        <div class="col-sm-6">
                            <p class="form-control-static">1234</p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-sm-6 control-label" style="text-align: left;">Branch</label>
                        <div class="col-sm-6">
                            <p class="form-control-static">1234</p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-sm-6 control-label" style="text-align: left;">Category Name</label>
                        <div class="col-sm-6">
                            <p class="form-control-static">1234</p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-sm-6 control-label" style="text-align: left;">Divisi</label>
                        <div class="col-sm-6">
                            <p class="form-control-static">1234</p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-sm-6 control-label" style="text-align: left;">Nama Project</label>
                        <div class="col-sm-6">
                            <p class="form-control-static">1234</p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-sm-6 control-label" style="text-align: left;">Periode</label>
                        <div class="col-sm-6">
                            <p class="form-control-static">1234</p>
                        </div>
                    </div>
                    
                </div>
                <div class="m-portlet__body">
                    <div class="form-group m-form__group col-md-4">
                        <label for="example-text-input" class="col-2 col-form-label">Total HPS</label>
                        <div class="col-2">
                            <input class="form-control m-input" type="text" value="2.000.000" id="example-text-input" readonly>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="example-text-input" class="col-2 col-form-label">Total Item</label>
                        <div class="col-2">
                            <input class="form-control m-input" type="text" value="3" id="example-text-input" readonly>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="example-text-input" class="col-2 col-form-label">Total Item</label>
                        <div class="col-2">
                            <input class="form-control m-input" type="text" value="30" id="example-text-input" readonly>
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
                            <tr>
                                <th scope="row" colspan="5">Example data</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="m-portlet__body">
                    <div class="form-group m-form__group col-md-12">
                        <label class="col-sm-2 col-form-label">Prioritas</label>
                        <div class="m-radio-inline col-sm-6">
                            <button type="button" class="btn btn-success" id="m_blockui_2_1">Lihat</button>
                            <button type="button" class="btn btn-brand" id="m_blockui_2_1">Download</button>
                            <button type="button" class="btn btn-primary" id="m_blockui_2_1">Upload</button>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label class="col-sm-2 col-form-label">Prioritas</label>
                        <div class="m-radio-inline col-sm-6">
                            <label class="m-radio">
                            <input type="radio" name="example_3" value="1"> Prioritas
                            <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label class="col-sm-2 col-form-label">Kelengkapan</label>
                        <div class="m-radio-inline col-sm-6">
                            <label class="m-radio">
                            <input type="radio" name="example_3" value="1"> Lengkap
                            <span></span>
                            </label>
                            <label class="m-radio">
                            <input type="radio" name="example_3" value="1"> Tidak Lengkap
                            <span></span>
                            </label>

                        </div>
                    </div>
                    
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Tipe Pembayaran</label>
                        <div class="col-sm-6">
                                <select class="form-control m-input" id="example-getting-started">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Jenis Pengadaan</label>
                        <div class="col-sm-6">
                            <select class="form-control m-input" id="exampleSelect1">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleTextarea" class="col-sm-2 col-form-label">Catatan</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Tipe Pembayaran</label>
                        <div class="col-sm-6">
                            <select class="form-control m-input" id="exampleSelect1">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">PIC</label>
                        <div class="col-sm-6">
                            <select class="form-control m-input" id="exampleSelect1">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body col-md-12">
                    <div class="form-group m-form__group col-md-6">
                        <label for="example-text-input" class="col-sm-4 col-form-label">Jenis Pengadaan</label>
                        <div class="col-sm-8">
                            <select class="form-control m-input" id="exampleSelect1">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-6">
                        <label for="example-text-input" class="col-sm-4 col-form-label">BOD</label>
                        <div class="col-sm-8">
                            <select class="form-control m-input" id="exampleSelect1">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
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
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row" colspan="6">Example data</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="m-portlet__body">
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Nama Pemenang</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Nama Pemenang">
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Harga Penawaran</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Harga Penawaran">
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Scoring</label>
                        <div class="col-sm-4">
                            <input type="file" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp">
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Dokumen Lain-lain</label>
                        <div class="col-sm-4">
                            <input type="file" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp">
                        </div>
                    </div>
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
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="123455">
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">PA Approval</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="YGT">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="YTH">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="YPP">
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Approval">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Approval">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Textbox">
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
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Sisa Anggaran">
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-6">
                        <label for="example-text-input" class="col-sm-4 col-form-label">Anggaran Terpakai</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Anggaran Terpakai">
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="form-group m-form__group col-md-6">
                        <label for="example-text-input" class="col-sm-4 col-form-label">Entity PNM</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp">
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-6">
                        <label for="example-text-input" class="col-sm-4 col-form-label">LOB</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp">
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-6">
                        <label for="example-text-input" class="col-sm-4 col-form-label">Main Account</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp">
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-6">
                        <label for="example-text-input" class="col-sm-4 col-form-label">Divisi</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp">
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-6">
                        <label for="example-text-input" class="col-sm-4 col-form-label">Sub Account</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp">
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-6">
                        <label for="example-text-input" class="col-sm-4 col-form-label">Business Type</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp">
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">COA</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="COA">
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Anggaran</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Anggaran Terpakai">
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">PA Approval</label>
                        <div class="col-sm-6">
                            <select class="form-control m-input" id="exampleSelect1">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Budget Disetujui</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Status">
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
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="123455">
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">BOD Approval</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="YGT">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="YTH">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="YPP">
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Approval">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Approval">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Textbox">
                        </div>
                    </div>
                </div>
                </div>
                <div class="tab">
                <div class="form-group m-form__group m--margin-top-10">
                    <h5 class="m-portlet__head-text"><strong>PO</strong></h5>
                </div>
                <div class="m-portlet__body col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Nama Dokumen</th>
                                <th scope="col">No Dokumen</th>
                                <th scope="col">Validasi</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row" colspan="4">Example data</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="m-portlet__body col-md-12">
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">Jumlah Barang</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Jumlah Barang">
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">Jenis Barang</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Jenis Barang">
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">Sub Total</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Sub Total">
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">PPN</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="PPN">
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">Disc</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Disc">
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">PPH</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="PPH">
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">Total</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Total">
                    </div>
                </div>
                <input type="hidden" name="id_pr" value="<?php echo $po->RequestID?>">
                <input type="hidden" id="hargatotal" value="<?php echo $hargatotal?>">
                <?php if(trim($po->ReqTypeID) == '3'){ ?>
                <div class="form-group m-form__group m--margin-top-10">
                        <h5 class="m-portlet__head-text"><strong>Sewa Barang dan Bangunan</strong></h5>
                </div>
                <div class="m-portlet__body col-md-12">
                <?php $i=1;
                foreach ($item as $list){?>
                    <input type="hidden" name="itemid[]" value="<?php echo $list->ItemID?>">
                    <div class="form-group m-form__group col-md-2">
                        <label for="exampleInputtext1">Barang/Bangunan</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" value="<?php echo $list->ItemName?>" name="barang[]" placeholder="Barang/Bangunan" readonly>
                    </div>
                    <div class="form-group m-form__group col-md-1">
                        <label for="exampleInputtext1">Qty</label>
                        <input type="number" min="0" class="form-control m-input" id="qty<?php echo $i?>" value="<?php echo $list->Qty?>" name="qty[]" placeholder="Qty">
                    </div>
                    <div class="form-group m-form__group col-md-2">
                        <label for="exampleInputtext1">Periode Sewa</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" name="sewa" placeholder="Periode Sewa" required>
                    </div>
                    <div class="form-group m-form__group col-md-2">
                        <label for="exampleInputtext1">Jenis Periode</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" name="jenis" placeholder="Jenis Periode" required>
                    </div>
                    <div class="form-group m-form__group col-md-1">
                        <label for="exampleInputtext1">Notifikasi</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" name="notif" placeholder="Notifikasi" required>
                    </div>
                    <div class="form-group m-form__group col-md-2">
                        <label for="exampleInputtext1">Harga Satuan</label>
                        <input type="number" min="0" class="form-control m-input" id="satuan<?php echo $i?>" value="<?php echo $list->HargaHPS?>" name="satuan[]" placeholder="Harga Satuan">
                    </div>
                    <div class="form-group m-form__group col-md-2">
                        <label for="exampleInputtext1">Harga</label>
                        <input type="text" class="form-control m-input total" id="total<?php echo $i?>" value="<?php echo $list->total?>" name="hargatotal[]" placeholder="Harga">
                    </div>
                <?php $i++;
            }?>
                </div>
            <?php }else{ ?>
                <div class="form-group m-form__group m--margin-top-10">
                        <h5 class="m-portlet__head-text"><strong>Detail Barang Dan Harga</strong></h5>
                </div>
                <div class="m-portlet__body col-md-12">
                <?php $i = 1;
                foreach ($item as $list){?>
                    <input type="hidden" name="itemid[]" value="<?php echo $list->ItemID?>">
                    <div class="form-group m-form__group col-md-3">
                        <label for="exampleInputtext1">Nama Barang</label>
                        <input type="text" class="form-control m-input" id="barang" name="barang[]" placeholder="Nama Barang" value="<?php echo $list->ItemName?>" readonly>
                    </div>
                    <div class="form-group m-form__group col-md-3">
                        <label for="exampleInputtext1">Qty</label>
                        <input type="number" min="0" class="form-control m-input" id="qty<?php echo $i?>" value="<?php echo $list->Qty?>" name="qty[]" placeholder="Qty">
                    </div>
                    <div class="form-group m-form__group col-md-3">
                        <label for="exampleInputtext1">Harga Satuan</label>
                        <input type="number" min="0" class="form-control m-input" id="satuan<?php echo $i?>" value="<?php echo $list->HargaHPS?>" name="satuan[]" placeholder="Harga Satuan">
                    </div>
                    <div class="form-group m-form__group col-md-3">
                        <label for="exampleInputtext1">Harga</label>
                        <input type="text" class="form-control m-input total" id="total<?php echo $i?>" value="<?php echo $list->total?>" name="hargatotal[]" placeholder="Harga">
                    </div>
                <?php $i++;
            }?>
                </div>
            <?php }?>
                <div class="form-group m-form__group m--margin-top-10 col-md-12">
                    <div class="col-md-4">
                        <h5 class="m-portlet__head-text"><strong>Termin</strong></h5>
                    </div>
                    <div class="col-md-3">
                        <label class="mt-checkbox">
                            <input type="checkbox" id="detail"> Detail Terima
                            <span></span>
                        </label>
                    </div>
                    <div class="form-group m-form__group col-md-3" id="notdetail">
                        <input type="text" class="form-control m-input datepicker" name="dterima" id="dterima" aria-describedby="textHelp" placeholder="dd/mm/yyyy" required>
                    </div>
                </div>
                <div class="termin">
                <div class="m-portlet__body col-md-12">
                    <div class="form-group m-form__group col-md-3">
                        <label for="exampleInputtext1">Persentase</label>
                        <input type="number" class="form-control m-input" name="persentase[]" id="presentase1" aria-describedby="textHelp" placeholder="Persentase" required>
                    </div>
                    <div class="form-group m-form__group col-md-3">
                        <label for="exampleInputtext1">Nilai</label>
                        <input type="text" class="form-control m-input" id="nilai1" name="nilai[]" aria-describedby="textHelp" placeholder="Nilai" readonly required>
                    </div>
                    <div class="form-group m-form__group col-md-3">
                        <label for="exampleInputtext1">Tanggal Jatuh Tempo</label>
                        <input type="text" class="form-control m-input datepicker" name="tempo[]" aria-describedby="textHelp" placeholder="Tanggal Jatuh Tempo" required>
                    </div>
                    <div class="form-group m-form__group col-md-3 terima" hidden>
                        <label for="exampleInputtext1">Tgl Akhir Penerimaan Barang</label>
                        <input type="text" class="form-control m-input datepicker" name="akhir[]" aria-describedby="textHelp" placeholder="Tgl Akhir Penerimaan Barang">
                    </div>
                </div>
                </div>
                <div class="m-portlet__body col-md-12 text-center">
                    <button name="btnSimpan" type="button" class="btn green" id="add_termin">Tambah Termin</button>
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
                    <span class="step"> </span>
                  </div>
                </form>

                </div>

            </div>
        </div>
        <!-- END VALIDATION STATES-->
    </div>
</div>


<!-- END PAGE CONTENT-->

<!-- Modal UPDATE-->



<?php $this->load->view('app.min.inc.php'); ?>

<script>
var $ = jQuery.noConflict();
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the crurrent tab

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
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
    $('#nextBtn').prop('type','submit');
    $("#nextBtn").removeAttr('onclick');
  } else {
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
  if (n == 1 && !validateForm()) return false;
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
$(document).on('click', '.datepicker', function(){
   $(this).datepicker({
        orientation: "left",
        format: "dd/mm/yyyy",
        autoclose: true
    }).focus();
   $(this).removeClass('datepicker');
});

var num = 1;
var n = 1;
    $("#add_termin").click(function(){
        num++;
        
        if($('#detail').is(":checked")){
            $('.termin').append('<div class="m-portlet__body col-md-12"><div class="form-group m-form__group m--margin-top-10 col-md-12"><div class="form-group m-form__group col-md-3"><label for="exampleInputtext1">Persentase</label><input type="number" class="form-control m-input" name="persentase[]" id="presentase'+num+'" aria-describedby="textHelp" placeholder="Persentase"></div><div class="form-group m-form__group col-md-3"><label for="exampleInputtext1">Nilai</label><input type="text" class="form-control m-input" id="nilai'+num+'" name="nilai[]" aria-describedby="textHelp" placeholder="Nilai" readonly></div><div class="form-group m-form__group col-md-3"><label for="exampleInputtext1">Tanggal Jatuh Tempo</label><input type="text" class="form-control m-input datepicker" id="exampleInputtext1" name="tempo[]" aria-describedby="textHelp" placeholder="Tanggal Jatuh Tempo"></div><div class="form-group m-form__group col-md-3 terima"><label for="exampleInputtext1">Tgl Akhir Penerimaan Barang</label><input type="text" class="form-control m-input datepicker" name="akhir[]" aria-describedby="textHelp" placeholder="Tgl Akhir Penerimaan Barang"></div></div></div>');
        }else{
            $('.termin').append('<div class="m-portlet__body col-md-12"><div class="form-group m-form__group col-md-3"><label for="exampleInputtext1">Persentase</label><input type="number" class="form-control m-input" name="persentase[]" id="presentase'+num+'" aria-describedby="textHelp" placeholder="Persentase"></div><div class="form-group m-form__group col-md-3"><label for="exampleInputtext1">Nilai</label><input type="text" class="form-control m-input" id="nilai'+num+'" name="nilai[]" aria-describedby="textHelp" placeholder="Nilai" readonly></div><div class="form-group m-form__group col-md-3"><label for="exampleInputtext1">Tanggal Jatuh Tempo</label><input type="text" class="form-control m-input datepicker" id="exampleInputtext1" name="tempo[]" aria-describedby="textHelp" placeholder="Tanggal Jatuh Tempo"></div><div class="form-group m-form__group col-md-3 terima" hidden><label for="exampleInputtext1">Tgl Akhir Penerimaan Barang</label><input type="text" class="form-control m-input datepicker" name="akhir[]" aria-describedby="textHelp" placeholder="Tgl Akhir Penerimaan Barang"></div></div>');
        }
        // n = $("input[name='persentase[]']").size();
        // $("#presentase"+num+"").on("keyup", function() {
        //         var total = $('#hargatotal').val();
        //         var percent = ($(this).val())/100;
        //            $('#nilai'+num+'').val(percent*total);
        //     });
        $("input[name='persentase[]']").on("keyup", function(){
            var total = $('#hargatotal').val();
            var percent = ($(this).val())/100;
            var id = $(this).attr('id');
            var lastid = id.substring(id.length-1, id.length);
            $('#nilai'+lastid+'').val(percent*total);
        });

    });

    <?php for ($j=1; $j < $i; $j++) { ?>
        $("#qty<?php echo $j;?>").on("keyup", function(){
            var sum = 0;
            var satuan = $("#satuan<?php echo $j;?>").val();
            var total = ($(this).val())*satuan;
            $("#total<?php echo $j;?>").val(total);
            $('.total').each(function(){
                sum += parseInt(this.value);
            });

            $('#hargatotal').val(sum);
        });
    <?php } ?>

    <?php for ($j=1; $j < $i; $j++) { ?>
        $("#satuan<?php echo $j;?>").on("keyup", function(){
            var sum = 0;
            var satuan = $("#qty<?php echo $j;?>").val();
            var total = ($(this).val())*satuan;
            $("#total<?php echo $j;?>").val(total);
            $('.total').each(function(){
                sum += parseInt(this.value);
            });

            $('#hargatotal').val(sum);
        });
    <?php } ?>

    

    $("#detail").change(function() {
        if(this.checked) {
            $('.terima').show();
            $('#notdetail').hide();
            $('#dterima').removeAttr('required');
        }else{
            $('.terima').hide();
            $('#notdetail').show();
            $('#dterima').attr('required');
        }
    });

    $("#presentase1").on("change paste keyup", function() {
        var total = $('#hargatotal').val();
        var percent = ($(this).val())/100;
        $('#nilai1').val(percent*total);
    });


</script>


<!-- END JAVASCRIPTS