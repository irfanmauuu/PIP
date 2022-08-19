
  <?php
  $Tgl1=date_create($tgl1);  
  $T1=date_format($Tgl1,'d-m-Y');
  $Tgl2=date_create($tgl2);  
  $T2=date_format($Tgl2,'d-m-Y');

  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=Laporan Penjualan Pertanggal".$tgl1."s/d".$tgl2.".xls");
  // // 
  ?> 
  <style type="text/css" rel=stylesheet>
    body{
      background: white;
    }
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
                                     <td colspan="9">
                                      <center>
                                       <h1>PT Pupuk Indonesia Pangan</h1>
                                      </center>
                                   </tr>
                                   <tr>   
                                      <td colspan="9">
                                        <center><h5>Jl. Raya Rawamerta, Dusun Sukamanah RT/RW 06/03 Desa Kutawargi,</h5> </center>
                                      </td>
                                   </tr>
                                   <tr>     
                                      <td colspan="9">
                                        <center>
                                          <h5>
                                          kecamatan Rawamerta Kabupaten Karawang Jawa Barat 
                                          Indonesia
                                         </h5>
                                        </center>  
                                      </td>  
                                   </tr>
                                   <tr>
                                     <td colspan="9">
                                        <center>
                                         <h5>
                                           Tanggal :  <?php $Tgl1=date_create($T1); $Tgl2=date_create($T2); echo date_format($Tgl1,'d-m-Y').' s/d '.date_format($Tgl2,'d-m-Y')  ?>
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
                                        <td class="data">Stok In</th>
                                        <td class="data">Stok Out</th>
                                        <td class="data">Harga</th>
                                        <td class="data">Qty Sak</th>
                                        <td class="data">Jumlah</th>
                                      </tr>
                                      <?php 
                                      $no=1;
                                     foreach ($query as $data)
                                          {
                                          $jumlah=$data->qty*$data->harga;
                                          $tgl=date_create($data->tgl);
                                          $tgl_produksi=date_create($data->tgl_produksi);
                                       ?>
                                           <tr>
                                           <td><?php echo  $no++;?></td>
                                           <td><?php echo htmlentities(date_format($tgl,'d-m-Y'));?></td>
                                           <td><?php echo htmlentities($data->nama.' '.$data->satuan_kg.' Kg '.date_format($tgl_produksi,'d-m-Y'));?></td>
                                           <td><?php echo htmlentities($data->stok_in+$data->qty);?></td>
                                           <td><?php echo htmlentities($data->qty);?></td>
                                           <td><?php echo htmlentities(($data->harga*$data->satuan_kg));?></td>
                                           <td><?php echo htmlentities($data->qty);?></td>
                                           <td><?php echo htmlentities(($data->harga*$data->satuan_kg*$data->qty));?></td>
                                          
                                         </tr> 
                                         <?php
                                       }
                                          $date1=$tgl1;
                                         $date2=$tgl2;
                                         $sql_total="SELECT SUM(qty)as total_kg, SUM(harga*qty*kg) as total_harga,satuan_kg FROM penjualan,stok_produk,produk WHERE  penjualan.id_stok=stok_produk.id_stok AND penjualan.id_produk=produk.id_produk AND status='lunas' AND tgl BETWEEN '$date1' AND '$date2'";
                                         $query2=$this->db->query($sql_total);
                                      
                                      ?>
                                      <tr>
                                        <td  colspan="6">Total</td>
                                        <td><?php foreach ($query2->result() as $total){ echo number_format($total->total_kg); } ?></td>                        
                                        <td><?php foreach ($query2->result() as $total){ echo number_format($total->total_harga); } ?></td>
                                        
                                      </tr>
                                     
                                        
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

                                      ?>
                                    <tr><td></td></tr>
                                    <tr>
                                      <td></td><td></td><td></td><td></td><td></td>
                                      <td colspan="3">Karawang , <?php echo $tgl.' '.$bulan.' '.$tahun; ?></td>
                                    </tr>
                                    <tr><td></td></tr>
                                    <tr><td></td></tr>
                                    <tr>
                                        <td></td><td></td><td></td><td></td><td></td>
                                        <td  colspan="5" style="border-top: 1px solid black"> TTD & Nama Lengkap Pejabat Berwenang PT PIP</td>
                                    </tr>
                                     
                                    </p>
          