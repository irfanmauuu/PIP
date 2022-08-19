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
                                   
                                    <div class="clearfix">
                                   <!--    <a href="<?php echo base_url() ?>Manager/form_pengguna" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah</a> -->
                                     </div>
                                     <form action="<?php echo base_url('Admin/data_pengguna')?>" method="get">
                                        <input type="search" class="form-control sm" name="x" placeholder="Nama Pengguna" >
                                     </form>
                                </div>
                                  <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                      <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Nama</th>
                                        <th>Akses</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                       $no=1;
                                        foreach ($get as $data) {
                                        //  $tgl=date_create($data->tgl_produksi);
                                        ?>
                                        <tr>
                                          <td><?php echo  $no++;?></td>
                                          <td><?php echo htmlentities($data->username);?></td>
                                          <td><?php echo htmlentities($data->nama);?></td>
                                          <td><?php echo htmlentities($data->akses);?></td>
                                          <td><?php echo htmlentities($data->status);?></td>
                                          <td>
                                            <?php if($data->status=='aktif' || $data->status=='Aktif'){
                                            ?>

                                            <a href="<?php echo base_url('Admin/form_edit_pengguna?x='.base64_encode($data->username))?>" class="btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                                            <?php if($data->akses=='Admin' || $data->akses=='admin'){}else{ ?>
                                            <a href="<?php echo base_url('Admin/hapus_pengguna?x='.base64_encode($data->username))?>" class="btn-danger btn-sm" onclick="return confirm('Yakin Data Akan Dihapus???')"><i class="fa fa-trash"></i> Hapus</a>
                                            <?php  } ?>
                                            <?php

                                            }else{ ?>

                                            <button data-toggle="modal" data-target="#myModal<?php echo $data->username ?>" class="btn btn-success btn-sm"><i class="fa fa-check" id="tombol-simpan"></i>Aktivasi</button>
                                             <div id="myModal<?php echo $data->username ?>" class="modal fade" >
             <div class="right_col" role="main" style="background: none;margin-left: 30%;">
                 <div class="row">
                        <div class="col-md-7 col-sm-10">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Aktivasi Akun </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                      <li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</li>
                                      <li>
                                        <a href="<?php echo base_url() ?>Admin/data_pengguna" class="btn btn-warning" title="kembali">
                                            <i class="fa fa-close" style="color:black"></i>
                                          </a>
                                      </li>
                                    </ul>
                            <div class="clearfix"></div>
                          </div>
                            <div class="x_content">
                                    <form method="post" id="form-user" action="<?php base_url() ?>aktivasi_pengguna">
                                        <input type="hidden" name="username" value="<?php echo  $data->username ?>">
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3">Username</label>
                                            <div class="col-md-6 col-sm-6">
                                               <h2><?php echo  $data->username ?></h2>
                                            </div>
                                        </div>
                                         <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3">Akses</label>
                                            <div class="col-md-6 col-sm-6">
                                               <select class="form-control" name="akses" required="">
                                                 <option value="">pilih</option>
                                                 <option value="Manager">Manager</option>
                                                 <option value="Staff Produksi">Staff Produksi</option>
                                                </select>
                                               
                                            </div>
                                        </div>
                                        <div class="ln_solid">
                                            <div class="form-group">
                                                <div class="col-md-6 offset-md-3">
                                                    <button type="submit" class="btn btn-primary btn-sm mt-3" id="tombol-simpan"><i class="fa fa-next" ></i> Submit</button>
                                                     
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                        </div>
             
                                             <?php  } ?>
                                          </td>
                                        </tr>
                                        <?php
                                        }
                                      ?>
                                      <tr></tr>
                                    </tbody>
                                  </table>
                            </div>
                    </div>
                </div>
            </div>
           </div>
          </div>
         </div>  