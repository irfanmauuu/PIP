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
                                    </div>
                                     <form action="<?php echo base_url('Staff_Produksi/data_produk_lama')?>" method="get">
                                        <input type="search" class="form-control sm" name="x" placeholder="Nama Produk">
                                     </form>
                                </div>
                                  <table class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                      <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th>Tanggal Produksi</th>
                                        <th>Harga / Kg</th>
                                        <th>Stok / Sak</th>
                                        <th>Satuan/Kg</th>
                                        <th>Jumlah</th>
                                        <th>Aksi</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                        $no=1;
                                        
                                        foreach ($query->result() as $data)
                                          {
                                         // $jumlah=$data->qty*$data->harga;
                                          $tgl=date_create($data->tgl_produksi);
                                       ?>
                                          <tr>
                                          <td><?php echo  $no++;?></td>
                                          <td><?php echo  $data->nama;?></td>
                                          <td><?php echo htmlentities($data->kategori);?></td>
                                          <td><?php echo htmlentities(date_format($tgl,'d-m-Y'));?></td>
                                          <td><?php echo htmlentities(number_format($data->harga)).' /Kg';?></td>
                                          <td><?php echo htmlentities(number_format($data->stok_produk)).' Sak';?></td>
                                          <td><?php echo htmlentities(number_format($data->satuan_kg)).' Kg';?></td>
                                          <td><?php echo htmlentities(number_format($data->satuan_kg*$data->stok_produk)).' Kg';?></td>
                                          <td>
                                            <button data-toggle="modal" data-target="#myModal<?php echo $data->id_stok?>" class="btn btn-success btn-sm"><i class="fa fa-repeat"></i> Produksi</button>
                                        <div id="myModal<?php echo $data->id_stok?>" class="modal fade" >
             <div class="right_col" role="main" style="background: none;margin-left: 20%;">
                 <div class="row">
                        <div class="col-md-10 col-sm-10">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Produksi Produk Lama </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                      <li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</li>
                                      <li>
                                        <a href="<?php echo base_url() ?>Staff_Produksi/data_produk_lama" class="btn btn-warning" title="kembali">
                                            <i class="fa fa-close" style="color:black"></i>
                                          </a>
                                      </li>
                                    </ul>
                            <div class="clearfix"></div>
                          </div>
                                <div class="x_content">
                                    <form method="post" id="form-user" action="<?php base_url() ?>simpan_produk_lama">
                                      <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3">Produk Lama</label>
                                            <div class="col-md-6 col-sm-6">
                                               <input  type="text" class="form-control" readonly="" value="<?php echo $data->nama; ?>">
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3">Produk Baru</label>
                                            <div class="col-md-6 col-sm-6">
                                               <input  type="text" class="form-control" name="nama" required="">
                                            </div>
                                        </div>
                                         <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3">Kategori</label>
                                            <div class="col-md-6 col-sm-6">
                                               <select class="form-control" name="kategori" required="">
                                                 <option value="">pilih</option>
                                                <?php 
                                                    $no=1;
                                                    foreach ($get as $Data) {
                                                    echo"
                                                       <option value='".$Data->nama_kategori."'>".$Data->nama_kategori."</option>
                                                    ";
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                           <label class="col-form-label col-md-3 col-sm-3">Satuan Kg </label>    <div class="col-md-6 col-sm-6  form-group has-feedback">
                                                <input  type="number" class="form-control" name="satuan_kg" required="">
                                            </div>
                                        </div>

                                        <div class="field item form-group">
                                           <label class="col-form-label col-md-3 col-sm-3">Harga </label>    
                                            <div class="col-md-6 col-sm-6  form-group has-feedback">
                                                <input  type="text" class="form-control" name="harga" required="" id="harga">
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                           <label class="col-form-label col-md-3 col-sm-3">Tgl Produksi </label>    
                                            <div class="col-md-6 col-sm-6  form-group has-feedback">
                                                <input  type="date" class="form-control" name="tgl_produksi" required="" >
                                            </div>
                                        </div> 
                                        <div class="field item form-group">
                                           <label class="col-form-label col-md-3 col-sm-3">Stok </label>    
                                            <div class="col-md-6 col-sm-6  form-group has-feedback">
                                                <input  type="text" class="form-control" name="stok" required="" maxlength="8">
                                            </div>
                                        </div>
                                        <input type="hidden" name="id_produk" value="<?php echo $id_produk ?>"> 
                                        <input type="hidden" name="id_stok" value="<?php echo $data->id_stok ?>"> 
                                       
                                        <div class="form-group">
                                                <div class="col-md-6 offset-md-3">
                                                    <button type="submit" name="submit" class="btn btn-primary btn-sm mt-3" id="tombol-simpan"><i class="fa fa-next" ></i> Simpan</button>
                                                     
                                                </div>
                                       </div>
                                    </form>
                                </div>
                              </div>
                            </div>
                          </div>
                         </div>
                      </div>
                                            <a href="<?php echo base_url('Staff_Produksi/hapus_produk_lama?x='.base64_encode($data->id_stok))?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Data Akan Dihapus???')"><i class="fa fa-trash"></i> Hapus</a>
                                          </td>
                                        </tr>   
                                        <?php } ?> 
                                            </tbody>
                                         </table>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                             </div>
                      
                      
