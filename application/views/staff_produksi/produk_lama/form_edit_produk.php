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
                                    <form action="<?php echo base_url() ?>Staff_Produksi/edit_produk"  method="post">
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3">Id Produk</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input  type="text" class="form-control" name="id_produk"  data-parsley-trigger="change" readonly value="<?php echo $id_produk ?>">
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3">Kategori</label>
                                            <div class="col-md-6 col-sm-6">
                                               <select class="form-control" name="kategori" required="">
                                                 <option value="">pilih</option>
                                                <?php 
                                                    $no=1;
                                                    foreach ($get as $data) {
                                                    ?>
                                                       <option alue="<?php echo $data->nama_kategori; ?>" <?php if($data->nama_kategori==$kategori){ echo "selected";}?>><?php echo $data->nama_kategori;?></option>
                                                    <?php
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3">Nama </label>
                                            <div class="col-md-6 col-sm-6">
                                                <input  type="text" class="form-control" name="nama"  data-parsley-trigger="change" required="" maxlength="30" value="<?php echo $nama; ?>">
                                            </div>
                                        </div>
                                      <!--   <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3">Jenis Produk </label>
                                            <div class="col-md-6 col-sm-6">
                                                <select name="jenis" class="form-control">
                                                    <option value="">--------</option>
                                                    <option value="Sampingan" <?php// if($jenis="Sampingan"){echo"selected";} ?>>Sampingan</option>
                                                </select>
                                            </div>
                                        </div> -->
                                
                                         <div class="field item form-group">
                                           <label class="col-form-label col-md-3 col-sm-3">Satuan </label>    
                                            <div class="col-md-6 col-sm-6  form-group has-feedback">
                                                <input  type="text" class="form-control" name="kg" required="" id="harga" maxlength="8" value="<?php echo $kg ?>">
                                                <b class="form-control-feedback right">/Kg</b>
                                            </div>
                                        </div> 

                                        <div class="field item form-group">
                                           <label class="col-form-label col-md-3 col-sm-3">Harga </label>    
                                            <div class="col-md-6 col-sm-6  form-group has-feedback">
                                                <input  type="text" class="form-control" name="harga" required="" id="harga" maxlength="8" value="<?php echo $harga ?>">
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
                     