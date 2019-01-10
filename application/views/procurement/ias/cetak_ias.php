<!DOCTYPE html>

<style>
	table,td {
	  border-collapse: collapse;
	  border: 1px solid black;
	}
	table {
	  font-size: 12px;
	}
</style>

 <?php 	
 	foreach($tes as $row){ 	
 ?>

<table width="100%">
	<tr>
		<th align="left">
			<h4>&nbsp;PT PERMODALAN NASIONAL MADANI (PERSERO)</h4>  
		</th>
		<th align="left" colspan="3">
			<h4>NO : <?php  echo $row->NO_DOC; ?></h4>  
		</th>
	</tr>
	<tr>
		<th align="left" >
			<h4>&nbsp;INVOICE APPROVAL SHEET</h4>  
		</th>
		<th align="left" colspan="3">
			<h4>TGL: <?php  echo $row->TGL; ?> </h4>  
		</th>
	</tr>
	<tr>
		<td align="left" colspan="1">
			<h4>&nbsp;NAMA SUPPLIER/KONTRAKTOR (VENDOR)</h4>  
		</td>
		<td align="left" colspan="3">
			<h4>&nbsp;Central Sukses Mandiri, PT</h4>  
		</td>
	</tr>
	<tr>
		<td align="left" colspan="4">
			  
		</td>
	</tr>
	<tr>
		<td align="left" rowspan="2">
			<h4>&nbsp;KELENGKAPAN DOKUMEN PENDUKUNG :</h4>  
		</td>
		<td align="center" colspan="2">
			<h4>KESEDIAAN DOKUMEN</h4>  
		</td>
		<td rowspan="2" align="center">
			<h4>KETERANGAN</h4>  
		</td>
	</tr>
	<tr>
		<td align="center">
			<h4>NO</h4>  
		</td>
		<td align="center">
			<h4>TGL</h4>  
		</td>
	</tr>
	<tr>
		<td>&nbsp;1. KWITANSI (RECEIPT)</td>
		<td>
			<?php 
				if($row->ID_DOC == '1'){
					echo $row->NO_DOC;
				}else{

				}

			?>	
		</td>
		<td>
			<?php 
				if($row->ID_DOC == '1'){
					echo $row->TGL;
				}else{

				}

			?>
		</td>
		<td align="center">
			<?php 
				if($row->ID_DOC == '1'){
					echo '<input type="checkbox" name="tes" checked required/> ADA <input type="checkbox" name="tes" required/> TIDAK';
				}else{
					echo '<input type="checkbox" name="tes" required/> ADA <input type="checkbox" name="tes" checked required/> TIDAK';
				}

			?>
		</td>
	</tr>
	<tr>
		<td>&nbsp;2. FAKTUR / SURAT PENAGIHAN (INVOICE)</td>
		<td>
			<?php 
				if($row->ID_DOC == '2'){
					echo $row->NO_DOC;
				}else{

				}

			?>	
		</td>
		<td>
			<?php 
				if($row->ID_DOC == '2'){
					echo $row->TGL;
				}else{

				}

			?>
		</td>
		<td align="center">
			<?php 
				if($row->ID_DOC == '2'){
					echo '<input type="checkbox" name="tes" checked required/> ADA <input type="checkbox" name="tes" required/> TIDAK';
				}else{
					echo '<input type="checkbox" name="tes" required/> ADA <input type="checkbox" name="tes" checked required/> TIDAK';
				}

			?>
			
		</td>
	</tr>
	<tr>
		<td>&nbsp;3. FAKTUR PAJAK (KHUSUS VENDOR PKP)</td>
		<td>
			<?php 
				if($row->ID_DOC == '3'){
					echo $row->NO_DOC;
				}else{

				}

			?>	
		</td>
		<td>
			<?php 
				if($row->ID_DOC == '3'){
					echo $row->TGL;
				}else{

				}

			?>
		</td>
		<td align="center">
			<?php 
				if($row->ID_DOC == '3'){
					echo '<input type="checkbox" name="tes" checked required/> ADA <input type="checkbox" name="tes" required/> TIDAK';
				}else{
					echo '<input type="checkbox" name="tes" required/> ADA <input type="checkbox" name="tes" checked required/> TIDAK';
				}

			?>
			
		</td>
	</tr>
	<tr>
		<td>&nbsp;4. BERITA ACARA (PROGRES REPORT) / SURAT JALAN (DELIVERY ORDER)</td>
		<td></td>
		<td></td>
		<td align="center"><input type="checkbox" name="tes"> ADA <input type="checkbox" name="tes"> TIDAK</td>
	</tr>
	<tr>
		<td>&nbsp;5. PURCHASE APPROVAL/PR*</td>
		<td>
			<?php 
				if($row->ID_DOC == '5'){
					echo $row->NO_DOC;
				}else{

				}

			?>	
		</td>
		<td>
			<?php 
				if($row->ID_DOC == '5'){
					echo $row->TGL;
				}else{

				}

			?>
		</td>
		<td align="center">
			<?php 
				if($row->ID_DOC == '5'){
					echo '<input type="checkbox" name="tes" checked required/> ADA <input type="checkbox" name="tes" required/> TIDAK';
				}else{
					echo '<input type="checkbox" name="tes" required/> ADA <input type="checkbox" name="tes" checked required/> TIDAK';
				}

			?>
			
		</td>
	</tr>
	<tr>
		<td>&nbsp;6. PURCHASE APPROVAL/PA*</td>
		<td>
			<?php 
				if($row->ID_DOC == '6'){
					echo $row->NO_DOC;
				}else{

				}

			?>	
		</td>
		<td>
			<?php 
				if($row->ID_DOC == '6'){
					echo $row->TGL;
				}else{

				}

			?>
		</td>
		<td align="center">
			<?php 
				if($row->ID_DOC == '6'){
					echo '<input type="checkbox" name="tes" checked required/> ADA <input type="checkbox" name="tes" required/> TIDAK';
				}else{
					echo '<input type="checkbox" name="tes" required/> ADA <input type="checkbox" name="tes" checked required/> TIDAK';
				}

			?>
		</td>
	</tr>
	<tr>
		<td>&nbsp;7. PURCHASE ORDER / PO ATAU PO KHUSUS ATK, ATAU TIKET PO PERJANJIAN/KONTRAK ATAU SURAT PERINTAH KERJA (SPK)*</td>
		<td>
			<?php 
				if($row->ID_DOC == '9'){
					echo $row->NO_DOC;
				}else{

				}

			?>	
		</td>
		<td>
			<?php 
				if($row->ID_DOC == '9'){
					echo $row->TGL;
				}else{

				}

			?>
		</td>
		<td align="center">
			<?php 
				if($row->ID_DOC == '9'){
					echo '<input type="checkbox" name="tes" checked required/> ADA <input type="checkbox" name="tes" required/> TIDAK';
				}else{
					echo '<input type="checkbox" name="tes" required/> ADA <input type="checkbox" name="tes" checked required/> TIDAK';
				}

			?>
		</td>
	</tr>
	<tr>
		<td>&nbsp;8. REPORT OF GODS RECEIPT (RGR)*</td>
		<td>
			<?php 
				if($row->ID_DOC == '7'){
					echo $row->NO_DOC;
				}else{

				}

			?>	
		</td>
		<td>
			<?php 
				if($row->ID_DOC == '7'){
					echo $row->TGL;
				}else{

				}

			?>
		</td>
		<td align="center">
			<?php 
				if($row->ID_DOC == '7'){
					echo '<input type="checkbox" name="tes" checked required/> ADA <input type="checkbox" name="tes" required/> TIDAK';
				}else{
					echo '<input type="checkbox" name="tes" required/> ADA <input type="checkbox" name="tes" checked required/> TIDAK';
				}

			?>
			
		</td>
	</tr>
	<tr>
		<td align="left" colspan="4">
			  
		</td>
	</tr>
	<tr>
		<td>&nbsp;*TIDAK BERLAKU UNTUK PEMBAYARAN REPAYMENT</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td align="left" colspan="4">
			  
		</td>
	</tr>
	<tr>
		<td>&nbsp;DASAR PENGGUNAAN PAJAK (DPP)</td>
		<td colspan="2">&nbsp;<b>Rp.</b> <?php echo $row->DPP; ?></td>
		<td>NO. REK. :<?php echo $row->NomorRekening; ?></td>
	</tr>
	<tr>
		<td>&nbsp;PPN 10%</td>
		<td colspan="2">&nbsp;<b>Rp.</b> <?php echo $row->PPN; ?></td>
		<td>A/N :<?php echo $row->NamaRekening; ?></td>
	</tr>
	<tr>
		<td>&nbsp;TOTAL TAGIHAN</td>
		<td colspan="2">&nbsp;<b>Rp.</b> <?php echo $row->DPP + $row->PPN; ?></td>
		<td>BANK :<?php echo $row->NamaBank; ?></td>
	</tr>
	<tr>
		<td align="left" colspan="4">
			<b>&nbsp;Pembayaran Untuk :</b>  <?php echo $row->QTY.' '.$row->ItemName.' <b>'.$row->DivisionID.'</b>'; ?>
		</td>
	</tr>
	<tr>
		<td align="center">
			Prepared by :
		</td>
		<td align="center">
			Approved by :
		</td>
		<td colspan="2" align="center">
			Verified by :
		</td>
	</tr>
	<tr>
		<td align="center"><br><br><br><br><br><br> <b>Procurment</b></td>
		<td align="center"><br><br><br><br><br><br> <b>DIVISI PPI</b></td>
		<td align="center"><br><br><br><br><br><br> <b>ANGGARAN</b></td>
		<td align="center"><br><br><br><br><br><br> <b>ACCOUNTUNG</b></td>
	</tr>

</table>
<?php
	}
?>
 
<script>
    window.print();
</script>