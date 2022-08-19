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
                                      <a href="<?php echo base_url() ?>Staff_Produksi/form_kategori" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah</a>
                                     </div>
                                     <form action="<?php echo base_url('Staff_Produksi/data_kategori')?>" method="get">
                                        <input type="search" class="form-control sm" name="x" placeholder="Nama Kategori" >
                                     </form>
                                </div>
                                  <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                      <tr>
                                        <th>No</th>
                                        <th>ID Kategori</th>
                                        <th>Nama Kategori</th>
                                        <th>Aksi</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                       $no=1;
                                        foreach ($get as $data) {
                                        ?>
                                        <tr>
                                          <td><?php echo $no++;?></td>
                                          <td><?php echo  $data->id_kategori;?></td>
                                          <td><?php echo htmlentities($data->nama_kategori);?></td>
                                          <td>
                                            <a href="<?php echo base_url('Staff_Produksi/form_edit_kategori?x='.base64_encode($data->id_kategori))?>" class="btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                                          
                                            <a href="<?php echo base_url('Staff_Produksi/hapus_kategori?x='.base64_encode($data->id_kategori))?>" class="btn-danger btn-sm" onclick="return confirm('Yakin Data Akan Dihapus???')"><i class="fa fa-trash"></i> Hapus</a>
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
     