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
											<a href="<?php echo base_url() ?>Staff_Produksi/data_produk" class="btn btn-warning" title="kembali">
											    <i class="fa fa-close" style="color:black"></i>
										    </a>
										</li>
									</ul>
                                    <div class="clearfix">
                                    	
                                    </div>
                                </div>
                                <div class="x_content">
                                    <form action="<?php echo base_url() ?>Staff_Produksi/simpan_produk_lama"  method="post">
                                      
                                        <?php
                                         $jsArray2 = "var prdName = new Array();\n"; 

                                         echo'
                                         <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3">Produk Pengembalian</label>
                                            <div class="col-md-6 col-sm-3">
                                              <select class="form-control" id="id_produk" required="" onchange="changeValue2(this.value)">
                                              <option value="">Pilih</option>';
                                                
                                           
                                                $no=1;
                                                    foreach ($nama_produk->result() as $Row) {
                                                      echo'
                                                         <option value="'.$Row->id_produk.'">'.$Row->nama.'</option>';
                                                         $jsArray2 .= "prdName['" . $Row->id_produk . "'] =     
                                                          {
                                                             id_pengembalian :'".addslashes($Row->id_pengembalian)."',
                                                             nama :'".addslashes($Row->nama)."'
                                                         };\n";
                                                        }  
                                                       echo '</select>';  
                                        ?>  
                                            <script type="text/javascript">  
                                                <?php echo $jsArray2; ?>

                                                   function changeValue2(id){
                                                   document.getElementById('id_pengembalian').value = (prdName[id].id_pengembalian);                             
                                                 };
                                             </script>    
                                         </div>
                                        </div>    
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3">Nama Produk</label>
                                            <div class="col-md-6 col-sm-6">
                                                <select name="id_produk" class="form-control">
                                                    <option value="">Pilih</option>
                                                    <?php 
                                                    $no=1;
                                                    foreach ($produk as $data) {
                                                    echo"
                                                       <option value='".$data->id_produk."'>".$data->nama." ".$data->satuan_kg." Kg </option>
                                                    ";
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                           <label class="col-form-label col-md-3 col-sm-3">Tgl Produksi </label>    
                                            <div class="col-md-6 col-sm-6  form-group has-feedback">
                                                <input  type="date" class="form-control" name="tgl_produksi" required="" maxlength="8">
                                            </div>
                                        </div> 
                                        <div class="field item form-group">
                                           <label class="col-form-label col-md-3 col-sm-3">Stok </label>    
                                            <div class="col-md-6 col-sm-6  form-group has-feedback">
                                                <input  type="text" class="form-control" name="stok" required="" maxlength="8">
                                            </div>
                                        </div> 
                                        <!-- HIDDEN -->
                                        <input type="HIDDEN" name="id_pengembalian" id="id_pengembalian">
                                        <input type="HIDDEN" name="nama" id="nama">
                                       
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
        </div>  
    </div>                 
