
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                        </div>

                    </div>
                    <div class="clearfix"></div>
                
                 <div class="row">
                        <div class="col-md-12 col-sm-10">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h5>ID Penjualan : <?php echo $id_transaksi ?></h5>
                                    <ul class="nav navbar-right panel_toolbox">
                                      <li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</li>
                                       
                                      </li>
                                    </ul>
                            <div class="clearfix"></div>
                          </div>
                                <div class="x_content">
                                    <form  method="post" id="form-user" action="#">
                                    <!-- <form  method="post" id="form-user" action="edit_penjualan"> -->
                                  
                                       <!-- HIDDEN -->
                                        <input type="HIDDEN" name="id_penjualan" value="<?php echo $id_penjualan ?>">
                                        <input type="HIDDEN" name="id_transaksi" value="<?php echo $id_transaksi ?>">
                                        <input type="hidden" name="tipe_sj" value="<?php echo $tipe_sj ?>">
                                        <input type="hidden" name="tgl" value="<?php echo date('Y/m/d') ?>">
                                        <input type="hidden" name="id_pelanggan" value="<?php echo $id_pelanggan; ?>">
                                       <?php   
                                        $sql="SELECT DISTINCT stok_produk,tgl_produksi,nama,kategori,harga,stok_produk.id_stok,stok_produk,stok_produk.id_produk,satuan_kg
                                               FROM stok_produk,produk,penjualan WHERE produk.id_produk=stok_produk.id_produk AND stok_produk > 0 AND id_pelanggan='$id_pelanggan' AND id_transaksi='$id_transaksi' AND status='belum lunas' AND tipe_sj='$tipe_sj' ORDER BY produk.nama,stok_produk.tgl_produksi ASC";
                                        $get_produk = $this->db->query($sql);
                                        $jsArray2 = "var prdName = new Array();\n"; 

                                       echo'
                                         <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3">Nama Produk</label>
                                            <div class="col-md-6 col-sm-3">
                                              <select class="form-control" id="id_produk" name="id_produk" required="" onchange="changeValue2(this.value)">
                                              <option value="">Pilih</option>';
                                          
                                              $no=1;
                                                    foreach ($nama_produk as $row) {
                                                      $Select="SELECT SUM(stok_produk)as stok_produk FROM stok_produk WHERE id_produk='$row->id_produk'";
                                                      $Qs=$this->db->query($Select);
                                                      $Stk=$Qs->row_array();
                                                      $Stok=$Stk['stok_produk'];
                                                    echo'
                                                         <option value="'.$row->id_produk.'"';if($row->id_produk==$id_produk){ echo 'selected'; } echo '>'.$row->nama.', '.$Stok.' Sak</option>';
                                                       $jsArray2 .= "prdName['" . $row->id_produk . "'] =     
                                                          {
                                                             harga            :'".addslashes($row->harga*$row->satuan_kg)."',
                                                             id_stok          :'".addslashes($row->id_stok)."',
                                                             kg               :'".addslashes($row->satuan_kg)."',
                                                             stok             :'".addslashes($Stok)."'
                                                         };\n";
                                                        }  
                                                       echo '</select>';  
                                        ?>  
                                            <script type="text/javascript">  
                                                <?php echo $jsArray2; ?>
                                                  function changeValue2(id){
                                                   document.getElementById('harga').value = formatRupiah(prdName[id].harga)+'/Sak';
                                                   document.getElementById('kg').value = (prdName[id].kg);  
                                                    document.getElementById('stok').value = (prdName[id].stok); 
                                                   document.getElementById('tgl_produksi').value = (prdName[id].tgl_produksi)
                                                };
                                             </script>
                                            <span id="pesanproduk"></span>
                                           </div>
                                        </div>
                                        <input type="hidden" name="stok" id="stok" <?php foreach ($nama_produk as $row) { 
                                          $Select="SELECT SUM(stok_produk)as stok_produk FROM stok_produk WHERE id_produk='$row->id_produk'";
                                                      $Qs=$this->db->query($Select);
                                                      $Stk=$Qs->row_array();
                                                      $Stok=$Stk['stok_produk'];
                                          if($row->id_produk==$id_produk){ echo 'value="'.$Stok.'"'; } }?> >

                                        <div class="field item form-group">
                                             <label class="col-form-label col-md-3 col-sm-3">Harga</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input  type="text" class="form-control" name="harga"  data-parsley-trigger="change" id="harga" readonly="" <?php foreach ($nama_produk as $row) {  if($row->id_produk==$id_produk){ ?> value="<?php  echo number_format($row->harga*$kg).'/Sak' ?>"  <?php } } ?>>
                                            </div>
                                        </div>
                                          <div class="field item form-group">
                                             <label class="col-form-label col-md-3 col-sm-3">Satuan Kg</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input  type="text" class="form-control" name="kg"  data-parsley-trigger="change" id='kg' readonly <?php foreach ($nama_produk as $row) {  if($row->id_produk==$id_produk){ ?> value="<?php  echo $kg;  ?>"  <?php } } ?> >
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                             <label class="col-form-label col-md-3 col-sm-3">No SO</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input  type="text" class="form-control" name="no_so"  value="<?php echo$no_so ?>"  data-parsley-trigger="change">
                                                
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                             <label class="col-form-label col-md-3 col-sm-3">Qty Sak</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input  type="number" class="form-control" name="qty"  data-parsley-trigger="change" id=qty min="0" max="1000" value="<?php echo$qty ?>">
                                                <span id="pesankg"></span>
                                            </div>
                                        </div>
                                        <div class="ln_solid">
                                            <div class="form-group">
                                                <div class="col-md-6 offset-md-3">
                                                  <button type="button" class="btn btn-primary btn-sm mt-3" onclick="simpan()"><i class="fa fa-edit"  ></i> Edit</button>
                                              <!--     <button type="submit" class="btn btn-primary btn-sm mt-3" ><i class="fa fa-edit"  ></i> Edit</button>
                                               -->       <button type="button" class="btn btn-warning btn-sm mt-3"  onClick="document.location.reload(true)" ><i class="fa fa-close" style="color:black"></i> Batal</button>
                                                  

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- Table -->
                               
                                 <table id="datatable" class="table table-striped table-bordered" style="width:100%" id=tampildata>
                                    <thead>
                                        <tr>
                                        <th rowspan=3>No</th>
                                        <th rowspan=3>Produk</th>
                                        <th rowspan=3>Harga</th>
                                        <th rowspan=3>Qty </th>
                                        <th rowspan=3>Jumlah</th>
                                        <th>Hapus</th>
                                      </tr>

                                    </thead>
                                   <tbody id="listUser">
                                      <?php 
                                      $no=1;
                                           $sql="SELECT id_penjualan, produk.id_produk,produk.nama,produk.harga,qty,kg,satuan_kg,tgl_produksi
                                              FROM penjualan,produk,stok_produk WHERE penjualan.id_stok=stok_produk.id_stok AND penjualan.id_produk=produk.id_produk AND penjualan.id_pelanggan='$id_pelanggan' AND status='belum lunas' AND tipe_sj='$tipe_sj'";
                                        $query=$this->db->query($sql);
                                        
                                        foreach ($query->result() as $data)
                                          {
                                          $jumlah=$data->qty*$data->harga;
                                           $tgl=date_create($data->tgl_produksi);
                                       ?>
                                          <tr>
                                           <td><?php echo  $no++;?></td>
                                           <td><?php echo htmlentities($data->nama);?><span><?php echo ' '.htmlentities($data->kg).' Kg '.date_format($tgl,'d-m-Y') ?></span></td>
                                           <td><?php echo htmlentities(number_format($data->harga*$data->satuan_kg));?></td>
                                           <td><?php echo htmlentities($data->qty).' Sak';?></td>
                                           <td><?php echo htmlentities(number_format($jumlah*$data->satuan_kg));?></td>
                                           <td>                                          
                                            <button  class="btn btn-danger btn-sm" onclick="hapus('<?php echo $data->id_penjualan ?>')" ><i class="fa fa-trash"></i></button>
                                            <button  class="btn btn-success btn-sm" onclick="edit('<?php echo $data->id_penjualan ?>')" ><i class="fa fa-edit"></i></button>
                                           </td>
                                         </tr> 
                                         <?php
                                        }
                                        //Total
                                         $sql="SELECT produk.harga,penjualan.qty,satuan_kg, 
                                            SUM(harga*qty*satuan_kg) as total_harga
                                            FROM penjualan,produk WHERE  penjualan.id_pelanggan='$id_pelanggan' AND status='belum lunas' AND id_transaksi='$id_transaksi' AND penjualan.id_produk=produk.id_produk";
                                         $query2=$this->db->query($sql);
                                       if($tipe_sj !==""){  
                                      ?>
                                      <tr>
                                        <td colspan="4">Biaya Pengiriman</td>
                                        <td colspan="2"><?php echo htmlentities(number_format($biaya_pengiriman)) ?></td>
                                      </tr>
                                      <tr>
                                        <td  colspan="4">Total</td>
                                        <td><?php foreach ($query2->result() as $total){ echo 'Rp '. number_format($total->total_harga+$biaya_pengiriman); } ?></td>
                                       <!--  <td><a href="<?php echo base_url('Admin/bayar?T='.base64_encode($id_transaksi)).'&P='.base64_encode($id_pelanggan) ?>" class="btn btn-info" target="window" ><i class="fa fa-money" ></i> Bayar</a></td> -->
                                         <td><button class="btn btn-warning" data-toggle="modal" data-target="#myModal" ><i class="fa fa-money" ></i> Bayar</button></td>
                                      </tr>
                                    <?php }else{ ?>
                                       <tr>
                                        <td  colspan="4">Total</td>
                                        <td><?php foreach ($query2->result() as $total){ echo 'Rp '. number_format($total->total_harga); } ?></td>
                                       <!--  <td><a href="<?php echo base_url('Admin/bayar?T='.base64_encode($id_transaksi)).'&P='.base64_encode($id_pelanggan) ?>" class="btn btn-info" target="window" ><i class="fa fa-money" ></i> Bayar</a></td> -->
                                         <td><button class="btn btn-warning" data-toggle="modal" data-target="#myModal" ><i class="fa fa-money" ></i> Bayar</button></td>
                                      </tr>
                                    <?php  } ?>
                                    </tbody>
                                  </table>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
              <div id="myModal" class="modal fade" >
             <div class="right_col" role="main" style="background: none;margin-left: 30%;">
                 <div class="row">
                        <div class="col-md-7 col-sm-10">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Konfirmasi Pembayaran </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                      <li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</li>
                                      <li>
                                     
                                      </li>
                                    </ul>
                            <div class="clearfix"></div>
                          </div>
                                <div class="x_content">
                                    <form method="post" id="form-user" action="<?php base_url() ?>bayar">
                                          <h2>Apakah akan melanjutkan pembayaran ?</h2>
                                              <div class="col-md-6 col-sm-5">
                                                <input type="hidden" name="metode_pembayaran" class="form-control" value="Tunai">
                                            </div>
                                            <input type="hidden" name="T" class="form-control" value="<?php echo $id_transaksi ?>">
                                            <input type="hidden" name="P" class="form-control" value="<?php echo $id_pelanggan ?>">
                                           
                                        <div class="ln_solid">
                                            <div class="form-group">
                                                <div class="col-md-6 offset-md-3">
                                                    <button type="submit" class="btn btn-primary btn-sm mt-3" id="tombol-simpan"><i class="fa fa-next" ></i> Iya</button>
                                                    <button type="button" onClick="document.location.reload(true)" class="btn btn-warning btn-sm mt-3" title="kembali" >Tidak </button>
                                                     
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                              </div>
                            </div>
                         </div>
                        </div>
                      </div>   

          
            <script type="text/javascript">
                function simpan(){
                    if(document.getElementById('id_produk').value==""){
                       $('#pesanproduk').html('Nama Produk  Harus di pilih');
                    }else if(document.getElementById('qty').value==""){
                       $('#pesankg').html('Qty KG Harus di isi');
                    }else if(parseInt(document.getElementById('qty').value) > parseInt(document.getElementById('stok').value)){
                       $('#pesankg').html('Qty melebihi stok yang ada');
                    }
                    else{
                     var data = $('#form-user').serialize();
                     $.ajax({
                         type: 'POST',
                         url: "<?php echo base_url()?>Admin/edit_penjualan",
                         data: data,
                          success: function(data) {
                          if(data!==''){
                              // alert(data);
                               location.reload(true);
                          }
                          else{
                                  location.reload(true);
                              }
                           }
                     });
                   }
                 }
              function hapus(id) {
              if (confirm("Yakin Data Akan Dihapus?") == true) {
               $.ajax({
                    type: 'POST',
                    data: 'id='+id,
                    url: "<?php echo base_url()?>Admin/hapus_penjualan",
                    success: function(result) {
                    location.reload(true);
                      var response = JSON.parse(result);
                     }
                  });
              } else {
                    return;
                }
              
              }
            // function edit(id) {
            //     $('html, body').animate({ scrollTop: 0 }, 'slow');

            //     $.ajax({
            //         type: 'POST',
            //         data: 'id='+id,
            //         success: function(result) {
            //       //  location.reload(true);
            //          $(".right_col").load("<?php echo base_url()?>Admin/form_edit_penjualan?id="+id);
            //           var response = JSON.parse(result);
            //          }
            //       });
                
            //   }
              
          </script>    
         
