<?php 
         $tanggal=date('d');
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
         $SELECT="SELECT * FROM pelanggan WHERE nama ='$nama'";
         $Query=$this->db->query($SELECT);
         $i=$Query->row_array();
?>
<style type="text/css">
  .garis{
    border: 1px solid black;
  }
  *{ color: black }
</style>
<body style="background: white"> 
      <CENTER style="border: 1px solid black;border-bottom: 0px">
        <h3>PT. PUPUK INDONESIA PANGAN</h3>
         <sp an>Dusun Sukamanah RT/RW 06/03 Desa Kutawargi, kecamatan Rawamerta <br> Kabupaten Karawang</span>
      </CENTER>

       <table style="width:100%" border="1">
             <tr> 
              <tr>  
                <th style="width: 70%"><center><h4>Delivery Order</h4> </center></th>
                <th rowspan="2">
                  <table>
                    <tr><td>No Dokumen </td><td>: PIP-WH-04-01.01</td></tr>
                    <tr><td>Tanggal Efectif </td><td>: -</td></tr>
                    <tr><td>Tanggal Revisi </td><td>: -</td></tr>
                  </table>
                </th>
              </tr>
             <th><center><h5>Surat Jalan </h5></center></th>
            </tr>
        </table>
         <table style="width:100%;border: 1px solid black;">
             <tr> 
              <tr>  
                <th colspan="3" style="width:50%">Pelanggan/Customer</th>
                <th rowspan="3">
                  <table>
                    <tr><td>No DO </td><td>: <?php echo $no_do ?></td></tr>
                    <tr><td>Tanggal </td><td>: <?php echo $tanggal.'-'.$bulan.'-'.$tahun ?></td></tr>
                    <tr><td>Gudang </td><td>: Warehouse PIP Rawamerta</td></tr>
                    <tr><td>Driver </td><td>: </td></tr>
                  </table>
                </th>
                <th rowspan="3">
                  <table>
                    <tr><td>No Pol </td><td>: -</td></tr>
                    <tr><td>No Cont </td><td>: -</td></tr>
                    <tr><td>Ekspedisi </td><td>: -</td></tr>
                    <tr><td>Type SJ </td><td>: <?php  echo $tipe_sj; ?> </td></tr>
                  </table>
                </th>
              </tr>
             <th  style="border-bottom: 1px solid black;border-top: 1px solid black"><?php echo $nama; ?></th>
            </tr>
            <tr>
              <th><?php echo $i['alamat']; ?></th>
            </tr>
        </table>

      <table  class="table bordered" id="datatable" border="1"  style="border-top:1px solid gray;">
        <thead >
          <tr>
            <td rowspan=3 align="center" style="border: 1px solid black" >No</td>
            <td rowspan=3 align="center" style="border: 1px solid black" >Nama Barang</td>
            <td rowspan=3 align="center" style="border: 1px solid black" >SO NO</td>
              <tr>  
                <td colspan="2" align="center" style="border:1px solid black;"><center> Satuan</center></td>
                <td rowspan="3" align="center" style="border:1px solid black;">Total Kg</td>
              </tr>
            <td align="center" style="border: 1px solid black" >Sak</td>
            <td align="center" style="border: 1px solid black" >Kg</td>
            </tr>
        </thead>
        <tbody>
  <?php 
     $sql=" SELECT id_penjualan,produk.id_produk,produk.nama,produk.harga,qty,id_pelanggan,no_so,tgl,kg,stok_produk.tgl_produksi as tgl_produksi
            FROM penjualan,produk,stok_produk WHERE penjualan.id_produk=produk.id_produk AND penjualan.id_pelanggan='$id_pelanggan' AND status='lunas' AND tipe_sj='$tipe_sj' AND tgl='$tgl' AND id_transaksi='$id_transaksi' AND penjualan.id_stok=stok_produk.id_stok ";
        $query=$this->db->query($sql);
                                                              
        $no=1;
       foreach ($query->result() as $data)
        {
           $total_kg=$data->qty*$data->kg;

           $tgl_produksi=date_create($data->tgl_produksi);
       
           $Tgl=date_create($data->tgl);
         ?>
        <tr>
          <td><?php echo  $no++;?></td>
          <td><?php echo htmlentities($data->nama).' '.$data->kg.' Kg ';?></td>
          <td><?php echo htmlentities($data->no_so);?></td>
          <td><?php echo htmlentities(number_format($data->qty));?></td>
          <td><?php echo htmlentities($data->kg);?></td>
          <td><?php echo htmlentities(number_format($total_kg));?></td>
        <tr> 
      <?php } 
        $sql_t="SELECT SUM(kg*qty) as total,SUM(qty) as qty,SUM(kg) as sum_kg
                FROM penjualan,produk WHERE penjualan.id_produk=produk.id_produk 
                AND penjualan.id_pelanggan='$id_pelanggan' 
                AND status='lunas' AND tipe_sj='$tipe_sj' 
                AND tgl='$tgl' AND id_transaksi='$id_transaksi' ";
        $query_t=$this->db->query($sql_t);
         ?>
        <tr>
          <td colspan="3">Total</td>
          <td ><?php  foreach ($query_t->result() as $data) { echo number_format($data->qty);}?></td>
          <td><?php  foreach ($query_t->result() as $data) { echo number_format($data->sum_kg);}?></td>
          <td><?php  foreach ($query_t->result() as $data) { echo number_format($data->total);}?></td>
        </tr>
      </tbody>  
      </table>
      <table style="border: 1px solid black; width: 100%;text-align: center;">
        <tr>
          <td class="garis">Dibuat Oleh</td>
          <td class="garis">Diperiksa</td>
          <td class="garis">Disetujui</td>
          <td class="garis">Dikirim</td>
          <td class="garis">Diterima</td>
          <td rowspan="3" style="text-align: left;width:200px">
            <u>Distribusi</u><br>
            Copy 1 : Accounting <br>
            Copy 2 : Custumers<br>
            Copy 3 : Transporter<br>
            Copy 4 : Warehouse<br>
            Copy 5 : Timbangan
          </td>
        </tr>
        <tr>
          <td class="garis"><br><br><br><br><br><br></td>
          <td class="garis"></td>
          <td class="garis"></td>
          <td class="garis"></td>
          <td class="garis"></td>
        </tr>
        <tr>
          <td class="garis"><?php echo $tanggal.'-'.$bulan.'-'.$tahun ?></td>
          <td class="garis"><?php echo $tanggal.'-'.$bulan.'-'.$tahun ?></td>
          <td class="garis"><?php echo $tanggal.'-'.$bulan.'-'.$tahun ?></td>
          <td class="garis"><?php echo $tanggal.'-'.$bulan.'-'.$tahun ?></td>
          <td class="garis"><?php echo $tanggal.'-'.$bulan.'-'.$tahun ?></td>
        </tr>
      </table>

</body>
<script type="text/javascript"> window.print() </script>