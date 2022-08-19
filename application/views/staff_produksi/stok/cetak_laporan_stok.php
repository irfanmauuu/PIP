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
                                   Data Stok Tanggal :  <?php $Tgl1=date_create($tgl1); $Tgl2=date_create($tgl2); echo date_format($Tgl1,'d-m-Y').' s/d '.date_format($Tgl2,'d-m-Y')  ?>
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
                                        <th rowspan=3>Jumlah</th>
                                      </tr>

                                    </thead>
                                     <tbody id="listUser">
                                      <?php 
                                      $no=1;
                                     foreach ($query as $data)
                                          {
                                                $tgl_produksi=date_create($data->tgl_produksi);
                                                $sql="SELECT nama FROM produk WHERE id_produk='$data->id_produk'";
                                                $cek=$this->db->query($sql);
                                                $i=$cek->row_array();
                                       ?>
                                          <tr>
                                           <td><?php echo  $no++;?></td>
                                           <td><?php echo htmlentities(date_format($tgl_produksi,'d-m-Y'));?></td>
                                           <td><?php echo htmlentities($i['nama']);?></td>
                                           <td style="text-align: right;"><?php echo htmlentities(number_format($data->stok_in+$data->stok_out));?></td>
                                           <td style="text-align: right;"><?php echo htmlentities(number_format($data->stok_out));?></td>
                                           <td style="text-align: right;"><?php echo number_format($data->total); ?></td>
                                          
                                         </tr> 
                                         <?php
                                         $date1=$tgl1;
                                         $date2=$tgl2;
                                        if(($id_produk=="")){
                                         $total_stok_in="SELECT SUM(stok_produk.stok_produk) as stok_in FROM stok_produk WHERE tgl_produksi BETWEEN '$date1' AND '$date2'";
                                           $stokIn=$this->db->query($total_stok_in);
                                           $in=$stokIn->row_array();

                                         $total_stok_out="SELECT SUM(qty) as stok_out FROM penjualan WHERE tgl BETWEEN '$date1' AND '$date2' AND status='lunas'";
                                           $stokOut=$this->db->query($total_stok_out);
                                           $out=$stokOut->row_array();
                                      
                                        }else{
                                         $total_stok_in="SELECT SUM(stok_produk.stok_produk) as stok_in FROM stok_produk WHERE tgl_produksi BETWEEN '$date1' AND '$date2' AND id_produk='$id_produk'";
                                           $stokIn=$this->db->query($total_stok_in);
                                           $in=$stokIn->row_array();

                                         $total_stok_out="SELECT SUM(qty) as stok_out FROM penjualan WHERE tgl BETWEEN '$date1' AND '$date2' AND status='lunas' AND id_produk='$id_produk'";
                                           $stokOut=$this->db->query($total_stok_out);
                                           $out=$stokOut->row_array();
                                         }
                                       }
                                        
                                      ?>
                                        <?php 
                                        if($no<=1){
                                         
                                             echo '<h4>Data tidak ditemukan</h4>';
                                             
                                        }
                                      ?>
                                      <tr>
                                        <td colspan="5">Total</td>
                                        <td><?php if($no>1){ echo number_format($in['stok_in']); }?></td>
                                        
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
                                          $Sql="SELECT * FROM pengguna WHERE akses='Staff Produksi' OR akses='staff produksi' AND status='aktif'";
                                          $Admin=$this->db->query($Sql);


                                      ?>
                                    <p>
                                      <center>Staff Produksi</center>
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

                                      ?>
                                    <p>
                                      <center>Karawang , <?php echo $tgl.' '.$bulan.' '.$tahun; ?></center>
                                      <br><br><br><br><br><br>
                                      <div style="width: 300px; background: black; height: 2px;"></div><br>
                                      <center>TTD & Nama Lengkap Pejabat Berwenang PT PIP</center>  
                                    </p>
                                  </div>
  <script type="text/javascript">
    window.print();
  </script>
          