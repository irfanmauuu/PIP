 <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                        </div>

                    </div>
                    <div class="clearfix"></div>

                                                  <div id="myModal2<?php echo $row->tgl.'-'.$row->id_pelanggan ?>" class="modal fade" id="modal2" >
                                                           <div class="right_col" role="main" style="background: none;margin-left: 20%; width: 100%;margin-top:2%">
                                                                  <div class="row">
                                                                    <div class="col-md-7 col-sm-10">
                                                                       <div class="x_panel">
                                                                            <div class="x_title">
                                                                               <h2>Pengembalian Produk </h2>
                                                                                   <ul class="nav navbar-right panel_toolbox">
                                                                                    <li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</li>
                                                                                       <li>
                                                                                         <a href="<?php echo base_url() ?>Staff_Produksi/data_pengembalian" class="btn btn-warning" title="kembali">
                                                                                            <i class="fa fa-close" style="color:black"></i>
                                                                                          </a>
                                                                                              </li>
                                                                                            </ul>
                                                                                    <div class="clearfix"></div>
                                                                                  </div>
                                                                                  <div class="x_content">
                                                                                    <?php echo $id_pelanggan=$row->id_pelanggan; ?>
                                      <form id="form-user" action="simpan_pengembalian"   method="post" >
                                     <?php

                                        $Sql="SELECT DISTINCT
                                                  penjualan.id_stok as id_stok,
                                                  penjualan.id_produk as id_produk,
                                                  penjualan.id_penjualan as id_penjualan,
                                                  penjualan.qty as qty,
                                                  penjualan.kg as satuan_kg,

                                                  produk.nama as nama
                                                  FROM penjualan,produk,stok_produk WHERE penjualan.id_produk=produk.id_produk AND status='lunas' AND id_pelanggan = '$id_pelanggan' ";
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
                                                      echo'
                                                         <option value="'.$Row->id_produk.'">'.$Row->nama.' '.$Row->satuan_kg.' Kg</option>';
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

                                                   document.getElementById('id_penjualan').value = (prdName[id].id_penjualan);
                                                   document.getElementById('id_stok').value = prdName[id].id_stok;
                                                   document.getElementById('total_kg').value = (prdName[id].total_kg);                             
                                                 };
                                             </script>    
                                            
                                            <span id="pesan1"></span>
                                           </div>

                                        </div>
                                        <input type="text" name="id_stok" id="id_stok">
                                        <input type="text" name="id_pelanggan" value="<?php echo $row->id_pelanggan ?>">
                                        <input type="text" name="id_penjualan" id="id_penjualan">
                                        <input type="text" name="tipe_sj" value="<?php echo $row->tipe_sj ?>">
                                        <input type="text" name="id_pengembalian" value="<?php echo $id_pengembalian ?>">
                                        <input type="text" name="tgl" value="<?php echo date('Y/m/d') ?>">
                                        
                                       <!--   <div class="field item form-group">
                                             <label class="col-form-label col-md-3 col-sm-3">Harga</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input  type="text" class="form-control" name="harga"  data-parsley-trigger="change" id="harga" readonly="">
                                            </div>
                                        </div> -->
                                        <div class="field item form-group">
                                             <label class="col-form-label col-md-3 col-sm-3">Total Kg</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input  type="text" class="form-control" name="total_kg"  data-parsley-trigger="change" id='total_kg' readonly="">
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                             <label class="col-form-label col-md-3 col-sm-3">Qty Kg</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input  type="number" class="form-control" name="qty"  data-parsley-trigger="change" id=qty min="0" max="1000">
                                                <span id="pesan3"></span>
                                            </div>
                                        </div>
                                        <div class="ln_solid">
                                            <div class="form-group">
                                                <div class="col-md-6 offset-md-3">
                                                  <input type="submit" name="submit" value="submit">
                                                 <!--    <button type="button" class="btn btn-primary btn-sm mt-3" onclick="simpan()"><i class="fa fa-save" ></i> Simpan</button> -->
                                                     
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
                                  </td>
                               </tr>

                               <?php     } ?>

                                                            
                                                          </tbody>
                                                        </table>
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
                                      url: "<?php echo base_url()?>Staff_Produksi/hapus_surat_jalan",
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
