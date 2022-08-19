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
                                      <a href="<?php echo base_url() ?>Staff_Produksi/form_produk" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah</a>
                                     </div>
                                     <form action="<?php echo base_url('Staff_Produksi/data_produk')?>" method="get">
                                        <input type="search" class="form-control sm" name="x" placeholder="Nama Barang" >
                                     </form>
                                </div>
                                  <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                      <tr>
                                        <th>No</th>
                                        <th>ID Kategori</th>
                                        <th>Kategori</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Total Produk</th>
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
                                          <td><?php echo  $data->id_produk;?></td>
                                          <td><?php echo htmlentities($data->kategori);?></td>
                                          <td><?php echo htmlentities($data->nama.' '.$data->satuan_kg.'/Kg');?></td>
                                          <td><?php echo htmlentities(number_format($data->harga)).' /Kg';?></td>
                                          <td><?php echo htmlentities(number_format($data->total_beras)).' /Kg';?></td>
                                          <td>
                                            <a href="<?php echo base_url('Staff_Produksi/form_edit_produk?x='.base64_encode($data->id_produk))?>" class="btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                                          
                                            <a href="<?php echo base_url('Staff_Produksi/hapus_produk?x='.base64_encode($data->id_produk))?>" class="btn-danger btn-sm" onclick="return confirm('Yakin Data Akan Dihapus???')"><i class="fa fa-trash"></i> Hapus</a>
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
     