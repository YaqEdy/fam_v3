                       
						<input type="hidden" id="ID_TIKET" value="<?php echo $ID_TIKET ?>" name="ID_TIKET" > 
					   <div class="row">
                                <div class="form-body">
                                                 <div class="form-group m-form__group m--margin-top-10">
                    <!-- <h5 class="m-portlet__head-text"><strong>Dokumen IAS</strong></h5> -->
                </div>
                <div class="m-portlet__body col-md-12 dokumen">
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">Nama Dokumen</label>
                        <!-- NAMA DOKUMEN NANTI DIBUAT DROPDOWN -->
                        <select class="form-control m-input" id="dok1" name="nama_dokumen[]" required>
                            <option value="">Pilih Dokumen</option>
                        </select>
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">No Dokumen</label>
                        <input type="text" class="form-control m-input"  name="no_dokumen[]" required>
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">Tanggal</label>
                        <input type="date" class="form-control m-input datepicker" name="tanggal[]" required>
                    </div>
                </div>
                <div class="m-portlet__body col-md-12 text-center">
                    <button name="btnDoc" type="button" class="btn green" id="add_doc">Tambah Dokumen</button>
                </div>
                 <div class="m-portlet__body col-md-12 text-center">
                                            <input type="text" name="ID_TIKET_DETAIL" id="ID_TIKET_DETAIL" style="display: none;" />
                                             <input type="text" name="ID_TERMIN_DETAIL" id="ID_TERMIN_DETAIL" value="<?php echo $ID_TERMIN_DETAIL ?>" style="display: none;" />
                                            <div class="form-group">
                                                <label>Please select a file to upload <b>Dokumen</b> :</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"> <i class="fa fa-file"></i>
                                                    </span> <input type="file" name="dok[]" class="form-control" 
                                                                   id="dok" multiple>
                                                </div>
                                            </div>
                                            <div class="panel panel-danger">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Note</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <ul>
                                                        <li>
                                                            Maximum upload size only <strong>5 MB</strong>.
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
             <!--    <div class="m-portlet__body col-md-12 text-center">
                    <div class="form-group m-form__group col-md-6">
                        <label for="exampleInputtext1">Dokumen</label>
                        <input type="file" class="form-control m-input" id="dok" name="dok">
                    </div>
                </div> -->
                                <div class="m-portlet__body col-md-8 text-center">
                                    <!-- <div class="form-group m-form__group col-md-12"> -->
                                <!-- <input class="form-control" type="text" id="ID_TERMIN" name="ID_TERMIN" style="display: none;"    /> -->
                                <!-- <input type="text" id="ID_TIKET2" name="ID_TIKET2" style="display: none;"/> -->
                                <!-- <input type="text" id="STATUS" name="STATUS" style="display: none;" /> -->
                                        <label>Jumlah Pembayaran </label> <span class="">*</span>
                                        <input required="required" class="form-control"
                                               type="text" id="NILAI" name="NILAI" readonly value="<?php echo $data_res ?>"  />
                                        <!-- </div> -->
                                    </div>
                                </div>
                            </div>  

<script>
     ComponentsDateTimePickers.init();
     var doc_data = "<?php echo $doc;?>"
    $('#dok1').html(doc_data);
</script>
