<!DOCTYPE html>
<?php
error_reporting(0);
?>
<style>

/*
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 5px;
  text-align: left;

} table {
      font-size: 15px;
    }
*/

    table,td {
      border-collapse: collapse;
      border: 1px solid black;
    }
    table {
      font-size: 15px;
    }
</style>

<!--     
             <tr>
      
                <h4><center>PURCHASE REQUEST</center></h4>
            <h5><center>PNM/DIT.KA/GA-01/PM/01-FORM01</center></h5>
      
               Nomor
            <h5><center>PNM/DIT.KA/GA-01/PM/01-FORM01</center></h5> -->
       
      
 <!--    <tr>
       <h4 style="margin-left:5px;" align="right">Nomor    : <span></span></h4>
       <h4 style="margin-left:5px;" align="right">Tanggal  : <span></span></h4>

   </tr>

   <tr>
       <h4 style="margin-left:5px;" align="right">Priority : <span></span></h4>
       <h4 style="margin-left:5px;" align="right">PIC      : <span></span></h4>

    </tr> -->
<table style=" width: 100%; border: 0px solid white;">
    <tr align="center">
        <th colspan="7"><h4>PT. PERMODALAN NASIONAL MADANI (PERSERO)</h4></th>
    </tr>
    <tr align="center">
        <th colspan="7"><h4>PURCHASE REQUEST</h4></th>
    </tr>
    <tr align="center">
        <th colspan="7"><h4>PNM/DIT.KA/GA-01/PM/01-FORM01</h4></th>
    </tr>
     <?php foreach ($qr_code as $a) {?>
    
    <?php }?>
    <tr>
        <th>Nomor</th>
        <th>:</th>
        <th><?php  echo $qr_code[0]->RequestID?></th>
        <th style="width:10%;"></th>
         <th>Priority</th>
        <th>:</th>
        <th></th> 
    </tr> 
  
    <tr>
        <th>Tanggal</th> 
        <th>:</th>
        <th><?php  echo date('d-m-Y',strtotime($qr_code[0]->CreateDate))?></th>
        <th style="width:10%;"></th>
         <th>PIC</th>
        <th>:</th>
        <th><?php echo $qr_code[0]->PIC_PO?> </th>
    </tr>
    <tr>
        <th>Metode</th>
        <th>:</th>
         <th><?php  echo $qr_code[0]->METODE?></th>
        <th style="width:10%;"></th>
    </tr>
    <!-- <tr>
        <th>Tanggal</th>
        <th>:</th>
        <th>XXXXX</th>
         <th ></th>
    </tr>
    <tr>
        <th></th>
        <th>Priority</th>
        <th>:</th>
        <th>XXXXX</th>
         <th ></th>
    </tr>
    <tr>
        <th></th>
        <th>PIC</th>
        <th>:</th>
        <th>XXXXX</th>
         <th ></th>
    </tr>
    <tr>
        <th></th>
        <th>Methode</th>
        <th>:</th>
        <th>XXXXX</th>
         <th ></th>
    </tr> -->
   <!--  <tr>
        <th colspan="2"><h4>PURCHASE REQUEST</h4></th>
        <th></th>
        <th></th>
        <th style="width:20%; "></th>
    </tr>
    <tr>
        <th colspan="2"><h4>PNM/DIT.KA/GA-01/PM/01-FORM01</h4></th>
         <th></th>
        <th></th>
        <th style="width:20%; "></th>
    </tr> -->
</table>
<br><br><br>
<table style=" width: 100%">
 
    <tr>
        <!-- <td><center>NO</center></td> -->
        <td><center>JENIS BARANG</center></td>
        <td><center>JUMLAH</center></td>
        <td><center>KETERANGAN</center></td>
        
    </tr>
  
  <tr>
    <!-- <td>&nbsp;</td> -->
    <td><center><?php  echo $a->ItemName?></center></td>
    <td><center><?php  echo $a->Qty?></center></td>
    <td><?php  echo $a->Keterangan?></td>
    
