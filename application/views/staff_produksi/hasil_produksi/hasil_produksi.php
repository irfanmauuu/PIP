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
                                   
                                     <form action="<?php echo base_url('Staff_Produksi/hasil_produksi')?>" method="post">
                                        <input type="search" class="form-control sm" name="x" placeholder="Nama Barang" >
                                     </form>
                                </div>
                                  <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                      <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Jumlah Produk Kg</th>
                                        <th>Jumlah Produksi Sak</th>
                                        <th>Total Sak</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                       $no=1;
                                        foreach ($query->result() as $data) {
                                        //  $tgl=date_create($data->tgl_produksi);
                                        ?>
                                        <tr>
                                          <td><?php echo  $no++;?></td>
                                          <td><?php echo htmlentities($data->nama .' '.$data->satuan_kg.'Kg');?></td>
                                          <td><?php echo htmlentities(number_format($data->stok_produk*$data->satuan_kg));?></td>
                                          <td><?php echo htmlentities(number_format($data->stok_produk));?></td>
                                          <td><?php echo htmlentities(number_format($data->stok_produk));?></td>
                                       
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
     