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
                                    <h2>Pelanggan </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</li>
                                        <li>
                                            <a href="<?php echo base_url() ?>Staff_Gudang/data_pelanggan" class="btn btn-warning" title="kembali">
                                                <i class="fa fa-close" style="color:black"></i>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="clearfix">
                                        
                                    </div>
                                </div>
                                <div class="x_content">
                                    <form action="<?php echo base_url() ?>Staff_Gudang/edit_pelanggan"  method="post">
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3">Id Pelanggan</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input  type="text" class="form-control" name="id_pelanggan"  data-parsley-trigger="change" readonly value="<?php echo $id_pelanggan ?>">
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3">Nama</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input  type="text" class="form-control" name="nama"  data-parsley-trigger="change" value="<?php echo$nama ?>" required="" maxlength="30">
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                           <label class="col-form-label col-md-3 col-sm-3">Alamat</label>    
                                            <div class="col-md-6 col-sm-6">
                                              <textarea class="form-control" name="alamat" maxlength="300" required="">
                                                  <?php echo $alamat ?>
                                              </textarea>
                                            </div>
                                        </div> 
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3">No Hp</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input  type="text" class="form-control" name="no_hp"  data-parsley-trigger="change" required="" maxlength="13" value="<?php echo $no_hp ?>">
                                            </div>
                                        </div>
                                        <div class="ln_solid">
                                            <div class="form-group">
                                                <div class="col-md-6 offset-md-3">
                                                    <button type='submit' class="btn btn-primary btn-sm mt-3"><i class="fa fa-pencil"></i> Edit</button>
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
                     