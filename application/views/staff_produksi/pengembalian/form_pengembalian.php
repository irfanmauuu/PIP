<?php
  $id_transaksi    =base64_decode($_GET['iT']);
  $id_pelanggan    =base64_decode($_GET['P']);
  $tgl             =base64_decode($_GET['Tg']);
  $tipe_sj         =base64_decode($_GET['SJ']);
  $tgl_sekarang    =date('Y-m-d');
   $SELECT="SELECT * FROM penjualan  WHERE penjualan.id_pelanggan='$id_pelanggan' AND  penjualan.tgl='$tgl'AND penjualan.tipe_sj='$tipe_sj'";
   $Query=$this->db->query($SELECT);
   $A=$Query->row_array();
   $id_penjualan=$A['id_penjualan'];
?>
 <div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
            </div>
        </div>
        <div class="clearfix"></div>
            <div class="right_col" role="main" style="background: none;margin-left: 10%; width: 130%;margin-top:2%">
                <div class="row">
                   <div class="col-md-7 col-sm-10">
                        <div class="x_panel">
                          <div class="x_title">
                            <h2>Pengembalian Produk </h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</li>
                                <li>
                                    <a href="<?php echo base_url() ?>Staff_Produksi/data_pengembalian" class="btn btn-warning" title="kembali"><i class="fa fa-close" style="color:black"></i></a>
                                </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <form id="form-user" action="#"   method="post" >
                                     <?php

                                        $Sql="SELECT DISTINCT
                                                  penjualan.id_stok as id_stok,
                                                  penjualan.id_produk as id_produk,
                                                  penjualan.id_penjualan as id_penjualan,
                                                  penjualan.qty as qty,
                                                  penjualan.kg as satuan_kg,
                                                  
                                                  produk.nama as nama
                                                  FROM penjualan,produk WHERE  penjualan.id_produk=produk.id_produk AND status='lunas' AND id_pelanggan = '$id_pelanggan'AND tgl='$tgl' AND id_transaksi='$id_transaksi'";
                                        $jsArray2 = "var prdName = new Array();\n"; 

                                       echo'
                                         <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3">Nama Produk</label>
                                            <div class="col-md-6 col-sm-3">
                                              <select class="form-control" id="id_produk" name=id_produk required="" onchange="changeValue2(this.value)">
                                              <option value="">Pilih</option>';
                                                
                                              $produk = $this->db->query($Sql);   
                                       
                                                $no=1;
                                                    foreach ($produk->result() as $Row) {
                                                      $date=date_create($Row->tgl_produksi);
                                                      echo'
                                                         <option value="'.$Row->id_produk.'">'.$Row->nama.' '.$Row->satuan_kg.' Kg </option>';
                                                       $jsArray2 .= "prdName['" . $Row->id_produk . "'] =     
                                                          {
                                                             id_stok      :'".addslashes($Row->id_stok)."',
                                                             total_kg     :'".addslashes($Row->qty)."',
                                                             id_penjualan :'".addslashes($Row->id_penjualan)."',
                                                             kg           :'".addslashes($Row->satuan_kg)."'
                                                         };\n";
                                                        }  
                                                       echo '</select>';  
                                        ?>  
                                            <script type="text/javascript">  
                                                <?php echo $jsArray2; ?>

                                                   function changeValue2(id){

                                                   document.getElementById('id_stok').value = prdName[id].id_stok;
                                                   document.getElementById('total_kg').value = (prdName[id].total_kg);
                                                   document.getElementById('id_penjualan').value = (prdName[id].id_penjualan);                             
                                                 };
                                             </script>    
                                            
                                            <span id="pesan1"></span>
                                           </div>

                                        </div>
                                        <input type="hidden" name="id_stok" id="id_stok">
                                        <input type="hidden" name="id_pelanggan" value="<?php echo $id_pelanggan ?>">
                                        <input type="hidden" name="id_penjualan" id="id_penjualan">
                                        <input type="hidden" name="tipe_sj" value="<?php echo $tipe_sj ?>">
                                        <input type="hidden" name="id_pengembalian" value="<?php echo $id_pengembalian ?>">
                                        <input type="hidden" name="tgl" value="<?php echo date('Y/m/d') ?>">

                                        <!-- 
                                         <div class="field item form-group">
                                             <label class="col-form-label col-md-3 col-sm-3">Harga</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input  type="text" class="form-control" name="harga"  data-parsley-trigger="change" id="harga" readonly="">
                                            </div>
                                        </div> -->
                                        <div class="field item form-group">
                                             <label class="col-form-label col-md-3 col-sm-3">Total Sak</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input  type="text" class="form-control" name="total_kg"  data-parsley-trigger="change" id='total_kg' readonly="">
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                             <label class="col-form-label col-md-3 col-sm-3">Qty Sak</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input  type="number" class="form-control" name="qty"  data-parsley-trigger="change" id=qty min="0" max="">
                                                <span id="pesan3"></span>
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                             <label class="col-form-label col-md-3 col-sm-3">Keterangan</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input  type="text" class="form-control" name="keterangan"  data-parsley-trigger="change" id=keterangan placeholder="alasan pengembalian" >
                                                <span id="pesan4"></span>
                                            </div>
                                        </div>
                                        <div class="ln_solid">
                                            <div class="form-group">
                                                <div class="col-md-6 offset-md-3">
                                                  <!-- <input type="submit" name="submit" value="submit"> -->
                                                    <button type="button" class="btn btn-primary btn-sm mt-3" onclick="simpan()"><i class="fa fa-save" ></i> Simpan</button>
                                                     
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                           <div class="x_content">
                                                <table id="datatable" class="table table-striped table-bordered" style="width:100%" id=tampildata>
                                                   <thead class="thead thead-dark">
                                                        <tr>
                                                            <th rowspan=3>No</th>
                                                            <th rowspan=3>Produk</th>
                                                            <th rowspan=3>Qty</th>
                                                            <th>Hapus</th>
                                                        </tr>

                                                          </thead>
                                                            <?php 
                                                           

                                                            $No=1;
                                                              $sql="SELECT satuan_kg,id_penjualan,id_pengembalian, produk.nama as nama,produk.harga as harga,jumlah as qty,tgl FROM pengembalian,produk WHERE pengembalian.id_produk=produk.id_produk AND id_pelanggan='$id_pelanggan' AND  tgl='$tgl_sekarang'AND tipe_sj='$tipe_sj'";
                                                              $query=$this->db->query($sql);
                                                             ?>
                                                            <tbody id="listUser">
                                                      
                                                             <?php 
                                                              foreach ($query->result() as $row)
                                                                {
                                                                // $jumlah=$row->qty*$row->harga;
                                                             ?>
                                                                <tr>
                                                                 <td><?php echo  $No++;?></td>
                                                                 <td><?php echo htmlentities($row->nama.' '.$row->satuan_kg.'Kg');?></td>
                                                                 <td><?php echo htmlentities($row->qty).' Sak';?></td>
                                                                 <th>
                                                              <!--     <a href="<?php echo base_url('Staff_Produksi/hapus_pengembalian?I='. base64_encode($row->id_pengembalian).'&T='.base64_encode($tgl).'&P='.base64_encode($id_pelanggan).'&SJ='.base64_encode($tipe_sj).'&PJ='.base64_encode($row->id_penjualan))?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a> -->
                                                                  <button  class="btn btn-danger btn-sm" onclick="hapus('<?php echo $row->id_pengembalian ?>')" ><i class="fa fa-trash"></i></button>
                                                                      
                                                                  </th>
                                                               </tr> 
                                                               <?php
                                                              }
                                                              //Total

                                                        
                                                               $sql="SELECT 
                                                                  SUM(jumlah) as jumlah
                                                                  FROM pengembalian,produk WHERE pengembalian.id_produk=produk.id_produk AND id_pelanggan='$id_pelanggan'  AND tgl='$tgl_sekarang' AND tipe_sj='$tipe_sj' AND id_penjualan='$id_penjualan'";
                                                               $query2=$this->db->query($sql);
                                                              
                                                            ?>
                                                            <tr>
                                                              <td  colspan="2">Total</td>
                                                              <td><?php foreach ($query2->result() as $total){ echo number_format($total->jumlah).' Sak'; } ?></td>
                                                              <td></td>
                                                            </tr>
                                                           
                                                          </tbody>
                                                        </table>
                                                      </div>
                                                    </div>
                                                   
                                                  </td>
                                    </div>
                                </div>
                            </div> 
                        </div> 
                    </div> 
                </div>                 

                              
                                    
                        <script type="text/javascript">
                           function background(){
                              document.getElementById("background").style.background = "#DADADA";
                              }
                            function simpan(){
                               
                                if(document.getElementById('id_produk').value==""){
                                   $('#pesan1').html('Nama Produk Harus di pilih');
                                }else if(document.getElementById('qty').value==""){
                                   $('#pesan3').html('Kg Produk Harus di isi');
                                 }else if(parseInt(document.getElementById('total_kg').value) < parseInt(document.getElementById('qty').value)){
                                  $('#pesan3').html('Qty Kg tidak boleh lebih banyak dari Total Qty');
                                 } 
                                 else if(document.getElementById('keterangan').value ==""){
                                  $('#pesan4').html('Keterangan Harus Di isi');
                                 } 
                                else{
                                 var data = $('#form-user').serialize();
                                 $.ajax({
                                     type: 'POST',
                                     url: "<?php echo base_url()?>Staff_Produksi/simpan_pengembalian",
                                     data: data,
                                     success: function() {
                                       $('html, body').animate({ scrollBottom: 0 }, 'slow');
                                       location.reload(true);
                                   
                                    //    $('#tampildata').load("<?php echo base_url()?>Staff_Gudang/tabel_surat_jalan").html(response);;
                                     }
                                 });
                               }
                             }
                               function hapus(id) {
                                if (confirm("Yakin Data Akan Dihapus?") == true) {
                                 $.ajax({
                                      type: 'POST',
                                      data: 'id='+id,
                                      url: "<?php echo base_url()?>Staff_Produksi/hapus_pengembalian",
                                      success: function(result) {
                                      location.reload(true);
                                        var response = JSON.parse(result);
                                       }
                                    });
                                } else {
                                      return;
                                  }
                                
                                }
                              function edit(id) {
                                  $('html, body').animate({ scrollTop: 0 }, 'slow');

                                  $.ajax({
                                      type: 'POST',
                                      data: 'id='+id,
                                      success: function(result) {
                                    //  location.reload(true);
                                       $(".right_col").load("<?php echo base_url()?>Staff_Produksi/form_edit_surat_jalan?id="+id);
                                        var response = JSON.parse(result);
                                       }
                                    });
                                  
                                }
                                
                            </script>    

                                    </div>
                                   </div> 
                                  </div> 
                                 </div>
                                </div>
                              </div>  
