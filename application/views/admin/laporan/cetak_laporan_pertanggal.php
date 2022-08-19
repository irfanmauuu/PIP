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
                                   Laporan Penjualan Tanggal :  <?php $Tgl1=date_create($tgl1); $Tgl2=date_create($tgl2); echo date_format($Tgl1,'d-m-Y').' s/d '.date_format($Tgl2,'d-m-Y')  ?>
                                 </h2>
                                 </center>

                                 <table id="datatable" class="table table-striped table-bordered" style="width:100%" id=tampildata>
                                     <thead>
                                      <tr>
                                        <th rowspan=3>No</th>
                                        <th rowspan=3>Tanggal</th>
                                        <th rowspan=3>Produk</th>
                                        <th rowspan=3>Stok In</th>
                                        <th rowspan=3>Stok Out</th>
                                        <th rowspan=3>Harga</th>
                                        <th rowspan=3>Qty</th>
                                        <th rowspan=3>Jumlah</th>
                                      </tr>

                                    </thead>
                                   <tbody id="listUser">
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
                                           <td style="text-align: right;"><?php echo htmlentities($data->stok_in+$data->qty);?></td>
                                           <td style="text-align: right;"><?php echo htmlentities($data->qty);?></td>
                                           <td style="text-align: right;"><?php echo htmlentities(number_format($data->harga*$data->satuan_kg));?></td>
                                           <td style="text-align: right;"><?php echo htmlentities($data->qty).' ';?></td>
                                           <td style="text-align: right;"><?php echo htmlentities(number_format($data->harga*$data->satuan_kg*$data->qty));?></td>
                                          
                                         </tr> 
                                         <?php
                                       }
                                         $date1=$tgl1;
                                          $date1=$tgl1;
                                         $date2=$tgl2;
                                         $sql_total="SELECT SUM(qty)as total_kg, SUM(harga*qty*kg) as total_harga,satuan_kg FROM penjualan,stok_produk,produk WHERE  penjualan.id_stok=stok_produk.id_stok AND penjualan.id_produk=produk.id_produk AND status='lunas' AND tgl BETWEEN '$date1' AND '$date2'";
                                         $query2=$this->db->query($sql_total);
                                        
                                      
                                      ?>
                                      <tr>
                                        <td  colspan="6">Total</td>
                                        <td style="text-align: right;"><?php foreach ($query2->result() as $total){ echo number_format($total->total_kg); } ?></td>                        
                                        <td style="text-align: right;"><?php foreach ($query2->result() as $total){ echo number_format($total->total_harga); } ?></td>
                                        
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
          