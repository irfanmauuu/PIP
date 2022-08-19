
  <?php
  $Tgl1=date_create($tgl1);  
  $T1=date_format($Tgl1,'d-m-Y');

  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=Laporan Penjualan Perhari ".$T1.".xls");
  // ?> 
  <style type="text/css" rel=stylesheet>
    td.data{
      border: 1px solid black;
      padding: 10px;
    }
  </style>
                                 <table>
                                   <tr>
                                <!--      <td> 
                                      <img src="<?php echo base_url(); ?>img/logoPIP.png" style="width:230px;float: left; position: absolute;margin-left: 5%;top:0">
                                     </td> -->
                                     <td colspan="6">
                                      <center>
                                       <h1>PT Pupuk Indonesia Pangan</h1>
                                      </center>
                                   </tr>
                                   <tr>   
                                      <td colspan="6">
                                        <center><h5>Jl. Raya Rawamerta, Dusun Sukamanah RT/RW 06/03 Desa Kutawargi,</h5> </center>
                                      </td>
                                   </tr>
                                   <tr>     
                                      <td colspan="6">
                                        <center>
                                          <h5>
                                          kecamatan Rawamerta Kabupaten Karawang Jawa Barat 
                                          Indonesia
                                         </h5>
                                        </center>  
                                      </td>
                                   </tr>
                                   <tr>
                                     <td colspan="6">
                                        <center>
                                         <h5>
                                           Tanggal :  <?php $Tgl1=date_create($T1); echo date_format($Tgl1,'d-m-Y')?>
                                         </h5>
                                        </center>
                                      </td>
                                   </tr>
                                 </table>
                                

                                 <table style="width:100%">
                                      <tr>
                                        <td class="data">No</th>
                                        <td class="data">Tanggal</th>
                                        <td class="data">Produk</th>
                                        <td class="data">Harga</th>
                                        <td class="data">Qty Sak</th>
                                        <td class="data">Jumlah</th>
                                      </tr>
                                      <?php 
                                      $no=1;
                                     foreach ($query as $data)
                                          {
                                          $jumlah=$data->qty*$data->harga*$data->kg;
                                          $tgl=date_create($data->tgl);
                                       ?>
                                          <tr>
                                           <td class="data"><?php echo  $no++;?></td>
                                           <td class="data"><?php echo htmlentities(date_format($tgl,'d-m-Y'));?></td>
                                           <td class="data"><?php echo htmlentities($data->nama);?></td>
                                           <td class="data"><?php echo htmlentities(($data->harga));?></td>
                                           <td class="data"><?php echo htmlentities(($data->qty));?></td>
                                           <td class="data"><?php echo htmlentities(($jumlah));?></td>
                                          
                                         </tr> 
                                         <?php
                                       }
                                         $date1=$tgl1;
                                         $sql_total="SELECT SUM(qty)as total_kg, SUM(harga*qty*kg) as total_harga FROM penjualan,produk WHERE tgl = '$date1' AND produk.id_produk=penjualan.id_produk AND status='lunas'";
                                         $query2=$this->db->query($sql_total);
                                        
                                      
                                      ?>
                                      <tr>
                                        <td  colspan="4" class="data">Total</td>
                                        <td class="data"><?php foreach ($query2->result() as $total){ echo ($total->total_kg).' Kg'; } ?></td>                        
                                        <td class="data"><?php foreach ($query2->result() as $total){ echo 'Rp '. ($total->total_harga); } ?></td>
                                        
                                      </tr>
                                     
                                    
                                    <?php 
                                       $tgl=date('d');
                                       $bln=date('m');
                                       $tahun=date('Y');
                                       if($bln=='01'){$bulan='Januari';}
                                       if($bln=='02'){$bulan='Februari';}
                                       if($bln=='03'){$bulan='Maret';}
                                       if($bln=='04'){$bulan='April';}
                                       if($bln=='05'){$bulan='Mei';}
                                       if($bln=='06'){$bulan='Juni';}
                                       if($bln=='07'){$bulan='Juli';}
                                       if($bln=='08'){$bulan='Agustus';}
                                       if($bln=='09'){$bulan='September';}
                                       if($bln=='10'){$bulan='Oktober';}
                                       if($bln=='11'){$bulan='November';}
                                       if($bln=='12'){$bulan='Desember';}
                                          $Sql="SELECT * FROM pengguna WHERE akses='Manager' OR akses='manager'";
                                          $Manager=$this->db->query($Sql);
                                      ?>
                                    <tr>
                                      <td></td><td></td><td></td><td></td><td></td>
                                      <td><center>Karawang , <?php echo $tgl.' '.$bulan.' '.$tahun; ?></center></td>
                                    </tr>
                                    <tr> <td></td><td></td><td></td><td></td><td></td><td>Manager</td></tr>
                                    <tr><td></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td></td></tr>
                                    <tr>
                                        <td></td><td></td><td></td><td></td><td></td>
                                        <td style="border-top: 1px solid black"> <center><?php foreach ($Manager->result() as $m) {
                                          echo $m->nama;}?></center>  </td>
                                    </tr>