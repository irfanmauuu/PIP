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
                               <!--        <button data-toggle="modal" data-target="#myModal" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-plus" id="tombol-simpan"></i>Tambah Transaksi</button>
                                -->      </div>
                                     <!-- <form action="<?php echo base_url('Staff_Produksi/data_penjualan')?>" method="get"> -->
                                        <input type="search" class="form-control sm" name="x" placeholder="Nama Pelanggan">
                                     </form>
                                </div>
                                  <table class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                      <tr>
                                        <th>No</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Tanggal</th>
                                        <th>Tipe SJ</th>
                                        <th>Aksi</th>
                                        <th>Cetak</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                        $no=1;
                                        
                                        foreach ($query->result() as $data)
                                          {
                                         // $jumlah=$data->qty*$data->harga;
                                          $tgl=date_create($data->tgl);
                                       ?>
                                          <tr>
                                           <td><?php echo  $no++;?></td>
                                           <td><?php echo htmlentities($data->nama) ?></td>
                                           <td><?php echo htmlentities(date_format($tgl,'d-m-Y'));?></td>
                                           <td><?php echo htmlentities($data->tipe_sj);?></td>
                                           <td>   
                                           <?php 
                                              if($data->no_do==null)
                                              {
                                                ?>
                                                   <button data-toggle="modal" data-target="#myModal<?php echo $data->id_transaksi.'-'.$data->id_pelanggan.'-'.$data->tgl.'-'.$data->tipe_sj ?>" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-plus" id="tombol-simpan"></i> Tambah</button>
                                        
                                            <?php 
                                              }else{
                                                ?>
                                                 <button data-toggle="modal" data-target="#myModal<?php echo $data->id_transaksi.'-'.$data->id_pelanggan.'-'.$data->tgl.'-'.$data->tipe_sj  ?>" class="btn btn-primary btn-sm"><i class="fa fa-eye" id="tombol-simpan"></i> Lihat</button>
                                                <?php 
                                              }
                                           ?> 
                                        

                                   <div id="myModal<?php echo $data->id_transaksi.'-'.$data->id_pelanggan.'-'.$data->tgl.'-'.$data->tipe_sj ?>" class="modal fade" >
                                   <div class="right_col" role="main" style="background: none;margin-left: 15%; width: 120%">
                                       <div class="row">
                                              <div class="col-md-7 col-sm-10">
                                                  <div class="x_panel">
                                                      <div class="x_title">
                                                          <h2>Surat Jalan </h2>
                                                          <ul class="nav navbar-right panel_toolbox">
                                                            <li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</li>
                                                            <li>
                                                              <a href="<?php echo base_url() ?>Staff_Produksi/data_penjualan" class="btn btn-warning" title="kembali">
                                                                  <i class="fa fa-close" style="color:black"></i>
                                                                </a>
                                                            </li>
                                                          </ul>
                                                  <div class="clearfix"></div>
                                                </div>
                                                      <div class="x_content">
                                                          <form method="post" id="form-user" action="<?php base_url() ?>simpan_no_do">
                                                            <!-- Hidden -->
                                                              <input type="Hidden" name="id_pelanggan" class="form-control" value="<?php echo $data->id_pelanggan ?>"> 
                                                               <input type="Hidden" name="id_transaksi" class="form-control" value="<?php echo $data->id_transaksi ?>" readonly>    
                                                                

                                                              <div class="field item form-group">
                                                                  <label class="col-form-label col-md-3 col-sm-3">No DO</label>
                                                                  <div class="col-md-6 col-sm-3">
                                                                    <input type="text" name="no_do" class="form-control" required="" value="<?php if($data->no_do==null){echo $no_do; }else{ echo $data->no_do; } ?>" readonly>    
                                                                  </div>
                                                              </div>
                                                              <div class="field item form-group">
                                                                  <label class="col-form-label col-md-3 col-sm-3">Pelanggan</label>
                                                                  <div class="col-md-6 col-sm-3">
                                                                    <input type="text" name="nama" class="form-control" value="<?php echo $data->nama ?>" readonly>    
                                                                  </div>
                                                              </div>
                                                              <div class="field item form-group">
                                                                  <label class="col-form-label col-md-3 col-sm-3">Tipe Sj</label>
                                                                  <div class="col-md-6 col-sm-3" readonly>
                                                                    <input type="text" name="tipe_sj" class="form-control" value="<?php echo $data->tipe_sj ?>" readonly>    
                                                                  </div>
                                                              </div>
                                                               <div class="field item form-group">
                                                                  <label class="col-form-label col-md-3 col-sm-3">Tgl</label>
                                                                  <div class="col-md-6 col-sm-3">
                                                                    <input type="text" name="tgl" class="form-control" value="<?php $tgl=date_create($data->tgl); echo date_format($tgl,'d-m-Y');   ?>" readonly>    
                                                                  </div>
                                                              </div>
                                                              <?php  if(!$data->no_do==null){}else{?>
                                                              <div class="ln_solid">
                                                                  <div class="form-group">
                                                                      <div class="col-md-6 offset-md-3">
                                                                          <button type="submit" class="btn btn-primary btn-sm mt-3" id="tombol-simpan"><i class="fa fa-save" ></i> Simpan</button>
                                                                           
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                            <?php } ?>
                                                          </form>
                                                         <table id="datatable" class="table table-striped table-bordered" style="width:100%" id=tampildata>
                                                          <thead class="thead thead-dark">
                                                            <tr>
                                                              <th rowspan=3>No</th>
                                                              <th rowspan=3>Produk</th>
                                                              <th rowspan=3>Harga</th>
                                                              <th rowspan=3>Qty Sak</th>
                                                              <th rowspan=3>Jumlah</th>
                                                            </tr>

                                                          </thead>
                                                         <tbody id="listUser">
                                                            <?php 
                                                            $No=1;
                                                              $sql="SELECT id_penjualan,produk.id_produk,produk.nama,produk.harga,qty,id_pelanggan,no_do,kg,stok_produk.tgl_produksi as tgl_produksi
                                                              
                                                                    FROM penjualan,produk,stok_produk WHERE penjualan.id_produk=produk.id_produk AND penjualan.id_pelanggan='$data->id_pelanggan' AND status='lunas' AND tipe_sj='$data->tipe_sj' AND tgl='$data->tgl' AND id_transaksi='$data->id_transaksi' AND penjualan.id_stok=stok_produk.id_stok";
                                                              $query=$this->db->query($sql);
                                                              
                                                              foreach ($query->result() as $row)
                                                                {
                                                                $jumlah=$row->qty*$row->harga;
                                                               
                                                             ?>
                                                                <tr>
                                                                 <td><?php echo  $No++;?></td>
                                                                 <td><?php echo htmlentities($row->nama.' '.$row->kg.' Kg');?></td>
                                                                 <td><?php echo htmlentities(number_format($row->harga*$row->kg));?></td>
                                                                 <td><?php echo htmlentities($row->qty);?></td>
                                                                 <td><?php echo htmlentities(number_format($jumlah*$row->kg));?></td>
                                                               </tr> 
                                                               <?php
                                                                 }
                                                              
                                                              
                                                               $sql="SELECT produk.harga,penjualan.qty, 
                                                                  SUM(harga*qty*satuan_kg) as total_harga
                                                                  FROM penjualan,produk WHERE penjualan.id_produk=produk.id_produk AND penjualan.id_pelanggan='$data->id_pelanggan' AND status='lunas'  AND id_transaksi='$data->id_transaksi'";
                                                               $query2=$this->db->query($sql);
                                                              
                                                            ?>
                                                            <tr>
                                                              <td  colspan="4">Total</td>
                                                              <td><?php foreach ($query2->result() as $total){ echo ' '. number_format($total->total_harga); } ?></td>
                                                            </tr>
                                                           
                                                          </tbody>
                                                        </table>
                                                      </div>
                                                    </div>
                                                   
                                                  </td>
                                                  <td>
                                                     <?php 
                                                  if($data->no_do==null )
                                                  { }else{
                                                      ?>
                                                       <a href="<?php echo base_url('Staff_Produksi/cetak_surat_jalan?N='.base64_encode($data->no_do).'&T='.base64_encode($data->tgl).'&Sj='.base64_encode($data->tipe_sj).'&IT='.base64_encode($data->id_transaksi).'&Ip='.base64_encode($data->id_pelanggan).'&np='.base64_encode($data->nama))  ?>" target=window class="btn btn-danger"><i class="fa fa-print"></i></a>
                                                      <?php 
                                                    }
                                                 ?> 
                                                  </td>
                                                </tr>
                                                 <?php
                                                    }
                                                  ?>
                                                 
                                            </tbody>
                                         </table>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                             </div>
                        </div> 
                        
         