<?php 
  $id_pelanggan=base64_decode($_GET['P']);
  $id_transaksi=base64_decode($_GET['T']);
//  $id_penjualan=base64_decode($_GET['IdP']);

  $tgl=base64_decode($_GET['Tg']);
  $Sql="SELECT * FROM pengguna WHERE akses='admin' OR akses='Admin'";
  $Admin=$this->db->query($Sql);

?>                 
<style type="text/css">
  table{
    width: 100%;
  }
  th{
    padding: 20px;
    color: white
  }
  td{
    border-bottom: 1px solid gray;
    padding: 20px;
  }
  td.total{
    border-bottom: 1px solid white;
  }
</style>
                   <div style="float: right;">
                     <b style="float: right;font-size: 30px">
                        Sales/Delivery Order
                     </b>
                     <br>
                     <p style="float: right;">
                        Sales Order# 
                     </p>
                   </div>
                   <div style="width: 30%;">
                       <img src="<?php echo base_url(); ?>img/logoPIP.png" style="width: 300px;margin-top: 2%;">
                       <BR>
                       <b>PT Pupuk Indonesia Pangan</b>
                       <p>
                          Jl. Raya Rawamerta, Dusun Sukamanah RT/RW 06/03 Desa Kutawargi,
                          kecamatan Rawamerta <br>Kabupaten Karawang Jawa Barat <br>
                          Indonesia
                          <br><br><br><br><br><br>
                          Kirim Kepada : <br>
                          <b><?php foreach ($query->result() as $row){ echo $row->nama;  }?></b><br>
                          <?php foreach ($query->result() as $row){ echo $row->alamat;  }?><br><br><br>
                          Driver To<br>
                          <?php  echo $tipe_sj; ?>
                       </p>
                   </div>
                   <body style="background: white">
                                 <table  style="width:100%" id=tampildata>
                                    <thead style="background: black">
                                      <tr >
                                        <th rowspan=3>No</th>
                                        <th rowspan=3>Item & Description</th>
                                        <th rowspan=3>Qty Sak</th>
                                        <th rowspan=3>Rate</th>
                                        <th rowspan=3>Amount</th>
                                      </tr>

                                    </thead>
                                   <tbody id="listUser">
                                      <?php 
                                      $no=1;
                                        $sql="SELECT id_penjualan, produk.id_produk,produk.nama,produk.harga,penjualan.qty,satuan_kg
                                              FROM penjualan,produk WHERE penjualan.id_produk=produk.id_produk AND penjualan.id_pelanggan='$id_pelanggan' AND id_transaksi='$id_transaksi' AND tipe_sj='$tipe_sj' AND tgl='$tgl'";
                                        $Query=$this->db->query($sql);
                                        
                                        foreach ($Query->result() as $data)
                                          {
                                          $jumlah=$data->qty*$data->harga*$data->satuan_kg;
                                     //     $tgl=date_create($data->tgl);
                                       ?>
                                          <tr>
                                           <td><?php echo  $no++;?></td>
                                           <td><?php echo htmlentities($data->nama).' '.$data->satuan_kg.' Kg';?></td>
                                           <td><?php echo htmlentities(number_format($data->qty)).'';?></td>
                                           <td><?php echo htmlentities(number_format($data->harga*$data->satuan_kg,2));?></td>
                                           
                                           <td><?php echo htmlentities(number_format($jumlah,2));?></td>
                                         </tr> 
                                         <?php
                                        }
                                        //Total
                                         $sql="SELECT produk.harga,penjualan.qty,satuan_kg, 
                                            SUM(harga*qty*satuan_kg) as total_harga
                                            FROM penjualan,produk WHERE penjualan.id_produk=produk.id_produk AND penjualan.id_pelanggan='$id_pelanggan'  AND id_transaksi='$id_transaksi' AND tipe_sj='$tipe_sj' AND tgl='$tgl'";
                                         $query2=$this->db->query($sql);
                                         
                                     
                                        if($tipe_sj!==""){
                                     
                                      ?>
                                      <tr>
                                        <td colspan="4">Biaya Pengiriman</td>
                                        <td><?php foreach ($query->result() as $row){ echo htmlentities(number_format($row->biaya_pengiriman,2));  ?></td>
                                      </tr>
                                      <tr>
                                        <td class="total" colspan="4" style="text-align: right">Sub Total</td>
                                        <td class="total"><?php foreach ($query2->result() as $total){ echo ' '. number_format($total->total_harga+$row->biaya_pengiriman,2); } ?></td>
                                      </tr>
                                      <tr>
                                        <td  class="total" colspan="3"></td>
                                        <td class="total" style="text-align: right;background:#DADADA;color: black"><b>Total</b></td>
                                        <td class="total" style="background:#DADADA;color: black"><b><?php foreach ($query2->result() as $total){ echo 'IDR '. number_format($total->total_harga+$row->biaya_pengiriman,2); } ?></b></td>
                                      </tr>
                                      <?php 
                                        }
                                      }else{?>

                                      <tr>
                                        <td class="total" colspan="4" style="text-align: right">Sub Total</td>
                                        <td class="total"><?php foreach ($query2->result() as $total){ echo ' '. number_format($total->total_harga,2); } ?></td>
                                      </tr>
                                      <tr>
                                        <td  class="total" colspan="3"></td>
                                        <td class="total" style="text-align: right;background:#DADADA;color: black"><b>Total</b></td>
                                        <td class="total" style="background:#DADADA;color: black"><b><?php foreach ($query2->result() as $total){ echo 'IDR '. number_format($total->total_harga,2); } ?></b></td>
                                      </tr>
                                      <?php } ?> 
                                    </tbody>
                                  </table>
                                  <br>
                                  <br>
                                  <br>
                                  <br><br><br><br><br>
                                  <div style="float: left;">
                                    <p>
                                     <?php 
                                       $SELECT="SELECT * FROM pengembalian,penjualan WHERE  pengembalian.id_pelanggan='$id_pelanggan' AND pengembalian.tipe_sj='$tipe_sj' AND penjualan.id_stok=pengembalian.id_stok";
                                        $cek=$this->db->query($SELECT);
                                        $num=$cek->num_rows();
                                      
                                      ?>
                                       <?php if($num>0){ $i=$cek->row_array();
                                                $id_produk=$i['id_produk'];
                                                $produk="SELECT * FROM produk WHERE id_produk='$id_produk'";
                                                $Produk=$this->db->query($produk);
                                                $prdk=$Produk->row_array();
                                        ?>
                                      <br>
                                       Note : Pengembalian  <?php foreach ($query->result() as $data)
                                              {
                                                 echo htmlentities($prdk['nama'].' '.$prdk['satuan_kg']).'Kg '.htmlentities(number_format($i['jumlah'])).' Sak. (<b>' .$i['keterangan'].'</b>)' ;

                                              }
                                          }else{
                                            echo "Tidak ada pengembalian produk";
                                          }
                                          ?>
                                      <br><br><br><br><br><br><br>
                                      <div style="width: 300px; background: black; height: 2px;"></div>
                                      TTD & Nama Lengkap Pejabat Berwenang PT PIP
                                    </p>
                                  </div>
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
                                  <div style="float: right;margin-right: 2%">
                                   <center>    
                                     Karawang , <?php echo $tgl.' '.$bulan.' '.$tahun; ?><br>
                                      <span>Admin</span>
                                      
                                      <br><br><br><br><br><br><br>
                                      <div style="width: 200px; background: black; height: 2px;"></div>
                                     <?php foreach ($Admin->result() as $admin) {
                                          echo $admin->nama;
                                      }  ?>
                                    </p>
                                   </center>  
                                  </div>
                   </body>

      <script type="text/javascript">
        window.print();
      </script>