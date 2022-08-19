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
                                    <h2>Pengembalian </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</li>
                                        <li>
                                            <a href="<?php echo base_url() ?>Staff_Produksi/data_pengembalian" class="btn btn-warning" title="kembali">
                                                <i class="fa fa-close" style="color:black"></i>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="clearfix">
                                        
                                    </div>
                                </div>
                                <div class="x_content">
                                    <form action="<?php echo base_url() ?>Staff_Produksi/edit_pengembalian"  method="post">
                                        <input  type="hidden" class="form-control" name="id_pengembalian"  id="harga" required=""  maxlength="9" value="<?php echo $id_pengembalian ?>">

                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3">Nama</label>
                                            <div class="col-md-6 col-sm-6">
                                               <select class="form-control" name="id_produk" required="">
                                                 <option value="">pilih</option>
                                                <?php 
                                                    $no=1;
                                                    foreach ($get as $data) {
                                                    ?>

                                                    <option value="<?php echo $data->id_produk; ?>"  <?php if($data->id_produk==$id_produk){ echo "selected";}?>> <?php echo $data->nama;?></option>
                                                    <?php 
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                           <label class="col-form-label col-md-3 col-sm-3">Tanggal Pengembalian</label>    
                                            <div class="col-md-6 col-sm-6  form-group has-feedback">
                                                <input  type="date" class="form-control" name="tgl" required="" id="harga"value="<?php echo $tgl ?>"  >
                                            </div>
                                        </div> 
                                        <div class="field item form-group">
                                           <label class="col-form-label col-md-3 col-sm-3">Jumlah Kg </label>    
                                            <div class="col-md-6 col-sm-6  form-group has-feedback">
                                                <input  type="number" class="form-control" name="jumlah"  id="" required=""  maxlength="9" value="<?php echo $jumlah ?>">
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
                     