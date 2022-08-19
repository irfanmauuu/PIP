 <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                        </div>

                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Produk </h2>
                                    <ul class="nav navbar-right panel_toolbox">
										<li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</li>
										<li>
											<a href="<?php echo base_url() ?>Staff_Produksi/data_stok" class="btn btn-warning" title="kembali">
											    <i class="fa fa-close" style="color:black"></i>
										    </a>
										</li>
									</ul>
                                    <div class="clearfix">
                                    	
                                    </div>
                                </div>
                                <div class="x_content">
                                    <form action="<?php echo base_url() ?>Staff_Produksi/simpan_stok"  method="post">
                                  <?php   
                                        $jsArray2 = "var prdName = new Array();\n"; 
                                       echo'
                                         <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3">Nama Produk</label>
                                            <div class="col-md-6 col-sm-3">
                                              <select class="form-control" id="id_produk" name=id_produk required="" onchange="changeValue2(this.value)">
                                              <option value="">Pilih</option>';
                                          
                                                $no=1;
                                                    foreach ($get->result() as $row) {
                                                       $tgl=date_create($row->tgl_produksi); 
                                                    echo'
                                                         <option value="'.$row->id_produk.'">'.$row->nama.' / '.number_format($row->total_beras).' Kg</option>';
                                                       $jsArray2 .= "prdName['" . $row->id_produk . "'] =     
                                                          {
                                                             kg                      :'".addslashes($row->satuan_kg)."',
                                                             total_beras             :'".addslashes($row->total_beras)."',
                                                             kategori             :'".addslashes($row->kategori)."'
                                                         };\n";
                                                        }  
                                                       echo '</select>';  
                                        ?>  
                                            <script type="text/javascript">  
                                                <?php echo $jsArray2; ?>
                                                  function changeValue2(id){
                                                    document.getElementById('kategori').value=(prdName[id].kategori)
                                                 var kg         = document.getElementById('kg').value = (prdName[id].kg);  
                                                 var total_beras = document.getElementById('total_beras').value = (prdName[id].total_beras);
                                                   document.getElementById('stok').value = parseInt(total_beras)/parseInt(kg);                          
                                                 };
                                             </script>
                                        </div>
                                        </div>
                                        <input type="hidden" name="total_beras" id="total_beras">
                                        <div class="field item form-group">
                                           <label class="col-form-label col-md-3 col-sm-3">Kg</label>    
                                            <div class="col-md-6 col-sm-6  form-group has-feedback">
                                                <input  type="text" class="form-control" name="kg" required="" id="kg" readonly="">
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                           <label class="col-form-label col-md-3 col-sm-3">Stok </label>    
                                            <div class="col-md-6 col-sm-6  form-group has-feedback">
                                                <input  type="text" class="form-control" name="stok" required=""   id="stok" readonly="">
                                                <b class="form-control-feedback right">/Sak</b>
                                            </div>
                                        </div> 
                                        <div class="field item form-group">
                                           <label class="col-form-label col-md-3 col-sm-3">Kategori </label>    
                                            <div class="col-md-6 col-sm-6  form-group has-feedback">
                                                <input  type="text" class="form-control" name="kategori" required=""  id="kategori" readonly="">
                                            </div>
                                        </div> 
                                        <div class="field item form-group">
                                           <label class="col-form-label col-md-3 col-sm-3">Tanggal Produksi </label>    
                                            <div class="col-md-6 col-sm-6  form-group has-feedback">
                                                <input  type="date" class="form-control" name="tgl_produksi" required="" id="harga" >
                                            </div>
                                        </div> 
                                       
                                   
                                       
                                        <div class="ln_solid">
                                            <div class="form-group">
                                                <div class="col-md-6 offset-md-3">
                                                    <button type='submit' class="btn btn-primary btn-sm mt-3"><i class="fa fa-save"></i> Simpan</button>
                                                    <button type='reset' class="btn btn-success btn-sm mt-3">Reset</button>
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
                     