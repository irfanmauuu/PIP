
  <?php
  $Tgl1=date_create($tgl1);  
  $T1=date_format($Tgl1,'d-m-Y');
  $Tgl2=date_create($tgl2);  
  $T2=date_format($Tgl2,'d-m-Y');

  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=Laporan Stok ".$tgl1."s/d".$tgl2.".xls");
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
                                        <td class="data">Jumlah</th>
                                      </tr>
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
                                           <td class="data"><?php echo  $no++;?></td>
                                           <td class="data"><?php echo htmlentities(date_format($tgl_produksi,'d-m-Y'));?></td>
                                           <td class="data"><?php echo htmlentities($i['nama']);?></td>
                                           <td class="data"><?php echo htmlentities(($data->stok_in)+$data->stok_out);?></td>
                                           <td class="data"><?php echo htmlentities(($data->stok_out));?></td>
                                           <td class="data"><?php echo ($data->total); ?></td>
                                          
                                         </tr> 
                                         <?php
                                         $date1=$tgl1;
                                         $date2=$tgl2;
                                         
                                         if($id_produk==""){
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
                                      <tr>
                                        <td colspan="5" class="data">Total</td>
                                        <td class="data"><?php if(isset($id_produk)){ echo ($in['stok_in']); }?></td>
                                        
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
                                      <td></td><td></td><td></td>
                                      <td colspan="3">Karawang , <?php echo $tgl.' '.$bulan.' '.$tahun; ?></td>
                                    </tr>
                                    <tr><td></td></tr>
                                    <tr><td></td></tr>
                                    <tr>
                                        <td></td><td></td><td></td>
                                        <td  colspan="3" style="border-top: 1px solid black"> TTD & Nama Lengkap Pejabat Berwenang PT PIP</td>
                                    </tr>
                                     
                                    </p>
          