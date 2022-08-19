<?php
                                      $month=base64_decode($_GET['m']);
                                      $bln=$month;
                                      $tahun=($year);
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
                                       $year=base64_decode($_GET['Y']);
?>
<style type="text/css">
  *{
    color: black;
    font-family: sans-serif;
  }
  body{
    background: white;
  }
  td th{
    border: 1px solid black;
  }
</style>                           
                             
                                      <img src="<?php echo base_url(); ?>img/logoPIP.png" style="width:230px;float: left; position: absolute;margin-left: 5%;top:0">
                                      <center style='margin-left: 10%'>
                                        <br>
                                       <h1>PT Pupuk Indonesia Pangan</h1>
                                        <p>
                                          Jl. Raya Rawamerta, Dusun Sukamanah RT/RW 06/03 Desa Kutawargi,
                                          kecamatan Rawamerta <br>Kabupaten Karawang Jawa Barat <br>
                                          Indonesia
                                        </p>
                                     </center>   
                                      
                                <div style="width:100%;height: 3px; background: black"></div>
                                <div style="width:100%;height: 2px; background: black;margin-top: 1.5px"></div>
                                <br>
                                <center>
                                 <h2>
                                 Laporan Penjualan  Bulan :  <?php echo $bulan.' '.$year ?>
                                 </h2>
                                 </center>

                                 <table id="datatable" class="table table-striped table-bordered" style="width:100%" id=tampildata>
                                    <thead>
                                      <tr>
                                        <th rowspan=3>No</th>
                                        <th rowspan=3>Tanggal</th>
                                        <th rowspan=3>Produk</th>
                                        <th rowspan=3>Harga</th>
                                        <th rowspan=3>Qty Sak</th>
                                        <th rowspan=3>Jumlah</th>
                                      </tr>

                                    </thead>
                                   <tbody id="listUser">
                                      <?php 
                                      $no=1;
                                     foreach ($query as $data)
                                          {
                                          $jumlah=$data->qty*$data->harga*$data->kg;
                                          $tgl=date_create($data->tgl);
                                       ?>
                                          <tr>
                                           <td><?php echo  $no++;?></td>
                                           <td><?php echo htmlentities(date_format($tgl,'d-m-Y'));?></td>
                                           <td><?php echo htmlentities($data->nama);?></td>
                                           <td style="text-align: right;"><?php echo htmlentities(number_format($data->harga));?></td>
                                           <td style="text-align: right;"><?php echo htmlentities($data->qty);?></td>
                                           <td style="text-align: right;"><?php echo htmlentities(number_format($jumlah));?></td>
                                          
                                         </tr> 
                                         <?php
                                       }
                                        
                                         $sql_total="SELECT SUM(qty)as total_kg, SUM(harga*qty*kg) as total_harga FROM penjualan,produk WHERE MONTH(tgl) = '$month' AND YEAR(tgl)=$year AND produk.id_produk=penjualan.id_produk AND status='lunas'";
                                         $query2=$this->db->query($sql_total);
                                        
                                      
                                      ?>
                                      <tr>
                                        <td  colspan="4">Total</td>
                                        <td><?php foreach ($query2->result() as $total){ echo number_format($total->total_kg); } ?></td>                        
                                        <td><?php foreach ($query2->result() as $total){ echo 'Rp '. number_format($total->total_harga); } ?></td>
                                        
                                      </tr>
                                     
                                    </tbody>
                                  </table>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
           <br>
                                  <br>
                                  <br>
                                  <br>
                                  <div style="width: 300px;float: left;">
                                    <?php 
                                          $Sql="SELECT * FROM pengguna WHERE akses='Admin' OR akses='admin'";
                                          $Admin=$this->db->query($Sql);


                                      ?>
                                    <p>
                                    <br>
                                      <center>Admin</center>
                                      <br>
                                      <br><br><br><br><br>
                                      <div style="width: 300px; background: black; height: 2px;"></div><br>
                                      <center>   <?php foreach ($Admin->result() as $a) {
                                          echo $a->nama;
                                      }  ?></center>  
                                    </p>
                                  </div>
                                  
                                  <div style="width: 300px;float: right;">
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
                                    <p>
                                      <center>Karawang , <?php echo $tgl.' '.$bulan.' '.$tahun; ?> <br> Manager</center>
                                      <br>
                                      <br><br><br><br><br>
                                      <div style="width: 300px; background: black; height: 2px;"></div><br>
                                      <center>   <?php foreach ($Manager->result() as $m) {
                                          echo $m->nama;
                                      }  ?></center>  
                                    </p>
                                  </div>
  <script type="text/javascript">
    window.print();
  </script>
          