</tr>

<tr>
    <!-- <td>&nbsp;</td> -->
    <td>&nbsp;</td>
    <td></td>
    <td></td>

</tr>

<tr>
    <!-- <td>&nbsp;</td> -->
    <td>&nbsp;</td>
    <td></td>
    <td></td>

</tr>
<tr>
    <!-- <td>&nbsp;</td> -->
    <td>&nbsp;</td>
    <td></td>
    <td></td>

</tr><tr>
    <!-- <td>&nbsp;</td> -->
    <td>&nbsp;</td>
    <td></td>
    <td></td>

</tr><tr>
    <!-- <td>&nbsp;</td> -->
    <td>&nbsp;</td>
    <td></td>
    <td></td>

</tr><tr>
    <!-- <td>&nbsp;</td> -->
    <td>&nbsp;</td>
    <td></td>
    <td></td>

</tr><tr>
    <!-- <td>&nbsp;</td> -->
    <td>&nbsp;</td>
    <td></td>
    <td></td>

</tr><tr>
    <!-- <td>&nbsp;</td> -->
    <td>&nbsp;</td>
    <td></td>
    <td></td>

</tr><tr>
    <!-- <td>&nbsp;</td> -->
    <td>&nbsp;</td>
    <td></td>
    <td></td>

</tr><tr>
    <!-- <td>&nbsp;</td> -->
    <td>&nbsp;</td>
    <td></td>
    <td></td>

</tr><tr>
    <!-- <td>&nbsp;</td> -->
    <td>&nbsp;</td>
    <td></td>
    <td></td>

</tr><tr>
    <!-- <td>&nbsp;</td> -->
    <td>&nbsp;</td>
    <td></td>
    <td></td>

</tr><tr>
    <!-- <td>&nbsp;</td> -->
    <td>&nbsp;</td>
    <td></td>
    <td></td>

</tr><tr>
    <!-- <td>&nbsp;</td> -->
    <td>&nbsp;</td>
    <td></td>
    <td></td>

</tr>

</tr><tr>
    <!-- <td>&nbsp;</td> -->
    <td>&nbsp;</td>
    <td></td>
    <td></td>
</tr>



<tr>
    <td colspan="5"><h3><center><bold>&nbsp;SEPESIFIKASI BARANG</center></bold></h3></td>

</tr>
<tr>
    <!-- <td>&nbsp;</td> -->
    <td>&nbsp;</td>
    <td></td>
    <td></td>
</tr>
<tr>
    <!-- <td>&nbsp;</td> -->
    <td>&nbsp;</td>
    <td></td>
    <td></td>
</tr>
<tr>
    <!-- <td>&nbsp;</td> -->
    <td>&nbsp;</td>
    <td></td>
    <td></td>
</tr>
<tr>
    <!-- <td>&nbsp;</td> -->
    <td>&nbsp;</td>
    <td></td>
    <td></td>
</tr>
</table>

<br>

<table style="width: 100%">   
<tr>
<td colspan="5"><center>Pemohon</center></td>
<td colspan="5"><center>Proses</center></td>
</tr>

<tr>   
<td><center>Admin Divisi</center></td>
<td><center>Kabag/Kaops</center> </td>
<td colspan="3"><center>Kadiv Pinca</center></td>

<td><center>Admin Cek</center></td>
<td><center>Kadiv PPI</center></td>
<td><center>Kabag PPI</center> </td>


</tr>

<tr>
<td height="70px;">&nbsp;</td>
<td>&nbsp;</td>
<td colspan="3">&nbsp;</td>

<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>    

</tr>


</table>

<!-- 
<h4>Inisial :</h4>
<h4>Divisi  :</h4>
<h4>Tanggal :</h4> -->

<h4><BOLD> * NO PR = TELAH DISETUJUI MELALUI SISTEM </BOLD> </h4>
 
<script>
    window.print();
</script>