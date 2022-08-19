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
                                        <button data-toggle="modal" data-target="#myModal" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-plus" id="tombol-simpan"></i>Tambah</button>
                                    </div>
                                     <form action="<?php echo base_url('Staff_Produksi/data_pengembalian')?>" method="get">
                                        <input type="search" class="form-control sm" name="x" placeholder="Nama Pelanggan">
                                     </form>
                                </div>
                                  <table class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                      <tr>
                                        <th>No</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Tipe SJ</th>
                                        <th>Tanggal</th>
                                        <th>Detail</th>
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
                                           <td><?php echo htmlentities($data->tipe_sj) ?></td>
                                           <td><?php echo htmlentities(date_format($tgl,'d-m-Y'));?></td>
                                           <td>   
                                            <button data-toggle="modal" data-target="#myModal<?php echo $data->id_pengembalian?>" class="btn btn-success btn-sm"><i class="fa fa-eye" id="tombol-simpan"></i> </button>
                                        

                                <div id="myModal<?php echo $data->id_pengembalian ?>" class="modal fade" >
                                   <div class="right_col" role="main" style="background: none;margin-left: 15%; width: 120%">
                                       <div class="row">
                                              <div class="col-md-7 col-sm-10">
                                                  <div class="x_panel">
                                                      <div class="x_title">
                                                          <h2>Pengembalian Produk </h2>
                                                          <ul class="nav navbar-right panel_toolbox">
                                                            <li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</li>
                                                            <li>
                                                              <a href="<?php echo base_url() ?>Staff_Produksi/data_pengembalian" class="btn btn-warning" title="kembali">
                                                                  <i class="fa fa-close" style="color:black"></i>
                                                                </a>
                                                            </li>
                                                          </ul>
                                                  <div class="clearfix"></div>
                                                </div>
                                                      <div class="x_content">
                                                         <table id="datatable" class="table table-striped table-bordered" style="width:100%" id=tampildata>
                                                          <thead class="thead thead-dark">
                                                            <tr>
                                                              <th rowspan=3>No</th>
                                                              <th rowspan=3>Produk</th>
                                                              <th rowspan=3>Harga</th>
                                                              <th rowspan=3>Qty <br>Penjualan</th>
                                                              <th rowspan=3>Qty <br>Pengembalian</th>
                                                              <th rowspan=3>Jumlah</th>
                                                            </tr>

                                                          </thead>
                                                         <tbody id="listUser">
                                                            <?php 
                                                            $No=1;
                                                              $Sql="penjualan 
                                                                    WHERE 
                                                                    id_pelanggan='$data->id_pelanggan' 
                                                                    AND tgl='$data->tgl' 
                                                                    AND tipe_sj='$data->tipe_sj' AND id_penjualan='$data->id_penjualan' 
                                                                   ";
                                                              $Query=$this->db->get($Sql);
                                                              $sql="SELECT 
                                                                 produk.satuan_kg as satuan_kg, 
                                                                 produk.nama as nama,
                                                                 produk.harga as harga,
                                                                 jumlah as jumlah,
                                                                 pengembalian.tgl as tgl
                                                                 FROM pengembalian,produk 
                                                                    WHERE pengembalian.id_produk=produk.id_produk
                                                                    AND pengembalian.id_pelanggan='$data->id_pelanggan' 
                                                                    AND pengembalian.tgl='$data->tgl' 
                                                                    AND pengembalian.tipe_sj='$data->tipe_sj' 
                                                                  
                                                                    AND pengembalian.id_penjualan='$data->id_penjualan'";
                                                              $query=$this->db->query($sql);
                                                              
                                                              foreach ($query->result() as $row)
                                                                {
                                                                $jumlah=$row->jumlah*$row->harga;
                                                             ?>
                                                                <tr>
                                                                 <td><?php echo  $No++; ?> </td>
                                                                 <td><?php echo htmlentities($row->nama.' '.$row->satuan_kg.' Kg');?></td>
                                                                 <td><?php echo htmlentities(number_format($row->harga*$row->satuan_kg).'/Sak');?></td>
                                                                 <td><?php 
                                                                  $i=$Query->result_array();
                                                                    $num= $Query->num_rows();
                                                                     // echo $key['qty'];      
                                                                  if(!$num==1){
                                                                         echo htmlentities($row->jumlah).' Sak';
                                                                    }    
                                                                  else{
                                                                      foreach ($i as $key ) {  
                                                                          echo htmlentities($row->jumlah+$key['qty']).' Sak'; 
                                                                        }
                                                                    }  
                                                                   ?></td>
                                                                 <td><?php echo htmlentities($row->jumlah).'  Sak';?></td>
                                                                 <td><?php echo htmlentities(number_format($jumlah*$row->satuan_kg));?></td>
                                                               </tr> 
                                                               <?php
                                                              }
                                                              //Total
                                                               $sql="SELECT produk.satuan_kg as satuan_kg,produk.harga,pengembalian.jumlah,SUM(jumlah) as jumlah, 
                                                                  SUM(harga*jumlah) as total_harga
                                                                  FROM pengembalian,produk WHERE pengembalian.id_produk=produk.id_produk AND id_pelanggan='$data->id_pelanggan' AND id_penjualan='$data->id_penjualan' AND tgl='$data->tgl' AND tipe_sj='$data->tipe_sj' ";
                                                               $query2=$this->db->query($sql);
                                                              
                                                            ?>
                                                            <tr>
                                                              <td  colspan="4">Total</td>
                                                              <td><?php foreach ($query2->result() as $total){ echo  number_format($total->jumlah).' Sak'; } ?></td>
                                                              <td><?php foreach ($query2->result() as $total){ echo  number_format($total->total_harga*$total->satuan_kg); } ?></td>
                                                            </tr>
                                                           
                                                          </tbody>
                                                        </table>
                                                      </div>
                                                    </div>
                                                   
                                                  </td>
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
                      
                           <div id="myModal" class="modal fade" >
                                   <div class="right_col" role="main" style="background: none;margin-left: 15%; width: 120%">
                                       <div class="row">
                                              <div class="col-md-7 col-sm-10" >
                                                  <div class="x_panel"  id="background" >
                                                      <div class="x_title">
                                                          <h2>Data Penjualan</h2>
                                                          <ul class="nav navbar-right panel_toolbox">
                                                            <li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</li>
                                                            <li>
                                                              <a href="<?php echo base_url() ?>Staff_Produksi/data_pengembalian" class="btn btn-warning" title="kembali">
                                                                  <i class="fa fa-close" style="color:black"></i>
                                                                </a>
                                                            </li>
                                                          </ul>
                                                  <div class="clearfix"></div>
                                                </div>
                                                      <div class="x_content">
                                                        <h3></h3>
                                                         <table class="table table-striped table-bordered" style="width:100%" id=tampildata>
                                                          <thead class="thead thead-dark">
                                                            <tr>
                                                              <th >No</th>
                                                              <th >Nama</th>
                                                              <th >Tipe SJ</th>
                                                              <th >Tanggal</th>
                                                              <th >Proses</th>
                                                            </tr>

                                                          </thead>
                                                         <tbody id="listUser">
                                                            <?php 
                                                              $delete="DELETE FROM penjualan WHERE qty=0 OR qty<0 ";
                                                              $this->db->query($delete);

                                                              $No=1;
                                                              $sql="SELECT DISTINCT id_transaksi, penjualan.tgl as tgl,pelanggan.nama as nama,penjualan.id_pelanggan,tipe_sj,no_do FROM penjualan,pelanggan WHERE status='lunas' AND penjualan.id_pelanggan=pelanggan.id_pelanggan";
                                                              $query=$this->db->query($sql);
                                                              
                                                              foreach ($query->result() as $row)
                                                                {
                                                                $tgl=date_create($row->tgl);
                                                             ?>
                                                                <tr>
                                                                 <td><?php echo  $No++;?></td>

                                                                 <td><?php echo htmlentities($row->nama);?></td>
                                                                 <td><?php echo htmlentities($row->tipe_sj);?></td>
                                                                 <td><?php echo htmlentities(date_format($tgl,'d-m-Y'));?></td>
                                                                 <td>
                                                                  <a href="<?php echo base_url('Staff_Produksi/form_pengembalian?iT='.base64_encode($row->id_transaksi).'&P='.base64_encode($row->id_pelanggan).'&SJ='.base64_encode($row->tipe_sj).'&Tg='.base64_encode($row->tgl))?>"  class="btn btn-primary btn-sm" onclick="background()"><i class="fa fa-edit" id="tombol-simpan"></i> </button>
                                                                  </td>
                                                                  </tr>
                                                             <?php   } ?>                                                            
                                                          </tbody>
                                                        </table>
                                                      </div>
                                                     
                                              </div>
                                            </div> 
                                          </div> 
                                        </div>
                                      </div>
                                     </div>
                                   </div>
                                 </div>
                              </div>     
