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
                                    <h2>Pengguna </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</li>
                                        <li>
                                            <a href="<?php echo base_url() ?>Manager/data_pengguna" class="btn btn-warning" title="kembali">
                                                <i class="fa fa-close" style="color:black"></i>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="clearfix">
                                        
                                    </div>
                                </div>
                                <div class="x_content">
                                    <form action="<?php echo base_url() ?>Managermin/simpan_pengguna"  method="post">
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3">Username</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input  type="text" class="form-control" name="id_pelanggan"  data-parsley-trigger="change">
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3">Nama</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input  type="text" class="form-control" name="nama"  data-parsley-trigger="change" required="" maxlength="30">
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3">Akses</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input  type="text" class="form-control" name="akses"  data-parsley-trigger="change" required="" maxlength="13">
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3">Password</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input  type="password" class="form-control" name="password"  data-parsley-trigger="change" required="" maxlength="13" >
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
                     